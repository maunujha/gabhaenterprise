#!/usr/bin/env bash
#
# Gabha Enterprise — manual production rollback.
# Run on the server as the `deploy` user:
#
#   bash deploy/rollback.sh              # roll back to the commit before HEAD (HEAD~1)
#   bash deploy/rollback.sh <commit-sha> # roll back to a specific commit
#
# Rebuilds dependencies, assets and caches for the target commit. Scoped to
# APP_DIR only — never touches other apps on this shared VPS.
#
# IMPORTANT: this does NOT touch the database. If the target code is
# incompatible with the current DB schema, restore the DB from backup or run the
# appropriate `php artisan migrate:rollback` manually. See DEPLOYMENT.md.
#
set -euo pipefail

APP_DIR="${APP_DIR:-/var/www/gabhaenterprise}"
cd "$APP_DIR"

TARGET="${1:-HEAD~1}"
TARGET_SHA="$(git rev-parse "$TARGET")"
CURRENT_SHA="$(git rev-parse HEAD)"

echo "→ Rolling back: ${CURRENT_SHA:0:12}  →  ${TARGET_SHA:0:12}"

echo "→ Maintenance mode on"
php artisan down --retry=15 || true
trap 'php artisan up || true' EXIT

git reset --hard "$TARGET_SHA"

echo "→ Composer (production, no-dev)"
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "→ Building front-end assets"
npm ci --no-audit --no-fund
npm run build

echo "→ Rebuilding optimized caches"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "→ Restarting queue workers"
php artisan queue:restart || true

echo "→ Fixing storage & cache permissions"
chmod -R ug+rwX storage bootstrap/cache
find storage bootstrap/cache -type d -exec chmod 2775 {} \; 2>/dev/null || true

echo "→ Maintenance mode off"
php artisan up
trap - EXIT

echo "✔ Rolled back to ${TARGET_SHA:0:12} — $(php artisan --version)"
echo "  Reminder: database migrations were NOT reverted (see DEPLOYMENT.md → Rollback)."
