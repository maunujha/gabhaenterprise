@php
    $services = config('company.services');

    // Per-service detail points — kept here for editorial control.
    $details = [
        'private-label' => ['Manufacturing under your brand and labels', 'Your designs, patterns, and specifications', 'Neck labels, care labels, hang tags applied', 'Retail-ready finishing and packing'],
        'oem' => ['Production to your tech pack and measurements', 'Pattern engineering and grading', 'Construction and tolerances to spec', 'Pre-production samples for sign-off'],
        'bulk' => ['30 to 30,000+ pieces per style', 'Managed cutting and stitching lines', 'In-line and end-line quality checks', 'Consistent output across the full run'],
        'custom' => ['Development from sketches or reference samples', 'Pattern making and fit development', 'Trim and fabric sourcing to match', 'Iterative sampling until approved'],
        'fabric' => ['Heavyweight cotton, loopknit, fleece, blends', 'GSM, shrinkage and colourfastness testing', 'Sourcing matched to your price point', 'Lab-dip and shade approvals'],
        'printing' => ['Screen, DTG and puff printing', 'Colour matching to your reference', 'Wash-tested for crack and fade resistance', 'Placement checked panel by panel'],
        'embroidery' => ['Flat, 3D puff and appliqué embroidery', 'In-house digitising of logos and artwork', 'Repeatable results across large runs', 'Any placement — chest, sleeve, back'],
        'packaging' => ['Custom polybags, tags and care labels', 'Branded mailers and boxes', 'Folded, tagged and barcoded to spec', 'Retail-ready or direct-to-ship'],
        'brand-launch' => ['Tech-pack guidance for first-time founders', 'Low first-run minimums', 'Support from sample to first drop', 'A route from idea to sellable product'],
    ];
@endphp

<x-layouts.app
    title="Manufacturing Services"
    description="Full-service apparel manufacturing: private label, OEM, bulk production, custom garments, fabric sourcing, printing, embroidery, packaging and brand-launch support — all under one roof in India.">

    <x-ui.page-header
        eyebrow="Services"
        title="Everything it takes to make a garment — under one roof."
        intro="From the first metre of fabric to the last folded piece in a box, every stage of manufacturing runs with one team accountable for the result. No brokers, no handoffs, no diluted quality."
        :breadcrumbs="[['label' => 'Manufacturing Services', 'url' => route('services')]]">

        {{-- In-page jump links --}}
        <nav aria-label="Services" class="mt-10 flex flex-wrap gap-2">
            @foreach ($services as $service)
                <a href="#{{ $service['slug'] }}"
                   class="rounded-full border border-line bg-bg px-4 py-2 text-[0.85rem] text-ink-soft hover:border-ink transition-colors">
                    {{ $service['title'] }}
                </a>
            @endforeach
        </nav>
    </x-ui.page-header>

    <div class="container-x">
        @foreach ($services as $i => $service)
            <section id="{{ $service['slug'] }}" class="scroll-mt-28 grid gap-8 border-b border-line py-14 lg:grid-cols-12 lg:gap-12 lg:py-20" data-reveal>
                <div class="lg:col-span-4">
                    <div class="flex items-center gap-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-tint text-brand">
                            <x-ui.icon :name="$service['icon']" :size="24" />
                        </span>
                        <span class="font-display text-[1.5rem] text-line-strong">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <h2 class="mt-5 font-display text-[clamp(1.6rem,2.4vw,2.1rem)] text-ink">{{ $service['title'] }}</h2>
                </div>

                <div class="lg:col-span-8">
                    <p class="text-[1.15rem] leading-relaxed text-ink-soft measure">{{ $service['summary'] }}</p>
                    <ul class="mt-8 grid gap-x-8 gap-y-3 sm:grid-cols-2">
                        @foreach ($details[$service['slug']] as $point)
                            <li class="flex items-start gap-3 text-[0.98rem] text-ink-soft">
                                <x-ui.icon name="check" :size="20" class="mt-0.5 shrink-0 text-brand" />
                                <span>{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('services.show', config('service_pages.'.$service['slug'].'.path')) }}"
                       class="mt-8 inline-flex items-center gap-2 font-medium text-ink link-underline">
                        Explore {{ $service['title'] }}
                        <x-ui.icon name="arrow-right" :size="18" />
                    </a>
                </div>
            </section>
        @endforeach
    </div>

    <x-ui.cta-band
        title="Not sure which of these you need?"
        text="Tell us what you want to make and the quantity. We’ll tell you exactly which services it takes — and what it costs."
        label="Get a quote" />
</x-layouts.app>
