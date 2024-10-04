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
	?>
	<?php
	if ( isset( $_POST['wolf_core_reset_purchase_code'] ) ) :
		delete_option( 'wolf_core_activation_notice_set' );
		delete_transient( 'wolf_core_activation_notice' );
		delete_option( 'wolf_core_activation_time' );
		delete_option( 'wolf_core_activated' );
		delete_option( 'wolf_core_code' );
		delete_option( 'wolf_core_key' );
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
				echo sprintf(
					wp_kses_post( __( '%1$s theme works with <strong>%2$s</strong> plugin to offer all its features.', 'wolf-core' ) ),
					$theme_name,
					// 'https://wolfthemes.com/wolf-wpbakery-page-builder-extension/',
					'Wolf Core'
				);
			?>
			</li>
			<li>
				<?php
					echo sprintf(
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
				echo sprintf(
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
				echo sprintf(
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
			echo sprintf(
				wp_kses_post( __( 'The %s is activated.', 'wolf-core' ) ),
				'Wolf Core'
			);
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
	$error_message = esc_html__( 'Something went wrong. It way be due to a temporary Envato API outage. Please try again in a few minutes.', 'wolf-core' );

	if ( ! $activated ) {

		/* Verifiy purchase */
		if ( ! empty( $_POST['theme_purchase_code'] ) ) {

			$code       = esc_attr( $_POST['theme_purchase_code'] );
			$remote_url = 'https://api.wolfthemes.com/envato/';
			// $remote_url = 'http://localhost/api/envato/';

			$url = $remote_url . '?code=' . $code;

			// send request
			$response = wp_safe_remote_post(
				$url,
				array(
					'method' => 'POST',
					'body'   => array(
						'action'        => 'activation',
						'purchase_code' => $code,
					),
				)
			);

			// get result if no error
			if ( ! is_wp_error( $response ) && is_array( $response ) ) {

				$body = wp_remote_retrieve_body( $response ); // use the content

				if ( $body ) {

					$data = json_decode( $body );

					if ( $data && is_object( $data ) && isset( $data->code ) && isset( $data->key ) ) {

						// set_transient( 'wolf_core_activated', true, 365 * DAY_IN_SECONDS );
						update_option( 'wolf_core_activated', true );
						update_option( 'wolf_core_activation_time', time() );
						add_option( 'wolf_core_code', $data->code );
						add_option( 'wolf_core_key', $data->key );
						delete_transient( 'wolf_core_activation_notice' );
						$activated = true;

						echo '<div class="notice-success notice">';
						echo '<p>';
						esc_html_e( 'Extension activated', 'wolf-core' );
						echo '</p>';
						echo '</div>';

						wp_safe_redirect( admin_url( 'themes.php?page=' . wolf_core_get_theme_slug() . '-about' ) );
						exit;

					} else {
						$is_error = true;
						$error    = $error_message;
					}
				} else {
					$is_error = true;
					$error    = $error_message;
				}
			} else {
				$is_error = true;
				$error    = $error_message;
			}
		} else {
			$is_error = true;
			$error    = esc_html__( 'Purchase code can not be empty', 'wolf-core' );
		}
	} elseif ( $activated ) {

		return true;
	}

	if ( $is_error && $error ) {

		echo '<div class="notice-error notice">';
		echo '<p>';
		echo esc_attr( $error );
		echo '</p>';
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
