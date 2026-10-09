# Stitch Prompt 21 — Manager Appointments desktop semantic cleanup only

Apply a final **desktop-only semantic/content patch** to the existing Manager Appointments screens.

This is **not a redesign**.

Do not change layout, information architecture, visual hierarchy, navigation structure, card/table patterns, modal structure or screen count.

Do not generate mobile/tablet.

Preserve the current 13 desktop screens and correct only the remaining product-contract/content problems.

## Global role wording

Replace:

- «مدیر ارشد»

with:

- **«مدیر سالن»**

Do not create manager hierarchy.

For specialists, avoid:

- ارشد;
- مستر;
- international/proof-style credentials.

Use neutral expertise labels only.

## 1. Workspace/list

Keep the layout and approved statuses.

Show only:

- reference ID;
- time;
- customer;
- mobile;
- specialist;
- services;
- total duration;
- status;
- booked total price.

If payment context appears, use only:

**پرداخت در سالن**

Remove:

- settlement/payment-status labels;
- POS/invoice language;
- CRM/loyalty/customer scoring;
- chair/studio/resource data.

## 2. Search/filter

Keep only statuses:

- تأییدشده
- انجام‌شده
- لغوشده
- عدم حضور

Keep search by:

- customer name;
- mobile;
- reference ID.

Use neutral specialist expertise.

Remove all CRM/history/loyalty/scoring language.

## 3. Active appointment detail

Keep existing detail structure.

Use only:

- reference ID;
- customer name;
- verified mobile;
- optional email;
- services snapshot;
- specialist;
- date/time;
- total duration;
- booked total price;
- status;
- **پرداخت در سالن**;
- manager actions.

Remove completely:

- «شیوه تسویه حساب»;
- «مبلغ کل فاکتور» wording — use «مبلغ ثبت‌شده نوبت» or «مبلغ کل نوبت»;
- «بدون پرونده CRM»;
- VIP chair / dedicated chair / station;
- SMS notification promises;
- operational notes not required to manage the appointment.

## 4. Cancel confirmation

Keep the same destructive confirmation layout.

Show:

- appointment reference;
- customer;
- specialist;
- date/time;
- services;
- duration;
- final warning;
- confirm cancellation.

Payment context, if shown, is only:

**پرداخت در سالن**

Remove all occurrences of:

- پیش‌پرداخت;
- بیعانه;
- تراکنش;
- refund;
- fee;
- invoice;
- database/session/log.

## 5. Cancelled detail

Keep the read-only layout.

Show only:

- status لغوشده;
- reference ID;
- customer;
- services snapshot;
- specialist;
- original date/time;
- duration;
- booked total price;
- read-only history state.

Remove:

- financial transaction/settlement language;
- archive product concepts beyond normal read-only history;
- branch/studio/chair;
- CRM.

## 6. Reschedule date/time

Keep the current layout and 30-minute **start grid**.

Services/specialist/duration/booked price remain fixed.

Use:

- «مبلغ ثبت‌شده نوبت»
- **پرداخت در سالن**

Do not use:

- invoice/factor;
- settlement;
- payment-status;
- clinical/material claims.

## 7. Reschedule review

Keep current old-time/new-time comparison.

Use exactly:

- «زمان فعلی»
- «زمان جدید انتخاب‌شده»

Keep:

- services fixed;
- specialist fixed;
- total duration fixed;
- booked price fixed;
- pay at salon.

Remove:

- «فرآیند درمان»;
- materials/consumables wording;
- settlement-account wording;
- SMS/calendar/system-notification guarantees;
- manager-shift preapproval language.

## 8. Stale reschedule recovery

Keep current recovery layout and semantics.

Required:

- original appointment unchanged;
- lost replacement marked unavailable;
- fresh available start times;
- no time selected initially;
- Continue disabled until explicit selection.

Important correction:

**Do not label available start times as “مدت: ۳۰ دقیقه”.**

The 30-minute rule is the **start-time grid**, not the appointment duration.

Show:
- start time only;
- and separately show the unchanged full appointment duration (e.g. ۱۳۵ دقیقه) in the appointment summary.

Remove:

- «پروتکل ۴۰۹»;
- transaction/security protocol wording;
- sync/engineering implementation language.

## 9. Specialist reassignment

Keep current layout.

Show only:

- current specialist;
- booked services;
- unchanged date/time;
- unchanged duration;
- unchanged booked total price;
- eligible/available replacements;
- explicit confirm.

Use neutral expertise labels.

Remove:

- invoice/factor wording;
- settlement;
- database wording;
- ratings;
- certificates;
- master/senior titles;
- clinical departments;
- nearby-slot recommendations;
- notifications.

Success wording should be:

**«متخصص نوبت با موفقیت تغییر کرد. خدمات، تاریخ و ساعت، مدت و مبلغ ثبت‌شده نوبت بدون تغییر باقی ماندند.»**

No «ثبت در پایگاه داده».

## 10. Invalid/unavailable reassignment

Keep the state layout.

Use only two reasons:

- متخصص برای همه خدمات این نوبت واجد شرایط نیست;
- متخصص برای کل بازه زمانی نوبت در دسترس نیست.

Remove:

- master/senior proof labels;
- department hierarchy;
- clinical/skin-treatment language;
- ratings/certificates.

## 11. Concurrent-change conflict

Keep the accepted conflict layout.

Use only:

**«این نوبت از آخرین بازبینی شما تغییر کرده است. عملیات فعلی متوقف شد تا اطلاعات جدید بازنویسی نشود. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.»**

Show:
- latest current appointment summary;
- review latest state;
- return to appointments.

Remove:

- payment status;
- «تسویه پس از ارائه خدمت»;
- central studio;
- internal note history;
- resource/chair allocation;
- technical/protocol/database details.

## 12. Completed detail

Make it a simple immutable read-only appointment snapshot.

Show:

- انجام‌شده;
- reference ID;
- customer;
- services at booking;
- specialist;
- historical date/time;
- duration;
- booked total price.

Optional payment context:

**پرداخت در سالن**

Remove:

- new transaction wording;
- invoice/receipt/financial archive;
- POS;
- print;
- treatment/clinical claims;
- resource/chair/studio;
- operational timeline.

## 13. No-show detail

Make it a simple immutable read-only appointment snapshot.

Show:

- عدم حضور;
- reference ID;
- customer;
- booked services;
- specialist;
- historical date/time;
- duration;
- booked total price.

Remove:
- clinical/facial-treatment framing;
- finance/settlement;
- CRM;
- resource assignment;
- reversible actions.

## Navigation

Keep only:

- نوبت‌ها
- خدمات
- متخصصان
- ساعات کاری سالن
- برنامه کاری متخصصان
- زمان‌های استراحت
- مرخصی‌ها

## Required output

Return corrected desktop versions of the same 13 existing screens.

No mobile/tablet.

No new features.

No new Markdown product contract.

The purpose of this pass is only to remove the remaining semantic/content drift so the desktop baseline can be frozen.
