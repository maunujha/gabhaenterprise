@php
    $company = config('company');
    $inputClass = 'w-full rounded-lg border border-line bg-bg px-4 py-3 text-ink placeholder:text-muted/60 transition focus:border-brand focus:outline-none focus:ring-2 focus:ring-brand/20 aria-[invalid=true]:border-red-500 aria-[invalid=true]:ring-red-500/15';
@endphp

<x-layouts.app
    title="Contact Us"
    description="Get an apparel manufacturing quote from Gabha Enterprise. Tell us your product, fabric and quantity and we’ll reply within one business day with a costing and timeline.">

    <x-ui.page-header
        eyebrow="Contact"
        title="Tell us what you want to make."
        intro="Share your product, fabric, and quantity — a tech pack or reference photo helps, but a few lines is enough to start. We reply within one business day."
        :breadcrumbs="[['label' => 'Contact', 'url' => route('contact')]]" />

    <section>
        <div class="container-x py-16 lg:py-24">
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">
                {{-- Contact details --}}
                <aside class="lg:col-span-4">
                    <h2 class="font-display text-[1.6rem] text-ink">Talk to the factory directly.</h2>
                    <p class="mt-4 text-muted leading-relaxed">No agents in the middle. Reach us however suits you.</p>

                    <div class="mt-8 space-y-6">
                        <a href="tel:{{ $company['phone_e164'] }}" class="group flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-brand-tint text-brand"><x-ui.icon name="phone" :size="20" /></span>
                            <span>
                                <span class="block text-[0.8rem] uppercase tracking-[0.14em] text-muted">Call</span>
                                <span class="block text-ink font-medium group-hover:text-brand transition-colors">{{ $company['phone'] }}</span>
                            </span>
                        </a>
                        <a href="https://wa.me/{{ $company['whatsapp'] }}" target="_blank" rel="noopener" class="group flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-brand-tint text-brand"><x-ui.icon name="whatsapp" :size="20" /></span>
                            <span>
                                <span class="block text-[0.8rem] uppercase tracking-[0.14em] text-muted">WhatsApp</span>
                                <span class="block text-ink font-medium group-hover:text-brand transition-colors">Message us</span>
                            </span>
                        </a>
                        <a href="mailto:{{ $company['email'] }}" class="group flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-brand-tint text-brand"><x-ui.icon name="mail" :size="20" /></span>
                            <span>
                                <span class="block text-[0.8rem] uppercase tracking-[0.14em] text-muted">Email</span>
                                <span class="block text-ink font-medium group-hover:text-brand transition-colors break-all">{{ $company['email'] }}</span>
                            </span>
                        </a>
                        <div class="flex items-start gap-4">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-brand-tint text-brand"><x-ui.icon name="pin" :size="20" /></span>
                            <span>
                                <span class="block text-[0.8rem] uppercase tracking-[0.14em] text-muted">Visit</span>
                                <span class="block text-ink font-medium">{{ $company['address']['locality'] }}, {{ $company['address']['region'] }}, India</span>
                                <span class="block text-muted text-[0.9rem] mt-0.5">{{ $company['hours'] }}</span>
                            </span>
                        </div>
                    </div>
                </aside>

                {{-- Form --}}
                <div class="lg:col-span-8">
                    @if (session('inquiry_sent'))
                        <div class="mb-8 flex items-start gap-4 rounded-xl border border-brand/25 bg-brand-tint p-6" role="status">
                            <x-ui.icon name="check" :size="24" class="mt-0.5 shrink-0 text-brand" />
                            <div>
                                <h2 class="font-semibold text-ink">Thank you — your inquiry is in.</h2>
                                <p class="mt-1 text-[0.95rem] text-ink-soft">We’ve received your message and will reply within one business day. For anything urgent, call or WhatsApp us directly.</p>
                            </div>
                        </div>
                    @endif

                    @error('website')
                        <div class="mb-6 rounded-lg border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <form action="{{ route('inquiry.store') }}" method="POST" class="rounded-2xl border border-line p-6 sm:p-8" novalidate>
                        @csrf

                        {{-- Honeypot: hidden from humans, required-empty for bots. --}}
                        <div class="absolute h-0 w-0 overflow-hidden" aria-hidden="true">
                            <label for="website">Leave this field empty</label>
                            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off" value="{{ old('website') }}">
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <label for="name" class="block text-[0.9rem] font-medium text-ink mb-2">Name <span class="text-brand">*</span></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                                       @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                                       class="{{ $inputClass }}" placeholder="Your full name">
                                @error('name') <p id="name-error" class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-1">
                                <label for="company" class="block text-[0.9rem] font-medium text-ink mb-2">Company <span class="text-muted font-normal">(optional)</span></label>
                                <input type="text" id="company" name="company" value="{{ old('company') }}" autocomplete="organization"
                                       @error('company') aria-invalid="true" aria-describedby="company-error" @enderror
                                       class="{{ $inputClass }}" placeholder="Brand or company name">
                                @error('company') <p id="company-error" class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-1">
                                <label for="email" class="block text-[0.9rem] font-medium text-ink mb-2">Email <span class="text-brand">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                       @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                                       class="{{ $inputClass }}" placeholder="you@company.com">
                                @error('email') <p id="email-error" class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-1">
                                <label for="phone" class="block text-[0.9rem] font-medium text-ink mb-2">Phone <span class="text-muted font-normal">(optional)</span></label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                                       @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror
                                       class="{{ $inputClass }}" placeholder="+91 98765 43210">
                                @error('phone') <p id="phone-error" class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="message" class="block text-[0.9rem] font-medium text-ink mb-2">What do you want to make? <span class="text-brand">*</span></label>
                                <textarea id="message" name="message" rows="5" required
                                          @error('message') aria-invalid="true" aria-describedby="message-error" @enderror
                                          class="{{ $inputClass }} resize-y" placeholder="e.g. 500 oversized heavyweight cotton tees, 240 GSM, 3 colours, screen-printed front and back. Target price and timeline if you have one.">{{ old('message') }}</textarea>
                                @error('message') <p id="message-error" class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4">
                            <x-ui.button type="submit" variant="primary" icon="arrow-right">Send inquiry</x-ui.button>
                            <p class="text-[0.85rem] text-muted">We reply within one business day. Your details are never shared.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
