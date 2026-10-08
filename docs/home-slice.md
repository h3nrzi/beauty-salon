# Home experience — Ticket 04

Assign the classic **Home** template (`page-home.php`) to the native Home page referenced by Studio settings. Existing static-front-page and menu assignments stay authoritative. The template fixes hero/trust → philosophy → featured Services → selected Projects → benefits → Testimonials → final CTA in the frozen v3 order. It uses the existing shared header/footer, native routes and contact facts, locally packaged fonts/icons and shared progressive comparison component.

**Pages → Home → Home fixed sections** exposes nine separately revisioned metadata keys: `_noir_home_hero`, `_noir_home_trust`, `_noir_home_philosophy`, `_noir_home_services`, `_noir_home_projects`, `_noir_home_placements`, `_noir_home_benefits`, `_noir_home_testimonials`, `_noir_home_final`. Administrators and Editors can maintain fixed text, bounded collections, stable references and image attachment IDs through native meta boxes or authenticated page REST. Lower roles cannot manage these fields. Anonymous page REST omits Home editorial metadata. No arbitrary layout, section ordering, public record routes or new content type is introduced.

Section headings are 1–180 Unicode characters; eyebrows 0–80; bodies 0–2,000. Hero additionally has accent/ending (0–180), badge/caption (0–80), studio context (0–180) and an optional image ID. Philosophy has a second body and accent. Trust, philosophy standards and benefits permit up to eight entries each: title 1–120, body 0–500, value 0–100 and a code-owned local icon. Testimonials allow up to six entries: quote 1–1,000, author 1–100, attribution 0–160 and integer rating 1–5. Invalid/unknown/markup/oversized fields retain previous valid content and show a notice. Clear all text and media IDs in a collection row to remove it; clear the review rating too. Empty optional collections omit their sections and controls.

Featured Services allow up to three ordered unique references to the existing five canonical identities, contextual teaser (0–300), badge (0–80), labelled scope (0–180) and optional attachment ID. Baseline order is Paint Correction, Ceramic Coating and Full Detail. Titles, price, duration and protection always resolve from canonical records. Home's frozen Interior & Exterior Detail maps to Full Detail, Paint Correction displays 2–3 days, and Ceramic uses the canonical protection statement without the stronger Home warranty claim. Draft/invalid/missing-primary-media Services disappear. A missing contextual image falls back to the canonical image. Detail and appointment links reuse `noir_service_links()` and preserve stable anchors/preselection across renaming.

Ordered Project placements reuse the existing shared placement schema (up to twelve) and canonical Project boundary. The shared Porsche uses its existing identity with a Home comparison pair. DB12 and Range Rover are two distinct Home-only records, never merged with Gallery's DBS. Vehicle, work and facts resolve canonically; contextual copy and images live in placements. Porsche links to its Gallery section; the two Home-only Projects link to Gallery without invented anchors. Native revisions restore section copy, reviews, image IDs and placement order. Canonical Service/Project revision behavior remains supplied by the existing records.

The Home hero is eager/high-priority; all later photography/comparison images are lazy with intrinsic dimensions and responsive attachment `srcset`/`sizes`. Fixed aspect ratios/heights reserve image geometry. Testimonials use blockquotes, attributed figure captions and one accessible rating announcement; decorative stars/icons are hidden from assistive technology. Native range comparison supports keyboard/touch/pointer and retains both labelled images without JavaScript or a successfully initialized comparison script. Missing plugin leaves an explicit contact fallback.

## Slice preparation

`fixtures/noir/home/baseline.json` records approved Home copy, eight media roles, three Service placements, three Project placements and only the two additional Home-only canonical records. It deliberately does not duplicate the Porsche or the five Services. `assets.json` records tracked source paths, frozen URLs, SHA-256, dimensions, crop/focal point, alt intent, usage and rights status. All existing local icons are reused under their tracked licenses; no new icon source or font dependency is introduced.

The owner authorized frozen Home photographs **only for the temporary local prototype on 2026-10-08**. All eight remain **not-yet-rights-cleared** for production. One-time local preparation used native media/post/meta APIs; attachment `_noir_asset_id` values are `home-<asset role>`, and `_noir_rights_status` records the temporary rights boundary. Project `_noir_project_id` and Featured images follow existing conventions. Existing records/content were preserved. There is no shipped second importer, activation seeding or reset command. Ticket 07 owns the reproducible asset-role/native-ID mapping, fresh setup, drift/reset and cleared production media.

## Verification

The approved spec pre-agrees native WordPress editorial/public HTTP behavior as the testing seam. `tests/home-wordpress.php` exercises native Editor/Administrator saves, lower-role exclusion, invalid input preservation, canonical propagation, stable links, ordered placement updates, native restoration of copy/media/reviews/references, and empty native rows. It temporarily edits the local baseline, creates disposable users and restores state in `finally`. Run on a local/disposable database.

```sh
wp --path=wordpress/app/public eval-file tests/home-wordpress.php
npm run check
node tests/home-browser.cjs
NOIR_BROWSER=firefox,webkit node tests/home-browser.cjs
npm run test:browser
```

Use Local's PHP/MySQL socket environment. `NOIR_HOME_URL`, `NOIR_BROWSER` and `NOIR_EVIDENCE_DIR` override local browser defaults. Syntax lint substitutes for typechecking because no typed build exists. The full browser suite now includes Contact, Services, Gallery and Home. Evidence and explicit acceptance limits are in `docs/evidence/home-04/README.md`.
