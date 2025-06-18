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
				'name'          => esc_html__( 'Audio Button', 'wolf-core' ),
				'description'   => esc_html__( 'A stylish presentation for your release', 'wolf-core' ),
				'vc_base'       => 'wolf_core_audio_button',
				'el_base'       => 'audio-button',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'dashicons-before dashicons-album',
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
					'type' => 'audio',
					'label' => esc_html__( 'Audio File', 'wolf-core' ),
					'param_name'  => 'file',
					'description' => esc_html__( 'Select audio file from media library.', 'wolf-core' ),
					'admin_label' => true,
				)
			),
		)
	);
}
