<?php
/**
 * Rotating Text
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
function wolf_core_rotating_text_params() {

	return apply_filters(
		'wolf_core_rotating_text_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Rotating Text', 'wolf-core' ),
				//'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_rotating_text',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'rotating_text',
				'icon'          => 'linea-arrows linea-arrows-clockwise',
			),
			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Text', 'wolf-core' ),
					'param_name'  => 'text',
				),
				/*array(
					'type'        => 'text',
					'label'       => esc_html__( 'Width', 'wolf-core' ),
					'param_name'  => 'width',
				),
				array(
					'type'        => 'link',
					'label'       => esc_html__( 'URL', 'wolf-core' ),
					'param_name'  => 'link',
				),*/

				/* Typography Group controls for Elementor */
				array(
					'type'         => 'typography',
					'label'        => esc_html__( 'Typography', 'wolf-core' ),
					'param_name'   => 'typography',
					'selector'     => '{{WRAPPER}} .wolf-core-rotating-text',
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-rotating-text svg text' => 'fill: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),
			),
		)
	);
}
