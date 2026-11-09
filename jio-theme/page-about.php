<?php
/**
 * Company (slug: about).
 */
get_header(); ?>

<main id="main">

<section class="phero">
	<div class="wrap phero__grid">
		<h1>Engineering our next chapter.</h1>
		<div class="phero__side">
			<p>IT, power and industrial products. One team in Abu Dhabi, serving Dubai, Abu Dhabi and the wider GCC.</p>
		</div>
	</div>
</section>

<!-- Three perspectives: one image and one chapter at a time. -->
<section class="company-perspectives" id="company-perspectives" aria-label="Our story, purpose and direction" data-company-perspectives>
    <div class="wrap">
        <div class="company-perspectives__view">
            <nav class="company-perspectives__tabs" aria-label="Company perspectives" data-company-nav>
            <a href="#beginnings" id="company-tab-beginnings" data-company-tab="beginnings" aria-controls="beginnings">Beginnings</a>
            <a href="#mission" id="company-tab-mission" data-company-tab="mission" aria-controls="mission">Mission</a>
            <a href="#vision" id="company-tab-vision" data-company-tab="vision" aria-controls="vision">Vision</a>
            </nav>
            <div class="company-perspectives__panels">
            <article class="company-perspectives__panel" id="beginnings" data-company-panel="beginnings" aria-labelledby="company-title-beginnings">
                <figure class="company-perspectives__media company-perspectives__media--photo">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/company-beginnings.webp" width="1402" height="1122" alt="Illustration of a small engineering team configuring IT hardware in a workshop" loading="lazy" decoding="async">
                    <figcaption><strong>A foundation in engineering.</strong><span>Beginnings · Illustrative image</span></figcaption>
                </figure>
                <div class="company-perspectives__copy">
                    <p class="company-perspectives__number">01 / 03</p>
                    <h2 id="company-title-beginnings">Our beginnings</h2>
                    <p class="company-perspectives__text">JIO Technologies began as a small team of engineers providing IT hardware and infrastructure. It has grown into a hybrid IT and energy provider based in Abu Dhabi, serving Dubai, Abu Dhabi and the wider GCC.</p>
                    <p class="company-perspectives__key">From hardware to hybrid infrastructure.</p>
                </div>
            </article>
            <article class="company-perspectives__panel" id="mission" data-company-panel="mission" aria-labelledby="company-title-mission">
                <figure class="company-perspectives__media company-perspectives__media--photo">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/company-mission-jio-tech.webp" width="1402" height="1122" alt="Illustration of equipment quality checks and customer handover beneath a JIO TECH wall sign" loading="lazy" decoding="async">
                    <figcaption><strong>Purpose behind every solution.</strong><span>Mission · Illustrative image</span></figcaption>
                </figure>
                <div class="company-perspectives__copy">
                    <p class="company-perspectives__number">02 / 03</p>
                    <h2 id="company-title-mission">Our mission</h2>
                    <p class="company-perspectives__text">To be a leading distributor of IT, power and industrial products, known for innovation, reliability and customer service.</p>
                    <p class="company-perspectives__key">Innovation. Reliability. Customer service.</p>
                </div>
            </article>
            <article class="company-perspectives__panel" id="vision" data-company-panel="vision" aria-labelledby="company-title-vision">
                <figure class="company-perspectives__media company-perspectives__media--photo">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/img/company-vision.webp" width="1402" height="1122" alt="Illustration of a modern UAE technology campus combining IT infrastructure, communications and energy systems" loading="lazy" decoding="async">
                    <figcaption><strong>A broader technology horizon.</strong><span>Vision · Illustrative image</span></figcaption>
                </figure>
                <div class="company-perspectives__copy">
                    <p class="company-perspectives__number">03 / 03</p>
                    <h2 id="company-title-vision">Our vision</h2>
                    <p class="company-perspectives__text">To deliver high-quality products across IT, power, telecommunications, computing and machinery.</p>
                    <p class="company-perspectives__key">Quality across connected technologies.</p>
                </div>
            </article>
            </div>
        </div>
        <ul class="company-perspectives__scope"><li>IT infrastructure</li><li>Power &amp; energy</li><li>One connected partner</li></ul>
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
<section class="vendors vendors--paper partner-reveal" id="platform-partners" aria-labelledby="partners-title" data-partner-reveal>
	<div class="wrap">
		<div class="sec-head"><h2 id="partners-title">Platform partners.</h2><p>The manufacturers our solutions are built on.</p></div>
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
