# Stitch Review 40 — Manager Specialists default-state cleanup

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (39).zip`  
**Decision:** **Freeze Manager Specialists desktop/default.**

## Final verification

The visible UI remains unchanged from the accepted surgical refinement and the default-state cleanup is now sufficiently complete.

Verified:

- no hidden add-specialist modal markup remains;
- no add-specialist form fields remain in the exported HTML;
- no `افزودن عضو جدید به تیم` / `ثبت متخصص` hidden state remains;
- the visible `افزودن متخصص جدید` CTA remains;
- static date wording is now `پنج‌شنبه ۲۴ آبان` without the misleading `امروز:` prefix;
- no KPI cards;
- no weekly-schedule column;
- no online-booking-status column;
- no senior/master/clinical/VIP wording;
- one clear `ویرایش` action per row;
- lower guidance correctly points schedules, breaks and time off to their dedicated sections.

## Deterministic source cleanup deferred

A small dead JavaScript block still queries non-existent modal elements:

- `add-modal`
- `close-modal-btn`
- `cancel-modal-btn`
- `submit-modal-btn`

Because the modal markup is gone and the script safely no-ops when those elements are absent, this does not affect the visible or interactive default baseline.

Remove that dead modal-control script during export audit / engineering cleanup.

Do not reopen Stitch for this.

## Frozen visual structure

Freeze:

- Manager operational sidebar;
- page header;
- `افزودن متخصص جدید` CTA;
- search;
- expertise/category chips;
- six-row specialist table;
- portrait + specialist identity;
- neutral expertise;
- `خدمات قابل ارائه` chips;
- one `ویرایش` action per row;
- lower guidance;
- v2 operational typography/spacing/control language.

## Frozen semantic baseline

- Manager manages specialist records;
- specialist list exposes identity, expertise and services each specialist can provide;
- schedules are not duplicated here;
- breaks/time off are not duplicated here;
- no live availability/attendance analytics;
- no HR/personnel dashboard;
- no hidden add/edit form is part of the frozen default state.

## Freeze boundary

This freezes **Manager Specialists — desktop/default** only.

It does not freeze:

- add-specialist form;
- edit-specialist form;
- schedules;
- breaks;
- time off;
- responsive variants;
- fixture specialist/service data.

Next page: Manager Salon Hours. Per workflow, review its old version before writing a refinement prompt.
