# 06: Harden Appointment Request against replay, concurrency and uncertain delivery

**What to build:** Customers receive safe, honest outcomes when requests are repeated, concurrent, expired, throttled or uncertain. The Studio avoids multiple transport attempts for one successfully claimed token. Complete the approved bounded, privacy-conscious reliability contract within the existing project-specific Appointment Request flow.

**Blocked by:** 05 — Submit a validated Appointment Request end-to-end.

**Status:** ready-for-agent

- [ ] Enforce the exact specified visitor/network/global submission and issuance limits with atomic counters. Cookie clearing cannot bypass network/global limits; forwarded addresses are honored only for explicitly trusted proxies. Persist only scoped keyed digests and operational counters/timestamps, never raw personal fields, IPs, mail payloads or request bodies. Throttle responses use 429 and Retry-After.
- [ ] Use the approved InnoDB-backed token state and conditional atomic claim with processing-owner finalization. Only the claim winner attempts transport; no transaction stays open during mail. Storage/atomic-operation failures fail closed before sending. Do not use transients or process-local locks as concurrency authority.
- [ ] Separate issued, processing, accepted, retryable failed and expired outcomes as specified. Concurrent/replayed processing requests never send; accepted replay returns the existing authenticated accepted outcome without another send. A definite failure permits only a later explicit safe retry.
- [ ] Timeouts, crashes, ambiguous transport errors and post-send acceptance-write failure produce a pending/uncertain non-success outcome with direct-contact guidance, never automatic resend. Processing older than 120 seconds is uncertain, not freed for takeover; expiration is not proof that transport failed. Do not promise exactly-once delivery.
- [ ] Enforce the specified 30-minute usable-token and receipt lifetimes, 24-hour accepted/uncertain tombstones, throttle expiry and cleanup bounds. Unknown/expired tokens cannot create issuance state through POST. Live capacity is capped at 10,000 tokens and 20,000 throttle rows with atomic accounting; never evict unexpired protected state to admit work.
- [ ] Hourly cleanup and bounded opportunistic cleanup of at most 100 rows per request satisfy specified retention without unbounded scans. Cleanup releases capacity atomically and required scheduled operation is documented without creating deployment infrastructure.
- [ ] Contact/form/status and error responses are no-store; visitors cannot receive each other's tokens/receipts through shared caches. Other pages remain cacheable. Test isolation without adding a speculative caching or token-refresh platform.
- [ ] Evidence uses separate real database connections/processes to prove one transport invocation under simultaneous valid POSTs, accepted replay, atomic counters/capacity, expiry and cleanup. Cover cookie clearing, forged proxy headers, foreign/expired tokens, database failures, definite versus uncertain transport failures, crashes and post-send write failure, including honest accessible no-JavaScript outcomes.
- [ ] Keep all hardening specific to this pilot. Do not introduce a generic queue, messaging system, workflow engine, extension framework or reusable distributed-systems infrastructure.
