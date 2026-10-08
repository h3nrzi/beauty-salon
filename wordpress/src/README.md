# Project-owned WordPress source

Create source here only after ownership and architecture are settled. Possible
paths include `themes/<slug>/`, `plugins/<slug>/` and `mu-plugins/`; none is mandatory.

Follow the [runtime boundary](../../docs/agents/wordpress-runtime.md) to attach source
to a local installation. Core, third-party packages and runtime data stay outside
this directory. Record the chosen mapping in `docs/project/runtime.md`.
