# routes.md

All routes are in `routes/web.php`. No API routes, no admin, no auth. Every route is **named**.

## Public pages (GET) — `PageController`

| Path | Name | Method |
|---|---|---|
| `/` | `home` | `home` |
| `/about` | `about` | `about` |
| `/manufacturing-services` | `services` | `services` |
| `/capabilities` | `capabilities` | `capabilities` |
| `/industries` | `industries` | `industries` |
| `/why-choose-us` | `why` | `whyChooseUs` |
| `/faqs` | `faqs` | `faqs` |
| `/contact` | `contact` | `contact` |

> SEO-friendly slugs. Route name ≠ path for `services` and `why` — reference by **name**.

## Contact form (POST)

- `POST /contact` → `InquiryController@store`, name **`inquiry.store`**
- Middleware: `throttle:6,1` (6/min) + web-group CSRF + honeypot (in `StoreInquiryRequest`)
- Success: redirect `back()` with session flash `inquiry_sent = true`

## Special endpoints

- `GET /sitemap.xml` → `SitemapController` (`__invoke`), name **`sitemap`** — dynamic XML.
- `GET /robots.txt` — static file at `public/robots.txt` (served by nginx/Laravel public dir).

## Notes

- To add a page: add a named route → a `PageController` method → a `pages/*.blade.php` view →
  register it in `SitemapController::$urls` and (if in nav/footer) the header/footer components.
- No route model binding anywhere; content is static/config-driven.
