<x-mail::message>
# New inquiry from {{ $inquiry->company ?: $inquiry->name }}

A new inquiry has been submitted through **{{ config('company.name') }}**.

<x-mail::panel>
**Name:** {{ $inquiry->name }}
@if ($inquiry->company)
**Company:** {{ $inquiry->company }}
@endif
**Email:** {{ $inquiry->email }}
@if ($inquiry->phone)
**Phone:** {{ $inquiry->phone }}
@endif
**Received:** {{ $inquiry->created_at->timezone(config('app.timezone'))->format('d M Y, g:i A') }} IST
</x-mail::panel>

**Message**

{{ $inquiry->message }}

<x-mail::button :url="'mailto:'.$inquiry->email">
Reply to {{ $inquiry->name }}
</x-mail::button>

Reference #{{ $inquiry->id }}

<x-slot:subcopy>
Reply directly to this email to respond — replies route to {{ $inquiry->email }}.
</x-slot:subcopy>
</x-mail::message>
