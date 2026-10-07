# Actual Safari smoke — 2026-10-07

Safari **26.1** on macOS **26.1**, native app controlled through accessibility UI (not Playwright WebKit). Opened `http://wordpress.local/services/` in a new tab. Observed all five canonical headings, the stable five section links and five Service-specific Contact links, four metric entries, four process stages, local comparison images and their labels, and the accessible range named “Before and after comparison — reveal after image” with value 50 and description “50% after image revealed”.

Clicked the second FAQ disclosure; its answer appeared while the first answer remained expanded. Clicked it again and observed its collapsed state. Screenshot inspection showed the styled page header and the comparison/FAQ region in the actual Safari window.

Native accessibility targeting of the range did not establish keyboard/pointer updates: the target failed to receive focus through this automation path. No pass is claimed for that action. The full keyboard/pointer/touch range suite passed in Chrome, Firefox and Playwright WebKit separately. This is an actual Safari rendering/disclosure smoke check, not the complete Safari viewport/no-JavaScript/manual screen-reader acceptance matrix; consolidated acceptance remains Ticket 07.
