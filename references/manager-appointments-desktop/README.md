# Manager Appointments — Desktop Reference

Status: **Frozen visual/interaction source**

This directory contains the organized Stitch source for the frozen Manager Appointments desktop baseline.

## Structure

```text
manager-appointments-desktop/
├── README.md
├── design-system.md
└── screens/
    ├── workspace-list/
    ├── active-appointment-detail/
    ├── search-filter-result/
    ├── reschedule-date-time/
    ├── cancelled-read-only-detail/
    ├── cancel-confirmation/
    ├── reschedule-review/
    ├── reschedule-stale-recovery/
    ├── invalid-unavailable-reassignment/
    ├── specialist-reassignment/
    ├── concurrent-change-conflict/
    ├── completed-read-only-detail/
    └── no-show-read-only-detail/
```

Each screen directory contains:

- `reference.html` — Stitch HTML export
- `screenshot.png` — corresponding visual reference

## Original Stitch mapping

| Original | Organized screen |
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

## Authority boundary

These files preserve the frozen Stitch visual/interaction reference.

The Product Definition remains authoritative for product behavior. Literal fixture content in Stitch exports must not override frozen product rules during engineering handoff.
