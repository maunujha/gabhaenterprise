#!/usr/bin/env bash
#
# Gabha Enterprise — production deploy.
# Run on the server as the `deploy` user:  bash deploy/deploy.sh
# (or install as /usr/local/bin/gabha-deploy).
#
# This script is IDEMPOTENT — running it repeatedly is safe. It deploys the
# current `origin/main` into an in-place git working tree and, on any failure,
# rolls the CODE back to the previous commit, rebuilds caches, and always leaves
# the app out of maintenance mode.
#
# NOTE on isolation: every command below is scoped to APP_DIR
# (/var/www/gabhaenterprise). It never touches other apps on this shared VPS
# (e.g. Urbanflaky) and never restarts shared services (nginx, php8.3-fpm).
#
# Overridable via env:
#   APP_DIR          project root            (default /var/www/gabhaenterprise)
#   BRANCH           branch to deploy         (default main)
#   HEALTHCHECK_URL  URL for the HTTP 200 check (default: app.url from config)
#
set -euo pipefail

APP_DIR="${APP_DIR:-/var/www/gabhaenterprise}"
BRANCH="${BRANCH:-main}"
HEALTHCHECK_URL="${HEALTHCHECK_URL:-}"

cd "$APP_DIR"

log() { printf '\n\033[1;34m→ %s\033[0m\n' "$*"; }
ok()  { printf '\033[1;32m✔ %s\033[0m\n' "$*"; }
warn(){ printf '\033[1;33m!  %s\033[0m\n' "$*"; }
err() { printf '\033[1;31m✖ %s\033[0m\n' "$*" >&2; }

# ---------------------------------------------------------------------------
# Rollback safety: remember the current commit so a failure can revert cleanly.
# ---------------------------------------------------------------------------
PREV_SHA="$(git rev-parse HEAD)"
ROLLED_BACK=0

rollback() {
  ROLLED_BACK=1
  err "Deploy failed — rolling code back to ${PREV_SHA:0:12}"
  git reset --hard "$PREV_SHA" || true
  composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist || true
  php artisan optimize:clear || true
  php artisan config:cache || true
  php artisan route:cache || true
  php artisan view:cache || true
  warn "Code rolled back to ${PREV_SHA:0:12}. Any DB migrations that already ran were NOT reverted"
  warn "(auto-rolling-back migrations is unsafe). Review manually — see DEPLOYMENT.md → Rollback."
}

# Single EXIT trap: roll back on error, and ALWAYS leave maintenance mode.
cleanup() {
  local code=$?
  if [ "$code" -ne 0 ] && [ "$ROLLED_BACK" -eq 0 ]; then
    rollback || true
  fi
  php artisan up || true
}
trap cleanup EXIT

# ---------------------------------------------------------------------------
# Health checks — return non-zero on a CRITICAL failure (triggers rollback).
# Proves: Laravel boots, APP_KEY set, migrations current, homepage serves 200.
# ---------------------------------------------------------------------------
run_healthchecks() {
  local fail=0

  # 1 + 2. Laravel boots AND APP_KEY is present (single framework-boot check).
  if php -r '
        require "vendor/autoload.php";
        $app = require "bootstrap/app.php";
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        exit(empty(config("app.key")) ? 1 : 0);
      ' >/dev/null 2>&1; then
    ok "Laravel boots and APP_KEY is set"
  else
    err "Laravel failed to boot or APP_KEY is missing"; fail=1
  fi

  # 3. Migrations completed (no pending migrations remain).
  if migrate_status="$(php artisan migrate:status 2>&1)"; then
    if printf '%s' "$migrate_status" | grep -qiE '\bpending\b'; then
      err "Pending migrations remain after deploy"; fail=1
    else
      ok "Database migrations are up to date"
    fi
  else
    err "Could not read migration status (DB connectivity?)"; fail=1
  fi

  # 4. Storage symlink — advisory only (this app does not use the public disk).
  if [ -L public/storage ] || [ -e public/storage ]; then
    ok "Storage link present"
  else
    warn "public/storage symlink absent — app does not use the public disk, so this is non-fatal"
  fi

  # 5. Homepage returns HTTP 200 (hit local nginx via --resolve to avoid DNS/hairpin issues).
  local url host code
  url="$HEALTHCHECK_URL"
  if [ -z "$url" ]; then
    url="$(php -r '
        require "vendor/autoload.php";
        $app = require "bootstrap/app.php";
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        echo rtrim((string) config("app.url"), "/");
      ' 2>/dev/null || true)"
  fi
  if [ -n "$url" ] && command -v curl >/dev/null 2>&1; then
    host="$(printf '%s' "$url" | sed -E 's#^https?://##; s#/.*$##')"
    code="$(curl -skS -o /dev/null -w '%{http_code}' --max-time 15 \
              --resolve "${host}:443:127.0.0.1" "https://${host}/" 2>/dev/null || echo 000)"
    if [ "$code" = "200" ]; then
      ok "Homepage returned HTTP 200 (${url})"
    elif [ "$code" = "000" ]; then
      # Could not connect from the server (e.g. hairpin NAT). The workflow's
      # external check is authoritative — warn here rather than false-fail.
      warn "Could not reach ${url} from the server locally (HTTP 000) — see the workflow's external check"
    else
      err "Homepage returned HTTP ${code} (expected 200) at ${url}"; fail=1
    fi
  else
    warn "Skipping HTTP check (no APP_URL / HEALTHCHECK_URL, or curl unavailable)"
  fi

  return "$fail"
}

# ===========================================================================
# Deploy
# ===========================================================================
log "Maintenance mode on"
php artisan down --retry=15 || true

log "Fetching origin/$BRANCH"
git fetch --quiet origin "$BRANCH"
git reset --hard "origin/$BRANCH"
NEW_SHA="$(git rev-parse HEAD)"
echo "   ${PREV_SHA:0:12}  →  ${NEW_SHA:0:12}"

log "Composer (production, no-dev)"
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

log "Building front-end assets"
npm ci --no-audit --no-fund
npm run build

log "Running migrations (--force)"
php artisan migrate --force

log "Ensuring storage symlink (idempotent)"
php artisan storage:link || true

log "Rebuilding optimized caches"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

log "Restarting queue workers (graceful; no-op if none running)"
php artisan queue:restart || true

log "Fixing storage & cache permissions"
chmod -R ug+rwX storage bootstrap/cache
find storage bootstrap/cache -type d -exec chmod 2775 {} \; 2>/dev/null || true

log "Maintenance mode off"
php artisan up

log "Running post-deploy health checks"
run_healthchecks
ok "Health checks passed"

# Success — disarm the rollback trap (keep a best-effort `up`).
trap 'php artisan up || true' EXIT
ok "Deploy complete — $(php artisan --version)  (${NEW_SHA:0:12})"
