# Design

The JIO Technologies redesign, built as the WordPress theme in `jio-theme/`. It combines specific features from seven Refero reference styles; it is not a copy of any one of them.

## Where each feature comes from

| Reference | What we took | Where it appears |
|---|---|---|
| **Brex** | Flat surfaces with 1px borders and no shadows; a grey logo band; inner-page heroes split into a large headline on the left and a side column on the right; a dark notice bar | Service tiles and forms; vendor grid (home, About); every inner-page hero; the "We are hiring" bar |
| **Wise** | Segmented pill switcher; sections alternating between paper, pale and dark | Hero layer switcher; support priority selector; Services groups and the home Industries band |
| **Mercury** | Dark full-bleed hero; a header that sits over the hero and turns solid on scroll; email field and button joined in one pill | Home hero, header behaviour, hero quote capture |
| **Authkit** | Circular icon tiles joined by a thin line | The 3-step quote process, and the circular layer symbols joined by a spine in the hero power chain |
| **Apple (iPhone 18 Pro)** | One lit object on a dark stage; 28px dark tiles; a comparison panel; a sticky in-page nav | Power chain set directly on the dark hero (no container); Power tile, Mission/Vision tiles, office card; VRLA vs lithium-ion panel; Services local nav |
| **Ramp** | Dark live strip with small labels and values; hairline grid of grayscale logos | Abu Dhabi clock and support strip; the 30-logo vendor wall grouped by layer (Home) and the partner grid (About). Sources: `jio-theme/assets/logos/SOURCES.md` |
| **teenage engineering** | Catalogue grid ruled with hairlines, 0 radius; product line drawings; left-aligned type | Equipment catalogue (Services); values grid (About); industry and FAQ rows; blog grid |

## Tokens

- **Surfaces:** paper `#f2f0eb`, paper-2 `#e8e5dd`, card `#fbfaf7`; night `#0f1114`, night-2 `#181b20`, night-3 `#22262c`.
- **Text:** ink `#121417`, ink-2 `#383e44`, mute `#596067`; on-night `#ecebe6`, on-night-mute `#9ea4ab`.
- **Accent:** one copper/ember accent, `#c8431a` on light surfaces and `#f0693a` on dark. It is used for actions, the power flow and focus. A green `#7cc79a` is used only for the "support live" dot and the ALLOW lines in the log.
- **Type:**
  - Instrument Serif for display text (headlines, industry names, comparison heads).
  - Plus Jakarta Sans for body and UI.
  - JetBrains Mono only for data: vendor lists, labels, times, phone numbers, logs.
- **Radius:**
  - 0 for catalogue cells, diagram nodes and tables.
  - 4px for inputs.
  - 14px for light tiles and forms, with 8px panels nested inside.
  - 28px for dark stage tiles, with 18px panels nested inside.
  - Pills for buttons, tags and switchers.
- **Depth:** hairlines and changes in surface colour. The only shadow is a soft one under the accent button. There are no gradients, glass effects or blurred orbs.
- **Motion:**
  - A copper current pulse travelling down the power-chain spine.
  - The header turning solid on scroll.
  - State changes on a 0.2–0.45s `cubic-bezier(.16,1,.3,1)` ease.
  - Everything respects `prefers-reduced-motion`.

## Rules

- No labels above headings. Mono uppercase labels mark data only (strip cells, table headers, contact fields).
- One primary accent action per view.
- Every claim on the site must trace to the live site or to PRODUCT.md. Testimonials, ratings, years in business and satisfaction scores stay off until the client confirms them.
