# Actual Safari smoke — 2026-10-08

Native Safari was opened through the Computer Use API on macOS. The installed Safari bundle reports its exact version below (recorded from the bundle metadata). This smoke is distinct from Playwright WebKit automation.

Observed at the existing native desktop window:

- `http://wordpress.local/gallery/` rendered the Gallery heading, six canonical Projects, equipment and final CTA; local comparison images aligned at the 50% split.
- The native accessibility tree exposed filters as toggle buttons, with All on and the other five off, plus “Showing 6 of 6 Projects”.
- Selecting Ceramic Coating changed selected state and the count to “Showing 3 of 6 Projects”; Porsche, Mercedes and BMW were removed from the accessibility tree, leaving Ferrari, DBS and Lamborghini.
- All restored the six Project containers and count.
- Direct navigation to the actual Porsche section anchor showed its comparison, canonical facts and native slider with “50% after image revealed”.

A subsequent attempt to operate the range through native Computer Use hit a ScreenCaptureKit invalid-parameter error. No successful actual-Safari keyboard/pointer test is claimed from that attempt. The complete four-width Safari/no-JavaScript matrix and manual screen-reader/zoom acceptance remain consolidated acceptance work; automated Chrome/Firefox/WebKit reports cover their documented subset.

Installed Safari version: **26.1** (CFBundleShortVersionString).
