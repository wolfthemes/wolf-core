<?php
/**
 * Social Icons
 *
 * @author WolfThemes
 * @package WolfCore/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Element Parameters
 *
 * @return array
 */
function wolf_core_social_icons_params() {

	return apply_filters(
		'wolf_core_social_icons_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Social Icons', 'wolf-core' ),
				'description'   => esc_html__( 'A set of icons linked to your social profiles', 'wolf-core' ),
				'vc_base'       => 'wolf_core_social_icons',
				'el_base'       => 'socials',
				'vc_category'   => esc_html__( 'Social', 'wolf-core' ),
				'el_categories' => array( 'social' ),
				'icon'          => 'fa fa-share-alt',
			),

			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Services', 'wolf-core' ),
					'param_name'  => 'services',
					'default'     => 'facebook,twitter,instagram',
					'description' => sprintf(
						wp_kses(
							__( 'Enter the service names separated by a comma. Leave empty to display them all.<br>You can set your profiles in the <a href="%s" target="_blank">customizer</a>.', 'wolf-core' ),
							array(
								'br' => array(),
								'a'  => array(
									'href'   => array(),
									'target' => array(),
								),
							)
						),
						esc_url( admin_url( 'customize.php' ) )
					),
					'admin_label' => true,
				),

				array(
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'type'         => 'choose',
					'options'      => array(
						'left'   => array(
							'title' => esc_html__( 'Left', 'wolf-core' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center' => array(
							'title' => esc_html__( 'Center', 'wolf-core' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'  => array(
							'title' => esc_html__( 'Right', 'wolf-core' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-socials-container' => 'text-align:{{VALUE}};',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'options'      => array(
						'center' => esc_html__( 'Center', 'wolf-core' ),
						'left'   => esc_html__( 'Left', 'wolf-core' ),
						'right'  => esc_html__( 'Right', 'wolf-core' ),
					),
					'page_builder' => 'vc',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Target', 'wolf-core' ),
					'param_name' => 'target',
					'options'    => ( function_exists( 'wolf_core_target_param_list' ) ) ? wolf_core_target_param_list() : '',
					'default'    => '_blank',
				),

				array(
					'type'       => 'checkbox',
					'label'      => sprintf( wolf_core_kses( __( 'Add %s attribute', 'wolf-core' ) ), '"noreferrer, noopener" rel' ),
					'param_name' => 'rel',
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Background shape', 'wolf-core' ),
					'param_name'  => 'background_style',
					'options'     => array(
						'none'                 => esc_html__( 'None', 'wolf-core' ),
						'rounded'              => esc_html__( 'Circle', 'wolf-core' ),
						'boxed'                => esc_html__( 'Square', 'wolf-core' ),
						'rounded-less'         => esc_html__( 'Rounded', 'wolf-core' ),
						'rounded-outline'      => esc_html__( 'Outline Circle', 'wolf-core' ),
						'boxed-outline'        => esc_html__( 'Outline Square', 'wolf-core' ),
						'rounded-less-outline' => esc_html__( 'Outline Rounded', 'wolf-core' ),
					),
					'description' => esc_html__( 'Select background shape and style for icon.', 'wolf-core' ),
					'default'     => 'none',
				),

				/* Icon Color for VC */
				array(
					'type'               => 'select',
					'label'              => esc_html__( 'Icon Color', 'wolf-core' ),
					'param_name'         => 'color',
					'options'            => array_merge(
						wolf_core_get_shared_colors(),
						array(
							'default'        => esc_html__( 'Default color', 'wolf-core' ),
							'gradient-red'   => esc_html__( 'Gradient Red', 'wolf-core' ),
							'gradient-green' => esc_html__( 'Gradient Green', 'wolf-core' ),
							'custom'         => esc_html__( 'Custom color', 'wolf-core' ),
						)
					),
					'default'            => 'default',
					'description'        => esc_html__( 'Select a icon color.', 'wolf-core' ),
					'param_holder_class' => 'wolf_core_colored-select',
					'group'              => esc_html__( 'Style', 'wolf-core' ),
					'page_builder'       => 'vc',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Icon Custom Color', 'wolf-core' ),
					'param_name'   => 'custom_color',
					'condition'    => array(
						'color' > 'custom',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
					'page_builder' => 'vc',
				),

				/* Icon Color for Elementor in Style tab */
				array(
					'label'        => esc_html__( 'Icon Color', 'wolf-core' ),
					'type'         => 'hidden',
					'param_name'   => 'color',
					'default'      => 'custom',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Icon Color', 'wolf-core' ),
					'param_name'   => 'custom_color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-icon' => 'color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				/* Background Color for VC */
				array(
					'type'               => 'select',
					'label'              => esc_html__( 'Background Color', 'wolf-core' ),
					'param_name'         => 'background_color',
					'options'            => array_merge(
						wolf_core_get_shared_colors(),
						array(
							'default'        => esc_html__( 'Default color', 'wolf-core' ),
							'gradient-red'   => esc_html__( 'Gradient Red', 'wolf-core' ),
							'gradient-green' => esc_html__( 'Gradient Green', 'wolf-core' ),
							'custom'         => esc_html__( 'Custom color', 'wolf-core' ),
						)
					),
					'default'            => 'default',
					'description'        => esc_html__( 'Select a Background color.', 'wolf-core' ),
					'param_holder_class' => 'wolf_core_colored-select',
					'group'              => esc_html__( 'Style', 'wolf-core' ),
					'page_builder'       => 'vc',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Background Custom Color', 'wolf-core' ),
					'param_name'   => 'custom_background_color', // backward compatiblity name (WVC plugin).
					'condition'    => array(
						'color' > 'custom',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
					'page_builder' => 'vc',
				),

				/* Background Color for Elementor in Style tab */
				array(
					'label'        => esc_html__( 'Background Color', 'wolf-core' ),
					'type'         => 'hidden',
					'param_name'   => 'background_color',
					'default'      => 'custom',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Background Color', 'wolf-core' ),
					'param_name'   => 'custom_background_color', // backward compatiblity name (WVC plugin).
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-icon-background-fill' => 'background-color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Size', 'wolf-core' ),
					'param_name' => 'size',
					'options'    => array(
						'fa-1x' => esc_html__( 'Tiny', 'wolf-core' ),
						'fa-2x' => esc_html__( 'Small', 'wolf-core' ),
						'fa-3x' => esc_html__( 'Medium', 'wolf-core' ),
						'fa-4x' => esc_html__( 'Large', 'wolf-core' ),
						'fa-5x' => esc_html__( 'Very Large', 'wolf-core' ),
					),
					'default'    => 'fa-2x',
				),

				array(
					'type'        => 'dropdown',
					'label'       => esc_html__( 'Hover Transition', 'wolf-core' ),
					'param_name'  => 'hover_effect',
					'options'     => array(
						'none'         => esc_html__( 'None', 'wolf-core' ),
						'opacity'      => esc_html__( 'Opacity', 'wolf-core' ),
						'border-inset' => esc_html__( 'Inset border', 'wolf-core' ),
						'sonar'        => esc_html__( 'Sonar', 'wolf-core' ),
						'fill'         => esc_html__( 'Fill', 'wolf-core' ),
						'pop'          => esc_html__( 'Pop', 'wolf-core' ),
						'rotate'       => esc_html__( 'Rotate', 'wolf-core' ),
					),
					// 'description' => esc_html__( 'Custom hover effects won\'t apply to icon with custom colors settings', 'wolf-core' ),
					'condition'   => array(
						'element'   => 'background_style',
						'not_empty' => true,
					),
					'admin_label' => true,
					'default'     => 'opacity',
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Direction', 'wolf-core' ),
					'param_name'  => 'direction',
					'std'         => 'horizontal',
					'options'     => array(
						'horizontal' => esc_html__( 'Horizontal', 'wolf-core' ),
						'vertical'   => esc_html__( 'Vertical', 'wolf-core' ),
					),
					'admin_label' => true,
					'default'     => 'horizontal',
				),

				array(
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Animate Icons One By One', 'wolf-core' ),
					'param_name' => 'css_animation_each',
					'group'      => esc_html__( 'Animation', 'wolf-core' ),
					'weight'     => -5,
				),
			),
		)
	);
}
