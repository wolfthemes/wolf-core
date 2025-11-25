<?php
/**
 * WooCommerce Search Form
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
function wolf_core_wc_search_form( $atts ) {

	$atts = apply_filters(
		'wolf_core_wc_search_form_atts',
		wp_parse_args(
			$atts,
			array()
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-wc-search-form wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	if ( function_exists( 'get_product_search_form' ) ) {
		ob_start();
		get_product_search_form();
		$output .= ob_get_clean();
	}

	$output .= '</div><!-- .wolf-core-wc-search-form -->';

	return $output;
}
