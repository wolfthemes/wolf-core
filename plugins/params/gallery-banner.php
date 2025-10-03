<?php
/**
 * Gallery
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
function wolf_core_gallery_banner_params() {

	return apply_filters(
		'wolf_core_gallery_banner_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Gallery Banner', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_gallery_banner',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'wolf_core_gallery_banner',
				'keywords'      => array( 'image', 'photo', 'visual', 'gallery' ),
				'icon'          => 'linea-basic linea-basic-picture-multiple',
				// 'register_scripts' => array(
				// 'wolf-core-galleries' => array(
				// 'src'     => WOLF_CORE_JS . '/galleries.js',
				// 'version' => WOLF_CORE_VERSION,
				// ),
				// ),
				// 'scripts'          => array( 'jquery', 'wolf-core' ),
			),
			'params'     => array(

				array(
					'type'        => 'image',
					'label'       => esc_html__( 'Cover Image', 'wolf-core' ),
					'param_name'  => 'cover_image',
					'description' => esc_html__( 'Select image from media library.', 'wolf-core' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Image Size', 'wolf-core' ),
					'param_name'  => 'img_size',
					'options'     => wolf_core_get_image_sizes(),
					'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
					'default'     => '600x360',
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Cover Image Size', 'wolf-core' ),
					'param_name'  => 'custom_img_size',
					'description' => esc_html__( 'Enter size in pixels (Example: 200x100 (Width x Height).', 'wolf-core' ),
					'condition'   => array(
						'img_size' => array( 'custom' ),
					),
				),

				array(
					'type'       => 'images',
					'label'      => esc_html__( 'Images', 'wolf-core' ),
					'param_name' => 'images',
					// 'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Title', 'wolf-core' ),
					'param_name' => 'banner_title',
				),
			),
		)
	);
}
