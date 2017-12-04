<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _s
 */
get_header(); ?>

	<a href="javascript:history.go(-1)" class="button">
		<?php esc_html_e( 'Go Back', 'acorn' ); ?>
	</a>

<?php get_footer();
