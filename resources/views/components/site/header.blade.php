@php
    $nav = [
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'Services', 'route' => 'services'],
        ['label' => 'Capabilities', 'route' => 'capabilities'],
        ['label' => 'Industries', 'route' => 'industries'],
        ['label' => 'Why Us', 'route' => 'why'],
        ['label' => 'FAQs', 'route' => 'faqs'],
    ];
@endphp

<header class="site-header" data-header>
    <div class="container-x flex items-center justify-between h-[4.75rem] gap-6">
        <a href="{{ route('home') }}" class="relative z-[65]" aria-label="Gabha Enterprise — home">
            <x-site.logo />
        </a>

        <nav class="hidden lg:flex items-center gap-8" aria-label="Primary">
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   @class([
                       'text-[0.92rem] transition-colors hover:text-ink',
                       'text-ink font-medium' => request()->routeIs($item['route']),
                       'text-muted' => ! request()->routeIs($item['route']),
                   ])
                   @if (request()->routeIs($item['route'])) aria-current="page" @endif>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden lg:block">
            <x-ui.button :href="route('contact')" variant="ink" icon="arrow-right">Start a project</x-ui.button>
        </div>

        {{-- Mobile toggle --}}
        <button type="button"
                class="group lg:hidden relative z-[65] inline-flex items-center justify-center w-11 h-11 -mr-2 text-ink"
                data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Toggle menu">
            <span class="sr-only">Menu</span>
            <x-ui.icon name="menu" :size="26" class="group-aria-[expanded=true]:hidden" />
            <x-ui.icon name="close" :size="26" class="hidden group-aria-[expanded=true]:block" />
        </button>
    </div>
</header>

{{-- Mobile full-screen navigation --}}
<div id="mobile-nav" class="nav-panel lg:hidden" data-nav-panel data-open="false">
    <div class="container-x flex flex-col h-full pt-24 pb-10">
        <nav class="flex flex-col gap-1" aria-label="Mobile">
            <a href="{{ route('home') }}" class="font-display text-4xl py-2 text-ink">Home</a>
            @foreach ($nav as $item)
                <a href="{{ route($item['route']) }}"
                   class="font-display text-4xl py-2 {{ request()->routeIs($item['route']) ? 'text-brand' : 'text-ink' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="mt-auto pt-8 border-t border-line space-y-4">
            <x-ui.button :href="route('contact')" variant="primary" icon="arrow-right" class="w-full">Start a project</x-ui.button>
            <div class="flex flex-col gap-2 text-sm text-muted">
                <a href="tel:{{ config('company.phone_e164') }}" class="inline-flex items-center gap-2">
                    <x-ui.icon name="phone" :size="16" /> {{ config('company.phone') }}
                </a>
                <a href="mailto:{{ config('company.email') }}" class="inline-flex items-center gap-2">
                    <x-ui.icon name="mail" :size="16" /> {{ config('company.email') }}
                </a>
            </div>
        </div>
    </div>
</div>
