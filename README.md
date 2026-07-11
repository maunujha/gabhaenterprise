# Gabha Enterprise

Corporate B2B website for **Gabha Enterprise** — a private-label and OEM apparel
manufacturer in Dholpur, India, and the parent company of the fashion brand
[Urbanflaky](https://urbanflaky.in).

The site is a lightweight marketing/lead-generation site: no e-commerce, no auth,
no admin. Its single conversion goal is a contact inquiry.

## Stack

- **Laravel 12** · PHP 8.3
- **Blade** components (no Vue / React / Livewire)
- **Tailwind CSS v4** + **Vite 7**
- **MySQL** (inquiries) — SQLite for local dev
- Self-hosted fonts (Newsreader + Hanken Grotesk) — no third-party requests

## Pages

Home · About · Manufacturing Services · Capabilities · Industries ·
Why Choose Us · FAQs · Contact

## Contact form

`POST /contact` → `StoreInquiryRequest` (validation + honeypot) →
`InquiryController` stores an `inquiries` row and emails
`InquiryReceived` to `config('company.inquiry_recipient')`.

Protected by CSRF, a hidden honeypot field, and a `throttle:6,1` rate limit.

## SEO

- Per-page title / description / canonical, Open Graph + Twitter cards
- JSON-LD: Organization + LocalBusiness + WebSite (site-wide),
  BreadcrumbList (inner pages), FAQPage (FAQs)
- `robots.txt`, dynamic `/sitemap.xml`, favicon + OG image

## Local development

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# For local dev, set DB_CONNECTION=sqlite and MAIL_MAILER=log in .env
php artisan migrate
npm run build        # or: npm run dev
php artisan serve
```

## Configuration

All company details (name, contact, address, services, industries) live in
[`config/company.php`](config/company.php) — the single source of truth for
views, structured data and mailables.

Environment (`.env`, never committed):

| Key | Purpose |
|---|---|
| `DB_*` | MySQL connection (dedicated `gabhaenterprise` DB + user) |
| `MAIL_*` | Hostinger SMTP (`support@urbanflaky.in`) |
| `INQUIRY_MAIL_TO` | Where inquiry notifications are sent |

## Deployment

Server: `/var/www/gabhaenterprise`, served by its own nginx vhost
([`deploy/nginx/gabhaenterprise.conf`](deploy/nginx/gabhaenterprise.conf))
over the shared PHP 8.3-FPM socket. Fully isolated from urbanflaky.in.

```bash
bash deploy/deploy.sh
```

The script: maintenance on → `git reset --hard origin/main` →
`composer install --no-dev` → `npm ci && npm run build` →
`migrate --force` → cache config/routes/views → fix permissions →
maintenance off.
