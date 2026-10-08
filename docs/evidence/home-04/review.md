# Ticket 04 two-axis review

Fixed point: `49e5f5648b7e62d15729c0eb3b3b71afe679b62a` (current HEAD before this task). Reviewed implementation commit: `3d74db4`. Command: `git diff 49e5f5648b7e62d15729c0eb3b3b71afe679b62a...HEAD`. Independent Standards and Spec sub-agents were required by `.agents/skills/code-review/SKILL.md`, invoked by the user-selected implement workflow.

## Standards

Hard violations: none found. Core remains untouched; plugin content ownership, theme presentation, stable references, revisions, native routes, and canonical facts follow the documented ADRs. Temporary media use is explicitly authorized and documented; production rights remain pending.

Possible smell — **Duplicated Code** (P3): `includes/home-page.php` reproduces Gallery’s metadata registration, authorization, REST validation/redaction, nonce checks, save loop and revision lifecycle. Representative repeated hunks are `register_post_meta('page',$key,...)` and `update_post_meta($post_id,'_noir_home_'.$name,wp_slash($value)); wp_save_post_revision($post_id);`. Future permission or revision-policy changes must be synchronized across both modules. A small shared fixed-page metadata lifecycle could accept template, prefix, schemas and section validator while retaining page-specific content logic. This is a maintainability judgement, not a documented-standard violation or acceptance blocker.

Disposition: retain the existing page-specific pattern for this slice. A shared lifecycle refactor affects other completed pages and is not required for correctness. No documented standard was violated.

## Spec

Initial **[P2] Reordering Projects silently removes configured comparisons.** `template-parts/home-project.php` rendered a comparison only when `$featured` was true; `page-home.php` assigned that flag only to the first placement. Moving Porsche later through the supported native editor replaced its configured pair with a single image. The specification requires “Unique ordered Project reference … optional contextual image or complete comparison pair” (`spec.md:112`) and “one reusable comparison component for Home, Services, and Gallery” (`spec.md:166`). Preserve first-card layout while rendering configured pairs independently of index; verify comparison behavior after reordering.

No additional actionable missing requirements or unwanted scope were found. Canonical Services/facts, distinct Home-only Projects, native metadata/restoration, bounded optional collections, configured links, and frozen section order are implemented. Temporary local image authorization and pending human visual/Safari/screen-reader acceptance are explicitly documented and were not treated as production certification.

Disposition: reproduced with a failing native/public HTTP regression; removed the placement-index gate; the test now checks reordered Porsche’s before image and comparison control. Hero rendering also omits an unavailable optional attachment through the existing validity boundary. The Spec reviewer independently verified both working changes and reported no new findings.

Final summary: Standards — 0 hard violations, 1 nonblocking P3 duplication smell; Spec — 1 initial P2, resolved, 0 remaining actionable findings.
