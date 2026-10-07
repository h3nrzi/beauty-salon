# Stitch → WordPress Workflow — Draft

> This document is intentionally incomplete. It evolves from evidence gathered during Pilot 01.

## Current workflow hypothesis

```text
1. Define a small product
2. Freeze page scope
3. Prepare Stitch-ready product/design brief
4. Generate and iterate UI/UX in Stitch
5. Approve a visual baseline
6. Export HTML/CSS/assets
7. Audit the export
8. Feed the approved handoff into Codex
9. Run Matt repo setup once
10. Grill unresolved engineering decisions with docs
11. Record vocabulary/ADRs as decisions settle
12. Run MATT to-spec
13. Run MATT to-tickets
14. Implement ticket-by-ticket
15. Code review and QA against Stitch
16. Run retrospective
17. Extract reusable rules
```

## Rules already established

### Stitch

- Stitch owns visual exploration.
- Finish the major UI/UX decisions before engineering.
- Keep all scoped pages inside one coherent design system.
- Treat responsive design as part of the handoff, not a later patch.

### Handoff

- Keep the raw export unchanged as reference.
- Review generated markup and CSS before converting it.
- Separate visual intent from generated implementation details.
- Record any manual correction that appears reusable.

### Codex + MATT

- Do not begin by blindly splitting HTML into PHP files.
- Run repo setup once before planning.
- Use grilling to settle unresolved engineering choices before specification.
- First understand the product, templates, repeated components, editable data, and runtime boundaries.
- Let `/to-spec` synthesize settled decisions rather than inventing them.
- Produce a spec and implementation tickets before code.
- Prefer WordPress-native conventions over preserving generated structure.

### WordPress

- Avoid unnecessary hardcoding.
- Escape output and sanitize input.
- Load assets through WordPress APIs.
- Use the template hierarchy intentionally.
- Keep the first pilot free from page-builder dependencies.

## Evidence to collect during Pilot 01

- Stitch prompt history
- screenshots of approved pages
- raw HTML/CSS export
- export audit notes
- MATT specification
- tickets
- implementation deviations
- QA findings
- final retrospective

## Open questions

These must be answered by evidence rather than assumptions:

- How much of Stitch HTML is worth preserving?
- Does Stitch produce stable reusable components across pages?
- What CSS cleanup patterns repeat?
- What is the best boundary between static page templates and WordPress-managed content?
- When is a custom post type justified?
- When should block/Gutenberg support enter the workflow?
- Which prompt instructions improve downstream HTML quality?
- What parts of the conversion can eventually be automated?
