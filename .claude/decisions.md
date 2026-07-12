# decisions.md

Notable technical decisions and *why*. Append new ones with date + rationale; don't restate obvious
framework defaults.

## Blade-only, no SPA framework

Static marketing site with a single form. Blade components keep it fast, SEO-friendly, and simple.
No Vue/React/Livewire/Alpine → smaller surface, no hydration/JS SEO concerns.
*Implication:* interactivity stays minimal + vanilla; revisit only if a genuinely dynamic feature appears.

## `config/company.php` as single source of truth

All company data (contact, address, services, industries, stats, analytics IDs) lives in one config
file, consumed by views, JSON-LD schema, and mailables. Avoids duplicated/inconsistent phone numbers,
addresses, and service names across the site.
*Implication:* edit business content there, not in views. Content changes need no code changes elsewhere.

## Persist inquiry first, email best-effort

`InquiryController` saves the `Inquiry` row, then sends the notification email inside a `try/catch`
with `report()`. A mail/SMTP failure must never lose a lead or 500 the visitor.
*Alternative rejected:* queueing the whole request — overkill; the DB row is the durable record.

## Honeypot + throttle instead of CAPTCHA

Contact form uses a hidden `website` honeypot field + `throttle:6,1` + CSRF. No reCAPTCHA/JS
challenge → zero third-party requests, no UX friction, adequate for this traffic level.
*Implication:* if spam volume grows, add a challenge before removing the honeypot.

## Self-hosted fonts, no third-party requests

Fonts are self-hosted WOFF2 (preloaded). No Google Fonts/CDN → privacy, performance, and no external
dependency. Analytics (GTM/GA4) is the only opt-in external script, env-gated.

## GTM *or* GA4, never both

Env chooses one path (`GTM_ID` preferred, nest GA4 inside GTM; else `GA4_ID` direct) to prevent
double-counting.

## Sitemap URLs kept in code, not DB

The site is a fixed set of marketing routes, so `SitemapController` holds an ordered array of route
names + priorities. Simpler than a DB-backed sitemap; add new pages to that array.

## Apex as canonical host; isolated VPS vhost

`www` and HTTP 301 to `https://gabhaenterprise.com`. The app has its own nginx vhost, DB, and TLS
cert, sharing only the PHP 8.3-FPM socket with urbanflaky.in → full isolation, independent deploys.

## Strict isolation from Urbanflaky on the shared VPS

The VPS runs multiple independent production apps; **Urbanflaky is a separate app** sharing only the
host + PHP 8.3-FPM socket. Permanent rule: while working on Gabha Enterprise, never modify/deploy/
cache-clear/restart Urbanflaky or emit commands that could affect it — everything is scoped to
`/var/www/gabhaenterprise`. Server-level/global changes (nginx, PHP-FPM, Supervisor, SSL, firewall,
cron, Docker, system packages) require explicit confirmation first, with impact on Urbanflaky stated.
*Why:* a shared server means a careless global command or wrong directory can take down an unrelated
production site. *Implication:* prefer project-local commands; avoid restarting shared services.

## Deploy via `git reset --hard origin/main` (in-place, no release dirs)

Deploy resets the server tree hard to `origin/main` (server tree is disposable). Guarantees the
server matches GitHub exactly; prevents drift from ad-hoc server edits.
*Implication:* never edit/commit on the server — all changes go through GitHub `main`.

## Automatic deploy via GitHub Actions on merge to `main`

`.github/workflows/deploy.yml` deploys on push to `main` (PR from `development` merged): a `quality`
gate (composer validate, `php -l`, config validation, tests, Pint advisory) then an SSH `deploy` job
that runs `deploy/deploy.sh`. *Why:* removes manual/error-prone deploys, enforces review + green
checks before shipping. *Alternatives rejected:* webhook-pull daemon (more moving parts);
release-directory/symlink atomic deploy (larger server-layout change than a small marketing site
warrants). *Pint is advisory* (`continue-on-error`) because the existing code isn't Pint-clean —
blocking would stop every deploy over cosmetics.

## Rollback = code-only revert to previous SHA; migrations never auto-reverted

In-place git deploy means no `releases/` to symlink-swap. Safety instead: `deploy.sh` records the
pre-deploy SHA and, on any failure (incl. health checks), resets code back + rebuilds + leaves
maintenance off — never a half-updated tree. `deploy/rollback.sh` does the same manually to any
commit. *Migrations are deliberately NOT auto-rolled-back* — a `down()` can drop data; restore DB
from backup or run `migrate:rollback` by hand. *Why:* an automated destructive migration revert is
more dangerous than a brief manual step.
