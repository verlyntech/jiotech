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
	{ tpl: '404.php', out: '404.html', slug: '404', title: 'Not found' },
];
const slugToFile = Object.fromEntries(pages.map((p) => [p.slug, p.out]));

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

	let html = read(page.tpl).replace(/^<\?php\s*\/\*\*[\s\S]*?\*\/\s*/, '<?php ');
	for (let i = 0; i < 4; i++) for (const [re, fn] of swaps) html = html.replace(re, fn);
	html = html.replace(/<\?php[\s\S]*?\?>/g, '');
	writeFileSync(join(here, page.out), html);
	return page.out;
}

console.log('wrote', pages.filter((p) => existsSync(join(theme, p.tpl))).map(render).join(', '));
