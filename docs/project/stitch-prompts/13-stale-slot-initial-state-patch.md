# Stitch Prompt 13 — Stale-slot initial-state patch only

Create **only one corrected screen** for the existing آرا Booking flow:

## Stale Slot Recovery — initial state

Do not redesign anything.

Reuse the existing stale-slot composition, typography, colors, spacing and summary structure.

The screen must show:

- the original selected time as unavailable;
- selected services preserved;
- selected specialist / «هر متخصص در دسترس» preserved;
- current alternative times visible.

### Mandatory initial-state rules

- **No alternative time is selected.**
- All available replacement-time controls must be visually unselected.
- Do not show a checkmark on any available time.
- Do not label any time as:
  - نزدیک‌ترین;
  - اولین پیشنهاد;
  - پیشنهاد اول/دوم/سوم;
  - recommended;
  - best;
  - fastest.
- Do not rank the replacement times.

### Continue action

The primary action:

**انتخاب ساعت و ادامه نوبت**

must be:

- visibly disabled;
- semantically disabled;
- non-clickable in the initial state.

It should become active only after the customer explicitly selects a replacement time, but **do not show the post-selection state in this output**.

### Preserve exact product behavior

- no appointment is created in this state;
- no replacement time is chosen automatically;
- services remain unchanged;
- specialist choice remains unchanged;
- customer is choosing again from fresh current availability.

## Output

Return only this one corrected stale-slot initial-state screen.

Do not regenerate:
- Services;
- Specialist;
- Date/Time happy path;
- Identity;
- Review;
- Success;
- desktop stages;
- Markdown product contracts;
- any other page.

This is the final Booking freeze-evidence patch.
