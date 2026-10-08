# Stitch Prompt 10 — Booking completion and consistency pass

Refine the existing **آرا Booking flow** generated from Prompt 09.

This is **not a redesign**.

Preserve:
- the current Soft Editorial application styling;
- the 5-stage progress pattern;
- service-selection layout;
- specialist-choice layout;
- date/time layout;
- identity-verification layout;
- review/confirmation layout;
- stale-slot visual language;
- success visual language.

The goal is to correct frozen product mismatches, add the missing required states, and provide desktop parity so the Booking baseline can be frozen.

## 1. Keep the canonical 5 stages exactly

1. خدمات
2. متخصص
3. زمان
4. اطلاعات
5. تأیید

Then show success as the result.

Do not turn payment into a stage.

## 2. Fix the customer change policy

Every Booking reference must use the frozen rule:

**لغو یا جابه‌جایی توسط مشتری تا ۲۴ ساعت قبل از نوبت مجاز است.**

Inside the final 24 hours, customer self-change is locked and the customer must contact the salon.

Remove all 12-hour / 6-hour variants.

Do not invent fees, penalties or “free cancellation” policy.

## 3. Correct stale-slot recovery

When the selected time becomes unavailable:

- clearly say the selected time is no longer available;
- preserve selected services;
- preserve selected specialist / «هر متخصص در دسترس» choice;
- show current alternative times;
- **do not automatically select any replacement time**;
- require the customer to explicitly choose a new time before continuing.

Do not rank a time as “first choice” or silently move the booking.

## 4. Add the missing No Eligible Specialist state

Create an explicit state for:

**the selected service set has no common specialist who can perform all selected services consecutively.**

Show:

- clear explanation;
- selected services remain visible;
- action to remove/change a service;
- path back to service selection.

Do not:
- auto-split into two bookings;
- silently remove a service;
- suggest an ineligible specialist.

## 5. Add the missing No Availability state

Create an explicit state for:

**eligible specialist(s) exist, but no valid time is available for the current date/selection.**

Show:

- selected services;
- specialist choice;
- total duration;
- clear empty-state message;
- action to choose another date;
- action to change specialist where appropriate.

Preserve prior valid selections.

Do not auto-book or silently switch specialist/time.

## 6. Clean specialist content

Remove:
- ratings/review scores;
- certificates;
- unverified credentials;
- exact experience claims unless clearly labelled fixture data.

Use neutral expertise labels only.

Keep:
- specific specialist;
- «هر متخصص در دسترس»;
- eligibility for the full selected service set.

Do not use “first available” or “fastest specialist”.

## 7. Clean service content

Remove:
- organic/vegan/material claims;
- lymphatic/physiological/clinical wording;
- guaranteed outcomes.

Use normal non-clinical beauty-service placeholder copy.

Keep:
- fixed duration;
- fixed price;
- compatibility;
- consecutive one-specialist appointment model.

## 8. Keep identity scope narrow

The identity step must support:

- name required;
- mobile required;
- email optional;
- mobile verification;
- passwordless experience;
- returning verified mobile recovers the same customer identity/history.

Do not introduce:
- standalone profile;
- preference center;
- loyalty profile;
- password;
- customer mobile-change flow.

A verification-code UI is allowed.

Do not name an SMS provider.

Do not promise future SMS reminders/confirmation messages.

## 9. Correct review/confirmation content

Use one salon only.

Remove:
- branch names such as “Fereshteh branch” / “central branch”;
- ratings/certificates;
- SMS promise;
- satisfaction-based payment language;
- cancellation fee claims.

Review must show:

- selected services;
- assigned/selected specialist;
- date/time;
- total duration;
- total price;
- customer identity;
- «پرداخت در سالن»;
- 24-hour self-change rule;
- immediate confirmation after final action.

Final CTA:
**تأیید و ثبت نوبت**

## 10. Simplify success to approved scope

Success may show:

- Confirmed status;
- booking/reference identifier if useful;
- specialist;
- services;
- date/time;
- duration;
- total price;
- pay-at-salon;
- «مشاهده در وقت‌های من»;
- return to Home/Services.

Remove unless separately approved:

- SMS reminder promises;
- add-to-calendar integration;
- share-booking action;
- arrive-10-minutes-early rule;
- hospitality/drink promise;
- branch terminology.

## 11. Keep time rules exact

- horizon: 90 days;
- same-day lead: 60 minutes;
- service durations: 15-minute increments;
- public start grid: **30 minutes**;
- selected services are consecutive;
- total duration is the sum of service durations.

Do not describe public starts as 15-minute slots.

## 12. Desktop parity is required

Provide desktop equivalents around **1440 CSS px** for the same Booking model.

At minimum demonstrate desktop versions of:

- service selection;
- specialist selection;
- date/time;
- identity;
- review/confirmation;
- success;
- stale slot;
- no eligible specialist;
- no availability.

Desktop may use a summary side panel, but must not create a different product flow.

## 13. Mobile evidence

Provide normal handset compositions around **390 CSS px**.

Keep:
- thumb-friendly controls;
- progress visibility;
- preserved-selection back navigation;
- no horizontal overflow;
- non-obstructive summary/CTA patterns.

## 14. Accessibility

Preserve/show:

- visible focus;
- keyboard-usable selectable cards and time slots;
- selected state not color-only;
- disabled/unavailable state with text/icon meaning;
- labelled inputs;
- inline validation;
- accessible progress semantics;
- sufficient contrast.

## 15. Do not add new product scope

Do not add:

- online payment/deposit;
- waitlist;
- promo codes;
- packages;
- reviews/ratings;
- loyalty;
- booking for another person;
- multiple branches;
- profile/preferences product;
- calendar integration;
- sharing;
- reminder service;
- chat/support tickets;
- architecture/API/storage decisions.

## Output

Return a **complete Booking baseline candidate**:

1. mobile flow/screens/states;
2. desktop equivalents;
3. explicit stale-slot state with no preselected replacement;
4. explicit No Eligible Specialist state;
5. explicit No Availability state;
6. updated Booking design-system delta if any token/state semantics changed.

If these corrections are satisfied, this pass should be suitable for Booking baseline freeze.
