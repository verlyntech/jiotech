# Elementor rebuild: progress and discrepancies

## Status

**Done and checked against live (23 pages):** Home, About, Careers, Partnerships, FAQ, Contact, Client support, Privacy Policy, Terms & Conditions, Industries, Services overview, and all 12 service pages.

**Can't be built with Elementor Free:** **Blog** and **404**. The post list and 404 page need Elementor Pro's Theme Builder, so they stay on the theme templates. The same applies to the header and footer.

**Switched over (21 Nov 2026):** the 23 Elementor pages are now the live pages at their real addresses (`/`, `/about/`, `/solutions/…` and so on), with the old titles and parent pages. The Elementor Home is the front page, and Privacy Policy is WordPress's privacy page. The 23 old code pages are in **Pages → Trash** (restorable). A full database backup from just before the switch is at `C:\Users\krish\Local Sites\jio\backup-before-elementor-switch.sql`. Checked: every address returns the Elementor version, with dark mode, jump links, logo ribbon and quote form; Blog and 404 still use the theme. The theme's page templates (`front-page.php`, `page-*.php`, `template-service.php`) are no longer used by these pages but are left in place.

**Page speed (`inc/elementor-speed.php`):** Elementor's own Google Fonts are switched off (it loaded five font files, including unused Roboto; the theme already loads the two site fonts), and every Elementor image after the first four loads lazily, so photos in hidden tabs wait until opened. Home went from 78 requests, 1.6 MB of images and a 32-second "load" (held open by the Google map) to 63 requests, 0.77 MB and 2.6 seconds; Services loads in 2.9 seconds and About in 1 second on Local. Local on Windows serves each file slowly (about 1 second per request), so real hosting will be faster.

**Smaller image files:** the 17 PNG logos were cut to at most twice their largest on-screen size (300×80 box) and palette-compressed: 618 KB → 95 KB in total (Huawei 78 KB → 3 KB). The six Home spotlight photos were resized from 1672 to 1380px wide (still twice their largest display size) and re-encoded: 985 KB → 568 KB. Against the originals at display size the logos differ by under 2% on average, mostly on anti-aliased edges. Home now loads in 1.7 seconds on Local with 250 KB of images (was 1.6 MB before any speed work). The originals are in git if ever needed.

**Before moving to a real domain:** Elementor content stores full links such as `http://jio.local/contact/` (inside JSON, written `http:\/\/jio.local`). A normal WordPress search-replace of the domain must also cover that escaped form.

Each page is rebuilt as a separate **draft** Elementor page, so the live code pages stay untouched.
Drafts use the theme's own header and footer (template "Elementor Full Width"), and the theme's images by URL.
Every page is checked against the live code page at desktop (1280px) and phone (390px) width.

## Shared setup (applies to every page)

- **Design tokens:** colours and the two fonts are Elementor global variables (`jio-ink`, `jio-green`, `jio-blue`, `jio-display`, `jio-sans`...).
- **Shared styles:** global classes `jio-section`, `jio-label`, `jio-sec-title`, `jio-h2`, `jio-h3`, `jio-body`, `jio-link`, `jio-btn`, `jio-tag`, `jio-media`, `jio-corner-tl`, `jio-corner-br`, `jio-img-cover`, `jio-tab`.
- **Custom icons:** Elementor can't hold the theme's inline SVG icons, so they are saved as files in `jio-theme/assets/elementor/` and placed as images.

### Discrepancies that apply to every page

| # | Discrepancy | Why | Fixable? |
|---|---|---|---|
| G1 | **Dark mode — fixed.** `inc/elementor-dark.php` reads each Elementor CSS file on the server and prints a dark-mode copy of every colour next to it, using the theme's dark palette, so there is no light flash. `assets/js/elementor-bridge.js` swaps 24 dark-ink icons for their `-dark.svg` versions. `theme.css` sets dark values for Elementor's `jio-` colour variables. Checked on 11 drafts at desktop and on Home at phone width: no light boxes or dark text left. Switching back to light restores the original look. | Elementor stores fixed colour values, so the theme's own variables can't reach them. | Done (theme bridge). |
| G5 | **Jump links and tab links — fixed.** A target carries a marker class `jio-anchor-<name>`; `elementor-bridge.js` scrolls to it, or opens it first if it is a tab. Works for clicks and for addresses like `/industries/#healthcare`, and lands below the sticky header like live. This replaces A1, P1, L1, I2, SO3, SO5, H4 and H7 below. | Elementor sections can't take an HTML id. | Done (theme bridge). |
| G6 | **Tablet width (768–1080px).** Most pages are now within 2% of live at 900px, using the same stacking and the same fluid `clamp()` sizes as live. Desktop is unchanged (within 3px at 1280). Remaining: Services is 3.5% taller (security cards and delivery steps keep desktop spacing). Elementor's tablet breakpoint is 1024px where live uses 1080px, so between 1025 and 1080px the drafts keep the desktop layout. | Elementor has fixed breakpoints. | Mostly done. |
| G2 | **Icons are images, not inline SVG.** They look identical in light mode but can't change colour (hover, dark mode). | Elementor Free can't store custom SVG markup. | Upload as SVG to the Media Library (needs SVG uploads enabled). |
| G3 | **No scroll-reveal animations.** | Elementor's free atomic widgets drop `animation` CSS. | Elementor Pro motion effects. |
| G4 | **Drafts use temporary titles and slugs** such as "About (Elementor)". | So they don't replace the live pages. | Swap when approved. |

## Pages

### 1. About — draft page ID 50 — done

Editor: `http://jio.local/wp-admin/post.php?post=50&action=elementor`
Preview: `http://jio.local/?page_id=50&preview=true` (signed in)

**Matched:** every section and all text, the Beginnings/Mission/Vision tabs (clickable, green underline on the active tab), images with the blue/green corner brackets, the four "How we work" values with their icons, team and culture rows, the 12 partner logos, and the blue "We are hiring" band. Desktop positions are within about 8px of the live page; phone layout total height is within 15px.

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| A1 | **Tab links don't open from the URL.** Live supports `/about/#mission` and `#vision` to open a tab directly. | Behaviour | Elementor tabs ignore the URL hash. |
| A2 | **Team copy spacing** differs by up to 8px (heading to "Our expertise"). | Minor | Live uses a grid gap plus paragraph margins. |
| A3 | **Tab label inset on phone** is 6px further in than live. | Minor | |
| A4 | **Partner logos have no reveal animation.** | Visual | See G3. |
| A5 | Dark mode, icons | | See G1, G2. |

### 2. Careers — draft page ID 91 — done

Editor: `http://jio.local/wp-admin/post.php?post=91&action=elementor`

**Matched:** green hero with breadcrumb, title, lead, intro and the black-box arrow button, the five "Who we hire" cards, the "What you get" image row with benefit tags, the three green-topped steps, and the three "Get to know JIO" link boxes. Every measured element is within 1px of the live page; total page height is identical (2678px).

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| C1 | **Arrow button hover**: live turns the whole button green on hover; the Elementor one does the same, but the arrow box can't be animated. | Minor | |
| C2 | **Breadcrumb isn't marked up as a breadcrumb** for screen readers (`aria-current="page"` is missing). | Accessibility | Elementor can't set ARIA attributes on text widgets. |
| C3 | Dark mode, animations | | See G1, G3. |

### 3. Partnerships — draft page ID 100 — done

Editor: `http://jio.local/wp-admin/post.php?post=100&action=elementor`

**Matched:** green hero with breadcrumb, title, lead and arrow button, the white image placeholder, all 12 brand cards (logo, category, name, description, link), the grey "One plan" steps band, and the "Work with JIO" row with its placeholder and two links. Every measured element sits at the same position as the live page; total height is identical (3590px).

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| P1 | **"Explore our technology brands" doesn't scroll to the brand grid.** | Behaviour | Elementor's atomic containers can't be given an HTML `id`, so the `#technology-partners` anchor has no target. |
| P2 | **Placeholders are still placeholders** (same as live). | Content | Replace with real photos in both versions. |
| P3 | Dark mode | | See G1. |

### 4. FAQ — draft page ID 113 — done

Editor: `http://jio.local/wp-admin/post.php?post=113&action=elementor`

**Matched:** the page heading with the phone/email line, and all 12 questions in two columns using Elementor's accordion (the same native open/close element as live). Questions open independently, and the blue chevron flips when open. Positions and total height are identical to live (1358px with one question open).

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| F1 | **Chevron shape**: live draws a thin 2px chevron; Elementor uses Font Awesome's solid chevron (slightly bolder). | Minor visual | Elementor only rotates its own library icons, not custom images. |
| F2 | **Chevron animation**: live eases the flip over 0.35s; Elementor flips over 0.3s. | Negligible | |
| F3 | Dark mode | | See G1. |

### 5. Contact — draft page ID 125 — done

Editor: `http://jio.local/wp-admin/post.php?post=125&action=elementor`

**Matched:** page heading, the three-step "call → discovery → proposal" strip with its connecting line and coloured icon boxes, the **working quote form**, the direct-contact list (phone, email, WhatsApp, office, support link), and the location card with an embedded Google map (Elementor's own map widget, pointed at the Al Zahiyah address). All positions are within 2px of live.

**How the form works:** Elementor Free has no form widget, so I added a `[jio_quote_form]` shortcode to the theme (`inc/forms.php`). It outputs the site's real form (same email handler, attachment rules, security token and spam trap). WordPress runs shortcodes inside Elementor text widgets, so the page simply contains that shortcode. Checked: the form renders at the same position and width as live, has all 13 service options, and shows the 6 validation errors on an empty submit.

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| CT1 | **The form is edited in the theme, not in Elementor.** Changing a field means editing `parts/quote-form.php`. | Workflow | Same file as the live site, so both stay in sync. |
| CT2 | **Map** uses Elementor's map widget; zoom/pin framing may differ slightly from the live embed. | Minor | |
| CT3 | Dark mode | | See G1. |

Theme change for this page: the footer's "Get a quote" banner is now also hidden on any page containing the form (`body:has(#quote-form)` in `main.css`), because Elementor sections can't carry the `#quote` ID the old rule looked for. Live pages are unaffected.

### 6. Client support — draft page ID 136 — done

Editor: `http://jio.local/wp-admin/post.php?post=136&action=elementor`

**Matched:** page heading and the full support panel: the Normal / High / Urgent selector with its routing text and call buttons, the WhatsApp/email/FAQ list, and the working support form. Column widths are identical to live (472 / 639px). Checked: choosing "Urgent" shows the call-now panel and sets the form's priority to urgent; the security token is present.

**How it works:** the selector and form share a script, so they stay together. I moved that block out of `page-client-support.php` into `parts/support-panel.php` (the live page now includes it from there, unchanged) and added a `[jio_support]` shortcode that the Elementor page uses.

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| CS1 | **Panel and form are edited in the theme**, not in Elementor (`parts/support-panel.php`). | Workflow | Same file as live. |
| CS2 | Dark mode | | See G1. |

### 7. Privacy Policy — draft page ID 160 — done
### 8. Terms & Conditions — draft page ID 164 — done

Editors: `http://jio.local/wp-admin/post.php?post=160&action=elementor` and `...post=164...`

**Matched:** green hero with label, title, intro and date; the sticky "On this page" sidebar with numbered items and the "Need a hand?" box; and all seven numbered sections with their full text and links. Every section sits at the same position and height as live; total heights are identical (Privacy 3381px, Terms 3191px).

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| L1 | **"On this page" items don't jump to their section.** On live they are links to `#information`, `#use` and so on. | Behaviour | Elementor can't give sections an HTML `id`, so I kept them as a plain list rather than links that go nowhere. |
| L2 | **Date isn't machine-readable** (live uses a `<time>` tag). | Negligible | |
| L3 | Dark mode | | See G1. |

### 9. Industries — draft page ID 168 — done

Editor: `http://jio.local/wp-admin/post.php?post=168&action=elementor`

**Matched:** green hero with image and arrow button; the **orbit selector** rebuilt natively with Elementor tabs (nine industry buttons placed around the ring at the same coordinates as live, green/blue accents, the ring with its orbiting green dot, the "Connected expertise" hub and the hint line); the nine detail cards that swap on click (meta line, icon, title, text, link); the dark "Not on the list?" band with the animated network diagram; and the four "Why industry expertise" cards. Every measured element is within 2px of live, the nine buttons land on identical pixels, and total height is identical (2782px). Checked on phone width: ring and buttons stay aligned, no sideways scroll.

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| I1 | **Selected button loses the small accent square** live draws at its top-left corner. | Minor visual | Needs a pseudo-element, which Elementor can't add. |
| I2 | **Industry links don't open from the URL** (`/industries/#healthcare` on live opens Healthcare). Arrow-key navigation is Elementor's own rather than the theme's. | Behaviour | Elementor tabs ignore the URL hash. |
| I3 | **Animations are now inside the SVG files** (orbiting dot, network flow and pulse). They look the same but no longer pause for visitors who turn on "reduce motion". | Accessibility | |
| I4 | **Icons are images**, so icon colours are fixed. | Minor | See G2. |
| I5 | Dark mode | | See G1. |

### 10–21. The 12 service pages — done

| Service | Draft ID | Hero |
|---|---|---|
| Power solutions | 213 | green |
| Data center design & hosting | 217 | green |
| Network & connectivity | 221 | blue |
| Cybersecurity, data protection & CCTV (6 cards) | 225 | blue |
| Managed IT & infrastructure services | 229 | blue |
| Maintenance & 24/7 technical support | 231 | green |
| IT consulting & advisory | 237 | blue |
| Digital transformation | 239 | blue |
| Business process automation | 245 | blue |
| Microsoft 365 & cloud transformation | 247 | blue |
| Identity & access management (IAM) | 249 | blue |
| Endpoint detection & response (EDR) | 251 | blue |

Editor for any of them: `http://jio.local/wp-admin/post.php?post=<ID>&action=elementor`

**How they were built:** every page was generated from the theme's own `inc/service-pages.json`, the same data the live pages use, so the wording can't drift. All styling sits in shared classes, so a design change (for example the card spacing) is made once and applies to all twelve.

**Matched:** breadcrumb, title, lead, intro and arrow button; hero image with corner brackets; the "What's included" cards (4, or 6 for Cybersecurity, in the same 4-column grid with the same borders); the "why" image row with brand tags; the three "How it works" steps; and the three related-service link boxes. Checked by loading each live page and its draft side by side at 1280px: all 12 headings on every page land within 2px of live, and page heights are within 1px.

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| S1 | **Twelve separate pages instead of one template.** Live renders all service pages from one template and the JSON file; in Elementor each page is edited on its own. | Workflow | One shared template would need Elementor Pro's Theme Builder. Shared classes keep the look consistent. |
| S2 | **Breadcrumb isn't marked up as a breadcrumb** for screen readers. | Accessibility | Same as C2. |
| S3 | Dark mode | | See G1. |

**Found while testing:** the IAM and EDR services (added in a recent pull) had no WordPress pages on your Local site, so their live URLs returned "page not found". I created both pages under Services; they now load.

### 22. Services overview — draft page ID 291 — done

Editor: `http://jio.local/wp-admin/post.php?post=291&action=elementor`

**Matched:** green hero with image, corner brackets and arrow button; the "20+ years" intro; the **service map explorer** rebuilt with Elementor tabs (five service buttons at the same spots as live; clicking one swaps the overview card, the highlighted wire and the hub colour, with green for Digital and blue for the rest); the two IAM/EDR cards with blue top rules; the six-item equipment catalogue with its icons; the dark "Expertise beyond implementation" band with three steps; the five "Why JIO" cards; and the closing "Bring your IT & power priorities together" band. At 1280px, every section starts and ends on the same pixel as live and the page height is identical (4257px). At 390px, no sideways scroll and the total height is within 19px of live.

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| SO1 | **Phone spacing differs by about 10px** in the IAM/EDR, delivery and "Why" sections (+10, +10 and −9px). | Minor | Live uses grid gaps plus paragraph margins that Elementor doesn't combine the same way. |
| SO2 | **Map buttons on phone have a fixed width** (112px). On live they size to their text (102–136px). Their centres land on the same spots. | Minor | |
| SO3 | **No direct links to a service, and no scroll on phone.** Live opens a service from the URL (`/solutions/#service-network`), updates the URL on click, and on phone scrolls down to the card after a tap. The draft only swaps the card. | Behaviour | Elementor tabs ignore the URL hash (same as A1). |
| SO4 | **Lists aren't marked up as lists.** The catalogue, steps and cards are plain boxes, where live uses `ul`/`ol`. | Accessibility | Elementor containers can't use list tags. |
| SO5 | **"Explore our services ↓" doesn't scroll to the map.** | Behaviour | Elementor containers can't take an HTML id (same as the anchor note on other pages). |
| SO6 | Dark mode, icons, animations | | See G1–G3. |

**Theme change:** the footer's "Ready to talk" band is hidden on this page like live. A new marker class, `jio-no-foot-cta`, sits on the closing band, and one selector was added to the existing footer rule in `main.css`. Any Elementor page can now hide the footer band by adding that class to a section.

### 23. Home — draft page ID 303 — done

Editor: `http://jio.local/wp-admin/post.php?post=303&action=elementor`

**Matched:**
- the full-screen hero with the image placeholder, headline, both buttons and the 24/7, 30 and 9 stats
- the scrolling manufacturer ribbon
- the six-service spotlight, built with Elementor tabs (photo with corner brackets, 01/06 counter, tags and link; blue accent, green for Power)
- the "Your advantage" comparison
- the industries rail with working arrows and the "1–3 of 9 industries" counter
- the quote area: three steps, the working quote form, the contact list and the map card

The footer's "Ready to talk" band is hidden like live.

At 1280px, every section starts and ends on the same pixel as live, and the page height is identical (4750px). At 390px, every section is also identical (7669px total), with no sideways scroll.

| # | Discrepancy | Size | Notes |
|---|---|---|---|
| H1 | **The manufacturer ribbon is not editable in Elementor.** It is the theme's own logo strip, placed with a `[jio_logo_wall]` shortcode so it keeps its scrolling loop and dark-mode logo swap. To change logos, edit `parts/logo-wall.php`. | Workflow | Elementor Free can't animate a marquee. |
| H2 | **No "Next service →" button** in the spotlight panels. Click a service in the list instead. The row keeps its height, so nothing moves. | Behaviour | Elementor tabs can't be switched from a button inside a panel. |
| H3 | **The selected service's ↗ arrow doesn't turn blue and rotate.** The blue bar and grey background do show. | Minor | Elementor can't style a child based on its tab being selected. |
| H4 | **"Get a quote" jumps to the form itself**, slightly lower than live, which jumps to the top of the quote section. | Minor | Elementor sections can't take an id. The form already has one. |
| H5 | **Industry arrows are text arrows (← →)** rather than the drawn icons, and have no screen-reader names ("Previous industries"). Arrow-key scrolling of the rail isn't available. | Minor / accessibility | Elementor's button can't hold an SVG or ARIA label. |
| H6 | **Hero height uses `100vh`** where live uses `100svh` with a minimum height. On phones whose address bar collapses, the hero can be slightly taller than live. | Minor | |
| H7 | **No direct links to a spotlight service** (`#spotlight-power`). | Behaviour | Same as A1. |
| H8 | Lists not marked up as lists; dark mode; animations | | See SO4, G1, G3. |

**Theme changes for this page (all additive, the live pages are unaffected):**
- `inc/forms.php`: new `[jio_logo_wall]` shortcode.
- `assets/js/site.js`: the industries arrows script also finds the Elementor version through marker classes (`jio-industry-rail`, `-prev`, `-next`, `-position`, `-controls`, and cards `jio-hind-card`).
- `assets/css/main.css`: hides the Elementor rail's scrollbar once the arrows are active, and dims an arrow at the end of the row, like live.
- New icon files in `assets/elementor/`: `hero-placeholder.svg` and `metric-support/brands/sectors.svg`.

**Found while testing:** on phone, the map card's text padding and heading size are slightly smaller on live (20px and 21.6px). Home now matches. The Contact draft uses the same card and may be up to about 30px taller there on phone. I haven't re-checked it.

### Follow-up fixes (after the rebuild)

- **Jump links (G5):** markers added on Home (quote section, six spotlight services), Services (map section, five services), Industries (nine sectors), About (three tabs), Partnerships (brand grid), Privacy and Terms (seven sections each). The Privacy and Terms "On this page" items are now real links. "Get a quote" on Home now goes to the top of the quote section like live, and "Explore our services ↓" on Services now works.
- **Dark mode (G1):** moved from the browser to the server, so pages arrive already dark.
- **Contact on phone:** the map card padding and heading size, and the three steps' vertical layout, now match live. The steps and card heights are identical; the page is 12px shorter overall.
- **Test quote from the new Home page:** sent with test values and arrived in Mailpit with every field correct (subject "Quote request: Power & energy… (Test Co)"). In the preview, the page then returned to Contact instead of Home: the form returns to the page it came from, and preview links are one-time, so this should not happen once Home is live. Re-check after the swap.
- **Tablet (G6):** shared styles stack the hero, "why" row, steps and related links like live; per-page fixes for Home, Contact, Careers, About, FAQ, Industries, Partnerships and Services; live's fluid `clamp()` formulas for headings, section padding and the spotlight.

### Shared-style fixes made along the way

- Section headings are capped at 599px like live, so long ones wrap the same way.
- Hero lead, intro and title widths now match the live caps (544px, 62ch, 18ch).
- Paragraph text in image rows is capped at 493px with 1.65 line height.

All of these are shared classes, so the pages built earlier picked up the fixes automatically. I re-checked Careers afterwards and it still matches exactly.

## Old page templates removed (21 Nov 2026)

With every page now on Elementor, the code-built page templates were deleted from the theme: `front-page.php`, the eleven `page-*.php` files, `template-service.php`, `inc/service-pages.php` and `.json`, `parts/service-page.tpl.html`, `parts/steps.php`, `direct.php`, `location.php`, `partner-logos.php`, and `assets/css/services.css` / `assets/js/services.js`. The static preview built from them (`preview/`, the root `serve.mjs` and `index.html`, `tests/preview-routes.test.mjs` and `.claude/launch.json`) went with them. They remain in git history.

Kept: `header.php`, `footer.php`, `page.php`, `index.php`, `home.php`, `single.php`, `404.php` (blog, 404 and fallback), and the three parts behind the shortcodes (`quote-form`, `support-panel`, `logo-wall`). Checked: all 23 Elementor pages, the blog and the 404 still load without PHP errors.

## SEO without Rank Math (22 Nov 2026)

Rank Math, Site Kit and Cloudflare were removed. Rank Math had only its defaults (no per-page titles or descriptions), so `inc/seo.php` now covers what it did: a meta description per page (taken from the page's Excerpt box, editable in WP Admin), Open Graph and Twitter tags with `assets/img/og-default.jpg` (1200×630) as the sharing image, LocalBusiness and WebSite details for Google on the homepage, and a WordPress sitemap at `/wp-sitemap.xml` without the user accounts list. Titles and canonical links come from WordPress: site title "JIO Technologies", tagline "IT and power solutions in Abu Dhabi and Dubai". After moving to the real domain, submit `/wp-sitemap.xml` in Google Search Console.

## Full site test against the old code-built pages (22 Nov 2026)

Compared with the old pages (`preview/*.html` at commit 5dab9ff) and tested in the browser:
- Content: every page's text matches the old page word for word; all 23 pages, the blog and 404 load with no PHP or console errors; 135 internal links and images resolve.
- Forms: Home quote form and the support form (Urgent) both deliver to sales@jiotechuae.com (Mailpit) and show their thank-you message; empty submits show the validation errors.
- Interactions: Home spotlight tabs (mouse and keyboard), industries carousel arrows, logo ribbon, Client support priority selector, FAQ accordion, dark-mode toggle and saved choice, phone menu, chatbot reply through the WordPress endpoint.
- All 23 pages at 375px in dark mode: no sideways scroll, no white panels or dark text, dark icons loaded.
- Fixed: "Skip to content" (`#main`) had no target on Elementor pages, so the Elementor content is now wrapped in `<main id="main">` (`inc/elementor-speed.php`); `/solutions/#equipment` (menu and footer "Equipment supply") and `/contact/#quote` (the chatbot's quote link) had no anchors, so the catalogue and Contact quote section now carry `jio-anchor-equipment` / `jio-anchor-quote`; four service page titles restored to their old names.

## Home hero redesign (22 Nov 2026)

The hero now follows the supplied mockup: the server and UPS room photo on the right with a curved green edge, outline hexagons and green waves, the headline with "power behind it." in green and a short green rule, white buttons with a dark green arrow box, and the three stats with dividers. The photo, curves and hexagons are one background image, `assets/img/home-hero.webp` (1836×684, 81 KB), cut from the mockup with its text and the chat button removed. It is anchored to the left so the text side is never cropped. The headline, buttons and stats are live Elementor widgets on top (`jio-hero-title` marks the headline for the green words in `main.css`). Desktop height is `max(34rem, 37.25vw)`, the image's own proportions. At tablet and phone widths the photo moves below the text (380px / 240px tall). In dark mode the image is dimmed (`main.css`) and the pale green maps to the dark surface (`inc/elementor-dark.php`). Checked at 1280–2560px: the text stays at least 94px clear of the photo. The image is only as sharp as the mockup; replace it with the original artwork at 2× (about 3700px wide) when available.
Follow-up: the hero is now capped so the logo ribbon shows on the first screen: `min-height: clamp(28rem, calc(100vh - 161px), 37.25vw)` (161px = header + ribbon), with vertical spacing that shrinks on short windows. Checked from 1280×620 to 2560×1300: logos fully visible every time, text still at least 81px clear of the photo.
Follow-up: the hero background is now the supplied office photo, `assets/img/home-hero-office.webp` (1916×821, 74 KB), replacing the server-room composite (deleted). The text sits on the plain wall on the left; checked from 1280×620 to 2560×1300 it stays at least 118px clear of the glass partition, and the logos still show on the first screen. The desktop height cap is now 42.85vw, the photo's own proportions.
Follow-up: the mockup's design is back around the office photo. `assets/img/home-hero-v2.webp` (1836×684, 65 KB) layers the pale green side, curved green edge, hexagons, bottom waves and dark green corner from the mockup over the office photo (the plain office image was removed). Desktop height cap back to 37.25vw. Checked 1280×620 to 2560×1300: text at least 63px clear of the curve, logos visible on the first screen.
Follow-up: hero background replaced by the user's blended office mockup. `assets/img/home-hero-v3.webp` (1836×685, 71 KB) is that mockup's hero area with its text, buttons, stats and the chat button inpainted out (OpenCV); `home-hero-v2.webp` removed. The live buttons are unchanged (white "Get a quote" with the dark green arrow box). Checked 1280×620 to 2560×1300: logos visible on the first screen; the stats sit on the pale side or the white wall, clear of the green curve.
Follow-up: dark mode no longer just dims the hero. `assets/img/home-hero-v3-dark.webp` (67 KB) is a dark version of the art: the pale side and the white wall become a dark charcoal-green panel, the green curve, waves and corner keep their colour, the hexagons are redrawn as green outlines, and the office photo stays lit (86% brightness). `main.css` shows it as the background of the `jio-hero-bg` wrapper in dark mode (and hides the light `<img>`), so there is no flash of the light image and it works in every browser; it is only downloaded in dark mode.
Follow-up: the dark hero now follows the user's dark mockup. `assets/img/home-hero-v4-dark.webp` (since replaced by v5) was that mockup's hero with its text, buttons and stats inpainted out and the text areas smoothed; v3-dark removed. In dark mode the hero's "Get a quote" arrow box turns brand green (#044715 → #4cbb17 in `inc/elementor-dark.php`). The dark-CSS cache key now includes the colour map, so map edits apply without waiting for Elementor to regenerate its CSS.
Follow-up: the first dark mockup was framed differently (zoomed in about 7%, cropped tighter), so the photo and corner jumped when switching modes. `assets/img/home-hero-v5-dark.webp` is the user's re-made dark version with the light image's framing, cleaned and resized to exactly 1836×685 like `home-hero-v3.webp`; the camera dome lines up within 2px between the two. v4-dark removed.
Fix: the spotlight's "01 / 06" counter was stretched across the whole photo (it inherited Elementor's 100% container width plus a stray left offset). The `jio-spot-count` class now has `width: auto; inset-inline-start: auto` and a 5px gap, so it is a small badge in the top-right corner like the old site (`top: 1.1rem; right: 1.15rem`). Checked at 1536, 1130 and 375px: 60×28px, 18px from the top and right edges.
Fix: switching between light and dark mode no longer shifts the hero. Nothing in the layout moved; the two images were offset by about 5px horizontally and 2px vertically. The dark image was registered to the light one with feature matching (OpenCV SIFT, 802 matches) and re-saved as `assets/img/home-hero-v6-dark.webp` (v5 removed); the remaining offset is under 0.2px, and the green curve and corner now line up within 2–3px. `elementor-bridge.js` also fetches the dark image after the page loads (its URL is the `--jio-hero-dark` variable in `main.css`), so the first switch to dark mode doesn't blink.
Fix: the Services hero photo's corner brackets hugged the photo edge (56px, 2px, at -1px) and were lost against it. The old page used the photo variant, so they now match every other photo: 48px, 2.4px, set 9.6px outside (blue top left, green bottom right). Checked all 64 photo brackets on 21 pages: all sit 9.6px outside their photo.

## Merge with main (22 Nov 2026)

`main` had moved on with four commits made against the old code site. Merged as follows:
- Chatbot moved to Groq (99db60b): kept. Its website context read the PHP page templates and `inc/service-pages.json`, which no longer exist, so `inc/chat-security.php` now reads the published pages instead (`jio_chat_page_chunks()`: Elementor-rendered text, cached per page until it is saved) and `chat-config.json` lists no template sources. Its Node copy for the static preview (`preview/serve.mjs`, `preview/chat.mjs`) and the tests that ran against it (`tests/backend.test.mjs`) were removed; `CHAT_SETUP.md` now describes testing on Local. Its Privacy Policy change (Groq instead of OpenRouter, updated 17 November 2026) was copied into the Elementor Privacy page.
- Company copy (a384f51): the Beginnings, Mission and Vision paragraphs and the culture text were copied into the Elementor Company page.
- Logo ribbon spacing, Brother crop and VMware grey (a384f51, 44ceadf): kept; they style the theme's logo ribbon.
- Homepage hero photo, service hub and hero alignment (a384f51, 44ceadf, 0be6fd8): not used; the Elementor homepage keeps the office hero. Their template and images were removed; their CSS only targets the removed templates.

## Chatbot request size (22 Nov 2026)

Groq's free tier gives each model 8,000 tokens a minute and 200,000 a day (confirmed from Groq's rate-limit headers for this key). A question used about 5,500 tokens, so a second quick question hit HTTP 429 on all three models. The prompt now sends two page excerpts of up to 1,100 characters (was four of 2,200) and only the name and one-line summary of each service: about 3,600 tokens a question (measured), roughly two per minute per model. No further Groq models could be added: this key's only other text models are `gpt-oss-safeguard-20b` (2,000 tokens a minute, smaller than one request) and `allam-2-7b` (403). Checked: four questions back to back all answered; one 429 was absorbed by the failover; IAM, UPS, server room and CCTV answers match the pages.
