# Codex + MATT Handoff

## Status

Stitch design is frozen at **v3**.

The next phase is not "convert HTML to PHP".

The next phase is:

**Understand the handoff → specify the WordPress implementation → create tickets → implement.**

---

## Inputs Codex must receive

Codex should be given:

1. the complete frozen Stitch v3 export
2. `docs/00-project-brief.md`
3. `docs/02-product-definition.md`
4. `docs/03-stitch-brief.md`
5. `docs/04-stitch-export-audit.md`
6. `docs/06-stitch-v2-review.md`
7. `docs/08-stitch-v3-final-review.md`
8. the final Stitch DESIGN.md
9. all four final screenshots
10. all four HTML files
11. `docs/10-wordpress-runtime-boundary.md`

The v1/v2 history is useful context but v3 is the implementation baseline.

---

## Critical instruction to Codex

Do **not** start implementation immediately.

First inspect the repository, frozen Stitch export, screenshots, product brief, and review notes.

Treat:

- screenshots as visual evidence
- DESIGN.md as design-system guidance
- HTML as interaction/layout reference
- product docs as scope authority

Do not treat generated HTML as production architecture.

---

## MATT sequence

The repo-level Matt setup is complete.

Run the engineering workflow in this order:

1. `/grill-with-docs`
2. resolve and document engineering decisions
3. create/update `GLOSSARY.md` and relevant ADRs as needed
4. `/to-spec`
5. review/approve the specification
6. `/to-tickets`
7. review/approve implementation tickets
8. `/implement` ticket-by-ticket
9. `/code-review`
10. `/retro`

Do not jump directly from handoff to `/to-spec`.

For this pilot, `/to-spec` should synthesize decisions that have already been made during grilling; it should not be used as the place where unresolved architecture/product-engineering choices are first decided.

---

## Engineering decisions to resolve during /grill-with-docs

Resolve these before `/to-spec`.

The final WordPress spec should record the resulting decisions:

### Theme model

- classic PHP theme vs block theme
- template hierarchy
- shared partial/component strategy
- asset build strategy

### Styling

The export uses Tailwind CDN.

The spec must decide whether to:

- compile Tailwind into production theme assets, or
- translate the frozen visual system into maintainable theme CSS

Do not leave Tailwind CDN in production.

### Content model

Decide how WordPress manages:

- services
- gallery/projects
- testimonials
- homepage content
- contact details
- opening hours
- site identity/navigation

Avoid creating CPTs or custom fields unless they materially improve editing and reuse.

### Forms

The frozen design contains an appointment-request UI.

The implementation must define:

- actual field names
- validation
- sanitization
- CSRF/nonce handling
- success/error states
- delivery/storage behavior
- spam protection

The final service choices should be:

- Exterior Detail
- Interior Detail
- Full Detail
- Paint Correction
- Ceramic Coating

Remove `Custom Consultation` unless intentionally re-approved.

### Media

Do not ship remote Stitch/Google/AIDA asset URLs.

Final images should be managed through WordPress or another explicit owned asset strategy.

### Navigation

Replace all placeholder `href="#"` links with WordPress-generated routes/navigation.

### Accessibility

At minimum specify:

- image alt behavior
- keyboard navigation
- menu state/ARIA
- FAQ interaction semantics
- before/after slider keyboard behavior
- focus states
- form labels/errors
- contrast
- reduced motion where relevant

### Performance

Specify:

- local/optimized CSS and JS
- image sizing
- responsive images
- lazy loading where appropriate
- font strategy
- no unnecessary runtime framework dependency

### SEO/platform basics

Specify:

- dynamic page titles
- WordPress document metadata
- semantic heading structure
- canonical site identity behavior
- compatibility with normal WordPress SEO plugins without coupling the theme to one

---

## Frozen visual constraints

Implementation should preserve:

- dark Obsidian foundation
- Champagne accent
- Syne/Inter typography direction
- sharp corners
- hairline borders
- editorial spacing
- large automotive imagery
- current section order unless WordPress constraints justify a documented change
- clear Request Appointment CTA hierarchy

Pixel-perfect duplication is not the goal.

The goal is **visual and behavioral parity with maintainable WordPress architecture**.

---

## Known cleanup items

Codex should fix these without requiring another design round:

- remaining legacy words such as atelier / concierge / provenance registry / concourse
- remove Custom Consultation
- real URLs/navigation
- local/WordPress-managed images
- alt attributes
- repeated markup
- production form handling
- page titles and metadata
- external prototype dependencies

---

## Engineering success criteria

The WordPress result passes when:

- all four pages preserve the approved design intent
- primary content can be edited appropriately in WordPress
- navigation and CTA paths are real
- appointment request works safely
- no generated remote asset dependency remains
- code is maintainable by a human WordPress developer
- responsive behavior matches the frozen reference
- accessibility basics are implemented
- no page builder is required
- no prototype-only CDN implementation remains


---

## Local WordPress baseline

WordPress **7.1.3** is installed under `wordpress/app/public/`.

Codex may inspect WordPress Core as local reference, but Core is immutable for this project. Project implementation belongs under `wp-content`, primarily in the NOIR theme.

See `docs/10-wordpress-runtime-boundary.md` before specifying implementation.
