# Stitch Review 38 — Manager Specialists old-version assessment

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (37).zip`  
**Package SHA-256:** `d845f8fb977bffffd11dd93b821c2895f25c3c80b09df93eb39aff6be41d5696`  
**Purpose:** Review the existing Manager Specialists page before refinement.

## Current page structure

The old Manager Specialists page already has a strong operational skeleton:

- persistent right-side Manager navigation;
- page header;
- `افزودن متخصص جدید` CTA;
- four summary/KPI cards;
- specialist search;
- expertise/category chips;
- six-row specialist table;
- portrait + name + personnel code;
- primary expertise;
- service chips;
- weekly schedule;
- online-booking status;
- row actions;
- lower system/sync note.

The core specialist list is useful, but the page mixes specialist-record management with analytics, scheduling details and system-state claims that belong elsewhere.

## What should be preserved

### 1. Manager shell

Preserve the same operational sidebar already frozen on Manager Appointments and Manager Services:

- `نوبت‌ها`
- `خدمات`
- `متخصصان`
- `ساعات کاری سالن`
- `برنامه کاری متخصصان`
- `زمان‌های استراحت`
- `مرخصی‌ها`

Keep `متخصصان` active.

### 2. Add specialist action

`افزودن متخصص جدید` is compatible with the frozen Manager scope.

Keep one clear primary CTA.

Do not define the add/edit form yet.

### 3. Specialist search + expertise categories

Preserve:

- one search field;
- restrained expertise/category chips.

These are practical for a specialist-management list.

### 4. Specialist identity + service eligibility

The strongest part of the table is the relationship between:

- specialist;
- expertise;
- services that specialist can provide.

Preserve:

- small portrait;
- specialist name;
- neutral expertise;
- service chips;
- one clear edit/open action.

## What should improve

### 1. Remove KPI/analytics cards

Current page shows:

- total active specialists;
- service coverage count;
- today's shift attendance;
- `۱۰۰٪ آماده پذیرش`.

These are analytics / live-operations metrics, not needed for the specialist catalog.

Remove all four cards.

Do not replace them with other KPI/dashboard cards.

A simple list count such as `۶ متخصص` near the catalog heading is enough if useful.

### 2. Weekly schedules do not belong in this table

The table currently exposes exact weekly schedules for each specialist.

But recurring schedules have their own confirmed Manager area:

`برنامه کاری متخصصان`

Keeping full schedules inside the specialist catalog duplicates responsibility and makes the table too wide.

Remove the weekly-schedule column from the default specialist list.

Do not duplicate:

- schedule editor;
- breaks;
- time off

inside this page.

### 3. “Online booking status” is too strong / ambiguous

Current page uses:

`فعال در رزرو آنلاین`

This conflates:

- specialist record state;
- actual availability;
- schedule;
- service eligibility.

Actual customer availability depends on schedules, breaks, time off and appointments.

Remove this column from the default list rather than freezing a misleading simple availability state.

### 4. Specialist hierarchy and medical/clinical wording are stale

Current page includes:

- `مستر استایلیست مو`;
- `متخصص ارشد رنگ و لایت`;
- `کارشناس فیشیال و پوست`;
- `تکنسین ارشد ناخن`;
- `متخصص احیا و تراپی مو`.

Use neutral expertise consistent with the frozen public Specialists page.

Examples:

- `کوتاهی و استایل مو`
- `رنگ و لایت`
- `مراقبت پوست`
- `مژه و ابرو`
- `خدمات ناخن`
- `مراقبت و استایل مو`

Do not use rankings, senior/master hierarchy or medical-style titles.

### 5. Service-chip wording is stale

Current chips include:

- `پاکسازی عمیق`;
- `آبرسانی هیدروژل`;
- `لیفتینگ پوست`;
- `فیبروز تخصصی`;
- `پدیکور VIP`;
- `بوتاکس مو`;
- `کراتین احیا`;
- `پروتئین‌تراپی`.

Use neutral services consistent with the frozen Services catalog.

### 6. “Authorized/covered services” language should stay neutral

The page concept is service eligibility, not licensing.

Use:

**`خدمات قابل ارائه`**

Do not use:

- authorized;
- certified;
- licensed;
- medically approved

semantics.

### 7. System/sync note is implementation-heavy

Current lower note says specialist service/schedule changes are immediately applied to the booking calendar and shows a last-sync timestamp.

Remove:

- instant-sync promise;
- calendar synchronization status;
- last synchronization time.

A grounded replacement may simply say:

**`برنامه کاری، زمان‌های استراحت و مرخصی هر متخصص از بخش‌های مربوط مدیریت می‌شود.`**

### 8. Row actions should be simple

Current rows use separate calendar/edit icons.

Because schedule management has its own page, the default specialist list only needs one clear row action:

**`ویرایش`**

Do not duplicate schedule management here.

### 9. “Personnel” framing is unnecessary

Current copy says:

- `مدیریت متخصصان و پرسنل`;
- `سازمان‌دهی کادر اجرایی سالن`.

The frozen product role is specialist/staff, but this page is specifically specialist management.

Use:

- `مدیریت متخصصان سالن`
- `متخصصان و خدمات قابل ارائه هر یک را مدیریت کنید.`

Do not turn it into a general HR/personnel system.

## Refinement target

The refined Manager Specialists page should keep the old page's shell and compact list, while narrowing the page to:

- specialist records;
- expertise;
- service eligibility;
- add/edit specialist.

Schedules, breaks and time off stay in their dedicated Manager areas.

The result should feel like specialist-catalog management — not analytics, HR, scheduling or live-availability monitoring.
