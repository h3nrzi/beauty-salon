# Services browser-comment fixes — 2026-10-08

Baseline: `06fd618`. Owner requested three corrections on `/services/`.

- Footer Service section anchors inherited WordPress's current-page flag from their shared Services page. Clear only their current-state flags/classes after canonical anchor resolution. The actual Services navigation item stays current; section links remain neutral.
- Footer Request Appointment inherited the global gold `.text-link` style. Give this footer link the same neutral color/weight as adjacent navigation links, with gold on hover.
- Move the shared native comparison range onto the images. A visible divider and central chevron handle replace the below-image range; its label is visually hidden but accessible. Focus outlines the images. RTL range direction follows the after-image reveal from the right, with horizontal keys normalized across engines. No JavaScript still shows both labelled figures. Gallery uses the same corrected component.

## Verification

The initial live-page probe failed all three exact symptoms; the corrected page passes all three. Permanent Services browser regressions assert neutral footer colors/current state and the range within the image bounds. They also drag the handle, tap/click, use arrows/Home/End, and inspect meaningful accessible values. Gallery covers the shared overlay, filtering, focus, native range interaction, vertical touch scrolling in Chrome, and blocked/absent scripts.

Commands passed:

```sh
NOIR_EVIDENCE_DIR=/tmp/noir-services-ui NOIR_BROWSER=chrome,firefox,webkit node tests/services-browser.cjs
NOIR_EVIDENCE_DIR=/tmp/noir-gallery-ui NOIR_BROWSER=chrome,firefox,webkit node tests/gallery-browser.cjs
npm run check
```

Both pages pass Chrome, Firefox and Playwright WebKit at 375, 768, 1024 and 1440px: 24 page/viewport runs total, with zero automated axe violations. Engine versions and runs are recorded in `services-browser-results.json` and `gallery-browser-results.json`; `axe-summary.json` records violation counts. Changed PHP files pass syntax checks; `git diff --check` passes. WebKit automation is not an actual Safari manual check.

Inspected decoded-image Chrome captures at 1384×773: [comparison](comparison.png) and [footer](footer.png). Historical Ticket 02 evidence describes the former below-image control; this follow-up supersedes that placement.
