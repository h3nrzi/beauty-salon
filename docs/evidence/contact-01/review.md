# Ticket 01 two-axis review

Baseline approved by owner: `f481fcd4bd0fd90b23d0847189d18f6b8b5dcc1e`. Initial implementation: `b4fb02c`. Two independent code-review agents reviewed `git diff f481fcd4bd0fd90b23d0847189d18f6b8b5dcc1e...HEAD`, then inspected the repairs in the working tree.

## Standards

Initial findings:

- P3 documented rule: some native administration labels were raw English or derived from machine keys. ADR 0004 and D-013 require translatable interface strings. Repaired with explicit translated section/field/icon/day/time/page/legal label maps.
- P3 judgement call, Mysterious Name: Studio settings reused Contact-named validation/input helpers. Shared helpers now live in `includes/fields.php` and use `noir_validate_fields`, `noir_normalize_text`, and `noir_admin_text_input`.

Recheck: both resolved; no new actionable issue. The Core boundary, supported APIs, native identity/menus, explicit setup and plugin/theme ownership are respected.

## Spec

Initial finding:

- P2: when the project plugin was inactive, saved public contact details were discarded by the theme even though they remained accessible through Core. This contradicted the required configured direct-contact fallback. Repaired by reading the saved option through Core, validating public phone/email and resolving native page links safely. A targeted HTTP regression test verifies deactivation and recovery of plugin activation in `finally`.

Recheck: resolved; no new relevant defect. No scope creep found. Actual submission, full bootstrap and consolidated certification remain their assigned later tickets.

Owner clarification (2026-10-07) supersedes the initial `needs-info` gate: Ticket 01 is complete and accepted. Directions is configured to the existing Beverly Hills address. Actual Privacy/Terms destinations remain unresolved Ticket 07 production-acceptance prerequisites and do not block Tickets 01–06. Configuration/validation remains implemented; no legal content or substitute legal destination is present.

Findings: Standards 2 initially, 0 unresolved; Spec 1 initially, 0 unresolved code defects, with actual Privacy/Terms destinations still pending for Ticket 07 production acceptance.
