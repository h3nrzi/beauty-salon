# Stitch Prompt 24 — Booking zero-selection sync, keep filters removed

Patch only the current **Booking / رزرو نوبت — service-selection** screen.

This is **not a redesign**.

The category filters were intentionally removed by the product owner.

**Do not reintroduce them.**

## Preserve exactly

Keep:

- no category/filter row;
- desktop split layout;
- five-step booking progress;
- six visible service cards;
- sticky summary panel;
- same-specialist guidance;
- public header/footer;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

## 1. True zero-selection initial state

The page must open with exactly:

- **0 selected services**
- all six service cards visually unselected
- all six service cards with `aria-checked="false"`
- all checkbox visuals unchecked
- summary badge: `۰ خدمت انتخاب‌شده`
- empty summary message:
  **`هنوز خدمتی انتخاب نکرده‌اید.`**
- `مجموع مدت`: `۰ دقیقه`
- `مجموع قیمت`: `۰ تومان`
- primary CTA `ادامه و انتخاب متخصص` visibly disabled

Do not preselect any service.

## 2. Static HTML must match runtime state

Do not rely on JavaScript running after load to repair a contradictory initial markup.

The exported HTML itself must already encode the zero-selection state.

JavaScript state must also initialize with zero selected services.

The next screenshot must show the same state.

## 3. Selection behavior after interaction

After the customer explicitly selects a service:

- mark only that card selected;
- update `aria-checked`;
- update selected count;
- add the service to summary;
- update total duration;
- update total price;
- enable Continue.

After removing the last selected service:

- return to the same zero-selection default state;
- disable Continue again.

## 4. Keep all six services synchronized

All six visible services must use the same names, durations and prices in:

- card content;
- interaction metadata;
- selected summary;
- totals.

Keep the current cleaned service data.

## 5. Accessibility

Keep:

- keyboard selection with Enter / Space;
- visible focus;
- role/checked semantics;
- accessible remove-button labels.

Selected state must not rely on color alone.

## 6. Remove obsolete filter code

Because the filter UI is intentionally gone:

- remove unused `categoryFilterBar` filter-interaction JavaScript;
- do not add category chips/buttons back.

## 7. Keep current product semantics

Keep:

- services performed پشت‌سرهم;
- one specialist must be eligible for the complete selected set;
- `پرداخت در سالن`;
- next step is Specialist;
- no consultation;
- no checkout/payment step;
- no automatic service recommendations.

## Export consistency requirement

The next export's:

- `screen.png`
- static HTML
- runtime initial state

must all represent **the same zero-selection state**.

## Required output

Return exactly one corrected:

- **Booking — desktop/default — zero-selection initial state**

No selected-state variant.
No filters.
No Specialist step.
No mobile/tablet.
No edge states.

If this is synchronized, Booking default will be frozen again.
