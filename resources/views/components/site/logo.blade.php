@props(['compact' => false])

{{-- Mark = a woven grid inside a rounded square (textile weave); inherits currentColor,
     so it adapts to light or dark backgrounds. --}}
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-2.5']) }}>
    <svg width="30" height="30" viewBox="0 0 32 32" fill="none" stroke="currentColor"
         stroke-width="1.7" stroke-linecap="round" aria-hidden="true" class="shrink-0">
        <rect x="4.5" y="4.5" width="23" height="23" rx="6.5" />
        <path d="M12 5.5v21M20 5.5v21M5.5 12h21M5.5 20h21" stroke-width="1.3"
              style="opacity:.55" />
    </svg>
    @unless ($compact)
        <span class="flex flex-col leading-none">
            <span class="font-semibold tracking-tight text-[0.98rem]">Gabha Enterprise</span>
            <span class="text-[0.62rem] uppercase tracking-[0.22em] opacity-55 mt-1">Apparel Manufacturing</span>
        </span>
    @endunless
    <span class="sr-only">Gabha Enterprise — home</span>
</span>
