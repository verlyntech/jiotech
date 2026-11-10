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
		<!-- Generated illustration of the connected infrastructure behind different industries. -->
		<figure class="industry-hero__media industry-hero__media--image">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/industries-it-team.webp" width="1402" height="1122" alt="Illustration of IT colleagues reviewing network dashboards while a technician works on server cabling in a modern UAE workspace" loading="eager" decoding="async">
			<figcaption>Your industry. Connected.</figcaption>
		</figure>
	</div>
</section>

<section class="sectors" aria-labelledby="sectors-heading">
	<div class="wrap">
		<div class="sec-head">
			<h2 id="sectors-heading">Built around your operating environment.</h2>
			<p>Every sector has different priorities. Explore how we connect IT, security and power to support yours.</p>
		</div>
		<div class="industry-explorer" data-industry-explorer>
            <div class="industry-orbit">
                <svg class="industry-orbit__track" viewBox="0 0 520 520" aria-hidden="true"><circle cx="260" cy="260" r="198"/><circle class="industry-orbit__inner-track" cx="260" cy="260" r="130"/><g class="industry-orbit__traveler"><circle class="industry-orbit__point" cx="260" cy="62" r="5"/></g></svg>
                <div class="industry-orbit__hub"><strong>Connected<br>expertise.</strong><span>Nine industries.<br>One infrastructure partner.</span></div>
                <div class="industry-orbit__nav" aria-label="Choose your industry" data-industry-nav>
					<a class="industry-orbit__node" id="industry-tab-government" href="#government" data-industry-tab="government" style="--node-x:50.000%;--node-y:12.000%" aria-controls="government">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M8 25L32 10l24 15H8zM12 52h40M8 58h48M16 30v17M27 30v17M38 30v17M49 30v17"/>
						<path class="sector-card__accent" d="M32 4v7"/>
						<path class="sector-card__accent" d="M16 47V30M27 47V30M38 47V30M49 47V30"/>
					</svg><span class="industry-orbit__label">Government</span><span class="sr-only">Government &amp; public sector</span>
                    </a>
					<a class="industry-orbit__node" id="industry-tab-healthcare" href="#healthcare" data-industry-tab="healthcare" style="--node-x:74.426%;--node-y:20.890%" aria-controls="healthcare">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M12 56V13h40v43M6 56h52M25 56V45h14v11"/>
						<path class="sector-card__accent" d="M29 22v-5h6v5h5v6h-5v5h-6v-5h-5v-6z"/>
						<path class="sector-card__accent" d="M5 39h16l4-5 6 10 6-9 4 4h18"/>
					</svg><span class="industry-orbit__label">Healthcare</span><span class="sr-only">Healthcare</span>
                    </a>
					<a class="industry-orbit__node" id="industry-tab-finance" href="#finance" data-industry-tab="finance" style="--node-x:87.423%;--node-y:43.401%" aria-controls="finance">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M8 26L32 11l24 15H8zM15 31v17M26 31v17M8 55h20M12 49h16"/>
						<path class="sector-card__accent" d="M45 31l13 5v10c0 6-5 11-13 15-8-4-13-9-13-15V36z"/>
						<path class="sector-card__accent" d="M38 45l6 6 9-12"/>
					</svg><span class="industry-orbit__label">Banking</span><span class="sr-only">Banking &amp; financial services</span>
                    </a>
					<a class="industry-orbit__node" id="industry-tab-energy" href="#energy" data-industry-tab="energy" style="--node-x:82.909%;--node-y:69.000%" aria-controls="energy">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M5 17h18M5 29h12M5 43h14M43 45h16M48 33h11"/>
						<path class="sector-card__accent" d="M36 5L18 35h16l-6 24 22-34H34z"/>
						<path class="sector-card__accent" d="M5 17h18M5 29h12M5 43h14M43 45h16M48 33h11"/>
					</svg><span class="industry-orbit__label">Energy</span><span class="sr-only">Energy &amp; utilities</span>
                    </a>
					<a class="industry-orbit__node" id="industry-tab-manufacturing" href="#manufacturing" data-industry-tab="manufacturing" style="--node-x:62.997%;--node-y:85.708%" aria-controls="manufacturing">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M8 56V30l15-10v10l15-10v36H8zM38 56h18V12H46v22M15 41h5M27 41h5M15 49h5M27 49h5"/>
						<path class="sector-card__accent" d="M15 41h5M27 41h5M15 49h5M27 49h5M51 8V3"/>
					</svg><span class="industry-orbit__label">Manufacturing</span><span class="sr-only">Manufacturing &amp; industrial</span>
                    </a>
					<a class="industry-orbit__node" id="industry-tab-construction" href="#construction" data-industry-tab="construction" style="--node-x:37.003%;--node-y:85.708%" aria-controls="construction">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M18 58V8h8v50M10 58h24M6 17h50V9H18M26 17l-8 12 8 12-8 12M47 17v19"/>
						<path class="sector-card__accent" d="M41 36h12v11H41z"/>
						<path class="sector-card__accent" d="M26 17l-8 12 8 12-8 12M47 17v19"/>
						<path class="sector-card__accent" d="M41 36h12v11H41z"/>
					</svg><span class="industry-orbit__label">Construction</span><span class="sr-only">Construction &amp; engineering</span>
                    </a>
					<a class="industry-orbit__node" id="industry-tab-logistics" href="#logistics" data-industry-tab="logistics" style="--node-x:17.091%;--node-y:69.000%" aria-controls="logistics">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M5 18h32v27H5zM37 28h13l9 12v9h-5M37 49H22M45 31v10h13"/>
						<circle cx="16" cy="50" r="6"/><circle cx="48" cy="50" r="6"/>
						<path class="sector-card__accent" d="M31 10H6M28 28H8M23 35H8"/>
						<path class="sector-card__accent" d="M12 50h8M16 46v8"/>
						<path class="sector-card__accent" d="M44 50h8M48 46v8"/>
					</svg><span class="industry-orbit__label">Logistics</span><span class="sr-only">Logistics &amp; transportation</span>
                    </a>
					<a class="industry-orbit__node" id="industry-tab-retail" href="#retail" data-industry-tab="retail" style="--node-x:12.577%;--node-y:43.401%" aria-controls="retail">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M11 21h42l4 36H7zM22 24V15a10 10 0 0 1 20 0v9"/>
						<path class="sector-card__accent" d="M22 24V15a10 10 0 0 1 20 0v9"/>
						<path class="sector-card__accent" d="M18 35h28M18 42h28M18 49h28"/>
					</svg><span class="industry-orbit__label">Retail</span><span class="sr-only">Retail &amp; e-commerce</span>
                    </a>
					<a class="industry-orbit__node" id="industry-tab-education" href="#education" data-industry-tab="education" style="--node-x:25.574%;--node-y:20.890%" aria-controls="education">
                        <svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M6 28c10-3 18-1 26 4 8-5 16-7 26-4v28c-10-3-18-1-26 4-8-5-16-7-26-4zM32 32v28"/>
						<path class="sector-card__accent" d="M10 13L32 4l22 9-22 9zM18 17v7M46 17v7M54 13v13"/>
						<path class="sector-card__accent" d="M12 36l13 3M12 43l13 3M39 39l13-3M39 46l13-3"/>
					</svg><span class="industry-orbit__label">Education</span><span class="sr-only">Education</span>
                    </a>
                </div>
                <p class="industry-orbit__hint">Select an industry to explore</p>
            </div>
            <div class="industry-explorer__details">
				<article class="industry-detail" id="government" data-industry-panel="government" aria-labelledby="industry-title-government">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>01 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M8 25L32 10l24 15H8zM12 52h40M8 58h48M16 30v17M27 30v17M38 30v17M49 30v17"/>
						<path class="sector-card__accent" d="M32 4v7"/>
						<path class="sector-card__accent" d="M16 47V30M27 47V30M38 47V30M49 47V30"/>
					</svg></div>
                    <h3 id="industry-title-government">Government &amp; public sector</h3>
                    <p>Secure, scalable infrastructure for public services and modernisation programmes, with connected systems and dependable backup power.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
				<article class="industry-detail" id="healthcare" data-industry-panel="healthcare" aria-labelledby="industry-title-healthcare">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>02 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M12 56V13h40v43M6 56h52M25 56V45h14v11"/>
						<path class="sector-card__accent" d="M29 22v-5h6v5h5v6h-5v5h-6v-5h-5v-6z"/>
						<path class="sector-card__accent" d="M5 39h16l4-5 6 10 6-9 4 4h18"/>
					</svg></div>
                    <h3 id="industry-title-healthcare">Healthcare</h3>
                    <p>Connected infrastructure that supports clinical systems, protects patient information and keeps essential equipment powered.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
				<article class="industry-detail" id="finance" data-industry-panel="finance" aria-labelledby="industry-title-finance">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>03 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M8 26L32 11l24 15H8zM15 31v17M26 31v17M8 55h20M12 49h16"/>
						<path class="sector-card__accent" d="M45 31l13 5v10c0 6-5 11-13 15-8-4-13-9-13-15V36z"/>
						<path class="sector-card__accent" d="M38 45l6 6 9-12"/>
					</svg></div>
                    <h3 id="industry-title-finance">Banking &amp; financial services</h3>
                    <p>Resilient hosting, secure connectivity and backup power for demanding financial operations and business continuity requirements.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
				<article class="industry-detail" id="energy" data-industry-panel="energy" aria-labelledby="industry-title-energy">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>04 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M5 17h18M5 29h12M5 43h14M43 45h16M48 33h11"/>
						<path class="sector-card__accent" d="M36 5L18 35h16l-6 24 22-34H34z"/>
						<path class="sector-card__accent" d="M5 17h18M5 29h12M5 43h14M43 45h16M48 33h11"/>
					</svg></div>
                    <h3 id="industry-title-energy">Energy &amp; utilities</h3>
                    <p>Integrated UPS, battery systems and monitoring to support the availability and performance of critical facilities.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
				<article class="industry-detail" id="manufacturing" data-industry-panel="manufacturing" aria-labelledby="industry-title-manufacturing">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>05 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M8 56V30l15-10v10l15-10v36H8zM38 56h18V12H46v22M15 41h5M27 41h5M15 49h5M27 49h5"/>
						<path class="sector-card__accent" d="M15 41h5M27 41h5M15 49h5M27 49h5M51 8V3"/>
					</svg></div>
                    <h3 id="industry-title-manufacturing">Manufacturing &amp; industrial</h3>
                    <p>Plant networks, backup power and infrastructure designed to support production systems and continuous operations.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
				<article class="industry-detail" id="construction" data-industry-panel="construction" aria-labelledby="industry-title-construction">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>06 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M18 58V8h8v50M10 58h24M6 17h50V9H18M26 17l-8 12 8 12-8 12M47 17v19"/>
						<path class="sector-card__accent" d="M41 36h12v11H41z"/>
						<path class="sector-card__accent" d="M26 17l-8 12 8 12-8 12M47 17v19"/>
						<path class="sector-card__accent" d="M41 36h12v11H41z"/>
					</svg></div>
                    <h3 id="industry-title-construction">Construction &amp; engineering</h3>
                    <p>Reliable site networks, surveillance and power for project offices, active developments and engineering teams.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
				<article class="industry-detail" id="logistics" data-industry-panel="logistics" aria-labelledby="industry-title-logistics">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>07 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M5 18h32v27H5zM37 28h13l9 12v9h-5M37 49H22M45 31v10h13"/>
						<circle cx="16" cy="50" r="6"/><circle cx="48" cy="50" r="6"/>
						<path class="sector-card__accent" d="M31 10H6M28 28H8M23 35H8"/>
						<path class="sector-card__accent" d="M12 50h8M16 46v8"/>
						<path class="sector-card__accent" d="M44 50h8M48 46v8"/>
					</svg></div>
                    <h3 id="industry-title-logistics">Logistics &amp; transportation</h3>
                    <p>Connected networks, tracking infrastructure and dependable power across warehouses, distribution sites and transport operations.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
				<article class="industry-detail" id="retail" data-industry-panel="retail" aria-labelledby="industry-title-retail">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>08 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M11 21h42l4 36H7zM22 24V15a10 10 0 0 1 20 0v9"/>
						<path class="sector-card__accent" d="M22 24V15a10 10 0 0 1 20 0v9"/>
						<path class="sector-card__accent" d="M18 35h28M18 42h28M18 49h28"/>
					</svg></div>
                    <h3 id="industry-title-retail">Retail &amp; e-commerce</h3>
                    <p>Connected stores and cloud infrastructure with security for digital commerce, checkout systems and customer-facing operations.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
				<article class="industry-detail" id="education" data-industry-panel="education" aria-labelledby="industry-title-education">
                    <div class="industry-detail__meta"><span>SECTOR EXPERTISE</span><span>09 / 09</span></div>
                    <div class="industry-detail__icon"><svg viewBox="0 0 64 64" aria-hidden="true">
						<path d="M6 28c10-3 18-1 26 4 8-5 16-7 26-4v28c-10-3-18-1-26 4-8-5-16-7-26-4zM32 32v28"/>
						<path class="sector-card__accent" d="M10 13L32 4l22 9-22 9zM18 17v7M46 17v7M54 13v13"/>
						<path class="sector-card__accent" d="M12 36l13 3M12 43l13 3M39 39l13-3M39 46l13-3"/>
					</svg></div>
                    <h3 id="industry-title-education">Education</h3>
                    <p>Secure campus connectivity, digital learning platforms and efficient power infrastructure for teaching and campus operations.</p>
                    <a class="link-line" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Discuss your requirements <span aria-hidden="true">↗</span></a>
                </article>
            </div>
        </div>
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

<!-- WHY INDUSTRY EXPERTISE: four reasons, same card row as the service pages. -->
<section class="industry-why" aria-labelledby="industry-why-title">
	<div class="wrap">
		<div class="svc-head"><p class="label">Industry expertise</p><h2 id="industry-why-title">Why industry expertise matters for IT.</h2><p>Whatever your sector, the IT and power behind it should be built for its reliability, security and compliance needs.</p></div>
		<ol class="svc-cards">
			<li><span class="svc-cards__num">01</span><h3>Compliance</h3><p>Healthcare, banking and government work comes with regulatory and audit requirements. We plan IT and power setups around them, with documentation that supports your audits.</p></li>
			<li><span class="svc-cards__num">02</span><h3>Sector systems</h3><p>From hospital applications to plant controls, the systems your sector runs depend on stable networks and power. We design around the systems you already use.</p></li>
			<li><span class="svc-cards__num">03</span><h3>Security</h3><p>Some sectors are targeted more often than others. Firewalls, endpoint protection and CCTV are sized to the risk your organisation faces.</p></li>
			<li><span class="svc-cards__num">04</span><h3>Backup power to standard</h3><p>Critical sites need UPS and battery setups built to the safety and audit requirements of their sector, and maintained to stay that way.</p></li>
		</ol>
	</div>
</section>

</main>

<?php get_footer(); ?>
