# Stitch Prompt 12 — Booking freeze evidence only

Do **not** redesign Booking and do **not** regenerate the entire product.

The current mobile visual direction is accepted.

Generate only the missing/corrected evidence required to freeze the Booking baseline.

## 1. Correct stale-slot initial state

Create the initial Stale Slot Recovery screen with:

- lost/original time visibly unavailable;
- services preserved;
- specialist choice preserved;
- fresh alternative times visible;
- **no alternative time selected**;
- no “recommended / closest / first / best” ranking;
- primary continue CTA visibly **disabled**.

Disabled CTA label may remain:

**انتخاب ساعت و ادامه نوبت**

After the user explicitly selects a replacement time, it may become active.

For the baseline evidence, show the **initial disabled state**.

## 2. Generate desktop staged flow — exactly five separate stages

Use the existing Booking visual language.

Desktop around 1440 CSS px.

Create separate desktop screens/views for:

### Desktop 1 — خدمات
Only stage 1 active.
Show:
- multi-service selection;
- compatibility;
- total duration;
- total price;
- next to Specialist;
- optional side summary.

### Desktop 2 — متخصص
Only stage 2 active.
Show:
- specific eligible specialists;
- «هر متخصص در دسترس»;
- preserved selected services;
- no ratings/certificates/credentials.

### Desktop 3 — زمان
Only stage 3 active.
Show:
- preserved service/specialist summary;
- 90-day horizon;
- 60-minute same-day lead;
- public starts on 30-minute grid;
- one explicit selected time for the normal happy path;
- 24-hour change rule.

### Desktop 4 — اطلاعات
Only stage 4 active.
Show:
- name required;
- mobile required;
- email optional;
- mobile verification;
- returning mobile recovers same identity/history;
- no profile/preferences center;
- no password.

### Desktop 5 — تأیید
Only stage 5 active.
Show:
- services;
- specialist;
- date/time;
- total duration;
- total price;
- customer identity;
- pay at salon;
- 24-hour self-change rule;
- final CTA «تأیید و ثبت نوبت».

Then show one separate:

### Desktop Success
Only approved content:
- Confirmed state;
- booking/reference ID;
- specialist;
- services;
- date/time;
- duration;
- total price;
- pay at salon;
- «مشاهده در وقت‌های من»;
- return to Home/Services.

## 3. Desktop interaction rule

Do not create one giant page containing all editable stages.

Each desktop screen must have:

- 5-stage progress;
- exactly one active editable stage;
- previous completed stages summarized;
- later stages unavailable/not yet active;
- back navigation that preserves prior valid selections;
- optional sticky/side summary.

## 4. Contract-safe fixture copy only

Across these generated screens remove:

- ratings/reviews;
- certificates/international credentials;
- organic/vegan/material claims;
- clinical/lymphatic/physiological claims;
- “fastest” / “first available” wording;
- SMS reminder/confirmation promises;
- free-cancellation/fee promises;
- satisfaction-dependent payment;
- branches;
- calendar integration;
- sharing;
- arrival-10-minutes-early rule;
- hospitality promises.

Use concise neutral placeholders instead.

## 5. Mock salon data must stay mock

Do **not** write any generated Markdown/spec claiming a literal address, phone, email, hours or branch is approved/frozen.

If business details appear for layout, label them clearly as mock/placeholder.

Do not add or modify the Product Contract.

## 6. Payment wording

Use only:

**پرداخت در سالن**

Do not define whether payment occurs before or after service.

No online payment/deposit.

## 7. Keep already-correct edge states

Do not redesign No Eligible Specialist or No Availability unless necessary for visual consistency.

Their approved semantics remain:

- no eligible specialist → change/remove service; no split booking;
- no availability → preserve selections, choose another date or specialist; no automatic choice.

## Required output

Return only:

- corrected stale-slot initial state with disabled CTA;
- desktop stage 1;
- desktop stage 2;
- desktop stage 3;
- desktop stage 4;
- desktop stage 5;
- desktop Confirmed success.

No new product-contract prose. No new pages. No new capabilities.

This is an evidence-only freeze pass.
