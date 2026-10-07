# Decision Log

A lightweight record of decisions made during the pilot.

## D-001 — Separate design generation from production engineering

**Status:** Accepted

Google Stitch is responsible for UI/UX exploration and the approved visual baseline.

The exported HTML/CSS is treated as handoff material and implementation evidence, not as production architecture that Codex must preserve.

## D-002 — Use a small 3–4 page website for Pilot 01

**Status:** Accepted

The first experiment should expose the full Stitch → WordPress conversion loop without introducing application complexity.

## D-003 — No page builder in Pilot 01

**Status:** Accepted

The first pilot will target a native, maintainable WordPress theme so we can observe the real conversion problems instead of delegating them to Elementor or another visual builder.

## D-004 — Codex implementation follows the MATT methodology

**Status:** Accepted

Engineering starts from an explicit spec/ticket phase rather than immediately rewriting the Stitch export.

## D-005 — Optimize for learning and repeatability

**Status:** Accepted

The repository records prompts, failures, deviations, and cleanup work. A successful website with undocumented manual steps is not considered a complete success.


## D-006 — Pilot 01 product is a premium auto detailing studio

**Status:** Accepted

The fictional product is **NOIR Auto Detailing**.

The four-page scope is:

1. Home
2. Services
3. Gallery
4. Contact / Appointment Request

Rationale:

- visually rich enough to test Stitch well
- simple enough to avoid application/backend complexity
- repeated services and gallery content create useful WordPress modeling questions
- clearly different from previously explored salon/booking products
- provides a realistic CTA and form without requiring a scheduling engine

## D-007 — Appointment flow remains lead generation

**Status:** Accepted

Pilot 01 will not implement live slot selection, automatic appointment confirmation, payment, customer accounts, or appointment management.

The contact form collects an appointment request. The business confirms it later.


## D-008 — v2 is accepted as the visual direction, but not frozen

**Status:** Accepted

Stitch v2 materially improved copy density and restored the appointment form to the intended lead-generation shape without damaging the approved visual system.

However, the actual exported HTML still contains stale ultra-luxury terminology in shared footer content and secondary sections, even though the v2 design-system document claims that terminology was replaced.

A final content-consistency pass is required before design freeze.

This establishes a workflow rule:

> Never freeze a Stitch handoff based only on DESIGN.md or the main screen. Audit the actual exported pages and repeated shared content.
