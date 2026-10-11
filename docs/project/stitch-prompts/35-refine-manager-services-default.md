# Stitch Prompt 35 — Refine Manager Services default state

Refine the **Manager Services / مدیریت خدمات** page only.

The old page has a useful service-management table, but it includes unnecessary KPI cards, stale clinical/spa terminology and over-specified service-state behavior.

## What to select in Stitch

Select exactly:

1. the current **old Manager Services / مدیریت خدمات** screen;
2. the frozen **Manager Appointments** screen as the primary operational visual anchor;
3. the frozen public **Services / خدمات** screen for neutral service/category/price language.

Return **one Manager Services screen only**.

## Source roles

Use the selected **old Manager Services** screen for:

- service-management purpose;
- search;
- category organization;
- service table;
- add-service CTA;
- specialist assignment summary;
- booking availability control;
- edit/open action;
- pagination.

Use frozen **Manager Appointments** for:

- right-side operational shell;
- page/header density;
- form/filter controls;
- table typography;
- row spacing;
- status/control treatment.

Use frozen public **Services** for:

- neutral service names;
- category names;
- duration/price language;
- specialist terminology.

Do not copy the public Services page layout.

## Hard scope rule

This is a **service catalog management** page.

Do not add:

- analytics/KPI dashboard;
- reports;
- revenue metrics;
- demand trends;
- service performance;
- CRM;
- inventory;
- payroll;
- accounting;
- promotions/packages;
- complex publishing workflow.

## 1. Manager shell

Keep the same Manager navigation as frozen Manager Appointments:

- `نوبت‌ها`
- `خدمات`
- `متخصصان`
- `ساعات کاری سالن`
- `برنامه کاری متخصصان`
- `زمان‌های استراحت`
- `مرخصی‌ها`

Keep `خدمات` active.

## 2. Remove the KPI row

Remove all four top summary cards:

- total active services;
- average duration;
- average price;
- specialist coverage.

Do not replace them with charts or analytics cards.

If useful, a simple list count such as `۶ خدمت` may appear near the catalog heading.

## 3. Page header

Use:

- title: **`مدیریت خدمات سالن`**
- concise supporting copy:

**`خدمات، مدت، قیمت، متخصصان ارائه‌دهنده و وضعیت رزرو را مدیریت کنید.`**

Remove:

- `پیکربندی کاتالوگ سالن`;
- system/configuration-heavy wording;
- `تعرفه`;
- `متخصصان مجاز`.

## 4. Primary actions

Keep one clear primary action:

**`افزودن خدمت جدید`**

A restrained sort control may remain if useful.

Do not add import/export/bulk-report actions.

## 5. Search and category organization

Keep one search field.

Placeholder:

**`جستجو بر اساس نام خدمت یا متخصص`**

Keep restrained category chips such as:

- `همه دسته‌ها`
- `مو و استایل`
- `رنگ و لایت`
- `مراقبت پوست`
- `دست و ناخن`
- `مژه و ابرو`

Do not use:

- `اسپا`;
- clinical/treatment categories.

## 6. Service table

Show a representative set of **6 service rows**.

Columns:

- `نام خدمت`
- `دسته‌بندی`
- `مدت`
- `قیمت`
- `متخصصان ارائه‌دهنده`
- `وضعیت رزرو`
- `عملیات`

Each row should support:

- service name;
- optional stable fixture code;
- neutral category;
- duration;
- price;
- one or more specialist names/avatars;
- simple booking availability state;
- one clear edit/open action.

## 7. Neutral service fixtures

Use service names consistent with the frozen public Services page.

Good examples:

- `کوتاهی و استایل`
- `بالیاژ و رنگساژ`
- `مراقبت و تقویت مو`
- `مراقبت پوست`
- `مانیکور و پدیکور`
- `لیفت و لمینت مژه`

Do not use:

- `درمان`;
- `تراپی`;
- `بوتاکس`;
- `اسپا`;
- medical titles;
- organic/certification/material claims.

## 8. Price terminology

Use:

**`قیمت`**

Do not use:

- `تعرفه`;
- official/fixed tariff wording.

## 9. Specialist terminology

Use:

**`متخصصان ارائه‌دهنده`**

Do not use:

- `متخصصان مجاز`;
- rankings;
- certificates;
- medical titles.

## 10. Booking availability state

Use one simple state/control:

**`قابل رزرو`**

The default list may show services as currently bookable.

Do not invent a complex service state model.

Do not add:

- draft/published;
- archived;
- hidden/public;
- multi-state publication workflows.

## 11. Row action

Use one clear action:

**`ویرایش`**

or one edit/open icon with an accessible label.

Do not show redundant edit + view controls unless they represent distinct confirmed actions.

## 12. Lower guidance

If keeping a bottom informational block, use only:

**`غیرفعال کردن رزرو یک خدمت نباید نوبت‌های تأییدشده قبلی را تغییر دهد.`**

Do not include:

- implementation timing;
- portal sync;
- calendar guide;
- system-status language.

## 13. Pagination

Keep simple pagination/list count if useful.

No analytics meaning.

## Visual quality bar

The page should feel:

- operational;
- compact;
- readable;
- consistent with frozen Manager Appointments;
- clearly part of the same v2 visual system;
- focused on catalog management.

Do not turn it into a generic SaaS admin dashboard.

## Required output

Return exactly one:

- **Manager Services — desktop/default — service catalog management**

No service edit/detail form yet.
No add-service form.
No mobile/tablet.
No edge states.

We will compare the new Manager Services page against the old version before deciding whether to freeze it.
