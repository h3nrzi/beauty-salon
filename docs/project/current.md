# Current project

- Project name: Beauty Salon
- Owner: Pending confirmation
- Phase: Product definition
- Product definition and scope approval: Pending
- Product direction: Single women's salon with public discovery, real booking, authenticated appointment management and core salon operations
- Locale: Persian / RTL
- Public pages: Home, Services, Specialists, Gallery, About, Contact, Booking, My Appointments
- Customer identity: Mobile-number centered; browse/start booking without sign-in; verify when needed; no password-based v1 UX
- Customer scope: Book for self; view, cancel, reschedule and review appointment history
- Booking composition: Multiple consecutive services per booking, all performable by one specialist; duration is the service-duration sum
- Specialist choice: Specific specialist or any available specialist
- Booking order: Services → specialist choice → date/time → identity/verification → confirmation
- Booking window: Up to 90 days ahead; minimum 60-minute lead for same-day booking
- Confirmation: Immediate; no manual approval in v1
- Availability conflict: Do not book a stale slot; preserve services/specialist and return to current time selection
- Customer change policy: Cancel/reschedule until 24 hours before appointment; later changes require salon contact
- Reschedule semantics: Date/time only; services and specialist remain unchanged
- Appointment lifecycle: Confirmed → Completed / Cancelled / No-show
- Operational roles: Manager; Staff / Specialist
- Salon scope: Search/view/cancel/reschedule/reassign/complete/no-show appointments; manage services, specialists and working hours / availability
- Payment scope: Pay at salon; no online payment in v1
- Frozen baseline and audit: Pending
- Engineering handoff: Pending
- MATT configuration confirmed once: Pending
- Relevant decisions / glossary / ADRs: Pending
- Approved spec / active ticket: Pending
- Runtime and reproduction procedure: Pending
- Local implementation gate and evidence: Pending
- Human acceptance gate, owner and evidence: Pending
- Production-release gate, owner and evidence: Pending
- Blockers / capability gaps: Page section inventory, detailed availability rules, exact staff permissions, brand/accessibility/media constraints and identity edge cases remain open
- Next action: Define page-level product scope and the remaining scheduling/operational rules before scope freeze.

Replace pending entries with links to existing artifacts as work progresses.
