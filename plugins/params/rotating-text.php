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
				'name'             => esc_html__( 'Rotating Text', 'wolf-core' ),
				// 'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_rotating_text',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'rotating_text',
				'icon'             => 'linea-arrows linea-arrows-clockwise',
				'register_scripts' => array(
					'wolf-core-rotating-text' => array(
						'src'     => WOLF_CORE_JS . '/rotating-text.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'wolf-core-rotating-text' ),
			),
			'params'     => array(
				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Text', 'wolf-core' ),
					'param_name' => 'text',
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Width (in px)', 'wolf-core' ),
					'default'    => 200,
					'step'       => 1,
					'param_name' => 'svg_width',
					'range'      => array(
						'px' => array(
							'min' => 100,
							'max' => 500,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-rotating-text .wolf-core-rotating-text-link' => 'width: {{SIZE}}px;height: {{SIZE}}px;',
					),
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'URL', 'wolf-core' ),
					'param_name' => 'link',
				),

				array(
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Scroll link (smooth scroll to anchor)', 'wolf-core' ),
					'param_name' => 'scroll_link',
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Animation Duration (in seconds)', 'wolf-core' ),
					'default'    => 15,
					'param_name' => 'rotating_speed',
					'range'      => array(
						's' => array(
							'min' => 1,
							'max' => 50,
						),
					),
				),

				array(
					'type'       => 'icon',
					'label'      => esc_html__( 'Icon', 'wolf-core' ),
					'param_name' => 'selected_icon',
				),

				array(
					'label'              => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'         => 'align',
					'type'               => 'choose',
					'options'            => array(
						'flex-start' => array(
							'title' => esc_html__( 'Left', 'wolf-core' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center'     => array(
							'title' => esc_html__( 'Center', 'wolf-core' ),
							'icon'  => 'eicon-text-align-center',
						),
						'flex-end'   => array(
							'title' => esc_html__( 'Right', 'wolf-core' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'selectors'          => array(
						'{{WRAPPER}} .wolf-core-rotating-text' => 'justify-content:{{VALUE}};',
					),
					'responsive_control' => true,
					'page_builder'       => 'elementor',
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Icon Size', 'wolf-core' ),
					'param_name' => 'icon_size',
					'range'      => array(
						'px' => array(
							'min' => 10,
							'max' => 300,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-rotating-text i' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .wolf-core-rotating-text svg:not(.wolf-core-rotating-text-svg)' => 'width: {{SIZE}}{{UNIT}};',
					),
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Icon Horizontal Adjustment', 'wolf-core' ),
					'param_name' => 'icon_horizontal_adjust',
					'range'      => array(
						'px' => array(
							'min' => -100,
							'max' => 100,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-rotating-text i:before' => 'margin-left: {{SIZE}}{{UNIT}};',
					),
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Icon Vertical Adjustment', 'wolf-core' ),
					'param_name' => 'icon_vertical_adjust',
					'range'      => array(
						'px' => array(
							'min' => -100,
							'max' => 100,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-rotating-text i:before' => 'margin-top: {{SIZE}}{{UNIT}};',
					),
				),

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
						'{{WRAPPER}} .wolf-core-rotating-text .wolf-core-rotating-text-svg text' => 'fill: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Icon Color', 'wolf-core' ),
					'param_name'   => 'icon_color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-rotating-text i' => 'color: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),
			),
		)
	);
}
