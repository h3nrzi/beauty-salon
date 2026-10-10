# Stitch Review 24 — Booking manual no-filter variant

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (23).zip`  
**Decision:** **Removing the category filter is accepted. Booking still remains open because the initial-state export is inconsistent.**

## Manual change accepted

The category/filter row was manually removed by the product owner.

This is accepted as an intentional design decision.

Why it works:

- the default Booking page shows only six representative services;
- all services remain visible at once;
- the page is easier to scan without an extra control row;
- filtering is not required for the v1 Booking service-selection step;
- the split desktop composition remains balanced.

Do **not** reintroduce category filters unless the catalog later grows enough to justify them.

## Improvements from Review 23

The new source fixes several earlier issues:

- all 6 visible services now exist in interaction metadata;
- cleaned service names are used consistently;
- keyboard interaction is present with `role="checkbox"`, `tabindex="0"`, Enter and Space support;
- remove buttons have accessible names;
- zero-selection summary logic exists;
- Continue can be disabled by the script;
- payment wording is now `پرداخت در سالن`;
- the filter UI is gone.

## Remaining blocker — initial visual state is still contradictory

The exported screenshot shows:

- **3 services selected**;
- three selected summary items;
- non-zero duration and price;
- enabled Continue CTA.

But the JavaScript state initializes with:

`selectedIds: new Set()`

and then calls `renderSummary()`, which expects:

- 0 selected;
- empty summary;
- zero totals;
- disabled Continue.

The static HTML itself still marks services 1, 2 and 6 as selected with `aria-checked="true"` and selected visual classes.

Because `renderSummary()` does not normalize every card's visual state on initial load, the source can produce a contradictory state:

- cards visually selected;
- summary empty;
- CTA disabled.

A frozen default state must not depend on script timing to become coherent.

## Required correction

The **static HTML and runtime state must both start at zero selection**.

Initial markup must show:

- all 6 cards unselected;
- `aria-checked="false"` on all service cards;
- unchecked visual controls;
- `۰ خدمت انتخاب‌شده`;
- empty summary message;
- `۰ دقیقه`;
- `۰ تومان`;
- disabled Continue CTA.

Then JavaScript may progressively enhance the interaction.

## Code cleanup

Because the filter UI was intentionally removed, remove the now-unused filter interaction script that queries `#categoryFilterBar`.

This is not a visual requirement, but keeping dead filter logic adds unnecessary divergence between the artifact and the intended product.

## Freeze gate

Preserve the no-filter layout.

Patch only the initial state + obsolete filter script.

If the next exported screenshot and HTML both represent the same true zero-selection state, **Booking desktop/default can be frozen again**.
