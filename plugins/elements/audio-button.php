<?php
/**
 * Audio button
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the Audio button markup
 *
 * @param array $atts attributes.
 */
function wolf_core_audio_button( $atts ) {
	$atts = apply_filters(
		'wolf_core_audio_button_atts',
		wp_parse_args(
			$atts,
			array(
				'file'                      => '',
				'css_animation'             => '',
				'css_animation_delay'       => '',
				'el_class'                  => '',
				'css'                       => '',
				'inline_style'              => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	// If elementor get file ID.
	if ( is_array( $file ) && isset( $file['url'] ) ) {
		$file = $file['url'];
	}

	$output      = '';
	$rand_id = wp_rand(0, 9999);

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-audio-button wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';
	$output .= '<span class="wolf-core-audio-button-icon">▶️</spa>';
	$output .= '<audio id="wolf-core-audio-button-player-' . $rand_id . '" class="wolf-core-audio-button-player" preload="metadata">';
	$output .= '<source src="' . $file . '" type="audio/mpeg">';
	$output .= esc_html__( 'Your browser does not support the audio element.', 'wolf-core' );
	$output .= '</audio>';

	$output .= '</div><!--.wolf-core-audio-button-->';

	return $output;
}
