# Stitch Prompt 19 — Manager Appointments final freeze pass

Apply one final **contract-cleanup + responsive-evidence pass** to the existing Manager Appointments design.

This is **not a redesign**.

Preserve:

- manager shell and right-side navigation;
- appointments workspace/table structure;
- search/filter layout;
- appointment-detail hierarchy;
- cancel/reschedule/reassign action hierarchy;
- status-chip language;
- Soft Editorial operational styling.

## 1. Mobile/tablet evidence — required

Create a compact responsive representation for essential manager appointment operations.

Provide:

### Compact appointment list/search
Around 390–768 CSS px.

Show:
- search;
- date/status/specialist filters in a mobile-friendly pattern;
- appointment cards/rows;
- time;
- customer;
- specialist;
- services;
- duration;
- status;
- open-detail action.

Do not squeeze the desktop table horizontally.

### Compact appointment detail
Show:
- reference ID;
- customer name/mobile;
- services;
- specialist;
- date/time;
- duration;
- booked total price;
- status;
- pay-at-salon context;
- manager actions appropriate to the current state.

No new functionality.

## 2. Status model — exact

Use only:

- تأییدشده
- انجام‌شده
- لغوشده
- عدم حضور

Remove:
- در انتظار تأیید
- در حال پذیرش و ارائه
- payment/settlement states
- draft/waitlist/refund statuses.

## 3. Reschedule start-grid correction

Manager rescheduling changes **date/time only**.

Keep:
- services fixed;
- specialist fixed;
- duration fixed;
- booked price fixed.

All selectable appointment start times must use the **30-minute start grid**.

Do not show 11:45 / 14:15 / 18:45 style starts.

Use valid examples such as:
- 11:30
- 12:00
- 14:30
- 15:00
- 16:30
- 18:00

subject to availability and full consecutive duration.

## 4. Remove deposit/prepayment semantics

Remove all:
- پیش‌پرداخت
- بیعانه
- deposit
- transferred deposit
- paid-in-advance language.

Use only:

**پرداخت در سالن**

The appointment may display its booked total price snapshot.

Do not define settlement timing or payment status.

## 5. Remove accounting/payment operations

Do not show/manage:

- settled/unsettled;
- POS;
- transaction reference;
- invoice state;
- refund;
- debt/credit;
- cashier workflow;
- financial archive.

Only show booked total price + pay-at-salon context.

## 6. Remove CRM / loyalty / customer scoring

Remove:

- VIP / gold / diamond;
- customer-club membership;
- visit counts;
- lateness history;
- customer score;
- CRM record wording.

Keep only:
- customer name;
- verified mobile snapshot;
- optional email snapshot;
- appointment/reference ID.

## 7. Specialist content — neutral only

Remove:

- ratings/stars;
- international certificates;
- master/senior proof claims;
- dermatology/clinical credentials;
- marketing claims.

Use neutral expertise labels.

Reassignment eligibility depends only on:
- ability to perform all booked services;
- availability for the full appointment interval.

## 8. Remove notifications/messaging promises

Do not say operations automatically send:

- SMS;
- reminders;
- calendar notifications.

Messaging implementation is not frozen.

## 9. Remove salon resource management

Remove:

- VIP chair;
- unit/station number;
- studio allocation;
- resource assignment.

v1 does not manage chairs/stations.

## 10. Remove print/receipt operations

Do not show:

- چاپ رسید;
- reception slip;
- invoice print;
- financial receipt workflow.

## 11. Concurrent-change conflict — product wording only

Keep the conflict/recovery pattern, but remove:

- 409;
- HTTP/status-code language;
- ETag;
- version-token strings;
- optimistic-locking terminology.

Use simple product language:

**«این نوبت از آخرین بازبینی شما تغییر کرده است. برای جلوگیری از بازنویسی اطلاعات جدید، عملیات فعلی متوقف شد. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.»**

Actions:
- refresh/review latest appointment;
- return to appointment workspace.

Do not silently overwrite.

## 12. Reassignment cleanup

Keep only:

- current specialist;
- booked services;
- unchanged date/time;
- unchanged duration;
- unchanged booked price;
- eligible/available replacement specialists;
- explicit confirmation.

Invalid/unavailable specialist state may explain:
- not eligible for all services; or
- unavailable for the full interval.

Remove:
- loyalty;
- emergency/sick-leave story;
- ratings;
- certificates;
- payment status;
- SMS/calendar messages.

## 13. Terminal-state detail cleanup

For Completed / Cancelled / No-show, use a simple read-only appointment snapshot:

- final status;
- reference ID;
- customer;
- services at booking;
- specialist;
- date/time;
- duration;
- booked total price;
- pay-at-salon context where useful.

Do not show:
- POS transaction details;
- invoice status;
- check-in/exit operational timeline;
- unit/chair/studio;
- CRM history;
- print;
- refund/debt semantics.

Terminal states must not expose reversible mutation actions.

## 14. Workspace cleanup

Keep the existing workspace/list visual structure.

Remove:
- payment settlement labels;
- “without deduction” cancellation copy;
- analytics/resource-capacity language;
- manual/new appointment creation.

No advanced analytics.

## 15. Navigation

Keep only confirmed manager areas:

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
- payments;
- marketing;
- inventory;
- payroll;
- role administration.

## Required output

Return:

1. corrected desktop workspace/list;
2. corrected desktop search/filter;
3. corrected desktop appointment detail;
4. corrected reschedule selection/review/stale state;
5. corrected reassignment + invalid state;
6. corrected concurrent-change conflict;
7. corrected Completed / Cancelled / No-show read-only detail;
8. compact mobile/tablet appointment list/search;
9. compact mobile/tablet appointment detail.

Do not create new product features.

Do not generate engineering-contract Markdown that promotes fixture data, HTTP/ETag details, payment state or CRM concepts into approved scope.

If this pass complies, Manager Appointments should be ready to freeze.
