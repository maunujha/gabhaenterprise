@props([
    'title',
    'intro' => null,
    'breadcrumbs' => [], // [['label' => '…', 'url' => '…'], …] — current page last
    'eyebrow' => null,
])

@php
    // Prepend Home; the passed items describe the trail to this page.
    $trail = array_merge([['label' => 'Home', 'url' => route('home')]], $breadcrumbs);

    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_map(fn ($item, $i) => [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $item['label'],
            'item' => $item['url'],
        ], $trail, array_keys($trail)),
    ];
@endphp

<section class="border-b border-line bg-surface">
    <div class="container-x pt-[6.5rem] pb-14 lg:pt-32 lg:pb-20">
        <nav aria-label="Breadcrumb" class="mb-8">
            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[0.82rem] text-muted">
                @foreach ($trail as $i => $crumb)
                    <li class="inline-flex items-center gap-2">
                        @if ($i < count($trail) - 1)
                            <a href="{{ $crumb['url'] }}" class="hover:text-ink transition-colors">{{ $crumb['label'] }}</a>
                            <span aria-hidden="true" class="text-line-strong">/</span>
                        @else
                            <span class="text-ink" aria-current="page">{{ $crumb['label'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>

        @if ($eyebrow)
            <p class="mb-4 text-[0.8rem] font-medium uppercase tracking-[0.2em] text-brand">{{ $eyebrow }}</p>
        @endif

        <h1 class="font-display text-[clamp(2.4rem,5.5vw,4rem)] text-ink max-w-4xl">{{ $title }}</h1>

        @if ($intro)
            <p class="mt-6 text-[1.15rem] leading-relaxed text-ink-soft measure">{{ $intro }}</p>
        @endif

        {{ $slot }}
    </div>
</section>

<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
