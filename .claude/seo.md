# seo.md

SEO is centralized in the layout head + a site-wide schema component; per-page overrides via props.
Canonical host is the **apex** `https://gabhaenterprise.com` (www 301s to apex at nginx).

## Meta handling — `components/layouts/app.blade.php`

Props: `title`, `description`, `canonical`, `ogImage`, `ogType` (default `website`), `noindex`.

- **Title:** `"{title} — Gabha Enterprise"`, or `"Gabha Enterprise — {tagline}"` on home (no title prop).
- **Description:** page `description` prop, else `config('company.description')`.
- **Canonical:** `canonical` prop, else `url()->current()`.
- **Robots:** `index, follow, max-image-preview:large`, or `noindex, nofollow` when `noindex=true`.
- **Open Graph + Twitter:** full tags; OG image defaults to `/og-image.png` (1200×630),
  `og:locale = en_IN`, Twitter `summary_large_image`.
- **Favicons:** `/favicon.svg`, `/favicon-32.png`, `/apple-touch-icon.png`; `theme-color #ffffff`.
- Each page sets `title` + `description` via the `<x-layouts.app>` props.

## Structured data (JSON-LD)

- **Site-wide** — `components/site/schema.blade.php` (included in every page via the layout):
  a single `@graph` with **Organization** (`#organization`) + **LocalBusiness** (`#localbusiness`,
  references org as parent, has geo/address/opening hours/priceRange) + **WebSite** (`#website`).
  All values come from `config/company.php`. Output with `JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE`.
- **BreadcrumbList** — on inner pages, injected via the layout `$head` slot.
- **FAQPage** — on `/faqs` (`pages/faqs.blade.php`, `@type => 'FAQPage'`), via the `$head` slot.

## Sitemap & robots

- **`/sitemap.xml`** — dynamic, `SitemapController` → `sitemap.blade.php`. Ordered URL list with
  per-route `priority` + `changefreq`; `lastmod = now()->toAtomString()`. Add new pages here.
- **`robots.txt`** — static at `public/robots.txt`.

## Analytics & Search Console (opt-in via env)

- Set **`GTM_ID`** *or* **`GA4_ID`** (never both — avoids double counting). GTM preferred (put GA4
  inside GTM). Rendered inline in the layout head + GTM `<noscript>` in body.
- **`GOOGLE_SITE_VERIFICATION`** → `<meta name="google-site-verification">` for Search Console.
- These read from `config('company.gtm_id' / 'ga4_id' / 'google_site_verification')`.
- See `integrations.md` for account/setup details.

## Conventions

- Never hardcode URLs — use `route()`. Keep OG image at `public/og-image.png` (1200×630).
- Performance for SEO: critical fonts preloaded (`hanken-grotesk-var`, `poppins-600`),
  long-cache on `/build` & `/fonts`, gzip — all at nginx (see `deployment.md`).
