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
function wolf_core_gallery_params() {

	return apply_filters(
		'wolf_core_gallery_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Gallery', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_gallery',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'wolf_core_gallery',
				'keywords'         => array( 'image', 'photo', 'visual', 'gallery' ),
				'icon'             => 'linea-basic linea-basic-picture-multiple',
				'register_scripts' => array(
					'wolf-core-galleries' => array(
						'src'     => WOLF_CORE_JS . '/galleries.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'jquery', 'aos', 'flickity', 'imagesloaded', 'isotope', 'packery-mode', 'flex-images', 'wolf-core', 'wolf-core-galleries' ),
			),
			'params'     => array(
				array(
					'type'        => 'images',
					'label'       => esc_html__( 'Images', 'wolf-core' ),
					'param_name'  => 'images',
					'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
				),
				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Gallery Type', 'wolf-core' ),
					'param_name'  => 'type',
					'options'     => array(
						'image_grid' => esc_html__( 'Grid', 'wolf-core' ),
						// 'carousel'   => esc_html__( 'Carousel', 'wolf-core' ),
						'mosaic'     => esc_html__( 'Mosaic', 'wolf-core' ),
						// 'metro'      => esc_html__( 'Metro', 'wolf-core' ),
						'masonry'    => esc_html__( 'Masonry', 'wolf-core' ),
						'justified'  => esc_html__( 'Justified', 'wolf-core' ),
					),
					'default'     => 'image_grid',
					'admin_label' => true,
				),

				array(
					'param_name'  => 'metro_pattern',
					'label'       => esc_html__( 'Metro Pattern', 'wolf-core' ),
					'type'        => 'select',
					'options'     => wolf_core_get_metro_patterns(),
					'default'     => 'auto',
					'condition'   => array(
						'type' => array( 'metro' ),
					),
					'default'     => 'auto',
					'admin_label' => true,
				),

				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Metro Full Height', 'wolf-core' ),
					'param_name'  => 'metro_fullheight',
					'condition'   => array(
						'type' => array( 'metro' ),
					),
					'description' => esc_html__( ' (beta: for pattern 5 only)', 'wolf-core' ),
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Metro Background Size', 'wolf-core' ),
					'options'     => array(
						'cover'   => esc_html__( 'Cover', 'wolf-core' ),
						'contain' => esc_html__( 'Contain', 'wolf-core' ),
					),
					'param_name'  => 'metro_bg_size',
					'condition'   => array(
						'type' => array( 'metro' ),
					),
					'default'     => 'cover',
					'description' => esc_html__( ' (beta: for pattern 5 only)', 'wolf-core' ),
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Image Size', 'wolf-core' ),
					'param_name'  => 'img_size',
					'options'     => wolf_core_get_image_sizes(),
					'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
					'condition'   => array(
						'type' => array( 'image_grid', 'carousel' ),
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
					'param_name' => 'slides_per_view',
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
						'type' => array( 'image_grid', 'carousel', 'masonry' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Padding', 'wolf-core' ),
					'param_name' => 'img_padding',
					'options'    => array(
						'yes' => esc_html__( 'Yes', 'wolf-core' ),
						'no'  => esc_html__( 'No', 'wolf-core' ),
					),
					'default'    => 'yes',
				),

				'hover_effect'  => array(
					'type'       => 'select',
					'label'      => esc_html__( 'Hover Effect', 'wolf-core' ),
					'param_name' => 'hover_effect',
					'options'    => wolf_core_get_hover_effects(),
					'default'    => 'default',
				),

				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Add caption below image?', 'wolf-core' ),
					'param_name'  => 'add_caption',
					'description' => esc_html__( 'The image title and caption will be used.', 'wolf-core' ),
					'condition'   => array(
						'type' => array( 'image_grid', 'carousel', 'masonry' ),
					),
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'On click action', 'wolf-core' ),
					'param_name'  => 'onclick',
					'options'     => array(
						'lightbox'        => sprintf( esc_html__( 'Open in %s', 'wolf-core' ), 'Lightbox' ),
						'none'            => esc_html__( 'None', 'wolf-core' ),
						'attachment_page' => esc_html__( 'Link to attachment page', 'wolf-core' ),
						'img_link_large'  => esc_html__( 'Link to large image', 'wolf-core' ),
						'custom_link'     => esc_html__( 'Open custom link', 'wolf-core' ),
					),
					'description' => esc_html__( 'Select action for click action.', 'wolf-core' ),
					'default'     => 'lightbox',
				),

				array(
					'type'        => 'exploded_textarea_safe',
					'label'       => esc_html__( 'Custom links', 'wolf-core' ),
					'param_name'  => 'custom_links',
					'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'wolf-core' ),
					'condition'   => array(
						'onclick' => array( 'custom_link' ),
					),
				),

				/*
				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Custom link target', 'wolf-core' ),
					'param_name'  => 'custom_links_target',
					'description' => esc_html__( 'Select where to open custom links.', 'wolf-core' ),
					'condition'   => array(
						'onclick' => array(
							'custom_link',
							'img_link_large',
						),
					),
					'default'     => ( function_exists( 'wolf_core_target_param_list' ) ) ? wolf_core_target_param_list() : '',
				),*/

				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Animate Image One By One', 'wolf-core' ),
					'param_name'   => 'css_animation_each',
					'group'        => esc_html__( 'Animation', 'wolf-core' ),
					'weight'       => -5,
					'page_builder' => 'vc',
				),

				array(
					'type'         => 'hidden',
					'label'        => esc_html__( 'Animate Image One By One', 'wolf-core' ),
					'param_name'   => 'css_animation_each',
					'default'      => 'yes',
					'page_builder' => 'elementor',
				),

				'css_animation' => array(
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
					'type'       => 'select',
					'label'      => esc_html__( 'Autoplay', 'wolf-core' ),
					'param_name' => 'autoplay',
					'options'    => array(
						'true'  => esc_html__( 'Yes', 'wolf-core' ),
						'false' => esc_html__( 'No', 'wolf-core' ),
					),
					'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
					'condition'  => array(
						'type' => array( 'carousel' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Pause on Hover (if autoplay)', 'wolf-core' ),
					'param_name' => 'pause_on_hover',
					'options'    => array(
						'true'  => esc_html__( 'Yes', 'wolf-core' ),
						'false' => esc_html__( 'No', 'wolf-core' ),
					),
					'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
					'condition'  => array(
						'type' => array( 'carousel' ),
					),
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Slideshow Speed in ms', 'wolf-core' ),
					'param_name' => 'slideshow_speed',
					'value'      => 6000,
					'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
					'condition'  => array(
						'type' => array( 'carousel' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Show Navigation Bullets', 'wolf-core' ),
					'param_name' => 'nav_bullets',
					'options'    => array(
						'true'  => esc_html__( 'Yes', 'wolf-core' ),
						'false' => esc_html__( 'No', 'wolf-core' ),
					),
					'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
					'condition'  => array(
						'type' => array( 'carousel' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Show Navigation Arrows', 'wolf-core' ),
					'param_name' => 'nav_arrows',
					'options'    => array(
						'true'  => esc_html__( 'Yes', 'wolf-core' ),
						'false' => esc_html__( 'No', 'wolf-core' ),
					),
					'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
					'condition'  => array(
						'type' => array( 'carousel' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Group Cells', 'wolf-core' ),
					'param_name' => 'group_cells',
					'options'    => array(
						'true'  => esc_html__( 'Yes', 'wolf-core' ),
						'false' => esc_html__( 'No', 'wolf-core' ),
					),
					'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
					'condition'  => array(
						'type' => array( 'carousel' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Navigation Arrows Tone', 'wolf-core' ),
					'param_name' => 'nav_arrows_tone',
					'options'    => array(
						'light' => esc_html__( 'Light', 'wolf-core' ),
						'dark'  => esc_html__( 'Dark', 'wolf-core' ),
					),
					'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
					'condition'  => array(
						'type' => array( 'carousel' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Navigation Dots Tone', 'wolf-core' ),
					'param_name' => 'nav_dots_tone',
					'options'    => array(
						'light' => esc_html__( 'Light', 'wolf-core' ),
						'dark'  => esc_html__( 'Dark', 'wolf-core' ),
					),
					'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
					'condition'  => array(
						'type' => array( 'carousel' ),
					),
				),
			),
		)
	);
}
