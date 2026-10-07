# Stitch v2 Review

## Verdict

**v2 is materially better than v1, but it is not the final frozen design baseline yet.**

The refinement prompt worked on the primary page content, especially Home and the appointment form. However, Stitch did not propagate the new tone consistently through all shared and secondary content.

One final targeted consistency pass is required before the Codex/MATT handoff.

---

## Quantitative comparison

Across the four exported HTML pages:

| Metric | v1 | v2 | Change |
|---|---:|---:|---:|
| Total HTML size | 209,136 bytes | 186,019 bytes | -11.1% |
| Visible text | 3,538 words | 2,827 words | -20.1% |
| Form controls | 19 | 13 | -31.6% |
| Flagged luxury/technical terms | 141 | 66 | -53.2% |
| Placeholder `href="#"` links | 95 | 94 | essentially unchanged |
| Images missing real `alt` | 21 | 20 | essentially unchanged |

The most important improvement is content simplification without a major loss of the visual system.

---

## What improved

### Home

Home now follows the intended product tone much more closely.

The main visible copy has largely removed terms such as:

- atelier
- commission
- allocation
- clinical protocol
- concourse

The premium visual identity remains intact.

**Status: accepted direction.**

### Contact form

The form has moved back toward the agreed lead-generation scope.

The visible conceptual fields now are:

1. Name
2. Phone
3. Email
4. Vehicle make/model
5. Service of interest
6. Preferred date
7. Message / notes

The raw form-control count is 12 because the service selector is implemented as multiple radio controls.

This is compatible with the product brief.

One extra service option, **Custom Consultation**, remains and can be removed in the final consistency pass.

### Content density

Visible text was reduced by about 20% overall.

Page-specific visible word count:

- Home: 859 → 714
- Services: 1,347 → 1,100
- Gallery: 689 → 517
- Contact: 643 → 496

This is a meaningful improvement.

### Design system

The visual identity remains recognizable:

- dark obsidian surfaces
- champagne/gold accent
- Syne + Inter
- sharp geometry
- editorial photography
- architectural grid
- hairline separators

The refinement did not collapse the design into a generic template.

---

## Main problem remaining: inconsistent propagation

The new v2 design-system document says the vocabulary was simplified and that terms such as `atelier`, `commission`, `allocation`, `dossier`, and `archival registry` were replaced.

The actual HTML does not consistently match that claim.

This is an important workflow finding:

> A generated design-system document cannot be assumed to describe the actual exported pages. The HTML/screens must still be audited.

### Stale shared footer

Services, Gallery, and Contact still contain an older footer/content block using phrases such as:

- ultra-exclusive atelier
- concourse preservation
- Level IV Certified Atelier
- Studio Manifesto
- Concourse Paint Correction
- Ceramic Infusion Matrix
- Archival Registry
- Private Commission Booking
- Private Sunday Allocations Only
- Client Concierge
- Privacy Protocol
- Provenance Registry

This is the single clearest v2 consistency failure.

### Services still contains legacy terminology

Examples include:

- NOIR Atelier Multi-Stage Jeweling
- Atelier Protocols & FAQs
- Master Protocol
- Concourse vs Standard Detail
- structured entry voucher
- certified paint depth telemetry

The page is shorter than v1, but the vocabulary is still more theatrical and technical than the agreed product brief.

### Gallery still contains legacy case-study terminology

Examples include:

- Private Client Commission
- archival / registry language
- concourse language
- legacy shared footer

The layout is still approved; the copy needs normalization.

### Contact still contains secondary scope creep

The core form is now good, but surrounding content still includes:

- Appointments & Concierge
- Beverly Hills Atelier
- Atelier Address
- Optional Enclosed Vehicle Pick-up & Delivery
- multi-step content referring to transportation
- stale ultra-luxury footer

This conflicts with the intentionally simple lead-generation boundary.

---

## Handoff-quality findings unchanged

v2 still uses prototype implementation patterns that Codex must later replace:

- Tailwind CDN
- placeholder `href="#"` navigation
- remote Google/AIDA image dependencies
- duplicated page-level header/footer
- presentation-only form behavior
- incomplete image alt coverage
- no production metadata/SEO layer

These are **not reasons for another Stitch pass**.

They belong to the engineering handoff.

The v3 pass should only fix product/design consistency.

---

## Decision

**Do one final Stitch consistency pass.**

Do not redesign.

Do not change the core layout.

Do not attempt to make the prototype production-ready.

The final pass should:

1. normalize shared header/footer content across every page
2. remove remaining theatrical luxury terminology
3. simplify Services terminology
4. remove secondary contact-page scope creep
5. keep the existing gallery and visual system
6. ensure the updated DESIGN.md matches the actual page output

If those conditions are met, freeze the Stitch baseline and proceed to Codex + MATT.
