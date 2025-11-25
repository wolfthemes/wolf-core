<?php
/**
 * WPBakery Page Builder Extension row params
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Row general params
 */
function wolf_core_row_general_params() {
	return array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column Type', 'wolf-core' ),
			'param_name'  => 'column_type',
			'value'       => array(
				esc_html__( 'Columns', 'wolf-core' ) => 'column',
				esc_html__( 'Blocks', 'wolf-core' )  => 'block',
			),
			'std'         => 'column',
			'description' => esc_html__( 'This will set a default style for your columns.', 'wolf-core' ),
			'weight'      => 1,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Container Width', 'wolf-core' ),
			'param_name' => 'container_width',
			'value'      => array(
				esc_html__( 'Wide', 'wolf-core' )        => 'wide',
				esc_html__( 'Boxed', 'wolf-core' )       => 'boxed',
				esc_html__( 'Small Boxed', 'wolf-core' ) => 'boxed-small',
				esc_html__( 'Large Boxed', 'wolf-core' ) => 'boxed-large',
			),
			'std'        => 'wide',
			'dependency' => array(
				'element' => 'column_type',
				'value'   => array( 'column' ),
			),
			'weight'     => 1,
		),

		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Box Shadow', 'wolf-core' ),
			'param_name' => 'box_shadow',
			'dependency' => array(
				'element'            => 'container_width',
				'value_not_equal_to' => array( 'wide' ),
			),
			'weight'     => 1,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Content Width', 'wolf-core' ),
			'param_name' => 'content_width',
			'value'      => array(
				sprintf( esc_html__( 'Standard width (%s centered)', 'wolf-core' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'standard',
				sprintf( esc_html__( 'Small width (%s centered)', 'wolf-core' ), apply_filters( 'wolf_core_row_small_width', '750px' ) ) => 'small',
				sprintf( esc_html__( 'Large width (%s centered)', 'wolf-core' ), '98%' ) => 'large',
				sprintf( esc_html__( 'Full width (%s)', 'wolf-core' ), '100%' ) => 'full',
			),
			'std'        => apply_filters( 'wolf_core_default_row_content_width', 'standard' ),
			'dependency' => array(
				'element' => 'container_width',
				'value'   => array( 'wide' ),
			),
			'weight'     => 1,
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Min Height', 'wolf-core' ),
			'param_name'  => 'min_height',
			'placeholder' => 'auto',
			'description' => esc_html__( 'Insert the row minimum height.', 'wolf-core' ),
			'weight'      => 1,
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Full height row?', 'wolf-core' ),
			'param_name'  => 'full_height',
			'description' => esc_html__( 'If checked row will be set to full height.', 'wolf-core' ),
			'value'       => array( esc_html__( 'Yes', 'wolf-core' ) => 'yes' ),
			'weight'      => 1,
			// 'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Columns Position', 'wolf-core' ),
			'param_name'  => 'columns_placement',
			'value'       => array(
				esc_html__( 'Default', 'wolf-core' ) => 'default',
				esc_html__( 'Middle', 'wolf-core' )  => 'middle',
				esc_html__( 'Top', 'wolf-core' )     => 'top',
				esc_html__( 'Bottom', 'wolf-core' )  => 'bottom',
				esc_html__( 'Stretch', 'wolf-core' ) => 'stretch',
			),
			'description' => esc_html__( 'Select columns position within row.', 'wolf-core' ),
			// 'dependency' => array(
			// 'element' => 'full_height',
			// 'not_empty' => true,
			// ),
			'weight'      => 1,
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Content Position', 'wolf-core' ),
			'param_name'  => 'content_placement',
			'value'       => array(
				esc_html__( 'Default', 'wolf-core' ) => 'default',
				esc_html__( 'Top', 'wolf-core' )     => 'top',
				esc_html__( 'Middle', 'wolf-core' )  => 'middle',
				esc_html__( 'Bottom', 'wolf-core' )  => 'bottom',
			),
			'description' => esc_html__( 'Select content position within columns.', 'wolf-core' ),
			'dependency'  => array(
				'element' => 'column_type',
				'value'   => array( 'column' ),
			),
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Add pointing down arrow', 'wolf-core' ),
			'description' => esc_html__( 'Allow user to scroll to the next section when clicking on the arrow', 'wolf-core' ),
			'param_name'  => 'arrow_down',
			'dependency'  => array(
				'element' => 'column_type',
				'value'   => array( 'column' ),
			),
			'weight'      => 1,
		),

		/*
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Mousewheel Scroll Down (beta)', 'wolf-core' ),
			'description' => esc_html__( 'Scroll to the next section automatically when scrolling down', 'wolf-core' ),
			'param_name' => 'mousewheel_down',
			'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
			'weight' => 1,
		),*/

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Arrow Caption', 'wolf-core' ),
			'param_name'  => 'arrow_down_text',
			'placeholder' => esc_html__( 'Continue', 'wolf-core' ),
			'dependency'  => array(
				'element'   => 'arrow_down',
				'not_empty' => true,
			),
			'weight'      => 1,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Arrow Alignement', 'wolf-core' ),
			'param_name' => 'arrow_down_alignement',
			'value'      => array(
				esc_html__( 'Center', 'wolf-core' ) => 'center',
				esc_html__( 'Left', 'wolf-core' )   => 'left',
				esc_html__( 'Right', 'wolf-core' )  => 'right',
			),
			'dependency' => array(
				'element'   => 'arrow_down',
				'not_empty' => true,
			),
			'weight'     => 1,
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Equal height', 'wolf-core' ),
			'param_name'  => 'equal_height',
			'description' => esc_html__( 'If checked columns will be set to equal height.', 'wolf-core' ),
			'value'       => array( esc_html__( 'Yes', 'wolf-core' ) => 'yes' ),
			'std'         => 'no',
			'dependency'  => array(
				'element' => 'column_type',
				'value'   => array( 'column' ),
			),
		),

		// Visibility
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Visibility', 'wolf-core' ),
			'param_name' => 'hide_class',
			'value'      => array(
				esc_html__( 'Always visible', 'wolf-core' )                 => '',
				esc_html__( 'Hide on tablet and mobile', 'wolf-core' )      => 'wvc-hide-tablet',
				esc_html__( 'Hide on mobile', 'wolf-core' )                 => 'wvc-hide-mobile',
				esc_html__( 'Show on tablet and mobile only', 'wolf-core' ) => 'wvc-show-tablet',
				esc_html__( 'Show on mobile only', 'wolf-core' )            => 'wvc-show-mobile',
				esc_html__( 'Always hidden', 'wolf-core' )                  => 'wvc-hide',
			),
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Disable row', 'wolf-core' ),
			'param_name'  => 'disable_element',
			// Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'wolf-core' ),
			'value'       => array( esc_html__( 'Yes', 'wolf-core' ) => 'yes' ),
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

		// Extra class
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'wolf-core' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wolf-core' ),
		),
	);
}

/**
 * Row extra params
 */
function wolf_core_row_extra_params() {
	return array(
		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Custom Column Gap', 'wolf-core' ),
			'param_name'  => 'gap',
			'description' => esc_html__( 'The space gap between columns.', 'wolf-core' ),
			'weight'      => -5,
			'std'         => '',
			'group'       => esc_html__( 'Advanced', 'wolf-core' ),
		),

		// Row name
		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Section name', 'wolf-core' ),
			'param_name'  => 'row_name',
			'description' => esc_html__( 'Required for the onepage scroll, this gives the name to the section.', 'wolf-core' ),
			'weight'      => -5,
			'group'       => esc_html__( 'Advanced', 'wolf-core' ),
		),
	);
}

/**
 * Row shape divider params
 */
function wolf_core_row_shape_dividers_params() {

	$sd_top = array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Type', 'wolf-core' ),
			'param_name' => 'sd_top_type',
			'value'      => array(
				esc_html__( 'Disabled', 'wolf-core' )     => 'disabled',
				esc_html__( 'Default', 'wolf-core' )      => 'default',
				esc_html__( 'Custom Image', 'wolf-core' ) => 'image',
				// esc_html__( 'Custom SVG', 'wolf-core' ) => 'custom_svg',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'dependency' => array(
				'element' => 'add_top_shape_divider',
				'value'   => array( 'yes' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape', 'wolf-core' ),
			'param_name' => 'sd_top_shape',
			'value'      => wolf_core_get_shape_divider_options(),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value'   => array( 'default' ),
			),
		),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Image', 'wolf-core' ),
			'param_name' => 'sd_top_img',
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value'   => array( 'image' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Inverted', 'wolf-core' ),
			'param_name' => 'sd_top_inverted',
			'value'      => array(
				esc_html__( 'No', 'wolf-core' )  => '',
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Flip', 'wolf-core' ),
			'param_name' => 'sd_top_flip',
			'value'      => array(
				esc_html__( 'No', 'wolf-core' )  => '',
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Shape Height', 'wolf-core' ),
			'param_name'  => 'sd_top_height',
			'description' => esc_html__( 'Enter a value in % or px.', 'wolf-core' ),
			'weight'      => -5,
			'placeholder' => '25%',
			'group'       => esc_html__( 'Divider Top', 'wolf-core' ),
			'dependency'  => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Shape Color', 'wolf-core' ),
			'param_name'         => 'sd_top_color',
			'value'              => array_merge(
				array( esc_html__( 'Default', 'wolf-core' ) => 'default' ),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', 'wolf-core' ) => 'custom' ),
				array( esc_html__( 'Transparent', 'wolf-core' ) => 'transparent' )
			),
			'std'                => 'default',
			'description'        => esc_html__( 'Select a color.', 'wolf-core' ),
			'group'              => esc_html__( 'Divider Top', 'wolf-core' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'weight'             => -5,
			'dependency'         => array(
				'element' => 'sd_top_type',
				'value'   => array( 'default' ),
			),
		),

		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Shape Custom Color', 'wolf-core' ),
			'param_name' => 'sd_top_custom_color',
			'dependency' => array(
				'element' => 'sd_top_color',
				'value'   => 'custom',
			),
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'weight'     => -5,
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shape Opacity', 'wolf-core' ),
			'param_name' => 'sd_top_opacity',
			'weight'     => -5,
			'std'        => '',
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'std'        => 100,
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Ratio', 'wolf-core' ),
			'param_name' => 'sd_top_ratio',
			'value'      => array(
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
				esc_html__( 'No', 'wolf-core' )  => 'no',
			),
			'weight'     => -5,
			'std'        => 'yes',
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shape Z-Index', 'wolf-core' ),
			'param_name' => 'sd_top_zindex',
			'weight'     => -5,
			'std'        => '',
			'group'      => esc_html__( 'Divider Top', 'wolf-core' ),
			'min'        => 0,
			'max'        => 10,
			'step'       => 1,
			'std'        => 0,
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Shape Responsive', 'wolf-core' ),
		// 'param_name' => 'sd_top_responsive',
		// 'value' => array(
		// esc_html__( 'Yes', 'wolf-core' ) => 'yes',
		// esc_html__( 'No', 'wolf-core' ) => '',
		// ),
		// 'weight' => -5,
		// 'group' => esc_html__( 'Divider Top', 'wolf-core' ),
		// 'dependency' => array(
		// 'element' => 'sd_top_type',
		// 'value_not_equal_to' => array( 'disabled' )
		// ),
		// )
	);

	$sd_bottom = array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Type', 'wolf-core' ),
			'param_name' => 'sd_bottom_type',
			'value'      => array(
				esc_html__( 'Disabled', 'wolf-core' )     => 'disabled',
				esc_html__( 'Default', 'wolf-core' )      => 'default',
				esc_html__( 'Custom Image', 'wolf-core' ) => 'image',
				// esc_html__( 'Custom SVG', 'wolf-core' ) => 'custom_svg',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'dependency' => array(
				'element' => 'add_bottom_shape_divider',
				'value'   => array( 'yes' ),
			),
		),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Image', 'wolf-core' ),
			'param_name' => 'sd_bottom_img',
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value'   => array( 'image' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape', 'wolf-core' ),
			'param_name' => 'sd_bottom_shape',
			'value'      => wolf_core_get_shape_divider_options(),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value'   => array( 'default' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Inverted', 'wolf-core' ),
			'param_name' => 'sd_bottom_inverted',
			'value'      => array(
				esc_html__( 'No', 'wolf-core' )  => '',
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Flip', 'wolf-core' ),
			'param_name' => 'sd_bottom_flip',
			'value'      => array(
				esc_html__( 'No', 'wolf-core' )  => '',
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Shape Height', 'wolf-core' ),
			'param_name'  => 'sd_bottom_height',
			'description' => esc_html__( 'Enter a value in % or px.', 'wolf-core' ),
			'weight'      => -5,
			'placeholder' => '25%',
			'group'       => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'dependency'  => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Shape Color', 'wolf-core' ),
			'param_name'         => 'sd_bottom_color',
			'value'              => array_merge(
				array( esc_html__( 'Default', 'wolf-core' ) => 'default' ),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', 'wolf-core' ) => 'custom' ),
				array( esc_html__( 'Transparent', 'wolf-core' ) => 'transparent' )
			),
			'std'                => 'default',
			'description'        => esc_html__( 'Select a color.', 'wolf-core' ),
			'group'              => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'weight'             => -5,
			'dependency'         => array(
				'element' => 'sd_bottom_type',
				'value'   => array( 'default' ),
			),
		),

		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Shape Custom Color', 'wolf-core' ),
			'param_name' => 'sd_bottom_custom_color',
			'dependency' => array(
				'element' => 'sd_bottom_color',
				'value'   => 'custom',
			),
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'weight'     => -5,
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shape Opacity', 'wolf-core' ),
			'param_name' => 'sd_bottom_opacity',
			'weight'     => -5,
			'std'        => '',
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'std'        => 100,
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Ratio', 'wolf-core' ),
			'param_name' => 'sd_bottom_ratio',
			'value'      => array(
				esc_html__( 'Yes', 'wolf-core' ) => 'yes',
				esc_html__( 'No', 'wolf-core' )  => 'no',
			),
			'weight'     => -5,
			'std'        => 'yes',
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shape Z-Index', 'wolf-core' ),
			'param_name' => 'sd_bottom_zindex',
			'weight'     => -5,
			'std'        => '',
			'group'      => esc_html__( 'Divider Bottom', 'wolf-core' ),
			'min'        => 0,
			'max'        => 10,
			'step'       => 1,
			'std'        => 0,
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Shape Responsive', 'wolf-core' ),
		// 'param_name' => 'sd_bottom_responsive',
		// 'value' => array(
		// esc_html__( 'Yes', 'wolf-core' ) => 'yes',
		// esc_html__( 'No', 'wolf-core' ) => '',
		// ),
		// 'weight' => -5,
		// 'group' => esc_html__( 'Divider Bottom', 'wolf-core' ),
		// 'dependency' => array(
		// 'element' => 'sd_bottom_type',
		// 'value_not_equal_to' => array( 'disabled' )
		// ),
		// )
	);

	return array_merge(
		$sd_top,
		$sd_bottom
	);
}
