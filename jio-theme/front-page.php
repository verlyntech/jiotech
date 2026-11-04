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
			<h1>One contractor for IT and the <span class="hl-green">power</span> behind it.</h1>
			<p class="hero__lede">JIO Technologies designs, supplies and maintains IT infrastructure and backup power for organisations across the UAE.</p>
			<div class="hero__ctas">
				<a class="btn-arrow" href="#quote"><span>Get a quote</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
				<a class="btn-line" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Explore services</a>
			</div>
			<ul class="hero__metrics" aria-label="JIO at a glance">
				<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4a8 8 0 1 0 0 16 8 8 0 0 0 0-16zM12 8v4l3 2"/></svg><span><b>24/7</b>Technical support</span></li>
				<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V9l8-5 8 5v11M9 20v-6h6v6"/></svg><span><b>30</b>Manufacturers supplied</span></li>
				<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20h16M6 20V10M10 20V10M14 20V10M18 20V10M3 10l9-6 9 6z"/></svg><span><b>9</b>Sectors served</span></li>
			</ul>
		</div>
	</div>

</section>

<!-- Manufacturer ribbon follows the hero. -->
<section class="vendor-strip" id="technology-brands" aria-label="Manufacturers supplied by JIO" data-vendor-strip>
<?php get_template_part( 'parts/logo-wall' ); ?>
</section>

<!-- SERVICES BENTO (Wise pale band + dark card with accent headline, Brex flat bordered tiles) -->
<section class="services band-green" id="chain">
	<div class="wrap">
		<div class="sec-head">
			<h2>From the battery room to the browser tab.</h2>
			<p>We cover every layer, so there is one contract and one number to call.</p>
		</div>

		<div class="bento">
			<article class="tile tile--power">
				<figure class="tile__img"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/tile-power.png" width="1200" height="900" alt="UPS battery string in a plant room" loading="lazy"><figcaption><h3>Power &amp; energy</h3></figcaption></figure>
				<p>UPS systems, battery banks and renewable setups, maintained for you.</p>
				<div class="tabs">
					<input type="radio" name="pw" id="pw1" checked><label for="pw1">UPS</label>
					<input type="radio" name="pw" id="pw2"><label for="pw2">VRLA</label>
					<input type="radio" name="pw" id="pw3"><label for="pw3">Lithium-ion</label>
					<input type="radio" name="pw" id="pw4"><label for="pw4">Renewables</label>
					<div class="tabs__body">
						<p data-for="pw1"><b>Online UPS.</b> Conditions the supply continuously and carries the load through an outage until generators start or systems shut down cleanly.</p>
						<p data-for="pw2"><b>VRLA batteries.</b> Sealed lead-acid. Lower upfront cost and the long-standing default for UPS strings, but service life drops fast in hot plant rooms.</p>
						<p data-for="pw3"><b>Lithium-ion.</b> Smaller footprint, better heat tolerance and a longer service life than lead-acid, at a higher purchase price.</p>
						<p data-for="pw4"><b>Renewables.</b> Solar-assisted supply to offset grid draw at sites with the roof or land to use.</p>
					</div>
				</div>
				<a class="link link--night" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>#power">Explore power solutions</a>
			</article>

			<article class="tile tile--dc">
				<figure class="tile__img"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/tile-datacenter.png" width="1200" height="900" alt="Server racks in a data centre aisle" loading="lazy"><figcaption><h3>Data center design &amp; hosting</h3></figcaption></figure>
				<div>
					<p>Built end to end, from a single rack to an enterprise hall.</p>
				</div>
			</article>

			<article class="tile tile--sec">
				<figure class="tile__img"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/tile-firewall.png" width="1200" height="900" alt="Firewall appliance in a server cabinet" loading="lazy"><figcaption><h3>Cybersecurity &amp; data protection</h3></figcaption></figure>
				<p>Monitoring and threat detection, edge to endpoint.</p>
				<ul class="checks">
					<li>Firewall and VPN edge</li>
					<li>Endpoint protection</li>
					<li>Email security</li>
					<li>Backup and recovery</li>
				</ul>
			</article>

			<article class="tile tile--net">
				<figure class="tile__img"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/tile-network.png" width="1200" height="900" alt="Network switches and patch cabling" loading="lazy"><figcaption><h3>Network &amp; connectivity</h3></figcaption></figure>
				<p>LAN, WAN, Wi-Fi and network security.</p>
				<ul class="pills pills--it"><li>LAN</li><li>WAN</li><li>Wi-Fi</li><li>Firewall</li><li>VPN</li></ul>
			</article>

			<article class="tile tile--msp">
				<figure class="tile__img"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/tile-msp.png" width="1200" height="900" alt="Operations desk with monitors and dashboards" loading="lazy"><figcaption><h3>Managed IT &amp; 24/7 support</h3></figcaption></figure>
				<p>24/7 monitoring and onsite response.</p>
				<ul class="pills pills--it"><li>Servers</li><li>Endpoints</li><li>Backup</li><li>Microsoft 365</li></ul>
			</article>

			<article class="tile tile--con">
				<figure class="tile__img"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/tile-consulting.png" width="1200" height="900" alt="Meeting table with architecture plans and a laptop" loading="lazy"><figcaption><h3>Consulting &amp; cloud</h3></figcaption></figure>
				<p>IT planning and cloud migration.</p>
				<a class="link" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">All services</a>
			</article>
		</div>
		<p class="bento__note">Images are illustrative, not photographs of JIO projects.</p>
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
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#government"><h3>Government &amp; public sector</h3><p>Secure, compliant systems for modernisation programmes.</p><ul class="pills"><li class="t-it">Data centers</li><li class="t-it">Secured networks</li><li class="t-power">Backup power</li></ul></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#healthcare"><h3>Healthcare</h3><p>IT and power for medical devices, patient data and 24/7 care.</p><ul class="pills"><li class="t-power">Continuous power</li><li class="t-it">Network security</li><li class="t-sec">CCTV</li></ul></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#finance"><h3>Banking &amp; financial services</h3><p>High-availability systems for mission-critical workloads.</p><ul class="pills"><li class="t-it">Resilient hosting</li><li class="t-it">Cybersecurity</li><li class="t-power">UPS</li></ul></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#energy"><h3>Energy &amp; utilities</h3><p>Smart power systems and UPS integration for critical facilities.</p><ul class="pills"><li class="t-power">UPS integration</li><li class="t-power">Battery systems</li><li class="t-it">Monitoring</li></ul></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#manufacturing"><h3>Manufacturing &amp; industrial</h3><p>Networks and backup power for continuous operations.</p><ul class="pills"><li class="t-it">Plant networks</li><li class="t-power">Backup power</li><li class="t-it">Automation-ready IT</li></ul></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#construction"><h3>Construction &amp; engineering</h3><p>IT, surveillance and energy for project sites and offices.</p><ul class="pills"><li class="t-it">Site networks</li><li class="t-sec">Surveillance</li><li class="t-power">Site power</li></ul></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#logistics"><h3>Logistics &amp; transportation</h3><p>Connected networks, IoT tracking and reliable power.</p><ul class="pills"><li class="t-it">Connected networks</li><li class="t-it">IoT tracking</li><li class="t-power">Reliable power</li></ul></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#retail"><h3>Retail &amp; e-commerce</h3><p>Connectivity, cloud and security for store and online sales.</p><ul class="pills"><li class="t-it">Store connectivity</li><li class="t-it">Cloud</li><li class="t-it">Payment security</li></ul></a></li>
			<li class="ind-card"><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>#education"><h3>Education</h3><p>Secure campus networks and energy-efficient infrastructure.</p><ul class="pills"><li class="t-it">Campus networks</li><li class="t-it">Learning platforms</li><li class="t-power">Efficient power</li></ul></a></li>
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
