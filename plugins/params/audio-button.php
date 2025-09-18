<?php
/**
 * Audio Button
 *
 * @author WolfThemes
 * @package WolfCore/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Element Parameters
 *
 * @return array
 */
function wolf_core_audio_button_params() {

	return apply_filters(
		'wolf_core_audio_button_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Audio Button', 'wolf-core' ),
				'description'      => esc_html__( 'A stylish presentation for your release', 'wolf-core' ),
				'vc_base'          => 'wolf_core_audio_button',
				'el_base'          => 'audio-button',
				'vc_category'      => esc_html__( 'Music', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'icon'             => 'dashicons-before dashicons-album',
				'register_scripts' => array(
					'wolf-core-audio-button' => array(
						'src'     => WOLF_CORE_JS . '/audio-button.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'wolf-core-audio-button' ),
			),

			'params'     => array(
				'file' => array(
					'type'        => 'audio',
					'label'       => esc_html__( 'Audio File', 'wolf-core' ),
					'param_name'  => 'file',
					'description' => esc_html__( 'Select audio file from media library.', 'wolf-core' ),
					'admin_label' => true,
				),
				array(
					'label'      => esc_html__( 'Button Type', 'wolf-core' ),
					'param_name' => 'btn_type',
					'type'       => 'select',
					'options'    => array(
						'icon'      => esc_html__( 'Icon', 'wolf-core' ),
						'equalizer' => esc_html__( 'Equalizer', 'wolf-core' ),
					),
				),
				array(
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'type'         => 'choose',
					'options'      => array(
						'left'   => array(
							'title' => esc_html__( 'Left', 'wolf-core' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center' => array(
							'title' => esc_html__( 'Center', 'wolf-core' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'  => array(
							'title' => esc_html__( 'Right', 'wolf-core' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-audio-button-icon' => 'margin-{{VALUE}}:0;',
					),
					'page_builder' => 'elementor',
				),
				/*
				array( */
				/*
					'label'      => esc_html__( 'Autoplay', 'wolf-core' ), */
				/*
					'description'      => esc_html__( 'May not work on all devices', 'wolf-core' ), */
				/*
					'type' => 'checkbox', */
				/*
					'param_name' => 'autoplay', */
				/* ), */
				array(
					'param_name' => 'background',
					'type'       => 'background',
					'label'      => esc_html__( 'Background', 'wolf-core' ),
					'selector'   => '{{WRAPPER}} .wolf-core-audio-button-icon',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
					'condition'  => array(
						'btn_type' => 'icon',
					),
				),
				array(
					'param_name' => 'icon_color',
					'type'       => 'colorpicker',
					'label'      => esc_html__( 'Icon Color', 'wolf-core' ),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-audio-button-icon' => 'color:{{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
					'condition'  => array(
						'btn_type' => 'icon',
					),
				),
				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Shape', 'wolf-core' ),
					'param_name'   => 'shape',
					'options'      => array(
						'square' => esc_html__( 'Square', 'wolf-core' ),
						'round'  => esc_html__( 'Round', 'wolf-core' ),
					),
					'prefix_class' => 'wolf-core-audio-button-shape-',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
					'condition'    => array(
						'btn_type' => 'icon',
					),
				),
			),
		)
	);
}
