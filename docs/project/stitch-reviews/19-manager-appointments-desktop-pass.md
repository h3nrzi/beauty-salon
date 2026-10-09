# Stitch Review 19 — Manager Appointments desktop-focused pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (5)(1).zip`  
**Decision:** **Desktop structure is now substantially complete, but the desktop baseline is not frozen yet. Mobile/tablet review is intentionally deferred by product-owner decision until desktop is finished.**

## Sequencing decision

From this point:

1. finish and freeze **Manager Appointments — Desktop**;
2. only then design/review the compact mobile/tablet version.

Mobile/tablet absence is therefore **not a blocker for the current desktop freeze gate**.

## What improved on desktop

This pass resolves several previous desktop issues:

- workspace/list uses only the approved lifecycle statuses;
- search/filter uses Confirmed / Completed / Cancelled / No-show;
- manual/new appointment creation is no longer prominent in the workspace;
- reschedule start times now follow a 30-minute grid;
- stale reschedule preserves the original appointment and starts with no replacement selected;
- reassignment has dedicated eligible / invalid-unavailable states;
- concurrent-change conflict is expressed in product-level language rather than raw HTTP/ETag terminology;
- Completed and No-show read-only detail states exist;
- cancellation, reschedule, reassignment and conflict coverage is now broad enough for a desktop freeze candidate.

The desktop information architecture and interaction hierarchy should **not be redesigned**.

## Desktop screen map

- `_13` — workspace/list
- `_9` — search/filter result
- `_12` — active appointment detail
- `_7` — cancel confirmation
- `_11` — cancelled read-only detail
- `_10` — reschedule date/time
- `_8` — reschedule review/result
- `_4` — stale reschedule recovery
- `_6` — reassignment
- `_5` — invalid/unavailable reassignment
- `_3` — concurrent-change conflict
- `_2` — Completed read-only detail
- `_1` — No-show read-only detail

## Remaining desktop blockers

### 1. Fee / payment semantics still drift from the frozen contract

Examples include:

- «هزینه جابه‌جایی: رایگان»;
- “settled / تسویه” wording;
- payment-status language;
- financial snapshot sections that behave like accounting.

The frozen product rule is only:

**پرداخت در سالن**

Manager may see the booked total price, but v1 does not manage payment state, refunds, fees, deposits, invoices or cashier operations.

### 2. CRM / loyalty / customer-scoring content remains

Examples include:

- عضو ویژه;
- مشتری الماس;
- previous-successful-visit counts;
- customer IDs/history framed as CRM data.

CRM and loyalty are outside v1.

Keep only appointment-relevant customer identity:
- name;
- verified mobile snapshot;
- optional email;
- appointment/reference ID.

### 3. Ratings / credentials / clinical positioning remain

Examples include:

- ارشد / master-style proof language;
- dermatology/clinical expertise;
- certificate-like specialist positioning;
- treatment/therapy-oriented wording.

Use neutral specialist expertise only.

Reassignment eligibility is determined by:
- ability to perform all booked services;
- availability for the full interval.

### 4. Wellness / organic / treatment fixture copy remains

Examples include:

- spa;
- organic oils;
- lymphatic / treatment / therapeutic wording;
- “درمانگر پوست”.

Use neutral beauty-service fixtures.

### 5. Chair / studio / station resource management remains

Examples include:

- VIP chair;
- studio number;
- salon unit / service cabin.

These resources are not in v1 scope.

Remove them from the desktop baseline.

### 6. Printing / receipt / financial-history concepts remain

Completed/terminal details still imply:

- financial settlement history;
- receipt/invoice semantics;
- print-style operational concepts.

Terminal appointment detail should be a simple read-only booking snapshot.

### 7. Cancellation copy exposes implementation/database semantics

The cancel confirmation says the action is irreversible “in the database” and exposes session/log identifiers.

The user-facing manager UI should say only:

- cancellation is final for that appointment;
- status becomes Cancelled;
- the appointment remains a read-only historical record.

Do not expose database/session implementation concepts.

### 8. Concurrent conflict still contains unrelated scope drift

The interaction pattern is now correct, but the screen still contains:

- customer loyalty tier;
- chair/studio assignment;
- premium/central-studio language;
- verbose internal history.

Keep the conflict state focused on:
- appointment changed elsewhere;
- operation stopped;
- review latest state;
- retry only after review.

### 9. Reassignment copy is over-elaborate and contains non-product claims

The reassignment structures are good, but copy still contains:

- financial/settlement wording;
- senior/master credential language;
- department/clinical specialization;
- nearby-slot recommendations not needed for reassignment.

Keep reassignment strictly about:
- current specialist;
- booked services;
- unchanged date/time/duration/price;
- eligible + available replacement specialists;
- explicit confirmation.

### 10. Terminal details are too operationally rich

Completed / Cancelled / No-show details should not become mini CRM/accounting records.

Keep only:
- final status;
- reference ID;
- customer;
- booked services snapshot;
- specialist;
- date/time;
- duration;
- booked total price;
- pay-at-salon context if useful.

No reversible actions.

## Desktop freeze gate

Desktop Manager Appointments may be frozen after one final **desktop-only cleanup pass** that:

1. preserves all current screen structures;
2. removes fee/accounting/payment-state semantics;
3. removes CRM/loyalty/customer scoring;
4. removes ratings/credentials/clinical/wellness claims;
5. removes chair/studio/resource-management concepts;
6. removes database/session/log implementation text;
7. simplifies terminal details to read-only appointment snapshots;
8. keeps the 30-minute reschedule grid and current conflict/reassignment semantics.

After desktop freeze, a separate mobile/tablet prompt will be created.
