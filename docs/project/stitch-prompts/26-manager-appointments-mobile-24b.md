# Stitch Prompt 26 — Manager Appointments Mobile 24B

Create the next Manager Appointments **mobile** batch by adapting the selected frozen desktop screens.

## Select in Stitch

Select these existing **desktop** Manager Appointments screens together:

- Active Appointment Detail
- Cancel Confirmation
- Cancelled Read-only Detail

Do not select the 24A mobile screens for this step unless you need one nearby only as a visual consistency reference.

## Goal

Adapt the selected desktop screens into a coherent **mobile experience around 390 CSS px**.

Preserve the same Soft Editorial manager visual language already established by Mobile 24A:

- Persian / RTL;
- compact operational hierarchy;
- touch-friendly controls;
- same status-chip treatment;
- same manager identity/header language;
- same approved mobile navigation pattern where navigation is visible.

Do not redesign the product.

## 1. Active appointment detail

Create a mobile detail screen for a **Confirmed** appointment.

Show:

- appointment/reference ID;
- customer name;
- verified mobile;
- optional email if present;
- booked services;
- specialist;
- date/time;
- total duration;
- booked total price;
- status `تأییدشده`;
- `پرداخت در سالن`.

Manager actions:

- `جابه‌جایی زمان`
- `تغییر متخصص`
- `لغو نوبت`

The action hierarchy must make the destructive cancel action visually distinct from the two non-destructive actions.

Do not show:

- CRM/loyalty;
- ratings;
- invoice/payment status;
- chair/studio/resource assignment;
- SMS/notification guarantees;
- manual booking creation.

## 2. Cancel confirmation

Create a compact destructive confirmation state.

Show enough context to prevent accidental cancellation:

- reference ID;
- customer;
- booked services;
- specialist;
- date/time;
- total duration.

Use clear product-level wording:

- this action cancels the appointment;
- status becomes `لغوشده`;
- the action is final for this appointment;
- the appointment remains available in read-only history.

Primary destructive action:

`تأیید لغو نوبت`

Secondary action:

`انصراف`

Do not introduce:

- cancellation fee;
- refund/credit;
- deposit/prepayment;
- transaction/payment workflow;
- database/session/log wording.

## 3. Cancelled read-only detail

Create a mobile read-only detail state after cancellation.

Show:

- status `لغوشده`;
- reference ID;
- customer;
- booked services snapshot;
- specialist;
- original date/time;
- total duration;
- booked total price.

Optional payment context only:

`پرداخت در سالن`

The screen must not expose:

- reschedule;
- reassign;
- restore/reopen;
- reversible status actions.

Use history/read-only language, not a separate “archive product”.

## Mobile navigation

Where navigation is visible, keep the same approved pattern as Mobile 24A.

Do not add:

- settings;
- notification center;
- analytics;
- CRM;
- finance;
- other new areas.

## Accessibility

Keep:

- touch-friendly action targets;
- readable RTL;
- status not color-only;
- clear destructive confirmation;
- no horizontal overflow.

## Required output

Return exactly these three mobile screens:

1. Active Appointment Detail
2. Cancel Confirmation
3. Cancelled Read-only Detail

No reschedule screens yet.
No reassignment screens yet.
No tablet screens.
No new product capability.

If this batch complies, Mobile 24B will be frozen before moving to the reschedule batch.
