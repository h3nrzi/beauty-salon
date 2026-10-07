# Pilot Product Definition

## Product

**NOIR Auto Detailing**

A fictional premium auto detailing studio website used specifically for Stitch → WordPress Pilot 01.

The business is intentionally simple: customers discover detailing services, inspect the quality of previous work, and contact the studio to request an appointment.

## Why this product

This product is a good first pilot because it gives us:

- a visually strong homepage for testing Stitch
- repeated service cards
- a gallery-heavy page
- clear CTA hierarchy
- a simple contact/booking-intent flow
- useful WordPress content-model questions
- no complex application/backend domain logic

It is also different from booking-heavy salon projects already explored elsewhere.

## Target audience

Car owners who care about appearance, paint condition, cleanliness, and premium vehicle care.

Primary intent:

1. understand what the studio offers
2. judge the quality of the work
3. choose a service
4. contact the studio

## Primary conversion

**Request an appointment**

This is intentionally a booking-intent/contact action, not a full scheduling engine.

Pilot 01 does not need:

- real-time availability
- online payment
- customer accounts
- appointment management
- CRM behavior

## Sitemap

### 1. Home

Purpose: establish trust, show the visual quality of the studio, and move visitors toward services or contact.

Required sections:

- Header / navigation
- Hero
- Primary CTA: Request an appointment
- Secondary CTA: View services
- Short studio value proposition
- Featured services
- Before/after or featured work section
- Why choose us
- Testimonials
- Final CTA
- Footer

### 2. Services

Purpose: clearly explain the detailing packages and individual services.

Required sections:

- Page intro
- Service cards
- What is included
- Optional starting-price presentation
- Process / how it works
- FAQ
- CTA to request an appointment

Initial service set:

- Exterior Detail
- Interior Detail
- Full Detail
- Paint Correction
- Ceramic Coating

The service list is content, not a final WordPress schema decision.

### 3. Gallery

Purpose: prove quality through previous work.

Required sections:

- Page intro
- Filterable-looking or grouped visual gallery
- Before/after examples where useful
- Short project captions
- CTA to contact the studio

For Pilot 01, filtering may remain visual-only unless it is trivial and useful.

### 4. Contact / Appointment Request

Purpose: convert interest into a lead.

Required sections:

- Contact details
- Opening hours
- Location/map placeholder
- Appointment request form
- Service-interest selector
- Vehicle information fields
- Message/notes
- Clear expectation that this is a request, not an instantly confirmed appointment

## Navigation

Primary navigation:

- Home
- Services
- Gallery
- Contact

Primary header CTA:

**Request Appointment**

## Content tone

- premium
- direct
- precise
- confident
- not overly luxurious or pretentious
- short copy
- strong visual hierarchy

## Visual direction

The visual language should feel:

- premium automotive
- editorial
- clean
- dark-neutral dominant
- high contrast
- restrained use of accent color
- large photography
- generous spacing
- sharp typography
- minimal decorative UI

Avoid:

- gaming/neon aesthetics
- excessive gradients
- glassmorphism
- dashboard-like cards
- overly rounded components
- fake luxury clichés
- dense text

## Responsive direction

The design must be intentional at:

- desktop
- tablet
- mobile

Mobile should not be treated as a compressed desktop layout.

Important mobile behavior:

- clear single primary CTA
- readable service cards
- comfortable gallery browsing
- touch-friendly navigation
- short sections and controlled vertical rhythm
- no horizontal overflow

## WordPress editability targets

The eventual WordPress implementation should make these areas editable:

- site identity
- navigation
- homepage copy
- services
- gallery items
- testimonials
- contact information
- opening hours
- appointment request form labels/options where reasonable

Exactly how these are modeled in WordPress will be decided during the MATT engineering phase, after the Stitch export is reviewed.

## Out of scope

- WooCommerce
- online payments
- live booking slots
- memberships
- customer login
- admin operations UI
- multilingual support
- blog
- advanced SEO tooling
- complex animation system

## Pilot success at the product level

The Stitch result should feel like a believable premium detailing business website, not a generic AI landing page.

A visitor should be able to answer these questions quickly:

- What does this studio do?
- What services are available?
- Does the work look trustworthy?
- How do I request an appointment?
