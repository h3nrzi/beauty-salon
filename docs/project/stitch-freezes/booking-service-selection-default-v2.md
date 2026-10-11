# Booking default service-selection v2

Status: **Frozen — desktop/default**  
Frozen: 2026-10-11

Source export:

`stitch_salon_visual_baseline (24).zip`

SHA-256:

`819380de1b7c766878aa25d35f9afdb7cf81fd6f24f90856da637ec6058183c6`

## Manual design decision

The category/filter row was intentionally removed by the product owner.

For the current six-service catalog, the frozen default shows all services directly with no filter controls.

## Frozen visual baseline

- five-step booking progress
- no-filter six-service catalog
- true zero-selection initial state
- selected/unselected service treatment
- desktop split layout
- sticky booking summary
- empty summary at zero selection
- total duration + total price
- same-specialist guidance
- disabled Continue CTA until selection
- `ادامه و انتخاب متخصص` CTA hierarchy
- next-step helper
- neutral public footer

## Frozen semantic baseline

- initial state has 0 selected services
- customer explicitly selects one or more services
- services are performed consecutively
- one specialist must be eligible for the full selected service set
- totals derive from selected services
- Continue is disabled with zero selection
- payment is at salon
- next step is Specialist
- identity/mobile verification occurs later
- no category filter is required for the current catalog size

## Accessibility intent

- keyboard-operable service selection
- checkbox-style selection semantics
- visible focus treatment
- selected state not color-only
- accessible remove-button labels
- true disabled Continue state

## Not frozen

- fixture service data
- responsive variants
- Specialist / Date-Time / Identity / Review steps
- success/stale/error states
- production control implementation details

Product Definition remains authoritative.
