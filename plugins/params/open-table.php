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
 * Element Parameters
 *
 * @return array
 */
function wolf_core_open_table_params() {

	return apply_filters(
		'wolf_core_open_table_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Open Table', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_open_table',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'open-table',
				'icon'          => 'fa fa-text-width',
			),
			'params'     => array(
			),
		)
	);
}
