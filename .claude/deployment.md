# deployment.md

## ⚠️ Shared VPS — scope every command to Gabha Enterprise

The VPS hosts multiple independent production apps; **Urbanflaky is a separate app on the same
server**. All deploy/git/build/cache/maintenance commands must run **only inside
`/var/www/gabhaenterprise`**. Never modify, deploy, cache-clear, or restart anything for Urbanflaky,
and never generate a command that could affect it. Prefer project-local artisan/composer/npm commands
over server-wide ones; **do not restart shared services** (nginx, php8.3-fpm) unless explicitly asked.

**Server-level / global changes require confirmation first.** Before touching nginx, PHP-FPM,
Supervisor, SSL, firewall, cron, Docker, or system packages, stop and ask — explain the impact and
whether it could affect Urbanflaky *before* suggesting commands. (The shared PHP 8.3-FPM socket means
restarting/reloading php8.3-fpm affects **both** apps.)

## Environments

- **Local (Windows / Laragon):** nginx + PHP 8.3.30. Dev DB usually SQLite; mail = `log`.
- **Production (VPS, Linux):** app at `/var/www/gabhaenterprise`, run as the `deploy` user.
  Own nginx vhost over the **shared** PHP 8.3-FPM socket (`/run/php/php8.3-fpm.sock`).
  Fully isolated from urbanflaky.in (separate DB, vhost, TLS cert) — see safety note above.

## Git workflow

GitHub `main` is source of truth. The deploy does `git reset --hard origin/main` — so the server
tree is **disposable**; never edit or commit on the server. Push to `main`, then deploy.

## Deploy (one command)

```bash
bash deploy/deploy.sh          # run on server as `deploy`; APP_DIR/BRANCH overridable via env
```

`deploy/deploy.sh` runs, in order (`set -euo pipefail`, auto `artisan up` on exit via trap):

1. `php artisan down --retry=15` (maintenance on)
2. `git fetch origin main` → `git reset --hard origin/main`
3. `composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist`
4. `npm ci --no-audit --no-fund` → `npm run build`
5. `php artisan migrate --force`
6. `php artisan optimize:clear` → `config:cache` → `route:cache` → `view:cache`
7. Fix perms: `chmod -R ug+rwX storage bootstrap/cache`; dirs → `2775`
8. `php artisan up` (maintenance off)

## nginx

`deploy/nginx/gabhaenterprise.conf` (install to `/etc/nginx/sites-available/`, symlink into
`sites-enabled/`). Behavior:

- HTTP :80 → 301 HTTPS (allows ACME `/.well-known/acme-challenge/`).
- `www` → 301 apex. **Canonical host = apex** `https://gabhaenterprise.com`.
- Root `/var/www/gabhaenterprise/public`; `try_files … /index.php?$query_string`.
- Security headers on all responses: HSTS (preload), X-Frame-Options SAMEORIGIN,
  X-Content-Type-Options nosniff, Referrer-Policy, Permissions-Policy, COOP.
- Long-cache `/build/` & `/fonts/` (1y); other static assets 30d. gzip on. `client_max_body_size 12m`.
- PHP via `unix:/run/php/php8.3-fpm.sock`; hides `X-Powered-By`. Denies dotfiles except `.well-known`.

## TLS

Let's Encrypt via certbot; cert at `/etc/letsencrypt/live/gabhaenterprise.com/`. Issued separately
from deploys (see `deploy/README`).

## Environment setup (server `.env`)

- `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://gabhaenterprise.com`
- `DB_*` → dedicated MySQL `gabhaenterprise` DB + `gabhaenterprise_user`
- `MAIL_*` → Hostinger SMTP (see `integrations.md`); `MAIL_PASSWORD` set only on server
- `INQUIRY_MAIL_TO`, and optionally `GTM_ID` **or** `GA4_ID`, `GOOGLE_SITE_VERIFICATION`
- `.env` is never committed.

## Production notes

- After deploy, `config:cache` is active → **`.env` changes require re-running the deploy** (or
  at least `php artisan config:cache`) to take effect.
- Sessions/cache/queue use the **database** driver (see `.env.example`); the `jobs`/`cache`/
  `sessions` tables ship via migrations.
