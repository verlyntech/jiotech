<?php
/**
 * Company (slug: about).
 */
get_header(); ?>

<main id="main">

<section class="phero">
	<div class="wrap phero__grid">
		<h1>Started by engineers supplying IT hardware. Now we run the power under it too.</h1>
		<div class="phero__side">
			<p>IT, power and industrial products. One team in Abu Dhabi, serving Dubai, Abu Dhabi and the wider GCC.</p>
		</div>
	</div>
</section>

<!-- Company story: stacked chapters with spaces reserved for the client's three photographs. -->
<section class="company-story" aria-label="Our beginnings, mission and vision">
	<div class="wrap">
		<div class="company-story__list">
			<article class="company-story__entry">
				<span class="company-story__step" aria-hidden="true">01</span>
				<div class="company-story__copy">
					<h2>Our beginnings</h2>
					<p>JIO Technologies began as a small team of engineers providing IT hardware and infrastructure. It has grown into a hybrid IT and energy provider based in Abu Dhabi, serving Dubai, Abu Dhabi and the wider GCC.</p>
				</div>
				<!-- Replace this placeholder with the beginnings photograph; keep the figure and image class. -->
				<figure class="company-story__media company-story__media--placeholder" aria-label="Image space reserved for our beginnings">
					<svg class="company-story__placeholder" viewBox="0 0 96 72" aria-hidden="true"><path d="M12 12h72v48H12z"/><circle cx="34" cy="29" r="5"/><path d="M12 50l20-14 17 13 15-21 20 22M23 6h50M23 66h50"/></svg>
					<figcaption>Our beginnings</figcaption>
				</figure>
			</article>
			<article class="company-story__entry company-story__entry--reverse">
				<span class="company-story__step" aria-hidden="true">02</span>
				<div class="company-story__copy">
					<h2>Mission</h2>
					<p>To be a leading distributor of IT, power and industrial products, known for innovation, reliability and customer service.</p>
				</div>
				<!-- Replace this placeholder with the mission photograph. -->
				<figure class="company-story__media company-story__media--placeholder" aria-label="Image space reserved for our mission">
					<svg class="company-story__placeholder" viewBox="0 0 96 72" aria-hidden="true"><path d="M12 12h72v48H12z"/><circle cx="34" cy="29" r="5"/><path d="M12 50l20-14 17 13 15-21 20 22M23 6h50M23 66h50"/></svg>
					<figcaption>Our mission</figcaption>
				</figure>
			</article>
			<article class="company-story__entry">
				<span class="company-story__step" aria-hidden="true">03</span>
				<div class="company-story__copy">
					<h2>Vision</h2>
					<p>To deliver high-quality products across IT, power, telecommunications, computing and machinery.</p>
				</div>
				<!-- Replace this placeholder with the vision photograph. -->
				<figure class="company-story__media company-story__media--placeholder" aria-label="Image space reserved for our vision">
					<svg class="company-story__placeholder" viewBox="0 0 96 72" aria-hidden="true"><path d="M12 12h72v48H12z"/><circle cx="34" cy="29" r="5"/><path d="M12 50l20-14 17 13 15-21 20 22M23 6h50M23 66h50"/></svg>
					<figcaption>Our vision</figcaption>
				</figure>
			</article>
		</div>
	</div>
</section>

<!-- VALUES: ruled four-column grid (teenage engineering) -->
<section class="values">
	<div class="wrap">
		<div class="sec-head"><h2>How we work.</h2></div>
		<ul class="cat cat--4">
			<li>
				<svg class="values__icon" viewBox="0 0 64 64" width="64" height="64" aria-hidden="true"><path d="M34 6c2 14-17 18-17 34a15 15 0 0 0 30 0c0-7-4-13-9-17 1 8-5 12-5 12s3-17 1-29z"/><path class="values__accent" d="M31 37c0 6-6 8-6 13a7 7 0 0 0 14 0c0-4-3-6-4-8l-4 6z"/></svg>
				<h3>Passionate</h3><p>We care about the systems we install after the invoice is paid.</p>
			</li>
			<li>
				<svg class="values__icon values__icon--it" viewBox="0 0 64 64" width="64" height="64" aria-hidden="true"><path d="M5 28l11-15 10 6-11 17zM59 28L48 13l-10 6 11 17zM18 20l8-5 10 1 7 6M17 34l15 15 6-4M44 33l5 4-11 12-6-1M24 40l-4 4M30 45l-4 4"/><path class="values__accent" d="M40 20l-6-3-13 10 4 5 8-6 11 10M14 39l4 4M50 40l-4 4"/></svg>
				<h3>Respectful</h3><p>Of your site, your staff and your schedule.</p>
			</li>
			<li>
				<svg class="values__icon" viewBox="0 0 64 64" width="64" height="64" aria-hidden="true"><path d="M32 6l20 8v16c0 13-9 21-20 28-11-7-20-15-20-28V14z"/><path class="values__accent" d="M22 31l7 7 14-15"/><path d="M23 12l9-4 9 4"/></svg>
				<h3>Ownership</h3><p>A fault is ours until it is fixed, whichever layer it started in.</p>
			</li>
			<li>
				<svg class="values__icon values__icon--it" viewBox="0 0 64 64" width="64" height="64" aria-hidden="true"><path d="M7 7h15v15H7zM42 7h15v15H42zM7 42h15v15H7zM42 42h15v15H42z"/><path class="values__accent" d="M22 22l10 10 10-10M22 42l10-10 10 10M26 26h12v12H26z"/></svg>
				<h3>Unified</h3><p>One team across IT and energy, not two departments.</p>
			</li>
		</ul>
	</div>
</section>

<!-- PARTNERS (Brex logo band) -->
<section class="vendors vendors--paper">
	<div class="wrap">
		<div class="sec-head"><h2>Platform partners.</h2><p>The manufacturers our solutions are built on.</p></div>
		<?php get_template_part( 'parts/partner-logos' ); ?>
	</div>
</section>

<!-- CAREERS -->
<section class="careers" id="careers">
	<div class="wrap careers__row">
		<div>
			<h2>We are hiring.</h2>
			<p>Open positions in Abu Dhabi are listed on our recruitment portal.</p>
		</div>
		<a class="btn" href="<?php echo esc_url( home_url( '/careers/' ) ); ?>">See open positions</a>
	</div>
</section>

</main>

<?php get_footer(); ?>
