<?php
/**
 * Big Text
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
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
				'name'        => esc_html__( 'Big Text', 'wolf-core' ),
				'description' =>  esc_html__( 'A big line of text that will take the full width of its container', 'wolf-core' ),
				'vc_base'     => 'wolf_core_bigtext',
				'vc_category' => esc_html__( 'Typography', 'wolf-core' ),
				'el_base'     => 'bigtext',
				'icon' => 'fa fa-text-width',
			),
			'params'     => array(

			),
		)
	);
}
