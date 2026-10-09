# Stitch Prompt 17 — Manager Appointments

Design the **Manager — Appointments** operational experience for the existing Persian/RTL product **آرا**, using the frozen public, Booking and My Appointments visual references.

Do not redesign the visual system.

This is the first salon-operations surface. It should feel operational, efficient and calm while still belonging to the same آرا product.

## Role

This experience is for **Manager**.

Manager may:

- view all appointments;
- search appointments;
- open appointment details;
- cancel appointments;
- reschedule appointments;
- reassign the specialist when the appointment remains valid for the new specialist.

Do not introduce broader CRM, reporting, accounting or staff-role administration.

## Core appointment model

Customer-visible lifecycle remains:

- Confirmed
- Completed
- Cancelled
- No-show

The manager may see these statuses across salon appointments.

Do not add:
- Pending approval;
- payment pending;
- waitlist;
- refunded;
- draft appointment.

Successful customer bookings are already Confirmed; manager does not approve bookings manually.

## A. Appointments workspace

Design a desktop-first operational workspace around 1440 CSS px.

Show:

- today's / upcoming appointments;
- search;
- filters useful for operations;
- clear appointment status;
- time;
- customer;
- specialist;
- services;
- duration.

Useful filters may include:

- date;
- status;
- specialist.

Keep filtering practical and compact.

Do not create advanced analytics/reporting.

## B. Search behavior

Support searching appointments by practical identifiers such as:

- customer name;
- customer mobile;
- appointment/reference ID.

Do not introduce CRM profiles or broad customer intelligence.

## C. Appointment detail

Show only operationally relevant information:

- appointment/reference ID;
- customer name;
- verified mobile snapshot;
- optional email snapshot if present;
- services booked;
- service-price snapshot / total booked price;
- specialist;
- date/time;
- total duration;
- current status;
- pay-at-salon context.

Do not overwrite historical booking snapshots with current service catalog values.

Do not add:
- ratings;
- loyalty;
- preferences;
- marketing notes;
- medical information.

## D. Manager cancel

Manager can cancel a valid appointment.

Design:

- explicit destructive confirmation;
- clear appointment identity;
- resulting Cancelled state.

Do not invent:

- refunds;
- credits;
- cancellation fees;
- loyalty effects.

Do not automatically create a replacement booking.

## E. Manager reschedule

Design a focused reschedule flow.

Preserve:

- booked services;
- assigned specialist;
- duration;
- booked price snapshot.

Change only:

- date/time.

Use valid current availability for the same specialist and complete service duration.

If a selected replacement slot becomes stale before commit:

- keep the existing appointment unchanged;
- show fresh current times;
- do not preselect a replacement;
- require explicit new selection.

Do not silently move the appointment.

## F. Manager reassign specialist

Manager may change only the assigned specialist when the appointment remains valid.

Required rules:

- new specialist must be eligible for **all booked services**;
- appointment date/time remains unchanged;
- total duration remains unchanged;
- booked service/price snapshots remain unchanged;
- new specialist must actually be available for the full appointment interval.

Show:

- current specialist;
- eligible replacement specialists;
- unavailable/ineligible specialists clearly disabled or excluded;
- explicit confirmation before reassignment.

Do not:

- change services;
- change date/time during reassignment;
- split the appointment across specialists;
- auto-pick a specialist.

## G. Operation conflict / stale state

If the appointment changed elsewhere or a selected target is no longer valid before manager confirmation:

- show a clear conflict/recovery state;
- do not overwrite silently;
- preserve the latest valid appointment state;
- require manager to review current data again.

Keep this visual concept simple; implementation details such as revision tokens belong later.

## H. Completed / No-show visibility

Manager appointment lists/details should clearly display Completed and No-show records.

Do not invent reversible status actions from terminal states.

The dedicated Staff/Specialist workflow for marking Completed / No-show will be designed separately.

## I. Responsive behavior

Primary operational target is desktop.

Also provide a compact mobile/tablet representation for essential appointment lookup/detail, but do not force the full operational workspace into a dense mobile dashboard.

No functionality should contradict desktop.

## J. Navigation

Operational navigation may include only confirmed v1 manager areas:

- Appointments;
- Services;
- Specialists;
- Salon hours;
- Specialist schedules;
- Breaks;
- Time off.

Do not add:

- analytics;
- CRM;
- marketing;
- payroll;
- inventory;
- accounting;
- complex roles/permissions;
- notifications center as a new product area.

## K. Content truth

Use neutral fixture data.

Do not introduce:

- branches;
- spa/clinic positioning;
- ratings;
- certificates;
- clinical/material claims;
- loyalty;
- SMS guarantees;
- mock business data as approved production facts.

## L. Accessibility

Target WCAG 2.2 AA.

Show intent for:

- keyboard-operable search/filter/actions;
- visible focus;
- status not conveyed only by color;
- destructive confirmation clarity;
- readable tables/lists in RTL;
- responsive reflow;
- accessible empty/loading/conflict states.

## Required output

Return a **Manager Appointments set** with:

- desktop appointments workspace;
- search/filter state;
- appointment detail;
- cancel confirmation/result;
- reschedule flow;
- stale/conflict reschedule state;
- specialist reassignment flow;
- reassignment invalid/unavailable state;
- representative Completed/Cancelled/No-show list/detail states;
- compact mobile/tablet appointment lookup/detail direction;
- any design-system delta needed for operational tables, filters, status chips and destructive actions.

Do not design Services/Specialists/Schedules management yet. This prompt is only for the Manager's appointment operations.
