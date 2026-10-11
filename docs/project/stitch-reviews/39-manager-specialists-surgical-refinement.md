# Stitch Review 39 — Manager Specialists surgical refinement

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (38).zip`  
**Compared against:** old Manager Specialists from `stitch_salon_visual_baseline (37).zip`  
**Decision:** **Visual structure accepted; one source-state cleanup remains before freeze.**

## What improved correctly

The surgical refinement worked and the old page remains clearly recognizable.

Accepted visible changes:

- KPI/analytics cards removed;
- vertical space collapsed cleanly;
- page is now focused on specialist catalog management;
- weekly-schedule column removed;
- online-booking-status column removed;
- table reduced to the right default columns:
  - `متخصص`
  - `حوزه فعالیت`
  - `خدمات قابل ارائه`
  - `عملیات`
- `مستر / ارشد / فیشیال / تراپی / VIP` language removed;
- specialist expertise is neutral;
- service chips are substantially cleaner;
- one clear `ویرایش` action remains per row;
- lower note correctly points schedules/breaks/time off to their dedicated areas;
- Manager shell geometry remains consistent with the frozen operational pages.

The visible desktop layout is good and should not be redesigned.

## Remaining blocker — hidden add-specialist form is embedded in this default export

The visible screenshot only shows the default list, but `code.html` also contains a hidden add-specialist modal with fields such as:

- `افزودن عضو جدید به تیم`
- `نام و نام خانوادگی`
- `حوزه فعالیت`
- `خدمات قابل ارائه`
- `ثبت متخصص`

Prompt 38 explicitly scoped this export to the **default Manager Specialists list** and said:

- no add-specialist form;
- no edit-specialist form.

The add form has not been reviewed or designed as a separate state yet.

A frozen default reference should not silently include an unreviewed hidden state.

## Small fixture cleanup

The top bar still contains a hard-coded:

`امروز: پنج‌شنبه ۲۴ آبان`

As on other Manager pages, avoid freezing a literal static fixture as dynamically “today”.

Use:

`پنج‌شنبه ۲۴ آبان`

The actual salon-local current date can be rendered during engineering.

## What should remain unchanged

Do not change:

- Manager sidebar;
- page header;
- add-specialist CTA position;
- search;
- expertise chips;
- six-row table;
- portraits;
- specialist names;
- expertise/service-chip hierarchy;
- edit action;
- lower guidance;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

## Freeze gate

Patch only:

1. remove the hidden add-specialist modal/form and its modal-opening script from this default export;
2. keep the `افزودن متخصص جدید` CTA visually present but do not render its form state here;
3. remove the literal `امروز:` prefix from the static date fixture.

If those are corrected without visual drift, **Manager Specialists desktop/default can be frozen**.
