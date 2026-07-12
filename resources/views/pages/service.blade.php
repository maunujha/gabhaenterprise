@php
    $home = route('home');
    $url = route('services.show', $page['path']);

    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $meta['title'],
        'serviceType' => $meta['title'],
        'description' => $page['meta_description'],
        'url' => $url,
        'provider' => [
            '@type' => 'Organization',
            '@id' => $home.'#organization',
            'name' => config('company.legal_name'),
        ],
        'areaServed' => ['@type' => 'Country', 'name' => 'India'],
    ];

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn ($f) => [
            '@type' => 'Question',
            'name' => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ], $page['faqs']),
    ];
@endphp

<x-layouts.app :title="$page['seo_title']" :description="$page['meta_description']">

    <x-ui.page-header
        :eyebrow="$page['eyebrow']"
        :title="$page['h1']"
        :intro="$page['lead']"
        :breadcrumbs="[
            ['label' => 'Manufacturing Services', 'url' => route('services')],
            ['label' => $meta['title'], 'url' => $url],
        ]" />

    {{-- Overview --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-16 lg:py-24">
            <div class="grid gap-10 lg:grid-cols-12 lg:gap-16">
                <div class="lg:col-span-4">
                    <span class="flex h-14 w-14 items-center justify-center rounded-xl bg-brand-tint text-brand">
                        <x-ui.icon :name="$meta['icon']" :size="28" />
                    </span>
                    <p class="mt-6 font-display text-[1.4rem] leading-snug text-ink text-balance">{{ $meta['summary'] }}</p>
                </div>
                <div class="lg:col-span-8 max-w-[68ch]">
                    @foreach ($page['intro'] as $i => $para)
                        <p @class([
                            'text-[1.2rem] leading-relaxed text-ink-soft' => $i === 0,
                            'mt-5 leading-relaxed text-muted' => $i > 0,
                            'text-pretty' => true,
                        ])>{{ $para }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Process — a genuine ordered sequence, so numbers earn their place --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <x-ui.section-title lead="A clear, accountable path from your brief to a result you have approved — with nothing lost between steps.">
                How we do it.
            </x-ui.section-title>

            <ol class="mt-14 space-y-px overflow-hidden rounded-2xl border border-line bg-line">
                @foreach ($page['process'] as $i => $step)
                    <li class="grid gap-3 bg-bg p-7 sm:grid-cols-12 sm:gap-8 sm:p-9">
                        <div class="sm:col-span-3 lg:col-span-2">
                            <span class="font-display text-[2rem] leading-none text-line-strong tabular-nums">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="sm:col-span-9 lg:col-span-10">
                            <h3 class="font-display text-[1.3rem] text-ink text-balance">{{ $step['title'] }}</h3>
                            <p class="mt-2.5 max-w-[64ch] leading-relaxed text-muted text-pretty">{{ $step['body'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Benefits — border-top list, not cards --}}
    <section class="border-b border-line bg-surface" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <x-ui.section-title lead="What working with a direct manufacturer actually changes for your brand.">
                Why it works.
            </x-ui.section-title>
            <ul class="mt-14 grid gap-x-12 gap-y-10 sm:grid-cols-2">
                @foreach ($page['benefits'] as $benefit)
                    <li class="border-t border-line-strong pt-5">
                        <h3 class="text-[1.1rem] font-semibold text-ink text-balance">{{ $benefit['title'] }}</h3>
                        <p class="mt-2 leading-relaxed text-muted text-pretty">{{ $benefit['body'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- FAQs — asymmetric: prompt left, accordion right --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <x-ui.section-title as="h2">Questions, answered.</x-ui.section-title>
                    <p class="mt-4 leading-relaxed text-muted">
                        Still unsure?
                        <a href="{{ route('contact') }}" class="link-underline text-ink">Ask us directly</a> — we reply within one business day.
                    </p>
                </div>
                <div class="lg:col-span-8">
                    <div class="divide-y divide-line border-y border-line">
                        @foreach ($page['faqs'] as $faq)
                            <details class="group">
                                <summary class="flex cursor-pointer items-start justify-between gap-6 py-5 list-none [&::-webkit-details-marker]:hidden">
                                    <span class="text-[1.05rem] font-medium text-ink text-balance">{{ $faq['q'] }}</span>
                                    <span aria-hidden="true" class="mt-1 shrink-0 text-brand transition-transform duration-300 group-open:rotate-45">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                                            <path d="M12 5v14M5 12h14" />
                                        </svg>
                                    </span>
                                </summary>
                                <p class="pb-5 -mt-1 max-w-[65ch] leading-relaxed text-muted text-pretty">{{ $faq['a'] }}</p>
                            </details>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related services + internal links --}}
    <section class="bg-surface" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <x-ui.section-title as="h2" lead="Most brands need a few of these together. We run them on one floor, so nothing falls between suppliers.">
                        Related services.
                    </x-ui.section-title>
                </div>
                <div class="lg:col-span-8">
                    <ul class="divide-y divide-line border-y border-line">
                        @foreach ($related as $rel)
                            <li>
                                <a href="{{ route('services.show', $rel['path']) }}" class="group flex items-center gap-5 py-5">
                                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-brand-tint text-brand">
                                        <x-ui.icon :name="$rel['icon']" :size="20" />
                                    </span>
                                    <span class="min-w-0 flex-1">
                                        <span class="block font-semibold text-ink">{{ $rel['title'] }}</span>
                                        <span class="mt-0.5 block text-[0.95rem] leading-relaxed text-muted">{{ $rel['summary'] }}</span>
                                    </span>
                                    <x-ui.icon name="arrow-right" :size="20" class="shrink-0 text-line-strong transition-transform duration-300 group-hover:translate-x-1 group-hover:text-ink" />
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-8 flex flex-wrap gap-x-6 gap-y-2 text-[0.95rem]">
                        <a href="{{ route('services') }}" class="link-underline text-ink-soft">All manufacturing services</a>
                        <a href="{{ route('capabilities') }}" class="link-underline text-ink-soft">Capabilities &amp; specs</a>
                        <a href="{{ route('industries') }}" class="link-underline text-ink-soft">Industries we serve</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related guides (published blog posts that reference this service) --}}
    @if (! empty($guides))
        <section class="border-t border-line" data-reveal>
            <div class="container-x py-16 lg:py-20">
                <x-ui.section-title as="h2" lead="Deeper reading on this service and how it fits your brand.">
                    Related guides.
                </x-ui.section-title>
                <ul class="mt-10 grid gap-x-10 gap-y-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($guides as $g)
                        <li class="border-t border-line-strong pt-5">
                            <h3 class="font-display text-[1.15rem] text-ink text-balance">
                                <a href="{{ route('blog.show', $g['slug']) }}" class="transition-colors hover:text-brand">{{ $g['title'] }}</a>
                            </h3>
                            <p class="mt-2 text-[0.95rem] leading-relaxed text-muted text-pretty">{{ $g['excerpt'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <x-ui.cta-band label="Get a quote" />

    <script type="application/ld+json">{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
</x-layouts.app>
