<?php
/**
 * JIO Technologies theme setup.
 */

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array(
		'primary' => __( 'Primary menu', 'jio' ),
		'footer'  => __( 'Footer menu', 'jio' ),
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	$ver = wp_get_theme()->get( 'Version' );
	wp_enqueue_style(
		'jio-fonts',
		'https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@500;600;700&family=Source+Sans+3:ital,wght@0,400;0,600;0,700;0,900;1,400&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'jio-main', get_template_directory_uri() . '/assets/css/main.css', array( 'jio-fonts' ), $ver . '.' . filemtime( get_template_directory() . '/assets/css/main.css' ) );
	wp_enqueue_script( 'jio-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), $ver . '.' . filemtime( get_template_directory() . '/assets/js/theme.js' ), false );
	wp_enqueue_style( 'jio-theme', get_template_directory_uri() . '/assets/css/theme.css', array( 'jio-main' ), $ver . '.' . filemtime( get_template_directory() . '/assets/css/theme.css' ) );
	wp_enqueue_script( 'jio-chat', get_template_directory_uri() . '/assets/js/chat.js', array(), $ver, array( 'strategy' => 'defer' ) );
	wp_enqueue_script( 'jio-site', get_template_directory_uri() . '/assets/js/site.js', array(), $ver . '.' . filemtime( get_template_directory() . '/assets/js/site.js' ), array( 'strategy' => 'defer' ) );
	if ( is_singular() && get_post_meta( get_queried_object_id(), '_elementor_edit_mode', true ) === 'builder' ) {
		wp_enqueue_script( 'jio-elementor-bridge', get_template_directory_uri() . '/assets/js/elementor-bridge.js', array(), $ver . '.' . filemtime( get_template_directory() . '/assets/js/elementor-bridge.js' ), array( 'strategy' => 'defer' ) );
	}
} );

/** Website assistant (server-side proxy to the model). */
require_once get_template_directory() . '/inc/chatbot.php';

/** Quote and support forms, emailed to the sales address. */
require_once get_template_directory() . '/inc/forms.php';
require_once get_template_directory() . '/inc/elementor-dark.php';
require_once get_template_directory() . '/inc/elementor-speed.php';
require_once get_template_directory() . '/inc/seo.php';
