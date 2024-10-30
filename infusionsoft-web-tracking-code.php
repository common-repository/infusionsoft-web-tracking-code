<?php
/**
Plugin Name: Infusionsoft® Tracking Code
Description: This plugin provides a simple method for Infusionsoft® users to add their Infusionsoft Tracking Code to a WordPress-powered site.
Author: Robert Calise
Version: 1.1
Author URI: https://robertcalise.com/

@package infusionsoft-web-tracking-code
 */

/**
 * Settings menu
 */
function inf_web_tracking_menu() {
	add_options_page(
		'Infusionsoft Tracking Code',
		'Infusionsoft Tracking Code',
		'manage_options',
		'infusionsoft-web-tracking-code.php',
		'inf_web_tracking_settings_page'
	);
}

/**
 * HTML for Settings page
 */
function inf_web_tracking_settings_page() {
	$plugin_dir_url = plugin_dir_url( __FILE__ );
	$app_name = get_option( 'inf-web-tracking-appname' );
?>
<div class="wrap">
	<h2>Infusionsoft® Tracking Code Settings</h2>
	<form method="post" action="options.php">
		<?php settings_fields( 'inf-web-tracking' ); ?>
		<?php do_settings_sections( 'inf-web-tracking' ); ?>
		<p>Simply find your Infusionsoft application name (the bit that appears before ".infusionsoft.com" in your browser's address bar, as shown), and enter it below:</p>
		<img src="<?php echo esc_attr( $plugin_dir_url ) . '/web-tracking-code-example.png'; ?>" alt="" />
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Infusionsoft App Name:</th>
				<td>https://<input type="text" name="inf-web-tracking-appname" value="<?php echo esc_attr( $app_name ); ?>" />.infusionsoft.com</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes' ) ?>" />
		</p>
	</form>
</div>
<?php }

/**
 * If no user is logged in and the appname option is set then enqueue the tracking code.
 */
function inf_web_tracking_code() {
	if ( ! is_user_logged_in() ) {
		if ( $appname = get_option( 'inf-web-tracking-appname', false ) ) {
			wp_enqueue_script(
				'inf-web-tracking-code',
				'https://' . esc_attr( $appname ) . '.infusionsoft.com/app/webTracking/getTrackingCode'
			);
		}
	}
}

/**
 * Register our 'inf-web-tracking-appname' setting
 */
function inf_web_tracking_settings() {
	register_setting( 'inf-web-tracking', 'inf-web-tracking-appname' );
}

/**
 * Admin notice to display if app name is not set
 */
function inf_web_tracking_admin_notice() {
	$options_page = admin_url( 'options-general.php?page=infusionsoft-web-tracking-code.php' );
?>
<div class="notice notice-warning is-dismissable">
	<p>It would appear you have not yet set up your Infusionsoft Web Tracking Code.</p>
	<p>Visit the plugin's <a href='<?php echo esc_attr( $options_page ); ?>'>Settings page</a> to configure it.</p>
	<button type="button" class="notice-dismiss">
		<span class="screen-reader-text">Dismiss this notice.</span>
	</button>
</div>
<?php }

// Only hook notices, menu, and settings in the admin.
if ( is_admin() ) {
	// If the appname isn't set then display notice.
	if ( ! get_option( 'inf-web-tracking-appname', false ) ) {
		add_action( 'admin_notices', 'inf_web_tracking_admin_notice' );
	}
	add_action( 'admin_menu', 'inf_web_tracking_menu' );
	add_action( 'admin_init', 'inf_web_tracking_settings' );
} else {
	// Otherwise, add action to call wp_enqueue_script.
	add_action( 'wp_footer', 'inf_web_tracking_code' );
}
