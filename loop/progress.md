# Design loop: live progress

**Goal:** the JIO homepage should match or beat the Schneider Electric homepage (`se.com/ww/en`, see `bar.md`) on every bar mechanism, while obeying `DESIGN.md` and the client rules.
**Exit:** all three critics pass every piece. Otherwise the user stops the run.
**Round count:** 11 · **Started:** 2026-11-01

## Pieces

| # | Piece | Status | Round |
|---|---|---|---|
| 1 | Home hero: headline, email capture, layer chain frame | PASSED in round 11 (all three critics) | 11 |
Round 8 (craft only): FAIL on line 3 only (descriptions wrapped); lines 1, 2, 4, 5 PASS, whitespace measured 39.1% | 8 |
Round 9 closed: brief PASS, system FAIL (off-palette dark green on hover and caret), craft PASS | 9 |
Round 10 closed: brief PASS, system FAIL (logo hover colours), craft FAIL (line 3: tile heading below the photo) | 10 |
Round 11: brief PASS, system PASS, craft PASS. Piece 1 PASSED | 11 |
| 2 | Below the hero: strip, services tiles, vendor wall, why one supplier, industries rail, quote, footer (merged from the original pieces 2 and 3) | PASSED in round 3 (all three critics) | 3 |

## Critic verdicts

| Piece | Round | Brief | System | Craft | Biggest gap |
|---|---|---|---|---|---|
| 1 | 1 | PASS | FAIL | FAIL | No photo image band or photo tiles; Schneider is better on imagery |

## Gap history

Round 1, piece 1, system critic (FAIL):
- Form inputs and the carousel button compute to Arial, not Source Sans 3 (inputs do not inherit the font by default).
- Hero status label uses #2E7B0B, a third green outside the two permitted secondaries.
- Services band background is #EEF8E8, a pale green tint outside the permitted palette.
Round 1, piece 1, brief critic (PASS): headline says "servers" where a buyer looks for "IT".
Round 1, piece 1, craft critic (FAIL, reference better): no full-width image band above the headline; no image tiles with captions; body and headings measured at 14 to 19px and 50 to 69px, with four font weights in use.

Fixed after round 1 (system gaps, no decision needed): form controls and carousel button now inherit Source Sans 3; inspector label is ink, not a third green; services band is white, not pale green. DESIGN.md updated to match.

Decisions answered by the user: (1) generate hero and tile images with Higgsfield; (2) match the bar's type scale.

Round 2 builder changes (piece 1): generated hero and three tile photos with Higgsfield (gpt_image_2_5, 0.25 credits each, about 1.25 credits total, 110 credits left before this). Added a full-width photo band above the hero headline, photo tiles with solid captions (no gradient) on the power, data centre and network tiles, body text set to 16px, headings set to 25px or less (measured bar range), and two font weights only (400 and 700).

Round 2, piece 1, brief critic (FAIL): the photo band pushed the headline to about y=813px, below the 800px first screen, so the first screen no longer states that JIO covers IT and power. Builder fix applied: band reduced to 9 to 13rem and the hero top padding reduced. Round 2 system and craft verdicts were judged on the build before this fix and will be re-run in round 3.

Round 2, piece 1, system critic (PASS, on the build before the band fix). One borderline item was flagged: the Consulting tile used a pale blue tint. Changed to white with a blue border, so every background is white, ink or a permitted secondary.

Round 2, piece 1, craft critic (FAIL). The critic's headline-below-fold gap is the same photo-band problem already fixed. Its BETTER field said Y while naming Y as the weaker site, so that field is contradictory and was ignored. Round 3 asks for X or Y separately to avoid that.

Round 3 started on the fixed build: all three critics re-run, with the Consulting tile change included.

Round 3, piece 1, brief critic (PASS). Note: the headline says "servers and the power", where a buyer looks for "IT infrastructure" and "backup power". The subhead names both, so the brief still passes.

Round 3, piece 1, system critic (PASS). All visible elements use Source Sans 3, square corners, no gradients, and only white, neutrals and the two secondaries.

Round 3, piece 1, craft critic (FAIL). Two gaps named: (a) "icon rows instead of image tiles" in the product section. Checked: the three service tiles (power, data centre, network) do render their photos and white captions at full width. The critic probably looked at the hero power chain, which is icon rows by design. Not changed. (b) Bar line 4: the bar's hero has a carousel with paired outline arrows. Ours has none in the hero (the only rail is in Industries). This is a decision for the user, not something I'll add silently.

Decision from the user: add a hero carousel. Builder change: the photo band is now a three-slide carousel (switchroom, data centre aisle, network) with boxed previous and next arrows and a 1 / 3 counter. The headline stays fixed below the photos, and there is no autoplay, so the buyer's message doesn't rotate away. Checked in the browser: arrows step, wrap around, and the headline sits at y=377 to 423, above the 800px fold. Two extra Higgsfield images cost 0.5 credits.

Round 4, piece 1, brief critic (PASS). Note: the hero quote form sits just below the 800px fold. The header "Get a quote" button is visible, so the route to a quote still passes.

Round 4, piece 1, system critic (PASS). No rule violations in the hero, carousel or first three sections.

Round 4, piece 1, craft critic (line-by-line on re-ask): lines 1, 2, 4 and 5 pass. Line 3 fails because the product tiles sat third below the hero, after the strip and vendor wall, outside the critic's scope of the first two sections. Line 4 flagged the carousel Previous button clipped at x=-17.

Builder changes for round 5: the services section now sits directly after the hero strip, with the vendor wall after it, so the product tiles fall inside the first two sections. The carousel controls are inset to the content column, with the Previous button now at the gutter.

Round 5, piece 1, brief critic (PASS). Note: the inline quote form sits at the fold, so the visible route to a quote is the header button.

Round 5, piece 1, system critic (PASS). The dark panels carry a faint green cast of about 9 out of 255. The critic judged them as neutral dark ink, not a tint.

Round 5, piece 1, craft critic (FAIL on line 3 only; lines 1, 2, 4 and 5 pass). The critic said the captions sit below the image. Checked: the caption is absolutely positioned inside the image's bottom edge, so it is over the image and this part of the critic's claim is wrong. The critic was right that the descriptions run to two lines.

Builder change for round 6: the three photo-tile descriptions are now one line each.

Round 6, piece 1, brief critic (PASS). Notes: the headline says "servers", with IT named in the lede. The in-hero quote button sits at the fold, so the header button is the fully visible route.

Round 6, piece 1, system critic (PASS). The select chevron is an SVG icon, not a gradient.

Round 6, piece 1, craft critic (FAIL on line 3). Checked and confirmed: the data-centre photo sat in a grid column 27px wide, so the caption fell outside it. Managed IT and Consulting had no photo at all.

Builder changes for round 7: the data-centre tile is now a single column, with its photo full width. The decorative rack drawing was removed, since the photo replaces it. Every service tile has a photo: Security monitoring (existing CCTV image), Managed IT and Consulting (two new images). Two new Higgsfield images cost 0.5 credits. Measured in the browser: all six photos load, and every caption sits inside its image.

Round 7, piece 1, brief critic (PASS). Note: the in-hero quote form sits at the bottom edge of the first screen, so the header button is the fully visible route.

Round 7, piece 1, system critic (PASS). The dark ink values carry a faint green cast of about 20% saturation. The critic treated them as dark ink, not a tint.

Round 7, piece 1, craft critic (FAIL). Disputed by measurement:
- Line 3 (product tiles in the first two sections): the measured order is hero, strip, services, vendors. The services section, with its six photo tiles, is the first section after the strip, so the tiles are in scope. The critic's report describes sections that do not match this order.
- Line 4 (arrows overlap the photo): measured at 1280px, the photo spans y 165 to 370 and the arrows span y 382 to 430. The arrows sit below the photo and inside the viewport, so there is no overlap.
- Line 5 (above-fold whitespace): the critic estimated about 55% against the bar's roughly 40%. This is a sampling estimate, not measured. Not yet resolved.

User decisions: (1) match the bar on whitespace; (2) re-run the craft critic.

Builder change for round 8: photo band height set to clamp(12rem, 20vw, 16rem), so 256px at 1280 wide, up from 208px. Measured at 1280x800: photo y 165 to 421; headline y 662 to 708 (inside the first screen); lede y 734 to 811; quote form y 847 onward (below the fold). The critic's own whitespace estimate is still pending. The brief and system critics were not re-run for this change. Re-run them before counting round 8 as a pass.

Round 8, piece 1, craft critic: lines 1, 2, 4 and 5 YES. Whitespace measured 39.1% on a 10px grid (the reference measured 46.6%). Arrows sit at y 433, below the photo bottom at y 421, inside the viewport. Line 3 NO: the captions are over the images and every photo is at least half its tile's width, but four descriptions wrapped to two or three lines.

Builder change for round 9: shortened the Security, Network, Managed IT and Consulting descriptions. Measured at 1280: all six descriptions are one line.

Round 9, piece 1, brief critic (PASS). Note: the carousel pushes the headline to y=662 and the in-hero quote button to y=847, below the fold. Above the fold, the only quote route is the header button.

Round 9, piece 1, craft critic (PASS, all five lines YES). The photo band is above the headline (y 165 to 421, headline at y 662). Headings are 18 to 25px and body 14 to 16px, in two weights. All six tiles have the caption inside the image, each image is over half its tile's width, and every description is one line (26px tall against a 25.6px line-height). The arrows are paired outlines at y 433, below the photo and inside the viewport. Whitespace measured 37.3% on a 4px grid (the reference measured 15.6%).

Round 9, piece 1, system critic (FAIL). The header phone number on hover and the text cursor used #2E7B0B, a darker green outside the palette.

Builder change for round 10: removed both off-palette text tints (#2E7B0B and #2B6896) from all 13 places. Text and hover states are now ink with a green or blue underline. Focus rings and the text cursor are ink. Icon strokes, the checkbox and the FAQ chevron use the exact #4CBB17 or #5F9BC6. No references remain. DESIGN.md updated.

Round 10, piece 1, brief critic (PASS). The same note as round 9: the headline sits at y=662 under the carousel, and the in-hero quote button is below the fold.

Round 10, piece 1, system critic (FAIL). Hovering a vendor logo removed its grayscale filter, so 22 of the 30 logos showed off-palette brand colours. The critic also flagged two pale tints (used on inner-page bands) and a red form-error border, which the homepage does not render but which break the rule site-wide. It also noted that the shared browser tab kept switching to se.com while the craft critic was running in parallel. All measurements were re-taken after it returned to the preview.

Builder change for round 11: vendor logos stay grayscale on hover (hover only raises opacity). The pale tints are removed; inner-page power, network and band sections are now white with an ink rule. Form errors use a 2px ink border instead of red. DESIGN.md updated.

Round 10, piece 1, craft critic (FAIL on line 3; lines 1, 2, 4 and 5 YES, whitespace 35%). It read each tile's heading, which sat below the photo, as the caption. Round 9's critic had measured the small label over the photo instead. To remove the ambiguity, each tile's heading now is the caption: it sits inside the photo in white, with only the one-line description below. Measured at 1280: on all six tiles the heading box is inside the image box, no heading sits below the image, the image is 86 to 89% of the tile width, and the description is one line.

Round 11, piece 1, brief critic (PASS). Note: the header button is the only quote route on the first screen, and the headline sits at y about 662 under the carousel.

Round 11, piece 1, system critic (PASS). It scanned all 441 stylesheet rules, in every state, as well as 310 rendered elements. No off-palette colour, gradient, radius or non-Source Sans font anywhere. Logos stay grayscale on hover.

Round 11, piece 1, craft critic (PASS, all five lines YES). Photo band above the headline. Type 14 to 16px body and 18 to 25px headings, two weights. All six tiles have the title inside the photo, the photo at 86 to 89% of the tile width, and a one-line description. Paired outline arrows below the photo, inside the first screen. Whitespace 43.5% (the reference measured 14.0%).

PIECE 1 PASSED: brief, system and craft all passed in round 11.

Piece 2 scope change (user approved "what you think is best"): the original pieces 2 and 3 are merged into one piece covering everything below the hero. The craft critic judges only the bar lines that apply below the hero: line 2 (type scale and weights) and line 4 (carousel arrows, used by the industries rail). Line 3 (product tiles) already passed inside piece 1.

Piece 2, round 1, brief critic (PASS on all five). The vendor brands are grouped by layer, the one-supplier reasons are concrete, nine sectors are shown, the quote form has the expected fields, and direct contacts appear next to the form and in the footer. Biggest gap: the form showed buyers a developer note ("Connect this form to ... before launch"), and Company and Phone were optional.

Fixed during round 1: the developer note on the quote and support forms is now an HTML comment, with an empty status line that the script fills on submit. Company and Phone are now required on the quote form.

Piece 2, round 1, craft critic (FAIL on both lines). Line 2: the vendor-wall group headings were 12.48px headings (below the 18px floor), and several labels were 12 to 13px. Line 4: the industries rail's arrows sat above the cards (arrows bottom y 4276, cards top y 4308).

Builder changes for round 2: the vendor-wall group headings are now 18px headings in sentence case. Labels, tags, contact labels, comparison row labels and dates are 14px. The industries arrows moved below the rail. Measured at 1280 below the fold: headings are only 18 and 25px, nothing is under 14px, weights are 400 and 700 only, the arrows sit at y 4618 below the rail's bottom at y 4602, and a Next click scrolls the rail by one card (352px).

Piece 2, round 1, system critic (FAIL). The consent checkbox computed border-radius 0, but Chrome drew the native box with rounded corners. Fix: a custom square checkbox (appearance none, 1.5px ink border, white). When checked it fills with #4CBB17 and shows an ink SVG check mark. Focus ring is ink. Verified: still required, square, and fills #4CBB17 when checked.

Piece 2, round 2, brief critic (PASS on all five). New gap: the Service dropdown defaulted to "UPS solutions" and wasn't required. Fixed: a disabled "Choose a service" placeholder, and the field is now required.

Piece 2, round 2, craft critic (line 4 PASS; line 2 FAIL). Most sizes it reported (12.48px wall headings, 13.12px tags, 12px labels) were fixed and measured before this round, so it most likely read a cached copy of the page in a reused tab. One new valid finding: emphasised non-heading values at 17.6px and 18px (step titles, contact values, strip figures). Fixed: all set to 16px.

Root-cause fix for stale reads: preview/serve.mjs, a no-store static server, replaces python http.server for the preview from round 3 on.

Piece 2, round 2, system critic (PASS). All fonts, corners, gradients, colours (in every state) and filters are clean below the fold. Native controls are either appearance:none or styled so Chrome drops the native look.

Piece 2, round 3, brief critic (PASS on all five). Gap: the lazy-loaded logos had zero width until loaded, so a buyer with slow or blocked images saw empty rows. Fixed: every logo now has width and height attributes (42 logos), so space is reserved and alt text shows if an image fails. This changes only HTML attributes, so the system and craft measurements in flight are unaffected.

Piece 2, round 3, craft critic (PASS on both lines). Line 2: every text element below the fold is 14 to 16px for body or 18 and 25px for headings, with weights 400 and 700 only. Nothing is out of range. Line 4: the industries arrows sit 16px below the card row, inside the viewport.

Piece 2, round 3, system critic (PASS). No violations below the fold in any state. The page was re-measured fresh after another reviewer moved the shared tab.

PIECE 2 PASSED: brief, system and craft all passed in round 3.

LOOP COMPLETE: both pieces passed. Total 14 rounds (piece 1: 11, piece 2: 3). Higgsfield: 9 images, about 2.25 credits.

Open decision (answered above): the craft bar needs photography (image band, image tiles). We have no photos, and generating them uses Higgsfield credits. Also the bar's type scale (headings 18 to 25px) conflicts with the large display headlines in DESIGN.md, which came from the Wise reference.
