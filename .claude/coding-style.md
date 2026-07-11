# coding-style.md

Match existing code. Reuse before rewriting. Keep it simple and production-ready.

## PHP / Laravel

- Follow **Laravel Pint** defaults (PSR-12). Run `vendor/bin/pint --dirty` before committing.
- Controllers are **thin** — no business logic in page controllers.
- Typed signatures & return types everywhere (`: View`, `: RedirectResponse`, typed properties).
- Validation lives in **FormRequest** classes, not controllers.
- Read all business/company data from **`config/company.php`** — never hardcode contact info,
  service names, addresses, or analytics IDs in views/schema/mail.
- Reference routes by **name** via `route('name')`; never hardcode URLs.
- Fail safe on side effects: e.g. inquiry is persisted first, email is best-effort in a
  `try/catch` with `report()`. Never let a non-critical failure lose data or 500 the visitor.

## Blade / views

- Pages: `resources/views/pages/<name>.blade.php`, wrapped in `<x-layouts.app title=… description=…>`.
- Reuse UI primitives in `components/ui/` (`button`, `section-title`, `page-header`, `cta-band`,
  `icon`) and site chrome in `components/site/`. Create a new component only when a pattern repeats.
- Component naming: kebab-case files → `<x-ui.button>`, `<x-site.header>`, `<x-layouts.app>`.
- Per-page extra `<head>` markup (e.g. page-specific JSON-LD) goes in the layout's `$head` slot.
- Keep a top-of-file `@php` block for view-local data derived from `config('company')`.

## CSS / Tailwind

- **Tailwind v4** — theme/tokens defined in `resources/css/app.css` (`@theme`), not a JS config.
- Use utility classes + existing custom tokens (e.g. `ink`, `on-ink`). No inline `<style>`.
- Accessibility: keep the skip-link, focus-visible states, `sr-only` patterns already in use.

## JS

- Keep it minimal and vanilla — **no** Vue / React / Livewire / Alpine unless explicitly asked.
- No third-party network requests (fonts self-hosted); analytics only via opt-in GTM/GA4.

## Files & structure

- One page = one route (named) + one `PageController` method + one `pages/*.blade.php`.
- New DB fields → a migration + update the `Inquiry` model's `$fillable` (mind honeypot filtering).
- New business content (a service, industry, stat) → edit the arrays in `config/company.php`.
