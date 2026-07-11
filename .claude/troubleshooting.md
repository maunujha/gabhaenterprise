# troubleshooting.md

Only **recurring** issues + confirmed fixes. Add entries as real problems repeat.

## Config/env changes not taking effect (production)

Deploy runs `config:cache`, so `.env` edits are ignored until caches rebuild.
**Fix:** re-run `bash deploy/deploy.sh`, or on the server `php artisan config:cache` (also
`route:cache`, `view:cache` if those changed). `php artisan optimize:clear` reverts to reading `.env`.

## Vite manifest / assets missing ("Unable to locate file in Vite manifest")

Assets not built, or built for the wrong mode.
**Fix:** `npm run build` (prod) — output must exist in `public/build`. In local dev use `npm run dev`
(Vite server) *or* `npm run build`. Never commit `public/build` (git-ignored).

## storage / bootstrap permission errors (500, cannot write logs/cache)

**Fix (server):** `chmod -R ug+rwX storage bootstrap/cache` and dirs to `2775` (the deploy script
does this). Ensure the `deploy` user and the php-fpm user share group write access.

## Inquiry email not arriving

Lead is still saved (check `inquiries` table / `storage/logs/laravel.log` for a reported mail
exception). Verify `MAIL_PASSWORD` is set on the server and `INQUIRY_MAIL_TO` is correct. Locally,
`MAIL_MAILER=log` writes mail to logs instead of sending.

## Contact form rejects a legit submission

Honeypot (`website` field must be present + empty) or `throttle:6,1` (6/min). Also check phone
regex `^[0-9+\-\s()]{7,20}$` and message `min:10`. See `StoreInquiryRequest`.

## www vs apex / redirect loops

Canonical host is the **apex**; nginx 301s `www` → apex and HTTP → HTTPS. If a loop appears, check
`APP_URL=https://gabhaenterprise.com` and that TLS certs cover both apex and www.

## Local dev DB

Use SQLite locally: `DB_CONNECTION=sqlite` + create `database/database.sqlite`, then `php artisan
migrate`. Production uses MySQL.
