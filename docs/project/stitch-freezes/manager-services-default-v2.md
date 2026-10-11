# Manager Services default v2

Status: **Frozen — desktop/default**  
Frozen: 2026-10-11

Source export:

`stitch_salon_visual_baseline (36).zip`

SHA-256:

`6d00d41f78cceabbc0fb84bd7c2cf9875848b56d26eb0e5aefad30765783e079`

## Frozen visual baseline

- Manager operational sidebar
- page header
- add-service CTA
- restrained sort control
- search
- category chips
- compact six-row service table
- consistent small thumbnails
- category / duration / price columns
- specialist-provider presentation
- simple `قابل رزرو` control
- one `ویرایش` row action
- pagination
- lower guidance block
- v2 operational spacing/type/control grammar

## Frozen semantic baseline

- Manager manages the service catalog
- columns expose:
  - service name
  - category
  - duration
  - price
  - provider specialists
  - booking availability
  - edit action
- `قیمت`, not tariff terminology
- `متخصصان ارائه‌دهنده`, not authorization/certification wording
- simple booking-availability baseline
- disabling service booking must not alter confirmed appointments
- no analytics/reporting/CRM/finance behavior

## Deterministic cleanup deferred

- `کوتاهی و استایل ژورنالی` → neutral service name if needed
- `بالیاژ فرانسوی و رنگساژ` → `بالیاژ و رنگساژ` unless approved data
- remove medical title from `دکتر هما صادقی`
- normalize static `امروز:` header fixture during engineering

## Not frozen

- add/edit service forms
- validation states
- implementation state machine
- responsive variants
- fixture data

Product Definition remains authoritative.
