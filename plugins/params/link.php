<?php
/**
 * Link
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
function wolf_core_link_params() {

	return apply_filters(
		'wolf_core_link_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Link', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_link',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'link',
				'icon'          => 'fas fa-link',
			),
			'params'     => array(
				array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Text', 'wolf-core' ),
					'param_name'  => 'text',
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Tagline', 'wolf-core' ),
					'param_name'  => 'tagline',
				),
				array(
					'type'        => 'link',
					'label'       => esc_html__( 'URL', 'wolf-core' ),
					'param_name'  => 'link',
				),
			),
		)
	);
}
