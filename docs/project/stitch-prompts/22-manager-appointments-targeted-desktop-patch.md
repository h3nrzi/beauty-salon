# Stitch Prompt 22 — Manager Appointments targeted desktop patch

Patch only the remaining problematic **desktop** Manager Appointments screens.

This is not a redesign.

Do not generate mobile/tablet.

Do not regenerate already-clean screens unless Stitch requires them for consistency.

Preserve the current manager shell, navigation, layout, typography, spacing, tables/cards and interaction patterns.

## Patch screen _1 — workspace/list

Remove:

- «ثبت نوبت دستی»
- any new/manual appointment creation action
- «مبلغ و تسویه»
- any extra operational state such as «در انتظار تعیین تکلیف»

Use:

- statuses only:
  - تأییدشده
  - انجام‌شده
  - لغوشده
  - عدم حضور
- «مبلغ ثبت‌شده نوبت»
- optional «پرداخت در سالن»

Do not add payment status.

## Patch screen _3 — search/filter result

Remove completely:

- «ثبت نوبت جدید»
- «در انتظار تایید»
- «در حال پذیرش و ارائه»
- customer membership date/history
- lateness history
- CRM/customer scoring
- «متخصص ارشد»
- SMS reminder language
- reception slip / print
- chair/resource-management guidance
- any helper saying manager changes are allowed only until 15 minutes before start

Keep:

- search by customer name, mobile or appointment/reference ID
- date filter
- specialist filter
- status filter with only:
  - تأییدشده
  - انجام‌شده
  - لغوشده
  - عدم حضور
- result card/row with customer, mobile, services, specialist, date/time, duration, booked total price, status
- open-detail action

Use neutral specialist expertise.

## Patch screen _6 — cancel confirmation

Replace proof/hierarchy labels such as:

- «آرایشگر ارشد»

with neutral wording such as:

- «متخصص مو و میکاپ»
- or another simple fixture expertise label

Do not introduce credentials, ratings or role hierarchy.

Keep the existing destructive confirmation structure.

## Patch screen _7 — reschedule review

Remove:

- «مرحله پیش‌ثبت»
- «Pre-Commit»
- technical/system-process wording
- «اسپا» fixture wording
- clinical/wellness/service-treatment wording

Use a simple heading/state such as:

- «مرور تغییر زمان»
- «آماده تأیید»

Show only:

- زمان فعلی
- زمان جدید انتخاب‌شده
- services fixed
- specialist fixed
- total duration fixed
- booked total price fixed
- «پرداخت در سالن»
- final confirm action

Use neutral beauty-service fixture names.

## Patch screen _10 — specialist reassignment

Remove:

- «فاکتور»
- «تسویه»
- legal/executive-system wording
- finance/accounting semantics

Use:

- «مبلغ ثبت‌شده نوبت»
- «پرداخت در سالن»

State clearly:

- specialist changes;
- services remain unchanged;
- date/time remain unchanged;
- duration remains unchanged;
- booked total price remains unchanged.

Success text:

**«متخصص نوبت با موفقیت تغییر کرد. خدمات، تاریخ و ساعت، مدت و مبلغ ثبت‌شده نوبت بدون تغییر باقی ماندند.»**

## Patch screen _11 — concurrent-change conflict

Keep the current accepted conflict visual structure.

Remove:

- customer-written notes
- internal notes
- narrative/audit history not required to resolve the conflict
- CRM-like history

Use only:

**«این نوبت از آخرین بازبینی شما تغییر کرده است. عملیات فعلی متوقف شد تا اطلاعات جدید بازنویسی نشود. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.»**

Show:

- latest current appointment summary
- review latest state
- return to appointments

## History wording cleanup where needed

If any affected screen calls Cancelled/Completed/No-show records a separate «بایگانی» product, use:

- «تاریخچه نوبت»
- «اطلاعات فقط‌خواندنی»

Do not create an Archive section/product.

## Do not change

Do not alter the already accepted semantics for:

- reschedule 30-minute start grid
- stale reschedule recovery
- invalid/unavailable reassignment
- Completed detail
- No-show detail
- active appointment detail

## Required output

Return only the corrected desktop screens needed for the patch:

- workspace/list
- search/filter
- cancel confirmation
- reschedule review
- specialist reassignment
- concurrent-change conflict

If needed, include corrected Cancelled wording only.

No mobile/tablet.
No new feature.
No new product-contract Markdown.

If these patches comply, Manager Appointments Desktop will be frozen.
