# Stitch brief

**Status:** Draft — product scope is frozen; visual design is not yet approved.

## Product

A Persian/RTL booking platform for one women's beauty salon.

The product combines a credible salon marketing experience with a real appointment workflow. Stitch owns visual exploration and interaction presentation, but it must not invent product scope or engineering architecture.

Primary customer journey:

```text
Discover salon/services
→ choose one or more services
→ choose a specific specialist or any available specialist
→ choose a date and available time
→ verify identity by mobile when needed
→ confirm appointment
→ later sign in and manage appointments
```

## Design goals

- Modern, feminine and premium.
- Light/neutral visual foundation with a warm accent.
- Elegant and editorial rather than generic SaaS.
- Avoid theatrical ultra-luxury styling.
- Avoid default beauty clichés such as excessive pink/gold, ornamental overload or overly decorative cards.
- Persian typography and RTL composition must feel native, not mirrored from an LTR layout.
- Booking clarity and trust matter more than decorative density.

## Brand and visual direction

**Working brand name:** آرا

**Selected direction:** Soft Editorial.

Visual character:

- calm, feminine, modern and premium without feeling distant;
- editorial composition with generous whitespace;
- warm ivory / off-white / light taupe foundation;
- restrained warm accent such as muted terracotta or rose-brown;
- soft, natural photography with realistic salon/beauty details rather than glossy stock clichés;
- Persian typography should feel refined and readable, with stronger editorial display treatment for headings and a highly legible UI style for booking flows;
- card borders, shadows and decoration should be subtle;
- medium radii are acceptable, but avoid turning the interface into a dense rounded-card SaaS dashboard;
- marketing pages may feel expressive and editorial, while Booking and My Appointments remain calm, obvious and task-focused.

The visual system must feel like one product across editorial marketing pages and application flows.

## Responsive priority

Booking and My Appointments are mobile-first.

The public marketing experience must still feel complete on desktop/tablet, but the primary interaction flows must be excellent on small screens first.

## Accessibility

Primary customer and staff-facing flows target WCAG 2.2 AA.

Designs must preserve:
- visible focus states;
- sufficient contrast;
- readable Persian type;
- meaningful labels;
- keyboard-operable controls;
- clear validation/error presentation;
- reduced-motion friendliness;
- layouts that can reflow without hiding essential actions.

## Public pages

### Home

Purpose: establish trust, communicate the salon's positioning and drive discovery/booking.

Required product content:
- salon introduction / hero;
- selected services;
- selected specialists;
- selected gallery work;
- trust/benefit content;
- clear booking CTA.

### Services

Purpose: help customers understand and compare services before booking.

Each service presentation must support:
- name;
- description;
- duration;
- price;
- eligible specialists;
- direct path into Booking.

The design must support selecting multiple compatible services without implying that arbitrary service combinations are always valid.

### Specialists

Purpose: help customers choose a preferred specialist.

Profiles should communicate:
- name;
- portrait;
- expertise;
- eligible services;
- booking CTA.

The product must also preserve an “any available specialist” path.

### Gallery

Purpose: present real salon work/portfolio and reinforce trust.

Keep the gallery focused on visual proof rather than turning it into a social feed or review system.

### About

Purpose: explain salon story, positioning and team identity.

### Contact

Purpose: provide:
- address;
- salon hours;
- phone/contact path;
- directions.

This page must also support the policy that customers inside the final 24-hour change window contact the salon rather than self-modifying the appointment.

### Booking

This is the core application flow.

Required steps:
1. select one or more services;
2. choose a specific specialist or any available specialist;
3. choose an available date/time;
4. identify/verify the customer by mobile when needed;
5. review booking summary;
6. confirm.

Important product behavior for UI states:
- up to 90 days ahead;
- at least 60 minutes lead for same-day booking;
- service durations use 15-minute increments;
- start times use a 30-minute grid;
- multi-service appointments are consecutive and must be performable by one specialist;
- show total duration and total price clearly;
- payment is at the salon;
- if a selected slot becomes stale before confirmation, preserve service/specialist choices and return the customer to current time selection;
- successful booking is immediately Confirmed.

Design explicit states for:
- loading availability;
- no eligible specialist;
- no available time;
- stale slot;
- validation error;
- identity verification;
- confirmation success;
- retry/recovery where appropriate.

Do not design payment, deposit or manual salon approval flows.

### My Appointments

Authenticated customer area.

Must support:
- upcoming appointments;
- appointment history;
- appointment detail;
- cancellation when more than 24 hours remain;
- rescheduling when more than 24 hours remain;
- clear locked-state/contact guidance inside the final 24 hours.

Rescheduling changes only date/time. Do not imply that service or specialist can be changed during reschedule.

## Staff experience

The product has two operational roles.

### Manager

Needs UI for:
- all appointments;
- search/view appointment details;
- cancel/reschedule/reassign where valid;
- services;
- specialists;
- salon hours;
- specialist schedules;
- breaks;
- time off.

### Staff / Specialist

Needs UI for:
- assigned appointments;
- appointment details needed to perform the service;
- mark Completed;
- mark No-show.

Do not introduce CRM, analytics dashboards, payroll, inventory, marketing automation or complex role administration.

## Customer identity

Product-level identity is mobile-number centered.

UI requirements:
- name + mobile required;
- email optional;
- verified mobile becomes the customer's primary read-only identifier in v1;
- no password-based customer UX;
- returning verified mobile recovers the same customer identity/appointment history;
- changing mobile number is out of scope.

Do not prescribe SMS provider or authentication implementation in Stitch artifacts.

## Pricing and appointment summary

- Each service has a visible price.
- Booking total is the service-price sum.
- Show selected services, specialist, date/time, total duration and total price before confirmation.
- Clearly communicate “pay at salon”.
- Do not introduce checkout/payment UI.

## Media

Stitch/reference imagery may be temporary prototype media.

Do not imply prototype imagery is production-cleared. Final production acceptance requires explicitly approved usage rights.

## Product exclusions

Do not add:
- marketplace/multiple salons;
- multiple branches;
- booking for another person;
- online payment/deposit;
- loyalty;
- reviews/ratings;
- CRM;
- inventory;
- payroll/accounting;
- advanced analytics;
- native mobile-app concepts;
- password-based customer accounts;
- complex staff roles.

## What Stitch may explore

Stitch may explore:
- page composition;
- visual hierarchy;
- typography;
- spacing;
- imagery;
- card/list presentation;
- navigation;
- responsive composition;
- booking-step presentation;
- appointment-management presentation;
- staff operational UI presentation;
- micro-interaction concepts.

Stitch must not invent:
- new product capabilities;
- new business rules;
- WordPress architecture;
- storage/authentication choices;
- APIs;
- SMS providers;
- new roles or permission models.

## Approval rule

We will iterate in Stitch until the visual system, responsive behavior and required states are coherent across all scoped customer/staff experiences.

Once the remaining differences are deterministic content/engineering cleanup rather than meaningful design uncertainty, freeze a baseline and move to export audit.
