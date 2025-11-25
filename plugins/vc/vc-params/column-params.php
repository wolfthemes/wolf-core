<?php
/**
 * WPBakery Page Builder Extension Column params
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Column general params
 */
function wolf_core_column_general_params() {
	return array(
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Content type', 'wolf-core' ),
			'param_name'  => 'content_type',
			'value'       => array(
				esc_html__( 'Text (padding)', 'wolf-core' )     => 'default',
				// esc_html__( 'Block with text content', 'wolf-core' ) => 'block-text',
				esc_html__( 'Media (no padding)', 'wolf-core' ) => 'block-media',
			),
			'description' => esc_html__( 'Select type of content you will insert.', 'wolf-core' ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Vertical Position', 'wolf-core' ),
			'param_name'  => 'content_placement',
			'value'       => array(
				esc_html__( 'Default', 'wolf-core' ) => 'default',
				esc_html__( 'Top', 'wolf-core' )     => 'top',
				esc_html__( 'Middle', 'wolf-core' )  => 'middle',
				esc_html__( 'Bottom', 'wolf-core' )  => 'bottom',
			),
			'description' => esc_html__( 'Select the vertical position of the content.', 'wolf-core' ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Horizontal Position', 'wolf-core' ),
			'param_name'  => 'content_alignment',
			'value'       => array(
				esc_html__( 'Center', 'wolf-core' ) => 'center',
				esc_html__( 'Left', 'wolf-core' )   => 'left',
				esc_html__( 'Right', 'wolf-core' )  => 'right',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', 'wolf-core' ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Default Text Alignment', 'wolf-core' ),
			'param_name'  => 'text_alignment',
			'value'       => array(
				esc_html__( 'Default', 'wolf-core' ) => 'default',
				esc_html__( 'Left', 'wolf-core' )    => 'left',
				esc_html__( 'Center', 'wolf-core' )  => 'center',
				esc_html__( 'Right', 'wolf-core' )   => 'right',
			),
			'description' => esc_html__( 'Specify the text alignment inside the column. It can be overwritten in some elements.', 'wolf-core' ),
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Content Min Height', 'wolf-core' ),
			'param_name'  => 'min_height',
			'placeholder' => 'auto',
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Content Max Width', 'wolf-core' ),
			'param_name'  => 'max_width',
			'placeholder' => 'auto',
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column Style', 'wolf-core' ),
			'param_name'  => 'column_style',
			'value'       => array(
				esc_html__( 'None', 'wolf-core' )                    => 'none',
				esc_html__( 'Box Shadow', 'wolf-core' )              => 'box-shadow',
				esc_html__( 'Boxed with Hover Effect', 'wolf-core' ) => 'boxed',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', 'wolf-core' ),
		),

		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Width', 'wolf-core' ),
			'edit_field_class' => 'wvc-hidden',
			'param_name'       => 'width',
			'value'            => array(
				esc_html__( '1 column - 1/12', 'wolf-core' )    => '1/12',
				esc_html__( '2 columns - 1/6', 'wolf-core' )    => '1/6',
				esc_html__( '3 columns - 1/4', 'wolf-core' )    => '1/4',
				esc_html__( '4 columns - 1/3', 'wolf-core' )    => '1/3',
				esc_html__( '5 columns - 5/12', 'wolf-core' )   => '5/12',
				esc_html__( '6 columns - 1/2', 'wolf-core' )    => '1/2',
				esc_html__( '7 columns - 7/12', 'wolf-core' )   => '7/12',
				esc_html__( '8 columns - 2/3', 'wolf-core' )    => '2/3',
				esc_html__( '9 columns - 3/4', 'wolf-core' )    => '3/4',
				esc_html__( '10 columns - 5/6', 'wolf-core' )   => '5/6',
				esc_html__( '11 columns - 11/12', 'wolf-core' ) => '11/12',
				esc_html__( '12 columns - 1/1', 'wolf-core' )   => '1/1',
			),
			// 'group' => __( 'Responsive Options', 'wolf-core' ),
			'description'      => __( 'Select column width.', 'wolf-core' ),
			'std'              => '1/1',
		),

		// Shift X-Axis
		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shift X-Axis', 'wolf-core' ),
			'param_name' => 'shift_x',
			'min'        => -1000,
			'max'        => 1000,
			'step'       => 10,
			'std'        => 0,
			'group'      => esc_html( 'Off-Grid', 'wolf-core' ),
			'weight'     => -100,
		),

		// Shift Y-Axis
		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shift Y-Axis', 'wolf-core' ),
			'param_name' => 'shift_y',
			'min'        => -1000,
			'max'        => 1000,
			'step'       => 10,
			'std'        => 0,
			'group'      => esc_html( 'Off-Grid', 'wolf-core' ),
			'weight'     => -100,
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Custom Z-Index', 'wolf-core' ),
			'param_name' => 'z_index',
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'std'        => 0,
			'group'      => esc_html( 'Off-Grid', 'wolf-core' ),
			'weight'     => -100,
		),
	);
}
