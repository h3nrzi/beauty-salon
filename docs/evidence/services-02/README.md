# Ticket 02 pilot evidence — 2026-10-07–08

Review baseline: `58e15281059a165176d0e5ba516a6b221cf50c02`. Local WordPress **7.1.3**, PHP **8.2.29**, nginx **1.26.1**, macOS **26.1**, Services at `http://wordpress.local/services/`. This is slice evidence; production and consolidated acceptance belong to Ticket 07.

## WordPress behavior

`wordpress-results.txt` and `full-suite.json` contain real native WordPress/public HTTP checks. Editor and Administrator management is supported; Author, Contributor, Subscriber and anonymous management is denied. Tests demonstrate native meta-box saves and nonce rejection; Unicode/backslash preservation; bounded facts, unknown-field/malformed-input rejection; immutable/unique identities; title/slug/Contact-page renaming; canonical title/price/duration/protection propagation; stable section links and Service-specific request URLs; draft/trash/missing-image exclusion from cards/footer/Contact choices; and no independent singles/archive/feed/search/anonymous REST content exposure.

Native Core revision restoration is exercised for Service title/facts/primary image and page FAQ/comparison attachment references. Page section REST and native meta-box saves are both exercised. A partial comparison pair retains its one labelled image with no slider. Existing Contact, Studio settings and plugin-fallback WordPress suites also pass.

## Browser behavior and accessibility

Chrome, Firefox and Playwright WebKit Services checks cover **375, 768, 1024 and 1440 CSS px**. Exact versions/timestamps are in `browser-results-*.json`. They verify five canonical cards, six inclusions per card, known prices/durations/protection, four metrics/process steps, native footer references, all five CTA preselection paths, ignored unknown preselection, independent keyboard FAQ disclosures with the first initially open, keyboard arrows/Home/End and pointer/touch range input with meaningful current value, responsive attachment dimensions/srcset/sizes, eager/high-priority first image and lazy remaining photos, no viewport overflow, no external asset requests, and no script errors. No-JavaScript runs retain both labelled comparison figures, hide the unused slider and allow independent FAQ disclosure.

`axe-*.json` records automated WCAG 2 A/AA and 2.1 A/AA checks; all Services checks report zero violations. Incomplete/manual-review entries remain in raw reports; this does not certify screen-reader behavior. Actual Safari **26.1** rendering and independent FAQ smoke observations are documented in `safari-smoke.md`. Playwright WebKit is not represented as actual Safari.

The full suite's first attempt passed all four WordPress scripts and Contact Chrome/Firefox, then hit an existing Contact WebKit execution-context failure during axe evaluation. That failure is preserved in `full-suite.json`; the corrected Contact harness now audits/captures a fresh baseline after its hash-navigation and viewport interactions. The targeted WebKit follow-up passes all four widths and is recorded in `contact-webkit-follow-up.txt` and `full-suite.json`. Services has its own successful multi-engine runs. No failed full-suite run is represented as a successful one.

## Visual inspection and corrections

The implementer inspected the frozen Services screenshot and HTML against local full-page renders. Desktop image placements follow the baseline: Exterior/Full Detail/Paint Correction on the left, Interior/Ceramic Coating on the right. Service stack, metrics, process, comparison, FAQ, final CTA and shared footer remain in order. Native local copies retain the reference subjects and intentional object-cover crops. All images are decoded before browser evidence screenshots, so lazy-loading does not create artificial blank regions.

Recorded deviations:

- Restore the intro/detail/comparison/FAQ text missing from the exported screenshot using its frozen HTML, as required by the specification.
- Keep canonical Paint Correction at 2–3 days, stable Service anchors and query values, and shared Contact-derived address/hours/footer identity.
- Add a small labelled canonical protection fact when supplied, so edits to that native fact are visible without interpreting free-text inclusions/badges.
- At this review baseline, use an explicitly labelled visible native range below the comparison image rather than the export's invisible full-image input. This placement was subsequently superseded by the owner-requested [on-image handle correction](../services-ui-fixes/README.md), retaining an accessible label and visible keyboard focus.
- Replace script-dependent FAQ buttons with native independent `details`/`summary`, preserving the first-open state and no-JavaScript disclosure.
- Use readable process numerals and locally licensed process icons. Keep dated “2025” editorial copy; runtime footer year is native.
- Normalize residual “resale provenance” to “resale value” and closing “bookings” to “Appointment Requests”. No additional service or commercial claim is added.

Human parity approval, manual screen-reader/zoom checks, and the complete actual stable Safari viewport/no-JavaScript matrix are still consolidated acceptance work. They are not claimed by automated evidence.

## Media rights and remaining boundaries

The owner authorized the seven frozen images as **temporary prototype/reference media for this pilot**, not proof of production rights. `fixtures/noir/services/assets.json` records every image as **not-yet-rights-cleared**, with local sources and hashes. Ticket 07 must verify rights or replace them with owned/licensed media before production acceptance. No runtime hotlinks, automatic seeding or independent importer are introduced. Ticket 07 owns full fresh setup/idempotency/drift/reset; Ticket 05 owns actual Appointment Request processing. Missing production legal/mail configuration remains under those existing gates.

Independent Standards/Spec review found four issues, all corrected and re-reviewed with zero remaining findings. See `review.md`; post-review WordPress and twelve Services browser/axe checks pass.
