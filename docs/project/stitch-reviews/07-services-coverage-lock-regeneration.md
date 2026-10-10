# Stitch Review 07 — Services regeneration with coverage lock

**Reviewed:** 2026-10-10  
**Source:** `stitch_salon_visual_baseline (7).zip`  
**Decision:** **Services visual structure accepted; one semantic/content cleanup pass remains before freeze.**

## What improved

The coverage-lock regeneration solved the main regression from Review 06.

Accepted visual structure:

- full desktop catalog restored;
- six visible service cards;
- multiple category chips;
- balanced three-column desktop grid;
- duration, price and eligible specialists are easy to scan;
- each service has a clear booking CTA;
- the multi-service guidance block is visible without dominating the page;
- footer/header remain consistent with the frozen public visual system;
- no large unused empty canvas remains.

The page now fulfills the visual purpose of a real Services catalog.

No layout redesign is needed.

## Product semantics already correct

Accepted:

- multiple services are allowed;
- selected services must be performable by one specialist;
- services are described as consecutive / `پیوسته و پشت‌سرهم`;
- payment is at salon;
- eligible specialists are shown per service;
- no ratings/reviews are present;
- no online payment/checkout is introduced.

## Remaining content blockers

### 1. “Official / authorized / fixed tariff” wording

The page contains:

- `فهرست کامل و تعرفه‌های رسمی`
- `متخصصان مجاز`
- `تعرفه قطعی خدمت`

These phrases imply formal/regulated authorization or price guarantees that are not part of the product contract.

Use neutral wording:

- `فهرست خدمات و قیمت‌ها`
- `متخصصان ارائه‌دهنده`
- `قیمت خدمت`

### 2. Material / formula claims

Examples include:

- `پودرهای استاندارد`
- `تثبیت‌کننده کالر کلاود`
- `فرمولاسیون اختصاصی`

These are unsupported product/quality claims.

Use neutral service descriptions focused on what the service is, not material certification or proprietary formulas.

### 3. Clinical / therapeutic claims

Examples include:

- `بازسازی و احیای تارهای موی آسیب‌دیده`
- `ماساژ لنفاوی صورت`
- `تقویت ریشه‌ها`
- `کراتینه‌سازی ساقه مژه`

For the freeze-quality Services page, avoid medical/physiological/therapeutic implications.

Use ordinary beauty-service descriptions.

### 4. Summary literals should be product-neutral

Examples:

- `۶ خدمت اعلام‌شده`
- `خدمات فعال`

Prefer simpler catalog language such as:

- `۶ خدمت`
- `فهرست خدمات`

Do not imply publishing/administrative states on the customer page.

### 5. Footer still contains unsupported business facts

The footer still includes:

- north-Tehran prestige wording;
- exact Zafaraniyeh address;
- exact phone;
- exact opening hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

These should be normalized to neutral placeholder/contact wording during this final Services cleanup.

Use the same deterministic public-footer cleanup already recorded for Home.

## Freeze gate

Keep the current Services composition exactly.

One focused semantic/content patch is enough.

If the next pass preserves:

- six-card catalog;
- category row;
- three-column desktop density;
- multi-service guidance;
- header/footer layout;

while correcting the literals above, **Services desktop/default can be frozen**.
