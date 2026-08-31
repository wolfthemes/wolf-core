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
				'rid'         => '412810',
				'lang'        => 'en-US',
				'theme'       => 'wide',
				'color'       => '2',
				'dark'        => 'false',
				'newtab'      => 'false',
				'ot_campaign' => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = "<script type='text/javascript' src='https://www.opentable.com/widget/reservation/loader?rid=$rid&type=standard&theme=$theme&color=$color&dark=$dark&iframe=false&domain=com&lang=$lang&newtab=$newtab&ot_source=Restaurant%20website&ot_campaign=$ot_campaign'></script>";

	$class = $el_class; // init container CSS class.

	return $output;
}
