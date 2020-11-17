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
	return $wp_theme->Name;
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
 * Theme license tab
 */
function wolf_core_output_license_tab() {
	?>
	<a href="#license" class="nav-tab"><?php esc_html_e( 'License', 'wolf-core' ); ?></a>
	<?php
}
add_action( 'wolf_core_license_tab', 'wolf_core_output_license_tab' );

/**
 * Theme license tab
 */
function wolf_core_output_license_tab_content() {
	?>
	<?php
		if ( isset( $_POST['wolf_core_reset_purchase_code'] ) ) :
			delete_option( 'wolf_core_activation_notice_set' );
			delete_transient( 'wolf_core_activation_notice' );
			delete_option( 'wolf_core_activated' );
			delete_option( 'wolf_core_code' );
			delete_option( 'wolf_core_key' );
		endif;
	?>
	<div id="license" class="wvc-options-panel">
	<?php
		$activated = wolf_core_activate_theme();
		$theme_name = wolf_core_get_theme_name();
		$theme_slug = wolf_core_get_theme_slug();
		?>
		<ul class="wvc-license-info">
			<li>
			<?php
				echo sprintf(
					wp_kses_post( __( '%s theme works with <strong>%s</strong> plugin to offer all its features.', 'wolf-core' ) ),
					$theme_name,
					//'https://wolfthemes.com/wolf-wpbakery-page-builder-extension/',
					'Wolf Core'
				);
			?>
			</li>
			<li>
				<?php
					echo sprintf(
						wp_kses_post( __( 'It extends of <a href="%s" target="_blank">%s</a> and <a href="%s" target="_blank">%s</a> plugin.', 'wolf-core' ) ),
						'https://wlfthm.es/wpbpb',
						'WPBakery Page Builder',
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
				echo sprintf(
					wp_kses_post( __( 'This extension is available only to users who purchased their theme from <a href="%s" target="_blank">%s</a>.', 'wolf-core' ) ),
					'https://wolfthemes.com',
					'WolfThemes'
				);
			?>
			</li>
			<!-- <li> -->
			<?php
				// echo sprintf(
				// 	wp_kses_post( __( 'You <strong>do not need to activate %s</strong> as the full version is already included in the theme (<a href="%s" target="_blank">more infos</a>).', 'wolf-core' ) ),
				// 	'WPBakery Page Builder',
				// 	'https://wolfthemes.ticksy.com/article/12629/'
				// );
			?>
			<!-- </li> -->
		</ul>
		<?php if ( ! $activated ) : ?>
		<p class="wvc-license-cta-text">
			<?php
				echo sprintf(
					wp_kses_post( __( 'Please enter your <strong>theme purchase code</strong> below to activate your theme license and be able to use all features.', 'wolf-core' ) ),
					'WolfThemes'
				);
			?>
		</p>
		<form method="post" action="<?php echo esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-about' ) ); ?>">
		<input name="theme_purchase_code" placeholder="693e0017-48d3-4bd5-be47-1c5c14e7ab9c" type="text" class="regular-text wvc-license-input"><input value="<?php esc_html_e( 'Activate', 'wolf-core' ); ?>" type="submit" class="button button-primary wvc-license-button">
		</form>
		<p>
			<a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-"><?php esc_html_e( 'How to find your purchase code', 'wolf-core' ); ?></a>
		</p>
		<?php else : ?>
		<p><?php
			echo sprintf(
				wp_kses_post( __( 'The %s is activated.', 'wolf-core' ) ),
				'Wolf Core'
			);
		?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'themes.php?page=' . $theme_slug . '-about' ) ); ?>"><input name="wolf_core_reset_purchase_code" value="<?php esc_html_e( 'Reset purchase code', 'wolf-core' ); ?>" type="submit" class="button button-secondary">
			</form>
		<?php
		endif;

	?>
	</div><!-- #license -->
	<?php
}
add_action( 'wolf_core_license_tab_content', 'wolf_core_output_license_tab_content' );

/**
 * Output the last new feature if set in the changelog XML
 *
 */
function wolf_core_activate_theme() {

	$activated = get_option( 'wolf_core_key' );
	$is_error = false;
	$error_message = esc_html__( 'Something went wrong. It way be due to a temporary Envato API outage. Please try again in a few minutes.', 'wolf-core' );

	if ( ! $activated && isset( $_POST['theme_purchase_code'] ) ) {

		/* Verifiy purchase */
		if ( isset( $_POST['theme_purchase_code'] ) && ! empty( $_POST['theme_purchase_code'] ) ) {

			$code = esc_attr( $_POST['theme_purchase_code'] );
			$remote_url = 'https://api.wolfthemes.com/envato/';
			//$remote_url = 'http://localhost/api/envato/';

			$url = $remote_url . '?code=' . $code;

			// send request
			$response = wp_remote_post( $url, array(
				'method' => 'POST',
				'body' => array(
					'action' => 'activation',
					'purchase_code' => $_POST['theme_purchase_code'],
				),
			) );

			// get result if no error
			if ( ! is_wp_error( $response ) && is_array( $response ) ) {

				$body = wp_remote_retrieve_body( $response ); // use the content

				if ( $body ) {

					$data = json_decode( $body );

					if ( $data && is_object( $data ) && isset( $data->code ) && isset( $data->key ) ) {

						//set_transient( 'wolf_core_activated', true, 365 * DAY_IN_SECONDS );
						update_option( 'wolf_core_activated', true );
						add_option( 'wolf_core_code', $data->code );
						add_option( 'wolf_core_key', $data->key );
						delete_transient( 'wolf_core_activation_notice' );
						$activated = true;

						echo '<div class="notice-success notice">';
						echo '<p>';
						esc_html_e( 'Extension activated', 'wolf-core' );
						echo '</p>';
						echo '</div>';

					} else {
						$is_error = true;
						$error = $error_message;
					}

				} else {
					$is_error = true;
					$error = $error_message;
				}

			} else {
				$is_error = true;
				$error = $error_message;
			}
		} else {
			$is_error = true;
			$error = esc_html__( 'Purchase code can not be empty', 'wolf-core' );
		}

	} else if ( $activated ) {

		return true;
	}

	if ( $is_error && $error ) {

		echo '<div class="notice-error notice">';
		echo '<p>';
		echo sanitize_text_field( $error );
		echo '</p>';
		echo '</div>';
	}

	return $activated;
}

function wolf_core_get_transient_timeout( $transient ) {
	global $wpdb;
		$transient_timeout = $wpdb->get_col( "
		SELECT option_value
		FROM $wpdb->options
		WHERE option_name
		LIKE '%_transient_timeout_$transient%'
		" );
	return ( isset( $transient_timeout[0] ) ) ? absint( ( $transient_timeout[0] - time() ) / DAY_IN_SECONDS ) : false;
}
