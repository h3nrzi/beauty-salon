# Contact and shared navigation — Ticket 01

The project theme is `wordpress/app/public/wp-content/themes/noir-auto-detailing/`; the required plugin is `wordpress/app/public/wp-content/plugins/noir-studio/`. Core is unchanged. No third-party runtime plugin, build step, or runtime framework is required.

Activate NOIR Studio and the NOIR Auto Detailing theme. Create/publish the native Home, Services, Gallery and Contact pages; assign Contact's **Contact / Appointment Request** template. Configure native site title/tagline/logo under WordPress settings and appearance. The unresolved exported logo has no owned source; use native text identity until an approved logo is supplied.

Assign the four page IDs under **Settings → Studio settings**. The screen owns description, address, public/direct telephone, public email, hours, timezone, status and explicitly supplied directions/privacy/terms destinations. Contact is the shared baseline: the initial facts live in `fixtures/noir/contact/baseline.php`. No plugin activation creates or overwrites content. This slice's local setup was explicit; complete repeatable bootstrap remains Ticket 07.

Assign native page-reference menus to **Primary navigation**, **Footer navigation**, and **Footer Service links**. The initial Primary/Footer menus contain Home, Services, Gallery and Contact. The five footer Service link labels refer to the Services page until Ticket 02 supplies canonical sections. These are native page links, not hard-coded slugs or fabricated record routes. Set the native Home page as static front page. Home, Services and Gallery use the safe generic template until their own tickets land.

For the initial Contact editorial copy, copy the fixture's `sections` into the registered `_noir_contact_intro`, `_noir_contact_response`, `_noir_contact_form`, `_noir_contact_standards` and `_noir_contact_process` metadata through native metadata APIs (or fill the Contact meta box). These are separate fixed schemas, not an arbitrary page-layout field. Editors and Administrators can maintain them in **Pages → Contact → Contact fixed sections**. Native revisions include these fields. Fields are plain text; markup/control characters, extra properties, blank required headings, invalid rows and values above Unicode character bounds are rejected. The previous valid section survives; the native meta-box notice or REST error explains the problem. Empty collection rows are removed, and empty collections omit their sections. Metadata API callers follow WordPress's normal slashed-value contract.

Only Administrators manage Studio settings and native menus/identity. Studio settings are saved atomically: any invalid field keeps the previous complete option. The seven-day hours editor accepts closed days or a valid 24-hour opening/closing pair. Grouped public hours reflect identical consecutive days; editing one weekday separates it automatically. Legal destinations accept a published native page ID or an HTTPS URL; Directions accepts HTTPS. The baseline Directions destination is a normal external Google Maps link to 9460 Wilshire Blvd, Beverly Hills, CA 90212, configured in the fixture and local Studio settings. No embedded map, API integration or map plugin is used. Actual Privacy/Terms destinations are unavailable and remain unresolved production-acceptance prerequisites owned by Ticket 07; their absence does not block accepted Ticket 01 or Tickets 02–06. Empty legal destinations remain visible in an Administrator production-setup diagnostic. The public theme omits missing destinations instead of inventing links or legal text.

For shared-settings recovery, export the `noir_studio` option with `wp option get noir_studio --format=json` into a protected environment backup, or use the native database backup. Restore to the same installation through an Administrator-context native option write; validation still applies. On a different installation, remap native page IDs before restoration. Native menus/site identity belong in that database backup too. Credentials are never saved in these settings.

The Appointment Request area preserves the frozen field hierarchy and surrounding process but explicitly displays disabled preview fields and active telephone/email contact links. There is no POST endpoint, false success modal, request persistence or mail send in Ticket 01. Ticket 05 replaces this template part with the validated form. Request copy now distinguishes interest from confirmation; “Custom Consultation” and “Concierge” are removed. A confirmed appointment in the process refers to the later manual Studio agreement.

Local fonts and icons, their licenses and SHA-256 checksums are listed in `fixtures/noir/contact/assets.json`. This Contact slice needs no editorial photo attachment. Ordinary CSS changes require no Node build. Native title-tag and standard head/body/footer hooks remain available to Core and SEO plugins.

## Verification

Run checks in a disposable/local WordPress environment. The tests create and remove temporary users/pages and restore shared settings in `finally`; the settings test briefly changes the public shared option. Do not run it against an active production site.

```sh
wp eval-file tests/contact-wordpress.php
wp eval-file tests/studio-wordpress.php
wp eval-file tests/plugin-fallback-wordpress.php
npm ci
npx playwright install
npm run check
npm run test:browser
```

The plugin-fallback test temporarily deactivates the project plugin and restores it; it checks only the direct-contact fallback for this slice. Full recovery certification remains Ticket 07.

The WP-CLI commands run from the repository root with the local installation selected (`--path=wordpress/app/public`). Use the Local shell or its PHP/MySQL socket configuration. Browser defaults are local Contact and installed Chrome; override `NOIR_CONTACT_URL`, `NOIR_BROWSER=firefox` or `NOIR_BROWSER=webkit`, and optionally `NOIR_BROWSER_EXECUTABLE`. Browser screenshots/results are written to `docs/evidence/contact-01/` (override `NOIR_EVIDENCE_DIR`). Playwright and axe-core are development dependencies only.

The WordPress checks exercise REST saves, native meta-box POST/nonce behavior, unknown/malformed/bounded fields, literal backslashes/Unicode, native revision restoration, anonymous and Editor restrictions, Administrator settings validation, shared-data propagation over HTTP, and configured native/HTTPS destinations. The browser suite checks responsive reflow at 375/768/1024/1440px, menu states/current page, Escape/focus return, viewport changes, skip navigation, no-JavaScript navigation/contact links, local assets and console errors. Visual evidence and remaining prerequisites are recorded in `docs/evidence/contact-01/README.md`.
