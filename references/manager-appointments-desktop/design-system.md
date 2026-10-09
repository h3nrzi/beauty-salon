---
name: Warm Editorial Salon & Booking
colors:
  surface: '#fef8f4'
  surface-dim: '#dfd9d5'
  surface-bright: '#fef8f4'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f9f2ef'
  surface-container: '#f3ede9'
  surface-container-high: '#ede7e3'
  surface-container-highest: '#e7e1de'
  on-surface: '#1d1b19'
  on-surface-variant: '#534340'
  inverse-surface: '#32302e'
  inverse-on-surface: '#f6f0ec'
  outline: '#86736f'
  outline-variant: '#d8c2bd'
  surface-tint: '#8d4c41'
  primary: '#814338'
  on-primary: '#ffffff'
  primary-container: '#9e5a4e'
  on-primary-container: '#ffebe8'
  inverse-primary: '#ffb4a7'
  secondary: '#615e59'
  on-secondary: '#ffffff'
  secondary-container: '#e7e2dc'
  on-secondary-container: '#67645f'
  tertiary: '#59544b'
  on-tertiary: '#ffffff'
  tertiary-container: '#716c63'
  on-tertiary-container: '#f7eee3'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffdad4'
  primary-fixed-dim: '#ffb4a7'
  on-primary-fixed: '#390b05'
  on-primary-fixed-variant: '#70352b'
  secondary-fixed: '#e7e2dc'
  secondary-fixed-dim: '#cbc6c0'
  on-secondary-fixed: '#1d1b18'
  on-secondary-fixed-variant: '#494642'
  tertiary-fixed: '#eae1d6'
  tertiary-fixed-dim: '#cdc5bb'
  on-tertiary-fixed: '#1f1b14'
  on-tertiary-fixed-variant: '#4b463e'
  background: '#fef8f4'
  on-background: '#1d1b19'
  surface-variant: '#e7e1de'
typography:
  display-lg:
    fontFamily: Noto Serif
    fontSize: 44px
    fontWeight: '400'
    lineHeight: 56px
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Noto Serif
    fontSize: 32px
    fontWeight: '400'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg:
    fontFamily: Noto Serif
    fontSize: 32px
    fontWeight: '500'
    lineHeight: 42px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Noto Serif
    fontSize: 26px
    fontWeight: '500'
    lineHeight: 34px
    letterSpacing: 0em
  headline-md:
    fontFamily: Noto Serif
    fontSize: 24px
    fontWeight: '500'
    lineHeight: 32px
  headline-sm:
    fontFamily: Noto Serif
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 15px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 20px
  label-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 15px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 13px
    fontWeight: '600'
    lineHeight: 18px
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 11px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.04em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  gutter: 1.5rem
  gutter-mobile: 1rem
  margin: 3rem
  margin-mobile: 1.25rem
  space-xs: 0.375rem
  space-sm: 0.75rem
  space-md: 1.25rem
  space-lg: 2rem
  space-xl: 3.5rem
---

## Brand & Style

This design system embodies an intimate, high-end editorial atmosphere tailored for luxury beauty, wellness, and bespoke salon reservations. Grounded in contemporary Persian design sensibilities, it balances artisanal warmth with deliberate restraint. 

The emotional tone evokes calm sanctuary, quiet luxury, and personal care. The design style synthesizes modern editorial minimalism with soft tactile warmth: generous negative space, measured layout proportions, architectural alignment, and organic, grounding textures. Visual clutter is methodically removed to highlight treatment services, tactile imagery, and seamless booking flows.

## Colors

The palette draws directly from raw earthenware, sun-dried stone, and parchment. 

- **Primary Accent (`#9E5A4E`)**: A single, focused Terracotta reserve used strictly for high-priority interactive calls to action, selected active states, and focal accents. Interactive hover shifts down to `#8F4F44`, and pressed states resolve to `#7C4339`.
- **Canvas & Surface Tiering**:
  - Base Page Canvas: `#FAF8F5` (Warm Ivory)
  - Secondary Canvas / Section Containers: `#F5F1EB` (Alabaster Bone)
  - Card & Elevated Floating Panels: `#FFFDFB` (Pure Porcelain)
  - Subtle Inset Wells & Filter Track Surfaces: `#F3EDE7` (Soft Warm Beige)
- **Neutrals & Framing**:
  - Hairline Borders & Structural Rules: `#E5DFD7` and `#E8E2DA`
  - Secondary Muted Borders: `#DDD5CA`
- **Text & Semantics**:
  - Primary Typography: Deep Charcoal `#23211F` ensuring strict contrast without coldness.
  - Secondary Body & Subtitles: Warm Umber `#5C5651`.
  - Muted Captions & Placeholder Text: Stone Gray `#8C847C`.
  - Interactive Focus Ring: `#9E5A4E` with an outer 2px offset in `#FAF8F5`.

## Typography

The typographical hierarchy is bilingual-ready and Persian-first. In Persian language contexts, `Vazirmatn` serves as the primary system driver across UI labels, editorial body, and headlines, utilizing its tailored Persian numerals (`font-feature-settings: "numr" 1, "ss01"`). In multi-language or Latin environments, typography pairs an editorial serif for expressive editorial displays (`Noto Serif`) with a balanced, warm grotesque sans-serif (`Plus Jakarta Sans`) for utilitarian data tables, pricing, and scheduling matrices.

- Headings prioritize optical weight over extreme bolding; titles favor light to medium serifs or medium-weight Vazirmatn characters to maintain literary composure.
- Editorial pullquotes, prices, and treatment titles receive increased line heights (1.4–1.6) to prevent crowded letterforms in both RTL and LTR viewports.
- Persian numerals are enforced across all booking slots, pricing, and duration indicators.

## Layout & Spacing

The layout is built upon an architectural grid engineered for breathable, magazine-grade storytelling.

- **Grid Architecture**: 
  - Desktop: 12-column layout with a maximum container boundary of `1280px`, anchored by generous `3rem` (48px) exterior margins and `1.5rem` (24px) gutters.
  - Tablet: 8-column layout with `2rem` (32px) margins.
  - Mobile: 4-column layout with `1.25rem` (20px) margins and `1rem` (16px) gutters.
- **Rhythm & White Space**: Vertical rhythm relies on ample empty space between sections (`space-xl` to twice `space-xl`) to establish an unhurried, tranquil experience. Booking time slots and treatment lists maintain comfortable vertical click targets with minimal inner density.
- **Bi-Directional Flexibility (RTL / LTR)**: Layout structures employ logical properties (`margin-inline-start`, `padding-inline-end`) ensuring seamless visual equilibrium between Persian (RTL) and Latin (LTR) modes without awkward spacing shifts.

## Elevation & Depth

Visual hierarchy rejects harsh digital drop shadows, relying instead on tonal layer transitions and diffused ambient warmth that replicates light filtering through sheer linen:

- **Surface Tiering**: Depth is primarily established through alternating backdrop tones (`#FAF8F5` base against `#FFFDFB` elevated cards, bordered with `#E5DFD7`).
- **Low-Contrast Framing**: Structural containment relies on crisp, subtle 1px outlines (`#E5DFD7`) rather than aggressive dropshadows.
- **Ambient Warm Shadows**:
  - **Flat / Default**: 0px blur, strictly delineated by a `1px solid #E5DFD7` border.
  - **Floating Elements (Card Hover, Dropdown Menus)**: `0 8px 24px -4px rgba(74, 52, 46, 0.05), 0 2px 6px -1px rgba(74, 52, 46, 0.03)`.
  - **Overlays (Modals, Booking Drawers)**: `0 20px 48px -12px rgba(35, 33, 31, 0.12), 0 1px 3px 0 rgba(35, 33, 31, 0.04)`.
- **Backdrop Diffusion**: Modals and drawer backdrops utilize `#23211F` at 30% opacity overlaid with a soft `4px` blur filter, preserving the warm palette underneath.

## Shapes

The geometric form language is gentle and tailored (`roundedness: 1`). Radii are kept soft rather than bulbous, reinforcing an architectural, refined presence.

- **Base Components (Inputs, Small Badges, Service Items)**: `0.25rem` (4px).
- **Cards, Panels, and Appointment Blocks**: `0.5rem` (8px).
- **Modals, Floating Panels, and Sheet Drawers**: `0.75rem` (12px).
- **Interactive Action Pills & Selected Dates**: Form-fitted geometry with deliberate, soft-edge finishes; full pill radii are reserved strictly for circular profile avatars and micro status indicators.

## Components

### Buttons
- **Primary**: Solid Terracotta background (`#9E5A4E`), `#FFFDFB` text, 0.25rem radius, horizontal padding `1.5rem`, vertical padding `0.75rem`. Hover state transitions to `#8F4F44`. Focus outline is a 2px offset ring in `#9E5A4E`.
- **Secondary**: Transparent background with a 1px border in `#E5DFD7`, `#23211F` text. On hover, background shifts to `#F3EDE7`.
- **Ghost / Text**: Transparent with `#5C5651` text, underlining on hover with a smooth 150ms opacity transition.

### Cards & Service Tiles
- Background `#FFFDFB`, bordered with a 1px solid `#E5DFD7`. 
- Service cards split content symmetrically: Treatment Title and Duration (`label-md` in `#5C5651`) on the inline start, and Price formatted with Persian numerals alongside an understated "Reserve" trigger on the inline end.
- Hover brings a subtle lift via the ambient warm shadow and a border shift to `#DDD5CA`.

### Form Fields & Inputs
- Background `#FFFDFB`, 1px border `#E5DFD7`, radius `0.25rem`. Height fixed at `44px` for touch ergonomics.
- Input text uses `#23211F`, placeholder text `#8C847C`.
- Focus state activates a 1px border in `#9E5A4E` with an inner shadow ring, avoiding standard browser chrome rings.

### Selection Chips & Time Slots
- Non-active time slots: `#F5F1EB` background, `#23211F` text, borderless or bordered with hairline `#E5DFD7`.
- Selected time slot: `#9E5A4E` background with `#FFFDFB` text, creating unmistakable visual confirmation.
- Unavailable/Disabled slots: Strikethrough `#8C847C` with `#FAF8F5` surface at 50% opacity.

### Checkboxes & Radios
- Square/Circular boundaries using 1px border in `#DDD5CA`, background `#FFFDFB`.
- Checked status fills with `#9E5A4E` containing an off-white `#FFFDFB` checkmark or inner dot.

### Navigation Drawer (Mobile)
- Slides smoothly from the inline end (`right` in LTR, `left` in RTL).
- Surface `#FAF8F5` framed with a single 1px separating border `#E5DFD7`.
- Features an uncluttered vertical sequence of navigational links (`headline-md`), leading to a pinned reservation action button anchored to the safe area bottom.