<?php
/**
 * Dark mode for Elementor page content.
 *
 * Elementor writes fixed colours into CSS files under uploads/elementor/css, so the theme's dark
 * variables can't reach them. Next to each of those files this prints a dark copy of every rule
 * that uses a light-palette colour, mapped to the theme's dark palette, under html[data-theme="dark"].
 * It is printed in the head with the same media query, so there is no light flash. Light mode is untouched.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Light colour (r,g,b) => dark colour, by kind of property. Brand green, blue and white text are kept. */
function jio_elementor_dark_map() {
	return array(
		'text'   => array( '14,21,18' => '#f1f2f3', '23,37,27' => '#f1f2f3', '54,64,59' => '#d3d6d9', '91,101,96' => '#aeb5bc', '75,100,80' => '#aeb5bc', '88,107,92' => '#aeb5bc', '169,179,173' => '#aeb5bc' ),
		'bg'     => array( '255,255,255' => '#23272b', '244,246,244' => '#2d3237', '237,248,232' => '#1b1e21', '236,243,249' => '#1b1e21', '14,21,18' => '#101214' ),
		'border' => array( '219,224,220' => '#424a52', '164,187,164' => '#424a52', '44,55,49' => '#384047', '14,21,18' => '#f1f2f3', '54,64,59' => '#d3d6d9' ),
	);
}

/** '#0e1512', '#fff' or 'rgb(14, 21, 18)' => '14,21,18'; anything else (variables, transparency) => ''. */
function jio_elementor_rgb_key( $value ) {
	$value = strtolower( trim( $value ) );
	if ( preg_match( '/^#([0-9a-f]{3}|[0-9a-f]{6})$/', $value, $m ) ) {
		$h = strlen( $m[1] ) === 3 ? preg_replace( '/(.)/', '$1$1', $m[1] ) : $m[1];
		return implode( ',', array_map( 'hexdec', str_split( $h, 2 ) ) );
	}
	if ( preg_match( '/^rgba?\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*(?:,\s*1(?:\.0+)?\s*)?\)$/', $value, $m ) ) {
		return $m[1] . ',' . $m[2] . ',' . $m[3];
	}
	return '';
}

/** Builds the dark copy of a CSS string (flat rules and @media blocks, as Elementor writes them). */
function jio_elementor_dark_css( $css ) {
	$map  = jio_elementor_dark_map();
	$kind = array( 'color' => 'text', 'background-color' => 'bg', 'border-color' => 'border', 'border-top-color' => 'border', 'border-right-color' => 'border', 'border-bottom-color' => 'border', 'border-left-color' => 'border' );
	$css  = preg_replace( '~/\*.*?\*/~s', '', $css );
	$out  = '';
	$len  = strlen( $css );
	$i    = 0;
	while ( $i < $len ) {
		$open = strpos( $css, '{', $i );
		if ( false === $open ) {
			break;
		}
		$head = trim( substr( $css, $i, $open - $i ) );
		if ( 0 === strpos( $head, '@' ) ) {
			// Block at-rule: find its matching close brace and recurse into @media only.
			$depth = 1;
			$j     = $open + 1;
			while ( $j < $len && $depth ) {
				$depth += ( '{' === $css[ $j ] ) - ( '}' === $css[ $j ] );
				$j++;
			}
			if ( 0 === stripos( $head, '@media' ) ) {
				$inner = jio_elementor_dark_css( substr( $css, $open + 1, $j - $open - 2 ) );
				if ( '' !== $inner ) {
					$out .= $head . '{' . $inner . '}';
				}
			}
			$i = $j;
			continue;
		}
		$close = strpos( $css, '}', $open );
		if ( false === $close ) {
			break;
		}
		$decls = '';
		if ( preg_match( '/\.elementor|\.e-[a-z0-9]|\.jio-/', $head ) ) { // Elementor element and global class rules only.
			foreach ( explode( ';', substr( $css, $open + 1, $close - $open - 1 ) ) as $decl ) {
				$parts = explode( ':', $decl, 2 );
				if ( 2 !== count( $parts ) ) {
					continue;
				}
				$prop = strtolower( trim( $parts[0] ) );
				if ( ! isset( $kind[ $prop ] ) ) {
					continue;
				}
				$important = false !== stripos( $parts[1], '!important' );
				$key       = jio_elementor_rgb_key( str_ireplace( '!important', '', $parts[1] ) );
				if ( isset( $map[ $kind[ $prop ] ][ $key ] ) ) {
					$decls .= $prop . ':' . $map[ $kind[ $prop ] ][ $key ] . ( $important ? ' !important' : '' ) . ';';
				}
			}
		}
		if ( '' !== $decls ) {
			$selectors = preg_split( '/,(?![^(]*\))/', $head );
			$out      .= implode( ',', array_map( static function ( $s ) { return 'html[data-theme="dark"] ' . trim( $s ); }, $selectors ) ) . '{' . $decls . '}';
		}
		$i = $close + 1;
	}
	return $out;
}

// Print the dark copy right after each Elementor stylesheet, with the same media query.
add_filter(
	'style_loader_tag',
	static function ( $tag, $handle, $href, $media ) {
		$uploads = wp_get_upload_dir();
		$base    = trailingslashit( $uploads['baseurl'] ) . 'elementor/css/';
		$url     = strtok( $href, '?' );
		if ( 0 !== strpos( set_url_scheme( $url ), set_url_scheme( $base ) ) ) {
			return $tag;
		}
		$file = trailingslashit( $uploads['basedir'] ) . 'elementor/css/' . basename( $url );
		if ( ! is_readable( $file ) ) {
			return $tag;
		}
		$cache_key = 'jio_ed_' . md5( $file . filemtime( $file ) . filesize( $file ) );
		$dark      = get_transient( $cache_key );
		if ( false === $dark ) {
			$dark = jio_elementor_dark_css( (string) file_get_contents( $file ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local file.
			set_transient( $cache_key, $dark, WEEK_IN_SECONDS );
		}
		if ( '' === $dark || false !== strpos( $dark, '<' ) ) { // Never print anything that could close the style tag.
			return $tag;
		}
		return $tag . sprintf( "<style id='%s-dark' media='%s'>%s</style>\n", esc_attr( $handle ), esc_attr( $media ? $media : 'all' ), $dark ); // CSS built only from the site's own Elementor files.
	},
	10,
	4
);
