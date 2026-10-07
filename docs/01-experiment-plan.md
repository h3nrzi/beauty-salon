# Experiment Plan

This document tracks the planned phases of Pilot 01.

## Phase 0 — Setup

- Initialize repository.
- Define documentation rules.
- Define pilot boundaries.
- Select the service product/domain.
- Freeze the page inventory.

**Exit condition:** product and 3–4 page scope are explicit.

## Phase 1 — Product framing

Create a compact input for Stitch:

- audience
- business goal
- primary CTA
- page inventory
- content hierarchy
- required sections
- visual direction
- mobile/responsive expectations
- accessibility expectations
- WordPress editability hints

**Exit condition:** approved Stitch-ready product brief.

## Phase 2 — Stitch design

Use Google Stitch to:

- explore visual directions
- establish a consistent design system
- design all selected pages
- validate mobile and desktop layouts
- refine navigation and CTA hierarchy
- eliminate obvious UX inconsistencies

Every important prompt or corrective instruction is recorded.

**Exit condition:** approved visual baseline.

## Phase 3 — Stitch handoff

Capture:

- exported HTML/CSS
- assets
- screenshots/reference views
- design notes
- known limitations

Review the export before WordPress conversion.

Questions to answer:

- What is reusable?
- What is duplicated?
- What is structurally weak?
- What should remain visual reference only?
- Which content areas need WordPress data?

**Exit condition:** engineering handoff is understood.

## Phase 4 — Codex + MATT specification

Before implementation, use the MATT workflow to turn the handoff into an explicit implementation specification and tickets.

The spec should cover:

- theme structure
- WordPress template mapping
- reusable components/partials
- asset loading
- navigation
- editable content
- content types if needed
- forms
- accessibility
- responsive parity
- security/escaping
- testing

**Exit condition:** implementation-ready tickets exist.

## Phase 5 — WordPress implementation

Convert the approved design into a real WordPress theme.

Important rule:

> Preserve design intent, but do not blindly preserve generated implementation choices.

**Exit condition:** all scoped pages work in WordPress with editable content.

## Phase 6 — QA

Compare WordPress against the approved Stitch reference.

Verify:

- desktop parity
- mobile parity
- typography
- spacing
- assets
- navigation
- content editing
- form behavior
- accessibility basics
- performance basics
- WordPress escaping/sanitization

**Exit condition:** pilot acceptance checklist passes.

## Phase 7 — Retrospective and workflow extraction

Document:

- what worked
- what failed
- recurring cleanup patterns
- prompt patterns
- WordPress conversion rules
- decisions that should become defaults
- decisions that must remain project-specific
- automation opportunities

Then promote `workflow-draft.md` into a reusable v1 workflow.

**Exit condition:** Pilot 01 produces a reusable process, not just a website.
