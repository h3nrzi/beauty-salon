# Stitch Review 09 — Services export/content sync

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (9).zip`  
**Package SHA-256:** `624e7fd9b64220d396fac04b8e7a752da78e3c7369bf37e57b6b0a2ba62c4eeb`  
**Decision:** **Freeze Services desktop/default.**

## Export consistency

The visible `screen.png` now matches the cleaned `code.html` semantics.

Verified visible/content alignment includes:

- `فهرست خدمات و قیمت‌ها`;
- `متخصصان ارائه‌دهنده`;
- `قیمت خدمت`;
- `فهرست خدمات`;
- `نمایش ۶ خدمت`;
- `پرداخت در سالن`;
- neutral footer placeholders;
- no exact fictional address/hours/contact details;
- no stale `تعرفه رسمی / قطعی` wording;
- no spa/clinical/material-certification literals targeted by the previous review.

## Frozen visual structure

Accepted:

- desktop public header/navigation;
- six-card service catalog;
- category chips;
- balanced three-column grid;
- service image treatment;
- name + neutral description;
- duration + price metadata;
- eligible-specialist presentation;
- `رزرو این خدمت` CTA;
- multi-service guidance block;
- public footer;
- typography/spacing/card/button language aligned with the frozen Home and design system v2.

## Frozen product semantics

Accepted:

- multiple services may be selected;
- all services in one booking must be performable by one specialist;
- selected services are consecutive;
- duration and total price are derived from selected services;
- payment context is `پرداخت در سالن`;
- no reviews/ratings;
- no online payment/checkout;
- no compatibility-error state yet.

## Freeze boundary

This freezes **Services — desktop/default** only.

It does not freeze:

- service fixture names/prices as production data;
- media as production-cleared assets;
- filter interaction states;
- multi-select/compatibility states;
- mobile/tablet;
- loading/empty/error states.

Next page: Specialists default state.
