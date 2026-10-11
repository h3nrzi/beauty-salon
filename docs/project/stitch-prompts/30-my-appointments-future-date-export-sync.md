# Stitch Prompt 30 — My Appointments future-date + export sync

Patch only the current **My Appointments / نوبت‌های من** screen.

This is **not a redesign**.

The current code is mostly correct, but the visible screenshot is stale and the appointment dates are still in the past.

## Select in Stitch

Select only the current My Appointments screen.

## Preserve exactly

Keep:

- desktop layout;
- header/navigation;
- upcoming/history tabs;
- two appointment cards;
- specialist/service data;
- price blocks;
- guidance column;
- `تماس با سالن`;
- `رزرو نوبت تازه`;
- neutral public footer;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

Do not add new states or capabilities.

## 1. Use genuinely future appointment dates

This page is the **نوبت‌های پیش‌رو** state.

Replace the current May/اردیبهشت ۱۴۰۵ dates with future fixture dates.

Use exactly:

### Appointment 1
**`۲۵ مهر ۱۴۰۵`**

Keep:
**`ساعت ۱۰:۳۰ صبح`**

### Appointment 2
**`۷ آبان ۱۴۰۵`**

Keep:
**`ساعت ۱۶:۰۰ عصر`**

Do **not** show weekday names on these two dates.

This avoids weekday/date mismatch and keeps the future semantics unambiguous.

## 2. Keep the corrected duration

For Appointment 1 keep exactly:

**`مدت نوبت: ۲ ساعت و ۴۵ دقیقه`**

because:

- بالیاژ و رنگساژ = ۱۲۰ دقیقه
- کوپ و براشینگ = ۴۵ دقیقه

Do not regress to `۲ ساعت و ۱۵ دقیقه`.

Appointment 2 remains:

**`مدت نوبت: ۶۰ دقیقه`**

## 3. Force visible-screen/source synchronization

The visible Stitch screen and next export must use the same cleaned content.

The next `screen.png` must visibly show:

- `مدیریت نوبت‌ها`;
- future dates above;
- `۲ ساعت و ۴۵ دقیقه` on Appointment 1;
- no system-sync block;
- neutral footer;
- no exact fictional address/phone/hours;
- no ۱۴۰۳ dates.

The paired `code.html` must show exactly the same content.

Do not export a stale screenshot from an older screen version.

## 4. Keep already-correct semantics

Keep:

- status `تأییدشده`;
- `مبلغ ثبت‌شده نوبت`;
- `پرداخت در سالن`;
- neutral specialist wording;
- policy guidance;
- no VIP/loyalty/facility/system claims.

## Required output

Return exactly one corrected:

- **My Appointments — desktop/default — upcoming appointments**

No History state.
No appointment detail.
No cancel/reschedule.
No mobile/tablet.

If screen.png and code.html are synchronized and both dates are future dates, My Appointments default will be frozen.
