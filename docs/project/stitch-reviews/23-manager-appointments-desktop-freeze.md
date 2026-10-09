# Stitch Review 23 — Manager Appointments final two-screen patch

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (9)(1).zip`  
**Package SHA-256:** `40c87d5d40f92808d73049d8d72e69310b24a1314376ef84f3bd0408b31945a1`  
**Decision:** **Approve and freeze Manager Appointments — Desktop.**

## Final patch verification

The two remaining blockers from Review 22 are resolved.

### Search / Filter

Accepted:

- manual/new appointment creation shortcut is removed;
- no `Ctrl + N` / «ثبت نوبت فوری» remains;
- filters use only the approved lifecycle statuses:
  - Confirmed;
  - Completed;
  - Cancelled;
  - No-show;
- search/filter remains focused on appointment lookup and opening details.

### Reschedule Review

Accepted:

- specialist/shift preapproval wording is removed;
- notification-settings wording is removed;
- selected replacement time is described at product level as currently available for the existing specialist and full appointment duration;
- current time vs selected new time is clear;
- services, specialist, duration and booked price remain unchanged;
- payment wording is limited to pay at salon.

## Desktop freeze decision

The complete Manager Appointments desktop interaction set is now frozen as:

`ara-manager-appointments-desktop-v1`

Accepted desktop patterns:

- workspace/list;
- search/filter;
- active appointment detail;
- cancel confirmation;
- Cancelled read-only detail;
- reschedule date/time;
- reschedule review;
- stale reschedule recovery;
- specialist reassignment;
- invalid/unavailable reassignment;
- concurrent-change conflict;
- Completed read-only detail;
- No-show read-only detail.

## Remaining deterministic cleanup

A few literal fixture words may still be normalized during source organization / engineering handoff, for example:

- «بایگانی / آرشیو» → customer/operations history wording where appropriate;
- neutral fixture service/expertise labels;
- generated HTML/tooling implementation details.

These do not reopen the desktop visual baseline.

## Next step

Upload the raw Stitch desktop source into the repository **without renaming it first**.

After it is present in GitHub, organize the source into stable English-named folders/files while preserving a mapping back to the frozen Stitch export.

Mobile/tablet Manager Appointments remains intentionally deferred until the desktop source is organized.
