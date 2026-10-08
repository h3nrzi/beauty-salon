# Services and appointment interest — Ticket 02

The **Services** classic template is `page-services.php`. Assign it to the existing native Services page and keep the four page IDs in **Settings → Studio settings**. The existing Contact template now derives its disabled preview choices from valid canonical Services and recognizes `?service=<stable-id>#appointment-request`. Online submission remains Ticket 05.

**Services → Add/Edit** uses native title, Featured image, revisions, and a fixed facts meta box. Only Editors and Administrators receive mapped Service capabilities. The five approved immutable identities are `exterior-detail`, `interior-detail`, `full-detail`, `paint-correction`, and `ceramic-coating`; a duplicate identity is refused even if the existing record is draft or trashed. Restore or permanently remove that record before reusing an identity. Public cards, quick index, footer links and Contact choices omit draft, trashed or invalid records. Featured image must be an image attachment. A missing primary image makes the Service publicly invalid.

Facts have the specification's bounds: title 1–100 Unicode characters, order 0–999, short description 0–300, full description 1–2,000, eyebrow/badge 0–80, 1–12 inclusions with 1–180 characters each, optional price 0–100,000,000 USD cents, duration 1–80 and protection 1–120 when supplied. Enter inclusions one per line. Empty optional facts are stored as `null`, not fabricated values. Plain text and valid UTF-8 only; no unknown fields, silent truncation or numeric-string metadata. Native meta-box numeric inputs are converted before validation. Invalid saves preserve prior facts and title and display an actionable notice. Identity deletion/change is refused at the metadata boundary as well. Native title, facts and primary-image revisions are restored with WordPress's own revision interface; identity is deliberately not revisioned.

**Pages → Services → Services fixed sections** provides separate registered metadata for intro, detailed-services heading, metrics, process, comparison, FAQ and final CTA. Composition/order are fixed. The small collections use bounded native fields: up to 8 metrics, 4 process steps, and 12 FAQ entries. Clear all text in a row to remove it. Empty collections omit the section. Comparison images use Media Library attachment IDs; 0 omits an optional image. A partial pair renders the remaining labelled image without controls. Native revisions restore copy, collections and image references. Page REST saves use the same validation and Editor/Administrator permissions.

The theme reads canonical published records through `noir_services()`, `noir_service()` and `noir_service_links()`. Stable section anchors and assigned-page permalinks survive record/page renames. Service records have no singles, archives, feeds, search entries, menu insertion or anonymous REST content API. The footer's native page-reference menu remains editable under **Appearance → Menus**. Set each **Footer Service links** item's **Service reference** to its stable identity. Those mapped items resolve their current title, order and section URL from the canonical Service; invalid references are omitted. Header/other footer navigation remains unchanged.

The reusable `template-parts/comparison.php` accepts labelled attachment pairs, uses the same geometry for both images and provides a labelled native 0–100 range with meaningful current value, overlaid on the image with a visible divider and drag handle. Its label remains available to assistive technology; focus outlines the image. It enables clipping only after initialization. Keyboard arrows/Home/End, pointer and touch operate the range. No JavaScript leaves both labelled figures visible. FAQ uses independent native `details` elements with the first open initially, including without JavaScript.

## Slice preparation and media boundary

`fixtures/noir/services/baseline.json` contains only the five canonical records and fixed Services sections transcribed from frozen v3. Paint Correction uses 2–3 days. The canonical image role is each Service identity; comparison roles are `comparison-before` and `comparison-after`. `assets.json` maps those roles to tracked local source files, original URLs, descriptions and SHA-256 hashes. No runtime hotlinks exist. Locally packaged process icons and their Apache-2.0 provenance are in `icons.json`; existing font/icon licenses remain in the theme assets.

The owner explicitly authorized the seven frozen images **only as temporary prototype/reference media on 2026-10-07**. Every source entry is **not-yet-rights-cleared**. Presence in this repository or Media Library is not proof of production usage rights. Ticket 07 must verify rights or replace the images with owned/licensed media before production acceptance.

This slice was prepared once with native WordPress media/post/meta/menu APIs in the existing local installation. It introduces no installer, activation seeding, reset command, drift algorithm or independent importer. Ticket 07 owns fresh setup and idempotent import. Its importer should map source roles via attachment `_noir_asset_id`, store the media rights status as `_noir_rights_status`, map the five records via `_noir_service_id`, assign their Featured images, map section comparison attachment IDs, and map native footer menu `_noir_service_ref` values. Fixture bookkeeping is not revisioned editorial content. Numeric runtime IDs are not portable fixture identities.

## Verification

Use a disposable/local database: WordPress checks briefly edit live baseline records and restore original values in `finally`. They create and clean up temporary users and one duplicate probe. This follows the deployed native WordPress/public HTTP seam recorded in the approved spec; no private helper or database-state-only test substitutes for the public propagation checks.

```sh
wp --path=wordpress/app/public eval-file tests/services-wordpress.php
npm run check
node tests/services-browser.cjs
NOIR_BROWSER=firefox,webkit node tests/services-browser.cjs
```

Use Local's PHP/MySQL socket environment for WP-CLI. Override `NOIR_SERVICES_URL`, `NOIR_BROWSER`, or `NOIR_EVIDENCE_DIR` as needed. `npm run test:browser` runs Contact and Services suites. The repository has no typed PHP/TypeScript build; checks use PHP syntax lint and Node syntax checks. Full WordPress verification includes existing Contact, Studio settings and plugin fallback scripts. Evidence and remaining consolidated acceptance are in `docs/evidence/services-02/README.md`.
