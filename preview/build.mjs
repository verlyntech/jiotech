// Renders the theme's page templates to static HTML in preview/ without PHP.
// Usage: node preview/build.mjs, then serve D:\JIO (python -m http.server 5173) and open /preview/
import { readFileSync, writeFileSync, existsSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const here = dirname(fileURLToPath(import.meta.url));
const theme = join(here, '..', 'jio-theme');
const read = (f) => readFileSync(join(theme, f), 'utf8');

// template -> output file; slug is the WordPress page slug used by home_url()
const pages = [
	{ tpl: 'front-page.php', out: 'index.html', slug: '', title: 'Home', front: true },
	{ tpl: 'page-solutions.php', out: 'solutions.html', slug: 'solutions', title: 'Services' },
	{ tpl: 'page-industries.php', out: 'industries.html', slug: 'industries', title: 'Industries' },
	{ tpl: 'page-about.php', out: 'about.html', slug: 'about', title: 'Company' },
	{ tpl: 'page-contact.php', out: 'contact.html', slug: 'contact', title: 'Contact' },
	{ tpl: 'page-client-support.php', out: 'client-support.html', slug: 'client-support', title: 'Client support' },
	{ tpl: 'page-faq.php', out: 'faq.html', slug: 'faq', title: 'FAQ' },
	{ tpl: 'page-careers.php', out: 'careers.html', slug: 'careers', title: 'Careers' },
	{ tpl: 'page-partnerships.php', out: 'partnerships.html', slug: 'partnerships', title: 'Partnerships' },
	{ tpl: '404.php', out: '404.html', slug: '404', title: 'Not found' },
];

// Service detail pages: same data and markup as inc/service-pages.php, filled here without PHP.
const esc = (v) => String(v).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
const fill = (tpl, data) => tpl
	.replace(/\{\{#(\w+)\}\}([\s\S]*?)\{\{\/\1\}\}/g, (_, key, inner) => (data[key] || [])
		.map((item) => (typeof item === 'object' ? fill(inner, { ...data, ...item }) : inner.replace(/\{\{\.\}\}/g, esc(item)))).join(''))
	.replace(/\{\{(\w+)\}\}/g, (_, key) => esc(data[key] ?? ''));
const services = JSON.parse(read('inc/service-pages.json')).pages;
const serviceFile = (slug) => `service-${slug}.html`;
const serviceTpl = read('parts/service-page.tpl.html');
for (const s of services) {
	const data = {
		...s,
		items: s.items.map((item, i) => ({ ...item, num: String(i + 1).padStart(2, '0') })),
		related: s.related.map((slug) => ({ title: services.find((x) => x.slug === slug).title, url: serviceFile(slug) })),
		solutions_url: 'solutions.html',
		quote_url: 'contact.html#quote',
	};
	pages.push({ html: `<?php get_header(); ?>\n${fill(serviceTpl, data)}\n<?php get_footer(); ?>`, out: serviceFile(s.slug), slug: `solutions/${s.slug}`, title: s.title });
}
const slugToFile = Object.fromEntries(pages.map((p) => [p.slug.replace(/\//g, ''), p.out]));

function render(page) {
	const head = `<script src="../jio-theme/assets/js/theme.js?v=${Date.now()}"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@500;600;700&family=Source+Sans+3:ital,wght@0,400;0,600;0,700;0,900;1,400&display=swap">
<link rel="stylesheet" href="../jio-theme/assets/css/main.css?v=${Date.now()}">
<script src="../jio-theme/assets/js/site.js?v=${Date.now()}" defer></script>
<script src="../jio-theme/assets/js/chat.js?v=${Date.now()}" defer></script>
${page.slug === 'solutions' ? `<link rel="stylesheet" href="../jio-theme/assets/css/services.css?v=${Date.now()}">\n<script src="../jio-theme/assets/js/services.js?v=${Date.now()}" defer></script>` : ''}
<link rel="stylesheet" href="../jio-theme/assets/css/theme.css?v=${Date.now()}">
<title>${page.title} | JIO Technologies (preview)</title>`;

	const swaps = [
		[/<\?php get_header\(\); \?>/g, () => read('header.php')],
		[/<\?php get_footer\(\); \?>/g, () => read('footer.php')],
		[/<\?php get_template_part\( '([^']+)' \); \?>/g, (_, p) => read(p + '.php')],
		[/<\?php wp_head\(\); \?>/g, () => head],
		[/<\?php echo esc_url\( get_template_directory_uri\(\) \); \?>/g, () => '../jio-theme'],
		[/<\?php echo esc_url\( rest_url\( 'jio\/v1\/chat' \) \); \?>/g, () => '/wp-json/jio/v1/chat'],
		[/<\?php jio_head_class\(\); \?>/g, () => (page.front ? ' site-head--over' : '')],
		[/<\?php echo esc_url\( home_url\( '([^']*)' \) \); \?>/g, (_, p) => {
			const [path, hash] = p.split('#');
			const slug = path.replace(/\//g, '');
			return (slugToFile[slug] || '#' + slug) + (hash ? '#' + hash : '');
		}],
		[/<\?php echo esc_html\( gmdate\( 'Y' \) \); \?>/g, () => String(new Date().getFullYear())],
		[/<\?php language_attributes\(\); \?>/g, () => 'lang="en"'],
		[/<\?php bloginfo\( 'charset' \); \?>/g, () => 'UTF-8'],
		[/<\?php body_class\(\); \?>/g, () => (page.front ? 'class="home"' : '')],
		[/<\?php if \( has_custom_logo\(\) \) \{ the_custom_logo\(\); \} else \{ \?>/g, () => ''],
		[/<\?php \} \?>/g, () => ''],
	];

	let html = page.html ?? read(page.tpl).replace(/^<\?php\s*\/\*\*[\s\S]*?\*\/\s*/, '<?php ');
	for (let i = 0; i < 4; i++) for (const [re, fn] of swaps) html = html.replace(re, fn);
	html = html.replace(/<\?php[\s\S]*?\?>/g, '');
	writeFileSync(join(here, page.out), html);
	return page.out;
}

console.log('wrote', pages.filter((p) => p.html || existsSync(join(theme, p.tpl))).map(render).join(', '));
