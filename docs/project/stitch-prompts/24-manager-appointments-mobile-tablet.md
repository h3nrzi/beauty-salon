# Stitch Prompt 24 — Manager Appointments responsive selection workflow

This file is **not** a single prompt to paste into Stitch.

Stitch only receives reliable visual context from the screen(s) selected on the canvas. Therefore, Manager Appointments responsive work must be done in **small selected-screen batches**.

## Rule

For each step below:

1. select only the listed existing desktop screen(s) in Stitch;
2. paste only that step's prompt;
3. review the generated responsive screen(s);
4. do not ask Stitch to infer unseen screens, GitHub files, repository paths, or product documentation.

Do not redesign the desktop baseline.

Do not introduce new product capabilities.

We will complete **Mobile first**. Tablet will be handled after the Mobile baseline is reviewed/frozen.

---

# 24A — Mobile workspace + search/filter

## Select in Stitch

Select these existing desktop screens:

- Manager Appointments workspace/list
- Manager Appointments search/filter result

## Paste this prompt

Adapt the selected Manager Appointments desktop screens into a **mobile experience around 390 CSS px**.

Preserve the selected screens' visual language, RTL hierarchy, status-chip treatment and operational tone.

Do not create a miniature desktop table.

Create:

1. a mobile appointments workspace/list;
2. a mobile search/filter result state;
3. an open-filter state using a mobile-friendly sheet/drawer/expandable pattern.

Appointment cards should prioritize:

- time;
- customer name;
- mobile snapshot;
- specialist;
- booked services;
- total duration;
- status;
- booked total price;
- open-details action.

Search by:

- customer name;
- mobile;
- appointment/reference ID.

Filters:

- date;
- status;
- specialist.

Statuses only:

- تأییدشده
- انجام‌شده
- لغوشده
- عدم حضور

Do not add:

- manual/new appointment creation;
- payment/settlement status;
- CRM/loyalty;
- analytics;
- chair/resource management;
- print actions.

Keep the Persian RTL UI touch-friendly with no horizontal overflow.

Return only the mobile workspace/list, search/filter result and open-filter state.

---

# 24B — Mobile active detail + cancel

## Select in Stitch

Select these existing desktop screens:

- active appointment detail
- cancel confirmation
- cancelled read-only detail

## Paste this prompt

Adapt the selected Manager Appointments desktop screens into a **mobile experience around 390 CSS px**.

Preserve the same visual language and interaction semantics.

Create:

1. active appointment detail;
2. cancel confirmation;
3. cancelled read-only detail/result.

Active detail should show:

- reference ID;
- customer name;
- verified mobile;
- optional email;
- booked services;
- specialist;
- date/time;
- total duration;
- booked total price;
- status;
- «پرداخت در سالن».

For a Confirmed appointment, show manager actions:

- جابه‌جایی زمان;
- تغییر متخصص;
- لغو نوبت.

Cancel confirmation must be clearly destructive and show the appointment identity before confirmation.

After cancellation:

- status becomes لغوشده;
- the appointment remains a read-only historical record;
- no replacement booking is created.

Do not add:

- fees/refunds/credits;
- payment status;
- invoice;
- CRM/loyalty;
- chair/studio/resource assignment;
- SMS guarantees.

Return only these three mobile screens.

---

# 24C — Mobile reschedule flow

## Select in Stitch

Select these existing desktop screens:

- reschedule date/time
- reschedule review
- reschedule stale recovery

## Paste this prompt

Adapt the selected Manager Appointments reschedule screens into a **mobile flow around 390 CSS px**.

Preserve the selected screens' visual language and the existing appointment summary.

Create:

1. reschedule date/time selection;
2. reschedule review/confirmation;
3. stale replacement recovery.

Rules:

- reschedule changes date/time only;
- services remain unchanged;
- specialist remains unchanged;
- total duration remains unchanged;
- booked price remains unchanged;
- appointment starts use the 30-minute grid.

Date/time selection should show:

- current appointment time;
- replacement date;
- available start times;
- explicit selected replacement.

Review should show:

- زمان فعلی;
- زمان جدید انتخاب‌شده;
- unchanged services;
- unchanged specialist;
- unchanged total duration;
- unchanged booked total price;
- «پرداخت در سالن»;
- final confirmation.

If the selected replacement becomes unavailable:

- original appointment remains unchanged;
- lost replacement is shown unavailable;
- show fresh available start times;
- preselect none;
- Continue remains disabled until the manager explicitly selects a new time.

Do not auto-pick a replacement.

Do not add approval workflows, SMS/calendar promises, payment state, HTTP/protocol/database terminology.

Return only these three mobile screens.

---

# 24D — Mobile specialist reassignment + conflict

## Select in Stitch

Select these existing desktop screens:

- specialist reassignment
- invalid/unavailable reassignment
- concurrent-change conflict

## Paste this prompt

Adapt the selected Manager Appointments operational screens into a **mobile experience around 390 CSS px**.

Create:

1. specialist reassignment;
2. invalid/unavailable reassignment;
3. concurrent-change conflict recovery.

For reassignment:

- show current specialist;
- show booked services;
- date/time remain unchanged;
- total duration remains unchanged;
- booked total price remains unchanged;
- show eligible and available replacement specialists;
- require explicit manager selection and confirmation.

A replacement specialist is valid only if they:

- can perform all booked services;
- are available for the full appointment interval.

Do not change date/time or services.

Invalid/unavailable state should explain only:

- specialist is not eligible for all booked services; or
- specialist is not available for the full interval.

For concurrent-change conflict, use product language only:

«این نوبت از آخرین بازبینی شما تغییر کرده است. عملیات فعلی متوقف شد تا اطلاعات جدید بازنویسی نشود. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.»

Actions:

- review latest appointment;
- return to appointments.

Do not expose HTTP codes, ETag, version tokens, database terminology, ratings, certificates, CRM or finance.

Return only these three mobile screens.

---

# 24E — Mobile terminal-state details

## Select in Stitch

Select these existing desktop screens:

- Completed read-only detail
- Cancelled read-only detail
- No-show read-only detail

## Paste this prompt

Adapt the selected terminal Manager Appointments desktop screens into **mobile read-only detail screens around 390 CSS px**.

Create one compact detail screen for each final state:

- انجام‌شده;
- لغوشده;
- عدم حضور.

Each should show only:

- final status;
- reference ID;
- customer;
- booked services;
- specialist;
- historical date/time;
- total duration;
- booked total price.

Use «پرداخت در سالن» only if payment context is useful.

Terminal states must not expose reversible manager actions.

Do not add:

- payment settlement/accounting;
- invoice/POS;
- CRM/loyalty;
- resource/chair/studio assignment;
- print/receipt;
- clinical/credential claims.

Return only these three mobile screens.

---

## Mobile freeze gate

After 24A–24E are reviewed and accepted, freeze Manager Appointments Mobile.

Then create a separate Tablet adaptation workflow using selected Desktop + frozen Mobile screens as references.

Do not start Tablet before Mobile is accepted.
