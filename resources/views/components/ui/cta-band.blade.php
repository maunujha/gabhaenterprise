@props([
    'title' => 'Tell us what you want to make.',
    'text' => 'Send your product, fabric, and quantity — a photo or a few lines is enough. We reply within one business day with a costing and a plan to sample it.',
    'label' => 'Contact us',
])

@php
    $wa = 'https://wa.me/'.config('company.whatsapp').'?text='.rawurlencode(config('company.whatsapp_message'));
@endphp

<section class="bg-ink-band text-on-ink">
    <div class="container-x py-20 lg:py-28">
        <div class="grid gap-10 lg:grid-cols-12 lg:items-end">
            <div class="lg:col-span-7">
                <h2 class="font-display text-[clamp(2rem,4.2vw,3.25rem)] text-on-ink">{{ $title }}</h2>
            </div>
            <div class="lg:col-span-5">
                <p class="text-on-ink-muted leading-relaxed">{{ $text }}</p>
                <div class="mt-8 flex flex-col sm:flex-row flex-wrap gap-3">
                    <x-ui.button href="{{ $wa }}" variant="whatsapp" icon="whatsapp" rel="noopener" target="_blank" class="flex-1 sm:flex-none">Chat on WhatsApp</x-ui.button>
                    <x-ui.button href="tel:{{ config('company.phone_e164') }}" variant="on-ink" icon="phone" class="flex-1 sm:flex-none">Call us</x-ui.button>
                    <x-ui.button :href="route('contact')" variant="ghost"
                                 class="!text-on-ink !border-white/25 hover:!border-white flex-1 sm:flex-none">{{ $label }}</x-ui.button>
                </div>
            </div>
        </div>
    </div>
</section>
