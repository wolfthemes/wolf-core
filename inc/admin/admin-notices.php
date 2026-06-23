<?php
/**
 * Wolf Core Admin notices
 *
 * @author wolf_cores
 * @category Admin
 * @package WolfCore/Admin
 * @version 1.9.9
 */

defined( 'ABSPATH' ) || exit;


add_action(
	'admin_init',
	function () {
		wolf_core_dismiss_review_notification();
	}
);

/**
 * Output inviting message to rate the theme
 */
function wolf_core_rating_request_admin_notice() {

	global $pagenow;

	if ( 'index.php' !== $pagenow ) {
		return;
	}

	if ( isset( $_GET['page'] ) && 'revslider' === $_GET['page'] ) {
		return;
	}

	// delete_option( 'wolf_core_theme_review_dismissed_date' );
	// delete_option( 'wolf_core_theme_review_dismissed_permanently' );

	// debug( get_option( 'wolf_core_activation_time' ) );
	// debug( 'wolf_core_theme_review_dismissed_permanently ' . get_option( "wolf_core_theme_review_dismissed_permanently" ) );

	if ( ! wolf_core_rating_notif_needed() ) {
		return;
	}

	if ( ! wolf_core_should_show_review_notification() ) {
		return;
	}

	$theme_name  = wolf_core_get_theme_name();
	$review_link = 'https://themeforest.net/downloads';

	$message = wp_sprintf(
		'<p class="wolf-core-admin-notice-img"><img src="%1$s" alt="WolfThemes avatar"></p>
	<p class="wolf-core-admin-notice-title"><strong>Enjoying %2$s? I’d Love Your Feedback!</strong></p>
        <p>Thank you for using %2$s. If it’s been helpful for your project, I’d really appreciate it if you could take a moment to leave a review.
		It will help me a ton!</p>
		<p class="wolf-core-admin-notice-cite">&mdash; Constantin from WolfThemes</p>
        <p><a href="%3$s" class="button-primary" target="_blank">Leave a Review</a> &nbsp; <a href="%4$s" class="button-secondary">Remind me later</a></p>
    	<p><em>Not now? No problem! You can dismiss this message anytime.</em><p>
		<p><a href="%5$s" class="button-link">Hide permanently</a></p>
		',
		esc_html( 'https://assets.wolfthemes.com/me.jpg' ),
		esc_html( $theme_name ), // %2$s - Theme name
		esc_url( $review_link ),   // %3$s - Review link
		esc_url( add_query_arg( 'wolf_core_dismiss_review_notification', '1' ) ), // %4$s - Dismiss link
		esc_url( add_query_arg( 'wolf_core_dismiss_review_notification', '2' ) ) // %5$s - Dismiss link
	);

	wolf_core_admin_notice( $message, 'success' );
}
add_action( 'admin_init', 'wolf_core_rating_request_admin_notice' );

/**
 * Dismiss notif
 *
 * @return void
 */
function wolf_core_dismiss_review_notification() {
	if ( isset( $_GET['wolf_core_dismiss_review_notification'] ) ) {
		$dismiss_type = absint( $_GET['wolf_core_dismiss_review_notification'] );

		if ( $dismiss_type === 1 ) {
			// Temporarily dismiss for 30 days
			update_option( 'wolf_core_theme_review_dismissed_date', time() );
		} elseif ( $dismiss_type === 2 ) {
			// Permanently dismiss
			update_option( 'wolf_core_theme_review_dismissed_permanently', true );
		}
	}
}


/**
 * Undocumented function
 *
 * @return void
 */
function wolf_core_should_show_review_notification() {
	// Check if the user permanently dismissed the notification
	$dismissed_permanently = get_option( 'wolf_core_theme_review_dismissed_permanently' );

	if ( $dismissed_permanently ) {
		return false; // Don't show the notification again
	}

	// Check if the notification has been dismissed temporarily and when
	$dismissed_date = get_option( 'wolf_core_theme_review_dismissed_date' );

	// If it was dismissed, check if 15 days have passed since
	if ( $dismissed_date ) {
		$thirty_days_in_seconds = 15 * 24 * 60 * 60;
		if ( ( time() - $dismissed_date ) < $thirty_days_in_seconds ) {
			return false; // Less than 15 days have passed
		}
	}

	return true; // Show the notification
}

/**
 * Custom admin notice
 *
 * @param string $message the message string.
 * @param string $type error|warning|info|success.
 * @param string $cookie_id if set a cookie will be use to hide the notice permanently.
 * @param string $dismiss_text dismiss message text.
 */
function wolf_core_admin_notice( $message = null, $type = null, $cookie_id = null, $dismiss_text = null ) {

	if ( ! $message || defined( 'DOING_AJAX' ) ) {
		return;
	}

	$is_dismissible = ( 'error' === $message ) ? '' : 'is-dismissible';

	if ( $cookie_id ) {

		if ( ! $dismiss_text ) {
			$dismiss_text = esc_html__( 'Hide permanently', 'wolf-core' );
		}

		if ( $cookie_id ) {
			if ( ! isset( $_COOKIE[ $cookie_id ] ) ) {
				$href = esc_url( admin_url( 'themes.php?page=' . wolf_core_get_theme_slug() . '-about&amp;dismiss=' . $cookie_id ) );
				echo wolf_core_kses( "<div class='notice notice-$type $is_dismissible wolf-core-admin-notice'><p>$message</p><p><a href='$href' id='$cookie_id' class='button wolf_core-dismiss-admin-notice'>$dismiss_text</a></p></div>" ); // WCS XSS ok.
			}
		}
	} else {
		echo wolf_core_kses( "<div class='notice notice-$type $is_dismissible wolf-core-admin-notice'><p>$message</p></div>" ); // phpcs:ignore
	}
	return false;
}
add_action( 'admin_notices', 'wolf_core_admin_notice' );

/**
 * Activated since 35 days
 */
function wolf_core_rating_notif_needed() {

	return wolf_core_is_35_days_after_activation();
}

function wolf_core_is_35_days_after_activation() {
	$activation_date = get_option( 'wolf_core_activation_time' );

	if ( $activation_date ) {
		// Get the current timestamp
		$current_time = time();

		// Calculate the difference (35 days in seconds = 30 * 24 * 60 * 60)
		$thirty_days_in_seconds = 35 * DAY_IN_SECONDS;

		// Check if 30 days have passed
		if ( ( $current_time - $activation_date ) >= $thirty_days_in_seconds ) {
			return true; // 35 days have passed
		}
	}
	// return true; // debug
	return false; // Not yet 35 days
}

/**
 * Check if support is expired
 *
 * @return bool
 */
function wolf_core_support_expired() {

	// return true;

	// Retrieve the support end date from the options table
	$support_end_date = get_option( 'wolf_core_supported_until' );

	// If there's no support end date saved, return early
	if ( ! $support_end_date ) {
		return;
	}

	// Convert the ISO 8601 formatted date to a timestamp
	$support_end_timestamp = strtotime( $support_end_date );

	// Get the current timestamp
	$current_timestamp = time();

	// Check if the support period has expired
	if ( $support_end_timestamp < $current_timestamp ) {
		return true;
	}
}

/**
 * Display admin notice for support renewal
 */
function wolf_core_display_support_renewal_notice() {

	global $pagenow;

	if ( 'index.php' !== $pagenow ) {
		return;
	}

	ob_start();
	?>
	<p>
		<?php
		echo wp_sprintf(
			__( '<strong>Need help? Your support for %s has expired.</strong> Renew now to continue receiving expert assistance and updates whenever you need it. Stay worry-free with full support—renew today.', 'wolf-core' ),
			esc_attr( wolf_core_get_theme_name() )
		);
		?>
	</p>
	<p>
	<a class="button button-primary button-hero" href="<?php echo esc_url( 'https://themeforest.net/downloads' ); ?>" target="_blank">
		<?php esc_html_e( 'Renew support now for continued assistance.', 'wolf-core' ); ?>
	</a>
	</p>
	<?php
	$hide_message = esc_html__( 'I’ll renew later. Hide this notice.', 'wolf-core' );
	$message      = ob_get_clean();

	if ( wolf_core_support_expired() ) {
		wolf_core_admin_notice( $message, 'warning', '_wolf_support_expired', $hide_message );
	}
}

// Hook the support expiration check into the admin area
add_action( 'admin_init', 'wolf_core_display_support_renewal_notice' );

/**
 * Display admin notice if Content Block is not enabled in Elementor settings with dismissal
 */
function wolf_core_content_block_elementor_notice() {
	global $typenow;
	if ( 'wolf_content_block' !== $typenow ) {
		return;
	}

	// Check if dismissed permanently
	if ( get_option( 'wolf_core_content_block_notice_dismissed' ) ) {
		return;
	}

	$elementor_cpt_support = get_option( 'elementor_cpt_support', array() );
	if ( ! in_array( 'wolf_content_block', $elementor_cpt_support ) ) {
		$message  = '<p><strong>Content Block is not enabled in Elementor!</strong></p>';
		$message .= '<p>To use this post type with Elementor, please enable it in the Elementor settings.</p>';
		$message .= '<p><a href="' . esc_url( admin_url( 'admin.php?page=elementor-settings' ) ) . '" class="button-primary">Go to Elementor Settings</a></p>';

		wolf_core_admin_notice( $message, 'warning', 'wolf_core_content_block_notice', 'Hide permanently' );
	}
}
add_action( 'admin_notices', 'wolf_core_content_block_elementor_notice' );

// Handle dismissal
function wolf_core_dismiss_content_block_notice() {
	if ( isset( $_GET['dismiss'] ) && 'wolf_core_content_block_notice' === $_GET['dismiss'] ) {
		update_option( 'wolf_core_content_block_notice_dismissed', true );
	}
}
add_action( 'admin_init', 'wolf_core_dismiss_content_block_notice' );