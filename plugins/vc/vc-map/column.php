<?php
/**
 * Column
 *
 * @author WolfThemes
 * @package WolfCore/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

vc_map(
	array(
		'name'            => esc_html__( 'Column', 'wolf-core' ),
		'base'            => 'vc_column',
		'is_container'    => true,
		'content_element' => false,
		'params'          => array_merge(
			wolf_core_column_general_params(),
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Skin Tone', 'wolf-core' ),
					'param_name' => 'font_color',
					'value'      => array(
						esc_html__( 'Inherit', 'wolf-core' ) => 'inherit',
						esc_html__( 'Light', 'wolf-core' )   => 'dark',
						esc_html__( 'Dark', 'wolf-core' )    => 'light',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
					'weight'     => 0,
				),
			),
			wolf_core_background_params(),
			array(
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Border Color', 'wolf-core' ),
					'param_name'         => 'border_color',
					'value'              => array_merge(
						array( esc_html__( 'None', 'wolf-core' ) => 'none' ),
						wolf_core_get_shared_gradient_colors(),
						wolf_core_get_shared_colors(),
						array( esc_html__( 'Transparent', 'wolf-core' ) => 'transparent' ),
						array( esc_html__( 'Custom color', 'wolf-core' ) => 'custom' )
					),
					'param_holder_class' => 'wolf_core_colored-dropdown',
					'group'              => esc_html__( 'Custom', 'wolf-core' ),
					'weight'             => -100,
				),

				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Border Custom Color', 'wolf-core' ),
					'param_name' => 'border_custom_color',
					'dependency' => array(
						'element' => 'border_color',
						'value'   => 'custom',
					),
					'group'      => esc_html__( 'Custom', 'wolf-core' ),
					'weight'     => -100,
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Border Style', 'wolf-core' ),
					'param_name' => 'border_style',
					'value'      => array(
						esc_html__( 'None', 'wolf-core' )   => 'none',
						esc_html__( 'Solid', 'wolf-core' )  => 'solid',
						esc_html__( 'Dotted', 'wolf-core' ) => 'dotted',
						esc_html__( 'Dashed', 'wolf-core' ) => 'dashed',
						esc_html__( 'Double', 'wolf-core' ) => 'double',
						esc_html__( 'Groove', 'wolf-core' ) => 'groove',
						esc_html__( 'Ridge', 'wolf-core' )  => 'ridge',
						esc_html__( 'Inset', 'wolf-core' )  => 'inset',
						esc_html__( 'Outset', 'wolf-core' ) => 'outset',
					),
					'group'      => esc_html__( 'Custom', 'wolf-core' ),
					'weight'     => -100,
				),

				array(
					'type'        => 'wolf_core_textfield',
					'heading'     => esc_html__( 'Inline Style', 'wolf-core' ),
					'param_name'  => 'inline_style',
					'group'       => esc_html__( 'Custom', 'wolf-core' ),
					'description' => sprintf( esc_html__( 'Additional inline CSS that will be applied to the element. (e.g: %s)', 'wolf-core' ), 'color:red;' ),
					'weight'      => -100,
				),
			),
			array(
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Custom Link', 'wolf-core' ),
					'param_name' => 'link',
					'group'      => esc_html__( 'Extra', 'wolf-core' ),
					'weight'     => -100,
				),

				array(
					'type'       => 'wolf_core_textfield',
					'heading'    => esc_html__( 'Link Extra Class', 'wolf-core' ),
					'param_name' => 'link_extra_class',
					'group'      => esc_html__( 'Extra', 'wolf-core' ),
					'weight'     => -100,
				),

				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Sticky', 'wolf-core' ),
					'param_name'  => 'sticky',
					'description' => esc_html__( 'Check this option to stick the element at the top when scrolling. Note that this feature doesn\'t work if your row is set to "equal height" columns.', 'wolf-core' ),
					'group'       => esc_html__( 'Extra', 'wolf-core' ),
					'weight'      => -100,
				),
			)
		),
		'js_view'         => 'VcColumnView',
	)
);
