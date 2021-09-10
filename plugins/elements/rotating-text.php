<?php
/**
 * Rotating Text
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
function wolf_core_rotating_text( $atts ) {

	$atts = apply_filters(
		'wolf_core_rotating_text_atts',
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

	$class .= ' wolf-core-rotating-text wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';
	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="100px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
	<defs><path id="circlePath" d="M 150, 150 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0 "></path>
	</defs><circle cx="150" cy="100" r="75" fill="none"></circle> <g> <use xlink:href="#circlePath" fill="none"></use>
	<text fill="#fff"><textPath xlink:href="#circlePath">' . esc_attr( $text ) . '</textPath> </text> </g> </svg>';
	$output .= '</div><!--.wolf-core-rotating-text-->';

	return $output;
}
