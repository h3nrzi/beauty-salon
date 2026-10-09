# ara-my-appointments-soft-editorial-v1

Status: **Frozen visual/interaction reference for My Appointments**  
Frozen: 2026-10-09

## Reference sources

### Mobile reference set

Use the accepted mobile state structures from Review 15 / the prior My Appointments completion export.

Accepted mobile states:

- Upcoming
- Empty upcoming
- Active appointment detail
- Reschedule date/time
- Reschedule review
- Reschedule success
- Reschedule stale-slot recovery
- Cancel confirmation
- Cancelled success/detail
- Locked inside-24-hours detail
- History active state
- Historical detail

### Desktop reference package

`stitch_ara_beauty_salon_ui (2)(1).zip`

SHA-256:

`17dfd0dec696bd6abdafbf6dfb480950f6f457778c0459ddc90e4cd8777bbecc`

Desktop screens:

- Upcoming/list — `_1/screen.png`
  - screenshot SHA-256: `4e25797f68acf8be084867db508a474dafd16bb2bdeb3c6c57decb10be92b12c`
- Active detail — `_2/screen.png`
  - screenshot SHA-256: `617d16f69189cbd9a531999d2a3d1e4eca8ec30147b5701bc234c8fbe7f2ce6f`
- Reschedule — `_3/screen.png`
  - screenshot SHA-256: `f728f9007897c23b766b79354bdb4fbd6cda8cb550f2eabf09ead7ce0e6c9cf8`
- History — `_4/screen.png`
  - screenshot SHA-256: `7c70a56311574578e71873793e2179dac3f493c08405e3882e509937e1d1f148`
- Locked <24h — `_5/screen.png`
  - screenshot SHA-256: `dc96d91db6d27a283c20d457b924336bcefaa42d98ea9a97895e3e95c1162506`
- Historical detail — `_6/screen.png`
  - screenshot SHA-256: `e91052ea340c898bf5ad5482ffff6f1be4bb38baec374d6588a45b0633e47438`

## Accepted interaction semantics

- Upcoming appointments are discoverable and ordered nearest first.
- Customer can open appointment detail.
- Eligible appointments allow cancel/reschedule.
- Reschedule changes only date/time.
- Services and specialist remain fixed.
- Inside the final 24 hours, self-change is locked and customer contacts the salon.
- Stale replacement-time recovery preserves the original appointment and requires explicit selection of a new time.
- Cancelled appointments remain visible in history.
- Historical details use immutable booking-time snapshots.
- Customer-visible lifecycle remains Confirmed / Completed / Cancelled / No-show.

## Deferred deterministic cleanup

Do not carry literal Stitch fixtures into production where they conflict with Product Definition.

Normalize:

- free-cancellation / fee / refund claims;
- branch/studio/spa wording;
- ratings/credentials;
- clinical/material/wellness claims;
- loyalty/packages;
- arrival-time rules;
- SMS/calendar/share behavior;
- literal mock address/phone/map details;
- payment timing beyond `pay at salon`;
- generated HTML/framework choices.

## Important boundary

This freezes visual structure and interaction semantics only.

Product Definition remains authoritative over behavior and production content.
