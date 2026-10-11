# Stitch Prompt 29 — My Appointments fixture consistency patch

Patch only the current refined **My Appointments / نوبت‌های من** screen.

This is **not a redesign**.

The UI and semantic cleanup are already accepted.

## Select in Stitch

Select only the current refined My Appointments screen.

## Preserve exactly

Do not change:

- desktop layout;
- header/navigation;
- tabs;
- two appointment-card layouts;
- statuses;
- specialists;
- booked-service chips;
- price blocks;
- guidance column;
- `تماس با سالن`;
- `رزرو نوبت تازه`;
- footer;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

Only correct the appointment fixture inconsistencies below.

## 1. Correct the first appointment duration

The first appointment contains:

- `بالیاژ و رنگساژ (۱۲۰ دقیقه)`
- `کوپ و براشینگ (۴۵ دقیقه)`

Therefore replace:

`مدت نوبت: ۲ ساعت و ۱۵ دقیقه`

with exactly:

**`مدت نوبت: ۲ ساعت و ۴۵ دقیقه`**

Do not change the individual service durations.

## 2. Make both upcoming appointment dates actually future dates

The page is the **نوبت‌های پیش‌رو** state.

Do not use year `۱۴۰۳`.

Replace both appointment dates with clearly future Persian placeholder dates.

Requirements:

- both dates must represent future appointments;
- if a weekday name is shown, it must match the date;
- keep the existing time-of-day values unless necessary for consistency;
- do not change the card structure.

If exact weekday/date matching is uncertain, use a date label without a weekday rather than showing an incorrect weekday.

## Keep already-correct content

Keep:

- status `تأییدشده`;
- reference IDs;
- neutral specialist wording;
- `مبلغ ثبت‌شده نوبت`;
- `پرداخت در سالن`;
- `مدت نوبت`;
- neutral footer;
- policy guidance;
- no VIP/loyalty/facility/system wording.

## Required output

Return exactly one corrected:

- **My Appointments — desktop/default — upcoming appointments**

No History state.
No detail state.
No cancel/reschedule state.
No mobile/tablet.

If these fixture consistency issues are corrected without visual drift, My Appointments default will be frozen.
