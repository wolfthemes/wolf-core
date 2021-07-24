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
			),

			'params'     => array(),
		)
	);
}
