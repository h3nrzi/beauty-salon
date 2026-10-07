# NOIR Auto Detailing — WordPress Implementation Specification

Status: ready-for-agent

Specification review/approval is required before ticket creation. This status records specification readiness; it does not authorize implementation. This document is the only deliverable of the current phase.

## Problem Statement

Car owners need to understand the Studio's Services, assess completed Projects, and submit an Appointment Request with clear expectations about later confirmation. The frozen Stitch v3 export demonstrates the intended experience, but its placeholder routes, external assets, duplicated content, and presentation-only form do not provide a maintainable operational website.

The Studio needs bounded native WordPress editing that preserves the approved composition, authoritative shared facts, reliable email notification, and reproducible setup. The pilot also needs evidence that conversion preserves visual and behavioral intent without undocumented manual work.

## Solution

Deliver the frozen four-page experience—Home, Services, Gallery, and Contact / Appointment Request—as a classic PHP WordPress theme supported by a small project-owned plugin. The theme controls layout and presentation; WordPress supplies editable content, identity, menus, and owned media; the plugin registers structured content and processes Appointment Requests.

An Appointment Request expresses interest only. The Studio receives one notification when the mail transport accepts it for sending and later contacts the customer to confirm availability and recommendations. The website offers no availability calculation, reservation, automatic confirmation, or customer request history.

## User Stories

1. As a car owner, I want to recognize NOIR and its location immediately, so that I can assess whether the Studio is relevant to me.
2. As a car owner, I want a clear Home page value proposition, so that I can understand the Studio's approach without reading dense copy.
3. As a car owner, I want the approved automotive photography and editorial hierarchy, so that I can judge the Studio's work and character.
4. As a visitor, I want consistent navigation on all four pages, so that I can move between discovery and contact.
5. As a mobile visitor, I want usable navigation and touch controls, so that I can explore the website on a small screen.
6. As a visitor, I want real routes and section links, so that links reach the intended content.
7. As a visitor, I want a clear Request Appointment action, so that I can contact the Studio when ready.
8. As a car owner, I want exactly the approved five Services, so that I can compare the available offerings.
9. As a car owner, I want Service descriptions and inclusions, so that I can understand what each offering covers.
10. As a car owner, I want consistent starting prices and durations across pages, so that I do not receive conflicting information.
11. As a car owner, I want protection information only where supported by the approved content, so that the website does not invent promises.
12. As a visitor, I want Home's featured Services to lead to their detailed sections, so that I can investigate an offering.
13. As a customer selecting a Service, I want its appointment CTA to preselect that Service, so that I do not need to choose it again.
14. As a car owner, I want the Studio's process explained, so that I understand what happens after contacting the Studio.
15. As a car owner, I want readable FAQ answers, so that I can resolve common questions before submitting a request.
16. As a visitor, I want completed Projects with accurate shared vehicle and work facts, so that I can assess relevant examples.
17. As a visitor, I want Home's selected Projects and Gallery's fuller collection, so that each page serves its intended purpose.
18. As a visitor, I want the existing Gallery filters to work, so that I can focus on relevant work.
19. As a visitor, I want All Projects to restore the complete Gallery, so that filtering does not hide work permanently.
20. As a keyboard user, I want to operate before/after comparisons, so that I can inspect the same work as pointer users.
21. As a visitor without JavaScript, I want both comparison images clearly labelled, so that the work remains understandable.
22. As a visitor, I want Testimonials presented clearly, so that I can read the approved customer accounts.
23. As a prospective customer, I want the Studio's telephone, email, address, and opening hours, so that I can contact or locate it.
24. As a prospective customer, I want consistent hours and location throughout the website, so that I can plan contact without conflicting details.
25. As a prospective customer, I want working telephone and email links, so that I can contact the Studio directly.
26. As a visitor, I want meaningful privacy and terms destinations, so that I can read the configured legal information.
27. As a customer, I want an Appointment Request form with my name, phone, vehicle, and Service, so that the Studio can respond usefully.
28. As a customer, I want email, Preferred Date, and notes to be optional, so that I can submit without unnecessary information.
29. As a customer, I want a Preferred Date interpreted in the Studio's timezone, so that date validation matches the business location.
30. As a customer, I want to understand that a Preferred Date does not reserve availability, so that I do not mistake interest for confirmation.
31. As a customer, I want clear field errors and preserved values, so that I can correct a request without retyping everything.
32. As a customer using assistive technology, I want labels, error associations, and understandable status feedback, so that I can complete the form independently.
33. As a customer without JavaScript, I want to submit the same Appointment Request, so that scripting is not a requirement for contact.
34. As a customer, I want success only after transport acceptance, so that the website does not falsely claim it sent my request.
35. As a customer, I want an honest failure message and safe retry where possible, so that I know how to proceed when delivery fails.
36. As a customer, I want refreshes and concurrent clicks on one submission to avoid repeated sends, so that I do not accidentally create duplicate notifications.
37. As a customer, I want an uncertain sending outcome explained without automatic resend, so that I can contact the Studio without a misleading success claim.
38. As a customer, I want my entered personal fields kept out of URLs and WordPress submission storage, so that contact does not create an unnecessary retained record.
39. As a Studio operator, I want one notification containing the validated request fields, so that I can follow up manually.
40. As a Studio operator, I want a site-controlled sender and optional validated Reply-To, so that notifications use the configured mail identity.
41. As a Studio operator, I want initial abuse protection without an external challenge service, so that routine requests remain straightforward.
42. As an Editor, I want to edit page copy and fixed collections, so that I can maintain content without changing layout.
43. As an Editor, I want to edit Services once, so that repeated facts and appointment choices stay consistent.
44. As an Editor, I want one record for each distinct Project with ordered placements, so that I can reuse work without duplicating facts.
45. As an Editor, I want renaming a Service or Project to preserve its links and references, so that editorial changes do not break navigation.
46. As an Editor, I want draft or invalid Services excluded from public listings and choices, so that customers cannot request unpublished offerings.
47. As an Editor, I want to replace images through the Media Library, so that photography remains owned and manageable.
48. As an Editor, I want native revisions and restoration of editorial metadata, so that I can recover earlier content.
49. As an Administrator, I want operational settings restricted to Administrators, so that editorial access does not expose delivery or legal configuration.
50. As an Administrator, I want a clear diagnostic when the required plugin or configuration is missing, so that I can restore operation.
51. As a visitor, I want a contact fallback when processing is unavailable, so that I still have a reasonable route to the Studio.
52. As a maintainer, I want explicit repeatable imports that preserve human changes, so that I can reproduce setup safely.
53. As a maintainer, I want missing assets and configuration reported, so that incomplete setup cannot silently pass acceptance.
54. As a maintainer, I want local deployable assets and supported WordPress extension points, so that the website remains maintainable without prototype dependencies or Core edits.
55. As a visitor, I want readable contrast, visible focus, and reduced motion support, so that presentation does not obstruct use.
56. As a visitor, I want responsive images and stable layout, so that pages load promptly without disruptive shifts.
57. As a maintainer, I want reproducible browser, visual, accessibility, delivery, and performance evidence, so that pilot results can be reviewed and repeated.

## Implementation Decisions

### Authority and frozen scope

- Apply this authority order: resolved product scope and repository decisions; frozen v3 screenshots for composition/hierarchy; v3 HTML for missing content, structure, and interactions; DESIGN.md for supporting tokens and guidance.
- Preserve four public product pages, section order, Obsidian foundation, Champagne accents, Syne/Inter direction, sharp geometry, hairline borders, editorial spacing, automotive imagery, and CTA hierarchy. Screenshot missing-image placeholders and unrendered text are defects, not requirements.
- Normalize residual language to the glossary, remove Custom Consultation, and replace confirmation/reservation wording in website actions with Appointment Request language. Manual later confirmation may be described in the process. Do not create additional Services from Project descriptions of PPF or other work.
- Treat the already-verified 47 DESIGN.md frontmatter/Home color tokens as matching. Follow rendered/export evidence for actual usage; do not invent a color-mismatch correction.
- Document small accessibility, image-performance, or platform corrections with their reason and before/after evidence. No silent redesign or additional generative design pass is authorized.

### Runtime, modules, and extension points

- Target the installed WordPress 7.1.3 baseline. Core remains immutable. Implementation uses project-owned theme/plugin code; environment configuration, credentials, generated uploads, caches, logs, and database state remain untracked.
- The classic theme supplies the static-front-page template, explicitly assigned Services/Gallery/Contact page templates, shared header/footer, and a safe generic page/not-found fallback. Template assignment and page IDs identify pages; mutable titles/slugs do not.
- Shared presentation components cover Service facts/cards, Project cards, comparison figures, CTA bands, hours/contact details, and form/status rendering. Templates receive validated content from the plugin's read interface rather than duplicating content validation or querying internal submission state.
- The plugin owns content registration, meta boxes, schema validation, business settings, the content read interface, bootstrap/import facilities, Appointment Request handling, notification delivery, and bounded operational state. It introduces exactly two CPTs, `noir_service` and `noir_project`; temporary operational state is not customer records or an additional CPT, and its storage mechanism is not prescribed.
- Register CPTs on `init` with `public=false`, `publicly_queryable=false`, `exclude_from_search=true`, `show_ui=true`, `show_in_nav_menus=false`, `has_archive=false`, `rewrite=false`, and `query_var=false`. Public presentation explicitly queries published valid records. No single/archive/feed/search or anonymous content API route should expose these records independently.
- Use native title, thumbnail, revisions, and custom-field support as appropriate. Use native meta boxes for bounded editing; these CPTs need no public REST exposure. Register subtype-specific metadata with explicit types, sanitization, authorization, and `revisions_enabled=true` for editorial fields. Save metadata before the completed editorial revision is captured; prove restoration rather than relying on registration alone. Immutable identities and importer bookkeeping are not revisioned editorial data. [WordPress CPT registration](https://developer.wordpress.org/reference/functions/register_post_type/) and [revisioned metadata](https://developer.wordpress.org/reference/functions/wp_post_revision_meta_keys/) support these extension points.
- Use `add_meta_boxes`, guarded `save_post` handling, and the Settings API with `manage_options` for shared operational settings. Metadata writes require a valid editing nonce and object-level `edit_post` permission, and must handle autosaves/revisions deliberately. Editors and Administrators can manage editorial records; Subscribers, anonymous users, and lower editorial roles gain no additional management privileges. Use mapped custom CPT capabilities granted only to Editors and Administrators.
- The plugin read interface returns published valid Services in explicit order, resolves stable IDs, returns page section data/ordered Project placements and shared business details, and supplies a form view model with choices, endpoint, token/nonce, safe entered values, field errors, and outcome. Empty/error results are explicit. The theme never assumes the plugin is loaded.
- Without the plugin, the theme avoids fatal errors, renders available native page/navigation content and configured contact fallback where accessible, disables submission, and displays an Administrator diagnostic. A plugin-provided theme response renderer may be registered for form errors; the plugin supplies a minimal accessible fallback response under other themes, preserving processing portability.
- Theme setup uses native title-tag, logo, thumbnail and menu support; rendering retains `wp_head`, `wp_body_open`, and `wp_footer`. Enqueue local styles/scripts through WordPress, conditionally load relevant interaction scripts, and include cache-busting versions. Plain CSS custom properties and small vanilla JavaScript files are deployable source; styling does not require a Node build.
- Future source tracking must explicitly include the project plugin currently excluded by the repository's generic plugin ignore rule. No ignore-rule or runtime change is made in the specification phase.

### Content schemas and editing bounds

All text bounds below count Unicode characters after unslashing and normalization. Reject invalid saves with an actionable notice and retain the last valid value; never silently truncate. Text fields are plain text unless explicitly designated rich text. Rich paragraphs allow only paragraphs, emphasis, lists, and safe links through a restricted WordPress KSES allowlist. Media fields contain attachment IDs, never remote image URLs. References contain stable identities, resolved to runtime record IDs.

| Content | Fields and limits |
| --- | --- |
| Service | Immutable unique `service_id`, editable native title (1–100), order (0–999), short description (0–300), full description (1–2,000), eyebrow/badge (0–80 each), inclusions (1–12 items, 1–180 each), starting price in USD cents (optional integer 0–100,000,000), duration label (optional 1–80), protection label (optional 1–120), and primary image attachment. |
| Service contextual presentation | Home placement may supply a teaser (0–300), badge (0–80), image, and labelled scope text (0–180). Price, duration, protection period, and Service identity always resolve from the canonical Service, not the placement. |
| Project | Immutable unique `project_id`, native title (1–120), vehicle (1–160), finish/color (0–100), work summary (1–1,000), ordered fact rows (0–8, label 1–60/value 1–180), image attachment, optional complete before/after pair with labels (1–80 each), and Gallery membership values from the frozen allowlist. |
| Project placement | Unique ordered Project reference, teaser (0–500), eyebrow (0–80), optional contextual image or complete comparison pair; vehicle/work facts resolve from the Project. Home supports up to 12 references, Gallery up to 60, with the initial frozen 3 and 6 placements respectively. |
| Page section | Registered named sections fixed by the assigned template: eyebrow (0–80), heading (1–180), introduction/body (0–2,000), image references and fixed-schema collection fields as listed below. No arbitrary section ordering, HTML layout, or new section types. |
| Small collections | Testimonials: 0–6 entries with quote (1–1,000), author (1–100), attribution (0–160), rating (1–5). FAQ: 0–12 entries with question (1–180), answer (1–2,000). Trust/benefit/equipment/metric entries: 0–8 per section, title (1–120), body (0–500), optional value (0–100), icon from a code-defined local allowlist. Process: up to 4 steps with title (1–120), body (0–500). Empty collections omit their section cleanly. |
| Shared Studio data | Description (1–500), address lines (1–200 each; maximum 4), public phone label (1–60) and dial string (7–15 digits with optional leading plus), optional direct phone with the same bounds, public email (validated, maximum 254), seven-day hours, IANA timezone, optional status label (0–80), and optional map/directions destination (HTTPS URL, maximum 2,048). |
| Hours | Each weekday has `closed` or one opening/closing pair in 24-hour `HH:MM`, closing later than opening. Initial Monday–Friday 08:00–18:00, Saturday 09:00–16:00, Sunday closed. No holiday/availability engine. |
| Operational configuration | Assigned four page IDs; privacy/terms destinations as native page IDs or explicit HTTPS URLs; exactly one notification recipient; site-controlled sender email/name; explicit environment mail readiness; Studio timezone. Validate referenced published destinations and addresses. Credentials are never settings fields. |

- Keep native WordPress site name, tagline, logo, and menus authoritative. Settings do not duplicate site identity. Menu editing follows native WordPress permissions; granting Editors content capabilities does not grant operational/theme configuration permissions.
- Native page metadata owns Home hero/trust/philosophy/featured placements/benefits/Testimonials/final CTA; Services intro/navigation to records/metrics/process/comparison/FAQ/final CTA; Gallery intro/ordered placements/equipment/final CTA; Contact intro/response expectation/Studio descriptive standards/process and surrounding form copy. Interface labels, errors, buttons, filter names, and state messages are translatable code-owned strings.
- Register metadata separately by section/collection with complete object/item validation and unknown properties rejected. Restoration covers page sections, ordered references, facts, images, Testimonials, and FAQ. Shared settings use documented export/database backup and restore, not post revisions or a new audit log.
- A Service is publicly valid when it has an approved identity, a nonempty title/description/inclusions, valid supplied optional facts, and required baseline media. Allow only the five approved identities; editors may rename their titles but cannot introduce a sixth offering. Draft/trash/invalid records are absent from all public lists and form choices; required baseline omissions fail acceptance.
- Projects must have valid stable identity, vehicle, work summary, and required media. Missing optional facts/images/collections omit only their relevant presentation; incomplete comparison pairs fall back to a valid single labelled image without an empty slider. Baseline comparison pairs are required for acceptance.
- Stable IDs are plugin-protected lowercase ASCII identifiers (maximum 80; letters, digits, hyphens). Imported IDs are immutable and duplicate IDs are rejected. New distinct Projects receive a unique plugin-generated `project-` identity. Renaming titles or changing slugs never changes references or anchors.

### Canonical fixtures and page mapping

The detailed Services export supplies initial descriptions, six inclusions per Service, starting prices, and durations. This table fixes cross-page facts without introducing absent claims.

| Stable Service ID | Initial title | Starting price | Duration | Protection fact |
| --- | --- | --- | --- | --- |
| `exterior-detail` | Exterior Detail | $350 | ~4–6 hours | Synthetic sealant included; no invented period |
| `interior-detail` | Interior Detail | $450 | ~5–7 hours | No period supplied |
| `full-detail` | Full Detail | $750 | 1–2 days | 6-month ceramic sealant |
| `paint-correction` | Paint Correction | $950 | 2–3 days | No period supplied |
| `ceramic-coating` | Ceramic Coating | $1,400 | 2–3 days | 3–5-year protection |

- Services page and footer order follow the table. Home featured order is Paint Correction, Ceramic Coating, Full Detail. Home's Interior & Exterior Detail maps to `full-detail`; use its canonical title and facts with its contextual teaser/image. Correct Home Paint Correction's conflicting duration. Preserve warranty documentation only as supplied by the detailed Service; do not turn the Home teaser into a stronger independent warranty promise.
- Record anchors are `service-<service_id>` and `project-<project_id>`. Service CTAs target the assigned Contact permalink with the non-personal `service=<service_id>` query and `#appointment-request`; detail links target Services anchors. Project links target Gallery anchors. No CPT permalinks are generated.

| Stable Project ID | Initial vehicle/work | Home order | Gallery order | Exact exported membership |
| --- | --- | --- | --- | --- |
| `porsche-911-gt3-992` | Porsche 911 GT3 (992), Jet Black Metallic; correction plus 5-year ceramic protection, 3 days | 1 | 1 | `paint-correction`, `exotic` |
| `aston-martin-db12` | Aston Martin DB12; satin PPF cleanse/protection, 2 days | 2 | — | No Gallery assignment |
| `range-rover-sv` | Range Rover SV; interior/leather care, 1.5 days | 3 | — | No Gallery assignment |
| `ferrari-f8-tributo` | Ferrari F8 Tributo, Rosso Corsa; ceramic/wheel protection, 2 days | — | 2 | `ceramic`, `exotic` |
| `aston-martin-dbs-superleggera` | Aston Martin DBS Superleggera, Satin Xenon Grey; matte finish protection, 2 days | — | 3 | `paint-correction`, `ceramic`, `exotic` |
| `mercedes-benz-300sl-1955` | 1955 Mercedes-Benz 300SL, DB180 Silver; classic preservation | — | 4 | `restoration`, `vintage` |
| `bmw-m3-touring` | BMW M3 Touring, Isle of Man Green; full detail/leather protection, 1.5 days | — | 5 | `full-detail`, `paint-correction` |
| `lamborghini-huracan-sto` | Lamborghini Huracán STO, Viola Pasifae; PPF/carbon-fiber cleansing and coating, 2 days | — | 6 | `ceramic`, `exotic` |

- Do not assign Porsche to the ceramic filter simply because its prose mentions coating. `restoration` is preserved membership metadata, not a new filter. Visible filter keys are `all`, `paint-correction`, `ceramic`, `full-detail`, `exotic`, `vintage`; no taxonomy routes or extra category UI are required.
- Porsche is one shared record with separate Home/Gallery imagery and teasers. Its Home label claiming 98.5% correction is not a new canonical fact; normalize comparison labels to Before/After rather than introducing a percentage beyond the authoritative work facts.
- Home-only Projects remain Home-only initially. A link for a Project without Gallery placement targets the Gallery page rather than a nonexistent anchor. Gallery's View Project Details links to its existing detailed section, not a new route or modal.
- Copy shared Studio facts from Contact: 9460 Wilshire Blvd, Beverly Hills, CA 90212; public phone +1 (800) 492-NOIR with exported numeric dial target; optional direct (310) 882-9014; public email studio@noirautodetailing.com; timezone America/Los_Angeles. Normalize the Services footer's conflicting address, hours, identity, and description to this shared source. Fictional public contact copy does not imply that notification mail configuration is ready.
- Fixture data copies remaining approved page prose, Testimonials, FAQ, process steps, and image roles from the frozen HTML, applying documented terminology cleanup. Do not add unsubstantiated commercial/technical facts. Runtime year formatting replaces hard-coded copyright years; dated editorial labels remain content rather than falsely implying new activity.

### Routing and presentation behavior

- Resolve all page links from configured native page IDs/permalinks and menus. Header/footer Request Appointment targets the Contact form anchor. Use `tel:` and `mailto:` for contact actions; configured map/directions links replace inert placeholders where applicable. Preserve location content without adding a third-party map dependency.
- Privacy and terms destinations must be explicitly configured and reachable before acceptance; do not fabricate policy text or point legal links to Home. Legal content is supplied separately or externally and does not expand the four-page product scope.
- The person icon remains decorative, hidden from assistive technology, and outside the tab order. It creates no account/login flow.
- With JavaScript, mobile navigation uses a native button with accessible name, `aria-controls`, and synchronized `aria-expanded`; Escape closes and returns focus to its trigger. Use a nonmodal disclosure to avoid unnecessary focus trapping. Without JavaScript, mobile links remain visible and usable.
- Gallery filters are buttons with selected state exposed through `aria-pressed`. Match whole membership values, not substrings; use `hidden` to remove filtered cards from visual and assistive navigation. Keep focus on the filter and announce the result count politely. All restores all six initial Projects. Without JavaScript, hide enhancement-only filters and display all Projects in baseline order.
- FAQ uses native disclosure semantics or equivalent buttons with associated panels, preserving the first-expanded baseline and independent expansion. All answers remain accessible without JavaScript.
- Use one reusable comparison component for Home, Services, and Gallery with a labelled native range control, 0–100, step 1, initial 50. Arrow keys, Home/End, pointer and touch change the revealed proportion; expose the current value meaningfully. Keep images geometrically aligned without stretching and allow vertical page scrolling on touch. Without JavaScript, render two labelled figures; enable clipping/slider controls only after successful initialization.
- Keep one meaningful H1 per page and hierarchical section headings; add a skip link and landmarks. Informative images have concise subject/context alt text, decorative images have empty alt, icons are hidden unless they carry otherwise absent meaning. Do not copy verbose generated `data-alt` descriptions verbatim.
- Visible focus, adequate target size, readable contrast, error contrast, zoom/reflow, and reduced-motion behavior are required. Maintain the approved visual character while removing inaccessible hover-only behavior. No essential information is conveyed only through color or motion.

### Appointment Request input contract

POST uses form action `noir_appointment_request` through WordPress `admin-post.php`. Register both `admin_post_nopriv_noir_appointment_request` and `admin_post_noir_appointment_request` to the same controller. GET never sends mail. The form uses ordinary POST without JavaScript; JavaScript may improve feedback and disable a button temporarily but cannot be the validation or duplicate-send authority.

| Field name | Required | Authoritative validation |
| --- | --- | --- |
| `name` | Yes | Trimmed plain text, 1–100 characters; support Unicode names, reject control characters. |
| `phone` | Yes | 7–40 characters; permit digits, spaces, parentheses, plus, hyphen and period; contain 7–15 digits. No automatic US-only format assumption. |
| `email` | No | Empty or valid email, maximum 254; reject CR/LF and malformed input rather than silently converting it to a different address. |
| `vehicle` | Yes | Trimmed plain text, 1–160 characters. |
| `service_id` | Yes | Exact stable ID for one of the five currently published valid Services; maximum 80. Recheck immediately before sending. |
| `preferred_date` | No | Empty or exactly `YYYY-MM-DD`, a real calendar date, today or later in America/Los_Angeles or the configured Studio timezone. No availability or hours restriction and no invented future-date ceiling beyond the four-digit year format. |
| `notes` | No | Plain text, maximum 2,000 characters; preserve normal line breaks, reject disallowed controls. No attachments or rich HTML. |
| `website` | No | Honeypot, expected empty; never echo or retain its value. |
| `submission_token` | Yes | 256-bit cryptographically random token encoded as 64 lowercase hex characters; registered unexpired server-side issuance required. |
| `_noir_nonce` | Yes | Valid WordPress nonce for this action and submission-token binding, plus the anonymous visitor binding described below. |

- Enforce a 32 KiB body limit before field processing and reject scalar fields submitted as arrays/objects. Reject malformed encoding; remove WordPress input slashes once. Validate raw normalized lengths before sanitization; sanitize plain text and textarea appropriately, validate email with native email validation, parse dates strictly with round-trip equality, and contextually escape every rendered value.
- Native `required`, `maxlength`, input types, autocomplete and Studio-local date `min` improve browser guidance. Group Service radios in a fieldset with legend. Unknown/unavailable preselection is ignored with no fabricated choice; POST retains the submitted invalid choice only as an error, never as an enabled option.
- Validation failure returns an accessible HTML response containing the form, safe entered values, field errors and summary, with HTTP 422. No redirect carries entered fields. Security failure returns 403, throttle failure 429 with Retry-After, configuration/definite transport failure 503, and uncertain sending outcome an explanatory non-success response. Valid entered fields may be preserved in these uncached responses when safely parsed; oversize/malformed/security-rejected bodies need not be reflected.
- Error summary links to fields; field messages use `aria-describedby` and `aria-invalid`; focus moves to the summary when enhanced. All feedback is readable with scripting disabled. Disable browser autofill only for the honeypot, which stays outside normal focus and assistive navigation.
- Success says: “Your appointment request has been accepted for sending. The Studio will contact you within 1 business day to discuss availability and recommendations. Your appointment is not confirmed.” No confirmed date, fixed reference code, automatic customer email, or claim of inbox receipt appears.

### CSRF, throttling, and privacy bounds

- Issue an anonymous 128-bit random signed visitor cookie on the uncached Contact/form response, HttpOnly, SameSite=Lax, Secure on HTTPS, with a documented short lifetime appropriate to form use. Bind the form's nonce to its submission token and visitor; scope `nonce_user_logged_out` customization to this plugin action only. Logged-in requests also require the native logged-in nonce. Validate visitor binding, token issuance, and nonce on POST. Nonces are CSRF protection, not single-use tokens or identity. If required cookie binding is unavailable, fail clearly with direct contact fallback; JavaScript remains unnecessary. [WordPress nonce validation](https://developer.wordpress.org/reference/functions/wp_verify_nonce/) describes the relevant verification/filter behavior.
- Store only keyed token/visitor/network digests and operational timestamps/counters, never raw personal fields, email payloads, raw IPs, full user agents, or URLs containing entered values. Use a plugin-specific secret derived from environment WordPress salts and domain-separated HMAC keys; rotating configuration invalidates outstanding forms safely. Do not log request bodies or mail payloads in application/error diagnostics.
- Throttle both visitor digest and network digest. Network input is the connection address aggregated to IPv4 /24 or IPv6 /64; honor forwarded addresses only behind an explicitly trusted configured proxy. Never trust arbitrary forwarded headers. Hash before persistence. Cookie clearing still encounters the network/global limits.
- Throttling must be short-lived, bounded and effective for both submissions and token issuance. Choose and document simple pilot-appropriate limits/windows, including protection against cookie clearing and excessive aggregate traffic; no exact counter schema, quota or window duration is prescribed. Count rejected/invalid attempts toward abuse limits; accepted-token replay does not consume a new send or call transport. Throttle responses use 429 with Retry-After.
- Abuse checks must remain effective under concurrent requests, and persisted digests/counters must expire and be cleaned up without creating durable visitor tracking. Prefer supported WordPress facilities where they demonstrably satisfy these properties; the specification does not mandate database counters or a particular storage mechanism.
- Honeypot, binding/nonce checks, shape/length checks, eligibility and throttles precede transport. Nonempty honeypot is rejected without sending or claiming success. Invalid fields do not consume the right to send. If required safeguards or state cannot be established reliably, fail closed before mail.
- Temporary operational state must have documented finite retention and a simple growth bound covering token issuance and abuse traffic. Expiry alone is not evidence of physical cleanup: demonstrate that obsolete state is removed and cannot accumulate indefinitely. Choose the smallest effective cleanup method and bounded work appropriate to the chosen storage; no fixed row counts, per-request batch size or hourly scheduler are required. Cleanup, eviction and storage pressure must never reopen a token that could have sent or erase the protection needed by an in-flight request; refuse new work if correctness cannot be preserved.
- Contact/form/status and POST error responses use no-store cache headers; token/nonce responses must not be served from shared caches. Other pages remain cacheable. If caching is introduced, configuration must exclude these paths and prove cross-visitor token isolation; a future token-refresh mechanism must also work without JavaScript.

### Submission reliability and notification contract

- Distinguish an issued token, an in-progress or uncertain attempt, recorded acceptance, a proven retryable failure and an expired/invalid token sufficiently to return the correct outcome. These are behavioral distinctions, not a mandated table schema or state encoding. Retain only non-personal operational information needed to enforce them; never store customer fields.
- One request token cannot cause multiple sends. Concurrent duplicate submissions with that token produce at most one transport attempt. Accepted replay never resends; expired, unknown or invalid tokens fail safely and cannot create issuance state through POST. A nonce alone is not duplicate-send protection.
- Choose the smallest project-specific mechanism using supported WordPress facilities that proves exclusive permission to attempt transport across independent concurrent requests. No particular database engine, custom table, SQL claim, locking API or transaction design is prescribed. A non-atomic check-then-set or a lock confined to one worker is insufficient unless the complete implementation proves the guarantees across workers. Fail closed before mail if the chosen mechanism cannot establish exclusivity reliably; success requires recorded acceptance attributable to the authorized attempt.
- Choose and document short usable-token and receipt lifetimes, finite retention for replay/uncertainty protection, and any pending-outcome threshold the implementation needs. Justify those choices against form usability and the actual transport behavior rather than implementing fixed 30-minute, 24-hour or 120-second values. Expiration, cleanup or loss of state never authorizes another send with the same token: once its protective state is gone, it is invalid and fails safely.

| Current state/event | Result | Transport behavior |
| --- | --- | --- |
| Issued, invalid fields | Keep issued within original expiry; return field errors | None |
| Issued/retryable failed, valid eligible POST wins claim | Processing | One studio notification attempt |
| Processing, concurrent/replayed POST | Pending or uncertain non-success response | None |
| Processing, positive transport result and acceptance write succeeds | Accepted, retained replay protection | No additional send |
| Processing, proven rejection before transport acceptance | Failed/retryable within original expiry; issue a fresh token only if expired | Retry only after a later explicit user POST |
| Processing, timeout/crash/ambiguous transport error or acceptance-write failure | Mark uncertainty if possible; otherwise leave processing | No automatic resend; no success claim |
| Accepted, replay | Existing accepted outcome while retained | None |
| Expired/missing token | Explain expiry and provide a fresh form where safe | None for the old token |

- A slow or interrupted attempt remains pending/uncertain unless acceptance or definite non-acceptance is established. No timeout, expired lock or cleanup action may authorize a competing attempt while the original could still send. Late completion may record acceptance only when its authority can still be verified; otherwise no success is claimed. Eventual state removal leaves the old token invalid, never retryable. A fresh independent user request cannot be deduplicated against historical personal content because no such content is stored; exactly-once email delivery is not promised.
- Treat missing mail configuration and known pre-transport failures as definite failure. A generic transport error is retryable only if the configured adapter provides evidence that the message was not accepted; otherwise it is uncertain. Certification tests must cover both classes. A `wp_mail()` true result is acceptance for processing, not proof of inbox receipt. [WordPress mail contract](https://developer.wordpress.org/reference/functions/wp_mail/) makes this distinction explicit.
- The plugin builds a plain-text studio notification containing the normalized seven request fields, Service stable ID/current title, Studio-local date if supplied, and request time/timezone. Blank optional fields are labelled not supplied. Subject is code-owned and excludes customer-entered strings. Send to exactly one validated configured studio recipient, from the site-controlled sender; include only the customer's validated optional email as Reply-To. No CC/BCC, attachments, customer copy, or WordPress recovery copy.
- Environment configuration establishes transport, credentials, sender-domain setup, timeouts and explicit readiness. A public inquiry email or default admin email is not an implicit notification-recipient fallback. Diagnostics contain non-personal reason codes; local mail capture used for tests is environment evidence and must not become a shipped submission store.
- After recorded acceptance, set a short-lived signed HttpOnly receipt cookie referencing the accepted token digest, issue a 303 safe redirect to the assigned Contact page with only a non-personal status flag and the form anchor, then exit. Contact displays success only when receipt signature/binding and retained accepted state validate. A guessed `status=sent` URL cannot create success. Refresh/back/replay cannot send again. Return the equivalent accepted PRG response for a valid accepted-token replay.
- Unknown outcomes offer direct contact and explicit advice to verify with the Studio; they do not automatically generate and submit another request. Definite failures preserve bounded values in the current response for an explicit retry. No session/transient stores customer values between requests.

### Owned assets and reproducible bootstrap

- Editorial images are local Media Library attachments. Package licensed Syne/Inter font files in the required weights and a small local SVG/icon set. Use no Tailwind CDN, Google font request, Material Symbols CDN, Google/AIDA image dependency, runtime UI framework, or undeclared remote asset fetch.
- Track source fixtures, approved source assets, fixture version, asset manifest, checksums, source/rights documentation and reproducible import instructions outside generated uploads. The manifest identifies role, original reference, source asset, rights evidence, checksum, dimensions, crop/focal point, alt/decorative intent and usage placements. A remote export URL alone is not rights evidence.
- Import explicitly through a development/bootstrap command registered by the plugin; plugin activation may initialize necessary operational state and capabilities but never seeds demo content or overwrites editorial content. Before mutation, validate fixtures, duplicate identities, media prerequisites and required setup inputs; provide a dry-run report.
- Map page roles, Service/Project fixture IDs and asset checksums to native IDs. Default re-import creates missing baseline items and attachments, preserves existing human changes, and reports drift/missing prerequisites. Reuse matching assets; avoid duplicate posts, menus and attachments. Set initial static front page/templates/menu assignments only when missing, and report incompatible existing assignments instead of replacing them silently.
- An explicit baseline reset may restore fixture-owned editorial records, references and assignments after reporting scope; never resets environment secrets, unrelated content, or customer data. Record importer provenance and baseline checksums separately from editorial revisions.
- Missing required photos, comparison pairs, legal destinations, or mail configuration are explicit acceptance blockers. Approved replacement photography is allowed with rights evidence and parity review of subject/crop/composition. Do not silently substitute generated placeholder production content.

### Metadata, image behavior, and performance

- Use WordPress-generated document titles, canonical page identity/permalinks, language/body attributes, and semantic headings. Do not hard-code duplicate title/canonical/Open Graph/description systems; retain extension points for normal SEO plugins. No SEO plugin is required or coupled to theme behavior, and no advanced SEO or invented structured business claims are introduced.
- Use attachment rendering APIs to supply responsive `srcset`/`sizes`, intrinsic width/height and intentional crops. Primary above-fold image is eager with appropriate fetch priority; below-fold images are lazy. On image-free Contact content, do not preload unrelated imagery. Comparison pairs reserve stable geometry and only load images appropriate to that component.
- Serve appropriately compressed modern images where supported; preserve a usable fallback. Self-host fonts with `font-display: swap`, limited required weights and metrically suitable fallback stacks; preload only a font demonstrably critical to the initial viewport. No unnecessary script or CSS framework.
- Fixed performance profile: production-like HTTPS runtime with debugging disabled, normal production PHP opcode caching, no Local development proxy/debug instrumentation, and documented hosting/PHP/database versions. Use pinned Lighthouse tooling and its actual Chrome version, cold browser cache/storage for each run, warmed server, 375×812 CSS viewport at DPR 1, simulated mobile throttling of 150 ms RTT, 1,638.4 Kbit/s throughput and 4× CPU slowdown, no extensions and no logged-in toolbar. Record host hardware, Lighthouse version/settings, asset version and cache behavior. Contact remains uncached at the page level.
- Run five navigations per page; median LCP must be ≤2.5 s and median CLS ≤0.1 for every page. Retain individual results and LCP element evidence, and inspect interaction/layout shifts separately in browser acceptance. This is a repeatable lab target, not a claim about field percentiles. Measured exceptions require review before acceptance; Local development measurements alone cannot satisfy this gate.

## Testing Decisions

- The primary seam is the deployed project's public/admin HTTP behavior against real WordPress with fixture content and controllable mail transport. Verify externally visible behavior and outcomes, not private helper calls, DOM utility classes, exact SQL text, or Core internals. Browser and integration checks observe the same product boundary rather than introducing separate APIs solely for testing.
- Use focused policy tests below that seam only for date/field boundary combinations, duplicate-send exclusion, expiry and abuse limits where deterministic clocks/concurrent workers are needed. Substitute clock and mail adapter at the plugin boundary; integration tests still exercise registration, routing, the chosen operational storage and real WordPress behavior. Test validation, abuse checks and delivery independently so one does not mask another.
- No project-owned implementation or test harness exists yet; bundled Core is not project test prior art. The v3 export provides interaction and visual evidence, not reusable production tests. Establish a small PHP/WordPress integration harness plus browser acceptance tooling during implementation, without adding a runtime framework dependency.

| Acceptance area | Required evidence |
| --- | --- |
| Routes and public scope | Four native pages; correct menu current state; all CTA/anchor/telephone/email/legal destinations; renamed titles/slugs preserve references; no public Service/Project singles, archives, search, feeds or independent anonymous API exposure. |
| Canonical content | Five Service fixtures and consistent price/duration/protection where present; Full Detail mapping; shared hours/address; eight distinct Projects with exact placements and filter membership; no Custom Consultation or forbidden legacy interface copy. |
| Editing and restoration | Administrator and Editor can edit all authorized content; lower roles cannot; Editor cannot change operational settings; edit propagates across every repeated appearance; restore native revisions for page collections, Service facts and Project facts/images/references; backup/restore shared settings. |
| Input validation | Missing required fields; empty optional fields; Unicode; bounds and bound+1; arrays; oversize/invalid encoding; invalid email/header injection; unknown/draft/invalid Service; script/HTML injection remains inert; invalid calendar dates; Studio-local today/yesterday across UTC midnight and daylight-saving transitions. |
| No-JavaScript submission | Issue token, submit, see field errors with safe preserved values, retry, receive genuine accepted PRG status; demonstrate no customer-field persistence or personal-data URL. Required cookies and valid binding remain in use. |
| Abuse/security | Honeypot, missing/foreign/expired token/nonce, altered visitor cookie, replay, cookie clearing, configured abuse limits, forged proxy headers, concurrent abuse checks, bounded state growth, cleanup/expiry, operational storage failure and cache isolation. None bypasses sending safeguards or produces false success. |
| Sending/state | Two concurrent valid POSTs using one token invoke transport once; accepted replay never resends; proven failure permits explicit safe retry; timeout/process crash/ambiguous error/post-send state-write failure never automatically resends or claims success; expired/missing token never reissues itself through POST. Use independent concurrent HTTP requests/workers against real WordPress and the chosen storage for race checks; a sequential replay or single-worker mock cannot prove concurrency safety. |
| Mail | Local capture proves one recipient, site-controlled sender, optional validated Reply-To and body fields; missing configuration fails; transport rejection and uncertain failure show correct outcomes; real configured transport delivers to a real inbox. Record actual receipt evidence with personal test data redacted. API return success alone is insufficient. |
| Progressive enhancement | No-JavaScript navigation usable, all Gallery Projects visible, FAQ readable, both comparison images labelled; partial script failure leaves content usable; absent optional content removes empty controls; required baseline omissions and missing plugin fail acceptance while remaining diagnostically safe. |
| Responsive interactions | Current stable Chrome, Firefox and Safari at 375, 768, 1024 and 1440 CSS-pixel widths; record exact browser/OS versions. Navigation, Gallery filters/count/reset, all comparisons, FAQ, form success/failure, preselection, zoom and no overflow. Use actual Safari for Safari acceptance. |
| Accessibility | Automated checks on all pages and success/error states plus manual keyboard and screen-reader checks for menus, filters, comparisons, FAQ and form. Record screen-reader/browser versions; verify labels, focus movement, landmarks, error associations, contrast, reduced motion, 200% text zoom and 400% reflow. |
| Visual parity | Human review of all four frozen screenshots plus HTML for screenshot rendering gaps; matching section order, hierarchy, crops, geometry and character. Save desktop/tablet/mobile evidence and an explicit deviation log. Do not fail parity because a broken screenshot placeholder has been replaced by the required image/text. |
| Media/import | Fresh install from tracked fixtures/assets, default repeat import without duplicates/overwrites, editorial drift reporting, missing media/rights/configuration failures and scoped reset. Browser network evidence shows no prototype remote dependency. |
| Performance | Fixed five-run profile per page with per-run and median LCP/CLS, image loading/dimensions, font strategy and production-like runtime evidence; review any target exception before acceptance. |

Completion requires the full acceptance matrix and reproducible setup/evidence instructions. Tests are specified here only; no harness, test code, ticket, or runtime implementation is created in this phase.

## Out of Scope

- Live slot selection, availability calculation, payment, customer accounts, appointment confirmation automation, request-management UI, CRM, submission archive, and automatic customer email.
- Additional CPTs, public Service/Project pages, blog, additional product pages, page builders, ACF, Site Editor layout customization, general-purpose section builders, maximum configurability and multilingual functionality.
- New Services/categories inferred from Project prose, stronger warranties, fabricated prices/durations/protection periods, and invented legal/production content.
- CAPTCHA or external anti-spam dependency, durable visitor identification, raw personal-data retention for throttling, indefinite operational state, exactly-once delivery promises and automatic retries after uncertain outcomes.
- Third-party map integration, complex animation, required frontend build framework, advanced SEO tooling, changes to WordPress Core, deployment credentials in source, and another Stitch design round.
- Ticket creation, implementation, runtime activation/import, deployment and changes to existing decision documents during this specification phase.

## Further Notes

- Resolved authority: [domain glossary](../../GLOSSARY.md), [decision log](../../docs/decision-log.md), [ADR 0001](../../docs/adr/0001-classic-theme-and-controlled-layout.md), [ADR 0002](../../docs/adr/0002-portable-appointment-request-processing.md), [ADR 0003](../../docs/adr/0003-owned-media-and-reproducible-imports.md), [ADR 0004](../../docs/adr/0004-native-structured-content-without-public-record-routes.md), [ADR 0005](../../docs/adr/0005-bounded-submission-state-without-customer-storage.md), [Codex/MATT handoff](../../docs/09-codex-matt-handoff.md), [runtime boundary](../../docs/10-wordpress-runtime-boundary.md), and [frozen v3 artifacts](../../references/v3/).
- WordPress extension-point documentation was checked with Context7 against official function references, and installed Core was inspected for the 7.1.3 baseline, anonymous admin-post dispatch, nonce visitor filtering, mail semantics, and registered metadata revisions. Local source remains the compatibility reference; implementation must verify any transport adapter's acceptance/failure behavior against the configured environment.
- The user explicitly requested synthesis from resolved decisions without reopening them, tickets, or implementation. Accordingly, the testing seam is recorded for specification review rather than starting another interview. Editorial/input bounds remain explicit contracts. Appointment Request reliability is a behavioral contract: implementation must justify simple operational limits, lifetimes, cleanup and concurrency choices with focused evidence, rather than treating a predetermined infrastructure design as required. Prefer the smallest maintainable project-specific implementation; no generic queue, messaging system, workflow engine or reusable distributed-systems framework is authorized.
- Remaining production prerequisites are approved/owned media with rights evidence, configured legal destinations, mail recipient/sender/transport, actual inbox receipt, and production-like performance evidence. They block final implementation acceptance, not creation of this specification. This document claims none of that evidence has already been obtained.
- Next workflow stage is specification review/approval, then separately authorized ticket creation and ticket review/approval before implementation.
