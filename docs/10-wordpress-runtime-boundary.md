# WordPress Runtime Boundary

## Installed baseline

- **WordPress Core:** 7.1.3
- **Location:** `wordpress/app/public/`
- **Core source:** local installed WordPress distribution
- **Pilot role:** runtime and local source reference for Codex

The repository intentionally contains WordPress Core so Codex can inspect the exact local platform without downloading or guessing a version.

## Core boundary

Treat these as **immutable upstream code**:

- `wordpress/app/public/wp-admin/`
- `wordpress/app/public/wp-includes/`
- WordPress root core PHP files

Do not modify WordPress Core to implement NOIR Auto Detailing.

If a requirement appears to need a Core edit, stop and solve it through normal WordPress extension points instead.

## Project implementation boundary

The expected project-owned implementation lives under:

`wordpress/app/public/wp-content/themes/noir-auto-detailing/`

A project-specific plugin may only be introduced if the MATT specification establishes a clear reason that functionality should not belong to the theme.

## Runtime-only data

Local runtime state is not project source and should remain untracked, including:

- database/runtime folders
- logs
- uploads
- cache
- local configuration
- `wp-config.php`
- Local environment helper files

Secrets and environment-specific configuration must not be committed.

## Bundled plugins and themes

Pilot 01 does not rely on bundled/default themes or installed third-party plugins as source code.

Only project-owned code should be explicitly tracked under `wp-content`.

## Engineering rule

WordPress Core is available to Codex for reading and API/reference lookup, but implementation must use supported WordPress APIs, hooks, template hierarchy, theme APIs, and other extension points.

**Do not patch Core.**

## Current engineering status

WordPress is installed and available locally.

Stitch v3 is frozen.

The repository is ready for the MATT `/to-spec` phase.
