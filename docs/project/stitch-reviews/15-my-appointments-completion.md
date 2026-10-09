# Stitch Review 15 — My Appointments completion pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (1)(1).zip`  
**Package SHA-256:** `43efa50f74646d12cbe6ac0e88e96b1e292c582eb7db21b4703477a0363f416d`  
**Decision:** **Do not freeze My Appointments yet.** Mobile state coverage is now substantially complete, but desktop evidence is still missing and several literal product-contract drifts remain.

## What improved

The export now provides explicit mobile evidence for the previously missing states:

- Upcoming appointments;
- Empty upcoming;
- Active appointment detail;
- Reschedule date/time;
- Reschedule review;
- Reschedule success;
- Reschedule stale-slot recovery;
- Cancel confirmation;
- Cancelled success/detail;
- Locked inside-24-hours detail;
- History with the History tab active;
- Historical detail.

This closes most of the state-coverage gaps from Review 14.

### Strong reusable mobile patterns

The following directions are visually acceptable and should be preserved:

- upcoming card/list hierarchy;
- empty-state composition;
- active appointment detail;
- focused reschedule date/time screen;
- reschedule stale-slot recovery;
- destructive cancel confirmation;
- locked-state presentation;
- history list;
- historical-detail hierarchy;
- cancelled-detail structure;
- reschedule-success structure.

Do not redesign these patterns.

## Remaining blockers before freeze

### 1. Desktop evidence is still missing

Prompt 15 required desktop evidence around 1440 CSS px for:

- Upcoming / list;
- Active appointment detail;
- Reschedule;
- Locked state;
- History;
- Historical detail.

The current export is still mobile/narrow-only.

My Appointments is a priority application surface. It cannot be frozen until the same product model is demonstrated on desktop.

### 2. Reschedule review still says the explicitly selected time is “proposed”

The review screen still uses wording equivalent to:

**زمان جدید انتخابی: پیشنهادی**

Once the customer explicitly picked the slot, the authoritative wording must be:

**زمان جدید انتخاب‌شده**

The UI must not imply the system proposed or chose it.

### 3. Cancellation-fee policy is still being invented

Several screens and the generated design-system delta still say:

- no cancellation fee;
- no deduction;
- 0 تومان fee;
- no charge.

The frozen product contract defines only the 24-hour eligibility cutoff.

It does **not** define fees, refunds, credits or a free-cancellation policy.

Remove all fee/refund assertions.

### 4. SMS behavior still appears in cancellation flow

Cancel confirmation/success content still contains SMS confirmation language.

Messaging behavior is not frozen.

Do not promise SMS for cancellation, reschedule or reminders.

### 5. Favorites / standalone Account still appear in navigation

The empty state still exposes:

- علاقه‌مندی;
- حساب من.

These are outside frozen v1 scope.

Approved customer destinations remain:

- وقت‌های من;
- رزرو وقت;
- public-site destinations where appropriate.

### 6. Branch / spa / studio positioning still appears

Examples remain:

- شعبه فرشته;
- سالن زیبایی و اسپا;
- استودیو مرکزی / private studio wording.

v1 is a single women's beauty salon.

Use neutral single-salon wording only.

### 7. Ratings / credentials / seniority claims remain

The active-detail and review screens still contain:

- specialist rating;
- senior/master stylist language;
- proof-like credential wording.

Ratings/reviews are out of scope, and credentials are not approved production facts.

Use neutral specialist expertise only.

### 8. Clinical/material fixture copy remains

Examples include:

- lymphatic massage;
- keratin/recovery framing;
- spa/wellness treatment wording.

Use neutral non-clinical beauty-service fixture content.

### 9. Payment timing is still over-specified

Some screens say payment occurs after service.

The frozen rule is only:

**پرداخت در سالن**

Do not define whether payment happens before or after service.

### 10. Mock business details are still too authoritative

Specific address / salon location / phone / map copy appear as if they are real.

These are fixture values only until supplied and approved.

### 11. Generated My Appointments spec contains a false fee rule

The package's `my_appointments_spec.md` states cancellation confirmation is “without fee / deposit”.

That document must not be treated as authoritative product contract.

Product Definition remains authoritative.

## Freeze gate

My Appointments can be frozen after one final narrow pass that:

1. provides desktop parity;
2. changes “proposed new time” to “selected new time”;
3. removes fee/refund/SMS/profile/favorites/branch/spa/rating/clinical/payment-timing drift;
4. keeps current mobile state structures instead of redesigning them.

No new art direction is needed.
