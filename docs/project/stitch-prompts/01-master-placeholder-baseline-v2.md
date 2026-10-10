# Stitch Prompt 01 — Master placeholder baseline v2

Create a **complete first-pass visual baseline** for a Persian/RTL beauty-salon booking product called **آرا**.

This is a clean restart.

Generate the primary pages as a coherent family using **placeholder content only**.

The purpose of this pass is to establish the product's visual system and page architecture — not to design edge cases, detailed workflows, or production copy.

## Product

آرا is a booking platform for **one women's beauty salon**.

It combines:

- public salon discovery;
- service and specialist discovery;
- real appointment booking;
- customer appointment management;
- manager operational pages;
- specialist/staff assigned appointments.

It is **not**:

- a marketplace;
- multi-branch;
- a CRM;
- an accounting product;
- an analytics dashboard;
- a loyalty product;
- an inventory/payroll system.

## Language and direction

Design the entire product in:

- Persian;
- RTL.

Brand direction:

**Soft Editorial**

The product should feel:

- calm;
- feminine;
- modern;
- premium;
- approachable;
- editorial rather than generic SaaS.

Use:

- warm ivory / off-white / light taupe foundation;
- restrained muted terracotta / rose-brown accent;
- refined Persian typography;
- natural beauty/salon photography;
- generous but controlled whitespace;
- subtle borders;
- restrained shadows;
- medium radii;
- clear visual hierarchy.

Avoid:

- stereotypical pink/gold salon branding;
- black/gold ultra-luxury styling;
- glassmorphism;
- excessive gradients;
- oversized rounded SaaS cards everywhere;
- decorative clutter;
- dashboard-heavy aesthetics;
- clinical/medical styling.

Marketing pages may feel more editorial.

Booking, My Appointments and staff/manager pages must feel more task-focused and operational while still clearly belonging to the same design system.

## Important baseline rule

Create **default/normal-state pages only**.

Do not create:

- loading states;
- error states;
- empty states;
- success states;
- stale/conflict states;
- destructive confirmation dialogs;
- alternate responsive variants;
- detailed modal flows.

Those will be created later, page by page.

Do not invent new capabilities.

Use clearly fictional placeholder data where necessary.

Do not turn placeholder facts into claims about the real salon.

## Shared visual system

Across the generated pages, establish one consistent system for:

- header/navigation;
- page titles;
- section headings;
- body copy;
- buttons;
- links;
- cards;
- inputs;
- search;
- filters;
- tables/lists;
- status chips;
- price/duration metadata;
- forms;
- operational navigation.

The pages should look intentionally designed together.

## Public / customer pages

Create these 8 pages:

### 1. Home — خانه

Include placeholder sections for:

- hero;
- short salon introduction;
- selected services;
- selected specialists;
- selected gallery work;
- trust/benefit section;
- primary booking CTA;
- footer.

Keep it editorial and premium without becoming decorative-heavy.

### 2. Services — خدمات

Show a complete-service-list page using placeholder services.

Each service presentation should visually support:

- name;
- short description;
- duration;
- price;
- eligible specialists;
- booking action.

Do not design advanced selection states yet.

### 3. Specialists — متخصصان

Show placeholder specialist profiles with:

- name;
- portrait;
- neutral expertise;
- eligible services;
- booking CTA.

Also make the page visually compatible with an eventual “any available specialist” option, but do not build that state yet.

Do not show ratings or reviews.

### 4. Gallery — نمونه‌کارها

Create a curated visual portfolio page.

Use editorial image composition.

Do not turn it into:

- social feed;
- reviews;
- before/after medical claims.

### 5. About — درباره آرا

Create an editorial salon-story page with placeholder:

- story;
- values;
- team introduction;
- salon atmosphere imagery.

Avoid certification/medical/unsupported business claims.

### 6. Contact — تماس با ما

Create a clear contact page with placeholder:

- address;
- salon hours;
- phone/contact path;
- directions section.

This is a single salon.

Do not create branches.

### 7. Booking — رزرو نوبت

Create only the **default first booking screen**, focused on service selection.

The full flow will later be:

services → specialist → date/time → identity → review → confirmed.

For this baseline screen, show:

- booking step indicator;
- selectable placeholder services;
- duration;
- price;
- selected-services summary area;
- total duration/price area;
- primary Continue CTA.

Important future rules to visually accommodate, but do not create states for them yet:

- multiple services may be selected;
- all services must be performable by one specialist;
- services are consecutive;
- payment is at salon.

Do not design payment/checkout.

### 8. My Appointments — نوبت‌های من

Create only the **default upcoming-appointments page**.

Show placeholder appointment cards with:

- status;
- services;
- specialist;
- date/time;
- duration;
- booked price;
- detail action.

Include a clear way to reach appointment history, but do not create history/cancel/reschedule states yet.

## Manager pages

Create one consistent manager operational shell with Persian RTL navigation.

Confirmed manager navigation areas only:

- نوبت‌ها
- خدمات
- متخصصان
- ساعات کاری سالن
- برنامه کاری متخصصان
- زمان‌های استراحت
- مرخصی‌ها

Do not add:

- analytics;
- CRM;
- payments;
- marketing;
- inventory;
- payroll;
- generic settings;
- notification center.

Create these 7 manager pages:

### 9. Manager Appointments — مدیریت نوبت‌ها

Create the normal appointments workspace.

Show:

- search;
- basic date/status/specialist filters;
- appointment list/table;
- time;
- customer;
- specialist;
- services;
- duration;
- status;
- booked total;
- open-detail action.

Statuses may visually support only:

- تأییدشده
- انجام‌شده
- لغوشده
- عدم حضور

Do not create appointment detail or mutation states yet.

### 10. Manager Services — مدیریت خدمات

Create a normal services-management list.

Show placeholder:

- service name;
- duration;
- price;
- availability/visibility indicator;
- eligible specialist summary;
- edit/open action.

Do not invent inventory, packages, promotions or payment features.

### 11. Manager Specialists — مدیریت متخصصان

Create a normal specialists-management list.

Show placeholder:

- specialist name;
- portrait/avatar;
- neutral expertise;
- eligible services;
- active/available-for-booking presentation;
- edit/open action.

Do not show ratings, payroll or performance analytics.

### 12. Salon Hours — ساعات کاری سالن

Create a straightforward weekly opening-hours management page.

Keep it operational and simple.

Do not mix specialist schedules into this page.

### 13. Specialist Schedules — برنامه کاری متخصصان

Create a management page for recurring specialist working schedules.

Show:

- specialist selection;
- recurring weekly availability;
- working time ranges.

Do not create time-off/break editing states here.

### 14. Breaks — زمان‌های استراحت

Create a management page for specialist recurring breaks.

Show a simple list/configuration structure.

Do not invent payroll or shift analytics.

### 15. Time Off — مرخصی‌ها

Create a management page for specialist unavailable dates/time ranges.

Keep the default list/configuration state only.

## Staff / specialist

### 16. Assigned Appointments — نوبت‌های منِ متخصص

Create a task-focused page for a signed-in specialist.

Show only assigned appointments with:

- customer;
- services;
- date/time;
- duration;
- status;
- open-detail action.

The specialist may eventually mark appointments Completed or No-show, but do not create those action states yet.

Do not show manager navigation or salon-wide controls.

## Product boundaries

Do not introduce:

- marketplace or multiple salons;
- multiple branches;
- booking for another person;
- online payment/deposit;
- loyalty;
- ratings/reviews;
- CRM;
- inventory;
- payroll/accounting;
- advanced analytics;
- password-based customer UX;
- clinical/medical claims;
- complex role hierarchy;
- manual appointment approval;
- generic Settings product;
- notifications center.

## Output expectations

Generate all **16 primary screens** as one coherent visual family.

Use placeholder content.

Prioritize consistency over completeness.

Do not create secondary states.

Do not create mobile/tablet variants in this pass.

Do not create implementation documentation or architecture.

The goal is a clean whole-product baseline that we can later refine page by page without changing the established visual language.
