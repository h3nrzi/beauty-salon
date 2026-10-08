# Pilot 01 Retrospective

Completed 2026-10-08. Scope: the full engineering-agent/process experiment, from product definition and Stitch v1/v2/v3 through Tickets 01–07 and local acceptance. Sources are repository artifacts and git history through `a7d3382`; this is not another NOIR product or visual review.

All seven local implementations and owner human acceptance are recorded. Approval does not assert unperformed measurements or production readiness. Findings distinguish observed failures from proposed defaults; agent time and token savings were not measured.

## What worked

- Product definition froze four pages and lead generation without booking/payment/account features. Stitch explored presentation; HTML/CSS remained reference material rather than production architecture. See [product definition](02-product-definition.md) and D-001–007 in the [decision log](decision-log.md).
- Targeted v2/v3 prompting improved consistency while retaining visual direction. Actual-export audits caught DESIGN.md claims the HTML did not satisfy. Freezing v3 with explicit deterministic cleanup avoided another generative pass. See [v1 audit](04-stitch-export-audit.md), [v2 review](06-stitch-v2-review.md) and [v3 freeze](08-stitch-v3-final-review.md).
- Matt setup established local tickets and domain-doc locations (`12261a0`). Grilling before specification (`37cded8`, `61edf5f`) settled authority, editing, ownership and request behavior in the glossary, ADRs and decisions. `/to-spec` and `/to-tickets` produced an approved specification and seven verifiable slices.
- Native WordPress editing and public HTTP/browser seams exposed defects syntax checks could not. Repairs retained failing-before/passing-after regressions. Independent-worker tests proved concurrency behavior; mail capture verified notifications independently of API success. See [specification](../.scratch/noir-wordpress-pilot/spec.md) and [Ticket 06 results](evidence/appointment-06/results.md).
- Explicit import preserved edits, reused media, reported drift and supported scoped reset. Final evidence retained interrupted attempts honestly. See [local evidence](evidence/pilot-07/README.md).

## Findings and corrections

| Priority / area | Pilot evidence | Process improvement |
| --- | --- | --- |
| P1: false-positive negative tests | Ticket 07 corrupt-image/duplicate checks failed earlier on a font path, yet counted as passing. `f8fe46d` corrected paths/assertions. [Review](evidence/pilot-07/review.md) | Require the intended diagnostic/status and relevant unchanged-state assertions. An arbitrary error does not prove the target condition. |
| P1: unwired checks | [Package commands](../package.json) exist, but no tracked CI/pre-commit execution exists. PHP/shell syntax and whitespace were verified separately. | Wire existing fast checks automatically; retain disposable-runtime integration verification. Tooling remains proposed. |
| P2: mechanical misses | Tickets 01/05 missed translated labels; Ticket 02 missed loading policy and manifest dimensions/crops/placements. [Contact](evidence/contact-01/review.md), [Services](evidence/services-02/review.md), [Appointment](evidence/appointment-05/review.md) | Convert recurring syntactic/schema requirements into deterministic checks rather than reviewer prose. |
| P2: ownership drift | Ticket 02 put Service-reference editing in the theme; Ticket 05 put styled form presentation in the plugin despite settled boundaries. | Map responsibility, existing interfaces and allowed change locations before each slice. Keep cross-module judgement in internal review. |
| P2: baseline-only coverage | Gallery lost valid zero values and missed equipment bounds; Home lost comparison pairs after reordering. [Gallery](evidence/gallery-03/review.md), [Home](evidence/home-04/review.md) | Agree relevant mutations with TDD seams: reorder, rename, unpublish, optional-content/media removal, valid zero, bounds and restoration. |
| P2: late reproduction | Slice preparation preceded complete bootstrap. Ticket 07 exposed hours drift; preflight blocked deleted-page recreation/reset. [Review](evidence/pilot-07/review.md) | Establish minimal reproduction in slice one; extend one authoritative importer. Keep final certification at the end. |
| P2: acceptance ambiguity | Legal destinations affected Ticket 01 completion interpretation; combined Ticket 07 checkboxes obscured local completion. `37ee707` split gates; `a7d3382` recorded approval. | Before `/to-spec`, assign separate local, human and production scopes, owners and evidence. |
| P2: infrastructure prescription | `f481fcd` replaced mandated storage mechanics/capacities/lifetimes with behavioral reliability guarantees. | Set outcomes/deployment constraints first; justify the smallest mechanism without weakening concurrency/privacy guarantees. |
| P2: harness instability | Contact/Gallery hit WebKit navigation races and lazy-image readiness failures; combined engines exhausted issuance limits. [Gallery](evidence/gallery-03/review.md), [final evidence](evidence/pilot-07/README.md) | Standardize bounded readiness, capture/navigation ordering and synthetic-state isolation before expanding matrices. Preserve assertions and cleanup. |
| P2: evidence cost | Ticket 07 exhausted disk space and finished in retained segments; repeated captures accumulated substantial artifacts. | Budget disk/artifact size, separate execution from retained captures, and identify commit/runtime/coverage for resumable runs. Reuse still-valid focused evidence. |
| P2: context discovery | Handoff/decision-log closing text still describes pre-spec status; slice guides mix historical and current setup. | Provide one current entry point and disclose history on demand. Rediscovery cost is inferred from scattered/stale sources, not measured session timing. |
| P2: capability planning | Automation used installed Chrome, Firefox Nightly and Playwright WebKit; native Safari work hit capture/developer-control limits. [Evidence](evidence/pilot-07/README.md) | Inventory runtime, browser versions, manual tools and mail capture before promising coverage. |
| P3: review proportionality | Home duplication remained nonblocking; reordered comparisons were a defect. Services footer/comparison fixes (`cf741af`) added demonstrated regressions. | Block on documented breaches and demonstrated defects; keep heuristic refactors optional. Review does not replace interaction/visual inspection. |
| P3: audit reproducibility | The v2 term count is 66 in its review and 56 in the v3 comparison without an explained counting change. | Retain audit definitions/scripts and artifact identity; preserve the stopping rule for deterministic cleanup. |

## Reusable defaults

Operational steps live in the [evidence-backed workflow](workflow-draft.md). Reuse frozen-artifact authority, grilling before synthesis, compact ownership maps, behavioral seams plus mutations, early reproduction, explicit acceptance scopes, proportional review and traceable evidence. Keep vocabulary and architecture rationale authoritative in the glossary/ADRs.

**Review ownership adopted from this retrospective:** `/implement` owns TDD → implementation → internal code-review → fixes/tests → commit. The post-commit independent review is a read-only gate for spec compliance, scope creep and demonstrated regressions. It reports blockers back to implementation; it must not become a second implementation/refactoring loop. This clarifies the next workflow rather than claiming every Pilot 01 review already followed that separation.

## Conditional patterns and project-specific decisions

| Classification | Keep when justified |
| --- | --- |
| Conditional patterns | Theme/plugin separation for portable behavior; stable identities/canonical facts for reused content; bounded collections for controlled layouts; replay/uncertainty handling where duplicate side effects matter; native integration and worker fault tests for relevant risks. |
| NOIR-specific choices | Classic PHP theme; exactly Service/Project private CPTs; fixed metadata schemas; email-only requests; one-option ledger/database-session mutex; NOIR quotas/retention values; exact viewport widths; fixture content, typography, media roles and placements. These are not universal defaults. |

Supported WordPress extension points, native editing/revisions and immutable Core were successful platform choices. Pilot 01 does not establish a universally best theme/content model, shared abstraction or percentage of generated HTML worth retaining.

### Candidates not promoted as universal rules

- A specific pre-commit/CI mechanism is deferred: automatic enforcement is reusable, but the cheapest wiring depends on the next project's language/runtime.
- Removing Wayfinder instructions or installed Matt skills is not a blanket default. Progressive disclosure is supported; this history does not prove those capabilities are useless elsewhere.
- Extracting Home/Gallery's shared metadata lifecycle is not required workflow work. Review identified a nonblocking smell, not a defect justifying a cross-slice refactor.
- Mandatory exhaustive worker/browser matrices are conditional on risk and capability. Pilot 01 does not justify imposing NOIR's evidence volume on every product.

## Automation / guardrail opportunities

Not implemented by this documentation update:

- Automatically run existing project-source syntax/whitespace checks; choose hook/CI placement for the next runtime.
- Check translatable literals, manifest fields/checksums, prototype dependencies and image-loading policy deterministically.
- Validate intended negative paths and cleanup/restoration; failed snapshots must abort before mutation.
- Add harness readiness/isolation procedures, evidence-capacity preflight and resumed-run manifests.
- Validate current navigation links and use repeatable export audits. Ownership and code smells still require judgement.

## Production-only prerequisites

Intentionally outside accepted local completion: cleared photographic rights, actual legal destinations, production HTTPS/runtime/storage/cache configuration, real inbox receipt, deployed external scheduler verification and the production-like performance profile. These remain [release gates](pilot-acceptance.md), not retrospective failures.

Unperformed actual Safari/stable Firefox, screen-reader and browser zoom measurements are separate evidence limitations; they are not all production-only. Owner approval accepted local work and disclosed limits without creating those measurements.

## Changes for Pilot 02

1. Before `/to-spec`, inventory capabilities and agree local/human/production gates, owners and reliability outcomes.
2. Start from one current entry point; disclose relevant ADRs, tickets and historical exports on demand.
3. Start each slice with ownership/interfaces and agreed TDD seams plus supported mutations.
4. Establish minimal reproduction in slice one; grow one importer through later slices.
5. Prove intended negative paths; automate mechanical requirements after separately authorizing tooling work.
6. Stabilize a browser tracer before broad coverage; budget evidence and retain resumable, attributable results.
7. Finish internal review/fixes before commit; keep independent post-commit review read-only.
8. Extract evidence-supported defaults/conditional patterns. Move generalizable findings to the playbook separately.
