<?php
/**
 * MailChimp function
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return a mailchimp Subscription form
 *
 * @param array $atts The attributes array.
 * @return string $output
 */
function wolf_core_mailchimp( $atts = array() ) {

	$atts = wp_parse_args(
		$atts,
		array(
			'list'                => wolf_core_get_option( 'mailchimp', 'default_mailchimp_list_id' ),
			'f_name'              => '',
			'l_name'              => '',
			'size'                => 'normal',
			'label'               => wolf_core_get_option( 'mailchimp', 'label' ),
			'submit_type'         => 'text',
			'submit_text'         => wolf_core_get_option( 'mailchimp', 'subscribe_text', esc_html__( 'Subscribe', 'wolf-core' ) ),
			'si_type'             => '',
			'icon'                => '',
			'bottom_line'         => wolf_core_get_option( 'mailchimp', 'bottom_line' ),
			'image_id'            => wolf_core_get_option( 'mailchimp', 'background' ),
			'show_bg'             => true,
			'show_label'          => true,
			'show_name'           => 'no',
			'placeholder_f_name'  => wolf_core_get_option( 'mailchimp', 'placeholder_f_name', esc_html__( 'Your first name', 'wolf-core' ) ),
			'placeholder_l_name'  => wolf_core_get_option( 'mailchimp', 'placeholder_l_name', esc_html__( 'Your last name', 'wolf-core' ) ),
			'placeholder'         => wolf_core_get_option( 'mailchimp', 'placeholder', esc_html__( 'Enter your email address', 'wolf-core' ) ),
			'button_style'        => '',
			'alignment'           => 'center',
			'text_alignment'      => 'center',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'enqueue_script'      => true,
			'submit_button_class' => '',
			'css'                 => '',
			'el_class'            => '',
			'inline_style'        => '',
		)
	);

	$atts = apply_filters( 'wolf_core_mailchimp_atts', $atts );

	extract( $atts ); // phpcs:ignore

	$list = apply_filters( 'wolf_core_default_mailchimp_list_id', wolf_core_get_option( 'mailchimp', 'default_mailchimp_list_id' ) );

	$output = '';

	$class = $el_class; // init container CSS class.

	if ( $enqueue_script && ! wp_script_is( 'wolf-core-mailchimp' ) ) {
		wp_enqueue_script( 'wolf-core-mailchimp' );
		// add JS global variables.
		wp_localize_script(
			'wolf-core-mailchimp',
			'WolfCoreMailchimpParams',
			array(
				'ajaxUrl'                       => esc_url( WOLF_CORE()->ajax_url() ),
				'subscriptionSuccessfulMessage' => wolf_core_get_option( 'mailchimp', 'thank_you_message', esc_html__( 'Thanks for subscribing', 'wolf-core' ) ),
			)
		);
	}

	$show_bg    = wolf_core_shortcode_bool( $show_bg );
	$show_label = wolf_core_shortcode_bool( $show_label );

	$class .= " wolf-core-mailchimp-form-container wolf-core-mailchimp-size-$size wolf-core-mailchimp-align-$alignment wolf-core-mailchimp-text-align-$text_alignment wolf-core-mc-submit-type-$submit_type wolf-core-element wolf-core-mailchimp-show-name-$show_name";

	$image_size = ( 'large' === $size ) ? 'large' : 'medium_large';
	$background = wolf_core_get_url_from_attachment_id( $image_id, $image_size );

	if ( $background && $show_bg ) {
		$class        .= ' wolf-core-mailchimp-has-bg wolf-core-font-light';
		$inline_style .= 'background-image:url(' . $background . ')';
	}

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<form class="wolf-core-mailchimp-form"><input type="hidden" name="wolf-core-mailchimp-list" class="wolf-core-mailchimp-list" value="' . esc_attr( $list ) . '">';

	$output .= '<input type="hidden" name="wolf-core-mailchimp-has-name" class="wolf-core-mailchimp-has-name" value="' . $show_name . '">';

	if ( $label && $show_label ) {
		$output .= '<h3 class="wolf-core-mailchimp-title">' . $label . '</h3>';
	}

	$output .= '<div class="wolf-core-mailchimp-inner">';

	if ( 'yes' === $show_name ) {

		$output .= '<div class="wolf-core-mailchimp-f-name-container wolf-core-mailchimp-input-container">
			<input placeholder="' . $placeholder_f_name . '"  type="text" name="wolf-core-mailchimp-f-name" class="wolf-core-mailchimp-f-name">
			</div>';

		$output .= '<div class="wolf-core-mailchimp-l-name-container wolf-core-mailchimp-input-container">
			<input placeholder="' . $placeholder_l_name . '"  type="text" name="wolf-core-mailchimp-l-name" class="wolf-core-mailchimp-l-name">
			</div>';
	}

	$output .= '<div class="wolf-core-mailchimp-email-container wolf-core-mailchimp-input-container">
		<input placeholder="' . $placeholder . '"  type="email" name="wolf-core-mailchimp-email" class="wolf-core-mailchimp-email">
		</div>';

	$output .= "<div class='wolf-core-mailchimp-submit-container'>";

	$button_class = apply_filters( 'wolf_core_mailchimp_submit_class', 'wolf-core-button wolf-core-mailchimp-submit ' . $button_style . ' ' . $submit_button_class );

	$output .= "<button class='$button_class'>";

	if ( 'icon' === $submit_type ) {

		$output .= "<i class='wolf-core-mc-icon fa $icon'></i>";

	} else {
		$output .= '<span class="wolf-core-button-text">' . $submit_text . '</span>';
	}

	$output .= '</button>';

	$output .= '</div>';
	$output .= '</div>'; // inner.
	$output .= '<div class="wolf-core-clear"></div>';
	$output .= '<span class="wolf-core-mailchimp-result">&nbsp;</span>';
	$output .= '</form>';
	$output .= '</div><!-- .wolf-core-mailchimp-form-container -->';

	$api_key = apply_filters( 'wolf_core_mailchimp_api_key', wolf_core_get_option( 'mailchimp', 'mailchimp_api_key' ) );

	if ( $api_key && ! empty( $list ) ) {

		return $output;

	} elseif ( is_user_logged_in() ) {

		$output = '<p class="wolf-core-align-center">';

		if ( ! $api_key ) {

			$output .= sprintf(
				wp_kses_post( __( '<p class="wolf-core-align-center">You must set a MailChimp API key in the <a href="%1$s" target="_blank">Wolf Core</a>. You can get your MailChimp API <a href="%2$s" target="_blank">here</a>.<p>', 'wolf-core' ) ),
				esc_url( admin_url( 'admin.php?page=wolf-core-mailchimp' ) ),
				esc_url( 'http://kb.mailchimp.com/integrations/api-integrations/about-api-keys' )
			);
			$output .= '<br>';
		}

		if ( ! $list ) {
			$output .= esc_html__( 'You must set a list ID.', 'wolf-core' );
		}

		$output .= '</p>';
		return $output;
	} else {

		$output = '';

		$output .= '<p class="wolf-core-align-center">' . esc_html__( 'Subscription to our newsletter open soon.', 'wolf-core' ) . '</p>';

		return $output;
	}
}
