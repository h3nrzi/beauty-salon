# 07: Reproduce and accept the complete four-page pilot

**What to build:** A maintainer reproduces the complete pilot from tracked approved fixtures/assets, safely repeats setup and performs a scoped baseline reset. Consolidated visitor/editor, recovery, delivery and performance evidence demonstrates compliance with the approved specification and frozen v3. This ticket owns complete bootstrap behavior and may fix only defects necessary to satisfy that specification.

**Blocked by:** 04 — Discover the Studio through the complete Home page; 06 — Harden Appointment Request against replay, concurrency and uncertain delivery.

**Status:** ready-for-human

Checkboxes track the owner's approved split between completed local implementation, human acceptance and production prerequisites. Checked local items do not certify production acceptance. Evidence: [`../../../docs/pilot-acceptance.md`](../../../docs/pilot-acceptance.md) and [`../../../docs/evidence/pilot-07/verification-summary.json`](../../../docs/evidence/pilot-07/verification-summary.json).

## Completed automated/local implementation

- [x] Complete one simple project-owned explicit bootstrap/import process using the slice fixtures/media rather than duplicating or redesigning importers. Track fixture versions, stable identities, attachment checksums, asset roles/crops/alternatives and usage-rights status outside generated runtime uploads. Activation never seeds or overwrites demo/editorial content. Current photographs remain temporary/not-yet-rights-cleared.
- [x] A fresh local setup recreates the four pages, templates/front-page assignment, native menus, five Services, eight distinct Projects with exact Home/Gallery placements and fixed page collections, using existing temporary media under explicit `--prototype`. Validate fixtures, duplicate identities, required assets and setup inputs before mutation; provide a dry-run report. Rights-cleared media acceptance remains below.
- [x] Default re-import creates missing baseline items, reuses matching attachments and preserves human edits without duplicate posts, menus or media. Report editorial drift, missing prerequisites and conflicting assignments rather than silently overwriting them. Maintain importer bookkeeping separately from editorial revisions.
- [x] An explicit reset reports its scope and restores only fixture-owned baseline editorial records/references/assignments. Preserve unrelated content and environment secrets. Record repeatable fresh/import/edit/re-import/reset evidence and full-site setup instructions.
- [x] Consolidated recovery evidence proves native revision restoration of page collections/references, Service facts and Project facts/images, plus documented shared-settings backup/restore. Prove Editor/Administrator editorial access and Administrator-only operational settings.
- [x] Required-plugin absence avoids fatal errors, fails submission closed without false success, provides reasonable public contact fallback and an Administrator diagnostic. Missing required content/media/rights, legal destinations or mail configuration blocks acceptance and is clearly reported. Exercise configuration/storage safeguards without introducing new recovery functionality.
- [x] Complete the automated/local public/admin acceptance matrix: native routes and stable references, no independent CPT exposure, canonical shared facts, interactions, no-JavaScript/partial-script behavior, form validation/security/reliability and no customer-field storage or personal-data URLs. Retain focused evidence from owning slices instead of replacing it with only final smoke checks. All nine native suites passed.
- [x] Record installed Chrome, Firefox Nightly and Playwright WebKit checks at 375, 768, 1024 and 1440 CSS-pixel widths with engine/OS versions: 48 page combinations passed. Consolidate automated axe, keyboard/touch and form success/error checks, plus 12 supplemental 320px/reduced-motion/blocked-enhancement probes. This does not certify actual Safari, stable Firefox, screen readers or actual browser text zoom.
- [x] Inspect all four frozen screenshots and HTML rendering gaps, retain desktop/tablet/mobile evidence and document justified deviations. Verify responsive media, local fonts/icons and network evidence showing no prototype remote dependencies. Missing-image placeholders are not production requirements. Final human visual approval and photo rights/quality remain below.
- [x] Retain actual local SMTP Mailpit capture evidence: 24 form combinations across three engines, four widths and JS/no-JS passed. Mailpit does not prove real inbox delivery.
- [x] Deliver reproducible setup/evidence instructions and resolve only defects blocking the approved local acceptance contract. Do not add product pages, CPTs, APIs, frameworks, request-management features, deployment infrastructure or new architecture. Syntax and independent Standards/Spec reviews passed; post-regression dry-run has no drift/conflicts.

## Human/manual acceptance still required

- [ ] Complete current stable Chrome/Firefox and actual Safari acceptance at all four widths; retain browser/OS versions. Installed-engine checks above do not replace the missing stable Firefox/actual Safari matrix.
- [ ] Complete manual keyboard/screen-reader, contrast, actual 200% text zoom and 400% reflow acceptance, recording screen-reader/browser versions. Automated axe and 320px reflow probes do not replace these checks.
- [ ] Approve all four frozen screenshot/HTML comparisons at desktop/tablet/mobile, including geometry, typography, canonical copy, image subjects/crops and justified deviations.
- [ ] Complete the maintainer/editor walkthrough and human sign-off on native editing, revision recovery and shared-settings backup/restore.

## Production-only acceptance still required

- [ ] Supply rights-cleared approved owned/licensed media and source/rights evidence; verify responsive quality, roles/crops/alternatives and placements. Existing temporary/not-yet-rights-cleared photographs are not approved production media.
- [ ] Supply and configure actual Privacy Policy and Terms of Service destinations; verify published native pages or explicit reachable HTTPS destinations. Do not fabricate legal content or use temporary destinations.
- [ ] Supply the real production HTTPS runtime and verify deployed storage/locking, cache exclusions, cookie and transport configuration. No production environment is fabricated or simulated by the local checks.
- [ ] Prove actual receipt through the configured real transport in a real inbox with personal test data redacted. Mail API acceptance and Mailpit capture alone do not satisfy delivery acceptance.
- [ ] Provision external WP-Cron through the production operator and verify cleanup/retention using the documented prerequisite and verification procedure. This ticket documents the procedure; it does not install production scheduler infrastructure.
- [ ] Run the specification's fixed production-like HTTPS performance profile, with pinned Lighthouse/actual Chrome, cold browser storage/cache, warmed server, documented runtime/hardware/cache behavior and the exact mobile viewport/throttling settings. Retain five runs per page, LCP-element evidence and medians: LCP at most 2.5 seconds and CLS at most 0.1 for every page. Local development measurements alone are insufficient; measured exceptions require review.

## Production-acceptance prerequisites

2026-10-07 — Owner clarification: **actual Privacy Policy and Terms of Service destinations remain unresolved and are owned by this ticket**. Obtain owner-supplied published native page IDs or explicit HTTPS destinations, configure them through the existing Administrator settings, and verify reachable destinations before production acceptance. Do not fabricate legal pages/copy or substitute Home/test URLs. Their absence does not block completion of Ticket 01 or Tickets 02–06. This records a prerequisite only; no Ticket 07 implementation is performed here.

The existing Beverly Hills address has a normal external Directions link in the Contact baseline fixture and Studio settings; it requires no map embed, API integration or map plugin.

## Comments

2026-10-08 — Owner clarified that no real production HTTPS runtime, final legal destinations or real inbox verification is available. Complete all feasible local bootstrap, drift/reset/fresh reproduction, recovery/permissions, regression, Mailpit, browser/accessibility and asset/network checks. Preserve temporary media status; do not fabricate legal destinations, production measurements or scheduler infrastructure. Record remaining manual and production prerequisites separately.

2026-10-08 — Implemented the single explicit `wp noir bootstrap` command over existing slice fixtures/assets. Local import adopts stable records and reuses 22 matching attachments; dry-run/preflight, preservation/drift/conflicts, missing baseline metadata, scoped reset, separate provenance, Administrator diagnostics and isolated fresh WordPress acceptance checks are included. Instructions and consolidated evidence matrix: `docs/pilot-acceptance.md`; retained local evidence: `docs/evidence/pilot-07/`. Scoped local reset resolved previous weekday-hours drift. Production rights, actual legal destinations, real inbox receipt, deployed cron verification and fixed HTTPS performance remain unresolved. Final manual actual Safari/stable Firefox/screen-reader/text-zoom/visual sign-off is still required. The original complete-production checkboxes remain unchecked pending those gates.

2026-10-08 — Final local verification completed across retained segments: 14 bootstrap cases, all nine native suites, 48 page/engine/width combinations, 24 JS/no-JS appointment combinations with actual local SMTP into Mailpit and 12 supplemental reflow/reduced-motion/download-failure probes passed. Syntax and both independent review axes passed. Post-regression dry-run reports no drift/conflicts; temporary mail fixture removed. Interrupted disk/rate-window/WebKit harness runs remain labelled as failures in the evidence index. Manual and production gates above remain unresolved; status stays `ready-for-human`.

2026-10-08 — Checklist correction after owner feedback: the earlier decision to leave every original combined criterion unchecked obscured completed local work. Split the checklist into completed automated/local items, outstanding human/manual acceptance and outstanding production-only acceptance, preserving all remaining gates. This supersedes the earlier comment about leaving all original checkboxes unchecked; status remains `ready-for-human`.
