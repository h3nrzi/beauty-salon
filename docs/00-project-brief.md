# Project Brief

## Project

**Stitch → WordPress Pilot 01**

## Objective

Test whether a small service website can be designed end-to-end in Google Stitch, exported as HTML/CSS, and then converted with Codex and the MATT methodology into a clean, maintainable WordPress project.

## What we are testing

1. How well Stitch can own the UI/UX phase.
2. How useful its HTML/CSS output is as an engineering handoff.
3. What must be cleaned, refactored, or re-modeled before WordPress integration.
4. How Codex + MATT should consume the export.
5. Which steps can become a reusable workflow for future products.

## Pilot scope

The first pilot intentionally stays small:

- One service-oriented business website
- 3–4 primary pages
- Responsive desktop and mobile design
- Shared visual system and reusable page sections
- One clear primary CTA
- WordPress-managed content where appropriate
- No advanced application/backend domain logic
- No WooCommerce in Pilot 01
- No page builder in Pilot 01

## Proposed page envelope

The exact business/domain is intentionally left open until the next product decision.

The pilot should fit roughly into:

1. Home
2. Services
3. About
4. Contact / Booking Intent

The fourth page may change once the product is selected.

## Engineering boundary

Stitch owns design exploration and the visual reference.

Stitch output is **not** automatically accepted as production architecture.

Codex + MATT own:

- code review of the export
- normalization/refactoring
- WordPress template architecture
- content modeling
- dynamic WordPress integration
- security and escaping
- accessibility and performance checks
- testing and QA

## Success criteria

The pilot succeeds if:

- WordPress output visually preserves the approved Stitch design.
- Key content can be edited from WordPress instead of being hardcoded.
- The codebase is understandable and maintainable by a human developer.
- Responsive behavior survives the conversion.
- We can clearly identify repeatable rules for Stitch → WordPress conversion.
- A second project could follow the resulting workflow with less manual discovery.

## Non-goals

- Building a generic WordPress framework before we have pilot evidence.
- Optimizing for every possible type of website.
- Solving e-commerce, memberships, dashboards, or complex application logic.
- Adding tools merely because they are popular.
