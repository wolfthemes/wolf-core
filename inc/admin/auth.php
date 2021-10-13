<?php
/**
 * Wolf Core auth
 *
 * Functions related to theme activation
 *
 * @author WolfThemes
 * @package WolfCore/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Show 30 days activation notice
 */
function wolf_core_show_activation_notice() {

	global $pagenow;
	// var_dump( $pagenow );

	$theme_slug = apply_filters( 'wolftheme_theme_slug', esc_attr( sanitize_title_with_dashes( get_template() ) ) );

	if ( isset( $_GET['page'] ) && $_GET['page'] === $theme_slug . '-about' ) {
		return;
	}

	if ( 'index.php' !== $pagenow ) {
		return;
	}

	if ( get_option( 'wolf_core_activated' ) ) {
		return;
	}

	$wp_theme   = wp_get_theme( get_template() );
	$theme_name = $wp_theme->Name;
	$timeout    = wolf_core_get_transient_timeout( 'wolf_core_activation_notice' );

	echo '<div class="notice notice-info">
		<p>' . sprintf(
		wp_kses_post( __( 'Hey there, thanks a lot for using our awesome <strong>%1$s</strong> theme! To ensure that it will work for verified customers only, you just need to enter your <a href="%2$s" target="_blank" title="Find your purchase code">theme purchase code</a> within the next <strong>%3$d days</strong>. You won\'t have to activate anything else after that.', 'wolf-core' ) ),
		$theme_name,
		'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-',
		$timeout
	) . '</p>
			<p>
			<a class="button button-primary" href="' . esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-about#license' ) ) . '">' . esc_html( 'Activate', 'wolf-core' ) . '</a>

			<a class="button button-secondary" target="_blank" href="https://wolfthemes.ticksy.com/article/13268/">' . esc_html( 'More infos', 'wolf-core' ) . '</a>
		</p>
	</div>';
}

/**
 * Missing plugin activation notice
 */
function wolf_core_admin_notice_missing_main_plugin() {

	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}

	$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
		esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'wolf-core' ),
		'<strong>' . esc_html__( 'Elementor Test Extension', 'wolf-core' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'wolf-core' ) . '</strong>'
	);

	printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
}

/**
 * Show notice if your plugin is activated but WPBakery Page Builder is not
 */
function wolf_core_activation_notice() {

	$theme_slug = apply_filters( 'wolftheme_theme_slug', esc_attr( sanitize_title_with_dashes( get_template() ) ) );

	if ( isset( $_GET['page'] ) && $_GET['page'] === $theme_slug . '-about' ) {
		return;
	}

	// $plugin_data = get_plugin_data( __FILE__ );
	echo '<div class="notice notice-warning">
		<p>' . sprintf(
		wp_kses_post( __( '<strong>%1$s</strong> only works for verified customers who purchased a theme from the <a href="%2$s" target="_blank">%3$s</a> team. Please enter your theme <a href="%4$s" target="_blank" title="Find your purchase code">purchase code</a> in the plugin settings to unlock all features.', 'wolf-core' ) ),
		'Wolf Elementor',
		'https://wlfthm.es/tf',
		'WolfThemes',
		'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-'
	) . '</p>
		<p>
			<a class="button button-primary" href="' . esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-about#license' ) ) . '">' . esc_html( 'Activate', 'wolf-core' ) . '</a>
		</p>
		</div>';
}

/**
 * Show notice if your plugin is activated but WPBakery Page Builder is not
 */
function wolf_core_show_wrong_theme_notice() {
	echo '<div class="notice notice-warning">
		<p>' . sprintf(
		wp_kses_post( __( 'Sorry, but <strong>%1$s</strong> only works with compatible <a target="_blank" href="%2$s">%3$s themes</a>.<br><strong>Be sure that you didn\'t change the theme\'s name in the %4$s file or the theme\'s folder name</strong>.<br>If you want to customize the theme\'s name, you can use a <a target="_blank" href="%5$s">child theme</a>.', 'wolf-core' ) ),
		'Wolf Core',
		'https://wlfthm.es/tf',
		'WolfThemes',
		'style.css',
		'https://wolfthemes.ticksy.com/article/11659/'
	) . '</p>
	</div>';
}

/**
 * Is the plugin activated?
 *
 * @return bool
 */
function wolf_core_is_activated() {

	// set_transient( 'wolf_core_activation_notice', true, 31 * DAY_IN_SECONDS );
	// delete_option( 'wolf_core_activated' );

	// delete_option( 'wolf_core_activation_notice_set' );
	// delete_transient( 'wolf_core_activation_notice' );
	// delete_option( 'wolf_core_activated' );
	// delete_option( 'wolf_core_code' );
	// delete_option( 'wolf_core_key' );

	// var_dump( get_transient( 'wolf_core_activation_notice' ) );

	// new.
	if ( ! get_transient( 'wolf_core_activation_notice' ) && ! get_option( 'wolf_core_activation_notice_set' ) ) {
		set_transient( 'wolf_core_activation_notice', true, 31 * DAY_IN_SECONDS );
		update_option( 'wolf_core_activation_notice_set', true );
	}

	// activated.
	if ( ( get_option( 'wolf_core_activated' ) || get_transient( 'wolf_core_activated' ) ) && get_option( 'wolf_core_key' ) && get_option( 'wolf_core_code' ) ) {
		// die( 'is fully activated' );
		return get_option( 'wolf_core_key' );
	}

	// Trial expired.
	if ( ( ! get_option( 'wolf_core_activated' ) || ! get_transient( 'wolf_core_activated' ) ) && ! get_option( 'wolf_core_key' ) && ! get_option( 'wolf_core_code' ) && ! get_transient( 'wolf_core_activation_notice' ) && get_option( 'wolf_core_activation_notice_set' ) ) {
		// die( 'period expired' );
		return false;
	}

	// Trial running.
	if ( get_transient( 'wolf_core_activation_notice' ) && get_option( 'wolf_core_activation_notice_set' ) ) {
		// die( 'period current' );
		return true;
	}

	// Recheck.
	if ( ! get_option( 'wolf_core_activated' ) && ! get_transient( 'wolf_core_activation_notice' ) && get_option( 'wolf_core_code' ) && get_option( 'wolf_core_key' ) ) {

		$remote_url = 'https://api.wolfthemes.com/envato/';
		$response   = wp_remote_post(
			$remote_url,
			array(
				'method' => 'POST',
				'body'   => array(
					'action' => 'verification',
					'code'   => get_option( 'wolf_core_code' ),
					'key'    => get_option( 'wolf_core_key' ),
				),
			)
		);

		if ( ! is_wp_error( $response ) && is_array( $response ) ) {

			$body = wp_remote_retrieve_body( $response );
			// $body = '';

			if ( '' === $body ) {
				delete_option( 'wolf_core_code' );
				delete_option( 'wolf_core_key' );
				update_option( 'wolf_core_activation_notice_set', true );
				return false;
			} else {
				// set_transient( 'wolf_core_activated', true, 365 * DAY_IN_SECONDS );
				update_option( 'wolf_core_activated', true );
				return true;
			}
		} else {
			delete_option( 'wolf_core_code' );
			delete_option( 'wolf_core_key' );
			update_option( 'wolf_core_activation_notice_set', true );
			return false;
		}
	}
}

/**
 * Theme not OK
 *
 * @return bool
 */
function wolf_core_wrong_theme() {

	$ok = array(
		'wolf-supertheme',
		'protheme',
		'andre',
		'iyo',
		'loud',
		'tune',
		'retine',
		'racks',
		'andre',
		'hares',
		'glytch',
		'superflick',
		'phase',
		'zample',
		'prequelle',
		'slikk',
		'vonzot',
		'deadlift',
		'hyperbent',
		'kayo',
		'reinar',
		'snakepit',
		'alceste',
		'fradence',
		'firemaster',
		'decibel',
		'tattoopress',
		'tattoopro',
		'milu',
		'beatit',
		'daeron',
		'herion',
		'oglin',
		'staaw',
		'bronze',
		'hazal',
		'craftz',
		'swingster',
		'speaker',
		'nu',
		'galatea',
		'newtheme',
	);

	return ( ! in_array( esc_attr( sanitize_title_with_dashes( get_template() ) ), $ok, true ) );
}
