<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acorn Theme
 */
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<section id="site-wrapper" class="main">
		<div class="container <?php echo acorn_splash_class(); ?>">


			<header class="site-header">
				<?php if ( ! is_front_page() || ! is_home() ) : ?>
					<a href="<?php echo esc_url( get_site_url() ); ?>" class="home-link">
				<?php endif; ?>
				<?php
					echo acorn_get_svg( array(
						'icon'  => 'acorn',
						'title' => 'Acorn Theme',
						'desc'  => 'Welcome to the Acorn Theme Waypoint',
					) );
				?>
				<?php if ( ! is_front_page() || ! is_home() ) : ?>
					</a>
				<?php endif; ?>

				<?php if ( ! is_user_logged_in() && true === acorn_theme_get_splash_options_value()  ) : ?>

					<h1><?php esc_html_e( 'Project Acorn', 'acorn' ); ?></h1>
					<h2><?php echo esc_html__( 'A WordPress REST API Waypoint for: ', 'acorn' ) . esc_url( get_site_url() ); ?>.</h2>

				<?php elseif ( is_front_page() || is_home() ) : ?>

					<h1><?php esc_html_e( 'Project Acorn Quick Reference', 'acorn' ); ?></h1>

				<?php elseif ( is_404() ) : ?>

					<h1><?php esc_html_e( 'Oops. Looks Like a 404.', 'acorn' ); ?></h1>
				<?php endif; ?>
			</header>
