# Stitch Review 02 — Combined placeholder baseline

**Reviewed:** 2026-10-10  
**Sources:**
- `stitch_salon_visual_baseline (1).zip`
- `stitch_salon_visual_baseline (2).zip`

**Decision:** **Whole-product placeholder baseline accepted. Visual system frozen for v2.**

The two ZIP files are treated as one logical Stitch export. Folder numbers reset inside each ZIP, so screen identity is mapped by visible page content rather than by `_1`, `_2`, etc.

## Combined coverage

### Public / customer
The first ZIP contains the complete public/customer baseline family:

- Home
- Services
- Specialists
- Gallery
- Contact
- About
- Booking — service-selection default
- My Appointments — upcoming default

### Operational
The second ZIP contains the operational family:

- Manager Appointments
- Manager Services
- Manager Specialists
- Salon Hours
- Specialist Schedules
- Breaks
- Time Off
- Staff / Specialist Assigned Appointments

The operational ZIP contains two Staff/Specialist appointment variants. This is an extra generated variant, not a missing product page. It is not a baseline blocker. One canonical Staff page will be chosen/refined later.

## Visual-system decision

The family is coherent enough to freeze the shared visual language before page-by-page refinement.

Accepted characteristics:

- warm ivory / off-white / taupe surfaces;
- restrained terracotta / rose-brown brand accent;
- warm espresso primary text;
- editorial display typography paired with cleaner UI/body typography;
- native Persian / RTL composition;
- restrained borders and shadows;
- medium radii;
- controlled whitespace;
- editorial public pages;
- denser but visually related operational pages;
- consistent primary/secondary action treatment;
- compact status-chip language;
- one manager operational shell with a right-side navigation rail.

The generated `ara/DESIGN.md` from the export is useful as a design-system snapshot, but Product Definition remains authoritative over generated content and capabilities.

## Viewport note

Home, Gallery and About are currently narrower than the stronger desktop public screens.

This is **not** a reason to keep patching the baseline.

The new workflow intentionally freezes the shared visual language first, then refines each page one by one. Those pages will be normalized during their own refinement pass.

## Placeholder-content note

The generated screens still contain placeholder semantic drift such as:

- spa / treatment wording;
- unsupported claims;
- senior/master-style specialist wording;
- fictional business details.

These do not block the visual-system freeze.

They must be removed when each page is refined.

## Decision

Phase 1 is complete.

Do not generate more whole-product baseline patches.

Proceed to page-by-page default-state refinement, starting with Home.
