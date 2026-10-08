# Appointment Request — Ticket 05

The Contact form uses ordinary `admin-post.php` POST for anonymous and authenticated visitors. The NOIR Studio plugin owns validation, cookie/token/nonce binding, mail and operational acceptance state. The theme renders the Contact response using the supplied view model; another theme receives the plugin's minimal accessible form/error fallback. No customer field is stored in WordPress or placed in a redirect URL.

Input follows the seven-field contract in the approved spec. WordPress slashes are removed once. UTF-8 and scalar shape, normalized Unicode character bounds, prohibited controls, phone syntax/digit bounds, exact eligible Service, native email validation and strict calendar/date boundaries are checked on the server. HTML is sanitized as plain text after checking lengths, and every output is escaped for its context. Unsafe/oversize values are omitted; other bounded values are returned in the current response. CRLF notes normalize to LF; email line breaks are rejected before trimming. The browser supplies guidance but the server decides. Enhanced errors focus the linked summary; scripting is not needed to submit or correct the form.

## Operational mail configuration

Configure only in untracked environment configuration, such as `wp-config.php`:

```php
define('NOIR_MAIL_RECIPIENT', 'studio@example.com'); // One explicit address.
define('NOIR_MAIL_FROM', 'requests@example.com');   // Operator-controlled sending identity.
define('NOIR_MAIL_READY', true);                   // Only after configuring/verifying transport.
```

Use the deployment's `wp_mail()` transport, verified sender domain and credentials. Transport credentials/timeouts are environment configuration, never repository source or public Studio settings. There is no fallback to `admin_email` or the public inquiry address and no customer confirmation email. These values have no WordPress editing endpoint: an Editor cannot change them; the missing-configuration diagnostic is restricted to `manage_options`. Verify the configured transport does not append recipients, change the sender or turn the plain-text message into HTML. In particular, Local's default sendmail wrapper adds a `mailhog@flywheel.local` recovery recipient. The evidence fixture uses direct Mailpit SMTP to avoid that wrapper.

Missing configuration fails before attempting transport and returns 503 with safe values and explicit retry guidance. A generic `wp_mail()` false result or exception does not prove non-acceptance and returns uncertain 503 with direct-contact guidance and no resubmission form. Positive `wp_mail()` acceptance must be recorded before a signed/bound receipt and 303 Contact redirect are issued. The exact public wording says accepted for sending, response within 1 business day, and appointment not confirmed. A guessed status URL, altered receipt or receipt borrowed by another visitor cannot display success.

## Normal-path state and Ticket 06 boundary

A 256-bit token is issued on Contact, with a signed HttpOnly SameSite=Lax visitor cookie (128 random bits, two-hour life, Secure on HTTPS). A form is usable for one hour, long enough to describe a vehicle without extending exposure to WordPress nonce lifetime. Logged-in forms additionally retain native user/session nonce protection. The logged-out nonce filter applies only to the project's token-specific action. Only HMAC token/visitor digests, existing WordPress user identity, state and operational timestamps are stored, using a key derived from WordPress auth salts and separate HMAC domains. Rotating salts invalidates outstanding forms.

The normal path uses a unique non-autoloaded WordPress option insertion to claim one attempt, plus temporary issued/processing/accepted state in a transient. Recorded accepted replay returns PRG without mail; a processing/uncertain replay offers direct contact. Receipt life is 15 minutes and state/claim retention is two hours; these keep a short usable status window and a finite intended cleanup period. A single WP-Cron cleanup event per issued token removes state first and then the claim. Issued tokens remain unusable after their one-hour expiry; removal never issues them again. WP-Cron needs traffic or an external scheduler; this slice does not certify cleanup under storage failure or abuse.

Ticket 06 owns capacity and effective bounded cleanup, visitor/network/global throttling and trusted proxies, independent-worker concurrency certification, storage failure injection, slow/crashed worker handling, late acceptance authority and complete uncertainty/retry handling. The option claim is a normal-path safeguard, not evidence that all those boundaries have been certified. No queue, new CPT, request archive or generalized reliability framework is introduced. Final reliability acceptance remains blocked on Ticket 06.

## Repeatable checks

Run in a local/disposable WordPress database using Local's PHP/MySQL socket environment:

```sh
wp --path=wordpress/app/public eval-file tests/appointment-wordpress.php
wp --path=wordpress/app/public eval-file tests/appointment-delivery-wordpress.php
npm run check
```

The first suite expects no configured mail readiness. The delivery suite installs `tests/fixtures/appointment-mail-environment.php` temporarily under `wp-content/mu-plugins/noir-appointment-test.php`, with its mode file at `/tmp/noir-ticket05/mail-mode`; it restores the previous files in `finally`. It only runs under `wp_get_environment_type() === 'local'`. The fixture uses this Local instance's Mailpit SMTP port 10006. For a different Local instance, adjust only the test fixture port and browser API URL. The capture contains synthetic test data and is not a shipped submission store.

For browser success/capture checks, temporarily copy the same fixture to that mu-plugin location, create the mode file containing `accepted`, then run:

```sh
NOIR_MAILPIT_URL=http://127.0.0.1:10005 NOIR_BROWSER=chrome,firefox,webkit npm run test:appointment
```

Remove the temporary mu-plugin and mode file afterwards. Without `NOIR_MAILPIT_URL`, the browser suite covers validation only. `NOIR_CONTACT_URL` and `NOIR_EVIDENCE_DIR` override the default site/evidence directory. Checks use reduced motion to avoid Playwright's no-JavaScript smooth-scroll stability problem. Axe runs in JavaScript-enabled contexts; no-JavaScript paths are independently exercised for actual POST, correction, accepted redirect, refresh, semantics and overflow. WebKit is not actual Safari; manual screen-reader, zoom and human visual parity acceptance remain pending. Syntax checks substitute for typechecking in this PHP/vanilla JavaScript project. Full regression still includes all previous WordPress and four-page browser suites.
