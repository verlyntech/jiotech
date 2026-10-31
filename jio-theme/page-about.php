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
			<p>JIO Technologies began as a small team of engineers providing IT hardware and infrastructure. It has grown into a hybrid IT and energy provider based in Abu Dhabi, serving Dubai, Abu Dhabi and the wider GCC.</p>
		</div>
	</div>
</section>

<!-- MISSION / VISION: dark stage tiles (Apple) -->
<section class="mv">
	<div class="wrap mv__grid">
		<article class="stage">
			<h2>Mission</h2>
			<p>To be a leading distributor of IT, power and industrial products, known for innovation, reliability and customer service.</p>
		</article>
		<article class="stage">
			<h2>Vision</h2>
			<p>To deliver high-quality products across IT, power, telecommunications, computing and machinery.</p>
		</article>
	</div>
</section>

<!-- VALUES: ruled four-column grid (teenage engineering) -->
<section class="values">
	<div class="wrap">
		<div class="sec-head"><h2>How we work.</h2></div>
		<ul class="cat cat--4">
			<li><h3>Passionate</h3><p>We care about the systems we install after the invoice is paid.</p></li>
			<li><h3>Respectful</h3><p>Of your site, your staff and your schedule.</p></li>
			<li><h3>Ownership</h3><p>A fault is ours until it is fixed, whichever layer it started in.</p></li>
			<li><h3>Unified</h3><p>One team across IT and energy, not two departments.</p></li>
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
