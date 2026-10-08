# Ticket 07 two-axis review

Fixed baseline: `d84da7b31ae1d4c16250e8a13514a0ecb271fd90`. Initial implementation: `4a00df5`; repairs: `f8fe46d`. Two independent agents reviewed the Standards and Spec axes required by the `implement`/`code-review` skills, then rechecked the repaired source.

## Standards

Initial documented finding: D-019/ADR 0003's missing-record recreation was blocked by preflight rejection of a deleted assigned page. Repaired: missing owned pages reach planning, are recreated, and their native role/front-page/menu references are repaired. Public CLI coverage deletes imported Home and checks its replacement and reference repair. Contact template edits are preserved/reported on import and restored by explicit reset.

Initial judgement-call smell: repeated menu names/item-resolution logic could make planning and mutation disagree. Repaired with one `MENUS` definition and shared `menu_item()` resolver using the relevant native menu collection.

Recheck: no outstanding documented breach or actionable regression. Standards: **0 outstanding findings**.

## Spec

Initial P1: deleted/unpublished role pages and changed Contact template were rejected before default import/reset could perform their required repair. Fixed and checked through the public CLI, including ordinary preservation and explicit reset.

Initial P2: malformed-fixture tests accepted any command error; copied fixtures failed on a presentation-font path before reaching the intended corrupt-image/duplicate-record condition. Fixed by resolving presentation assets from the active packaged theme and requiring the exact intended diagnostic. The corrected retained evidence now demonstrates the claimed failure paths.

Recheck: both findings resolved; no new actionable Spec finding or scope creep. Manual and production-only prerequisites remain explicitly unresolved under the owner's approved scope. Spec: **0 outstanding implementation findings**.

These reviews establish implementation readiness; they do not replace human/production acceptance.

The final Local runner adjustment was independently reviewed too: page engines now run sequentially with per-engine synthetic ledger resets, within the same snapshot/EXIT restoration boundary. Engine-specific evidence filenames remain distinct, and product rate limits are unchanged. No actionable Standards finding in that adjustment.

The final Gallery browser-harness adjustment was independently reviewed on the Spec axis: the native detail-link destination/click/hash check follows image loading, responsive geometry, axe and capture. Assertions remain intact; this prevents WebKit's subsequent document navigation from detaching the rendered-document probes. No actionable finding or weakened coverage was reported.

Standards rechecked the appointment per-engine extension too: isolated synthetic ledger windows and `appointment/$browser` evidence directories preserve the original cleanup/restoration and prevent report overwrites. No actionable finding.
