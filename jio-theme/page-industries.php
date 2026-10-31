<?php
/**
 * Industries.
 */
get_header(); ?>

<main id="main">

<section class="phero">
	<div class="wrap phero__grid">
		<h1>Nine sectors where downtime has a cost you can name.</h1>
		<div class="phero__side">
			<p>Each sector weighs uptime, security and compliance differently. The equipment is often the same; the way it is specified, backed up and supported is not.</p>
			<a class="btn" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your site</a>
		</div>
	</div>
</section>

<section class="sectors">
	<div class="wrap">
		<ul class="sector-list">
			<li id="government">
				<h2>Government &amp; public sector</h2>
				<p>Scalable, secure and compliant systems for modernisation and digital transformation programmes.</p>
				<ul class="pills"><li class="t-it">Data centers</li><li class="t-it">Secured networks</li><li class="t-power">Backup power</li></ul>
			</li>
			<li id="healthcare">
				<h2>Healthcare</h2>
				<p>IT and power systems that keep medical devices running, protect patient data and support 24/7 care.</p>
				<ul class="pills"><li class="t-power">Continuous power</li><li class="t-it">Network security</li><li class="t-sec">CCTV</li></ul>
			</li>
			<li id="finance">
				<h2>Banking &amp; financial services</h2>
				<p>Secure, compliant, high-availability IT built for mission-critical financial workloads.</p>
				<ul class="pills"><li class="t-it">Resilient hosting</li><li class="t-it">Cybersecurity</li><li class="t-power">UPS</li></ul>
			</li>
			<li id="energy">
				<h2>Energy &amp; utilities</h2>
				<p>Smart power systems, UPS integration and infrastructure upgrades for critical facilities.</p>
				<ul class="pills"><li class="t-power">UPS integration</li><li class="t-power">Battery systems</li><li class="t-it">Monitoring</li></ul>
			</li>
			<li id="manufacturing">
				<h2>Manufacturing &amp; industrial</h2>
				<p>High-performance networks, backup power and automation-ready infrastructure for continuous operations.</p>
				<ul class="pills"><li class="t-it">Plant networks</li><li class="t-power">Backup power</li><li class="t-it">Automation-ready IT</li></ul>
			</li>
			<li id="construction">
				<h2>Construction &amp; engineering</h2>
				<p>IT setups, surveillance and energy for project sites and corporate offices.</p>
				<ul class="pills"><li class="t-it">Site networks</li><li class="t-sec">Surveillance</li><li class="t-power">Site power</li></ul>
			</li>
			<li id="logistics">
				<h2>Logistics &amp; transportation</h2>
				<p>Connected networks, IoT-enabled tracking and reliable power for operational efficiency.</p>
				<ul class="pills"><li class="t-it">Connected networks</li><li class="t-it">IoT tracking</li><li class="t-power">Reliable power</li></ul>
			</li>
			<li id="retail">
				<h2>Retail &amp; e-commerce</h2>
				<p>Connectivity, cloud systems and security for in-store and online transactions.</p>
				<ul class="pills"><li class="t-it">Store connectivity</li><li class="t-it">Cloud</li><li class="t-it">Payment security</li></ul>
			</li>
			<li id="education">
				<h2>Education</h2>
				<p>Digital learning platforms, secure networks and energy-efficient campus infrastructure.</p>
				<ul class="pills"><li class="t-it">Campus networks</li><li class="t-it">Learning platforms</li><li class="t-power">Efficient power</li></ul>
			</li>
		</ul>
		<div class="sectors__more">
			<h2>Not on the list?</h2>
			<p>The list is not exhaustive. If you run servers, networks or anything that needs backup power, we can help.</p>
			<a class="link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Tell us what you run</a>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
