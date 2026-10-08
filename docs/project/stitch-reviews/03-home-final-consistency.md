# Stitch Review 03 — Final Home consistency pass

**Reviewed:** 2026-10-08  
**Source:** third Stitch export with desktop + mobile Home screens and updated design-system notes  
**Decision:** **Accept and freeze the Home + initial visual-system direction.** Do not run another generative Home redesign pass.

## What is now good enough to freeze

The third export resolves the design uncertainty that justified prior Stitch iteration:

- desktop and mobile both expose «وقت‌های من» and «رزرو وقت»;
- mobile has a real navigation trigger and the mobile layout reads as an intentional handset composition;
- Home remains curated to three selected services rather than reproducing the full Services page;
- booking is represented as the approved five-stage journey;
- “هر متخصص در دسترس” is used rather than an unapproved first-available rule;
- pay-at-salon / no-online-payment messaging is clear;
- brand presentation reads as «آرا» rather than a user/avatar identity;
- the Soft Editorial system is coherent across hero, service previews, specialists, values, gallery, booking bridge and footer;
- responsive evidence is now credible: desktop screenshot 2560 px wide and mobile screenshot 780 px wide, consistent with high-DPI desktop/mobile exports rather than the previous ultra-narrow mobile evidence.

The visual language now has enough certainty to guide the remaining pages.

## Remaining deviations

A few mismatches remain, but they are deterministic cleanup rather than unresolved design questions. Per the workflow stopping rule, they should **not** trigger another generative Stitch loop.

### Copy / product-label cleanup

The desktop export still contains residual wording such as:

- HTML title “سالن زیبایی و اسپا”;
- footer label equivalent to “آتلیه و اسپا اختصاصی”;
- a footer/privacy label mixing privacy and hygiene;
- some copy that states material quality / hygiene standards as established facts.

The mobile export still includes legal-style links such as «قوانین نوبت‌دهی» and «حریم خصوصی» as normal destinations.

These are not accepted product facts. During later export audit / engineering handoff:
- normalize positioning to **سالن زیبایی بانوان آرا**;
- treat legal/privacy destinations as unresolved until real content exists;
- neutralize unsupported proof/quality/hygiene claims;
- preserve only approved product facts.

### Typography token cleanup

The design prose correctly describes Persian-first use of Vazirmatn, but the exported frontmatter / generated HTML still assigns `Noto Serif` to several Persian display tokens.

This is now a deterministic design-token cleanup:
- Persian visible UI/body must remain Persian-capable;
- use Vazirmatn or another explicitly approved Persian/Arabic-capable display face when engineering the baseline;
- do not infer a production font license/package from the Stitch export.

### Color token cleanup

The prose declares `#9E5A4E` as the single primary terracotta action color while the exported token frontmatter still contains `primary: #814338` and `primary-container: #9E5A4E`.

Carry forward the visual appearance, but normalize semantic tokens during handoff so engineers do not have to guess which value owns primary actions.

### Mock business facts

Address, phone and opening hours are still mock composition data. The footer now labels them as sample data in the desktop screen, which is acceptable for the visual baseline.

Do not treat these values as production content.

## Freeze decision

Freeze the **Home + initial design system** as:

`ara-home-soft-editorial-v1`

This is a visual baseline, not production-ready HTML.

Accepted:
- composition;
- section rhythm;
- responsive strategy;
- navigation pattern;
- CTA hierarchy;
- service/specialist/gallery preview language;
- warm neutral + terracotta visual direction;
- restrained card/elevation language;
- five-stage booking bridge presentation.

Not accepted as authoritative:
- literal placeholder copy;
- legal/privacy destinations;
- mock address/phone/hours;
- media rights;
- font delivery/licensing;
- exact generated HTML architecture;
- Tailwind/runtime choices;
- raw color token naming.

## Next step

Do not iterate Home again unless a later cross-page inconsistency exposes a real visual-system problem.

Use this baseline to design the next scoped page: **Services**.
