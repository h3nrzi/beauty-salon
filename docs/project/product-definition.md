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
→ verify customer identity by mobile when needed
→ confirm the appointment
→ later sign in and manage appointments
```

Business outcome: make discovering the salon and booking/managing a real appointment straightforward without turning the first release into a marketplace, payments product or full salon-management suite.

Owner and final acceptance owner: Pending confirmation.

## Scope

### Confirmed customer experience

- One women's beauty salon, not a marketplace or multi-salon product.
- Public salon/marketing experience plus a real booking flow.
- Customers can browse and begin the booking journey without signing in.
- Customer identity is mobile-number centered at the product level.
- The customer verifies identity when needed to complete a real booking.
- Password-based customer accounts are not part of the intended v1 experience.
- Sign-in is required for the customer's appointment-management area, using the same customer identity.
- One booking can contain multiple services.
- All services in one booking must be performable by the same specialist.
- Multi-service bookings are performed consecutively as one appointment; the appointment duration is the sum of the selected service durations.
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
- In v1, customers book only for themselves; booking for another person is out of scope.
- Payment is not collected online in the first release; payment happens at the salon.

### Confirmed public pages

The first release includes:

- Home;
- Services;
- Specialists;
- Gallery;
- About;
- Contact;
- Booking;
- My Appointments.

The exact content/section inventory for each page will be defined before the Stitch brief is approved.

### Confirmed booking-window and appointment rules

- Customers can book up to **90 days** in advance.
- Same-day bookings require at least **60 minutes** of lead time.
- Availability must respect:
  - all selected services;
  - specialist eligibility for the complete selected service set;
  - the total consecutive duration of the selected services;
  - the specialist's actual working availability.
- Choosing “any available specialist” is a supported customer path, not a fallback error state.
- A successful booking is confirmed immediately; there is no manual salon approval step in v1.
- Customer cancellation and rescheduling are allowed until **24 hours before** the appointment.
- Inside the final 24 hours, customers cannot self-cancel or self-reschedule and must contact the salon.
- Rescheduling changes only the appointment date/time. The selected services and assigned/selected specialist stay unchanged.
- Changing services or specialist requires cancelling the existing appointment and creating a new booking.
- If a selected slot becomes unavailable before confirmation:
  - the booking is not created;
  - the selected services and specialist choice are preserved;
  - the customer returns to time selection and sees current available options.
- Customer-visible lifecycle for v1 is centered on:
  - Confirmed;
  - Completed;
  - Cancelled;
  - No-show.

### Confirmed salon operations

The first release includes only the operational core needed to run the booking product.

Staff can:

- search and view appointments;
- cancel an appointment;
- reschedule an appointment;
- reassign the specialist when the appointment remains valid for that specialist;
- mark an appointment Completed;
- mark an appointment No-show.

The salon can also manage:

- services;
- specialists;
- working hours / availability.

### Confirmed operational roles

Keep v1 role scope intentionally small:

- **Manager**
  - manages services;
  - manages specialists;
  - manages working hours / availability;
  - manages all appointments.
- **Staff / Specialist**
  - views and manages appointments relevant to that specialist.

The exact permitted actions inside each role will be refined before scope approval; no broader role hierarchy is intended for v1.

CRM, complex internal notes, marketing workflows and broader salon-management capabilities remain outside v1.

### Explicitly outside the first release

- Marketplace or multiple salons.
- Multiple branches.
- Booking for another person.
- Online deposits or full online payment.
- Loyalty program.
- Public reviews/ratings.
- CRM and marketing automation.
- Inventory management.
- Payroll.
- Accounting.
- Advanced reporting/analytics.
- Native mobile applications.
- Password-based customer account UX.
- Complex staff role hierarchies.

### Still to define

- Exact section/content inventory for the public pages.
- Detailed slot granularity and working-break/time-off behavior.
- Exact permitted actions for Staff / Specialist versus Manager.
- Exact mobile identity UX and recovery/change scenarios.
- Contact/support behavior inside the final 24-hour change window.
- Brand direction and content inputs.
- Responsive/mobile priorities.
- Accessibility target.
- Asset ownership/rights.

Do not choose WordPress architecture, content types, storage, authentication implementation, SMS provider, form infrastructure or other engineering details during this phase.

## Constraints

Known product constraints:

- The first release must work as a credible single-salon booking product, not only a lead form.
- The customer-facing and staff experiences are **Persian and RTL**.
- Dates/times must be presented with an experience appropriate for Persian users; calendar/storage implementation is an engineering decision for later.
- Browsing and starting a booking should not require an account.
- Customer identity is mobile-number centered and does not require a password-based v1 experience.
- Appointment management belongs to an authenticated customer experience.
- No online payment dependency is required for v1.
- A booking may include multiple services only when one specialist can perform the whole service set.
- Multi-service duration is the sum of the selected services and is scheduled consecutively.
- Customers may select a specific specialist or any available specialist.
- Booking horizon is 90 days and same-day lead time is 60 minutes.
- Customer self-cancellation/self-rescheduling closes 24 hours before the appointment.
- Rescheduling preserves the booked services and specialist; service/specialist changes require a new booking.
- Booking for another person is not supported in v1.
- Successful bookings are immediately confirmed.
- A stale/lost slot must fail safely and return the customer to current time selection without losing the service/specialist choices.
- Customer and appointment information introduces privacy expectations that must be defined before engineering specification.

Pending:

- Brand direction and content inputs.
- Responsive/mobile priorities.
- Accessibility target.
- Asset ownership/rights.
- Detailed staff permissions.
- Detailed availability calendar rules.
- Operational acceptance expectations.

Unknowns remain explicit until agreed.

## Acceptance planning

Local, human and production-release acceptance will be separated before engineering specification.

At this stage, product acceptance means the agreed customer journeys, pages, actions, constraints and exclusions are explicit enough to create the Stitch brief without inventing product behavior.

## Scope approval

Status: **Not approved yet.**

Confirmed direction:

**Single women's salon + Persian/RTL public discovery + multi-service real booking + mobile-centered identity + specific/any specialist choice + one-specialist consecutive service set + 90-day horizon + 60-minute same-day lead + immediate confirmation + stale-slot recovery + 24-hour customer change cutoff + authenticated appointment management + Manager/Staff core operations + pay at salon.**

The remaining product questions must be resolved before scope freeze and before generating the Stitch brief.
