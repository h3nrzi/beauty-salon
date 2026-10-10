# Stitch Prompt 34 — Manager Appointments Mobile 24D targeted patch

Patch the existing **three Mobile 24D screens only**. This is not a redesign.

## Select in Stitch

Select these three generated mobile screens together:

- تغییر متخصص نوبت
- عدم امکان انتخاب متخصص
- تعارض تغییر هم‌زمان نوبت

Preserve the current layouts, cards, spacing, action hierarchy, colors and RTL styling.

## 1. Persian titles

Replace visible English titles:
- `Reassign Specialist`
- `Booking Conflict Resolver`

with:
- `تغییر متخصص نوبت`
- `عدم امکان انتخاب متخصص`
- `تعارض تغییر هم‌زمان نوبت`

## 2. Neutral specialist wording

Remove senior/master/credential wording such as:
- `استایلیست ارشد`
- `میکاپ آرتیست ارشد`

Use neutral labels:
- `متخصص مو و میکاپ`
- `متخصص میکاپ`
- `متخصص خدمات مو و میکاپ`

## 3. Reassignment semantics

Keep:
- only specialist changes;
- services unchanged;
- date/time unchanged;
- duration unchanged;
- booked price unchanged.

For eligible specialists use:
- `واجد شرایط برای همه خدمات نوبت`
- `در دسترس برای کل بازه زمانی نوبت`

Replace technical wording like `تنظیم بر اساس صلاحیت فنی همزمان` / `آماده ثبت نهایی` with:
- `متخصصان واجد شرایط`
- `آماده تأیید`

## 4. Same appointment snapshot across reassignment states

Use on both reassignment and invalid/unavailable screens:
- reference ID: `ARA-84921`
- customer: `سحر دانش‌پژوه`
- mobile: `۰۹۱۲۳۴۵۶۷۸۹`
- date: `دوشنبه، ۱۸ اردیبهشت`
- time: `۱۰:۰۰ الی ۱۲:۱۵`
- duration: `۱۳۵ دقیقه`
- booked total: `۱,۶۰۰,۰۰۰ تومان`
- payment: `پرداخت در سالن`
- current specialist: `پروانه رادمنش`

Keep the same booked services across both screens.

## 5. Invalid/unavailable state

Use only:
- `این متخصص برای همه خدمات این نوبت واجد شرایط نیست.`
- or `این متخصص برای کل بازه زمانی نوبت در دسترس نیست.`

State:
**`نوبت فعلی بدون تغییر باقی می‌ماند.`**

Actions:
- `مشاهده متخصصان واجد شرایط`
- `انصراف و بازگشت به جزئیات نوبت`

Remove credential/legal/calendar-system/marketing wording.

## 6. Concurrent-change conflict

Remove:
- server/system/locking/platform language;
- `Booking Conflict Resolver`;
- `تغییر همزمان در سرور`;
- `تأیید نهایی و قفل نوبت`;
- `برای حفظ صحت داده‌ها`;
- `آخرین وضعیت رسمی و معتبر سیستم`;
- `سامانه یکپارچه نوبت‌دهی`;
- unrelated salon marketing image/content.

Use exactly:

**`این نوبت از آخرین بازبینی شما تغییر کرده است. عملیات فعلی متوقف شد تا اطلاعات جدید بازنویسی نشود. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.`**

Show only a compact latest appointment summary:
- reference ID;
- customer;
- services;
- specialist;
- latest date/time;
- duration;
- booked total;
- `پرداخت در سالن`.

Actions:
- `بررسی آخرین وضعیت نوبت`
- `بازگشت به نوبت‌ها`

Do not silently overwrite.

## Required output

Return corrected versions of the same three Mobile 24D screens only.

No terminal-state screens.
No tablet.
No new capability.

If these corrections comply, Mobile 24D will be frozen.
