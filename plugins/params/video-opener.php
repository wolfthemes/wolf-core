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
 *  Element Parameters
 *
 * @return array
 */
function wolf_core_video_opener_params() {

	return apply_filters(
		'wolf_core_video_opener_params',
		array(
			'properties' => array(
				'name'        => esc_html__( 'Lightbox Video Play Button', '%TEXTDOMAIN%' ),
				'description' => esc_html__( 'A stylish presentation for your release', '%TEXTDOMAIN%' ),
				'vc_base'     => 'wolf_core_video_opener',
				'el_base'     => 'video-opener',
				'vc_category' => esc_html__( 'Music', '%TEXTDOMAIN%' ),
				'icon'        => 'dashicons-before dashicons-video',
			),

			'params'     => array(
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Custom Play Button', '%TEXTDOMAIN%' ),
					'param_name' => 'custom_play_button',
					'options'      => array(
						''    => esc_html__( 'No', '%TEXTDOMAIN%' ),
						'yes' => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
					),
				),

				array(
					'type'       => 'image',
					'label'      => esc_html__( 'Button Image', '%TEXTDOMAIN%' ),
					'param_name' => 'button_image',
					'condition'  => array(
						'custom_play_button' => array( 'yes' ),
					),
				),

				array(
					'label'     => esc_html__( 'Alignment', '%TEXTDOMAIN%' ),
					'param_name' => 'alignment',
					'type'      => 'choose',
					'options'   => array(
						'left'    => array(
							'title' => esc_html__( 'Left', '%TEXTDOMAIN%' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center'  => array(
							'title' => esc_html__( 'Center', '%TEXTDOMAIN%' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'   => array(
							'title' => esc_html__( 'Right', '%TEXTDOMAIN%' ),
							'icon'  => 'eicon-text-align-right',
						),
						'justify' => array(
							'title' => esc_html__( 'Justified', '%TEXTDOMAIN%' ),
							'icon'  => 'eicon-text-align-justify',
						),
					),
					'selectors' => array(
						'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					),
				),

				// array(
				// 'type'       => 'select',
				// 'label'      => esc_html__( 'Alignment', '%TEXTDOMAIN%' ),
				// 'param_name' => 'alignment',
				// 'value'      => array(
				// ''esc_html__( 'center', '%TEXTDOMAIN%' ) => 'center',
				// ''esc_html__( 'left', '%TEXTDOMAIN%' ) => 'left',
				// ''esc_html__( 'right', '%TEXTDOMAIN%' ) => 'right',
				// ),
				// ),

				// array(
				// 'type' => 'text',
				// 'label' => esc_html__( 'Video URL', '%TEXTDOMAIN%' ),
				// 'param_name' => 'video_url',
				// 'placeholder' => 'https://vimeo.com/124894010',
				// 'description' => sprintf(
				// esc_html__( 'Support %1$s and %2$s', '%TEXTDOMAIN%' ),
				// 'YouTube',
				// 'Vimeo'
				// ),
				// 'admin_label' => true,
				// ),

				array(
					'type'        => 'url',
					'label'       => esc_html__( 'Video URL', '%TEXTDOMAIN%' ),
					'param_name'  => 'video_url',
					'description' => esc_html__( 'A YouTube, Vimeo, or mp4 URL.', '%TEXTDOMAIN%' ),
					'admin_label' => true,
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Caption Position', '%TEXTDOMAIN%' ),
					'param_name' => 'caption_position',
					'options'      => array(
						'none'   => esc_html__( 'None', '%TEXTDOMAIN%' ),
						'bottom' => esc_html__( 'Bottom', '%TEXTDOMAIN%' ),
						'right'  => esc_html__( 'Right', '%TEXTDOMAIN%' ),
						'left'   => esc_html__( 'Left', '%TEXTDOMAIN%' ),
						'top'    => esc_html__( 'Top', '%TEXTDOMAIN%' ),
					),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Caption', '%TEXTDOMAIN%' ),
					'param_name'  => 'caption',
					'placeholder' => esc_html__( 'Watch "My Video Title"', '%TEXTDOMAIN%' ),
					// 'condition'  => array(
					// 'caption_position' => array( '' ),
					// ),
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Duration', '%TEXTDOMAIN%' ),
					'param_name' => 'duration',
					// 'condition' => array(
					// 'caption_position' => array( 'none' ),
					// ),
				),
			),
		)
	);
}
