# Stitch Prompt 30 — Manager Appointments Mobile 24C

Create the next Manager Appointments **mobile reschedule** batch by adapting the selected frozen desktop screens.

## Select in Stitch

Select these existing **desktop** Manager Appointments screens together:

- جابه‌جایی زمان نوبت
- مرور و تأیید تغییر زمان
- بازیابی زمان نامعتبر / Stale Reschedule Recovery

Do not select unrelated screens.

## Goal

Adapt the selected desktop reschedule experience into a coherent **mobile flow around 390 CSS px**.

Preserve the established Manager Appointments mobile visual language from 24A and 24B:

- Persian / RTL;
- compact operational hierarchy;
- touch-friendly controls;
- same status-chip language;
- same manager header/navigation treatment where visible;
- Soft Editorial styling.

Do not redesign the product.

## 1. Mobile reschedule date/time

Create a mobile date/time selection screen.

Show:

- current appointment summary;
- current date/time;
- selected specialist;
- booked services;
- total duration;
- booked total price;
- replacement date selection;
- available appointment start times.

Rules:

- reschedule changes **date/time only**;
- services remain unchanged;
- specialist remains unchanged;
- total duration remains unchanged;
- booked total price remains unchanged;
- appointment starts use the **30-minute grid**.

Available examples may use:

- ۱۰:۰۰
- ۱۰:۳۰
- ۱۱:۰۰
- ۱۴:۳۰
- ۱۵:۰۰

subject to availability.

Do not show 15-minute-offset starts such as 10:15 or 11:45.

Do not label a start-grid interval as the appointment duration.

## 2. Mobile reschedule review

Create a mobile review/confirmation screen.

Show clearly:

- `زمان فعلی`;
- `زمان جدید انتخاب‌شده`;
- services unchanged;
- specialist unchanged;
- total duration unchanged;
- booked total price unchanged;
- `پرداخت در سالن`.

Use product-level availability wording only, for example:

**`این زمان برای متخصص فعلی و مدت کامل نوبت در دسترس است.`**

Primary action:

`تأیید تغییر زمان`

Secondary action:

`بازگشت و انتخاب زمان دیگر`

Do not add:

- specialist approval;
- shift-manager approval;
- SMS/calendar notifications;
- payment/settlement state;
- technical pre-commit wording.

## 3. Mobile stale replacement recovery

Create the recovery state when the selected replacement becomes unavailable before confirmation.

Required semantics:

- original appointment remains unchanged;
- selected replacement is clearly marked unavailable;
- fresh current start times are shown;
- **no replacement time is preselected**;
- Continue/Review action is disabled until the manager explicitly chooses a new time.

Explain at product level:

**`زمان انتخاب‌شده دیگر در دسترس نیست. نوبت فعلی بدون تغییر باقی مانده است. یک زمان جدید انتخاب کنید.`**

Keep the unchanged appointment summary visible enough to reassure the manager.

Do not:

- silently choose a replacement;
- alter services;
- alter specialist;
- alter booked price;
- expose HTTP/409/ETag/version/database language.

## Content boundary

Use neutral fixture content.

Do not introduce:

- spa/clinic/therapeutic wording;
- ratings/certificates;
- CRM/loyalty;
- payment status;
- invoice;
- chair/studio/resource assignment;
- SMS/notification promises;
- branch semantics.

## Accessibility

Keep:

- touch-friendly date/time controls;
- readable RTL;
- selected/unavailable states not color-only;
- clear disabled state;
- no horizontal overflow.

## Required output

Return exactly these three mobile screens:

1. جابه‌جایی زمان — انتخاب تاریخ و ساعت
2. مرور و تأیید تغییر زمان
3. بازیابی زمان نامعتبر / زمان دیگر در دسترس نیست

No reassignment screens yet.
No terminal-state screens.
No tablet screens.
No new product capability.

If this batch complies, Mobile 24C will be frozen before moving to specialist reassignment/conflict.
