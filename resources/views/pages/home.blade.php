@php
    $company = config('company');
    $services = $company['services'];
    $stats = $company['stats'];

    $process = [
        ['title' => 'Sample', 'text' => 'You send a tech pack, a reference garment, or a sketch. We develop the pattern, source the fabric, and stitch a sample for your approval.'],
        ['title' => 'Approve', 'text' => 'We refine fit, fabric, print, and trims until the sample is exactly right — and lock a costing and timeline before a single bulk unit is cut.'],
        ['title' => 'Produce', 'text' => 'Bulk cutting, stitching, printing, and embroidery run on managed lines with in-line checks that hold the approved standard at scale.'],
        ['title' => 'Deliver', 'text' => 'Every piece is finished, quality-checked, folded, tagged, and packed to your spec — ready for retail or to ship.'],
    ];
@endphp

<x-layouts.app
    title="Private Label & OEM Apparel Manufacturer"
    description="Gabha Enterprise is a private-label and OEM apparel manufacturer in Dholpur, India — premium heavyweight cotton clothing for brands, retailers and exporters. From fabric sourcing to finished, packed garments.">

    {{-- ===================== Hero ===================== --}}
    <section class="relative overflow-hidden">
        {{-- faint weave motif --}}
        <div aria-hidden="true" class="pointer-events-none absolute -right-24 -top-24 h-[34rem] w-[34rem] opacity-[0.05]">
            <svg viewBox="0 0 200 200" fill="none" stroke="currentColor" stroke-width="0.6" class="text-ink h-full w-full">
                @for ($i = 0; $i <= 200; $i += 12.5)
                    <line x1="{{ $i }}" y1="0" x2="{{ $i }}" y2="200" />
                    <line x1="0" y1="{{ $i }}" x2="200" y2="{{ $i }}" />
                @endfor
            </svg>
        </div>

        <div class="container-x pt-28 pb-16 lg:pt-36 lg:pb-24">
            <p class="text-[0.82rem] font-medium uppercase tracking-[0.22em] text-muted">
                Gabha Enterprise · Apparel Manufacturing
            </p>

            <h1 class="mt-6 font-display text-[clamp(2.6rem,6.2vw,5rem)] text-ink max-w-[16ch]">
                We make the apparel brands put <span class="italic">their name</span> on.
            </h1>

            <div class="mt-10 grid gap-12 lg:grid-cols-12 lg:items-end">
                <div class="lg:col-span-7">
                    <p class="text-[1.2rem] leading-relaxed text-ink-soft measure">
                        A private-label and OEM garment manufacturer in Dholpur, India —
                        producing premium heavyweight cotton apparel for clothing brands,
                        retailers, and exporters. You design the label; we engineer the garment,
                        from fabric to finished and packed.
                    </p>

                    <div class="mt-9 flex flex-wrap gap-3">
                        <x-ui.button :href="route('contact')" variant="primary" icon="arrow-right">Start a project</x-ui.button>
                        <x-ui.button :href="route('services')" variant="ghost">Explore our services</x-ui.button>
                    </div>
                </div>

                {{-- Editorial spec list (real facts, not a metric template) --}}
                <div class="lg:col-span-5">
                    <dl class="divide-y divide-line border-y border-line">
                        <div class="flex items-baseline justify-between gap-6 py-3.5">
                            <dt class="text-muted text-[0.95rem]">Fabric</dt>
                            <dd class="text-ink font-medium text-right">Heavyweight cotton, 180–240 GSM</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-6 py-3.5">
                            <dt class="text-muted text-[0.95rem]">Minimum order</dt>
                            <dd class="text-ink font-medium text-right">From 300 pieces / style</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-6 py-3.5">
                            <dt class="text-muted text-[0.95rem]">Sampling</dt>
                            <dd class="text-ink font-medium text-right">~15 days to first sample</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-6 py-3.5">
                            <dt class="text-muted text-[0.95rem]">Based in</dt>
                            <dd class="text-ink font-medium text-right">Dholpur, Rajasthan, India</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== Positioning + proof ===================== --}}
    <section class="border-t border-line bg-surface" data-reveal>
        <div class="container-x py-16 lg:py-20">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-center">
                <div class="lg:col-span-7">
                    <p class="font-display text-[clamp(1.5rem,2.6vw,2.1rem)] leading-snug text-ink max-w-2xl">
                        We are the factory floor behind labels you already know —
                        including our own brand, <span class="italic">Urbanflaky</span>. We build the
                        garment to the same standard, whether the name on it is ours or yours.
                    </p>
                </div>
                <div class="lg:col-span-5">
                    <dl class="grid grid-cols-2 gap-x-8 gap-y-8">
                        @foreach ($stats as $stat)
                            <div>
                                <dt class="font-display text-[clamp(1.9rem,3vw,2.5rem)] text-ink leading-none">{{ $stat['value'] }}</dt>
                                <dd class="mt-2 text-[0.9rem] text-muted leading-snug">{{ $stat['label'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== Services index ===================== --}}
    <section class="border-t border-line" data-reveal>
        <div class="container-x py-20 lg:py-28">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <x-ui.section-title lead="Nine capabilities, one accountable manufacturer — so your product never passes through a chain of middlemen.">
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

    {{-- ===================== Process (genuine sequence) ===================== --}}
    <section class="border-t border-line bg-surface" data-reveal>
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

    {{-- ===================== Standards (dark band) ===================== --}}
    <section class="bg-ink-band text-on-ink" data-reveal>
        <div class="container-x py-20 lg:py-28">
            <div class="grid gap-12 lg:grid-cols-12 lg:items-center">
                <div class="lg:col-span-6">
                    <h2 class="font-display text-[clamp(2rem,4vw,3rem)] text-on-ink max-w-xl">
                        Built to a standard, not to a price.
                    </h2>
                    <p class="mt-6 text-on-ink-muted leading-relaxed max-w-xl">
                        Cheap manufacturing shows — in a collar that curls after one wash, a print
                        that cracks, a size that drifts across a run. We build the opposite:
                        garments engineered to survive the wash test, the wear test, and your
                        customer’s expectations. That is what keeps brands re-ordering.
                    </p>
                    <div class="mt-9">
                        <x-ui.button :href="route('why')" variant="on-ink" icon="arrow-right">Why brands choose us</x-ui.button>
                    </div>
                </div>
                <div class="lg:col-span-6">
                    <ul class="grid gap-4 sm:grid-cols-2">
                        @foreach ([
                            ['icon' => 'shield', 'title' => 'Wash-tested durability', 'text' => 'Fabric checked for GSM, shrinkage, and colourfastness before it becomes a garment.'],
                            ['icon' => 'ruler', 'title' => 'Consistent sizing', 'text' => 'Graded patterns and in-line measurement so unit 30,000 fits like the sample.'],
                            ['icon' => 'handshake', 'title' => 'One point of contact', 'text' => 'No middlemen — you speak to the people who actually make your garment.'],
                            ['icon' => 'leaf', 'title' => 'Responsible making', 'text' => 'Efficient cutting, considered sourcing, and less waste on every run.'],
                        ] as $item)
                            <li class="rounded-xl border border-white/10 p-6">
                                <x-ui.icon :name="$item['icon']" :size="24" class="text-on-ink" />
                                <h3 class="mt-4 font-medium text-on-ink">{{ $item['title'] }}</h3>
                                <p class="mt-1.5 text-[0.9rem] leading-relaxed text-on-ink-muted">{{ $item['text'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== Industries preview ===================== --}}
    <section class="border-t border-line" data-reveal>
        <div class="container-x py-20 lg:py-28">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <x-ui.section-title lead="If you sell apparel, we can make it. We manufacture for six kinds of buyer — each with different priorities, all needing the same thing: garments that hold up.">
                    Who we manufacture for.
                </x-ui.section-title>
                <a href="{{ route('industries') }}" class="link-underline inline-flex items-center gap-2 text-ink shrink-0">
                    Industries we serve <x-ui.icon name="arrow-right" :size="18" />
                </a>
            </div>

            <ul class="mt-12 flex flex-wrap gap-3">
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
