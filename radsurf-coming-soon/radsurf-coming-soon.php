<?php
/**
 * Plugin Name: Rad Surf Coming Soon
 * Description: Shows the Rad Surf "coming soon" page to visitors while you build. Logged-in admins still see the real site. Sign-up form uses WPForms.
 * Version: 1.1.0
 * Author: Rad Surf Co.
 * Text Domain: radsurf-coming-soon
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'RADSURF_CS_URL', plugin_dir_url( __FILE__ ) );
define( 'RADSURF_CS_DIR', plugin_dir_path( __FILE__ ) );

/* ---------- Settings page: Settings → Rad Surf Coming Soon ---------- */
add_action( 'admin_menu', function () {
	add_options_page( 'Rad Surf Coming Soon', 'Rad Surf Coming Soon', 'manage_options', 'radsurf-coming-soon', 'radsurf_cs_settings_page' );
} );

add_action( 'admin_init', function () {
	register_setting( 'radsurf_cs', 'radsurf_cs_enabled', array( 'type' => 'boolean', 'default' => false, 'sanitize_callback' => 'rest_sanitize_boolean' ) );
	register_setting( 'radsurf_cs', 'radsurf_cs_form_id', array( 'type' => 'integer', 'default' => 0, 'sanitize_callback' => 'absint' ) );
	register_setting( 'radsurf_cs', 'radsurf_cs_instagram', array( 'type' => 'string', 'default' => 'https://www.instagram.com/radsurfnoflo', 'sanitize_callback' => 'esc_url_raw' ) );
	register_setting( 'radsurf_cs', 'radsurf_cs_facebook', array( 'type' => 'string', 'default' => 'https://www.facebook.com/profile.php?id=61553354830685', 'sanitize_callback' => 'esc_url_raw' ) );
} );

function radsurf_cs_settings_page() {
	$on = get_option( 'radsurf_cs_enabled', false ); ?>
	<div class="wrap">
		<h1>Rad Surf Coming Soon</h1>
		<p>When ON, visitors see the coming soon page. You (logged in) keep seeing and editing the real site.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'radsurf_cs' ); ?>
			<table class="form-table" role="presentation">
				<tr><th scope="row">Coming soon mode</th>
					<td><label><input type="checkbox" name="radsurf_cs_enabled" value="1" <?php checked( $on ); ?>> ON — show coming soon page to visitors</label></td></tr>
				<tr><th scope="row"><label for="radsurf_cs_form_id">WPForms form ID</label></th>
					<td><input type="number" id="radsurf_cs_form_id" name="radsurf_cs_form_id" value="<?php echo esc_attr( get_option( 'radsurf_cs_form_id', 0 ) ); ?>" class="small-text">
					<p class="description">WPForms → All Forms → the number in the shortcode, e.g. [wpforms id="<strong>123</strong>"]. The form should have one <strong>Email</strong> field.</p></td></tr>
				<tr><th scope="row"><label for="radsurf_cs_instagram">Instagram</label></th>
					<td><input type="url" id="radsurf_cs_instagram" name="radsurf_cs_instagram" value="<?php echo esc_attr( get_option( 'radsurf_cs_instagram', 'https://www.instagram.com/radsurfnoflo' ) ); ?>" class="regular-text"></td></tr>
				<tr><th scope="row"><label for="radsurf_cs_facebook">Facebook</label></th>
					<td><input type="url" id="radsurf_cs_facebook" name="radsurf_cs_facebook" value="<?php echo esc_attr( get_option( 'radsurf_cs_facebook', 'https://www.facebook.com/profile.php?id=61553354830685' ) ); ?>" class="regular-text"></td></tr>
			</table>
			<?php submit_button(); ?>
		</form>
		<p><a href="<?php echo esc_url( add_query_arg( 'radsurf_cs_preview', '1', home_url( '/' ) ) ); ?>" target="_blank" class="button">Preview coming soon page</a></p>
	</div>
<?php }

/* Admin bar reminder so you never forget it is ON */
add_action( 'admin_bar_menu', function ( $bar ) {
	if ( ! get_option( 'radsurf_cs_enabled' ) || ! current_user_can( 'manage_options' ) ) return;
	$bar->add_node( array( 'id' => 'radsurf-cs', 'title' => '🌊 Coming soon is ON', 'href' => admin_url( 'options-general.php?page=radsurf-coming-soon' ) ) );
}, 100 );

/* ---------- Show the page to visitors ---------- */
add_action( 'template_redirect', function () {
	$preview = isset( $_GET['radsurf_cs_preview'] ) && current_user_can( 'manage_options' );
	if ( ! $preview ) {
		if ( ! get_option( 'radsurf_cs_enabled' ) ) return;
		if ( is_user_logged_in() ) return;
	}
	// Let WooCommerce webhooks, payment callbacks, REST, cron, feeds and the login page keep working.
	if ( wp_doing_ajax() || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || is_feed() ) return;
	if ( isset( $_GET['wc-api'] ) || isset( $_GET['wc-ajax'] ) ) return;
	if ( is_robots() ) return;

	if ( ! $preview ) {
		status_header( 503 );            // tells Google "temporarily down", protects your rankings
		header( 'Retry-After: 86400' );
	}
	nocache_headers();
	include RADSURF_CS_DIR . 'template.php';
	exit;
}, 1 );

/* WPForms success message shown in the brand style */
add_filter( 'wpforms_frontend_confirmation_message', function ( $message, $form_data ) {
	if ( (int) $form_data['id'] !== (int) get_option( 'radsurf_cs_form_id' ) ) return $message;
	return '<span class="rs-done"><em>You’re on the list.</em> Stay rad.</span>';
}, 10, 2 );
