# Stitch Review 04 — Services page

**Reviewed:** 2026-10-08  
**Source:** Stitch Services export containing desktop + mobile screens and the shared design-system document  
**Decision:** **Accept and freeze the Services visual/interaction direction.** Remaining issues are deterministic content/policy cleanup and must not trigger another generative Services redesign loop.

## What works

The Services exploration extends the frozen Home baseline coherently:

- the Soft Editorial palette, spacing and card language are preserved;
- desktop and mobile both read as the same product family;
- the page is correctly richer than the curated Home service preview;
- service cards expose name, description, duration, price and eligible specialists;
- multi-service selection is visually explicit;
- selected state is not communicated by color alone;
- incompatible service state is visible and explained;
- desktop provides a persistent selected-services summary;
- mobile provides a compact selected-services summary close to the primary continue action;
- total duration and total price are surfaced;
- the next action clearly moves to specialist/time selection;
- pay-at-salon / no-online-payment messaging remains visible;
- service durations shown are consistent with the approved 15-minute duration increments.

The core interaction concept is strong enough to guide engineering and later cross-page design.

## Deterministic cleanup required

### 1. Cancellation policy contradicts the frozen Product Definition

The desktop export says customers can change/cancel up to **6 hours** before the appointment.

The approved policy is:

- customer self-cancel/reschedule until **24 hours before** the appointment;
- inside the final 24 hours, the customer must contact the salon.

The 6-hour wording is invalid and must not survive handoff.

### 2. Unsupported claims were reintroduced

The desktop export includes claims equivalent to:

- guaranteed sterilized packs;
- organic / certified materials;
- sulfate/paraben/cruelty-free sourcing;
- broad hygiene/material guarantees.

These are explicitly outside approved product facts.

Replace later with neutral copy such as:
- professional and orderly environment;
- transparent service information;
- clear scheduling;
- customer-facing consultation where actually supported.

Do not imply certifications, guarantees, organic/vegan status or material provenance without approved evidence.

### 3. Some service copy drifts toward wellness/clinical claims

Examples include wording around lymphatic drainage, circulation improvement and other physiological outcomes.

For the current product, service placeholder copy should remain firmly in normal beauty-salon territory and avoid medical/clinical promises or therapeutic outcome claims.

This is content cleanup, not a reason to change the layout.

### 4. Incompatible-service behavior adds an unapproved split-booking promise

Desktop copy says the system will guide the customer to split incompatible services into a separate appointment and includes a “reserve separately” action.

The approved rule is only:

- one appointment may contain multiple services if at least one common specialist can perform the full set;
- incompatible additions must fail clearly.

Do not promise an automated split-booking flow until it is explicitly added to product scope.

A simple incompatible state with guidance to remove/change selections is sufficient.

### 5. Fixed price/duration should not be labelled as estimates

The desktop selected-services summary says “estimated duration” and “estimated cost”.

The current product defines fixed service durations and customer-facing service prices.

Use:
- total duration;
- total price.

Do not introduce variable/estimated pricing semantics without a product decision.

### 6. Mobile and desktop sample catalogs differ

Desktop shows seven sample services while mobile shows four.

For the visual baseline this is acceptable as representative composition, but engineering must use one authoritative catalog dataset and render the same underlying records responsively.

Do not treat the two Stitch variants as separate product inventories.

### 7. Mobile bottom navigation includes a Profile destination

The frozen public page inventory does not define a standalone Profile page.

The product does have authenticated customer identity, but the accepted customer application surface is primarily My Appointments.

During later audit/handoff:
- do not create a new Profile product area merely because Stitch rendered one;
- either map identity/account affordances into the approved authenticated experience or record a deliberate scope change first.

### 8. Mock business data remains non-authoritative

Phone, address, hours and service/person names are visual fixture data only.

Do not treat them as production facts.

### 9. Known design-token cleanup remains deferred

The shared DESIGN.md still carries the same font/color token inconsistencies already recorded in the frozen Home baseline:
- Persian display tokens still name `Noto Serif`;
- frontmatter primary values still conflict with the prose primary terracotta definition.

These remain deterministic export-audit / engineering-handoff cleanup and do not require more Stitch iteration.

## Freeze decision

Freeze the Services direction as:

`ara-services-soft-editorial-v1`

Accepted:
- service catalog composition;
- category/filter presentation direction;
- selected/unselected/incompatible state language;
- desktop selected-services summary concept;
- mobile selected-services summary concept;
- total duration/price presentation;
- eligible-specialist context;
- CTA transition into specialist/time selection;
- responsive visual hierarchy.

Not authoritative:
- literal sample service catalog;
- staff/customer names;
- business contact data;
- 6-hour cancellation text;
- organic/certification/hygiene claims;
- therapeutic claims;
- split-booking automation;
- standalone Profile destination;
- generated HTML/framework choices.

## Next step

Do not iterate Services again unless a later cross-page design exposes a genuine system-level inconsistency.

Use the frozen Home + Services visual language to design the next scoped page: **Specialists**.
