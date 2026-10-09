# Stitch Prompt 16 — My Appointments final freeze pass

Apply one final **contract-cleanup + desktop-parity pass** to the existing آرا My Appointments design.

This is **not a redesign**.

Preserve the accepted mobile visual structures and Soft Editorial application language.

## A. Mobile screens to patch only

Do not regenerate unaffected mobile screens unless needed for consistency.

Correct these existing states:

### Active appointment detail
Remove:
- rating/stars;
- branch/address/map as authoritative content;
- spa/studio positioning;
- fee/refund assertions;
- after-service payment wording.

Use:
- neutral specialist expertise;
- fixture business details only if clearly marked mock;
- **پرداخت در سالن**.

### Reschedule date/time
Remove:
- “بدون کسر هزینه کنسلی” or any fee claim.

Keep:
- services fixed;
- specialist fixed;
- only date/time changes;
- 90-day horizon;
- 30-minute public start grid.

### Reschedule review
Change:
- «زمان جدید انتخابی: پیشنهادی»

to:
- **«زمان جدید انتخاب‌شده»**

Remove:
- ratings;
- master/senior credential claims;
- branch/spa wording;
- extra payment-timing claims.

### Cancel confirmation
Remove:
- no-fee / no-penalty / no-deduction guarantees;
- SMS language;
- refund/credit language.

Keep only:
- explicit final cancellation confirmation;
- appointment identity;
- 24-hour eligibility context.

### Cancelled success/detail
Remove:
- 0 تومان cancellation fee;
- “without fee” wording;
- branch/studio wording;
- SMS promises.

Keep:
- status Cancelled;
- immutable original appointment snapshot;
- visible in History;
- path to My Appointments;
- optional normal new Booking path.

### Empty upcoming
Remove:
- Favorites;
- standalone Account/Profile;
- support/chat prompt.

Keep:
- رزرو وقت جدید;
- optional Services path.

### History / Historical detail
Remove:
- branch/studio;
- ratings/credentials;
- spa/clinical/service-health claims.

Keep immutable historical snapshot semantics.

## B. Keep already-correct mobile states

Preserve without conceptual change:

- Upcoming;
- Empty upcoming structure;
- Active detail structure;
- Reschedule structure;
- Reschedule success structure;
- Reschedule stale-slot recovery;
- Cancel confirmation structure;
- Cancelled detail structure;
- Locked <24h structure;
- History active state;
- Historical detail structure.

## C. Desktop parity — required

Create desktop around **1440 CSS px** using the same product model.

Provide separate representative desktop screens for:

### 1. Upcoming / list
Show:
- upcoming Confirmed appointment(s);
- nearest first;
- date/time;
- specialist;
- services;
- total duration;
- booked price;
- open detail.

A list + detail/master-detail pattern is allowed.

### 2. Active appointment detail
Show:
- Confirmed;
- services;
- specialist;
- date/time;
- duration;
- booked price;
- customer snapshot if useful;
- pay at salon;
- reschedule;
- cancel;
- 24-hour policy.

### 3. Reschedule
Show:
- fixed services;
- fixed specialist;
- current time;
- replacement date/time selection;
- 30-minute starts;
- same duration;
- no service/specialist editing.

### 4. Locked inside 24 hours
Show:
- self-change disabled;
- 24-hour explanation;
- neutral salon-contact CTA;
- back to My Appointments.

No emergency wording.

### 5. History active state
Show:
- History tab selected;
- Completed;
- Cancelled;
- No-show;
- rows/cards open detail.

### 6. Historical detail
Show immutable snapshot:
- final status;
- services at booking;
- specialist at booking;
- historical date/time;
- duration;
- booked price;
- no mutation actions.

## D. Exact policy rules

Use only:

- customer self-cancel/reschedule until **24 hours before** appointment;
- inside final 24 hours, self-change is locked and customer contacts salon;
- reschedule changes **date/time only**;
- services remain unchanged;
- specialist remains unchanged;
- booked price snapshot remains unchanged;
- cancelled appointment remains visible in History;
- stale replacement time never changes original appointment until confirmation.

## E. Payment wording

Use only:

**پرداخت در سالن**

Do not say:
- after service;
- before service;
- free;
- no fee;
- refund;
- credit.

## F. Navigation

Approved customer destinations:

- «وقت‌های من»
- «رزرو وقت»
- public site destinations where appropriate.

Do not add:
- Favorites;
- Account/Profile center;
- loyalty;
- preference center.

## G. Content safety / truth

Use neutral fixture content.

Remove:

- spa/wellness positioning;
- branch names;
- ratings;
- certificates;
- master/senior proof claims;
- lymphatic/clinical/physiological claims;
- organic/material claims;
- SMS reminder/confirmation promises;
- authoritative mock address/phone/map claims.

## H. Do not alter product contract

Do not generate or modify a Markdown Product Contract that declares:

- a cancellation-fee rule;
- a literal salon address/phone;
- messaging/SMS behavior;
- branch data;
- payment timing.

Product Definition remains authoritative.

## Required output

Return:

1. corrected affected mobile states;
2. desktop Upcoming/list;
3. desktop Active detail;
4. desktop Reschedule;
5. desktop Locked state;
6. desktop History active state;
7. desktop Historical detail.

Do not introduce new features. Do not redesign the application visual language.

If this pass complies, My Appointments should be ready to freeze.
