# Stitch Review 21 — Manager Appointments desktop semantic cleanup pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (7)(1).zip`  
**Package SHA-256:** `dd433f0e7f0b67937f18929c406fce1fce60f0f1fc12c339b75898fd759c6546`  
**Decision:** **Desktop is still not frozen.** Several screens are now clean enough structurally and semantically, but the requested semantic cleanup was not applied consistently across the full desktop set.

## Sequencing remains unchanged

Per product-owner decision:

1. finish and freeze **Manager Appointments — Desktop**;
2. only then move to mobile/tablet.

No mobile/tablet work is requested yet.

## Screens now close enough structurally

The following desktop patterns remain accepted and should not be redesigned:

- active appointment detail;
- reschedule date/time;
- stale reschedule recovery;
- invalid/unavailable reassignment;
- Completed read-only detail;
- No-show read-only detail;
- overall manager shell/navigation/table/detail language.

The remaining work is a targeted patch of specific screens/literals.

## Remaining desktop blockers by screen

### `_1` — workspace/list

Still contains:

- «ثبت نوبت دستی»;
- settlement-style column wording such as «مبلغ و تسویه»;
- a No-show row with an extra state like «در انتظار تعیین تکلیف».

Required correction:

- remove manual/new appointment creation;
- use «مبلغ ثبت‌شده نوبت» rather than settlement semantics;
- appointment status remains only Confirmed / Completed / Cancelled / No-show;
- payment context, if shown, is only «پرداخت در سالن».

### `_3` — search/filter result

This screen still contains major old scope drift:

- «ثبت نوبت جدید»;
- «در انتظار تایید»;
- «در حال پذیرش و ارائه»;
- customer membership date/history;
- lateness history;
- senior specialist wording;
- automatic SMS reminder;
- reception slip / print action;
- chair-management guidance;
- old helper copy about manager changes being allowed until 15 minutes before start.

This screen must be patched before freeze.

Keep only:

- search by name/mobile/reference ID;
- date/status/specialist filters;
- approved four statuses;
- appointment result information;
- neutral specialist expertise;
- open-detail action.

### `_6` — cancel confirmation

Still contains «آرایشگر ارشد».

Use neutral specialist wording only.

The confirmation must remain product-level and must not introduce role/credential hierarchy.

### `_7` — reschedule review

Still contains:

- «مرحله پیش‌ثبت (Pre-Commit)»;
- service fixture wording using «اسپا»;
- process wording that sounds more technical than customer/manager-facing UI needs.

Use:

- «مرور تغییر زمان» / «آماده تأیید»;
- neutral beauty-service fixtures;
- current time vs selected new time;
- fixed services/specialist/duration/booked price;
- pay at salon.

Do not expose pre-commit engineering terminology.

### `_10` — specialist reassignment

Still contains:

- «فاکتور»;
- «تسویه»;
- legal/executive-system wording around invariants.

Use product language only:

- booked total price stays unchanged;
- pay at salon;
- services/date/time/duration stay unchanged;
- assigned specialist changes after explicit confirmation.

No invoice/settlement product.

### `_11` — concurrent-change conflict

The conflict concept is accepted, but the screen still contains a customer/internal note and an unnecessary narrative history.

Complex internal notes/CRM-style history are outside v1.

Keep the state focused on:

- appointment changed since last review;
- operation stopped;
- show latest appointment state;
- review latest state;
- retry only after review.

Remove unrelated notes/history.

## Additional consistency cleanup

### “Archive” wording

Where Cancelled / Completed / No-show details use «بایگانی» as a product concept, prefer:

- «تاریخچه نوبت»
- «اطلاعات فقط‌خواندنی»

The product has appointment history; it does not need a separate archive subsystem.

### Neutral content fixtures

Avoid proof/clinical/wellness language.

Use ordinary beauty-service and specialist labels only.

## Freeze gate

No new screens are needed.

Desktop Manager Appointments can be frozen after a **targeted patch only** to the affected screens above.

Do not regenerate already-clean screens and do not redesign the desktop shell.
