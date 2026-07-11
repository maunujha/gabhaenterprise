@props(['onDark' => false])

{{-- GABHA ENTERPRISE wordmark. Colours come from two explicit vars so the
     knockout works in both contexts:
       light (header): dark box, white "GABHA", dark border + "ENTERPRISE"
       dark  (footer): light box, dark "GABHA", light border + "ENTERPRISE" --}}
<span class="ge-logo @if ($onDark) ge-logo--on-dark @endif">
    <span class="ge-logo__box">GABHA</span>
    <span class="ge-logo__word">ENTERPRISE</span>
    <span class="sr-only">Gabha Enterprise — home</span>
</span>
