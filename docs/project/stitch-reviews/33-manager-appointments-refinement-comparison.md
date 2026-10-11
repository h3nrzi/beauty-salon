# Stitch Review 33 — Manager Appointments refinement comparison

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (32).zip`  
**Compared against:** old Manager Appointments from `stitch_salon_visual_baseline (31).zip`  
**Package SHA-256:** `5dfaad78a6657f79864c6736ce651ab023fcb81b4888fc181efb8c6bcf436fa0`  
**Decision:** **Manager Appointments is substantially improved, but one final readability/density patch remains before freeze.**

## Old vs new

The new page removes the major scope drift while preserving the strong operational structure.

### Preserved correctly

- right-side manager navigation;
- search;
- date / specialist / status filters;
- quick lifecycle filters;
- five-row appointment table;
- status chips;
- masked customer mobile;
- duration;
- booked amount;
- `مشاهده جزئیات`;
- pagination;
- compact desktop operations layout.

### Improved correctly

Removed:

- `ثبت نوبت حضوری جدید`;
- walk-in/manual appointment creation;
- `خروجی لیست روز`;
- `بروزرسانی زنده فعال است`;
- front-desk/walk-in intro copy;
- stale clinical/therapy service names.

Corrected:

- page intro is now `جستجو، بررسی و مدیریت نوبت‌های سالن.`;
- statuses use only the frozen lifecycle;
- price column is `مبلغ ثبت‌شده`;
- service labels are more neutral;
- header and filter date are internally consistent;
- counts remain fixture list counts rather than KPI cards.

## Remaining visual blocker 1 — filter labels are visibly truncated

The date and specialist filters are too narrow.

Visible examples:

- date appears as `پنج‌شنبه ۲۴...`;
- specialist appears as `همه متخصص...`.

These are primary operational controls and should be readable without ellipsis at the desktop baseline width.

The status filter fits, so the toolbar should be rebalanced rather than redesigned.

## Remaining visual blocker 2 — quick-filter chips wrap counts awkwardly

Some lifecycle quick filters break their count onto a second line.

Examples visually resemble:

- `لغوشده` then `(۴)` below;
- `عدم حضور` then `(۲)` below.

Each quick filter should remain a compact single-line chip.

## Remaining visual blocker 3 — service cells are too narrow

Service chips in the table wrap into tall narrow stacks.

This makes the table harder to scan and creates unnecessary row height.

The Services column should receive more horizontal space.

Good options:

- wider Services column;
- compact inline chips;
- concise wrapped text/chips in at most two lines.

Do not remove booked-service visibility.

## Remaining content cleanup — “today” should not be frozen as a literal fixture

The header currently says:

`امروز: پنج‌شنبه ۲۴ آبان`

and the date filter shows the same date.

The consistency is fixed, but the visual baseline should not freeze a hard-coded date as literal “today”.

Prefer:

- header pill: `پنج‌شنبه ۲۴ آبان`
- date filter: `پنج‌شنبه ۲۴ آبان`

or a neutral `تاریخ انتخاب‌شده` treatment.

The implementation can later render the actual salon-local current date when appropriate.

## What should remain unchanged

Do not redesign:

- manager shell;
- navigation;
- page header hierarchy;
- search;
- filter types;
- quick-filter vocabulary/counts;
- table columns;
- five fixture rows;
- status colors;
- detail action;
- pagination;
- typography/colors/card language.

## Freeze gate

Patch only:

1. toolbar width/readability;
2. single-line quick-filter chips;
3. Services-column readability;
4. remove literal `امروز:` from the hard-coded fixture date.

If these are corrected without visual drift, **Manager Appointments desktop/default can be frozen**.
