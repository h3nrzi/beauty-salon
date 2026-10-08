# Project workspace

This starter has no active project. Begin by copying the
[state template](../../templates/project-state.md) to `current.md` and the
[product definition](../../templates/product-definition.md) to `product-definition.md`
in this directory. These files are created by the new project's owner and agent.

`current.md` is the authoritative navigation/status record. Keep it short: current
phase, scope approval, baseline, active spec/ticket, relevant decisions, runtime
procedure, evidence, outstanding gates and next action. Link only existing artifacts;
mark future ones as pending. Historical handoffs are not current status.

Create these paths as [WORKFLOW.md](../../WORKFLOW.md) reaches their stages:

| Path relative to repository root | Contents |
| --- | --- |
| `docs/project/product-definition.md` | Agreed product scope and exclusions |
| `docs/project/stitch-brief.md` | Visual requirements derived from product scope |
| `references/<baseline-id>/` | Unchanged approved export, screenshots, HTML/CSS/assets and guidance |
| `docs/project/export-audit.md` | Artifact identity, observed gaps, dependency/asset audit and freeze approval |
| `docs/project/engineering-handoff.md` | Baseline authority, deterministic corrections and unresolved choices |
| `docs/decision-log.md` | Settled choices, rationale and links to superseding decisions |
| `GLOSSARY.md`, `docs/adr/` | Domain vocabulary and architecture decisions |
| `docs/project/runtime.md` | Local install attachment, versions, capabilities, setup and recovery |
| `docs/project/acceptance.md` | Separate local, human and release gates with owners and evidence |
| `.scratch/<feature>/spec.md`, `.scratch/<feature>/issues/` | Approved MATT contracts, slices and dependencies |
| `wordpress/src/` | Project-owned implementation after ownership is agreed |
| `tests/`, `fixtures/` | Checks and reproducible inputs justified by the project |
| `docs/evidence/<run-id>/` | Run manifest/results, selected captures, limitations and resume pointers |
| `docs/project/retrospective.md` | Evidence-backed findings classified by reusability |

These are documented destinations, not missing starter files. Use one authoritative
setup/import procedure when needed. Keep secrets and live personal data out of
fixtures, references and evidence. No sample project is needed to initialize this workspace.
