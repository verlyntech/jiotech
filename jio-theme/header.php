<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to content</a>
<header class="site-head" data-head>
	<div class="wrap wrap--wide site-head__row">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="JIO Technologies, home">
			<span class="brand__art">
				<span class="brand__words">
					<img class="brand__logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo.webp" width="1282" height="262" alt="" aria-hidden="true">
					<img class="brand__logo brand__logo--dark" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-dark.webp" width="1282" height="262" alt="" aria-hidden="true">
				</span>
				<span class="brand__mark">
					<img class="brand__logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo.webp" width="1282" height="262" alt="JIO Technologies">
					<img class="brand__logo brand__logo--dark" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo-dark.webp" width="1282" height="262" alt="JIO Technologies">
					<svg class="brand__trace" viewBox="0 0 1282 262" aria-hidden="true" focusable="false"><path pathLength="1" d="M179.5 260.5L180.2 261.8L182 261.8L183.2 260.8L190.5 260L201.2 256.8L210.5 252.2L219.2 246.2L228.8 236.8L234.8 228L238.5 220.2L242.5 204.8L243 70.5L243.8 69.8L260.5 68.8L268.8 66.8L280.5 61.8L292.2 53.5L300 45.2L307.5 33.2L311.5 21L312.5 8.2L311.8 7.5L152 7.8L143.2 9L133.2 12L125.2 15.8L116.5 21.2L107.2 29.8L99.8 39.8L95.2 49L92 60.5L91.5 180L89 189.2L86 193.8L80.5 198.2L75.5 200L68.5 200L62.2 197.2L59 193.5L57 188L55.8 187.5L0 187.8L0 193.5L1 195.2L3.8 209.2L7 217.8L13.8 229.2L25.2 242L39 251.5L51.8 257.2L65 260.5L67.8 260L69.8 261.8L71.5 261.8L72.5 260.8L81.8 260.8L83.2 261.8L85.8 261.8L88 260L90.5 260.5L92.2 259.5L96 259.5L98 258.2L105 256.8L117.5 250.8L131 240.8L138.2 233L144.8 223.8L150.8 210.8L154 197.5L154.8 99L156 92.8L160 84.8L165.2 79L170 75.5L178.8 72L179.5 72.8Z"/></svg>
				</span>
			</span>
		</a>
		<nav class="nav" aria-label="Primary">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<div class="nav__item" data-mega>
				<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Services</a>
				<button class="nav__toggle" type="button" aria-expanded="false" aria-controls="mega-services" aria-label="Show services" data-mega-toggle hidden><svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2 4.5l4 4 4-4"/></svg></button>
				<div class="mega" id="mega-services" data-mega-panel hidden>
					<div class="wrap wrap--wide mega__grid">
						<div class="mega__group mega__group--it">
							<p class="mega__label">IT</p>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/managed-services/' ) ); ?>"><span>Managed IT &amp; infrastructure</span><small>Monitoring, support and optimisation</small></a>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/network-connectivity-solutions/' ) ); ?>"><span>Network &amp; connectivity</span><small>LAN, WAN, Wi-Fi and structured cabling</small></a>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/cyber-security/' ) ); ?>"><span>Cybersecurity &amp; CCTV</span><small>Network, cloud and physical security</small></a>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/it-consulting-advisory/' ) ); ?>"><span>IT consulting &amp; advisory</span><small>Strategy, roadmaps and governance</small></a>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/digital-transformation/' ) ); ?>"><span>Digital transformation</span><small>Modernise legacy systems and connect data</small></a>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/business-process-automation/' ) ); ?>"><span>Business process automation</span><small>Workflows, approvals and reports with Microsoft 365</small></a>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/cloud-saas-transformation/' ) ); ?>"><span>Microsoft 365 &amp; cloud</span><small>Move email, files and teams to Microsoft 365</small></a>
						</div>
						<div class="mega__group mega__group--power">
							<p class="mega__label">Power</p>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/power-energy-solutions/' ) ); ?>"><span>Power &amp; energy</span><small>UPS, batteries, renewables and power distribution</small></a>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/web-development/' ) ); ?>"><span>Data center design &amp; hosting</span><small>From a single rack to an enterprise hall</small></a>
							<a class="mega__link" href="<?php echo esc_url( home_url( '/solutions/maintenance-technical-support/' ) ); ?>"><span>Maintenance &amp; 24/7 support</span><small>Preventive maintenance, remote and on-site help</small></a>
						</div>
						<div class="mega__aside">
							<p class="mega__label">Something down?</p>
							<p class="mega__aside-title">24/7 technical support</p>
							<a class="mega__phone" href="tel:+971553440144">+971 55 344 0144</a>
							<a class="mega__aside-link" href="<?php echo esc_url( home_url( '/client-support/' ) ); ?>">Client support</a>
							<a class="btn-arrow btn-arrow--sm" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Get a quote</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
						</div>
						<div class="mega__foot">
							<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">All services <span aria-hidden="true">&#8599;</span></a>
							<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>#equipment">Equipment supply <span aria-hidden="true">&#8599;</span></a>
							<a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>">Industries we serve <span aria-hidden="true">&#8599;</span></a>
						</div>
					</div>
				</div>
			</div>
			<a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>">Industries</a>
			<div class="nav__item" data-mega>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Company</a>
				<button class="nav__toggle" type="button" aria-expanded="false" aria-controls="mega-company" aria-label="Show company pages" data-mega-toggle hidden><svg viewBox="0 0 12 12" aria-hidden="true"><path d="M2 4.5l4 4 4-4"/></svg></button>
				<div class="mega mega--slim" id="mega-company" data-mega-panel hidden>
					<div class="wrap wrap--wide mega__row">
						<a class="mega__link" href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><span>About us</span><small>Our story, mission and how we work</small></a>
						<a class="mega__link" href="<?php echo esc_url( home_url( '/careers/' ) ); ?>"><span>Careers</span><small>Open roles and life at JIO</small></a>
						<a class="mega__link" href="<?php echo esc_url( home_url( '/partnerships/' ) ); ?>"><span>Partnerships</span><small>Manufacturers, distributors and resellers</small></a>
						<a class="mega__link" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><span>FAQ</span><small>Answers to common buyer questions</small></a>
					</div>
				</div>
			</div>
			<a href="<?php echo esc_url( home_url( '/client-support/' ) ); ?>">Support</a>
			<a href="https://jiotech.ae/">B2B portal</a>
		</nav>
		<div class="site-head__act">
			<a class="phone" href="tel:+971553440144">+971 55 344 0144</a>
			<a class="btn-arrow btn-arrow--sm" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Get a quote</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
		</div>
		<button class="theme-toggle" type="button" data-theme-toggle aria-pressed="false" title="Switch to dark mode" hidden>
			<svg class="theme-toggle__moon" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.5 14A8.5 8.5 0 0 1 10 3.5 8.5 8.5 0 1 0 20.5 14Z"/></svg>
			<svg class="theme-toggle__sun" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M2 12h2m16 0h2M5 5l1.4 1.4m11.2 11.2L19 19M5 19l1.4-1.4M17.6 6.4 19 5"/></svg>
			<span class="sr">Dark mode</span>
		</button>
		<details class="menu">
			<summary aria-label="Menu"><span></span></summary>
			<div class="menu__panel">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
				<details class="menu__group">
					<summary>Services</summary>
					<p class="menu__label">Power</p>
					<a href="<?php echo esc_url( home_url( '/solutions/power-energy-solutions/' ) ); ?>">Power &amp; energy</a>
					<a href="<?php echo esc_url( home_url( '/solutions/web-development/' ) ); ?>">Data center design &amp; hosting</a>
					<a href="<?php echo esc_url( home_url( '/solutions/maintenance-technical-support/' ) ); ?>">Maintenance &amp; 24/7 support</a>
					<p class="menu__label">IT</p>
					<a href="<?php echo esc_url( home_url( '/solutions/managed-services/' ) ); ?>">Managed IT &amp; infrastructure</a>
					<a href="<?php echo esc_url( home_url( '/solutions/network-connectivity-solutions/' ) ); ?>">Network &amp; connectivity</a>
					<a href="<?php echo esc_url( home_url( '/solutions/cyber-security/' ) ); ?>">Cybersecurity &amp; CCTV</a>
					<a href="<?php echo esc_url( home_url( '/solutions/it-consulting-advisory/' ) ); ?>">IT consulting &amp; advisory</a>
					<a href="<?php echo esc_url( home_url( '/solutions/digital-transformation/' ) ); ?>">Digital transformation</a>
					<a href="<?php echo esc_url( home_url( '/solutions/business-process-automation/' ) ); ?>">Business process automation</a>
					<a href="<?php echo esc_url( home_url( '/solutions/cloud-saas-transformation/' ) ); ?>">Microsoft 365 &amp; cloud</a>
					<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">All services</a>
				</details>
				<a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>">Industries</a>
				<details class="menu__group">
					<summary>Company</summary>
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About us</a>
					<a href="<?php echo esc_url( home_url( '/careers/' ) ); ?>">Careers</a>
					<a href="<?php echo esc_url( home_url( '/partnerships/' ) ); ?>">Partnerships</a>
					<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a>
				</details>
				<a href="<?php echo esc_url( home_url( '/client-support/' ) ); ?>">Client support</a>
				<a href="https://jiotech.ae/">B2B portal</a>
				<a href="tel:+971553440144">+971 55 344 0144</a>
				<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a quote</a>
			</div>
		</details>
	</div>
</header>
