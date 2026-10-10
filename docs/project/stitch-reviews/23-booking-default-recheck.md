# Stitch Review 23 — Booking default re-check / freeze revoked

**Reviewed again:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (22).zip`  
**Previous decision:** Frozen in Review 22  
**New decision:** **Freeze revoked. Booking default must be corrected before continuing.**

The second review found several issues that are not merely deterministic handoff cleanup.

## 1. The screen is not a true default/initial state

The frozen artifact shows one or more services already selected.

For a **default Booking service-selection state**, the customer should enter with:

- no service selected;
- empty selection summary;
- zero totals;
- disabled Continue CTA.

Arbitrary preselection must not be part of the default baseline.

A selected-services example belongs to a later interaction/state review, not the default state.

## 2. Screenshot and HTML disagree

The exported screenshot visibly shows **1 selected service**.

The paired HTML/source initializes **2 selected services**.

This creates different:

- selected count;
- summary items;
- total duration;
- total price.

A frozen visual reference cannot have contradictory screenshot/source state.

## 3. Interactive service metadata is stale and inconsistent

The visible service cards use the cleaned service catalog, but the embedded interaction data still contains old literals such as:

- `بالیاژ تخصصی فرانسوی`;
- `درمان آبرسانی و تراپی مو`;
- `کوپ ژورنالی و کوتاهی`;
- `مانیکور روسی`;
- `فیشیال پاکسازی عمیق`.

After interacting with the page, these old names can reappear in the summary.

That would reintroduce semantics we explicitly removed.

## 4. The sixth service is missing from interaction metadata

The visible page contains **6 service cards**, but the interaction metadata only defines 5 services.

Selecting the sixth service can produce incorrect totals or broken summary behavior.

All visible services must use the same source of truth for:

- name;
- duration;
- price;
- selection summary.

## 5. Continue remains available when no service is selected

The page already contains an empty-selection summary branch, but the Continue CTA is not correspondingly disabled.

The intended default state should show:

- no selection;
- disabled `ادامه و انتخاب متخصص`;
- CTA enabled only after at least one explicit customer selection.

## 6. Selection control is not sufficiently keyboard-accessible

Service cards rely on pointer click handlers around non-semantic visual checkbox elements.

The product accessibility target is WCAG 2.2 AA.

At minimum the baseline should show intent for:

- keyboard-operable selection;
- visible focus;
- actual checkbox/button semantics;
- accessible remove buttons.

## 7. Future booking steps are too low contrast

Future step items use very low opacity levels.

They may remain visually secondary, but they should remain comfortably readable and not depend on extremely low opacity.

## 8. Payment literal still over-specifies timing

Current:

`پرداخت در سالن پس از ارائه خدمات انجام می‌شود.`

Use exactly:

`پرداخت در سالن`

## Revised freeze target

Booking service-selection default should be a **true initial state**:

- 0 selected services;
- all service cards unselected;
- empty summary;
- 0 duration / 0 price;
- Continue disabled;
- six visible services;
- clean consistent metadata;
- screenshot and HTML in sync;
- keyboard-accessible selection intent.

The existing visual composition is still good and should be preserved.
