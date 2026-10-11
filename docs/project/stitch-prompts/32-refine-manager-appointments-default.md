# Stitch Prompt 32 — Refine Manager Appointments default state

Refine the **Manager Appointments / مدیریت نوبت‌ها** page only.

The old page has a strong operational shell and table structure. Improve it without adding new manager capabilities.

## What to select in Stitch

Select exactly:

1. the current **old Manager Appointments** screen;
2. the frozen **My Appointments** screen for appointment/status/price language;
3. optionally the frozen **Booking** screen for task-focused UI consistency.

Return **one Manager Appointments screen only**.

## Source roles

Use the selected **old Manager Appointments** screen for:

- right-side manager navigation;
- desktop operational density;
- search/filter structure;
- appointment table;
- pagination;
- detail action.

Use frozen **My Appointments / Booking** for:

- cleaner customer/appointment terminology;
- status-chip language;
- price wording;
- restrained card/control styling;
- overall v2 visual consistency.

Do not copy their layouts.

## Hard capability boundary

This page is a **Manager appointment workspace**, not a receptionist booking-creation tool.

Do not include:

- `ثبت نوبت حضوری جدید`;
- walk-in/manual appointment creation;
- `خروجی لیست روز`;
- exports/reports;
- live-update claims;
- analytics/KPI cards;
- CRM/customer profiles;
- finance/payment operations.

## 1. Manager shell

Preserve the right-side navigation with only:

- `نوبت‌ها`
- `خدمات`
- `متخصصان`
- `ساعات کاری سالن`
- `برنامه کاری متخصصان`
- `زمان‌های استراحت`
- `مرخصی‌ها`

Keep `نوبت‌ها` active.

A simple `بازگشت به سایت اصلی` action may remain.

## 2. Page header

Use:

- title: **`مدیریت نوبت‌ها`**
- concise supporting copy:

**`جستجو، بررسی و مدیریت نوبت‌های سالن.`**

Do not mention:

- walk-in registration;
- live monitoring;
- reporting/export.

## 3. Search

Keep one prominent search field.

Placeholder direction:

**`جستجو بر اساس نام مراجع، شماره موبایل یا کد نوبت`**

Do not turn search into CRM/customer-profile search.

## 4. Filters

Keep practical filters for:

- date;
- specialist;
- status.

Use one internally consistent selected-date fixture.

Do not show contradictory “today” dates in different places.

You may use a neutral label such as:

**`تاریخ انتخاب‌شده`**

with one fictional date.

## 5. Quick status filters

Keep compact quick filters if useful:

- `همه نوبت‌ها`
- `تأییدشده`
- `انجام‌شده`
- `لغوشده`
- `عدم حضور`

Counts may be shown as fixture list counts, but:

- no charts;
- no percentages;
- no trends;
- no KPI/dashboard treatment.

## 6. Appointment table

Show a representative set of **5 appointment rows**.

Columns:

- `زمان نوبت`
- `مراجع`
- `متخصص`
- `خدمات`
- `مدت نوبت`
- `وضعیت`
- `مبلغ ثبت‌شده`
- `عملیات`

Each row should support:

- customer name;
- partially masked mobile;
- specialist;
- one or more neutral booked services;
- duration;
- lifecycle status;
- booked amount;
- `مشاهده جزئیات`.

Do not add direct cancel/reschedule/reassign buttons in the list.

Those actions belong to appointment detail.

## 7. Service wording

Use neutral service names consistent with frozen Services.

Good examples:

- `بالیاژ و رنگساژ`
- `کوپ و براشینگ`
- `مراقبت پوست`
- `مانیکور و پدیکور`
- `مراقبت و استایل مو`

Do not use:

- `تراپی`;
- `بوتاکس مو`;
- spa/clinic terminology;
- material/certification claims.

## 8. Status semantics

Use only:

- `تأییدشده`
- `انجام‌شده`
- `لغوشده`
- `عدم حضور`

Do not add:

- pending approval;
- awaiting payment;
- refunded;
- draft;
- waitlist.

Terminal states must look read-only from this list.

## 9. Price semantics

Use column label:

**`مبلغ ثبت‌شده`**

Do not show:

- payment status;
- refund;
- invoice;
- settlement;
- checkout.

Payment remains `پرداخت در سالن` at the product level, but it does not need to be repeated in every table row.

## 10. Remove live/system claims

Do not show:

- `بروزرسانی زنده فعال است`;
- sync status;
- server status;
- system-health indicators.

## 11. Pagination

Keep simple pagination/list-count treatment.

This is list navigation, not analytics.

## Product boundaries

Do not add:

- appointment creation;
- CRM;
- analytics;
- reporting/export;
- finance/accounting;
- notifications center;
- complex role management;
- branches;
- inventory/payroll.

## Visual quality bar

The page should feel:

- operational;
- compact;
- calm;
- easy to scan;
- clearly part of the v2 product family;
- desktop-first;
- not like a generic SaaS dashboard.

Preserve useful information density.

## Required output

Return exactly one:

- **Manager Appointments — desktop/default — appointment workspace**

No appointment detail.
No cancel/reschedule/reassign state.
No staff view.
No mobile/tablet.
No edge states.

We will compare the new Manager Appointments page against the old version before deciding whether to freeze it.
