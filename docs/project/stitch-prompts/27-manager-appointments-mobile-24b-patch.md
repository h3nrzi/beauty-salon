# Stitch Prompt 27 — Manager Appointments Mobile 24B targeted patch

Patch the existing **Manager Appointments Mobile 24B** screens only.

This is not a redesign.

## Select in Stitch

Select these three generated 24B mobile screens together:

- جزئیات نوبت فعال
- تأیید لغو نوبت
- جزئیات نوبت لغوشده — فقط‌خواندنی

Apply only the corrections below.

## Preserve

Keep the current:

- mobile layouts;
- cards and spacing;
- status-chip treatment;
- action hierarchy;
- bottom navigation pattern from Mobile 24A;
- RTL styling;
- destructive-action styling.

Do not create new screens.

## 1. Persian top titles

Replace visible English titles:

- `Appointment Details`
- `Cancel Confirmation`

with Persian:

- `جزئیات نوبت`
- `تأیید لغو نوبت`

Keep the entire visible manager UI Persian / RTL.

## 2. Remove branch-like wording

Remove:

- `سالن اصلی`
- `حضور مراجع در سالن اصلی`

This product is one salon, not a branch system.

Use `سالن آرا` only where a salon label is genuinely needed, otherwise omit the label.

## 3. Cancel confirmation history wording

Keep the destructive confirmation layout.

Replace archive/customer-file wording with:

**«پس از لغو، این نوبت در تاریخچه نوبت‌ها به‌صورت فقط‌خواندنی باقی می‌ماند.»**

Remove:

- `بایگانی خودکار سابقه`;
- customer-file/archive wording;
- CRM implications;
- archive subsystem language.

Keep:

- reference ID;
- customer;
- specialist;
- booked services;
- date/time;
- duration;
- booked total;
- `پرداخت در سالن`;
- `تأیید لغو نوبت`;
- `انصراف`.

## 4. Cancelled read-only detail cleanup

Remove completely:

- `مشتری دائم`;
- `عضو باشگاه وفاداری آرا`;
- visit/customer-history labels;
- `فضای اختصاصی لاین مو`;
- `آرشیو مواد و فرمول‌ها`;
- formula/material archive concepts;
- resource/station/chair concepts;
- `مربی ارشد`;
- CRM/reporting/archive subsystem wording.

Use only:

- status `لغوشده`;
- reference ID;
- customer name;
- verified mobile;
- optional email;
- booked services snapshot;
- specialist with neutral expertise label;
- original date/time;
- total duration;
- booked total price;
- optional `پرداخت در سالن`;
- read-only history wording.

Use:

- `تاریخچه نوبت`
- `اطلاعات فقط‌خواندنی`

Do not use a separate `بایگانی` product concept.

## 5. Active appointment detail cleanup

Keep the current mobile detail structure and the three manager actions:

- `جابه‌جایی زمان`;
- `تغییر متخصص`;
- `لغو نوبت`.

Remove:

- `رزرو آنلاین تأییدشده`;
- `حضور مراجع در سالن اصلی`;
- `آماده‌سازی خدمات`;
- direct phone-call action if it is presented as an operational product action;
- branch/location semantics.

Show only:

- reference ID;
- status `تأییدشده`;
- date/time;
- total duration;
- customer name;
- verified mobile;
- optional email;
- specialist;
- booked consecutive services;
- booked total price;
- `پرداخت در سالن`.

## 6. Verified mobile wording

Replace implementation-style:

- `تأیید پیامکی`

with product-level:

- `موبایل تأییدشده`

Do not imply a messaging/notification workflow.

## 7. Payment wording

Remove:

- `شیوه تسویه`;
- `تسویه در محل`;
- payment-status language.

Use only:

- `مبلغ ثبت‌شده نوبت` or `مبلغ کل نوبت`;
- `پرداخت در سالن`.

No invoice, settlement, payment state, refund or transaction semantics.

## 8. Specialist wording

Use neutral expertise only.

Do not use:

- ارشد;
- مستر;
- مربی ارشد;
- ratings;
- certificates.

## Required output

Return corrected versions of the same three 24B mobile screens only:

1. جزئیات نوبت فعال
2. تأیید لغو نوبت
3. جزئیات نوبت لغوشده — فقط‌خواندنی

No reschedule screens.
No reassignment screens.
No tablet.
No new feature.

If these three screens comply, Mobile 24B will be frozen.
