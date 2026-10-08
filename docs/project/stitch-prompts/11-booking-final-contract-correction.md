# Stitch Prompt 11 — Booking final product-contract correction

Apply one **final correction pass** to the existing آرا Booking flow.

**Do not redesign the visual system. Do not add new ideas.**

Preserve the accepted layout/components, Soft Editorial application styling, progress stepper, selection controls, summary panels and error-state language.

This pass exists only to make the generated screens conform exactly to the frozen product contract.

## A. Stale-slot recovery — mandatory correction

Initial stale-slot recovery state must have:

- original lost time shown as unavailable;
- selected services preserved;
- selected specialist / «هر متخصص در دسترس» preserved;
- fresh alternative times visible;
- **zero alternative times selected initially**;
- no “nearest”, “recommended first”, “best” or automatic ranking language;
- primary continue CTA disabled until the customer explicitly chooses a new time.

After an explicit user click, selected styling and the continue CTA may activate.

Do not preselect 11:30 or any other time.

## B. Keep the same five-stage flow on mobile and desktop

Canonical stages:

1. خدمات
2. متخصص
3. زمان
4. اطلاعات
5. تأیید

Success is the result.

For **desktop**, do not place all editable stages into one giant page.

Use the same staged interaction model as mobile:

- one active stage per screen/view;
- a persistent progress indicator;
- a side summary is allowed;
- backward navigation preserves valid selections.

Provide desktop evidence for all five stages plus success.

## C. Service fixtures — neutral only

Remove all literal claims such as:

- organic / گیاهی / vegan;
- lymphatic / medical / physiological treatment;
- guaranteed results;
- material-quality/certification claims.

Use plain non-clinical beauty-service descriptions.

Keep fixed duration and price.

## D. Specialist fixtures — neutral only

Remove:

- ratings;
- stars;
- certificates;
- international credentials;
- exact experience claims unless explicitly marked fixture-only;
- “senior/master” proof-style claims.

Keep:

- name;
- simple non-clinical expertise;
- eligible services;
- specific specialist option;
- «هر متخصص در دسترس».

Never use:

- «اولین متخصص آزاد»;
- «سریع‌ترین متخصص»;
- “best/fastest” assignment semantics.

## E. Identity — no profile/preferences product

Identity supports only:

- name required;
- mobile required;
- email optional;
- mobile verification;
- returning verified mobile recovers the same customer identity / appointment history.

Replace any profile/preferences wording with neutral identity-recovery copy.

OTP input and resend-code UI are okay for verification.

Do not promise reminders or confirmation messages after booking.

## F. Review — exact approved contract

Review must show only approved information:

- selected services;
- specialist;
- date/time;
- total duration;
- total price;
- customer identity;
- payment at salon;
- 24-hour self-change rule;
- immediate confirmation after final submit.

Final CTA:
**تأیید و ثبت نوبت**

Remove:

- ratings;
- branch names;
- cancellation-fee/free-cancellation claims;
- “0 تومان رایگان” policy labels unrelated to the fixed booking total;
- satisfaction-dependent payment;
- SMS confirmation toast/promise.

The product is one salon only.

## G. Success — exact approved scope

Success may contain:

- «نوبت با موفقیت ثبت و تأیید شد»;
- booking/reference ID;
- assigned specialist;
- selected services;
- date/time;
- duration;
- total price;
- «پرداخت در سالن»;
- «مشاهده در وقت‌های من»;
- «بازگشت به صفحه اصلی» or Services.

Remove:

- add to calendar;
- share details;
- SMS reminder/confirmation promises;
- arrive-10-minutes-early rule;
- drinks/hospitality promises;
- branch/central-branch wording;
- extra support capabilities.

## H. No Eligible Specialist — exact state

Show:

- no one common specialist can perform the complete selected set;
- current selected services;
- remove service action;
- change services / return to stage 1.

Do not suggest:

- booking departments/services separately;
- automatic split booking;
- another branch;
- certification/quality guarantees.

Use **متوالی / پشت‌سرهم**, not wording that implies simultaneous parallel service delivery.

## I. No Availability — keep selections, no automatic decisions

Show:

- eligible specialist(s) exist;
- no sufficient consecutive capacity for the current selection/date;
- selected services and specialist remain preserved;
- choose another date;
- optionally change specialist / choose «هر متخصص در دسترس».

Use neutral wording:
**مشاهده تاریخ‌های بعدی دارای ظرفیت**

Do not auto-select a date/time/specialist.

## J. Time rules — exact

Use only:

- booking horizon: 90 days;
- same-day lead: 60 minutes;
- service durations: 15-minute increments;
- public appointment starts: **30-minute grid**.

## K. Customer change rule — exact

Use only:

**لغو یا جابه‌جایی توسط مشتری تا ۲۴ ساعت قبل از نوبت مجاز است. در ۲۴ ساعت پایانی، تغییر خودکار قفل است و مشتری باید با سالن تماس بگیرد.**

No 6h/12h variants. No fees/penalties unless later approved.

## L. No new scope

Do not add:

- online payment/deposit;
- reminders;
- calendar integration;
- sharing;
- profile/preferences center;
- reviews/ratings;
- loyalty;
- packages;
- waitlist;
- promo codes;
- branches;
- split booking;
- chat/support ticket;
- architecture/API/provider choices.

## Required output

Return the final Booking baseline candidate with:

- mobile stages 1–5;
- mobile Confirmed success;
- desktop stages 1–5 using the same staged flow;
- desktop Confirmed success;
- Stale Slot Recovery with **nothing preselected** initially;
- No Eligible Specialist;
- No Availability;
- updated Booking design-system delta only if necessary.

This is the final contract-cleanup pass. Do not invent replacement marketing copy to fill removed claims; concise neutral placeholders are preferable.
