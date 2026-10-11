# Stitch Review 29 — My Appointments final patch re-check

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (28).zip`  
**Package SHA-256:** `76d54a3787a376b4d3d3722880c57cc3b1cba0c21ca81ea0d157a3294fab16a9`  
**Decision:** **Do not freeze yet. Visual/content cleanup from Prompt 28 succeeded, but two appointment-data consistency errors remain.**

## What is now correct

The requested cleanup from Review 28 is complete.

Verified:

- neutral public footer is now in place;
- no stale Zafaraniyeh / north-Tehran / exact phone / exact hours;
- automatic system-sync block is gone;
- intro eyebrow is now `مدیریت نوبت‌ها`;
- new-booking copy is customer-facing rather than system-centric;
- `مدت زمان اختصاصی` is now `مدت نوبت`;
- no VIP/loyalty/facility/hospitality drift remains;
- no `مستر`, `ارشد`, `اسپا`, autoclave, parking or upsell content remains.

The current UI structure should be preserved.

## Remaining blocker 1 — first appointment duration is internally inconsistent

The first appointment shows:

- `بالیاژ و رنگساژ (۱۲۰ دقیقه)`
- `کوپ و براشینگ (۴۵ دقیقه)`

The booked services therefore total:

**۱۶۵ دقیقه = ۲ ساعت و ۴۵ دقیقه**

But the appointment summary shows:

**`مدت نوبت: ۲ ساعت و ۱۵ دقیقه`**

This contradicts the frozen booking rule that total duration is the sum of booked service durations.

Correct the first appointment duration to:

**`۲ ساعت و ۴۵ دقیقه`**

Do not change the service durations.

## Remaining blocker 2 — “upcoming” appointments use past dates

The page is explicitly the **upcoming appointments** default state, but both fixture dates use year **۱۴۰۳**.

At the time of this review, these dates are historical, not upcoming.

Use clearly future placeholder dates.

Do not preserve ۱۴۰۳ on the upcoming tab.

The exact business calendar is fixture data, but the semantic relationship must be correct:

- upcoming tab → future appointments;
- history tab → past/terminal appointments later.

Use future Persian dates that are internally coherent with their weekday labels, or omit weekday if Stitch cannot keep the calendar combination accurate.

## What should remain unchanged

Do not redesign:

- tabs;
- two-column layout;
- both appointment cards;
- guidance card;
- contact link;
- new-booking CTA;
- footer;
- typography;
- spacing;
- colors;
- card hierarchy.

## Freeze gate

Patch only:

1. first appointment duration: `۲ ساعت و ۴۵ دقیقه`;
2. both upcoming appointment dates: future fixture dates with internally consistent labels.

If those are corrected without visual drift, **My Appointments desktop/default — upcoming appointments can be frozen**.
