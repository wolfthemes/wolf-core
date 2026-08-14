<?php
/**
 * Animated SVG
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
function wolf_core_animated_svg_params() {

	return apply_filters(
		'wolf_core_animated_svg_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Animated SVG', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_animated_svg',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'animated-svg',
				'icon'             => 'eicon-headphones',
				'register_scripts' => array(
					'wolf-core-animated-svg' => array(
						'src'     => WOLF_CORE_JS . '/animated-svg.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'wolf-core-functions', 'wolf-core-animated-svg' ),
			),
			'params'     => array(

				array(
					'type'       => 'hidden',
					'label'      => esc_html__( 'Type', 'wolf-core' ),
					'param_name' => 'type',
					'options'    => array(
						'simple'   => esc_html__( 'Simple', 'wolf-core' ),
						'multiple' => esc_html__( 'Muliple Paths', 'wolf-core' ),
					),
					'default'    => 'simple',
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
						'{{WRAPPER}} .wolf-core-animated-text' => 'justify-content:{{VALUE}};',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'       => 'repeater',
					'param_name' => 'paths',
					'label'      => esc_html__( 'Paths', 'wolf-core' ),
					'params'     => array(
						array(
							'param_name' => 'title',
							'label'      => esc_html__( 'Name', 'wolf-core' ),
						),
						array(
							'param_name' => 'inline_code',
							'label'      => esc_html__( 'Single Path Inline Code', 'wolf-core' ),
							'type'       => 'textarea',
						),

						array(
							'type'       => 'colorpicker',
							'label'      => esc_html__( 'Stroke Color', 'wolf-core' ),
							'param_name' => 'path_color',
						),

						array(
							'label'      => esc_html__( 'Animation Duration (in seconds)', 'wolf-core' ),
							'param_name' => 'anim_duration',
						),

						array(
							'label'      => esc_html__( 'Animation Delay (in seconds)', 'wolf-core' ),
							'param_name' => 'anim_delay',
						),
					),
					'condition'  => array(
						'type' => array( 'multiple' ),
					),
				),

				array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'SVG Inline Code', 'wolf-core' ),
					'param_name'  => 'inline_code',
					'condition'   => array(
						'type' => array( 'simple' ),
					),
					'description' => sprintf( wolf_core_kses( __( '<a href="%s" target="_blank">How to get an SVG code.</a>', 'wolf-core' ) ), 'https://wolfthemes.ticksy.com/article/17288/' ),
				),

				array(
					'type'       => 'colorpicker',
					'label'      => esc_html__( 'Stroke Color', 'wolf-core' ),
					'param_name' => 'path_color',
				),

				array(
					'label'      => esc_html__( 'Animate Once', 'wolf-core' ),
					'param_name' => 'anim_once',
					'type'       => 'checkbox',
				),

				array(
					'label'      => esc_html__( 'Animation Duration (in seconds)', 'wolf-core' ),
					'param_name' => 'anim_duration',
				),

				array(
					'label'      => esc_html__( 'Animation Delay (in seconds)', 'wolf-core' ),
					'param_name' => 'anim_delay',
				),

				array(
					'label'      => esc_html__( 'Stroke Width', 'wolf-core' ),
					'param_name' => 'stroke_width',
				),

				array(
					'label'              => esc_html__( 'SVG Width (in px)', 'wolf-core' ),
					'param_name'         => 'width',
					'responsive_control' => true,
					// 'type' => 'slider',
					'selectors'          => array(
						'{{WRAPPER}} .wolf-core-animated-svg > svg' => 'width:{{SIZE}}px!important;',
					),
				),
			),
		)
	);
}
