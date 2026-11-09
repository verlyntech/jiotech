<?php
/**
 * Service detail pages under /solutions/ (managed services, power & energy, and so on).
 *
 * Content lives in inc/service-pages.json and the markup in parts/service-page.tpl.html, which the
 * static preview (preview/build.mjs) renders too. Any child page of "Services" whose slug is in the
 * JSON uses this layout, so the existing WordPress pages keep their URLs.
 */

/** All service pages, keyed by slug. */
function jio_service_pages() {
	static $pages = null;
	if ( null === $pages ) {
		$pages = array();
		$json  = json_decode( (string) file_get_contents( get_template_directory() . '/inc/service-pages.json' ), true );
		foreach ( ( $json['pages'] ?? array() ) as $page ) {
			$pages[ $page['slug'] ] = $page;
		}
	}
	return $pages;
}

/** Fill the template: {{field}} is escaped, {{#list}}...{{/list}} repeats, {{.}} is a plain list item. */
function jio_fill_template( $tpl, array $data ) {
	$tpl = preg_replace_callback(
		'/\{\{#(\w+)\}\}(.*?)\{\{\/\1\}\}/s',
		function ( $m ) use ( $data ) {
			$out = '';
			foreach ( (array) ( $data[ $m[1] ] ?? array() ) as $item ) {
				$out .= is_array( $item ) ? jio_fill_template( $m[2], $item + $data ) : str_replace( '{{.}}', esc_html( $item ), $m[2] );
			}
			return $out;
		},
		$tpl
	);
	return preg_replace_callback(
		'/\{\{(\w+)\}\}/',
		function ( $m ) use ( $data ) {
			$value = $data[ $m[1] ] ?? '';
			return ( '_url' === substr( $m[1], -4 ) || 'url' === $m[1] ) ? esc_url( $value ) : esc_html( $value );
		},
		$tpl
	);
}

/** Markup for one service page. */
function jio_render_service_page( $slug ) {
	$pages = jio_service_pages();
	$page  = $pages[ $slug ];
	foreach ( $page['items'] as $i => $item ) {
		$page['items'][ $i ]['num'] = sprintf( '%02d', $i + 1 );
	}
	$page['related'] = array_map(
		function ( $rel ) use ( $pages ) {
			return array( 'title' => $pages[ $rel ]['title'], 'url' => home_url( '/solutions/' . $rel . '/' ) );
		},
		$page['related']
	);
	$page['solutions_url'] = home_url( '/solutions/' );
	$page['quote_url']     = home_url( '/contact/#quote' );
	return jio_fill_template( (string) file_get_contents( get_template_directory() . '/parts/service-page.tpl.html' ), $page );
}

/** The service slug for the current page, or null when it is not a service page. */
function jio_current_service_slug() {
	if ( ! is_page() ) {
		return null;
	}
	$post   = get_queried_object();
	$parent = $post->post_parent ? get_post( $post->post_parent ) : null;
	return ( $parent && 'solutions' === $parent->post_name && isset( jio_service_pages()[ $post->post_name ] ) ) ? $post->post_name : null;
}

add_filter(
	'page_template',
	function ( $template ) {
		return jio_current_service_slug() ? get_template_directory() . '/template-service.php' : $template;
	}
);
