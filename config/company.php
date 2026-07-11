<?php

/*
|--------------------------------------------------------------------------
| Company profile
|--------------------------------------------------------------------------
|
| Single source of truth for Gabha Enterprise's public details. Views, SEO
| meta, structured data and mailables all read from here so the site never
| repeats a phone number, address or service name in two places.
|
*/

return [

    'name'        => 'Gabha Enterprise',
    'legal_name'  => 'Gabha Enterprise',
    'tagline'     => 'Apparel manufacturing, engineered for brands.',
    'brand'       => 'Urbanflaky',

    'description' => 'Gabha Enterprise is a private-label and OEM apparel manufacturer producing premium heavyweight cotton and knitwear for clothing brands, retailers and exporters — from fabric sourcing to finished, packed garments.',

    // Contact ------------------------------------------------------------
    'email'         => 'support@urbanflaky.in',
    'phone'         => '+91 73572 91841',
    'phone_e164'    => '+917357291841',
    'whatsapp'      => '917357291841',
    'whatsapp_message' => 'Hi Gabha Enterprise, I would like to discuss manufacturing apparel for my brand.',

    // Where inquiry notifications are delivered. Same-domain internal
    // delivery on Hostinger, so it is not affected by external filtering.
    'inquiry_recipient' => env('INQUIRY_MAIL_TO', 'support@urbanflaky.in'),

    // Address (used for LocalBusiness schema + footer) -------------------
    'address' => [
        'street'   => 'Industrial Area',
        'locality' => 'Dholpur',
        'region'   => 'Rajasthan',
        'postal'   => '328001',
        'country'  => 'IN',
    ],

    'geo' => [
        'lat' => '26.7025',
        'lng' => '77.8899',
    ],

    'hours' => 'Mon–Sat, 10:00–19:00 IST',

    // Social / brand properties -----------------------------------------
    'links' => [
        'urbanflaky' => 'https://urbanflaky.in',
    ],

    'founded' => '2019',

    // Headline capability figures (kept factual + conservative) ----------
    'stats' => [
        ['value' => '50+',   'label' => 'Brands manufactured for'],
        ['value' => '30',    'label' => 'Piece minimum per style'],
        ['value' => '180 GSM+', 'label' => 'Heavyweight cotton standard'],
        ['value' => '15 days', 'label' => 'Typical sampling turnaround'],
    ],

    // Services — canonical list reused across home, services page + footer.
    'services' => [
        ['slug' => 'private-label', 'icon' => 'tag',       'title' => 'Private Label Manufacturing', 'summary' => 'Your brand, our factory floor. We produce finished garments under your label, ready to sell — you own the design, we own the making.'],
        ['slug' => 'oem',           'icon' => 'layers',    'title' => 'OEM Clothing Manufacturing',  'summary' => 'Build to your specification. Send a tech pack and we engineer the garment — construction, grading, and tolerances to spec.'],
        ['slug' => 'bulk',          'icon' => 'boxes',     'title' => 'Bulk Apparel Production',      'summary' => 'Consistent quality at volume. Scaled cutting, stitching, and finishing lines that hold the same standard from unit 30 to unit 30,000.'],
        ['slug' => 'custom',        'icon' => 'scissors',  'title' => 'Custom Garment Manufacturing','summary' => 'From a sketch or a reference sample. We develop patterns, source trims, and build a garment that did not exist before.'],
        ['slug' => 'fabric',        'icon' => 'spool',     'title' => 'Fabric Sourcing',             'summary' => 'Heavyweight cotton, loopknit, fleece, and blends — sourced, tested for GSM and shrinkage, and matched to your price point.'],
        ['slug' => 'printing',      'icon' => 'printer',   'title' => 'Printing',                    'summary' => 'Screen, DTG, and puff printing with wash-tested durability. Colour matched to your reference, checked panel by panel.'],
        ['slug' => 'embroidery',    'icon' => 'hoop',      'title' => 'Embroidery',                  'summary' => 'Flat, 3D puff, and appliqué embroidery digitised in-house for clean, repeatable logos and artwork on any placement.'],
        ['slug' => 'packaging',     'icon' => 'package',   'title' => 'Packaging',                   'summary' => 'Custom polybags, tags, care labels, and mailers. Garments arrive folded, tagged, and retail- or ship-ready.'],
        ['slug' => 'brand-launch',  'icon' => 'rocket',    'title' => 'Brand Launch Support',        'summary' => 'For first-time founders: tech-pack help, low first runs, and guidance from sample to your first sellable drop.'],
    ],

    // Who we manufacture for.
    'industries' => [
        ['icon' => 'sparkle',   'title' => 'Clothing Brands',  'summary' => 'Established labels scaling production or moving to a partner who protects their standard and their margins.'],
        ['icon' => 'rocket',    'title' => 'Startups',         'summary' => 'First-time founders launching a line — low minimums, tech-pack support, and a route from idea to first drop.'],
        ['icon' => 'boxes',     'title' => 'Wholesalers',      'summary' => 'Volume buyers who need dependable lead times, consistent sizing, and pricing that works at scale.'],
        ['icon' => 'tag',       'title' => 'Retailers',        'summary' => 'Stores building private-label ranges that sit beside — and hold up against — the brands on their shelves.'],
        ['icon' => 'globe',     'title' => 'Exporters',        'summary' => 'Buyers shipping abroad who need export-grade finishing, documentation, and repeatable quality.'],
        ['icon' => 'handshake', 'title' => 'Corporate Buyers', 'summary' => 'Teams sourcing uniforms, merch, and premium branded apparel with a single accountable manufacturer.'],
    ],

];
