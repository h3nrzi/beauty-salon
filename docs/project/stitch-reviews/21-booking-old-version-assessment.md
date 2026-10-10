# Stitch Review 21 — Booking old-version assessment

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (21).zip`  
**Purpose:** Review the existing Booking service-selection page before refinement.

## Current page structure

The old Booking page already has a strong task-focused desktop skeleton:

- public header/navigation;
- five-step booking progress indicator;
- service-selection intro;
- category chips;
- multi-select service cards;
- desktop split layout;
- sticky selected-services summary;
- running total duration;
- running total price;
- primary CTA to specialist selection;
- public footer.

This is a good interaction architecture and should be refined rather than replaced.

## What should be preserved

### 1. Five-step booking progress

The stepper gives the customer a clear sense of the journey.

Preserve the five pre-confirmation stages, but correct the labels to match the frozen product contract:

1. `خدمات`
2. `متخصص`
3. `تاریخ و ساعت`
4. `اطلاعات و تأیید موبایل`
5. `مرور و تأیید`

Confirmation success happens after step 5 and should not become a payment step.

### 2. Split desktop layout

The old page uses the desktop canvas well:

- service catalog on the right;
- sticky selection summary on the left.

Preserve this task-focused 7/5-style composition.

Do not turn Booking into a sparse editorial page.

### 3. Multi-service selection + sticky summary

Preserve:

- selectable service cards;
- clear selected state;
- selected-service list;
- remove-from-selection action;
- total duration;
- total price;
- CTA to the next step.

This is useful and directly supports the real booking model.

### 4. Category discovery

The category-chip row is useful and should remain restrained.

## What should improve

### 1. Step 4 semantics are incomplete

Current step 4 is:

- `اطلاعات تماس`
- `ثبت مشخصات`

The frozen flow includes customer identity/mobile verification.

Use:

**`اطلاعات و تأیید موبایل`**

Do not expose implementation/provider details.

### 2. Intro incorrectly allows simultaneous services

Current copy says:

`امکان رزرو چند خدمت به‌صورت همزمان یا در امتداد یکدیگر فراهم است.`

The product rule is:

- multiple services are allowed;
- they are performed **consecutively**;
- one specialist must be able to perform the complete selected set.

Use simple product wording describing services as `پشت‌سرهم`.

### 3. Dynamic “capacity today” / luxury wording is unsupported

Current page contains:

- `رزرو تشریفاتی و شخصی‌سازی شده`;
- `ظرفیت پذیرش اختصاصی امروز: فعال`.

These add luxury positioning and a live-capacity state that are not part of the default booking baseline.

Remove them.

### 4. Service content is claim-heavy

Current cards include examples such as:

- `پرطرفدار`;
- `مستر استایلیست ارشد`;
- `تراپی ارگانیک`;
- `درمان آبرسانی`;
- material/formula claims;
- therapeutic/clinical wording;
- `ناخن و اسپا`.

Use the neutral service language already established in frozen Services.

### 5. Free consultation block is out of scope

The page contains:

- `مشاوره حضوری رایگان پیش از شروع`;
- a 10-minute analysis before every process.

This invents a consultation workflow and should be removed.

### 6. Running totals should not be described as estimated

Current summary says:

- `مجموع زمان تخمینی`.

For selected services, duration is the sum of service durations.

Use:

- `مجموع مدت`
- `مجموع قیمت`

The values can update as selection changes, but they are not presented as vague estimates.

### 7. Payment timing is over-specified

Current copy says payment happens at the salon **after the service**.

The frozen rule is only:

**`پرداخت در سالن`**

Do not freeze before/after-service timing.

### 8. Single-specialist rule needs clearer wording

Current copy says services are delivered by “one specialist or coordinated”.

The actual product rule is stricter:

- all selected services must be performable by the **same specialist**.

On step 1, explain that the next step will show specialists eligible for the complete selected service set.

Do not split a booking across specialists.

### 9. Cancellation helper is in the wrong place and overclaims fees

Current CTA helper says:

`انصراف یا ویرایش تا ۲۴ ساعت پیش از موعد بدون جریمه امکان‌پذیر است`.

Problems:

- “بدون جریمه” is not part of the frozen product contract;
- cancellation/reschedule policy is not the primary helper for service-selection step 1.

Use next-step guidance instead, for example:

**`در مرحله بعد، متخصص مناسب برای همه خدمات انتخاب‌شده را انتخاب می‌کنید.`**

The 24-hour policy belongs where appointment-management/change rules are relevant.

### 10. Default selection should not imply automatic service preselection

The old screen opens with two arbitrary services already checked.

The refined visual may show a representative selected state if useful for demonstrating the sticky summary, but it must not imply that the product automatically preselects those services.

Prefer a neutral representative selection state with clear customer-selected styling, or a natural no-selection default if Stitch can preserve the full layout.

Do not introduce automatic recommendations.

### 11. Footer is stale

The old footer contains:

- north-Tehran positioning;
- exact Zafaraniyeh address;
- exact phone;
- exact hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

Use the frozen neutral public footer.

## Refinement target

The refined Booking page should combine:

- **old Booking** for task-focused information architecture and sticky summary;
- **frozen Services** for neutral service content/card language;
- **frozen Home** for public shell/header/footer consistency.

The result should feel like the first step of a real booking flow: clear, efficient and operational — not luxurious, clinical, consultation-heavy or sparse.
