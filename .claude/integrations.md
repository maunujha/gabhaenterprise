# integrations.md

The site deliberately has **few** external dependencies. All optional integrations are env-gated.

## Mail / SMTP (contact inquiries)

- **Hostinger SMTP** — `smtp.hostinger.com:587`, TLS, user `support@urbanflaky.in`.
- From: `support@urbanflaky.in` ("Gabha Enterprise"). `MAIL_PASSWORD` set only in server `.env`.
- Inquiry notifications go to `config('company.inquiry_recipient')` = `INQUIRY_MAIL_TO`
  (default `support@urbanflaky.in`). Same-domain internal delivery → not hit by external filtering.
- Flow: `POST /contact` → `InquiryController@store` persists `Inquiry`, then best-effort sends
  `App\Mail\InquiryReceived` (failures caught + `report()`ed, never lost). See `architecture.md`.
- Local dev: set `MAIL_MAILER=log` to write mail to `storage/logs` instead of sending.

## Google Analytics 4 / Tag Manager (opt-in)

- Set **`GTM_ID`** (preferred — nest GA4 inside GTM) **or** **`GA4_ID`** directly. Never both.
- Rendered in `components/layouts/app.blade.php` head + GTM `<noscript>` in body.
- Currently blank in `.env.example` — supply real IDs per environment.

## Google Search Console (opt-in)

- **`GOOGLE_SITE_VERIFICATION`** → verification `<meta>` in head. Submit `/sitemap.xml` in GSC.

## WhatsApp (primary CTA)

- Floating action button (`components/site/whatsapp-fab.blade.php`) + inline CTAs.
- Deep link: `https://wa.me/{whatsapp}?text={urlencoded whatsapp_message}` — both from
  `config/company.php` (`whatsapp = 917357291841`, `whatsapp_message`).

## Fonts

- **Self-hosted** WOFF2 in `public/fonts/` (Hanken Grotesk variable + Poppins/Newsreader).
  No Google Fonts / CDN requests. Critical faces preloaded in the layout head.

## Not integrated (by design)

No reCAPTCHA (uses honeypot + throttle instead), no Cloudflare-specific code, no Maps embed
(LocalBusiness schema carries geo), no payment/e-commerce, no auth/social login, no AWS/S3
(`AWS_*` present in `.env.example` but unused; `FILESYSTEM_DISK=local`).

> When adding a new external service, record it here and note the env keys + where it's wired.
