# Stitch Review 08 — Services semantic cleanup

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (8).zip`  
**Package SHA-256:** `36c537870d585359858348f2175a214918d9104bf44222827f7840f09ef559ad`  
**Decision:** **Services is not frozen yet because the exported screenshot and HTML are inconsistent.**

## What is correct in the HTML

The generated `code.html` now contains most of the requested cleanup:

- `فهرست خدمات و قیمت‌ها`
- neutral `متخصصان ارائه‌دهنده`
- `قیمت خدمت`
- six service cards preserved
- neutral service descriptions
- `فهرست خدمات` / `نمایش ۶ خدمت`
- neutral footer placeholders instead of exact address/hours/contact data
- `خدمات سالن`
- `رزرو نوبت`

The page structure remains good and should not be redesigned.

## Blocking export mismatch

The paired `screen.png` still visibly shows older pre-cleanup content, including:

- exact fictional address / phone / opening hours;
- older footer wording;
- older service-description literals;
- older pricing/catalog labels.

This means the visual export is stale relative to the HTML.

A frozen visual reference cannot contain a screenshot that contradicts its paired source.

## Small final text normalization

While syncing the visible screen to the corrected HTML, also normalize these remaining literals:

- `تعرفه‌ها` → `قیمت‌ها`
- `شیوه پرداخت حضوری در سالن` → `پرداخت در سالن`

## Freeze gate

Do not redesign Services.

Patch/synchronize the current Services screen so the visible Stitch screen and next exported `screen.png` match the corrected source content.

Keep exactly:

- six service cards;
- category row;
- three-column desktop catalog;
- eligible-specialist presentation;
- multi-service guidance;
- header/footer layout.

If the next screenshot matches the cleaned content, **Services desktop/default can be frozen**.
