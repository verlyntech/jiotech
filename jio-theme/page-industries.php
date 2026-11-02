<?php
/** Industries. */
get_header(); ?>

<main id="main">

<section class="industry-hero">
	<div class="wrap industry-hero__grid">
		<div class="industry-hero__copy">
			<h1>Managed IT &amp; energy services for your industry.</h1>
			<p class="industry-hero__lead">Infrastructure shaped around the way your organisation operates.</p>
			<p>JIO brings managed IT, secure connectivity and dependable power together. We align your systems with the demands of your sector, helping you maintain continuity today and plan for what comes next.</p>
			<a class="btn-arrow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Discuss your requirements</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
		</div>
		<!-- Replace this placeholder with the client's industry photograph, keeping the figure dimensions. -->
		<figure class="industry-hero__media" aria-label="Image space reserved for industry photography">
			<svg class="industry-hero__placeholder" viewBox="0 0 120 90" aria-hidden="true"><path d="M18 18h84v54H18zM30 10h60M30 80h60M18 61l25-21 18 15 19-26 22 32"/><circle cx="43" cy="33" r="5"/></svg>
			<figcaption>Your industry. Connected.</figcaption>
		</figure>
	</div>
	<div class="wrap"><ul class="industry-hero__scope"><li>Managed IT</li><li>Resilient power</li><li>Secure connectivity</li></ul></div>
</section>

<section class="sectors" aria-labelledby="sectors-heading">
	<div class="wrap">
		<div class="sec-head">
			<h2 id="sectors-heading">Built around your operating environment.</h2>
			<p>Every sector has different priorities. Explore how we connect IT, security and power to support yours.</p>
		</div>
		<ul class="sector-list">
			<li id="government">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M8 25L32 10l24 15H8zM12 52h40M8 58h48M16 30v17M27 30v17M38 30v17M49 30v17"/><path class="sector-card__accent" d="M32 4v7M26 39h12v13"/></svg><span aria-hidden="true">01</span></div>
				<h2>Government &amp; public sector</h2>
				<p>Secure, scalable infrastructure for public services and modernisation programmes, with connected systems and dependable backup power.</p>
				<ul class="pills"><li class="t-it">Data centers</li><li class="t-it">Secured networks</li><li class="t-power">Backup power</li></ul>
			</li>
			<li id="healthcare">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M12 56V13h40v43M6 56h52M25 56V43h14v13M19 35h5M40 35h5"/><path class="sector-card__accent" d="M29 20v-5h6v5h5v6h-5v5h-6v-5h-5v-6z"/></svg><span aria-hidden="true">02</span></div>
				<h2>Healthcare</h2>
				<p>Connected infrastructure that supports clinical systems, protects patient information and keeps essential equipment powered.</p>
				<ul class="pills"><li class="t-power">Continuous power</li><li class="t-it">Network security</li><li class="t-sec">CCTV</li></ul>
			</li>
			<li id="finance">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M8 26L32 11l24 15H8zM15 31v17M26 31v17M8 55h28M12 49h21"/><path class="sector-card__accent" d="M46 32l12 5v9c0 7-5 12-12 16-7-4-12-9-12-16v-9zM40 46l4 4 8-10"/></svg><span aria-hidden="true">03</span></div>
				<h2>Banking &amp; financial services</h2>
				<p>Resilient hosting, secure connectivity and backup power for demanding financial operations and business continuity requirements.</p>
				<ul class="pills"><li class="t-it">Resilient hosting</li><li class="t-it">Cybersecurity</li><li class="t-power">UPS</li></ul>
			</li>
			<li id="energy">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M8 13h17M8 24h12M8 35h9M8 46h15M40 51h16M45 40h11M49 29h7"/><path class="sector-card__accent" d="M36 5L18 35h16l-6 24 22-34H34z"/></svg><span aria-hidden="true">04</span></div>
				<h2>Energy &amp; utilities</h2>
				<p>Integrated UPS, battery systems and monitoring to support the availability and performance of critical facilities.</p>
				<ul class="pills"><li class="t-power">UPS integration</li><li class="t-power">Battery systems</li><li class="t-it">Monitoring</li></ul>
			</li>
			<li id="manufacturing">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M8 56V30l15-10v10l15-10v36H8zM38 56h18V12H46v22M15 41h5M27 41h5M15 49h5M27 49h5"/><path class="sector-card__accent" d="M46 6h10M46 22h10M43 45h8"/></svg><span aria-hidden="true">05</span></div>
				<h2>Manufacturing &amp; industrial</h2>
				<p>Plant networks, backup power and infrastructure designed to support production systems and continuous operations.</p>
				<ul class="pills"><li class="t-it">Plant networks</li><li class="t-power">Backup power</li><li class="t-it">Automation-ready IT</li></ul>
			</li>
			<li id="construction">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M18 58V8h8v50M10 58h24M6 17h50V9H18M26 17l-8 12 8 12-8 12M47 17v18"/><path class="sector-card__accent" d="M42 35h10v9H42zM32 9l15 8M34 9l-8 8"/></svg><span aria-hidden="true">06</span></div>
				<h2>Construction &amp; engineering</h2>
				<p>Reliable site networks, surveillance and power for project offices, active developments and engineering teams.</p>
				<ul class="pills"><li class="t-it">Site networks</li><li class="t-sec">Surveillance</li><li class="t-power">Site power</li></ul>
			</li>
			<li id="logistics">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M5 18h32v31H5zM37 28h13l9 12v9H37M45 31v10h13"/><circle cx="16" cy="50" r="6"/><circle cx="48" cy="50" r="6"/><path class="sector-card__accent" d="M11 11h20M11 27h20M11 34h12"/></svg><span aria-hidden="true">07</span></div>
				<h2>Logistics &amp; transportation</h2>
				<p>Connected networks, tracking infrastructure and dependable power across warehouses, distribution sites and transport operations.</p>
				<ul class="pills"><li class="t-it">Connected networks</li><li class="t-it">IoT tracking</li><li class="t-power">Reliable power</li></ul>
			</li>
			<li id="retail">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M11 21h42l4 36H7zM22 24V15a10 10 0 0 1 20 0v9"/><path class="sector-card__accent" d="M22 38h20M22 45h13"/></svg><span aria-hidden="true">08</span></div>
				<h2>Retail &amp; e-commerce</h2>
				<p>Connected stores and cloud infrastructure with security for digital commerce, checkout systems and customer-facing operations.</p>
				<ul class="pills"><li class="t-it">Store connectivity</li><li class="t-it">Cloud</li><li class="t-it">Payment security</li></ul>
			</li>
			<li id="education">
				<div class="sector-card__top"><svg viewBox="0 0 64 64" aria-hidden="true"><path d="M6 28c10-3 18-1 26 4 8-5 16-7 26-4v28c-10-3-18-1-26 4-8-5-16-7-26-4zM32 32v28"/><path class="sector-card__accent" d="M10 13L32 4l22 9-22 9zM18 17v8M46 17v8M54 13v14"/></svg><span aria-hidden="true">09</span></div>
				<h2>Education</h2>
				<p>Secure campus connectivity, digital learning platforms and efficient power infrastructure for teaching and campus operations.</p>
				<ul class="pills"><li class="t-it">Campus networks</li><li class="t-it">Learning platforms</li><li class="t-power">Efficient power</li></ul>
			</li>
		</ul>
		<div class="sectors__more" data-sector-motion>
			<div class="sectors__more-copy">
				<h2>Not on the list?</h2>
				<p>Your infrastructure needs are the starting point. Tell us about your sites, systems and priorities, and we will help shape an IT and power solution around your operation.</p>
				<a class="btn-arrow" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Let’s discuss your business</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
			</div>
			<svg class="sector-network" viewBox="0 0 360 230" aria-hidden="true">
				<g class="sector-network__tracks"><path d="M50 50h60v65h45M310 50h-60v65h-45M50 180h60v-65h45M310 180h-60v-65h-45"/></g>
				<g class="sector-network__flow"><path d="M50 50h60v65h45M310 50h-60v65h-45"/></g>
				<g class="sector-network__flow sector-network__flow--blue"><path d="M50 180h60v-65h45M310 180h-60v-65h-45"/></g>
				<g class="sector-network__nodes"><path d="M25 25h50v50H25zM285 25h50v50h-50zM25 155h50v50H25zM285 155h50v50h-50z"/><path d="M36 37h28v9H36zM36 53h28v9H36zM296 40h28v20h-28zM303 32h14M296 49h28M36 171h28v18H36zM44 163v8M56 163v8M296 170h28v20h-28zM302 177h16M302 183h10"/></g>
				<rect class="sector-network__pulse" x="144" y="79" width="72" height="72"/>
				<rect class="sector-network__hub" x="150" y="85" width="60" height="60"/>
				<path class="sector-network__building" d="M167 128v-26h26v26M162 128h36M173 108h4M183 108h4M173 115h4M183 115h4M178 128v-7h6v7"/>
				<text x="180" y="174" text-anchor="middle">YOUR BUSINESS</text>
			</svg>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
