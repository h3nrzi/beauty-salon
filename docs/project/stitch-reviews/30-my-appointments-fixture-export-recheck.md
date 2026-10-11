# Stitch Review 30 — My Appointments fixture/export re-check

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (29).zip`  
**Decision:** **Do not freeze yet. Two blockers remain: the dates are still not future dates, and screen.png is stale relative to code.html.**

## What is correct in code.html

The source now includes the corrected first appointment duration:

- `بالیاژ و رنگساژ (۱۲۰ دقیقه)`
- `کوپ و براشینگ (۴۵ دقیقه)`
- `مدت نوبت: ۲ ساعت و ۴۵ دقیقه`

The source also retains the accepted neutral content:

- `مدیریت نوبت‌ها`
- `تأییدشده`
- `مبلغ ثبت‌شده نوبت`
- `پرداخت در سالن`
- neutral public footer
- no VIP/loyalty/facility wording

## Blocker 1 — the new dates are still historical

The source uses:

- `سه‌شنبه ۱۵ اردیبهشت ۱۴۰۵`
- `دوشنبه ۲۸ اردیبهشت ۱۴۰۵`

At the time of review (2026-10-11), both dates are already in the past.

This page is explicitly the **نوبت‌های پیش‌رو** default state.

Use clearly future fixture dates.

To avoid weekday/date mismatch, use future Persian dates **without weekday labels**, for example:

- `۲۵ مهر ۱۴۰۵`
- `۷ آبان ۱۴۰۵`

Keep the existing times.

## Blocker 2 — screen.png is stale relative to code.html

The screenshot still visibly shows the older pre-patch page, including:

- old ۱۴۰۳ dates;
- first appointment duration `۲ ساعت و ۱۵ دقیقه`;
- stale system-sync note;
- old fictional footer/business details.

But `code.html` contains the newer cleaned content.

A frozen visual baseline cannot have a screenshot that contradicts its source.

## Freeze gate

Do not redesign the page.

Synchronize the visible Stitch canvas/export with the cleaned source and use genuinely future dates.

The next export must have the same content in:

- visible Stitch screen;
- `screen.png`;
- `code.html`.

If that is true, My Appointments desktop/default can be frozen.
