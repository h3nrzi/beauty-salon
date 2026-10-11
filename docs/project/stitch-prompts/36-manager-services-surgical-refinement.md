# Stitch Prompt 36 — Manager Services surgical refinement

Modify the **old Manager Services / مدیریت خدمات** screen.

This is a **surgical cleanup**, not a redesign.

## What to select in Stitch

Select **only the original/old Manager Services screen** from before Prompt 35.

Do not select:

- the rejected Prompt 35 output;
- Manager Appointments;
- public Services;
- Home;
- any other screen.

The old Manager Services screen is the visual source of truth for this pass.

## Critical instruction

Preserve the old screen's geometry and composition.

Do **not** invent a new layout.

Keep the same:

- right-side Manager sidebar;
- top bar;
- page-heading placement;
- action-button placement;
- search/filter block;
- category-chip placement;
- table width;
- table column rhythm;
- row height/density;
- pagination position;
- lower guidance position.

The goal is to make the old screen cleaner, not different.

## 1. Remove only the KPI cards

Delete the four KPI cards at the top:

- کل خدمات فعال
- متوسط زمان خدمت
- میانگین تعرفه
- پوشش متخصصان

After removing them, **collapse that vertical space**.

Pull the existing page heading/actions/search/table upward naturally.

Do not replace KPI cards with another dashboard section.

Do not create empty whitespace where they used to be.

## 2. Keep the existing heading/actions composition

Keep the old heading/action relationship.

Use title:

**`مدیریت خدمات سالن`**

Supporting copy:

**`خدمات، مدت، قیمت، متخصصان ارائه‌دهنده و وضعیت رزرو را مدیریت کنید.`**

Keep:

- `افزودن خدمت جدید`
- current restrained sort control if it fits naturally.

Do not relocate them into a new visual composition.

## 3. Preserve the search/category block

Keep the old search/category control layout.

Use search placeholder:

**`جستجو بر اساس نام خدمت یا متخصص`**

Keep category chips in the same place and same visual style.

Use:

- `همه دسته‌ها`
- `مو و استایل`
- `رنگ و لایت`
- `مراقبت پوست`
- `دست و ناخن`
- `مژه و ابرو`

Do not add new filters.

## 4. Preserve the old table layout

Keep the old table structure and proportions as closely as possible.

Columns:

- `نام خدمت`
- `دسته‌بندی`
- `مدت`
- `قیمت`
- `متخصصان ارائه‌دهنده`
- `وضعیت رزرو`
- `عملیات`

Show the same 6-row density.

Do not redesign the table into cards.

Do not enlarge row height.

## 5. Use consistent service-thumbnail treatment

Use one consistent pattern for all six rows.

Preferred:

- small restrained thumbnail for every service.

If matching thumbnails cannot be generated consistently:

- omit thumbnails from all rows.

Do **not** mix photographs with large decorative icon tiles.

## 6. Neutral service fixtures

Use exactly these representative names:

1. `کوتاهی و استایل`
2. `بالیاژ و رنگساژ`
3. `مراقبت و تقویت مو`
4. `مانیکور و پدیکور`
5. `مراقبت پوست`
6. `لیفت و لمینت مژه`

Avoid:

- درمان
- تراپی
- بوتاکس
- اسپا
- medical titles
- certification/material claims.

## 7. Terminology corrections only

Use:

- `قیمت` — not `تعرفه`
- `متخصصان ارائه‌دهنده` — not `متخصصان مجاز`
- `قابل رزرو` — one simple state

Do not invent:

- draft/published;
- archive;
- hidden/public;
- analytics state;
- service-performance metrics.

## 8. Row actions

Keep one clear action per row:

**`ویرایش`**

Remove the redundant separate view action.

Keep the action aligned with the old row layout.

## 9. Lower guidance

Keep the old lower guidance block position and visual treatment.

Replace its copy with only:

**`غیرفعال کردن رزرو یک خدمت نباید نوبت‌های تأییدشده قبلی را تغییر دهد.`**

Remove:

- `مشاهده راهنمای تقویم`;
- system/portal sync wording;
- implementation timing.

## 10. Do not change the Manager shell

Do not alter:

- sidebar width;
- sidebar item spacing;
- logo;
- top-bar height;
- manager identity placement;
- overall canvas width.

## Required output

Return exactly one:

- **Manager Services — desktop/default**

The result should look immediately recognizable as the **old Manager Services screen cleaned up**, not as a newly designed page.

No edit form.
No add-service form.
No mobile/tablet.
No new state.
