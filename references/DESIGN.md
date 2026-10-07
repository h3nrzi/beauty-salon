---
name: Obsidian & Champagne Precision
colors:
  surface: '#131313'
  surface-dim: '#131313'
  surface-bright: '#3a3939'
  surface-container-lowest: '#0e0e0e'
  surface-container-low: '#1c1b1b'
  surface-container: '#201f1f'
  surface-container-high: '#2a2a2a'
  surface-container-highest: '#353534'
  on-surface: '#e5e2e1'
  on-surface-variant: '#d1c5b4'
  inverse-surface: '#e5e2e1'
  inverse-on-surface: '#313030'
  outline: '#9a8f80'
  outline-variant: '#4e4639'
  surface-tint: '#e9c176'
  primary: '#e9c176'
  on-primary: '#412d00'
  primary-container: '#c5a059'
  on-primary-container: '#4e3700'
  inverse-primary: '#775a19'
  secondary: '#c8c6c5'
  on-secondary: '#313030'
  secondary-container: '#4a4949'
  on-secondary-container: '#bab8b7'
  tertiary: '#c8c6c5'
  on-tertiary: '#303030'
  tertiary-container: '#a7a5a5'
  on-tertiary-container: '#3b3b3b'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#ffdea5'
  primary-fixed-dim: '#e9c176'
  on-primary-fixed: '#261900'
  on-primary-fixed-variant: '#5d4201'
  secondary-fixed: '#e5e2e1'
  secondary-fixed-dim: '#c8c6c5'
  on-secondary-fixed: '#1c1b1b'
  on-secondary-fixed-variant: '#474646'
  tertiary-fixed: '#e4e2e1'
  tertiary-fixed-dim: '#c8c6c5'
  on-tertiary-fixed: '#1b1c1c'
  on-tertiary-fixed-variant: '#474746'
  background: '#131313'
  on-background: '#e5e2e1'
  surface-variant: '#353534'
typography:
  display-xl:
    fontFamily: Syne
    fontSize: 72px
    fontWeight: '700'
    lineHeight: 76px
    letterSpacing: -0.03em
  display-xl-mobile:
    fontFamily: Syne
    fontSize: 44px
    fontWeight: '700'
    lineHeight: 48px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Syne
    fontSize: 48px
    fontWeight: '600'
    lineHeight: 54px
    letterSpacing: -0.02em
  headline-lg-mobile:
    fontFamily: Syne
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 38px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Syne
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Syne
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
    letterSpacing: 0em
  title-md:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '500'
    lineHeight: 26px
    letterSpacing: 0em
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 26px
    letterSpacing: -0.01em
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 22px
    letterSpacing: 0em
  label-uppercase:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.15em
  label-sm:
    fontFamily: Inter
    fontSize: 11px
    fontWeight: '500'
    lineHeight: 14px
    letterSpacing: 0.08em
spacing:
  gutter: 1.5rem
  gutter-mobile: 1rem
  margin: 4rem
  margin-mobile: 1.5rem
  space-xs: 0.25rem
  space-sm: 0.5rem
  space-md: 1rem
  space-lg: 2rem
  space-xl: 4rem
---

## Brand & Style

This design system establishes an architectural, editorial luxury aesthetic tailored for high-end automotive preservation, bespoke paint protection, and concourse-level detailing. The atmosphere evokes the quiet confidence of an ultra-exclusive atelier: clinical precision paired with museum-grade craftsmanship.

### Aesthetic Principles
- **Architectural Minimalism:** Layouts honor structural discipline, expansive negative space, and rigid alignments reminiscent of premium editorial monographs and modern brutalist architecture.
- **Monochrome Dominance:** True obsidian and rich charcoal tones form the foundational canvas. Restraint is paramount—color is never used decoratively, only purposefully.
- **Metallic Tension:** A singular, subdued champagne gold/warm bronze accent functions as an intentional focal point, echoing precision brass instrumentation and high-spec automotive trim.
- **Restraint & Exclusions:** Absolutely no neon glows, chromatic gradients, faux glassmorphism, floating drop-shadows, or rounded "friendly" SaaS motifs. Visual authority stems from hairline precision, stark contrast, and full-bleed editorial imagery.

## Colors

The palette relies on a pitch-black core modulated by subtle tonal tiers and unified by a metallic champagne accent.

### Color Architecture
- **Primary (`#C5A059`):** Refined champagne gold. Used strictly for high-priority interactive states, key focal badges, micro-accents, and active selections. Must not saturate the viewport.
- **Neutral Canvas (`#0A0A0A`):** Pure obsidian. Serves as the primary viewport background to deliver cinematic depth and infinite contrast against automotive photography.
- **Surface Elevation (`#121212` / `#181818`):** Layered surface tones providing subtle step-ups in visual plane without introducing chromatic distraction.
- **Hairline Structural Borders (`#262626` / `#333333`):** 1px structural grid dividers framing content sections and components.
- **Typography Tone Hierarchy:**
  - *Primary Text (`#F5F5F7`):* Stark, luminous off-white delivering optimal contrast for headlines and vital data.
  - *Secondary / Body (`#D1D1D6`):* Softened titanium white preventing optical glare across dense editorial descriptions.
  - *Muted / Caption (`#A1A1A6`):* Subdued neutral gray for technical specs, tracking metadata, and input labels.

## Typography

The typographic pairing balances the sculptural, high-impact presence of **Syne** for display elements against the clinical, utilitarian clarity of **Inter** for technical body copy and UI controls.

### Implementation Guidelines
- **Display & Headlines:** Headings use Syne in semi-bold or bold weights with controlled negative letter spacing to create commanding, architectural lockups.
- **Body Text:** Inter delivers flawless legibility across dark surfaces. Generous line heights (`1.5` to `1.6`) ensure readability against high-contrast backgrounds.
- **Labels & Micro-Copy:** All navigational tags, section metadata, badges, and button labels must use `label-uppercase`—set strictly in uppercase with wide letter tracking (`0.12em` to `0.18em`) to mirror luxury timepieces and bespoke automotive badging.

## Layout & Spacing

The layout operates on a disciplined 12-column architectural grid with visible hairline demarcations that frame content blocks like gallery exhibits.

### Grid & Breakpoints
- **Desktop (1280px+):** 12 columns, fixed maximum canvas width of 1440px or full-bleed structural edge-to-edge with 64px (`margin`) outer offsets and 24px (`gutter`) inter-column channels.
- **Tablet (768px – 1279px):** 8 columns, 32px outer canvas margins, 20px gutters. Content collapses gracefully into symmetric 4-column blocks.
- **Mobile (< 768px):** 4 columns, 24px (`margin-mobile`) margins, 16px (`gutter-mobile`) gutters. Dense vertical stacks preserve vertical breathing room.

### Spacing Philosophy
- Section transitions must lean into expansive vertical offsets (`space-xl` or larger) to convey luxury, calm, and confidence.
- Component-level spacing adheres strictly to tight multiples of 8px, prioritizing horizontal internal padding over vertical padding in button and pill layouts to maintain sleek silhouettes.

## Elevation & Depth

This design system rejects conventional dropped shadows, colored blurs, and skeuomorphic lighting models. Spatial depth is communicated exclusively via **tonal stratification** and **hairline edge definition**.

### Depth Hierarchy
1. **Canvas Level (Ground 0):** Pure `#0A0A0A` serves as the underlying void for full-page backgrounds.
2. **Structural Panels (Level 1):** `#121212` backgrounds framed with a crisp, 1px solid border in `#262626`.
3. **Elevated & Interactive Surfaces (Level 2):** `#181818` with `#333333` hairline borders, used for popovers, flyouts, and contextual detail panels.
4. **Active/Hover Focus:** On hover or active focus, surface borders brighten transitionally from `#262626` to `#C5A059` at 100% opacity, offering sharp feedback without shifting layout geometries.

## Shapes

The shape system embraces absolute razor-edge geometry (`roundedness: 0`). 

### Geometric Rationale
- Radii are set to `0px` across cards, image viewports, dialogs, inputs, and primary buttons.
- Rectilinear perimeters mirror carbon-fiber weaves, chassis body lines, and structural framing.
- The only permissible curved elements are technical indicators (e.g., status LEDs, radio controls, circular detail inspection loupes) which remain purely circular (50% radius) for functional distinction.

## Components

### Buttons
- **Primary:** Solid `#C5A059` fill with `#0A0A0A` text, 0px border radius, uppercase typography with `0.15em` tracking. Padding: `16px 32px`. Hover state: Subtle desaturation or illumination (`#D4AF37`) with instant ease-out transition (150ms).
- **Secondary / Outline:** Transparent fill, 1px solid `#333333` border, `#F5F5F7` text. Hover state: Border shifts to `#C5A059`, text shifts to `#C5A059`.
- **Text Link / Action:** Inline uppercase label with an animated 1px underline that expands from left to right on hover.

### Cards & Service Containers
- Built on `#121212` backgrounds enclosed by 1px `#262626` hairline borders.
- Zero border radius. Images within cards bleed directly to top and side edges with razor-sharp framing.
- Imagery employs a subtle desaturated treatment by default, transitioning to full tonal richness upon cursor engagement.

### Input Fields & Controls
- **Text Inputs:** Low-height, rectangular containers with `#0E0E0E` backgrounds, 1px `#262626` borders, and `#F5F5F7` text. Floating labels in `label-sm` muted uppercase (`#A1A1A6`). Focused state transitions the border to a sharp 1px `#C5A059` stroke without glow.
- **Checkboxes & Radios:** Sharp, custom square check marks and micro-inset radio indicators. Active fill uses `#C5A059` with zero corner smoothing.

### Badges & Technical Chips
- Low-profile status tags featuring transparent fills, 1px solid `#333333` borders, and 4px 10px padding. Text is formatted in `label-sm` uppercase. Champagne accents are reserved for certified tier badges (e.g., "LEVEL IV CERAMIC", "PAINT TO SAMPLE").

### Lists & Specifications
- Studio specification tables and service matrices utilize border-bottom dividers in `#1F1F1F`.
- Key/value rows align label columns in muted titanium gray (`#A1A1A6`) with tabular figures and values rendered in high-contrast crisp white (`#F5F5F7`).

### Studio Signature Details
- **Inspection Loupe / Image Slider:** Razor-thin vertical slider dividers (1px `#C5A059`) for before/after paint correction comparisons.
- **Service Tier Steppers:** Linear horizontal hairline conduits linking rectangular step nodes, avoiding rounded pill meters.