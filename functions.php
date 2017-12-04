<?php
/**
 *  Functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acorn Theme
 */

if ( ! function_exists( 'acorn_theme_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function acorn_theme_setup() {

		/**
		 * Register nav menus.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/register_nav_menus
		 */
		register_nav_menus( array(
			'main' => esc_html__( 'Main Menu', 'acorn' ),
		) );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

	}
	add_action( 'after_setup_theme', 'acorn_theme_setup' );

endif;

/**
 * Load styles and scripts.
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Setup Custom Menu Endpoints
 */
require get_template_directory() . '/inc/menu-endpoints.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom hooks.
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Custom template functions.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Settings to toggle splash page.
 */
require get_template_directory() . '/inc/settings.php';

/**
 * Removes customizer from this theme.
 */
require get_template_directory() . '/inc/remove-customizer.php';
