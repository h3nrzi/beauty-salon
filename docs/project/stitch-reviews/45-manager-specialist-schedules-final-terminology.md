# Stitch Review 45 — Manager Specialist Schedules final terminology patch

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (47).zip`  
**Package SHA-256:** `a7d2a0d97e342da7ad3a47561d02b668b7003b26fdd8750f844a74307be487af`  
**Decision:** **Freeze Manager Specialist Schedules desktop/default.**

## Final verification

The two remaining terminology issues from Review 44 are resolved.

Verified:

- `۶ متخصص فعال` is now `۶ متخصص`;
- legend `روز کاری و فعال` is now `روز کاری`;
- `روز غیرکاری / تعطیل` remains clear;
- working rows use `روز کاری`;
- non-working rows use `روز غیرکاری`;
- Friday correctly notes `سالن در این روز بسته است`;
- no attendance/active-state semantics were reintroduced.

## Scope verification

Still absent as required:

- weekly booking caps;
- daily appointment caps;
- attendance coefficient;
- services-covered KPI;
- restore-default action;
- live/system-sync language;
- break editing;
- time-off editing;
- HR/payroll/analytics behavior.

## Frozen visual structure

Freeze:

- Manager operational sidebar;
- page header;
- specialist selector;
- selected-specialist summary;
- weekly-hours summary;
- seven-day recurring schedule;
- working/non-working treatment;
- start/end time chips;
- per-day `ویرایش` action;
- `ذخیره تغییرات برنامه`;
- bottom guidance;
- v2 operational typography/spacing/control language.

## Frozen semantic baseline

- this page manages one specialist's recurring weekly working schedule;
- each weekday is either `روز کاری` or `روز غیرکاری`;
- working days define recurring start/end times;
- salon closure may make a day non-working;
- specialist breaks are managed separately;
- specialist time off is managed separately;
- this is not an attendance system;
- there is no fixed daily/weekly appointment capacity.

## Freeze boundary

This freezes **Manager Specialist Schedules — desktop/default** only.

It does not freeze:

- per-day edit state;
- break management;
- time-off management;
- validation/error states;
- responsive variants;
- fixture specialist/date data.

Next page: Manager Breaks. Per workflow, review the old version before writing a refinement prompt.
