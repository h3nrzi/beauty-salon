# Stitch Review 20 — Manager Appointments desktop final-freeze attempt

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (6)(2).zip`  
**Decision:** **Desktop is still not frozen.** The screen coverage and interaction structure are now strong enough, but the pass did not fully complete the requested product-contract cleanup.

## Sequencing

Per product-owner decision:

- finish **Manager Appointments — Desktop** first;
- mobile/tablet remains intentionally deferred;
- absence of mobile/tablet is not a blocker in this review.

## What is now accepted structurally

All required desktop patterns exist and should not be redesigned:

- workspace/list;
- search/filter;
- active appointment detail;
- cancel confirmation;
- Cancelled read-only detail;
- reschedule date/time;
- reschedule review;
- stale reschedule recovery;
- specialist reassignment;
- invalid/unavailable reassignment;
- concurrent-change conflict;
- Completed read-only detail;
- No-show read-only detail.

Also accepted:

- only Confirmed / Completed / Cancelled / No-show are used in main workspace filters;
- reschedule start choices now use the 30-minute grid;
- stale reschedule preserves the original appointment;
- reassignment keeps date/time/services/duration fixed;
- concurrent-change conflict is mostly expressed in product language.

## Remaining desktop blockers

### 1. Active detail still exposes out-of-scope payment/CRM/resource/messaging behavior

The active detail still contains:

- «شیوه تسویه حساب» / settlement-style language;
- «مبلغ کل فاکتور»;
- «بدون پرونده CRM»;
- VIP chair / dedicated salon seat;
- automatic SMS notification promise.

The accepted v1 display is simply:

- booked total price;
- **پرداخت در سالن**;
- appointment/customer/service/specialist information.

No CRM, chair/resource management, invoice/settlement workflow or SMS guarantee.

### 2. Cancel confirmation still references prepayment/transaction concepts

The cancel confirmation says:

- «بدون تراکنش پیش‌پرداخت».

Even saying there is no prepayment still introduces an unsupported payment-state model.

Remove all deposit/prepayment/transaction wording.

Cancellation confirmation only needs the appointment snapshot + irreversible Cancelled outcome.

### 3. Reschedule review still contains treatment/settlement/notification drift

The review contains:

- «فرآیند درمان»;
- material/consumable preservation semantics;
- settlement-account language;
- notification-system/update copy.

Keep the review focused on:

- old time;
- selected new time;
- fixed services;
- fixed specialist;
- fixed duration;
- fixed booked price;
- **پرداخت در سالن**;
- final confirm.

### 4. Stale reschedule confuses 30-minute grid with appointment duration

The stale recovery correctly uses start times on a 30-minute grid, but each available start is labelled:

- «مدت: ۳۰ دقیقه».

That is incorrect.

The appointment itself remains **135 minutes** in this fixture.

30 minutes is the **start-time grid interval**, not the appointment duration.

Show start times only (or explicitly label the unchanged full appointment duration separately). Do not label each start as a 30-minute service duration.

### 5. Stale recovery still contains technical/protocol language

The screen still references:

- «پروتکل رزرو شماره ۴۰۹»;
- transaction/security wording.

Remove these implementation/protocol concepts. The customer/manager-facing state only needs to say the selected replacement is no longer available and the original appointment is unchanged.

### 6. Reassignment invalid state still uses proof/clinical/department language

The invalid/unavailable reassignment state still contains:

- master-style title;
- department/service-line framing;
- facial/skin-care clinical-style categories.

Use neutral specialist expertise and eligibility language only.

The state should say only:

- specialist cannot perform all booked services; or
- specialist is unavailable for the full appointment interval.

### 7. Reassignment success still contains invoice/settlement/database language

The reassignment flow still says:

- invoice/factor remains unchanged;
- settlement language;
- «ثبت در پایگاه داده».

Use product language only:

- assigned specialist changed;
- services/date/time/duration/booked price stayed unchanged;
- appointment remains Confirmed.

Do not expose persistence/database wording.

### 8. Concurrent-change conflict still contains payment-timing and studio drift

The conflict screen still includes:

- settlement state;
- «تسویه پس از ارائه خدمت»;
- central studio wording;
- unnecessary internal timeline/notes.

Keep only:

- this appointment changed since the manager last viewed it;
- operation was stopped;
- latest state is shown;
- manager must review before retrying.

### 9. Completed detail still contains transaction/accounting semantics

The Completed historical detail still says:

- no new transaction can be issued;
- financial/archive semantics;
- treatment-style fixture wording.

A terminal detail should be a simple immutable appointment snapshot, not an accounting record.

### 10. No-show detail still contains clinical fixture language

The No-show detail uses:

- facial / skin-care treatment phrasing.

Use neutral beauty-service fixture copy.

### 11. “Senior manager / senior specialist” wording risks role/credential expansion

The UI repeatedly uses «مدیر ارشد» and specialist labels such as «آرایشگر ارشد».

The product has one operational role named **Manager**, not a hierarchy of manager levels.

Use «مدیر سالن» for the signed-in manager. Use neutral specialist expertise rather than senior/master proof labels.

## Freeze decision

**Do not freeze desktop yet.**

No visual redesign is needed. One final literal/semantic cleanup pass is sufficient.

The next pass should preserve every current desktop layout and interaction pattern and replace only the remaining out-of-scope / misleading content.

After that, freeze Manager Appointments Desktop and then start a separate mobile/tablet pass.
