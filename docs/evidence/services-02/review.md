# Two-axis review — 2026-10-08

Baseline `58e15281059a165176d0e5ba516a6b221cf50c02`; implementation commit `877171b`. Independent Standards and Spec agents reviewed `git diff 58e15281059a165176d0e5ba516a6b221cf50c02...HEAD`, then reviewed the corrective working-tree diff. Scope: Ticket 02 and the owner's temporary-reference-media authorization. No Core changes or independent importer.

## Standards

Initial report: **1 finding, P2**. The theme owned `_noir_service_ref` native editing, validation and persistence and read the internal metadata directly. ADR 0004 and the specification assign editorial controls and validation/read interfaces to the plugin, presentation to the theme.

Resolution: moved native reference editing/persistence to `noir-studio`; `noir_service_menu_reference()` returns validated title, URL and order. The theme only presents those values. Fixed-section admin labels are translatable and multiline rendering no longer depends on English labels.

Follow-up report: “The previous P2 standards finding is resolved. The plugin now owns Service-reference editing, validation, persistence, and resolution; the theme consumes validated title, URL, and order solely for presentation. Fixed-section admin labels are translatable, and multiline rendering no longer depends on English label text. The image-loading and manifest updates introduce no identified standards breaches. No new actionable documented-standard violations or baseline smells found in the reviewed working-tree changes.”

**Standards: 0 remaining findings.**

## Spec

Initial report: **3 findings**.

- **P2:** all Service images were forced lazy, including the first visible desktop image. The spec requires “Primary above-fold image is eager with appropriate fetch priority; below-fold images are lazy.”
- **P3:** the comparison alt descriptions copied verbose generated `data-alt` prose. The spec requires concise subject/context alternatives.
- **P3:** the media manifest lacked dimensions, crop/focal intent and usage placements required for reproduction.

Resolution: the first valid Service card is eager/high priority; remaining Service and comparison photos stay lazy. Seven concise alt descriptions replace the verbose export descriptions in both source manifest and prepared local attachments. Every image now records actual dimensions, cover geometry, center focal intent, responsive frame behavior, placements and desktop side. Temporary **not-yet-rights-cleared** status is retained.

Follow-up report: “All three Spec findings are resolved in the working tree. The first valid Service card receives eager loading and high fetch priority; later images remain lazy. The browser assertion now checks that distinction. All seven manifest alt descriptions are concise, including the comparison pair. Each asset now records dimensions, crop/focal intent, frame geometry and usage placement while preserving its temporary, not-yet-rights-cleared status. Moving menu-reference editing into the plugin preserves native menu permissions and stable canonical links. Translated admin labels introduce no apparent editing regression. No new actionable Spec findings in these changes.”

After that review, the targeted WordPress suite and all twelve Services browser/axe checks passed; logs are `wordpress-results.txt` and `services-review-follow-up.txt`. Both native meta boxes also rendered without PHP errors. Full-suite initial failure and corrective Contact WebKit pass remain recorded. Actual Safari/screen-reader/human parity and production gates are explicitly unclaimed in the evidence README.

**Spec: 0 remaining findings.**

Summary: Standards 0 remaining (initial worst P2); Spec 0 remaining (initial worst P2).
