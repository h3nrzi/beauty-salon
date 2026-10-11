# Stitch Review 26 — My Appointments old-version assessment

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (25).zip`  
**Purpose:** Review the existing My Appointments page before refinement.

## Current page structure

The old My Appointments page already has a useful desktop structure:

- public header/navigation;
- page intro;
- upcoming/history tab switcher;
- upcoming appointment cards;
- appointment status;
- reference code;
- date/time;
- duration;
- specialist;
- booked services;
- booked total;
- detail CTA;
- left-side informational/support column;
- closing CTA to book another appointment;
- public footer.

This is a strong baseline for a customer appointment-management page and should be refined rather than replaced.

## What should be preserved

### 1. Upcoming/history navigation

The tab structure is useful and maps to the frozen product scope:

- `نوبت‌های پیش‌رو`
- `تاریخچه نوبت‌ها`

Keep the current page focused on the **upcoming** default state.

History itself will be created later as a separate state.

### 2. Appointment-card information density

The cards expose the right kinds of information:

- status;
- reference ID;
- date/time;
- duration;
- specialist;
- services;
- booked total;
- payment-at-salon context;
- detail action.

This is the right information model for the default page.

### 3. Desktop two-column composition

The main appointment stream + secondary support/info column uses desktop space well.

Preserve this structure, but simplify the left column so it only contains product-relevant guidance.

### 4. Detail CTA

`مشاهده جزئیات نوبت` is the correct primary action from this default list.

Do not expose cancel/reschedule directly on every list card yet; those belong in the appointment detail flow.

## What should improve

### 1. Loyalty / VIP customer semantics are out of scope

Current page includes:

- `مشتری ویژه`
- dedicated customer-status widget.

Loyalty / tiering is not part of v1.

Remove the customer-status card entirely.

If a top summary is retained, keep only useful appointment information such as the number of upcoming appointments.

### 2. Dynamic business-hours summary is unnecessary here

The page includes:

- `ساعت رسمی پذیرش: ۹:۰۰ الی ۱۹:۰۰`.

This is both fictional business data and not needed on My Appointments.

Remove it from the customer appointment-management default.

### 3. Status wording should use frozen lifecycle language

Current page uses:

- `تأییدشده و نهایی`.

The frozen lifecycle uses:

- `تأییدشده`
- `انجام‌شده`
- `لغوشده`
- `عدم حضور`

Use exactly `تأییدشده` for upcoming appointments.

Do not add extra finality/approval semantics.

### 4. Specialist hierarchy / spa wording is wrong

Current cards include:

- `مستر کالریست`
- `تکنسین ارشد`
- `اسپا`

Use neutral specialist expertise and service names consistent with frozen Services / Specialists.

### 5. Appointment-card marketing imagery is unnecessary

The first appointment includes a large decorative service banner with:

- `جایگاه اختصاصی...`
- `سالن VIP`

This adds unsupported facility/luxury claims and makes the card visually heavy.

The default My Appointments list should be task-focused.

Prefer compact appointment cards without decorative lifestyle banners.

### 6. “Final amount” wording should be simplified

Current cards say:

- `مبلغ نهایی نوبت`

The product needs the booked-price snapshot.

Use:

**`مبلغ ثبت‌شده نوبت`**

or:

**`مبلغ نوبت`**

Keep:

**`پرداخت در سالن`**

Do not introduce payment status or settlement timing.

### 7. Visit-guidance block introduces unsupported policy

The left column contains:

- arrive 10 minutes early;
- reception/pampering wording;
- call reception at least 24 hours before to change time.

The actual customer rule is:

- self-cancel / self-reschedule until 24 hours before;
- inside the final 24 hours, self-change is locked and the customer should contact the salon.

Do not place a generic “call reception 24 hours before” instruction on the default page.

For the default page, use concise neutral guidance such as:

- changes are available according to the appointment policy;
- open the appointment detail to see available actions.

Exact locked-state messaging belongs to the detail/state flow.

### 8. Exact phone/contact data should not appear

Current page includes a direct fictional reception phone number.

Remove exact contact data from the default My Appointments page.

If contact is needed, link to the Contact page.

### 9. Facility / hospitality / hygiene claims are out of scope

Current left column includes:

- private salon space;
- organic herbal drinks;
- private parking;
- VIP area;
- hygiene guarantee;
- medical autoclave sterilization.

Remove these completely.

They are not part of appointment management and are unsupported business claims.

### 10. Upsell block is too marketing-heavy

Current page says:

- add complementary services before the appointment;
- facial/pedicure examples.

A simple `رزرو نوبت تازه` CTA is fine.

Do not make My Appointments an upsell surface.

### 11. Footer is stale

Current footer reintroduces:

- north-Tehran positioning;
- exact address/phone/hours;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

Use the frozen neutral public footer.

## Refinement target

The refined My Appointments page should combine:

- **old My Appointments** for appointment-list information architecture;
- **frozen Booking** for task-focused customer UI;
- **frozen Home / public pages** for header/footer visual continuity.

The result should feel like a calm customer utility page:

- clear;
- compact;
- trustworthy;
- easy to scan;
- focused on upcoming appointments and detail access.

It should not feel like a loyalty dashboard, luxury hospitality page, or marketing surface.
