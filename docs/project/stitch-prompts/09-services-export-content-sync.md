# Stitch Prompt 09 — Services export/content sync

Patch only the current refined **Services / خدمات** screen.

This is **not a redesign**.

## Select in Stitch

Select only the current Services screen.

## Goal

Make the **visible Stitch screen** match the already-corrected semantic content so that the next exported `screen.png` and `code.html` are consistent.

Do not preserve stale visible text from the previous version.

## Preserve exactly

Keep:

- desktop layout;
- six service cards;
- category chips;
- three-column catalog;
- imagery;
- eligible-specialist presentation;
- booking CTAs;
- multi-service guidance block;
- header/navigation;
- footer layout;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

Do not reduce the catalog.

## Visible text must use the cleaned version

### Intro
Use:

- `فهرست خدمات و قیمت‌ها`
- `متخصصان ارائه‌دهنده`

If intro copy uses `تعرفه‌ها`, replace it with:

**`قیمت‌ها`**

### Catalog labels
Use:

- `فهرست خدمات`
- `نمایش ۶ خدمت`
- `قیمت خدمت`

Do not show:

- `خدمات فعال`
- `خدمت اعلام‌شده`
- `تعرفه قطعی`
- `تعرفه رسمی`

### Payment wording
Use exactly:

**`پرداخت در سالن`**

Do not show:

- `شیوه پرداخت حضوری در سالن`
- payment timing/state wording.

### Service descriptions
Keep neutral beauty-service descriptions only.

Do not show:

- material/certification claims;
- proprietary formulas;
- clinical/therapeutic claims;
- lymphatic massage;
- physiological strengthening claims.

### Footer
The visible footer must use neutral placeholders:

- `نشانی سالن — اطلاعات نهایی در صفحه تماس`
- `اطلاعات تماس در صفحه تماس`
- `ساعات کاری سالن در صفحه تماس نمایش داده می‌شود`
- `خدمات سالن`
- `رزرو نوبت`

Do not show exact fictional address, phone, opening hours or north-Tehran positioning.

## Export consistency requirement

The next export must have:

- visible `screen.png` matching the cleaned text;
- paired `code.html` containing the same visible semantics.

No visual redesign.

## Required output

Return exactly one corrected:

- **Services — desktop/default**

No mobile/tablet.
No alternate version.
No filter states.
No booking states.
No edge states.

If screenshot and HTML are synchronized, Services desktop/default will be frozen.
