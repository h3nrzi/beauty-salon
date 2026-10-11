# Stitch Review 25 — Booking zero-selection sync

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (24).zip`  
**Package SHA-256:** `819380de1b7c766878aa25d35f9afdb7cf81fd6f24f90856da637ec6058183c6`  
**Decision:** **Freeze Booking desktop/default — true zero-selection initial state.**

## Manual design decision

The category/filter row was manually removed by the product owner before this export.

That change is accepted and is now part of the frozen Booking default baseline.

With six visible services, showing all services directly is simpler and keeps the first booking step focused.

Do not reintroduce filters unless the service catalog later grows enough to justify them.

## Zero-selection verification

The initial visual/exported state is now coherent.

Verified:

- 0 services selected;
- all 6 service cards are visually unselected;
- all 6 service cards use `aria-checked="false"`;
- summary badge shows `۰ خدمت انتخاب‌شده`;
- empty summary says `هنوز خدمتی انتخاب نکرده‌اید.`;
- total duration is `۰ دقیقه`;
- total price is `۰ تومان`;
- `ادامه و انتخاب متخصص` is disabled;
- screenshot and static HTML show the same initial state.

## Interaction-data verification

Accepted:

- all 6 visible services exist in interaction metadata;
- service names/durations/prices are consistent with the visible cards;
- no stale old service names remain in the interaction data;
- no obsolete category-filter code remains;
- payment wording is `پرداخت در سالن`.

## Accessibility intent

Accepted for the Stitch baseline:

- each service card exposes checkbox semantics;
- cards are keyboard-focusable;
- Enter / Space selection support exists;
- selected state is not color-only;
- summary remove buttons have accessible names;
- Continue has a true disabled state at zero selection.

Final production implementation should still use the most appropriate native/semantic controls during engineering, but the interaction intent is now clear enough to freeze.

## Frozen visual structure

Freeze:

- public header/navigation;
- five-step booking progress;
- no-filter service catalog;
- six visible service cards;
- unselected default card state;
- desktop split layout;
- sticky booking summary;
- zero-selection empty summary;
- duration/price totals;
- same-specialist guidance;
- disabled/enabled Continue hierarchy;
- next-step helper;
- neutral public footer;
- v2 typography/spacing/card/button grammar.

## Frozen semantic baseline

- default state starts with no services selected;
- customer explicitly selects one or more services;
- services are performed consecutively;
- one specialist must be eligible for the full selected service set;
- total duration and price are derived from the explicit selection;
- Continue is disabled until at least one service is selected;
- payment is at salon;
- next step is Specialist;
- no filter is required for the current six-service catalog.

## Freeze boundary

This freezes **Booking — desktop/default — service-selection initial state**.

It does not freeze:

- selected-service interaction variants as separate screens;
- Specialist step;
- Date/Time step;
- Identity/Mobile verification;
- Review/Confirm;
- success/stale/error states;
- mobile/tablet;
- fixture service data.

Next page: My Appointments default. Per workflow, review the old version first.
