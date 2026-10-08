# Stitch → WordPress Workflow Starter

Clone this repository to define a new product, explore its visual design in
Stitch, and engineer and accept a maintainable WordPress implementation using
MATT. It contains workflow instructions and reusable agent skills. It starts
without a product, selected architecture or runnable website.

## Start a new project

1. Read [WORKFLOW.md](WORKFLOW.md) and the [workspace map](docs/project/README.md).
2. Copy [templates/project-state.md](templates/project-state.md) to
   `docs/project/current.md` and [templates/product-definition.md](templates/product-definition.md)
   to `docs/project/product-definition.md`. Fill in the product definition with
   your owner: audience, outcomes, scope, editable content, constraints and exclusions.
3. Agree scope before generating visuals. Follow the workflow through Stitch brief,
   exploration, approved baseline freeze, actual-export audit and engineering handoff.
4. Confirm the supplied MATT configuration once, grill unresolved decisions, then
   approve a specification and tickets. Implement, review, reproduce, accept and
   write a retrospective using the workflow's separate gates.

MATT supplies the engineering skills in [.agents/skills/](.agents/skills/).
The tracker and domain conventions are already configured in [docs/agents/](docs/agents/issue-tracker.md).
Project-specific architecture is decided during grilling/specification: theme model,
content types, forms, storage, testing and deployment are not inherited defaults.
There is no package installation or runtime provisioning step needed to begin
product definition. Configure WordPress when engineering needs it, following the
[runtime boundary](docs/agents/wordpress-runtime.md).

## Repository map

| Workflow core — retain across projects | Purpose |
| --- | --- |
| `README.md`, `WORKFLOW.md`, `AGENTS.md` | Entry point, canonical process and agent navigation |
| `.agents/skills/`, `skills-lock.json` | Reusable MATT skills and recorded provenance |
| `docs/agents/` | Tracker, triage, domain and runtime conventions |
| `templates/` | Small starting templates without product assumptions |
| `.gitignore` | Runtime, secrets and generated-output boundary |

| Project workspace — populate as work progresses | Purpose |
| --- | --- |
| `docs/project/` | Current state, product, brief, audit, handoff, runtime, acceptance and retrospective |
| `references/<baseline-id>/` | Frozen approved Stitch exports and assets |
| `docs/decision-log.md`, `GLOSSARY.md`, `docs/adr/` | Project decisions and vocabulary, created lazily |
| `.scratch/<feature>/` | MATT specification and tickets |
| `docs/evidence/<run-id>/` | Attributable, bounded verification evidence |
| `wordpress/src/` | Project-owned source, populated after architecture decisions |
| `tests/`, `fixtures/` | Project-specific checks and reproducible inputs when needed |
| `wordpress/app/`, other local runtime paths | Ignored installation and local data; see runtime instructions |

Only workspace navigation/placeholders are supplied. The [workspace map](docs/project/README.md)
explains when to create each artifact. For the origin of the workflow, consult the
optional [history note](docs/history.md).
