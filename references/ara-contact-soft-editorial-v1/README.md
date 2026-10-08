# ara-contact-soft-editorial-v1

Status: **Frozen visual reference for Contact**  
Frozen: 2026-10-09

## Source export

Reviewed Stitch package:

`stitch_ara_beauty_salon_ui (5).zip`

Package SHA-256:

`1b8c464e8c8ea7684997d85950a079337900675a393e51cf00e762ad650bb14f`

### Desktop reference

- screenshot dimensions: **2560 × 4394**
- screenshot SHA-256: `9c4adf22cbd4aefae2a756e909f39ea1bb6fda940f661b36a970ae2cbcbbb19f`
- HTML SHA-256: `b1cecea9e211e4a22940f87e8bfc5ed46efd22bce78e8a6f883ac0f8f98baa91`

### Mobile reference

- screenshot dimensions: **317 × 1600**
- screenshot SHA-256: `b4b3bda3ea214869dfd58952f0f814ce9eb7fa072214e65b5edb408766042eed`
- HTML SHA-256: `459fe68c0c776bfbcac2b389fe7b07f60929040a8112693888cc51eb0e2b34a3`

### Shared design-system source

- `DESIGN.md` SHA-256: `6c1bf8e48ab8cac06876523faf20219eb0ead32047999f44721e93f472dd1eb4`

## Accepted visual/interaction baseline

- Extends the frozen Home, Services, Specialists, Gallery and About references.
- Contact prioritizes phone/contact, directions, opening hours and Booking.
- The 24-hour self-change cutoff is visually prominent.
- «وقت‌های من» is the normal self-management path outside the final 24 hours.
- Inside the final 24 hours, customers are directed to contact the salon.
- Salon public hours are distinct from specialist booking availability.
- Directions are presented as a clear product action without requiring an embedded-map architecture.
- Legal/privacy content is visibly unresolved/placeholder rather than falsely published.

## Known deterministic cleanup

Do not carry these Stitch literals into production:

- “emergency reception contact” wording;
- parking/security/building-access claims;
- hard-coded Google Maps / نشان / بلد provider decisions;
- booking-SMS location-verification wording;
- 10-minute early-arrival rule;
- after-service payment timing beyond the approved pay-at-salon rule;
- standalone person/Profile affordance unless later approved;
- different mobile/desktop mock business datasets;
- mock phone/email/address/hours as production facts;
- generated HTML/Tailwind decisions;
- unresolved display-font and color-token inconsistencies.

## Evidence boundary

The mobile screenshot is useful design evidence but not final responsive acceptance at the intended handset width.

Later implementation acceptance must render realistic mobile/browser viewports.

## Important boundary

This is a **visual and interaction reference**, not authoritative salon business data and not production-ready HTML.

The frozen Product Definition remains authoritative over all literal Stitch copy and behavior.
