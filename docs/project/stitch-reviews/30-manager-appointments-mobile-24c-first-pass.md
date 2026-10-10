# Stitch Review 30 — Manager Appointments Mobile 24C first pass

**Reviewed:** 2026-10-10  
**Source:** `stitch_ara_beauty_salon_ui (7)(2).zip`  
**Package SHA-256:** `09f2e9d0a5b1a2c1a46104343c446d88c2353a78d6c5512cb88a09de7ab0c391`  
**Decision:** **24C is not frozen yet.** The mobile reschedule interaction model is correct, but a small visible-copy cleanup is required across the three screens.

## Export map

- `_1` — reschedule date/time selection
- `_2` — stale replacement recovery
- `_3` — reschedule review/confirmation

## What works

The core reschedule contract is represented correctly:

- mobile layouts are genuinely responsive;
- reschedule changes date/time only;
- services remain fixed;
- specialist remains fixed;
- total duration remains fixed;
- booked price remains fixed;
- replacement starts use the 30-minute start grid;
- the selected replacement is explicit;
- stale recovery keeps the original appointment unchanged;
- stale recovery shows fresh available alternatives;
- no replacement is preselected in stale recovery;
- Continue remains disabled until a new time is chosen;
- review clearly compares old vs new time;
- `پرداخت در سالن` is preserved;
- no payment-state/CRM/notification/HTTP-version semantics were introduced.

No redesign is needed.

## Remaining blockers

### 1. Visible English top titles remain on all three screens

The top bars visibly show:

- `Reschedule Select Datetime`
- `Reschedule Slot Recovery`
- `Reschedule Review Confirm`

The manager product surface is Persian / RTL.

Use Persian titles only:

- `جابه‌جایی زمان نوبت`
- `زمان انتخاب‌شده دیگر در دسترس نیست`
- `مرور و تأیید تغییر زمان`

### 2. Date/time selection uses ambiguous “overlap confirmation” wording

The selection screen contains:

`تأیید همپوشانی`

This sounds like a manual/technical approval step.

The product rule is simply that the selected time must be valid for the same specialist and full appointment duration.

Replace with product-level wording such as:

- `بدون تداخل زمانی`
- or `برای مدت کامل نوبت در دسترس است`

Do not imply a separate approval workflow.

### 3. Stale recovery contains unnecessary reservation/capacity product wording

The stale screen contains:

- `مدیریت رزرواسیون اختصاصی`
- `تغییر وضعیت ظرفیت`
- `وضعیت نوبت فعلی: معتبر و پایدار`

These are not needed for the frozen product contract and make the UI sound like a separate reservation/capacity subsystem.

Use simple appointment language:

- `مدیر سالن`
- `زمان انتخاب‌شده دیگر در دسترس نیست`
- `نوبت فعلی بدون تغییر باقی مانده است`

### 4. Review screen contains unnecessary technical/status literals

The review includes:

- `منسوخ` on the old time;
- `اختصاصی` near the specialist;
- success copy: `در تقویم سالن ثبت شد`.

These are unnecessary product/implementation implications.

Use:

- `زمان قبلی` without a “deprecated” status;
- neutral specialist wording;
- success message:
  **`زمان نوبت با موفقیت تغییر کرد.`**

Do not describe persistence into a separate calendar product.

## Freeze gate

Patch the same three Mobile 24C screens only.

No interaction changes are needed.

24C can be frozen after:

1. all visible top titles are Persian;
2. overlap wording becomes product-level availability language;
3. stale recovery uses simple appointment language;
4. review removes `منسوخ`, `اختصاصی`, and calendar-registration wording.

Do not start 24D until 24C is accepted.
