# Stitch Prompt 03 — Final Home consistency pass

Apply a final consistency pass to the existing **آرا / Soft Editorial Home**.

Do not redesign the Home page. Keep the accepted visual direction, section order, imagery rhythm, 3-service curation, specialist preview, gallery composition and overall spacing.

The goal is to produce a **single coherent Home/design-system baseline candidate** across desktop and mobile.

## 1. Keep product actions consistent on desktop and mobile

Both desktop and mobile headers must provide clear access to:

- «وقت‌های من»
- «رزرو وقت»

Mobile must also keep the menu trigger and access to the public navigation.

Do not hide My Appointments at any normal mobile width.

## 2. Use one booking summary everywhere

Use the same approved product summary on desktop and mobile:

1. انتخاب خدمات
2. انتخاب متخصص یا هر متخصص در دسترس
3. انتخاب تاریخ و ساعت
4. تأیید شماره موبایل
5. مرور و تأیید نهایی

Retain:
- پرداخت در سالن
- بدون پرداخت اینترنتی

Remove:
- SMS confirmation promises;
- “پکیج” wording;
- any implication of manual salon approval or later coordination after a successful booking.

## 3. Keep positioning as a beauty salon

Use wording equivalent to:

**سالن زیبایی بانوان آرا**

Do not introduce:
- spa;
- atelier;
- clinic;
- medical/clinical positioning.

## 4. Neutralize unsupported marketing claims

Do not state unapproved facts such as:
- “نمونه‌های واقعی و بدون فیلتر”;
- guarantees of zero waiting;
- guaranteed hygiene/material standards;
- certificates, awards, organic/vegan claims or similar proof claims.

Use neutral placeholder copy focused on:
- calm experience;
- clear scheduling;
- transparent time and price;
- professional service;
- specialist choice;
- visual portfolio.

## 5. Treat business details as placeholders

Address, phone and hours may stay for composition, but label them as mock/placeholder data in the design/export.

They must not read as approved production facts.

## 6. Legal/privacy links

Either remove legal/privacy links from this baseline, or label them clearly as placeholder/future destinations.

Do not present uncreated legal content as published.

## 7. Use explicit Persian-capable typography

For Persian visible text:

- Use Vazirmatn for functional UI/body.
- For editorial headings, use an explicitly Persian/Arabic-capable display font available in Stitch, or use a refined Vazirmatn hierarchy.

Do not rely on `Noto Serif` alone for Persian headings if that causes fallback.

Production font packaging/licensing remains for later engineering review.

## 8. Normalize accent semantics

Keep the visual palette, but define one primary action terracotta consistently.

Recommended baseline semantic:
- Primary action: `#9E5A4E`
- Hover/pressed: a darker terracotta
- Supporting warm neutral/accent: separate secondary value

Update design-system notes/tokens so “primary” and “primary-container” do not contradict the prose.

## 9. Preserve Home curation

Keep exactly 3 selected service previews on Home.

Do not reintroduce:
- category filters;
- a full service catalog;
- packages.

Keep a clear «مشاهده همه خدمات» path.

## 10. Export realistic responsive evidence

Provide:
- desktop Home around 1440 px wide;
- mobile Home around 390 px wide.

The mobile screenshot must be a real handset-sized viewport, not an ultra-narrow compressed image.

## Output

Return:
1. final desktop Home;
2. final mobile Home;
3. updated design-system notes reflecting typography/navigation/color corrections.

Do not add any new page, feature, role, business rule or architecture decision.

This is a consistency/finalization pass. If the result satisfies these corrections, the Home + initial design system can be frozen as the first visual baseline.
