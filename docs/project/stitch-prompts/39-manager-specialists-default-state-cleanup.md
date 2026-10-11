# Stitch Prompt 39 — Manager Specialists default-state cleanup

Patch only the current refined **Manager Specialists / مدیریت متخصصان** screen.

This is **not a redesign**.

The visible UI is accepted.

## Select in Stitch

Select only the current refined Manager Specialists screen.

## Preserve exactly

Keep:

- right-side Manager sidebar;
- page header;
- `افزودن متخصص جدید` CTA;
- search;
- expertise chips;
- six-row specialist table;
- portraits;
- specialist names/codes;
- neutral expertise;
- `خدمات قابل ارائه`;
- one `ویرایش` action per row;
- lower guidance;
- typography;
- spacing;
- colors;
- borders/radii/shadows.

## 1. Remove the hidden add-specialist form from this export

The current source includes a hidden modal/form for adding a specialist.

Remove that hidden state entirely from this default screen.

Do not include:

- `افزودن عضو جدید به تیم` modal;
- name field;
- expertise field;
- service-selection field;
- `ثبت متخصص` form;
- modal open/close JavaScript.

Keep the visible button:

**`افزودن متخصص جدید`**

but do not show or embed the add-specialist form in this default-state export.

The add form will be designed later as its own state.

## 2. Static date wording

Replace:

`امروز: پنج‌شنبه ۲۴ آبان`

with:

**`پنج‌شنبه ۲۴ آبان`**

Do not imply that the static fixture is dynamically “today”.

## 3. Keep the accepted specialist-management scope

Keep only:

- specialist identity;
- expertise;
- services each specialist can provide;
- edit action.

Do not reintroduce:

- KPI cards;
- weekly schedules;
- booking-status column;
- attendance/live availability;
- HR/personnel dashboard;
- analytics;
- schedule editor;
- breaks/time-off editor.

## Required output

Return exactly one:

- **Manager Specialists — desktop/default**

No add-specialist form.
No edit-specialist form.
No modal.
No schedule state.
No mobile/tablet.

If this source-state cleanup is applied without visual drift, Manager Specialists default will be frozen.
