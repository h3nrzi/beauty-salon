# Stitch Export Audit — v1

## Status

**Result: Strong visual baseline, not yet ready for Codex/WordPress handoff.**

The first Stitch export successfully establishes a coherent visual system across all four pages, but it also introduces product, content, accessibility, and implementation issues that should be corrected or consciously accepted before engineering begins.

The next action is one focused Stitch refinement pass.

---

## Export inventory

Received export:

- Home — `code.html` + screenshot
- Services — `code.html` + screenshot
- Gallery — `code.html` + screenshot
- Contact / Appointment Request — `code.html` + screenshot
- `DESIGN.md` — "Obsidian & Champagne Precision"

Original ZIP SHA-256:

`c9f5c0c779f21a7d7ccb192877263af8af65cb3b61e56b4fb755570c2194ad32`

Text artifact hashes:

- Home HTML: `4a66555fa5b79394905053b653e4b5df2d0fda4ce12984512c8d4ec73e159d9e`
- Services HTML: `5687fd3c4d74a7de6e87f5e4ce331360d3270ff0606b8309c0831f9d58827cdb`
- Gallery HTML: `bc301361ec09dd4765e394be692b76a80f4a361dca18a9432fb9acf3c48768dd`
- Contact HTML: `2dc561e9126e9b8494f7400b73d57644741ee32bde015b44fa27ca5ea5420f2f`
- DESIGN.md: `b25c709d2a5f259cdc333a34346125e855487e713e87088ffe43f9c48556c92f`

---

## What Stitch did well

### 1. Cohesive design system

The strongest output is the shared visual language:

- Syne + Inter typography pairing
- dark obsidian surface system
- restrained champagne/gold accent
- sharp rectangular geometry
- hairline borders
- consistent spacing vocabulary
- consistent button and card treatment
- consistent header/footer family
- strong image-led editorial direction

This is much closer to a usable design handoff than a set of disconnected generated landing pages.

### 2. DESIGN.md is valuable

The export includes a structured design-system document covering:

- color tokens
- typography tokens
- spacing
- breakpoints
- elevation rules
- shape rules
- component behavior

This is high-value input for the later Codex/MATT phase because engineering can preserve design intent without treating generated HTML as architecture.

### 3. Page hierarchy is visually convincing

All four pages have clear hierarchy and the main CTA remains prominent.

The visual output looks deliberately art-directed rather than like a generic SaaS template.

### 4. Useful interaction prototypes

The generated HTML includes lightweight interaction examples:

- mobile navigation drawer
- before/after sliders
- gallery filters
- FAQ accordion

These can serve as behavioral references even if the production implementation changes.

---

## Product/UX issues to correct in Stitch

### 1. The tone overshot the brief

The brief asked for premium, direct, precise, and **not overly pretentious**.

The generated experience repeatedly uses language such as:

- atelier
- commission
- allocation
- registry
- master protocol
- clinical
- archival
- concourse

The result is visually compelling but the copy frequently feels more like a fictional ultra-luxury concept than a believable detailing business.

**Decision:** Keep the visual sophistication, simplify the language.

### 2. Information density is too high

Especially on Services and Contact, the layout contains too many:

- technical labels
- metrics
- badges
- pseudo-certifications
- process details
- metadata rows

This weakens scanability and makes the site feel larger and more complex than our four-page pilot needs.

**Decision:** Reduce information density by roughly 25–35% while keeping the same visual system.

### 3. The appointment form became too complex

The original brief suggested a simple appointment-request form.

The export contains 18 form controls, including vehicle-condition classification, additional service toggles, transit requests, and other operational details.

This is outside the intended product scope for Pilot 01.

**Decision:** Return to the simple lead-generation boundary.

Target fields:

- Name
- Phone
- Email (optional)
- Vehicle make/model
- Service of interest
- Preferred date
- Message / notes

### 4. Avoid invented proof claims as primary trust signals

The pages contain numerous precise-looking claims, certifications, operational figures, environmental measurements, and capacity statistics.

For a fictional visual prototype these are useful as texture, but a reusable product workflow should not encourage the design model to invent business claims.

**Decision:** Use neutral placeholder proof points or clearly generic trust language unless real business data is supplied.

### 5. Preserve the strong gallery direction

Gallery is one of the best results.

The before/after inspection concept and editorial case-study composition are worth preserving.

However, the final design should not depend on long fictional case-study copy to remain visually balanced.

---

## HTML/CSS implementation audit

### Good structural signals

Each page includes:

- semantic `header`
- semantic `main`
- semantic `footer`
- a single `h1`
- responsive utility classes
- reusable visual token names
- consistent Tailwind configuration
- shared navigation concept

The same Tailwind configuration and base style block are duplicated identically across all four HTML files. This is useful evidence that a central theme stylesheet/config can replace them later.

### Production blockers / cleanup requirements

#### Tailwind CDN

All four pages load:

`https://cdn.tailwindcss.com`

This is acceptable for generated prototype HTML but should not remain the production WordPress strategy as-is.

The MATT phase must explicitly decide whether to:

- compile Tailwind into theme assets, or
- translate the design into maintainable theme CSS.

Do not make that decision during the Stitch phase.

#### External image dependencies

The export uses Google-hosted remote image URLs, including `aida-public` assets.

Production must not depend on these generated remote URLs.

Images will need to be:

- replaced with owned/licensed final media
- downloaded/localized where appropriate
- managed through the WordPress Media Library

The exported screenshots also show the logo asset failing to render in some locations, reinforcing that remote asset URLs are not a safe production dependency.

#### Navigation links are placeholders

Most internal links currently use:

`href="#"`

Observed placeholder-link counts:

- Home: 27
- Services: 26
- Gallery: 22
- Contact: 20

This is expected in a visual prototype but must become WordPress-generated URLs/navigation.

#### Header/footer duplication

Each HTML file contains its own header and footer markup.

The structures are substantially shared but include page-specific active state differences.

Production should extract these into WordPress theme structure rather than preserving page-level duplication.

#### Form is presentation-only

The Contact page contains a real `form` element, but it has no meaningful production submission contract.

Most user-data controls also do not yet carry useful `name` attributes.

The form should therefore be treated as UI reference, not functional implementation.

#### Accessibility gaps

The export has useful labels on the appointment form, but several visual images use `data-alt` rather than real `alt` attributes.

Observed images missing real `alt`:

- Home: 6
- Services: 7
- Gallery: 7
- Contact: 1

Additional items to revisit during engineering:

- slider keyboard interaction
- mobile navigation ARIA state
- focus states
- gallery-filter semantics
- reduced-motion behavior where applicable

#### Metadata / SEO is incomplete

The generated pages do not contain normal page `title` elements and do not represent a production SEO layer.

This is expected for the Stitch prototype and should be solved in WordPress.

---

## Page-by-page assessment

### Home

**Keep**

- visual direction
- hero composition
- service-card treatment
- selected work section
- final CTA rhythm
- dark/gold system

**Refine**

- reduce pseudo-technical microcopy
- simplify trust metrics
- keep headline/copy shorter
- ensure the brand/logo is represented by a stable local/reference asset

### Services

**Keep**

- alternating image/content rhythm
- service breakdown concept
- process section
- FAQ
- strong visual hierarchy

**Refine**

- substantially reduce copy
- remove unnecessary technical claims
- use the plain service names from the product definition
- make scanning easier
- avoid turning five simple services into an over-engineered catalogue

### Gallery

**Keep almost entirely**

- editorial grid
- case-study feeling
- before/after slider concept
- filter concept
- strong photography priority

**Refine**

- shorten case-study copy
- use neutral data placeholders where real data is unavailable
- make sure the layout still works with ordinary WordPress gallery/project content

### Contact / Appointment Request

**Keep**

- split information/form layout
- clear appointment-request expectation
- contact information hierarchy
- operating-hours block
- visual consistency with rest of site

**Refine heavily**

- simplify the form back to the agreed scope
- remove "allocation/commission" language
- remove operational complexity not needed for lead generation
- replace excessive facility/concierge concepts with normal business contact details

---

## Handoff decision

**Do not start Codex/MATT implementation yet.**

The export is visually strong enough to keep, but one controlled Stitch refinement pass will make the downstream conversion materially cleaner.

We should freeze the visual system and adjust:

1. copy tone
2. content density
3. appointment-form scope
4. invented proof/technical claims
5. basic handoff hygiene where Stitch can improve it

After v2 is exported, compare v1 and v2, approve the visual baseline, and only then start the Codex/MATT specification phase.
