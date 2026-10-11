# Stitch Review 28 — My Appointments refinement comparison

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (27).zip`  
**Compared against:** old My Appointments from `stitch_salon_visual_baseline (25).zip`  
**Package SHA-256:** `04a3ce483f4dfb49afd218016ce5f8ed64224e04726c95d0b9316f1c76c99b91`  
**Decision:** **My Appointments is substantially improved, but one final content/footer patch is required before freeze.**

## Old vs new

The new page successfully removes most of the major scope drift while preserving the useful appointment-management structure.

### Preserved correctly

- public header/navigation;
- `نوبت‌های پیش‌رو` / `تاریخچه نوبت‌ها` tabs;
- two upcoming appointment cards;
- desktop two-column utility layout;
- appointment reference ID;
- date/time/duration;
- specialist;
- booked services;
- booked total;
- `مشاهده جزئیات نوبت`;
- secondary guidance column;
- `رزرو نوبت تازه` CTA.

### Improved correctly

Removed:

- `مشتری ویژه` / loyalty/VIP tier;
- VIP / exclusive appointment banner;
- private parking;
- organic drinks / hospitality claims;
- autoclave / hygiene guarantees;
- exact reception phone from the utility column;
- 10-minute early-arrival instruction;
- incorrect 24-hour phone-call instruction;
- `مستر` / `ارشد` specialist hierarchy;
- `تأییدشده و نهایی`;
- marketing upsell block.

Corrected:

- upcoming status now uses `تأییدشده`;
- price uses `مبلغ ثبت‌شده نوبت`;
- payment context is `پرداخت در سالن`;
- specialist/service language is substantially more neutral;
- policy guidance now correctly defers available actions to appointment detail.

## Remaining blocker 1 — stale public footer

The visible page still contains the old fictional footer:

- north-Tehran prestige wording;
- exact Zafaraniyeh address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`;
- location in copyright text.

This must be replaced with the frozen neutral public footer.

## Remaining blocker 2 — implementation/system synchronization claim

The secondary column says:

`اطلاعات نوبت‌ها به صورت خودکار با سیستم هماهنگی سالن همگام‌سازی می‌شود.`

This exposes/invents an implementation mechanism and does not help the customer.

Remove this block entirely or replace it with a simple product-level note.

Preferred: remove it.

## Remaining cleanup 3 — unnecessary “system” language

The page intro eyebrow says:

`سامانه مدیریت نوبت‌های مراجعین`

and the new-booking card says:

`می‌توانید از سامانه رزرو استفاده کنید.`

These are not severe scope violations, but they make the copy feel system-centric.

Prefer customer-facing language:

- intro eyebrow: `مدیریت نوبت‌ها`
- new-booking copy: `برای خدمات دیگر یا یک تاریخ جدید، می‌توانید نوبت تازه‌ای رزرو کنید.`

## Remaining cleanup 4 — appointment metadata wording

Replace:

`مدت زمان اختصاصی`

with:

`مدت نوبت`

The current wording implies an exclusivity concept that is not needed.

## What should remain unchanged

Do not redesign:

- tab structure;
- two appointment cards;
- card density;
- two-column layout;
- guidance card;
- Contact link;
- new-booking CTA;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

## Freeze gate

Patch only:

1. neutral public footer;
2. remove the automatic system-sync block;
3. simplify the system-centric intro/new-booking wording;
4. `مدت زمان اختصاصی` → `مدت نوبت`.

If these are corrected without visual drift, **My Appointments desktop/default — upcoming appointments can be frozen**.
