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
			<img class="brand__logo" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo.webp" width="1282" height="262" alt="JIO Tech, JIO Technologies LLC">
		</a>
		<nav class="nav" aria-label="Primary">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
			<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Services</a>
			<a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>">Industries</a>
			<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Company</a>
			<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a>
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
				<a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Services</a>
				<a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>">Industries</a>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Company</a>
				<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a>
				<a href="<?php echo esc_url( home_url( '/client-support/' ) ); ?>">Client support</a>
				<a href="https://jiotech.ae/">B2B portal</a>
				<a href="tel:+971553440144">+971 55 344 0144</a>
				<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a quote</a>
			</div>
		</details>
	</div>
</header>
