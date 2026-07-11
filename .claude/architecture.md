# architecture.md

Static marketing site: thin controllers return Blade views; page content is authored in Blade,
company data comes from `config/company.php`. No services layer, no repositories — deliberately simple.

## Request flow

```
routes/web.php → PageController@<page> → view('pages.<page>')
                 InquiryController@store ← StoreInquiryRequest → Inquiry::create + Mail
                 SitemapController (__invoke) → view('sitemap')
```

## Controllers (`app/Http/Controllers/`)

- **PageController** — one thin method per page, each returns `view('pages.*')`. No logic.
- **InquiryController@store** — persists the `Inquiry` first, then *tries* to email
  `InquiryReceived`; mail failures are caught + `report()`ed so a lead is never lost. Redirects
  `back()->with('inquiry_sent', true)`.
- **SitemapController (__invoke)** — hardcoded ordered URL list (route name + priority + freq) →
  renders `sitemap` view as `application/xml`.

## Requests / validation

- **StoreInquiryRequest** — rules for name/company/email/phone/message + a **honeypot** field
  `website` (`present`, `max:0`). `inquiryData()` returns only persisted fields + `ip_address`
  (honeypot dropped). Generic error messages for honeypot to avoid tipping off bots.

## Models

- **Inquiry** — the only real model (table `inquiries`). Fillable: name, company, email, phone,
  message, ip_address.
- **User** — leftover Laravel skeleton model; **unused** (no auth on this site).

## Mail

- **InquiryReceived** (`app/Mail/`) — mailable rendered from `resources/views/emails/inquiry-received.blade.php`,
  sent to `config('company.inquiry_recipient')`.

## Views (`resources/views/`)

- **`pages/`** — one Blade file per page (`home`, `about`, `services`, `capabilities`,
  `industries`, `why-choose-us`, `faqs`, `contact`). Each opens with a `@php` block reading
  `config('company')` and wraps content in `<x-layouts.app title=… description=…>`.
- **`components/layouts/app.blade.php`** — the master HTML layout: `<head>` (SEO meta, OG/Twitter,
  favicons, font preload, GTM/GA4, `@vite`, `<x-site.schema />`), skip-link, header, `{{ $slot }}`,
  footer, WhatsApp FAB. Accepts props: `title`, `description`, `canonical`, `ogImage`, `ogType`,
  `noindex`, and a `$head` slot for per-page extra `<head>` markup (e.g. page-specific JSON-LD).
- **`components/site/`** — site chrome: `header`, `footer`, `logo`, `schema` (site-wide JSON-LD),
  `whatsapp-fab`.
- **`components/ui/`** — reusable primitives: `button`, `cta-band`, `icon`, `page-header`,
  `section-title`.
- **`emails/inquiry-received.blade.php`** — inquiry notification email body.
- **`sitemap.blade.php`** — XML sitemap template.

## Config-driven data

`config/company.php` holds structured arrays consumed across the site:
`services` (9, each slug/icon/title/summary), `industries` (6), `stats` (4 headline figures),
contact details, address, geo, hours, analytics IDs. Add/edit business content here, not in views.

## Front-end

- `resources/css/app.css` — Tailwind v4 theme (custom color tokens like `ink`, `on-ink`) + styles.
- `resources/js/app.js` — minimal JS; a `no-js`→`js` html-class swap runs inline in `<head>`.
- Built by Vite (`@vite([...])`); output in `public/build/` (ignored, versioned assets).
