# Stitch Review 41 — Manager Salon Hours old-version assessment

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (40).zip`  
**Purpose:** Review the existing Manager Salon Hours page before refinement.

## What should be preserved

The old page already has a strong weekly-hours management skeleton:

- frozen Manager sidebar;
- page title;
- weekly seven-day schedule;
- open/closed day state;
- opening and closing times;
- per-day edit affordance;
- save action;
- explanation that salon hours and specialist schedules are separate concepts.

This is the right core for the Manager Salon Hours page.

## What should be removed or corrected

### 1. Booking-rule settings do not belong here

The left column currently includes:

- default slot duration: `۱۵ دقیقه`;
- minimum booking notice: `۲ ساعت قبل`;
- booking horizon: `۳۰ روز آینده`;
- automatic slot optimization.

These are both misplaced and partly contradictory to the frozen product rules:

- public start grid = 30 minutes;
- same-day lead time = 60 minutes;
- booking horizon = 90 days.

Do not place booking-policy controls on the Salon Hours page.

This page should manage weekly salon opening hours only.

### 2. Remove VIP / exception wording

Friday currently says:

- `تعطیل رسمی سالن`;
- `امکان پذیرش VIP با هماهنگی تلفنی`.

VIP exceptions are out of scope.

A closed day should simply be closed.

### 3. “Online booking active” is redundant

Each open row says:

`پذیرش آنلاین فعال`

For this page, open/closed + opening/closing times are enough.

Actual bookability still depends on specialist schedules, breaks, time off, existing appointments, lead time and booking horizon.

Remove the per-day online-booking label.

### 4. Remove implementation/system language

Current copy says changes apply to all online-booking calendars and mentions automatic slot coordination.

Use product-level wording only.

Good direction:

**`ساعات کاری سالن چارچوب کلی دسترسی به زمان‌های رزرو را مشخص می‌کند. برنامه کاری هر متخصص جداگانه مدیریت می‌شود.`**

### 5. Remove “restore default”

The page includes `بازگردانی پیش‌فرض`, but no approved product rule defines a default-hours template.

Remove it from the baseline.

Keep `ذخیره تغییرات`.

### 6. Remove unrelated specialist-management CTA

The policy block includes `مدیریت متخصصان`.

That action is not necessary here because the persistent sidebar already provides navigation.

### 7. Remove stale business/facility footer card

The lower-left card contains:

- `سالن تخصصی آرا`;
- exact fictional address;
- administrative internal phone.

Remove it.

### 8. Static “today” wording

Top bar uses:

`امروز: پنج‌شنبه ۲۴ آبان`

Use only the fixture date without `امروز:`, or a neutral static date treatment.

## Refinement target

Keep the old page geometry recognizable.

Narrow the page to one responsibility:

**manage the salon's recurring weekly opening hours.**

Do not mix:

- booking policy;
- specialist schedules;
- breaks;
- time off;
- VIP exceptions;
- system automation;
- business contact details.
