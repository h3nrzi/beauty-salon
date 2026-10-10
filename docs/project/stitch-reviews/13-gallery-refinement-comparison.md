# Stitch Review 13 — Gallery refinement comparison

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (13).zip`  
**Compared against:** old Gallery from `stitch_salon_visual_baseline (12).zip`  
**Package SHA-256:** `865f2362053e5a5ccde71f8800e2c24899be2c8e142df77e8d4d8c4e3eadc25d`  
**Decision:** **Gallery is substantially improved, but one visual blocker remains before freeze.**

## Old vs new

The new Gallery preserves the useful structure of the old page while removing most of the scope/content drift.

### Preserved correctly

- six-item desktop portfolio;
- balanced 3-column × 2-row composition;
- image-first cards;
- category chips;
- specialist attribution;
- concise per-item metadata;
- clear per-card CTA;
- editorial page intro;
- public header/footer structure.

### Improved correctly

The new version removes or avoids the old page's major semantic problems:

- no `متخصصان بین‌المللی`;
- no `بدون تخریب فولیکول`;
- no `ارگانیک` positioning;
- no lymphatic/collagen/physiological claims;
- no `رزرو مشاوره` workflow;
- no face-analysis / sensitivity-test / digital-draft funnel;
- no legal/media-consent marketing claims;
- closing section is now grounded in:
  - viewing services;
  - choosing a specialist;
  - booking an appointment.

This is a clear improvement.

## Visual blocker

### One gallery card uses a broken / screenshot-like image

The lower-middle card:

`لایت مو و استایل`

contains an image that visibly looks like a screenshot of another page/interface embedded inside the card rather than a natural portfolio photograph.

This breaks the visual credibility of the Gallery and is inconsistent with the other five image-led cards.

Replace only that image with a natural, realistic salon portfolio photograph showing:

- styled/highlighted hair;
- soft natural light;
- no text;
- no UI;
- no screenshot inside the image;
- no watermark;
- no collage.

Keep the card's layout and metadata unchanged.

## Deterministic content cleanup

The footer still contains old fictional business facts:

- north-Tehran positioning;
- exact Zafaraniyeh address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

Because we already need one focused Gallery patch for the visual blocker, clean these footer literals in the same pass using the neutral public-footer wording already established for Services.

Do not change the footer layout.

## Freeze gate

Do not redesign Gallery.

Patch only:

1. the broken lower-middle portfolio image;
2. the stale footer literals.

If those are corrected while preserving the current six-card composition, **Gallery desktop/default can be frozen**.
