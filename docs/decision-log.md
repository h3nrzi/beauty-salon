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


## D-006 — Pilot 01 product is a premium auto detailing studio

**Status:** Accepted

The fictional product is **NOIR Auto Detailing**.

The four-page scope is:

1. Home
2. Services
3. Gallery
4. Contact / Appointment Request

Rationale:

- visually rich enough to test Stitch well
- simple enough to avoid application/backend complexity
- repeated services and gallery content create useful WordPress modeling questions
- clearly different from previously explored salon/booking products
- provides a realistic CTA and form without requiring a scheduling engine

## D-007 — Appointment flow remains lead generation

**Status:** Accepted

Pilot 01 will not implement live slot selection, automatic appointment confirmation, payment, customer accounts, or appointment management.

The contact form collects an appointment request. The business confirms it later.


## D-008 — v2 is accepted as the visual direction, but not frozen

**Status:** Accepted

Stitch v2 materially improved copy density and restored the appointment form to the intended lead-generation shape without damaging the approved visual system.

However, the actual exported HTML still contains stale ultra-luxury terminology in shared footer content and secondary sections, even though the v2 design-system document claims that terminology was replaced.

A final content-consistency pass is required before design freeze.

This establishes a workflow rule:

> Never freeze a Stitch handoff based only on DESIGN.md or the main screen. Audit the actual exported pages and repeated shared content.


## D-009 — Freeze Stitch v3 and move residual cleanup to engineering

**Status:** Accepted

Stitch v3 is the frozen design baseline.

The final pass reduced flagged legacy terminology from 56 instances in v2 to 9 in v3 while preserving the approved visual system.

A few content inconsistencies remain, including isolated legacy terminology and one extra "Custom Consultation" service option. These are deterministic content/implementation corrections and do not justify another generative design pass.

Workflow rule established:

> Stop iterating in Stitch when the remaining differences are deterministic content or implementation cleanup rather than unresolved UI/UX decisions.

The next phase is Codex + MATT specification, not direct HTML-to-PHP conversion.


## D-010 — Use grilling before specification

**Status:** Accepted

Matt Pocock skills are installed and `/setup-matt-pocock-skills` is complete.

This repo uses:

- local Markdown issue tracking under `.scratch/`
- single-context domain documentation with root `GLOSSARY.md`
- ADRs under `docs/adr/`

The engineering workflow is:

```text
/setup-matt-pocock-skills ✅
        ↓
/grill-with-docs
        ↓
resolved engineering decisions + domain docs/ADRs
        ↓
/to-spec
        ↓
/to-tickets
        ↓
/implement
        ↓
/code-review
        ↓
/retro
```

Rationale: unresolved WordPress architecture and implementation choices should be settled during grilling. `/to-spec` should synthesize those decisions into an implementation specification rather than becoming the first place decisions are made.

## D-011 — Resolve the initial WordPress engineering boundaries

**Status:** Accepted

The pre-spec engineering interview established a classic PHP theme with developer-controlled layout, editable WordPress content, authoritative shared content, plain theme CSS and small vanilla JavaScript files, a small project-owned plugin for appointment-request processing, email-only delivery, and owned media with reproducible imports. These decisions do not approve any custom post type or settle the detailed content schema.

Architecture rationale is recorded in:

- `docs/adr/0001-classic-theme-and-controlled-layout.md`
- `docs/adr/0002-portable-appointment-request-processing.md`
- `docs/adr/0003-owned-media-and-reproducible-imports.md`

## D-012 — Apply an explicit frozen-artifact authority order

**Status:** Accepted

When artifacts disagree, use this order:

1. Product scope and explicit frozen decisions in the repository.
2. Frozen v3 screenshots for visual composition and hierarchy.
3. Exported v3 HTML for content, structure, and interactions that screenshots fail to render.
4. `references/v3/DESIGN.md` for design-system tokens and supporting visual guidance.

Accessibility, keyboard behavior, focus visibility, reduced motion, contrast, and image-performance improvements may make small documented deviations without changing the frozen hierarchy, section order, or visual character. Screenshot rendering defects are not production requirements. Do not infer or record a DESIGN.md-versus-export color mismatch without verification.

Verification during the engineering interview confirmed that the 47 color tokens in DESIGN.md frontmatter exactly match the Home v3 Tailwind color configuration, including token names and hex values. No frontmatter-versus-Home color mismatch exists.

## D-013 — Approve bounded native content editing

**Status:** Accepted

Exactly two plugin-owned custom post types are approved: Service and Project, admin-editable structured records with no public singles or archives. The four-page scope is unchanged. Page-specific sections and small fixed collections use native registered metadata/meta boxes; genuinely shared business data uses a project settings screen. Native identity and menus remain authoritative. No ACF, page builder, additional CPT, or maximum-configurability requirement is approved. Interface-level strings remain code-owned/translatable unless a demonstrated editorial need justifies an exception.

See `docs/adr/0004-native-structured-content-without-public-record-routes.md` for rationale and routing boundaries.

## D-014 — Establish the appointment-request contract

**Status:** Accepted

Required fields are name, phone, vehicle make/model, and approved service. Email, preferred date, and notes are optional. Preferred date means a valid studio-local date today or later; it does not imply availability, booking, or confirmation. Server validation is authoritative, with bounded inputs, sanitization, and contextual output escaping.

Submission works without JavaScript. Validation errors preserve entered values in the response without persisting submissions or putting personal data in URLs. Success only follows mail-transport acceptance and communicates acceptance for sending, never appointment confirmation. Missing mail configuration or transport failure cannot render success. Delivery is one studio notification through `wp_mail()`, with no automatic customer email; transport and credentials are environment configuration.

Initial abuse protection has no CAPTCHA or external anti-spam dependency. Use a honeypot, WordPress request/CSRF protection, and bounded short-lived server-side throttling. An anonymous token is neither durable identity nor the sole limit key. Clearing a cookie must not completely bypass protection; raw personal form fields are not retained for abuse detection. Caching, if introduced, must preserve correct form/token/error behavior and must not unnecessarily disable unrelated-page caching.

## D-015 — Normalize shared hours and studio timezone

**Status:** Accepted

Use Contact as the initial authoritative source: Monday–Friday 08:00–18:00, Saturday 09:00–16:00, Sunday closed. Store/edit hours once and render them everywhere. Use America/Los_Angeles as the studio timezone for the Beverly Hills baseline.

## D-016 — Make acceptance evidence reproducible

**Status:** Accepted

Test validation, abuse checks, and mail delivery separately; integration checks run against real WordPress. Browser acceptance covers navigation, existing gallery filters, FAQ, keyboard-operated comparisons, form success/failure, the no-JavaScript submission path, and content edits propagating to shared appearances. Local mail capture and a real inbox delivery check are required, with verified failure behavior.

Responsive acceptance uses 375, 768, 1024, and 1440px viewports. Test current stable Chrome, Firefox, and Safari; final evidence records the actual versions. Include manual keyboard/screen-reader checks with automated accessibility checks and human visual-parity review. Responsive behavior follows HTML where screenshots provide insufficient evidence.

Use local assets, responsive images with dimensions, eager loading for the primary above-fold image, and lazy loading below it. Performance targets are LCP ≤ 2.5s and CLS ≤ 0.1 under a documented fixed test profile on a production-like build/runtime, not ordinary Local development. Measured exceptions require review. Accessibility/performance corrections may make documented small deviations but cannot silently change scope, hierarchy, section order, or visual character.

## D-017 — Resolve canonical content mapping and stable identities

**Status:** Accepted

The detailed Services page supplies initial canonical facts for exactly Exterior Detail, Interior Detail, Full Detail, Paint Correction, and Ceramic Coating. Home's Interior & Exterior Detail maps to Full Detail; Paint Correction uses 2–3 days everywhere. Canonical records supply prices, durations, and protection periods where those facts exist in the frozen baseline; missing commercial or technical claims must not be invented. Only published and valid Services appear in public listings and appointment choices.

Services have stable machine identifiers independent of editable titles and WordPress post slugs, used for import mapping, CTA preselection, form validation, and cross-page references. Projects also have stable machine identifiers for imports and references. Record anchors derive from stable identity rather than display titles.

Each distinct work example has one Project record, with page-specific ordered references allowing Home-only, Gallery-only, or shared placement. Contextual teaser text and alternate imagery are permitted where required by the frozen presentation, while shared vehicle/work facts remain authoritative. Gallery grouping/filter assignments stay within the exported baseline; descriptive prose does not create categories. See ADR 0004.

## D-018 — Bound editorial access and test restoration

**Status:** Accepted

Administrators and Editors may manage page editorial content, Services, Projects, and their editorial metadata. Shared business settings, legal destinations, appointment notification recipient, and other operational configuration are Administrator-only. Mail transport credentials remain environment configuration and are not ordinary editorial settings. Enable and test native revisions for supported editorial records and revision-enabled metadata; restoration is an acceptance requirement. Shared settings use documented backup/recovery without a new audit-log system.

## D-019 — Bootstrap explicitly and preserve human changes

**Status:** Accepted

Use an explicit repeatable development/bootstrap import, never automatic demo seeding or overwriting on plugin activation. Default import is idempotent: create missing baseline records, map stable fixture identifiers, preserve human editorial changes, and report drift or missing prerequisites. An explicit reset may intentionally restore the baseline. Track source fixtures, approved source assets, asset manifest, useful checksums, and usage-rights/source documentation outside generated uploads. Missing required media, legal destinations, or mail configuration blocks acceptance; never silently invent substitute production content. See ADR 0003.

## D-020 — Reduce duplicate sends without promising exactly-once delivery

**Status:** Accepted

Use short-lived server-side submission-token state distinguishing issued, processing, accepted, and failed/expired. Concurrent use of one token cannot produce multiple sends. After recorded transport acceptance, replay cannot send again and may return the existing success outcome. Success uses POST/Redirect/GET. Definite validation or transport failure permits safe retry; genuinely uncertain outcomes must not automatically resend or claim success. No customer form fields are stored in token state, and exactly-once email delivery is not promised. See ADR 0005.

## D-021 — Require progressive enhancement and diagnose dependency failures

**Status:** Accepted

Without JavaScript, appointment submission works, navigation is usable, FAQ content is accessible/readable, all Gallery projects remain discoverable, and comparisons expose both clearly labelled images. Missing optional content degrades cleanly without empty controls, broken layout, or fabricated claims. Missing required baseline content/media fails acceptance.

The project plugin is a required runtime dependency. If unavailable, the theme must not fatal; submission fails closed, no false success path appears, a reasonable contact fallback is provided where possible, and Administrators receive a clear diagnostic notice. Plugin absence is a production acceptance failure, not a supported normal operating mode.

## Pre-spec handoff status

All identified pre-spec engineering decision branches have been resolved through the interview. Final shared-understanding confirmation remains the closing step of the grilling workflow; no specification, implementation tickets, or runtime implementation has been created.

The subsequent `/to-spec` phase must make these agreed boundaries concrete: field schemas and bounds, canonical fixture identifiers and content mapping, PHP template/component structure, supported WordPress registration/hooks and request routing, atomic submission-state transitions, explicitly bounded token/throttle lifetimes and privacy-conscious keys, media import/rights verification, accessible interaction semantics, metadata/SEO integration, and the fixed production-like performance test profile. These implementation details must satisfy the recorded decisions and are not permission to reopen frozen scope or design.

Required media, legal destinations, mail configuration, and real delivery/performance evidence are acceptance prerequisites, not reasons to block specification. The MATT sequence remains `/to-spec` → spec review/approval → `/to-tickets` → ticket review/approval → implementation.
