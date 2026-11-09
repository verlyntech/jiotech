<?php
/**
 * Services (slug: solutions).
 */
get_header(); ?>

<main id="main" class="solutions-page">

<section class="solutions-hero" aria-labelledby="solutions-title">
	<div class="wrap wrap--wide">
		<div class="solutions-hero__grid">
			<div class="solutions-hero__copy">
				<p class="solutions-hero__category">Services &amp; solutions</p>
				<h1 id="solutions-title">Smarter <span class="solutions-hero__it">IT.</span><br>Stronger <span class="solutions-hero__energy">energy.</span><br>Better together.</h1>
				<p class="solutions-hero__lead">Empowering businesses through smarter IT &amp; energy integration.</p>
				<p>JIO Technologies LLC brings enterprise technology and power systems together to improve efficiency, strengthen security and support business continuity.</p>
				<div class="solutions-hero__actions">
					<a class="btn-arrow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Discuss your requirements</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
					<a class="solutions-hero__explore" href="#capabilities">Explore our services <span aria-hidden="true">↓</span></a>
				</div>
			</div>
			<div class="solutions-hero__art">
				<figure class="solutions-image solutions-image--hero solutions-image--photo">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/services-hero-jio-tech.webp" width="1402" height="1122" alt="Illustration of a JIO TECH-branded infrastructure room with UPS and battery cabinets, server racks and organised network cabling" loading="eager" fetchpriority="high" decoding="async">
				</figure>
				<div class="solutions-hero__note"><svg viewBox="0 0 48 48" aria-hidden="true"><path d="M4 10h18v12H4zM4 27h18v12H4zM9 16h6M9 33h6M34 5l-8 20h9l-5 18 15-25H34z"/></svg><p>One integrated approach.<br><strong>From power to performance.</strong></p></div>
			</div>
		</div>
		<div class="solutions-hero__scope" aria-label="Solution priorities"><span>Business continuity</span><span>Secure infrastructure</span><span>Scalable operations</span></div>
	</div>
</section>

<section class="solutions-intro" aria-labelledby="solutions-intro-title">
	<div class="wrap wrap--wide solutions-intro__grid">
		<div class="solutions-intro__heading"><span class="solutions-intro__experience">20+ <span>years of experience</span></span><h2 id="solutions-intro-title">Comprehensive IT &amp; energy services for business.</h2></div>
		<div class="solutions-intro__copy"><p>For over two decades, JIO Technologies has helped organisations across the UAE turn complex infrastructure needs into practical, connected solutions.</p><p>From cloud platforms and cybersecurity to UPS systems and renewable energy, we design, deploy and maintain infrastructure around your business priorities. Our approach helps you streamline operations, manage costs and build the capacity to grow.</p></div>
	</div>
</section>

<section class="capabilities" aria-labelledby="capabilities-title" data-capabilities>
	<div class="wrap wrap--wide">
		<div class="capabilities__heading" id="capabilities"><h2 id="capabilities-title">Five service areas. One connected partner.</h2><p>Choose a service to explore its role in your infrastructure and discuss your requirements with our team.</p></div>
		<div class="service-explorer" data-service-explorer data-active-service="power">
			<div class="service-map">
				<div class="service-map__top"><span>Built to work together</span><span aria-hidden="true">IT + ENERGY</span></div>
				<div class="service-map__stage">
					<svg class="service-map__wires" viewBox="0 0 640 520" preserveAspectRatio="none" aria-hidden="true">
						<path class="is-active" data-service-wire="power" d="M320 245V170H125V100"/>
						<path data-service-wire="datacenter" d="M320 245V170H515V100"/>
						<path data-service-wire="network" d="M320 245H225V320H125"/>
						<path data-service-wire="operations" d="M320 245H415V320H515"/>
						<path data-service-wire="equipment" d="M320 245V445"/>
					</svg>
					<div class="service-map__hub" aria-hidden="true"><svg viewBox="0 0 32 32"><path d="M7 7h18v7H7zM7 18h18v7H7zM11 10.5h2M11 21.5h2M16 14v4"/><path class="service-map__hub-accent" d="M20 10.5h1M20 21.5h1"/></svg><span>One partner</span></div>
					<nav class="service-map__nodes" aria-label="Service areas" data-service-nav>
						<a class="service-node service-node--power is-active" id="service-power" href="#power" data-service-node="power" aria-controls="power">
							<span class="service-node__top"><svg viewBox="0 0 32 32" aria-hidden="true"><path d="M18 3L7 18h9l-2 11 12-16h-9z"/></svg><span aria-hidden="true">01</span></span><strong>Power &amp;<br>energy</strong>
						</a>
						<a class="service-node service-node--datacenter" id="service-datacenter" href="#datacenter" data-service-node="datacenter" aria-controls="datacenter">
							<span class="service-node__top"><svg viewBox="0 0 32 32" aria-hidden="true"><path d="M5 5h22v9H5zM5 18h22v9H5zM9 9.5h2M9 22.5h2M17 9.5h6M17 22.5h6"/></svg><span aria-hidden="true">02</span></span><strong>Data centers<br>&amp; cloud</strong>
						</a>
						<a class="service-node service-node--network" id="service-network" href="#network" data-service-node="network" aria-controls="network">
							<span class="service-node__top"><svg viewBox="0 0 32 32" aria-hidden="true"><path d="M16 3l10 4v8c0 7-10 14-10 14S6 22 6 15V7zM11 15l3 3 7-7"/></svg><span aria-hidden="true">03</span></span><strong>Network &amp;<br>security</strong>
						</a>
						<a class="service-node service-node--operations" id="service-operations" href="#operations" data-service-node="operations" aria-controls="operations">
							<span class="service-node__top"><svg viewBox="0 0 32 32" aria-hidden="true"><path d="M5 18v-4a11 11 0 0 1 22 0v4M5 14h5v10H5zM22 14h5v10h-5zM26 24v3H16M13 25h6v4h-6z"/></svg><span aria-hidden="true">04</span></span><strong>Managed IT<br>&amp; support</strong>
						</a>
						<a class="service-node service-node--equipment" id="service-equipment" href="#equipment" data-service-node="equipment" aria-controls="service-panel-equipment">
							<span class="service-node__top"><svg viewBox="0 0 32 32" aria-hidden="true"><path d="M4 9l12-6 12 6v14l-12 6-12-6zM4 9l12 6 12-6M16 15v14M10 6l12 6"/></svg><span aria-hidden="true">05</span></span><strong>Equipment<br>supply</strong>
						</a>
					</nav>
				</div>
				<p class="service-map__hint">Choose a service to explore its role.</p>
			</div>
			<div class="service-explorer__overview">
				<div class="service-explorer__top"><span>Connected expertise</span><span data-service-position aria-live="polite" aria-atomic="true">01 / 05</span></div>
				<article class="service-summary" id="power" aria-labelledby="service-power" data-service-summary="power">
					<span class="service-summary__category">Business continuity</span>
					<h3>Power &amp; energy</h3>
					<p>Build a resilient power foundation for your critical equipment. We bring site power, backup systems and energy optimisation into one coordinated plan.</p>
					<ul><li>UPS systems and VRLA or lithium-ion batteries</li><li>Power planning and renewable integration</li><li>Preventive maintenance and service contracts</li></ul>
					<a class="service-summary__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss power &amp; energy <span aria-hidden="true">↗</span></a>
				</article>
				<article class="service-summary" id="datacenter" aria-labelledby="service-datacenter" data-service-summary="datacenter" hidden>
					<span class="service-summary__category">Capacity &amp; performance</span>
					<h3>Data centers &amp; cloud</h3>
					<p>Connect your physical infrastructure and cloud platforms around the applications you run. From a single rack to a hybrid environment, we plan for capacity and growth.</p>
					<ul><li>Data center design, hosting, power and cooling</li><li>Private, public and hybrid cloud environments</li><li>Cloud architecture and migration planning</li></ul>
					<a class="service-summary__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss data centers &amp; cloud <span aria-hidden="true">↗</span></a>
				</article>
				<article class="service-summary" id="network" aria-labelledby="service-network" data-service-summary="network" hidden>
					<span class="service-summary__category">Connected &amp; protected</span>
					<h3>Network &amp; security</h3>
					<p>Bring connectivity, cybersecurity and physical security together across your sites. Give your people dependable access while protecting your systems and information.</p>
					<ul><li>Business LAN, WAN and Wi-Fi connectivity</li><li>Security monitoring and data protection</li><li>CCTV, recording and remote monitoring</li></ul>
					<a class="service-summary__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss network &amp; security <span aria-hidden="true">↗</span></a>
				</article>
				<article class="service-summary" id="operations" aria-labelledby="service-operations" data-service-summary="operations" hidden>
					<span class="service-summary__category">Operational confidence</span>
					<h3>Managed IT &amp; support</h3>
					<p>Keep day-to-day systems supported while planning your next technology investment. One team coordinates infrastructure, user support and maintenance around your priorities.</p>
					<ul><li>Infrastructure management and end-user support</li><li>24/7 monitoring, remote and onsite assistance</li><li>Technology roadmaps and systems integration</li></ul>
					<a class="service-summary__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss managed IT &amp; support <span aria-hidden="true">↗</span></a>
				</article>
				<article class="service-summary" id="service-panel-equipment" aria-labelledby="service-equipment" data-service-summary="equipment" hidden>
					<span class="service-summary__category">Supply through deployment</span>
					<h3>Equipment supply</h3>
					<p>Specify, source and deploy equipment through the same infrastructure partner. We connect product selection, vendor coordination and installation with your wider operating plan.</p>
					<ul><li>Networking, servers, storage and business devices</li><li>UPS systems, batteries and power distribution</li><li>Vendor coordination and deployment planning</li></ul>
					<a class="service-summary__link" href="#equipment">Explore equipment supply <span aria-hidden="true">↗</span></a>
				</article>
			</div>
		</div>

	</div>
</section>

<!-- EQUIPMENT CATALOGUE (teenage engineering ruled product grid) -->
<section class="catalogue" id="equipment" aria-labelledby="equipment-title">
	<div class="wrap wrap--wide">
		<div class="sec-head">
			<h2 id="equipment-title">Infrastructure equipment</h2>
		</div>
		<ul class="cat">
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><rect x="38" y="8" width="44" height="74"/><rect x="45" y="16" width="30" height="16"/><path d="M45 42h30M45 48h30M45 54h30"/><circle cx="60" cy="70" r="4"/></svg>
				<h3>UPS units</h3><p>Eaton, APC, Vertiv, BPC</p>
			</li>
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><rect x="22" y="26" width="34" height="48"/><rect x="64" y="26" width="34" height="48"/><path d="M30 26v-6h6v6M42 26v-6h6v6M72 26v-6h6v6M84 26v-6h6v6M33 44h12M39 38v12M75 44h12"/></svg>
				<h3>VRLA batteries</h3><p>Amaron, SacredSun</p>
			</li>
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><rect x="34" y="6" width="52" height="78"/><path d="M34 22h52M34 38h52M34 54h52M34 70h52"/><circle cx="78" cy="14" r="2"/><circle cx="78" cy="30" r="2"/><circle cx="78" cy="46" r="2"/><circle cx="78" cy="62" r="2"/></svg>
				<h3>Lithium-ion battery cabinets</h3><p>Matched to the UPS</p>
			</li>
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><rect x="52" y="4" width="16" height="82"/><circle cx="60" cy="16" r="3"/><circle cx="60" cy="30" r="3"/><circle cx="60" cy="44" r="3"/><circle cx="60" cy="58" r="3"/><circle cx="60" cy="72" r="3"/></svg>
				<h3>Power distribution units</h3><p>APC, Eaton, Vertiv</p>
			</li>
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><rect x="12" y="28" width="96" height="16"/><rect x="12" y="48" width="96" height="16"/><path d="M20 36h30M20 56h30"/><circle cx="98" cy="36" r="2"/><circle cx="98" cy="56" r="2"/></svg>
				<h3>Servers</h3><p>Dell, HPE, Lenovo, Supermicro</p>
			</li>
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><rect x="34" y="14" width="52" height="64"/><path d="M42 24h36v10H42zM42 40h36v10H42zM42 56h36v10H42z"/></svg>
				<h3>Storage &amp; NAS</h3><p>Synology, Dell, HPE</p>
			</li>
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><rect x="12" y="38" width="96" height="18"/><path d="M20 47h4M28 47h4M36 47h4M44 47h4M52 47h4M60 47h4M68 47h4M76 47h4"/><path d="M60 38V24M50 18a14 14 0 0 1 20 0M44 12a22 22 0 0 1 32 0"/></svg>
				<h3>Switches &amp; Wi-Fi</h3><p>Cisco, Aruba, Ubiquiti</p>
			</li>
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><rect x="14" y="34" width="92" height="24"/><path d="M14 46h92M38 34v24M62 34v12M86 34v24M50 46v12M74 46v12"/></svg>
				<h3>Firewalls</h3><p>Fortinet, Sophos, WatchGuard</p>
			</li>
			<li>
				<svg viewBox="0 0 120 90" aria-hidden="true"><path d="M24 30l58-12 8 20-58 12z"/><circle cx="80" cy="30" r="5"/><path d="M40 48l-6 26M24 74h22"/></svg>
				<h3>CCTV cameras &amp; recorders</h3><p>Hikvision</p>
			</li>
		</ul>
	</div>
</section>

<section class="solutions-delivery" aria-labelledby="delivery-title">
	<div class="wrap wrap--wide">
		<div class="solutions-delivery__heading"><h2 id="delivery-title">Expertise beyond implementation.</h2><p>A connected delivery approach that takes your infrastructure from business priorities to ongoing performance.</p></div>
		<ol class="solutions-delivery__steps">
			<li><span aria-hidden="true">01</span><h3>Design around your goals.</h3><p>Review your sites, systems and priorities. Define a solution that fits your operational needs and plans for growth.</p></li>
			<li><span aria-hidden="true">02</span><h3>Deploy as one connected system.</h3><p>Coordinate equipment, installation and integration across IT and power, with a clear scope and implementation plan.</p></li>
			<li><span aria-hidden="true">03</span><h3>Maintain for the long term.</h3><p>Support your infrastructure through monitoring, preventive maintenance and technical assistance as your business evolves.</p></li>
		</ol>
	</div>
</section>

<section class="solutions-next" aria-labelledby="solutions-next-title">
	<div class="wrap wrap--wide solutions-next__grid"><div><h2 id="solutions-next-title">Bring your IT &amp; energy priorities together.</h2><p>Tell us what you operate, what needs to improve and where you want to go. We will help shape a practical plan.</p></div><a class="btn-arrow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Start a conversation</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a></div>
</section>

</main>

<?php get_footer(); ?>
