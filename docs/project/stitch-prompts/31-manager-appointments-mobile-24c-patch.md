# Stitch Prompt 31 — Manager Appointments Mobile 24C targeted patch

Patch the existing **three Mobile 24C reschedule screens only**.

This is not a redesign.

## Select in Stitch

Select these three generated mobile screens together:

- جابه‌جایی زمان نوبت
- زمان انتخاب‌شده دیگر در دسترس نیست
- مرور و تأیید تغییر زمان

Preserve the current layout, spacing, date/time controls, cards, status treatment, button hierarchy and RTL styling.

## 1. Persian top titles

Replace the visible English top-bar titles:

- `Reschedule Select Datetime`
- `Reschedule Slot Recovery`
- `Reschedule Review Confirm`

with Persian:

- `جابه‌جایی زمان نوبت`
- `زمان انتخاب‌شده دیگر در دسترس نیست`
- `مرور و تأیید تغییر زمان`

No visible English screen titles should remain.

## 2. Date/time selection wording

Keep the 30-minute start grid and the existing selected time.

Replace:

`تأیید همپوشانی`

with product-level availability wording such as:

**`بدون تداخل زمانی`**

or:

**`برای مدت کامل نوبت در دسترس است`**

Do not introduce a manual approval step.

Keep:

- services fixed;
- specialist fixed;
- duration fixed;
- booked price fixed;
- `پرداخت در سالن`.

## 3. Stale recovery wording

Keep the existing stale interaction exactly:

- original appointment unchanged;
- lost replacement unavailable;
- fresh times shown;
- no replacement preselected;
- Continue disabled until explicit selection.

Remove:

- `مدیریت رزرواسیون اختصاصی`
- `تغییر وضعیت ظرفیت`
- `وضعیت نوبت فعلی: معتبر و پایدار`

Use simple product wording:

- `مدیر سالن`
- `زمان انتخاب‌شده دیگر در دسترس نیست`
- `نوبت فعلی بدون تغییر باقی مانده است`

Keep the existing explanatory message:

**`زمان انتخاب‌شده دیگر در دسترس نیست. نوبت فعلی بدون تغییر باقی مانده است. یک زمان جدید انتخاب کنید.`**

## 4. Review wording

Keep the old-time vs new-time comparison and final confirmation.

Remove:

- `منسوخ`
- `اختصاصی` beside the specialist
- calendar-registration wording such as `در تقویم سالن ثبت شد`

Use neutral labels only.

Success message:

**`زمان نوبت با موفقیت تغییر کرد.`**

Keep:

- `زمان قبلی نوبت`
- `زمان جدید انتخاب‌شده`
- unchanged services;
- unchanged specialist;
- unchanged total duration;
- unchanged booked total price;
- `پرداخت در سالن`;
- `تأیید تغییر زمان`.

## Do not change

Do not alter:

- 30-minute start grid;
- selected replacement time;
- stale recovery behavior;
- appointment fixture;
- service set;
- specialist;
- duration;
- booked total price;
- mobile visual structure.

Do not add:

- approval workflows;
- SMS/calendar notifications;
- payment status;
- CRM/loyalty;
- HTTP/ETag/database language;
- branch/resource semantics.

## Required output

Return corrected versions of the same three Mobile 24C screens only.

No reassignment screens.
No terminal-state screens.
No tablet.

If these corrections comply, Mobile 24C will be frozen.
