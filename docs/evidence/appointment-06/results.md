# Appointment Request reliability — Ticket 06

Verified on 2026-10-08 in the disposable Local WordPress instance: WordPress 7.1.3, PHP 8.2.29, MySQL 8.4.0, independent PHP-FPM workers. No production transport or customer records were used.

## Results

| Check | Result |
| --- | --- |
| Nine real WordPress suites: Studio, Contact, Services, Gallery, Home, plugin fallback, appointment policy, appointment delivery, appointment reliability | Passed |
| Duplicate exclusion across eight concurrent valid HTTP POSTs on distinct FPM processes | One transport invocation; one accepted response; seven pending responses |
| Concurrent accepted replay with valid binding | No additional transport; 30 accepted replays and 10 throttled responses |
| Concurrent issuance with cleared cookies and forged forwarded addresses | 40 forms and five 429 responses with Retry-After |
| Explicitly trusted proxy / global admission, concurrent batches | 120 forms and 30 throttled responses |
| Visitor issuance, invalid POST admission, hard token/counter capacities and physical cleanup | Passed |
| Held exclusive lock, killed database connection and real SQL write-refusal triggers | Failed closed before transport |
| Uncertain false return, exception and interrupted worker | Pending/uncertain responses; no retry form; no second transport |
| Client timeout with an original slow worker still active | Pending replay; eventual success only after that worker recorded acceptance; one invocation |
| Post-send acceptance recording failure | Non-success; protective processing state retained; replay never sends |
| Cleanup while the original slow sender is active | Removed token stays invalid; no recreated acceptance or competing attempt |
| Bound receipts, no-store form/status/errors and unrelated-page caching | Passed |
| Privacy inspection of persisted state | Only operational digests, states, counters and timestamps |
| Four page browser suites at 375 / 768 / 1024 / 1440 pixels | Passed |
| Reliability error/throttle browser checks with JavaScript on/off at 375 pixels | Passed; enhanced uncertainty axe audit has zero violations |
| Appointment acceptance with real Mailpit capture, three engines × four widths × JavaScript on/off | 24 passing cases; enhanced axe audits have zero violations |
| Registered recurring cleanup dispatched through actual WP-CLI cron event execution | Passed |
| JavaScript/PHP syntax, shell syntax and whitespace checks | Passed |
| Full runner snapshot failure | Aborts before mutation; prior ledger restored on normal completion |

Browser engines: chrome 155.0.8059.39, firefox 153.0, webkit 26.5. Machine-readable results: `browser-results.json`. WebKit does not certify actual Safari; manual screen-reader/visual acceptance remains in Ticket 07.

## Review

Standards: no remaining actionable violations. The reviewer found one issue in the first regression runner: a failed snapshot could be interpreted as absent state. The runner now explicitly distinguishes authoritative presence/absence, aborts on failed reads, and restores only a valid saved snapshot. Source re-review confirmed the fix. Production authorization/persistence review found no defects under the documented single-primary pinned-connection deployment boundary.

Spec: no actionable implementation findings or scope creep. Exclusive recorded claims, authenticated accepted replay, conservative uncertainty, concurrent throttling, bounded state, actual pruning and accessible no-JavaScript responses implement the ticket. Idle physical retention is conditional on an external scheduler; this deployment prerequisite is documented and remains an explicit Ticket 07 check.

## Reproduction and limits

From the configured Local WP-CLI shell, run `npm run test:pilot`. An alternative WP-CLI executable can be supplied through `NOIR_WP_BIN`. The full runner refuses a preexisting mail fixture, isolates every suite's network/visitor state, and restores the original operational ledger on exit. `NOIR_EVIDENCE_DIR` may redirect screenshots outside the repository. This run used those overrides for the local PHP/socket wrapper and temporary screenshot directory.

Tests alter only synthetic operational deadlines to exercise expiry and cleanup without waiting an hour. Concurrent transport checks instrument `pre_wp_mail` to count calls; the independent Ticket 05 delivery suite and the 24 appointment browser cases exercise actual Mailpit SMTP capture. Interrupted-worker checks terminate at the transport boundary; timeout checks leave the original worker running after the client disconnects. No exactly-once inbox delivery claim is made.

The initial combined page browser run hit the intended network limit; the final Local-only runner resets between suites and all checks pass. Idle deletion requires a five-minute external WP-Cron runner for the documented physical-retention bound. Storage unavailability can delay cleanup while refusing new work. No live deployment, real inbox test or scheduler installation is claimed by this implementation.
