<?php
/**
 * Front page.
 */
get_header(); ?>

<main id="main">

<!-- HERO: full-bleed photo with a flat ink overlay, headline left, statement card right, stats along the bottom -->
<section class="hero hero--photo">
	<img class="hero__bg" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/hero-office.webp" width="2000" height="1131" alt="" loading="eager" fetchpriority="high">
	<div class="wrap hero__inner">
		<div class="hero__copy">
			<h1>One contractor for the servers and the <span class="hl-green">power</span> behind them.</h1>
			<p class="hero__lede">JIO Technologies designs, supplies and maintains IT infrastructure and backup power for organisations across the UAE.</p>
			<div class="hero__ctas">
				<a class="btn-arrow" href="#quote"><span>Get a quote</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
				<a class="btn-line" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">Explore services</a>
			</div>
		</div>
		<aside class="hero__card" aria-label="About JIO Technologies">
			<svg class="hero__quote" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 18v-5.5C4 8.4 6 6 9.5 5.5M13.5 18v-5.5c0-4.1 2-6.5 5.5-7M4 12.5h5v5.5H4zM13.5 12.5h5v5.5h-5z"/></svg>
			<p class="hero__card-text">IT and power under one contract, with one team accountable from the mains to the firewall.</p>
			<div class="hero__card-foot">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/logo.webp" width="1282" height="262" alt="JIO Tech, JIO Technologies LLC" class="hero__card-logo">
				<span>Al Muroor Road, Abu Dhabi</span>
			</div>
		</aside>
	</div>
	<div class="wrap hero__bottom">
		<p class="hero__pitch"><span class="hero__pitch-ico" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M13 3L5 14h6l-1 7 8-11h-6z"/></svg></span>One contract for IT and power across Abu Dhabi, Dubai and the GCC.</p>
		<ul class="hero__stats">
			<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 4a8 8 0 1 0 0 16 8 8 0 0 0 0-16zM12 8v4l3 2"/></svg><span><b>24/7</b>Technical support</span></li>
			<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20V9l8-5 8 5v11M9 20v-6h6v6"/></svg><span><b>30</b>Manufacturers supplied</span></li>
			<li><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 20h16M6 20V10M10 20V10M14 20V10M18 20V10M3 10l9-6 9 6z"/></svg><span><b>9</b>Sectors served</span></li>
		</ul>
	</div>
</section>

<!-- LAYERS: the power chain, now its own section -->
<section class="layers">
	<div class="wrap layers__grid">
		<div class="layers__copy">
			<h2>Six layers, one supplier.</h2>
			<p>If the UPS fails, so does everything under it. We supply and support every layer, so one team owns the fault from the mains to the firewall.</p>
			<a class="link" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>">See every service</a>
		</div>
		<figure class="frame" data-chain data-focus="all" aria-label="The six layers JIO supplies and supports, from mains supply to surveillance">
			<div class="frame__bar">
				<span class="frame__title">One site, six layers</span>
				<div class="seg" role="radiogroup" aria-label="Show layer">
					<button type="button" role="radio" aria-checked="true" data-focus-btn="all">All</button>
					<button type="button" role="radio" aria-checked="false" data-focus-btn="power">Power</button>
					<button type="button" role="radio" aria-checked="false" data-focus-btn="it">IT</button>
					<button type="button" role="radio" aria-checked="false" data-focus-btn="security">Security</button>
				</div>
			</div>
			<ol class="chain__list">
				<li class="node node--power" data-layer="power">
					<span class="node__sym" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 12c1.5-4.5 3-4.5 4.5 0s3 4.5 4.5 0 3-4.5 4.5 0 3 4.5 4.5 0"/></svg></span>
					<span class="node__t">Mains and solar input</span>
					<span class="node__m">Grid feed, renewable setups</span>
				</li>
				<li class="node node--power" data-layer="power">
					<span class="node__sym" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 7.5h15v9H3zM18 10.5h2.5v3H18M10.5 9.5l-2 3h3l-2 3"/></svg></span>
					<span class="node__t">UPS and battery</span>
					<span class="node__m">VRLA, lithium-ion · Eaton, APC, Vertiv, BPC</span>
				</li>
				<li class="node node--power" data-layer="power it">
					<span class="node__sym" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3.5v5M5.5 8.5h13M5.5 8.5v4M12 8.5v4M18.5 8.5v4M3.5 12.5h4v6h-4zM10 12.5h4v6h-4zM16.5 12.5h4v6h-4z"/></svg></span>
					<span class="node__t">Power distribution</span>
					<span class="node__m">PDUs, rack power, cooling integration</span>
				</li>
				<li class="node node--it" data-layer="it">
					<span class="node__sym" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 4h16v7H4zM4 13h16v7H4zM7.5 7.5h3M7.5 16.5h3M16 7.5h1M16 16.5h1"/></svg></span>
					<span class="node__t">Servers, storage, cloud</span>
					<span class="node__m">Dell, HPE, Lenovo, Supermicro · AWS, Azure</span>
				</li>
				<li class="node node--it" data-layer="it security">
					<span class="node__sym" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 3.5 19 6v5.5c0 4.4-3 7.4-7 9-4-1.6-7-4.6-7-9V6z"/><path d="m9 12 2 2 4-4"/></svg></span>
					<span class="node__t">Network and firewall</span>
					<span class="node__m">Cisco, Fortinet, Aruba, Sophos</span>
				</li>
				<li class="node node--sec" data-layer="security">
					<span class="node__sym" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m3.5 9 11-3 1.8 5-11 3z"/><path d="m16.3 9.6 3.7 1.4-1 2.6-3.6-1.3M8.5 12.6 7.5 19M4.5 19h6"/></svg></span>
					<span class="node__t">Surveillance</span>
					<span class="node__m">CCTV cameras and recorders · Hikvision</span>
				</li>
			</ol>
			<figcaption class="inspector" aria-live="polite">
				<span class="inspector__k" data-insp-k>All layers</span>
				<span class="inspector__v" data-chain-cap>Six layers, one supplier. If the UPS fails, so does everything under it.</span>
			</figcaption>
		</figure>
	</div>
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
				<a class="link link--night" href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>#power">Compare battery types</a>
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

<!-- VENDOR WALL (Brex logo band, Ramp hairline logo grid) -->
<section class="vendors">
	<div class="wrap">
		<div class="sec-head">
			<h2>Thirty manufacturers, one supplier.</h2>
			<p>We supply, install and maintain equipment from these brands, grouped by the layer they sit in.</p>
		</div>
		<?php get_template_part( 'parts/logo-wall' ); ?>
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

<!-- INDUSTRIES (Ramp horizontal card row with boxed arrow controls) -->
<section class="industries">
	<div class="wrap">
		<div class="sec-head sec-head--row">
			<div>
				<h2>Built for organisations that cannot go offline.</h2>
				<p>Nine sectors, each with its own mix of uptime, security and compliance pressure.</p>
			</div>
		</div>
	</div>
	<div class="rail" data-rail tabindex="0" aria-label="Industries">
		<ul class="rail__track">
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
	<div class="wrap">
		<div class="rail__ctrl">
			<button type="button" class="sqbtn" data-rail-prev aria-label="Previous industries"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 5l-7 7 7 7"/></svg></button>
			<button type="button" class="sqbtn" data-rail-next aria-label="Next industries"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 5l7 7-7 7"/></svg></button>
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
