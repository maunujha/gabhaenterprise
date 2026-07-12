<?php

/*
|--------------------------------------------------------------------------
| Service page content
|--------------------------------------------------------------------------
|
| Long-form content for the dedicated service pages (hub-and-spoke under
| /manufacturing-services/{path}). Keyed by the same slug used in
| config('company.services') so icon/title/summary are never repeated here.
|
| Each entry:
|   path              → SEO-friendly URL segment (the {service} route param)
|   seo_title         → <title> (layout appends " — Gabha Enterprise")
|   meta_description  → unique meta description
|   eyebrow           → small kicker above the H1
|   h1                → page H1
|   lead              → intro sentence shown in the page header
|   intro[]           → opening paragraphs
|   process[]         → {title, body} ordered steps
|   benefits[]        → {title, body}
|   faqs[]            → {q, a}
|   related[]         → sibling service slugs to cross-link
|
| Typographic apostrophes/dashes are intentional (house style + avoids
| escaping inside single-quoted strings).
|
*/

return [

    'private-label' => [
        'path' => 'private-label-manufacturing',
        'seo_title' => 'Private Label Clothing Manufacturer',
        'meta_description' => 'Private label clothing manufacturer in India producing finished garments under your brand — your designs, our factory. Low 30-piece minimums, retail-ready. Get a quote.',
        'eyebrow' => 'Private Label',
        'h1' => 'Private Label Clothing Manufacturing',
        'lead' => 'Your brand on the label, our factory floor behind it. We produce finished, retail-ready garments under your name — you own the design and the customer, we own the making.',
        'intro' => [
            'Private label manufacturing is the most direct way to build a clothing brand without owning a factory. You bring the brand — the name, the designs, the identity your customers recognise — and we turn it into garments that carry your labels and nothing of ours. Every piece that leaves our floor looks, feels, and reads as if your own workshop made it.',
            'For a growing label, that arrangement removes the single biggest barrier to scaling: capital tied up in machines, floor space, and a payroll of tailors. Instead of running production, you run the brand. We handle cutting, stitching, decoration, finishing, and packing, and hand you back cartons of garments ready to photograph, list, and sell.',
            'We have manufactured this way for more than fifty brands, from first-time founders ordering thirty pieces to established labels moving tens of thousands of units a season. The process is the same at either end: your specification, our accountability, and one team you can call when you need an answer rather than a chain of suppliers pointing at each other.',
            'Because we also run our own label, Urbanflaky, we know what it costs a brand when a manufacturer cuts a corner. That is the standard we hold your production to — the one we would want for our own product.',
        ],
        'process' => [
            ['title' => 'Share your brand and design', 'body' => 'It starts with what you already have — a tech pack, a reference garment, a set of sketches, or simply a clear idea of the product. We review your designs, labels, and quality expectations, and flag anything that will affect cost, fit, or lead time before it becomes a problem rather than after.'],
            ['title' => 'Sampling and fit approval', 'body' => 'We develop a pre-production sample that matches your specification — fabric, fit, construction, and decoration. You review it in your hands, request changes, and we iterate until it is exactly the garment you want to sell. Nothing moves to bulk until you have signed the sample off.'],
            ['title' => 'Fabric and trims sourcing', 'body' => 'Once the sample is approved we source the bulk fabric and trims — neck tapes, care labels, hang tags, drawcords, and packaging — matched to the sample and tested for GSM, shrinkage, and colourfastness so the full run behaves like the piece you held.'],
            ['title' => 'Bulk cutting and stitching', 'body' => 'Your order moves onto managed cutting and stitching lines. Because the same team runs the whole floor, the standard set in your sample holds from the first unit to the last, whether that is a run of thirty pieces or three thousand.'],
            ['title' => 'Decoration and labelling', 'body' => 'Printing, embroidery, and your brand labels are applied in-house. Keeping decoration under our own roof means colours match your reference, placements stay consistent, and there is no third party to coordinate — or to blame — when a detail matters.'],
            ['title' => 'Quality check, finishing and dispatch', 'body' => 'Every garment is checked, trimmed, pressed, folded, tagged, and packed to your specification. We run in-line and end-line inspections, then dispatch retail-ready cartons — or ship direct to your customers if you sell online.'],
        ],
        'benefits' => [
            ['title' => 'Your brand, start to finish', 'body' => 'Nothing we make carries our name. Neck labels, care labels, hang tags, and packaging are all yours, so the customer only ever sees your brand — never ours.'],
            ['title' => 'Low minimums to start', 'body' => 'You can begin at thirty pieces per style — low enough to test a design in the market before committing capital to a large run, and high enough to price sensibly.'],
            ['title' => 'One accountable maker', 'body' => 'No brokers, no middlemen, no chain of subcontractors. One team owns the result, so when you need a change or an answer there is a single person to call.'],
            ['title' => 'Consistent quality at any volume', 'body' => 'The same lines and the same checks apply whether you order thirty pieces or thirty thousand, so your reorders match your first run instead of drifting.'],
            ['title' => 'A faster route to market', 'body' => 'With sampling in around fifteen days and decoration handled in-house, you spend less time coordinating suppliers and more time selling the product.'],
            ['title' => 'Room to grow', 'body' => 'As your label scales, production scales with it on the same floor, so you never have to re-qualify a new manufacturer in the middle of your growth.'],
        ],
        'faqs' => [
            ['q' => 'What is the minimum order for private label production?', 'a' => 'Our standard minimum is thirty pieces per style, and you can usually split that across a couple of colours and a full size range. It is deliberately low so a new brand can test a design without ordering hundreds of units up front, then scale the styles that sell.'],
            ['q' => 'Will the garments carry only my brand?', 'a' => 'Yes. Private label means the finished product carries your neck labels, care labels, and hang tags, and arrives in your packaging. Nothing identifies us as the manufacturer — to your customer, it is entirely your product.'],
            ['q' => 'Do I need a tech pack to get started?', 'a' => 'It helps, but it is not essential. If you have a tech pack we work to it precisely. If you only have sketches, a reference garment, or an idea, we can develop the pattern and specification with you through our brand launch support.'],
            ['q' => 'How long does a private label order take?', 'a' => 'A first sample typically takes around fifteen days. After you approve it, bulk production usually runs thirty to forty-five days depending on quantity, fabric availability, and decoration. We confirm exact timelines before you commit.'],
            ['q' => 'Can you match a garment I already sell?', 'a' => 'Often, yes. Send us the reference piece and we will assess the fabric, construction, and fit, then build a sample to match as closely as the materials allow. It is a common way for brands to move production to us without changing their product.'],
            ['q' => 'What fabrics can you use for private label garments?', 'a' => 'Mostly knitwear and cut-and-sew — single jersey, heavyweight cotton up to 240 GSM, French terry, fleece, and blends. If you have a specific fabric in mind we will source and test it; see our fabric sourcing service for the detail.'],
            ['q' => 'Can you produce a full collection, not just one style?', 'a' => 'Yes. Many brands run several styles with us in a single production cycle — tees, hoodies, and more — sharing fabric and decoration where it makes sense. Each style still meets the thirty-piece minimum, and we sequence them so the collection lands together rather than trickling in.'],
            ['q' => 'Do you keep my designs and labels confidential?', 'a' => 'Yes. Your designs, patterns, and brand materials are yours, and we treat them as confidential. We manufacture them for you and do not resell your styles or use your branding on other clients\' work — the whole point of private label is that the product is only ever yours.'],
        ],
        'related' => ['oem', 'bulk', 'brand-launch'],
    ],

    'oem' => [
        'path' => 'oem-clothing-manufacturing',
        'seo_title' => 'OEM Clothing Manufacturer',
        'meta_description' => 'OEM clothing manufacturer in India. Send a tech pack and we engineer the garment to spec — construction, grading and tolerances, with pre-production samples for sign-off.',
        'eyebrow' => 'OEM Manufacturing',
        'h1' => 'OEM Clothing Manufacturing',
        'lead' => 'Build to your specification. Send a tech pack and we engineer the garment — construction, grading, and tolerances made to spec, not to guesswork.',
        'intro' => [
            'OEM — original equipment manufacturing — is for brands and buyers who already know exactly what they want made. You supply the specification, and we produce to it: the fabric, the fit, the construction details, the tolerances, and the finishing all built to match the document you hand us, not our interpretation of it.',
            'The difference between OEM and a looser arrangement is discipline. A tech pack is a contract in drawings and measurements, and our job is to read it precisely — to grade the pattern across your size range, hold the seam allowances and stitch types you have called out, and flag any point where the spec and the material will fight each other before we cut a single metre.',
            'That precision is what lets a brand reorder with confidence. When the specification is the source of truth, the second run matches the first, the third matches the second, and quality stops depending on who happened to be on the line that day.',
            'We build OEM garments for established labels, wholesalers, and exporters who cannot afford variation between runs — and we treat your tech pack as the standard everything is measured against.',
        ],
        'process' => [
            ['title' => 'Tech pack review', 'body' => 'We read your specification in full — measurements, points of measure, construction notes, stitch types, trims, and tolerances — and come back with questions before we quote. Catching an ambiguity on paper is far cheaper than discovering it in a sample, and cheaper still than finding it in bulk.'],
            ['title' => 'Pattern engineering and grading', 'body' => 'We translate the spec into production patterns and grade them across your full size range, so a small and a triple-XL are built to the same logic. Grading done properly is invisible; done badly it shows up as garments that fit at one size and not the next.'],
            ['title' => 'Pre-production sampling', 'body' => 'We produce a sample built strictly to your tech pack and measure it against your points of measure. You receive it for sign-off, and we record any approved deviation so the bulk run is measured against a spec you have actually seen made.'],
            ['title' => 'Material sourcing to spec', 'body' => 'Fabric and trims are sourced to match the approved sample and tested for GSM, shrinkage, and colourfastness. Where your spec names a material we source to it; where it names a performance we source to that and confirm with you.'],
            ['title' => 'Controlled bulk production', 'body' => 'Cutting and stitching run on managed lines with the tech pack at the station, not in a drawer. In-line checks catch drift while it is still correctable, so tolerances hold across the whole quantity rather than only at the start.'],
            ['title' => 'Inspection and dispatch', 'body' => 'End-line inspection measures finished garments back against the specification before anything is packed. Approved units are finished, folded, and dispatched with the documentation an exporter or retailer needs.'],
        ],
        'benefits' => [
            ['title' => 'Made to your spec, not ours', 'body' => 'Your tech pack is the standard. We engineer to it and measure against it, so what you receive is what you specified rather than an approximation of it.'],
            ['title' => 'Repeatable across runs', 'body' => 'Because the specification drives production, reorders match your original — the reason brands move to OEM in the first place.'],
            ['title' => 'Proper grading', 'body' => 'Patterns are graded across your full size range so fit holds from your smallest size to your largest, not just the sample size.'],
            ['title' => 'Tolerances that are actually held', 'body' => 'We check finished garments back against your points of measure at end-line, so tolerances are verified, not assumed.'],
            ['title' => 'Export-grade output', 'body' => 'Finishing, labelling, and documentation are built for buyers shipping abroad as well as brands selling at home.'],
            ['title' => 'Fewer surprises', 'body' => 'We raise spec-versus-material conflicts before cutting, so problems are solved on paper instead of in a rejected bulk lot.'],
        ],
        'faqs' => [
            ['q' => 'What is the difference between OEM and private label?', 'a' => 'Private label is largely our making applied to your brand, often starting from a reference or a simple brief. OEM starts from your detailed technical specification and engineers the garment to it exactly. Many brands begin with private label and move to OEM as their specs mature.'],
            ['q' => 'Do you need a complete tech pack?', 'a' => 'A complete tech pack gives the most predictable result, but we can work from a partial spec plus a reference garment and help fill the gaps. The more precise your document, the more precisely we can hold to it across every run.'],
            ['q' => 'Can you match tolerances from my previous manufacturer?', 'a' => 'Usually, yes. Share your points of measure and, ideally, a reference garment, and we will build a sample to those tolerances for you to approve before bulk. That approved sample then becomes the benchmark for the production run.'],
            ['q' => 'What quantities do you handle for OEM?', 'a' => 'From thirty pieces per style up to tens of thousands. The specification and quality checks are the same at either scale; only the number of managed lines changes.'],
            ['q' => 'How do you keep quality consistent between reorders?', 'a' => 'The approved sample and your tech pack are kept as the reference, and finished garments are measured back against them at end-line every run. Consistency comes from measuring against a fixed standard rather than from memory.'],
            ['q' => 'Can you handle printing and embroidery to spec?', 'a' => 'Yes — screen, DTG, and puff printing and in-house embroidery are all decorated to your placement and colour references. Keeping decoration in-house is part of how we hold your spec end to end.'],
            ['q' => 'Can you work from my existing production patterns?', 'a' => 'Yes. If you already have graded patterns we can produce from them, or digitise and verify them against your tech pack first. Where a pattern and a specification disagree, we flag it and confirm with you rather than guessing which one to follow.'],
            ['q' => 'Do you provide pre-production samples before bulk?', 'a' => 'Always. A pre-production sample built to your tech pack is signed off before any bulk cutting begins. It is the point where the specification becomes a physical benchmark, and nothing scales until you have approved that piece.'],
        ],
        'related' => ['private-label', 'bulk', 'custom'],
    ],

    'bulk' => [
        'path' => 'bulk-apparel-manufacturing',
        'seo_title' => 'Bulk Apparel Manufacturing',
        'meta_description' => 'Bulk apparel manufacturing in India — consistent quality from 30 to 30,000+ pieces per style. Managed cutting and stitching lines with in-line and end-line quality checks.',
        'eyebrow' => 'Bulk Production',
        'h1' => 'Bulk Apparel Production',
        'lead' => 'Consistent quality at volume. Scaled cutting, stitching, and finishing that hold the same standard from unit thirty to unit thirty thousand.',
        'intro' => [
            'Bulk production is where a lot of manufacturers quietly lose the plot. A sample can be beautiful and a first hundred pieces can be clean, but the real test of a factory is whether unit thirty thousand looks like unit one. Holding a standard across a large run is a discipline, not a stroke of luck, and it is the discipline we build our lines around.',
            'The risk in volume is drift. Fabric arrives in different dye lots, operators change across shifts, and small tolerances compound into visible variation if nobody is measuring. We manage bulk by keeping the approved sample at the line, checking work while it is being made rather than only after, and pulling anything that wanders off standard before it becomes a carton of seconds.',
            'That is why brands, wholesalers, and exporters bring their volume to us — not because volume is impressive, but because consistent volume is hard, and it is what a growing business actually needs. A dependable second and third run is worth more than a perfect sample.',
            'From a thirty-piece test to a multi-thousand-piece production order, the same standard and the same checks apply. Only the number of lines changes.',
        ],
        'process' => [
            ['title' => 'Confirm the approved standard', 'body' => 'Every bulk run begins from a signed-off sample and specification. That approved piece is the standard the whole quantity is measured against, so there is never a debate about what "correct" looks like once production is under way.'],
            ['title' => 'Bulk fabric and dye-lot control', 'body' => 'We source fabric for the full quantity and manage dye lots so colour holds across the run. Where a large order spans lots, we check shade continuity rather than assuming two rolls of the same reference will match.'],
            ['title' => 'Cutting for consistency', 'body' => 'Cutting is planned so panels are consistent across the order and fabric is used efficiently. Consistent cutting is the quiet foundation of consistent fit — errors here multiply through every later stage.'],
            ['title' => 'Managed stitching lines', 'body' => 'Stitching runs on managed lines with the standard visible at the station. Because one team runs the floor, the construction set in your sample is the construction applied to the whole quantity, shift after shift.'],
            ['title' => 'In-line quality checks', 'body' => 'We inspect during production, not only at the end. Catching drift in-line means a problem is corrected across the next bundle instead of discovered in a finished carton, which is what keeps reject rates low at scale.'],
            ['title' => 'End-line inspection and packing', 'body' => 'Finished garments are inspected against the standard, then finished, folded, tagged, and packed to your specification. You receive cartons that are consistent unit to unit and ready to sell or ship.'],
        ],
        'benefits' => [
            ['title' => 'Consistency at scale', 'body' => 'The last piece matches the first because the approved standard travels with the order and is checked throughout — not left to chance.'],
            ['title' => 'One standard, any quantity', 'body' => 'Thirty pieces or thirty thousand, the checks are the same. You are not trading quality for volume.'],
            ['title' => 'Dependable reorders', 'body' => 'Your second and third runs match your first, which is what lets you build a catalogue customers can trust.'],
            ['title' => 'Low reject rates', 'body' => 'In-line inspection catches issues while they are still cheap to fix, so more of every run is sellable.'],
            ['title' => 'Efficient pricing at volume', 'body' => 'Planned cutting and managed lines keep waste down, and those savings show up in your unit cost as quantities grow.'],
            ['title' => 'Ready to sell or ship', 'body' => 'Bulk arrives finished, tagged, and packed to spec — retail-ready or export-ready, not a pile of loose garments to sort.'],
        ],
        'faqs' => [
            ['q' => 'What is your maximum production capacity?', 'a' => 'We run bulk from thirty pieces up to tens of thousands per style. Large orders are handled across additional managed lines while the same standard and checks apply, so scale does not dilute quality.'],
            ['q' => 'How do you keep colour consistent across a large run?', 'a' => 'We manage dye lots and check shade continuity where an order spans multiple rolls, rather than assuming two lots of the same reference will match. Any shade concern is raised with you before it reaches bulk.'],
            ['q' => 'What is your reject or defect rate?', 'a' => 'We keep it low by inspecting in-line as well as at end-line, so drift is corrected during production instead of discovered afterwards. Exact standards are agreed against your approved sample before the run begins.'],
            ['q' => 'How long does bulk production take?', 'a' => 'After sample approval, bulk typically runs thirty to forty-five days depending on quantity, fabric availability, and decoration. Larger orders take longer, and we confirm the timeline before you commit.'],
            ['q' => 'Can you scale up if my first order sells well?', 'a' => 'Yes — that is the point of manufacturing on one floor. Your reorder uses the same approved standard, so scaling up does not mean re-qualifying a new supplier or risking a different product.'],
            ['q' => 'Do you handle finishing and packing for bulk orders?', 'a' => 'Yes. Every bulk order is folded, tagged, barcoded if required, and packed to your specification in polybags, mailers, or retail packaging — see our packaging service for the detail.'],
            ['q' => 'Can I split a bulk order across several styles or colours?', 'a' => 'Yes. A production run can span multiple styles and colourways, each still meeting the thirty-piece minimum per style. We plan cutting and lines so a mixed order stays consistent within each style and lands together as one delivery.'],
            ['q' => 'How do you handle a large repeat order?', 'a' => 'A repeat runs against the same approved sample and specification as the original, so it matches rather than drifts. Because your standard is already recorded, repeats usually move faster than a first run of the same style.'],
            ['q' => 'Do you store fabric or finished stock between runs?', 'a' => 'Arrangements for holding fabric or finished goods between runs depend on the order and are agreed case by case. Tell us your reorder pattern and we will suggest a practical approach for your volume rather than a one-size answer.'],
        ],
        'related' => ['private-label', 'oem', 'packaging'],
    ],

    'custom' => [
        'path' => 'custom-garment-manufacturing',
        'seo_title' => 'Custom Garment Manufacturing',
        'meta_description' => 'Custom garment manufacturing in India — from a sketch or reference sample to a finished product. Pattern making, fit development, trim sourcing and iterative sampling.',
        'eyebrow' => 'Custom Manufacturing',
        'h1' => 'Custom Garment Manufacturing',
        'lead' => 'From a sketch or a reference sample to a garment that did not exist before. We develop patterns, source trims, and build the product with you.',
        'intro' => [
            'Custom garment manufacturing is for the product that is not in anyone else\'s catalogue — the silhouette you have drawn, the detail you have not seen done well, the idea that only exists as a reference and a description. Our job is to turn that into a real, repeatable garment without losing what made it worth making.',
            'That is a development process, not an order form. It moves from your idea to a pattern, from a pattern to a first sample, and from that sample through as many rounds as the design needs until the fit, the fabric, and the finish are right. Some styles land in two rounds; ambitious ones take more. We would rather take the extra round than sign off a garment you are not sure of.',
            'The advantage of developing custom work with a manufacturer rather than a middleman is that the people making your patterns are the people running your production. Nothing is lost in translation between a design studio and a factory floor, because it is the same floor.',
            'Whether you are refining an existing product or inventing a new one, we build it from the ground up and keep the pattern and specification so it can be reproduced exactly when it sells.',
        ],
        'process' => [
            ['title' => 'Start from your reference', 'body' => 'We begin with whatever you have — sketches, a reference garment, mood images, or a written description — and turn it into a shared understanding of the product: the fit you want, the fabric feel, the details that define it, and the price it needs to hit.'],
            ['title' => 'Pattern making', 'body' => 'We develop a first pattern from the reference, making the design decisions explicit — where the seams fall, how the garment is constructed, how it will move. A good pattern is where a custom idea becomes buildable rather than just describable.'],
            ['title' => 'Trim and fabric sourcing', 'body' => 'We source fabric and trims to match the intent — heavyweight cotton, fleece, blends, and the zippers, tapes, and hardware a custom design calls for — and test them so the sample behaves like the finished product.'],
            ['title' => 'First sample', 'body' => 'We build a first sample so you can judge the garment in your hands rather than on paper. Seeing it made almost always surfaces refinements that no drawing reveals — and that is exactly what the sample is for.'],
            ['title' => 'Iterative fit development', 'body' => 'We revise pattern, fit, fabric, or detail and re-sample as many times as the design needs. Each round is deliberate, and we keep a record of what changed so nothing that worked gets lost between versions.'],
            ['title' => 'Lock the spec for production', 'body' => 'Once you approve the final sample we fix the pattern and specification. That locked standard is what makes a custom garment reproducible, so the run — and every reorder — matches the piece you signed off.'],
        ],
        'benefits' => [
            ['title' => 'A product that is truly yours', 'body' => 'Custom development builds a garment to your idea, not a lightly modified stock block, so what you sell is genuinely distinct.'],
            ['title' => 'Makers who design', 'body' => 'Pattern making and production happen on the same floor, so intent is not lost between a studio and a factory.'],
            ['title' => 'As many rounds as it takes', 'body' => 'We iterate until the sample is right rather than rushing a design you are unsure of into bulk.'],
            ['title' => 'Reproducible once approved', 'body' => 'We lock the pattern and spec, so a custom garment can be reordered exactly instead of re-developed each time.'],
            ['title' => 'Honest feasibility', 'body' => 'We tell you early where a detail will fight the fabric or the budget, so you make design choices with the trade-offs in front of you.'],
            ['title' => 'Low first runs', 'body' => 'You can produce a new custom style from thirty pieces, so a fresh idea can be tested before it is scaled.'],
        ],
        'faqs' => [
            ['q' => 'I only have a sketch — can you still make it?', 'a' => 'Yes. A sketch, a reference garment, or even a clear description is enough to start. We develop the pattern and specification with you and prove the design through sampling before anything goes to production.'],
            ['q' => 'How many sample rounds are usual?', 'a' => 'Simple styles often settle in two rounds; more ambitious designs take more. We would rather take an extra round than sign off a garment you are not confident in, and we agree the approach with you up front.'],
            ['q' => 'Can you develop a garment I cannot find anywhere?', 'a' => 'That is exactly what custom manufacturing is for. If it can be built in knitwear or cut-and-sew, we will work out how — and tell you honestly if a particular detail is impractical at your target price.'],
            ['q' => 'Do I own the pattern you develop?', 'a' => 'The pattern and specification are developed for your product and used to make it. We keep them so your style can be reproduced consistently on reorders.'],
            ['q' => 'What is the minimum for a custom style?', 'a' => 'Thirty pieces per style once the design is approved, which lets you launch a new custom product without committing to a large first run.'],
            ['q' => 'How long does custom development take?', 'a' => 'It depends on the number of sample rounds, but a first sample is usually around fifteen days, with each revision adding time. We give you a realistic schedule once we understand the design.'],
            ['q' => 'What if my custom design turns out to be impractical to make?', 'a' => 'We tell you early. During pattern making and the first sample we surface anything that will fight the fabric, the budget, or the construction, and suggest a change that keeps the intent. It is far cheaper to solve a problem in development than to discover it in bulk.'],
            ['q' => 'Can you reproduce a custom style months later?', 'a' => 'Yes. Because we lock the pattern and specification once you approve the sample, a custom style can be reordered exactly rather than re-developed, so your product stays consistent from one season to the next.'],
        ],
        'related' => ['oem', 'private-label', 'fabric'],
    ],

    'fabric' => [
        'path' => 'fabric-sourcing',
        'seo_title' => 'Fabric Sourcing for Apparel',
        'meta_description' => 'Apparel fabric sourcing in India — heavyweight cotton, loopknit, fleece and blends, tested for GSM, shrinkage and colourfastness, and matched to your price point.',
        'eyebrow' => 'Fabric Sourcing',
        'h1' => 'Fabric Sourcing',
        'lead' => 'Heavyweight cotton, loopknit, fleece, and blends — sourced, tested for GSM and shrinkage, and matched to your price point.',
        'intro' => [
            'Fabric is where a garment is won or lost. You can cut and stitch flawlessly and still ship a disappointing product if the cloth is thin, shrinks, or fades — and no amount of finishing rescues the wrong base material. Sourcing well is not about finding the cheapest roll; it is about matching the right fabric to your product, your customer, and your price, then proving it will behave.',
            'We source across the knitwear and cut-and-sew range — single jersey, heavyweight cotton up to 240 GSM, French terry, loopknit, fleece, and cotton-rich blends — and we test what we source. GSM tells you the weight and hand you are actually getting, shrinkage tells you whether the garment will still fit after the first wash, and colourfastness tells you whether the colour survives real life. We check these before a fabric goes anywhere near your bulk.',
            'Matching fabric to price point is part of the craft. A brand chasing a premium feel and a brand chasing a sharp price need different cloth, and pretending otherwise leads to either a blown budget or a weak product. We put the honest options in front of you with the trade-offs attached.',
            'Whether you are producing with us or specifying fabric for your own run, we source to a standard you can rely on rather than to whatever happens to be cheap that week.',
        ],
        'process' => [
            ['title' => 'Understand the product', 'body' => 'We start with what the fabric has to do — the garment, the feel you want, the season, the customer, and the price it needs to hit. Sourcing without that context is guesswork; with it, we can narrow quickly to the cloth that actually fits your product.'],
            ['title' => 'Shortlist and hand-feel', 'body' => 'We shortlist fabrics that match the brief and get samples into your hands, because weight and hand-feel are decided by touch, not by a spec sheet. You compare real options rather than descriptions.'],
            ['title' => 'Lab-dip and shade approval', 'body' => 'For colour, we run lab-dips and shade approvals so the production colour is one you have actually seen and signed off, not an approximation of a reference on a screen.'],
            ['title' => 'GSM and shrinkage testing', 'body' => 'We test GSM to confirm the weight you are paying for, and shrinkage so the garment still fits after washing. A fabric that fails these quietly ruins fit and repeat sales, so we catch it before bulk.'],
            ['title' => 'Colourfastness and quality checks', 'body' => 'We check colourfastness to washing and rubbing so colours hold in real use. Where a product will be exported or heavily worn, we test to the standard that use demands.'],
            ['title' => 'Secure the bulk', 'body' => 'Once a fabric is approved, we secure the quantity for your run and manage dye lots for consistency, so the cloth in bulk matches the swatch you signed off.'],
        ],
        'benefits' => [
            ['title' => 'The right cloth, not the cheapest', 'body' => 'We match fabric to your product and price rather than defaulting to whatever is cheap, so the base material actually supports your brand.'],
            ['title' => 'Tested before bulk', 'body' => 'GSM, shrinkage, and colourfastness are checked up front, so fabric problems are caught on a swatch, not in a shipment.'],
            ['title' => 'Real hand-feel decisions', 'body' => 'You judge shortlisted fabrics by touch, because weight and feel cannot be decided reliably from a description.'],
            ['title' => 'Colour you have approved', 'body' => 'Lab-dips and shade approvals mean the production colour is one you have seen and signed off, not a surprise.'],
            ['title' => 'Price-point matching', 'body' => 'We put honest fabric options against your target cost, so you choose with the trade-offs visible instead of hidden.'],
            ['title' => 'Consistent bulk', 'body' => 'Dye-lot management keeps colour and weight consistent across the quantity you order.'],
        ],
        'faqs' => [
            ['q' => 'What fabrics do you source?', 'a' => 'Mainly knitwear and cut-and-sew materials — single jersey, heavyweight cotton up to 240 GSM, French terry, loopknit, fleece, and cotton-rich blends. If you need something specific, tell us the product and we will source to it.'],
            ['q' => 'Can you match a fabric from a garment I already have?', 'a' => 'Usually, yes. Send the reference garment and we will assess its weight, composition, and hand, then source a fabric that matches as closely as the market allows and prove it with a sample.'],
            ['q' => 'How do you test fabric quality?', 'a' => 'We check GSM for weight, shrinkage for fit after washing, and colourfastness for how colour holds in wash and wear. These tests happen before bulk so problems are caught on a swatch rather than in your order.'],
            ['q' => 'Can I hit a specific price point?', 'a' => 'Often, yes — within the limits of what the cloth can do. We show you honest options against your target cost so you can trade feel, weight, and composition against price with the consequences in view.'],
            ['q' => 'Do you source fabric only, or with production?', 'a' => 'Both. Sourcing is part of full production with us, and we can also source and supply fabric for your own run. Either way it is tested to the same standard.'],
            ['q' => 'What is heavyweight cotton, and why does GSM matter?', 'a' => 'GSM is grams per square metre — the fabric\'s weight. Heavyweight cotton, roughly 180 GSM and above up to 240 GSM, gives the structured, substantial feel premium tees and hoodies are known for. GSM is the number that most honestly describes what you are getting.'],
            ['q' => 'Can you source sustainable or organic fabrics?', 'a' => 'We can source to specific fabric requirements where they are available in the market, and we tell you honestly about the cost and lead-time implications. Share the standard you need and we will source and test to it rather than promise it blind.'],
            ['q' => 'What happens if a fabric fails testing?', 'a' => 'It does not go into your bulk. If a fabric fails on GSM, shrinkage, or colourfastness we return to sourcing and find one that meets the standard, so a testing failure is caught on a swatch rather than in your finished order.'],
        ],
        'related' => ['custom', 'private-label', 'oem'],
    ],

    'printing' => [
        'path' => 'printing',
        'seo_title' => 'Garment Printing — Screen, DTG & Puff',
        'meta_description' => 'In-house garment printing in India — screen, DTG and puff printing, colour matched to your reference and wash-tested for crack and fade resistance. Checked panel by panel.',
        'eyebrow' => 'Printing',
        'h1' => 'Garment Printing',
        'lead' => 'Screen, DTG, and puff printing with wash-tested durability. Colour matched to your reference and checked panel by panel.',
        'intro' => [
            'A print is the first thing a customer sees and the first thing that fails if it is done badly. A logo that cracks after three washes or a colour that drifts from the reference does more damage to a brand than no print at all. We keep printing in-house precisely because it is too important to hand off — the people printing your garments answer to the same standard as the people making them.',
            'Different artwork wants different methods. Screen printing gives durable, vivid results and is efficient for bold designs at volume. DTG — direct-to-garment — handles detailed, full-colour artwork and photographic work without the setup of screens. Puff printing raises the design for a tactile, dimensional finish. Choosing the right method for the job is half of getting a good print, and we help you choose rather than forcing your artwork through whatever we happen to run.',
            'Whatever the method, we colour-match to your reference, wash-test for crack and fade resistance, and check placement panel by panel so a run is consistent rather than approximately right. A print you can wash is a print you can build a brand on.',
            'Because decoration sits on the same floor as production, there is no coordinating between a factory and an outside printer, and no one to blame when a detail slips — the result is ours to get right.',
        ],
        'process' => [
            ['title' => 'Artwork and method review', 'body' => 'We review your artwork and recommend the method that suits it — screen for bold, high-volume designs, DTG for detailed or full-colour work, puff for a raised finish. Matching method to artwork is the decision that most affects how the final print looks and lasts.'],
            ['title' => 'Colour matching', 'body' => 'We match ink colours to your reference so the print on the garment is the colour you specified, not a near-enough version of it. Colour is where brands are recognised, and we treat it as a specification rather than a suggestion.'],
            ['title' => 'Strike-off and approval', 'body' => 'We produce a print strike-off on the actual fabric for you to approve. Ink behaves differently on different cloth, so proving the print on your real garment — not a swatch of something else — is what avoids surprises in bulk.'],
            ['title' => 'Wash testing', 'body' => 'We wash-test approved prints for crack and fade resistance, because durability is the whole point. A print that looks perfect off the press and fails in the wash is a failed print, and we would rather find that in testing than you find it in returns.'],
            ['title' => 'Production printing', 'body' => 'We print the run to the approved strike-off, holding colour and placement consistent from the first garment to the last. Consistency across a run is what separates a professional print from a promotional one.'],
            ['title' => 'Panel-by-panel checks', 'body' => 'Prints are checked panel by panel through the run so placement and quality stay consistent. Anything off-standard is caught and corrected rather than packed and shipped.'],
        ],
        'benefits' => [
            ['title' => 'In-house, not outsourced', 'body' => 'Printing sits on the same floor as production, so colour, placement, and timing are controlled directly instead of coordinated across suppliers.'],
            ['title' => 'The right method for the artwork', 'body' => 'Screen, DTG, or puff — we match the technique to your design rather than forcing every job through one process.'],
            ['title' => 'Wash-tested durability', 'body' => 'Prints are tested for crack and fade resistance, so they survive real washing rather than only looking good off the press.'],
            ['title' => 'True colour matching', 'body' => 'We match to your reference and prove it on your actual fabric, so brand colours stay recognisable.'],
            ['title' => 'Consistent across the run', 'body' => 'Panel-by-panel checks keep placement and quality even from the first garment to the last.'],
            ['title' => 'One accountable team', 'body' => 'With decoration in-house there is no printer to blame and no handoff to manage — the result is ours to deliver.'],
        ],
        'faqs' => [
            ['q' => 'Which printing method should I use?', 'a' => 'It depends on the artwork. Screen printing suits bold designs and larger runs, DTG suits detailed or full-colour and photographic work, and puff gives a raised, tactile finish. Send your artwork and we will recommend the method that will look and last best.'],
            ['q' => 'Will the print survive washing?', 'a' => 'That is what we wash-test for. Approved prints are checked for crack and fade resistance before a run, because a print that fails in the wash is a failed print regardless of how it looks off the press.'],
            ['q' => 'Can you match my exact brand colours?', 'a' => 'Yes. We colour-match to your reference and prove it with a strike-off on your actual fabric, since ink behaves differently on different cloth. You approve the colour on the real garment before bulk.'],
            ['q' => 'Is there a minimum for printed garments?', 'a' => 'Printing runs with our standard thirty-piece minimum per style. Screen printing becomes more cost-efficient as quantities rise because of the setup involved, while DTG has no screen setup and suits smaller or highly detailed runs.'],
            ['q' => 'Can you print designs I provide?', 'a' => 'Yes — send print-ready artwork and we will handle colour matching, strike-off, and production. If your files need preparing for print we can advise on what we need to get the best result.'],
            ['q' => 'Do you print and embroider on the same garment?', 'a' => 'Yes. Print and embroidery are both in-house, so a garment can carry a printed graphic and an embroidered logo, decorated and checked under one roof — see our embroidery service for the detail.'],
            ['q' => 'Can you print oversized or all-over designs?', 'a' => 'Large front, back, and sleeve prints are standard; genuine all-over prints depend on the technique and the garment and are assessed case by case. Send the artwork and placement and we will tell you what the method can hold cleanly.'],
            ['q' => 'Do print colours look the same on light and dark garments?', 'a' => 'Ink reads differently on light and dark fabric, which is why we prove the print with a strike-off on your actual garment colour. You approve the real result, and where needed we adjust — an underbase on dark fabric, for instance — to keep the colour true.'],
        ],
        'related' => ['embroidery', 'private-label', 'bulk'],
    ],

    'embroidery' => [
        'path' => 'embroidery',
        'seo_title' => 'Garment Embroidery Services',
        'meta_description' => 'In-house garment embroidery in India — flat, 3D puff and appliqué, digitised in-house for clean, repeatable logos and artwork on any placement. Consistent across large runs.',
        'eyebrow' => 'Embroidery',
        'h1' => 'Embroidery',
        'lead' => 'Flat, 3D puff, and appliqué embroidery, digitised in-house for clean, repeatable logos on any placement.',
        'intro' => [
            'Embroidery reads as quality. A crisp, well-registered stitch on a chest, a sleeve, or a cap signals a garment that was made with care, which is exactly why it fails so visibly when it is done badly — puckered fabric, a logo that has lost its shape, letters that have closed up. Getting embroidery right starts long before the needle, in how the design is digitised, and that is a step we keep in-house rather than trust to a file someone else prepared.',
            'Digitising is the craft of turning artwork into stitch instructions — the path, density, and sequence the machine follows. Done well it is invisible and the logo simply looks right; done poorly it distorts small text, puckers light fabric, and looks different every time it runs. Because we digitise in-house, we tune each design to the fabric and placement it will actually sit on, which is what makes the result both clean and repeatable.',
            'We work in flat embroidery for standard logos and lettering, 3D puff for a raised, dimensional look, and appliqué for layered fabric designs. Whatever the technique, the aim is a stitch that holds its shape from the first garment to the last, on whichever placement your design calls for.',
            'With embroidery in-house alongside printing and production, a garment can be decorated, checked, and finished under one roof, on one schedule, to one standard.',
        ],
        'process' => [
            ['title' => 'Artwork and placement review', 'body' => 'We review your logo or artwork and the placement you want — chest, sleeve, back, or cap — and flag anything that will not translate cleanly to stitch, such as very small text or fine detail, before we digitise rather than after it disappoints.'],
            ['title' => 'In-house digitising', 'body' => 'We digitise the design into stitch instructions tuned to the fabric and placement, controlling path, density, and sequence. This is the step that decides whether embroidery looks sharp and sits flat, and keeping it in-house is how we control the result.'],
            ['title' => 'Sample sew-out', 'body' => 'We sew a sample of the digitised design on your actual fabric so you can approve it in the round — shape, size, colour, and hand. Seeing it stitched on the real material is the only reliable way to judge it.'],
            ['title' => 'Refine and approve', 'body' => 'We adjust the digitising if the sew-out needs it — tightening small text, easing density on lighter fabric — and re-sew until the logo is clean. The approved sew-out becomes the standard for the run.'],
            ['title' => 'Production embroidery', 'body' => 'We embroider the run to the approved sew-out, holding registration and placement consistent across the whole quantity. Repeatability is the point — every garment should carry the same logo, not a variation of it.'],
            ['title' => 'Quality checks', 'body' => 'Embroidered garments are checked for registration, tension, and finish. Anything with puckering or a misplaced stitch is pulled rather than packed, so what ships matches what you approved.'],
        ],
        'benefits' => [
            ['title' => 'Digitised in-house', 'body' => 'We control the digitising ourselves, tuning each design to its fabric and placement — the step that most determines whether embroidery looks sharp.'],
            ['title' => 'Clean on any placement', 'body' => 'Chest, sleeve, back, or cap, we set the design up for where it will actually sit rather than applying one file everywhere.'],
            ['title' => 'Repeatable across runs', 'body' => 'The approved sew-out is the standard, so every garment in the run — and every reorder — carries the same logo.'],
            ['title' => 'The right technique', 'body' => 'Flat, 3D puff, or appliqué, matched to the look you want rather than the one method we happen to run.'],
            ['title' => 'Proven on your fabric', 'body' => 'A sample sew-out on your real material means you approve the actual result, not a rendering of it.'],
            ['title' => 'One roof with print and production', 'body' => 'Embroidery, printing, and making share a floor, so decoration is on one schedule and one standard.'],
        ],
        'faqs' => [
            ['q' => 'What types of embroidery do you offer?', 'a' => 'Flat embroidery for standard logos and lettering, 3D puff for a raised dimensional look, and appliqué for layered fabric designs. We recommend the technique that suits your artwork and the finish you want.'],
            ['q' => 'Do you digitise logos in-house?', 'a' => 'Yes, and it matters. Digitising turns your artwork into stitch instructions, and doing it in-house lets us tune each design to the fabric and placement so it sits flat and stays sharp — rather than running a generic file.'],
            ['q' => 'Will my small text embroider cleanly?', 'a' => 'Very small text and fine detail are the usual challenge. We flag it during artwork review and adjust the digitising to keep letters open, and if something genuinely will not read at size we tell you honestly and suggest an alternative.'],
            ['q' => 'Can you embroider caps and sleeves, not just chests?', 'a' => 'Yes — chest, sleeve, back, and caps are all standard placements. We set the digitising up for the specific placement, since a design that works on a flat chest may need adjusting for a curved cap.'],
            ['q' => 'Is the embroidery consistent across a large order?', 'a' => 'Yes. The approved sew-out is the standard the whole run is embroidered to, and garments are checked for registration and finish, so every piece carries the same logo rather than a drifting version of it.'],
            ['q' => 'Can a garment be both printed and embroidered?', 'a' => 'Yes. Both are in-house, so a garment can carry a printed graphic and an embroidered logo, decorated and checked together — see our printing service for the print side.'],
            ['q' => 'Is embroidery or printing better for my logo?', 'a' => 'Embroidery reads as premium and lasts extremely well, and suits logos and lettering; printing handles fine detail, gradients, and large graphics that embroidery cannot. We recommend by artwork and placement — and a single garment can carry both.'],
            ['q' => 'Can you match thread colours to my brand?', 'a' => 'Yes. We match embroidery thread to your brand colours as closely as the thread range allows and confirm it on the sample sew-out, so the stitched logo reads in your colours rather than an approximation of them.'],
        ],
        'related' => ['printing', 'private-label', 'packaging'],
    ],

    'packaging' => [
        'path' => 'packaging',
        'seo_title' => 'Apparel Packaging & Finishing',
        'meta_description' => 'Apparel packaging and finishing in India — custom polybags, tags, care labels and branded mailers. Garments arrive folded, tagged and packed, retail- or ship-ready.',
        'eyebrow' => 'Packaging',
        'h1' => 'Packaging',
        'lead' => 'Custom polybags, tags, care labels, and mailers. Garments arrive folded, tagged, and packed — retail-ready or ready to ship.',
        'intro' => [
            'Packaging is the last thing you make and the first thing your customer touches. It is the moment a garment stops being a product and starts being an experience — the fold, the tag, the tissue, the mailer with your name on it. Done thoughtfully it makes a small brand feel considered; ignored, it undermines the garment inside no matter how well that garment was made.',
            'We treat finishing and packaging as part of manufacturing rather than an afterthought bolted on at the end. Garments come off the line and are trimmed, pressed, folded, tagged, barcoded where needed, and packed to your specification — so what leaves us is not a pile of loose product to sort, but cartons ready to put on a shelf or send to a doorstep.',
            'Retail and direct-to-consumer want different things. A retailer needs consistent folding, correct tickets, and barcodes that scan; a DTC brand needs a mailer that protects the garment and rewards the unboxing. We handle both, to the packaging spec you set, with the same care as the stitching.',
            'Because packaging happens on the same floor as production, your polybags, tags, and mailers are applied to the right garments in the right quantities without a separate supplier and a separate schedule to manage.',
            'Good packaging also protects margin in quieter ways — fewer damaged returns, fewer mis-picks in a stockroom, a product that photographs well for the listing. It is one of the cheapest places to make a garment feel more considered, and one of the easiest to get wrong by leaving it to the last hour of a production run.',
        ],
        'process' => [
            ['title' => 'Define the packaging spec', 'body' => 'We agree exactly how your garments should arrive — fold style, polybag, hang tags, care labels, barcodes, mailers or retail boxes — so packaging is a specification we execute rather than a decision made hurriedly at the end of a run.'],
            ['title' => 'Source packaging materials', 'body' => 'We source the polybags, tags, labels, tissue, and mailers to your spec, branded where you want them branded. Packaging materials are sourced and checked to the same standard as trims, because they are part of the product experience.'],
            ['title' => 'Finishing and pressing', 'body' => 'Before packing, garments are trimmed of loose threads, pressed, and finished so they present well. A well-made garment badly finished still looks cheap in the bag, so finishing is where the making is protected.'],
            ['title' => 'Folding and tagging', 'body' => 'Garments are folded consistently and tagged with your hang tags, tickets, and price or size labels as specified. Consistent folding is what makes a retail delivery look professional and a DTC parcel look considered.'],
            ['title' => 'Barcoding and labelling', 'body' => 'Where you sell through retail or marketplaces, we apply barcodes and labels that scan and comply, so your product moves through a stockroom or a fulfilment centre without friction.'],
            ['title' => 'Pack retail- or ship-ready', 'body' => 'Finally we pack to spec — polybagged and cartoned for retail, or in branded mailers ready to ship direct. You receive product you can sell or send without re-handling it.'],
        ],
        'benefits' => [
            ['title' => 'Part of manufacturing', 'body' => 'Finishing and packing happen on the same floor as making, so there is no separate supplier or schedule to coordinate.'],
            ['title' => 'Retail- or ship-ready', 'body' => 'Garments arrive folded, tagged, and packed to spec — ready for a shelf or a doorstep, not a pile to sort.'],
            ['title' => 'Branded experience', 'body' => 'Custom polybags, tags, and mailers carry your brand into the customer\'s hands at the moment they open the parcel.'],
            ['title' => 'Barcodes that scan', 'body' => 'Correct barcoding and labelling let your product move through retail and fulfilment without friction.'],
            ['title' => 'Consistent presentation', 'body' => 'Consistent folding and finishing make every unit present the same, which is what a professional delivery looks like.'],
            ['title' => 'Protected in transit', 'body' => 'The right mailer or carton protects the garment you spent care making, so it arrives as intended.'],
        ],
        'faqs' => [
            ['q' => 'Can you use my own branded packaging?', 'a' => 'Yes. We apply your polybags, hang tags, care labels, and mailers, or source branded packaging to your spec. The aim is that your product arrives looking entirely like your brand, inside and out.'],
            ['q' => 'Do you pack for retail and for direct-to-consumer?', 'a' => 'Both. Retail deliveries are folded, ticketed, barcoded, and cartoned to a store\'s requirements; DTC orders are packed in branded mailers ready to ship. Tell us your channel and we pack to it.'],
            ['q' => 'Can you apply barcodes and price tickets?', 'a' => 'Yes. Where you sell through retailers or marketplaces we apply barcodes and labels that scan and comply, so your product moves through stockrooms and fulfilment without being re-handled.'],
            ['q' => 'Is packaging included with production?', 'a' => 'Finishing and packing are part of full production with us. The exact packaging — materials, branding, and format — is set by your spec, and we cost it transparently alongside the garment.'],
            ['q' => 'Can you ship directly to my customers?', 'a' => 'We can pack orders in branded mailers ready to ship. Direct fulfilment arrangements depend on your setup, so tell us how you sell and we will tell you what we can do.'],
            ['q' => 'What if I do not have packaging designed yet?', 'a' => 'We can advise on practical options — polybags, tags, and mailers that suit your product and budget — and source them for you, so a lack of finished packaging design does not hold up your run.'],
            ['q' => 'Can you fold and pack to a retailer\'s exact requirements?', 'a' => 'Yes. Retailers often specify fold size, ticket placement, polybag type, and carton counts, and we pack to that specification so your delivery is accepted without rework. Send us the requirement and we build it into the finishing stage.'],
            ['q' => 'Do you provide care and content labels?', 'a' => 'Yes. We apply neck labels, care and size labels, and content or origin labels to your specification, sourced and attached as part of finishing so every garment is compliant and shelf-ready.'],
            ['q' => 'Can packaging be recyclable or plastic-free?', 'a' => 'We can source recyclable or paper-based packaging options where they suit the product, and we are honest about the cost and protection trade-offs. Tell us your preference and we will put practical options in front of you.'],
        ],
        'related' => ['bulk', 'private-label', 'brand-launch'],
    ],

    'brand-launch' => [
        'path' => 'brand-launch-support',
        'seo_title' => 'Clothing Brand Launch Support',
        'meta_description' => 'Clothing brand launch support in India for first-time founders — tech-pack help, low first runs, and guidance from sample to your first sellable drop. Start from 30 pieces.',
        'eyebrow' => 'Brand Launch Support',
        'h1' => 'Brand Launch Support',
        'lead' => 'For first-time founders: tech-pack help, low first runs, and guidance from a sample to your first sellable drop.',
        'intro' => [
            'Launching a clothing brand is where most good ideas quietly die — not from a lack of vision, but from the gap between an idea and a garment you can actually sell. Manufacturers talk in tech packs, GSM, and MOQs; a first-time founder has a design, a budget, and a lot of unanswered questions. Brand launch support exists to close that gap, so a new label reaches its first drop instead of stalling in the space between concept and production.',
            'We help you turn an idea into a real, sellable product without pretending you already speak the language of a factory. That means explaining the choices rather than burying them — which fabric suits your product and price, what a tech pack actually needs, how sampling works, and how to keep a first run small enough to launch on a founder\'s budget. You keep control of the brand; we make sure the manufacturing decisions are informed ones.',
            'Because we run our own label alongside our manufacturing, we have made the mistakes a first launch tends to make, and we would rather you skip them. Low first-run minimums let you prove a design in the market before committing capital, and a direct relationship with the people making your garments means fewer surprises at the worst possible time.',
            'From your first sketch to your first sellable drop, the aim is simple: get a good product made properly, at a scale you can afford, with someone in your corner who has done it before.',
        ],
        'process' => [
            ['title' => 'Talk through the idea', 'body' => 'We start with your product, your customer, and your budget, and translate the idea into practical manufacturing terms — without assuming you already know them. The first job is to turn a vision into a set of decisions you can actually make.'],
            ['title' => 'Help build the specification', 'body' => 'If you do not have a tech pack, we help create one — fabric, fit, construction, labels, and decoration — so your product is defined clearly enough to make consistently. A good spec is what stops a brand\'s quality drifting between its first run and its fifth.'],
            ['title' => 'Choose fabric and fit', 'body' => 'We guide you to the right fabric for your product and price and develop the fit through sampling, explaining the trade-offs so you choose with the consequences in view rather than in hindsight.'],
            ['title' => 'Sample to a sellable standard', 'body' => 'We produce and refine a sample until it is genuinely ready to sell, not just close. Seeing and wearing the sample is where a founder gets the confidence to commit — and where the last problems are found cheaply.'],
            ['title' => 'Launch a low first run', 'body' => 'We produce a first run from thirty pieces per style, so you can go to market and prove demand without sinking your budget into inventory. It is the single most important decision a cautious first launch can make.'],
            ['title' => 'Scale what sells', 'body' => 'When a style sells, we scale it on the same floor to the same standard, so growth does not mean re-qualifying a new manufacturer or risking a different product just as momentum builds.'],
        ],
        'benefits' => [
            ['title' => 'Guidance in plain language', 'body' => 'We explain the manufacturing choices instead of burying them in jargon, so you make informed decisions about your own brand.'],
            ['title' => 'Tech-pack help', 'body' => 'No tech pack? We help build one, so your product is defined well enough to make consistently from the very first run.'],
            ['title' => 'Low first runs', 'body' => 'Start from thirty pieces per style and prove a design in the market before committing serious capital to inventory.'],
            ['title' => 'A partner who has launched', 'body' => 'We run our own label, so the advice comes from having made the mistakes a first launch tends to make.'],
            ['title' => 'Direct, not brokered', 'body' => 'You deal with the people making your garments, so there are fewer surprises and someone accountable when you need an answer.'],
            ['title' => 'A path to scale', 'body' => 'When a style works, it scales on the same floor to the same standard — no disruptive supplier change mid-growth.'],
        ],
        'faqs' => [
            ['q' => 'I have never made a garment before — can you help?', 'a' => 'Yes; that is exactly who brand launch support is for. We translate your idea into practical steps, help build the specification, and guide you from a first sample to a sellable first drop without assuming you already know how a factory works.'],
            ['q' => 'What if I do not have a tech pack?', 'a' => 'Most first-time founders do not. We help create one from your sketches, references, and intentions — defining fabric, fit, construction, and decoration — so your product can be made consistently rather than differently each run.'],
            ['q' => 'How small can my first order be?', 'a' => 'Thirty pieces per style, which you can usually split across sizes and a colour or two. A low first run lets you test demand in the market before committing capital, then scale the styles that sell.'],
            ['q' => 'How much does it cost to start a clothing brand?', 'a' => 'It depends on your fabric, style, quantity, and decoration. Keeping the first run small is the main lever a founder controls, and we cost everything transparently so you can plan a launch to your budget rather than discover it midway.'],
            ['q' => 'How long from idea to first drop?', 'a' => 'It varies with how developed your idea is, but sampling is usually around fifteen days and a first production run thirty to forty-five days after approval. We give you a realistic schedule once we understand the product.'],
            ['q' => 'What happens when my brand grows?', 'a' => 'We scale with you on the same floor and to the same standard, so a successful launch flows straight into larger runs — see our bulk apparel production — without changing manufacturer.'],
            ['q' => 'Do I need a registered company to start manufacturing?', 'a' => 'You can develop samples and plan production before your business paperwork is complete, though you will want it in place for selling and, if relevant, exporting. We focus on getting your product right and are happy to work alongside you as the business side comes together.'],
            ['q' => 'How many styles should I launch with?', 'a' => 'Most first-time founders do best launching a small, focused range — a few strong styles rather than a broad catalogue — so the budget goes into getting each one right and testing real demand. We will talk through a launch range that fits what you can spend.'],
        ],
        'related' => ['private-label', 'custom', 'bulk'],
    ],

];
