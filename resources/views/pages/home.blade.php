@php
    $company = config('company');
    $services = $company['services'];

    $wa = 'https://wa.me/'.$company['whatsapp'].'?text='.rawurlencode($company['whatsapp_message']);

    $process = [
        ['title' => 'Sample', 'text' => 'Send a tech pack, a reference garment, or a sketch. We develop the pattern, source the fabric, and stitch a sample for your approval.'],
        ['title' => 'Approve', 'text' => 'We refine fit, fabric, print, and trims until it is exactly right — and lock a costing and timeline before a single bulk unit is cut.'],
        ['title' => 'Produce', 'text' => 'Bulk cutting, stitching, printing, and embroidery run on managed lines with in-line checks that hold the approved standard at scale.'],
        ['title' => 'Deliver', 'text' => 'Every piece is finished, quality-checked, folded, tagged, and packed to your spec — ready for retail or to ship.'],
    ];
@endphp

<x-layouts.app
    title="Private Label & OEM Apparel Manufacturer"
    description="Gabha Enterprise is a private-label and OEM apparel manufacturer in Dholpur, India — premium heavyweight cotton clothing for brands, retailers and exporters, from just 30 pieces per style. Chat on WhatsApp for a quote.">

    {{-- ============================ Hero ============================ --}}
    <section class="relative overflow-hidden">
        <div class="container-x pt-24 pb-14 lg:pt-32 lg:pb-24">
            <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-10">
                {{-- Copy + CTAs --}}
                <div class="lg:col-span-7">
                    <p class="inline-flex items-center gap-2 rounded-full border border-line bg-surface px-3.5 py-1.5 text-[0.8rem] font-medium text-ink-soft">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-brand"></span>
                        Manufacturing for 50+ apparel brands
                    </p>

                    <h1 class="mt-6 font-display text-[clamp(2.4rem,5.6vw,4.25rem)] text-ink max-w-[15ch]">
                        We make premium apparel for your brand.
                    </h1>

                    <p class="mt-6 text-[1.15rem] leading-relaxed text-ink-soft max-w-xl">
                        Private-label &amp; OEM clothing manufacturing in Dholpur, India — heavyweight
                        cotton tees, hoodies, polos and more. You design the label; we make it, finish
                        it, and pack it. <span class="text-ink font-medium">From just 30 pieces per style.</span>
                    </p>

                    {{-- Primary CTAs — WhatsApp + Call first (fastest lead paths) --}}
                    <div class="mt-9 flex flex-col sm:flex-row flex-wrap gap-3">
                        <x-ui.button href="{{ $wa }}" variant="whatsapp" icon="whatsapp" rel="noopener" target="_blank">
                            Get a quote on WhatsApp
                        </x-ui.button>
                        <x-ui.button href="tel:{{ $company['phone_e164'] }}" variant="ink" icon="phone">
                            Call {{ $company['phone'] }}
                        </x-ui.button>
                    </div>
                    <p class="mt-4 text-[0.92rem] text-muted">
                        Prefer to write? <a href="{{ route('contact') }}" class="link-underline text-ink">Send an inquiry</a> — we reply within one business day.
                    </p>
                </div>

                {{-- Hero image --}}
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-sm lg:max-w-none">
                        <div aria-hidden="true" class="absolute -right-3 -top-3 h-24 w-24 rounded-2xl bg-brand/10 lg:h-32 lg:w-32"></div>
                        <div class="relative overflow-hidden rounded-2xl bg-surface ring-1 ring-line">
                            <img
                                src="/images/garment-tee-800.webp"
                                srcset="/images/garment-tee-500.webp 500w, /images/garment-tee-800.webp 800w, /images/garment-tee-1200.webp 1200w"
                                sizes="(min-width: 1024px) 40vw, 90vw"
                                width="1000" height="1200" fetchpriority="high" decoding="async"
                                alt="Model wearing a Gabha Enterprise black heavyweight cotton t-shirt with dark denim"
                                class="w-full h-auto object-cover">
                        </div>
                        {{-- Floating trust badge --}}
                        <div class="absolute -bottom-4 -left-3 sm:-left-5 flex items-center gap-2.5 rounded-xl border border-line bg-bg px-4 py-3 shadow-[0_18px_40px_-20px_oklch(0.2_0.03_265/0.5)]">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-brand-tint text-brand"><x-ui.icon name="check" :size="18" /></span>
                            <span class="leading-tight">
                                <span class="block text-[0.95rem] font-semibold text-ink">From 30 pieces</span>
                                <span class="block text-[0.78rem] text-muted">low minimum / style</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== Trust / proof strip ==================== --}}
    <section class="border-y border-line bg-surface">
        <div class="container-x py-8">
            <dl class="grid grid-cols-2 gap-6 md:grid-cols-4">
                @foreach ([
                    ['v' => '30', 'l' => 'Piece minimum / style'],
                    ['v' => '180–240', 'l' => 'GSM heavyweight cotton'],
                    ['v' => '~15 days', 'l' => 'To your first sample'],
                    ['v' => '50+', 'l' => 'Brands manufactured for'],
                ] as $stat)
                    <div class="text-center md:text-left">
                        <dt class="font-display text-[clamp(1.5rem,2.4vw,2rem)] text-ink leading-none">{{ $stat['v'] }}</dt>
                        <dd class="mt-1.5 text-[0.85rem] text-muted leading-snug">{{ $stat['l'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>

    {{-- ==================== Positioning ==================== --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-16 lg:py-20">
            <p class="font-display text-[clamp(1.5rem,2.8vw,2.2rem)] leading-snug text-ink max-w-4xl">
                We are the factory floor behind labels you already know — including our own brand,
                Urbanflaky. We build your garments to the same standard, whether the name on the neck
                label is ours or yours.
            </p>
            <a href="{{ route('about') }}" class="mt-6 link-underline inline-flex items-center gap-2 text-ink">
                Our story <x-ui.icon name="arrow-right" :size="18" />
            </a>
        </div>
    </section>

    {{-- ==================== Services ==================== --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-28">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <x-ui.section-title lead="Nine capabilities under one roof — so your product never passes through a chain of middlemen.">
                    From fabric to finished garment.
                </x-ui.section-title>
                <a href="{{ route('services') }}" class="link-underline inline-flex items-center gap-2 text-ink shrink-0">
                    All services <x-ui.icon name="arrow-right" :size="18" />
                </a>
            </div>

            <div class="mt-14 grid gap-x-12 md:grid-cols-2">
                @foreach ($services as $i => $service)
                    <a href="{{ route('services') }}#{{ $service['slug'] }}"
                       class="group flex items-start gap-5 py-6 border-t border-line first:border-t-0 md:[&:nth-child(2)]:border-t-0 hover:bg-surface transition-colors">
                        <span class="mt-1 flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-brand-tint text-brand">
                            <x-ui.icon :name="$service['icon']" :size="22" />
                        </span>
                        <span class="min-w-0">
                            <span class="flex items-center gap-2 text-ink font-medium text-[1.05rem]">
                                {{ $service['title'] }}
                                <x-ui.icon name="arrow-up-right" :size="16" class="text-muted opacity-0 -translate-x-1 transition-all group-hover:opacity-100 group-hover:translate-x-0" />
                            </span>
                            <span class="mt-1.5 block text-[0.95rem] leading-relaxed text-muted">{{ $service['summary'] }}</span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== Standards (dark band + image) ==================== --}}
    <section class="bg-ink-band text-on-ink" data-reveal>
        <div class="container-x py-20 lg:py-28">
            <div class="grid gap-12 lg:grid-cols-12 lg:items-center">
                <div class="lg:col-span-7 order-2 lg:order-1">
                    <h2 class="font-display text-[clamp(2rem,4vw,3rem)] text-on-ink max-w-xl">
                        Built to a standard, not to a price.
                    </h2>
                    <p class="mt-6 text-on-ink-muted leading-relaxed max-w-xl">
                        Cheap manufacturing shows — a collar that curls after one wash, a print that
                        cracks, a size that drifts across a run. We build the opposite: garments
                        engineered to survive the wash test, the wear test, and your customer’s
                        expectations. That is what keeps brands re-ordering.
                    </p>
                    <ul class="mt-8 grid gap-4 sm:grid-cols-2 max-w-xl">
                        @foreach ([
                            ['icon' => 'shield', 'title' => 'Wash-tested durability'],
                            ['icon' => 'ruler', 'title' => 'Consistent sizing at scale'],
                            ['icon' => 'handshake', 'title' => 'One accountable contact'],
                            ['icon' => 'sparkle', 'title' => 'We run our own brand'],
                        ] as $item)
                            <li class="flex items-center gap-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/10"><x-ui.icon :name="$item['icon']" :size="18" class="text-on-ink" /></span>
                                <span class="text-[0.98rem] text-on-ink">{{ $item['title'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-9 flex flex-wrap gap-3">
                        <x-ui.button href="{{ $wa }}" variant="whatsapp" icon="whatsapp" rel="noopener" target="_blank">Chat on WhatsApp</x-ui.button>
                        <x-ui.button :href="route('why')" variant="on-ink" icon="arrow-right">Why brands choose us</x-ui.button>
                    </div>
                </div>
                <div class="lg:col-span-5 order-1 lg:order-2">
                    <div class="overflow-hidden rounded-2xl">
                        <img
                            src="/images/garment-polo-560.webp"
                            srcset="/images/garment-polo-560.webp 560w, /images/garment-polo-900.webp 900w"
                            sizes="(min-width: 1024px) 38vw, 90vw"
                            width="900" height="1080" loading="lazy" decoding="async"
                            alt="Model wearing a Gabha Enterprise teal pique cotton polo shirt"
                            class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== Process ==================== --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-28">
            <x-ui.section-title lead="A clear, sample-first process. Nothing goes to bulk until you have approved exactly what you are paying for.">
                How a project runs.
            </x-ui.section-title>

            <ol class="mt-14 grid gap-px overflow-hidden rounded-xl border border-line bg-line sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($process as $i => $step)
                    <li class="bg-bg p-7 lg:p-8">
                        <span class="font-display text-[1.6rem] text-brand">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-4 text-[1.15rem] font-semibold text-ink">{{ $step['title'] }}</h3>
                        <p class="mt-2.5 text-[0.95rem] leading-relaxed text-muted">{{ $step['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- ==================== Industries ==================== --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-16 lg:py-20">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <h2 class="font-display text-[clamp(1.5rem,2.6vw,2rem)] text-ink">Who we manufacture for.</h2>
                <a href="{{ route('industries') }}" class="link-underline inline-flex items-center gap-2 text-ink shrink-0">
                    Industries we serve <x-ui.icon name="arrow-right" :size="18" />
                </a>
            </div>
            <ul class="mt-8 flex flex-wrap gap-3">
                @foreach ($company['industries'] as $industry)
                    <li class="inline-flex items-center gap-2.5 rounded-full border border-line px-5 py-2.5 text-[0.95rem] text-ink">
                        <x-ui.icon :name="$industry['icon']" :size="18" class="text-brand" />
                        {{ $industry['title'] }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-ui.cta-band />
</x-layouts.app>
