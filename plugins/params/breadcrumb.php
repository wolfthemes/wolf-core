<?php
/**
 * Breadcrumb
 *
 * @author WolfThemes
 * @package WolfCore/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 *  Element Parameters
 *
 * @return array
 */
function wolf_core_breadcrumb_params() {

	return apply_filters(
		'wolf_core_breadcrumb_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Breadcrumb', 'wolf-core' ),
				'description'   => esc_html__( 'A stylish presentation for your release', 'wolf-core' ),
				'vc_base'       => 'wolf_core_breadcrumb',
				'el_base'       => 'breadcrumb',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'dashicons-before dashicons-album',
			),

			'params'     => array(


			),
		)
	);
}
