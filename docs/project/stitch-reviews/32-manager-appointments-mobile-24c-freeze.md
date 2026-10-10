# Stitch Review 32 — Manager Appointments Mobile 24C final patch

**Reviewed:** 2026-10-10  
**Source:** `stitch_ara_beauty_salon_ui (9)(2).zip`  
**Package SHA-256:** `1ce13beec737125f238f51941ee6c7c2842ec776a0c75cff9cb9b9903d9ab4b7`  
**Decision:** **Approve and freeze Manager Appointments Mobile 24C.**

## Export map

- `_1` — reschedule date/time selection
- `_2` — stale replacement recovery
- `_3` — reschedule review/confirmation

## Final patch verification

The two remaining blockers from Review 31 are resolved.

### Reschedule date/time selection

Accepted:

- visible title is now Persian: `جابه‌جایی زمان نوبت`;
- `تأیید همپوشانی` is removed;
- product-level availability wording `بدون تداخل زمانی` is used;
- 30-minute start grid remains intact;
- the selected replacement time remains explicit;
- services, specialist, duration and booked total remain fixed;
- `پرداخت در سالن` is preserved.

### Stale replacement recovery

Accepted:

- original appointment remains unchanged;
- invalid replacement is clearly unavailable;
- fresh alternatives are shown;
- no alternative is preselected;
- Continue remains disabled until explicit selection;
- no technical/protocol wording is exposed.

### Reschedule review

Accepted:

- old vs new time is clearly compared;
- selected replacement is explicitly reviewed;
- product-level availability wording is used;
- success copy is `زمان نوبت با موفقیت تغییر کرد.`;
- no approval/notification/payment-state/technical scope drift remains.

## Frozen 24C semantics

- reschedule changes date/time only;
- services remain unchanged;
- specialist remains unchanged;
- total duration remains unchanged;
- booked price remains unchanged;
- appointment starts use the 30-minute grid;
- stale target never silently replaces the current appointment;
- original appointment remains unchanged until a valid reschedule succeeds.

## Boundary

This freezes **Manager Appointments Mobile 24C — reschedule flow**.

It does not yet freeze:

- specialist reassignment mobile flow;
- invalid/unavailable reassignment mobile state;
- concurrent-change mobile recovery;
- Completed / No-show terminal mobile details;
- tablet.

Next step is Mobile 24D.
