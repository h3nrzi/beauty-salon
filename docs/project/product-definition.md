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
- Name and mobile number are required customer information.
- Email is optional.
- After verification, the mobile number is treated as the customer's primary identity and is read-only in the v1 profile experience.
- Changing a customer's mobile number is outside v1.
- If the verified mobile number already belongs to a customer, the same customer identity and appointment history are recovered rather than creating a second account.
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

- **Home**
  - salon introduction;
  - selected services;
  - selected specialists;
  - selected gallery work;
  - trust/benefit content;
  - clear booking CTA.
- **Services**
  - complete service list;
  - description;
  - duration;
  - price;
  - eligible specialists.
- **Specialists**
  - specialist profiles;
  - expertise;
  - eligible services.
- **Gallery**
  - salon work / portfolio.
- **About**
  - salon story, positioning and team introduction.
- **Contact**
  - address;
  - salon hours;
  - phone/contact details;
  - directions/contact path.
- **Booking**
  - complete service → specialist → date/time → identity → confirmation flow.
- **My Appointments**
  - upcoming appointments;
  - appointment history;
  - cancel action when permitted;
  - reschedule action when permitted.

Detailed visual section composition still belongs to the Stitch brief and design iteration.

### Confirmed booking-window and scheduling rules

- Customers can book up to **90 days** in advance.
- Same-day bookings require at least **60 minutes** of lead time.
- Each service duration is defined in **15-minute increments**.
- Public appointment start times are offered on a **30-minute start grid**.
- The total duration of a multi-service appointment is the sum of its selected service durations.
- Availability must respect:
  - salon opening hours;
  - the selected service set;
  - specialist eligibility for the complete selected service set;
  - the total consecutive duration of the selected services;
  - the specialist's recurring schedule;
  - specialist breaks;
  - specialist time off;
  - already-booked appointments.
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

### Confirmed pricing

- Each service has a defined customer-facing price.
- The displayed booking total is the sum of the selected service prices.
- The booking must retain the agreed price at the time it is confirmed so later service-price edits do not silently change an existing appointment.
- Payment still happens at the salon; no deposit or online payment flow is included in v1.

### Confirmed salon operations

The first release includes only the operational core needed to run the booking product.

The salon can manage:

- appointments;
- services;
- specialists;
- salon opening hours;
- specialist recurring schedules;
- specialist breaks;
- specialist time off / unavailability.

Staff appointment operations include:

- search and view appointments;
- cancel an appointment;
- reschedule an appointment;
- reassign the specialist when the appointment remains valid for that specialist;
- mark an appointment Completed;
- mark an appointment No-show.

### Confirmed operational roles

Keep v1 role scope intentionally small:

- **Manager**
  - manages all appointments;
  - manages services;
  - manages specialists;
  - manages salon hours;
  - manages specialist schedules, breaks and time off;
  - can cancel, reschedule and reassign appointments.
- **Staff / Specialist**
  - views appointments assigned to that specialist;
  - views the appointment details needed to perform the service;
  - can mark an assigned appointment Completed;
  - can mark an assigned appointment No-show;
  - cannot reassign appointments;
  - cannot change salon-wide services, specialist records or availability configuration;
  - cannot cancel or reschedule appointments in v1.

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
- Customer mobile-number change flow.
- Complex staff role hierarchies.

### Still to define

- Exact salon brand direction and content inputs.
- Responsive/mobile priorities.
- Accessibility target.
- Asset ownership/rights.
- Exact customer support/contact expectation inside the final 24-hour change window.
- Privacy/release expectations for customer data and booking communications.
- Final owner for product and human acceptance.

Do not choose WordPress architecture, content types, storage, authentication implementation, SMS provider, form infrastructure or other engineering details during this phase.

## Constraints

Known product constraints:

- The first release must work as a credible single-salon booking product, not only a lead form.
- The customer-facing and staff experiences are **Persian and RTL**.
- Dates/times must be presented with an experience appropriate for Persian users; calendar/storage implementation is an engineering decision for later.
- Browsing and starting a booking should not require an account.
- Customer identity is mobile-number centered and does not require a password-based v1 experience.
- Name and mobile are required; email is optional.
- Verified mobile is read-only in v1 and changing mobile is out of scope.
- Appointment management belongs to an authenticated customer experience.
- No online payment dependency is required for v1.
- A booking may include multiple services only when one specialist can perform the whole service set.
- Multi-service duration is the sum of the selected services and is scheduled consecutively.
- Service durations use 15-minute increments; public starts use a 30-minute grid.
- Customers may select a specific specialist or any available specialist.
- Availability considers salon hours, specialist schedules, breaks, time off and existing appointments.
- Booking horizon is 90 days and same-day lead time is 60 minutes.
- Customer self-cancellation/self-rescheduling closes 24 hours before the appointment.
- Rescheduling preserves the booked services and specialist; service/specialist changes require a new booking.
- Booking for another person is not supported in v1.
- Successful bookings are immediately confirmed.
- A stale/lost slot must fail safely and return the customer to current time selection without losing the service/specialist choices.
- Confirmed bookings retain their booking-time service prices.
- Customer and appointment information introduces privacy expectations that must be defined before engineering specification.

Pending:

- Brand direction and content inputs.
- Responsive/mobile priorities.
- Accessibility target.
- Asset ownership/rights.
- Customer support policy for locked appointments.
- Operational acceptance expectations.
- Final owner and human acceptance owner.

Unknowns remain explicit until agreed.

## Acceptance planning

Local, human and production-release acceptance will be separated before engineering specification.

At this stage, product acceptance means the agreed customer journeys, pages, actions, constraints and exclusions are explicit enough to create the Stitch brief without inventing product behavior.

## Scope approval

Status: **Not approved yet.**

Confirmed direction:

**Single women's salon + Persian/RTL public discovery + real multi-service booking + mobile-centered identity + specific/any specialist choice + one-specialist consecutive service set + explicit pricing + salon/specialist availability + 90-day horizon + 60-minute same-day lead + immediate confirmation + stale-slot recovery + 24-hour customer change cutoff + authenticated appointment management + Manager/Staff core operations + pay at salon.**

Only final brand/content, accessibility/responsive, asset-rights, customer-support and acceptance-owner decisions remain before scope freeze.
