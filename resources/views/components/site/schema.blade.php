@php
    $c = config('company');
    $home = route('home');

    // Shared image/logo objects — reused across entities so the same asset is
    // described once and stays consistent.
    $logo = url('/favicon.svg');
    $ogImage = [
        '@type' => 'ImageObject',
        'url' => url('/og-image.png'),
        'width' => 1200,
        'height' => 630,
    ];

    $postalAddress = [
        '@type' => 'PostalAddress',
        'streetAddress' => $c['address']['street'],
        'addressLocality' => $c['address']['locality'],
        'addressRegion' => $c['address']['region'],
        'postalCode' => $c['address']['postal'],
        'addressCountry' => $c['address']['country'],
    ];

    $org = [
        '@type' => 'Organization',
        '@id' => $home.'#organization',
        'name' => $c['legal_name'],
        'url' => $home,
        'logo' => $logo,
        'image' => $ogImage,
        'description' => $c['description'],
        'slogan' => $c['tagline'],
        'email' => $c['email'],
        'telephone' => $c['phone_e164'],
        'foundingDate' => $c['founded'],
        'address' => $postalAddress,
        'contactPoint' => [[
            '@type' => 'ContactPoint',
            'contactType' => 'sales',
            'telephone' => $c['phone_e164'],
            'email' => $c['email'],
            'areaServed' => 'IN',
            'availableLanguage' => ['en', 'hi'],
        ]],
        'brand' => ['@type' => 'Brand', 'name' => $c['brand']],
        'sameAs' => array_values($c['links']),
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'Apparel Manufacturing Services',
            'itemListElement' => array_map(fn ($s) => [
                '@type' => 'Offer',
                'itemOffered' => [
                    '@type' => 'Service',
                    'name' => $s['title'],
                    'description' => $s['summary'],
                    'provider' => ['@id' => $home.'#organization'],
                ],
            ], $c['services']),
        ],
    ];

    $localBusiness = [
        '@type' => 'LocalBusiness',
        '@id' => $home.'#localbusiness',
        'name' => $c['legal_name'],
        'url' => $home,
        'image' => $ogImage,
        'logo' => $logo,
        'email' => $c['email'],
        'telephone' => $c['phone_e164'],
        'priceRange' => '₹₹',
        'currenciesAccepted' => 'INR',
        'parentOrganization' => ['@id' => $home.'#organization'],
        'address' => $postalAddress,
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => $c['geo']['lat'],
            'longitude' => $c['geo']['lng'],
        ],
        'areaServed' => ['@type' => 'Country', 'name' => 'India'],
        'openingHoursSpecification' => [[
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'opens' => '10:00',
            'closes' => '19:00',
        ]],
    ];

    $website = [
        '@type' => 'WebSite',
        '@id' => $home.'#website',
        'url' => $home,
        'name' => $c['name'],
        'description' => $c['tagline'],
        'publisher' => ['@id' => $home.'#organization'],
        'inLanguage' => 'en-IN',
    ];

    $graph = [
        '@context' => 'https://schema.org',
        '@graph' => [$org, $localBusiness, $website],
    ];
@endphp

<script type="application/ld+json">{!! json_encode($graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
