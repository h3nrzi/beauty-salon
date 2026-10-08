# Stitch Review 09 — Booking flow

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (6).zip`  
**Package SHA-256:** `97bfad94f4a36a2bd009a646a039bab9fadd1b97d830a9d4170064fed9a4a4d4`  
**Decision:** **Visual direction accepted, Booking baseline not frozen.** One focused completion/correction pass is required because this is the core application flow and several frozen product rules / required states are still missing or contradicted.

## What works

The export establishes a strong application-language extension of the public Soft Editorial system:

- clear 5-stage progress structure;
- multi-service selection with running duration/price;
- visible incompatible-service state;
- first-class «هر متخصص در دسترس» option;
- eligible/ineligible specialist treatment;
- date/time selection with 30-minute start choices visible in the time screen;
- 90-day horizon and 60-minute same-day lead-time messaging;
- mobile identity verification without password UI;
- review/confirmation screen with complete booking summary;
- immediate-confirmation concept;
- dedicated stale-slot recovery screen;
- successful booking screen;
- selection-preserving back/forward flow direction.

This is the correct visual direction. Do not redesign it from scratch.

## Blocking product/behavior mismatches

### 1. Customer change cutoff is wrong in the date/time step

The date/time screen says cancel/change is allowed until **12 hours** before the appointment.

The frozen rule is **24 hours**.

This must be corrected before Booking is frozen.

### 2. Stale-slot recovery silently preselects a replacement time

The stale-slot screen shows 11:30 as already selected / “nearest available” after the original 10:00 slot is lost.

The frozen rule is:

- do not create the appointment;
- preserve services;
- preserve specialist choice;
- return to current time selection;
- show current alternatives;
- **do not silently switch or preselect another time**.

The recovery screen must leave the replacement time unselected until the customer explicitly chooses it.

### 3. Required empty/error states are missing

Prompt 09 explicitly required:

- **No eligible specialist** for the selected service set;
- **No availability** when eligible specialists exist but no times are available.

The export shows an incompatible service card and one ineligible specialist, but it does not show the required full-flow empty states.

Because Booking is core product behavior, these states must be designed before freeze.

### 4. Desktop Booking equivalents are missing

The prompt required mobile-first screens **and desktop equivalents around 1440 CSS px**.

The exported screen set is narrow/mobile-like throughout; no credible desktop Booking flow is included.

Booking cannot be frozen until the same interaction model is demonstrated on desktop.

## Deterministic content/scope cleanup required in the refinement

### Specialist screen

The export adds:

- ratings such as 4.9 / 4.8;
- certificate/credential claims;
- “senior”/credential-style copy not supplied by product data.

Ratings/reviews are out of scope and credentials are unverified.

Use neutral fixture expertise only.

### Service screen

The service-copy layer reintroduces:

- “organic glow” wording;
- lymphatic-drainage / physiological language;
- anatomy-based claims.

Keep service fixtures non-clinical and neutral.

The incompatible-service message may tell the customer to change/remove the conflicting service. Do **not** introduce an automated split-booking workflow.

### Identity screen

The screen says a personalized profile of services/preferences is activated.

A standalone profile/preferences product is not in frozen scope.

Keep identity behavior limited to:

- name;
- verified mobile;
- optional email;
- recovery of the same customer identity / appointment history.

The verification-code UI is acceptable as an interaction concept, but do not name a provider or promise reminder/confirmation delivery behavior.

Avoid absolute privacy guarantees such as “complete privacy”; detailed security/privacy implementation belongs later.

### Review screen

The export introduces several non-authoritative items:

- “branch Fereshteh” / branch language — v1 is single-salon;
- SMS tracking/reminder promise;
- satisfaction-dependent payment wording;
- specialist ratings/credentials;
- “free” cancellation/change fee policy.

Normalize to:

- one salon;
- pay at salon;
- 24-hour self-change cutoff;
- immediate confirmation;
- no messaging-delivery promise;
- no refund/fee promise unless later approved.

### Success screen

The success screen adds:

- “central branch” wording;
- SMS reminder 2 hours before;
- “add to calendar”;
- “share details”;
- arrive 10 minutes early;
- seasonal drink / hospitality promise.

These are new capabilities or business rules not frozen in Product Definition.

For the Booking baseline, keep success focused on:

- confirmed appointment;
- services;
- assigned specialist;
- date/time;
- duration/price;
- pay at salon;
- path to «وقت‌های من»;
- safe return to the public site.

Any calendar/share/reminder/hospitality feature requires a deliberate product decision later.

## Design-system cleanup already known

The booking-specific design delta correctly documents:

- terracotta `#9E5A4E`;
- 5-stage progress;
- stale/no-specialist/no-availability state intent.

However the shared `DESIGN.md` still carries old deterministic token inconsistencies:

- Persian display frontmatter still names `Noto Serif`;
- `primary: #814338` conflicts with the prose primary action `#9E5A4E`.

These do not require visual redesign, but the final frozen Booking reference should describe the intended semantic tokens consistently.

## Evidence note

Current screenshots are useful mobile-flow design references, but they do not satisfy the requested desktop evidence.

## Decision

**Do not freeze Booking yet.**

Run one focused refinement/completion pass that:

1. preserves the accepted application visual system;
2. fixes the 24-hour rule;
3. fixes stale-slot recovery so no replacement is preselected;
4. adds explicit No Eligible Specialist and No Availability states;
5. removes scope/content drift from specialist/service/identity/review/success screens;
6. provides a coherent desktop equivalent of the same flow.

If that pass succeeds, freeze Booking without another generative redesign loop.
