# Appointment Request — Tickets 05–06

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

## Reliability and retained operational state

A 256-bit random token binds an ordinary form to a signed HttpOnly SameSite=Lax visitor cookie and the current WordPress user. The cookie lasts two hours. Forms expire after **20 minutes**; this is sufficient for the pilot's seven fields while limiting exposed form lifetime. A consumed token never becomes issued again. Native logged-in nonce protection and the narrowly scoped logged-out nonce remain in place. Salt rotation invalidates outstanding tokens and receipts.

The pilot uses **one non-autoloaded WordPress option**, `noir_request_ledger`, on the site's primary MySQL/MariaDB connection. Its bounded JSON contains only token/visitor/user HMAC digests, status, expiry/retention timestamps, and scoped HMAC throttle keys with counts/window ends. It contains no customer fields, raw IPs, cookies, nonces, request bodies, mail payloads or transport exceptions. Reads bypass object caches, so a persistent cache cannot provide stale authorization. Outstanding Ticket 05 transient tokens become invalid at upgrade; their previously scheduled cleanup events still remove their old transient/claim records.

Each read/prune/admission/claim/acceptance write holds a database- and site-scoped `GET_LOCK` for at most a one-second acquisition wait. The handler pins the existing `mysqli` connection and executes prepared SQL directly because `wpdb::query()` can reconnect and thereby lose a session lock. The write checks `IS_USED_LOCK() = CONNECTION_ID()` and the value is read back before authorizing transport. Missing/unsupported locking, corrupt state, failed reads/writes or a dead connection fail closed. This requires an ordinary **single primary database** with session advisory locks and no connection multiplexing, split routing or multi-primary writes. Unsupported database adapters are refused. The supported Local instance uses MySQL 8.4.0. See [WordPress connection behavior](https://developer.wordpress.org/reference/classes/wpdb/check_connection/) and [MySQL locking functions](https://dev.mysql.com/doc/refman/8.4/en/locking-functions.html).

The exclusive transition is `issued → processing`. The lock is released **before** `wp_mail()`, so a slow transport cannot monopolize admission. Only the worker that successfully recorded that transition may call transport. A second worker must re-read state under the mutex immediately before claiming, even if its earlier validation saw `issued`. Cleanup never reissues or recreates a token. If the original worker is still sending after removal, duplicates find no issuance; the original cannot recreate acceptance either. No timeout permits another attempt. There is no pending timeout or recovery retry: all processing states are pending/uncertain until recorded acceptance or removal.

A generic false result or exception is uncertain. A crashed worker leaves processing state; a later replay offers direct contact without a form. Positive `wp_mail()` acceptance becomes success only after acceptance is recorded and read back. Post-send storage failure remains uncertain, never success or an automatic retry. Definite pre-send configuration/route failures preserve the existing form for a later explicit retry, because no transport permission was consumed. A recorded accepted replay issues the authenticated receipt/303 without another send. Receipts last 15 minutes and can display success only while the bound acceptance record still exists. Email delivery itself is not exactly-once and inbox delivery is not promised.

## Abuse limits, bounds and cleanup

Admission counts all POSTs, including invalid/expired/missing tokens, before validation; POST never creates issuance state. Form issuance and POST have independent ten-minute fixed windows starting at the first admitted operation. These small pilot limits intentionally trade availability on shared networks for simple bounded protection:

| Boundary | Visitor | Network | Entire site |
| --- | ---: | ---: | ---: |
| Form issuance | 20 | 40 | 120 |
| POST attempts, including replay | 30 | 80 | 240 |

Clearing a cookie cannot remove network/global protection. Missing visitor cookies share a conservative submission bucket. IP addresses are normalized in memory and immediately HMACed. Ignore all forwarding headers by default. An operator may define `NOIR_TRUSTED_PROXIES` as an array of **exact immediate proxy IPs** in untracked environment configuration. Only a trusted immediate peer enables bounded, validated `X-Forwarded-For` parsing; walk right to left through explicitly trusted proxies to the first untrusted address. Malformed trusted chains refuse work. Deployments must ensure those proxies append/overwrite client headers correctly. Other forwarding headers are ignored. Limits include authenticated users; a login is not an exemption. Responses use 429, positive `Retry-After`, no form and direct-contact guidance.

Every token record, including processing/uncertain/accepted, has a **one-hour absolute retention deadline from issuance**. Admission never extends it. Counter entries expire at the end of their ten-minute window. The entire ledger holds at most **768 tokens and 1,024 counters** (one option row, O(1) cron events); capacity exhaustion refuses new work rather than evicting protective records. Six ten-minute global windows admit at most 720 tokens; window boundary bursts are independently bounded by the hard capacity. Denied operations create no identities. No customer data is kept for recovery.

All ledger operations prune expired entries and verify persistence, including reads and capacity refusals. One recurring WordPress cleanup event also invokes the same pruner hourly; it has no per-token arguments or growth. A running external scheduler must invoke `wp cron event run --due-now` at least every five minutes for an idle site's physical deletion to occur within **two hours and five minutes** of issuance (counter deletion within one hour and fifteen minutes). Traffic-driven WP-Cron alone cannot promise idle physical deletion: scheduler setup is an explicit deployment prerequisite, and must be verified in Ticket 07. On the Local pilot, the automated checks invoke the registered cleanup hook and prove the actual stored entries disappear. Without a working scheduler/traffic, the single bounded row cannot grow, expired records cannot authorize work, and the next ledger operation removes them. Storage outages can delay deletion and refuse work; restoration resumes cleanup. No application can guarantee deletion while its database is unavailable.

Contact, form, status, redirects and submission errors use `Cache-Control: no-store, private, max-age=0`. Only Contact sets the page cache bypass flag; unrelated pages remain cacheable. A proxy/page cache must honor these headers and bypass Contact and the existing admin-post endpoint; pre-existing edge caching that ignores origin headers is outside WordPress's ability to repair. There is no token refresh or caching subsystem.

## Repeatable checks

Run in a local/disposable WordPress database using Local's PHP/MySQL socket environment:

```sh
wp --path=wordpress/app/public eval-file tests/appointment-wordpress.php
wp --path=wordpress/app/public eval-file tests/appointment-delivery-wordpress.php
wp --path=wordpress/app/public eval-file tests/appointment-reliability-wordpress.php
npm run check
```

The first suite expects no configured mail readiness. The delivery suite installs `tests/fixtures/appointment-mail-environment.php` temporarily under `wp-content/mu-plugins/noir-appointment-test.php`, with its mode file at `/tmp/noir-ticket05/mail-mode`; it restores the previous files in `finally`. It only runs under `wp_get_environment_type() === 'local'`. The fixture uses this Local instance's Mailpit SMTP port 10006. For a different Local instance, adjust only the test fixture port and browser API URL. The capture contains synthetic test data and is not a shipped submission store.

For browser success/capture checks, temporarily copy the same fixture to that mu-plugin location, create the mode file containing `accepted`, then run:

```sh
NOIR_MAILPIT_URL=http://127.0.0.1:10005 NOIR_BROWSER=chrome,firefox,webkit npm run test:appointment
```

Remove the temporary mu-plugin and mode file afterwards. Without `NOIR_MAILPIT_URL`, the browser suite covers validation only. `NOIR_CONTACT_URL` and `NOIR_EVIDENCE_DIR` override the default site/evidence directory. Checks use reduced motion to avoid Playwright's no-JavaScript smooth-scroll stability problem. Axe runs in JavaScript-enabled contexts; no-JavaScript paths are independently exercised for actual POST, correction, accepted redirect, refresh, semantics and overflow. WebKit is not actual Safari; manual screen-reader, zoom and human visual parity acceptance remain pending. Syntax checks substitute for typechecking in this PHP/vanilla JavaScript project. Full regression still includes all previous WordPress and four-page browser suites.

The reliability suite uses `curl_multi` for independent concurrent HTTP requests and records worker PIDs to prove distinct FPM processes. Its temporary Local-only fixture counts transport invocations without storing mail or customer input. It tests accepted replay and receipt isolation; network/global/visitor admission, cleared cookies and forged/trusted proxy headers; invalid and expired tokens; held-lock and dead-connection failure; database triggers refusing writes before and after transport; timed-out, slow/interrupted workers; cleanup while a worker remains active; hard token/counter capacities and physical removal. It finally runs `tests/appointment-reliability-browser.cjs` in Chrome with JavaScript on/off and axe for enhanced uncertainty feedback. All temporary fixture files, triggers and the prior ledger are restored in `finally`. Tests change only synthetic operational deadlines to exercise expiry without sleeping an hour. Run all suites in a disposable Local database; reset the operational ledger **between suites** to avoid intentional real network limits affecting unrelated test runs. Never reset production operational state as a recovery action.

For the complete regression, use the Local WP-CLI shell and `npm run test:pilot`. `NOIR_WP_BIN` may identify an alternative WP-CLI executable; `NOIR_EVIDENCE_DIR` redirects browser artifacts. This Local-only runner resets the ledger between each suite, then restores its previous value on exit. It covers all nine WordPress suites, syntax checks, all four page browser suites, and appointment acceptance in Chrome/Firefox/WebKit with actual Mailpit capture. It refuses to overwrite an existing Ticket 05 mail fixture. Use a disposable database because the other editorial tests also temporarily change content.
