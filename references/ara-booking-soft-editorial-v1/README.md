# ara-booking-soft-editorial-v1

Status: **Frozen visual/interaction reference for Booking**  
Frozen: 2026-10-09

## Final source package

`stitch_ara_beauty_salon_ui (10).zip`

SHA-256:

`98e01abadf4d8199f99c404a4e4393ef801370103b9caf88b87319ce484d7efd`

## Accepted mobile reference set

- Services — `._2/screen.png`
- Specialist — `._3/screen.png`
- Date/Time — `._1/screen.png`
- Identity — `._4/screen.png`
- Review/Confirm — `._5/screen.png`
- Confirmed success — `_1/screen.png`
- No Availability — `_2/screen.png`
- No Eligible Specialist — `_3/screen.png`
- Stale Slot Recovery — `stale_slot/screen.png`

Final stale-slot screen SHA-256:

`7084b38c9ca1e1b8476777c10dda1c2aecd01b5cb02cd85d533bc6811f5eadc4`

## Accepted desktop reference set

- Services — `_6/screen.png`
- Specialist — `_5/screen.png`
- Date/Time — `_4/screen.png`
- Identity — `_7/screen.png`
- Review/Confirm — `_8/screen.png`
- Confirmed success — `_9/screen.png`

## Accepted interaction semantics

Canonical flow:

```text
Services
→ Specialist
→ Date/Time
→ Identity
→ Review/Confirm
→ Confirmed
```

Accepted recovery/empty patterns:

- No Eligible Specialist
- No Availability
- Stale Slot Recovery with zero replacement preselection

## Deferred deterministic cleanup

The frozen reference does not make literal Stitch copy authoritative.

During export audit / engineering handoff normalize all previously recorded drift, including:

- unsupported ratings/credentials/clinical/material claims;
- spa/wellness/branch wording;
- messaging/SMS promises;
- mock address/contact facts;
- payment wording beyond `pay at salon`;
- legal/privacy placeholder content;
- font/token inconsistencies;
- generated HTML/framework choices.

## Responsive evidence boundary

Mobile and desktop visual intent is frozen.

Final implementation acceptance must still verify realistic browser/device viewports, keyboard behavior, focus states, Persian/RTL rendering and all interactive states.


## Deterministic UI consistency cleanup

### Next-step helper consistency

Across Booking stages, helper copy such as «مرحله بعدی…» must use one consistent placement.

Approved implementation rule:

- primary CTA remains the dominant action;
- next-step helper text is always placed **below** the primary CTA;
- helper text is RTL-aligned, visually secondary and uses consistent spacing;
- do not alternate between side-by-side and below-button placement across stages;
- this is an implementation/handoff cleanup and does not reopen the frozen Stitch baseline.
