# Stitch Review 33 — Manager Appointments Mobile 24D first pass

**Reviewed:** 2026-10-10  
**Source:** `stitch_ara_beauty_salon_ui (10)(1).zip`  
**Package SHA-256:** `8514f806b1f69da61897d095d8f5f80f84b3c689f598c52e428b1607748e9c9e`  
**Decision:** **24D is not frozen yet.** The mobile interaction structures are usable, but all three screens still contain visible product/semantic drift.

## Export map

- `_1` — specialist reassignment
- `_2` — invalid / unavailable reassignment
- `_3` — concurrent-change conflict

## What works

The core interaction model is correct:

- reassignment is a dedicated mobile flow;
- services/date/time/duration/booked price are shown as fixed context;
- eligible vs invalid/unavailable specialist states are visible;
- explicit specialist selection is required;
- invalid/unavailable state keeps the appointment unchanged;
- conflict stops the operation instead of silently overwriting data;
- manager can review the latest appointment state and return to appointments.

No broad redesign is needed.

## Remaining blockers

### 1. Visible English titles
The screens show `Reassign Specialist` and `Booking Conflict Resolver`. Use Persian only:
- `تغییر متخصص نوبت`
- `عدم امکان انتخاب متخصص`
- `تعارض تغییر هم‌زمان نوبت`

### 2. Credential hierarchy
Remove `استایلیست ارشد` / `میکاپ آرتیست ارشد`. Use neutral expertise only.

### 3. Technical reassignment wording
Replace phrases such as `تنظیم بر اساس صلاحیت فنی همزمان` and `آماده ثبت نهایی` with simple product language:
- specialist can perform all booked services;
- specialist is available for the full interval;
- manager explicitly selects;
- `آماده تأیید`.

### 4. Invalid-state copy is over-specified
Use only:
- `این متخصص برای همه خدمات این نوبت واجد شرایط نیست.`
- `این متخصص برای کل بازه زمانی نوبت در دسترس نیست.`

Then state that the current appointment remains unchanged.

### 5. Reassignment states use inconsistent appointment fixtures
`_1` and `_2` are states of the same flow but use different appointment/customer/date/price data.

Use the `_1` snapshot consistently:
- `ARA-84921`
- `سحر دانش‌پژوه`
- `۰۹۱۲۳۴۵۶۷۸۹`
- `دوشنبه، ۱۸ اردیبهشت`
- `۱۰:۰۰ الی ۱۲:۱۵`
- `۱۳۵ دقیقه`
- `۱,۶۰۰,۰۰۰ تومان`
- current specialist `پروانه رادمنش`

### 6. Conflict screen exposes system/implementation semantics
Remove:
- `تغییر همزمان در سرور`
- `Booking Conflict Resolver`
- `تأیید نهایی و قفل نوبت`
- `برای حفظ صحت داده‌ها`
- `آخرین وضعیت رسمی و معتبر سیستم`
- `سامانه یکپارچه نوبت‌دهی`

Use only:

**`این نوبت از آخرین بازبینی شما تغییر کرده است. عملیات فعلی متوقف شد تا اطلاعات جدید بازنویسی نشود. آخرین وضعیت را بررسی کنید و در صورت نیاز دوباره اقدام کنید.`**

Show a compact latest appointment summary plus:
- `بررسی آخرین وضعیت نوبت`
- `بازگشت به نوبت‌ها`

### 7. Remove unrelated marketing content
The conflict state does not need a salon marketing image or integrated-system quality claim. Keep it operational and focused.

## Freeze gate

Patch the same three screens only. 24D can be frozen after the issues above are corrected.
