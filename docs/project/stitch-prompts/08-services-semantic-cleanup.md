# Stitch Prompt 08 — Services semantic cleanup only

Patch the current refined **Services / خدمات** screen only.

This is **not a redesign**.

## Select in Stitch

Select only the current Services screen from the coverage-lock regeneration.

Do not select Home or the old Services variants.

## Preserve exactly

Keep the current:

- desktop layout;
- public header/navigation;
- intro composition;
- category chips;
- six service cards;
- three-column grid;
- imagery;
- eligible-specialist presentation;
- booking CTAs;
- multi-service guidance block;
- footer layout;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

Do not reduce the number of service cards.

Do not change the page back into a sparse layout.

## 1. Neutral page intro

Replace:

- `فهرست کامل و تعرفه‌های رسمی`

with:

**`فهرست خدمات و قیمت‌ها`**

Replace wording such as:

- `متخصصان مجاز`

with:

**`متخصصان ارائه‌دهنده`**

Keep the intro focused on comparing:

- service;
- duration;
- price;
- eligible specialists;
- booking path.

## 2. Service-price wording

Replace every:

- `تعرفه قطعی خدمت`

with:

**`قیمت خدمت`**

Do not imply a regulated tariff or broader price guarantee.

## 3. Neutral service descriptions

Keep all six service cards and their names/metadata structure.

Rewrite descriptions so they are ordinary beauty-service descriptions.

Remove or avoid wording such as:

- `پودرهای استاندارد`;
- proprietary/material-brand claims;
- `فرمولاسیون اختصاصی`;
- therapeutic repair claims;
- `ماساژ لنفاوی`;
- physiological root-strengthening claims;
- clinical/medical treatment language.

Use neutral examples such as:

- styling and finishing;
- color/light technique;
- routine hair care;
- gentle facial cleansing/care;
- manicure/pedicure grooming;
- lash lift/lamination styling.

Do not make health/medical/result guarantees.

## 4. Neutral catalog labels

Replace:

- `خدمات فعال`

with:

**`فهرست خدمات`**

Replace:

- `نمایش ۶ خدمت اعلام‌شده`

with:

**`نمایش ۶ خدمت`**

Do not introduce customer-visible publishing/admin status.

## 5. Multi-service guidance

Keep the current guidance block and its visual layout.

Preserve the correct semantics:

- all selected services in one booking must be performable by one specialist;
- services are scheduled consecutively;
- total duration and total price are based on the selected services;
- `پرداخت در سالن`.

Do not say services are simultaneous.

## 6. Footer literal cleanup

Keep the footer layout exactly.

Remove/replace unsupported literal business facts:

- north-Tehran prestige/exclusivity wording;
- exact street address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

Use neutral placeholders such as:

- `نشانی سالن — اطلاعات نهایی در صفحه تماس`
- `اطلاعات تماس در صفحه تماس`
- `ساعات کاری سالن در صفحه تماس نمایش داده می‌شود`
- `خدمات سالن`
- `رزرو نوبت`

Do not introduce branches.

## Do not add

- ratings/reviews;
- loyalty;
- CRM;
- online payment/deposit;
- packages/promotions;
- certifications;
- “100%” guarantees;
- clinical claims;
- senior/master specialist hierarchy;
- first/fastest-available wording;
- notifications/reminders.

## Required output

Return exactly one corrected:

- **Services — desktop/default**

No mobile/tablet.
No alternate version.
No filter-state variants.
No booking states.
No edge states.

If these content corrections are applied without visual drift, Services desktop/default will be frozen.
