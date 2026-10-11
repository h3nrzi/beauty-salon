# Stitch Prompt 41 — Manager Salon Hours surgical refinement

Modify the **old Manager Salon Hours / ساعات کاری سالن** screen.

This is a **surgical cleanup**, not a redesign.

## What to select in Stitch

Select **only the original/old Manager Salon Hours screen**.

Do not select any other visual anchor.

## Preserve the old visual structure

Keep:

- right-side Manager sidebar;
- top bar;
- page-header position;
- weekly-hours main card;
- seven-day list;
- open/closed treatment;
- opening/closing time presentation;
- per-day edit affordance;
- save button;
- overall spacing, colors, typography and card treatment.

Do not invent a new layout.

## 1. Page heading

Use:

**`ساعات کاری عمومی سالن آرا`**

Supporting copy:

**`ساعات باز و بسته بودن سالن را برای روزهای هفته مدیریت کنید.`**

Remove broad “booking/calendar base settings” language.

## 2. Weekly schedule

Keep all 7 days.

Each row should show only:

- day name;
- `باز` or `بسته`;
- opening time;
- closing time;
- one `ویرایش` action.

For a closed day, show simply:

**`بسته`**

Do not show:

- VIP exceptions;
- phone exceptions;
- `پذیرش آنلاین فعال`.

## 3. Keep salon hours separate from specialist schedules

Keep one concise guidance block:

**`ساعات کاری سالن چارچوب کلی دسترسی به زمان‌های رزرو را مشخص می‌کند. برنامه کاری هر متخصص، زمان‌های استراحت و مرخصی‌ها از بخش‌های مربوط مدیریت می‌شوند.`**

Do not add implementation/sync wording.

## 4. Remove the entire booking-settings side column

Delete the controls for:

- default slot duration;
- minimum booking notice;
- booking horizon;
- automatic slot optimization.

Do not replace them with other booking-policy controls.

The product rules for those concepts are frozen elsewhere and do not belong on this page.

## 5. Actions

Keep:

**`ذخیره تغییرات`**

Remove:

**`بازگردانی پیش‌فرض`**

Do not add import/export/reset/bulk actions.

## 6. Remove unrelated / stale content

Remove:

- `مدیریت متخصصان` link inside the guidance block;
- lower business card with address/internal phone;
- exact fictional contact details;
- VIP terminology;
- system-sync claims.

## 7. Static date

Replace:

`امروز: پنج‌شنبه ۲۴ آبان`

with:

**`پنج‌شنبه ۲۴ آبان`**

## Product boundary

Do not add:

- booking horizon controls;
- lead-time controls;
- slot-grid controls;
- specialist schedule editing;
- breaks;
- time off;
- holiday exception system;
- branches;
- live booking status;
- analytics.

## Required output

Return exactly one:

- **Manager Salon Hours — desktop/default**

The result should look immediately recognizable as the old Salon Hours screen cleaned up.

No specialist schedule state.
No break/time-off state.
No mobile/tablet.
No new capability.
