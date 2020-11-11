<?php
/**
 * Big Text
 *
 * @author WolfThemes
 * @category Core
 * @package %PACKAGENAME%/Elements
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

/**
 * Element Parameters
 *
 * @return array
 */
function wolf_core_bigtext_params() {

	return apply_filters(
		'wolf_core_bigtext_params',
		array(
			'properties' => array(
				'name'        => esc_html__( 'Big Text', '%TEXTDOMAIN%' ),
				'description' =>  esc_html__( 'A big line of text that will take the full width of its container', '%TEXTDOMAIN%' ),
				'vc_base'     => 'wolf_core_bigtext',
				'vc_category' => esc_html__( 'Typography', '%TEXTDOMAIN%' ),
				'el_base'     => 'bigtext',
				'icon' => 'fa fa-text-width',
			),
			'params'     => array(

			),
		)
	);
}
