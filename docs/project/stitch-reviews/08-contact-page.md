# Stitch Review 08 — Contact page

**Reviewed:** 2026-10-09  
**Source:** Stitch Contact export containing desktop + mobile screens and the shared design-system document  
**Decision:** **Accept and freeze the Contact visual/interaction direction.** Remaining mismatches are deterministic content/data cleanup and should not trigger another generative Contact redesign.

## What works

The Contact exploration extends the frozen public visual system coherently:

- the Soft Editorial palette, spacing and contact-card language remain consistent;
- the page clearly prioritizes contact, directions and booking rather than turning into a lead form;
- the approved **24-hour customer change cutoff** is prominently represented;
- «وقت‌های من» remains the self-management path outside the final 24 hours;
- direct salon contact is the support path inside the final 24 hours;
- salon opening hours are visually separated from specialist booking availability;
- the page gives clear paths to Booking, phone/contact and directions;
- desktop and mobile both preserve access to «وقت‌های من» and «رزرو وقت»;
- legal links are now visibly labelled as draft/placeholder content in the export;
- business data is explicitly labelled as mock/preliminary in several places;
- the page does not add a contact form, live chat or support-ticket workflow.

The visual/interaction model is strong enough to guide implementation.

## Deterministic cleanup required

### 1. Do not call the inside-24-hours path “emergency contact”

The desktop export labels the reception CTA as «تماس اضطراری پذیرش».

The product rule is simply:

- self-change is disabled inside the final 24 hours;
- customer must contact the salon.

This is not an emergency-support product.

Use neutral wording such as:

- «تماس با پذیرش»;
- «برای تغییر دیرهنگام با سالن تماس بگیرید».

### 2. Remove unsupported parking / building-operation claims

The export invents facts such as:

- dedicated parking;
- parking coordination with building/security staff;
- specific building/floor/access details.

These are not approved product facts.

All address/access details remain mock data until the real salon information is supplied.

### 3. Do not prescribe map providers in the product baseline

The export names Google Maps, نشان and بلد.

The product requirement is only a clear **directions** path.

Provider selection belongs later and may depend on deployment/local requirements.

Use provider-neutral wording such as «مسیریابی در نقشه» in the authoritative handoff unless a provider is explicitly chosen.

### 4. Remove SMS-based location verification wording

Desktop copy says the location should be verified from a booking SMS before the visit.

Messaging/SMS behavior is not frozen.

Do not promise or depend on SMS delivery for address confirmation.

### 5. “Arrive 10 minutes early” is an invented operating rule

The desktop export asks customers to arrive 10 minutes before the appointment.

That policy is not part of frozen Product Definition.

Do not carry it into production unless the salon explicitly adopts it.

### 6. Payment timing is over-specified

The export says all service fees are calculated/collected **after the service**.

The frozen product rule is only:

- payment happens at the salon;
- no online payment/deposit in v1.

Do not add a satisfaction-dependent or after-service payment policy unless approved separately.

### 7. Header person/avatar affordance is still ambiguous

Desktop and mobile headers include a standalone person icon beside Booking/My Appointments.

A separate Profile product area is not frozen.

Do not turn this decorative/account-like icon into a new destination unless scope is changed. Prefer the approved «وقت‌های من» identity entry.

### 8. Mobile/desktop business data is inconsistent

The variants use different mock addresses and details.

This is acceptable for visual exploration, but engineering must use one authoritative salon information source.

Do not preserve separate mobile/desktop literals.

### 9. Exact phone/email/hours remain mock data

Phone, email, address and opening hours are visual fixtures only.

The design correctly labels some of them as mock/preview data, but handoff must keep that boundary explicit.

### 10. Mobile screenshot evidence is still narrower than target

The mobile screenshot is **317 px wide**, closer to a real handset than earlier exports but still below the intended ~390 CSS-width design target.

The layout is clear enough to freeze design intent.

Final implementation acceptance must render normal handset widths and does not need another generative Contact pass.

### 11. Known design-token cleanup remains deferred

The shared design system still carries the previously tracked deterministic inconsistencies:

- Persian display tokens still name `Noto Serif`;
- frontmatter primary values conflict with the prose terracotta primary definition.

Resolve these in export audit / engineering handoff, not by regenerating Contact.

## Freeze decision

Freeze the Contact direction as:

`ara-contact-soft-editorial-v1`

Accepted:

- Contact page composition;
- prominent 24-hour support-policy block;
- separation of salon opening hours from specialist booking availability;
- contact-information cards;
- directions/location card treatment;
- Booking bridge;
- desktop/mobile hierarchy;
- relationship to the frozen public visual system.

Not authoritative:

- literal phone/email/address/hours;
- emergency wording;
- parking/building/access claims;
- maps-provider choices;
- SMS location-confirmation behavior;
- 10-minute arrival rule;
- exact payment timing beyond pay-at-salon;
- person/profile affordance;
- generated HTML/framework choices.

## Next step

Do not iterate Contact again unless later cross-page work exposes a genuine visual-system problem.

The public discovery pages are now visually established.

Next, design the product's core application flow: **Booking**.
