# Stitch Review 17 — Manager Appointments first pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (3)(1).zip`  
**Package SHA-256:** `3765d27d042eb198b53847666f7f251d0b5011eb37a7f132eb83d84970550e9b`  
**Decision:** **Visual direction accepted, Manager Appointments baseline not frozen.** The export establishes a good desktop operational language, but it only covers three states and still introduces several capabilities/statuses outside the frozen v1 contract.

## Screen map

- `_1` — Manager appointments workspace / daily list
- `_2` — Appointment detail
- `_3` — Search/filter result view

## What works

The first operational pass has a strong structural direction:

- clear desktop-first manager shell;
- right-side operational navigation;
- appointments table/list with time, customer, specialist, services, duration and status;
- compact status summary at the top;
- search + date/status/specialist filtering;
- appointment-detail hierarchy;
- booked-service snapshot presentation;
- customer identity snapshot;
- manager actions for reschedule / reassign / cancel are surfaced;
- visual language still belongs to the same آرا system without looking like a marketing page.

The visual system should be refined, not redesigned.

## Blocking coverage gaps

Prompt 17 required explicit operational flows/states for:

- cancel confirmation + cancelled result;
- reschedule flow;
- stale/conflict reschedule state;
- specialist reassignment flow;
- invalid/unavailable reassignment state;
- representative Completed / Cancelled / No-show detail states;
- compact mobile/tablet lookup/detail direction.

None of these are sufficiently evidenced yet.

The current export only gives workspace/search/detail.

Manager Appointments cannot be frozen until the mutation and conflict states are designed.

## Product-contract drift to remove

### 1. Manual appointment creation was invented

The workspace includes:

- «ثبت نوبت دستی»
- «ثبت نوبت جدید»
- keyboard shortcut for instant appointment creation.

Manual appointment creation is **not** in the frozen v1 salon-operations scope.

The confirmed manager scope is to manage existing appointments, not create arbitrary bookings from the operations panel.

Remove this capability unless product scope is explicitly changed.

### 2. Unsupported statuses were introduced

The search/filter screen includes statuses such as:

- «در انتظار تایید»
- «در حال پذیرش و ارائه»

The frozen appointment lifecycle is centered on:

- Confirmed
- Completed
- Cancelled
- No-show

There is no pending-approval stage because successful bookings are immediately Confirmed.

Remove unsupported workflow statuses.

### 3. Payment/settlement operations are being invented

The workspace/detail introduces operational payment semantics such as:

- «تسویه شده در سالن»
- «در انتظار تعیین تکلیف»
- invoice / settlement wording.

The frozen product rule is only:

- pay at salon;
- no online payment/deposit.

v1 does not define a cashier/accounting/payment-status workflow.

The manager may see booked total price and `پرداخت در سالن`, but should not manage settlement states unless scope is expanded.

### 4. Cancellation fee/refund semantics reappear

Cancelled rows include wording such as:

- «بدون کسر وجه».

No cancellation fee/refund policy is defined.

Remove fee/refund/credit semantics.

### 5. CRM-like customer history was introduced

The search result says:

- membership since a given date;
- no lateness recorded;
- “without CRM record” phrasing.

v1 explicitly excludes CRM.

Keep only information needed to identify/manage the appointment:

- customer name;
- verified mobile snapshot;
- optional email snapshot;
- appointment/reference ID.

Do not infer customer history, loyalty, attendance scoring or CRM state.

### 6. SMS/notification behavior was invented

The detail/search screens say operational changes or reminders automatically send SMS to customer/specialist.

Messaging delivery behavior is not frozen.

Do not promise SMS/reminder notifications.

### 7. VIP chair / station assignment is out of scope

The detail introduces:

- dedicated VIP chair;
- workstation/seat assignment.

Chair/station resource management is not in v1.

Do not add seat/chair/resource-allocation product scope.

### 8. Reception slip / printing was invented

The search result includes «فیش پذیرش» / print behavior.

Printing/reception-slip workflows are not confirmed v1 capabilities.

Remove them from the baseline unless deliberately added later.

### 9. “Live synchronization / shift capacity” operational claims are too broad

The screen contains:

- live-sync claims;
- shift-capacity percentage;
- “one slot left” operational analytics;
- guidance around seat optimization.

These drift toward analytics/resource-management and are outside v1.

A manager can filter/search appointments and act on availability, but do not create dashboard analytics or resource-capacity products.

### 10. Manager actions are over-permissive in copy

The helper says confirmed appointments may be changed up to 15 minutes before start.

No such manager cutoff exists in Product Definition.

Do not invent a manager 15-minute change window.

Manager actions should be allowed when the underlying operation remains valid; exact engineering guards will be specified later.

### 11. Multi-service wording implies simultaneous service delivery

The helper says services may be “همزمان/پیوسته”.

The frozen booking model is:

- one appointment;
- one specialist;
- selected services performed consecutively.

Use unambiguous consecutive wording only.

### 12. Specialist/business fixture claims remain non-authoritative

The export includes:

- senior/master expertise labels;
- salon-specific station names;
- exact business details.

Keep fixture copy neutral and do not promote it to product facts.

## What can be reused

These visual patterns are strong:

- `_1` operational appointments workspace;
- `_3` search/filter layout;
- `_2` detail page structure;
- right-side operational navigation;
- compact status chips;
- RTL table/list treatment;
- manager action block.

The next pass should complete the missing operation flows and clean literal scope drift without changing the overall visual direction.

## Decision

**Do not freeze Manager Appointments yet.**

One focused completion pass is required for:

1. cancel confirmation/result;
2. reschedule + stale/conflict recovery;
3. specialist reassignment + invalid/unavailable state;
4. representative terminal-state detail;
5. compact mobile/tablet lookup/detail;
6. removal of manual-booking, unsupported statuses, payment-tracking, CRM, SMS, chair/resource, print and analytics drift.
