<?php
/**
 * Column
 *
 * @author WolfThemes
 * @package %PACKAGENAME%/Params
 * @version 3.2.8
 */

defined( 'ABSPATH' ) || exit;

vc_map(
	array(
		'name'            => esc_html__( 'Column', '%TEXTDOMAIN%' ),
		'base'            => 'vc_column',
		'is_container'    => true,
		'content_element' => false,
		'params'          => array_merge(
			wolf_core_column_general_params(),
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Skin Tone', '%TEXTDOMAIN%' ),
					'param_name' => 'font_color',
					'value'      => array(
						esc_html__( 'Inherit', '%TEXTDOMAIN%' ) => 'inherit',
						esc_html__( 'Light', '%TEXTDOMAIN%' ) => 'dark',
						esc_html__( 'Dark', '%TEXTDOMAIN%' ) => 'light',
					),
					'group'      => esc_html__( 'Style', '%TEXTDOMAIN%' ),
					'weight'     => 0,
				),
			),
			wolf_core_background_params(),
			array(
				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Border Color', '%TEXTDOMAIN%' ),
					'param_name'         => 'border_color',
					'value'              => array_merge(
						array( esc_html__( 'None', '%TEXTDOMAIN%' ) => 'none' ),
						wolf_core_get_shared_gradient_colors(),
						wolf_core_get_shared_colors(),
						array( esc_html__( 'Transparent', '%TEXTDOMAIN%' ) => 'transparent' ),
						array( esc_html__( 'Custom color', '%TEXTDOMAIN%' ) => 'custom' )
					),
					'param_holder_class' => 'wolf_core_colored-dropdown',
					'group'              => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
					'weight'             => -100,
				),

				array(
					'type'       => 'colorpicker',
					'heading'    => esc_html__( 'Border Custom Color', '%TEXTDOMAIN%' ),
					'param_name' => 'border_custom_color',
					'dependency' => array(
						'element' => 'border_color',
						'value'   => 'custom',
					),
					'group'      => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
					'weight'     => -100,
				),

				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Border Style', '%TEXTDOMAIN%' ),
					'param_name' => 'border_style',
					'value'      => array(
						esc_html__( 'None', '%TEXTDOMAIN%' ) => 'none',
						esc_html__( 'Solid', '%TEXTDOMAIN%' ) => 'solid',
						esc_html__( 'Dotted', '%TEXTDOMAIN%' ) => 'dotted',
						esc_html__( 'Dashed', '%TEXTDOMAIN%' ) => 'dashed',
						esc_html__( 'Double', '%TEXTDOMAIN%' ) => 'double',
						esc_html__( 'Groove', '%TEXTDOMAIN%' ) => 'groove',
						esc_html__( 'Ridge', '%TEXTDOMAIN%' ) => 'ridge',
						esc_html__( 'Inset', '%TEXTDOMAIN%' ) => 'inset',
						esc_html__( 'Outset', '%TEXTDOMAIN%' ) => 'outset',
					),
					'group'      => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
					'weight'     => -100,
				),

				array(
					'type'        => 'wolf_core_textfield',
					'heading'     => esc_html__( 'Inline Style', '%TEXTDOMAIN%' ),
					'param_name'  => 'inline_style',
					'group'       => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
					'description' => sprintf( esc_html__( 'Additional inline CSS that will be applied to the element. (e.g: %s)', '%TEXTDOMAIN%' ), 'color:red;' ),
					'weight'      => -100,
				),
			),
			array(
				array(
					'type'       => 'vc_link',
					'heading'    => esc_html__( 'Custom Link', '%TEXTDOMAIN%' ),
					'param_name' => 'link',
					'group'      => esc_html__( 'Extra', '%TEXTDOMAIN%' ),
					'weight'     => -100,
				),

				array(
					'type'       => 'wolf_core_textfield',
					'heading'    => esc_html__( 'Link Extra Class', '%TEXTDOMAIN%' ),
					'param_name' => 'link_extra_class',
					'group'      => esc_html__( 'Extra', '%TEXTDOMAIN%' ),
					'weight'     => -100,
				),

				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Sticky', '%TEXTDOMAIN%' ),
					'param_name'  => 'sticky',
					'description' => esc_html__( 'Check this option to stick the element at the top when scrolling. Note that this feature doesn\'t work if your row is set to "equal height" columns.', '%TEXTDOMAIN%' ),
					'group'       => esc_html__( 'Extra', '%TEXTDOMAIN%' ),
					'weight'      => -100,
				),
			)
		),
		'js_view'         => 'VcColumnView',
	)
);
