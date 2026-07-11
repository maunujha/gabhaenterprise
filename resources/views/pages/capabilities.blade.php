@php
    $products = [
        ['icon' => 'tag', 'title' => 'Oversized T-shirts', 'text' => 'Drop-shoulder, boxy, heavyweight — our signature.'],
        ['icon' => 'tag', 'title' => 'Classic & Regular Tees', 'text' => 'Crew and V-neck in a full range of weights.'],
        ['icon' => 'layers', 'title' => 'Hoodies & Sweatshirts', 'text' => 'French terry and fleece, pullover or zip.'],
        ['icon' => 'tag', 'title' => 'Polo Shirts', 'text' => 'Pique and jersey polos with clean plackets.'],
        ['icon' => 'layers', 'title' => 'Long-sleeve & Henleys', 'text' => 'Layering pieces in matched fabrics.'],
        ['icon' => 'scissors', 'title' => 'Custom Cut & Sew', 'text' => 'Anything you can spec — built from a pattern up.'],
    ];

    $fabrics = [
        ['name' => 'Single jersey cotton', 'gsm' => '140–200 GSM', 'use' => 'Regular & classic tees'],
        ['name' => 'Heavyweight cotton', 'gsm' => '180–240 GSM', 'use' => 'Oversized & premium tees'],
        ['name' => 'French terry / loopknit', 'gsm' => '240–320 GSM', 'use' => 'Sweatshirts & light hoodies'],
        ['name' => 'Fleece', 'gsm' => '300–360 GSM', 'use' => 'Heavy hoodies & winterwear'],
        ['name' => 'Cotton-poly blends', 'gsm' => '160–260 GSM', 'use' => 'Performance & value ranges'],
        ['name' => 'Pique', 'gsm' => '180–220 GSM', 'use' => 'Polo shirts'],
    ];

    $decoration = ['Screen printing', 'DTG (direct-to-garment)', 'Puff / HD print', 'Flat embroidery', '3D puff embroidery', 'Appliqué', 'Woven & printed labels', 'Rubber & metal patches'];

    $finishing = ['Custom neck labels', 'Care & size labels', 'Branded hang tags', 'Custom polybags', 'Folding & barcoding', 'Retail & mailer packaging'];

    $terms = [
        ['label' => 'Minimum order', 'value' => 'From 300 pieces per style'],
        ['label' => 'Size range', 'value' => 'XS – 3XL (extendable)'],
        ['label' => 'Sampling time', 'value' => '~15 days to first sample'],
        ['label' => 'Bulk lead time', 'value' => '30–45 days (typical, order-dependent)'],
        ['label' => 'Colours', 'value' => 'Multiple colourways per style'],
        ['label' => 'Markets', 'value' => 'Domestic & export'],
    ];

    $quality = [
        ['title' => 'Fabric testing', 'text' => 'GSM, shrinkage, and colourfastness checked before cutting.'],
        ['title' => 'Pre-production sample', 'text' => 'A sealed sample you approve before bulk begins.'],
        ['title' => 'In-line checks', 'text' => 'Measurements and construction verified during the run.'],
        ['title' => 'Final AQL check', 'text' => 'End-line inspection to an agreed acceptance standard.'],
    ];
@endphp

<x-layouts.app
    title="Our Capabilities"
    description="Apparel manufacturing capabilities: product types, fabrics and GSM ranges, printing and embroidery, finishing, quality control, MOQs and lead times for premium cotton clothing.">

    <x-ui.page-header
        eyebrow="Capabilities"
        title="The specification sheet."
        intro="What we make, what we make it from, and how we control quality — laid out plainly so you can see whether we fit your product before you send a single email."
        :breadcrumbs="[['label' => 'Capabilities', 'url' => route('capabilities')]]" />

    {{-- What we make --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <x-ui.section-title lead="Knitwear and cut-and-sew apparel across weights — with oversized heavyweight tees as our specialty.">
                What we make.
            </x-ui.section-title>
            <ul class="mt-12 grid gap-x-10 gap-y-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($products as $product)
                    <li class="border-t border-line pt-6">
                        <x-ui.icon :name="$product['icon']" :size="22" class="text-brand" />
                        <h3 class="mt-3 text-[1.05rem] font-semibold text-ink">{{ $product['title'] }}</h3>
                        <p class="mt-1.5 text-[0.95rem] leading-relaxed text-muted">{{ $product['text'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- Fabrics table --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <x-ui.section-title lead="We source and test fabric to your price point — not just to what is cheapest.">
                Fabrics &amp; weights.
            </x-ui.section-title>

            <div class="mt-12 overflow-x-auto">
                <table class="w-full min-w-[36rem] border-collapse text-left">
                    <thead>
                        <tr class="border-b border-line-strong text-[0.78rem] uppercase tracking-[0.14em] text-muted">
                            <th scope="col" class="py-3 pr-6 font-medium">Fabric</th>
                            <th scope="col" class="py-3 pr-6 font-medium">Typical weight</th>
                            <th scope="col" class="py-3 font-medium">Typical use</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fabrics as $fabric)
                            <tr class="border-b border-line">
                                <td class="py-4 pr-6 font-medium text-ink">{{ $fabric['name'] }}</td>
                                <td class="py-4 pr-6 text-ink-soft tabular-nums">{{ $fabric['gsm'] }}</td>
                                <td class="py-4 text-muted">{{ $fabric['use'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Decoration + finishing --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <div class="grid gap-14 lg:grid-cols-2">
                <div>
                    <h2 class="font-display text-[clamp(1.6rem,2.4vw,2.1rem)] text-ink">Decoration</h2>
                    <p class="mt-4 text-muted leading-relaxed measure">Print and embroidery digitised and tested in-house for durable, repeatable results.</p>
                    <ul class="mt-8 flex flex-wrap gap-2.5">
                        @foreach ($decoration as $item)
                            <li class="rounded-full border border-line px-4 py-2 text-[0.9rem] text-ink-soft">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h2 class="font-display text-[clamp(1.6rem,2.4vw,2.1rem)] text-ink">Finishing &amp; packaging</h2>
                    <p class="mt-4 text-muted leading-relaxed measure">Every detail that makes a garment look like it belongs on a shelf.</p>
                    <ul class="mt-8 flex flex-wrap gap-2.5">
                        @foreach ($finishing as $item)
                            <li class="rounded-full border border-line px-4 py-2 text-[0.9rem] text-ink-soft">{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Quality process --}}
    <section class="bg-surface border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <x-ui.section-title lead="Four checkpoints stand between your fabric and your finished order.">
                How we control quality.
            </x-ui.section-title>
            <ol class="mt-12 grid gap-px overflow-hidden rounded-xl border border-line bg-line sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($quality as $i => $step)
                    <li class="bg-surface p-7">
                        <span class="font-display text-[1.5rem] text-brand">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="mt-4 font-semibold text-ink">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-[0.92rem] leading-relaxed text-muted">{{ $step['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Terms --}}
    <section data-reveal>
        <div class="container-x py-20 lg:py-24">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="lg:col-span-4">
                    <x-ui.section-title as="h2">Order terms.</x-ui.section-title>
                    <p class="mt-4 text-muted leading-relaxed">Indicative figures — final terms depend on your style, fabric, and quantity.</p>
                </div>
                <div class="lg:col-span-8">
                    <dl class="divide-y divide-line border-y border-line">
                        @foreach ($terms as $term)
                            <div class="flex items-baseline justify-between gap-6 py-4">
                                <dt class="text-muted">{{ $term['label'] }}</dt>
                                <dd class="text-ink font-medium text-right">{{ $term['value'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <x-ui.cta-band
        title="Does your product fit our lines?"
        text="Send your style, fabric, and quantity. If it is in our range, we’ll come back with a costing and a sampling plan. If it isn’t, we’ll tell you that too."
        label="Ask about your product" />
</x-layouts.app>
