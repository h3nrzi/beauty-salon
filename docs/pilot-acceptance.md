# Four-page pilot reproduction and acceptance — Ticket 07

## Acceptance boundary

2026-10-08: implementation and local verification are separate from production acceptance. The owner explicitly authorized completing all feasible local work while leaving actual legal destinations, production HTTPS, real inbox delivery, production scheduling and cleared photography unresolved. No substitute legal pages, production runtime, delivery claim or production performance result is supplied.

The source of truth remains `.scratch/noir-wordpress-pilot/spec.md`, the frozen four screenshot/HTML pairs in `references/v3/`, and the existing slice fixtures in `fixtures/noir/`. Source photos remain `not-yet-rights-cleared`; local prototype use does not establish production rights.

## Reproduce a fresh setup

Use a supported installed WordPress runtime with native revisions enabled, the tracked `noir-studio` plugin and `noir-auto-detailing` theme. Core is immutable. Supply the database, native Administrator account, URLs and environment configuration outside the repository. From the project root, using that runtime's WP-CLI/PHP/socket environment:

```sh
wp --path=wordpress/app/public plugin activate noir-studio
wp --path=wordpress/app/public theme activate noir-auto-detailing
wp --path=wordpress/app/public noir bootstrap --user=ADMIN_LOGIN \
  --fixtures="$PWD/fixtures/noir" --prototype --dry-run
wp --path=wordpress/app/public noir bootstrap --user=ADMIN_LOGIN \
  --fixtures="$PWD/fixtures/noir" --prototype
```

`--prototype` is permitted only when WordPress reports `local` or `development`. It acknowledges already authorized temporary photographs and reports their unresolved rights. Omit it for a rights-cleared production import; current assets cause that import to fail before mutation. Activation registers content/capabilities/operational state only and never seeds editorial records.

The single project-owned `wp noir bootstrap` command loads the existing Contact PHP fixture and Services/Gallery/Home JSON fixtures. It creates missing native pages, the five canonical Services, six Gallery Projects and two additional Home-only Projects. Porsche is shared; DB12 and DBS remain distinct. It maps all 22 tracked photographic roles to native attachment IDs, resolves fixed page collections and contextual image references, assigns templates/static front page/Studio page roles, and creates the three native menus. Native site title/custom logo remain under normal WordPress identity administration.

Preflight validates all slices and fixed schemas, versions, duplicate identities, primary/paired media references, source checksums/dimensions, local presentation licenses, shared facts and existing setup inputs before writes. `--dry-run` emits versions, source hashes, asset/native IDs, planned actions, editorial drift, assignment conflicts, reset scope and acceptance blockers without importer writes. Normal Core/plugin initialization may still perform its documented capability/operational initialization on command boot.

Default re-import creates missing records/metadata/menu items, reuses matching original attachment files by SHA-256, preserves existing editorial fields (including intentionally empty collections), and reports differences from the fixture. Native IDs/stable identities prevent renaming from creating duplicate records. Missing template assignments are initialized; incompatible editorial template assignments are reported and preserved. Existing front-page/menu-location assignments are initialized only when absent. Malformed existing Studio facts/legal inputs stop preflight. Incompatible templates, unpublished roles and conflicting assignments are reported/preserved during normal import; explicit reset restores fixture-owned templates/status/roles. Deleted baseline pages and missing native menu references are recreated/repaired. If native settings validation cannot accept a preserved assignment, the original option stays intact and the report records the unresolved prerequisite.

Provenance is stored in the non-autoloaded `noir_bootstrap` option: native record/menu-item/attachment mappings, fixture and manifest versions/checksums, baseline hashes and rights status. It is independent of editorial metadata and native revisions. Source manifests remain outside uploads; source files are never downloaded during import. The command checkpoints completed mappings so an I/O failure can be retried. It is not a transaction or a concurrent multi-maintainer import service: run one importer at a time, take a normal runtime backup, and rerun after fixing any reported I/O failure.

## Scoped reset and recovery

```sh
wp --path=wordpress/app/public noir bootstrap --user=ADMIN_LOGIN \
  --fixtures="$PWD/fixtures/noir" --prototype --reset --dry-run
wp --path=wordpress/app/public noir bootstrap --user=ADMIN_LOGIN \
  --fixtures="$PWD/fixtures/noir" --prototype --reset
```

Inspect the dry-run scope first. Reset prints that scope again before mutation, then restores fixture-owned titles/slugs/status/content, fixed metadata/primary images, shared editorial Studio facts, references and native assignments. It repairs only baseline menu items; extra unrelated items/content remain. An edited original attachment is preserved; reset restores baseline references to a matching/imported source rather than replacing its file. Legal destinations, mail constants/transport, appointment state, environment secrets, unrelated content and site identity stay intact. Ordinary re-import always preserves human edits.

Use native **Revisions** on Home/Services/Gallery/Contact and Service/Project editing screens to restore their bounded collections, shared facts, images and stable references. The full WordPress regression suites exercise actual Editor/Administrator saves and native revision restoration, including propagation through independently served HTTP pages. Stable identities/provenance are not revisioned editorial fields.

Shared Studio settings use the existing validated native option, not post revisions. Store backups outside the repository in a protected location:

```sh
wp --path=wordpress/app/public option get noir_studio --format=json > /protected/studio-backup.json
wp --path=wordpress/app/public --user=ADMIN_LOGIN option update noir_studio \
  "$(cat /protected/studio-backup.json)" --format=json
```

Restore in the same native site after verifying that its saved page IDs still exist. The existing Administrator validator applies to restore too; invalid values preserve the previous option. For another site, restore a full native backup or reassign that site's native page IDs through Studio settings. Do not restore the importer option independently across databases because its IDs belong to its original site. Native content backups are the rollback boundary for interrupted imports/resets; no new recovery feature is introduced.

Editors and Administrators edit page sections, Services and Projects. Editors cannot change Studio operational settings, native menus or run bootstrap. Lower roles cannot edit these collections. Missing plugin execution remains covered by the independent plugin-fallback suite: no fatal errors or false submission success, saved public telephone/email fallback and Administrator diagnostic. Administrator-only diagnostics also report unrecorded bootstrap, missing canonical records/media, asset checksum drift, unresolved rights/legal destinations and mail readiness.

## Reproduce local verification

Use a disposable **Local** database/runtime. Tests intentionally modify synthetic content/state and restore it; do not point this runner at production.

```sh
npm ci
npm run check
npm run test:bootstrap
NOIR_BROWSER=chrome,firefox,webkit npm run test:pilot
```

`NOIR_WP_BIN` selects a configured WP-CLI wrapper; it must honor an explicit `--path` argument. The bootstrap test installs real WordPress into a random isolated table prefix and a temporary uploads directory, uses the same tracked plugin/theme, then removes only its own tables/files. It never runs `wp db clean/reset` or mutates the working site's records. Synthetic test Administrator/Editor accounts and mail fields contain no real personal data. The full runner snapshots/restores the preexisting appointment ledger and refuses a preexisting mail test fixture. Evidence can be redirected with `NOIR_EVIDENCE_DIR`; per-suite/engine directories and engine-specific page result filenames prevent results overwriting one another. Page and appointment engines run sequentially with synthetic ledger resets between them so acceptance probes do not collide with the deliberately low issuance budget; the product protections remain unchanged.

`tests/bootstrap-cli.sh` covers fresh construction, zero-write dry-run, missing metadata repair versus intentional emptiness, safe repeat import, drift and conflicts, scoped reset, malformed/checksum/duplicate fixture rejection, prototype rights gating, Administrator authority, menu drift and native shared-settings backup/restore, deleted-page recreation/menu-reference repair and Contact template preservation/reset. The nine existing native suites cover recovery, permissions, public scope, validation, storage failures, replay/races and delivery. The four owning browser suites retain their original focused checks. Supplemental checks add 320px reflow, reduced-motion emulation, complete enhancement-download failure, image loading and remote-dependency/a11y checks. A 320px viewport is a reflow probe, not evidence of actual 400% browser zoom; manual text zoom remains required.

Local mail evidence uses actual SMTP into Mailpit, while reliability race checks use the owning slice's transport instrumentation. Mailpit is environment-only test capture, not shipped request storage, and never substitutes for real inbox receipt. Keep test transport fixtures out of production and remove them on exit.

## Acceptance matrix and retained evidence

2026-10-08 — The owner explicitly approved all seven tickets and the local pilot. Human sign-off is recorded in their issue comments. The matrix below preserves evidence limitations: this approval adds no actual Safari/stable Firefox, screen-reader or browser-zoom measurements and does not resolve production prerequisites.

| Contract | Automated/local evidence | Outstanding acceptance |
| --- | --- | --- |
| Four native routes, menu current state, CTA/anchors and stable references | Contact/Services/Gallery/Home native and browser suites; exact Home/Gallery order; no anonymous CPT routes/API/search/feed exposure | Real published legal destinations and reachability |
| Canonical Services/Projects/Studio facts | Five Services/eight Projects, shared Porsche, exact placements, rename/draft behavior; baseline report has no drift/conflicts after scoped local reset | Human content/photography approval |
| Native editing and recovery | Native Editor/Admin saves and HTTP propagation; lower-role restrictions; page/Service/Project facts/images/reference revision restores; native shared-settings backup/restore | Operator walkthrough/sign-off |
| Progressive enhancement and interactions | Existing keyboard/touch comparisons, navigation, Gallery count/filter/reset, FAQs; no-JS and partial-script probes; 320px reduced-motion reflow | Full actual Safari matrix; screen-reader use and actual text zoom |
| Form validation, abuse and reliability | Nine native suites, independent FPM races, accepted replay, uncertainty/storage failure/cleanup safeguards, no personal-field persistence/URLs; enhanced/un-enhanced form states and axe | Configured real transport receipt and environment review |
| Missing plugin/configuration/media | Public fallback, fail-closed submission, native settings validator, bootstrap preflight and Admin prerequisite codes | All production prerequisites must be supplied |
| Local owned assets | 22 source roles reused; checksummed manifests; responsive images/intrinsic dimensions/local fonts/icons; browser network checks reject external requests | Rights clearing/approved replacement and crop/quality approval |
| Browser/a11y | Installed Chrome, Firefox engine and Playwright WebKit at four widths; axe on pages/form states; supplemental reflow/reduced-motion/failure probes | Current stable Firefox/actual Safari certification; manual keyboard/screen-reader/contrast/text zoom/400% reflow |
| Visual parity | Owning slices' screenshot/HTML inspections and desktop/tablet/mobile captures retained; new baseline captures after restored hours | Final human comparison/sign-off for all four frozen exports |
| Mail | One-recipient/site-controlled-sender/Reply-To/body validation and actual local Mailpit capture | Actual receipt in real inbox, redacted evidence |
| Performance | Responsive/local asset strategy and runtime profile instructions | Production-like HTTPS five-run lab profile and reviewed medians |

Machine-readable local bootstrap reports and verification logs live in `docs/evidence/pilot-07/`. The owning focused evidence remains in `contact-01`, `services-ui-fixes`, `gallery-03`, `home-04`, `appointment-05` and `appointment-06`; it is not replaced by a single smoke test. Browser version labels report the installed engines exactly. Playwright WebKit is not actual Safari; the available Firefox installation is Nightly and does not certify current stable Firefox.

Frozen screenshot gaps and justified deviations are documented in each owning slice: actual images replace broken export placeholders; Full Detail/price/duration/protection and shared hours use canonical facts; neutral comparison labels replace unsupported claims; native local icons replace the remote symbol font; legal links remain absent until supplied. These are explicit deviations, not automatic human visual approval. Local reset restored approved weekday/Saturday hours instead of the previous all-days-closed drift.

## Human/manual acceptance to finish

Record tester, date, OS/browser and screen-reader versions, per-page and per-state results, and screenshots/notes. Use actual current stable Chrome/Firefox/Safari at 375, 768, 1024 and 1440 CSS px. Check mobile navigation/focus, Gallery filters/count/reset, every comparison with keyboard/touch, FAQ, Service preselection, validation errors/uncertainty/success, contrast, reduced motion, actual 200% text zoom and 400% reflow. Use a real screen reader, including error association, live announcements and focus movement. Compare all four frozen screenshot **and HTML** pairs against baseline desktop/tablet/mobile renders; explicitly approve or reject each remaining crop/geometry/content difference. Automated axe results retain manual-review entries and are not screen-reader certification.

Actual Safari Home AX rendering was observed again on 2026-10-08. Attempting responsive mode encountered the CUA capture error and disabled developer controls; no Safari viewport/keyboard/touch pass is claimed. Prior Home/Gallery native Safari smoke remains focused rendering-only evidence.

## Production-only prerequisites and verification

1. Owner supplies actual published native Privacy Policy/Terms page IDs or explicit HTTPS destinations. Configure them through existing Administrator Studio settings and verify reachable expected content. Do not use Home, test pages or fabricated legal copy. Import/reset never fabricates or replaces these destinations.
2. Clear rights for every photograph or supply approved owned/licensed replacements with source/rights evidence, checksums, dimensions, roles, focal crops, alt/decorative intent and usage placements in the existing manifests. Verify visual parity and sufficient output quality. Current temporary photos and 512px source resolution require review.
3. Configure the existing transport/readiness boundary outside source: recipient, site-controlled sender, domain authentication, credentials/timeouts and explicit readiness. Test failure classes and actual receipt at the intended real inbox with synthetic data; retain message/header evidence with addresses/test fields redacted. `wp_mail()` acceptance alone never proves delivery.
4. Verify the documented single-primary/pinned database connection/storage boundary, fail-closed locking/writes, HTTPS cookies and Contact/form/status/POST no-store behavior. If adding a cache externally, exclude these paths and prove cross-visitor token isolation. Record deployed runtime/database/cache behavior, not only Local checks.
5. Arrange an external five-minute WP-Cron runner in the real environment under its operator's normal procedures. No scheduler or deployment infrastructure is installed by this ticket. Verify `wp cron event list` includes `noir_request_cleanup_ledger`, run due events through that environment's WP-CLI, and observe synthetic expired state actually removed after an idle period; prove failure reporting and recovery after storage outage. The hook recurs hourly; the five-minute external dispatch interval yields the physical-retention bounds documented in `docs/appointment-slice.md`.
6. Measure the fixed production-like HTTPS profile, with debugging disabled, normal PHP opcode caching, no Local proxy/debugging and no logged-in toolbar/extensions. Record hosting/PHP/database versions, hardware, actual Chrome version and executable, exact pinned Lighthouse version/lockfile, asset checksum/version and cache behavior. Keep Contact uncached. Warm the server; start a clean browser cache/storage context for every run. Use 375×812 CSS px, DPR 1, simulated mobile throttling at 150ms RTT, 1,638.4 Kbit/s throughput and 4× CPU slowdown. Perform five navigations for **each** page. Save all Lighthouse reports/settings and LCP element evidence; compute each page's median LCP/CLS. Gate on LCP ≤2.5s and CLS ≤0.1, and review exceptions before acceptance. No Local measurement is supplied as certification.

Production acceptance stays unresolved until these records and human approvals exist. The implemented local portion is reviewable independently under the owner's clarified scope.
