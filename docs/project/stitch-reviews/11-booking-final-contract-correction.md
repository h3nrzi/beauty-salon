# Stitch Review 11 — Booking final contract-correction pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (8).zip`  
**Package SHA-256:** `dda158db9f57bdea8a358bc139fbe6350c804abe4325c79c3820c47bd1339b71`  
**Decision:** **Do not freeze Booking yet.** Most mobile contract cleanup improved, but two core interaction requirements are still not satisfied: stale-slot CTA state and desktop staged-flow parity.

## What improved

The new export materially improves the mobile Booking contract:

- canonical 5-stage progress is preserved;
- 24-hour customer-change rule is visible in the time/review flow;
- 90-day horizon, 60-minute same-day lead and 30-minute public start grid are represented;
- «هر متخصص در دسترس» is used correctly in the mobile specialist/time flow;
- No Eligible Specialist now explains the common-specialist constraint and offers remove/change-service actions;
- No Availability preserves the current choice and offers another date / specialist route;
- stale-slot recovery no longer visually preselects one of the alternative times;
- identity copy is closer to the approved returning-customer recovery behavior;
- the visual system remains coherent and should not be redesigned.

## Remaining blocking issues

### 1. Stale-slot primary CTA is visually active before a new time is selected

The stale-slot screen now correctly shows all replacement times as unselected.

However the primary CTA «انتخاب ساعت و ادامه نوبت» is still rendered as an active terracotta button.

The required initial state is:

- zero replacement slots selected;
- continue CTA visually and semantically **disabled**;
- CTA becomes enabled only after explicit user selection.

This is a core recovery-state behavior and must be corrected before freeze.

### 2. Desktop still does not demonstrate the canonical staged flow

Prompt 11 explicitly required desktop stages 1–5 using the same one-active-stage-at-a-time model as mobile.

The export instead provides a single large desktop screen that exposes multiple booking stages/controls together and lets the user edit the workflow from one long page.

That is a materially different interaction model.

The frozen baseline requires:

- same canonical 5 stages on desktop;
- one active stage at a time;
- persistent progress;
- optional side summary;
- backward navigation preserving valid selections.

A single giant desktop booking form is not accepted as the desktop baseline.

### 3. Desktop still contains scope/content drift

The desktop screen also reintroduces several literals that must not become authoritative, including:

- «سریع‌ترین» semantics;
- certificate / international credential copy;
- SMS-related copy;
- “free” change/cancellation language;
- satisfaction / after-service payment phrasing beyond the simple pay-at-salon rule;
- wellness/relaxation/clinical-style service fixture copy;
- claims around operations/support.

These reinforce why the desktop screen cannot be frozen as-is.

### 4. Generated contract documents introduced a false authoritative salon address

The package includes generated Markdown that calls this an approved/frozen address:

`تهران، زعفرانیه، خیابان آصف، پلاک ۱۲`

No real salon address has been approved.

This is fixture data only and must **not** be promoted into the Product Contract, baseline spec or production truth.

The same applies to any literal phone/email/hours unless separately supplied and approved.

### 5. Generated contract copy over-specifies payment timing

Generated Markdown states payment occurs specifically after service delivery.

The frozen rule is only:

- pay at salon;
- no online payment/deposit.

Do not create an additional “after service” business rule unless explicitly approved.

### 6. Success/reference screen still contains old out-of-scope extras in the package

One exported success variant still contains:

- central-branch wording;
- SMS reminder;
- add to calendar;
- sharing;
- arrive 10 minutes early;
- seasonal drink/hospitality promise.

These remain rejected scope/content. They must not be used as the final success baseline.

## Freeze gate

Booking may be frozen once there is direct evidence of only these remaining corrections:

1. stale-slot initial CTA disabled while no replacement time is selected;
2. desktop uses the same staged 1→5 model as mobile;
3. the desktop screens use neutral contract-safe fixture copy;
4. no generated “contract” document promotes mock address/payment timing/features to approved product facts.

No further art-direction exploration is needed.
