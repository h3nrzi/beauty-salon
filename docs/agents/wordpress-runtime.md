# WordPress runtime and source boundary

WordPress Core and installed third-party packages are upstream runtime, not project
source. Core remains immutable: implement through supported extension points.
Read the installed platform when useful, but never patch Core to satisfy a ticket.

## Source location

Track project-owned code under `wordpress/src/`. Once architecture is agreed,
create only the required directories, for example `themes/<slug>/`,
`plugins/<slug>/` or `mu-plugins/`. No theme or plugin model is preselected.
Keep source authoritative here; do not develop a second copy in the runtime.

The whole `wordpress/app/` tree is ignored, including Core, `wp-config.php`,
installed themes/plugins, uploads and generated content. Other local configuration,
databases, logs and dependency output are ignored by the root `.gitignore`.
Do not force-add runtime code. Track reproducible project-owned fixtures separately
only when required, with appropriate rights and no secrets or live personal data.

## Attach or create a local installation

Use an existing suitable WordPress installation or create one with the local method
your project chooses. The starter requires no Docker, Bedrock, Composer or provisioning
framework. A local installation may live at `wordpress/app/public/` or entirely
outside the checkout. For another in-repository location, add an ignore rule before
installing and verify that runtime files cannot enter Git.

Before implementation, record in `docs/project/runtime.md`:

- The runtime root, site URL, WordPress/PHP/database versions and required extensions.
- How to start/stop/access the environment and where local secrets are configured
  (locations and variable names only).
- How each owned source directory maps into the runtime's `wp-content/`, using the
  chosen environment's supported linking or copy/deployment method. Never overwrite
  an existing installation's source or data without checking ownership and backups.
- How to install required third-party dependencies, activate owned extensions,
  reproduce content/configuration, run checks and recover/reset the agreed scope.
- Available tools, production differences and acceptance capability gaps.

Validate attachment with a minimal owned change and fresh setup in a disposable
runtime during the first slice. If the environment needs copies, deployment flows
from `wordpress/src/` into runtime and edits stay in source. Extend this same setup
path as later slices need content/assets; preserve editor changes by default and
make reset scope explicit. Keep generated runtime data out of commits.
