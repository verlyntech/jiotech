# JIO Technologies website

WordPress theme and a dependency-free local preview for the JIO Technologies LLC website.

## Current website

- **Home:** responsive storefront hero, a six-service spotlight with selectable overviews, six service illustrations and keyboard navigation, a continuous horizontal manufacturer ribbon below the compact hero (familiar brands first, full-colour logos visible on the first screen and reduced-motion support), and a horizontal industry carousel with previous/next arrows and green corner markers.
- **Services:** a connected diagram for five service areas, with animated icons, a concise overview on the left, keyboard selection and enquiry links. A pale green map canvas with white animated connectors over green tracks joins fully bordered service boxes: white in light mode and charcoal in dark mode, with colour accents identifying the selected service. The equipment catalogue remains below.
- **Company:** the Three perspectives design: selectable Beginnings, Mission and Vision tabs, matching illustrations (including JIO TECH signage in Mission), keyboard navigation and direct chapter links, plus icons for the existing company values.
- **Industries:** nine static industry icons arranged around a circular selector, with the selected sector's overview, capabilities and enquiry link in a larger adjacent panel. Supports keyboard selection and direct sector links.
- **Contact and legal:** the homepage enquiry sidebar and Contact page share an Abu Dhabi location card, directions and a Google map that loads only on request. Privacy Policy and Terms & Conditions have dedicated pages, section links and matching light/dark layouts.
- **Shared header:** responsive logo with a gently floating shield and static wordmark, navigation and a keyboard-accessible dark-mode toggle. The hiring announcement banner has been removed.

The design uses white, green (`#4CBB17`), blue (`#5F9BC6`) and dark ink, with square corners, IBM Plex Sans headings and Source Sans 3 body text. See [DESIGN.md](DESIGN.md) and [PRODUCT.md](PRODUCT.md) for the project context.

Shared responsive spacing keeps sections and cards compact across pages. The industry icons remain static; connected infrastructure pulses elsewhere pause off screen and respect reduced-motion preferences.

Dark mode follows the device colour preference until a visitor uses the header toggle. The explicit choice is saved in the browser and shared across pages and tabs. If browser storage is unavailable, the toggle still works for the current page. Neutral charcoal surfaces, lighter cards and soft white text preserve the content hierarchy; green and blue remain accents on controls, headings and rules. Logos retain their supplied colours on light backings in dark mode.

## Local preview

Requires Node.js 18 or newer. Run these commands from the repository root:

```sh
node preview/build.mjs
node preview/serve.mjs
```

Open [http://localhost:5173/preview/](http://localhost:5173/preview/). To choose another port, run `node preview/serve.mjs 5174` instead.

After editing a template, stylesheet or script, rerun the build command and refresh the browser. The preview renders the PHP templates into HTML without running WordPress. Forms in this static preview are not connected to production submission handlers.

## Project structure

| Path | Purpose |
| --- | --- |
| `jio-theme/` | WordPress theme to install and activate. |
| `jio-theme/front-page.php` | Homepage content and infrastructure/industry cards. |
| `jio-theme/page-solutions.php` | Services introduction, five service areas and equipment catalogue. |
| `jio-theme/page-about.php` | Company page. |
| `jio-theme/page-industries.php` | Industries page. |
| `jio-theme/header.php`, `footer.php` | Shared navigation and footer. |
| `jio-theme/assets/css/main.css` | Shared styles and responsive layouts. |
| `jio-theme/assets/css/services.css` | Services page styling. |
| `jio-theme/assets/js/site.js` | Infrastructure interactions, industry arrows and shared page behaviour. |
| `jio-theme/assets/js/services.js` | Connected service selection, overview panels, keyboard controls and deep links. |
| `jio-theme/assets/js/theme.js`, `assets/css/theme.css` | Early theme selection, saved preference, header toggle and dark palette. |
| `jio-theme/assets/img/` | Logo and website image assets. |
| `preview/build.mjs` | Generates the website and legal preview HTML pages. |
| `preview/serve.mjs` | Local preview server. |

## WordPress installation

1. Copy `jio-theme` into the WordPress installation’s `wp-content/themes/` directory.
2. Activate **JIO Technologies** in Appearance → Themes.
3. Use the page slugs `solutions`, `about`, `industries`, `contact`, `client-support`, `faq`, `privacy-policy` and `terms-conditions` so WordPress selects the corresponding templates.
4. Configure the site’s homepage and verify navigation, contact forms and support integrations in WordPress before deployment.

The static preview does not replace testing in a WordPress/PHP environment.

## Content and images

All displayed website photographs and illustrations are people-free. The homepage spotlight uses six service illustrations, including an equipment-only power room and an empty cloud planning workspace. The Services hero uses a generated illustration of integrated IT and power equipment. Industries uses an empty IT operations workspace. Company perspectives show an engineering workshop, an equipment preparation room and a technology campus, with JIO TECH signage preserved in the Mission image. The remaining 22 media frames across the eight service detail pages, Company, Careers and Partnerships each use a different people-free illustration. The set varies equipment close-ups, energy installations, technical planning, automated facilities and workplace architecture. Images are optimised WebP assets with descriptive alternative text and stable responsive frames. Service image files and dimensions are defined in `inc/service-pages.json` and rendered consistently in WordPress and the static preview.

Update the source templates rather than editing generated files in `preview/`. Rebuild the preview after every content change. Vendor logos retain their supplied colours.

## Checks

```sh
node --check jio-theme/assets/js/site.js
node --check jio-theme/assets/js/services.js
node --check preview/build.mjs
node preview/build.mjs
node --test --test-isolation=none tests/preview-routes.test.mjs
git diff --check
```

For UI review, check phone, tablet and desktop widths; the header logo; the manufacturer ribbon on initial load; all nine industry cards through the arrow controls; and the links to all five service areas.

## Secrets and backend configuration

Keep API credentials in server-side configuration and out of templates, browser scripts, screenshots and commits. `.env` files are ignored by Git. The preview server is for development review; production should run through the WordPress installation. Chatbot configuration is separate from the website layout changes.

## Final contact and legal pages

`parts/location.php` is shared by Home and Contact. Address and directions are taken from the company's live Contact page at https://jiotechuae.com/contact/. Google Maps stays unloaded until the visitor chooses it; the directions link works without JavaScript. The same directions destination appears in the footer and contact details.

Privacy and terms content lives in `page-privacy-policy.php` and `page-terms-conditions.php`. Create or retain published WordPress pages with those exact slugs and verify the footer and form consent links after deployment. Review these initial policy texts against actual business retention, hosting and supplier arrangements before publication; they are website copy, not a legal compliance certification.

The chatbot front end, WordPress backend and knowledge content use the GitHub version. The preview retains that dialogue engine with a public-file allowlist and a loopback-only listener; local chatbot rewrite files are unused. Credentials remain server-side and ignored by Git.

The privacy-rights wording was checked against the UAE Government’s overview: https://u.ae/en/about-the-uae/digital-uae/data/data-protection-laws. Review applicable legal requirements and the company’s actual practices before publishing.
