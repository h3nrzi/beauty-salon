# Stitch Prompt 29 — Manager Appointments Mobile 24B final literal patch

Patch **only the existing mobile Cancel Confirmation screen**.

Do not redesign the screen.

## Select in Stitch

Select only:

- `تأیید لغو نوبت`

## Preserve

Keep the current:

- layout;
- appointment summary;
- destructive confirmation hierarchy;
- Persian / RTL styling;
- manager header;
- button styling;
- appointment fixture values.

## Change one success-state sentence only

Find the cancel-success message that currently says:

`وضعیت نوبت به «لغوشده» به‌روزرسانی و در سوابق ذخیره گردید.`

Replace it with exactly:

**`نوبت با موفقیت لغو شد و در تاریخچه نوبت‌ها به‌صورت فقط‌خواندنی باقی می‌ماند.`**

Do not use:

- `در سوابق ذخیره گردید`;
- database/storage/persistence wording;
- archive/CRM wording.

Do not change anything else.

## Required output

Return the corrected mobile Cancel Confirmation screen only.

No other Mobile 24B screens.
No reschedule.
No tablet.
No new feature.

If this literal is corrected, Mobile 24B will be frozen.
