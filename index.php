<?php
/**
 * The Index template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#home-page-display
 *
 * @package Acorn Theme
 */

get_header();

	if ( ! is_user_logged_in() && true === acorn_theme_get_splash_options_value() ) :
		acorn_theme_display_splash_page();
	else :
		acorn_theme_display_dev_page();
	endif;

get_footer();
