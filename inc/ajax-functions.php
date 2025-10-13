<?php
/**
 * Wolf Core AJAX functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get background markup
 */
function wolf_core_ajax_get_bg_markup() {

	extract( $_POST ); // phpcs:ignore

	$output = '';

	$_POST['background_img_lazyload'] = false;

	if ( 'image' === $background_type ) {

		$output = wolf_core_background_img( $_POST );

	} elseif ( 'video' === $background_type ) {

		$output = wolf_core_background_video( $_POST );
	}

	if ( 'yes' === $add_overlay ) {

		$main_image     = ( 'video' === $background_type ) ? $video_bg_img : $image;
		$dominant_color = wolf_core_get_image_dominant_color( $main_image );

		if ( 'auto' === $overlay_color ) {
			$overlay_custom_color = ( $dominant_color ) ? $dominant_color : '#000000';
		}

		$output .= wolf_core_background_overlay(
			array(
				'overlay_color'        => $overlay_color,
				'overlay_custom_color' => $overlay_custom_color,
				'overlay_opacity'      => $overlay_opacity,
			)
		);
	}

	if ( $add_effect ) {
		$output .= apply_filters( 'wolf_core_background_effect', '', $atts );
	}

	echo $output;

	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_get_bg_markup', 'wolf_core_ajax_get_bg_markup' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_get_bg_markup', 'wolf_core_ajax_get_bg_markup' );

/**
 *  Mailchimp subscription
 */
function wolf_core_mailchimp_ajax() {

	extract( $_POST ); // phpcs:ignore

	// debug( $_POST );

	if ( isset( $_POST['email'] ) && isset( $_POST['list_id'] ) ) {
		$f_name   = ( isset( $_POST['firstName'] ) ) ? esc_attr( $_POST['firstName'] ) : '';
		$l_name   = ( isset( $_POST['lastName'] ) ) ? esc_attr( $_POST['lastName'] ) : '';
		$has_name = isset( $_POST['hasName'] ) && 'yes' === $_POST['hasName'];
		$email    = sanitize_email( esc_attr( $_POST['email'] ) );
		$list_id  = esc_attr( $_POST['list_id'] );

		$data = array(
			'list_id'   => $list_id,
			'email'     => $email,
			'status'    => 'subscribed',
			'firstname' => $f_name,
			'lastname'  => $l_name,
		);

		if ( $has_name && ( ! $f_name || ! $l_name ) ) {

			esc_html_e( 'Please insert your name', 'wolf-visual-composer' );

		} elseif ( ! is_email( $email ) ) {

			esc_html_e( 'Please insert a valid email', 'wolf-visual-composer' );

		} else {
			// Subscribe
			wolf_core_sync_mailchimp( $data );
			// WVCM()->subscribe( $list_id, $email, $f_name, $l_name );
			// echo 'OK';
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_mailchimp_ajax', 'wolf_core_mailchimp_ajax' );
add_action( 'wp_ajax_nopriv_wolf_core_mailchimp_ajax', 'wolf_core_mailchimp_ajax' );

/**
 * Get URL of an attachment post by ID
 */
function wolf_core_ajax_get_url_from_attachment_id() {

	extract( $_POST );

	if ( isset( $_POST['attachmentId'] ) ) {
		$attachment_id = absint( $_POST['attachmentId'] );
		$size          = ( isset( $_POST['size'] ) ) ? sanitize_text_field( $_POST['size'] ) : 'wpb-thumbnail';
		if ( wolf_core_get_url_from_attachment_id( $attachment_id, $size ) ) {
			echo wolf_core_get_url_from_attachment_id( $attachment_id, $size );
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_get_url_from_attachment_id', 'wolf_core_ajax_get_url_from_attachment_id' );

/**
 * Get video embed code from URL
 */
function wolf_core_ajax_get_video_embed_from_url() {

	extract( $_POST );

	if ( isset( $_POST['videoUrl'] ) ) {

		$v_url   = esc_url( $_POST['videoUrl'] );
		$post_id = absint( $_POST['postId'] );

		if ( preg_match( '/(http:|https:)?\/\/[a-zA-Z0-9\/.?&=_-]+.mp4/', $v_url, $match ) ) {

			$video_attrs = array(
				'src'      => esc_url( $v_url ),
				'poster'   => get_the_post_thumbnail_url( $post_id ),
				'autoplay' => false,
				'preload'  => true,
			);

			echo wp_video_shortcode( $video_attrs ); // phpcs:ignore

		} else {
			echo wp_oembed_get( $v_url ); // phpcs:ignore
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_get_video_embed_from_url', 'wolf_core_ajax_get_video_embed_from_url' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_get_video_embed_from_url', 'wolf_core_ajax_get_video_embed_from_url' );

/**
 * AJAX BMIX form
 */
function wolf_core_ajax_bmic_form() {

	extract( $_POST ); // phpcs:ignore

	$response = array(
		'result'  => '',
		'message' => '',
	);

	if ( isset( $_POST['height'] ) && isset( $_POST['weight'] ) && isset( $_POST['age'] ) && isset( $_POST['sex'] ) && isset( $_POST['activityFactor'] ) ) {

		$unit            = esc_attr( $_POST['unit'] );
		$height          = esc_attr( $_POST['height'] );
		$weight          = esc_attr( $_POST['weight'] );
		$age             = absint( $_POST['age'] );
		$sex             = esc_attr( $_POST['sex'] );
		$activity_factor = esc_attr( $_POST['activityFactor'] );
		$min_height      = 100;
		$max_height      = 250;

		if ( 'imperial' === $unit ) {
			$min_height = 40;
			$max_height = 100;
		}

		// $response['message'] = 'Unit ' . $unit;

		if ( $height < $min_height || $height > $max_height ) {

			$response['result'] = 'error';
			// $response['message'] .= $height;
			$response['message'] = esc_html__( 'You height value seems incorrect. Please enter a valid number.', 'wolf-visual-composer' );

		} elseif ( $age < 5 || $age > 120 ) {

			$response['result']  = 'error';
			$response['message'] = esc_html__( 'You age seems incorrect. Please enter a valid number.', 'wolf-visual-composer' );

		} elseif ( $sex !== 'female' && $sex !== 'male' ) {

			$response['result']  = 'error';
			$response['message'] = esc_html__( 'Please select your sex.', 'wolf-visual-composer' );

		} elseif ( $activityFactor !== 'inactive' && $activityFactor !== 'low' && $activityFactor !== 'moderate' && $activityFactor !== 'high' && $activityFactor !== 'very-high' ) {
			$response['result']  = 'error';
			$response['message'] = esc_html__( 'Something went wrong while submitting the form, please try again later.', 'wolf-visual-composer' );
		} else {
			// GO.
			$response['result']  = 'success';
			$bmi                 = wolf_core_bmi( $height, $weight, $unit );
			$bmr                 = wolf_core_bmr( $height, $weight, $age, $sex, $unit );
			$status              = wolf_core_bmi_status( $bmi );
			$daliy_calorie_needs = wolf_core_daily_calorie_needs( $bmr, $activity_factor );
			$response['message'] = '<p>' . sprintf( wolf_core_kses( __( '<strong>You are %1$s *.</strong> Your BMI is <strong>%2$s</strong>. Your BMR is <strong>%3$s</strong>. Your daily calorie needs is <strong>%4$s</strong>.', 'wolf-visual-composer' ) ), $status, $bmi, $bmr, $daliy_calorie_needs ) . '</p>';

			$response['message'] .= '<p class="wvc-bmic-disclaimer">* ' . apply_filters( 'wolf_core_bmic_disclaimer_text', esc_html__( 'This calculation does not take into account factors which may affect a person height or weight like bodybuilders and athletes with a high proportion of muscle mass, pregnant women, the elderly or young children etc.', 'wolf-visual-composer' ) ) . '</p>';
		}

		echo wp_json_encode( $response );

	} else {
		$response['result']  = 'error';
		$response['message'] = esc_html__( 'Something went wrong while submitting the form, please try again later.', 'wolf-visual-composer' );

		echo wp_json_encode( $response );
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_bmic_form', 'wolf_core_ajax_bmic_form' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_bmic_form', 'wolf_core_ajax_bmic_form' );

/**
 * Update loading animation type
 */
function wolf_core_ajax_update_loading_animation_type_post_meta() {

	check_ajax_referer( 'wolf_core_ajax_nonce', 'security' );

	if ( isset( $_POST['loadingAnimationType'] ) && ! empty( $_POST['postId'] ) ) {

		if ( update_post_meta( absint( $_POST['postId'] ), '_post_loading_animation_type', esc_attr( $_POST['loadingAnimationType'] ) ) ) {
			echo 'OK';
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_update_loading_animation_type_post_meta', 'wolf_core_ajax_update_loading_animation_type_post_meta' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_update_loading_animation_type_post_meta', 'wolf_core_ajax_update_loading_animation_type_post_meta' );

/**
 * Update menu layout meta
 */
function wolf_core_ajax_update_menu_layout_post_meta() {

	check_ajax_referer( 'wolf_core_ajax_nonce', 'security' );

	if ( isset( $_POST['menuLayout'] ) && ! empty( $_POST['postId'] ) ) {

		if ( update_post_meta( absint( $_POST['postId'] ), '_post_menu_layout', esc_attr( $_POST['menuLayout'] ) ) ) {
			echo 'OK';
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_update_menu_layout_post_meta', 'wolf_core_ajax_update_menu_layout_post_meta' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_update_menu_layout_post_meta', 'wolf_core_ajax_update_menu_layout_post_meta' );

/**
 * Update menu style meta
 */
function wolf_core_ajax_update_menu_style_post_meta() {

	check_ajax_referer( 'wolf_core_ajax_nonce', 'security' );

	if ( isset( $_POST['menuStyle'] ) && ! empty( $_POST['postId'] ) ) {

		if ( update_post_meta( absint( $_POST['postId'] ), '_post_menu_style', esc_attr( $_POST['menuStyle'] ) ) ) {
			echo 'OK';
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_update_menu_style_post_meta', 'wolf_core_ajax_update_menu_style_post_meta' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_update_menu_style_post_meta', 'wolf_core_ajax_update_menu_style_post_meta' );

/**
 * Update hero font tone meta
 */
function wolf_core_ajax_update_hero_font_tone_post_meta() {

	check_ajax_referer( 'wolf_core_ajax_nonce', 'security' );

	if ( isset( $_POST['heroFontTone'] ) && ! empty( $_POST['postId'] ) ) {

		if ( update_post_meta( absint( $_POST['postId'] ), '_post_hero_font_tone', esc_attr( $_POST['heroFontTone'] ) ) ) {
			echo 'OK';
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_update_hero_font_tone_post_meta', 'wolf_core_ajax_update_hero_font_tone_post_meta' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_update_hero_font_tone_post_meta', 'wolf_core_ajax_update_hero_font_tone_post_meta' );

/**
 * Update header block
 */
function wolf_core_ajax_update_after_header_block_post_meta() {

	check_ajax_referer( 'wolf_core_ajax_nonce', 'security' );

	if ( isset( $_POST['afterHeaderBlock'] ) && ! empty( $_POST['postId'] ) ) {

		if ( update_post_meta( absint( $_POST['postId'] ), '_post_after_header_block', esc_attr( $_POST['afterHeaderBlock'] ) ) ) {
			echo 'OK';
		} else {
			echo 'error';
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_update_after_header_block_post_meta', 'wolf_core_ajax_update_after_header_block_post_meta' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_update_after_header_block_post_meta', 'wolf_core_ajax_update_after_header_block_post_meta' );

/**
 * Update footer block
 */
function wolf_core_ajax_update_before_footer_block_post_meta() {

	check_ajax_referer( 'wolf_core_ajax_nonce', 'security' );

	if ( isset( $_POST['beforeFooterBlock'] ) && ! empty( $_POST['postId'] ) ) {

		if ( update_post_meta( absint( $_POST['postId'] ), '_post_before_footer_block', esc_attr( $_POST['beforeFooterBlock'] ) ) ) {
			echo 'OK';
		} else {
			echo 'error footer';
		}
	}
	exit;
}
add_action( 'wp_ajax_wolf_core_ajax_update_before_footer_block_post_meta', 'wolf_core_ajax_update_before_footer_block_post_meta' );
add_action( 'wp_ajax_nopriv_wolf_core_ajax_update_before_footer_block_post_meta', 'wolf_core_ajax_update_before_footer_block_post_meta' );
