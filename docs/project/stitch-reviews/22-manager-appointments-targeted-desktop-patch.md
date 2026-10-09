# Stitch Review 22 — Manager Appointments targeted desktop patch

**Reviewed:** 2026-10-09  
**Source:** `stitch_ara_beauty_salon_ui (8)(1).zip`  
**Package SHA-256:** `ca7b2f698deff2c416896281da46cda40660b52c602fb0c6ce9538ce9ca136f1`  
**Decision:** **Desktop is one small patch away from freeze.** The targeted cleanup worked on most affected screens, but two visible product-semantic issues remain.

## What is now clean enough

The following previously problematic areas are now acceptable for desktop baseline:

- workspace/list no longer exposes manual/new appointment creation;
- workspace/list uses the approved four statuses;
- cancel confirmation is reduced to a product-level destructive action;
- reassignment no longer uses invoice/settlement/database wording;
- concurrent-change conflict no longer exposes HTTP/ETag/database implementation details;
- active detail, stale reschedule, terminal-state structures and reassignment structures remain visually accepted.

No layout redesign is needed.

## Remaining blockers

### 1. Search/filter still exposes manual booking creation

The search/filter screen still includes:

`ثبت نوبت فوری — Ctrl + N`

Manual/new appointment creation is not in the frozen v1 manager scope.

Remove this shortcut and any remaining manual/new appointment creation affordance from the search/filter experience.

### 2. Reschedule review still implies an unapproved approval workflow

The reschedule review still says the selected slot was:

`توسط متخصص و مدیر شیفت تایید اولیه شده است`

and includes wording around:

`تنظیمات اطلاع‌رسانی`

The frozen product does not define:

- specialist approval of a manager reschedule;
- manager-shift preapproval;
- a notification-settings workflow.

The UI only needs to state that the selected replacement time is currently valid/available.

Use product-level wording such as:

**«این زمان برای متخصص فعلی و مدت کامل نوبت در دسترس است.»**

Then show the final manager confirmation action.

Do not introduce preapproval or notification-system semantics.

## Non-blocking deterministic wording cleanup

Some terminal-state screens still use words such as:

- بایگانی;
- آرشیو عملیاتی.

There is no separate Archive product surface. During implementation/handoff, normalize these to:

- تاریخچه نوبت;
- اطلاعات فقط‌خواندنی.

This wording alone does not require another broad Stitch pass.

## Freeze gate

No new screens are needed.

Patch only:

1. search/filter — remove `Ctrl + N / ثبت نوبت فوری`;
2. reschedule review — remove specialist/shift preapproval + notification-settings semantics.

If those two screens are corrected without introducing new scope, **Manager Appointments Desktop can be frozen**.
