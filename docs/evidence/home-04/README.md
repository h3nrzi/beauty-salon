# Ticket 04 local evidence — 2026-10-08

Review baseline: `49e5f5648b7e62d15729c0eb3b3b71afe679b62a`. Local Home: `http://wordpress.local/`. WordPress 7.1.3, Local PHP 8.2.29, nginx 1.26.1, macOS 26.1. Exact automated browser versions/timestamps are in the browser result files.

## Native WordPress evidence

`wordpress-results.txt` records native public/admin seam checks. Actual Editor saves and authenticated page REST propagate Home text, including Unicode/backslashes. Author/Subscriber edits are denied; anonymous page REST excludes editorial metadata. Invalid headings, markup, out-of-range ratings, unknown fields, oversized/duplicate Service/Project references and forged native nonce preserve content. Canonical Service title/price/duration/protection edits propagate to Home and Services, while stable detail/preselection links survive renaming. Draft Services are excluded. One shared Porsche work edit propagates to Home and Gallery. Native revisions restore Home copy, hero media, Testimonials, placement references/contextual copy/media and baseline order. Optional empty collections and cleared native Service/review rows omit cleanly. All probes restore local state in `finally`.

## Browser/accessibility evidence

Home tests run in installed Chrome, Firefox and Playwright WebKit at 375, 768, 1024 and 1440 CSS px. They check the frozen section order, canonical featured offerings/facts, exact Project order, three attributed reviews with accessible ratings, configured navigation state, actual Services target anchors, Contact preselection and Gallery destinations. Keyboard Home/End/Arrow and touch operate the comparison; before/after geometry stays aligned. Every Home photograph loads from the local Media Library with `srcset`/`sizes` and intrinsic dimensions; hero is eager/high-priority and remaining photos are lazy. Checks reject external requests, script errors and viewport overflow. JavaScript disabled or independently blocked comparison script leaves both labelled figures, all Projects and keyboard-operable discovery links available.

`axe-*.json` contains zero automated WCAG 2 A/AA and 2.1 A/AA violations across twelve Home viewport/engine runs, including unresolved manual-review entries. This automated audit does not certify screen-reader use. `home-*.png` are full-page desktop/tablet/mobile renders after local photographs load. Native Safari rendering/accessibility-tree smoke is recorded separately in `safari-smoke.md`; WebKit is not labelled actual Safari acceptance.

The initial tracer test failed because Home did not render saved content, then passed after implementation. Early browser harness runs failed on a nonexistent select (Contact currently exposes radio preselection), an overly broad hero image selector that included its decorative icon, and a navigation assertion made before navigation completed. The selectors/wait were corrected; the hero image CSS was also limited to the photograph so the caption icon retains its geometry. Independent Spec review reproduced a placement-index bug: reordering Porsche suppressed its configured comparison. A new native/public HTTP regression failed before the fix, then passed when comparison rendering became independent of first-card layout. The first full regression suite also exposed a pre-existing Services test timing race: smooth scrolling between two separate rectangle reads could make an aligned comparison appear displaced. The harness now measures both rectangles in one frame without changing product geometry. Only completed follow-up runs are reported as passing. `full-suite.json` records final syntax, six WordPress scripts, PHP lint and the four-page Chrome browser regression suite; all final checks pass after the review fix. Duplicate regression screenshots/audits are not retained; final Home captures replace their earlier counterparts, and the complete four-page regression stdout is retained in that report.

## Visual inspection and deviations

The implementer inspected frozen Home screenshot/HTML and local desktop/mobile renders. Hero typography/image/trust strip, philosophy, three featured Services, a wide Porsche comparison followed by DB12/Range Rover, four benefits, three reviews and inset final CTA retain their order, columns, dark/champagne palette and hierarchy.

Explicit differences for native content/accessibility:

- Canonical Full Detail replaces the legacy combined title; canonical duration/protection replace conflicting duration/warranty copy.
- “Selected Projects” replaces forbidden “Provenance Registry”; neutral Before/After replace the unsupported 98.5% correction label.
- Project work and ordered facts remain canonical, rather than copied Home-specific technical values. More canonical fact rows are visible than in the compact export; human parity review should assess the resulting card height.
- Each featured Service adds the required preselected appointment link. Home-only Projects have discoverable Gallery links.
- Real Media Library photographs replace screenshot/remote dependencies; the frozen source photos are 512×279 references and require production quality/rights review.
- Existing local decorative icons replace the remote icon font. Reviews expose textual ratings and native quotation/attribution semantics.
- Final CTA expresses an Appointment Request and does not advertise availability. Shared current hours are rendered from Studio settings rather than duplicated from Home copy.

Pre-existing local configuration has all weekdays marked closed; this slice preserves that setting and therefore its shared footer differs from baseline hours. Ticket 07 baseline setup/acceptance must resolve the configuration drift. No new hours or availability promise is inferred here.

Human visual parity approval, screen-reader/200% text zoom/400% reflow and the full actual Safari viewport/no-JavaScript matrix remain pending consolidated acceptance. Production-like five-run LCP/CLS measurement is not claimed from Local. Ticket 07 owns full reproducible setup, cleared production media, legal destinations and production performance. `ready-for-human` means implementation/evidence are ready for this review, not production certification.

`review.md` records independent Standards/Spec review: no hard Standards violations, one nonblocking duplication observation, and one Spec finding fixed and independently rechecked.
