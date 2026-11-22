<?php
/**
 * Page speed for pages built with Elementor.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Elementor would load its own Google Fonts (all weights, plus its unused Roboto defaults); the theme already loads both site fonts.
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );

/**
 * Adds loading="lazy" to every image after the first few. Elementor's images have no width and height,
 * so WordPress's own lazy-loading skips them; images in hidden tabs then wait until their tab is opened.
 */
function jio_lazy_load_images( $html, $eager = 4 ) {
	$count = 0;
	return preg_replace_callback(
		'/<img\b(?![^>]*\sloading=)[^>]*>/i',
		static function ( $m ) use ( &$count, $eager ) {
			return ++$count <= $eager ? $m[0] : preg_replace( '/^<img\b/i', '<img loading="lazy"', $m[0] );
		},
		$html
	);
}

add_filter(
	'the_content',
	static function ( $html ) {
		if ( 'builder' !== get_post_meta( get_the_ID(), '_elementor_edit_mode', true ) ) {
			return $html;
		}
		$html = jio_lazy_load_images( $html );
		// The page's main landmark and the header's "Skip to content" (#main) target, as the old templates had.
		return in_the_loop() && is_main_query() ? '<main id="main">' . $html . '</main>' : $html;
	},
	20 // After Elementor has put the page into the content.
);
