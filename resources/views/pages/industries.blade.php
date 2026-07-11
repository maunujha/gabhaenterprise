@php
    $industries = config('company.industries');

    // What we specifically offer each buyer type.
    $offers = [
        'Clothing Brands' => ['Consistent quality that protects your reputation', 'Capacity to scale without changing partner', 'Private-label finishing, your labels throughout'],
        'Startups' => ['Low first-run minimums from 30 pieces', 'Tech-pack and development guidance', 'A route from idea to your first sellable drop'],
        'Wholesalers' => ['Dependable, repeatable lead times', 'Consistent sizing across large runs', 'Pricing that works at volume'],
        'Retailers' => ['Private-label ranges for your shelves', 'Quality that holds up against name brands', 'Retail-ready folding, tagging and packaging'],
        'Exporters' => ['Export-grade finishing and documentation', 'Repeatable quality to an agreed AQL', 'Packaging and labelling for overseas markets'],
        'Corporate Buyers' => ['Uniforms, merch and premium branded apparel', 'One accountable manufacturer, one contact', 'Branding via print, embroidery and labels'],
    ];
@endphp

<x-layouts.app
    title="Industries We Serve"
    description="We manufacture apparel for clothing brands, startups, wholesalers, retailers, exporters and corporate buyers — premium heavyweight cotton clothing, private label and OEM, from India.">

    <x-ui.page-header
        eyebrow="Industries"
        title="Who we manufacture for."
        intro="Different buyers need different things from a factory. A startup needs low minimums and hand-holding; an exporter needs documentation and repeatable AQL. We are set up for all of them."
        :breadcrumbs="[['label' => 'Industries', 'url' => route('industries')]]" />

    <div class="container-x">
        @foreach ($industries as $i => $industry)
            <section class="grid gap-8 border-b border-line py-14 lg:grid-cols-12 lg:gap-12 lg:py-18" data-reveal>
                <div class="lg:col-span-5">
                    <div class="flex items-center gap-4">
                        <span class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-tint text-brand">
                            <x-ui.icon :name="$industry['icon']" :size="24" />
                        </span>
                        <span class="font-display text-[1.4rem] text-line-strong">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <h2 class="mt-5 font-display text-[clamp(1.6rem,2.6vw,2.2rem)] text-ink">{{ $industry['title'] }}</h2>
                    <p class="mt-4 text-[1.05rem] leading-relaxed text-muted measure">{{ $industry['summary'] }}</p>
                </div>
                <div class="lg:col-span-7 lg:pl-8 lg:border-l lg:border-line flex items-center">
                    <ul class="grid gap-4 w-full">
                        @foreach ($offers[$industry['title']] as $point)
                            <li class="flex items-start gap-3 text-[1.02rem] text-ink-soft">
                                <x-ui.icon name="check" :size="20" class="mt-1 shrink-0 text-brand" />
                                <span>{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endforeach
    </div>

    <x-ui.cta-band
        title="Whichever of these you are, the first step is the same."
        text="Tell us what you sell and what you want to make. We’ll show you how we’d manufacture it — and what it costs."
        label="Contact us" />
</x-layouts.app>
