# Stitch Review 42 — Manager Salon Hours surgical refinement

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (42).zip`  
**Package SHA-256:** `c552b9c64cdad2680f11959cfafc3123504e0fd8da3bd53f905098557b8e5dd4`  
**Decision:** **Freeze Manager Salon Hours desktop/default.**

## Why this pass is accepted

The page now has one clear responsibility: managing the salon's recurring weekly opening hours.

The old layout remains recognizable and the unrelated booking-policy/system content has been removed.

## Verified improvements

Removed:

- default slot-duration control;
- minimum booking-notice control;
- booking-horizon control;
- automatic slot-optimization control;
- VIP/phone exception on Friday;
- per-day `پذیرش آنلاین فعال`;
- `بازگردانی پیش‌فرض`;
- unrelated `مدیریت متخصصان` CTA;
- stale business/address/internal-phone card;
- system/synchronization language;
- static `امروز:` prefix.

Preserved correctly:

- Manager operational sidebar;
- page header;
- seven-day weekly schedule;
- open/closed day state;
- opening and closing times;
- per-day `ویرایش` affordance;
- `ذخیره تغییرات`;
- guidance that salon hours are separate from specialist schedules, breaks and time off.

## Source-state verification

The exported HTML contains only the default weekly-hours view.

No hidden edit modal/form or unrelated booking-policy form is embedded in this export.

## Frozen visual structure

Freeze:

- Manager operational shell;
- `ساعات کاری عمومی سالن آرا` page header;
- save action;
- scheduling guidance block;
- seven-day weekly-hours card;
- day-name / open-closed / time / edit hierarchy;
- closed-Friday treatment;
- v2 operational typography, spacing and controls.

## Frozen semantic baseline

- this page manages recurring salon opening hours only;
- each weekday is open or closed;
- open days have opening and closing times;
- specialist recurring schedules are managed separately;
- specialist breaks are managed separately;
- specialist time off is managed separately;
- booking horizon, lead time and public start-grid rules are not editable here.

## Deterministic cleanup deferred

The small `۷ روز هفته` badge wraps onto two visual lines in the export.

Normalize it to a single-line compact label during engineering/export cleanup if retained.

This does not affect the accepted page architecture and does not justify another Stitch regeneration.

## Freeze boundary

This freezes **Manager Salon Hours — desktop/default** only.

It does not freeze:

- per-day edit state;
- validation/error state;
- holiday/date exceptions;
- specialist schedules;
- breaks;
- time off;
- responsive variants.

Next page: Manager Specialist Schedules. Per workflow, review its old version before writing a refinement prompt.
