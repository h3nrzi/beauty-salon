# Stitch → Engineering Workflow — Pilot 01

Evidence-backed as of 2026-10-08; the filename is retained for existing links. This replaces the hypothesis with the successful Pilot 01 sequence and approved process corrections. Observations and exceptions are in the [retrospective](retrospective.md). Proposed guardrails are not installed tooling.

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

## NOIR choices, not universal defaults

WordPress, classic PHP themes, exactly two private CPTs, fixed metadata collections, email-only requests, the single-option ledger, NOIR quotas/retention, exact viewport widths, fixtures, media mappings and design tokens are project choices. Reconsider them for Pilot 02; use [NOIR decisions](decision-log.md) as examples rather than architecture prescriptions.

## Automation / guardrail backlog

Wire existing checks before adding duplicates. Candidates: project-source syntax/whitespace gates; translatable literals; manifest schema/checksums; prototype dependencies; image-loading assertions; precise negative paths; snapshot/cleanup protection; evidence capacity/run manifests; current navigation links; repeatable export audits. Use deterministic checks for mechanical rules and reviewers for cross-module judgement. Hooks, CI, tests and harness changes require a separate task.

## Production prerequisites and measurement limits

NOIR local completion intentionally excluded cleared photography, actual legal destinations, production HTTPS/runtime/cache/storage verification, real inbox receipt, deployed scheduling and production-like performance certification. Preserve those [release gates](pilot-acceptance.md).

Actual Safari/stable Firefox, screen-reader and browser zoom measurements remain separately disclosed local evidence limits. They are not automatically production-only; owner acceptance does not claim they occurred. Agree this distinction before specification.

## Changes for Pilot 02

Front-load capabilities/acceptance, ownership maps and mutation-based seams. Begin reproduction in slice one. Stabilize browser/evidence procedures before broad matrices. Automate repeated mechanical checks through separately scoped work. Keep internal review inside implementation and independent review read-only. Extract evidence-supported conditional defaults while leaving project architecture and release prerequisites explicit.
