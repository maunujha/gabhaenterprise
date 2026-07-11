@php
    $c = config('company');
    $home = route('home');

    $org = [
        '@type' => 'Organization',
        '@id' => $home.'#organization',
        'name' => $c['legal_name'],
        'url' => $home,
        'logo' => url('/favicon.svg'),
        'image' => url('/og-image.png'),
        'description' => $c['description'],
        'email' => $c['email'],
        'telephone' => $c['phone_e164'],
        'foundingDate' => $c['founded'],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $c['address']['street'],
            'addressLocality' => $c['address']['locality'],
            'addressRegion' => $c['address']['region'],
            'postalCode' => $c['address']['postal'],
            'addressCountry' => $c['address']['country'],
        ],
        'brand' => ['@type' => 'Brand', 'name' => $c['brand']],
        'sameAs' => array_values($c['links']),
    ];

    $localBusiness = [
        '@type' => 'LocalBusiness',
        '@id' => $home.'#localbusiness',
        'name' => $c['legal_name'],
        'url' => $home,
        'image' => url('/og-image.png'),
        'email' => $c['email'],
        'telephone' => $c['phone_e164'],
        'priceRange' => '₹₹',
        'parentOrganization' => ['@id' => $home.'#organization'],
        'address' => $org['address'],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => $c['geo']['lat'],
            'longitude' => $c['geo']['lng'],
        ],
        'areaServed' => ['@type' => 'Country', 'name' => 'India'],
        'openingHours' => 'Mo-Sa 10:00-19:00',
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
