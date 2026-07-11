@php
    $faqs = [
        ['q' => 'What is your minimum order quantity (MOQ)?', 'a' => 'Our standard minimum is just 30 pieces per style — low enough for new brands to test the market. Within that you can usually split across colours and sizes, and scale to tens of thousands with the same partner.'],
        ['q' => 'Can you manufacture under my own brand and labels?', 'a' => 'Yes. Private-label manufacturing is core to what we do. We produce finished garments with your neck labels, care labels, and hang tags — you own the design and the brand, we handle the making.'],
        ['q' => 'What products and fabrics do you make?', 'a' => 'We specialise in knitwear and cut-and-sew apparel: oversized and classic t-shirts, hoodies, sweatshirts, polos, and custom styles. Fabrics range from single jersey and heavyweight cotton (up to 240 GSM) to French terry and fleece. See the Capabilities page for the full specification.'],
        ['q' => 'How long does sampling and production take?', 'a' => 'A first sample typically takes around 15 days. Bulk production usually runs 30–45 days after sample approval, depending on quantity, fabric availability, and decoration. We confirm exact timelines before you commit.'],
        ['q' => 'I am a brand-new startup without a tech pack. Can you still help?', 'a' => 'Absolutely. Many of our clients start with just a sketch, a reference garment, or an idea. We help develop the pattern, choose the fabric, and guide you from first sample to a sellable first drop.'],
        ['q' => 'Do you offer printing and embroidery in-house?', 'a' => 'Yes — screen, DTG, and puff printing, plus flat, 3D, and appliqué embroidery, all digitised and tested in-house. Keeping decoration under our roof means better colour matching and durability.'],
        ['q' => 'Do you serve customers across India and for export?', 'a' => 'We manufacture for brands across India and produce export-grade garments with the finishing, labelling, and documentation overseas buyers require.'],
        ['q' => 'How does pricing work, and how do I get a quote?', 'a' => 'Pricing depends on your fabric, style, quantity, and decoration. Send those details through the contact form and we’ll come back with an itemised costing — no markup from middlemen, because there aren’t any.'],
        ['q' => 'Do you handle finishing and packaging?', 'a' => 'Yes. Garments are folded, tagged, barcoded, and packed to your specification in custom polybags, mailers, or retail packaging — ready to sell or ship.'],
    ];

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn ($f) => [
            '@type' => 'Question',
            'name' => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ], $faqs),
    ];
@endphp

<x-layouts.app
    title="FAQs"
    description="Answers to common questions about apparel manufacturing with Gabha Enterprise — minimum order quantities, private label, fabrics, lead times, sampling, printing, export and pricing.">

    <x-ui.page-header
        eyebrow="FAQs"
        title="Questions, answered plainly."
        intro="The things brands ask us most — about minimums, fabrics, timelines, and how working with a manufacturer directly actually works."
        :breadcrumbs="[['label' => 'FAQs', 'url' => route('faqs')]]" />

    <section data-reveal>
        <div class="container-x py-16 lg:py-24">
            <div class="mx-auto max-w-3xl divide-y divide-line border-y border-line">
                @foreach ($faqs as $faq)
                    <details class="group">
                        <summary class="flex cursor-pointer items-start justify-between gap-6 py-6 list-none [&::-webkit-details-marker]:hidden">
                            <span class="text-[1.1rem] font-medium text-ink">{{ $faq['q'] }}</span>
                            <span aria-hidden="true" class="mt-1 shrink-0 text-brand transition-transform duration-300 group-open:rotate-45">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                                    <path d="M12 5v14M5 12h14" />
                                </svg>
                            </span>
                        </summary>
                        <p class="pb-6 -mt-1 leading-relaxed text-muted measure">{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>

            <p class="mx-auto max-w-3xl mt-10 text-muted">
                Still have a question?
                <a href="{{ route('contact') }}" class="link-underline text-ink">Get in touch</a> — we reply within one business day.
            </p>
        </div>
    </section>

    <x-ui.cta-band />

    <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
</x-layouts.app>
