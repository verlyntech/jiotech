<?php
/**
 * Search and sharing tags, replacing Rank Math: meta description, Open Graph and Twitter cards,
 * business details for Google (JSON-LD) on the homepage, and a sitemap without user accounts.
 * Titles and canonical links come from WordPress itself ("Page – JIO Technologies").
 * A page's description is its excerpt (Excerpt box in the page editor); posts fall back to their auto excerpt.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', static function () {
	add_post_type_support( 'page', 'excerpt' );
} );

// The users sitemap would publish account names.
add_filter( 'wp_sitemaps_add_provider', static function ( $provider, $name ) {
	return 'users' === $name ? false : $provider;
}, 10, 2 );

/** One-line plain-text description for the current view, at most 160 characters. */
function jio_seo_description() {
	$text = '';
	if ( is_singular() ) {
		$post = get_queried_object();
		$text = has_excerpt( $post ) ? $post->post_excerpt : ( 'post' === $post->post_type ? get_the_excerpt( $post ) : '' );
	}
	if ( '' === trim( $text ) ) {
		$text = get_bloginfo( 'description' );
	}
	$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( $text ) ) );
	return mb_strlen( $text ) > 160 ? rtrim( mb_substr( $text, 0, 157 ), " ,.;:" ) . '…' : $text;
}

add_action( 'wp_head', static function () {
	if ( is_404() ) {
		return;
	}
	$desc  = jio_seo_description();
	$url   = is_singular() ? get_permalink() : home_url( add_query_arg( array() ) );
	$image = is_singular() && has_post_thumbnail() ? get_the_post_thumbnail_url( null, 'large' ) : get_template_directory_uri() . '/assets/img/og-default.jpg';
	$tags  = array(
		'description'         => $desc,
		'og:type'             => is_singular( 'post' ) ? 'article' : 'website',
		'og:site_name'        => get_bloginfo( 'name' ),
		'og:locale'           => 'en_US',
		'og:title'            => wp_get_document_title(),
		'og:description'      => $desc,
		'og:url'              => $url,
		'og:image'            => $image,
		'twitter:card'        => 'summary_large_image',
	);
	foreach ( $tags as $key => $value ) {
		$attr = 0 === strpos( $key, 'og:' ) ? 'property' : 'name';
		printf( "<meta %s=\"%s\" content=\"%s\">\n", $attr, esc_attr( $key ), esc_attr( $value ) );
	}

	if ( is_front_page() ) {
		$data = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				array(
					'@type'      => 'LocalBusiness',
					'@id'        => home_url( '/#business' ),
					'name'       => 'JIO Technologies LLC',
					'url'        => home_url( '/' ),
					'logo'       => get_template_directory_uri() . '/assets/img/logo.webp',
					'image'      => $image,
					'description' => $desc,
					'telephone'  => '+971553440144',
					'email'      => 'sales@jiotechuae.com',
					'address'    => array(
						'@type'           => 'PostalAddress',
						'streetAddress'   => 'Abdullah Bin Darwish Building, Office No. 304, Sheikh Zayed Bin Sultan St, Al Zahiyah, E15',
						'addressLocality' => 'Abu Dhabi',
						'addressCountry'  => 'AE',
					),
					'areaServed' => array( 'Abu Dhabi', 'Dubai', 'GCC' ),
				),
				array(
					'@type'     => 'WebSite',
					'@id'       => home_url( '/#website' ),
					'name'      => get_bloginfo( 'name' ),
					'url'       => home_url( '/' ),
					'publisher' => array( '@id' => home_url( '/#business' ) ),
				),
			),
		);
		echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
	}
}, 1 );
