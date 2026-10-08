# Current project

- Project name: Beauty Salon
- Owner: Pending confirmation
- Phase: Product definition
- Product definition and scope approval: Pending
- Product direction: Single women's salon with public discovery, real booking, authenticated appointment management and core salon operations
- Locale: Persian / RTL
- Public pages: Home, Services, Specialists, Gallery, About, Contact, Booking, My Appointments
- Customer identity: Name + verified mobile required; email optional; mobile-centered account; mobile read-only in v1
- Customer scope: Book for self; view, cancel, reschedule and review appointment history
- Booking composition: Multiple consecutive services per booking, all performable by one specialist; duration is the service-duration sum
- Specialist choice: Specific specialist or any available specialist
- Booking order: Services → specialist choice → date/time → identity/verification → confirmation
- Scheduling: Service durations in 15-minute increments; appointment starts on a 30-minute grid
- Availability: Salon hours + specialist schedule + breaks + time off + existing appointments
- Booking window: Up to 90 days ahead; minimum 60-minute lead for same-day booking
- Pricing: Service-price sum shown and retained at booking confirmation; pay at salon
- Confirmation: Immediate; no manual approval in v1
- Availability conflict: Do not book a stale slot; preserve services/specialist and return to current time selection
- Customer change policy: Cancel/reschedule until 24 hours before appointment; later changes require salon contact
- Reschedule semantics: Date/time only; services and specialist remain unchanged
- Appointment lifecycle: Confirmed → Completed / Cancelled / No-show
- Operational roles: Manager; Staff / Specialist
- Manager scope: All appointments, services, specialists, salon hours, schedules, breaks, time off, cancel/reschedule/reassign
- Specialist scope: Own appointments; view details; mark Completed / No-show
- Frozen baseline and audit: Pending
- Engineering handoff: Pending
- MATT configuration confirmed once: Pending
- Relevant decisions / glossary / ADRs: Pending
- Approved spec / active ticket: Pending
- Runtime and reproduction procedure: Pending
- Local implementation gate and evidence: Pending
- Human acceptance gate, owner and evidence: Pending
- Production-release gate, owner and evidence: Pending
- Blockers / capability gaps: Final brand/content, responsive/accessibility, media rights, customer-support and acceptance-owner decisions remain
- Next action: Resolve final product-level presentation/acceptance constraints, then freeze Product Definition and move to Stitch Brief.

Replace pending entries with links to existing artifacts as work progresses.
