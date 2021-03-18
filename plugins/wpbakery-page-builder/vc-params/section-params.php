<?php
/**
 * Section params
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Section general params
 */
function wolf_core_section_general_params() {
	return array(

		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Content Width', 'wolf-core' ),
		// 	'param_name' => 'content_type',
		// 	'value' => array(
		// 		sprintf( esc_html__( 'Standard width (%s centered)', 'wolf-core' ), '1140px' ) => 'standard',
		// 		sprintf( esc_html__( 'Small width (%s centered)', 'wolf-core' ), '750px' ) => 'small',
		// 		sprintf( esc_html__( 'Large width (%s centered)', 'wolf-core' ), '98%' ) => 'large',
		// 		sprintf( esc_html__( 'Full width (%s)', 'wolf-core' ), '100%' ) => 'full',
		// 	),
		// 	'dependency' => array( 'element' => 'content_layout', 'value' => array( 'column' ) ),
		// 	'weight' => 1,
		// ),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Min Height', 'wolf-core' ),
			'param_name' => 'min_height',
			'placeholder' => 'auto',
			'description' => esc_html__( 'Insert the row minimum height in pixel.', 'wolf-core' ),
			'weight' => 1,
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Full height section?', 'wolf-core' ),
			'param_name' => 'full_height',
			'description' => esc_html__( 'If checked section will be set to full height.', 'wolf-core' ),
			'value' => array( esc_html__( 'Yes', 'wolf-core' ) => 'yes' ),
			'weight' => 1,
		),

		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Content position', 'wolf-core' ),
		// 	'param_name' => 'content_placement',
		// 	'value' => array(
		// 		esc_html__( 'Default', 'wolf-core' ) => 'default',
		// 		esc_html__( 'Top', 'wolf-core' ) => 'top',
		// 		esc_html__( 'Middle', 'wolf-core' ) => 'middle',
		// 		esc_html__( 'Bottom', 'wolf-core' ) => 'bottom',
		// 	),
		// 	'description' => esc_html__( 'Select content position within columns.', 'wolf-core' ),
		// 	'dependency' => array( 'element' => 'content_layout', 'value' => array( 'column' ) ),
		// ),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Add pointing down arrow', 'wolf-core' ),
			'description' => esc_html__( 'Allow user to scroll to the next section when clicking on the arrow', 'wolf-core' ),
			'param_name' => 'arrow_down',
			//'dependency' => array( 'element' => 'full_height', 'value' => array( 'yes' ) ),
			'weight' => 1,
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Arrow Caption', 'wolf-core' ),
			'param_name' => 'arrow_down_text',
			'placeholder' => esc_html__( 'Continue', 'wolf-core' ),
			'weight' => 1,
		),

		// Row name
		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Section name', 'wolf-core' ),
			'param_name' => 'row_name',
			'description' => esc_html__( 'Required for the onepage scroll, this gives the name to the section.', 'wolf-core' ),
		),

		// Visibility
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Visibility', 'wolf-core' ),
			'param_name' => 'hide_class',
			'value' => array(
				esc_html__( 'Always visible', 'wolf-core' ) => '',
				esc_html__( 'Hide on tablet and mobile', 'wolf-core' ) => 'wvc-hide-tablet',
				esc_html__( 'Hide on mobile', 'wolf-core' ) => 'wvc-hide-mobile',
				esc_html__( 'Show on tablet and mobile only', 'wolf-core' ) => 'wvc-show-tablet',
				esc_html__( 'Show on mobile only', 'wolf-core' ) => 'wvc-show-mobile',
				esc_html__( 'Always hidden', 'wolf-core' ) => 'wvc-hide',
			),
		),

		// Extra class
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'wolf-core' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wolf-core' ),
		),
	);
}

/**
 * Section custom params
 */
function wolf_core_section_custom_params() {
	return array(
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'wolf-core' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Custom', 'wolf-core' ),
			'weight' => -1,
		),

		// array(
		// 	'type' => 'textfield',
		// 	'heading' => esc_html__( 'Border Color', 'wolf-core' ),
		// 	'param_name' => 'border_color',
		// 	'group' => esc_html__( 'Custom', 'wolf-core' ),
		// 	'weight' => -1,
		// ),

		// array(
		// 	'type' => 'textfield',
		// 	'heading' => esc_html__( 'Border Style', 'wolf-core' ),
		// 	'param_name' => 'border_style',
		// 	'group' => esc_html__( 'Custom', 'wolf-core' ),
		// 	'weight' => -1,
		// ),
	);
}
