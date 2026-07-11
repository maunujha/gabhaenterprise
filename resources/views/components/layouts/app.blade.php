@props([
    'title' => null,
    'description' => null,
    'canonical' => null,
    'ogImage' => null,
    'ogType' => 'website',
    'noindex' => false,
])

@php
    $company = config('company');
    $pageTitle = $title
        ? $title.' — '.$company['name']
        : $company['name'].' — '.$company['tagline'];
    $desc = $description ?: $company['description'];
    $canonicalUrl = $canonical ?: url()->current();
    $image = url($ogImage ?: '/og-image.png');
@endphp

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>document.documentElement.classList.replace('no-js','js')</script>

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $desc }}">
    <link rel="canonical" href="{{ $canonicalUrl }}">
    @if ($noindex)
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow, max-image-preview:large">
    @endif

    {{-- Open Graph --}}
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:site_name" content="{{ $company['name'] }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $desc }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_IN">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $desc }}">
    <meta name="twitter:image" content="{{ $image }}">

    <meta name="theme-color" content="#ffffff">

    {{-- Favicons --}}
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="/favicon-32.png" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    {{-- Preload critical self-hosted fonts (no external requests) --}}
    <link rel="preload" href="/fonts/hanken-grotesk-var.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="/fonts/poppins-600.woff2" as="font" type="font/woff2" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <x-site.schema />
    {{ $head ?? '' }}
</head>
<body class="min-h-screen antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:z-[70] focus:top-4 focus:left-4 focus:bg-ink focus:text-on-ink focus:px-4 focus:py-2 focus:rounded-md">Skip to content</a>

    <x-site.header />

    <main id="main">
        {{ $slot }}
    </main>

    <x-site.footer />

    <x-site.whatsapp-fab />
</body>
</html>
