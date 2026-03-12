<?php
/**
 * Lightbox Video Play Button
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
function wolf_core_video_opener_params() {

	return apply_filters(
		'wolf_core_video_opener_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Video Opener', 'wolf-core' ),
				'description'      => esc_html__( 'A stylish presentation for your release', 'wolf-core' ),
				'vc_base'          => 'wolf_core_video_opener',
				'el_base'          => 'video-opener',
				'vc_category'      => esc_html__( 'Music', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'icon'             => 'linea-music linea-music-play-button',
				'register_scripts' => array(
					'wolf-core-video-opener' => array(
						'src'     => WOLF_CORE_JS . '/video-opener.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'wolf-core-video-opener' ),
			),

			'params'     => array(
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Custom Play Button', 'wolf-core' ),
					'param_name' => 'custom_play_button',
					'options'    => array(
						''    => esc_html__( 'No', 'wolf-core' ),
						'yes' => esc_html__( 'Yes', 'wolf-core' ),
					),
				),

				array(
					'type'       => 'image',
					'label'      => esc_html__( 'Button Image', 'wolf-core' ),
					'param_name' => 'button_image',
					'condition'  => array(
						'custom_play_button' => array( 'yes' ),
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
						'{{WRAPPER}}' => 'margin-{{VALUE}}:0;',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'options'      => array(
						'center' => esc_html__( 'center', 'wolf-core' ),
						'left'   => esc_html__( 'left', 'wolf-core' ),
						'right'  => esc_html__( 'right', 'wolf-core' ),
					),
					'page_builder' => 'vc',
				),

				array(
					'type'         => 'wolf_core_video_url',
					'label'        => esc_html__( 'Video URL', 'wolf-core' ),
					'param_name'   => 'video_url',
					'placeholder'  => 'https://vimeo.com/124894010',
					'description'  => sprintf(
						esc_html__( 'Support %1$s and %2$s', 'wolf-core' ),
						'YouTube',
						'Vimeo'
					),
					'admin_label'  => true,
					'page_builder' => 'vc',
				),

				array(
					'type'         => 'url',
					'label'        => esc_html__( 'Video URL', 'wolf-core' ),
					'param_name'   => 'video_url',
					'description'  => esc_html__( 'A YouTube, Vimeo, or mp4 URL.', 'wolf-core' ),
					'admin_label'  => true,
					'page_builder' => 'elementor',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Caption Position', 'wolf-core' ),
					'param_name' => 'caption_position',
					'options'    => array(
						'none'   => esc_html__( 'None', 'wolf-core' ),
						'bottom' => esc_html__( 'Bottom', 'wolf-core' ),
						'right'  => esc_html__( 'Right', 'wolf-core' ),
						'left'   => esc_html__( 'Left', 'wolf-core' ),
						'top'    => esc_html__( 'Top', 'wolf-core' ),
					),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Caption', 'wolf-core' ),
					'param_name'  => 'caption',
					'placeholder' => esc_html__( 'My Video Title', 'wolf-core' ),
					// 'condition'  => array(
					// 'caption_position' => array( '' ),
					// ),
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Duration', 'wolf-core' ),
					'param_name' => 'duration',
					// 'condition' => array(
					// 'caption_position' => array( 'none' ),
					// ),
				),
			),
		)
	);
}
