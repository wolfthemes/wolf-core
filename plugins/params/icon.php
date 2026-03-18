<?php
/**
 * Icon
 *
 * Overwite default icon widget to add funcitonalities
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
function wolf_core_icon_params() {

	return apply_filters(
		'wolf_core_icon_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Icon', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'vc_icon',
				'vc_category'   => esc_html__( 'Basic', 'wolf-core' ),
				'el_categories' => array( 'basic' ),
				'el_base'       => 'icon',
				'keywords'      => array( 'icon' ),
				'icon'          => 'linea-basic linea-basic-star',
				'scripts'       => array( 'jquery', 'wolf-core-icon' ),
			),
			'params'     => array(

				array(
					'param_name'  => 'media_type', // change this!
					'type'        => 'select',
					'label'       => esc_html__( 'Icon Type', 'wolf-core' ),
					'options'     => array(
						'icon'          => esc_html__( 'Simple', 'wolf-core' ),
						'animated_icon' => esc_html__( 'Animated', 'wolf-core' ),
					),
					'admin_label' => true,

					'default'     => 'icon',
				),

				array(
					'param_name'  => 'selected_icon',
					'type'        => 'icon',
					'label'       => esc_html__( 'Icon', 'wolf-core' ),
					'admin_label' => true,
					'default'     => array(
						'value'   => apply_filters( 'wolf_core_default_icon', 'fa fa-rocket' ),
						'library' => apply_filters( 'wolf_core_default_icon_font', 'fontawesome' ),
					),
					'condition'   => array(
						'media_type' => 'icon',
					),
				),

				array(
					'param_name'  => 'animated_icon',
					'type'        => 'animated_icon',
					'label'       => esc_html__( 'Icon', 'wolf-core' ),
					'admin_label' => true,
					'default'     => array(
						'value'   => apply_filters( 'wolf_core_default_icon', 'fa fa-rocket' ),
						'library' => apply_filters( 'wolf_core_default_icon_font', 'fontawesome' ),
					),
					'condition'   => array(
						'media_type' => 'animated_icon',
					),
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'View', 'wolf-core' ),
					'options'      => array(
						'default' => esc_html__( 'Default', 'wolf-core' ),
						'stacked' => esc_html__( 'Stacked', 'wolf-core' ),
						'framed'  => esc_html__( 'Framed', 'wolf-core' ),
					),
					'admin_label'  => true,
					'param_name'   => 'view',
					'prefix_class' => 'wolf-core-icon-view-',
				),

				array(
					'type'          => 'select',
					'param_name'    => 'shape',
					'label'         => esc_html__( 'Shape', 'wolf-core' ),
					'options'       => array(
						'circle' => esc_html__( 'Circle', 'wolf-core' ),
						'square' => esc_html__( 'Square', 'wolf-core' ),
					),
					'condition'     => array(
						'view!'                 => 'default',
						'selected_icon[value]!' => '',
					),
					'vc_dependency' => array(
						'element'            => 'view',
						'value_not_equal_to' => array( 'default' ),
					),
					'admin_label'   => true,
					'prefix_class'  => 'wolf-core-icon-shape-',
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Link', 'wolf-core' ),
					'param_name' => 'link',
				),

				array(
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'align',
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
						'{{WRAPPER}} .wolf-core-icon-container' => 'text-align: {{VALUE}}!important;',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'align',
					'options'      => array(
						'left'   => esc_html__( 'Left', 'wolf-core' ),
						'center' => esc_html__( 'Center', 'wolf-core' ),
						'right'  => esc_html__( 'Right', 'wolf-core' ),
					),
					'page_builder' => 'vc',
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
					'type'       => 'colorpicker',
					'label'      => esc_html__( 'Primary Color', 'wolf-core' ),
					'param_name' => 'primary_color',
					'selectors'  => array(
						'{{WRAPPER}}.wolf-core-icon-view-stacked .wolf-core-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.wolf-core-icon-view-framed .wolf-core-icon, {{WRAPPER}}.wolf-core-icon-view-default .wolf-core-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
						'{{WRAPPER}}.wolf-core-icon-view-framed .wolf-core-icon, {{WRAPPER}}.wolf-core-icon-view-default .wolf-core-icon svg' => 'fill: {{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'          => 'colorpicker',
					'label'         => esc_html__( 'Secondary Color', 'wolf-core' ),
					'param_name'    => 'secondary_color',
					'selectors'     => array(
						'{{WRAPPER}}.wolf-core-icon-view-framed .wolf-core-icon' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.wolf-core-icon-view-stacked .wolf-core-icon' => 'color: {{VALUE}};',
						'{{WRAPPER}}.wolf-core-icon-view-stacked .wolf-core-icon svg' => 'fill: {{VALUE}};',
					),
					'condition'     => array(
						'view!' => 'default',
					),
					'vc_dependency' => array(
						'element'            => 'view',
						'value_not_equal_to' => array( 'default' ),
					),
					'group'         => esc_html__( 'Style', 'wolf-core' ),
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
					'type'       => 'colorpicker',
					'label'      => esc_html__( 'Primary Color', 'wolf-core' ),
					'param_name' => 'hover_primary_color',
					'selectors'  => array(
						'{{WRAPPER}}.wolf-core-icon-view-stacked .wolf-core-icon:hover' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.wolf-core-icon-view-framed .wolf-core-icon:hover, {{WRAPPER}}.wolf-core-icon-view-default .wolf-core-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
						'{{WRAPPER}}.wolf-core-icon-view-framed .wolf-core-icon:hover, {{WRAPPER}}.wolf-core-icon-view-default .wolf-core-icon:hover svg' => 'fill: {{VALUE}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'          => 'colorpicker',
					'label'         => esc_html__( 'Secondary Color', 'wolf-core' ),
					'param_name'    => 'hover_secondary_color',
					'selectors'     => array(
						'{{WRAPPER}}.wolf-core-icon-view-framed .wolf-core-icon:hover' => 'background-color: {{VALUE}};',
						'{{WRAPPER}}.wolf-core-icon-view-stacked .wolf-core-icon:hover' => 'color: {{VALUE}};',
						'{{WRAPPER}}.wolf-core-icon-view-stacked .wolf-core-icon:hover svg' => 'fill: {{VALUE}};',
					),
					'condition'     => array(
						'view!' => 'default',
					),
					'vc_dependency' => array(
						'element'            => 'view',
						'value_not_equal_to' => array( 'default' ),
					),
					'group'         => esc_html__( 'Style', 'wolf-core' ),
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
					'param_name'         => 'size',
					'type'               => 'slider',
					'responsive_control' => true,
					'label'              => esc_html__( 'Size', 'wolf-core' ),
					'range'              => array(
						'px' => array(
							'min' => 6,
							'max' => 300,
						),
					),
					'selectors'          => array(
						'{{WRAPPER}} .wolf-core-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					),
					'separator'          => 'before',
					'group'              => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'padding',
					'type'       => 'slider',
					'label'      => esc_html__( 'Padding', 'wolf-core' ),
					'range'      => array(
						'em' => array(
							'min' => 0,
							'max' => 5,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-icon' => 'padding: {{SIZE}}{{UNIT}};',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name'         => 'rotate',
					'type'               => 'slider',
					'responsive_control' => true,
					'label'              => esc_html__( 'Rotate', 'wolf-core' ),
					'default'            => array(
						'size' => 0,
						'unit' => 'deg',
					),
					'tablet_default'     => array(
						'unit' => 'deg',
					),
					'mobile_default'     => array(
						'unit' => 'deg',
					),
					'selectors'          => array(
						'{{WRAPPER}} .wolf-core-icon i, {{WRAPPER}} .wolf-core-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
					),
					'separator'          => 'before',
					'group'              => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'border_width',
					'type'       => 'dimensions',
					'label'      => esc_html__( 'Border Width', 'wolf-core' ),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'view' => 'framed',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'param_name' => 'border_radius',
					'type'       => 'dimensions',
					'label'      => esc_html__( 'Border Radius', 'wolf-core' ),
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'view' => 'framed',
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),
			),
		)
	);
}
