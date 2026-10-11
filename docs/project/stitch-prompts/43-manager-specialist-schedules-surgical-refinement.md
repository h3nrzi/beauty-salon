# Stitch Prompt 43 — Manager Specialist Schedules surgical refinement

Modify the **old Manager Specialist Schedules / برنامه کاری متخصصان** screen.

This is a **surgical cleanup**, not a redesign.

## What to select in Stitch

Select **only the original/old Manager Specialist Schedules screen**.

Do not select additional visual anchors.

## Preserve the old composition

Keep:

- right-side Manager sidebar;
- top bar;
- page-header placement;
- specialist selector;
- selected-specialist section;
- seven-day weekly schedule;
- working/non-working visual treatment;
- start/end times;
- per-day `ویرایش` action;
- `ذخیره تغییرات برنامه` action;
- overall spacing, typography, colors and card geometry.

Do not invent a new layout.

## 1. Page heading

Use:

**`برنامه کاری هفتگی متخصصان`**

Supporting copy:

**`ساعات کاری تکرارشونده هر متخصص را برای روزهای هفته مدیریت کنید.`**

Remove HR/personnel/shift-management wording.

## 2. Specialist selector

Keep the current selector structure.

Use neutral specialist expertise only.

Examples:

- `کوتاهی و استایل مو`
- `رنگ و لایت`
- `مراقبت پوست`
- `مژه و ابرو`
- `خدمات ناخن`
- `مراقبت و استایل مو`

Do not use:

- `ارشد`;
- `مستر`;
- `اسپا`;
- clinical titles.

A simple fixture count such as `۶ متخصص` may remain.

## 3. Simplify the selected-specialist summary

Keep a compact selected-specialist summary if useful.

Remove:

- `شیفت منظم استاندارد`;
- services-covered summary;
- `سقف رزرو هفتگی`;
- `ضریب حضور`.

If one derived summary remains, it may show only:

- selected specialist name;
- number of working days;
- total recurring weekly hours.

Do not turn it into KPI cards.

## 4. Weekly schedule rows

Keep all 7 days.

Each day should show only:

- day name;
- `روز کاری` or `روز غیرکاری`;
- start time;
- end time;
- one `ویرایش` action.

For working days, keep the current recurring time range style.

Remove:

- `حاضر در سالن`;
- `حداکثر ظرفیت روزانه`;
- fixed appointment-count capacity;
- attendance language.

## 5. Non-working days

For a recurring non-working day, use:

**`روز غیرکاری`**

Do not use:

- `عدم حضور در سالن`;
- `فعال‌سازی شیفت`;
- capacity = 0 as a core field.

If the salon itself is closed on a day, a small note may say:

**`سالن در این روز بسته است`**

Do not invent exceptions.

## 6. Remove restore-default action

Remove:

**`بازیابی پیش‌فرض`**

Keep:

**`ذخیره تغییرات برنامه`**

Do not add reset/import/export actions.

## 7. Bottom guidance

Use exactly:

**`این برنامه، ساعات کاری هفتگی تکرارشونده متخصص را مشخص می‌کند. زمان‌های استراحت و مرخصی‌ها از بخش‌های مربوط مدیریت می‌شوند.`**

Do not mention:

- online booking calendar sync;
- implementation timing;
- portal/system synchronization.

## 8. Static date

Replace:

`امروز: پنج‌شنبه ۲۴ آبان`

with:

**`پنج‌شنبه ۲۴ آبان`**

## Product boundary

Do not add:

- attendance tracking;
- weekly booking caps;
- daily appointment caps;
- service eligibility editing;
- breaks editing;
- time-off editing;
- HR/payroll;
- analytics;
- live availability dashboard.

## Required output

Return exactly one:

- **Manager Specialist Schedules — desktop/default**

The result should look immediately recognizable as the old page cleaned up.

No edit-day modal.
No break state.
No time-off state.
No mobile/tablet.
No new capability.
