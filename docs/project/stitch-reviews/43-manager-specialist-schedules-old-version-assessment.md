# Stitch Review 43 — Manager Specialist Schedules old-version assessment

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (44).zip`  
**Package SHA-256:** `65a189555b0c3691486129721c80b39dc4cad2aad5e21fbecfa95b0b2c238af9`  
**Purpose:** Review the existing Manager Specialist Schedules page before refinement.

## What should be preserved

The old page already has the right high-level structure for recurring specialist schedules:

- Manager operational sidebar;
- page title;
- specialist selector;
- selected-specialist weekly schedule;
- seven-day recurring schedule;
- working-day vs non-working-day treatment;
- start/end time visibility;
- per-day edit affordance;
- save action;
- separation from breaks and time off.

This is a strong base and should be cleaned up rather than redesigned.

## What should improve

### 1. Remove shift/attendance analytics

The summary block currently contains:

- weekly total hours;
- services covered in these shifts;
- working-day count;
- weekly booking cap;
- attendance coefficient;
- `شیفت منظم استاندارد`.

Most of this is analytics/HR language, not required to manage a recurring schedule.

Remove:

- weekly booking cap;
- attendance coefficient;
- services-covered summary;
- standard-shift badge.

A simple selected-specialist identity + optional derived weekly-hours summary is enough.

### 2. Remove fixed daily appointment capacity

Each working day currently shows:

- `حداکثر ظرفیت روزانه: ۶ نوبت`.

This is not a valid product rule.

Actual bookable capacity depends on:

- service duration;
- salon hours;
- specialist schedule;
- breaks;
- time off;
- existing appointments.

Remove per-day appointment-capacity limits from this page.

### 3. Use recurring-schedule wording instead of attendance language

Current rows use:

- `حاضر در سالن`;
- `عدم حضور در سالن آرا`;
- `ضریب حضور`.

This sounds like attendance tracking.

Use neutral schedule language:

- `روز کاری`;
- `روز غیرکاری`.

This page defines the recurring weekly schedule; it is not an attendance system.

### 4. Keep non-working days simple

Thursday currently shows a weekly rest state and a CTA to activate the shift.

Friday is tied to salon closure.

For the default baseline, use:

- `روز کاری` with start/end times; or
- `روز غیرکاری`.

If the salon itself is closed that day, show a neutral note such as:

**`سالن در این روز بسته است`**

Do not use `غیرقابل تخصیص`, VIP/exception language or attendance wording.

### 5. Remove “restore default”

The page includes:

`بازیابی پیش‌فرض`

No approved default specialist-schedule template exists.

Remove this action.

Keep:

**`ذخیره تغییرات برنامه`**

### 6. Specialist selector copy contains stale hierarchy/spa language

Examples include:

- `استایلیست ارشد مو`;
- `طراح ناخن و اسپا`;
- `فیشیال و پوست`.

Use the neutral specialist expertise language already frozen on Manager Specialists.

### 7. Remove implementation/system synchronization wording

The bottom guidance says schedule changes become the routine/default in all online booking calendars.

Use product-level wording only:

**`این برنامه، ساعات کاری هفتگی تکرارشونده متخصص را مشخص می‌کند. زمان‌های استراحت و مرخصی‌ها از بخش‌های مربوط مدیریت می‌شوند.`**

Do not mention sync, portal or calendar implementation.

### 8. Static “today” wording

Replace:

`امروز: پنج‌شنبه ۲۴ آبان`

with:

`پنج‌شنبه ۲۴ آبان`

## Refinement target

Keep the old page recognizable and focused on one responsibility:

**manage one specialist's recurring weekly working schedule.**

Do not mix this page with:

- attendance;
- HR;
- fixed appointment capacity;
- service eligibility;
- breaks;
- time off;
- analytics.
