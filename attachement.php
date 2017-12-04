<?php
/**
 * The Attachement preview template file.
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

while ( have_posts() ) :
	the_post();

		get_template_part( 'template-parts/content', get_post_format() );

endwhile;

get_footer();