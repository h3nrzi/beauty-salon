# Stitch Review 36 — Manager Services refinement rejected

**Reviewed:** 2026-10-11  
**Source:** `stitch_salon_visual_baseline (35).zip`  
**Compared against:** old Manager Services from `stitch_salon_visual_baseline (34).zip`  
**Package SHA-256:** `7131619a4cceccfd26ad557f41454e2a2f303d8c41f9675f5fd8fa32e6826667`  
**Decision:** **Reject the new refinement. Return to the old Manager Services screen as the visual source.**

## Why this version is rejected

Prompt 35 removed several out-of-scope elements correctly, but Stitch over-interpreted the refinement and rebuilt too much of the composition.

The result is materially weaker than the old screen.

### 1. Page hierarchy became fragmented

The old page had a clear top-to-bottom operational rhythm:

- manager shell;
- page heading/actions;
- search/category controls;
- service table;
- guidance.

The new page separates the title, actions and controls too aggressively, creating a looser and less intentional top section.

The page feels assembled from independent blocks rather than one operational workspace.

### 2. The visual density regressed

The old version used the desktop canvas efficiently.

The new version introduces unnecessary open space and weaker alignment between:

- heading;
- add/sort actions;
- category row;
- search;
- table.

The catalog should feel compact and deliberate, not airy like a marketing page.

### 3. The table became visually weaker

The old table had stronger row rhythm and more balanced column proportions.

The new version:

- makes the service-name treatment inconsistent;
- mixes photographs and icon placeholders unevenly;
- gives some columns too much space and others too little;
- weakens scanability of duration/price/specialist information;
- makes the edit action feel detached from the row.

### 4. Service imagery became inconsistent

Some services use photographs while others use large symbolic icon tiles.

This creates an accidental mixed visual language.

For a manager catalog table, service imagery should be either:

- consistently small thumbnails; or
- consistently omitted.

Do not mix thumbnail photography and oversized decorative icons.

### 5. Too many design changes were made at once

The goal was a **scope/content cleanup**, not a redesign.

The old Manager Services layout was already usable.

The next attempt should make surgical changes only.

## Root workflow correction

For this page, do **not** use frozen public Services or multiple reference screens.

The old Manager Services screen already belongs to the same baseline family.

Selecting multiple visual anchors encouraged Stitch to synthesize a new layout rather than edit the existing one.

## Accepted decisions from the rejected pass

Keep these product corrections in the next attempt:

- remove KPI/analytics cards;
- use `قیمت`, not `تعرفه`;
- use `متخصصان ارائه‌دهنده`, not `متخصصان مجاز`;
- neutralize treatment/spa/medical service names;
- use one simple `قابل رزرو` control;
- use one clear `ویرایش` row action;
- remove calendar-guide/system-sync language.

## Next strategy

Start again from the **old Manager Services** screen.

Preserve its geometry and table composition almost exactly.

Apply only targeted removals/renames.

Do not use the rejected screen as a reference.
