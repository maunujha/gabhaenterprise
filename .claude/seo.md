# seo.md

SEO is centralized in the layout head + a site-wide schema component; per-page overrides via props.
Canonical host is the **apex** `https://gabhaenterprise.com` (www 301s to apex at nginx).

## Meta handling — `components/layouts/app.blade.php`

Props: `title`, `description`, `canonical`, `ogImage`, `ogImageAlt`, `ogType` (default `website`), `noindex`.

- **`<html lang="en-IN">`** — matches `og:locale=en_IN` and schema `inLanguage=en-IN` (India-focused B2B).
- **Title:** `"{title} — Gabha Enterprise"`, or `"Gabha Enterprise — {tagline}"` on home (no title prop).
- **Description:** page `description` prop, else `config('company.description')`.
- **Canonical:** `canonical` prop, else `url()->current()` (self-canonical, query-string stripped).
- **Robots:** `index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1`,
  or `noindex, nofollow` when `noindex=true`.
- **Open Graph + Twitter:** full tags; OG image defaults to `/og-image.png` (1200×630) with
  `og:image:alt` + `twitter:image:alt` (`ogImageAlt` prop, defaults to `"{name} — {tagline}"`),
  `og:locale = en_IN`, Twitter `summary_large_image`.
- **Favicons:** `/favicon.svg`, `/favicon-32.png`, `/apple-touch-icon.png`; `theme-color #ffffff`.
- Each page sets `title` + `description` via the `<x-layouts.app>` props.

## Structured data (JSON-LD)

- **Site-wide** — `components/site/schema.blade.php` (included in every page via the layout):
  a single `@graph` with **Organization** (`#organization`) + **LocalBusiness** (`#localbusiness`,
  references org as parent) + **WebSite** (`#website`). All values from `config/company.php`.
  Output with `JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE`. Details:
  - Organization has `contactPoint` (**ContactPoint**, type `sales`), `slogan`, `brand`, `sameAs`
    (from `config.links` — add real social profiles there and they flow in automatically), and
    `hasOfferCatalog` → **OfferCatalog** of the 9 `config.services` as `Offer`→**Service** items.
  - `image` is an **ImageObject** (og-image.png, 1200×630); `logo` is `/favicon.svg`. Both shared
    by Organization + LocalBusiness (defined once as `$ogImage`/`$logo`).
  - LocalBusiness adds geo, `openingHoursSpecification` (Mo–Sa 10:00–19:00), `priceRange ₹₹`,
    `currenciesAccepted INR`, `areaServed` Country India.
- **BreadcrumbList** — on inner pages, injected via the layout `$head` slot.
- **FAQPage** — on `/faqs` (`pages/faqs.blade.php`, `@type => 'FAQPage'`), via the `$head` slot.
- **Service + FAQPage** — on each dedicated service page (`pages/service.blade.php`): a `Service`
  node (`provider` → `#organization`) plus a `FAQPage` of that service's FAQs. Rendered as two
  `ld+json` scripts at the end of the page body (breadcrumb comes from `page-header`).

## Sitemap & robots

- **`/sitemap.xml`** — dynamic, `SitemapController` → `sitemap.blade.php`. Ordered URL list with
  per-route `priority` + `changefreq`; `lastmod = now()->toAtomString()`. Add new pages here.
  The 9 dedicated service pages are appended automatically by iterating `config('service_pages')`.
  **Published** blog posts (+ the `/blog` index) are appended from `config('blog.posts')`; drafts
  are excluded. Blog posts emit `Article`/`BlogPosting` JSON-LD when published. See `content.md`.
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
