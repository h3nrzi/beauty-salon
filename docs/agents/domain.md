# Domain Docs

This repo uses a single-context domain documentation layout.

## Before exploring, read these

- `GLOSSARY.md` at the repo root.
- ADRs in `docs/adr/` relevant to the area being explored.
- Existing decisions in `docs/decision-log.md` relevant to that area.

If the glossary or ADRs do not exist, proceed silently.
The `/domain-modeling` skill creates them lazily when terms or
decisions are resolved.

## File structure

- `GLOSSARY.md`: shared domain vocabulary.
- `docs/adr/NNNN-<decision-slug>.md`: architecture decisions.

## Use the glossary's vocabulary

Use glossary terms when naming domain concepts in issues, proposals,
hypotheses, and tests. If a needed concept is missing, reconsider
the wording or note the gap for `/domain-modeling`.

## Flag ADR conflicts

Explicitly identify any proposal that contradicts an existing ADR,
and explain why the decision merits reopening.
