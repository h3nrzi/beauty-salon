# ara-specialists-soft-editorial-v1

Status: **Frozen visual reference for Specialists**  
Frozen: 2026-10-08

## Source export

Reviewed Stitch package:

`stitch_ara_beauty_salon_ui (2).zip`

Package SHA-256:

`0c709543012ede16b589634c584e0f27c3c3a3f8756e430b25da03529c4f1cf6`

### Desktop reference

- screenshot dimensions: **555 × 1600**
- screenshot SHA-256: `606dcf2d1d2a0438fe91cf0d31b712f205486eec63f8bd2c97fc14493b7d450d`
- HTML SHA-256: `72528dbe7412ce5531fc0a664a9682bca5e6e2a2d2a49f0b136c970464583127`

### Mobile reference

- screenshot dimensions: **177 × 1600**
- screenshot SHA-256: `279cc7f64ccf755400a36a128725649f8cc7a817429ed67e895a1f5f14f0337d`
- HTML SHA-256: `cede8a381f46a9c86bc21fc0d7a3abc8a4d08cb7a203c6c7c4eeb9e23762099e`

### Shared design-system source

- `DESIGN.md` SHA-256: `6c1bf8e48ab8cac06876523faf20219eb0ead32047999f44721e93f472dd1eb4`

## Accepted visual/interaction baseline

- Extends `ara-home-soft-editorial-v1` and `ara-services-soft-editorial-v1`.
- Specific-specialist discovery and «هر متخصص در دسترس» are both first-class paths.
- Specialist cards expose portrait, identity, expertise context, eligible services and booking action.
- “Any available specialist” has a clear explanatory block and CTA.
- Portrait photography is natural/editorial rather than social-profile styled.
- Page remains public-discovery oriented, not an admin directory.
- Pay-at-salon remains visible.

## Known deterministic cleanup

Do not carry these Stitch literals into production:

- 15-minute public slot wording — public starts use a 30-minute grid.
- SMS reminder/confirmation promises.
- payment-at-salon as a booking-step replacement for review/confirmation.
- “fastest time” assignment semantics.
- 12-hour cancellation rule — approved rule is 24 hours.
- exact years of experience or nearest-appointment text as real facts.
- clinical/physiological/laser/sunburn guidance without explicit product approval.
- sterilization/material guarantees.
- “simultaneous services” wording — selected services are consecutive with one specialist.
- standalone Profile destination unless later approved.
- mock business data as production truth.
- generated HTML/Tailwind decisions.
- unresolved display-font and color-token inconsistencies.

## Evidence boundary

The mobile screenshot is too narrow to serve as final handset visual evidence. The baseline freezes design intent, not final responsive acceptance. Later implementation acceptance must render normal mobile widths.

## Important boundary

This is a **visual and interaction reference**, not an authoritative specialist dataset and not production-ready HTML.

Product Definition remains authoritative over all literal Stitch copy and behavior.
