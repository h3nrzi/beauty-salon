# Stitch Prompt 24 — Manager Appointments Mobile / Tablet

Design the **Manager Appointments Mobile / Tablet** experience for آرا using the already frozen and organized desktop reference:

`references/manager-appointments-desktop/`

The desktop source is authoritative for visual language and interaction intent.

Do **not** redesign the manager product.

The goal is to create a compact responsive operational experience that preserves the same Manager Appointments product model without squeezing desktop tables into small screens.

## Source references

Use the organized desktop source:

- `references/manager-appointments-desktop/README.md`
- `references/manager-appointments-desktop/design-system.md`
- `references/manager-appointments-desktop/screens/`

Carry forward:

- visual hierarchy;
- status-chip language;
- appointment card/detail language;
- destructive-action treatment;
- reschedule/reassignment semantics;
- conflict/recovery semantics;
- Soft Editorial operational styling.

## Role and scope

This experience is for **Manager**.

Manager may:

- view all appointments;
- search appointments;
- open appointment details;
- cancel appointments;
- reschedule appointments;
- reassign specialist when valid.

Do not add:

- manual/new appointment creation;
- CRM;
- analytics;
- payment/settlement management;
- inventory;
- payroll;
- marketing;
- role administration;
- chair/station management;
- print/receipt workflows.

## Responsive targets

Design:

- **mobile** around 390 CSS px;
- **tablet** around 768 CSS px.

The interface must be operationally useful, not a miniature desktop dashboard.

Do not horizontally compress the desktop table.

## 1. Mobile / tablet appointments list

Transform the desktop workspace into readable cards or compact rows.

Each appointment should support:

- time;
- customer name;
- mobile snapshot;
- specialist;
- booked services;
- total duration;
- status;
- booked total price;
- open-detail action.

Statuses only:

- تأییدشده
- انجام‌شده
- لغوشده
- عدم حضور

Do not add extra workflow/payment statuses.

## 2. Search and filters

Provide a compact mobile/tablet search/filter pattern.

Search by:

- customer name;
- mobile;
- appointment/reference ID.

Filters:

- date;
- status;
- specialist.

On mobile, filters may use:

- filter drawer;
- bottom sheet;
- compact expandable controls.

Do not create a dense row of desktop dropdowns.

## 3. Appointment detail

Create a mobile/tablet detail screen showing:

- reference ID;
- customer name;
- verified mobile;
- optional email;
- booked services;
- specialist;
- date/time;
- total duration;
- booked total price;
- status;
- `پرداخت در سالن`.

For Confirmed appointments, expose manager actions:

- جابه‌جایی زمان;
- تغییر متخصص;
- لغو نوبت.

Do not show:

- CRM;
- loyalty;
- rating;
- payment status;
- invoice;
- chair/studio/resource assignment;
- SMS guarantees.

## 4. Manager cancel

Create compact mobile/tablet cancel confirmation.

Show:

- appointment identity;
- customer;
- services;
- specialist;
- date/time;
- destructive confirmation.

After success:

- status is Cancelled;
- appointment becomes read-only history;
- no replacement booking is created.

No fee/refund/credit/payment logic.

## 5. Manager reschedule

Create a compact reschedule flow.

Rules:

- date/time only;
- services unchanged;
- specialist unchanged;
- duration unchanged;
- booked price unchanged;
- appointment starts use the **30-minute grid**.

Show:

- current date/time;
- replacement date;
- available start times;
- selected new time;
- review/confirm.

Do not change services or specialist here.

## 6. Reschedule stale recovery

If the chosen replacement becomes unavailable:

- original appointment remains unchanged;
- lost replacement is shown unavailable;
- fresh times are shown;
- none selected initially;
- Continue disabled until explicit selection.

Do not silently choose another time.

## 7. Specialist reassignment

Create compact reassignment screens.

Show:

- current specialist;
- services;
- unchanged date/time;
- unchanged duration;
- unchanged booked price;
- eligible + available replacement specialists.

A replacement specialist must:

- perform all booked services;
- be available for the full appointment interval.

Do not change date/time or services.

## 8. Invalid / unavailable reassignment

Create a clear compact state for:

- specialist not eligible for all booked services;
- specialist unavailable for full appointment interval.

Current appointment remains unchanged.

Allow:

- choose another specialist;
- cancel reassignment.

## 9. Concurrent-change conflict

Create mobile/tablet conflict recovery using product language only:

**«این نوبت از آخرین بازبینی شما تغییر کرده است. عملیات فعلی متوقف شد تا اطلاعات جدید بازنویسی نشود. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.»**

Actions:

- review latest appointment;
- return to appointments.

Do not expose:

- HTTP codes;
- ETag;
- revision tokens;
- database language.

## 10. Terminal appointment detail

Provide read-only compact examples for:

- Completed;
- Cancelled;
- No-show.

Show only:

- final status;
- reference ID;
- customer;
- booked services;
- specialist;
- date/time;
- duration;
- booked total price.

Do not expose reversible actions.

## 11. Navigation

Adapt the Manager navigation for mobile/tablet.

Confirmed manager areas only:

- نوبت‌ها
- خدمات
- متخصصان
- ساعات کاری سالن
- برنامه کاری متخصصان
- زمان‌های استراحت
- مرخصی‌ها

Possible patterns:

- drawer;
- compact sidebar on tablet;
- menu sheet on mobile.

Do not create bottom navigation with unrelated product areas.

## 12. Interaction priority

Mobile/tablet should optimize for:

- quick lookup;
- reading appointment details;
- focused operational actions;
- clear destructive confirmations.

Do not attempt to show every desktop column at once.

## 13. Accessibility

Target WCAG 2.2 AA.

Show intent for:

- visible focus;
- touch-friendly controls;
- status not color-only;
- accessible filters;
- destructive-action clarity;
- readable Persian RTL;
- no horizontal overflow;
- dialogs/sheets with clear focus management.

## 14. Content truth

Use neutral fixture data.

Do not introduce:

- branches;
- spa/clinic positioning;
- ratings;
- certificates;
- CRM/loyalty;
- clinical/material claims;
- SMS promises;
- payment-state semantics;
- mock business facts as approved data.

## Required output

Return a **Manager Appointments Mobile / Tablet set** containing:

### Mobile
- appointments list/search;
- filters open state;
- active appointment detail;
- cancel confirmation/result;
- reschedule selection/review;
- stale reschedule recovery;
- specialist reassignment;
- invalid/unavailable reassignment;
- concurrent-change conflict;
- Completed detail;
- Cancelled detail;
- No-show detail.

### Tablet
Provide representative screens for:
- appointments workspace/list;
- search/filter;
- active detail;
- reschedule;
- reassignment;
- conflict/locked terminal state.

Do not regenerate desktop screens.

Do not introduce new product capabilities.

The result must feel like the responsive operational extension of the frozen Manager Appointments desktop baseline.
