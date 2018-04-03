<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acorn Theme
 */

wp_footer(); ?>

				<footer class="site-footer">
					<?php if ( ! is_user_logged_in() && true === acorn_theme_get_splash_options_value() ) : ?>
						<h6><small>
							<?php echo esc_html__( 'Project Acorn', 'acorn' ) . ' ' . intval( date( 'Y' ) ); ?> | <a href="https://github.com/jomurgel"><?php esc_html_e( 'by @jomurgel', 'acorn' ); ?></a>
						</small></h6>

					<?php else : ?>

						<a href="<?php echo esc_url( get_admin_url() ) . esc_html( '/options-general.php?page=acorn_theme' ); ?>" class="button">
							<?php esc_html_e( 'Update Splash Page Settings', 'acorn' ); ?>
						</a>

						<a class="button" href="https://github.com/jomurgel/project-acorn/fork">
							<?php esc_html_e( 'Fork Theme', 'acorn' ); ?>
						</a>

						<a href="https://github.com/jomurgel/project-acorn-ssr" target="_blank" class="button">
							<?php esc_html_e( 'Download Project Acorn SSR', 'acorn' ); ?>
						</a>

						<h6><small>
							<?php echo esc_html__( 'Project Acorn', 'acorn' ) . ' ' . intval( date( 'Y' ) ); ?> | <a href="https://github.com/jomurgel" target="_blank"><?php esc_html_e( 'by @jomurgel', 'acorn' ); ?></a> | <a href="https://github.com/jomurgel/project-acorn/issues" target="_blank"><?php esc_html_e( 'Submit an Issue', 'acorn' ); ?></a> | <a href="<?php echo wp_logout_url(); ?>"><?php esc_html_e( 'Log Out', 'acorn' ); ?></a>
						</small></h6>

					<?php endif; ?>

				</footer><!-- .site-footer -->

			</div><!-- .container -->
	</div><!-- .main -->

</body>
</html>
