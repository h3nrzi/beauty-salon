# Stitch Design Brief

## Purpose

This document is the controlled input for Google Stitch during Pilot 01.

The goal is to complete the UI/UX phase before engineering begins.

Stitch should solve the visual and interaction-design problem. It should not invent backend architecture or WordPress implementation details.

---

## Product summary

Design a responsive four-page website for **NOIR Auto Detailing**, a fictional premium automotive detailing studio.

Customers should be able to understand the services, inspect previous work, build trust, and request an appointment.

This is a lead-generation website, not a full online booking system.

---

## Pages

Create a coherent design system across these four pages:

1. Home
2. Services
3. Gallery
4. Contact / Appointment Request

Use one shared header, navigation system, footer, typography system, spacing language, buttons, cards, and form controls.

---

## Design direction

Create a premium automotive aesthetic with an editorial feel.

Desired qualities:

- modern
- confident
- minimal
- high contrast
- photography-led
- restrained
- spacious
- professional

Prefer:

- dark-neutral visual foundation
- off-white/light neutral text areas where useful
- one restrained accent color
- strong typography
- large vehicle photography
- clean grids
- subtle dividers
- clear hierarchy

Avoid:

- neon racing aesthetic
- gaming visuals
- excessive gradients
- glassmorphism
- overly rounded cards
- generic SaaS styling
- dashboard patterns
- heavy decorative animation
- fake luxury motifs

The design should feel premium because of composition, typography, photography, and spacing rather than ornament.

---

## UX priorities

The primary conversion is:

**Request Appointment**

Secondary action:

**View Services**

Users should always understand:

- what the business offers
- why it is credible
- where to see past work
- how to request an appointment

Do not present the contact form as a confirmed booking.

Use wording that makes it clear the customer is submitting an appointment request.

---

## Page requirements

### Home

Include:

- header/navigation
- high-impact hero
- short positioning statement
- Request Appointment CTA
- View Services CTA
- featured services
- selected work / before-after visual section
- short trust/value section
- testimonials
- final CTA
- footer

Keep hero copy concise.

### Services

Show these services:

- Exterior Detail
- Interior Detail
- Full Detail
- Paint Correction
- Ceramic Coating

Include:

- intro
- clear service cards or sections
- concise descriptions
- what's-included information
- optional starting-price treatment
- detailing process
- FAQ
- Request Appointment CTA

Do not make the page feel like an ecommerce catalog.

### Gallery

Create a photography-led portfolio page.

Include:

- intro
- strong image grid
- several before/after examples
- concise captions
- visual grouping or filter-like navigation if it improves UX
- final CTA

The page should remain useful even if filtering is not implemented later.

### Contact / Appointment Request

Include:

- short intro
- contact information
- opening hours
- location/map area
- appointment request form

Suggested form fields:

- Name
- Phone
- Email (optional)
- Vehicle make/model
- Service of interest
- Preferred date
- Message / notes

Make the submission expectation clear:

**The studio will contact the customer to confirm the appointment.**

---

## Responsive requirements

Design desktop, tablet, and mobile intentionally.

Mobile requirements:

- navigation must be touch-friendly
- primary CTA remains obvious
- text should not become dense
- service content should stack naturally
- gallery must remain visually strong
- form fields must be comfortable to use
- avoid horizontal scrolling
- avoid overly tall empty hero areas

---

## Accessibility expectations

Use:

- strong text/background contrast
- readable body text
- clear focus/interactive states
- visible labels on form inputs
- meaningful button labels
- sufficient touch target sizes
- semantic visual hierarchy

Do not rely on color alone to communicate state.

---

## HTML/CSS handoff requirements

The final Stitch version will be exported and used as engineering reference.

When possible:

- keep layout structure understandable
- use consistent component patterns across pages
- avoid unnecessary one-off styles
- reuse button and card treatments
- keep typography consistent
- keep spacing patterns consistent
- keep responsive behavior predictable

Do not optimize for WordPress or PHP. Engineering adaptation happens later.

---

# Stitch Prompt v1

Use the following as the initial project prompt:

> Design a polished responsive four-page website for **NOIR Auto Detailing**, a premium automotive detailing studio.
>
> The website is for car owners who want high-quality exterior, interior, paint-correction and ceramic-coating services. The primary conversion is **Request Appointment** and the secondary action is **View Services**.
>
> Create these pages as one cohesive website: **Home, Services, Gallery, and Contact / Appointment Request**.
>
> Use a premium automotive editorial style: modern, minimal, confident, high-contrast, photography-led and spacious. Favor dark neutral tones, strong typography, clean grids, subtle dividers and one restrained accent color. Avoid neon racing aesthetics, excessive gradients, glassmorphism, generic SaaS cards, dashboard patterns, overly rounded UI and fake luxury decoration.
>
> The Home page should include a strong hero, concise positioning, the two main CTAs, featured services, selected work or before/after examples, trust/value points, testimonials and a final CTA.
>
> The Services page should cover Exterior Detail, Interior Detail, Full Detail, Paint Correction and Ceramic Coating, with concise descriptions, what's included, optional starting-price presentation, a simple process section, FAQ and a CTA.
>
> The Gallery page should be photography-led, using a strong visual grid with before/after examples and short captions. It can visually suggest categories, but the design must still work without real filtering.
>
> The Contact / Appointment Request page should contain contact information, opening hours, a location/map area and a form with Name, Phone, optional Email, Vehicle make/model, Service of interest, Preferred date and Message/notes. Make it clear this is an appointment request and that the studio will contact the customer to confirm.
>
> Design desktop, tablet and mobile intentionally. Mobile must not look like a compressed desktop version. Keep navigation touch-friendly, text readable, forms comfortable, galleries strong and CTAs obvious.
>
> Use a consistent shared design system across all four pages: header, footer, typography, spacing, buttons, cards and form controls. Keep the structure clean and reusable because the final design will later be exported as HTML/CSS and converted into a maintainable WordPress theme.
