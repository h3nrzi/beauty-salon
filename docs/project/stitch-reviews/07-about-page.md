# Stitch Review 07 — About page

**Reviewed:** 2026-10-09  
**Source:** Stitch About export containing desktop + mobile screens and the shared design-system document  
**Decision:** **Accept and freeze the About visual/interaction direction.** Remaining mismatches are deterministic content/policy cleanup and should not trigger another generative About redesign.

## What works

The About exploration extends the frozen public visual system coherently:

- the Soft Editorial palette, spacing and editorial storytelling remain consistent;
- the page has a clear brand-story structure rather than becoming another service catalog;
- desktop uses a strong story → values → team → space → booking progression;
- mobile preserves that progression without collapsing into repetitive generic cards;
- the team section acts as a preview and routes toward Specialists instead of duplicating the entire catalog;
- salon-space imagery is explicitly labelled as conceptual/preview imagery in the page itself;
- the page connects naturally back to Services and Booking;
- pay-at-salon / no-online-payment messaging remains visible;
- the mobile bottom navigation in this export stays within approved public destinations and does not add a standalone Profile page.

The visual direction is strong enough to guide implementation and the remaining public pages.

## Deterministic cleanup required

### 1. Spa/wellness positioning was reintroduced

The desktop/mobile copy includes:

- spa wording;
- “head spa” / spa-care labels;
- language around health/wellness beyond the frozen beauty-salon positioning.

The approved product is **سالن زیبایی بانوان آرا**.

Do not silently expand the business into a spa/clinic/wellness service unless product scope is explicitly changed.

### 2. Unsupported material and health claims remain

Examples include wording equivalent to:

- معتبر گیاهی / plant-based materials;
- protecting structural health of hair/skin;
- hygiene/material-quality assurances;
- “beauty and health” positioning.

These are not approved product facts.

Use neutral brand copy focused on service clarity, calm experience, customer choice and transparent scheduling.

### 3. Mandatory consultation was invented

The desktop/mobile values section says every service begins with a free/individual consultation.

The frozen product does not define a mandatory consultation stage.

Do not carry this into handoff unless it is later approved as a real service/business rule.

### 4. Zero-wait / exact-time guarantees are unsupported

The copy promises no queues, no waiting and exact-on-time acceptance.

The product supports structured scheduling, but it does not guarantee zero waiting.

Use language such as:
- «زمان‌بندی شفاف»;
- «نمایش زمان‌های در دسترس»;
- «برنامه‌ریزی منظم».

Avoid absolute operational guarantees.

### 5. Public scheduling interval is wrong

The export repeatedly says appointments are scheduled in **15-minute intervals**.

The frozen rules are:

- service durations use **15-minute increments**;
- public appointment **start times use a 30-minute grid**.

Normalize this in handoff.

### 6. “First available specialist” is still incorrect

The mobile/desktop copy uses «اولین متخصص/فرد در دسترس».

The approved product meaning is **هر متخصص در دسترس**.

Do not add a ranking/assignment promise such as “first” or “fastest”.

### 7. Booking flow still misstates identity and confirmation

The export includes:

- SMS confirmation/reminder as a product step;
- payment-at-salon as the fifth booking step;
- “ثبت آنی بدون تماس” wording that implies messaging/delivery behavior not yet specified.

The approved journey is:

```text
services
→ specialist choice
→ date/time
→ mobile identity verification
→ review and confirmation
```

Payment-at-salon is a payment policy, not a booking step.

Do not promise SMS delivery/provider behavior yet.

### 8. Unsupported staff credentials and experience years were introduced

The team preview includes exact experience years such as 8, 10, 6 and 5 years.

These are fixture data only.

Do not treat years of experience, titles or credentials as production facts unless supplied and verified.

### 9. Unsupported safety/facility claims remain

Examples include:

- filtered ventilation;
- acoustic isolation;
- sterilization/physical standards;
- ergonomic massage chairs;
- guaranteed privacy/quiet claims presented as factual business features.

These may be useful visual placeholders, but they are not approved production facts.

Keep only neutral composition/story language until real venue facts are supplied.

### 10. “Official license” claim is unsupported

The desktop footer contains wording equivalent to «دارای مجوز رسمی خدمات تخصصی زیبایی».

This is an unverified legal/business claim and must not survive handoff unless the actual license is provided and approved for publication.

### 11. Satisfaction-dependent payment wording is not approved

Some copy says payment occurs after the service and after satisfaction.

The approved product rule is simply:

- payment happens at the salon;
- no online payment/deposit in v1.

Do not imply a satisfaction-guarantee/refund policy.

### 12. Legal/privacy links remain placeholders

Desktop footer again shows Privacy and booking/cancellation rules as normal live destinations.

Those contents are not yet approved/published.

Treat them as unresolved/future destinations until real legal content exists.

### 13. Mock business facts remain non-authoritative

Exact address, phone, email, hours and business identity details are visual fixtures only.

They must not be promoted to production truth.

### 14. Screenshot evidence is not final responsive acceptance

The export screenshots are approximately:

- desktop: **452 × 1600**;
- mobile: **190 × 1600**.

The composition is understandable, but these are not strong final browser-acceptance captures at the intended 1440/390 CSS widths.

This does not require another generative Stitch pass. Later implementation acceptance must render realistic viewports.

### 15. Known design-token cleanup remains deferred

The shared design system still carries the same deterministic issues already tracked:

- Persian display typography names `Noto Serif`;
- frontmatter primary values conflict with the prose terracotta primary token.

Resolve these during export audit / engineering handoff, not by regenerating About.

## Freeze decision

Freeze the About direction as:

`ara-about-soft-editorial-v1`

Accepted:

- About page story structure;
- editorial intro/story treatment;
- values presentation;
- team-preview composition;
- salon-space/atmosphere visual section;
- product bridge into Services/Specialists/Booking;
- responsive hierarchy;
- relationship to the existing frozen visual system.

Not authoritative:

- literal story/brand claims;
- spa/wellness positioning;
- material/health claims;
- mandatory consultation;
- zero-wait guarantees;
- 15-minute public-slot wording;
- first-available specialist wording;
- SMS/reminder behavior;
- experience years/credentials;
- facility/safety claims;
- official-license claim;
- satisfaction-payment semantics;
- legal/privacy destinations;
- mock business data;
- generated HTML/framework choices.

## Next step

Do not iterate About again unless later cross-page work exposes a real visual-system inconsistency.

Use the frozen Home + Services + Specialists + Gallery + About references to design the next scoped public page: **Contact**.
