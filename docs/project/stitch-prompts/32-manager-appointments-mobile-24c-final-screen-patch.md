# Stitch Prompt 32 — Manager Appointments Mobile 24C final single-screen patch

Patch **only the existing Mobile reschedule date/time selection screen**.

Do not redesign anything.

## Select in Stitch

Select only:

- `جابه‌جایی زمان نوبت` / the current mobile date-time selection screen

## Preserve

Keep the current:

- appointment summary;
- date selector;
- 30-minute start-time grid;
- selected replacement time;
- booked services;
- specialist;
- total duration;
- booked total price;
- `پرداخت در سالن`;
- buttons;
- spacing;
- colors;
- RTL layout.

## Change 1 — top title

Replace the visible English title:

`Reschedule Select Datetime`

with exactly:

`جابه‌جایی زمان نوبت`

No visible English page title should remain.

## Change 2 — availability wording

Replace:

`تأیید همپوشانی`

with exactly:

`بدون تداخل زمانی`

If supporting helper text is needed, use:

`این زمان برای متخصص فعلی و مدت کامل نوبت در دسترس است.`

Do not introduce:

- approval workflow;
- technical overlap-validation terminology;
- SMS/calendar notifications;
- payment status;
- CRM;
- branch/resource concepts.

## Required output

Return only the corrected mobile reschedule date/time selection screen.

No stale-recovery screen.
No review screen.
No reassignment.
No tablet.
No new feature.

If these two literals are corrected, Mobile 24C will be frozen.
