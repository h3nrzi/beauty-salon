# ara-manager-appointments-desktop-v1

Status: **Frozen visual/interaction reference — Manager Appointments Desktop**  
Frozen: 2026-10-09

## Frozen source export

`stitch_ara_beauty_salon_ui (9)(1).zip`

SHA-256:

`40c87d5d40f92808d73049d8d72e69310b24a1314376ef84f3bd0408b31945a1`

## Accepted screen mapping

| Stitch folder | Canonical English name |
| --- | --- |
| `_1` | `workspace-list` |
| `_2` | `active-appointment-detail` |
| `_3` | `search-filter-result` |
| `_4` | `reschedule-date-time` |
| `_5` | `cancelled-read-only-detail` |
| `_6` | `cancel-confirmation` |
| `_7` | `reschedule-review` |
| `_8` | `reschedule-stale-recovery` |
| `_9` | `invalid-unavailable-reassignment` |
| `_10` | `specialist-reassignment` |
| `_11` | `concurrent-change-conflict` |
| `_12` | `completed-read-only-detail` |
| `_13` | `no-show-read-only-detail` |

## Source integrity

The frozen reference accepts the paired `screen.png` + `code.html` artifacts for each screen.

The raw Stitch folder names are temporary import identifiers. When the source is uploaded to GitHub, reorganize them using the canonical English names above while preserving traceability to this mapping.

## Accepted semantics

- Manager works with existing appointments.
- Manager can search/view, cancel, reschedule and reassign when valid.
- Lifecycle uses Confirmed / Completed / Cancelled / No-show.
- Reschedule changes date/time only.
- Reassignment changes specialist only and requires eligibility + full-interval availability.
- Stale/conflicting operations never silently overwrite current appointment state.
- Terminal states are read-only.
- Payment context is `pay at salon`; no accounting/payment-state product is implied.

## Boundary

This freezes the **desktop visual/interaction baseline** only.

Mobile/tablet Manager Appointments is intentionally deferred and will be designed after the desktop source is organized in the repository.

Product Definition remains authoritative over any literal fixture content.
