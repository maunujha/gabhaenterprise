# SEO Content Strategy — Gabha Enterprise

The content hub (`/blog`) exists to win **top- and mid-funnel** search traffic that the
transactional service pages can't, then route it to those service pages and the contact form.
It follows a **topic-cluster (hub-and-spoke)** model: broad *pillar* guides establish topical
authority; focused *cluster* posts target long-tail queries and link up to their pillar and across
to the relevant service page.

> **Status: all 8 posts are written in full and published** — indexable, in the sitemap, and linked
> from the footer ("Guides"). Bodies live in `resources/views/pages/blog/content/{slug}.blade.php`.
> Any *new* post can still be added as `draft` (noindex, out of the sitemap) until its body is ready;
> flip `status => 'published'` in `config/blog.php` to release it.

## Objectives

1. Rank for informational queries a buyer researches *before* they're ready to ask for a quote.
2. Build topical authority around "clothing manufacturing / starting a brand" for a Dholpur, India
   private-label & OEM manufacturer.
3. Funnel readers to the matching **service page** and the **contact** form via in-content links.

## Architecture — 2 pillars, 6 clusters

| # | Post (slug) | Type | Cluster | Parent pillar | Primary keyword |
|---|---|---|---|---|---|
| 1 | `how-to-start-a-clothing-brand` | **Pillar** | Starting a Brand | — | how to start a clothing brand |
| 2 | `garment-manufacturing-process` | **Pillar** | Manufacturing | — | garment manufacturing process |
| 3 | `private-label-vs-oem-manufacturing` | Cluster | Starting a Brand | #1 | private label vs oem |
| 4 | `clothing-manufacturing-moq-guide` | Cluster | Starting a Brand | #1 | clothing manufacturing MOQ |
| 5 | `clothing-fabric-guide` | Cluster | Manufacturing | #2 | clothing fabric guide |
| 6 | `garment-printing-guide` | Cluster | Manufacturing | #2 | garment printing guide |
| 7 | `garment-embroidery-guide` | Cluster | Manufacturing | #2 | garment embroidery guide |
| 8 | `apparel-packaging-guide` | Cluster | Manufacturing | #2 | apparel packaging guide |

Full keyword sets (primary + secondary), meta descriptions, excerpts, intros, and section outlines
live in **`config/blog.php`** — the single source of truth. Don't duplicate copy here.

## Internal-linking map (the whole point of clusters)

**Down** — each pillar links to its cluster posts. **Up** — each cluster links back to its pillar.
**Across** — clusters link to sibling clusters where topics touch. **Convert** — every post links to
the service page(s) it maps to; each service page shows a "Related guides" block listing published
posts that reference it (reverse lookup, `PageController@service`).

| Post | → Service pages (convert) | → Posts (up / across) |
|---|---|---|
| How to Start a Clothing Brand | brand-launch, private-label, custom | ↓ private-label-vs-oem, moq, fabric |
| Garment Manufacturing Process | oem, bulk, private-label | ↓ fabric, printing, embroidery, packaging |
| Private Label vs OEM | private-label, oem | ↑ how-to-start · → moq |
| MOQ Guide | bulk, brand-launch, private-label | ↑ how-to-start · → private-label-vs-oem |
| Fabric Guide | fabric, custom, private-label | ↑ manufacturing-process · → how-to-start |
| Printing Guide | printing, private-label | ↑ manufacturing-process · → embroidery |
| Embroidery Guide | embroidery, private-label | ↑ manufacturing-process · → printing |
| Packaging Guide | packaging, bulk | ↑ manufacturing-process · → moq |

Service → blog links only surface **published** posts, so indexable service pages never link to thin
draft pages.

## On-page SEO checklist (per post, before publishing)

- [ ] Unique `seo_title` (~50–60 chars incl. brand) and `meta_description` (~150–160 chars).
- [ ] One `<h1>` (the `h1` field); section headings as `<h2>`; sub-points `<h3>`.
- [ ] Primary keyword in H1, intro, one H2, and naturally in body — **no stuffing**.
- [ ] 1,200–2,000 words of genuinely useful, original copy (match the service-page voice).
- [ ] ≥1 link to the mapped service page(s); ≥1 link up to the pillar; ≥1 lateral cluster link.
- [ ] `Article`/`BlogPosting` JSON-LD (auto from the template once published).
- [ ] Self-canonical (automatic); descriptive slug (already set).
- [ ] Add real imagery with alt text if the topic warrants it (optional; site is typographic).

## Publishing workflow

1. Write the body for each `outline` section in `config/blog.php` (extend the data model with a
   `body` per section, or convert the post to a dedicated Blade partial if it needs rich layout).
2. Set `status => 'published'` and confirm `date`.
3. `npm run build` (if new utility classes) + deploy. The post auto-indexes, lists on `/blog`, and
   enters `sitemap.xml`.
4. Add **Guides** to the header/footer nav once ≥2 posts are live (kept out of nav while empty).

## Suggested publishing order

Pillars first (they anchor the clusters and pass authority down): **#1 → #2**, then the clusters
that map to the highest-intent services: private-label-vs-oem → MOQ → fabric → printing →
embroidery → packaging.

## Measurement

Track in Search Console (already wired via `GOOGLE_SITE_VERIFICATION`): impressions/clicks per
guide, and assisted conversions from guide → service page → contact. Refresh pillars every ~6–12
months; keep cluster posts tightly scoped to one query intent each.
