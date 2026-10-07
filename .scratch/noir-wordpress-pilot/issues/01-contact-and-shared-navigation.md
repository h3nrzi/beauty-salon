# 01: Contact the Studio through Contact and shared navigation

**What to build:** Visitors can contact the Studio through the frozen Contact page and use responsive shared navigation and footer links. Editors maintain Contact content while Administrators manage authoritative shared Studio details. Use the approved classic theme and small project plugin, adding only what this slice needs.

**Blocked by:** None (can start immediately).

**Status:** accepted

- [x] Contact preserves frozen v3 section order, hierarchy, typography, geometry, surrounding Appointment Request copy, Studio information and process. Normalize approved terminology corrections. Appointment Request submission is delivered by Ticket 05.
- [x] Native identity and menus remain authoritative. Shared navigation/footer use native page references, correct current-page state, working telephone/email links, a configured baseline Directions destination, and Administrator-configurable validated legal destinations. Actual Privacy/Terms destinations are Ticket 07 production-acceptance prerequisites; their absence does not block this slice. The person icon is decorative; no account flow is introduced.
- [x] Mobile navigation works as an accessible disclosure with synchronized expanded state, Escape dismissal and focus return; links remain usable without JavaScript. Provide skip navigation, landmarks, semantic headings, visible focus and appropriate icon/image alternatives.
- [x] Editors and Administrators can edit Contact's fixed sections through bounded native metadata; invalid saves preserve valid content with actionable feedback. Only Administrators manage shared Studio/operational settings. Hours, address, phone, public email and timezone have one authoritative source, following the approved baseline and validation bounds.
- [x] Package baseline licensed local fonts/icons and only the owned media required for this slice. Use native asset enqueueing and metadata hooks, supported WordPress APIs, plain CSS and small vanilla JavaScript; do not modify Core or add runtime frameworks.
- [x] Slice-level WordPress/browser checks demonstrate navigation, destinations, shared-data propagation, editing permissions, validation, responsive behavior and keyboard/no-JavaScript use. Record Contact visual evidence against frozen v3.
- [x] Keep this slice limited to functioning Contact/shared presentation and necessary setup data. Ticket 07 owns complete reproducible bootstrap, broad recovery/plugin-failure evidence and consolidated acceptance; do not introduce an independent importer here.

## Comments

2026-10-07 — Implemented Contact, shared native navigation/footer, bounded revision-enabled editorial sections, Administrator-only Studio settings, local licensed assets and slice checks. See `docs/contact-slice.md` and `docs/evidence/contact-01/README.md`.

**Historical implementation note (superseded by the owner clarification below):** Acceptance was initially held pending explicitly supplied privacy/terms/directions destinations. No approved destinations or published legal content exist in the repository/runtime; requested them from the owner. The rendering/configuration paths pass tests with isolated test destinations, but no test URLs are retained as production values. The initial status was `needs-info`. Online Appointment Request submission remains Ticket 05; complete bootstrap and consolidated acceptance remain Ticket 07.

2026-10-07 — Owner clarification resolves the remaining Ticket 01 information gate. Privacy and Terms destinations are not available; do not create legal pages/copy or substitute URLs. Their actual destinations remain unresolved production-acceptance prerequisites owned by Ticket 07 and do not block completion of Ticket 01 or Tickets 02–06. Administrator configuration, validation, missing-configuration diagnostics and omission of unavailable public legal links remain implemented.

Directions is configured in the tracked baseline fixture and local Studio settings as a normal external Google Maps directions link to **9460 Wilshire Blvd, Beverly Hills, CA 90212**: `https://www.google.com/maps/dir/?api=1&destination=9460+Wilshire+Blvd%2C+Beverly+Hills%2C+CA+90212`. This adds no embedded map, API integration or plugin. All Ticket 01 criteria are satisfied under the clarified scope; **Ticket 01 is complete and accepted**. Evidence: `docs/evidence/contact-01/destinations-clarification.json` and `docs/evidence/contact-01/README.md`.
