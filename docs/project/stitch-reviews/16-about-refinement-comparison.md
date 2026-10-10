# Stitch Review 16 — About refinement comparison

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (17).zip`  
**Compared against:** old About from `stitch_salon_visual_baseline (16).zip`  
**Package SHA-256:** `b4eb2ef09ee68eacfd49f2dd9a10effc095237620868634dc14a8968549306e7`  
**Decision:** **About is substantially improved, but one final visual/content patch is required before freeze.**

## Old vs new

The new About keeps the useful editorial depth of the old page while removing most of the unsupported claims.

### Preserved correctly

- long-form editorial rhythm;
- strong story section;
- salon-atmosphere photography;
- three visual highlight cards;
- four-value section;
- team section;
- closing CTA;
- public header/footer family.

### Improved correctly

The new version removes or avoids many old problems:

- no founding-year story;
- no specialist-count / percentage statistics;
- no Zafaraniyeh prestige story in the main content;
- no international academy / Milan / Paris / Dubai claims;
- no organic/material-certification claims;
- no mandatory 30-minute consultation workflow;
- no standalone consultation CTA;
- no senior/master hierarchy in the visible team copy;
- highlights are now product-oriented rather than invented numeric stats.

## Remaining blocker 1 — duplicated footer

The exported page visibly contains **two footer blocks**.

The first footer uses the newer neutral placeholder language.

A second stale footer appears below it and reintroduces:

- `شمال تهران`;
- exact Zafaraniyeh address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

This is a clear visual/export defect and must be fixed before freeze.

Keep only **one** footer: the neutral v2 public footer.

## Remaining blocker 2 — unsupported absolute/quality wording

A few visible literals are still stronger than the frozen product contract.

Examples include:

- `هماهنگی بی‌نقص`;
- `بدون ابهام و هزینه‌های پیش‌بینی‌نشده`;
- `پایبندی به زمان‌بندی دقیق ... برای جلوگیری از معطلی`;
- `حفظ استانداردهای دقیق، محیطی امن و حرفه‌ای`;
- footer phrase `محیطی اختصاصی و برگزیده`.

These should be softened to grounded product/brand language.

Suggested direction:

- `تجربه‌ای آرام و هماهنگ`;
- `نمایش روشن قیمت و مدت هر خدمت`;
- `برنامه‌ریزی روشن نوبت‌ها و احترام به زمان`;
- `ارائه خدمات با دقت و توجه به جزئیات`;
- neutral salon description without `اختصاصی / برگزیده`.

## Remaining blocker 3 — icon/label semantics

The hero/story area contains the Material icon token `spa`.

If it is only an icon implementation name and does not render as visible text, no issue.

If the visible UI shows the word `spa`, remove it. The brand should not be positioned as a spa.

## What should remain unchanged

Do not redesign:

- page structure;
- image composition;
- highlights;
- values cards;
- salon-space image grid;
- team block;
- closing CTA;
- typography;
- spacing;
- colors;
- card/button language.

## Freeze gate

Patch only:

1. remove the duplicate stale footer entirely;
2. soften the remaining absolute/unsupported literals;
3. ensure `spa` is not visible as customer-facing text.

If these are corrected without visual drift, **About desktop/default can be frozen**.
