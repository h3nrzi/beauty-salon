# Stitch Review 44 — Manager Specialist Schedules surgical refinement

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (45).zip`  
**Package SHA-256:** `146a7d7b9ebaccce47ba4d0e7b3aae2dd9929b3411727a4b924e25f0ff73d4f8`  
**Decision:** **Visual structure accepted; one small terminology patch remains before freeze.**

## What improved correctly

The page is now focused on recurring specialist schedules and the old analytics/attendance clutter is gone.

Accepted:

- Manager shell preserved;
- specialist selector preserved;
- seven-day recurring schedule preserved;
- weekly booking-cap removed;
- daily appointment-cap removed;
- attendance coefficient removed;
- services-covered summary removed;
- standard-shift badge removed;
- `حاضر در سالن` / `عدم حضور` wording removed from day rows;
- restore-default action removed;
- system/calendar-sync language removed;
- date no longer uses the hard-coded `امروز:` prefix;
- bottom guidance correctly separates schedules from breaks and time off;
- no hidden edit modal/form is embedded in this default export.

## Remaining terminology issue 1 — legend still says “active”

The schedule legend still shows:

`روز کاری و فعال`

This page is not defining a generic active/inactive state.

Use exactly:

**`روز کاری`**

The second legend item may remain:

**`روز غیرکاری / تعطیل`**

## Remaining terminology issue 2 — specialist count says “active”

The specialist selector heading shows:

`۶ متخصص فعال`

The page is not managing an active/inactive specialist lifecycle.

Use simply:

**`۶ متخصص`**

This avoids silently introducing a specialist-record state model.

## What should remain unchanged

Do not redesign:

- page header;
- save action;
- specialist selector;
- selected-specialist summary;
- seven schedule rows;
- time chips;
- edit actions;
- non-working Thursday/Friday treatment;
- guidance block;
- typography;
- spacing;
- colors;
- Manager shell.

## Freeze gate

Patch only:

1. `روز کاری و فعال` → `روز کاری`;
2. `۶ متخصص فعال` → `۶ متخصص`.

If these literals are corrected without visual drift, **Manager Specialist Schedules desktop/default can be frozen**.
