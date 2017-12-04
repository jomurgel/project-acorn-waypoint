<?php
/**
 * Custom scripts and styles.
 *
 * @package Acorn Theme
 */

/**
 * Enqueue Styles and Scripts
 */
function acorn_theme_scripts() {

	// Set base url.
	$base_url  = esc_url_raw( home_url() );
	$base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/' );

	/**
	 * If we are debugging the site, use a unique version every page load so as to ensure no cache issues.
	 */
	$version = time();

	/**
	 * Enqueue Styles
	 */
	wp_enqueue_style( 'acorn-theme-style', get_stylesheet_directory_uri() . '/style.css', array(), $version );
}
add_action( 'wp_enqueue_scripts', 'acorn_theme_scripts' );

/**
 * Removes excerpt "read more" (helps in REST API output).
 */
add_filter( 'excerpt_more', '__return_false' );

/**
 * Add SVG definitions to the footer.
 * https://github.com/WordPress/twentyseventeen/blob/master/inc/icon-functions.php
 */
function acorn_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_parent_theme_file_path( '/assets/svg/icons.svg' );

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}
add_action( 'wp_footer', 'acorn_include_svg_icons', 9999 );
