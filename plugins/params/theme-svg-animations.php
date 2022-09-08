<?php
/**
 * Theme Animated SVG
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
function wolf_core_theme_svg_animations_params() {

	return apply_filters(
		'wolf_core_theme_svg_animations_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Theme SVG Animations', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_theme_svg_animations',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'theme-svg-animations',
				'icon'             => 'linea-software linea-software-transform-bezier',
			),
			'params'     => array(

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Type', 'wolf-core' ),
					'param_name' => 'svg_animation_option',
					'options'    => apply_filters( 'wolf_core_theme_svg_animation_options', array() ),
				),

				array(
					'type'       => 'colorpicker',
					'label'      => esc_html__( 'Stroke Color', 'wolf-core' ),
					'param_name' => 'path_color',
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Animation Duration (in s)', 'wolf-core' ),
					'param_name' => 'anim_duration',
					'range'      => array(
						's' => array(
							'step' => 0.1,
							'min' => 0.1,
							'max' => 10000,
						),
					),
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Animation Delay (in s)', 'wolf-core' ),
					'param_name' => 'anim_delay',
					'range'      => array(
						's' => array(
							'step' => 0.1,
							'min' => 0.1,
							'max' => 10,
						),
					),
				),

				array(
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'type'         => 'choose',
					'options'      => array(
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
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-theme-svg-animation' => 'justify-content:{{VALUE}};',
					),
					'page_builder' => 'elementor',
				),
			),
		)
	);
}
