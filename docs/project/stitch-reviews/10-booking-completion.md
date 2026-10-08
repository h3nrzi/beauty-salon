# Stitch Review 10 — Booking completion pass

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (7).zip`  
**Package SHA-256:** `ac67918cc03ed0c17347cba67307828693e823a32592152ea67b92c17424a83b`  
**Decision:** **Booking is materially closer, but still not frozen.** Required edge states and desktop evidence now exist, but the refinement still violates several frozen product rules and the stale-slot behavior is still incorrect.

## What improved

Prompt 10 successfully added/clarified:

- all five mobile booking stages;
- a dedicated Confirmed success screen;
- explicit No Eligible Specialist state;
- explicit No Availability state;
- desktop Booking evidence;
- 24-hour change/cancel wording in the core mobile date/review screens;
- 30-minute public start-grid wording;
- clear pay-at-salon review content;
- immediate-confirmation wording;
- preserved service/specialist context in stale-slot recovery.

The application visual system remains accepted. Do not redesign it.

## Blocking issues before freeze

### 1. Stale-slot recovery still auto-selects a replacement time

This remains the biggest behavior error.

The stale-slot screen currently:

- marks **11:30** as «انتخاب شده»;
- labels it as the nearest / first suggestion;
- changes the main CTA to «تأیید ساعت 11:30 و ادامه نوبت».

The frozen rule is:

- preserve services;
- preserve specialist choice;
- show fresh alternatives;
- **no replacement time is selected automatically**;
- the CTA remains disabled/inactive until the customer explicitly chooses a new time.

Remove any “nearest”, “first suggestion”, default selected state or silent recommendation that behaves like selection.

### 2. Desktop is present, but it is a different interaction model and still carries major contract drift

The desktop export places essentially the whole Booking workflow in one long editable page instead of preserving the staged 5-step flow.

It also reintroduces:

- «اولین متخصص آزاد»;
- «سریع‌ترین تایم»;
- international certificate claims;
- ratings/credential-style copy;
- organic/material claims;
- lymphatic/clinical wording;
- SMS reminder/confirmation promises;
- “free” change/cancellation semantics;
- satisfaction-dependent payment wording;
- unsupported reception/internal support details.

For baseline freeze, desktop must use the same five-stage interaction model as mobile. A split layout / sticky summary is fine, but **one active stage per screen/state** must remain clear.

### 3. Mobile Specialist still contains an unverified credential

The Specialist step includes a certificate claim such as «گواهینامه کوپ مدرن».

Remove ratings, certificates and unverified credentials from booking fixtures.

### 4. Mobile Service copy still includes unsupported clinical/material claims

Examples remain:

- «درخشش ارگانیک»;
- «ماساژ تخلیه لنفاوی».

Use neutral, non-clinical service fixture copy only.

### 5. Identity still invents a profile/preferences product

The identity screen says mobile verification activates a personalized profile of services/preferences.

The frozen identity scope is only:

- name;
- verified mobile;
- optional email;
- recovery of the same customer identity and appointment history.

Do not create a standalone preference/profile concept.

OTP / verification-code UI itself is acceptable. Resend-code behavior within verification is acceptable. Do not extend it into reminder/notification promises.

### 6. Review screen still contains forbidden literals/features

The mobile Review screen still includes:

- specialist rating;
- branch wording;
- “free” payment/fee wording;
- after-service payment semantics beyond simple pay-at-salon;
- a confirmation-SMS toast.

Normalize to the frozen contract:

- single salon;
- no rating;
- no branch;
- total price;
- pay at salon;
- 24-hour self-change rule;
- immediate confirmation;
- no messaging-delivery promise.

### 7. Success screen still adds new product scope

The Confirmed screen still includes:

- “central salon/branch” style wording;
- SMS reminder promise;
- add-to-calendar action;
- share-details action;
- arrive 10 minutes early;
- hospitality/comfort promise.

These are outside the frozen v1.

Success should be limited to:

- Confirmed state;
- booking/reference identifier;
- specialist;
- services;
- date/time;
- duration;
- total price;
- pay-at-salon;
- «مشاهده در وقت‌های من»;
- safe return to the public site.

### 8. No Eligible Specialist still suggests split booking

The No Eligible Specialist screen says the customer may book different departments separately.

That is an unapproved split-booking path.

The state must only:

- explain that no common specialist can perform the full selected set;
- preserve the selected services;
- allow removing/changing a service;
- return to Services.

The same screen also contains a branch label and certification/quality guarantee copy; remove both.

### 9. No Availability is mostly correct, but keep it neutral

The state correctly preserves the current date/selection and offers another date or «هر متخصص در دسترس».

Use neutral wording such as «مشاهده تاریخ‌های بعدی دارای ظرفیت» rather than language that implies automatic “best/first” assignment.

## Design-system note

The package includes a Booking baseline spec that correctly restates the main frozen rules.

The shared `DESIGN.md` still has the existing deterministic font/color-token mismatch:

- Persian display frontmatter names `Noto Serif`;
- prose primary action is `#9E5A4E` while frontmatter declares a different primary token.

This remains export-audit/handoff cleanup and is not the reason Booking is blocked.

## Decision

**Do not freeze Booking yet.**

Run one final contract-correction pass. It must be a narrow correction pass, not another visual exploration.

If the next export removes the remaining scope drift, fixes stale-slot initial state, and makes desktop use the same staged interaction model, Booking can be frozen.
