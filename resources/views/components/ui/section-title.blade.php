@props([
    'lead' => null,
    'align' => 'left', // left | center
    'as' => 'h2',
])

<div @class([
    'max-w-2xl' => $align === 'left',
    'max-w-2xl mx-auto text-center' => $align === 'center',
])>
    <{{ $as }} class="font-display text-[clamp(1.85rem,3.6vw,2.75rem)] text-ink">{{ $slot }}</{{ $as }}>
    @if ($lead)
        <p @class([
            'mt-5 text-lg leading-relaxed text-muted',
            'measure' => $align === 'left',
        ])>{{ $lead }}</p>
    @endif
</div>
