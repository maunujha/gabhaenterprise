@php
    $url = route('blog.show', $slug);
    $isDraft = ($post['status'] ?? 'draft') !== 'published';

    $articleSchema = [
        '@context' => 'https://schema.org',
        '@type' => $post['type'] === 'pillar' ? 'Article' : 'BlogPosting',
        'headline' => $post['h1'],
        'description' => $post['meta_description'],
        'url' => $url,
        'mainEntityOfPage' => $url,
        'inLanguage' => 'en-IN',
        'datePublished' => $post['date'],
        'dateModified' => $post['date'],
        'author' => ['@id' => route('home').'#organization'],
        'publisher' => ['@id' => route('home').'#organization'],
        'keywords' => implode(', ', array_merge([$post['primary_keyword']], $post['secondary_keywords'] ?? [])),
    ];
@endphp

<x-layouts.app :title="$post['seo_title']" :description="$post['meta_description']" :noindex="$isDraft">

    <x-ui.page-header
        eyebrow="Guide"
        :title="$post['h1']"
        :intro="$post['excerpt']"
        :breadcrumbs="[
            ['label' => 'Guides', 'url' => route('blog.index')],
            ['label' => $post['h1'], 'url' => $url],
        ]">
        <div class="mt-7 flex flex-wrap items-center gap-x-5 gap-y-2 text-[0.88rem] text-muted">
            <span class="inline-flex items-center gap-2">
                <span class="h-1.5 w-1.5 rounded-full bg-brand"></span>
                {{ $post['type'] === 'pillar' ? 'Pillar guide' : 'Guide' }}
            </span>
            <span>{{ $post['read_time'] }} read</span>
            @if ($pillar)
                <span>Part of <a href="{{ route('blog.show', $pillar['slug']) }}" class="link-underline text-ink-soft">{{ $pillar['title'] }}</a></span>
            @endif
        </div>
    </x-ui.page-header>

    {{-- Intro --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-14 lg:py-20">
            <div class="max-w-[68ch]">
                @foreach ($post['intro'] as $i => $para)
                    <p @class([
                        'text-[1.2rem] leading-relaxed text-ink-soft' => $i === 0,
                        'mt-5 leading-relaxed text-muted' => $i > 0,
                        'text-pretty' => true,
                    ])>{{ $para }}</p>
                @endforeach

                @if ($isDraft)
                    <p class="mt-8 rounded-lg border border-line bg-surface px-5 py-4 text-[0.92rem] leading-relaxed text-muted">
                        <strong class="font-medium text-ink-soft">Guide in progress.</strong>
                        The full article is being written — the outline below is what it will cover.
                    </p>
                @endif
            </div>
        </div>
    </section>

    {{-- Full article body when a content partial exists; outline scaffold otherwise (drafts) --}}
    @php $bodyView = 'pages.blog.content.'.$slug; @endphp
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-14 lg:py-20">
            @if (view()->exists($bodyView))
                <div class="article max-w-[72ch]">
                    @include($bodyView)
                </div>
            @else
                <x-ui.section-title lead="How this guide is structured — each section ties a brand decision back to how the garment is actually made.">
                    What this guide covers.
                </x-ui.section-title>

                <ol class="mt-12 space-y-px overflow-hidden rounded-2xl border border-line bg-line">
                    @foreach ($post['outline'] as $i => $item)
                        <li class="grid gap-2 bg-bg p-6 sm:grid-cols-12 sm:gap-8 sm:p-8">
                            <div class="sm:col-span-1">
                                <span class="font-display text-[1.35rem] leading-none text-line-strong tabular-nums">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="sm:col-span-11">
                                <h3 class="font-display text-[1.2rem] text-ink text-balance">{{ $item['heading'] }}</h3>
                                @if (! empty($item['points']))
                                    <ul class="mt-3 flex flex-wrap gap-x-6 gap-y-1.5 text-[0.94rem] text-muted">
                                        @foreach ($item['points'] as $point)
                                            <li class="inline-flex items-center gap-2">
                                                <span class="h-1 w-1 rounded-full bg-brand/60"></span>{{ $point }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ol>
            @endif
        </div>
    </section>

    {{-- Internal links: services + related guides --}}
    <section class="bg-surface" data-reveal>
        <div class="container-x py-16 lg:py-24">
            <div class="grid gap-x-12 gap-y-12 lg:grid-cols-2">
                @if (! empty($relatedServices))
                    <div>
                        <x-ui.section-title as="h2">Services in this guide.</x-ui.section-title>
                        <ul class="mt-8 divide-y divide-line border-y border-line">
                            @foreach ($relatedServices as $rel)
                                <li>
                                    <a href="{{ route('services.show', $rel['path']) }}" class="group flex items-center gap-4 py-4">
                                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-brand-tint text-brand">
                                            <x-ui.icon :name="$rel['icon']" :size="18" />
                                        </span>
                                        <span class="flex-1 font-medium text-ink">{{ $rel['title'] }}</span>
                                        <x-ui.icon name="arrow-right" :size="18" class="shrink-0 text-line-strong transition-transform duration-300 group-hover:translate-x-1 group-hover:text-ink" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (! empty($relatedPosts))
                    <div>
                        <x-ui.section-title as="h2">Continue reading.</x-ui.section-title>
                        <ul class="mt-8 divide-y divide-line border-y border-line">
                            @foreach ($relatedPosts as $rel)
                                <li>
                                    <a href="{{ route('blog.show', $rel['slug']) }}" class="group block py-4">
                                        <span class="block font-medium text-ink transition-colors group-hover:text-brand">{{ $rel['title'] }}</span>
                                        <span class="mt-1 block text-[0.92rem] leading-relaxed text-muted">{{ $rel['excerpt'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <x-ui.cta-band label="Get a quote" />

    @unless ($isDraft)
        <script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endunless
</x-layouts.app>
