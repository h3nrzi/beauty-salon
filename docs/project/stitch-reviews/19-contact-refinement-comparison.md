# Stitch Review 19 — Contact refinement comparison

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (19).zip`  
**Compared against:** old Contact from `stitch_salon_visual_baseline (15).zip`  
**Package SHA-256:** `02384f0f744144ac2a6ea18ac861b9a5ff1eec07e8379fbd576ec88ceb7a7de1`  
**Decision:** **Contact is substantially improved, but one final content/media patch remains before freeze.**

## Old vs new

The new Contact page keeps the useful information architecture of the old version while removing most of the unsupported facility and dynamic-state claims.

### Preserved correctly

- practical desktop two-column structure;
- separate address/contact/hours cards;
- large map/directions panel;
- visit guidance;
- clear booking CTA;
- public header/footer family.

### Improved correctly

The new version removes or avoids:

- `پذیرش فعال است` / open-now state;
- live phone-response timing;
- private elevator/parking claims;
- guest-parking claims;
- special/private entrance claims;
- restrictive access policy;
- dedicated support-center semantics;
- exact address/phone/hours in the main contact cards;
- provider-specific map decision in the main layout.

The main content is now much closer to the product contract.

## Remaining blocker 1 — stale footer

The visible page and `code.html` still contain the old footer with:

- `شمال تهران`;
- exact Zafaraniyeh address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`;
- copyright line with `تهران، زعفرانیه`.

This directly contradicts the neutral placeholder contact cards above it.

Keep only the neutral frozen public-footer pattern used by the other frozen public pages.

## Remaining blocker 2 — salon image contains embedded business-like text

The salon-atmosphere image visibly includes signage/text such as:

- `Ara Beauty Salon`;
- small contact/hours-style text.

Even though the image is placeholder media, it visually reintroduces pseudo-business facts into a page whose contact data is intentionally still neutral.

Replace that image with a clean salon-interior photograph containing:

- no embedded phone number;
- no hours;
- no address;
- no prominent signage text;
- no watermark/UI/collage.

Keep the image card position and layout unchanged.

## Small content cleanup

While making the final patch, simplify these literals:

- `پاسخگویی و مشاوره` → `راه ارتباطی`
- `جهت هماهنگی، پرسش درباره خدمات و راهنمایی دسترسی.` may remain, but do not imply a standalone consultation workflow.
- `زمان‌بندی پذیرش و ساعات کاری رسمی سالن بر اساس تقویم نوبت‌دهی تنظیم خواهد شد.` → use a simpler neutral placeholder sentence.
- `محیط آرام سالن آرا — فضایی پیراسته و دور از شلوغی برای آسودگی مراجعین.` → neutral atmosphere wording without a quality guarantee.

## What should remain unchanged

Do not redesign:

- two-column desktop architecture;
- contact cards;
- map placeholder;
- booking CTA;
- visit-guidance card;
- closing CTA;
- typography;
- spacing;
- colors;
- card/button language.

## Freeze gate

Patch only:

1. the stale footer;
2. the embedded-text salon image;
3. the few literals above.

If these are corrected without visual drift, **Contact desktop/default can be frozen**.
