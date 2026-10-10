# Stitch Prompt 16 — About final patch

Patch only the current refined **About / درباره آرا** screen.

This is **not a redesign**.

## Select in Stitch

Select only the current refined About screen.

## Preserve exactly

Keep the current:

- desktop layout;
- header/navigation;
- editorial story structure;
- imagery;
- three highlight cards;
- four values cards;
- salon-atmosphere section;
- team section;
- closing CTA;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

Do not make the page sparse.

## 1. Remove the duplicate footer

The current page has two footer blocks.

Delete the stale second footer completely.

Keep only **one** footer using the neutral v2 public-footer structure.

The remaining footer should use:

- `نشانی سالن — اطلاعات نهایی در صفحه تماس`
- `اطلاعات تماس در صفحه تماس`
- `ساعات کاری سالن در صفحه تماس نمایش داده می‌شود`
- `خدمات سالن`
- `متخصصان آرا`
- `رزرو نوبت`
- `پیگیری نوبت‌ها`

Do not show:

- north-Tehran positioning;
- exact address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

## 2. Soften absolute / unsupported wording

Replace:

`تمرکز بر تجربه آرام و هماهنگی بی‌نقص`

with:

**`تمرکز بر تجربه‌ای آرام و هماهنگ`**

Replace any wording equivalent to:

`بدون ابهام و هزینه‌های پیش‌بینی‌نشده`

with:

**`نمایش روشن قیمت، مدت و جزئیات هر خدمت پیش از رزرو`**

Replace any wording equivalent to:

`پایبندی به زمان‌بندی دقیق مراجعین و برنامه‌ریزی پیوسته برای جلوگیری از معطلی`

with:

**`برنامه‌ریزی روشن نوبت‌ها و احترام به زمان مراجعین`**

Replace wording equivalent to:

`حفظ استانداردهای دقیق، محیطی امن و حرفه‌ای`

with neutral wording such as:

**`ارائه خدمات با دقت، هماهنگی و توجه به جزئیات`**

## 3. Neutral footer/brand description

Remove:

- `محیطی اختصاصی و برگزیده`
- exclusivity/prestige wording.

Use neutral wording such as:

**`سالن زیبایی آرا؛ فضایی برای معرفی خدمات، انتخاب متخصص و رزرو ساده نوبت.`**

## 4. No visible spa label

If the word `spa` is visible anywhere in the customer-facing UI, remove it.

Do not position آرا as a spa or clinic.

If `spa` is only an internal icon token and not visible, leave the icon implementation alone.

## Keep already-correct content

Keep:

- `هر متخصص در دسترس`;
- non-numeric product highlights;
- four grounded values;
- neutral team wording;
- `مشاهده متخصصان`;
- `مشاهده خدمات`;
- `رزرو نوبت`;
- no mandatory consultation;
- no international/certification claims.

## Required output

Return exactly one corrected:

- **About — desktop/default**

No mobile/tablet.
No alternate version.
No new page.
No edge states.

If the duplicate footer and remaining literals are corrected without visual drift, About desktop/default will be frozen.
