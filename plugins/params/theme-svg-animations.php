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
				'name'          => esc_html__( 'Theme SVG Animations', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_theme_svg_animations',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'theme-svg-animations',
				'icon'          => 'linea-software linea-software-transform-bezier',
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
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-theme-svg-animation .overable-svg-anim-svg path' => 'stroke:{{VALUE}};',
					),
				),

				array(
					'label'      => esc_html__( 'Animate Once', 'wolf-core' ),
					'param_name' => 'anim_once',
					'type'       => 'checkbox',
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Animation Duration (in ms)', 'wolf-core' ),
					'param_name' => 'anim_duration',
					'default'    => 800,
					'range'      => array(
						'px' => array(
							'step' => 100,
							'min'  => 100,
							'max'  => 10000,
						),
					),
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Animation Delay (in ms)', 'wolf-core' ),
					'param_name' => 'anim_delay',
					'default'    => 200,
					'range'      => array(
						'px' => array(
							'step' => 100,
							'min'  => 100,
							'max'  => 10000,
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

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Stroke Width', 'wolf-core' ),
					'param_name' => 'stroke_width',
					'default'    => 5,
					'range'      => array(
						'px' => array(
							'step' => 1,
							'min'  => 1,
							'max'  => 50,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .overable-svg-anim-svg path' => 'stroke-width:{{SIZE}}{{UNIT}};',
					),
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'SVG Width (in px)', 'wolf-core' ),
					'param_name' => 'width',
					'size_units' => array( 'px', '%' ),
					'range'      => array(
						'px' => array(
							'min'  => 0,
							'max'  => 1000,
							'step' => 5,
						),
						'%'  => array(
							'min' => 0,
							'max' => 100,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-theme-svg-animation-inner' => 'width:{{SIZE}}{{UNIT}};',
					),
				),
			),
		)
	);
}
