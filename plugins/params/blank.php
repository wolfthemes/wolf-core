<?php
/**
 * Blank
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
function wolf_core_blank_params() {

	return apply_filters(
		'wolf_core_blank_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Blank', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_blank',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'blank',
				'icon'          => 'fa fa-text-width',
			),
			'params'     => array(),
		)
	);
}
