# Stitch Prompt 25 — Manager Appointments Mobile 24A targeted patch

Patch the existing **Manager Appointments Mobile 24A** screens only.

This is not a redesign.

## Select in Stitch

Select the three generated 24A mobile screens together:

- mobile appointments workspace/list;
- filtered search result;
- open-filter state.

Then apply this prompt.

## Preserve

Keep the current:

- mobile card layout;
- search placement;
- filter interaction;
- status-chip treatment;
- RTL hierarchy;
- appointment information density;
- colors, spacing and visual style.

## Patch 1 — Persian header

Replace the English heading:

`Appointments`

with:

`نوبت‌ها`

or, if the current hierarchy needs the longer title:

`مدیریت نوبت‌ها`

Keep the whole manager surface Persian / RTL.

## Patch 2 — mobile navigation

Remove the generic:

`تنظیمات`

destination.

Do not invent a generic settings/product area.

Do not use `ساعات و تقویم` as a new combined product destination.

Confirmed manager areas are only:

- نوبت‌ها
- خدمات
- متخصصان
- ساعات کاری سالن
- برنامه کاری متخصصان
- زمان‌های استراحت
- مرخصی‌ها

For mobile, keep the most important direct destinations compact and place the remaining approved operational areas behind a menu/drawer if needed.

Do not add any area outside this list.

## Patch 3 — notification bell

Remove the header notification bell.

Do not imply a notification center or notifications product.

Keep the manager identity affordance if useful.

## Patch 4 — scheduling fixture

In the open-filter state, replace any appointment start such as:

`۱۲:۴۵`

with a valid **30-minute-grid** start.

Use, for example:

- `۱۲:۳۰`
- or `۱۳:۰۰`

Adjust the displayed end time only as needed to preserve that appointment's total duration.

Do not change the scheduling rule.

## Patch 5 — fixture consistency

The workspace and its open-filter version represent the same date/state family.

Use the same neutral total appointment count in both screens.

Do not show `۶ نوبت ثبت‌شده` in one and `۸ نوبت ثبت‌شده` in the other.

## Do not change

Do not alter:

- search by customer name / mobile / reference ID;
- filters for date / status / specialist;
- statuses:
  - تأییدشده
  - انجام‌شده
  - لغوشده
  - عدم حضور
- appointment card data hierarchy;
- `پرداخت در سالن`;
- open-details action.

Do not add:

- manual booking creation;
- CRM/loyalty;
- analytics;
- payment state;
- chair/resource management;
- print/receipt;
- SMS/notification features.

## Required output

Return the corrected versions of the same three mobile 24A screens only.

No 24B screens yet.
No tablet screens.
No new product capability.

If these three screens comply, Mobile 24A will be frozen and we will continue to 24B.
