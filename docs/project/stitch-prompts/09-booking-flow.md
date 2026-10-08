# Stitch Prompt 09 — Booking flow

Design the **core Booking flow** for the existing Persian/RTL brand **آرا**, using the frozen public visual references:

- `ara-home-soft-editorial-v1`
- `ara-services-soft-editorial-v1`
- `ara-specialists-soft-editorial-v1`
- `ara-gallery-soft-editorial-v1`
- `ara-about-soft-editorial-v1`
- `ara-contact-soft-editorial-v1`

This is the most important application flow in the product.

Do not redesign the brand system. Adapt the Soft Editorial language into a calm, task-focused booking experience.

## Product goal

A customer can create a real appointment through this order:

```text
1. select one or more services
2. choose a specific specialist or «هر متخصص در دسترس»
3. choose an available date/time
4. identify / verify customer by mobile
5. review and confirm
6. success
```

The flow must feel simple, reliable and mobile-first.

## Core product rules

Respect these frozen rules exactly.

### Services

- One booking may contain multiple services.
- All selected services must be performable by **one common specialist**.
- Services are performed **consecutively**, not in parallel.
- Total appointment duration is the sum of selected service durations.
- Service durations are defined in **15-minute increments**.
- Show the booking-time total price as the sum of selected service prices.
- Payment happens at the salon.
- Do not add online payment or deposits.

### Specialist

Customer may choose:

- a specific eligible specialist; or
- **هر متخصص در دسترس**.

Do not use:
- “اولین متخصص در دسترس”;
- “سریع‌ترین متخصص”;
- ranking/assignment guarantees.

If «هر متخصص در دسترس» is chosen, the customer is still booked with one eligible specialist.

### Date and time

- Booking horizon: up to **90 days** ahead.
- Same-day booking requires at least **60 minutes** lead time.
- Public appointment **start times use a 30-minute grid**.
- Availability must account for:
  - salon opening hours;
  - specialist recurring schedule;
  - breaks;
  - time off;
  - existing appointments;
  - selected service set;
  - total consecutive duration.

Do not expose impossible/ineligible slots as selectable.

### Identity

Customers may browse and begin Booking without signing in.

To complete a booking:

- name is required;
- mobile is required;
- email is optional;
- customer verifies the mobile identity;
- password-based account UX is out of scope.

If a verified mobile already belongs to a customer, the same customer identity is recovered.

Do not choose or name an SMS provider.

Do not promise delivery behavior that has not been specified.

### Confirmation

A successful booking is **immediately Confirmed**.

There is no manual salon-approval step.

Before final confirmation show a clear summary:

- selected services;
- specialist;
- date/time;
- total duration;
- total price;
- pay-at-salon policy;
- customer identity.

### Stale slot

If the chosen slot becomes unavailable before confirmation:

- do not create the appointment;
- preserve selected services;
- preserve selected specialist choice;
- return customer to time selection;
- clearly explain that the selected time is no longer available;
- show current available options.

Do not silently switch the customer to another time or specialist.

## Required screens / states

Design a coherent flow, not one giant page.

At minimum show:

### A. Service selection

- searchable/browsable services if useful;
- multi-select;
- selected state;
- incompatible state;
- running total duration;
- running total price;
- continue CTA.

Do not add packages.

### B. Specialist choice

- specific eligible specialist cards;
- first-class «هر متخصص در دسترس» option;
- preserve selected-service summary;
- clear continue CTA.

### C. Date/time selection

Show:
- date selector/calendar;
- available times;
- selected state;
- loading state;
- no-times-available state;
- 90-day boundary;
- same-day lead-time behavior;
- total duration context.

Public starts are on a 30-minute grid.

### D. Mobile identity verification

Show:
- name;
- mobile;
- optional email;
- mobile verification step;
- returning-customer recovery behavior concept.

Do not use passwords.

Do not name an SMS provider.

### E. Review and confirmation

Show:
- complete booking summary;
- services;
- specialist;
- date/time;
- duration;
- total price;
- pay-at-salon message;
- final «تأیید رزرو» action.

Do not replace this stage with payment.

### F. Confirmed success

Show:
- clear Confirmed state;
- appointment summary;
- path to «وقت‌های من»;
- path back to Home/Services if useful.

Do not promise SMS notification unless shown only as unresolved/optional copy.

### G. Stale-slot recovery

Show the exact recovery state:
- selected time is no longer available;
- services and specialist remain selected;
- return to current time choices.

### H. No eligible specialist

If the selected service set has no common eligible specialist:
- clearly explain incompatibility;
- allow customer to change/remove selected services;
- do not invent automatic split booking.

### I. No availability

If eligible specialists exist but no time is available:
- show an understandable empty state;
- allow another date or specialist choice;
- preserve prior valid selections.

## Mobile-first behavior

Booking and My Appointments are the highest-priority mobile experiences.

Provide a mobile flow around **390 px CSS width** first.

Mobile requirements:
- thumb-friendly controls;
- visible progress;
- persistent but non-obstructive selected-booking summary where useful;
- avoid giant sticky panels that cover content;
- no horizontal overflow;
- clear back navigation that preserves selections;
- keyboard/input states that do not obscure the main action.

Then provide a desktop flow around **1440 px CSS width** using the same interaction model.

Desktop may use:
- split layouts;
- summary side panel;
- wider date/time presentation.

Do not create a separate desktop product model.

## Progress/navigation

Use a clear progress pattern for the 5 pre-confirmation stages:

1. خدمات
2. متخصص
3. زمان
4. اطلاعات
5. تأیید

Success is the result, not a sixth editable step.

Users must be able to move backward without losing valid prior choices.

## Accessibility

Target WCAG 2.2 AA.

Show intent for:

- visible focus;
- keyboard-operable service/specialist/time controls;
- selected state not relying on color alone;
- disabled/unavailable state with text/icon semantics;
- properly labelled form inputs;
- validation/error messages near fields;
- accessible progress semantics;
- sufficient contrast;
- reduced-motion-friendly transitions.

## Product boundaries

Do not add:

- online payment/deposit;
- manual approval;
- packages;
- reviews/ratings;
- loyalty;
- booking for another person;
- multiple branches;
- waitlist;
- promo codes;
- memberships;
- chat/support ticket;
- medical intake;
- profile page;
- password account;
- architecture/API/storage decisions.

## Content truth

Service names, specialist names, phone/email and media are fixtures unless separately approved.

Do not introduce:
- clinical claims;
- certificates;
- guaranteed results;
- organic/vegan/material claims;
- SMS guarantees;
- unsupported cancellation rules.

## Output

Return a **Booking flow set**, not just one screen:

- mobile core screens/states first;
- desktop equivalents;
- any design-system delta for:
  - progress;
  - service selection;
  - specialist selection;
  - calendar/time slots;
  - forms/verification;
  - summary panel;
  - error/recovery/success states.

The Booking flow must feel like the same آرا product, but more functional and restrained than the editorial marketing pages.
