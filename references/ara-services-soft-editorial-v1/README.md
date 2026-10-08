# ara-services-soft-editorial-v1

Status: **Frozen visual reference for Services**  
Frozen: 2026-10-08

## Source export

Reviewed Stitch package:

`stitch_ara_beauty_salon_ui (1).zip`

Package SHA-256:

`8e4b1ea24005ebb34d5f678f3de4826e1fb03eb5592b6f85f97f57cd821f6e1f`

### Desktop reference

- screenshot dimensions: **656 × 1600**
- screenshot SHA-256: `9c2e0a1636f15343c5708b0881699db1a8275f9c3ebe3ee2a5113e0700c29c03`
- HTML SHA-256: `5372b4b860e9e559f98899d750dc6d04e4d1cc680c0d895400259068dbebba72`

### Mobile reference

- screenshot dimensions: **324 × 1600**
- screenshot SHA-256: `49bf0a083a66b903c8cbef86f295062d52c804dc4db38d649eaa5a02d377ba90`
- HTML SHA-256: `7439458454c9a7fcac3b146382d4a29910197a6ec8ac995219718d876b2cfa61`

### Shared design-system source

- `DESIGN.md` SHA-256: `6c1bf8e48ab8cac06876523faf20219eb0ead32047999f44721e93f472dd1eb4`

## Accepted visual/interaction baseline

- Extends `ara-home-soft-editorial-v1`.
- Full Services page is richer than Home's 3-service preview.
- Services expose description, duration, price and eligible specialist context.
- Multi-service selection is explicit.
- Selected state uses text/icon/border, not color alone.
- Incompatible combinations receive a clear visible state.
- Selected-service summary exposes total duration and total price.
- Desktop may use a persistent side summary.
- Mobile may use a compact bottom summary above primary navigation.
- Primary continuation leads to specialist/time selection.
- Pay-at-salon remains explicit.

## Known deterministic cleanup

Do not carry these Stitch literals into production:

- 6-hour cancellation rule — approved policy is 24 hours.
- guaranteed sterilization / organic / certified / vegan-material claims.
- therapeutic or physiological outcome claims.
- automated split-booking promise for incompatible service sets.
- “estimated” labels for fixed total duration/price.
- separate mobile vs desktop service inventories.
- standalone Profile destination unless later approved.
- mock address, phone, hours, names and prices as production facts.
- generated HTML/Tailwind decisions.
- unresolved Noto Serif and primary-token inconsistencies already tracked from the Home baseline.

## Important boundary

This is a **visual and interaction reference**, not an authoritative product-data fixture and not production-ready HTML.

Product Definition remains authoritative over all literal Stitch copy and behavior.
