# Stitch Review 31 — Manager Appointments Mobile 24C patch

**Reviewed:** 2026-10-10  
**Source:** `stitch_ara_beauty_salon_ui (8)(2).zip`  
**Package SHA-256:** `8413ab526051552c6e5a8c3f2144be59c050b91b9e50b683e7b3a86a62554265`  
**Decision:** **24C is one screen away from freeze.** The stale-recovery and review screens are now acceptable; the date/time-selection screen still contains two old literals.

## Export map

- `_1` — reschedule date/time selection
- `_2` — stale replacement recovery
- `_3` — reschedule review/confirmation

## Accepted screens

### `_2` — stale replacement recovery

Accepted:

- Persian visible title;
- original appointment remains unchanged;
- unavailable replacement is clearly marked invalid;
- fresh 30-minute-grid start times are shown;
- no replacement is preselected;
- Continue remains disabled until explicit selection;
- no HTTP/ETag/database language;
- no payment/CRM/notification scope drift.

### `_3` — reschedule review

Accepted:

- Persian visible title;
- old vs new time comparison is clear;
- no `منسوخ` status label remains;
- no specialist `اختصاصی` label remains;
- product-level availability wording is used;
- success wording is reduced to `زمان نوبت با موفقیت تغییر کرد.`;
- services, specialist, duration and booked price remain unchanged;
- `پرداخت در سالن` is preserved.

## Remaining blocker — `_1` date/time selection

The visible screen and HTML still contain:

- English top title: `Reschedule Select Datetime`
- `تأیید همپوشانی`

These were explicitly targeted in Prompt 31 but were not applied to this screen.

Required patch:

- title → `جابه‌جایی زمان نوبت`
- `تأیید همپوشانی` → `بدون تداخل زمانی`

or equivalent product-level wording:

`برای مدت کامل نوبت در دسترس است`

No layout or interaction changes are needed.

## Freeze gate

Patch only `_1`.

If the next export removes the English title and `تأیید همپوشانی` while preserving the current mobile flow, **Mobile 24C is frozen**.
