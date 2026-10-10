# Stitch Review 25 — Manager Appointments Mobile 24A patch

**Reviewed:** 2026-10-10  
**Source:** `stitch_ara_beauty_salon_ui (1)(2).zip`  
**Package SHA-256:** `ee42586ee15c25acf9179f1058600cfada402df894201e1be7d61989e1bef2c1`  
**Decision:** **Approve and freeze Mobile 24A.**

## Generated screen map

- `_1` — filtered search result
- `_2` — mobile appointments workspace/list
- `_3` — open filter state

## Patch verification

The blockers from Review 24 are resolved.

### Persian manager heading

Accepted:

- visible header is Persian;
- `مدیریت نوبت‌ها` / `نوبت‌ها` is used;
- no visible English `Appointments` heading remains.

An internal HTML comment containing “Appointments Workspace List” is non-user-facing and does not affect the visual baseline.

### Navigation

Accepted:

- generic `تنظیمات` destination is removed;
- ambiguous `ساعات و تقویم` destination is removed;
- mobile bottom navigation uses only confirmed product areas:
  - نوبت‌ها
  - خدمات
  - متخصصان
  - ساعات کاری

Other confirmed operational areas can be surfaced later through the mobile manager menu/navigation pattern when those pages are designed; 24A does not invent new destinations.

### Notification center

Accepted:

- the notification bell is removed;
- no notification-center affordance is implied.

### Scheduling fixture

Accepted:

- the invalid 12:45 appointment start is gone;
- visible appointment starts align to the 30-minute start grid;
- end times may naturally fall off-grid according to service duration.

### Fixture consistency

Accepted:

- the workspace and open-filter state now consistently show `۶ نوبت ثبت‌شده`.

## Frozen 24A interaction patterns

The following mobile patterns are now frozen for Manager Appointments:

- appointment cards instead of compressed desktop tables;
- prominent RTL search;
- mobile-friendly filter sheet;
- date / status / specialist filters;
- four approved appointment statuses only;
- booked total price + pay-at-salon context;
- direct appointment-detail action;
- bottom navigation limited to approved areas.

## Boundary

This freezes **Manager Appointments Mobile 24A — workspace/search/filter only**.

It does not yet freeze:

- active appointment detail;
- cancel flow;
- reschedule flow;
- specialist reassignment;
- conflict recovery;
- terminal-state mobile details;
- tablet.

Next step is Mobile 24B.
