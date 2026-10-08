# ara-home-soft-editorial-v1

Status: **Frozen visual reference for Home + initial design system**  
Frozen: 2026-10-08

## Source export

Reviewed Stitch package:

`stitch_ara_beauty_salon_ui(2).zip`

Package SHA-256:

`7d56069b18387cb5f35f5fb146b44e819839c15efa4bfff3021c59d50e202516`

The package contained two Home variants/screens plus `DESIGN.md`.

### Desktop reference

- screenshot dimensions: **2560 × 8814**
- screenshot SHA-256: `c60fe164c1532d7ff47a0b44373aef381f35f41bcf98940d045a434f717354b4`
- HTML SHA-256: `6c43d3b18aff40d08a160fcde0184d87d971f8145607c799f7e75b04024dd3cb`

### Mobile reference

- screenshot dimensions: **780 × 19274**
- screenshot SHA-256: `5b9739e676a9314db59facc490ed9a4f5fc7ec574e78d13a26c6689a2d12eeea`
- HTML SHA-256: `cb085d3891a2ff585e1d60d82e7a86802ce012808add6c1aef3a7dfb48431ece`

### Design-system source

- `DESIGN.md` SHA-256: `6c1bf8e48ab8cac06876523faf20219eb0ead32047999f44721e93f472dd1eb4`

## Accepted visual baseline

- Brand: **آرا**
- Direction: **Soft Editorial**
- Persian / RTL first
- Warm ivory / taupe foundation
- Restrained terracotta primary-action language
- Calm, premium and feminine without generic pink/gold styling
- Editorial whitespace and natural photography
- Subtle borders/elevation
- Mobile-first interaction thinking for booking-related actions
- Home navigation exposes both «وقت‌های من» and «رزرو وقت»
- Home uses three selected services as a curated preview
- Booking bridge reflects the approved five-stage journey
- Pay-at-salon messaging is explicit

## Known deterministic cleanup

These are intentionally deferred to export audit / engineering handoff rather than another Stitch loop:

- normalize residual spa/atelier wording to beauty-salon positioning;
- remove or mark unresolved legal/privacy destinations;
- neutralize unsupported hygiene/material-quality claims;
- treat address/phone/hours as mock data only;
- normalize Persian display typography rather than relying on Noto Serif fallback;
- normalize semantic color tokens so the primary-action color is unambiguous;
- do not carry generated Tailwind/HTML structure forward as an architecture decision.

## Important boundary

This baseline freezes visual intent, not implementation.

The generated HTML, remote font choices, media URLs, placeholder text and runtime/tooling are reference material only and must be audited before engineering.
