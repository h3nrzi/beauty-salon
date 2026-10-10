# Stitch Prompt 06 — Refine Services default state

Refine the **Services / خدمات** page only.

This is the next page-by-page default-state refinement after Home was frozen.

## What to select in Stitch

Select:

1. the current **Services / خدمات** baseline screen;
2. the frozen refined **Home / خانه** screen as the public visual anchor.

Return **one Services screen only**.

## Goal

Create a strong **desktop/default Services page** that feels like a direct continuation of the frozen Home visual system.

Do not create selection edge states, booking steps, mobile/tablet variants or alternate Services versions yet.

## Visual continuity

Use the selected frozen Home only as a visual-system anchor for:

- public header/navigation;
- content width;
- typography scale;
- spacing rhythm;
- primary/secondary button treatment;
- borders/radii/shadows;
- image treatment;
- footer language.

Do not copy the Home page layout.

Keep:

- Persian / RTL;
- warm ivory/off-white canvas;
- muted terracotta / rose-brown accent;
- warm espresso text;
- subtle borders and shadows;
- medium radii;
- calm editorial presentation.

## Services page purpose

The page should help customers:

- understand available services;
- compare duration and price;
- understand which specialists can perform each service;
- start booking.

## Required page structure

### 1. Page intro

Use a concise page title and supporting copy.

Keep it grounded and product-focused.

Do not use spa/clinic/medical positioning.

### 2. Service discovery / organization

Organize placeholder services in a clear desktop structure.

Possible patterns:

- category tabs/chips;
- restrained filters;
- editorial grouped sections.

Do not turn the page into a dense ecommerce catalog.

### 3. Service cards / rows

Each service should visually support:

- service name;
- short neutral description;
- duration;
- price;
- eligible specialists;
- booking action.

Use neutral beauty-service examples.

Do not use:

- medical/treatment claims;
- organic/certification claims;
- guaranteed results;
- ratings/reviews.

### 4. Eligible specialists

Make eligibility understandable without overloading each card.

This may use:

- small avatars;
- specialist names;
- a concise eligible-specialists line.

Do not introduce specialist ranking, ratings or senior/master hierarchy.

### 5. Booking path

Each service should provide a clear path into Booking.

The page may support the visual idea of selecting more than one service, but do **not** create compatibility-error states yet.

Important product semantics to respect:

- one booking may contain multiple services;
- all selected services must be performable by the same specialist;
- services are performed consecutively;
- total duration is the sum of service durations;
- total price is the sum of service prices;
- payment is at salon.

### 6. Footer

Use the same public footer family as frozen Home.

## Content cleanup during this refinement

Unlike the initial placeholder baseline, this page is now entering freeze-quality refinement.

Remove or avoid:

- spa/wellness language;
- therapeutic/clinical claims;
- material/certification claims;
- ratings/reviews;
- exact unsupported business claims;
- senior/master specialist labels;
- “first/fastest available” wording;
- simultaneous-service wording;
- payment timing beyond `پرداخت در سالن`.

## Do not add

- marketplace/multiple salons;
- branches;
- loyalty;
- CRM;
- online payment/deposit;
- checkout;
- packages/promotions;
- notifications/reminders;
- inventory;
- reviews/ratings.

## Required output

Return exactly one:

- **Services — desktop/default**

No mobile/tablet.
No booking-flow states.
No compatibility error state.
No loading/empty/error/success state.

We will review and freeze the Services default state before moving to Specialists.
