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
					'label'        => esc_html__( 'Type', 'elementor' ),
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
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'align',
					'type'         => 'choose',
					'options'      => array(
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
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-icon-container' => 'text-align: {{VALUE}}!important;',
					),
					'page_builder' => 'wolf-core',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
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
						'{{WRAPPER}} .wolf-core-button .wolf-core-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .wolf-core-button .wolf-core-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					),
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
					'tab'   => 'close',
					'group' => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'group_tabs' => 'close',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),
			),
		)
	);
}
