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

The four-page NOIR pilot is implemented as a classic theme and project-owned plugin. Explicit reproducible bootstrap, safe repeat imports, scoped reset and local acceptance checks are documented in [pilot acceptance](docs/pilot-acceptance.md). The full local regression runner is `npm run test:pilot`, using a configured disposable Local WP-CLI runtime.

Production acceptance remains pending actual legal destinations, cleared photography, configured real inbox delivery, production HTTPS/performance evidence and manual browser/accessibility/visual sign-off. See `.scratch/noir-wordpress-pilot/issues/07-reproducible-pilot-acceptance.md` and the evidence index in `docs/evidence/pilot-07/`.
