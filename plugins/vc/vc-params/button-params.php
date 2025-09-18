<?php
/**
 * WPBakery Page Builder Extension button params
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get bigtext params
 *
 * @return array
 */
function wolf_core_button_params() {

	// inspired by js_composer/conifg/buttons/shortcode-vc-button.php
	$icons_params = vc_map_integrate_shortcode(
		wolf_core_icon_params(),
		'i_',
		'',
		array(
			'include_only_regex' => '/^(type|icon_\w*)/',
		// we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
		),
		array(
			'element' => 'add_icon',
			'value'   => 'true',
		)
	);

	// populate integrated vc_icons params.
	if ( is_array( $icons_params ) && ! empty( $icons_params ) ) {
		foreach ( $icons_params as $key => $param ) {
			if ( is_array( $param ) && ! empty( $param ) ) {

				// var_dump( $param );

				if ( ! isset( $param['group'] ) ) {
					// set group tab
					// $icons_params[ $key ]['group'] = esc_html__( 'Icon', 'wolf-core' );
				}

				if ( 'i_type' == $param['param_name'] ) {
					// force dependency
					$icons_params[ $key ]['dependency'] = array(
						'element' => 'add_icon',
						'value'   => 'true',
					);
				}

				if ( isset( $param['admin_label'] ) ) {
					// remove admin label
					unset( $icons_params[ $key ]['admin_label'] );
				}
			}
		}
	}

	// var_dump( $icons_params );

	return array(
		'name'        => esc_html__( 'Button', 'wolf-core' ),
		'description' => esc_html__( 'Eye catching button', 'wolf-core' ),
		'base'        => 'vc_button',
		'category'    => esc_html__( 'Content', 'wolf-core' ),
		'icon'        => 'fa fa-square',
		'params'      => array_merge(
			array(

				array(
					'type'        => 'wolf_core_textfield',
					'heading'     => esc_html__( 'Text', 'wolf-core' ),
					'param_name'  => 'title',
					'value'       => esc_html__( 'My Button', 'wolf-core' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'vc_link',
					'heading'     => esc_html__( 'URL (Link)', 'wolf-core' ),
					'param_name'  => 'link',
					'description' => esc_html__( 'Add link to button.', 'wolf-core' ),
					// 'admin_label' => true,
				),

				array(
					'type'               => 'dropdown',
					'heading'            => esc_html__( 'Color', 'wolf-core' ),
					'param_name'         => 'color',
					'value'              => array_merge(
						wolf_core_get_shared_colors(),
						wolf_core_get_shared_gradient_colors(),
						array( esc_html__( 'Custom color', 'wolf-core' ) => 'custom' )
					),
					'description'        => esc_html__( 'Select button color.', 'wolf-core' ),
					'param_holder_class' => 'wolf_core_colored-dropdown',
				),

				array(
					'type'        => 'colorpicker',
					'heading'     => esc_html__( 'Custom color', 'wolf-core' ),
					'param_name'  => 'custom_color',
					'description' => esc_html__( 'Select custom button color.', 'wolf-core' ),
					'dependency'  => array(
						'element' => 'color',
						'value'   => 'custom',
					),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Shape', 'wolf-core' ),
					'description' => esc_html__( 'Select button shape.', 'wolf-core' ),
					'param_name'  => 'shape',
					'std'         => apply_filters( 'wolf_core_default_button_shape', 'standard' ),
					'value'       => array(
						esc_html__( 'Standard', 'wolf-core' )         => 'standard',
						esc_html__( 'Round', 'wolf-core' )            => 'rounded',
						esc_html__( 'Square', 'wolf-core' )           => 'boxed',
						esc_html__( 'Rounded', 'wolf-core' )          => 'rounded-less',
						esc_html__( 'Outline Standard', 'wolf-core' ) => 'standard-outline',
						esc_html__( 'Outline Round', 'wolf-core' )    => 'rounded-outline',
						esc_html__( 'Outline Square', 'wolf-core' )   => 'boxed-outline',
						esc_html__( 'Outline Rounded', 'wolf-core' )  => 'rounded-less-outline',
					),
					'description' => esc_html__( 'Select background shape and style for button.', 'wolf-core' ),
				),

				// array(
				// 'type' => 'dropdown',
				// 'heading' => esc_html__( 'Style', 'wolf-core' ),
				// 'description' => esc_html__( 'Select button display style.', '%%' ),
				// 'param_name' => 'style',
				// 'value' => array(
				// esc_html__( 'Flat', 'wolf-core' ) => 'flat',
				// esc_html__( '3d', 'wolf-core' ) => '3d',
				// esc_html__( 'Custom', 'wolf-core' ) => 'custom',
				// esc_html__( 'Outline custom', 'wolf-core' ) => 'outline-custom',
				// esc_html__( 'Gradient', 'wolf-core' ) => 'gradient',
				// esc_html__( 'Gradient Custom', 'wolf-core' ) => 'gradient-custom',
				// ),
				// ),

				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Size', 'wolf-core' ),
					'param_name'  => 'size',
					'description' => esc_html__( 'Select button display size.', 'wolf-core' ),
					'std'         => 'sm',
					'value'       => array(
						esc_html( 'Small', 'wolf-core' )       => 'xs',
						esc_html( 'Normal', 'wolf-core' )      => 'sm',
						esc_html( 'Large', 'wolf-core' )       => 'md',
						esc_html( 'Extra Large', 'wolf-core' ) => 'lg',
					),
					'admin_label' => true,
				),

				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'  => 'align',
					'description' => esc_html__( 'Select button alignment.', 'wolf-core' ),
					'value'       => array(
						esc_html__( 'Center', 'wolf-core' ) => 'center',
						esc_html__( 'Inline', 'wolf-core' ) => 'inline',
						esc_html__( 'Left', 'wolf-core' )   => 'left',
						esc_html__( 'Right', 'wolf-core' )  => 'right',
					),
					'admin_label' => true,
				),

				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Set full width button?', 'wolf-core' ),
					'param_name' => 'button_block',
					'dependency' => array(
						'element'            => 'align',
						'value_not_equal_to' => 'inline',
					),
				),

				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Hover effect', 'wolf-core' ),
					'param_name'  => 'hover_effect',
					'value'       => array(
						esc_html__( 'None', 'wolf-core' )            => 'none',
						esc_html__( 'Opacity', 'wolf-core' )         => 'opacity',
						esc_html__( 'Background', 'wolf-core' )      => 'background',
						esc_html__( 'Up', 'wolf-core' )              => 'upper',
						esc_html__( 'Fill Vertical', 'wolf-core' )   => 'fill-vertical',
						esc_html__( 'Fill Horizontal', 'wolf-core' ) => 'fill-horizontal',
					),
					'admin_label' => true,
				),

				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Add icon?', 'wolf-core' ),
					'param_name' => 'add_icon',
				),

				array(
					'type'        => 'dropdown',
					'heading'     => esc_html__( 'Icon Alignment', 'wolf-core' ),
					'description' => esc_html__( 'Select icon alignment.', 'wolf-core' ),
					'param_name'  => 'i_align',
					'value'       => array(
						esc_html__( 'Left', 'wolf-core' )  => 'left',
						esc_html__( 'Right', 'wolf-core' ) => 'right',
					),
					'dependency'  => array(
						'element' => 'add_icon',
						'value'   => 'true',
					),
				),

				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Reveal Icon on Hover', 'wolf-core' ),
					'description' => esc_html__( 'The icon will be visible on hover only.', 'wolf-core' ),
					'param_name'  => 'i_hover',
					'dependency'  => array(
						'element' => 'add_icon',
						'value'   => 'true',
					),
				),
			),
			$icons_params,
			array(
				array(
					'type'        => 'wolf_core_textfield',
					'heading'     => esc_html__( 'Font Weight', 'wolf-core' ),
					'param_name'  => 'font_weight',
					'placeholder' => '400',
					'admin_label' => true,
					'weight'      => -1000,
					'group'       => esc_html__( 'Extra', 'wolf-core' ),
					'std'         => apply_filters( 'wolf_core_button_default_font_weight', 400 ),
				),

				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Scroll to anchor?', 'wolf-core' ),
					'param_name' => 'scroll_to_anchor',
					'weight'     => -1000,
					'group'      => esc_html__( 'Extra', 'wolf-core' ),
				),
			)
		),
		// 'js_view' => 'VcButton3View',
		// 'custom_markup' => '{{title}}<div class="vc_btn3-container"><button class="vc_general vc_btn3 vc_btn3 vc_btn3-size-sm vc_btn3-shape-{{ params.shape }} vc_btn3-style-{{ params.style }} vc_btn3-color-{{ params.color }}">{{{ params.title }}}</button></div>',
	);
}
