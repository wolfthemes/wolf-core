<?php
/**
 * Breadcrumb
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the Breadcrumb markup
 *
 * @param array $atts The Breadcrumb attributes.
 */
function wolf_core_breadcrumb( $atts ) {
	$atts = apply_filters(
		'wolf_core_breadcrumb_atts',
		wp_parse_args(
			$atts,
			array(
				'align'               => '',
				'text_align_mobile'   => '',
				'font_size'           => '',
				'font_weight'         => '',
				'text_transform'      => '',
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

	// $class .= ' wolf-core-mobile-text-align-' . $text_align_mobile;
	// $class .= " wolf-core-align-$align";

	// if ( $font_size ) {
	// $font_size     = wolf_core_sanitize_css_value( $font_size );
	// $inline_style .= "font-size:$font_size;";
	// }

	// if ( $text_transform ) {
	// $inline_style .= 'text-transform:' . esc_attr( $text_transform ) . ';';
	// }

	// if ( $font_weight ) {
	// $inline_style .= 'font-weight:' . absint( $font_weight ) . ';';
	// }

	$class .= ' wolf-core-breadcrumb wolf-core-element';

	$output .= '<div  class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );

	$output .= '>';

	$output .= wolf_core_get_breadcrumb();

	$output .= '</div>';

	return $output;
}
