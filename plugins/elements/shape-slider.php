<?php
/**
 * Shape Slider
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
function wolf_core_shape_slider( $atts ) {

	$atts = apply_filters(
		'wolf_core_shape_slider_atts',
		wp_parse_args(
			$atts,
			array()
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	return $output;
}
