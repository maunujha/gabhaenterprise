# commands.md

Reusable commands. Do not duplicate these elsewhere. Windows/Laragon locally; bash on the VPS.

## Local dev

```bash
composer install
npm install
cp .env.example .env            # then set DB_CONNECTION=sqlite, MAIL_MAILER=log for local
php artisan key:generate
php artisan migrate
npm run build                   # production assets
npm run dev                     # Vite dev server (HMR)
php artisan serve               # http://127.0.0.1:8000
composer run dev                # concurrently: serve + queue:listen + pail + vite
```

## Artisan

```bash
php artisan migrate                     # local
php artisan migrate --force             # production (non-interactive)
php artisan migrate:fresh --seed        # local reset (destructive)
php artisan optimize:clear              # clear config/route/view/event/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan route:list
php artisan tinker
php artisan queue:listen --tries=1      # queue worker (db driver)
php artisan pail                        # tail logs
php artisan down / up                   # maintenance mode
```

## Composer

```bash
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist   # production
composer dump-autoload -o
composer run test                       # config:clear + artisan test
```

## NPM / build

```bash
npm ci --no-audit --no-fund             # production install (deploy)
npm run build                           # Vite build → public/build
npm run dev                             # Vite dev server
```

## Quality / tests

```bash
php artisan test                        # PHPUnit
vendor/bin/pint                         # Laravel Pint (code style)
vendor/bin/pint --dirty                 # format only changed files
```

## Deploy (VPS, as `deploy` user)

```bash
bash deploy/deploy.sh                   # full production deploy (see deployment.md)
```

## Git

```bash
git status
git checkout -b <feature>               # branch off main for non-trivial work
git push origin main                    # source of truth; triggers manual deploy
```

## Useful server / Linux

```bash
sudo nginx -t && sudo systemctl reload nginx
sudo systemctl reload php8.3-fpm
tail -f storage/logs/laravel.log
sudo certbot renew --dry-run
chmod -R ug+rwX storage bootstrap/cache
```
