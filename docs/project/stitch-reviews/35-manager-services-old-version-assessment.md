# Stitch Review 35 — Manager Services old-version assessment

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (34).zip`  
**Package SHA-256:** `9518175adece1518c3a8a65692f1ec03cd6bc3f6218e9eaa06d884db4db30411`  
**Purpose:** Review the existing Manager Services page before refinement.

## Current page structure

The old Manager Services page already has a useful operational desktop skeleton:

- persistent right-side Manager navigation;
- page header;
- four top summary/KPI cards;
- service-management heading;
- sort control;
- `افزودن خدمت جدید` CTA;
- search;
- category chips;
- service table;
- service name + code;
- category;
- duration;
- price;
- assigned/eligible specialists;
- booking-state toggle;
- per-row edit/view actions;
- pagination;
- lower informational guidance block.

The core table structure is useful, but the page currently mixes real service-management needs with analytics, stale marketing/clinical terminology and some over-specified behavior.

## What should be preserved

### 1. Manager operational shell

Preserve the same right-side navigation already frozen on Manager Appointments:

- `نوبت‌ها`
- `خدمات`
- `متخصصان`
- `ساعات کاری سالن`
- `برنامه کاری متخصصان`
- `زمان‌های استراحت`
- `مرخصی‌ها`

Keep `خدمات` active.

### 2. Service list/table

The strongest part of the old page is the management table.

Preserve service-level visibility for:

- service name;
- category;
- duration;
- price;
- specialists who can provide the service;
- booking availability/status;
- edit/open action.

A compact desktop list is more appropriate than turning this into card-heavy SaaS UI.

### 3. Search + category organization

Preserve:

- service search;
- restrained category filtering/grouping.

This is practical for service administration.

### 4. Add/edit service affordances

The product scope says the Manager manages services.

A clear:

- `افزودن خدمت جدید`
- edit/open action per service

is compatible with that scope at the product/UI level.

Do not define implementation/storage details in Stitch.

## What should improve

### 1. Top KPI cards are outside the intended operational core

Current page shows:

- `کل خدمات فعال — ۲۸ خدمت`
- `متوسط زمان خدمت — ۶۸ دقیقه`
- `میانگین تعرفه — ۶۵۰,۰۰۰ تومان`
- `پوشش متخصصان — ۱۲ نفر آماده`

These are dashboard/analytics-style metrics and are not needed to manage the catalog.

They also visually compete with the actual task.

Remove the KPI row.

A small simple count near the list is fine, but do not create analytics cards.

### 2. “Tariff” terminology should use customer-facing price language

Current page uses:

- `تعرفه`
- `میانگین تعرفه`

The frozen customer/product language is price.

Use:

- `قیمت`
- `قیمت خدمت`

Do not imply regulated/official tariff semantics.

### 3. “Authorized specialists” wording is too formal

Current page uses:

- `متخصصان مجاز`

Use:

**`متخصصان ارائه‌دهنده`**

or equivalent neutral wording.

Do not imply licensing/certification.

### 4. Service names/categories contain stale clinical/spa language

Examples include:

- `درمان تخصصی اولاپلکس`
- `تراپی و احیا`
- `مانیکور و پدیکور اسپا`
- `پاکسازی عمیق و فیشیال`
- `دکتر هما صادقی`

These conflict with the neutral product direction already frozen on public Services/Specialists.

Use neutral service and specialist fixture language.

Examples:

- `مراقبت و تقویت مو`
- `مانیکور و پدیکور`
- `مراقبت پوست`
- neutral specialist names/expertise without medical titles.

### 5. “Active / bookable” should not imply a complex state model

Current row text says:

- `فعال / قابل رزرو`

The product definition only requires Manager service management; it does not yet freeze a multi-dimensional publication/archive/bookability state machine.

For this baseline, show one simple operational state such as:

**`قابل رزرو`**

with a toggle or compact status control.

Do not invent:

- draft/published workflows;
- archive lifecycle;
- multiple independent service states;
- hidden vs published vs bookable matrices.

Those belong to engineering/product clarification later if needed.

### 6. The lower capacity note over-specifies immediate system behavior

Current note says disabling a service:

- immediately suspends customer booking;
- preserves previously booked appointments.

Preserving existing appointments is consistent with product safety, but the current copy freezes operational timing/mechanics too strongly.

Use a simpler product-level note:

**`غیرفعال کردن رزرو یک خدمت نباید نوبت‌های تأییدشده قبلی را تغییر دهد.`**

Do not describe implementation timing, syncing or portal mechanics.

### 7. “Calendar guide” CTA is unrelated here

Current lower block contains:

- `مشاهده راهنمای تقویم`

This is not part of the service-management task.

Remove it.

### 8. Sort control is optional, not a priority

The `مرتب‌سازی` control may remain if it helps the table, but it should not dominate the header.

Search, add service and category organization are the primary controls.

### 9. Row actions are visually redundant

Current rows use both edit and eye/view icons.

For a service-management list, one clear **edit/open** action is enough for the default baseline.

Prefer:

**`ویرایش`**

or one clear open/edit icon with an accessible label.

Do not clutter each row with duplicate actions unless they represent distinct confirmed behavior.

## Refinement target

The refined Manager Services page should combine:

- **old Manager Services** for table information architecture;
- **frozen Manager Appointments** for operational shell, control density and typography;
- **frozen public Services** for neutral service/category/price/specialist language.

The result should feel like a practical service-catalog management workspace — not an analytics dashboard, certification tool, clinic/spa catalog or complex CMS state machine.
