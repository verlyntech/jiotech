<?php
/**
 * Careers (slug: careers). Uses the service-page layout styles (.svc-*).
 */
get_header(); ?>

<main id="main" class="svc">

<section class="svc-hero" aria-labelledby="careers-title">
	<div class="wrap svc-hero__grid">
		<div class="svc-hero__copy">
			<nav class="svc-crumb" aria-label="Breadcrumb"><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Company</a><span aria-hidden="true">/</span><span aria-current="page">Careers</span></nav>
			<h1 id="careers-title">Start your journey.</h1>
			<p class="svc-hero__lead">Grow your career as we grow.</p>
			<p class="svc-hero__intro">JIO Technologies works across IT infrastructure, energy systems and cloud. From our base in Abu Dhabi, the team builds smarter, secure and sustainable systems for organisations across the UAE. If you are passionate about technology and committed to doing the job well, we want to hear from you.</p>
			<div class="svc-hero__actions">
				<!-- Point this at the recruitment portal once JIO confirms its address. -->
				<a class="btn-arrow" href="https://www.linkedin.com/company/jio-technologies-llc"><span>See open positions</span><span class="btn-arrow__box"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg></span></a>
				<a class="link" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About JIO</a>
			</div>
		</div>
		<figure class="svc-media svc-media--photo">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/careers-office-atrium.webp" width="1402" height="1122" alt="Illustration of a light-filled technology workplace atrium with a glass and timber staircase" loading="eager" fetchpriority="high" decoding="async">
			<figcaption>Illustrative image</figcaption>
		</figure>
	</div>
</section>

<section class="svc-included" aria-labelledby="careers-who-title">
	<div class="wrap">
		<div class="svc-head"><p class="label">Who we hire</p><h2 id="careers-who-title">People who like solving real problems.</h2></div>
		<ol class="svc-cards svc-cards--5">
			<li><span class="svc-cards__num">01</span><h3>Passionate</h3><p>Curious about technology and energy, and keen to learn how the two fit together.</p></li>
			<li><span class="svc-cards__num">02</span><h3>Proactive</h3><p>Problem-solvers who spot the issue before the client does.</p></li>
			<li><span class="svc-cards__num">03</span><h3>Team players</h3><p>Clear communicators who work well with colleagues and clients.</p></li>
			<li><span class="svc-cards__num">04</span><h3>Adaptable</h3><p>Comfortable picking up new tools, trends and challenges.</p></li>
			<li><span class="svc-cards__num">05</span><h3>Committed</h3><p>Dedicated to delivering excellent work for every client.</p></li>
		</ol>
	</div>
</section>

<section class="svc-fit" aria-labelledby="careers-offer-title">
	<div class="wrap svc-fit__grid">
		<figure class="svc-media svc-media--wide svc-media--photo">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/careers-learning-lab.webp" width="1586" height="992" alt="Illustration of an empty training laboratory with networking and low-voltage energy learning benches" loading="lazy" decoding="async">
			<figcaption>Illustrative image</figcaption>
		</figure>
		<div class="svc-fit__copy">
			<p class="label">What you get</p>
			<h2 id="careers-offer-title">A long-term career, not just a job.</h2>
			<p>You will work on IT and power projects for government, enterprise and industrial clients, learn both sides of the infrastructure, and grow with the company.</p>
			<p class="svc-fit__brands">Benefits</p>
			<ul class="svc-tags"><li>Competitive salaries</li><li>Performance-based rewards</li><li>Health &amp; wellness benefits</li><li>Training &amp; certification sponsorship</li><li>Career growth pathways</li></ul>
		</div>
	</div>
</section>

<section class="svc-process" aria-labelledby="careers-apply-title">
	<div class="wrap">
		<div class="svc-head"><p class="label">How to apply</p><h2 id="careers-apply-title">Three steps to joining the team.</h2></div>
		<ol class="svc-steps">
			<li><span class="svc-steps__num">01</span><h3>Find a role</h3><p>Open positions are listed on our recruitment portal.</p></li>
			<li><span class="svc-steps__num">02</span><h3>Apply</h3><p>Send your application and CV through the listing.</p></li>
			<li><span class="svc-steps__num">03</span><h3>Meet the team</h3><p>If your experience fits, we will contact you to arrange a conversation.</p></li>
		</ol>
	</div>
</section>

<section class="svc-related" aria-labelledby="careers-more-title">
	<div class="wrap">
		<div class="svc-head"><p class="label">Get to know JIO</p><h2 id="careers-more-title">See what the team works on.</h2></div>
		<ul class="svc-links">
			<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><span>Our company</span><span class="svc-links__arrow" aria-hidden="true">&#8599;</span></a></li>
			<li><a href="<?php echo esc_url( home_url( '/solutions/' ) ); ?>"><span>Our services</span><span class="svc-links__arrow" aria-hidden="true">&#8599;</span></a></li>
			<li><a href="<?php echo esc_url( home_url( '/industries/' ) ); ?>"><span>Industries we serve</span><span class="svc-links__arrow" aria-hidden="true">&#8599;</span></a></li>
		</ul>
	</div>
</section>

</main>

<?php get_footer(); ?>
