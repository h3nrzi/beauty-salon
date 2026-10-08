# Stitch Prompt 08 — Contact page

Design the **Contact page** for the existing Persian/RTL brand **آرا**, using these frozen visual references:

- `ara-home-soft-editorial-v1`
- `ara-services-soft-editorial-v1`
- `ara-specialists-soft-editorial-v1`
- `ara-gallery-soft-editorial-v1`
- `ara-about-soft-editorial-v1`

Do not redesign the visual system. Extend the same Soft Editorial product language.

## Product purpose

The Contact page gives customers a clear, trustworthy way to:

- find the salon;
- see salon hours;
- call/contact the salon;
- get directions;
- understand what to do when an appointment is inside the final 24-hour self-change cutoff;
- continue to Booking when they are still eligible to self-book/change.

This is not a lead-generation form page and not a customer-support ticketing system.

## Visual continuity

Carry forward:

- Persian/RTL-first composition;
- warm ivory / taupe surfaces;
- restrained terracotta primary actions;
- editorial whitespace;
- subtle borders/elevation;
- same header/navigation behavior;
- clear «وقت‌های من» access;
- prominent «رزرو وقت» CTA.

Use **سالن زیبایی بانوان آرا** positioning only.

Do not introduce spa, clinic, medical-center or atelier positioning.

## Page structure

### Intro / contact header

Include:

- title such as «تماس با آرا»;
- concise copy explaining how to reach the salon;
- primary path to Booking;
- secondary path to call/contact.

Keep copy factual and neutral.

Do not invent claims such as 24/7 support, immediate-response guarantees or dedicated concierge service.

### Contact details

Create a clear contact-information section that can support:

- phone;
- optional public email;
- address;
- salon opening hours;
- directions.

All literal values are **mock placeholders** until real production information is supplied.

Make that placeholder status clear in the visual/export notes.

Do not invent:
- multiple branches;
- WhatsApp/Telegram/social channels unless explicitly approved;
- emergency contact;
- medical support.

### Directions / location

Provide a clear “get directions” affordance.

You may use:
- a static map-like visual placeholder;
- an address/directions card;
- a clear external-directions CTA.

Do not prescribe a maps provider or API.

Do not imply the current mock address is production-approved.

### Appointment-change support

This is an important product rule.

The approved customer policy is:

- customer may self-cancel/reschedule until **24 hours before** the appointment;
- inside the final 24 hours, self-change is locked and the customer must contact the salon.

Design a calm, clear support block explaining this.

Include:
- concise 24-hour rule;
- call/contact CTA;
- link to «وقت‌های من» for appointments still eligible for self-management.

Do not invent:
- 6-hour or 12-hour cutoffs;
- automatic exceptions;
- emergency rescheduling;
- refund/penalty policies;
- manual override guarantees.

### Hours / availability context

Salon public opening hours may be shown as placeholder content.

Do not confuse:
- public salon opening hours;
- specialist availability;
- booking slots.

Booking availability is calculated separately in the product.

### Booking bridge

If a customer simply wants a new appointment, provide a strong route to Booking.

Reinforce:
- service choice;
- specific specialist or «هر متخصص در دسترس»;
- date/time selection;
- mobile verification;
- review and confirmation;
- payment at the salon.

Do not promise SMS delivery.

### Footer

Use the same established footer/navigation language.

Legal/privacy links may only appear as clearly unresolved/future placeholders unless real content exists.

## Responsive behavior

Provide:

1. mobile Contact page around 390 px CSS width;
2. desktop Contact page around 1440 px CSS width.

Mobile priorities:

- phone/contact CTA must be easy to reach;
- address/hours remain readable;
- the 24-hour support rule must be obvious without dominating the page;
- directions and Booking actions must be touch-friendly.

## Accessibility

Target WCAG 2.2 AA for primary interactions.

Show:

- visible focus states;
- clear link/button labels;
- phone/email semantics;
- address/hours in readable structure;
- sufficient contrast;
- map/directions content that does not depend on an image alone;
- state/policy messaging not conveyed only by color.

## Product boundaries

Do not add:

- contact/lead form unless deliberately approved;
- support-ticket system;
- live chat;
- social DMs;
- multiple branches;
- online payment/deposit;
- refund policy;
- loyalty;
- reviews;
- medical/emergency support;
- admin/staff tools;
- architecture/API/maps-provider decisions.

## Content truth

Phone, address, email and hours are fixture data until supplied and approved.

Do not invent:
- official licenses;
- certifications;
- guaranteed response times;
- 24/7 availability;
- parking/accessibility facilities as factual business claims.

## Output

Return:

- mobile Contact screen;
- desktop Contact screen;
- any design-system delta needed specifically for contact cards, directions and the 24-hour support block.

The Contact page should feel like the natural service/support endpoint of the frozen public visual system, not a new design direction.
