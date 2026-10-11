# Stitch Prompt 33 — Manager Appointments final readability patch

Patch only the current refined **Manager Appointments / مدیریت نوبت‌ها** screen.

This is **not a redesign**.

The product scope and overall UI are accepted. Fix only the remaining desktop readability issues.

## Select in Stitch

Select only the current refined Manager Appointments screen.

## Preserve exactly

Keep:

- right-side manager navigation;
- active `نوبت‌ها` item;
- page title and supporting copy;
- search;
- date / specialist / status filters;
- quick lifecycle filters;
- five-row appointment table;
- all table columns;
- status colors;
- `مشاهده جزئیات`;
- pagination;
- typography;
- colors;
- borders/radii/shadows.

Do not add capabilities.

## 1. Make all filter labels fully readable

The current toolbar truncates:

- date;
- specialist.

Do not show ellipsis for default filter values.

The visible desktop toolbar must fully display:

- `پنج‌شنبه ۲۴ آبان`
- `همه متخصصان`
- `همه وضعیت‌ها`

Rebalance the 12-column toolbar widths.

Suggested direction:

- Search: 4 columns
- Date: 3 columns
- Specialist: 2 or 3 columns
- Status: remaining 2 or 3 columns

Choose the balance that makes all labels readable.

Keep one-row desktop layout if possible.

## 2. Remove hard-coded “today” wording

In the top header date pill replace:

`امروز: پنج‌شنبه ۲۴ آبان`

with:

**`پنج‌شنبه ۲۴ آبان`**

Keep the date filter on the same fixture date.

Do not imply that this hard-coded fixture is dynamically “today”.

## 3. Keep quick filters on one line

Each chip must remain compact and single-line:

- `همه نوبت‌ها (۲۸)`
- `تأییدشده (۱۴)`
- `انجام‌شده (۸)`
- `لغوشده (۴)`
- `عدم حضور (۲)`

Do not allow the count to wrap beneath the label.

Use sufficient horizontal padding and `nowrap` behavior.

## 4. Improve Services-column readability

Keep the `خدمات` column and booked-service visibility.

Avoid tall narrow chips where service words stack vertically.

Give the Services column more usable width.

For multi-service rows:

- display compact chips side by side when space allows;
- otherwise wrap cleanly to a maximum of two lines.

Examples:

- `بالیاژ و رنگساژ`
- `کوپ و براشینگ`

Do not hide the second service behind a tooltip or count-only indicator.

## 5. Keep the accepted product semantics

Keep:

- search by customer name / mobile / appointment code;
- date / specialist / lifecycle-status filters;
- only:
  - `تأییدشده`
  - `انجام‌شده`
  - `لغوشده`
  - `عدم حضور`;
- `مبلغ ثبت‌شده`;
- detail-only row action;
- no manual appointment creation;
- no export/reporting;
- no live-update indicator;
- no CRM/analytics/payment operations.

## Required output

Return exactly one corrected:

- **Manager Appointments — desktop/default — appointment workspace**

No appointment detail.
No cancel/reschedule/reassign state.
No mobile/tablet.
No new capability.

If the toolbar, quick filters and Services column are fully readable without visual drift, Manager Appointments default will be frozen.
