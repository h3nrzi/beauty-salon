# Stitch Review 10 — Specialists old-version assessment

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (10).zip`  
**Purpose:** Review the existing Specialists page before writing the refinement prompt.

## Current page structure

The old Specialists page already has a useful desktop information architecture:

- public header/navigation;
- page intro;
- one top-level specialist-choice guidance block;
- six specialist cards in a 3-column × 2-row grid;
- portrait-led cards;
- name + expertise;
- eligible-service chips;
- direct booking CTA per specialist;
- bottom informational/CTA block;
- public footer.

This is a good content-density baseline and should be preserved during refinement.

## What should be preserved

### 1. Six-card desktop grid

The page already feels complete as a specialist catalog.

Preserve:

- six visible specialist cards;
- balanced three-column desktop density;
- consistent portrait ratio;
- clear card CTA;
- eligible-service chips.

Do not collapse this page into one featured specialist or a sparse prototype.

### 2. Specialist/service relationship

The old cards clearly show which services each specialist can perform.

This is valuable and should remain easy to scan.

### 3. Direct booking path

`رزرو نوبت با این متخصص` is a good default-state action.

Keep a clear specialist-specific booking CTA.

### 4. Top-level “no specific specialist” path

The old page already makes room for a non-specific-specialist option.

The concept should remain, but the semantics must be corrected from “first available” to the actual product path:

`هر متخصص در دسترس`

## What should improve

### 1. “First available / first empty slot” semantics are wrong

Current page contains:

- `اولین متخصص در دسترس`
- `انتخاب اولین وقت خالی`

The frozen product concept is not first/fastest availability.

Use:

**`هر متخصص در دسترس`**

This is a first-class choice where the booking flow can later assign an eligible available specialist.

Do not imply fastest/earliest/best-match behavior.

### 2. Senior/master hierarchy should be removed

Current examples include:

- `متخصص ارشد`
- `کارشناس ارشد`

v1 does not define public specialist ranking/hierarchy.

Use neutral expertise labels only.

### 3. Clinical / health / therapy language is too strong

Current page contains:

- `سلامت پوست`
- `پاکسازی عمیق`
- `احیا و تراپی مو`
- `بوتاکس مو`
- `پروتئین تراپی`
- `کراتین احیا`

These push the page toward therapeutic/clinical positioning.

Use ordinary beauty-service language and neutral expertise.

### 4. Spa / permanent-makeup wording needs caution

Current page includes:

- `لاین ناخن و اسپا`
- permanent-makeup / microblading content.

The new refined page should stay within neutral salon-service language and avoid turning the brand into a spa/clinic.

### 5. “Authorized services” wording is wrong

Current cards say:

`خدمات مجاز`

This sounds like licensing/authorization.

Use:

- `خدمات قابل ارائه`
- or `خدمات این متخصص`

### 6. Certification/material/health claims must be removed

Bottom block currently says:

- `تعهد به استانداردهای بین‌المللی مراقبت`
- official specialist certificates;
- best biological materials;
- hygiene-standard claims.

These are unsupported claims and should not be part of the refined page.

Replace the block with grounded product guidance, for example explaining:

- choose a specific specialist; or
- continue with any available specialist.

### 7. Footer contains unsupported business facts

Current footer contains:

- north-Tehran prestige wording;
- exact Zafaraniyeh address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

Use the neutral frozen public-footer pattern instead.

## Refinement target

The new Specialists page should combine:

- **old Specialists** for catalog density / information architecture;
- **frozen Home + Services** for visual language;
- corrected product semantics for specialist choice and public content.

The page should still feel like a complete six-person specialist catalog, not a sparse editorial feature page.
