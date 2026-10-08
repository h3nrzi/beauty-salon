# Ticket 03 local evidence — 2026-10-08

Review baseline: `e6dd26c32df09a6f48bf4b5a6104334467c11740`. Native WordPress **7.1.3**, PHP **8.2.29**, nginx **1.26.1**, macOS **26.1**, Gallery at `http://wordpress.local/gallery/`.

## Native WordPress behavior

`wordpress-results.txt` exercises actual native WordPress editing, REST and public HTTP. Administrators and Editors manage Projects; Author, Contributor, Subscriber and anonymous management is denied. Native Editor saves generate permanent identities, retain references across title/slug renaming, propagate canonical vehicle/work and Unicode, preserve literal zero text, reject invalid/unknown/markup fields, duplicate memberships and incomplete comparisons, and retain prior title/facts on invalid saves or forged nonces. Immutable identities cannot change or be deleted; duplicate identities, including drafts, are rejected.

Native Core revisions restore Project title/facts/primary/comparison images and Gallery placement references/copy/contextual imagery. Native row reordering changes all six public positions and revision restoration returns the complete baseline order. Editor REST supports the specified eight equipment entries with bounded optional values and local icons; Author page edits are denied. Unknown, duplicate and oversized placements are rejected. Anonymous page REST strips Gallery editorial metadata.

Public HTTP excludes draft/missing-primary-image work and retains a labelled single figure if an optional comparison image becomes unavailable. Project singles, archives, feeds, search and anonymous independent content API probes reveal no Project content. Probe tests create disposable records/users and temporarily change page collections and one attachment status; `finally` restores local baseline state. No independent public testing API is introduced.

## Browser and accessibility evidence

The responsive Gallery runs pass in installed **Chrome**, **Firefox**, and **Playwright WebKit** at **375, 768, 1024 and 1440 CSS px**. Exact versions/timestamps are in `browser-results-*.json`. Checks cover the six ordered placements; selected filters; exact whole memberships and counts (All 6, Paint Correction 3, Ceramic 3, Full Detail 1, Exotics 4, Classics 1); reset; retained keyboard focus; excluded cards removed from accessible navigation; polite result status; real Gallery section links; and no placeholder destinations.

Comparisons support Arrow/Home/End with meaningful value text, pointer and touch native range input, and identical image geometry. Chrome's actual vertical touch gesture scrolls over comparison imagery. No-JavaScript and independently blocked Gallery/comparison scripts preserve all work and the relevant labelled figures while keeping unused controls hidden. Responsive attachment `srcset`/`sizes`, intrinsic dimensions, initial eager/high-priority primary image, initially lazy remaining images, no viewport overflow, no external requests and no script errors are checked.

`axe-*.json` reports zero automated WCAG 2 A/AA and 2.1 A/AA violations across twelve responsive Gallery runs. Raw incomplete/manual-review entries remain. This is not screen-reader certification. Actual **Safari 26.1** native rendering, filter/reset and anchor/slider accessibility-tree smoke are recorded separately in `safari-smoke.md`; Playwright WebKit is not presented as actual Safari acceptance.

The first six-Project browser test failed before authorized media preparation. A later WebKit run stalled during fast lazy-image traversal: two offscreen native requests remained deferred. The minimized actual-page probe passed when each image remained in view until load. The harness now observes each lazy image loading before decode/capture; the full WebKit follow-up passes four widths. No failed/stalled run is represented as passing. `full-suite.json` records final syntax, all five WordPress suites and the full Contact/Services/Gallery Chrome browser suite; all pass.

## Visual inspection and deviations

The implementer compared frozen `references/v3/gallery/screen.png` and HTML against local desktop/mobile full-page renders. The six placements, two wide features, paired card rows, subjects/crops, Porsche metric tiles plus technical rows, Mercedes preservation panel/footer/image caption, equipment and final CTA retain their approved order and hierarchy. All screenshots wait for local images to load before capture.

Explicit deviations:

- Use the shared visibly labelled native range below the split image for keyboard/touch usability. Before is on the left, After on the right at 50%; image geometry stays aligned. No JavaScript displays both figures.
- Show a polite visible result count and selected filter state; hide unused filter UI without enhancement.
- Render Project headings at one consistent semantic level and expose canonical fact labels even where visual labels are suppressed. Editor changes to vehicle/work remain authoritative.
- Use four project-authored decorative equipment SVGs rather than a remote icon font. Their source/ownership and hashes are recorded in `fixtures/noir/gallery/icons.json`.
- Normalize the final invitation to request an appointment rather than reserve a time. Shared navigation/footer/contact facts remain authoritative from earlier slices.

Human visual parity approval, manual screen-reader/zoom checks and the complete actual Safari viewport/no-JavaScript matrix remain consolidated acceptance work; they are not claimed by this local automated evidence.

## Media and bootstrap boundary

The owner explicitly authorized the seven frozen Gallery photos **only for the temporary local prototype on 2026-10-08**. Tracked local sources, SHA-256 hashes, dimensions, crop/focal point, alt intent, usage placements and references are in `fixtures/noir/gallery/assets.json`. Every photo remains **not-yet-rights-cleared** for production. The sources are the frozen 512×279 references, not invented production imagery; production replacement/rights and quality review belong to Ticket 07.

A one-time local preparation used native media/post/meta APIs, preserving any existing records. Attachment `_noir_asset_id` and `_noir_rights_status` and Project `_noir_project_id` supply the mapping for Ticket 07. No importer, activation seeding, drift/reset implementation or Home-only project seed is added. Ticket 07 owns reproducible fresh setup, production rights and consolidated acceptance; Ticket 04 owns Home integration.
