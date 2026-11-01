# Design

The JIO Technologies site, built as the WordPress theme in `jio-theme/`. Rules set by the client, in order of precedence:

1. No terminal-looking (monospace) fonts, anywhere.
2. No rounded corners on buttons, boxes, tags or any other element. Buttons are boxed or transparent.
3. No gradients. The JIO logo keeps its own colour gradient, and is never converted to black and white.
4. Palette: white is the primary colour. Secondaries are green `#4CBB17` and blue `#5F9BC6`.
5. Typeface: Source Sans 3 is the only typeface.

Inspiration comes from seven Refero reference styles. We take layouts and mechanics from them, not their palettes or type.

## Where each reference shows up

| Reference | What we took | Where it appears |
|---|---|---|
| **Brex** | Flat surfaces with 1px borders and no shadows; a logo band; inner-page heroes split into a headline and a side column; a dark notice bar | Service tiles and forms; vendor wall; every inner-page hero; the "We are hiring" bar |
| **Wise** | Heavy display headlines; segmented switchers; sections alternating white, pale green and dark | Hero headline with a green underline; layer and priority switchers; Power tile headline; Services band |
| **Mercury** | Dark full-bleed hero; a header that sits over the hero and turns solid on scroll; email field joined to its button | Home hero; header behaviour; hero quote capture |
| **Authkit** | Circular icon tiles joined by a thin line | The 3-step quote process; the layer symbols on the hero chain |
| **Apple (iPhone 18 Pro)** | One lit object on a dark stage; a comparison panel; a sticky in-page section nav | Power chain on the dark hero; Power tile; "Why one supplier" dark stage; VRLA vs lithium-ion panel; Services section nav |
| **Ramp** | Dark live strip of small labels and values; a hairline grid of logos; a horizontal row of cards with arrow controls | Abu Dhabi clock and support strip; vendor wall; industries rail |
| **teenage engineering** | Ruled catalogue grid with 0 radius; product line drawings; left-aligned lists | Equipment catalogue (Services); values (About); FAQ rows; blog grid |

## Colour

- **White** `#ffffff` is the base for every page. Ink `#0e1512` is the text colour and the colour of rules and boxed controls.
- **Green** `#4CBB17` marks **power and energy**: the Power tile, the UPS and battery layers, power-related tags, the "Power & batteries" logo group and the power sections.
- **Blue** `#5F9BC6` marks **IT and networks**: servers, network and firewall, managed IT and cloud, and the IT logo groups.
- No other greens or blues exist. Because the bright secondaries fail contrast as text on white, text is always ink; green and blue appear as fills, rules, underlines, icon strokes and markers, with ink text on top. Focus rings and the text cursor are ink.
- Dark sections use night `#0e1512` and night-2 `#18211c`. They're used for the hero, the Power tile, the "Why one supplier" stage, the comparison panel and the footer CTA. They are not colour backgrounds.
- Section backgrounds are white or the dark night tones only. There are no pale tints. Vendor logos stay grayscale at rest and on hover, so no third-party brand colour appears. Form errors use a 2px ink border, not red.

## Type

- **Source Sans 3 only**, loaded from Google Fonts at weights 400, 700 and 900.
- **The hero headline is the one exception to the bar.** It's `clamp(2.5rem, 5vw, 4rem)` (64px at 1280 wide, 40px on a phone), weight 900, tracking -0.035em, line-height 0.95. It spans the full content width under the photo carousel, so it sets on two lines on desktop and ends above the fold.
- **Every other heading follows the Schneider Electric bar:** section H2s are 25px and H3s are 18px, both weight 700.
- Body text is 16px at 1.6 line-height. Labels, tags, hints and small print are 14px. Nothing is below 14px.
- Labels are weight 700, uppercase, with 0.08em tracking. They're sans-serif, not monospace.
- Numbers use tabular figures so the strip and tables line up.

## Forms

- Validation is the site's own, not the browser's (`novalidate`). On submit, every invalid field gets a message under it (an ink "!" badge with the text), a 2px ink border and `aria-invalid`. An error summary at the top lists each problem as a link to its field and takes focus. Errors clear as the field is fixed. No red: errors are ink, as the palette allows.
- Messages name the problem and the fix ("Enter a work email address, like name@company.ae").
- Optional fields are marked "optional" in the label. Only what a reply needs is required: name, company, email, the service and consent.
- The quote form takes an optional RFQ or drawings upload (PDF, Word, Excel, DWG, ZIP, up to 10 MB). The file button is square and boxed like every other control.
- The submit label matches the first step of the process ("Request a call and quote"). The line under it says what happens next and how the details are used. A reply-time promise goes there only once the client confirms it.

## Imagery

- The photography is generated, not taken at JIO sites. It's labelled as illustrative wherever it appears: "Illustrative images" beside the carousel controls, and a note under the service tiles. Never caption it as JIO's own infrastructure.
- Replace it with client photography when that exists.

## Shape

- **Every element is square.** `border-radius: 0` is set globally. Buttons, inputs, tags, switchers, cards, tiles, the chain frame and the inspector panel all have square corners.
- Buttons are either **boxed** (solid green with a 1.5px green border, or solid ink), or **transparent** (1.5px ink outline, or an underline link).
- Boxes use a 1px rule or a 1.5px ink border. They don't rely on shadows.
- The only box-shadow is on the floating inspector panel and the mobile menu, to separate them from the page.

## Depth and effects

- Depth comes from hairline rules and from changes in surface colour (white, fog, pale tint, dark).
- No gradients anywhere in CSS or markup. The only gradient is inside the JIO logo file, which is kept as supplied.
- No glass, blur, blurred orbs or noise texture.

## Motion

- A green current pulse travels down the power-chain spine, once every 3.4 seconds.
- The live "support" dot pulses slowly.
- The header turns solid once the dark hero scrolls away (home only).
- The layer switcher dims the layers you aren't looking at, over 0.4s.
- State changes take 0.2 to 0.45s on `cubic-bezier(.16,1,.3,1)`.
- Everything is disabled under `prefers-reduced-motion`.

## Layout

- Maximum content width 1240px, with fluid gutters of 1rem to 3rem.
- Sections have 4 to 7rem of vertical padding. Section heads are two-column: a large headline left, a short note right.
- The home hero is a two-column split. The chain frame bleeds off the right edge of the screen.
- Breakpoints: 1080px (two-column layouts collapse, the menu replaces the nav) and 720px (phone layout).

## Rules

- **No labels above headings.** Small uppercase labels are for data only: strip values, table headers, contact fields, the logo-wall group names.
- **One primary action per view.** On the homepage, that's the green "Get a quote" button.
- **Claims trace to a source.** Every fact comes from the live site or from `PRODUCT.md`. Testimonials, ratings, years in business and satisfaction scores stay out until the client confirms them.
- **The logo is never recoloured.** It keeps its gradient on every background it appears on.
