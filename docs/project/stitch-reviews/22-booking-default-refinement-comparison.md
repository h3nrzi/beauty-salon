# Stitch Review 22 — Booking default refinement comparison

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (22).zip`  
**Compared against:** old Booking from `stitch_salon_visual_baseline (21).zip`  
**Package SHA-256:** `00362dab4f9841d12f9a79e3b9dbc1a8428c6556020fff0f888c5253d11edc39`  
**Decision:** **Freeze Booking desktop/default — service-selection step.**

## Old vs new

The refined Booking screen keeps the strongest parts of the old interaction architecture while removing most of the scope/content drift.

### Preserved correctly

- five-step booking progress;
- task-focused desktop split layout;
- service catalog on the right;
- sticky booking summary on the left;
- category chips;
- clear selected/unselected service states;
- selected-service removal action;
- running duration and price totals;
- primary CTA to specialist selection;
- public header/footer family.

### Improved correctly

- step 4 is now `اطلاعات و تأیید موبایل`;
- service intro now says selected services are performed `پشت‌سرهم`;
- same-specialist rule is explicit;
- next-step guidance explains that only specialists eligible for the complete selected service set will be shown;
- no live-capacity / luxury-reservation copy;
- free-consultation block is removed;
- `مجموع مدت` / `مجموع قیمت` replace vague estimate language;
- no cancellation-fee claim near the CTA;
- service content is substantially more neutral;
- footer uses the neutral public baseline.

## Frozen visual structure

Freeze:

- public header/navigation;
- five-step booking progress;
- service-selection heading/intro;
- category chips;
- service rows/cards;
- selected/unselected visual states;
- desktop split layout;
- sticky `خلاصه انتخاب نوبت` panel;
- selected-service list;
- remove action;
- duration/price totals;
- same-specialist guidance;
- primary `ادامه و انتخاب متخصص` CTA;
- next-step helper placement;
- neutral public footer;
- typography, spacing, colors, cards, borders/radii/shadows.

## Frozen product semantics

Accepted:

- one or multiple services may be selected;
- services are consecutive;
- all selected services must be performable by one specialist;
- total duration is the sum of service durations;
- total price is the sum of service prices;
- the next step is Specialist;
- customer identity/mobile verification is a later step;
- no payment/checkout step;
- no consultation step;
- no automatic service recommendation is part of the product contract.

## Deterministic cleanup deferred

Do **not** reopen Stitch for this literal:

`پرداخت در سالن پس از ارائه خدمات انجام می‌شود.`

Normalize during export audit / engineering handoff to:

`پرداخت در سالن`

This does not affect layout or interaction.

The visible representative selected services are fixture state only and do not imply automatic preselection in production.

## Freeze boundary

This freezes **Booking — desktop/default — service-selection step** only.

It does not freeze:

- Specialist step;
- Date/Time step;
- Identity/Mobile verification step;
- Review/Confirm step;
- success/empty/stale/error states;
- service fixture values;
- mobile/tablet.

Next page: My Appointments default. Per workflow, review the old version before writing its refinement prompt.
