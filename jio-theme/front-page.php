<?php
/**
 * Front page.
 */
get_header(); ?>

<main id="main">

<!-- Hero: keep the storefront sign clear of copy; smaller screens place the photograph above the text. -->
<section class="hero hero--photo">
	<img class="hero__bg" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/hero-office.webp" width="2000" height="1131" alt="JIO Technologies LLC storefront with the company sign above the entrance" loading="eager" fetchpriority="high">
	<div class="wrap wrap--wide hero__inner">
		<div class="hero__copy">
			<h1>One contractor for IT and the power behind it.</h1>
			<p class="hero__lede">JIO Technologies designs, supplies and maintains IT infrastructure and backup power for organisations across the UAE.</p>
			<div class="hero__ctas">
				<a class="btn-arrow" href="#quote"><span>Get a quote</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
				<a class="btn-line" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Explore services</a>
			</div>
		</div>
		<ul class="hero__metrics" aria-label="JIO at a glance">
				<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4a8 8 0 1 0 0 16 8 8 0 0 0 0-16zM12 8v4l3 2"/></svg><span><b>24/7</b>Technical support</span></li>
				<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V9l8-5 8 5v11M9 20v-6h6v6"/></svg><span><b>30</b>Manufacturers supplied</span></li>
				<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20h16M6 20V10M10 20V10M14 20V10M18 20V10M3 10l9-6 9 6z"/></svg><span><b>9</b>Sectors served</span></li>
		</ul>
	</div>

</section>

<!-- Manufacturer ribbon follows the hero. -->
<section class="vendor-strip" id="technology-brands" aria-label="Manufacturers supplied by JIO" data-vendor-strip>
<?php get_template_part( 'parts/logo-wall' ); ?>
</section>

<!-- SERVICES: selectable spotlight with service illustrations. -->
<section class="home-spotlight" id="chain" aria-labelledby="spotlight-title" data-home-spotlight>
	<div class="wrap">
		<div class="home-spotlight__head">
			<div><p class="label">Integrated expertise</p><h2 id="spotlight-title">From the battery room<br>to the browser tab.</h2></div>
			<p>Every layer, connected.<br>One contract. One number to call.</p>
		</div>
		<div class="home-spotlight__layout">
			<nav class="home-spotlight__nav" aria-label="Explore our services" data-spotlight-nav>
				<a class="home-spotlight__tab" id="spotlight-tab-network" href="#spotlight-network" data-spotlight-tab="network"><span class="home-spotlight__number">01</span><span>Network &amp; connectivity</span><span class="home-spotlight__arrow" aria-hidden="true">↗</span></a>
				<a class="home-spotlight__tab" id="spotlight-tab-security" href="#spotlight-security" data-spotlight-tab="security"><span class="home-spotlight__number">02</span><span>Cybersecurity &amp; data protection</span><span class="home-spotlight__arrow" aria-hidden="true">↗</span></a>
				<a class="home-spotlight__tab" id="spotlight-tab-cloud" href="#spotlight-cloud" data-spotlight-tab="cloud"><span class="home-spotlight__number">03</span><span>Consulting &amp; cloud</span><span class="home-spotlight__arrow" aria-hidden="true">↗</span></a>
				<a class="home-spotlight__tab" id="spotlight-tab-datacenter" href="#spotlight-datacenter" data-spotlight-tab="datacenter"><span class="home-spotlight__number">04</span><span>Data center design &amp; hosting</span><span class="home-spotlight__arrow" aria-hidden="true">↗</span></a>
				<a class="home-spotlight__tab" id="spotlight-tab-managed" href="#spotlight-managed" data-spotlight-tab="managed"><span class="home-spotlight__number">05</span><span>Managed IT &amp; 24/7 support</span><span class="home-spotlight__arrow" aria-hidden="true">↗</span></a>
				<a class="home-spotlight__tab" id="spotlight-tab-power" href="#spotlight-power" data-spotlight-tab="power"><span class="home-spotlight__number">06</span><span>Power &amp; energy</span><span class="home-spotlight__arrow" aria-hidden="true">↗</span></a>
			</nav>
			<div class="home-spotlight__stage">
				<article class="home-spotlight__panel" id="spotlight-network" data-spotlight-panel="network">
					<figure class="home-spotlight__visual home-spotlight__visual--photo">
						<span class="home-spotlight__count" aria-label="Service 1 of 6">01 <span>/ 06</span></span>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/home-service-network.webp" width="1672" height="941" alt="Network switches connected with organised blue and yellow cabling" loading="lazy" decoding="async">
					</figure>
					<div class="home-spotlight__copy">
						<p class="home-spotlight__eyebrow">Design · Supply · Support</p>
						<h3>Network &amp; connectivity</h3>
						<p>Connect offices, branches and hybrid teams through reliable LAN, WAN and wireless infrastructure, with network security built into the design.</p>
						<ul class="home-spotlight__tags" aria-label="Capabilities"><li>LAN &amp; WAN</li><li>Business Wi-Fi</li><li>Site connectivity</li><li>VPN</li></ul>
						<div class="home-spotlight__actions"><a class="link" href="<?php echo esc_url( home_url( '/solutions/network-connectivity-solutions/' ) ); ?>">Explore this service <span aria-hidden="true">↗</span></a><button type="button" class="home-spotlight__next" data-spotlight-next>Next service <span aria-hidden="true">→</span></button></div>
					</div>
				</article>
				<article class="home-spotlight__panel" id="spotlight-security" data-spotlight-panel="security">
					<figure class="home-spotlight__visual home-spotlight__visual--photo">
						<span class="home-spotlight__count" aria-label="Service 2 of 6">02 <span>/ 06</span></span>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/home-service-security.webp" width="1672" height="941" alt="Three security operations monitors showing network, protection and backup dashboards" loading="lazy" decoding="async">
					</figure>
					<div class="home-spotlight__copy">
						<p class="home-spotlight__eyebrow">Design · Supply · Support</p>
						<h3>Cybersecurity &amp; data protection</h3>
						<p>Protect business systems and information from the network edge to every endpoint, with security monitoring, threat detection and a coordinated approach to recovery.</p>
						<ul class="home-spotlight__tags" aria-label="Capabilities"><li>Firewall &amp; VPN</li><li>Endpoint protection</li><li>Email security</li><li>Backup &amp; recovery</li></ul>
						<div class="home-spotlight__actions"><a class="link" href="<?php echo esc_url( home_url( '/solutions/cyber-security/' ) ); ?>">Explore this service <span aria-hidden="true">↗</span></a><button type="button" class="home-spotlight__next" data-spotlight-next>Next service <span aria-hidden="true">→</span></button></div>
					</div>
				</article>
				<article class="home-spotlight__panel" id="spotlight-cloud" data-spotlight-panel="cloud">
					<figure class="home-spotlight__visual home-spotlight__visual--photo">
						<span class="home-spotlight__count" aria-label="Service 3 of 6">03 <span>/ 06</span></span>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/home-service-consulting-workspace.webp" width="1672" height="941" alt="Illustration of an empty cloud planning workspace with architecture diagrams, technology roadmaps and server infrastructure" loading="lazy" decoding="async">
					</figure>
					<div class="home-spotlight__copy">
						<p class="home-spotlight__eyebrow">Design · Supply · Support</p>
						<h3>Consulting &amp; cloud</h3>
						<p>Align your technology roadmap with business priorities. Plan cloud migration, hybrid infrastructure and systems integration around your applications, people and growth.</p>
						<ul class="home-spotlight__tags" aria-label="Capabilities"><li>IT planning</li><li>Cloud migration</li><li>Hybrid infrastructure</li><li>Integration</li></ul>
						<div class="home-spotlight__actions"><a class="link" href="<?php echo esc_url( home_url( '/solutions/it-consulting-advisory/' ) ); ?>">Explore this service <span aria-hidden="true">↗</span></a><button type="button" class="home-spotlight__next" data-spotlight-next>Next service <span aria-hidden="true">→</span></button></div>
					</div>
				</article>
				<article class="home-spotlight__panel" id="spotlight-datacenter" data-spotlight-panel="datacenter">
					<figure class="home-spotlight__visual home-spotlight__visual--photo">
						<span class="home-spotlight__count" aria-label="Service 4 of 6">04 <span>/ 06</span></span>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/home-service-datacenter.webp" width="1672" height="941" alt="Server racks and overhead cabling in a modern data center" loading="lazy" decoding="async">
					</figure>
					<div class="home-spotlight__copy">
						<p class="home-spotlight__eyebrow">Design · Supply · Support</p>
						<h3>Data center design &amp; hosting</h3>
						<p>Bring racks, structured cabling, power, cooling and application hosting together in one coordinated environment, from a single rack to an enterprise data hall.</p>
						<ul class="home-spotlight__tags" aria-label="Capabilities"><li>Facility design</li><li>Power &amp; cooling</li><li>Application hosting</li></ul>
						<div class="home-spotlight__actions"><a class="link" href="<?php echo esc_url( home_url( '/solutions/web-development/' ) ); ?>">Explore this service <span aria-hidden="true">↗</span></a><button type="button" class="home-spotlight__next" data-spotlight-next>Next service <span aria-hidden="true">→</span></button></div>
					</div>
				</article>
				<article class="home-spotlight__panel" id="spotlight-managed" data-spotlight-panel="managed">
					<figure class="home-spotlight__visual home-spotlight__visual--photo">
						<span class="home-spotlight__count" aria-label="Service 5 of 6">05 <span>/ 06</span></span>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/home-service-managed.webp" width="1670" height="941" alt="IT support workstation with two monitors, a headset and server equipment" loading="lazy" decoding="async">
					</figure>
					<div class="home-spotlight__copy">
						<p class="home-spotlight__eyebrow">Design · Supply · Support</p>
						<h3>Managed IT &amp; 24/7 support</h3>
						<p>Keep servers, endpoints and everyday systems supported through continuous monitoring, preventive maintenance, remote assistance and onsite response.</p>
						<ul class="home-spotlight__tags" aria-label="Capabilities"><li>Servers</li><li>Endpoints</li><li>Microsoft 365</li><li>24/7 monitoring</li></ul>
						<div class="home-spotlight__actions"><a class="link" href="<?php echo esc_url( home_url( '/solutions/managed-services/' ) ); ?>">Explore this service <span aria-hidden="true">↗</span></a><button type="button" class="home-spotlight__next" data-spotlight-next>Next service <span aria-hidden="true">→</span></button></div>
					</div>
				</article>
				<article class="home-spotlight__panel" id="spotlight-power" data-spotlight-panel="power">
					<figure class="home-spotlight__visual home-spotlight__visual--photo">
						<span class="home-spotlight__count" aria-label="Service 6 of 6">06 <span>/ 06</span></span>
						<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/home-service-power-equipment.webp" width="1672" height="941" alt="Illustration of UPS power equipment, enclosed battery banks and renewable energy monitoring in an empty infrastructure room" loading="lazy" decoding="async">
					</figure>
					<div class="home-spotlight__copy">
						<p class="home-spotlight__eyebrow">Design · Supply · Support</p>
						<h3>Power &amp; energy</h3>
						<p>Coordinate backup power, battery systems and renewable energy around the equipment your business depends on. From installation to preventive maintenance, one team supports your power infrastructure.</p>
						<ul class="home-spotlight__tags" aria-label="Capabilities"><li>UPS systems</li><li>VRLA &amp; lithium-ion</li><li>Renewables</li><li>Maintenance</li></ul>
						<div class="home-spotlight__actions"><a class="link" href="<?php echo esc_url( home_url( '/solutions/power-energy-solutions/' ) ); ?>">Explore this service <span aria-hidden="true">↗</span></a><button type="button" class="home-spotlight__next" data-spotlight-next>Next service <span aria-hidden="true">→</span></button></div>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>

<!-- WHY ONE SUPPLIER (Apple dark stage with a white comparison card as the reset) -->
<section class="versus">
	<div class="wrap">
		<div class="versus__head">
			<h2>Why one supplier for IT and power.</h2>
			<p>When power and IT are bought separately, the gap between the two contracts is where outages start.</p>
		</div>
		<div class="versus__grid">
			<div class="versus__col">
				<h3>Separate IT and power contractors</h3>
				<ul>
					<li>Two contracts, two support numbers, two site visits.</li>
					<li>UPS sized from a nameplate guess, not the rack load.</li>
					<li>After an outage, each side points at the other.</li>
					<li>Battery replacement falls between the two contracts.</li>
				</ul>
			</div>
			<div class="versus__col versus__col--us">
				<h3>JIO Technologies</h3>
				<ul>
					<li>One contract and one number for every layer.</li>
					<li>UPS and battery runtime sized from the equipment we install.</li>
					<li>One team owns the fault from the mains to the firewall.</li>
					<li>Battery health is part of the same maintenance schedule.</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- INDUSTRIES: one horizontal row, advanced with the arrow controls. -->
<section class="industries" id="home-industries" aria-labelledby="home-industries-title">
	<div class="wrap wrap--wide">
		<div class="industries__head">
			<div><h2 id="home-industries-title">Built for organisations that cannot go offline.</h2><p>Nine sectors, each with its own mix of uptime, security and compliance pressure.</p></div>
			<a class="link" href="<?php echo esc_url( home_url( '/industries/' ) ); ?>">Explore all industries <span aria-hidden="true">↗</span></a>
		</div>
		<div class="industries__rail" id="industries-rail" data-industry-rail tabindex="0" role="region" aria-label="Industries we serve">
		<ul class="industries__track">
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#government"><h3>Government &amp; public sector</h3><p>Secure, compliant systems for modernisation programmes.</p></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#healthcare"><h3>Healthcare</h3><p>IT and power for medical devices, patient data and 24/7 care.</p></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#finance"><h3>Banking &amp; financial services</h3><p>High-availability systems for mission-critical workloads.</p></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#energy"><h3>Energy &amp; utilities</h3><p>Smart power systems and UPS integration for critical facilities.</p></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#manufacturing"><h3>Manufacturing &amp; industrial</h3><p>Networks and backup power for continuous operations.</p></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#construction"><h3>Construction &amp; engineering</h3><p>IT, surveillance and energy for project sites and offices.</p></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#logistics"><h3>Logistics &amp; transportation</h3><p>Connected networks, IoT tracking and reliable power.</p></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#retail"><h3>Retail &amp; e-commerce</h3><p>Connectivity, cloud and security for store and online sales.</p></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#education"><h3>Education</h3><p>Secure campus networks and energy-efficient infrastructure.</p></a></li>
		</ul>
		</div>
		<div class="industries__controls" data-industry-controls hidden>
			<p class="industries__position" data-industry-position aria-live="polite">1–3 of 9 industries</p>
			<div class="industries__arrows">
				<button class="sqbtn" type="button" aria-label="Previous industries" aria-controls="industries-rail" data-industry-prev><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M19 12H5m6-6-6 6 6 6"/></svg></button>
				<button class="sqbtn" type="button" aria-label="Next industries" aria-controls="industries-rail" data-industry-next><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg></button>
			</div>
		</div>
	</div>
</section>

<!-- PROCESS + QUOTE (Authkit centred intro + square tiles joined by a thin line) -->
<section class="quote" id="quote">
	<div class="wrap">
		<div class="intro">
			<h2>Tell us what you run. We will come back with a proposal.</h2>
			<p>Scope, equipment and a support plan, in writing.</p>
		</div>
		<?php get_template_part( 'parts/steps' ); ?>
		<div class="quote__grid">
			<?php get_template_part( 'parts/quote-form' ); ?>
			<?php get_template_part( 'parts/direct' ); ?>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
