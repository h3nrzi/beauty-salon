# ara-about-soft-editorial-v1

Status: **Frozen visual reference for About**  
Frozen: 2026-10-09

## Source export

Reviewed Stitch package:

`stitch_ara_beauty_salon_ui (4).zip`

Package SHA-256:

`85cac7ea778fb96c041f20d1de535b6d33a166895a9ce68dd44abb7b192fd346`

### Desktop reference

- screenshot dimensions: **452 × 1600**
- screenshot SHA-256: `f10445e54b9b906f705dfec75ac889d06316badb32d81a17fc5c9189b67a013e`
- HTML SHA-256: `cefc09b48fe4cef2cfdab07027393976e19dba7d6496b10423b2268f0e08b4dd`

### Mobile reference

- screenshot dimensions: **190 × 1600**
- screenshot SHA-256: `43215ce63a39effc483a2b7f23e34d827a5e082926fc50b58426386527e6f169`
- HTML SHA-256: `87044d40e3c58071444c30a8b839edfd43b3ec2d4ca4e2fb224fd8f2184f3b3c`

### Shared design-system source

- `DESIGN.md` SHA-256: `6c1bf8e48ab8cac06876523faf20219eb0ead32047999f44721e93f472dd1eb4`

## Accepted visual/interaction baseline

- Extends the frozen Home, Services, Specialists and Gallery references.
- About uses an editorial story → values → team → space → product-bridge structure.
- Team content remains a preview, not a duplicate Specialists catalog.
- Space/atmosphere imagery is conceptually useful and must remain explicitly non-authoritative until real salon media exists.
- About routes naturally toward Services, Specialists and Booking.
- Pay-at-salon remains consistent with the product.
- Mobile bottom navigation in this reference stays within approved public destinations.

## Known deterministic cleanup

Do not carry these Stitch literals into production:

- spa/wellness/health positioning beyond the approved beauty-salon product;
- plant-based/material-health claims;
- mandatory free consultation before every service;
- zero-wait / exact-on-time guarantees;
- 15-minute public start-grid wording;
- “first available specialist” semantics;
- SMS confirmation/reminder promises;
- payment-at-salon as a replacement for review/confirmation in the booking flow;
- exact experience years and unverified credentials;
- filtered ventilation / sound isolation / sterilization / facility guarantees;
- official-license claim without supplied evidence;
- satisfaction-dependent payment wording;
- unresolved legal/privacy destinations;
- mock address/phone/email/hours as production facts;
- generated HTML/Tailwind choices;
- unresolved display-font and color-token inconsistencies.

## Evidence boundary

The screenshots are useful design references but not final viewport acceptance evidence.

Later implementation acceptance must render realistic desktop/mobile viewports.

## Media boundary

All people/space imagery remains prototype/reference media.

Production acceptance requires explicit approved media rights and must not infer that pictured people or interiors belong to آرا.

## Important boundary

This is a **visual and interaction reference**, not authoritative product content and not production-ready HTML.

The frozen Product Definition remains authoritative over all literal Stitch copy and behavior.
