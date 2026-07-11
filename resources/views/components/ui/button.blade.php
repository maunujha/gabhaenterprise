@props([
    'href' => null,
    'variant' => 'primary', // primary | ink | ghost | on-ink
    'type' => 'button',
    'icon' => null,
])

@php
    $class = 'btn btn-'.$variant;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
        @if ($icon)
            <x-ui.icon :name="$icon" :size="18" />
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
        @if ($icon)
            <x-ui.icon :name="$icon" :size="18" />
        @endif
    </button>
@endif
