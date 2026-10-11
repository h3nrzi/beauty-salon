# Stitch Prompt 44 — Manager Specialist Schedules final terminology patch

Patch only the current refined **Manager Specialist Schedules / برنامه کاری متخصصان** screen.

This is **not a redesign**.

The visual structure is accepted.

## Select in Stitch

Select only the current refined Specialist Schedules screen.

## Preserve exactly

Keep:

- Manager sidebar;
- page title and supporting copy;
- `ذخیره تغییرات برنامه`;
- specialist selector;
- selected specialist;
- weekly-hours summary;
- seven-day schedule;
- start/end times;
- `ویرایش` actions;
- non-working day treatment;
- bottom guidance;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

## 1. Specialist count

Replace:

`۶ متخصص فعال`

with exactly:

**`۶ متخصص`**

Do not introduce active/inactive specialist status on this page.

## 2. Schedule legend

Replace:

`روز کاری و فعال`

with exactly:

**`روز کاری`**

Keep:

**`روز غیرکاری / تعطیل`**

Do not introduce a separate active/inactive schedule state.

## Keep already-correct content

Keep:

- `روز کاری` on working rows;
- `روز غیرکاری` on Thursday and Friday;
- `سالن در این روز بسته است` for Friday;
- selected specialist weekly hours;
- no appointment caps;
- no attendance analytics;
- no restore-default;
- no sync/system wording.

## Required output

Return exactly one corrected:

- **Manager Specialist Schedules — desktop/default**

No edit modal.
No breaks/time-off state.
No mobile/tablet.
No new capability.

If these two literals are corrected without visual drift, this page will be frozen.
