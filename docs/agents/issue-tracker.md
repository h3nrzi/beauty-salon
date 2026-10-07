# Issue tracker: Local Markdown

Issues and specs for this repo live as Markdown files in `.scratch/`.

## Conventions

- One feature per directory: `.scratch/<feature-slug>/`.
- The spec is `.scratch/<feature-slug>/spec.md`.
- Implementation issues are one file per ticket at
  `.scratch/<feature-slug>/issues/<NN>-<slug>.md`, numbered from `01`.
- Triage state is a `Status:` line near the top of each issue file.
  Use the role strings in `triage-labels.md`.
- Append comments and conversation history under `## Comments`.

## When a skill says "publish to the issue tracker"

Create the spec or individual issue files at the paths above,
creating directories as needed.

## When a skill says "fetch the relevant ticket"

Read the file at the referenced path. Resolve issue numbers within
the relevant feature directory.

## Wayfinding operations

Used by `/wayfinder`. The map is a file with one child file per ticket.

- Map: `.scratch/<effort>/map.md`, containing Notes,
  Decisions-so-far, and Fog.
- Child ticket: `.scratch/<effort>/issues/NN-<slug>.md`, numbered
  from `01`. A `Type:` line records research/prototype/grilling/task.
  Wayfinding lifecycle states use `Status: claimed` or
  `Status: resolved`.
- Blocking: a `Blocked by: NN, NN` line near the top. A ticket is
  unblocked when every listed ticket is resolved.
- Frontier: scan the effort's issues for open, unblocked, unclaimed
  tickets; first by number wins.
- Claim: set `Status: claimed` and save before work.
- Resolve: append the answer under `## Answer`, set
  `Status: resolved`, and append a context pointer (summary and path)
  to the map's Decisions-so-far.
