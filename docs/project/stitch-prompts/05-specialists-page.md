# Stitch Prompt 05 — Specialists page

Design the **Specialists page** for the existing Persian/RTL brand **آرا**, using these frozen visual references:

- `ara-home-soft-editorial-v1`
- `ara-services-soft-editorial-v1`

Do not redesign the visual system. Extend the same Soft Editorial product language.

## Product purpose

The Specialists page helps customers understand who works at the salon, what each specialist can perform, and whether they want:

- a specific specialist; or
- **هر متخصص در دسترس**.

Specialist selection ultimately belongs to the Booking flow, but this public page should support discovery and a clear path into booking.

## Visual continuity

Carry forward:

- Persian/RTL-first layout;
- warm ivory / taupe surfaces;
- restrained terracotta primary actions;
- generous editorial whitespace;
- subtle borders/elevation;
- natural portrait photography;
- same header/navigation pattern;
- clear «وقت‌های من» access;
- prominent «رزرو وقت» CTA;
- same service-card and metadata visual vocabulary where useful.

Use **سالن زیبایی بانوان آرا** positioning only.

Do not introduce spa, clinic or atelier positioning.

## Page structure

### Intro / page header

Include:
- title such as «متخصص‌های آرا»;
- concise copy explaining that customers can choose a preferred specialist or continue with «هر متخصص در دسترس»;
- a clear booking CTA.

Do not make unsupported claims about awards, international certifications, “best in city”, medical credentials or guaranteed results.

### “Any available specialist” path

Give «هر متخصص در دسترس» a deliberate, visible treatment.

Explain simply:
- the booking system will show times where an eligible specialist can perform the selected service set;
- the final appointment is still with one eligible specialist;
- this is not a “first available” promise.

Provide a clear CTA into Booking.

### Specialist catalog

Show a manageable set of representative specialist profiles.

Each profile should support:
- portrait;
- name;
- short professional role/expertise summary;
- eligible services;
- concise availability/discovery cue if useful;
- action to view/select for booking.

Do not invent:
- ratings/review counts;
- follower counts;
- awards;
- certificates;
- unsupported years-of-experience claims;
- medical titles;
- personal social-media feeds.

Use grounded placeholder expertise such as hair styling, color, nails, makeup, or non-clinical beauty care.

### Specialist-to-service relationship

Make it easy to understand which services each specialist can perform.

Use the visual language established on Services.

Do not create a contradictory model where a specialist appears eligible for a service that the Services page says is incompatible.

For exploration, use one internally coherent sample data set.

### Booking transition

Selecting a specialist from this page should have a clear path into Booking.

The product order remains:

```text
services
→ specialist choice
→ date/time
→ mobile identity/verification
→ review and confirmation
```

If the customer enters Booking from a specialist profile, the specialist may be preselected, but do not skip the required service selection/validation rules.

Do not design online payment.

## Responsive behavior

Provide:

1. mobile Specialists page around 390 px CSS width;
2. desktop Specialists page around 1440 px CSS width.

Mobile should feel intentionally composed, not like a compressed card grid.

Portraits, names, service tags and CTAs must remain readable and touch-friendly.

## Accessibility

Target WCAG 2.2 AA for primary interactions.

Show:
- visible keyboard focus;
- meaningful portrait alt-text intent;
- CTAs with clear labels;
- service eligibility not conveyed only by color;
- sufficient contrast;
- keyboard-usable controls.

## Product boundaries

Do not add:

- ratings or reviews;
- loyalty;
- social follower metrics;
- marketplace/multiple salons;
- multiple branches;
- medical/clinical credentials;
- online payment;
- packages;
- staff/admin controls;
- standalone customer Profile scope;
- architecture/API/storage decisions;
- SMS/provider decisions.

## Content truth

Names, portraits, expertise and service assignments are visual fixture data unless separately approved.

Avoid unsupported claims such as:
- certified/master/internationally accredited;
- award-winning;
- guaranteed outcomes;
- organic/vegan product usage;
- medical or therapeutic expertise.

## Output

Return:
- mobile Specialists screen;
- desktop Specialists screen;
- any design-system delta needed specifically for specialist cards, portrait treatment and “any available specialist” presentation.

The page should feel like the natural next public-discovery surface after Home and Services, not a new design direction.
