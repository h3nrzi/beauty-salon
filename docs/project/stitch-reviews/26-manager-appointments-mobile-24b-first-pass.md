# Stitch Review 26 — Manager Appointments Mobile 24B first pass

**Reviewed:** 2026-10-10  
**Source:** `stitch_ara_beauty_salon_ui (2)(2).zip`  
**Package SHA-256:** `8a1b7cf1eede1caf33449d80c4f25df03e8b4eea1dffaeecb9161a9e7eec62f0`  
**Decision:** **24B is not frozen yet.** The mobile detail/cancel structure is good, but the three screens still contain several visible scope/content drifts.

## Generated screen map

- `_1` — cancel confirmation
- `_2` — cancelled read-only detail
- `_3` — active Confirmed appointment detail

## What works

The responsive direction is accepted:

- all three screens are genuinely mobile rather than compressed desktop layouts;
- action hierarchy on the active detail is clear;
- cancel is visually separated as destructive;
- the cancelled detail is read-only;
- appointment services, specialist, duration and booked total are legible;
- the approved Mobile 24A bottom navigation pattern is carried forward.

No redesign is needed.

## Remaining blockers

### 1. Visible English page titles remain

The top bars show:

- `Cancel Confirmation`
- `Appointment Details`

The product surface is Persian / RTL.

Use Persian titles only, for example:

- `تأیید لغو نوبت`
- `جزئیات نوبت`

### 2. Branch-like “main salon” wording appears

Examples:

- `سالن اصلی`
- `حضور مراجع در سالن اصلی`

v1 is a single salon and does not model branches.

Use neutral wording such as:

- `سالن آرا`
- or omit the location label entirely where it adds no value.

### 3. Cancel confirmation introduces archive/CRM semantics

The cancel screen says:

- `بایگانی خودکار سابقه`
- details remain in a customer file and salon calendar archive.

There is no separate Archive/CRM product.

Use simple product wording:

**«پس از لغو، این نوبت در تاریخچه نوبت‌ها به‌صورت فقط‌خواندنی باقی می‌ماند.»**

Do not mention customer files, CRM records or archive subsystems.

### 4. Cancelled detail contains major CRM/loyalty drift

The cancelled detail includes:

- `مشتری دائم`
- `عضو باشگاه وفاداری آرا`
- customer-history framing.

CRM and loyalty are out of scope.

Keep only:

- customer name;
- verified mobile;
- optional email.

### 5. Cancelled detail contains resource/material scope

The cancelled detail includes:

- `فضای اختصاصی لاین مو`
- `آرشیو مواد و فرمول‌ها`
- related salon/material imagery.

Chair/station/resource allocation and formula/material archives are not v1 capabilities.

Remove those concepts from the authoritative mobile baseline.

### 6. Specialist credential hierarchy reappears

The cancelled detail contains:

- `مربی ارشد`

Use neutral specialist expertise only.

Do not add senior/master/credential hierarchy.

### 7. “Archive/reporting” language is still too product-like

The cancelled detail says the record is kept in an archive for management reporting.

Use:

- `تاریخچه نوبت`
- `اطلاعات فقط‌خواندنی`

Do not imply a separate reporting/archive subsystem.

### 8. Active detail exposes extra unapproved operational semantics

The active detail includes:

- `رزرو آنلاین تأییدشده`
- `حضور مراجع در سالن اصلی`
- `آماده‌سازی خدمات`
- a direct phone-call action.

These are not needed for the frozen appointment-detail contract.

Keep the screen focused on appointment identity, customer, services, specialist, date/time, duration, booked total, status and the three manager actions.

### 9. Verified-mobile wording should stay product-level

The active detail says:

- `تأیید پیامکی`

The product contract only needs the manager to see that the mobile is verified.

Prefer:

- `موبایل تأییدشده`

Do not make messaging delivery/verification implementation part of the visual contract.

### 10. Payment wording still uses settlement semantics

The active detail says:

- `شیوه تسویه`
- `پرداخت در سالن (تسویه در محل)`

The frozen rule is only:

**`پرداخت در سالن`**

Use `مبلغ ثبت‌شده نوبت` / `مبلغ کل نوبت` and `پرداخت در سالن`.

Do not add settlement/payment-status semantics.

## Freeze gate

No new screens are needed.

Patch the same three 24B screens only:

1. Persian top titles;
2. remove branch/main-salon wording;
3. replace archive/CRM wording with read-only appointment history;
4. remove loyalty/customer-history/resource/material concepts;
5. use neutral specialist expertise;
6. simplify active detail to the approved appointment contract;
7. use `موبایل تأییدشده`;
8. use only `پرداخت در سالن`.

If these corrections comply, Mobile 24B can be frozen.
