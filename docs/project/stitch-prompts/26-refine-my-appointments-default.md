# Stitch Prompt 26 — Refine My Appointments default state

Refine the **My Appointments / نوبت‌های من** page only.

The old page has good appointment-card structure, but it includes loyalty, luxury/facility and policy drift.

## What to select in Stitch

Select exactly:

1. the current **old My Appointments / نوبت‌های من** screen;
2. the frozen **Booking / رزرو نوبت** service-selection screen as the task-focused customer UI anchor;
3. the frozen **Home / خانه** screen for public header/footer continuity.

Return **one My Appointments screen only**.

## Source roles

Use the selected **old My Appointments** screen for:

- upcoming/history navigation;
- desktop appointment-list density;
- appointment-card information model;
- detail CTA;
- secondary guidance column;
- closing new-booking CTA.

Use frozen **Booking + Home** for:

- visual system;
- public header/navigation;
- task-focused card density;
- typography;
- spacing;
- buttons;
- colors;
- borders/radii/shadows;
- footer.

Do not copy the Booking layout.

## Hard default-state requirement

This page is the **upcoming appointments default state**.

Show a representative set of **2 upcoming appointments**.

Do not create:

- history state;
- empty state;
- cancel state;
- reschedule state;
- locked <24h state;
- success state.

Those will be generated later.

## 1. Page intro

Use:

- title: `نوبت‌های من`
- concise supporting copy such as:

**`نوبت‌های پیش‌رو را ببینید و برای مشاهده جزئیات یا اقدام‌های مجاز، هر نوبت را باز کنید.`**

Do not use:

- `سامانه مدیریت نوبت‌های اختصاصی`;
- luxury/exclusive positioning.

## 2. Upcoming / History tabs

Keep:

- `نوبت‌های پیش‌رو`
- `تاریخچه نوبت‌ها`

Current/default tab:

**`نوبت‌های پیش‌رو`**

If a count is shown, keep it simple:

**`۲ نوبت`**

Do not show loyalty/customer-tier status.

## 3. Remove loyalty / customer-status widget

Do not show:

- `مشتری ویژه`
- VIP/member/customer tier;
- loyalty points;
- customer ranking.

If a small summary block is retained, it may show only:

- number of upcoming appointments.

## 4. Appointment cards

Show 2 representative upcoming appointment cards.

Each card should contain:

- status: **`تأییدشده`**
- reference ID
- date
- time
- total duration
- specialist name
- neutral specialist expertise
- booked services
- `مبلغ ثبت‌شده نوبت`
- `پرداخت در سالن`
- primary action: **`مشاهده جزئیات نوبت`**

Do not show:

- `تأییدشده و نهایی`;
- approval workflow;
- payment status;
- invoice;
- rating;
- loyalty.

## 5. Neutral specialist / service wording

Use neutral specialist expertise.

Do not use:

- `مستر`
- `ارشد`
- ratings
- certificates
- spa/clinical positioning.

Use service names consistent with the frozen Services page.

## 6. Remove decorative VIP/service banners

Do not use large marketing/lifestyle banners inside appointment cards.

Remove concepts such as:

- `سالن VIP`
- `جایگاه اختصاصی`
- private floor/room claims.

Keep the cards compact and operational.

## 7. Appointment policy guidance

Use one restrained guidance card/column.

Good wording:

**`برای مشاهده اقدام‌های در دسترس هر نوبت، جزئیات نوبت را باز کنید. امکان لغو یا تغییر زمان بر اساس سیاست نوبت و فاصله زمانی تا شروع نوبت نمایش داده می‌شود.`**

Do not invent:

- 10-minute early-arrival requirement;
- receptionist workflow;
- cancellation fee;
- phone-call requirement before 24 hours.

The detailed 24-hour locked behavior will be designed later in the appointment-detail state family.

## 8. Contact path

If contact help is shown, use:

**`تماس با سالن`**

as a link/action to the Contact page.

Do not show exact phone numbers on this page.

## 9. Secondary column

Keep a secondary desktop column if visually useful, but limit it to grounded content such as:

- appointment-policy guidance;
- link to Contact;
- simple `رزرو نوبت تازه` CTA.

Do not show:

- private parking;
- organic drinks;
- private lounge;
- hygiene guarantees;
- sterilization/autoclave claims;
- location marketing.

## 10. New booking CTA

Keep a simple closing/secondary action:

**`رزرو نوبت تازه`**

Do not frame it as adding complementary/up-sell services to an existing appointment.

Changing services of an existing appointment is not allowed through reschedule.

## 11. Footer

Use the frozen neutral public footer family.

Do not show:

- exact fictional address;
- exact phone;
- exact hours;
- north-Tehran positioning;
- `خدمات تخصصی`;
- `رزرو آنلاین وقت`.

## Product semantics to preserve

- upcoming appointments are confirmed appointments;
- booked services/specialist/date/time/duration/price are clearly shown;
- booked price is a snapshot;
- payment is at salon;
- customer opens detail to see allowed management actions;
- history exists as another page state/tab;
- lifecycle uses only:
  - `تأییدشده`
  - `انجام‌شده`
  - `لغوشده`
  - `عدم حضور`.

## Product boundaries

Do not add:

- loyalty/VIP tiers;
- ratings/reviews;
- CRM;
- reminders/notifications;
- online payment;
- consultation;
- facility guarantees;
- hospitality claims;
- branches;
- profile/account features.

## Visual quality bar

The result should feel:

- task-focused;
- clear;
- calm;
- compact but breathable;
- consistent with frozen Booking;
- still visibly part of the public/customer design system.

Do not make it a generic SaaS dashboard.

## Required output

Return exactly one:

- **My Appointments — desktop/default — upcoming appointments**

No history state.
No appointment detail.
No cancel/reschedule state.
No empty state.
No mobile/tablet.

We will compare the new page against the old version before deciding whether to freeze it.
