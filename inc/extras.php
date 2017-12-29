<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Acorn Theme
 */

 /**
  * Force Permalink Structure to /%postname%/.
  */
function acorn_theme_set_permalink_structure() {

	// Set global var.
	global $wp_rewrite;

	// Set postname permalink structure.
	$wp_rewrite->set_permalink_structure( '/%postname%/' );
}
add_action( 'init', 'acorn_theme_set_permalink_structure' );

/**
 * Outputs boolean depending on settings checkbox state.
 *
 * @return boolean
 */
function acorn_theme_get_splash_options_value() {

	$splash_check = isset( get_option( 'acorn_theme_settings' )['acorn_theme_checkbox_field'] ) ? true : false;

	return $splash_check;
}

/**
 * Redirect to login page if we're not logged in and don't have splash page set.
 */
function acorn_theme_redirect_to_admin() {

	if ( is_user_logged_in() ) {
		return;
	}

	if ( ! is_user_logged_in() && true === acorn_theme_get_splash_options_value() && is_home() ) {
		return;
	}

	auth_redirect();
	die();
}
add_action( 'template_redirect', 'acorn_theme_redirect_to_admin' );

/**
 * Create new color scheme for Acorn.
 *
 * @return array new color scheme
 */
function acorn_add_admin_color_scheme() {

	//Get the theme directory
	$theme_dir = get_template_directory_uri();

	//Ocean
	wp_admin_css_color(
		'acorn', __( 'Acorn' ),
		$theme_dir . '/assets/theme/colors.min.css',
		array(
			'#222222', // default dropdown/accent.
			'#373b3f', // base color.
			'#ee2d6d', // highlight color.
			'#73cfe6', // notofication color.
		)
	);
}
add_action( 'admin_init', 'acorn_add_admin_color_scheme' );

/**
 * Set new acorn color scheme as default.
 *
 * @param  int $user_id current user id.
 * @return array new color scheme default.
 */
function acorn_set_default_admin_color( $user_id ) {

	$args = array(
		'ID' => $user_id,
		'admin_color' => 'acorn',
	);
	wp_update_user( $args );
}
add_action( 'user_register', 'acorn_set_default_admin_color' );

/**
 * Add container class if splash page.
 * @return string flex-container class
 */
function acorn_splash_class() {

	$flex = ( ! is_user_logged_in() && true === acorn_theme_get_splash_options_value() ) || is_404() ? esc_attr( 'flex-container' ) : '';

	return $flex;
}
