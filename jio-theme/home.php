<?php
/**
 * Blog index.
 */
get_header(); ?>

<main id="main">
<section class="phero">
	<div class="wrap phero__grid">
		<h1>Notes on IT, power and keeping both running.</h1>
	</div>
</section>
<section class="posts">
	<div class="wrap">
		<?php if ( have_posts() ) : ?>
		<ul class="post-grid">
			<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium_large' ); } ?>
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
					<h2><?php the_title(); ?></h2>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
				</a>
			</li>
			<?php endwhile; ?>
		</ul>
		<div class="pager"><?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?></div>
		<?php else : ?>
		<p class="empty">No posts yet.</p>
		<?php endif; ?>
	</div>
</section>
</main>

<?php get_footer(); ?>
