# Stitch Review 14 — My Appointments first pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui(3).zip`  
**Package SHA-256:** `2e0e1d3a0748f547c78bbaa68ff9e918fef4dd2033051e7f950cf08e50a577dc`  
**Decision:** **Visual direction accepted, My Appointments baseline not frozen.** The mobile interaction language is promising, but several required states are missing, desktop evidence is missing, and multiple product-contract drifts remain.

## Screen map from the export

- `_7` — Upcoming appointments / mixed upcoming + history preview
- `_6` — Empty upcoming state
- `_8` — Active appointment detail, self-service eligible
- `_3` — Reschedule date/time selection
- `_4` — Reschedule review/confirmation
- `_1` — Reschedule stale-slot recovery
- `_2` — Cancel confirmation with hidden cancel-success modal
- `_5` — Inside-24-hours locked appointment detail

## What works

The first pass successfully extends the frozen Booking language into authenticated appointment management:

- clear upcoming appointment card;
- empty-upcoming treatment;
- active detail with reschedule/cancel actions;
- 24-hour locked state;
- focused reschedule flow where services and specialist remain fixed;
- 30-minute replacement start-grid direction;
- stale-slot recovery that preserves the original appointment;
- stale-slot replacement times are initially unselected and Continue is disabled;
- explicit destructive cancel confirmation;
- tabbed upcoming/history concept;
- status-chip language is coherent with the frozen product lifecycle;
- mobile-first composition remains visually consistent with Booking.

The visual direction should be refined, not redesigned.

## Blocking gaps before freeze

### 1. Desktop My Appointments evidence is missing

Prompt 14 required desktop representative screens for:

- upcoming/list;
- detail;
- reschedule;
- locked state;
- history.

The current export is entirely mobile/narrow.

My Appointments is one of the product's priority application surfaces, so desktop parity must be demonstrated before freeze.

### 2. Dedicated History list is not evidenced clearly enough

The upcoming screen contains a hidden/tabbed history panel and preview rows, but there is no dedicated exported History state showing the history tab active.

We need direct visual evidence for:

- history tab selected;
- Completed;
- Cancelled;
- No-show;
- opening a historical record.

### 3. Historical detail is missing

There is no dedicated past appointment detail showing an immutable booking snapshot.

Required historical detail:

- final status;
- booked services snapshot;
- specialist snapshot;
- historical date/time;
- duration;
- booked price snapshot;
- no self-service mutation controls.

### 4. Cancel confirmation and cancel success need separate visible evidence

The cancel screen contains a hidden success modal in code, but the screenshot only evidences the confirmation state.

Freeze evidence should include a distinct Cancelled success/detail state.

### 5. Reschedule confirmation and success should not be visually conflated

The reschedule-review file also contains success wording. The final baseline should clearly distinguish:

- review before committing the new time;
- successful updated appointment after commit.

The original appointment must remain unchanged until final reschedule confirmation succeeds.

## Product-contract drift that must be cleaned in the next pass

### 6. Cancellation fee policy was invented

The export repeatedly says:

- no cancellation fee;
- no deduction/cost;
- “بدون کسر هزینه کنسلی”.

The frozen Product Definition defines only the **24-hour self-service cutoff**.

It does not define cancellation fees, refunds, credits, or a free-cancellation policy.

Remove all fee/refund assertions.

### 7. SMS confirmation was invented

Cancel success and appointment-detail behavior mention confirmation SMS.

Messaging behavior is not frozen.

Do not promise cancellation/reschedule/reminder SMS.

### 8. Standalone account/favorites/profile destinations were reintroduced

The mobile navigation includes:

- علاقه‌مندی;
- حساب من / account;
- profile/person affordances.

The frozen v1 customer surface is My Appointments plus Booking and public pages.

Do not create Favorites or a standalone Profile/Account product from Stitch output.

### 9. Branch / spa positioning reappears

Examples include:

- شعبه فرشته;
- سالن زیبایی و اسپا;
- استودیو خصوصی;
- branch/location wording.

v1 is one women's beauty salon.

Use neutral single-salon wording only.

### 10. Ratings, credentials and seniority claims are unapproved

The active detail/reschedule review introduces:

- 4.9 rating;
- “master/senior stylist” style claims;
- proof-like specialist credentials.

Ratings/reviews are out of scope and credentials are fixture-only unless later verified.

Use neutral expertise labels.

### 11. Clinical / material / treatment claims reappear

History/service fixture copy includes:

- lymphatic massage;
- keratin/repair;
- spa/wellness terminology;
- other treatment/health framing.

Use neutral non-clinical beauty-service fixtures.

### 12. Payment wording is over-specified

The export says payment occurs “after service”.

The approved rule is only:

- **pay at salon**;
- no online payment/deposit.

Do not define before/after-service timing.

### 13. Mock address/map/contact facts are presented too concretely

The active detail includes a specific address, salon location, map and navigation content.

Business details remain mock unless supplied and approved.

Do not turn them into authoritative customer-history data.

### 14. Reschedule review uses “proposed” language after explicit selection

Once the customer has explicitly selected a replacement slot, the review should say **selected new time**, not “suggested/proposed new time”.

The system must not imply it chose the time.

### 15. Cancelled appointment semantics need exact final-state treatment

After cancellation:

- appointment status becomes Cancelled;
- it remains visible in history;
- no replacement booking is created automatically.

The current hidden success modal says it is archived, which is acceptable conceptually only if “history” is the customer-facing representation; do not invent a separate archive product.

## What can be reused

The following mobile patterns are strong and should be kept:

- `_7` upcoming card structure;
- `_6` empty-state composition;
- `_8` active-detail hierarchy;
- `_3` reschedule date/time composition;
- `_4` reschedule review structure;
- `_1` stale-slot recovery structure;
- `_2` destructive cancel confirmation pattern;
- `_5` locked-state hierarchy.

The next pass should correct/complete these patterns rather than generate a new design direction.

## Decision

**Do not freeze My Appointments yet.**

One focused completion pass is required for:

1. desktop parity;
2. explicit History active state;
3. Historical detail;
4. distinct Cancelled success/detail;
5. distinct Reschedule success;
6. cleanup of fees/SMS/profile/favorites/branch/ratings/clinical/payment/mock-business drift.
