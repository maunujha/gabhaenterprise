@php
    $reasons = [
        ['icon' => 'sparkle', 'title' => 'We run our own brand', 'text' => 'Through Urbanflaky we sell to demanding customers every day. We manufacture your garments to the exact standard we hold our own to — because we know what a returning customer costs to earn.'],
        ['icon' => 'handshake', 'title' => 'Direct manufacturer, no middlemen', 'text' => 'You are talking to the factory, not a trading agent marking up someone else’s work. That means honest costs, faster answers, and no telephone game with your quality.'],
        ['icon' => 'shield', 'title' => 'Quality control at every stage', 'text' => 'Fabric testing, a sealed pre-production sample, in-line checks, and a final inspection. Problems are caught on our floor, not by your customers.'],
        ['icon' => 'rocket', 'title' => 'Low minimums, room to grow', 'text' => 'Start at 30 pieces per style and scale to tens of thousands with the same partner — no need to switch factories the moment you succeed.'],
        ['icon' => 'layers', 'title' => 'Full-service, under one roof', 'text' => 'Fabric, cutting, stitching, printing, embroidery, finishing, and packing in one place. One team owns the whole garment, so nothing falls through the gaps between vendors.'],
        ['icon' => 'clock', 'title' => 'Honest timelines and pricing', 'text' => 'We quote what things actually cost and take, then meet it. No surprise charges, no quietly slipping deadlines.'],
    ];

    $comparison = [
        ['point' => 'Who you talk to', 'broker' => 'A sales agent', 'us' => 'The people who make your garment'],
        ['point' => 'Quality accountability', 'broker' => 'Passed between vendors', 'us' => 'One team, start to finish'],
        ['point' => 'Minimum order', 'broker' => 'Often high', 'us' => 'From 30 pieces per style'],
        ['point' => 'Pricing', 'broker' => 'Marked up, opaque', 'us' => 'Direct and itemised'],
        ['point' => 'Scaling up', 'broker' => 'Switch suppliers', 'us' => 'Same partner, more capacity'],
    ];
@endphp

<x-layouts.app
    title="Why Choose Us"
    description="Why brands choose Gabha Enterprise: a direct manufacturer that runs its own brand, controls quality at every stage, offers low minimums, and keeps pricing and timelines honest."

    >
    <x-ui.page-header
        eyebrow="Why Us"
        title="The difference between a factory and a partner."
        intro="Anyone can stitch a t-shirt. The question is whether it comes back right, on time, at the price you agreed — order after order. Here is why brands keep choosing us."
        :breadcrumbs="[['label' => 'Why Choose Us', 'url' => route('why')]]" />

    {{-- Reasons --}}
    <section class="border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-28">
            <div class="grid gap-x-14 gap-y-12 sm:grid-cols-2">
                @foreach ($reasons as $i => $reason)
                    <div class="flex gap-6 border-t border-line pt-8">
                        <span class="font-display text-[1.6rem] leading-none text-brand shrink-0">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div>
                            <h2 class="text-[1.2rem] font-semibold text-ink">{{ $reason['title'] }}</h2>
                            <p class="mt-2.5 leading-relaxed text-muted">{{ $reason['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Comparison --}}
    <section class="bg-surface border-b border-line" data-reveal>
        <div class="container-x py-20 lg:py-24">
            <x-ui.section-title lead="Most brands have been burned by a broker at least once. This is what changes when you work with the factory directly.">
                Broker vs. direct manufacturer.
            </x-ui.section-title>

            <div class="mt-12 overflow-x-auto">
                <table class="w-full min-w-[40rem] border-collapse text-left">
                    <thead>
                        <tr class="text-[0.78rem] uppercase tracking-[0.14em]">
                            <th scope="col" class="py-4 pr-6 font-medium text-muted w-1/3"></th>
                            <th scope="col" class="py-4 pr-6 font-medium text-muted">Typical broker</th>
                            <th scope="col" class="py-4 pl-6 font-medium text-brand border-l border-line">Gabha Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comparison as $row)
                            <tr class="border-t border-line">
                                <th scope="row" class="py-4 pr-6 font-medium text-ink text-left align-top">{{ $row['point'] }}</th>
                                <td class="py-4 pr-6 text-muted align-top">{{ $row['broker'] }}</td>
                                <td class="py-4 pl-6 text-ink font-medium align-top border-l border-line">
                                    <span class="inline-flex items-start gap-2">
                                        <x-ui.icon name="check" :size="18" class="mt-0.5 shrink-0 text-brand" />
                                        {{ $row['us'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <x-ui.cta-band
        title="Work with the people who make it."
        text="No agents, no markup, no guessing who is responsible for your order. Start a conversation with the factory directly."
        label="Talk to us" />
</x-layouts.app>
