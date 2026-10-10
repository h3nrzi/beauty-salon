# Stitch Prompt 19 — Contact final patch

Patch only the current refined **Contact / تماس با ما** screen.

This is **not a redesign**.

## Select in Stitch

Select only the current refined Contact screen.

## Preserve exactly

Keep the current:

- desktop two-column layout;
- public header/navigation;
- page intro;
- address/contact/hours cards;
- visit-guidance card;
- map/directions panel;
- booking CTA;
- closing CTA;
- footer layout position;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

Do not make the page sparse.

## 1. Replace the stale footer content

Keep one footer only, using the neutral frozen public-footer pattern.

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

- `شمال تهران`;
- exact Zafaraniyeh address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`;
- copyright wording that includes `تهران، زعفرانیه`.

## 2. Replace the salon-atmosphere image

The current salon image contains visible embedded business-like text/signage.

Replace only that image with a clean, realistic salon-interior photograph.

Image direction:

- warm contemporary salon interior;
- soft natural light;
- calm neutral palette;
- no visible phone number;
- no address;
- no opening hours;
- no prominent business signage text;
- no watermark;
- no UI screenshot;
- no collage.

Keep the card layout and size unchanged.

## 3. Contact-label cleanup

Replace:

`پاسخگویی و مشاوره`

with:

**`راه ارتباطی`**

Keep the card title:

`تلفن سالن`

Supporting copy may say:

**`برای پرسش درباره خدمات، هماهنگی و راهنمایی دسترسی می‌توانید با سالن تماس بگیرید.`**

Do not create a consultation product.

## 4. Hours placeholder cleanup

Keep:

`ساعات کاری سالن`

Use:

**`ساعات کاری — اطلاعات نهایی پیش از انتشار تکمیل می‌شود`**

Supporting copy:

**`جزئیات ساعات کاری نهایی سالن در این بخش نمایش داده می‌شود.`**

Do not mention calendar-system implementation.

## 5. Neutral atmosphere caption

Replace wording equivalent to:

`محیط آرام سالن آرا — فضایی پیراسته و دور از شلوغی برای آسودگی مراجعین.`

with something neutral such as:

**`نمایی از فضای داخلی سالن آرا.`**

Do not make quality/privacy/exclusivity guarantees.

## Keep already-correct content

Keep:

- neutral address placeholder;
- neutral phone placeholder;
- neutral hours placeholder;
- map placeholder;
- `راهنمای مراجعه و رزرو`;
- `رزرو نوبت`;
- no open-now state;
- no private parking/elevator claims;
- no restrictive access policy.

## Required output

Return exactly one corrected:

- **Contact — desktop/default**

No mobile/tablet.
No live open/closed state.
No map interaction state.
No alternate version.
No new feature.

If these corrections are applied without visual drift, Contact desktop/default will be frozen.
