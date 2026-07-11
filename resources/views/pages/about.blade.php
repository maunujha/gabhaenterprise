@php
    $company = config('company');

    $values = [
        ['icon' => 'shield', 'title' => 'Quality is non-negotiable', 'text' => 'We would rather lose an order than ship a garment we would not sell under our own brand. The wash test is the final word.'],
        ['icon' => 'handshake', 'title' => 'Direct, honest relationships', 'text' => 'You work with the people who make your product — not a sales layer. Straight answers on cost, timing, and what is possible.'],
        ['icon' => 'sparkle', 'title' => 'We make what we sell', 'text' => 'We run our own label, Urbanflaky. Every lesson from selling to real customers goes back into how we build for you.'],
        ['icon' => 'leaf', 'title' => 'Made responsibly', 'text' => 'Efficient cutting, considered sourcing, and less waste — because good manufacturing should not cost the earth.'],
    ];
@endphp

<x-layouts.app
    title="About Us"
    description="Gabha Enterprise is a Dholpur-based apparel manufacturer and the parent company of the fashion brand Urbanflaky. We manufacture premium heavyweight cotton clothing for brands, retailers and exporters.">

    <x-ui.page-header
        eyebrow="About"
        title="A manufacturer that thinks like a brand."
        intro="Gabha Enterprise makes premium apparel for other companies — and, through Urbanflaky, for its own customers too. That dual view shapes everything: we build your garments the way we build ours."
        :breadcrumbs="[['label' => 'About', 'url' => route('about')]]" />

    {{-- Story --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-28">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <x-ui.section-title as="h2">Our story</x-ui.section-title>
                </div>
                <div class="lg:col-span-8 space-y-6 text-[1.08rem] leading-relaxed text-ink-soft">
                    <p>
                        Gabha Enterprise was founded in {{ $company['founded'] }} in Dholpur, Rajasthan,
                        in the heart of India’s garment belt. We began the way many good manufacturers
                        do — stitching for other people, learning the craft one order at a time, and
                        refusing to cut the corners that quietly ruin a garment.
                    </p>
                    <p>
                        In time we did something most factories never do: we launched our own brand.
                        <a href="{{ $company['links']['urbanflaky'] }}" target="_blank" rel="noopener" class="link-underline text-ink">Urbanflaky</a>
                        sells premium heavyweight cotton streetwear directly to customers who are
                        demanding about fit, fabric, and finish. Selling to those customers taught us
                        what a factory alone can never learn — how a garment holds up after fifty
                        washes, and what makes someone buy the same label twice.
                    </p>
                    <p>
                        Today Gabha Enterprise brings that owner’s standard to every brand we
                        manufacture for. Whether the name on the neck label is Urbanflaky or yours,
                        the garment is built to be worn, washed, and re-ordered.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Pull quote --}}
    <section class="bg-surface border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <blockquote class="mx-auto max-w-4xl text-center">
                <p class="font-display text-[clamp(1.6rem,3.4vw,2.6rem)] leading-snug text-ink">
                    “We do not ship a garment we would not be proud to sell ourselves.”
                </p>
                <footer class="mt-6 text-[0.9rem] uppercase tracking-[0.18em] text-muted">
                    The Gabha Enterprise standard
                </footer>
            </blockquote>
        </div>
    </section>

    {{-- Values --}}
    <section data-reveal>
        <div class="container-x py-20 lg:py-28">
            <x-ui.section-title lead="Four commitments that decide how we run every order — and why brands stay with us.">
                What we stand for.
            </x-ui.section-title>

            <div class="mt-14 grid gap-x-12 gap-y-10 sm:grid-cols-2">
                @foreach ($values as $value)
                    <div class="flex items-start gap-5 border-t border-line pt-8">
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-brand-tint text-brand">
                            <x-ui.icon :name="$value['icon']" :size="22" />
                        </span>
                        <div>
                            <h3 class="text-[1.1rem] font-semibold text-ink">{{ $value['title'] }}</h3>
                            <p class="mt-2 text-[0.98rem] leading-relaxed text-muted">{{ $value['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Where we are --}}
    <section class="bg-ink-band text-on-ink" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-center">
                <div class="lg:col-span-7">
                    <h2 class="font-display text-[clamp(1.8rem,3.2vw,2.6rem)] text-on-ink">Made in Dholpur, India.</h2>
                    <p class="mt-5 max-w-xl text-on-ink-muted leading-relaxed">
                        We manufacture from Dholpur, Rajasthan — close to fabric, close to skilled
                        hands, and connected to India’s export infrastructure. It means competitive
                        costs without the compromise, and a supply chain we can actually see.
                    </p>
                </div>
                <div class="lg:col-span-5">
                    <div class="flex items-center gap-3 text-on-ink">
                        <x-ui.icon name="pin" :size="22" class="text-on-ink-muted" />
                        <span class="text-lg">{{ $company['address']['locality'] }}, {{ $company['address']['region'] }}</span>
                    </div>
                    <p class="mt-2 text-on-ink-muted">India · Serving brands nationwide and for export</p>
                </div>
            </div>
        </div>
    </section>

    <x-ui.cta-band />
</x-layouts.app>
