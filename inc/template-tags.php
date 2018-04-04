<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Acorn Theme
 */

/**
 * Return SVG markup.
 *
 * https://github.com/WordPress/twentyseventeen/blob/master/inc/icon-functions.php
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function acorn_get_svg( $args = array() ) {

	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'acorn' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an SVG icon filename.', 'acorn' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'aria_hidden' => true, // Hide from screen readers.
		'fallback'    => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = '';
	if ( true === $args['aria_hidden'] ) {
		$aria_hidden = ' aria-hidden="true"';
	}

	// Set ARIA.
	$aria_labelledby = '';
	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="title desc"';
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// If there is a title, display it.
	if ( $args['title'] ) {
		$svg .= '<title>' . esc_html( $args['title'] ) . '</title>';
	}

	// If there is a description, display it.
	if ( $args['desc'] ) {
		$svg .= '<desc>' . esc_html( $args['desc'] ) . '</desc>';
	}

	// Use absolute path in the Customizer so that icons show up in there.
	if ( is_customize_preview() ) {
		$svg .= '<use xlink:href="' . get_parent_theme_file_uri( '/assets/images/svg-icons.svg#icon-' . esc_html( $args['icon'] ) ) . '"></use>';
	} else {
		$svg .= '<use xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use>';
	}

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}
	$svg .= '</svg>';

	return $svg;
}

/**
 * Render splash page markup.
 */
function acorn_theme_display_splash_page() {
	?>

	<div class="entry-content">
		<a class="button" href="https://github.com/jomurgel/project-acorn/fork"><?php esc_html_e( 'Fork', 'acorn' ); ?></a>
		<a class="button" href="<?php echo wp_login_url(); ?>"><?php esc_html_e( 'Login', 'acorn' ); ?></a>
	</div><!-- .entry-content -->

	<?php
}

/**
 * Render Quick Reference (index) Page.
 */
function acorn_theme_display_dev_page() {
	?>

	<div class="entry-content code-output">
		<h2><?php esc_html_e( 'Posts', 'acorn' ); ?></h2>
		<div class="code-block">
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/posts' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/posts/id' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/posts/?slug=slug' ); ?></code>
		</div><!-- .code-block -->

		<h2><?php esc_html_e( 'Pages', 'acorn' ); ?></h2>
		<div class="code-block">
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/pages' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/pages/id' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/pages/?slug=slug' ); ?></code>
		</div><!-- .code-block -->

		<h2><?php esc_html_e( 'Menus', 'acorn' ); ?></h2>
		<div class="code-block">
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp-api-menus/v2/menus' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp-api-menus/v2/menus/id' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp-api-menus/v2/menus/slug' ); ?></code>
		</div><!-- .code-block -->

		<h2><?php esc_html_e( 'Categories', 'acorn' ); ?></h2>
		<div class="code-block">
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/categories' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/categories/id' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/categories/?slug=slug' ); ?></code>
		</div><!-- .code-block -->

		<h2><?php esc_html_e( 'Tags', 'acorn' ); ?></h2>
		<div class="code-block">
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/tags' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/tags/id' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp-json/wp/v2/tags/?slug=slug' ); ?></code>
		</div><!-- .code-block -->

		<h2><?php esc_html_e( 'Custom Post Types', 'acorn' ); ?></h2>
		<div class="code-block">
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp/v2/types' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp/v2/types/id' ); ?></code>
			<code><?php echo esc_url( get_site_url() ) . esc_html( '/wp/v2/types/?slug=slug' ); ?></code>
		</div><!-- .code-block -->

		<a href="https://developer.wordpress.org/rest-api/reference/" target="_blank" class="button">
			<?php esc_html_e( 'WordPress REST API Docs', 'acorn' ); ?>
		</a>

	</div><!-- .entry-content -->

	<?php
}
