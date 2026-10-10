# Stitch Review 04 — Home semantic cleanup

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (4).zip`  
**Package SHA-256:** `0eeb51660541cfcff1932bb81ff2fa3b3d2fccf51d640f718d8ad5ef3428d831`  
**Decision:** **Home is visually ready; one final literal/content patch remains before freeze.**

## What is now correct

The requested product-semantic corrections were mostly applied without damaging the accepted visual structure.

Accepted:

- `انتخاب متخصص یا هر متخصص در دسترس` now replaces first/fastest-available wording;
- multi-service language now uses `پیوسته و پشت‌سرهم`, not simultaneous service delivery;
- reminder/notification promise is removed;
- pricing benefit now correctly says duration/price are shown before booking and the booked amount is retained after confirmation;
- specialist cards no longer depend on detailed weekly schedules;
- the desktop Home composition remains visually consistent with the frozen v2 design system.

No layout or visual-system changes are needed.

## Remaining blockers

### 1. Unsupported geographic / exclusivity claims remain

The footer still says:

`پناهگاهی آرام برای زیبایی، اصالت و لطافت زنانه در محیطی اختصاصی و برگزیده در شمال تهران.`

and shows a precise fictional address:

`تهران، زعفرانیه، خیابان اعجازی، پلاک ۱۲`

The page is now in refinement/freeze stage, so these should not read as approved salon facts.

Use neutral placeholder wording.

### 2. Exact business hours remain as if factual

The footer contains:

- `شنبه تا پنج‌شنبه: ۹:۰۰ الی ۱۹:۰۰`
- `جمعه‌ها: با هماهنگی و نوبت قبلی`

These hours are not approved product facts.

For Home default-state freeze, use neutral placeholder text or generic contact-path wording rather than exact hours.

### 3. Payment timing is over-specified

The Home says:

`پرداخت در سالن پس از ارائه خدمت`

The frozen product rule is only:

`پرداخت در سالن`

Do not freeze before/after-service timing into the UI contract.

### 4. Unsupported salon-positioning literals remain

The Home still contains phrases such as:

- `سالن اختصاصی در تهران`
- `محیط آرام و اختصاصی بانوان`
- `سامانه اختصاصی ...`

These are stronger than necessary and may read as business/quality claims.

Prefer neutral product wording such as:

- `یک سالن زیبایی زنانه`
- `رزرو شفاف خدمات و متخصصان`
- `تجربه رزرو ساده و روشن`

### 5. A few service/section labels remain unnecessarily “specialized”

Phrases such as `لاین تخصصی رنگ`, `تیم تخصصی`, and `خدمات تخصصی` are not product-scope violations, but they add an unapproved marketing tone.

Use neutral `خدمات`, `متخصصان`, or simple expertise labels where possible.

## Freeze gate

Patch only the remaining literals above.

Do not change the Home structure, typography, imagery, spacing, card system, CTA hierarchy or footer layout.

If those content literals are corrected, **Home default state should be frozen**.
