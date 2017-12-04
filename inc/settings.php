<?php
/**
 * Setup Splash Page Toggle Options Page.
 *
 * @package Acorn Theme
 */

/**
 * Add Admin Menu.
 */
function acorn_theme_add_admin_menu() {
	add_options_page( 'Acorn Theme', 'Acorn Theme', 'manage_options', 'acorn_theme', 'acorn_theme_options_page' );
}

/**
 * Init Settings Page Field Descriptions.
 */
function acorn_theme_settings_init() {

	// Register page.
	register_setting( 'pluginPage', 'acorn_theme_settings' );

	// Define section description.
	add_settings_section(
		'acorn_theme_pluginPage_section',
		__( 'Do you want to show the Acorn splash page if logged out?', 'acorn' ),
		'acorn_theme_settings_description',
		'pluginPage'
	);

	// Define field description.
	add_settings_field(
		'acorn_theme_checkbox_field',
		__( 'Show Splash Page?', 'acorn' ),
		'acorn_theme_checkbox_field_render',
		'pluginPage',
		'acorn_theme_pluginPage_section'
	);
}

/**
 * Set field description.
 */
function acorn_theme_settings_description() {

	echo __( 'If splash page checkbox is NOT checked, any user not logged in will be redirected to the login page.', 'acorn' );
}

/**
 * Add the checkbox to the settings page.
 */
function acorn_theme_checkbox_field_render() {

	$options   = get_option( 'acorn_theme_settings' );

	// Make sure we have a value so we avoid offset errors.
	$input_val = isset( $options['acorn_theme_checkbox_field'] ); ?>

	<input type="checkbox" name="acorn_theme_settings[acorn_theme_checkbox_field]" value="1" <?php checked( $input_val, 1 ); ?> />

	<?php
}

/**
 * Output settings page + form.
 */
function acorn_theme_options_page() {
	?>

	<form action='options.php' method='post'>
		<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
		?>
	</form>

	<?php
}

add_action( 'admin_menu', 'acorn_theme_add_admin_menu' );
add_action( 'admin_init', 'acorn_theme_settings_init' );
