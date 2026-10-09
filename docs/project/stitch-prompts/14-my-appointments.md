# Stitch Prompt 14 — My Appointments

Design the **My Appointments** experience for the existing Persian/RTL brand **آرا**, using the frozen public-page and Booking references:

- `ara-home-soft-editorial-v1`
- `ara-services-soft-editorial-v1`
- `ara-specialists-soft-editorial-v1`
- `ara-gallery-soft-editorial-v1`
- `ara-about-soft-editorial-v1`
- `ara-contact-soft-editorial-v1`
- `ara-booking-soft-editorial-v1`

Do not redesign the visual system.

This is the authenticated customer area for viewing and managing appointments.

## Product purpose

A verified customer can:

- see upcoming appointments;
- see appointment history;
- open appointment details;
- cancel an eligible upcoming appointment;
- reschedule an eligible upcoming appointment;
- understand when self-service change is locked;
- contact the salon when inside the final 24 hours.

The customer identity is mobile-centered.

Do not create a separate profile/preferences product.

## Core appointment policy

Respect these frozen rules exactly:

- customer may self-cancel or self-reschedule until **24 hours before** the appointment;
- inside the final 24 hours, self-service change is locked;
- inside the final 24 hours, customer must contact the salon;
- rescheduling changes **date/time only**;
- services remain unchanged;
- specialist remains unchanged;
- duration remains derived from the existing booked services;
- booking price snapshot remains unchanged;
- changing service or specialist requires cancel + new booking;
- terminal appointment states are not reversible in customer UI.

## Appointment lifecycle

Customer-facing statuses may include:

- Confirmed
- Completed
- Cancelled
- No-show

Use clear Persian labels and neutral visual semantics.

Do not invent:
- Pending approval;
- payment pending;
- refunded;
- waitlisted;
- draft appointment state.

## Required screens / states

Design a coherent mobile-first My Appointments experience.

### A. Upcoming appointments list

Show:
- upcoming confirmed appointments;
- date/time;
- specialist;
- selected services;
- total duration;
- booked total price;
- clear status;
- primary action to open details.

If multiple appointments exist, order by nearest upcoming first.

### B. Empty upcoming state

If there are no upcoming appointments:

- calm empty state;
- clear path to «رزرو وقت»;
- optional path to Services.

Do not add promotional urgency or fake scarcity.

### C. Appointment detail — eligible for self-service

For an appointment more than 24 hours away, show:

- Confirmed status;
- services;
- specialist;
- date/time;
- total duration;
- booked price snapshot;
- pay-at-salon context;
- customer contact snapshot where appropriate;
- «جابه‌جایی زمان» action;
- «لغو نوبت» action.

Clearly state:

- reschedule changes date/time only;
- services and specialist stay unchanged.

### D. Reschedule flow

Design a focused reschedule experience.

Rules:

- current services remain fixed;
- current specialist remains fixed;
- only date/time can change;
- show currently booked date/time;
- show available replacement dates/times;
- public starts remain on 30-minute grid;
- same booking horizon / availability rules apply where relevant;
- stale replacement slot must be handled safely;
- final confirmation clearly states only the time is changing.

Do not allow service or specialist editing inside reschedule.

### E. Reschedule stale-slot state

If a newly selected replacement time becomes unavailable before confirmation:

- do not change the appointment;
- keep the original appointment intact;
- preserve current appointment services/specialist;
- return to current replacement-time selection;
- show fresh available times;
- **do not preselect a new replacement time**;
- continue CTA remains disabled until explicit selection.

### F. Cancel confirmation

For appointments outside the final 24 hours:

- provide a clear destructive confirmation;
- identify the appointment being cancelled;
- explain that cancellation is final for that appointment;
- require explicit confirmation.

Do not invent:
- cancellation fees;
- refunds;
- credits;
- loyalty effects.

### G. Cancel success

After successful cancellation:

- show Cancelled state;
- keep the appointment visible in history/detail;
- offer path to book a new appointment if desired.

Do not automatically create a replacement booking.

### H. Locked state — inside final 24 hours

For an appointment inside the final 24 hours:

- disable/hide self-reschedule and self-cancel actions appropriately;
- clearly explain the 24-hour policy;
- provide salon contact CTA;
- provide navigation back to appointment list.

Do not:
- create emergency mode;
- promise exception approval;
- show penalty/refund rules;
- offer automatic override.

### I. History list

Show past appointments with clear status:

- Completed
- Cancelled
- No-show

Allow opening detail.

Do not add:
- ratings;
- reviews;
- “rate your visit” prompts;
- loyalty points;
- rebook automation unless it simply starts a new normal Booking flow with no hidden assumptions.

### J. Historical detail

Show immutable snapshot information:

- services at booking;
- specialist;
- appointment date/time;
- duration;
- booked price;
- final status.

Do not rewrite historical data from current catalog values.

## Mobile-centered identity

My Appointments requires the customer's verified mobile identity.

If identity verification is needed to enter:

- use the same passwordless mobile-verification language as Booking;
- returning verified mobile recovers the same customer identity/history.

Do not introduce:
- password;
- username;
- social login;
- standalone profile center;
- mobile-number change flow.

## Responsive behavior

Provide **mobile first**, around 390 CSS px.

Mobile priorities:

- appointment cards are compact and readable;
- status is visible;
- destructive actions are not too easy to tap accidentally;
- locked-state contact path is obvious;
- date/time/service summaries do not overflow;
- actions remain reachable without giant sticky panels.

Then provide desktop around 1440 CSS px using the same product model.

Desktop may use:

- master/detail layout;
- list + detail panel;
- wider history/upcoming segmentation.

Do not create different functionality on desktop.

## Navigation

Use a clear authenticated customer navigation pattern.

Primary customer destinations remain:

- «وقت‌های من»
- «رزرو وقت»
- public site destinations where appropriate.

Do not create a standalone Profile page unless product scope is explicitly changed.

## Accessibility

Target WCAG 2.2 AA.

Show intent for:

- visible focus;
- keyboard-operable appointment cards/actions;
- status not conveyed only by color;
- destructive cancel confirmation with clear labels;
- readable dates/times in Persian RTL;
- accessible empty/locked/error states;
- focus management for confirmation dialogs/states.

## Product boundaries

Do not add:

- reviews/ratings;
- loyalty;
- credits/refunds;
- cancellation fees;
- online payment;
- waitlist;
- packages;
- booking for another person;
- service changes during reschedule;
- specialist changes during reschedule;
- profile/preferences center;
- chat/support ticket;
- multiple branches;
- architecture/API/storage decisions.

## Content truth

Names, phone, address and service data remain fixture content unless separately approved.

Do not add:
- SMS reminder promises;
- certificates;
- clinical claims;
- material/organic claims;
- “free cancellation” wording;
- emergency support wording.

## Output

Return a **My Appointments flow set** containing:

### Mobile
- Upcoming list
- Empty upcoming
- Appointment detail — self-service allowed
- Reschedule date/time
- Reschedule review/confirmation
- Reschedule stale-slot recovery
- Cancel confirmation
- Cancelled success/detail
- Locked inside-24-hours detail
- History list
- Historical detail

### Desktop
Provide the same experience model with representative screens for:
- upcoming/list;
- detail;
- reschedule;
- locked state;
- history.

Also return any design-system delta needed for:
- appointment status chips;
- destructive actions;
- locked-policy messaging;
- appointment cards;
- history rows;
- reschedule states.

The experience must feel like the authenticated customer extension of the frozen Booking system, not a separate application.
