# Stitch Review 24 — Manager Appointments Mobile 24A first pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui(4).zip`  
**Package SHA-256:** `b61a0cc6c58577d9860977134fe2bcdd9532ef0dc270fc8435589e17053df80d`  
**Decision:** **24A is not frozen yet.** The mobile workspace/search/filter direction is good, but a small consistency/scope patch is required before moving to 24B.

## Generated screen map

- `_1` — filtered search result / single appointment
- `_2` — mobile appointments workspace/list
- `_3` — open filter state

## What works

The responsive direction is correct:

- the desktop table was transformed into mobile appointment cards rather than squeezed horizontally;
- search is prominent and readable in RTL;
- filters are mobile-friendly;
- appointment cards prioritize time, customer, specialist, services, duration, status and booked total;
- the four approved appointment statuses are represented;
- pay-at-salon wording is used;
- no manual booking action appears in the main list;
- the filter sheet supports date, status and specialist filtering;
- the overall visual language remains close to the frozen desktop manager baseline.

No broad redesign is needed.

## Remaining blockers

### 1. Header title is still English

The mobile header uses:

`Appointments`

The product is Persian / RTL.

Use a Persian operational title such as:

- `نوبت‌ها`
- or `مدیریت نوبت‌ها`

Do not mix an English product heading into the Persian manager surface.

### 2. Mobile navigation introduces an unapproved area

The bottom navigation contains:

- `تنظیمات`

A generic Settings area is not part of the frozen manager v1 scope.

The confirmed manager areas are:

- نوبت‌ها
- خدمات
- متخصصان
- ساعات کاری سالن
- برنامه کاری متخصصان
- زمان‌های استراحت
- مرخصی‌ها

For mobile, use a compact navigation pattern that exposes only these confirmed areas. It may use a menu/drawer for secondary operational areas rather than forcing all areas into a bottom bar.

### 3. Navigation merges approved areas into an ambiguous new destination

The bottom navigation uses:

`ساعات و تقویم`

This is not one of the frozen operational areas and may blur:

- salon hours;
- specialist schedules;
- breaks;
- time off.

Do not create a new combined product area. If compact navigation is needed, put these approved areas behind an operational menu/drawer.

### 4. Notification bell implies an unapproved notification center

The header includes a bell icon.

Notifications / notification-center functionality is not part of the frozen v1 Manager scope.

Remove the bell unless it is purely decorative with no implied destination; preferred baseline is to remove it.

### 5. One fixture violates the 30-minute appointment start grid

In the open-filter state, one appointment starts at:

`۱۲:۴۵`

The frozen booking/scheduling contract requires appointment starts on a **30-minute grid**.

Use a valid start such as:

- ۱۲:۳۰
- ۱۳:۰۰

while preserving any valid total duration.

### 6. Same-day fixture count is inconsistent across related states

The workspace shows:

`۶ نوبت ثبت‌شده`

while the open-filter state for the same date shows:

`۸ نوبت ثبت‌شده`

These are meant to be the same mobile workspace with the filter UI opened.

Use one consistent neutral fixture count across the related 24A screens.

## Non-blocking notes

The card hierarchy, search/filter interaction, status chips and pay-at-salon presentation are accepted.

Do not regenerate the interaction model. Patch only the visible issues above.

## Freeze gate

24A can be frozen after a targeted patch to:

1. Persian header title;
2. approved mobile navigation only;
3. remove the notification-center implication;
4. replace the invalid 12:45 appointment start;
5. keep the same-day appointment count consistent.

Do **not** start 24B until 24A is accepted.
