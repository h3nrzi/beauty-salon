# Stitch Review 05 — Specialists page

**Reviewed:** 2026-10-08  
**Source:** Stitch Specialists export containing desktop + mobile screens and the shared design-system document  
**Decision:** **Accept and freeze the Specialists visual/interaction direction.** Remaining issues are deterministic copy/policy cleanup and should not trigger another generative Specialists redesign.

## What works

The Specialists exploration extends the frozen Home and Services direction coherently:

- the Soft Editorial palette, spacing and portrait-card language remain consistent;
- the page clearly supports both a specific specialist path and «هر متخصص در دسترس»;
- “any available specialist” is given deliberate first-class treatment rather than being hidden as a fallback;
- specialist cards expose portrait, name, role/expertise, eligible services and direct booking actions;
- the visual hierarchy makes individual discovery distinct from the flexible booking path;
- desktop and mobile both retain clear «رزرو وقت» access;
- payment-at-salon messaging remains visible;
- the page does not introduce ratings/review counts or social-media metrics;
- the public Specialist surface still feels editorial rather than like an admin directory.

The core visual/interaction model is strong enough to guide engineering and the next public pages.

## Deterministic cleanup required

### 1. Slot-grid wording contradicts the frozen Product Definition

The desktop export says «بازه‌های زمانی ۱۵ دقیقه‌ای» for public booking.

The approved product rule is:

- service durations use **15-minute increments**;
- public appointment **start times use a 30-minute grid**.

Do not carry the 15-minute public-slot wording into handoff.

### 2. Booking summary still misstates the identity/confirmation flow

The desktop five-step explanation uses:

- “ثبت شماره تماس”;
- SMS reminder language;
- “پرداخت در سالن” as the fifth booking step.

The approved journey is:

```text
select services
→ choose specific / any available specialist
→ choose date/time
→ verify mobile identity
→ review and confirm
```

Pay-at-salon is a payment policy, not the final booking step.

Do not promise reminder/confirmation SMS behavior until messaging delivery is explicitly specified.

### 3. Mobile copy still drifts into “fastest time”

The mobile process text says the customer can prioritize «سریع‌ترین زمان».

The approved option is **هر متخصص در دسترس**, not a guarantee of the globally fastest/first available slot.

Keep the flexible specialist meaning without adding ranking/assignment promises.

### 4. Cancellation policy is wrong

The mobile CTA area says cancellation/support is available until **12 hours** before the appointment.

The frozen policy is **24 hours**.

Inside the final 24 hours, the customer must contact the salon.

### 5. Unsupported experience and credential claims

The mobile cards introduce exact years of experience such as 7, 5, 6 and 4 years.

These are fixture data only and are not approved salon facts.

Do not treat them as production content unless later supplied/verified.

### 6. Clinical / physiological claims were reintroduced

Examples include:

- lymphatic drainage;
- improving circulation;
- 48-hour restrictions around laser/sunburn;
- anatomy-based/therapeutic language presented as factual care guidance.

The frozen product is a beauty salon, not a clinic.

Keep placeholder service expertise non-clinical and avoid medical/physiological outcome or contraindication claims unless explicitly added with proper product/legal review.

### 7. Hygiene/material guarantees remain unsupported

The export still contains wording equivalent to:

- fully sterile tools;
- unified hygiene standards;
- no-damage guarantees.

These are not approved product facts.

Use neutral placeholder copy such as professional, orderly and careful service rather than guarantees/certification claims.

### 8. Multi-service copy must preserve “consecutive, one specialist”

Desktop copy says “رزرو همزمان خدمات سازگار”.

The approved model is not simultaneous parallel service delivery. It is:

- one appointment;
- one eligible specialist;
- multiple selected services performed **consecutively**;
- total duration equals the sum of service durations.

Use wording that cannot be read as parallel/simultaneous services.

### 9. Profile remains an unapproved standalone destination

The mobile bottom navigation again includes «پروفایل».

The approved customer surface is My Appointments plus the mobile-centered identity experience.

Do not create a standalone Profile page solely because Stitch rendered one. A deliberate scope change would be required.

### 10. Mock availability and business facts are non-authoritative

“Nearest appointment”, address, hours, phone, specialist names and exact availability are visual fixture data only.

Engineering must use one authoritative runtime dataset and must not treat these literals as production truth.

### 11. Mobile screenshot is not strong acceptance evidence

The exported mobile screenshot is only **177 px wide**.

The responsive composition is inferable from the HTML and layout, but this image is not accepted as realistic handset visual evidence.

This does not require another generative design pass; later visual acceptance should render the implemented page at an actual handset viewport.

### 12. Known design-token cleanup remains deferred

The shared DESIGN.md still carries previously recorded deterministic inconsistencies:

- `Noto Serif` is still named in Persian display tokens;
- frontmatter primary values conflict with the prose primary terracotta definition.

These belong to export audit / engineering handoff, not another Stitch loop.

## Freeze decision

Freeze the Specialists direction as:

`ara-specialists-soft-editorial-v1`

Accepted:

- Specialists page composition;
- portrait-card treatment;
- specific-specialist discovery path;
- prominent «هر متخصص در دسترس» path;
- eligible-service presentation;
- direct booking CTA pattern;
- desktop/mobile hierarchy;
- relationship to Home + Services visual system.

Not authoritative:

- literal specialist names;
- exact years of experience;
- nearest-appointment labels;
- address/phone/hours;
- 12-hour cancellation text;
- SMS/reminder behavior;
- 15-minute public slot wording;
- clinical/physiological claims;
- hygiene/material guarantees;
- standalone Profile destination;
- generated HTML/framework choices.

## Next step

Do not iterate Specialists again unless later cross-page work exposes a genuine visual-system problem.

Use the frozen Home + Services + Specialists references to design the next scoped public page: **Gallery**.
