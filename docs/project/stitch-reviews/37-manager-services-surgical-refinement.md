# Stitch Review 37 — Manager Services surgical refinement

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (36).zip`  
**Package SHA-256:** `6d00d41f78cceabbc0fb84bd7c2cf9875848b56d26eb0e5aefad30765783e079`  
**Compared against:** old Manager Services from `stitch_salon_visual_baseline (34).zip`  
**Decision:** **Freeze Manager Services desktop/default.**

## Why this pass is accepted

The surgical strategy worked.

The new page remains immediately recognizable as the old Manager Services workspace, while removing the major scope/content problems that caused the earlier rejected redesign.

### Preserved correctly

- same Manager sidebar geometry;
- same top-bar/header structure;
- same heading/action relationship;
- same search/category-control block;
- same compact six-row table;
- same table density and overall proportions;
- same pagination placement;
- same lower guidance location.

The page did not drift into a new composition.

## Improvements accepted

Removed:

- top KPI/analytics cards;
- redundant view action;
- calendar-guide CTA;
- system/portal synchronization explanation;
- complex active/published-style wording.

Corrected:

- `تعرفه` → `قیمت`;
- `متخصصان مجاز` → `متخصصان ارائه‌دهنده`;
- one simple `قابل رزرو` control;
- neutral service categories;
- treatment/spa terminology substantially reduced;
- one clear `ویرایش` action per row;
- guidance reduced to the product-level rule that disabling booking for a service must not alter already-confirmed appointments.

## Visual quality

The table is materially stronger than the rejected Prompt 35 output.

Accepted:

- all six services use a consistent small-thumbnail treatment;
- no mixed oversized decorative icon tiles;
- duration/price/specialist columns remain easy to scan;
- bookability control is compact;
- row height remains operational rather than card-like;
- the page feels like the same Manager product family as frozen Manager Appointments.

## Deterministic cleanup deferred

Do **not** reopen Stitch for these fixture literals:

1. `کوتاهی و استایل ژورنالی`
   → normalize to `کوتاهی و استایل` if the production catalog uses the frozen public fixture.

2. `بالیاژ فرانسوی و رنگساژ`
   → normalize to `بالیاژ و رنگساژ` unless “فرانسوی” becomes approved real service data.

3. `دکتر هما صادقی`
   → remove the medical title and use a neutral specialist name.

4. Header fixture:
   `امروز: پنج‌شنبه ۲۴ آبان`
   → use actual salon-local current date in engineering or remove the literal `امروز:` from static fixture copy.

These are literal fixture/content cleanup only and do not affect the accepted visual structure.

## Frozen visual structure

Freeze:

- Manager operational shell;
- page header;
- add-service CTA;
- restrained sort control;
- search;
- category chips;
- six-row service-management table;
- service thumbnail treatment;
- category/duration/price columns;
- `متخصصان ارائه‌دهنده` presentation;
- `قابل رزرو` control;
- one `ویرایش` action per row;
- pagination;
- lower guidance block;
- v2 operational typography/spacing/control language.

## Frozen semantic baseline

- Manager can manage the service catalog;
- service list exposes name, category, duration, price, providers and booking availability;
- service price language is `قیمت`;
- specialist relationship uses `متخصصان ارائه‌دهنده`;
- one simple booking-availability state is enough for this baseline;
- disabling booking for a service must not change already-confirmed appointments;
- no analytics/reporting/CRM/finance behavior is introduced.

## Freeze boundary

This freezes **Manager Services — desktop/default — service catalog management** only.

It does not freeze:

- add-service form;
- edit-service form;
- validation/error states;
- service-state implementation model;
- responsive variants;
- fixture service/specialist data.

Next page: Manager Specialists. Per workflow, review its old version before writing a refinement prompt.
