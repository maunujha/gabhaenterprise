<?php

/*
|--------------------------------------------------------------------------
| Blog / content hub
|--------------------------------------------------------------------------
|
| Lightweight, config-driven blog (no DB, no CMS) mirroring service_pages.php.
| This file is the SEO CONTENT STRUCTURE, not finished articles — each post
| carries its SEO scaffold (title, meta, keywords, excerpt, intro, outline)
| and its internal-linking map (related services + related posts). Fill the
| section bodies later, then flip `status` from 'draft' to 'published'.
|
| Topic-cluster model (hub-and-spoke):
|   • 2 PILLARS (broad, high-intent): how-to-start-a-clothing-brand,
|     garment-manufacturing-process
|   • 6 CLUSTER posts linking up to a pillar and across to service pages.
|
| Publishing rules (enforced in BlogController / SitemapController):
|   • status 'draft'     → renders with noindex; excluded from sitemap + index list.
|   • status 'published' → indexable; listed on /blog; added to sitemap.
|
| Each post:
|   type                → 'pillar' | 'cluster'
|   cluster             → cluster group key (see $clusters)
|   pillar              → parent pillar slug (clusters only; null for pillars)
|   status              → 'draft' | 'published'
|   seo_title           → <title> (layout appends " — Gabha Enterprise")
|   h1                  → page H1
|   meta_description    → unique meta description
|   primary_keyword     → head term the post targets
|   secondary_keywords  → supporting / brand-focused terms (natural, no stuffing)
|   excerpt             → listing + og/summary sentence
|   read_time           → indicative
|   date                → planned/publish date (ISO)
|   intro[]             → opening paragraphs
|   outline[]           → { heading (H2), points[] (H3 / key sub-points) }
|   related_services    → service_pages slugs (blog → service internal links)
|   related_posts       → blog slugs (pillar ↔ cluster + lateral links)
|
| Typographic apostrophes/dashes are intentional (house style + avoids escaping).
|
*/

return [

    // Cluster labels for grouping on the index + strategy docs.
    'clusters' => [
        'starting-a-brand' => 'Starting a Clothing Brand',
        'manufacturing'    => 'Manufacturing & Production',
    ],

    'posts' => [

        /* =============================== PILLAR 1 =============================== */
        'how-to-start-a-clothing-brand' => [
            'type' => 'pillar',
            'cluster' => 'starting-a-brand',
            'pillar' => null,
            'status' => 'published',
            'seo_title' => 'How to Start a Clothing Brand in India (Step-by-Step)',
            'h1' => 'How to Start a Clothing Brand: A Step-by-Step Guide',
            'meta_description' => 'A practical, no-fluff guide to starting a clothing brand in India — from idea and tech pack to your first manufactured run, with low MOQs, real costs and honest timelines.',
            'primary_keyword' => 'how to start a clothing brand',
            'secondary_keywords' => ['start a clothing brand in India', 'launch a clothing line', 'clothing brand startup costs', 'low MOQ clothing manufacturer', 'clothing brand manufacturing'],
            'excerpt' => 'Everything a first-time founder needs to go from an idea to a sellable first drop — the decisions, the costs, and the manufacturing steps that actually matter.',
            'read_time' => '12 min',
            'date' => '2026-07-11',
            'intro' => [
                'Starting a clothing brand looks effortless from the outside and feels like a maze from the inside. The design is the fun part; the gap between a good idea and a garment you can actually sell is where most brands stall.',
                'This guide walks the whole path in plain terms — positioning, product, manufacturing model, fabric, sampling, and your first production run — so you can start with the decisions that matter instead of the ones that just feel busy.',
            ],
            'outline' => [
                ['heading' => 'Is now the right time to start a clothing brand?', 'points' => ['What the market rewards today', 'The commitments and costs to expect']],
                ['heading' => 'Define your brand before your product', 'points' => ['Positioning, audience, and price point', 'Where your brand will actually sell']],
                ['heading' => 'Turn your idea into a product specification', 'points' => ['Sketches, reference garments, and tech packs', 'What a manufacturer needs from you to quote']],
                ['heading' => 'Choose your manufacturing model', 'points' => ['Private label, OEM, or fully custom', 'Why low minimums matter for a first run']],
                ['heading' => 'Pick the right fabric', 'points' => ['Weight, GSM, and hand-feel', 'Matching fabric to your target price']],
                ['heading' => 'Sampling: getting the first garment right', 'points' => ['How the sampling process works', 'How many rounds to plan for']],
                ['heading' => 'Your first production run', 'points' => ['MOQs, timelines, and costing', 'Decoration: printing and embroidery']],
                ['heading' => 'Packaging, launch, and scaling', 'points' => ['Retail vs direct-to-consumer packing', 'Scaling the styles that sell']],
            ],
            'related_services' => ['brand-launch', 'private-label', 'custom'],
            'related_posts' => ['private-label-vs-oem-manufacturing', 'clothing-manufacturing-moq-guide', 'clothing-fabric-guide'],
        ],

        /* =============================== PILLAR 2 =============================== */
        'garment-manufacturing-process' => [
            'type' => 'pillar',
            'cluster' => 'manufacturing',
            'pillar' => null,
            'status' => 'published',
            'seo_title' => 'The Garment Manufacturing Process, Explained Step by Step',
            'h1' => 'The Garment Manufacturing Process: From Fabric to Finished',
            'meta_description' => 'How a garment is actually made — the full apparel manufacturing process from tech pack and fabric through cutting, stitching, decoration, quality control, and packing.',
            'primary_keyword' => 'garment manufacturing process',
            'secondary_keywords' => ['apparel manufacturing process', 'clothing production process', 'how clothes are manufactured', 'cut and sew manufacturing', 'stages of garment production'],
            'excerpt' => 'A clear walk through every stage of apparel manufacturing, so you know exactly what happens to your order between a tech pack and a packed carton.',
            'read_time' => '11 min',
            'date' => '2026-07-11',
            'intro' => [
                'Most brands buy manufacturing without ever seeing how it works — which makes it hard to spec well, judge a quote, or know where quality is won and lost.',
                'This guide opens up the whole process, stage by stage, from specification to dispatch, so you can talk to a manufacturer as an informed partner rather than a hopeful outsider.',
            ],
            'outline' => [
                ['heading' => 'What "garment manufacturing" actually covers', 'points' => ['Where making begins and ends', 'Who is accountable at each stage']],
                ['heading' => 'Stage 1 — Specification and the tech pack', 'points' => ['What a tech pack contains', 'Why precision here saves money later']],
                ['heading' => 'Stage 2 — Pattern making and grading', 'points' => ['From spec to production pattern', 'Grading across the size range']],
                ['heading' => 'Stage 3 — Fabric sourcing and testing', 'points' => ['GSM, shrinkage, colourfastness', 'Matching fabric to the product']],
                ['heading' => 'Stage 4 — Sampling and approval', 'points' => ['The pre-production sample', 'Signing off before bulk']],
                ['heading' => 'Stage 5 — Cutting', 'points' => ['Marker planning and efficiency', 'Consistency across panels']],
                ['heading' => 'Stage 6 — Stitching and assembly', 'points' => ['Managed lines', 'Construction to spec']],
                ['heading' => 'Stage 7 — Decoration: printing and embroidery', 'points' => ['In-house vs outsourced', 'Colour and placement control']],
                ['heading' => 'Stage 8 — Quality control', 'points' => ['In-line vs end-line checks', 'Acceptance standards']],
                ['heading' => 'Stage 9 — Finishing, packing, and dispatch', 'points' => ['Pressing, folding, tagging', 'Retail- or ship-ready']],
            ],
            'related_services' => ['oem', 'bulk', 'private-label'],
            'related_posts' => ['clothing-fabric-guide', 'garment-printing-guide', 'garment-embroidery-guide', 'apparel-packaging-guide'],
        ],

        /* =============================== CLUSTERS =============================== */
        'private-label-vs-oem-manufacturing' => [
            'type' => 'cluster',
            'cluster' => 'starting-a-brand',
            'pillar' => 'how-to-start-a-clothing-brand',
            'status' => 'published',
            'seo_title' => 'Private Label vs OEM Clothing Manufacturing: Which to Choose',
            'h1' => 'Private Label vs OEM: Which Manufacturing Model Fits Your Brand?',
            'meta_description' => 'Private label vs OEM apparel manufacturing explained — the real differences in control, cost, and complexity, and how to choose the right model for your clothing brand.',
            'primary_keyword' => 'private label vs oem',
            'secondary_keywords' => ['private label clothing manufacturing', 'oem clothing manufacturing', 'difference between private label and oem', 'white label vs private label clothing'],
            'excerpt' => 'The two most common ways brands get made — what each really means, how they differ on control and cost, and which one suits a new label.',
            'read_time' => '8 min',
            'date' => '2026-07-11',
            'intro' => [
                'Private label and OEM get used interchangeably, but they describe two different relationships with a factory — and picking the wrong one costs you either control or time.',
                'This guide draws the line clearly, compares them where it counts, and helps you choose the model that fits where your brand is right now.',
            ],
            'outline' => [
                ['heading' => 'The quick answer', 'points' => []],
                ['heading' => 'What private label manufacturing means', 'points' => ['Your brand on our making', 'Best for']],
                ['heading' => 'What OEM manufacturing means', 'points' => ['Built to your specification', 'Best for']],
                ['heading' => 'Private label vs OEM: side by side', 'points' => ['Control, cost, speed, and complexity']],
                ['heading' => 'Which model suits a new brand?', 'points' => []],
                ['heading' => 'Can you move from one to the other?', 'points' => []],
            ],
            'related_services' => ['private-label', 'oem'],
            'related_posts' => ['how-to-start-a-clothing-brand', 'clothing-manufacturing-moq-guide'],
        ],

        'clothing-manufacturing-moq-guide' => [
            'type' => 'cluster',
            'cluster' => 'starting-a-brand',
            'pillar' => 'how-to-start-a-clothing-brand',
            'status' => 'published',
            'seo_title' => 'Clothing Manufacturing MOQ Guide: Minimums Explained',
            'h1' => 'MOQ in Clothing Manufacturing: A Practical Guide',
            'meta_description' => 'What MOQ (minimum order quantity) really means in clothing manufacturing, why it exists, typical minimums, and how to launch a brand on a low first run.',
            'primary_keyword' => 'clothing manufacturing MOQ',
            'secondary_keywords' => ['minimum order quantity clothing', 'low MOQ clothing manufacturer', 'MOQ meaning apparel', 'small batch clothing manufacturing'],
            'excerpt' => 'Minimum order quantity is the number that decides whether a new brand can afford to start. Here is what MOQ means, why it exists, and how to keep yours low.',
            'read_time' => '7 min',
            'date' => '2026-07-11',
            'intro' => [
                'MOQ — minimum order quantity — is the first hard number a new brand runs into, and the one that most often decides whether an idea gets made at all.',
                'This guide explains why minimums exist, what is realistic in apparel, and how to launch with a small first run without paying a punishing unit price.',
            ],
            'outline' => [
                ['heading' => 'What MOQ means and why it exists', 'points' => []],
                ['heading' => 'Typical MOQs in apparel manufacturing', 'points' => []],
                ['heading' => 'Why low MOQs matter for new brands', 'points' => []],
                ['heading' => 'MOQ per style vs per fabric vs per colour', 'points' => []],
                ['heading' => 'How to keep your first order small', 'points' => []],
                ['heading' => 'MOQ and unit cost: the trade-off', 'points' => []],
            ],
            'related_services' => ['bulk', 'brand-launch', 'private-label'],
            'related_posts' => ['how-to-start-a-clothing-brand', 'private-label-vs-oem-manufacturing'],
        ],

        'clothing-fabric-guide' => [
            'type' => 'cluster',
            'cluster' => 'manufacturing',
            'pillar' => 'garment-manufacturing-process',
            'status' => 'published',
            'seo_title' => 'Clothing Fabric Guide: Cotton, GSM, Knits & Weights',
            'h1' => 'A Fabric Guide for Clothing Brands',
            'meta_description' => 'A brand-focused fabric guide — cotton, jersey, French terry and fleece, GSM and weights explained, and how to choose the right fabric for your garment and price.',
            'primary_keyword' => 'clothing fabric guide',
            'secondary_keywords' => ['GSM fabric guide', 'heavyweight cotton fabric', 'fabric for t-shirts', 'apparel fabric types', 'fabric weight guide'],
            'excerpt' => 'Fabric decides how a garment feels, lasts, and prices. This guide covers the fabrics, weights, and GSM ranges that matter, and how to choose well.',
            'read_time' => '9 min',
            'date' => '2026-07-11',
            'intro' => [
                'You can cut and stitch a garment flawlessly and still ship a disappointing product if the fabric is wrong — thin, shrinking, or simply not what the customer expected to touch.',
                'This guide demystifies apparel fabric: what GSM means, which materials suit which products, and how to match cloth to your price point without guessing.',
            ],
            'outline' => [
                ['heading' => 'Why fabric is the most important decision', 'points' => []],
                ['heading' => 'Understanding GSM and fabric weight', 'points' => []],
                ['heading' => 'Common apparel fabrics and what they suit', 'points' => ['Jersey, terry, fleece, pique, blends']],
                ['heading' => 'Heavyweight cotton and premium tees', 'points' => []],
                ['heading' => 'Knits vs wovens', 'points' => []],
                ['heading' => 'Testing: GSM, shrinkage, colourfastness', 'points' => []],
                ['heading' => 'Matching fabric to your price point', 'points' => []],
            ],
            'related_services' => ['fabric', 'custom', 'private-label'],
            'related_posts' => ['garment-manufacturing-process', 'how-to-start-a-clothing-brand'],
        ],

        'garment-printing-guide' => [
            'type' => 'cluster',
            'cluster' => 'manufacturing',
            'pillar' => 'garment-manufacturing-process',
            'status' => 'published',
            'seo_title' => 'Garment Printing Guide: Screen, DTG & Puff Compared',
            'h1' => 'Garment Printing Guide: Methods, Durability & When to Use Each',
            'meta_description' => 'A practical garment printing guide — screen printing, DTG, and puff compared on cost, detail, and durability, plus how to get prints that survive washing.',
            'primary_keyword' => 'garment printing guide',
            'secondary_keywords' => ['screen printing vs DTG', 'types of garment printing', 'puff printing', 'best printing for t-shirts', 'DTG printing'],
            'excerpt' => 'Screen, DTG, or puff? A clear comparison of garment printing methods on cost, detail, and durability — and how to get a print that lasts.',
            'read_time' => '8 min',
            'date' => '2026-07-11',
            'intro' => [
                'A print is the first thing a customer sees and the first thing that fails if it is done badly. Choosing the right method for your artwork is half the battle.',
                'This guide compares the main garment printing methods, explains where each wins, and covers the durability and colour details that separate a professional print from a promotional one.',
            ],
            'outline' => [
                ['heading' => 'Choosing a printing method', 'points' => []],
                ['heading' => 'Screen printing', 'points' => ['How it works', 'Best for']],
                ['heading' => 'DTG (direct-to-garment)', 'points' => ['How it works', 'Best for']],
                ['heading' => 'Puff and specialty prints', 'points' => []],
                ['heading' => 'Screen vs DTG vs puff: comparison', 'points' => []],
                ['heading' => 'Making prints that last', 'points' => ['Wash durability, crack and fade']],
                ['heading' => 'Colour matching and placement', 'points' => []],
            ],
            'related_services' => ['printing', 'private-label'],
            'related_posts' => ['garment-embroidery-guide', 'garment-manufacturing-process'],
        ],

        'garment-embroidery-guide' => [
            'type' => 'cluster',
            'cluster' => 'manufacturing',
            'pillar' => 'garment-manufacturing-process',
            'status' => 'published',
            'seo_title' => 'Garment Embroidery Guide: Flat, 3D Puff & Appliqué',
            'h1' => 'Garment Embroidery Guide for Clothing Brands',
            'meta_description' => 'A garment embroidery guide covering flat, 3D puff, and appliqué, why digitising decides quality, and when embroidery beats printing for your logo.',
            'primary_keyword' => 'garment embroidery guide',
            'secondary_keywords' => ['embroidery vs printing', 'types of embroidery', '3D puff embroidery', 'logo embroidery clothing', 'embroidery digitising'],
            'excerpt' => 'Embroidery reads as quality when it is done right and cheap when it is not. This guide covers the types, the digitising that decides them, and when to choose it.',
            'read_time' => '7 min',
            'date' => '2026-07-11',
            'intro' => [
                'A crisp embroidered logo signals a garment made with care — which is exactly why bad embroidery is so visible. Quality is decided long before the needle, in the digitising.',
                'This guide explains the types of embroidery, why digitising matters so much, and how to judge when embroidery is the right call for your brand over printing.',
            ],
            'outline' => [
                ['heading' => 'When to choose embroidery over printing', 'points' => []],
                ['heading' => 'Types of embroidery', 'points' => ['Flat, 3D puff, appliqué']],
                ['heading' => 'Why digitising decides quality', 'points' => []],
                ['heading' => 'Placements: chest, sleeve, back, caps', 'points' => []],
                ['heading' => 'Embroidery on different fabrics', 'points' => []],
                ['heading' => 'Thread colour matching and consistency', 'points' => []],
            ],
            'related_services' => ['embroidery', 'private-label'],
            'related_posts' => ['garment-printing-guide', 'garment-manufacturing-process'],
        ],

        'apparel-packaging-guide' => [
            'type' => 'cluster',
            'cluster' => 'manufacturing',
            'pillar' => 'garment-manufacturing-process',
            'status' => 'published',
            'seo_title' => 'Apparel Packaging Guide: Tags, Polybags & Branding',
            'h1' => 'Apparel Packaging Guide: Finishing That Sells',
            'meta_description' => 'An apparel packaging guide — polybags, hang tags, care labels, and branded mailers, plus retail vs DTC packing and how finishing protects your brand.',
            'primary_keyword' => 'apparel packaging guide',
            'secondary_keywords' => ['clothing packaging ideas', 'hang tags and labels', 'garment packaging', 'retail vs DTC packaging', 'branded clothing packaging'],
            'excerpt' => 'Packaging is the first thing your customer touches and the last thing a manufacturer does. This guide covers the elements, the channels, and the branding.',
            'read_time' => '7 min',
            'date' => '2026-07-11',
            'intro' => [
                'Packaging is the last thing you make and the first thing your customer touches — the moment a garment stops being a product and starts being an experience.',
                'This guide covers what goes into apparel packaging, how retail and direct-to-consumer differ, and how the right finishing makes a small brand feel considered.',
            ],
            'outline' => [
                ['heading' => 'Why packaging is part of the product', 'points' => []],
                ['heading' => 'The elements: polybags, tags, labels, mailers', 'points' => []],
                ['heading' => 'Care and content labels (and compliance)', 'points' => []],
                ['heading' => 'Retail packaging vs direct-to-consumer', 'points' => []],
                ['heading' => 'Branding the unboxing experience', 'points' => []],
                ['heading' => 'Sustainable packaging options', 'points' => []],
            ],
            'related_services' => ['packaging', 'bulk'],
            'related_posts' => ['garment-manufacturing-process', 'clothing-manufacturing-moq-guide'],
        ],

    ],
];
