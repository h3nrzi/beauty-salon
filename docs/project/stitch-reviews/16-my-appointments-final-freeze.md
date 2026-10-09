# Stitch Review 16 — My Appointments final freeze pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (2)(1).zip`  
**Package SHA-256:** `17dfd0dec696bd6abdafbf6dfb480950f6f457778c0459ddc90e4cd8777bbecc`  
**Decision:** **Accept and freeze the My Appointments visual/interaction baseline.**

## What this pass resolves

Desktop parity is now present for the required representative customer-management states:

- Upcoming / list;
- Active appointment detail;
- Reschedule;
- Locked inside-24-hours detail;
- History active state;
- Historical detail.

Together with the previously accepted mobile state set from Review 15, the customer appointment-management experience now has sufficient visual/interaction coverage to freeze.

## Accepted desktop mapping

- `_1` — Upcoming / list
- `_2` — Active appointment detail
- `_3` — Reschedule date/time
- `_4` — History active state
- `_5` — Locked inside-24-hours detail
- `_6` — Historical detail

The desktop direction remains consistent with the frozen Booking system and does not introduce a different customer product model.

## Accepted mobile state set

The mobile structures accepted from the previous completion pass remain part of the baseline:

- Upcoming;
- Empty upcoming;
- Active appointment detail;
- Reschedule date/time;
- Reschedule review;
- Reschedule success;
- Reschedule stale-slot recovery;
- Cancel confirmation;
- Cancelled success/detail;
- Locked inside-24-hours detail;
- History active state;
- Historical detail.

## Remaining literal/content drift

The current desktop export still contains many literal fixture claims that are **not authoritative product behavior** and must be normalized during export audit / engineering handoff.

Examples include:

- “free cancellation / no deduction” wording;
- arrival-10-minutes-early guidance;
- add-to-calendar action;
- branch / central salon / studio wording;
- specific address, phone and location data;
- rating / seniority / credential claims;
- organic / keratin / collagen / clinical or wellness language;
- loyalty-member wording;
- package/free-item wording;
- bank transaction / invoice detail beyond the frozen product need;
- “payment after service” or other timing semantics beyond `pay at salon`;
- dedicated lockers, parking, hospitality and other business-operation claims.

These remain deterministic content cleanup. They do **not** reopen the visual baseline.

## Product contract remains authoritative

The frozen implementation must preserve:

- customer self-cancel/reschedule only until 24 hours before the appointment;
- inside the final 24 hours, self-change is locked and customer contacts the salon;
- reschedule changes date/time only;
- services stay unchanged;
- specialist stays unchanged;
- booked price snapshot stays unchanged;
- cancelled appointments remain visible in history;
- historical records use booking-time snapshots;
- no ratings/reviews/loyalty/refund/credit/profile/favorites product is introduced;
- payment wording remains simply `pay at salon`.

## Freeze decision

Freeze the customer appointment-management direction as:

`ara-my-appointments-soft-editorial-v1`

Accepted:

- customer appointment-list hierarchy;
- empty-state direction;
- appointment detail structure;
- 24-hour locked-state presentation;
- reschedule interaction direction;
- stale replacement-time recovery semantics;
- cancel confirmation pattern;
- cancelled-result/history treatment;
- history status presentation;
- historical immutable-detail presentation;
- desktop/mobile responsive product model.

Not authoritative:

- literal fixture copy;
- literal addresses/contact details;
- salon branch/studio references;
- ratings/credentials;
- clinical/material claims;
- fee/refund/payment-timing claims;
- loyalty/packages;
- calendar/SMS integrations;
- generated HTML/framework choices.

## Next step

Proceed to the salon operational experience, beginning with **Manager — Appointments**.
