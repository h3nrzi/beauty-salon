# Stitch Review 01 — Home + initial design system

**Reviewed:** 2026-10-08  
**Source:** Stitch export containing `screen.png`, `code.html` and `DESIGN.md`  
**Decision:** Visual direction accepted; baseline **not frozen**. One focused refinement pass is required.

## What works

The first exploration successfully establishes the intended Soft Editorial direction:

- warm ivory / taupe / terracotta palette;
- calm premium tone without default pink/gold salon styling;
- readable RTL composition;
- strong hierarchy between editorial marketing sections and transactional CTAs;
- natural photography direction;
- clear pay-at-salon messaging;
- service price/duration presentation;
- specialist and gallery sections that fit the intended product;
- a coherent mobile-oriented long-form Home composition.

The overall aesthetic is close enough that we should refine this direction rather than restart from a different visual concept.

## Product / scope corrections required

### 1. Home must stay curated, not become the Services page

The current Home includes a category filter and a five-item service menu. That is too close to the full Services experience.

Refine Home to a deliberately curated preview:
- remove service-category filtering from Home;
- show only a small selected set of representative services;
- keep a clear link to the full Services page.

This preserves page boundaries and makes Home feel more editorial.

### 2. Remove invented capabilities and claims

The current copy introduces claims that are not approved product facts, including examples such as:

- “۱۰۰٪ ارگانیک”;
- “برترین برندهای مراقبتی وگان”;
- “متریال ارگانیک”;
- international/clinical credentials and specific certificates;
- “تضمین بالاترین استانداردهای بهداشتی و مدارک بین‌المللی”;
- absolute product/material safety claims;
- package selection (“پکیج”);
- unsupported salon-specific operational claims.

Replace these with neutral, credible placeholder copy that does not imply certification, awards, medical/clinical status, guarantees, organic/vegan sourcing, or unapproved packages.

### 3. Do not compress booking into a misleading three-step promise

The Home currently states that booking is completed in three steps and explicitly promises an immediate SMS confirmation.

The approved product flow is:

```text
services
→ specialist choice
→ date/time
→ mobile identity/verification
→ review/confirmation
```

Home may summarize this flow, but it must not contradict it. Do not promise SMS delivery behavior yet; the provider/delivery behavior has not been specified.

### 4. Use the approved “any available specialist” meaning

Copy currently refers to “اولین متخصص در دسترس”.

Use wording equivalent to **«هر متخصص آزاد / هر متخصص در دسترس»** and avoid implying an unapproved “first available” assignment rule.

### 5. Fix mobile navigation

The code hides the desktop navigation below the large breakpoint, but no equivalent mobile navigation control is present.

Additionally, `My Appointments` is hidden below the small breakpoint even though Booking and My Appointments are explicitly mobile-first.

The refined Home must include:
- a real mobile navigation trigger/menu;
- mobile access to all public navigation;
- persistent discoverable access to «وقت‌های من»;
- persistent clear access to «رزرو وقت».

### 6. Correct navigation state

The Home export marks «خدمات» as the current page.

On Home:
- no unrelated page may be marked current;
- optionally include a Home link and mark it current, or keep the brand mark as the Home affordance without a false active state.

### 7. Replace the profile-like image used as the brand mark

The header currently uses a portrait/profile image next to «آرا».

Use a simple brand wordmark/monogram treatment instead. The salon brand identity must not visually read like a logged-in user avatar.

### 8. Keep legal/support links honest

The footer introduces specific legal/rights/health links such as booking rules and a client-rights charter without approved content.

For this stage:
- keep only confirmed navigation/contact content;
- legal/privacy destinations may appear only as clearly marked placeholders if needed for composition;
- do not imply that uncreated legal content already exists.

### 9. Reduce invented location/business facts

Specific address, phone, opening hours and similar facts can be used only as obvious mock content for visual composition.

Do not let the design imply these are approved production facts.

## Visual-system refinements

### Persian display typography

The current implementation requests `Noto Serif`, which is not a strong Persian-first display choice and can fall back unpredictably.

For visual exploration, use a Persian/Arabic-capable display face or a refined Vazirmatn-based hierarchy. Keep the final production font decision open for engineering/assets review.

### Token consistency

The export uses both `#814338` and `#9E5A4E` as competing primary/accent values.

Refine the design system so there is one clear semantic primary action color and a clearly secondary supporting warm tone.

### Editorial density

The direction is good, but Home can breathe more:
- fewer service items;
- slightly less metadata in marketing previews;
- preserve richer details for Services/Booking;
- allow imagery and whitespace to carry more of the premium character.

## Accessibility / state review

The refinement should explicitly show:
- focus treatment for navigation, service links, filter-like controls if any remain, and gallery links;
- touch-friendly mobile navigation;
- no information/state encoded only by color;
- readable text over gallery photography or move text outside imagery where contrast is uncertain.

## Baseline decision

Do **not** freeze this export.

Keep the visual direction and major section rhythm, then run one focused Home refinement pass. After that pass, review both mobile and desktop before deciding whether Home/design-system uncertainty is low enough to proceed to the remaining scoped pages.
