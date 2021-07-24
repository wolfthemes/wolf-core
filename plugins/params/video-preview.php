<?php
/**
 * Video Preview
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
function wolf_core_video_preview_params() {

	return apply_filters(
		'wolf_core_video_preview_params',
		array(

			'properties' => array(
				'name'          => esc_html__( 'Video Preview', 'wolf-core' ),
				'description'   => esc_html__( 'An embed video with preview', 'wolf-core' ),
				'vc_base'       => 'wolf_core_video_preview',
				'el_base'       => 'video-preview',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'linea-basic linea-basic-video',
			),

			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Video URL', 'wolf-core' ),
					'param_name'  => 'url',
					'placeholder' => 'https://www.youtube.com/watch?v=fKBweD2hyf4',
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Title', 'wolf-core' ),
					'param_name'  => 'title',
					'placeholder' => esc_html__( 'My video title', 'wolf-core' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'image',
					'label'       => esc_html__( 'Cover Image', 'wolf-core' ),
					'param_name'  => 'image',
					'admin_label' => true,
				),

				array(
					'type'        => 'video',
					'label'       => esc_html__( 'Custom Video Preview (optional)', 'wolf-core' ),
					'param_name'  => 'video_preview',
					'description' => esc_html__( 'A short mp4 video file', 'wolf-core' ),
					'admin_label' => true,
				),
			),
		)
	);
}
