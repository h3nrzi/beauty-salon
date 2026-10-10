# Stitch Prompt 23 — Correct Booking true default state

Patch only the current **Booking / رزرو نوبت — service-selection** screen.

This is **not a redesign**.

The previous screen looked good visually, but it was frozen too early. Correct the default state and interaction consistency while preserving the current composition.

## Select in Stitch

Select only the current refined Booking service-selection screen.

## Preserve exactly

Keep:

- desktop split layout;
- five-step progress;
- service catalog position;
- category chips;
- six service cards;
- sticky summary panel;
- same-specialist guidance;
- typography;
- spacing;
- colors;
- borders/radii/shadows;
- public header/footer.

Do not make the page sparse.

## 1. Make this the true initial/default state

When the screen first opens:

- **0 services selected**
- all service checkboxes unselected
- summary badge: **`۰ خدمت انتخاب‌شده`**
- selected-services list shows a simple empty message such as:
  **`هنوز خدمتی انتخاب نکرده‌اید.`**
- `مجموع مدت`: **`۰ دقیقه`**
- `مجموع قیمت`: **`۰ تومان`**
- primary CTA `ادامه و انتخاب متخصص` is visibly disabled

Do not preselect any service.

Do not imply recommendations or automatic selection.

## 2. Continue CTA behavior

The Continue CTA must remain disabled until the customer explicitly selects at least one service.

After at least one selection:

- enable the CTA;
- update summary count;
- update selected-service list;
- update total duration;
- update total price.

Do not navigate with zero selected services.

## 3. Keep all six services consistent

The visible catalog has six services.

All six must participate correctly in selection and totals.

Use one consistent set of names/durations/prices across:

- visible cards;
- selected-service summary;
- totals;
- interaction behavior.

Do not allow old/stale service names to reappear after interaction.

Do not use old literals such as:

- `بالیاژ تخصصی فرانسوی`
- `درمان آبرسانی و تراپی مو`
- `کوپ ژورنالی و کوتاهی`
- `مانیکور روسی`
- `فیشیال پاکسازی عمیق`

Use exactly the current cleaned service-card data.

## 4. Selection accessibility

Make service selection clearly keyboard-operable.

Show intent for:

- real checkbox/button semantics;
- visible keyboard focus;
- selected state not communicated by color alone;
- accessible service names attached to selection controls.

Remove actions in the summary should have an accessible name such as:

`حذف [نام خدمت] از نوبت`

Do not rely only on the icon `close`.

## 5. Booking-step readability

Keep future steps visually secondary, but improve readability.

Do not use extremely low-opacity text.

All visible step labels should remain comfortably readable while the current step remains clearly dominant.

Keep the five labels:

1. `خدمات`
2. `متخصص`
3. `تاریخ و ساعت`
4. `اطلاعات و تأیید موبایل`
5. `مرور و تأیید`

## 6. Payment wording

Use exactly:

**`پرداخت در سالن`**

Do not specify before/after-service timing.

## 7. Keep correct booking semantics

Keep:

- one or more services may be selected;
- selected services are performed پشت‌سرهم;
- one specialist must be eligible for the complete selected service set;
- next step is Specialist;
- no consultation workflow;
- no payment/checkout step;
- no ratings/reviews;
- no automatic specialist matching claim.

## 8. Export consistency

The next exported `screen.png` and `code.html` must represent the same initial state:

- zero selected services;
- zero totals;
- disabled Continue CTA.

Do not export one state visually and a different state in HTML.

## Required output

Return exactly one corrected:

- **Booking — desktop/default — initial service-selection state**

No selected-state variant.
No specialist step.
No date/time step.
No mobile/tablet.
No edge states.

If this true initial state is correct and synchronized, Booking default can be frozen again.
