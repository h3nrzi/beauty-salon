# Stitch Prompt 35 — Manager Appointments Mobile 24D visual reset workflow

The previous Mobile 24D attempt drifted visually.

Do **not** patch or reuse the bad Mobile 24D generated screens as the design source.

We will rebuild 24D **one screen at a time** using a frozen good Mobile screen as the visual anchor and the matching Desktop screen as the semantic source.

---

# 35A — Specialist Reassignment mobile reset

## Select exactly these two screens in Stitch

1. A **frozen good Mobile Manager screen** from 24B or 24C that best represents the established mobile visual language. Prefer:
   - Mobile Active Appointment Detail, or
   - Mobile Reschedule Review.

2. The **Desktop Specialist Reassignment** screen:
   - `تغییر و تخصیص مجدد متخصص`

Do **not** select any previously generated Mobile 24D screen.

## Paste this prompt

Create one new **mobile Specialist Reassignment screen around 390 CSS px**.

Use the selected **mobile screen only as the visual design reference**:
- same header scale;
- same Persian / RTL typography;
- same spacing rhythm;
- same card radius/borders;
- same status-chip style;
- same button hierarchy;
- same compact information density;
- same Soft Editorial operational feel.

Use the selected **desktop reassignment screen only as the semantic/interaction reference**.

Do not copy the desktop layout.

Do not invent a new visual style.

Show:
- title: `تغییر متخصص نوبت`
- appointment/reference ID;
- current specialist;
- booked services;
- date/time;
- total duration;
- booked total price;
- `پرداخت در سالن`;
- eligible replacement specialists.

Rules:
- only specialist changes;
- services remain unchanged;
- date/time remain unchanged;
- duration remains unchanged;
- booked price remains unchanged;
- replacement must be eligible for all booked services;
- replacement must be available for the full appointment interval;
- manager explicitly selects one replacement;
- no replacement is auto-selected.

Use neutral expertise labels only.

Do not add:
- ratings;
- certificates;
- senior/master hierarchy;
- CRM/loyalty;
- payment state;
- analytics;
- clinical wording;
- chair/studio/resource assignment;
- SMS/notifications.

Keep this screen visually consistent with the selected frozen mobile reference.

Return **one screen only**.

---

## After 35A

Do not generate the invalid state or conflict state yet.

Review 35A first.

Once 35A is accepted, use the accepted 35A screen itself as the visual reference for the invalid/unavailable state.

For the later conflict screen, use a frozen recovery/error mobile screen such as the accepted Stale Reschedule Recovery as the visual anchor plus the Desktop Conflict screen as the semantic source.
