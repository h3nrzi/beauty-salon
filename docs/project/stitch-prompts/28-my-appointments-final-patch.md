# Stitch Prompt 28 — My Appointments final patch

Patch only the current refined **My Appointments / نوبت‌های من** screen.

This is **not a redesign**.

## Select in Stitch

Select only the current refined My Appointments screen.

## Preserve exactly

Keep:

- desktop layout;
- public header/navigation;
- upcoming/history tabs;
- two appointment cards;
- card information hierarchy;
- `مشاهده جزئیات نوبت` CTAs;
- secondary guidance column;
- `تماس با سالن` link;
- `رزرو نوبت تازه` CTA;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

Do not add states or new capabilities.

## 1. Replace the stale footer

Keep the footer layout but use the same neutral frozen public-footer language as the other frozen public pages.

Use:

- `سالن زیبایی آرا`
- `سالن زیبایی آرا؛ فضایی برای معرفی خدمات، انتخاب متخصص و رزرو ساده نوبت.`
- `نشانی سالن — اطلاعات نهایی در صفحه تماس`
- `اطلاعات تماس در صفحه تماس`
- `ساعات کاری سالن در صفحه تماس نمایش داده می‌شود`
- `خدمات سالن`
- `متخصصان آرا`
- `رزرو نوبت`
- `پیگیری نوبت‌ها`

Remove completely:

- north-Tehran positioning;
- exact Zafaraniyeh address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`;
- copyright/location wording containing `تهران، زعفرانیه`.

## 2. Remove the implementation/system-sync block

Delete the block that says:

`اطلاعات نوبت‌ها به صورت خودکار با سیستم هماهنگی سالن همگام‌سازی می‌شود.`

Do not replace it with database/system/sync/notification language.

The secondary column should remain clean with only:

- appointment guidance;
- Contact path;
- new-booking CTA.

## 3. Simplify the intro eyebrow

Replace:

`سامانه مدیریت نوبت‌های مراجعین`

with:

**`مدیریت نوبت‌ها`**

Keep the main heading:

**`نوبت‌های من`**

## 4. Simplify new-booking copy

Replace wording equivalent to:

`برای خدمات دیگر یا رزرو نوبت جدید برای تاریخ‌های آتی، می‌توانید از سامانه رزرو استفاده کنید.`

with:

**`برای خدمات دیگر یا یک تاریخ جدید، می‌توانید نوبت تازه‌ای رزرو کنید.`**

Keep CTA:

**`رزرو نوبت تازه`**

## 5. Appointment-duration wording

On both appointment cards replace:

`مدت زمان اختصاصی`

with:

**`مدت نوبت`**

Do not change the duration values.

## Keep already-correct content

Keep:

- `تأییدشده`;
- reference IDs;
- booked service snapshots;
- neutral specialist expertise;
- `مبلغ ثبت‌شده نوبت`;
- `پرداخت در سالن`;
- policy guidance that says available actions are shown in appointment detail;
- `تماس با سالن` without an exact phone number.

## Product boundaries

Do not reintroduce:

- loyalty/VIP;
- ratings;
- hospitality/facility claims;
- private parking;
- hygiene guarantees;
- reminders/notifications;
- payment status;
- consultation;
- CRM;
- profile/account features.

## Required output

Return exactly one corrected:

- **My Appointments — desktop/default — upcoming appointments**

No History state.
No appointment detail.
No cancel/reschedule.
No empty state.
No mobile/tablet.

If this patch preserves the accepted UI and fixes these literals, My Appointments default will be frozen.
