@props([
    'title' => 'Let’s build your next collection.',
    'text' => 'Send us your tech pack, a reference sample, or just a sketch and target quantity. We’ll come back with a costing, a timeline, and a plan to sample it.',
    'label' => 'Start a project',
])

<section class="bg-ink-band text-on-ink">
    <div class="container-x py-20 lg:py-28">
        <div class="grid gap-10 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-7">
                <h2 class="font-display text-[clamp(2rem,4.2vw,3.25rem)] text-on-ink">{{ $title }}</h2>
            </div>
            <div class="lg:col-span-5">
                <p class="text-on-ink-muted leading-relaxed">{{ $text }}</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <x-ui.button :href="route('contact')" variant="on-ink" icon="arrow-right">{{ $label }}</x-ui.button>
                    <x-ui.button href="https://wa.me/{{ config('company.whatsapp') }}" variant="ghost"
                                 class="!text-on-ink !border-white/25 hover:!border-white" rel="noopener" target="_blank">
                        WhatsApp us
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
</section>
