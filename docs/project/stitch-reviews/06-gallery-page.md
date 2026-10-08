# Stitch Review 06 — Gallery page

**Reviewed:** 2026-10-08  
**Source:** Stitch Gallery export containing desktop + mobile screens and the shared design-system document  
**Decision:** **Accept and freeze the Gallery visual/interaction direction.** Remaining mismatches are deterministic content/data cleanup and should not trigger another generative Gallery redesign.

## What works

The Gallery exploration extends the frozen Home, Services and Specialists system coherently:

- the Soft Editorial palette, spacing and image-first composition remain consistent;
- the page feels like a curated portfolio rather than a social feed;
- the desktop gallery uses a controlled editorial grid with clear category filters;
- the mobile gallery becomes an intentional stacked portfolio rather than a compressed masonry layout;
- service category, service title, specialist context and booking/discovery actions are visible;
- «هر متخصص در دسترس» remains compatible with the broader product flow;
- pay-at-salon / no-online-payment messaging is preserved;
- no likes, comments, review stars, follower counts or social handles were introduced;
- the overall visual direction is strong enough to guide later implementation.

## Deterministic cleanup required

### 1. The export incorrectly claims the images are real salon work

Desktop copy explicitly says the Gallery images were captured in the real salon with natural daylight.

That is **not** an approved product fact.

All current imagery is prototype/reference media only.

During export audit / engineering handoff:

- remove claims that the images are real client/salon work;
- do not imply the pictured results belong to آرا;
- production acceptance requires owned or rights-cleared media with explicit provenance.

The gallery may say it is a visual portfolio **only after** the production media/content is actually supplied and approved.

### 2. Unsupported material/product claims were reintroduced

Examples include wording equivalent to:

- plant-based materials;
- ammonia-free products;
- organic extracts;
- keratin/protein treatment claims;
- premium/material-quality assurances.

These are not frozen product facts.

Use neutral service descriptions until real product/material information is supplied.

### 3. Clinical / physiological claims were reintroduced

The desktop and mobile variants include language around:

- lymphatic drainage;
- improved blood circulation;
- reflexology;
- skin-layer recovery;
- physiological/therapeutic outcomes.

The frozen product is a women's beauty salon, not a medical/clinical service.

Remove or neutralize this copy unless such claims are explicitly added later with appropriate product/legal evidence.

### 4. Hygiene / safety guarantees are unsupported

The mobile/desktop screens include language equivalent to:

- medical-sterile tools;
- completely sterile tools;
- hygienic lamination;
- “without damage” guarantees.

These are not approved claims.

Use neutral copy such as professional, orderly and careful service rather than guarantees/certification language.

### 5. “Direct contact with specialist” is not an approved product capability

The desktop intro includes a trust badge equivalent to «ارتباط مستقیم با متخصص».

The product lets a customer choose a specialist for booking. It does **not** currently define direct messaging/contact with specialists.

Replace this with a grounded concept such as:

- انتخاب متخصص دلخواه;
- مشاهده متخصص‌های واجد شرایط.

Do not create a direct-contact capability through copy.

### 6. Consultation-before-every-service is not yet an approved workflow

Both variants introduce copy saying every service starts with a dedicated consultation.

That may be reasonable marketing content later, but it is not part of the frozen v1 booking/service contract.

Do not imply a mandatory consultation stage unless it is deliberately added to product scope.

### 7. “Simultaneous” or bundled treatment wording must not distort the booking model

Some gallery copy combines multiple treatment outcomes in a way that can read like parallel/bundled delivery.

The frozen rule remains:

- one appointment;
- one eligible specialist;
- selected services performed consecutively;
- total duration equals the sum of selected service durations.

Gallery captions must not invent a conflicting service-delivery model.

### 8. Mobile bottom navigation again includes a standalone Profile destination

The mobile Gallery includes «پروفایل».

A standalone Profile page is not part of frozen public scope.

Do not create that page merely because Stitch rendered it. Identity/account affordances must stay within the approved authenticated experience unless scope is changed deliberately.

### 9. Mobile and desktop item sets are not an authoritative shared dataset

Desktop and mobile show different subsets/counts and different literal captions.

This is acceptable as visual exploration.

Engineering must render one authoritative Gallery dataset responsively rather than treating the two variants as separate content inventories.

### 10. Mock business and specialist facts remain non-authoritative

Names, service assignments, durations, business hours, phone, address and specialist relationships are fixture data only unless separately approved.

Do not promote them to production facts during handoff.

### 11. Mobile screenshot evidence is too narrow for final responsive acceptance

The exported mobile screenshot is only **189 px wide**.

The composition is understandable, but this image is not final handset acceptance evidence.

Later implementation acceptance must render normal handset widths such as 375–390 CSS px.

This does not require another generative Stitch pass.

### 12. Known design-token cleanup remains deferred

The shared design system still carries previously recorded deterministic inconsistencies:

- Persian display typography still names `Noto Serif`;
- frontmatter primary values still conflict with the prose primary terracotta definition.

These belong to export audit / engineering handoff and do not justify another Gallery design loop.

## Freeze decision

Freeze the Gallery direction as:

`ara-gallery-soft-editorial-v1`

Accepted:

- Gallery page composition;
- editorial portfolio grid;
- mobile stacked portfolio direction;
- simple category-filter treatment;
- service/specialist context on gallery items;
- booking/discovery bridge;
- desktop/mobile hierarchy;
- relationship to Home + Services + Specialists visual system.

Not authoritative:

- literal imagery ownership/authenticity;
- service/material/product claims;
- clinical/physiological claims;
- sterilization/safety guarantees;
- consultation workflow;
- direct-contact capability;
- standalone Profile destination;
- literal specialist/service datasets;
- mock business data;
- generated HTML/framework choices.

## Next step

Do not iterate Gallery again unless later cross-page work exposes a real visual-system inconsistency.

Use the frozen Home + Services + Specialists + Gallery references to design the next scoped public page: **About**.
