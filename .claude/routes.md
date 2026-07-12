# routes.md

All routes are in `routes/web.php`. No API routes, no admin, no auth. Every route is **named**.

## Public pages (GET) — `PageController`

| Path | Name | Method |
|---|---|---|
| `/` | `home` | `home` |
| `/about` | `about` | `about` |
| `/manufacturing-services` | `services` | `services` |
| `/manufacturing-services/{service}` | `services.show` | `service` |
| `/capabilities` | `capabilities` | `capabilities` |
| `/industries` | `industries` | `industries` |
| `/why-choose-us` | `why` | `whyChooseUs` |
| `/faqs` | `faqs` | `faqs` |
| `/contact` | `contact` | `contact` |
| `/blog` | `blog.index` | `BlogController@index` |
| `/blog/{post}` | `blog.show` | `BlogController@show` |

> SEO-friendly slugs. Route name ≠ path for `services` and `why` — reference by **name**.

### Dedicated service pages (hub-and-spoke)

`services.show` is a single param route → `PageController@service($service)` → one template
`pages/service.blade.php`. The `{service}` param is the descriptive URL slug (e.g.
`private-label-manufacturing`); the controller resolves it to a content key by matching the `path`
field in `config/service_pages.php`, and `abort(404)` on no match. 9 spokes, one per service in
`config('company.services')`. The hub (`/manufacturing-services`) links to each via "Explore …";
the footer links three directly. Long-form (1500+ words): intro, process, benefits, FAQs, related
links, CTA. Per-page **Service** + **FAQPage** JSON-LD (breadcrumb comes from `page-header`).
`link()` service URLs with `route('services.show', config('service_pages.<slug>.path'))`.

## Contact form (POST)

- `POST /contact` → `InquiryController@store`, name **`inquiry.store`**
- Middleware: `throttle:6,1` (6/min) + web-group CSRF + honeypot (in `StoreInquiryRequest`)
- Success: redirect `back()` with session flash `inquiry_sent = true`

## Blog / content hub

`BlogController` (`index` + `show`) serves a config-driven blog from `config/blog.php` — no DB.
Draft posts render but are `noindex` and kept out of the sitemap. See `content.md`.

## Special endpoints

- `GET /sitemap.xml` → `SitemapController` (`__invoke`), name **`sitemap`** — dynamic XML.
- `GET /robots.txt` — static file at `public/robots.txt` (served by nginx/Laravel public dir).

## Notes

- To add a page: add a named route → a `PageController` method → a `pages/*.blade.php` view →
  register it in `SitemapController::$urls` and (if in nav/footer) the header/footer components.
- No route model binding anywhere; content is static/config-driven.
