# Manager Appointments default v2

Status: **Frozen — desktop/default**  
Frozen: 2026-10-11

Source export:

`stitch_salon_visual_baseline (33).zip`

SHA-256:

`f88d6609a60b654e68048ce56fa1cf9d0bbbc61086f145dfe1f8567c0d51b6d1`

## Frozen visual baseline

- right-side Manager navigation
- page header / manager identity area
- search
- date / specialist / status filters
- quick lifecycle filters
- compact five-row appointment table
- customer + masked mobile treatment
- specialist column
- readable booked-service chips
- duration
- lifecycle status chips
- `مبلغ ثبت‌شده`
- `مشاهده جزئیات`
- pagination
- v2 operational visual grammar

## Frozen semantic baseline

- search by customer name / mobile / appointment ID
- filters: date / specialist / lifecycle status
- statuses:
  - `تأییدشده`
  - `انجام‌شده`
  - `لغوشده`
  - `عدم حضور`
- booked-price snapshot shown as `مبلغ ثبت‌شده`
- detail is the only row action in the default list
- no manual appointment creation
- no export/reporting
- no live-update/system status
- no CRM/analytics/payment operations

## Deterministic cleanup deferred

- shorten search placeholder if needed for full visible discoverability
- normalize duration display formatting during engineering

## Not frozen

- detail/mutation states
- stale/conflict handling
- staff view
- responsive variants
- fixture data/counts

Product Definition remains authoritative.
