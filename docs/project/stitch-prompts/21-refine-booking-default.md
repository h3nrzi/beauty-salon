# Stitch Prompt 21 — Refine Booking default service-selection state

Refine the **Booking / رزرو نوبت** page only.

The old Booking page has a strong service-selection interaction model. Improve it without losing the split layout, service catalog or sticky summary.

## What to select in Stitch

Select exactly:

1. the current **old Booking / رزرو نوبت** service-selection screen;
2. the frozen **Services / خدمات** screen for neutral service-card/content language;
3. the frozen **Home / خانه** screen for public header/footer visual continuity.

Return **one Booking screen only**.

## Source roles

Use the selected **old Booking** for:

- five-step progress pattern;
- desktop split layout;
- category chips;
- selectable service list;
- selected-services summary;
- running duration/price;
- next-step CTA.

Use frozen **Services + Home** for:

- visual system;
- neutral service language;
- public header/footer;
- typography;
- spacing;
- cards;
- buttons;
- borders/radii/shadows.

Do not copy the Services or Home page composition.

## Hard layout requirement

Keep Booking task-focused and information-rich.

Preserve a desktop split layout:

- service selection on the right;
- sticky booking summary on the left.

Show at least **5 representative service choices** so the page feels like a real selection step.

Do not make it sparse.

## 1. Booking progress

Use five pre-confirmation stages:

1. `خدمات`
2. `متخصص`
3. `تاریخ و ساعت`
4. `اطلاعات و تأیید موبایل`
5. `مرور و تأیید`

Current stage:

**`خدمات`**

Do not add:

- payment step;
- approval step;
- notification step.

## 2. Intro

Use a simple task-focused heading such as:

**`خدمات موردنظر خود را انتخاب کنید`**

Supporting copy:

**`می‌توانید یک یا چند خدمت انتخاب کنید. خدمات انتخاب‌شده در یک نوبت و به‌صورت پشت‌سرهم انجام می‌شوند و باید توسط یک متخصص قابل ارائه باشند.`**

Remove:

- `رزرو تشریفاتی و شخصی‌سازی شده`;
- live capacity indicators;
- “simultaneous services” wording;
- quality/luxury guarantees.

## 3. Category row

Keep restrained service categories consistent with frozen Services.

Examples:

- همه خدمات
- کوتاهی و استایل
- رنگ و لایت
- مراقبت مو
- مراقبت پوست
- ناخن
- مژه و ابرو

Do not use `اسپا` as a product category.

Do not create filter-state variants yet.

## 4. Service choices

Show at least 5 representative service cards/rows.

Each should support:

- selection control;
- service name;
- neutral short description;
- duration;
- price;
- small image if useful.

Use neutral service copy consistent with frozen Services.

Do not use:

- `پرطرفدار` unless it is clearly just removable fixture content;
- senior/master labels;
- ratings;
- clinical/treatment claims;
- organic/material claims;
- consultation claims;
- spa positioning.

Do not make specialist ranking part of service cards.

## 5. Selection behavior shown in the baseline

Preserve clear selected/unselected styling.

The visual baseline may show a small representative set of **customer-selected** services so the sticky summary is demonstrated.

If services are shown selected:

- make it clear they are customer selections;
- do not imply automatic/preselected recommendations.

Do not auto-recommend or auto-select services.

## 6. Sticky summary

Keep a sticky `خلاصه انتخاب نوبت` panel.

Show:

- selected services;
- remove action;
- `مجموع مدت`;
- `مجموع قیمت`;
- `پرداخت در سالن`.

Do not use:

- `مجموع زمان تخمینی`;
- vague estimate language;
- payment timing beyond `پرداخت در سالن`.

Use a simple service-order note:

**`خدمات انتخاب‌شده به‌صورت پشت‌سرهم انجام می‌شوند.`**

Do not use `پیوسته و همگام` or simultaneous-service wording.

## 7. Same-specialist rule

Add concise product guidance:

**`در مرحله بعد فقط متخصصانی نمایش داده می‌شوند که همه خدمات انتخاب‌شده را ارائه می‌کنند.`**

Do not:

- split services across specialists;
- promise automatic matching to the fastest/best specialist;
- expose technical compatibility logic.

## 8. Primary CTA

Use:

**`ادامه و انتخاب متخصص`**

The CTA should clearly follow the selected-services summary.

Below it, use next-step helper text such as:

**`در مرحله بعد، متخصص مناسب برای همه خدمات انتخاب‌شده را انتخاب می‌کنید.`**

Do not show:

- `بدون جریمه`;
- cancellation-fee claims;
- unrelated 24-hour policy copy on this step.

## 9. Remove consultation block

Do not show:

- free consultation before service;
- mandatory pre-service analysis;
- consultation-time promise.

Booking should proceed directly through the frozen five-step flow.

## 10. Footer

Use the frozen neutral public footer family.

Do not show:

- exact fictional address;
- exact phone;
- exact hours;
- north-Tehran positioning;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

Use neutral placeholder/contact wording.

## Product boundaries

Do not add:

- online payment/deposit;
- manual appointment approval;
- consultation workflow;
- loyalty;
- reviews/ratings;
- notifications/reminders;
- branches;
- marketplace behavior;
- clinical claims;
- specialist ranking.

## Visual quality bar

The result should feel:

- task-focused;
- clear;
- dense enough for real selection;
- consistent with frozen public pages;
- less marketing-heavy than the old Booking;
- ready to become the anchor for later Booking states.

Do not redesign the visual system.

## Required output

Return exactly one:

- **Booking — desktop/default — service-selection step**

No specialist step yet.
No date/time step.
No identity step.
No review/success state.
No mobile/tablet.
No edge states.

We will compare the refined Booking against the old version before deciding whether to freeze its default service-selection state.
