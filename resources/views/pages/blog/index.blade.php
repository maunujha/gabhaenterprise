<x-layouts.app
    title="Guides"
    description="Manufacturer-written guides for clothing brands — how to start a brand, choose fabric, printing, embroidery, packaging, MOQs, and how a garment is made."
    :noindex="! $hasPublished">

    <x-ui.page-header
        eyebrow="Guides"
        title="Guides for building a clothing brand."
        intro="Practical, manufacturer-written guides on starting a brand, choosing fabric, printing, embroidery, packaging, and getting a garment made — plain language, no jargon, no fluff."
        :breadcrumbs="[['label' => 'Guides', 'url' => route('blog.index')]]" />

    @foreach ($clusters as $key => $label)
        <section class="border-b border-line" data-reveal>
            <div class="container-x py-16 lg:py-24">
                <x-ui.section-title>{{ $label }}</x-ui.section-title>

                <div class="mt-12 grid gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $slug => $p)
                        @continue($p['cluster'] !== $key)
                        <article class="flex flex-col border-t border-line-strong pt-6">
                            <p class="flex items-center gap-2 text-[0.82rem] text-muted">
                                <span class="font-medium text-brand">{{ $p['type'] === 'pillar' ? 'Pillar guide' : 'Guide' }}</span>
                                @if (($p['status'] ?? '') !== 'published')
                                    <span aria-hidden="true">·</span><span>Coming soon</span>
                                @endif
                            </p>
                            <h3 class="mt-3 font-display text-[1.3rem] leading-snug text-ink text-balance">
                                <a href="{{ route('blog.show', $slug) }}" class="transition-colors hover:text-brand">{{ $p['h1'] }}</a>
                            </h3>
                            <p class="mt-2.5 flex-1 text-[0.96rem] leading-relaxed text-muted text-pretty">{{ $p['excerpt'] }}</p>
                            <a href="{{ route('blog.show', $slug) }}" class="mt-5 inline-flex items-center gap-2 text-[0.92rem] font-medium text-ink link-underline">
                                Read the guide
                                <x-ui.icon name="arrow-right" :size="16" />
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    <x-ui.cta-band label="Get a quote" />
</x-layouts.app>
