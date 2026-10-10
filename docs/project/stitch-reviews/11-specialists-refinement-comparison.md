# Stitch Review 11 — Specialists refinement comparison

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (11).zip`  
**Compared against:** old Specialists baseline from `stitch_salon_visual_baseline (10).zip`  
**Decision:** **Freeze Specialists desktop/default visual baseline.**

## Old vs new

The new version is a clear improvement over the old Specialists page while preserving the useful catalog structure.

### Preserved correctly

- six specialist cards;
- balanced 3-column × 2-row desktop grid;
- portrait-led presentation;
- eligible-service chips;
- direct `رزرو نوبت با این متخصص` CTA;
- complete specialist-catalog density;
- public header/footer family.

### Improved correctly

- `اولین متخصص در دسترس` / `اولین وقت خالی` replaced with the correct first-class path:
  - `هر متخصص در دسترس`
- top guidance is clearer and better integrated into the page;
- `خدمات مجاز` replaced with `خدمات قابل ارائه`;
- senior/master hierarchy removed;
- cards are visually cleaner and better aligned with frozen Home + Services;
- certification/material guarantee block was replaced by booking guidance;
- overall page now feels like the same public design system rather than a separate catalog template.

## Accepted visual structure

Freeze:

- page intro;
- `هر متخصص در دسترس` guidance block;
- six-card specialist grid;
- portrait proportions;
- expertise + service-chip hierarchy;
- specialist-specific booking CTA;
- bottom booking-guidance block;
- public footer layout;
- typography, spacing, color, border/radius/shadow language.

## Remaining deterministic content cleanup

Do **not** reopen Stitch for these. Normalize during export audit / engineering handoff.

### 1. Footer business facts

The footer still contains old fictional facts:

- north-Tehran positioning;
- exact Zafaraniyeh address;
- exact phone;
- exact hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

Normalize to the same neutral public-footer placeholders already used for frozen Home / Services.

### 2. Remaining treatment-style service labels

A few card literals still use stronger treatment language, including:

- `پروتئین تراپی`;
- `احیای مو`;
- `کراتینه مو`;
- some `فیشیال` wording.

Use neutral beauty-service wording where needed.

### 3. “System assigns” wording

The bottom block says the scheduling coordination is handed to “the system”.

Keep the product concept but use simpler customer-facing wording during implementation:

- customer chooses `هر متخصص در دسترس`;
- booking continues using specialists eligible for the selected services and actually available.

Do not freeze an assignment algorithm or implementation mechanism from the Stitch copy.

## Freeze boundary

This freezes **Specialists — desktop/default visual and interaction baseline**.

It does not freeze:

- specialist fixture names;
- production portraits/media rights;
- exact service labels;
- actual availability;
- mobile/tablet;
- specialist-detail state;
- date/time states.

Next page: Gallery — but per workflow, review the old Gallery version first before writing/refining its prompt.
