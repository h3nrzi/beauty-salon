# Stitch Review 05 — Home final literal pass

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (5).zip`  
**Package SHA-256:** `396055d00b1784a7bc65f91cc99bab536ea3e55bed57b801a69d71a272b26200`  
**Decision:** **Freeze Home default state.**

## Why freeze now

The page is visually coherent and matches the frozen v2 design system.

The remaining differences are deterministic text substitutions, not design uncertainty.

Per the v2 workflow, we stop regenerating a good screen when only literal cleanup remains.

## Accepted Home structure

Frozen:

- public desktop header/navigation;
- hero composition;
- editorial intro section;
- selected-services section;
- selected-specialists section;
- selected-gallery strip;
- product-benefit section;
- closing booking CTA;
- public footer;
- typography scale;
- spacing rhythm;
- card language;
- button hierarchy;
- imagery treatment;
- overall Soft Editorial direction.

## Product semantics already corrected

Accepted:

- specific specialist or `هر متخصص در دسترس`;
- multi-service wording uses consecutive / `پشت‌سرهم`;
- reminder/notification promise removed;
- pricing benefit reflects visible duration/price and retained booked amount;
- no ratings/reviews;
- no online payment/checkout.

## Remaining deterministic text cleanup

Do **not** reopen Stitch for these.

Normalize during export audit / engineering handoff:

1. `محیط آرام و اختصاصی بانوان`
   → use neutral product wording without an exclusivity/quality claim.

2. `پرداخت در سالن پس از ارائه خدمت`
   → `پرداخت در سالن`

3. footer label `خدمات تخصصی`
   → `خدمات سالن` or `خدمات`

These literals do not affect layout, hierarchy, interaction or visual design.

## Freeze boundary

This freezes **Home — desktop/default visual and interaction baseline**.

It does not freeze:

- fixture images as production media;
- fictional names/prices/business facts;
- mobile/tablet composition;
- loading/error/alternate states.

Next page: Services default state.
