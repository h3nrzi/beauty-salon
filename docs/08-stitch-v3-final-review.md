# Stitch v3 Final Review & Design Freeze

## Verdict

**DESIGN FREEZE — Accepted with known handoff deviations.**

v3 is good enough to become the frozen Stitch baseline.

The remaining mismatches are no longer design problems. They are small content-normalization and implementation-cleanup tasks that are cheaper and safer to handle during the Codex/MATT engineering phase than through another Stitch iteration.

The visual system, page hierarchy, responsive direction, and major UX decisions are now stable.

---

## v2 → v3 comparison

Across the four exported HTML pages:

| Metric | v2 | v3 | Change |
|---|---:|---:|---:|
| Total HTML size | 186,019 bytes | 185,186 bytes | -0.4% |
| Visible text | 2,827 words | 2,737 words | -3.2% |
| Flagged legacy terms | 56 | 9 | -83.9% |
| Form controls | 13 | 12 | -7.7% |
| Placeholder href="#" links | 94 | 102 | prototype-only |
| Images missing real alt | 20 | 20 | unchanged |

The important result is the dramatic reduction in stale product language without disrupting the visual design.

---

## Accepted design baseline

The following are now frozen as design intent:

- four-page information architecture
- Home / Services / Gallery / Contact structure
- Obsidian + Champagne visual system
- Syne + Inter typography direction
- sharp rectangular geometry
- editorial automotive photography
- spacing and section rhythm
- primary/secondary button hierarchy
- service-card visual treatment
- gallery and before/after visual language
- appointment-request layout
- responsive/mobile direction
- shared header/footer visual composition

Engineering may change markup and implementation details, but should preserve this visual intent unless a documented accessibility, performance, WordPress, or maintainability reason requires deviation.

---

## What v3 fixed successfully

### Shared global content

Most legacy ultra-luxury terminology has been removed from Home, Gallery, Contact, and shared content.

The footer is now substantially closer to the agreed product language:

- Home
- Services
- Gallery
- Contact
- Request Appointment
- normal service names
- operating hours
- location
- privacy / terms

### Services

The five intended services are now clearly visible as the primary service model:

- Exterior Detail
- Interior Detail
- Full Detail
- Paint Correction
- Ceramic Coating

The page is materially easier to scan than v1.

### Gallery

The strong editorial visual direction remains intact while the copy is significantly less theatrical.

### Contact

The main form now implements the intended conceptual scope:

1. Name
2. Phone
3. Email
4. Vehicle make/model
5. Service of interest
6. Preferred date
7. Message / notes

The page clearly communicates that the submission is an appointment request rather than an automatically confirmed booking.

---

## Known deviations accepted for engineering cleanup

These are explicitly **not reasons for another Stitch iteration**.

### 1. Small legacy-language residue

Nine flagged legacy terms remain across all visible page copy.

Examples include:

- Home: "Provenance Registry"
- Services: several leftover uses of "atelier", "clinical", and "concourse"
- Gallery: one "concourse" reference
- Contact: two "concierge" references

These are copy substitutions, not design decisions.

**Engineering handoff rule:** normalize them while preserving layout dimensions as closely as practical.

### 2. Contact still contains "Custom Consultation"

The requested five service choices are present, but the form still includes one extra option:

- Custom Consultation

**Engineering handoff rule:** remove it unless product scope explicitly changes.

### 3. DESIGN.md is still not a perfect source of truth

The v3 design-system note says all theatrical terminology has been fully replaced, while the exported HTML still contains a few residual examples.

This reinforces the workflow rule established after v2:

> Treat DESIGN.md as design guidance, not proof that the generated screens and HTML satisfy the brief.

### 4. Prototype-only implementation patterns remain

Expected cleanup for Codex/MATT:

- Tailwind CDN
- remote Google/AIDA images
- placeholder navigation links
- duplicated header/footer markup
- presentation-only form behavior
- incomplete real alt attributes
- missing production metadata/SEO handling
- generated inline scripts/interactions

These are intentionally deferred to engineering.

### 5. Remote-asset reliability

Some exported screenshots show image/logo placeholders not resolving consistently.

Production must not depend on Stitch remote asset URLs.

**Engineering handoff rule:** all final media must be owned/localized or managed through the WordPress Media Library.

---

## Why we stop iterating in Stitch here

Another prompt would mostly be chasing:

- individual words
- one extra radio option
- prototype implementation hygiene
- external asset behavior

Those are better handled deterministically in code.

Continuing to regenerate the UI also introduces the risk of visual regression in already-approved sections.

This creates an important workflow principle:

> Stop using the design generator when the remaining differences are deterministic implementation/content cleanup rather than unresolved UI/UX decisions.

---

## Freeze status

**Stitch Design Phase: COMPLETE**

Frozen reference:

**NOIR Auto Detailing — Stitch v3**

Next phase:

**Engineering Handoff → Codex + MATT**

The engineering phase must begin from the frozen product/design evidence rather than immediately converting HTML files into PHP templates.
