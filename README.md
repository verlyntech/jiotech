# JIO Technologies website

WordPress theme for the JIO Technologies LLC website. The pages themselves are built in Elementor; see [ELEMENTOR-REBUILD.md](ELEMENTOR-REBUILD.md).

## Current website

- **Home:** a realistic, people-free AI-generated IT workspace photograph representing all six services, as a full-width green-shaded hero background with existing enquiry links and statistics, a six-service spotlight with selectable overviews, six service illustrations and keyboard navigation, a continuous horizontal manufacturer ribbon below the compact hero (familiar brands first, full-colour logos visible on the first screen and reduced-motion support), and a horizontal industry carousel with previous/next arrows and green corner markers.
- **Services:** a connected diagram for five service areas, with animated icons, a concise overview on the left, keyboard selection and enquiry links. A pale green map canvas with white animated connectors over green tracks joins fully bordered service boxes: white in light mode and charcoal in dark mode, with colour accents identifying the selected service. The equipment catalogue remains below.
- **Company:** the Three perspectives design: selectable Beginnings, Mission and Vision tabs, matching people-free, unbranded illustrations and an additional supporting sentence in each chapter, keyboard navigation and direct chapter links, plus icons for the existing company values.
- **Industries:** nine static industry icons arranged around a circular selector, with the selected sector's overview, capabilities and enquiry link in a larger adjacent panel. Supports keyboard selection and direct sector links.
- **Contact and legal:** the homepage enquiry sidebar and Contact page share an Abu Dhabi location card, directions and a lazy-loaded Google map. Privacy Policy and Terms & Conditions have dedicated pages, section links and matching light/dark layouts.
- **Shared header:** responsive logo with a gently floating shield and static wordmark, navigation and a keyboard-accessible dark-mode toggle. The hiring announcement banner has been removed.

The design uses white, green (`#4CBB17`), blue (`#5F9BC6`) and dark ink, with square corners, IBM Plex Sans headings and Source Sans 3 body text. See [DESIGN.md](DESIGN.md) and [PRODUCT.md](PRODUCT.md) for the project context.

Shared responsive spacing keeps sections and cards compact across pages. The industry icons remain static; connected infrastructure pulses elsewhere pause off screen and respect reduced-motion preferences.

Dark mode follows the device colour preference until a visitor uses the header toggle. The explicit choice is saved in the browser and shared across pages and tabs. If browser storage is unavailable, the toggle still works for the current page. Neutral charcoal surfaces, lighter cards and soft white text preserve the content hierarchy; green and blue remain accents on controls, headings and rules. Logos retain their supplied colours on light backings in dark mode.

## Local site

The site runs in Local at http://jio.local. There is no separate static preview of the pages: the old code-built page templates and the preview built from them were removed once every page had been rebuilt in Elementor.

## Project structure

| Path | Purpose |
| --- | --- |
| `jio-theme/` | WordPress theme to install and activate. |
| `jio-theme/header.php`, `footer.php` | Shared navigation and footer, used around the Elementor pages. |
| `jio-theme/page.php`, `index.php`, `home.php`, `single.php`, `404.php` | Fallback page, blog and 404 templates (not built in Elementor). |
| `jio-theme/inc/forms.php` | Quote and support forms, plus the `[jio_quote_form]`, `[jio_support]` and `[jio_logo_wall]` shortcodes used in Elementor. |
| `jio-theme/inc/elementor-dark.php`, `inc/elementor-speed.php` | Dark mode and page speed for the Elementor pages. |
| `jio-theme/parts/` | The quote form, support panel and logo wall behind those shortcodes. |
| `jio-theme/assets/css/main.css` | Shared styles and responsive layouts. |
| `jio-theme/assets/js/site.js` | Industry arrows, logo ribbon and shared page behaviour. |
| `jio-theme/assets/js/elementor-bridge.js` | Jump links and dark-mode icons on the Elementor pages. |
| `jio-theme/assets/js/theme.js`, `assets/css/theme.css` | Early theme selection, saved preference, header toggle and dark palette. |
| `jio-theme/assets/img/`, `assets/elementor/` | Logo, photos and the icons used on the Elementor pages. |

## WordPress installation

1. Copy `jio-theme` into the WordPress installation’s `wp-content/themes/` directory.
2. Install Elementor and activate **JIO Technologies** in Appearance → Themes.
3. Move the pages across with the database (see the domain note in ELEMENTOR-REBUILD.md), and set Home as the homepage.
4. Verify navigation, contact forms and support integrations in WordPress before deployment.

## Content and images

All displayed website photographs and illustrations are people-free. The homepage spotlight uses six service illustrations, including an equipment-only power room and an empty cloud planning workspace. The Services hero uses a generated illustration of integrated IT and power equipment. Industries uses an empty IT operations workspace. Company perspectives show an engineering workshop, an equipment preparation room and a technology campus, with an unbranded Mission office image. The remaining 22 media frames across the eight service detail pages, Company, Careers and Partnerships each use a different people-free illustration. The set varies equipment close-ups, energy installations, technical planning, automated facilities and workplace architecture. Images are optimised WebP assets with descriptive alternative text and stable responsive frames. Page content and images are edited in Elementor. Vendor logos retain their supplied colours.

## Checks

```sh
node --check jio-theme/assets/js/site.js
node --check jio-theme/assets/js/elementor-bridge.js
git diff --check
```

For UI review, check phone, tablet and desktop widths; the header logo; the manufacturer ribbon on initial load; all nine industry cards through the arrow controls; and the links to all five service areas.

## Secrets and backend configuration

Keep API credentials in server-side configuration and out of templates, browser scripts, screenshots and commits. `.env` files are ignored by Git. Chatbot configuration is separate from the website layout changes.

## Final contact and legal pages

Home and Contact share the Abu Dhabi location card. The office address is Abdullah Bin Darwish Building, Office No. 304, Sheikh Zayed Bin Sultan St, Al Zahiyah, E15, Abu Dhabi. The embedded map and directions link use the same address. The same directions destination appears in the footer and contact details.

Privacy and terms content lives in the Elementor pages with the slugs `privacy-policy` and `terms-conditions`. Verify the footer and form consent links after deployment. Review these initial policy texts against actual business retention, hosting and supplier arrangements before publication; they are website copy, not a legal compliance certification.

The chatbot retains its intent router, quick replies, navigation and quote/form flow, with Groq providing model answers through a backend-only proxy. Current public website excerpts ground replies; shared refusal rules, strict structured output and validated links protect the dialogue. `GROQ_API_KEY` stays private and ignored by Git. See `CHAT_SETUP.md` for WordPress deployment and validation.

The privacy-rights wording was checked against the UAE Government’s overview: https://u.ae/en/about-the-uae/digital-uae/data/data-protection-laws. Review applicable legal requirements and the company’s actual practices before publishing.

## Source repository

The active repository is https://github.com/verlyntech/jiotech. Use `git pull --ff-only origin main` before starting work and `git push origin main` to publish reviewed commits. The former repository is retained locally as `legacy-origin`; it is not the default push destination.

## Homepage positioning and Mission image

The homepage comparison describes AI-ready infrastructure, cybersecurity, business process automation and managed IT, with links to the relevant service pages. Its manufacturer ribbon excludes Hikvision and the battery brands Amaron and SacredSun, retains the other original supplied brand marks, and uses an equal edge-to-edge gap between naturally sized logos, including the looping seam. Brother is displayed as a cropped wordmark without its tagline. The footer service list starts with Digital transformation. The homepage uses `parts/home-service-hub.php` for one responsive AI-generated photograph of a natural IT solutions office. Network equipment, security monitoring, cloud planning, server racks, a support workstation and UPS cabinets represent the six services without logos, people, service labels or infographic elements. Optimised panoramic WebP sizes fill the hero at every breakpoint, with green shading behind the page copy. The hero reserves the manufacturer ribbon height, so its moving logos are visible directly below the background on the initial screen.

The Mission tab uses `assets/img/company-mission-office-unbranded.webp`, a 1402 × 1122 office illustration with the wall logo removed. The Services hero similarly uses `assets/img/services-hero-infrastructure-unbranded.webp` without the wall sign. Both were edited using the built-in image generator; original images and edit prompts are retained locally in `output/imagegen/unbranded-scenes/`. These are illustrations, not photographs of actual JIO premises.

## Partnerships, identity security and power positioning

The Partnerships page is available from both Company menus and includes 12 named technology brands with logos, practical integration roles and relevant service links. It uses styled image spaces for future partnership and project photographs. It does not assert certification levels or manufacturer authorisation tiers.

IAM and EDR are separate service pages under `solutions` (slugs `identity-access-management` and `endpoint-detection-response`), linked from navigation, the Services page and the cybersecurity page. IAM and EDR each use two distinct, people-free illustrations. Optional media blocks show styled placeholders when a service has no supplied image. The website quote form includes both new services. Its server allowlist is maintained in `inc/quote-form-options.json`; the Power choice retains its legacy submitted value so existing assistant prefills keep working.

Visible positioning now uses IT and power. Renewable-energy offerings and solar imagery have been removed from the rendered site, including the Power page, homepage power media and Company Vision image. The original `/solutions/power-energy-solutions/` URL and the Industries `#energy` fragment are preserved for existing links. The BPC Energy brand retains its actual name. The earlier website commit retained the GitHub chatbot. The subsequent Groq integration uses the current catalogues and preserves its existing visitor flows; secrets remain excluded from Git.

Current optimised replacement assets are stored in `jio-theme/assets/img/`: `company-mission-office-unbranded.webp`, `services-hero-infrastructure-unbranded.webp`, `company-vision-campus-v2.webp`, `service-power-backup-v2.webp`, `home-service-power-v2.webp`, `service-consulting-power-v2.webp`, `service-consulting-planning-v2.webp`, `careers-learning-lab-power-v2.webp`, and the four `service-iam-*` / `service-edr-*` images. They were generated or edited with the built-in image generator; original PNGs and prompts are retained locally in the corresponding `output/imagegen/` folders. They are illustrations rather than photographs of JIO premises or completed projects.

IAM and EDR terminology and capabilities were checked against Microsoft documentation:
- https://learn.microsoft.com/entra/fundamentals/introduction-identity-access-management
- https://learn.microsoft.com/en-us/entra/fundamentals/entra-admin-center
- https://learn.microsoft.com/microsoft-365/security/defender-endpoint/overview-endpoint-detection-response
- https://learn.microsoft.com/en-us/defender-endpoint
