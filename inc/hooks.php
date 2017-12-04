<?php
/**
 * Action hooks and filters.
 *
 * A place to put hooks and filters that aren't necessarily template tags.
 *
 * @package Acorn Theme
 */
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acorn_body_classes( $classes ) {

	// Give all pages a unique class.
	if ( ! is_user_logged_in() && true === acorn_theme_get_splash_options_value() ) {
		$classes[] = 'splash-page';
	}

	return $classes;
}
add_filter( 'body_class', 'acorn_body_classes' );
