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
				'name'          => esc_html__( 'icon', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'vc_icon',
				'vc_category'   => esc_html__( 'Basic', 'wolf-core' ),
				'el_categories' => array( 'basic' ),
				'el_base'       => 'icon',
				'keywords'      => array( 'icon' ),
				'icon'          => 'fa fa-rocket',

				'params'        => array(

					array(
						'type'        => 'select',
						'label'       => esc_html__( 'Icon Type', 'wolf-visual-composer' ),
						'options'     => array(
							'icon'          => esc_html__( 'Icon', 'wolf-visual-composer' ),
							'animated_icon' => esc_html__( 'Animated Icon', 'wolf-visual-composer' ),
							// esc_html__( 'Image', 'wolf-visual-composer' ) => 'image',
						),
						'admin_label' => true,
						'param_name'  => 'media_type', // change this!
						'default'     => 'icon',
					),

					array(
						'type'        => 'icon',
						'label'       => esc_html__( 'Icon', 'wolf-visual-composer' ),
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
						'label'       => esc_html__( 'View', 'wolf-visual-composer' ),
						'options'     => array(
							'default' => esc_html__( 'Default', 'wolf-visual-composer' ),
							'stacked' => esc_html__( 'Stacked', 'wolf-visual-composer' ),
							'framed'  => esc_html__( 'Framed', 'wolf-visual-composer' ),
						),
						'admin_label' => true,
						'param_name'  => 'view',
					),

					array(
						'type'          => 'select',
						'param_name'    => 'shape',
						'label'         => esc_html__( 'Shape', 'wolf-visual-composer' ),
						'options'       => array(
							'circle' => esc_html__( 'Circle', 'wolf-visual-composer' ),
							'square' => esc_html__( 'Square', 'wolf-visual-composer' ),
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
				),
			),
		)
	);
}
