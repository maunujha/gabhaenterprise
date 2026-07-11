@props(['knockout' => null])

{{-- GABHA ENTERPRISE wordmark. Adapts to light/dark via currentColor:
     the box + border + "ENTERPRISE" take currentColor; "GABHA" is knocked
     out to the surface behind it (--ge-knock, default white). --}}
<span class="ge-logo" @if ($knockout) style="--ge-knock: {{ $knockout }}" @endif>
    <span class="ge-logo__box">GABHA</span>
    <span class="ge-logo__word">ENTERPRISE</span>
    <span class="sr-only">Gabha Enterprise — home</span>
</span>
