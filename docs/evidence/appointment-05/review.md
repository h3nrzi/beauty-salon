# Two-axis review

Baseline `3d6896e812a12dfc90e080528415da9bb1e4bf2e`; initial implementation commit `0129f58`. Two independent agents reviewed Standards and Spec using the `code-review` skill. Full Ticket 06 reliability certification was excluded.

## Standards

Initial findings: two documented breaches and one heuristic concern.

1. Presentation boundary: the plugin implemented the normal styled form although ADR 0002 says the theme owns presentation. Corrected by moving the normal form/status composition into the theme template. The plugin supplies a bounded view including choices, fields, endpoint, safe values, errors, date minimum and outcome; it retains only a minimal portable fallback.
2. Translatable interface strings: new literal English interface copy did not follow decision D-013's code-owned/translatable requirement. Corrected with WordPress translation functions and contextual escaping in both theme and plugin.
3. Possible Mysterious Name / Primitive Obsession: positional field arrays made validation/rendering indices unclear. Corrected with named field-contract keys, without introducing a new abstraction.

Independent follow-up verification is recorded below when complete.

## Spec

Initial review found no actionable normal-path implementation defect or scope creep. One partial acceptance requirement remains: automated Chrome/Firefox/WebKit evidence does not replace actual Safari, manual screen-reader/zoom or human visual parity review. The ticket and evidence explicitly leave those pending. Complete worker/throttle/storage/crash/capacity certification remains Ticket 06.

## Additional visual correction

Visual inspection of the error screenshot exposed PHP warnings and an admin toolbar on anonymous POST responses: `admin-post.php` initializes the admin runtime without a current editing screen. A new real HTTP regression failed before the fix and passed after removing toolbar rendering/style callbacks only for the public response. WordPress Core is unchanged. The plugin fallback also passes a real HTTP correction test with the normal theme response hook removed by the temporary test environment.

Initial counts: Standards 2 documented findings + 1 judgement call (all corrected); Spec 0 implementation defects + 1 disclosed manual-acceptance gap.
