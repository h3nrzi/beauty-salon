# Stitch Review 32 — Manager Appointments old-version assessment

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (31).zip`  
**Package SHA-256:** `4d23f8178a0b4fc1592192bca1f573df3ed38fec9703049d1a20223d16fd7318`  
**Purpose:** Review the existing Manager Appointments page before refinement.

## Current page structure

The old Manager Appointments page already has a useful operational desktop skeleton:

- persistent right-side manager navigation;
- page header / manager identity area;
- search;
- date filter;
- specialist filter;
- status filter;
- quick status chips;
- appointment table;
- status chips;
- masked customer mobile;
- appointment duration;
- total amount;
- per-row `مشاهده جزئیات` action;
- pagination.

This is the correct kind of information architecture for the Manager default workspace and should be refined rather than replaced.

## What should be preserved

### 1. Operational shell

The right-side navigation is strong and matches the confirmed Manager scope:

- `نوبت‌ها`
- `خدمات`
- `متخصصان`
- `ساعات کاری سالن`
- `برنامه کاری متخصصان`
- `زمان‌های استراحت`
- `مرخصی‌ها`

Preserve this shell.

Do not add:

- analytics;
- CRM;
- marketing;
- finance;
- inventory;
- payroll;
- generic Settings;
- notifications center.

### 2. Search and practical filters

Preserve:

- search by customer name / mobile / reference ID;
- date filter;
- specialist filter;
- status filter.

The quick status chips are also useful as operational shortcuts.

Keep the status vocabulary limited to:

- `تأییدشده`
- `انجام‌شده`
- `لغوشده`
- `عدم حضور`

### 3. Appointment table density

The current table uses the desktop canvas well.

Preserve columns for:

- time;
- customer;
- specialist;
- booked services;
- duration;
- status;
- booked amount;
- details action.

Keep the page operational and compact.

### 4. Detail as the main row action

`مشاهده جزئیات` is the correct default list action.

Cancel / reschedule / reassign should be handled from the detail flow, not cluttered into every list row.

## What should improve

### 1. Manager-created / walk-in appointment capability is not in frozen v1 scope

Current page includes:

- `ثبت نوبت حضوری جدید`
- copy about `ثبت فوری مراجعین حضوری`

The frozen Manager scope includes:

- search/view;
- cancel;
- reschedule;
- reassign;
- complete/no-show through the confirmed role rules.

It does not currently include creating new appointments on behalf of walk-in customers.

Remove the walk-in/manual-create CTA and related copy from this baseline.

Do not invent receptionist/front-desk booking creation.

### 2. “Export day list” is not a confirmed v1 capability

Current page includes:

- `خروجی لیست روز`

Export/reporting is not part of the frozen product scope.

Remove it from the default Manager Appointments page.

### 3. Live-update/system-state claim is unnecessary

Current page says:

- `بروزرسانی زنده فعال است`

Live sync/real-time mechanics are not a frozen product capability and expose implementation assumptions.

Remove this label.

### 4. Exact “today” fixtures are internally inconsistent

The header shows one Persian date while the date filter shows a different one.

The current screen includes both:

- `امروز: پنج‌شنبه ۲۴ آبان`
- `امروز (۲۴ مهر ۱۴۰۳)`

This is contradictory.

For the refined baseline, either:

- use one internally consistent placeholder date throughout; or
- use a neutral selected-date label without hardcoding “today”.

Do not mix dates.

### 5. Service names include stale clinical / treatment language

Examples include:

- `پاکسازی عمیق پوست`
- `تراپی بوتاکس مو`

Use neutral service names consistent with the frozen Services page.

Examples:

- `مراقبت پوست`
- `مراقبت و استایل مو`
- `بالیاژ و رنگساژ`
- `مانیکور و پدیکور`

Do not reintroduce spa/clinical/therapy positioning.

### 6. Amount wording should reflect booking snapshot semantics

Current column says:

- `مبلغ کل`

For confirmed/historical appointments the Manager should see the amount captured for that booking.

Prefer:

**`مبلغ ثبت‌شده`**

or:

**`مبلغ نوبت`**

Do not add payment status, invoice or settlement workflow.

### 7. Top copy is too “front desk / surveillance” oriented

Current intro says:

- `نظارت، بررسی وضعیت و ثبت فوری مراجعین حضوری...`

Use a grounded operational description such as:

**`جستجو، بررسی و مدیریت نوبت‌های سالن.`**

The product is not a surveillance/concierge/front-desk suite.

### 8. Quick-filter counts are fixture data only

Counts such as:

- all 28;
- confirmed 14;
- completed 8;
- cancelled 4;
- no-show 2

may remain as clearly representative list counts if they help the UI, but they are not product facts or analytics.

Do not add KPI cards, charts, trends or dashboard metrics.

### 9. Avoid “live/current-time” semantic traps in terminal statuses

The table mixes `انجام‌شده` and `عدم حضور` in a day-oriented view.

That is valid only when the appointment time has passed.

For the visual baseline, use representative fixture rows that do not imply impossible lifecycle timing.

Do not create reversible terminal-state actions from the list.

## Refinement target

The refined Manager Appointments page should combine:

- **old Manager Appointments** for operational shell, search/filter/table density;
- **frozen Booking / My Appointments** for clean status, price and service language;
- the frozen Manager product scope for capabilities.

The result should feel like a practical salon operations workspace — not a CRM, analytics dashboard, receptionist booking tool or reporting suite.
