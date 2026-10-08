# Stitch → WordPress Workflow

Use this workflow after reading [README.md](README.md). Project state lives in
[docs/project/README.md](docs/project/README.md); create the documented artifacts
as their stages begin. No product or architecture is selected in this starter.

## Sequence

```text
Product definition
→ scope freeze
→ Stitch brief
→ Stitch iteration
→ frozen visual baseline
→ export audit
→ engineering handoff
→ MATT setup
→ grilling
→ glossary/ADRs/decisions
→ /to-spec
→ /to-tickets
→ ticket implementation
→ internal code-review
→ independent gate review
→ final reproducibility/acceptance
→ retrospective
→ reusable-rule extraction
```

## Completion criteria

| Stage | Done when |
| --- | --- |
| Product definition / scope freeze | Actors, outcome, pages, editable needs and exclusions are agreed. Design output cannot silently expand them. |
| Stitch brief / iteration | One visual system and responsive intent cover the scope. Prompts target observed discrepancies across shared/secondary content too. |
| Frozen baseline / export audit | Retain unchanged versioned screenshots, HTML/CSS/assets and guidance. Audit actual exports against scope, claims, interactions and dependencies. Record residual cleanup and authority. Interim audits may guide iteration; the final audit accompanies the freeze. |
| Engineering handoff | Separate frozen intent from generated implementation. List deterministic corrections and unresolved choices. Stop generative iteration when remaining differences are content/implementation cleanup. |
| MATT setup | Configure tracker, vocabulary and domain-doc locations once; confirm navigation/publication. Load relevant skill branches. |
| Grilling / domain decisions | Settle ownership, editing/reuse, runtime constraints, reliability behavior and acceptance scopes. Inventory capabilities; record glossary/ADRs/decisions as they settle. |
| `/to-spec` | Synthesize observable contracts, testing seams and acceptance evidence from settled decisions. Obtain approval before tickets. |
| `/to-tickets` | Approve verifiable vertical slices and genuine dependencies. Include minimal reproduction early and consolidated acceptance last. |
| Implementation / internal review | Follow the slice procedure; repair and verify blocking findings before commit. |
| Independent gate | Inspect committed results read-only against pinned baseline/spec/evidence; report compliance, scope creep and regressions. |
| Final reproduction / acceptance | Prove fresh setup, safe repeat setup and agreed recovery; consolidate evidence and separate local completion, human approval and release prerequisites. |
| Retrospective / extraction | Use repository/history evidence; classify defaults, conditional patterns and project choices before generalizing. |

## Reusable defaults

### Authority and navigation

Use product scope/decisions for scope; frozen screenshots for composition; HTML for content/interactions absent from screenshots; DESIGN.md for supporting guidance. Rendering defects are not implementation requirements. Record justified deviations.

Provide one current agent entry point naming the active spec/ticket, runtime procedure and relevant decisions. Keep always-loaded instructions short with task-triggered pointers. Label historical status/handoffs and consult them on demand. Keep current status authoritative in one place.

### Before specification

Separate **local implementation**, **human acceptance** and **production release** requirements, each with an owner, evidence and capability gaps. Approval accepts the stated result/limits; it does not substitute for unperformed measurements.

Inventory runtime access/configuration, browser versions, manual accessibility tools, mail capture and production access before promising coverage. Record environment reproduction once. Specify reliability outcomes/deployment constraints before infrastructure; implementation justifies the smallest sufficient mechanism and limits with focused evidence.

### Per-slice implementation and review

1. Read the active ticket/spec and applicable decisions. Map responsibility: owner, interface, consumer and allowed change locations.
2. Agree behavioral TDD seams and relevant mutations: reorder, rename, unpublish, optional-content/media removal, valid zero, bounds and restoration. Test supported edits, not only fixtures.
3. Use TDD at those seams. Negative tests require the intended diagnostic/status and relevant unchanged state. Lower-level controls are conditional on proving a risk, not an excuse to couple tests to implementation.
4. Establish minimal reproduction in slice one; extend one authoritative importer/setup path. Preserve edits by default and make reset scope explicit where imports exist.
5. Run focused checks, internal code-review, fixes and affected regressions; complete required broader verification before commit. Convert recurring mechanical requirements into deterministic checks.
6. Commit the verified slice and submit it to the independent gate.

**Ownership:** `/implement` owns TDD → implementation → internal code-review → fixes/tests → commit. The post-commit independent review is a read-only gate focused on spec compliance, scope creep and demonstrated regressions. It must not become a second implementation/refactoring loop.

Blockers require a cited contract/scope violation or demonstrated regression. Return them to implementation for repair/tests/new commit; recheck affected evidence. Heuristic refactors are nonblocking unless tied to a concrete contract failure. Keep judgement in review and mechanical enforcement in tooling.

### Browser procedure and evidence

Prove a small tracer before expanding engines, widths and states. Standardize bounded font/image readiness, visible-image loading before decode and capture before document-replacing navigation. Isolate synthetic state between suites/engines, snapshot before mutation and restore on exit; abort on failed snapshots. Parallelize only independent workloads.

Separate behavioral execution from retained captures. Select representative screenshots, retain structured results and preflight disk space. Record commit, runtime/browser versions, configuration, coverage and outcome per segment so interrupted runs resume without erasing failures or misrepresenting combined results. Reuse still-applicable evidence and rerun affected paths after changes. Automation, manual inspection, transport acceptance and inbox receipt are distinct claims.

## Conditional patterns

| Pattern | Trigger |
| --- | --- |
| Business logic outside presentation | Behavior must survive presentation/theme changes. |
| Canonical records and stable references | Editable facts repeat or references must survive renaming. |
| Bounded collections | Editors control content while developers retain composition. |
| Replay/uncertainty state and worker fault tests | Duplicate side effects or ambiguous transport outcomes matter. |
| Native recovery and preservation/reset checks | The platform supports revisions or imported baselines. |
| Multi-engine/manual acceptance | Audience/risk/capabilities justify it; agree coverage explicitly. |

## Project decisions, not universal defaults

Choose the theme model, content types, editing model, forms, persistence,
reliability mechanisms, limits, media, design tokens and test matrix during
grilling/specification. None is supplied by this starter. In particular, a request
ledger, fixed browser/viewport matrix and exhaustive concurrency tests require a
project-specific risk or contract. A CI provider and pre-commit implementation
are also conditional choices.

## Automation / guardrail backlog

Wire existing checks before adding duplicates. Candidates: project-source syntax/whitespace gates; translatable literals; manifest schema/checksums; prototype dependencies; image-loading assertions; precise negative paths; snapshot/cleanup protection; evidence capacity/run manifests; current navigation links; repeatable export audits. Use deterministic checks for mechanical rules and reviewers for cross-module judgement. Hooks, CI, tests and harness changes require a separate task.

## Acceptance scopes

Before specification, record three distinct gates in `docs/project/acceptance.md`:

| Gate | Required record |
| --- | --- |
| Local implementation | Reproduction procedure, observable contracts, automated checks, environment and known limitations. |
| Human acceptance | Named owner, agreed visual/interaction/accessibility inspection, result and explicit approval of disclosed limits. |
| Production release | Applicable legal/media permissions, deployment configuration, delivery verification and production measurements, each with owner and evidence. |

Choose requirements for the product; these examples are not a universal checklist.
A successful transport call is not evidence of inbox receipt. Automated browser
coverage is not evidence of unperformed native-browser or screen-reader inspection.
Missing measurements remain explicit even after owner approval. Local completion
and human approval do not imply production readiness.

## Artifact progression and MATT

1. Copy the [project-state template](templates/project-state.md) to
   `docs/project/current.md` and the [product-definition template](templates/product-definition.md)
   to `docs/project/product-definition.md`. Settle product scope with its owner.
2. Write `docs/project/stitch-brief.md`. Explore in Stitch, then freeze the approved
   export under `references/<baseline-id>/`. Include actual pages, HTML/CSS,
   assets, screenshots and available design guidance. Record baseline identity,
   provenance, approval and any missing assets in the export audit.
3. Write `docs/project/export-audit.md` and `docs/project/engineering-handoff.md`.
   Compare every exported page against scope, content, responsive intent,
   interactions, accessibility, external dependencies and asset rights. Retain
   audit definitions so counts and comparisons can be reproduced. The handoff
   names the baseline, authority, corrections and unresolved engineering choices.
4. Confirm MATT setup once before engineering. This starter already configures
   local Markdown issues, five triage roles and single-context domain docs in
   [docs/agents](docs/agents/issue-tracker.md). Verify the configuration and record
   that in current state; do not repeat setup per ticket. Use the bundled
   `setup-matt-pocock-skills` skill only when configuration needs changing.
5. Use `grilling` to settle the handoff's unresolved engineering decisions. Create
   `docs/decision-log.md`, `GLOSSARY.md` and `docs/adr/` lazily under the
   [domain conventions](docs/agents/domain.md). Record runtime capabilities and
   reproduction in `docs/project/runtime.md`, following the
   [runtime boundary](docs/agents/wordpress-runtime.md). Agree acceptance scopes.
6. Use `to-spec` to synthesize settled decisions into `.scratch/<feature>/spec.md`.
   Obtain approval, then use `to-tickets` for verifiable slices with real dependency
   edges in `.scratch/<feature>/issues/`. Follow the
   [issue conventions](docs/agents/issue-tracker.md). If synthesis reveals an open
   architectural choice, return to grilling rather than silently choosing it.
7. Use `implement` with `tdd` and internal `code-review` for each slice, following
   the ownership and review procedure above. Slash names denote MATT skills;
   where slash invocation is unavailable, load the corresponding bundled
   `.agents/skills/<name>/SKILL.md`. Keep the active spec/ticket and evidence
   pointers in current state. Add project tooling only as the scope requires it.
8. Complete the independent read-only gate and consolidated reproduction/acceptance.
   Record outcomes in `docs/evidence/<run-id>/` and update acceptance/current state.
9. Write `docs/project/retrospective.md` from artifacts and history. Classify each
   finding as a reusable rule, conditional pattern or project decision. Promote
   only evidence-backed process rules to this workflow; retain product architecture
   in project documents. Changes to external repositories require a separate task.
