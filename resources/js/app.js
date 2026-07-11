/* Gabha Enterprise — minimal, dependency-free interactions. */

document.documentElement.classList.add('js');

/* Scroll reveal: content is visible by default; this only animates it in. */
function initReveal() {
    const items = document.querySelectorAll('[data-reveal]');
    if (!items.length) return;

    if (!('IntersectionObserver' in window)) {
        items.forEach((el) => el.classList.add('is-in'));
        return;
    }

    const io = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    obs.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.12 }
    );

    items.forEach((el) => io.observe(el));
}

/* Full-screen mobile navigation. */
function initNav() {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    if (!toggle || !panel) return;

    const setOpen = (open) => {
        toggle.setAttribute('aria-expanded', String(open));
        panel.dataset.open = String(open);
        document.body.style.overflow = open ? 'hidden' : '';
    };

    toggle.addEventListener('click', () =>
        setOpen(toggle.getAttribute('aria-expanded') !== 'true')
    );
    panel.querySelectorAll('a').forEach((a) =>
        a.addEventListener('click', () => setOpen(false))
    );
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') setOpen(false);
    });
}

/* Elevate the sticky header once the page scrolls. */
function initHeader() {
    const el = document.querySelector('[data-header]');
    if (!el) return;
    const onScroll = () => el.classList.toggle('is-scrolled', window.scrollY > 8);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
}

/* Lead-intent tracking: push dataLayer events on WhatsApp + call clicks so
   GTM/GA4 can record them as conversions. Delegated + capture phase so it
   fires before the link navigates away. Safe with or without GTM present. */
function initLeadTracking() {
    window.dataLayer = window.dataLayer || [];
    document.addEventListener(
        'click',
        function (e) {
            var a = e.target.closest && e.target.closest('a[href]');
            if (!a) return;
            var href = a.getAttribute('href') || '';
            if (href.indexOf('wa.me') !== -1 || href.indexOf('whatsapp.com') !== -1) {
                window.dataLayer.push({ event: 'whatsapp_click', link_url: href });
            } else if (href.lastIndexOf('tel:', 0) === 0) {
                window.dataLayer.push({ event: 'call_click', link_url: href });
            }
        },
        true
    );
}

function init() {
    initReveal();
    initNav();
    initHeader();
    initLeadTracking();
}

if (document.readyState !== 'loading') init();
else document.addEventListener('DOMContentLoaded', init);
