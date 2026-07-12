# CLAUDE.md — Gabha Enterprise

Permanent instruction manual for this repository. Read this first, every session.

> **Gabha Enterprise** — Laravel 12 corporate B2B marketing site for a private-label /
> OEM apparel manufacturer in Dholpur, India (parent of the fashion brand *Urbanflaky*).
> Lightweight lead-gen site: no e-commerce, no auth, no admin. Single goal = contact inquiry.

---

## ⚠️ Shared-VPS safety — non-negotiable, read first

This VPS hosts **multiple independent production apps**. Gabha Enterprise (this repo) and
**Urbanflaky** are **separate** applications — shared server, fully isolated (own dir, DB, nginx
vhost, TLS). **Never assume this repo is the only app on the server.**

**While working on Gabha Enterprise, never touch Urbanflaky** — do not modify, deploy, edit its
files/env/config, clear its caches, restart its services, or generate any command that could affect
it. Every git, build, cache, deploy, and maintenance command must operate **only within the Gabha
Enterprise project directory** (`/var/www/gabhaenterprise`). Prefer project-scoped commands over
server-wide ones; avoid restarting shared services unless I explicitly ask.

**Stop and ask for my confirmation before any server-level / global change** — nginx, PHP-FPM,
Supervisor, SSL, firewall, cron, Docker, system packages, or any global config. First explain the
impact and whether it could affect Urbanflaky; only then suggest or generate commands.

See `deployment.md` and `decisions.md` for details.

---

## 1. Memory-first workflow (token optimization is a top priority)

The `.claude/` folder is this project's long-term memory. **Read memory before reading source.**

For every request:

1. Read only the **relevant** memory file(s) in `.claude/` (see index below).
2. From memory, determine the **exact** source files needed.
3. Read only those files.
4. Implement the change, reusing existing patterns.
5. If long-term knowledge changed, update the matching memory file (see §5).

**Never** recursively scan the repo, and never read ignored paths (see `.claudeignore`) unless
explicitly asked. Assume repo-wide search is expensive — escalate:
known path → known folder → filename → scoped search → repo-wide search (last resort).

### Memory index (`.claude/`)

| File | Read it when the task touches… |
|---|---|
| `project.md` | overview, tech stack, workflow, conventions (start here if unsure) |
| `architecture.md` | app structure, Blade components, layouts, config-driven data |
| `routes.md` | routes, controllers, endpoints, the contact form |
| `deployment.md` | VPS deploy, git flow, caching, nginx, permissions |
| `commands.md` | any composer / artisan / npm / git / server command |
| `coding-style.md` | naming, patterns, how to add a page/component/service |
| `seo.md` | meta, canonical, JSON-LD, sitemap, robots, GTM/GA4 |
| `content.md` | blog/content hub, pillar & cluster posts, draft/publish workflow |
| `integrations.md` | mail/SMTP, analytics, Search Console, external services |
| `troubleshooting.md` | recurring build/deploy/cache/permission problems |
| `decisions.md` | *why* something is built the way it is |

---

## 2. Project workflow

Local development → GitHub (`maunujha/gabhaenterprise`, branch `main` = source of truth)
→ manual deploy to VPS (`/var/www/gabhaenterprise`) via `bash deploy/deploy.sh`.

- Commit/push only when asked. Branch off `main` for non-trivial work.
- Production is deployed manually from GitHub `main`. Never edit files on the server.

## 3. Coding rules

- **Reuse first.** Prefer modifying existing code over rewriting. Match surrounding style.
- Follow Laravel 12 conventions. Keep solutions simple and production-ready.
- **`config/company.php` is the single source of truth** for all company data (name, contact,
  address, services, industries, stats, analytics IDs). Never hardcode these in views/schema/mail.
- Blade only — **no** Vue / React / Livewire / Alpine unless explicitly requested.
- Tailwind CSS v4 (config-in-CSS via `resources/css/app.css`). No inline `<style>` blocks.
- Self-hosted fonts only — never add third-party network requests (fonts, CDNs, trackers)
  beyond the opt-in GTM/GA4.
- Every route is **named**; views/sitemap/breadcrumbs use `route()`, never hardcoded URLs.
- Avoid new dependencies unless clearly justified.

## 4. Response style

Concise. Don't explain obvious code. Don't dump whole files unless asked. Prefer summaries and
actionable recommendations. Flag risks when relevant.

## 5. Memory update policy

After a task that changes long-term knowledge, update the matching `.claude/` file immediately.

**Do update** for: new architecture, routes, integrations, folder restructuring, SEO changes,
new conventions, reusable utilities, server/CI config, performance or security work, or a notable
technical decision (→ `decisions.md`).

**Never** create memory for: typo/CSS/minor-UI fixes, temporary debugging, one-off experiments,
small bug fixes, or content edits.

**Quality:** keep each file ~100–300 lines. Be concise, summarize, don't copy source code, don't
duplicate across files, and remove obsolete info when updating. Memory is an evolving knowledge base.

## 6. Ignore policy

Respect `.claudeignore`. Do not auto-read `vendor/`, `node_modules/`, `storage/`,
`bootstrap/cache/`, `public/build/`, lockfiles, logs, or binary/media assets unless asked.
