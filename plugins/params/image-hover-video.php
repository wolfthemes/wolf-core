<?php
/**
 * Image Hover Videos
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
function wolf_core_image_hover_video_params() {

	return apply_filters(
		'wolf_core_image_hover_video_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Image Hover Video', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_image_hover_video',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'image-hover-video',
				'icon'             => 'linea-basic linea-basic-video',
				'register_scripts' => array(
					'wolf-core-image-hover-video' => array(
						'src'     => WOLF_CORE_JS . '/image-hover-video.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'wolf-core-image-hover-video' ),
			),
			'params'     => array(
				array(
					'type'       => 'image',
					'label'      => esc_html__( 'Image', 'wolf-core' ),
					'param_name' => 'image',
				),
				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Image Size', 'wolf-core' ),
					'param_name'  => 'img_size',
					'options'     => wolf_core_get_image_sizes(),
					'default'     => 'medium',
					'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Custom Image Size', 'wolf-core' ),
					'param_name'  => 'custom_img_size',
					'description' => esc_html__( 'Enter size in pixels (Example: 200x100 (Width x Height).', 'wolf-core' ),
					'condition'   => array( 'img_size' => 'custom' ),
				),
				array(
					'type'       => 'video',
					'label'      => esc_html__( 'Video', 'wolf-core' ),
					'param_name' => 'video',
				),
				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Link', 'wolf-core' ),
					'param_name' => 'link',
				),
			),
		)
	);
}
