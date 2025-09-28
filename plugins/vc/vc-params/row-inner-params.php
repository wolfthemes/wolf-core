<?php
/**
 * Row inner params
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Row inner general params
 */
function wolf_core_row_inner_general_params() {
	return array(
		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Column Type', 'wolf-core' ),
		// 'param_name' => 'column_type',
		// 'value' => array(
		// esc_html__( 'Columns', 'wolf-core' ) => 'column',
		// esc_html__( 'Block', 'wolf-core' ) => 'block',
		// ),
		// 'std' => 'column',
		// 'description' => esc_html__( 'This will set a default style for your columns.', 'wolf-core' ),
		// 'weight' => 1,
		// ),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Row Width', 'wolf-core' ),
			'param_name' => 'container_width',
			'value'      => array(
				sprintf( esc_html__( 'Inherit', 'wolf-core' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'inherit',
				sprintf( esc_html__( 'Standard width (%s centered)', 'wolf-core' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'standard',
				sprintf( esc_html__( 'Small width (%s centered)', 'wolf-core' ), apply_filters( 'wolf_core_row_small_width', '750px' ) ) => 'small',
			),
			'weight'     => 1,
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Min Height', 'wolf-core' ),
			'param_name'  => 'min_height',
			'placeholder' => 'auto',
			'description' => esc_html__( 'Insert the row minimum height in pixel.', 'wolf-core' ),
			'weight'      => 1,
		),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Content position', 'wolf-core' ),
		// 'param_name' => 'content_placement',
		// 'value' => array(
		// esc_html__( 'Default', 'wolf-core' ) => 'default',
		// esc_html__( 'Top', 'wolf-core' ) => 'top',
		// esc_html__( 'Middle', 'wolf-core' ) => 'middle',
		// esc_html__( 'Bottom', 'wolf-core' ) => 'bottom',
		// ),
		// 'description' => esc_html__( 'Select content position within columns.', 'wolf-core' ),
		// 'dependency' => array( 'element' => 'content_layout', 'value' => array( 'column' ) ),
		// ),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Columns position', 'wolf-core' ),
		// 'param_name' => 'columns_placement',
		// 'value' => array(
		// esc_html__( 'Default', 'wolf-core' ) => 'default',
		// esc_html__( 'Middle', 'wolf-core' ) => 'middle',
		// esc_html__( 'Top', 'wolf-core' ) => 'top',
		// esc_html__( 'Bottom', 'wolf-core' ) => 'bottom',
		// esc_html__( 'Stretch', 'wolf-core' ) => 'stretch',
		// ),
		// 'description' => esc_html__( 'Select columns position within row.', 'wolf-core' ),
		// 'dependency' => array(
		// 'element' => 'full_height',
		// 'not_empty' => true,
		// ),
		// 'weight' => 1,
		// ),

		// array(
		// 'type' => 'checkbox',
		// 'heading' => esc_html__( 'Equal height', 'wolf-core' ),
		// 'param_name' => 'equal_height',
		// 'description' => esc_html__( 'If checked columns will be set to equal height.', 'wolf-core' ),
		// 'value' => array( esc_html__( 'Yes', 'wolf-core' ) => 'yes' ),
		// 'dependency' => array( 'element' => 'content_layout', 'value' => array( 'column' ) ),
		// ),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Columns gap', 'wolf-core' ),
		// 'param_name' => 'gap',
		// 'value' => array(
		// '0px' => '0',
		// '1px' => '1',
		// '2px' => '2',
		// '3px' => '3',
		// '4px' => '4',
		// '5px' => '5',
		// '10px' => '10',
		// '15px' => '15',
		// '20px' => '20',
		// '25px' => '25',
		// '30px' => '30',
		// '35px' => '35',
		// ),
		// 'std' => '0',
		// 'description' => esc_html__( 'Select gap between columns in row.', 'wolf-core' ),
		// ),

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

		// Extra class
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', 'wolf-core' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wolf-core' ),
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Disable row', 'wolf-core' ),
			'param_name'  => 'disable_element',
			// Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'wolf-core' ),
			'value'       => array( esc_html__( 'Yes', 'wolf-core' ) => 'yes' ),
		),
	);
}
