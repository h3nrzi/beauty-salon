# 02: Compare the five Services and choose an appointment interest

**What to build:** Visitors compare the five canonical Services on the frozen Services page, inspect the process, FAQ and comparison, and follow a Service-specific Appointment Request CTA. Editors change Service facts once and see those facts reflected in Services and the shared footer.

**Blocked by:** 01 — Contact the Studio through Contact and shared navigation.

**Status:** accepted

- [x] Present exactly Exterior Detail, Interior Detail, Full Detail, Paint Correction and Ceramic Coating, in baseline order, with approved descriptions, inclusions, prices, durations and protection facts. Paint Correction consistently uses 2–3 days. Do not invent missing claims or offer Custom Consultation.
- [x] Editors and Administrators manage Service records and Services page sections with the specified native fields, bounds and permissions. Reject duplicate/changed immutable identities and invalid saves. Draft, trashed or invalid Services are excluded from public listings; lower roles gain no management privileges.
- [x] Service detail links use stable section anchors; Appointment Request CTAs use the assigned Contact page, stable Service query value and form anchor. Renaming titles/slugs preserves references. No Service singles, archives, feeds, search entries or independent anonymous content API exposure appear.
- [x] The frozen metrics, process, comparison, FAQ and final CTA work responsively. FAQ preserves independent disclosure and the initial expanded answer. The shared comparison behavior supports labelled keyboard/pointer/touch controls and two labelled images without JavaScript, with no empty controls for absent optional content.
- [x] Prepare only the canonical fixtures, rights-documented owned media and attachment mapping necessary to demonstrate this Services slice. Complete fresh setup, idempotent import, drift handling and reset belong to Ticket 07; do not duplicate or independently redesign the importer.
- [x] Focused WordPress/browser evidence covers canonical facts, shared-footer propagation, stable links, permissions, invalid/draft exclusion, native revision restoration, route restrictions, responsive images, keyboard/no-JavaScript interactions, accessibility and Services visual parity.


## Comments

2026-10-08 — Ticket 02 implementation is complete on the current branch and prepared in the local WordPress installation. See `docs/services-slice.md` and `docs/evidence/services-02/README.md`. Canonical Services, bounded native editing/revisions, stable section/request links, native footer propagation, Contact preview preselection, frozen Services sections, independent FAQ and progressive comparison are implemented. All four WordPress suites, syntax checks, and Contact/Services browser checks across Chrome/Firefox/Playwright WebKit at 375/768/1024/1440 pass, including a documented corrective Contact WebKit follow-up. Two independent review axes initially found four issues; all were fixed and re-reviewed with zero remaining findings.

Owner clarification on 2026-10-07 authorizes local copies of the seven frozen Services images **only as temporary prototype/reference media**. Their rights status is explicitly **not-yet-rights-cleared**; Ticket 07 owns final rights verification or owned/licensed replacement before production acceptance. This supersedes the owned-media portion of this slice's fixture criterion; there are no runtime hotlinks or independent importer.

`ready-for-human` records pending human acceptance, not missing implementation: automated/focused slice evidence is complete; human visual parity approval, manual screen-reader/zoom verification and the complete actual Safari matrix are not claimed. Actual Safari 26.1 rendering/FAQ smoke is recorded separately. Consolidated production/browser/accessibility acceptance, full fresh import/drift/reset, media rights and unresolved production configuration remain Ticket 07; real request processing remains Ticket 05.

2026-10-08 — Owner explicitly confirmed that all tickets are approved ("همشون تاییدن"). Local implementation and human sign-off are accepted; this supersedes earlier pending-human status/comments. No additional manual test execution or production evidence is asserted. Final legal destinations, media rights, real HTTPS/inbox/performance and deployed cron verification remain unresolved production prerequisites in Ticket 07.
