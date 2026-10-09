# Stitch Prompt 15 — My Appointments completion and contract pass

Refine the existing **آرا My Appointments** experience from Prompt 14.

This is **not a redesign**.

Preserve the accepted Soft Editorial application language and the existing mobile structures for:

- upcoming list;
- empty upcoming;
- appointment detail;
- reschedule;
- stale-slot recovery;
- cancel confirmation;
- locked state.

The goal is to complete missing states, add desktop parity, and remove product-contract drift so My Appointments can be frozen.

## 1. Keep the exact customer appointment model

Statuses:

- تأییدشده
- انجام‌شده
- لغوشده
- عدم حضور

Do not add:
- pending approval;
- payment pending;
- refunded;
- waitlist;
- draft appointment.

## 2. Upcoming list

Keep the current compact appointment-card direction.

Show:

- Confirmed status;
- date/time;
- specialist;
- selected services;
- total duration;
- booked total price;
- open-details action.

Order nearest upcoming first.

Do not show:
- branch;
- rating;
- certification;
- spa positioning.

## 3. Empty upcoming

Keep the current calm empty-state direction.

Allow:

- «رزرو وقت جدید»;
- optional path to Services.

Remove:

- support-chat prompt;
- Favorites;
- Account/Profile destination;
- promotional urgency.

## 4. Active appointment detail — more than 24 hours away

Show:

- Confirmed;
- services;
- specialist;
- date/time;
- duration;
- booked price snapshot;
- customer contact snapshot where appropriate;
- pay at salon;
- «جابه‌جایی زمان»;
- «لغو نوبت».

State clearly:

**جابه‌جایی فقط تاریخ و ساعت را تغییر می‌دهد؛ خدمات و متخصص ثابت می‌مانند.**

Remove:

- ratings;
- branch/address/map fixture as authoritative content;
- “free cancellation” language;
- fee/refund claims;
- SMS promises;
- after-service payment timing.

## 5. Reschedule date/time

Preserve:

- current appointment remains intact until confirmation;
- services fixed;
- specialist fixed;
- only date/time changes;
- 90-day horizon;
- 30-minute public start grid;
- availability respects the existing appointment duration.

Remove all “بدون هزینه / بدون کسر هزینه” wording.

## 6. Reschedule review

Create a dedicated **pre-commit review** state.

Use wording:

- «زمان فعلی»
- «زمان جدید انتخاب‌شده»

Do not call the explicitly selected time:

- پیشنهادی;
- recommended;
- nearest;
- best.

Show:

- fixed services;
- fixed specialist;
- current date/time;
- selected replacement date/time;
- unchanged duration;
- unchanged booked price;
- final action to confirm reschedule.

Do not show success on the same initial review screen.

## 7. Reschedule success

Create a distinct post-success state.

Show:

- appointment successfully updated;
- new confirmed date/time;
- same specialist;
- same services;
- same duration;
- same booked price;
- path back to appointment detail / My Appointments.

Do not promise SMS.

## 8. Reschedule stale-slot

Keep the good current semantics:

- original appointment is still intact;
- lost replacement time is unavailable;
- services/specialist preserved;
- replacement times shown fresh;
- **none selected initially**;
- Continue disabled until explicit selection.

No automatic ranking or preselection.

## 9. Cancel confirmation

Keep the existing destructive confirmation pattern.

Show:

- appointment identity;
- date/time;
- services;
- specialist;
- explicit irreversible cancellation confirmation.

Remove:

- “no cancellation fee”;
- “no deduction”;
- refund/credit language.

The Product Definition only defines eligibility by the 24-hour cutoff.

## 10. Cancelled success/detail

Create a distinct visible state after successful cancellation.

Show:

- status: لغوشده;
- original appointment snapshot;
- appointment remains available in History;
- path back to My Appointments;
- optional normal «رزرو وقت جدید» path.

Do not:

- promise SMS;
- auto-create a new appointment;
- create credits/refunds;
- use a separate “archive product” concept.

## 11. Locked inside-24-hours detail

Keep the current strong locked-state direction.

Use only:

- self-reschedule/cancel unavailable;
- customer must contact salon;
- contact CTA;
- back to list.

Do not use:

- emergency wording;
- exception guarantees;
- penalties/refunds;
- support-ticket/chat system.

Phone/contact literal must be clearly mock unless real data is approved.

## 12. History — explicit active state required

Create a dedicated exported History screen with the **History tab visibly active**.

Include representative rows/cards for:

- Completed;
- Cancelled;
- No-show.

Each item can open details.

Do not add:

- ratings;
- review prompts;
- rebook automation;
- loyalty;
- Favorites.

A simple «رزرو وقت جدید» starts the normal Booking flow if needed.

## 13. Historical detail — explicit screen required

Create a dedicated past appointment detail.

Show immutable snapshot fields:

- final status;
- services at booking;
- specialist at booking;
- historical date/time;
- duration;
- booked price.

Do not show:

- edit/reschedule;
- cancel;
- rating/review;
- current catalog values overwriting historical snapshots.

## 14. Navigation

Approved customer destinations:

- «وقت‌های من»
- «رزرو وقت»
- public site destinations where appropriate.

Do not add:

- «علاقه‌مندی»
- standalone «حساب من»
- standalone Profile/preferences center.

A small identity/avatar affordance may exist only if it does not imply a new product destination.

## 15. Content cleanup

Use neutral fixture content.

Remove:

- spa/wellness branding;
- branch names;
- ratings/stars;
- certificates/credentials;
- lymphatic/clinical/physiological claims;
- organic/material claims;
- exact business address/map as authoritative data;
- SMS confirmation/reminder promises.

Use:

**پرداخت در سالن**

Do not define payment as specifically before or after service.

## 16. Desktop parity

Provide desktop around **1440 CSS px** using the same product model.

Required desktop evidence:

- Upcoming / list;
- Active appointment detail;
- Reschedule date/time;
- Reschedule review/success;
- Locked inside-24-hours detail;
- History active state;
- Historical detail.

Desktop may use list + detail / master-detail layouts, but must not create new functionality.

## 17. Mobile evidence

Provide normal mobile evidence around **390 CSS px** for:

- Upcoming;
- Empty upcoming;
- Active detail;
- Reschedule;
- Reschedule review;
- Reschedule success;
- Stale-slot;
- Cancel confirmation;
- Cancelled success/detail;
- Locked detail;
- History;
- Historical detail.

## 18. Accessibility

Preserve:

- visible focus;
- keyboard-operable actions;
- status not color-only;
- destructive action clarity;
- accessible dialogs;
- readable Persian date/time;
- clear locked and empty states.

## Output

Return a **freeze-candidate My Appointments set** with the required mobile and desktop evidence.

Do not generate new product-contract Markdown that marks fixture data as approved.

Do not redesign the application visual language.
