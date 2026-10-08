# Gallery and completed Projects — Ticket 03

The `page-gallery.php` classic template reads canonical plugin-owned Projects and ordered page placements. Assign it to the native Gallery page already referenced in Studio settings. It adds no independent Project routes, taxonomy, modal, or importer. The Gallery detail link resolves the assigned page permalink plus `#project-<stable identity>`. Home-only work links to Gallery without inventing an anchor.

**Projects → Add/Edit** provides native title, Featured image, revisions and a bounded facts box. Administrators and Editors manage records; lower roles have no Project capabilities. Titles are 1–120 Unicode characters; vehicle 1–160; finish 0–100; work 1–1,000; facts 0–8 rows with labels 1–60 and values 1–180. Comparison images use actual image attachment IDs; both 0 omits the pair, both supplied requires labels of 1–80 characters. Native saves preserve prior title/status/slug and facts on invalid input. Protected identities are unique lowercase ASCII IDs of at most 80 characters, immutable even across renames and revisions. Newly edited distinct Projects receive `project-<UUID>` automatically. Stable imported fixture identities are assigned explicitly, never selected by title.

**Pages → Gallery → Gallery fixed sections** controls intro, ordered placements, equipment (up to 8 items, with optional values and code-owned local icons) and final CTA without exposing layout HTML/JSON. Placement row order is presentation order. Each Project reference appears at most once per page, with a contextual teaser (0–500), eyebrow (0–80), optional attachment, and optional complete labelled comparison pair. Gallery allows 60 rows; the registered Home placement collection allows 12 for Ticket 04's integration. References resolve canonical vehicle/work/facts and retain shared Porsche identity; Gallery DBS is distinct from Home DB12. Delete all row content, leave image IDs at 0, to remove a row. Native revisions restore facts, primary/comparison images and page placements; machine identity is deliberately not revisioned. Validation runs on native metadata and page REST writes. Gallery metadata is removed from anonymous page REST responses.

The public read boundary includes only published valid records with required primary image. Empty optional content is omitted. Deleted optional comparison attachments retain any surviving labelled figure without an empty slider; missing contextual image falls back to the canonical image. Invalid/duplicate placements are excluded individually at read time, allowing surviving work to remain discoverable. Missing plugin/content leaves an explicit Contact fallback.

Filter UI is enhanced only after successful initialization. Exact whole membership values determine matches; buttons expose `aria-pressed`, excluded cards use `hidden`, focus stays on the initiating button, and a polite status announces visible/total counts. All resets all six baseline Projects. No JavaScript or a blocked Gallery script retains all work in row order with unused filters hidden. The existing shared native range comparison supports keyboard, pointer and touch while preserving vertical scrolling, aligned object-cover geometry and two labelled figures without JavaScript.

## Fixtures and preparation boundary

`fixtures/noir/gallery/baseline.json` contains only six Gallery Project records, six ordered placements and fixed Gallery copy transcribed from frozen v3. It does not seed Home-only DB12 or Range Rover work. The shared Porsche has one canonical fixture identity ready for Home's separate contextual media in Ticket 04. Exact baseline memberships are stored independently of descriptive work text, including `restoration` metadata with no additional filter or Service.

`assets.json` maps each Gallery image role to its source reference, tracked source location, usage, crop/focal point, alt intent, dimensions/checksum and rights status. A reference URL is not usage-rights evidence. The owner authorized these seven frozen images only for the temporary local prototype on 2026-10-08. Every photograph remains not-yet-rights-cleared for production. Production requires cleared/approved media under ADR 0003 and Ticket 07. Project-authored decorative equipment SVG sources/checksums are recorded separately in `icons.json`. No activation-time content seeding, second bootstrap importer, reset or drift mechanism is added. Ticket 07 will map attachment `_noir_asset_id` roles and `_noir_rights_status`, Project `_noir_project_id`, native Featured images and comparison IDs, page `_noir_gallery_*` metadata and native page/template references.

## Verification boundary

The approved specification records native WordPress editorial/public behavior as the primary seam. Slice checks exercise role capabilities, real native saves and revision restoration, public HTTP propagation/routes, and the actual Gallery browser page. Syntax checking substitutes for typechecking because this repository has no typed build.

Production rights, complete reproducible bootstrap, actual Safari and screen-reader acceptance, human parity approval and production-like performance remain consolidated acceptance responsibilities, not claims made by automated local checks.

```sh
wp --path=wordpress/app/public eval-file tests/gallery-wordpress.php
npm run check
node tests/gallery-browser.cjs
NOIR_BROWSER=firefox,webkit node tests/gallery-browser.cjs
```

Use Local's PHP/MySQL socket environment. Override `NOIR_GALLERY_URL`, `NOIR_BROWSER` and `NOIR_EVIDENCE_DIR` for another local runtime. The WP suite creates disposable users/records and temporarily edits page metadata and one attachment status, restoring state in `finally`; run against a local/disposable database. The browser suite writes responsive screenshots and axe reports, verifies exact memberships/count/reset/focus, keyboard/pointer/touch comparisons and Chrome vertical touch scrolling, no-JavaScript discovery, independently blocked Gallery/comparison scripts, local responsive media and real anchor links.

The comparison split now reveals After from the right so its initial left-Before/right-After orientation matches frozen Gallery; Services continues to use the same aligned component. Porsche renders its first three ordered facts as metric tiles, with remaining technical facts as rows. Mercedes renders its ordered preservation facts, staging/footer and lacquer caption through code-owned contextual presentation. Values are always canonical, rather than repeated in placements.
