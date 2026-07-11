#!/usr/bin/env bash
#
# Gabha Enterprise — production deploy.
# Run on the server as the `deploy` user:  bash deploy/deploy.sh
# (or install as /usr/local/bin/gabha-deploy).
#
set -euo pipefail

APP_DIR="${APP_DIR:-/var/www/gabhaenterprise}"
BRANCH="${BRANCH:-main}"

cd "$APP_DIR"

echo "→ Maintenance mode on"
php artisan down --retry=15 || true
trap 'php artisan up || true' EXIT

echo "→ Fetching $BRANCH"
git fetch --quiet origin "$BRANCH"
git reset --hard "origin/$BRANCH"

echo "→ Composer (production)"
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "→ Building front-end assets"
npm ci --no-audit --no-fund
npm run build

echo "→ Migrations"
php artisan migrate --force

echo "→ Caching config, routes, views, events"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "→ Storage permissions"
chmod -R ug+rwX storage bootstrap/cache
find storage bootstrap/cache -type d -exec chmod 2775 {} \; 2>/dev/null || true

echo "→ Maintenance mode off"
php artisan up
trap - EXIT

echo "✔ Deploy complete — $(php artisan --version)"
