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
