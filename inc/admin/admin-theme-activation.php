<?php
/**
 * Wolf Core admin theme activation
 *
 * Functions related to theme activation notice
 *
 * @author WolfThemes
 * @category Admin
 * @package WolfCore/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get theme name
 */
function wolf_core_get_theme_name() {
	$wp_theme = wp_get_theme( get_template() );
	return $wp_theme->Name; // phpcs:ignore
}

if ( ! function_exists( 'wolf_core_get_theme_slug' ) ) {
	/**
	 * Get the theme slug
	 *
	 * @return string
	 */
	function wolf_core_get_theme_slug() {

		return apply_filters( 'wolftheme_theme_slug', esc_attr( sanitize_title_with_dashes( get_template() ) ) );
	}
}

/**
 * About Me tab
 */
function wolf_core_output_about_me_tab() {
	?>
	<a href="#about-me" class="nav-tab"><?php esc_html_e( 'About me', 'wolf-core' ); ?></a>
	<?php
}
add_action( 'wolf_core_about_me_tab', 'wolf_core_output_about_me_tab' );

/**
 * Theme about_me tab content
 */
function wolf_core_output_about_me_tab_content() {
	?>
	<div id="about-me" class="wolf-core-options-panel">
		<div class="about-me-text wolftheme-about-me-text">
			<div class="row wolftheme-about-columns">
				<div class="col col-12">
					<h3>About Me</h3>

<img style="float:right; padding-left:40px;" src="https://assets.wolfthemes.com/me.jpg" alt="WolfThemes avatar">

<p>Hi there! I’m Constantin, the creator behind WolfThemes. With over 12 years of experience in designing WordPress themes, I’m passionate about crafting stunning, modern websites that help creative professionals, musicians, and artists showcase their work.</p>

<p>At WolfThemes, we’re all about helping you build beautiful, functional websites with ease. From drag-and-drop customization to seamless performance, my goal is to ensure every theme meets your needs while delivering a smooth user experience.</p>

<p>I'm truly grateful to have over 34,000 customers who trust my themes for their websites. Whether you're a band, musician, or part of a creative agency, it’s an honor to be part of your journey.</p>

<p><strong>I wish you all the best with your project!</strong></p>

<p><img style="max-width:150px" src="https://assets.wolfthemes.com/logo-dark.png" alt="WolfThemes logo"></p>

<h3>Want to Help?</h3>

<p>If you love the theme and it’s working well for you, please take a minute to leave a rating on <a href="https://themeforest.net/downloads" target="_blank">ThemeForest</a>. It would be greatly appreciated! 😉</p>

<p>Thank you for being part of the WolfThemes family!</p>

<p><em>— Constantin</em></p>

<p>
	<a href="https://themeforest.net/downloads"  target="_blank">
		<img style="max-width:150px; margin:15px 0;" src="https://assets.wolfthemes.com/5-stars.png" alt="5-stars">
	</a>
</p>
<p><a class="button-primary" href="https://themeforest.net/downloads"  target="_blank">Leave a rating</a></p>

					</div>
				</div>
			</div>
		</div>
	<?php
}
add_action( 'wolf_core_about_me_tab_content', 'wolf_core_output_about_me_tab_content' );

/**
 * License Me tab
 */
function wolf_core_output_license_tab() {
	?>
	<a href="#license" class="nav-tab"><?php esc_html_e( 'License', 'wolf-core' ); ?></a>
	<?php
}
add_action( 'wolf_core_license_tab', 'wolf_core_output_license_tab' );

/**
 * Theme  tab
 */
function wolf_core_output_license_tab_content() {

	if ( isset( $_POST['wolf_core_reset_purchase_code'] ) ) :
		wolf_core_reset_license_data();
		endif;
	?>
	<div id="license" class="wolf-core-options-panel">
	<?php
		$activated  = wolf_core_activate_theme();
		$theme_name = wolf_core_get_theme_name();
		$theme_slug = wolf_core_get_theme_slug();
	?>
		<ul class="wolf-core-license-info">
			<li>
			<?php
				printf(
					wp_kses_post( __( '%1$s theme works with <strong>%2$s</strong> plugin to offer all its features.', 'wolf-core' ) ),
					$theme_name,
					// 'https://wolfthemes.com/wolf-wpbakery-page-builder-extension/',
					'Wolf Core'
				);
			?>
			</li>
			<li>
				<?php
					printf(
						wp_kses_post( __( 'It extends of <a href="%1$s" target="_blank">%2$s</a> plugin.', 'wolf-core' ) ),
						'https://elementor.com/',
						'Elementor'
					);
				?>
			</li>
			<li>
				<?php esc_html_e( 'It includes plugin territory features that boost the theme functionalities.', 'wolf-core' ); ?>
			</li>
			<li>
				<?php
				printf(
					wp_kses_post( __( 'This extension is available only to users who purchased their theme from <a href="%1$s" target="_blank">%2$s</a>.', 'wolf-core' ) ),
					'https://wolfthemes.com',
					'WolfThemes'
				);
				?>
			</li>
			<!-- <li> -->
			<?php
				// echo sprintf(
				// wp_kses_post( __( 'You <strong>do not need to activate %s</strong> as the full version is already included in the theme (<a href="%s" target="_blank">more infos</a>).', 'wolf-core' ) ),
				// 'WPBakery Page Builder',
				// 'https://wolfthemes.ticksy.com/article/12629/'
				// );
			?>
			<!-- </li> -->
		</ul>
		<?php if ( ! $activated ) : ?>
		<p class="wolf-core-license-cta-text">
			<?php
				printf(
					wp_kses_post( __( 'Please enter your <strong>theme purchase code</strong> below to activate your theme  and be able to use all features.', 'wolf-core' ) ),
					'WolfThemes'
				);
			?>
		</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-about' ) ); ?>">
		<input name="theme_purchase_code" placeholder="693e0017-48d3-4bd5-be47-1c5c14e7ab9c" type="text" class="regular-text wolf-core-license-input"><input value="<?php esc_html_e( 'Activate', 'wolf-core' ); ?>" type="submit" class="button button-primary wolf-core-license-button">
		</form>
		<p>
			<a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-"><?php esc_html_e( 'How to find your purchase code', 'wolf-core' ); ?></a>
		</p>
		<?php else : ?>
		<p>

			<?php
			printf(
				wp_kses_post( __( 'The %s Extension is activated.', 'wolf-core' ) ),
				'Wolf Core'
			);

			$support_end_date = get_option( 'wolf_core_supported_until' );

			if ( $support_end_date ) {
				echo '<br>';
				echo '<strong>';

				if ( wolf_core_support_expired() ) {
					// If support has expired, show the renewal message
					echo wp_sprintf(
						wp_kses_post( __( 'Your support for %1$s has expired. You can renew it <a target="_blank" href="%2$s">HERE</a>.', 'wolf-core' ) ),
						esc_html( wolf_core_get_theme_name() ),
						esc_url( 'https://themeforest.net/downloads' )
					);
				} else {
					// Convert the ISO 8601 formatted date to a timestamp
					$support_end_timestamp = strtotime( $support_end_date );
					// Format the timestamp into a more readable date
					$formatted_date = date( 'F j, Y', $support_end_timestamp ); // E.g., December 8, 2024

					// Show the valid support message with the expiration date
					echo wp_sprintf(
						wp_kses_post( __( 'Your support for %1$s is valid until <span style="color: #28a745;">%2$s</span>.', 'wolf-core' ) ),
						esc_html( wolf_core_get_theme_name() ),
						esc_html( $formatted_date )
					);
				}

				echo '</strong>';
			}
			?>
		</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-about' ) ); ?>"><input name="wolf_core_reset_purchase_code" value="<?php esc_html_e( 'Reset purchase code', 'wolf-core' ); ?>" type="submit" class="button button-secondary">
			</form>
			<?php
		endif;

		?>
	</div><!-- # -->
	<?php
}
add_action( 'wolf_core_license_tab_content', 'wolf_core_output_license_tab_content' );

/**
 * Activate the theme
 */
function wolf_core_activate_theme() {

	$activated     = get_option( 'wolf_core_key' );
	$is_error      = false;
	$error_message = esc_html__( 'Something went wrong. It may be due to a temporary Envato API outage. Please try again in a few minutes.', 'wolf-core' );
	$error         = '';

	// Check if cURL is enabled on the server
	if ( ! function_exists( 'curl_init' ) ) {
		$is_error = true;
		$error    = esc_html__( 'The server does not support cURL, which is required for theme activation. Please contact your hosting provider.', 'wolf-core' );
	}

	// Check if the theme is not already activated
	if ( ! $activated && ! $is_error ) {

		/* Verify purchase */
		if ( ! empty( $_POST['theme_purchase_code'] ) ) {

			$code       = esc_attr( $_POST['theme_purchase_code'] );
			$remote_url = 'https://api.wolfthemes.cloud/envato/';
			$url        = $remote_url . '?code=' . $code;

			// Send request
			$response = wp_safe_remote_post(
				$url,
				array(
					'method'  => 'POST',
					'timeout' => 20,
					'body'    => array(
						'action'        => 'activation',
						'purchase_code' => $code,
						'site_domain'   => wolf_get_license_domain(), // Add this line
					),
				)
			);

			// Check for WP errors first
			if ( is_wp_error( $response ) ) {
				$is_error = true;
				$error    = $response->get_error_message();

				// Handle specific cURL errors
				if ( strpos( $error, 'cURL' ) !== false ) {
					$error = esc_html__( 'The request failed due to a cURL error. This may be caused by firewall or DNS blocking. Please check with your hosting provider to ensure that outgoing requests to api.wolfthemes.cloud are allowed.', 'wolf-core' );
				}
			} elseif ( is_array( $response ) ) {

				// Retrieve the response body
				$body = wp_remote_retrieve_body( $response );

				// Check if the body is empty
				if ( ! $body ) {
					$is_error = true;
					$error    = esc_html__( 'No response body received from the server. Please try again later.', 'wolf-core' );
				} else {
					// Decode the JSON response
					$data = json_decode( $body );

					// Validate the response data
					if ( $data && is_object( $data ) && isset( $data->code ) && isset( $data->key ) ) {

						// Save activation details
						wolf_core_store_license_data( $data );
						$activated = true;

						// Display success message
						echo '<div class="wolf-core-activation-success wolf-core-notice-warning wolf-core-admin-notice">';
						echo '<p>' . esc_html__( 'Extension activated', 'wolf-core' ) . '</p>';
						echo '</div>';

						// Redirect after activation
						wp_safe_redirect( admin_url( 'themes.php?page=' . wolf_core_get_theme_slug() . '-about#license' ) );
						exit;

					} elseif ( isset( $data->error ) ) {
						$is_error = true;
						$error    = esc_html__( 'Error: ' . $data->error, 'wolf-core' );
					} else {
						$is_error = true;
						$error    = esc_html__( 'Invalid or incomplete data received from the server. Please try again.', 'wolf-core' );
						// Log error with raw response body for further debugging
						error_log( 'Activation Error: Invalid or incomplete data. Raw response: ' . print_r( $body, true ) );
					}
				}
			} else {
				$is_error = true;
				$error    = esc_html__( 'Unexpected error during the request. Please try again later.', 'wolf-core' );
			}
		} else {
			$is_error = true;
			$error    = esc_html__( 'Purchase code cannot be empty', 'wolf-core' );
		}
	} elseif ( $activated ) {
		return true;
	}

	// Display error message if there was an error
	if ( $is_error && $error && isset( $_POST['theme_purchase_code'] ) ) {
		echo '<div class="wolf-core-activation-error wolf-core-notice-warning wolf-core-admin-notice">';
		echo '<p>' . esc_attr( $error ) . '</p>';
		echo '</div>';
	}

	return $activated;
}

/**
 * Get transient timeout
 *
 * @param string $transient The transient name.
 * @return void
 */
function wolf_core_get_transient_timeout( $transient ) {
	global $wpdb;
		$transient_timeout = $wpdb->get_col(
			"
		SELECT option_value
		FROM $wpdb->options
		WHERE option_name
		LIKE '%_transient_timeout_$transient%'
		"
		);
	return ( isset( $transient_timeout[0] ) ) ? absint( ( $transient_timeout[0] - time() ) / DAY_IN_SECONDS ) : false;
}