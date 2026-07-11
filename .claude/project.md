# project.md

## Overview

Gabha Enterprise — corporate B2B marketing / lead-generation website for a private-label and
OEM apparel manufacturer in Dholpur, Rajasthan, India. Parent company of the fashion brand
**Urbanflaky** (urbanflaky.in). No e-commerce, no auth, no admin, no database-driven content.
Single conversion goal: a contact inquiry (form + WhatsApp).

## Tech stack

- **Laravel 12** · PHP **8.3** (composer requires `^8.2`)
- **Blade** components only — no Vue / React / Livewire / Alpine
- **Tailwind CSS v4** + **Vite 7** (`@tailwindcss/vite` plugin; theme lives in CSS, not a JS config)
- **MySQL** in production (inquiries + session/cache/queue tables); **SQLite** for local dev
- Self-hosted fonts (Hanken Grotesk + Poppins/Newsreader) — no third-party network requests
- Local dev on Windows via **Laragon** (nginx + PHP 8.3.30); production on a Linux **VPS**

## Repository & workflow

- GitHub: `https://github.com/maunujha/gabhaenterprise` — branch **`main`** is source of truth.
- Local dev → push to GitHub `main` → **manual** deploy to VPS (`bash deploy/deploy.sh`).
- Never edit files directly on the server; always deploy from `main`.

## Shared VPS (isolation is critical)

The production VPS hosts **multiple independent apps**. This repo is Gabha Enterprise
(`/var/www/gabhaenterprise`); **Urbanflaky** (urbanflaky.in) is a **separate** production app on the
same server. They share only the host + PHP 8.3-FPM socket — separate dir, DB, nginx vhost, TLS.
**Never modify, deploy, or otherwise affect Urbanflaky while working here.** See `CLAUDE.md`
(⚠️ Shared-VPS safety) and `deployment.md`.

## Folder overview

```
app/Http/Controllers/   PageController, InquiryController, SitemapController
app/Http/Requests/      StoreInquiryRequest (validation + honeypot)
app/Mail/               InquiryReceived (mailable)
app/Models/             Inquiry, User (User unused — default skeleton)
config/company.php      SINGLE SOURCE OF TRUTH for all company data
routes/web.php          all public routes (named)
resources/views/pages/  one Blade file per page (8 pages)
resources/views/components/  layouts/, site/, ui/  (see architecture.md)
resources/css/app.css   Tailwind v4 theme + styles
database/migrations/    users, cache, jobs, inquiries
deploy/                 deploy.sh + nginx/gabhaenterprise.conf
public/                 favicon, og-image, robots.txt, fonts/, images/, build/
```

## Pages

Home · About · Manufacturing Services · Capabilities · Industries · Why Choose Us · FAQs · Contact

## Key conventions

- **`config/company.php` is the single source of truth** — name, contact, address, services,
  industries, stats, analytics IDs. Views, SEO meta, JSON-LD and mailables all read from it.
  Never repeat a phone number, address or service name in two places.
- Every route is **named**; never hardcode a URL — use `route()`.
- Timezone `Asia/Kolkata`; locales `en` / `en_IN`.
- Most-used commands live in `commands.md`; deploy details in `deployment.md`.
