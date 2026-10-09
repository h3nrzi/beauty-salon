# Stitch Prompt 18 — Manager Appointments completion pass

Refine the existing **Manager — Appointments** experience for آرا.

This is **not a redesign**.

Preserve the accepted operational visual language from Prompt 17:

- right-side manager navigation;
- desktop-first workspace;
- appointments list/table;
- search/filter pattern;
- appointment-detail hierarchy;
- status chips;
- Soft Editorial operational styling.

The goal is to complete the missing manager-operation flows and remove scope drift so the Manager Appointments baseline can be frozen.

## 1. Keep v1 manager scope exact

Manager may:

- view all appointments;
- search appointments;
- open appointment details;
- cancel appointments;
- reschedule appointments;
- reassign specialist when valid.

Do **not** add:

- manual/new appointment creation;
- walk-in booking creation;
- CRM;
- payment/settlement management;
- cashier workflow;
- printing/reception slips;
- chair/station assignment;
- analytics/capacity dashboard;
- loyalty;
- marketing;
- notifications center.

Remove all «ثبت نوبت دستی / ثبت نوبت جدید» actions and related shortcuts.

## 2. Appointment statuses

Use only:

- تأییدشده
- انجام‌شده
- لغوشده
- عدم حضور

Do not add:

- در انتظار تایید;
- در حال پذیرش;
- payment pending;
- waitlist;
- draft.

Bookings are already Confirmed when successfully created.

## 3. Workspace / list cleanup

Keep the existing desktop workspace structure.

Each row may show:

- appointment/reference ID;
- time;
- customer name;
- verified mobile snapshot;
- specialist;
- booked services;
- total duration;
- status;
- booked total price;
- «پرداخت در سالن» context.

Do not show/manage:

- payment-settlement state;
- refund status;
- cancellation fee;
- loyalty/member status;
- lateness history;
- CRM status.

Filters may include:

- date;
- status;
- specialist.

Search may match:

- customer name;
- mobile;
- appointment/reference ID.

## 4. Appointment detail cleanup

Preserve the existing detail layout but show only:

- reference ID;
- customer name;
- verified mobile;
- optional email;
- booked service snapshots;
- booked total price;
- specialist;
- date/time;
- duration;
- current status;
- «پرداخت در سالن».

Remove:

- CRM/member-history language;
- ratings/credentials;
- VIP chair / workstation assignment;
- SMS notification promises;
- cashier/settlement workflow;
- invented operational notes.

## 5. Manager cancel flow — required

Create:

### Cancel confirmation
Show:

- appointment identity;
- customer;
- services;
- specialist;
- date/time;
- explicit destructive confirmation.

Do not add:

- fees;
- refunds;
- credits;
- SMS guarantees.

### Cancelled result/detail
Show:

- status becomes Cancelled;
- original appointment snapshot remains visible;
- no replacement booking is created automatically;
- return to list/detail.

## 6. Manager reschedule flow — required

Manager reschedule changes **date/time only**.

Preserve:

- services;
- specialist;
- duration;
- booked price snapshot.

Show:

- current date/time;
- valid replacement dates/times;
- 30-minute public start grid;
- availability for the same specialist and full consecutive duration;
- selected replacement;
- review/confirm.

Do not change services or specialist in this flow.

## 7. Reschedule conflict/stale state — required

If the selected replacement time becomes invalid before commit:

- do not modify the existing appointment;
- show that the selected replacement is no longer available;
- preserve appointment/services/specialist;
- show fresh current alternatives;
- preselect none;
- require explicit new selection;
- Continue disabled until selection.

Do not silently move the appointment.

## 8. Specialist reassignment — required

Create a dedicated manager reassignment flow.

Show:

- current specialist;
- booked services;
- unchanged appointment date/time;
- unchanged duration;
- eligible replacement specialists.

A replacement specialist must:

- be eligible for all booked services;
- be available for the full appointment interval.

Manager explicitly chooses and confirms.

Do not:

- change services;
- change date/time;
- split across specialists;
- auto-pick a specialist.

## 9. Invalid/unavailable reassignment state — required

Show a clear state when a target specialist:

- cannot perform all booked services; or
- is not available for the full appointment interval.

Keep current appointment unchanged.

Allow manager to:

- choose another eligible specialist;
- cancel the reassignment action.

Do not auto-correct the appointment.

## 10. Conflict / concurrent-change state

If appointment data changed elsewhere before a manager action commits:

- show a clear conflict state;
- do not overwrite silently;
- refresh/display current appointment state;
- require manager review before trying again.

Do not prescribe engineering implementation details.

## 11. Terminal-state detail examples

Provide representative detail/read-only treatments for:

- Completed;
- Cancelled;
- No-show.

Terminal states must not expose reversible status controls in this manager baseline.

No payment/refund/accounting workflow.

## 12. Remove unsupported operational copy

Remove all references to:

- manual booking creation;
- “15 minutes before start” manager cutoff;
- SMS reminders/change notifications;
- live synchronization guarantees;
- shift capacity percentages;
- one-slot-left analytics;
- VIP chairs/stations;
- print slip;
- CRM/customer membership;
- lateness history;
- fee/refund/credit;
- settlement status.

Use concise neutral operational copy.

## 13. Multi-service semantics

Use:

- services are consecutive;
- one specialist performs the full booked service set;
- duration is the sum of service durations.

Do not use wording suggesting simultaneous parallel services.

## 14. Mobile/tablet direction — required

Provide a compact responsive representation for essential manager appointment operations.

Show at least:

- appointment search/list;
- appointment detail;
- status;
- primary manager actions where appropriate.

Do not cram the desktop table into a tiny viewport.

The mobile/tablet representation is for operational lookup/action, not a new product model.

## 15. Navigation

Manager navigation may contain only confirmed v1 areas:

- نوبت‌ها
- خدمات
- متخصصان
- ساعات کاری سالن
- برنامه کاری متخصصان
- زمان‌های استراحت
- مرخصی‌ها

Do not add analytics, CRM, payments, marketing, inventory, payroll or role administration.

## 16. Accessibility

Preserve intent for:

- visible focus;
- keyboard-operable search/filter/actions;
- readable RTL data tables/cards;
- status not color-only;
- accessible destructive confirmation;
- clear disabled/ineligible specialist states;
- understandable conflict/recovery states.

## Required output

Return a **Manager Appointments freeze-candidate set** containing:

- desktop workspace/list;
- desktop search/filter result;
- desktop appointment detail;
- cancel confirmation;
- cancelled result/detail;
- reschedule date/time;
- reschedule review/confirmation;
- reschedule stale/conflict state;
- specialist reassignment;
- invalid/unavailable reassignment;
- concurrent-change conflict state;
- representative Completed detail;
- representative Cancelled detail;
- representative No-show detail;
- compact mobile/tablet appointment list/search;
- compact mobile/tablet appointment detail.

Do not design Services/Specialists/Schedules management yet.

Do not generate new product-contract Markdown that promotes fixture data or new operations to approved scope.
