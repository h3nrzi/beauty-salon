# Stitch Prompt 33 — Manager Appointments Mobile 24D

Create the next Manager Appointments **mobile specialist reassignment + conflict** batch by adapting the selected frozen desktop screens.

## Select in Stitch

Select these existing **desktop** Manager Appointments screens together:

- تغییر و تخصیص مجدد متخصص
- عدم امکان تخصیص متخصص جدید
- تعارض / تغییر هم‌زمان نوبت

Do not select unrelated screens.

## Goal

Adapt the selected desktop operational states into a coherent **mobile experience around 390 CSS px**.

Preserve the established Manager Appointments mobile language from 24A–24C:

- Persian / RTL;
- compact operational hierarchy;
- touch-friendly controls;
- same manager header/navigation treatment where visible;
- same status-chip/action styling;
- Soft Editorial visual direction.

Do not redesign the product.

## 1. Mobile specialist reassignment

Create a mobile specialist-reassignment screen.

Show:

- current appointment reference;
- current specialist;
- booked services;
- appointment date/time;
- total duration;
- booked total price;
- eligible replacement specialists.

Rules:

- only the specialist changes;
- services remain unchanged;
- date/time remain unchanged;
- duration remains unchanged;
- booked price remains unchanged.

A replacement specialist is valid only if they:

- can perform **all** booked services;
- are available for the **full appointment interval**.

Manager must explicitly choose one specialist and confirm.

Do not auto-pick a replacement.

Use neutral specialist expertise only.

Do not show ratings, certificates, senior/master hierarchy or clinical credentials.

## 2. Invalid / unavailable reassignment

Create a mobile invalid/unavailable state.

Use only these product reasons:

- `این متخصص برای همه خدمات این نوبت واجد شرایط نیست.`
- or `این متخصص برای کل بازه زمانی نوبت در دسترس نیست.`

Current appointment remains unchanged.

Allow:

- choose another eligible specialist;
- cancel/return without changing the appointment.

Do not:

- change date/time;
- split services across specialists;
- recommend nearby appointment times;
- introduce department/clinical/credential logic.

## 3. Concurrent-change conflict

Create a mobile conflict-recovery screen for the case where the appointment changed after the manager last viewed it.

Use exactly this product-level message:

**`این نوبت از آخرین بازبینی شما تغییر کرده است. عملیات فعلی متوقف شد تا اطلاعات جدید بازنویسی نشود. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.`**

Show:

- latest current appointment summary;
- what is currently authoritative enough for the manager to review;
- action to review latest appointment;
- action to return to appointments.

Do not silently overwrite.

Do not expose:

- HTTP/409;
- ETag;
- revision/version tokens;
- database/session/log details;
- internal audit timeline.

## Content boundary

Use neutral fixture content.

Do not introduce:

- CRM/loyalty;
- ratings/certificates;
- clinical/therapy claims;
- payment/settlement state;
- invoice/POS;
- SMS/notification promises;
- chair/studio/resource assignment;
- branches;
- manual booking creation.

If payment context appears, use only:

`پرداخت در سالن`

## Accessibility

Keep:

- touch-friendly specialist cards/actions;
- selected/invalid states not color-only;
- readable Persian RTL;
- clear confirmation hierarchy;
- no horizontal overflow.

## Required output

Return exactly these three mobile screens:

1. تغییر متخصص نوبت
2. عدم امکان انتخاب متخصص
3. تعارض تغییر هم‌زمان نوبت

No terminal-state screens yet.
No tablet screens.
No new product capability.

If this batch complies, Mobile 24D will be frozen before the final terminal-state mobile batch.
