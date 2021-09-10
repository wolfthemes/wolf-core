<?php
/**
 * arquee ext
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the element markup
 *
 * @param array $atts The element attributes.
 */
function wolf_core_marquee_text( $atts ) {

	$atts = apply_filters(
		'wolf_core_marquee_text_atts',
		wp_parse_args(
			$atts,
			array(
				'text' => '',
				'width' => '',
				'link' => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-marquee-text wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';
	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<span>' . esc_attr( $text ) . '</span>';
	$output .= '<span>' . esc_attr( $text ) . '</span>';
	$output .= '<span>' . esc_attr( $text ) . '</span>';
	$output .= '<span>' . esc_attr( $text ) . '</span>';
	$output .= '<span>' . esc_attr( $text ) . '</span>';
	$output .= '<span>' . esc_attr( $text ) . '</span>';

	$output .= '</div><!--.wolf-core-marquee-text-->';

	return $output;
}
