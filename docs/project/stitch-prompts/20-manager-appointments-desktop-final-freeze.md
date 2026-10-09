# Stitch Prompt 20 — Manager Appointments desktop final freeze

Apply one final **desktop-only product-contract cleanup pass** to the existing Manager Appointments design.

Do **not** generate mobile/tablet screens in this pass.

Do **not** redesign the desktop visual system.

Preserve the current accepted desktop structures:

- workspace/list;
- search/filter;
- appointment detail;
- cancel confirmation;
- cancelled detail;
- reschedule date/time;
- reschedule review;
- stale reschedule recovery;
- reassignment;
- invalid/unavailable reassignment;
- concurrent-change conflict;
- Completed detail;
- No-show detail.

## 1. Workspace / search / detail

Keep the current layouts.

Use only appointment-relevant data:

- reference ID;
- customer name;
- verified mobile;
- optional email;
- specialist;
- booked services;
- date/time;
- duration;
- status;
- booked total price;
- **پرداخت در سالن**.

Statuses only:

- تأییدشده
- انجام‌شده
- لغوشده
- عدم حضور

Remove:
- payment status;
- settlement;
- invoice;
- CRM/member/loyalty status;
- customer score/history;
- chair/studio/resource assignment.

## 2. Payment wording — exact

Use only:

**پرداخت در سالن**

Do not show:

- تسویه‌شده / تسویه‌نشده;
- هزینه جابه‌جایی رایگان;
- cancellation fee;
- refund/credit;
- deposit/prepayment;
- transaction/POS/invoice;
- before-service / after-service payment timing.

Booked total price may remain visible.

## 3. Customer data — no CRM / loyalty

Remove:

- عضو ویژه;
- VIP / Gold / Diamond;
- visit counts;
- lateness history;
- CRM identifiers;
- customer scoring.

Keep only identity necessary for the appointment.

## 4. Specialist data — neutral only

Remove:

- ratings/stars;
- certificates;
- master/senior proof claims;
- dermatology/clinical credentials;
- marketing labels.

Use neutral expertise labels only.

## 5. Service fixtures — neutral beauty language

Remove:

- spa/wellness terminology;
- lymphatic / therapeutic / clinical wording;
- organic/material claims;
- “treatment” language where it reads medically.

Use ordinary non-clinical beauty-service names/descriptions.

## 6. Remove chair/studio/resource-management scope

Remove:

- VIP chair;
- chair number;
- station/unit;
- studio allocation;
- service cabin/resource assignment.

These are not part of Manager Appointments v1.

## 7. Cancel confirmation — product wording only

Keep the current destructive confirmation layout.

State:

- this cancels the appointment;
- status becomes Cancelled;
- the action is final for this appointment;
- the appointment remains available as a read-only historical record.

Remove:

- database wording;
- session IDs;
- log IDs;
- backend/technical persistence language;
- fee/refund claims.

## 8. Cancelled / Completed / No-show detail

Make each a simple read-only historical appointment snapshot.

Show:

- final status;
- reference ID;
- customer;
- services at booking;
- specialist;
- original date/time;
- duration;
- booked total price;
- pay-at-salon context if useful.

Remove:

- financial settlement records;
- POS/transaction details;
- invoice/receipt actions;
- CRM history;
- chair/studio/resource;
- check-in/exit operational timeline;
- print actions;
- refund/debt language.

No reversible actions.

## 9. Reschedule — keep the correct scheduling model

Keep:

- date/time only;
- services fixed;
- specialist fixed;
- duration fixed;
- booked price fixed;
- 30-minute appointment start grid;
- current valid availability;
- explicit selected new time;
- stale recovery with no replacement preselected.

Remove:

- free reschedule / zero-fee wording;
- payment-state changes;
- notification promises;
- clinical/material fixture copy.

## 10. Reassignment — narrow to exact product semantics

Keep:

- current specialist;
- booked services;
- unchanged date/time;
- unchanged duration;
- unchanged booked price;
- replacement specialists that can perform all booked services;
- full-interval availability;
- explicit manager selection and confirmation;
- invalid/unavailable state.

Remove:

- ratings;
- certificates;
- loyalty;
- emergency/sick-leave narrative;
- finance/settlement language;
- department/clinical claims;
- nearby-slot recommendations.

Reassignment does not change time.

## 11. Concurrent-change conflict — keep it focused

Use only product-level wording:

**«این نوبت از آخرین بازبینی شما تغییر کرده است. برای جلوگیری از بازنویسی اطلاعات جدید، عملیات فعلی متوقف شد. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.»**

Show:

- latest appointment state;
- review/refresh latest state;
- return to appointments.

Remove:

- HTTP/status codes;
- ETag/version tokens;
- database/session/log details;
- loyalty tier;
- chair/studio allocation;
- premium/central-studio wording;
- unnecessary internal audit timeline.

Do not silently overwrite.

## 12. Manager navigation

Keep only:

- نوبت‌ها
- خدمات
- متخصصان
- ساعات کاری سالن
- برنامه کاری متخصصان
- زمان‌های استراحت
- مرخصی‌ها

Do not add:
- analytics;
- CRM;
- finance/payments;
- marketing;
- inventory;
- payroll;
- complex role administration.

## Required output — desktop only

Return corrected desktop versions of:

1. workspace/list;
2. search/filter;
3. active appointment detail;
4. cancel confirmation;
5. Cancelled detail;
6. reschedule date/time;
7. reschedule review;
8. stale reschedule recovery;
9. reassignment;
10. invalid/unavailable reassignment;
11. concurrent-change conflict;
12. Completed detail;
13. No-show detail.

No mobile/tablet output in this pass.

No new product features.

If this desktop pass complies, the Manager Appointments desktop baseline will be frozen. Mobile/tablet will be handled separately afterward.
