<?php
/**
 * Clients
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
function wolf_core_clients_params() {

	return apply_filters(
		'wolf_core_clients_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Clients', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_clients',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'clients',
				'icon'          => 'linea-basic linea-basic-folder-multiple',
			),
			'params'     => array(
				array(
					'type'        => 'hidden',
					'label'       => esc_html__( 'Type', 'wolf-core' ),
					'param_name'  => 'type',
					'options'     => array(
						'grid'     => esc_html__( 'Grid', 'wolf-core' ),
						'carousel' => esc_html__( 'Carousel', 'wolf-core' ),
						// 'mosaic'     => esc_html__( 'Mosaic', 'wolf-core' ),
						// 'metro'      => esc_html__( 'Metro', 'wolf-core' ),
						// 'masonry'    => esc_html__( 'Masonry', 'wolf-core' ),
						// 'justified'  => esc_html__( 'Justified', 'wolf-core' ),
					),
					'default'     => 'grid',
					'admin_label' => true,
				),
				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Image Size', 'wolf-core' ),
					'param_name'  => 'img_size',
					'options'     => wolf_core_get_image_sizes(),
					'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
					'condition'   => array(
						'type' => array( 'grid', 'carousel' ),
					),
					'default'     => '600x360',
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Custom Image Size', 'wolf-core' ),
					'param_name'  => 'custom_img_size',
					'description' => esc_html__( 'Enter size in pixels (Example: 200x100 (Width x Height).', 'wolf-core' ),
					'condition'   => array(
						'img_size' => array( 'custom' ),
					),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Columns', 'wolf-core' ),
					'param_name' => 'columns',
					'options'    => array(
						'auto' => esc_html__( 'Auto', 'wolf-core' ),
						2      => esc_html__( 'Two', 'wolf-core' ),
						3      => esc_html__( 'Three', 'wolf-core' ),
						4      => esc_html__( 'Four', 'wolf-core' ),
						5      => esc_html__( 'Five', 'wolf-core' ),
						6      => esc_html__( 'Six', 'wolf-core' ),
						1      => esc_html__( 'One', 'wolf-core' ),
					),
					'default'    => 'auto',
					'condition'  => array(
						'type' => array( 'grid', 'carousel', 'masonry' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Padding', 'wolf-core' ),
					'param_name' => 'padding',
					'options'    => array(
						'yes' => esc_html__( 'Yes', 'wolf-core' ),
						'no'  => esc_html__( 'No', 'wolf-core' ),
					),
					'default'    => 'yes',
				),

				'css_animation_each' => array(
					'type'         => 'hidden',
					'label'        => esc_html__( 'Animate Image One By One', 'wolf-core' ),
					'param_name'   => 'css_animation_each',
					'default'      => 'yes',
					'page_builder' => 'elementor',
				),

				'css_animation'      => array(
					'type'         => 'select',
					'label'        => esc_html__( 'Animation', 'wolf-core' ),
					'param_name'   => 'css_animation',
					'options'      => array(
						'none'            => esc_html__( 'None', 'wolf-core' ),
						'fade'            => esc_html__( 'Fade', 'wolf-core' ),
						'fade-up'         => esc_html__( 'Fade Up', 'wolf-core' ),
						'fade-down'       => esc_html__( 'Fade Down', 'wolf-core' ),
						'fade-left'       => esc_html__( 'Fade Left', 'wolf-core' ),
						'fade-right'      => esc_html__( 'Fade Right', 'wolf-core' ),
						'fade-up-right'   => esc_html__( 'Fade Up Right', 'wolf-core' ),
						'fade-up-left'    => esc_html__( 'Fade Up Left', 'wolf-core' ),
						'fade-down-right' => esc_html__( 'Fade Down Right', 'wolf-core' ),
						'fade-down-left'  => esc_html__( 'Fade Down Left', 'wolf-core' ),

						'uncoverXLeft'    => esc_html__( 'uncoverXLeft', 'wolf-core' ),
						'uncoverXRight'   => esc_html__( 'uncoverXRight', 'wolf-core' ),
						'uncoverYTop'     => esc_html__( 'uncoverYTop', 'wolf-core' ),
						'uncoverYBottom'  => esc_html__( 'uncoverYBottom', 'wolf-core' ),

						'flip-up'         => esc_html__( 'Flip Up', 'wolf-core' ),
						'flip-down'       => esc_html__( 'Flip Down', 'wolf-core' ),
						'flip-left'       => esc_html__( 'Flip Left', 'wolf-core' ),
						'flip-right'      => esc_html__( 'Flip Right', 'wolf-core' ),

						'slide-up'        => esc_html__( 'Slide Up', 'wolf-core' ),
						'slide-down'      => esc_html__( 'Slide Down', 'wolf-core' ),
						'slide-left'      => esc_html__( 'Slide Left', 'wolf-core' ),
						'slide-right'     => esc_html__( 'Slide Right', 'wolf-core' ),

						'zoom-in'         => esc_html__( 'Zoom In', 'wolf-core' ),
						'zoom-in-up'      => esc_html__( 'Zoom In Up', 'wolf-core' ),
						'zoom-in-down'    => esc_html__( 'Zoom In Down', 'wolf-core' ),
						'zoom-in-left'    => esc_html__( 'Zoom In Left', 'wolf-core' ),
						'zoom-in-right'   => esc_html__( 'Zoom In Right', 'wolf-core' ),
						'zoom-out'        => esc_html__( 'Zoom Out', 'wolf-core' ),
						'zoom-out-up'     => esc_html__( 'Zoom Out Up', 'wolf-core' ),
						'zoom-out-down'   => esc_html__( 'Zoom Out Down', 'wolf-core' ),
						'zoom-out-left'   => esc_html__( 'Zoom Out Left', 'wolf-core' ),
						'zoom-out-right'  => esc_html__( 'Zoom Out Right', 'wolf-core' ),
					),
					'default'      => 'none',
					'page_builder' => 'elementor',
				),
				array(
					'type'       => 'repeater',
					'param_name' => 'clients',
					'label'      => esc_html__( 'Clients', 'wolf-core' ),
					'params'     => array(
						array(
							'param_name' => 'title',
							'label'      => esc_html__( 'Title', 'wolf-core' ),
						),
						array(
							'param_name' => 'image',
							'label'      => esc_html__( 'Image', 'wolf-core' ),
							'type'       => 'image',
						),
						array(
							'param_name' => 'image_hover',
							'label'      => esc_html__( 'Image on Hover', 'wolf-core' ),
							'type'       => 'image',
						),
						array(
							'param_name' => 'link',
							'label'      => esc_html__( 'Link', 'wolf-core' ),
							'type'       => 'link',
						),
					),
				),
			),
		)
	);
}
