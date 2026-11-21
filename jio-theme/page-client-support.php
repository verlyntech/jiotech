<?php
/**
 * Client support.
 */
get_header(); ?>

<main id="main">

<section class="phero">
	<div class="wrap phero__grid">
		<h1>Something is down. Here is the fastest way to reach us.</h1>
		<div class="phero__side">
			<p>Technical support runs 24/7, remote and onsite. Pick how urgent it is and we will route it.</p>
		</div>
	</div>
</section>

<section class="support">
	<div class="wrap support__grid">

		<?php get_template_part( 'parts/support-panel' ); ?>

	</div>
</section>

</main>

<?php get_footer(); ?>
