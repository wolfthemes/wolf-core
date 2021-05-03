<?php
/**
 * Contact Form 7
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
function wolf_core_contact_form_7( $atts ) {

	$atts = apply_filters(
		'wolf_core_contact_form_7_atts',
		wp_parse_args(
			$atts,
			array(
				'form_id'             => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-corecontact-form-7-container';

	$output .= '<div  class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );

	$output .= '>';

	if ( $form_id ) {
		$output .= do_shortcode( '[contact-form-7 id="' . absint( $form_id ) . '"]' );
	}

	$output .= '</div>';

	return $output;
}
