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
				<?php get_template_part( 'parts/location' ); ?>
			</div>
		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
