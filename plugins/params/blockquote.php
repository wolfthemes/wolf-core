<?php
/**
 * Blockquote
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
function wolf_core_blockquote_params() {

	return apply_filters(
		'wolf_core_blockquote_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Blank', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_blockquote',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'blockquote',
				'icon'          => 'fa fa-quote',
			),
			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Text', 'wolf-core' ),
					'param_name'  => 'text',
				),
			),
		)
	);
}
