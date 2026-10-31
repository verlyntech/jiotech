<?php
/**
 * Generic page (privacy, terms, and any page without its own template).
 */
get_header(); ?>

<main id="main">
<?php while ( have_posts() ) : the_post(); ?>
<section class="phero"><div class="wrap phero__grid"><h1><?php the_title(); ?></h1></div></section>
<div class="wrap"><div class="prose"><?php the_content(); ?></div></div>
<?php endwhile; ?>
</main>

<?php get_footer(); ?>
