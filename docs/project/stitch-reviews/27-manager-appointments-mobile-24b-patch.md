# Stitch Review 27 — Manager Appointments Mobile 24B patch

**Reviewed:** 2026-10-10  
**Source:** `stitch_ara_beauty_salon_ui (3)(2).zip`  
**Package SHA-256:** `f45817ac05f6438f3e293a2bb3306664220470cb6c3380cdcd0dac641bcbec56`  
**Decision:** **24B is still not frozen.** The underlying HTML content is much cleaner, but the exported package is internally inconsistent: two screenshots still show the old pre-patch UI, and one same-appointment fixture differs across screens.

## Export map

- `_1` — cancel confirmation
- `_2` — active appointment detail
- `_3` — cancelled read-only detail

## What improved in the HTML source

The generated HTML now reflects most requested cleanup:

- Persian page titles in the HTML;
- active detail uses `موبایل تأییدشده`;
- payment copy is reduced to `پرداخت در سالن`;
- CRM/loyalty/resource/material concepts are removed from the HTML;
- specialist wording is neutral;
- cancelled detail is framed as read-only appointment history;
- manager actions remain correctly limited to reschedule / reassign / cancel.

These semantics are acceptable.

## Blocking issue 1 — screenshot and HTML export do not match

The exported `screen.png` files for `_1` and `_2` still visibly show the old pre-patch content.

### `_1` screenshot still shows

- English `Cancel Confirmation`;
- `سالن اصلی`;
- archive/customer-file copy.

But `_1/code.html` contains the corrected Persian/product-level wording.

### `_2` screenshot still shows

- English `Appointment Details`;
- `سالن اصلی`;
- `تأیید پیامکی`;
- `شیوه تسویه` / settlement wording;
- extra operational timeline/call action.

But `_2/code.html` contains the corrected content.

A frozen visual reference cannot contain a screenshot that contradicts its paired HTML source.

The next pass must make the visible Stitch screen and exported screenshot match the corrected HTML.

## Blocking issue 2 — same appointment has inconsistent customer mobile

All three screens use the same appointment/reference ID:

`ARA-14030225-01`

But the customer mobile is not consistent.

Cancel confirmation / active detail use:

`۰۹۱۲۳۴۵۶۷۸۹`

Cancelled detail uses:

`۰۹۰۱۹۲۳۶۶۲۲`

Because these screens represent the same appointment before/during/after cancellation, the customer snapshot must remain identical.

Use one mobile number consistently across all three screens. Prefer keeping:

`۰۹۱۲۳۴۵۶۷۸۹`

because it already appears in the active and confirmation states.

## Small wording cleanup

The cancel success copy currently says:

`در سوابق ذخیره گردید`

Prefer:

**`نوبت با موفقیت لغو شد و در تاریخچه نوبت‌ها به‌صورت فقط‌خواندنی باقی می‌ماند.`**

This avoids storage/persistence-style wording and aligns with the frozen product model.

## Freeze gate

No new layout or interaction work is needed.

24B can be frozen after:

1. the visible/exported screenshots for cancel confirmation and active detail are regenerated from the corrected UI;
2. all three screens use the same customer mobile snapshot;
3. cancel-success copy uses appointment-history language.

Do not redesign these screens.
