<?php
/**
 * Marquee Text
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
function wolf_core_marquee_text_params() {

	return apply_filters(
		'wolf_core_marquee_text_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Marquee Text', 'wolf-core' ),
				// 'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_marquee_text',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'marquee_text',
				'icon'          => 'linea-software linea-software-font-tracking',
			),
			'params'     => array(
				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Text', 'wolf-core' ),
					'param_name' => 'text',
					'default'    => esc_html__( 'This is my marquee text', 'wolf-core' ),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Direction', 'wolf-core' ),
					'param_name' => 'direction',
					'options'    => array(
						'right' => esc_html__( 'To the right', 'wolf-core' ),
						'left'  => esc_html__( 'To the left', 'wolf-core' ),
					),
				),

				array(
					'type'         => 'typography',
					'label'        => esc_html__( 'Typography', 'wolf-core' ),
					'param_name'   => 'typography',
					'selector'     => '{{WRAPPER}} .wolf-core-marquee-text',
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-marquee__inner' => 'color: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Hover Color', 'wolf-core' ),
					'param_name'   => 'color_hover',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-marquee-container:hover .wolf-core-marquee-text' => 'color: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Background Color', 'wolf-core' ),
					'param_name'   => 'bg_color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .elementor-widget-container' => 'background-color: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Animation Duration (in seconds)', 'wolf-core' ),
					'default'    => 10,
					'param_name' => 'marquee_speed',
					'range'      => array(
						's' => array(
							'min' => 1,
							'max' => 50,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-marquee__inner' => 'animation-duration: {{SIZE}}s;',
					),
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Link', 'wolf-core' ),
					'param_name' => 'link',
				),
			),
		)
	);
}
