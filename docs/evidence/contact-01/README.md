# Ticket 01 evidence — 2026-10-07

Local WordPress **7.1.3**, PHP **8.2.29**, nginx **1.26.1**, Contact at `http://wordpress.local/contact/`. Baseline review point: `f481fcd4bd0fd90b23d0847189d18f6b8b5dcc1e`. This is slice evidence, not consolidated production acceptance.

## Browser and keyboard checks

Automated Chrome **155.0.8059.39**, Firefox Playwright build **155.0**, and WebKit Playwright build **26.5** passed at **375, 768, 1024, 1440px**. Exact versions/timestamps are saved in `browser-results-*.json`. These build identifiers are not a claim that all engines are stable browser releases.

Each viewport passed current-page links, five approved preview Service labels, four process steps, working `tel:`/`mailto:` schemes, no inert `href="#"`, responsive reflow, locally loaded fonts/icons, no external resource requests and no browser script errors. Mobile disclosure button state matches visibility. Escape dismisses from inside or outside the open navigation and returns focus to the trigger. Crossing the desktop breakpoint closes the disclosure and moves focus from the disappearing menu to a usable control. Skip navigation focuses the main landmark. No-JavaScript contexts retain visible mobile links and direct contact links; all four widths remain within the viewport.

axe-core **4.11.1** found **zero WCAG 2 A/AA and 2.1 A/AA violations** in all 12 checks. Raw `axe-*.json` results include incomplete/manual-review items; automated zero findings does not certify accessibility. Disabled preview controls and the nonfunctional online submission are explicitly explained. Manual Safari **26.1 (21622.2.11.11.9)** spot-check via native UI confirmed Contact rendering, heading levels, primary/footer landmarks and labelled contact links in the accessibility tree, decorative icons absent from that tree, and Option-Tab → Skip to content → Return moving focus to the main content. No VoiceOver speech session or stable Firefox release certification is claimed; consolidated checks remain Ticket 07.

## WordPress boundaries

`tests/contact-wordpress.php` passed Editor REST saves, oversized/blank/unknown/malformed input rejection, preservation of last valid content, Unicode and literal backslash preservation, native metadata revision creation/restoration, native meta-box POST saves, invalid nonce rejection, actionable admin feedback and anonymous denial.

`tests/studio-wordpress.php` passed Administrator saves, Editor first-create/update denial, invalid email/timezone/phone/description/HTTPS credentials rejection, reversed hours and unknown nested property rejection, unpublished page rejection, shared phone/description propagation over real HTTP to header/Contact/footer, and native/explicit HTTPS legal/directions rendering. Native Contact title/slug renaming also preserves the assigned template and shared-data identity. Temporary test destinations and option changes were restored; none remain as production configuration.

`tests/plugin-fallback-wordpress.php` passed actual HTTP after plugin deactivation: Contact responds 200, saved telephone/email actions and Contact anchor survive, submission remains unavailable, and plugin activation is restored. This is a targeted fallback regression check, not complete Ticket 07 recovery evidence.

PHP syntax checks passed for all project-owned PHP/fixture/test files; JS syntax checks passed. There is no TypeScript typecheck target in this PHP/vanilla JS slice.

## Frozen v3 comparison and documented corrections

Reference: `references/v3/contact/screen.png` (873 × 1600, scaled export), with `references/v3/contact/code.html` filling gaps where the screenshot did not render content. The implementation is captured at actual browser widths; these are visual review images, not an asserted pixel-diff match against a scaled, partially rendered export.

`contact-chrome-1440.png` preserves the dark dotted foundation, Champagne eyebrow and response panel, uppercase Syne heading wrapping, 5/7 Studio/request column ratio, Inter copy, rectangular fields/panels, four-step process and four-column footer. Compare the 375/768/1024 captures for progressively stacked sections and the 1024 navigation breakpoint. Human visual inspection confirmed section order, typography direction, geometry and spacing hierarchy. No new design generation was used.

Corrections visible against v3:

- The screenshot's blank Studio column, hidden process text and missing explanatory copy are rendering defects. Their content is restored from the frozen HTML.
- The unresolved remote logo placeholder is removed. Native site name is the initial identity; a native Media Library custom logo can be supplied when an owned approved emblem exists. No remote emblem is shipped.
- “Appointments & Concierge” becomes “Appointments & Studio”; “Appointment Booking”, automatic-confirmation/reservation phrases and “Custom Consultation” are normalized. Later manual confirmation remains in process step 03.
- A single Contact-authoritative Studio description, address, phone/email and grouped seven-day hours drive all shared appearances. Year uses native date formatting.
- The preview excludes the sixth Service option. Until Ticket 05, its submission area clearly says online requests are unavailable and provides live telephone/email actions; no false success modal is shipped.
- Heading semantics now follow H1/H2/H3; mobile links are visible without JS, focus is visible, and the person icon is decorative. Links and controls have usable targets; no motion is essential.
- Native WordPress footer Service menus currently target the published Services page; Ticket 02 will provide canonical detailed sections.

## Remaining acceptance prerequisites

**Privacy, terms and directions:** owner-approved real destinations have not been supplied. The Administrator screen reports these omissions, public markup omits missing links, and this ticket retains `needs-info`. Tests used disposable explicit destinations solely to verify configuration/rendering. No fabricated legal content or substitute production destination is present.

Ticket 05 owns actual Appointment Request submission. Ticket 07 owns complete reproducible bootstrap, broad dependency/recovery evidence and consolidated browser/screen-reader/performance acceptance. This slice adds no independent importer or submission storage.
