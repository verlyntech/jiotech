<?php
/**
 * Single post.
 */
get_header(); ?>

<main id="main">
<?php while ( have_posts() ) : the_post(); ?>
<article class="article">
	<header class="wrap article__head">
		<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
		<h1><?php the_title(); ?></h1>
	</header>
	<?php if ( has_post_thumbnail() ) : ?><div class="wrap article__img"><?php the_post_thumbnail( 'large' ); ?></div><?php endif; ?>
	<div class="wrap"><div class="prose"><?php the_content(); ?></div></div>
</article>
<?php endwhile; ?>
</main>

<?php get_footer(); ?>
