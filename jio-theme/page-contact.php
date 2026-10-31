<?php
/**
 * Contact.
 */
get_header(); ?>

<main id="main">

<section class="phero">
	<div class="wrap phero__grid">
		<h1>Get a quote.</h1>
		<div class="phero__side">
			<p>Tell us about the site and what has to stay running. We will set up a call, review the systems with you, and send a written proposal.</p>
		</div>
	</div>
</section>

<section class="quote quote--page" id="quote">
	<div class="wrap">
		<?php get_template_part( 'parts/steps' ); ?>
		<div class="quote__grid">
			<?php get_template_part( 'parts/quote-form' ); ?>
			<div class="office">
				<?php get_template_part( 'parts/direct' ); ?>
				<div class="office__card">
					<h2>Office</h2>
					<p>Al Muroor Road<br>Abu Dhabi, United Arab Emirates</p>
					<a class="link" href="https://maps.google.com/?q=JIO+Technologies+Al+Muroor+Road+Abu+Dhabi">Open in Google Maps</a>
				</div>
			</div>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
