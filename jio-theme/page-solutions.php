<?php
/**
 * Services (slug: solutions).
 */
get_header(); ?>

<main id="main">

<!-- PAGE HERO: asymmetric split (Brex) -->
<section class="phero">
	<div class="wrap phero__grid">
		<h1>Every layer from the battery string to the firewall.</h1>
		<div class="phero__side">
			<p>Twelve services in four groups. Each group sits on the one before it, which is why we sell and support them together.</p>
			<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Get a quote</a>
		</div>
	</div>
</section>

<!-- LOCAL NAV: sticky product nav (Apple) -->
<nav class="localnav" aria-label="Service groups" data-localnav>
	<div class="wrap localnav__row">
		<a href="#power">Power</a>
		<a href="#datacenter">Data centers &amp; cloud</a>
		<a href="#network">Network &amp; security</a>
		<a href="#operations">Managed IT &amp; support</a>
		<a href="#equipment">Equipment</a>
	</div>
</nav>

<!-- POWER -->
<section class="group" id="power">
	<div class="wrap group__grid">
		<h2>Power &amp; energy</h2>
		<ul class="rows">
			<li><h3>Power &amp; energy solutions</h3><p>Everything from UPS systems to renewable energy setups, designed for business continuity and lower running cost.</p></li>
			<li><h3>UPS, VRLA and lithium battery solutions</h3><p>Installation, configuration, preventive maintenance, battery replacement and annual service contracts in Dubai and Abu Dhabi.</p></li>
			<li><h3>Smart infrastructure &amp; sustainability</h3><p>Power usage, IT performance and environmental impact measured and managed as one system.</p></li>
		</ul>
	</div>

	<!-- COMPARISON PANEL (Apple dark comparison stage) -->
	<div class="wrap">
		<div class="compare">
			<div class="compare__head">
				<h3>VRLA or lithium-ion?</h3>
				<p>The battery string decides how long a UPS lasts and how often you pay for it again. In a hot plant room, that difference is large.</p>
			</div>
			<div class="compare__table" role="table" aria-label="VRLA and lithium-ion compared">
				<div class="compare__row compare__row--head" role="row">
					<span role="columnheader"></span><span role="columnheader">VRLA</span><span role="columnheader">Lithium-ion</span>
				</div>
				<div class="compare__row" role="row"><span role="rowheader">Typical service life</span><span role="cell">3 to 5 years</span><span role="cell">10 to 15 years</span></div>
				<div class="compare__row" role="row"><span role="rowheader">Heat tolerance</span><span role="cell">Life roughly halves for every 8 to 10&nbsp;°C above 25&nbsp;°C</span><span role="cell">Tolerates higher room temperatures</span></div>
				<div class="compare__row" role="row"><span role="rowheader">Footprint and weight</span><span role="cell">Larger, heavier</span><span role="cell">Roughly half the space and weight</span></div>
				<div class="compare__row" role="row"><span role="rowheader">Purchase price</span><span role="cell">Lower</span><span role="cell">Higher</span></div>
				<div class="compare__row" role="row"><span role="rowheader">Best for</span><span role="cell">Smaller loads, cooled rooms, tight budgets</span><span role="cell">Data halls, hot rooms, long ownership</span></div>
			</div>
			<p class="compare__note">Typical industry figures. Real numbers depend on the model, load and room conditions; we size each string for the site.</p>
		</div>
	</div>
</section>

<!-- DATA CENTERS & CLOUD -->
<section class="group group--alt" id="datacenter">
	<div class="wrap group__grid">
		<h2>Data centers &amp; cloud</h2>
		<ul class="rows">
			<li><h3>Data center design &amp; hosting</h3><p>Design, construction and management of data centers, from a single rack to enterprise halls, including cabling, power integration and cooling. Secure hosting for critical applications.</p></li>
			<li><h3>Cloud &amp; hybrid infrastructure</h3><p>Private, public or hybrid cloud environments designed, deployed and managed on AWS, Microsoft Azure, Google Cloud and Oracle Cloud.</p></li>
		</ul>
	</div>
</section>

<!-- NETWORK & SECURITY -->
<section class="group" id="network">
	<div class="wrap group__grid">
		<h2>Network &amp; security</h2>
		<ul class="rows">
			<li><h3>Network &amp; connectivity</h3><p>End-to-end networking, from infrastructure setup to optimisation: LAN and WAN design, wireless, and network security for hybrid workplaces.</p></li>
			<li><h3>Cybersecurity &amp; data protection</h3><p>Security for digital assets with continuous monitoring and proactive threat detection.</p></li>
			<li><h3>CCTV &amp; physical security</h3><p>Camera and recorder installation, remote monitoring, and integration with the IT network.</p></li>
		</ul>
	</div>
</section>

<!-- OPERATIONS -->
<section class="group group--alt" id="operations">
	<div class="wrap group__grid">
		<h2>Managed IT &amp; support</h2>
		<ul class="rows">
			<li><h3>Managed IT &amp; infrastructure</h3><p>Your IT estate managed from servers to end-user support, so your own team is not tied up in daily maintenance.</p></li>
			<li><h3>Maintenance &amp; 24/7 technical support</h3><p>Round-the-clock monitoring, preventive maintenance, remote and onsite help, and emergency response.</p></li>
			<li><h3>IT consulting &amp; digital transformation</h3><p>IT planning, cloud migration and technology integration tied to the business plan.</p></li>
			<li><h3>IT procurement &amp; vendor management</h3><p>Networking gear, servers, storage, UPS units and power distribution supplied from one purchase order.</p></li>
		</ul>
	</div>
</section>

<!-- EQUIPMENT CATALOGUE (teenage engineering ruled product grid) -->
<section class="catalogue" id="equipment">
	<div class="wrap">
		<div class="sec-head">
			<h2>Equipment we supply and install.</h2>
			<p>Bought through us, installed by us, and covered by the same support contract.</p>
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

</main>

<?php get_footer(); ?>
