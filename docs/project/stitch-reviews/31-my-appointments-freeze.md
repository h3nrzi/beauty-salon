# Stitch Review 31 — My Appointments future-date/export sync

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (30).zip`  
**Package SHA-256:** `8d67e2f1b0f6f524c0d2395610e018fb5b59b62e1b09a6a70d5311d5cb4743b8`  
**Decision:** **Freeze My Appointments desktop/default — upcoming appointments.**

## Final verification

The blockers from Review 30 are resolved.

Verified in both the visible screenshot and `code.html`:

- page eyebrow: `مدیریت نوبت‌ها`;
- current tab: `نوبت‌های پیش‌رو`;
- exactly 2 representative upcoming appointments;
- Appointment 1 date: `۲۵ مهر ۱۴۰۵`;
- Appointment 2 date: `۷ آبان ۱۴۰۵`;
- no weekday labels are shown, avoiding weekday/date mismatch;
- Appointment 1 duration: `۲ ساعت و ۴۵ دقیقه`;
- Appointment 2 duration: `۶۰ دقیقه`;
- status uses `تأییدشده`;
- price label uses `مبلغ ثبت‌شده نوبت`;
- payment context uses `پرداخت در سالن`;
- no system-sync block;
- neutral public footer;
- no exact fictional address/phone/hours;
- no VIP/loyalty/facility/hospitality drift.

The exported screenshot and source now represent the same cleaned upcoming-appointments state.

## Frozen visual structure

Freeze:

- public header/navigation;
- `نوبت‌های پیش‌رو` / `تاریخچه نوبت‌ها` tabs;
- two-column desktop utility layout;
- two upcoming appointment cards;
- appointment status/reference/date/time/duration hierarchy;
- specialist and booked-service presentation;
- `مبلغ ثبت‌شده نوبت` + `پرداخت در سالن`;
- `مشاهده جزئیات نوبت` CTA;
- guidance card;
- `تماس با سالن` path;
- `رزرو نوبت تازه` CTA;
- neutral public footer;
- v2 typography/spacing/card/button grammar.

## Frozen semantic baseline

- default state is upcoming appointments;
- upcoming appointments are future confirmed appointments;
- booked services/specialist/date/time/duration/price are visible;
- booked price is a snapshot;
- payment is at salon;
- management actions are discovered from appointment detail;
- History exists as a separate tab/state;
- lifecycle vocabulary remains:
  - `تأییدشده`
  - `انجام‌شده`
  - `لغوشده`
  - `عدم حضور`.

## Freeze boundary

This freezes **My Appointments — desktop/default — upcoming appointments** only.

It does not freeze:

- History state;
- appointment detail;
- cancel flow;
- reschedule flow;
- locked <24h;
- stale reschedule;
- terminal-state detail;
- mobile/tablet;
- fixture customer/appointment data.

Next page: Manager Appointments default. Per workflow, review its old version before writing a refinement prompt.
