# Stitch Review 34 — Manager Appointments final readability re-check

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (33).zip`  
**Package SHA-256:** `f88d6609a60b654e68048ce56fa1cf9d0bbbc61086f145dfe1f8567c0d51b6d1`  
**Compared against:** previous refined Manager Appointments from `stitch_salon_visual_baseline (32).zip`  
**Decision:** **Freeze Manager Appointments desktop/default.**

## Final readability verification

The blockers from Review 33 are resolved.

Accepted:

- date filter is fully readable: `پنج‌شنبه ۲۴ آبان`;
- specialist filter is fully readable: `همه متخصصان`;
- status filter is fully readable: `همه وضعیت‌ها`;
- quick lifecycle filters remain on one line with their counts;
- Services cells are wider and booked-service chips are readable;
- multi-service rows display both services without tall vertical stacking;
- hard-coded `امروز:` prefix is removed;
- manager navigation remains complete and readable;
- the five-row table remains compact and easy to scan.

## Scope verification

Still absent as required:

- manual / walk-in appointment creation;
- day-list export;
- live-update/system indicator;
- analytics/KPI cards;
- CRM/customer-profile actions;
- payment/refund/invoice operations.

The default row action remains:

`مشاهده جزئیات`

which keeps cancel/reschedule/reassign out of the list and in the detail flow.

## Frozen visual structure

Freeze:

- right-side Manager operational navigation;
- page header and manager identity area;
- search toolbar;
- date / specialist / status filters;
- quick lifecycle filters;
- five-row appointment table;
- customer + masked mobile presentation;
- specialist presentation;
- booked-service chips;
- duration/status/booked-amount columns;
- `مشاهده جزئیات` row action;
- pagination;
- v2 operational typography/spacing/card/control language.

## Frozen semantic baseline

- search supports customer name, mobile or appointment/reference ID;
- practical filters are date, specialist and lifecycle status;
- lifecycle vocabulary is limited to:
  - `تأییدشده`
  - `انجام‌شده`
  - `لغوشده`
  - `عدم حضور`;
- amount is the booked snapshot: `مبلغ ثبت‌شده`;
- list rows do not expose mutation actions directly;
- terminal statuses are visible but not reversible from this list;
- list counts are fixture navigation data, not analytics.

## Deterministic cleanup deferred

Do not reopen Stitch for these small presentation literals:

- shorten the search placeholder if needed in production so all three searchable concepts are visible, e.g. `نام، موبایل یا کد نوبت را جستجو کنید`;
- normalize duration display formatting during engineering if desired (for example human-readable Persian duration instead of `۲:۴۵ ساعت`).

These do not affect the accepted layout or interaction architecture.

## Freeze boundary

This freezes **Manager Appointments — desktop/default — appointment workspace** only.

It does not freeze:

- appointment detail;
- cancel;
- reschedule;
- specialist reassignment;
- stale/conflict states;
- staff view;
- responsive variants;
- fixture counts/data.

Next page: Manager Services. Per workflow, review the old version before writing its refinement prompt.
