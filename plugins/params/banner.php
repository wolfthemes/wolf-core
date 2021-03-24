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
				'description'   => esc_html__( 'A Big Linked Image with Text Overlay', 'wolf-visual-composer' ),
				'vc_base'       => 'wolf_core_banner',
				'el_base'       => 'banner',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'fa fa-bookmark-o',
			),

			'params'     => array(
				array(
					'type'        => 'image',
					'condition'   => esc_html__( 'Image', 'wolf-visual-composer' ),
					'param_name'  => 'image',
					'value'       => '',
					'description' => esc_html__( 'Select image from media library.', 'wolf-visual-composer' ),
					'admin_label' => true,
				),

				// Image size.
				array(
					'type'        => 'select',
					'condition'   => esc_html__( 'Banner Size', 'wolf-visual-composer' ),
					'param_name'  => 'img_size',
					'options'     => wolf_core_get_image_sizes(),
					'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-visual-composer' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'condition'   => esc_html__( 'Custom Banner Size', 'wolf-visual-composer' ),
					'param_name'  => 'custom_img_size',
					'description' => esc_html__( 'Enter size in pixels (Example: 200x100 (Width x Height).', 'wolf-visual-composer' ),
					'condition'   => array( 'img_size' => 'custom' ),
				),
			),
		)
	);
}
