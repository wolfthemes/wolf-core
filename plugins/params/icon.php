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
				'icon'          => 'fa fa-rocket',
				'scripts'       => array( 'jquery' ),
			),
			'params'     => array(

				array(
					'param_name'  => 'media_type', // change this!
					'type'        => 'select',
					'label'       => esc_html__( 'Icon Type', 'wolf-core' ),
					'options'     => array(
						'icon'          => esc_html__( 'Icon', 'wolf-core' ),
						'animated_icon' => esc_html__( 'Animated Icon', 'wolf-core' ),
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
					'type'        => 'select',
					'label'       => esc_html__( 'View', 'wolf-core' ),
					'options'     => array(
						'default' => esc_html__( 'Default', 'wolf-core' ),
						'stacked' => esc_html__( 'Stacked', 'wolf-core' ),
						'framed'  => esc_html__( 'Framed', 'wolf-core' ),
					),
					'admin_label' => true,
					'param_name'  => 'view',
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
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Link', 'wolf-core' ),
					'param_name' => 'link',
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
						'{{WRAPPER}} .elementor-icon-wrapper' => 'text-align: {{VALUE}};',
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
			),
		)
	);
}
