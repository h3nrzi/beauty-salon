# Stitch Review 18 — Manager Appointments completion pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (4)(1).zip`  
**Package SHA-256:** `60bf82be0a6b4b9d629648d31c65ba570123c1e4e6ea3e4b79142bd24ffb5f3c`  
**Decision:** **Do not freeze Manager Appointments yet.** Coverage is now strong on desktop, but responsive/mobile evidence is still missing and several product-semantic issues remain in active operational states.

## Screen map

- `_13` — appointments workspace/list
- `_11` — search/filter result
- `_12` — appointment detail
- `_10` — cancel confirmation
- `_9` — cancelled result/detail
- `_8` — reschedule date/time
- `_6` — reschedule review/confirmation
- `_7` — reschedule stale/conflict recovery
- `_5` — specialist reassignment
- `_4` — invalid/unavailable reassignment
- `_3` — concurrent-change conflict
- `_2` — Completed historical detail
- `_1` — No-show historical detail

## What improved

The desktop operational coverage is now materially complete:

- workspace/list and filters;
- appointment detail;
- destructive cancel confirmation;
- cancelled read-only result;
- reschedule selection and review;
- stale-slot recovery with original appointment preserved;
- reassignment flow;
- invalid/unavailable reassignment state;
- concurrent-change conflict concept;
- Completed and No-show read-only detail.

The visual direction remains accepted. Do not redesign the manager shell, table/list language, action hierarchy or detail structure.

## Remaining blockers

### 1. Mobile/tablet operational evidence is still missing

Prompt 18 explicitly required a compact responsive representation for:

- appointment lookup/list;
- appointment detail;
- primary manager actions where appropriate.

All exported screens are desktop-sized. Manager Appointments cannot be frozen until compact responsive evidence exists.

### 2. Reschedule stale-state uses invalid 15-minute-offset start times

The stale/reschedule screen offers times such as:

- 11:45
- 14:15
- 18:45

The frozen scheduling rule uses a **30-minute public appointment start grid**.

Manager rescheduling of a customer appointment must use the same valid appointment-start model unless a later product decision explicitly changes it.

Use starts such as 11:30, 12:00, 14:30, 15:00, etc., subject to availability and duration.

### 3. Deposit/prepayment was introduced

The reschedule screens contain:

- «پیش‌پرداخت دریافت‌شده»
- «بیعانه واریزی»
- transfer/preservation of deposit language.

v1 explicitly has **no online deposit/payment flow**.

Use only:
- booked total price snapshot;
- **پرداخت در سالن**.

Do not add deposit/prepayment state.

### 4. Search/filter still includes unsupported statuses

The search/filter screen still includes:

- «در انتظار تأیید»
- «در حال پذیرش و ارائه»

The frozen lifecycle remains:

- Confirmed
- Completed
- Cancelled
- No-show

Successful bookings do not wait for manager approval.

### 5. Payment/accounting state is still being managed

Workspace/detail/terminal screens include:

- settled / unpaid / invoice state;
- transaction references;
- POS details;
- finance/archive language.

v1 has no cashier/accounting/settlement workflow.

Manager may see:
- booked total price;
- **pay at salon** context.

Do not design financial-state management.

### 6. CRM / loyalty / attendance history remains

Examples include:

- VIP / gold / diamond customer;
- membership history;
- prior successful visits;
- lateness/no-show history;
- customer record identifiers.

CRM and loyalty are explicitly out of scope.

Only appointment-relevant customer identity should be shown.

### 7. Ratings / credentials / clinical expertise remain

Reassignment and detail screens include:

- ratings;
- international certificates;
- master/senior proof claims;
- dermatology/clinical treatment wording.

Use neutral specialist expertise and eligibility only.

Eligibility is determined by booked services + actual availability, not marketing credentials.

### 8. SMS / calendar notification behavior remains

Some screens say SMS/calendar notifications are automatically sent after operations.

Messaging/delivery behavior is not frozen.

Do not promise SMS or calendar notifications.

### 9. Chair/studio/resource assignment remains

The export still contains:

- VIP chair;
- unit/station number;
- studio allocation.

Chair/station/resource management is not in v1.

Remove these literals from the authoritative baseline.

### 10. Printing / receipt workflow remains

The Completed detail includes «چاپ رسید» and payment-receipt history.

Printing and receipt/accounting workflows are not in confirmed scope.

### 11. Concurrent-change screen exposes implementation details

The conflict screen includes:

- `409 CONFLICT`;
- ETag/version strings;
- optimistic-locking terminology.

The **interaction concept** is correct: do not silently overwrite stale data.

But Stitch must not prescribe engineering implementation.

Use product-level wording such as:

- «این نوبت از آخرین بازبینی شما تغییر کرده است.»
- «آخرین اطلاعات را دوباره بررسی کنید.»

Do not expose HTTP/status/version-token implementation concepts in the baseline.

### 12. Reassignment flow still contains unrelated business/product scope

Reassignment screens include:

- loyalty/customer-club wording;
- emergency sick-leave narrative;
- payment/final invoice semantics;
- notification guarantees;
- ratings/certificates.

The accepted reassignment product semantics are only:

- current specialist;
- booked services;
- unchanged date/time;
- unchanged duration;
- unchanged booked price;
- eligible + available replacement specialists;
- explicit manager selection/confirmation;
- invalid/unavailable options blocked.

### 13. Historical/terminal details are over-specified

Completed/Cancelled/No-show screens include:

- POS transaction references;
- invoice issuance;
- check-in/exit operational timeline;
- salon-unit/studio assignment;
- CRM history;
- print actions;
- refund/debt language.

For v1, terminal appointment detail should remain a read-only appointment snapshot with status and core booking information.

## Freeze gate

One narrow final pass remains.

Manager Appointments can be frozen after:

1. compact mobile/tablet list + detail evidence exists;
2. reschedule start times conform to the 30-minute grid;
3. deposits/prepayments are removed;
4. unsupported statuses are removed;
5. active operational screens are cleaned of accounting/CRM/loyalty/SMS/resource/print/clinical/credential drift;
6. concurrent conflict is expressed at product level, without HTTP/ETag implementation language.

No further art-direction exploration is needed.
