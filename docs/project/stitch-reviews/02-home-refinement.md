# Stitch Review 02 — Home refinement

**Reviewed:** 2026-10-08  
**Source:** second Stitch export with three generated screens plus design-system documents  
**Decision:** Refinement is materially better. Visual direction remains accepted, but Home/design-system baseline is **not frozen yet**. One final consistency pass is required.

## Overall assessment

The refinement successfully fixed several important issues from Review 01:

- Home now uses a curated 3-service preview instead of behaving like the full Services page.
- The refined mobile screen exposes both «وقت‌های من» and «رزرو وقت».
- A real mobile menu pattern is present.
- The false active/current state on «خدمات» is removed in the refined screens.
- The profile-like brand avatar is removed; «آرا» now reads as a brand/wordmark.
- The refined mobile booking summary now reflects the approved 5-stage product flow.
- “هر متخصص در دسترس” replaces the unapproved “first available” interpretation.
- Pay-at-salon / no-online-payment messaging remains clear.
- The overall Soft Editorial composition is stronger and less crowded.

This is now close to a usable Home/design-system baseline.

## Why the baseline is not frozen yet

The exported screens are not internally consistent. The most refined mobile screen and the refined desktop screen do not yet express the same approved product copy/navigation behavior.

### 1. Desktop header still loses critical product actions

The refined desktop screen contains the public navigation, but does not preserve obvious header access to:

- «وقت‌های من»;
- «رزرو وقت».

Those actions are present in the refined mobile screen and are product-important.

The final Home baseline must keep both discoverable on desktop and mobile.

### 2. Desktop booking copy still contains stale product mismatches

The refined desktop booking block still includes language equivalent to:

- SMS confirmation after booking;
- “service or package”;
- wording that may imply a later coordination/approval step.

The approved v1 does not define packages, does not promise SMS delivery behavior, and confirms a successful booking immediately without manual approval.

The mobile refinement is closer to the approved contract. Make desktop match that same 5-stage flow.

### 3. “Spa / atelier” positioning is still being invented

Page title/footer variants still call the product a “spa” or “atelier / exclusive spa”.

The frozen Product Definition is a single women's beauty salon. Do not silently widen product positioning into a spa unless scope is explicitly changed.

Use “سالن زیبایی بانوان آرا” or similarly neutral salon wording.

### 4. Some unsupported claims remain

The refined mobile copy still contains claims such as:

- “نمونه‌های واقعی و بدون فیلتر”;
- wording that can read as a guarantee of no waiting/no schedule overlap;
- broad hygiene/material-quality assertions presented as established salon facts.

These may be reasonable eventual marketing claims, but they are not approved facts yet.

Use neutral placeholder language:
- “نمونه‌ای از سبک و کیفیت بصری خدمات” rather than claiming the work is real/unfiltered;
- “زمان‌بندی شفاف” rather than guaranteeing no waiting;
- “محیط حرفه‌ای و منظم” rather than unsupported certification/quality guarantees.

### 5. Legal/privacy links are still presented as real destinations

The refined mobile footer still shows «قوانین نوبت‌دهی» and «حریم خصوصی» as normal links.

They are not yet approved/published destinations.

For the visual baseline:
- either remove them;
- or clearly mark them as placeholder/future destinations.

Do not visually imply finished legal content.

### 6. Specific business facts need explicit placeholder treatment

Address, phone and opening hours are still specific invented values.

They can remain for composition only if visibly/documentarily treated as mock placeholder content. They are not production facts.

### 7. Persian display typography is still unresolved in the implementation

The design documents discuss Persian-first typography, but their tokens and generated HTML still rely on `Noto Serif` for display headings.

That can cause uncontrolled Persian fallback because the intended font is not explicitly a Persian/Arabic serif family.

Before baseline freeze, use an explicitly Persian/Arabic-capable display choice, or use Vazirmatn consistently for the baseline. Final production font packaging remains an engineering/media decision later.

### 8. Color-token semantics are still contradictory

The design prose says `#9E5A4E` is the single primary terracotta, but frontmatter still declares:

- `primary: #814338`;
- `primary-container: #9E5A4E`.

This is not a visual blocker by itself, but the baseline design system should state one semantic primary action color and one supporting warm tone consistently so later engineering does not guess.

### 9. Mobile screenshot evidence is not usable at a realistic viewport width

The exported mobile `screen.png` is only about 65 px wide. The HTML structure appears responsive, but that screenshot is not reliable visual evidence for a normal handset.

Before freeze, render/export a realistic mobile viewport (for example 390×844 or 375×812) plus desktop.

## Baseline decision

**Do not freeze yet.**

Run one final consistency pass, not a redesign.

Freeze Home/design-system after:
- desktop/mobile navigation/action parity;
- one approved 5-stage booking summary everywhere;
- removal of package/SMS/manual-coordination wording;
- salon-only positioning;
- unsupported marketing claims neutralized;
- legal/business details clearly treated as placeholders;
- Persian-capable display typography;
- consistent primary color semantics;
- realistic mobile + desktop visual evidence.
