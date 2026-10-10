# Stitch workflow v2 — placeholder-first baseline

**Status:** Active — 2026-10-10  
**Purpose:** Restart visual design from a clean baseline and optimize the workflow for how Stitch actually works.

## Why v2 exists

The first Stitch iteration produced useful product-learning and several good screens, but repeated patching of generated screens caused visual drift:

- typography and spacing changed across iterations;
- operational screens gradually developed new card/alert styles;
- semantic fixes accidentally changed visual language;
- selected-screen context was sometimes too broad;
- Stitch was asked to infer repository/project context it could not actually see.

The v2 workflow separates **visual-system creation**, **page refinement**, and **state generation**.

Product Definition remains authoritative:

`docs/project/product-definition.md`

The previous Stitch references remain historical learning artifacts. They are not the visual target for v2 unless deliberately selected later as inspiration.

## Core workflow

### Phase 1 — Master placeholder baseline

Start from a clean Stitch project/canvas.

Use one standalone master prompt to generate all primary product pages in their **default/normal state** with placeholder content.

Goals:
- establish one visual language;
- establish navigation shells;
- establish typography;
- establish spacing rhythm;
- establish shared cards, buttons, inputs, tables/lists and content sections;
- see the complete product family together before polishing individual pages.

Do **not** generate edge states in this phase.

Do **not** spend time correcting exact copy/data in this phase unless it changes product meaning.

### Phase 2 — Visual-system review and freeze

Review the generated set as one family.

Choose and freeze:
- color system;
- typography scale;
- page width/grid;
- header/navigation patterns;
- card/border/radius/shadow language;
- primary/secondary/destructive buttons;
- inputs/search/filter controls;
- status chips;
- marketing section rhythm;
- operational list/table/card language.

If the family is visually incoherent, regenerate the baseline from the master prompt rather than patching every screen individually.

### Phase 3 — Page-by-page refinement

Refine one primary page at a time.

For each page:
1. select only that baseline screen;
2. give one focused prompt;
3. improve hierarchy/content/layout;
4. keep the frozen visual language;
5. freeze the page's default state before moving to its secondary states.

Do not mix unrelated pages in one refinement prompt.

### Phase 4 — State generation

Once a page's default state is frozen, create its required states one family at a time.

Examples:
- Booking: no eligible specialist, no availability, stale slot, validation, identity verification, review, success.
- My Appointments: upcoming, history, locked <24h, cancel, reschedule, stale reschedule.
- Manager Appointments: detail, cancel, reschedule, reassignment, invalid reassignment, conflict, terminal states.

For state generation:
1. select the frozen default/base screen;
2. create one state family;
3. review;
4. freeze;
5. move to the next family.

### Phase 5 — Responsive adaptation

Do responsive work only after the relevant desktop/default design is stable.

For each responsive screen:
- select one frozen screen as the semantic source;
- select one already-good screen at the target viewport as the visual anchor when needed;
- generate one page/state family at a time.

Never ask Stitch to infer unseen repository files or unselected screens.

## Stitch operating rules

### Rule 1 — Stitch only knows what it can see
Prompts must be self-contained.

Do not reference:
- GitHub paths;
- local paths;
- repository docs;
- unseen screens;
- prior screens that are not selected.

### Rule 2 — One prompt, one design goal

Good:
- create the whole placeholder baseline;
- refine Services;
- create Booking stale states;
- adapt Manager Appointments to mobile.

Bad:
- redesign several unrelated pages while fixing copy and creating edge states.

### Rule 3 — Placeholder before precision

The master baseline may use clearly fictional placeholder names, images, prices and contact data.

Placeholder data must not introduce new product capabilities.

Exact business facts and production copy are handled later.

### Rule 4 — Do not patch a visually bad branch repeatedly

If a screen drifts visually:
- allow at most one focused correction attempt;
- if still weak, regenerate from a frozen visual anchor.

Do not compound bad generations through repeated patching.

### Rule 5 — Separate visual and semantic review

A screen may be:
- visually accepted but semantically dirty;
- semantically correct but visually rejected.

Do not confuse the two.

Semantic cleanup should not redesign the page.

### Rule 6 — Freeze the default state before edge states
Do not generate a large state tree from a weak default screen.

### Rule 7 — No architecture in Stitch
Stitch may explore presentation and interaction only.

It must not decide:
- APIs;
- database/storage;
- auth implementation;
- SMS provider;
- revision-token strategy;
- framework/CMS architecture.

### Rule 8 — Stop when differences are deterministic
Do not keep regenerating a good visual baseline to fix trivial copy.

Small literal corrections can be recorded for engineering handoff when they do not affect visual/interaction meaning.

## v2 page inventory

### Public / customer
1. Home
2. Services
3. Specialists
4. Gallery
5. About
6. Contact
7. Booking — default shell / service-selection state
8. My Appointments — default upcoming state

### Manager
9. Appointments
10. Services management
11. Specialists management
12. Salon hours
13. Specialist schedules
14. Breaks
15. Time off

### Staff / Specialist
16. Assigned appointments

Secondary detail pages and state families are intentionally deferred until after baseline review.

## Recommended refinement order

After the master baseline is accepted:
1. Home
2. Services
3. Specialists
4. Gallery
5. About
6. Contact
7. Booking default
8. My Appointments default
9. Manager Appointments default
10. Manager Services
11. Manager Specialists
12. Manager availability configuration pages
13. Staff Assigned Appointments
14. state families
15. responsive passes

This order establishes the public design language first, then the task-focused customer UI, then the operational UI.

## Freeze policy

A baseline/page is frozen when:
- visual hierarchy is coherent;
- it belongs to the same design system as the rest of the product;
- its default interaction model is clear;
- remaining issues are deterministic copy/data/engineering cleanup;
- no meaningful visual uncertainty remains.

Do not freeze fixture data as product truth.

Product Definition always overrides generated fixture content.
