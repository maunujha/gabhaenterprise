@php
    $company = config('company');
    $year = date('Y');
@endphp

<footer class="bg-ink-band text-on-ink">
    <div class="container-x py-16 lg:py-20">
        <div class="grid gap-12 lg:grid-cols-12">
            {{-- Brand + contact --}}
            <div class="lg:col-span-5">
                <a href="{{ route('home') }}" class="text-on-ink inline-block" aria-label="Gabha Enterprise — home">
                    <x-site.logo :on-dark="true" />
                </a>
                <p class="mt-6 max-w-sm text-[0.98rem] leading-relaxed text-on-ink-muted">
                    Private-label and OEM apparel manufacturing for brands that care how a
                    garment is made — from fabric to finished, folded, and packed.
                </p>

                <div class="mt-8 flex flex-col gap-3 text-[0.95rem]">
                    <a href="tel:{{ $company['phone_e164'] }}" class="inline-flex items-center gap-3 text-on-ink hover:text-white transition-colors">
                        <x-ui.icon name="phone" :size="18" class="text-on-ink-muted" /> {{ $company['phone'] }}
                    </a>
                    <a href="mailto:{{ $company['email'] }}" class="inline-flex items-center gap-3 text-on-ink hover:text-white transition-colors">
                        <x-ui.icon name="mail" :size="18" class="text-on-ink-muted" /> {{ $company['email'] }}
                    </a>
                    <p class="inline-flex items-start gap-3 text-on-ink-muted">
                        <x-ui.icon name="pin" :size="18" class="mt-0.5" />
                        <span>{{ $company['address']['locality'] }}, {{ $company['address']['region'] }}, India</span>
                    </p>
                </div>
            </div>

            {{-- Link columns --}}
            <div class="lg:col-span-7 grid grid-cols-2 sm:grid-cols-3 gap-8">
                <nav aria-label="Company">
                    <h2 class="text-[0.72rem] uppercase tracking-[0.18em] text-on-ink-muted">Company</h2>
                    <ul class="mt-4 space-y-3 text-[0.95rem]">
                        <li><a href="{{ route('about') }}" class="text-on-ink/90 hover:text-white transition-colors">About us</a></li>
                        <li><a href="{{ route('why') }}" class="text-on-ink/90 hover:text-white transition-colors">Why choose us</a></li>
                        <li><a href="{{ route('capabilities') }}" class="text-on-ink/90 hover:text-white transition-colors">Capabilities</a></li>
                        <li><a href="{{ route('contact') }}" class="text-on-ink/90 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </nav>

                <nav aria-label="Services">
                    <h2 class="text-[0.72rem] uppercase tracking-[0.18em] text-on-ink-muted">Services</h2>
                    <ul class="mt-4 space-y-3 text-[0.95rem]">
                        <li><a href="{{ route('services.show', config('service_pages.private-label.path')) }}" class="text-on-ink/90 hover:text-white transition-colors">Private label</a></li>
                        <li><a href="{{ route('services.show', config('service_pages.oem.path')) }}" class="text-on-ink/90 hover:text-white transition-colors">OEM manufacturing</a></li>
                        <li><a href="{{ route('services.show', config('service_pages.printing.path')) }}" class="text-on-ink/90 hover:text-white transition-colors">Printing</a></li>
                        <li><a href="{{ route('services') }}" class="text-on-ink/90 hover:text-white transition-colors">All services</a></li>
                    </ul>
                </nav>

                <nav aria-label="More">
                    <h2 class="text-[0.72rem] uppercase tracking-[0.18em] text-on-ink-muted">More</h2>
                    <ul class="mt-4 space-y-3 text-[0.95rem]">
                        <li><a href="{{ route('industries') }}" class="text-on-ink/90 hover:text-white transition-colors">Industries</a></li>
                        <li><a href="{{ route('faqs') }}" class="text-on-ink/90 hover:text-white transition-colors">FAQs</a></li>
                        <li>
                            <a href="{{ $company['links']['urbanflaky'] }}" rel="noopener" target="_blank"
                               class="inline-flex items-center gap-1 text-on-ink/90 hover:text-white transition-colors">
                                Urbanflaky <x-ui.icon name="arrow-up-right" :size="14" />
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <hr class="mt-14 mb-8 border-0 h-px bg-white/10">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-[0.85rem] text-on-ink-muted">
            <p>&copy; {{ $year }} {{ $company['legal_name'] }}. All rights reserved.</p>
            <p>Home of <a href="{{ $company['links']['urbanflaky'] }}" rel="noopener" target="_blank" class="text-on-ink hover:text-white underline underline-offset-4 decoration-white/30">Urbanflaky</a> · Dholpur, Rajasthan</p>
        </div>
    </div>
</footer>
