# content.md

Blog / content hub — a **lightweight, config-driven** system (no DB, no CMS), mirroring the
service-pages pattern. Full strategy in `docs/seo-content-strategy.md`.

## Structure

- **`config/blog.php`** — single source of truth. `clusters` (group labels) + `posts` keyed by slug.
  Each post: `type` (pillar|cluster), `cluster`, `pillar` (parent slug, clusters only), `status`
  (draft|published), `seo_title`, `h1`, `meta_description`, `primary_keyword`, `secondary_keywords`,
  `excerpt`, `read_time`, `date`, `intro[]`, `outline[]` ({heading, points[]}), `related_services[]`
  (blog→service links), `related_posts[]` (blog→blog links).
- **`BlogController`** — `index()` (lists posts grouped by cluster; page noindex until ≥1 published)
  + `show($post)` (404 if unknown; resolves related services/posts + parent pillar).
- **Routes** — `blog.index` (`/blog`), `blog.show` (`/blog/{post}`).
- **Views** — `pages/blog/index.blade.php`, `pages/blog/show.blade.php` (reuse `page-header`,
  `section-title`, `cta-band`, tokens). Show renders intro + outline (as a "What this guide covers"
  scaffold) + internal links + CTA.

## Topic clusters (2 pillars, 6 clusters)

Pillars: `how-to-start-a-clothing-brand`, `garment-manufacturing-process`. Clusters:
`private-label-vs-oem-manufacturing`, `clothing-manufacturing-moq-guide`, `clothing-fabric-guide`,
`garment-printing-guide`, `garment-embroidery-guide`, `apparel-packaging-guide`.

## Article bodies

Full article bodies live in **`resources/views/pages/blog/content/{slug}.blade.php`** (semantic
HTML — `<h2>`/`<h3>`/`<p>`/`<ul>`/`<table>` + inline `route()` links to services & sibling guides).
`show.blade.php` renders the body partial via `@include` when `view()->exists(...)`, else falls back
to the config `outline` scaffold. Prose is styled by the **`.article`** component in
`resources/css/app.css` (tokenized, no per-element utility classes).

## Draft/publish rules (SEO-safe)

- **All 8 are `published`** with full ~1,100–1,300-word bodies: indexable, listed on `/blog`, in
  `sitemap.xml`, and surfaced in service pages' "Related guides" (reverse lookup in
  `PageController@service`). `/blog` is linked from the **footer** ("Guides").
- Any future post added as **`draft`** renders with `noindex`, stays out of the sitemap and out of
  service-page "Related guides", and shows the outline scaffold until a body partial exists.
- To add a post: add an entry to `config/blog.php` + a body partial; set `status` when the body is
  ready. See the on-page checklist in `docs/seo-content-strategy.md`.

## Schema

- Published posts emit `Article` (pillars) / `BlogPosting` (clusters) JSON-LD (author+publisher →
  `#organization`). Breadcrumb comes from `page-header`. Drafts emit no article schema.
