@props(['name', 'size' => 24])

@php
    // Stroke-based line icons (24×24, currentColor). One place for all glyphs.
    $paths = [
        'arrow-right'   => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
        'arrow-up-right'=> '<path d="M7 17 17 7"/><path d="M8 7h9v9"/>',
        'check'         => '<path d="M20 6 9 17l-5-5"/>',
        'menu'          => '<path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/>',
        'close'         => '<path d="M18 6 6 18"/><path d="M6 6l12 12"/>',
        'mail'          => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'phone'         => '<path d="M4 5c0-1 1-2 2-2h2l2 5-2 1a12 12 0 0 0 6 6l1-2 5 2v2c0 1-1 2-2 2A16 16 0 0 1 4 5Z"/>',
        'whatsapp'      => '<path d="M12 3a9 9 0 0 0-7.7 13.6L3 21l4.6-1.2A9 9 0 1 0 12 3Z"/><path d="M8.5 8.5c0 4 3 7 7 7 .6 0 1.2-.5 1.2-1.1l-.2-1.4-2.1-.6-.9 1a5.5 5.5 0 0 1-2.4-2.4l1-.9-.6-2.1-1.4-.2c-.6 0-1.1.6-1.1 1.2Z"/>',
        'pin'           => '<path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/>',
        'tag'           => '<path d="M3 12V5a2 2 0 0 1 2-2h7l9 9-9 9-9-9Z"/><circle cx="8" cy="8" r="1.3"/>',
        'layers'        => '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>',
        'boxes'         => '<path d="M3 8 12 3l9 5v8l-9 5-9-5V8Z"/><path d="M3 8l9 5 9-5"/><path d="M12 13v8"/>',
        'scissors'      => '<circle cx="6" cy="6" r="2.5"/><circle cx="6" cy="18" r="2.5"/><path d="M8 8 20 20"/><path d="M8 16 20 4"/>',
        'spool'         => '<rect x="6" y="3" width="12" height="18" rx="2"/><path d="M6 8h12"/><path d="M6 16h12"/><path d="M12 8v8"/>',
        'printer'       => '<path d="M6 9V3h12v6"/><rect x="4" y="9" width="16" height="8" rx="2"/><path d="M8 21h8v-6H8z"/>',
        'hoop'          => '<circle cx="12" cy="12" r="8"/><path d="M12 8v8"/><path d="M8 12h8"/><circle cx="12" cy="12" r="2"/>',
        'package'       => '<path d="M12 3 4 7v10l8 4 8-4V7l-8-4Z"/><path d="M4 7l8 4 8-4"/><path d="M12 11v10"/><path d="m8 5 8 4"/>',
        'rocket'        => '<path d="M5 15c-1 1-1 4-1 4s3 0 4-1"/><path d="M9 15 4.5 13.5 8 10c3-4 7-6 11-6 0 4-2 8-6 11l-3.5 3.5L9 15Z"/><circle cx="14.5" cy="9.5" r="1.5"/>',
        'shield'        => '<path d="M12 3 5 6v6c0 4 3 7 7 9 4-2 7-5 7-9V6l-7-3Z"/><path d="m9 12 2 2 4-4"/>',
        'ruler'         => '<path d="M4 16 16 4l4 4L8 20l-4-4Z"/><path d="m8 8 2 2"/><path d="m11 11 2 2"/><path d="m14 8 2 2"/>',
        'clock'         => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'factory'       => '<path d="M3 21V9l6 4V9l6 4V4h4l0 17H3Z"/><path d="M7 17h.01M11 17h.01M15 17h.01"/>',
        'leaf'          => '<path d="M4 20C4 10 12 4 20 4c0 8-6 16-16 16Z"/><path d="M4 20c4-6 8-9 12-11"/>',
        'truck'         => '<path d="M3 6h11v9H3z"/><path d="M14 9h4l3 3v3h-7z"/><circle cx="7" cy="18" r="1.6"/><circle cx="17" cy="18" r="1.6"/>',
        'handshake'     => '<path d="m3 12 4-4 4 3 3-1 4 4"/><path d="m3 12 3 3 2-1"/><path d="M18 14v3M6 15v2"/>',
        'sparkle'       => '<path d="M12 3v6M12 15v6M3 12h6M15 12h6"/><path d="m7 7 3 3M14 14l3 3M17 7l-3 3M10 14l-3 3"/>',
        'globe'         => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3c3 3 3 15 0 18M12 3c-3 3-3 15 0 18"/>',
        'quote'         => '<path d="M7 7H4v6h4V9c0-1 .5-2 2-2V5C8 5 7 6 7 7Zm10 0h-3v6h4V9c0-1 .5-2 2-2V5c-2 0-3 1-3 2Z"/>',
    ];

    $glyph = $paths[$name] ?? '';
@endphp

<svg {{ $attributes->merge(['class' => 'inline-block shrink-0', 'aria-hidden' => 'true']) }}
     width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none"
     stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
    {!! $glyph !!}
</svg>
