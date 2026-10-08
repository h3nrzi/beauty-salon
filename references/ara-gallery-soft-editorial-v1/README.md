# ara-gallery-soft-editorial-v1

Status: **Frozen visual reference for Gallery**  
Frozen: 2026-10-08

## Source export

Reviewed Stitch package:

`stitch_ara_beauty_salon_ui (3).zip`

Package SHA-256:

`7a3a143251f57ddd11fb8c1b4aa788e68c6cca232d4b7c95da76273fc81a08c2`

### Mobile reference

- screenshot dimensions: **189 × 1600**
- screenshot SHA-256: `731d6d4eae022b7cbc206964afcb6d95ed7da13f9cbaa6b5ac501b6de2918e15`
- HTML SHA-256: `ef9eb7bf4a2a47ada6642bda9bc2f15f09b552a2129b362a275b5b9b7d8054d1`

### Desktop reference

- screenshot dimensions: **2560 × 5962**
- screenshot SHA-256: `054923d65889358a6ff6fa0778ac1099f74a7e40eb215d244f6befd75b5bf6e4`
- HTML SHA-256: `6e30a09da612434890283b796763b8d3c990b1099c65b613dfd12af5c811b5f0`

### Shared design-system source

- `DESIGN.md` SHA-256: `6c1bf8e48ab8cac06876523faf20219eb0ead32047999f44721e93f472dd1eb4`

## Accepted visual/interaction baseline

- Extends the frozen Home, Services and Specialists references.
- Gallery remains a curated visual portfolio, not a social feed.
- Desktop uses an editorial grid with restrained filtering.
- Mobile uses an intentional stacked portfolio composition.
- Gallery items can show service category, service title, specialist context and clear discovery/booking actions.
- Simple category filtering is acceptable.
- Pay-at-salon messaging remains consistent with the rest of the product.
- No review/social mechanics are part of the Gallery.

## Known deterministic cleanup

Do not carry these Stitch literals into production:

- claims that prototype images are real salon/client work;
- organic / ammonia-free / keratin / protein / premium-material claims without approved evidence;
- lymphatic-drainage, circulation, reflexology or other therapeutic/physiological claims;
- medical-sterile / fully sterile / no-damage guarantees;
- direct-contact-with-specialist wording;
- mandatory consultation-before-every-service workflow;
- standalone Profile destination unless later approved;
- separate mobile vs desktop gallery inventories;
- mock specialist/business facts as production truth;
- generated HTML/Tailwind choices;
- unresolved display-font and color-token inconsistencies.

## Evidence boundary

The mobile screenshot is too narrow to serve as final handset visual evidence. The baseline freezes visual intent only. Later implementation acceptance must render realistic mobile widths.

## Media boundary

All current images are prototype/reference media.

Production acceptance requires explicit owned or rights-cleared media and must not infer provenance from this Stitch export.

## Important boundary

This is a **visual and interaction reference**, not authoritative product content and not production-ready HTML.

The frozen Product Definition remains authoritative over all literal Stitch copy and behavior.
