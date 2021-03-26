<?php
/**
 * Banner
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
function wolf_core_banner_params() {

	return apply_filters(
		'wolf_core_banner_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Banner', 'wolf-core' ),
				'description'   => esc_html__( 'A Big Linked Image with Text Overlay', 'wolf-core' ),
				'vc_base'       => 'wolf_core_banner',
				'el_base'       => 'banner',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'fa fa-bookmark-o',
			),

			'params'     => array(
				array(
					'type'        => 'image',
					'label'       => esc_html__( 'Image', 'wolf-core' ),
					'param_name'  => 'image',
					'description' => esc_html__( 'Select image from media library.', 'wolf-core' ),
					'admin_label' => true,
				),

				// Image size.
				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Banner Size', 'wolf-core' ),
					'param_name'  => 'img_size',
					'options'     => wolf_core_get_image_sizes(),
					'default'     => 'landscape',
					'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Custom Banner Size', 'wolf-core' ),
					'param_name'  => 'custom_img_size',
					'description' => esc_html__( 'Enter size in pixels (Example: 200x100 (Width x Height).', 'wolf-core' ),
					'condition'   => array( 'img_size' => 'custom' ),
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
