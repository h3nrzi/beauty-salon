# Product definition

## Owner and outcome

**Selected product direction:** Beauty Booking Platform for a single women's beauty salon.

The product is more than a marketing website. Its core value is a real appointment-booking experience for salon customers, backed by the salon's operational management of appointments, services, specialists and working availability.

Primary customer outcome:

```text
Discover salon/services
→ choose one or more services
→ choose a specific specialist or any available specialist
→ choose a date and available time
→ identify/verify the customer when needed
→ confirm the appointment
→ later view/manage appointments
```

Business outcome: make discovering the salon and booking/managing a real appointment straightforward without turning the first release into a marketplace, payments product or full salon-management suite.

Owner and final acceptance owner: Pending confirmation.

## Scope

### Confirmed customer experience

- One women's beauty salon, not a marketplace or multi-salon product.
- Public salon/marketing experience plus a real booking flow.
- Customers can begin browsing and the booking journey without signing in.
- Customer identity/verification may be requested at the point needed to complete a real booking; implementation is deliberately undecided.
- Sign-in is required for the customer's appointment-management area.
- One booking can contain multiple services.
- The booking flow uses this product order:
  - select one or more services;
  - choose a specific specialist or “any available specialist”;
  - choose a date and an actually available time;
  - identify/verify the customer;
  - confirm the appointment.
- Customers can:
  - view upcoming appointments;
  - cancel an appointment;
  - reschedule an appointment;
  - view appointment history.
- Payment is not collected online in the first release; payment happens at the salon.

### Confirmed booking-window rules

- Customers can book up to **90 days** in advance.
- Same-day bookings require at least **60 minutes** of lead time.
- Availability must respect the selected service set and specialist choice. The detailed slot/duration rules are still to be defined.
- Choosing “any available specialist” is a supported customer path, not a fallback error state.

### Confirmed salon operations

The first release includes only the operational core needed to run the booking product:

- manage appointments;
- manage services;
- manage specialists;
- manage working hours / availability.

The exact staff roles, permissions and operational actions still need product definition. Do not infer an engineering model yet.

### Explicitly outside the first release

- Marketplace or multiple salons.
- Multiple branches.
- Online deposits or full online payment.
- Loyalty program.
- Public reviews/ratings.
- CRM and marketing automation.
- Inventory management.
- Payroll.
- Accounting.
- Advanced reporting/analytics.
- Native mobile applications.

### Still to define

- Exact public pages and discovery journeys.
- How multi-service duration and specialist eligibility affect slot availability.
- Cancellation and rescheduling policy.
- Customer identity/sign-in product experience.
- Whether customers can book for another person.
- Appointment states visible to customers and staff.
- Staff/admin operational actions and permission boundaries.
- What happens when availability changes during booking.
- Language/locale and content/brand constraints.

Do not choose WordPress architecture, content types, storage, authentication implementation, form infrastructure or other engineering details during this phase.

## Constraints

Known product constraints:

- The first release must work as a credible single-salon booking product, not only a lead form.
- Browsing and starting a booking should not require an account.
- Appointment management belongs to an authenticated customer experience.
- No online payment dependency is required for v1.
- A booking may include multiple services.
- Customers may select a specific specialist or any available specialist.
- Booking horizon is 90 days and same-day lead time is 60 minutes.
- Booking availability must eventually reflect real salon/service/specialist working constraints; the detailed business rules are still pending.
- Customer and appointment information introduces privacy expectations that must be defined before engineering specification.

Pending:

- Language and locale.
- Brand direction and content inputs.
- Responsive/mobile expectations.
- Accessibility target.
- Asset ownership/rights.
- Booking/cancellation/rescheduling policies.
- Operational acceptance expectations.

Unknowns remain explicit until agreed.

## Acceptance planning

Local, human and production-release acceptance will be separated before engineering specification.

At this stage, product acceptance means the agreed customer journeys, pages, actions, constraints and exclusions are explicit enough to create the Stitch brief without inventing product behavior.

## Scope approval

Status: **Not approved yet.**

Confirmed direction:

**Single women's salon + public discovery + multi-service real booking + specific/any specialist choice + 90-day horizon + 60-minute same-day lead + authenticated appointment management + core salon operations + pay at salon.**

The remaining product questions must be resolved before scope freeze and before generating the Stitch brief.
