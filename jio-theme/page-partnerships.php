<?php
/**
 * Partnerships (slug: partnerships). Uses the service-page layout styles (.svc-*).
 */
get_header(); ?>

<main id="main" class="svc">

<section class="svc-hero" aria-labelledby="partners-title">
	<div class="wrap svc-hero__grid">
		<div class="svc-hero__copy">
			<nav class="svc-crumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Company</a><span aria-hidden="true">/</span><span aria-current="page">Partnerships</span></nav>
			<h1 id="partners-title">Drive business forward by partnering with us.</h1>
			<p class="svc-hero__lead">Leading manufacturers, delivered as one system.</p>
			<p class="svc-hero__intro">JIO brings power, compute, networking and security from established brands into one design, one installation and one support contract. Manufacturers and distributors get a local team that delivers to their standards. Resellers and trade buyers can order through our B2B portal.</p>
			<div class="svc-hero__actions">
				<a class="btn-arrow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Talk to us about partnering</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
				<a class="link" href="https://jiotech.ae/">B2B portal</a>
			</div>
		</div>
		<figure class="svc-media svc-media--photo">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/partnerships-delivery-hub.webp" width="1402" height="1122" alt="Illustration of an organised technology delivery hub with equipment shelving, transit cases and a staging bench" loading="eager" fetchpriority="high" decoding="async">
			<figcaption>Illustrative image</figcaption>
		</figure>
	</div>
</section>

<section class="svc-included" aria-labelledby="partners-focus-title">
	<div class="wrap">
		<div class="svc-head"><p class="label">Focus areas</p><h2 id="partners-focus-title">The brands behind our projects.</h2></div>
		<ol class="svc-cards">
			<li><span class="svc-cards__num">01</span><h3>Power &amp; energy</h3><p>UPS, batteries and energy management from APC by Schneider Electric, Eaton, Vertiv, Emerson and BPC Energy.</p></li>
			<li><span class="svc-cards__num">02</span><h3>Servers, storage &amp; edge</h3><p>Compute, storage and edge devices from Dell Technologies, HPE, Lenovo and Supermicro.</p></li>
			<li><span class="svc-cards__num">03</span><h3>Networking &amp; security</h3><p>Switching, Wi-Fi, firewalls and CCTV from Cisco, HPE Aruba Networking, Fortinet, Huawei and Hikvision.</p></li>
			<li><span class="svc-cards__num">04</span><h3>Virtualisation &amp; cloud</h3><p>Infrastructure that is ready for virtualisation and cloud, with VMware, Microsoft and AWS.</p></li>
		</ol>
	</div>
</section>

<section class="svc-process" aria-labelledby="partners-how-title">
	<div class="wrap">
		<div class="svc-head"><p class="label">How we work with partners</p><h2 id="partners-how-title">Local delivery, to the manufacturer&rsquo;s standard.</h2></div>
		<ol class="svc-steps">
			<li><span class="svc-steps__num">01</span><h3>Aligned objectives</h3><p>Solutions designed with manufacturer input, and regular reviews of deployment quality.</p></li>
			<li><span class="svc-steps__num">02</span><h3>Delivery to standard</h3><p>Manufacturer-approved materials and testing procedures, with joint commissioning where a project calls for it.</p></li>
			<li><span class="svc-steps__num">03</span><h3>Clear documentation</h3><p>Transparent project documentation and warranty terms aligned with the manufacturer.</p></li>
		</ol>
	</div>
</section>

<section class="svc-fit" aria-labelledby="partners-where-title">
	<div class="wrap svc-fit__grid">
		<figure class="svc-media svc-media--wide svc-media--photo">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/partnerships-integrated-edge.webp" width="1586" height="992" alt="Illustration of an integrated edge installation combining an IT rack, UPS cabinet, power distribution and security camera" loading="lazy" decoding="async">
			<figcaption>Illustrative image</figcaption>
		</figure>
		<div class="svc-fit__copy">
			<p class="label">Where we partner</p>
			<h2 id="partners-where-title">Projects where IT and power meet.</h2>
			<p>Partnerships work best where one site needs power, compute and connectivity to work together. That is the kind of project JIO is built for.</p>
			<p class="svc-fit__brands">Project types</p>
			<ul class="svc-tags"><li>Data centers</li><li>Telecom &amp; edge infrastructure</li><li>Enterprise IT</li><li>Public sector projects</li></ul>
		</div>
	</div>
</section>

<section class="svc-related" aria-labelledby="partners-routes-title">
	<div class="wrap">
		<div class="svc-head"><p class="label">Work with JIO</p><h2 id="partners-routes-title">Choose the route that fits you.</h2></div>
		<ul class="svc-links">
			<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Manufacturers &amp; distributors</span><span class="svc-links__arrow" aria-hidden="true">&#8599;</span></a></li>
			<li><a href="https://jiotech.ae/"><span>Resellers &amp; trade buyers</span><span class="svc-links__arrow" aria-hidden="true">&#8599;</span></a></li>
			<li><a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>"><span>Organisations buying services</span><span class="svc-links__arrow" aria-hidden="true">&#8599;</span></a></li>
		</ul>
	</div>
</section>

</main>

<?php get_footer(); ?>
