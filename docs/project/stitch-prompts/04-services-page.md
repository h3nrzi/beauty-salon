# Stitch Prompt 04 — Services page

Design the **Services page** for the existing Persian/RTL brand **آرا**, using the frozen Home visual reference `ara-home-soft-editorial-v1`.

Do not redesign the visual system. Extend the established Soft Editorial language consistently.

## Product purpose

The Services page helps customers understand and compare all salon services before entering Booking.

This page is richer and more complete than the Home service preview.

Each service must support:

- service name;
- concise description;
- duration;
- price;
- eligible specialists;
- a clear path into Booking.

The product supports selecting **multiple compatible services** in one booking, but only when one specialist can perform the complete selected set.

Do not imply that every arbitrary combination is valid.

## Visual continuity

Carry forward:

- Persian/RTL-first composition;
- warm ivory / taupe surfaces;
- restrained terracotta action color;
- editorial whitespace;
- subtle cards/borders;
- natural photography only where it adds value;
- the same header/navigation pattern;
- access to «وقت‌های من»;
- prominent «رزرو وقت»;
- calm premium tone rather than dense SaaS UI.

Do not reintroduce:
- pink/gold beauty clichés;
- glassmorphism;
- heavy shadows;
- overly rounded cards;
- invented spa/clinic/atelier positioning.

Use **سالن زیبایی بانوان آرا** as the product positioning.

## Page structure

Create a Services page that includes:

### Intro / page header

- clear page title such as «خدمات آرا»;
- concise explanatory copy;
- reassurance about transparent time and price;
- CTA to start booking.

Do not invent awards, certificates, organic/vegan claims, clinical claims or guaranteed results.

### Service catalog

Show a complete but readable catalog.

For each service, provide:
- name;
- short description;
- duration in 15-minute increments;
- price;
- eligible specialist names or a compact specialist availability cue;
- action to select/start booking.

Use realistic placeholder service data for a women's salon, but keep the number manageable for visual exploration.

Suggested service groups may include hair, nails, skin/beauty care and makeup, but do not invent product categories that imply medical/clinical treatments.

### Multi-service selection behavior

Explore a clear interaction pattern for choosing more than one service.

Show:
- selected/unselected state;
- selected-services count;
- running total duration;
- running total price;
- a clear continue-to-specialist action.

Important rules to communicate without overloading the page:

- all selected services must be compatible with at least one common specialist;
- total appointment duration is the sum of selected service durations;
- payment happens at the salon;
- online payment is not part of v1.

If a newly selected service would make the current set incompatible, design a clear understandable state/message rather than silently accepting it.

### Eligible specialist context

A service should make it possible to understand who can perform it.

Do not force a specialist choice on this page; specialist choice belongs to the next Booking step.

Use “متخصص‌های واجد شرایط” or equivalent neutral language.

### Final booking CTA

At the end of the page, provide a strong transition to Booking with the current selected-service summary when services are selected.

If nothing is selected, the CTA can guide the user to choose a service first.

## Responsive behavior

Provide:

1. mobile Services page around 390 px CSS width;
2. desktop Services page around 1440 px CSS width.

Mobile is not a compressed desktop table.

On mobile:
- selection controls must be thumb-friendly;
- selected-service summary should remain discoverable;
- avoid covering content with a large sticky element;
- keep price/duration readable.

## Accessibility

Target WCAG 2.2 AA for primary interactions.

Show:
- visible focus treatment;
- selected state not conveyed by color alone;
- readable labels for service selection;
- clear disabled/incompatible states;
- sufficient contrast;
- keyboard-usable controls.

## Product boundaries

Do not add:

- packages;
- online payment or deposits;
- reviews/ratings;
- loyalty;
- marketplace/multiple branches;
- medical/clinical treatments;
- staff/admin tools;
- architecture/API/storage decisions;
- SMS/provider decisions.

## Content truth

Business facts, contact details and media remain placeholders unless already approved.

Do not invent claims of:
- certifications;
- organic/vegan products;
- guaranteed outcomes;
- awards;
- “best in city” status;
- zero-wait guarantees.

## Output

Return:
- mobile Services screen;
- desktop Services screen;
- any design-system delta needed specifically for service selection states.

The result should feel like the natural next page of the frozen Home baseline, not a new design direction.
