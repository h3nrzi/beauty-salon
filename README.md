# Stitch → WordPress Pilot

An experiment to build a small real WordPress product from a Google Stitch design/export, using Codex and the MATT methodology for the engineering phase.

## Goal

Validate a repeatable workflow:

```text
Product Brief
  → Google Stitch
  → UI/UX iteration
  → HTML/CSS export
  → Codex + MATT
  → WordPress theme
  → QA
  → Workflow retrospective
```

The main output of this repository is not only the finished WordPress site. It is also a documented, reusable workflow for future products.

## Pilot constraints

- Small service-business website
- 3–4 primary pages
- UI/UX completed in Google Stitch before WordPress implementation
- Stitch HTML/CSS treated as design/reference input, not final production architecture
- WordPress implementation should be a real maintainable theme
- No page builder in the first pilot
- Decisions, problems, and deviations are documented as they happen

## Repository map

- `docs/00-project-brief.md` — objective, scope, success criteria
- `docs/01-experiment-plan.md` — phase-by-phase execution plan
- `docs/decision-log.md` — decisions and rationale
- `docs/workflow-draft.md` — evolving reusable workflow
- `docs/retrospective.md` — lessons learned at the end of the pilot
- `references/` — Stitch exports, screenshots, and other reference material
- `wordpress/` — WordPress implementation once engineering begins

## Current status

**Phase 1 — Stitch design / refinement**

Pilot product: **NOIR Auto Detailing**.

Stitch v2 has been reviewed. The visual direction is accepted and content density/form scope improved materially, but stale legacy terminology remains in shared footer and secondary content. Next: run the final content-consistency pass in `docs/07-stitch-final-consistency-prompt-v3.md`, then freeze the Stitch baseline and begin Codex/MATT specification.
