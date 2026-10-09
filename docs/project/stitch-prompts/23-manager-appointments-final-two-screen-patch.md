# Stitch Prompt 23 — Manager Appointments final two-screen desktop patch

Patch **only two existing desktop screens** in Manager Appointments.

Do not redesign anything.

Do not generate mobile/tablet.

Do not regenerate the other desktop screens.

Preserve all current layout, visual hierarchy, navigation, typography, spacing and component styling.

## Screen 1 — Search / Filter result

Remove completely:

- `ثبت نوبت فوری`
- `Ctrl + N`
- any manual/new appointment creation shortcut or action.

Keep:

- search by customer name / mobile / appointment reference ID;
- date filter;
- specialist filter;
- status filter;
- statuses only:
  - تأییدشده
  - انجام‌شده
  - لغوشده
  - عدم حضور
- appointment result;
- open-details action.

Do not replace the removed shortcut with another creation action.

## Screen 2 — Reschedule review

Keep the existing review layout.

Show:

- زمان فعلی;
- زمان جدید انتخاب‌شده;
- services unchanged;
- specialist unchanged;
- total duration unchanged;
- booked total price unchanged;
- پرداخت در سالن;
- final manager confirmation.

Replace wording such as:

- «توسط متخصص و مدیر شیفت تایید اولیه شده است»
- «تنظیمات اطلاع‌رسانی»

with simple product-level availability wording:

**«این زمان برای متخصص فعلی و مدت کامل نوبت در دسترس است.»**

Do not introduce:

- specialist approval;
- manager-shift approval;
- notification settings;
- SMS/calendar notifications;
- technical pre-commit terminology.

## Required output

Return only:

1. corrected Search / Filter desktop screen;
2. corrected Reschedule Review desktop screen.

No new screens.
No mobile/tablet.
No new feature.
No new product-contract Markdown.

If these two patches comply, Manager Appointments Desktop will be frozen.
