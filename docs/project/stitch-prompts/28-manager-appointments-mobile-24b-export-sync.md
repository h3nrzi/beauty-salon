# Stitch Prompt 28 — Manager Appointments Mobile 24B export-sync patch

Patch the existing **three Mobile 24B screens only**.

This is not a redesign.

## Select in Stitch

Select these three generated Mobile 24B screens together:

- جزئیات نوبت فعال
- تأیید لغو نوبت
- جزئیات نوبت لغوشده — فقط‌خواندنی

The previous patch corrected much of the content, but the exported screenshots and screen content are not fully synchronized.

## Goal

Make the **visible Stitch screens** match the already-corrected product semantics, so that the next export's `screen.png` and `code.html` agree.

Do not preserve stale visible text from earlier iterations.

## 1. Cancel confirmation visible screen

Ensure the visible screen shows:

- title: `تأیید لغو نوبت`
- single-salon wording only; no `سالن اصلی`
- reference ID: `ARA-14030225-01`
- customer: `سارا احمدی`
- mobile: `۰۹۱۲۳۴۵۶۷۸۹`
- neutral specialist wording
- booked services
- date/time
- total duration
- booked total price
- `پرداخت در سالن`

History copy:

**`پس از لغو، این نوبت در تاریخچه نوبت‌ها به‌صورت فقط‌خواندنی باقی می‌ماند.`**

Remove from the visible UI:

- English `Cancel Confirmation`
- `سالن اصلی`
- customer-file / archive wording
- CRM/resource/payment-state language

After success, use:

**`نوبت با موفقیت لغو شد و در تاریخچه نوبت‌ها به‌صورت فقط‌خواندنی باقی می‌ماند.`**

Do not use `در سوابق ذخیره گردید`.

## 2. Active appointment detail visible screen

Ensure the visible screen shows:

- title: `جزئیات نوبت`
- reference ID: `ARA-14030225-01`
- status: `تأییدشده`
- customer: `سارا احمدی`
- mobile: `۰۹۱۲۳۴۵۶۷۸۹`
- label: `موبایل تأییدشده`
- optional email
- neutral specialist
- booked consecutive services
- date/time
- total duration
- `مبلغ کل نوبت` or `مبلغ ثبت‌شده نوبت`
- `پرداخت در سالن`

Manager actions only:

- `جابه‌جایی زمان`
- `تغییر متخصص`
- `لغو نوبت`

Remove from the visible UI:

- English `Appointment Details`
- `سالن اصلی`
- `تأیید پیامکی`
- `شیوه تسویه`
- `تسویه در محل`
- direct phone action
- operational timeline items such as arrival/preparation
- CRM/resource/notification language

## 3. Cancelled read-only detail consistency

Keep the current cleaned read-only structure.

Use the **same appointment snapshot** as the other two screens:

- reference ID: `ARA-14030225-01`
- customer: `سارا احمدی`
- mobile: `۰۹۱۲۳۴۵۶۷۸۹`
- same services
- same specialist
- same original date/time
- same duration
- same booked total price

Status:

`لغوشده`

Use:

- `تاریخچه نوبت`
- `اطلاعات فقط‌خواندنی`

Do not add reversible actions.

## 4. Export consistency requirement

The next export must have:

- `screen.png` visually matching its paired `code.html`;
- no old/stale pre-patch English or scope-drift content visible in screenshots.

Do not change the established mobile layout, bottom navigation, typography, spacing or action hierarchy.

## Required output

Return corrected versions of the same three Mobile 24B screens only.

No reschedule screens.
No reassignment screens.
No tablet.
No new product capability.

If the visible screens and exported HTML/screenshots are consistent, Mobile 24B will be frozen.
