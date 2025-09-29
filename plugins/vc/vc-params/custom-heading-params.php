<?php
/**
 * WPBakery Page Builder Extension custom heading params
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get heading params
 *
 * @return array
 */
function wolf_core_custom_heading_params() {
	return apply_filters(
		'wolf_core_custom_heading_params',
		array(
			'name'        => esc_html__( 'Heading', 'wolf-core' ),
			'description' => esc_html__( 'A big title with flexible font size', 'wolf-core' ),
			'base'        => 'vc_custom_heading',
			'category'    => esc_html__( 'Typography', 'wolf-core' ),
			'icon'        => 'fa fa-text-width',
			'params'      => array(

				array(
					'type'        => 'textarea',
					'heading'     => esc_html__( 'Text', 'wolf-core' ),
					'param_name'  => 'text',
					'value'       => esc_html__( 'My Headline', 'wolf-core' ),
					'admin_label' => true,
					'description' => sprintf( esc_html__( 'You can use the %s short tag to display the current page title.', 'wolf-core' ), '{{post_title}}' ),
				),

				array(
					'type'       => 'wolf_core_textfield',
					'heading'    => esc_html__( 'Font Size', 'wolf-core' ),
					'param_name' => 'font_size',
					'value'      => apply_filters( 'wolf_core_default_custom_heading_font_size', 48 ),
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Behavior', 'wolf-core' ),
					'param_name' => 'responsive',
					'value'      => array(
						esc_html__( 'Static', 'wolf-core' )     => 'no',
						esc_html__( 'Responsive', 'wolf-core' ) => 'yes',
					),
				),

				array(
					'type'       => 'wolf_core_textfield',
					'heading'    => esc_html__( 'Minimum Font Size', 'wolf-core' ),
					'param_name' => 'min_font_size',
					'value'      => 18,
					'dependency' => array(
						'element' => 'responsive',
						'value'   => 'yes',
					),
				),

				array(
					'type'        => 'wolf_core_font_family',
					'heading'     => esc_html__( 'Font', 'wolf-core' ),
					'param_name'  => 'font_family',
					'admin_label' => true,
					'std'         => apply_filters( 'wolf_core_default_custom_heading_font_family', '' ),
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Text Alignment', 'wolf-core' ),
					'param_name' => 'text_align',
					'value'      => array(
						esc_html__( 'Center', 'wolf-core' ) => 'center',
						esc_html__( 'Left', 'wolf-core' )   => 'left',
						esc_html__( 'Right', 'wolf-core' )  => 'right',
					),
				),

				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Center Align on Mobile', 'wolf-core' ),
					'param_name' => 'text_align_mobile',
					'value'      => array(
						esc_html__( 'Center', 'wolf-core' ) => 'center',
					),
				),

				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'         => 'color',
					'value'              => array_merge(
						wolf_core_get_shared_colors(),
						array(
							esc_html__( 'Default color', 'wolf-core' )  => 'default',
							esc_html__( 'Gradient Red', 'wolf-core' )   => 'gradient-red',
							esc_html__( 'Gradient Green', 'wolf-core' ) => 'gradient-green',
							esc_html__( 'Custom color', 'wolf-core' )   => 'custom',
						)
					),
					'std'                => 'default',
					'description'        => esc_html__( 'Select a text color.', 'wolf-core' ),
					'param_holder_class' => 'wolf_core_colored-dropdown',
				),

				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name' => 'custom_color',
					'dependency' => array(
						'element' => 'color',
						'value'   => 'custom',
					),
				),

				array(
					'type'        => 'wolf_core_textfield',
					'heading'     => esc_html__( 'Font Weight', 'wolf-core' ),
					'param_name'  => 'font_weight',
					'value'       => apply_filters( 'wolf_core_default_custom_heading_font_weight', 700 ),
					'placeholder' => apply_filters( 'wolf_core_default_custom_heading_font_weight', 700 ),
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Text Transform', 'wolf-core' ),
					'param_name' => 'text_transform',
					'value'      => array(
						esc_html__( 'Default', 'wolf-core' )   => '',
						esc_html__( 'None', 'wolf-core' )      => 'none',
						esc_html__( 'Uppercase', 'wolf-core' ) => 'uppercase',
					),
					'std'        => apply_filters( 'wolf_core_default_custom_heading_text_transform', '' ),
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Font Style', 'wolf-core' ),
					'param_name' => 'font_style',
					'value'      => array(
						esc_html__( 'Default', 'wolf-core' ) => '',
						esc_html__( 'Italic', 'wolf-core' )  => 'italic',
					),
				),

				array(
					'type'       => 'wolf_core_textfield',
					'heading'    => esc_html__( 'Letter Spacing', 'wolf-core' ),
					'param_name' => 'letter_spacing',
					'value'      => apply_filters( 'wolf_core_default_custom_heading_letter_spacing', '' ),
				),

				array(
					'type'        => 'wolf_core_textfield',
					'heading'     => esc_html__( 'Line Height', 'wolf-core' ),
					'param_name'  => 'line_height',
					'placeholder' => '1',
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Tag', 'wolf-core' ),
					'param_name' => 'tag',
					'value'      => array(
						'h2',
						'p',
						'h5',
						'h4',
						'h3',
						'h1',
					),
				),

				array(
					'type'        => 'vc_link',
					'heading'     => esc_html__( 'Link', 'wolf-core' ),
					'param_name'  => 'link',
					'placeholder' => 'http://',
				),

				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Add Image Background?', 'wolf-core' ),
					'param_name' => 'add_background',
				),

				array(
					'type'       => 'attach_image',
					'heading'    => esc_html__( 'Background Image', 'wolf-core' ),
					'param_name' => 'background_img',
					'value'      => '',
					'dependency' => array(
						'element' => 'add_background',
						'value'   => array( 'true' ),
					),
					'group'      => esc_html__( 'Background', 'wolf-core' ),
					'weight'     => 0,
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Background position', 'wolf-core' ),
					'param_name' => 'background_position',
					'value'      => array(
						esc_html__( 'center center', 'wolf-core' ) => 'center center',
						esc_html__( 'center top', 'wolf-core' )    => 'center top',
						esc_html__( 'left top', 'wolf-core' )      => 'left top',
						esc_html__( 'right top', 'wolf-core' )     => 'right top',
						esc_html__( 'center bottom', 'wolf-core' ) => 'center bottom',
						esc_html__( 'left bottom', 'wolf-core' )   => 'left bottom',
						esc_html__( 'right bottom', 'wolf-core' )  => 'right bottom',
						esc_html__( 'left center', 'wolf-core' )   => 'left center',
						esc_html__( 'right center', 'wolf-core' )  => 'right center',
					),
					'dependency' => array(
						'element' => 'add_background',
						'value'   => array( 'true' ),
					),
					'group'      => esc_html__( 'Background', 'wolf-core' ),
					'weight'     => 0,
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Background repeat', 'wolf-core' ),
					'param_name' => 'background_repeat',
					'value'      => array(
						esc_html__( 'no repeat', 'wolf-core' ) => 'no-repeat',
						esc_html__( 'repeat', 'wolf-core' )    => 'repeat',
						esc_html__( 'repeat-x', 'wolf-core' )  => 'repeat-x',
						esc_html__( 'repeat-y', 'wolf-core' )  => 'repeat-y',
					),
					'dependency' => array(
						'element' => 'add_background',
						'value'   => array( 'true' ),
					),
					'group'      => esc_html__( 'Background', 'wolf-core' ),
					'weight'     => 0,
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Background size', 'wolf-core' ),
					'param_name' => 'background_size',
					'value'      => array(
						esc_html__( 'default', 'wolf-core' ) => 'inherit',
						esc_html__( 'cover', 'wolf-core' )   => 'cover',
						esc_html__( 'contain', 'wolf-core' ) => 'contain',
					),
					'dependency' => array(
						'element' => 'add_background',
						'value'   => array( 'true' ),
					),
					'group'      => esc_html__( 'Background', 'wolf-core' ),
					'weight'     => 0,
				),
			),
		)
	);
}
