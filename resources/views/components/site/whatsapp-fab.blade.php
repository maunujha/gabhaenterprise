@php
    $wa = 'https://wa.me/'.config('company.whatsapp').'?text='.rawurlencode(config('company.whatsapp_message'));
@endphp

<a href="{{ $wa }}" target="_blank" rel="noopener"
   class="wa-fab" aria-label="Chat with Gabha Enterprise on WhatsApp">
    <x-ui.icon name="whatsapp" :size="30" />
    <span class="wa-fab__label">Chat with us</span>
</a>
