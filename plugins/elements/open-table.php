<?php
/**
 * Open Table
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
function wolf_core_open_table( $atts ) {

	$atts = apply_filters(
		'wolf_core_open_table_atts',
		wp_parse_args(
			$atts,
			array(

			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	return $output;
}
