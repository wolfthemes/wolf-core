<?php
/**
 * Button
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
function wolf_core_button_params() {

	return apply_filters(
		'wolf_core_button_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Button', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_button',
				'vc_category'   => esc_html__( 'Basic', 'wolf-core' ),
				'el_categories' => array( 'basic' ),
				'el_base'       => 'button',
				'keywords'      => array( 'button' ),
				// 'icon'          => 'eicon-button',
				'icon'          => 'fa fa-square',
			),
			'params'     => array(
				array(
					'type'         => 'select',
					'param_name'   => 'button_type',
					'label'        => esc_html__( 'Type', 'wolf-core' ),
					'options'      => apply_filters(
						'wolf_core_button_types',
						array(
							''        => esc_html__( 'Default', 'wolf-core' ),
							'info'    => esc_html__( 'Info', 'wolf-core' ),
							'success' => esc_html__( 'Success', 'wolf-core' ),
							'warning' => esc_html__( 'Warning', 'wolf-core' ),
							'danger'  => esc_html__( 'Danger', 'wolf-core' ),
						)
					),
					'prefix_class' => 'wolf-core-button-',
				),

				array(
					'label'       => esc_html__( 'Text', 'wolf-core' ),
					'param_name'  => 'text',
					'type'        => 'text',
					'default'     => esc_html__( 'Click here', 'wolf-core' ),
					'placeholder' => esc_html__( 'Click here', 'wolf-core' ),
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Link', 'wolf-core' ),
					'param_name' => 'link',
				),

				array(
					'label'              => esc_html__( 'Alignment', 'wolf-core' ),
					'responsive_control' => true,
					'param_name'         => 'align',
					'type'               => 'choose',
					'options'            => array(
						'left'    => array(
							'title' => esc_html__( 'Left', 'wolf-core' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center'  => array(
							'title' => esc_html__( 'Center', 'wolf-core' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'   => array(
							'title' => esc_html__( 'Right', 'wolf-core' ),
							'icon'  => 'eicon-text-align-right',
						),
						'justify' => array(
							'title' => __( 'Justified', 'wolf-core' ),
							'icon'  => 'eicon-text-align-justify',
						),
					),
					'prefix_class'       => 'wolf-core%s-align-',
					'default'            => '',
					'page_builder'       => 'wolf-core',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'align',
					'options'      => array(
						'left'    => esc_html__( 'Left', 'wolf-core' ),
						'center'  => esc_html__( 'Center', 'wolf-core' ),
						'right'   => esc_html__( 'Right', 'wolf-core' ),
						'justify' => esc_html__( 'Justified', 'wolf-core' ),
					),
					'page_builder' => 'vc',
				),

				array(
					'type'           => 'select',
					'param_name'     => 'size',
					'label'          => esc_html__( 'Size', 'wolf-core' ),
					'default'        => 'sm',
					'options'        => array(
						'xs' => esc_html__( 'Extra Small', 'wolf-core' ),
						'sm' => esc_html__( 'Small', 'wolf-core' ),
						'md' => esc_html__( 'Medium', 'wolf-core' ),
						'lg' => esc_html__( 'Large', 'wolf-core' ),
						'xl' => esc_html__( 'Extra Large', 'wolf-core' ),
					),
					'style_transfer' => true,
				),

				array(
					'param_name'       => 'selected_icon',
					'label'            => esc_html__( 'Icon', 'wolf-core' ),
					'type'             => 'icon',
					'fa4compatibility' => 'icon',
					'skin'             => 'inline',
					'label_block'      => false,
				),

				array(
					'param_name'    => 'icon_align',
					'label'         => esc_html__( 'Icon Position', 'wolf-core' ),
					'type'          => 'select',
					'default'       => 'left',
					'options'       => array(
						'left'  => esc_html__( 'Before', 'wolf-core' ),
						'right' => esc_html__( 'After', 'wolf-core' ),
					),
					'condition'     => array(
						'selected_icon[value]!' => '',
					),
					'vc_dependency' => array(
						'element'            => 'selected_icon',
						'value_not_equal_to' => array( '' ),
					),
				),

				array(
					'param_name' => 'icon_indent',
					'label'      => esc_html__( 'Icon Spacing', 'wolf-core' ),
					'type'       => 'slider',
					'range'      => array(
						'px' => array(
							'max' => 50,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .wolf-core-button-icon-align-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					),
				),

				array(
					'param_name'  => 'icon_hover_reveal',
					'label'       => esc_html__( 'Reveal Icon on Hover', 'wolf-core' ),
					'type'        => 'checkbox',
					'description' => esc_html__( 'The icon will be visible on hover only.', 'wolf-core' ),
				),

				array(
					'param_name' => 'view',
					'label'      => esc_html__( 'View', 'wolf-core' ),
					'type'       => 'hidden',
					'default'    => 'traditional',
				),

				array(
					'param_name'  => 'button_css_id',
					'label'       => esc_html__( 'Button ID', 'wolf-core' ),
					'type'        => 'text',
					'dynamic'     => array(
						'active' => true,
					),
					'default'     => '',
					'title'       => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'wolf-core' ),
					'description' => esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'wolf-core' ),
					'separator'   => 'before',
				),

				array(
					'param_name'  => 'scroll_to_anchor',
					'label'       => esc_html__( 'Scroll to Anchor', 'wolf-core' ),
					'type'        => 'checkbox',
					'description' => esc_html__( 'If your button is linked to an anchor this option will enable a smooth scroll animation.', 'wolf-core' ),
				),

				/* Typography Group controls for Elementor */
				array(
					'type'         => 'typography',
					'label'        => esc_html__( 'Typography', 'wolf-core' ),
					'param_name'   => 'typography',
					'selector'     => '{{WRAPPER}} .wolf-core-button',
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'text_shadow',
					'label'        => esc_html__( 'Text Shadow', 'wolf-core' ),
					'param_name'   => 'text_shadow',
					'selector'     => '{{WRAPPER}} .wolf-core-button',
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'group_tabs' => 'open',
					'name'       => 'icon_colors',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'tab'   => 'open',
					'name'  => 'normal',
					'label' => esc_html__( 'Normal', 'wolf-core' ),
					'group' => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'button_text_color',
					'label'      => esc_html__( 'Text Color', 'wolf-core' ),
					'type'       => 'colorpicker',
					'default'    => '',
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'background_color',
					'label'      => esc_html__( 'Background Color', 'wolf-core' ),
					'type'       => 'colorpicker',
					'default'    => wolf_core_get_theme_accent_color_value(),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-button' => 'background-color: {{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'tab'   => 'close',
					'group' => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'tab'   => 'open',
					'name'  => 'hover',
					'label' => esc_html__( 'Hover', 'wolf-core' ),
					'group' => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'hover_color',
					'label'      => esc_html__( 'Text Color', 'wolf-core' ),
					'type'       => 'colorpicker',
					'default'    => '',
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-button:hover, {{WRAPPER}} .wolf-core-button:focus' => 'color: {{VALUE}};',
						'{{WRAPPER}} .wolf-core-button:hover svg, {{WRAPPER}} .wolf-core-button:focus svg' => 'fill: {{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'button_background_hover_color',
					'label'      => esc_html__( 'Backgorund Color', 'wolf-core' ),
					'type'       => 'colorpicker',
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-button:hover, {{WRAPPER}} .wolf-core-button:focus' => 'background-color: {{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'button_hover_border_color',
					'label'      => __( 'Border Color', 'wolf-core' ),
					'type'       => 'colorpicker',
					'condition'  => array(
						'border_border!' => '',
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-button:hover, {{WRAPPER}} .wolf-core-button:focus' => 'border-color: {{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'       => 'hover_animation',
					'param_name' => 'hover_animation',
					'label'      => esc_html__( 'Hover Animation', 'wolf-core' ),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'tab'   => 'close',
					'group' => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'group_tabs' => 'close',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'border',
					'type'       => 'border',
					'label'      => esc_html__( 'Border', 'wolf-core' ),
					'selector'   => '{{WRAPPER}} .wolf-core-button',
					'separator'  => 'before',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'border_radius',
					'type'       => 'dimensions',
					'label'      => esc_html__( 'Border Radius', 'wolf-core' ),
					'size_units' => array( 'px', '%', 'em' ),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'button_box_shadow',
					'type'       => 'box_shadow',
					'label'      => esc_html__( 'Box Shadow', 'wolf-core' ),
					'selector'   => '{{WRAPPER}} .wolf-core-button',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name'         => 'text_padding',
					'responsive_control' => true,
					'type'               => 'dimensions',
					'label'              => esc_html__( 'Padding', 'wolf-core' ),
					'selectors'          => array(
						'{{WRAPPER}} .wolf-core-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'group'              => esc_html__( 'Style', 'wolf-core' ),
				),
			),
		)
	);
}
