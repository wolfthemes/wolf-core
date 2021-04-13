<?php
/**
 * Google Maps
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
function wolf_core_google_maps_params() {

	$default_address = esc_html__( 'Notre Dame de Strasbourg', 'wolf-core' );

	return apply_filters(
		'wolf_core_google_maps_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Google Maps', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_google_maps',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'google_maps',
				'icon'          => 'fa fa-map-marker',
				'scripts'       => array(),
			),
			'params'     => array(

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Map Type', 'wolf-core' ),
					'param_name'  => 'type',
					'options'     => array(
						'simple'   => esc_html__( 'Simple', 'wolf-core' ),
						'multiple' => esc_html__( 'Muliple locations', 'wolf-core' ),
					),
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'heading'     => esc_html__( 'Address', 'wolf-core' ),
					'param_name'  => 'address',
					'admin_label' => true,
					'placeholder' => $default_address,
					'default'     => $default_address,
					'label_block' => true,
					'condition'   => array(
						'type' => array( 'simple' ),
					),
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Skin', 'wolf-core' ),
					'param_name'  => 'map_skin',
					'options'     => array(
						'standard'       => esc_html__( 'Standard', 'wolf-core' ),
						// 'accent'       => esc_html__( 'Theme Accent Color', 'wolf-core' ),
						'silver'         => esc_html__( 'Light', 'wolf-core' ),
						'retro'          => esc_html__( 'Retro', 'wolf-core' ),
						'dark'           => esc_html__( 'Dark', 'wolf-core' ),
						'night'          => esc_html__( 'Night', 'wolf-core' ),
						'aubergine'      => esc_html__( 'Aubergine', 'wolf-core' ),
						'ultra_light'    => esc_html__( 'Ultra Light with Labels', 'wolf-core' ),
						'shades_of_grey' => esc_html__( 'Shades of Grey', 'wolf-core' ),
						'cool_grey'      => esc_html__( 'Cool Grey', 'wolf-core' ),
						'pale_dawn'      => esc_html__( 'Pale Dawn', 'wolf-core' ),
						'map'            => esc_html__( 'Medium Green', 'wolf-core' ),
						'custom'         => esc_html__( 'Custom', 'wolf-core' ),
					),
					'admin_label' => true,
				),

				array(
					'type'        => 'textarea_raw_html',
					'label'       => esc_html__( 'Custom code', 'wolf-core' ),
					'param_name'  => 'custom_map_skin',
					'description' => sprintf( wolf_core_kses( __( 'You can get a custom code from <a href="%s" target="_blank">https://snazzymaps.com</a> and paste it here', 'wolf-core' ) ), 'https://snazzymaps.com/' ),
					'condition'   => array(
						'map_skin' => array( 'custom' ),
					),
				),

				array(
					'type'       => 'slider',
					'label'      => esc_html__( 'Zoom', 'wolf-core' ),
					'param_name' => 'zoom',
					'min'        => 1,
					'max'        => 20,
					'step'       => 1,
					'default'    => 10,
				),

				array(
					'type'         => 'text',
					'label'        => esc_html__( 'Map height', 'wolf-core' ),
					'param_name'   => 'height',
					'default'      => '500px',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'text',
					'label'        => esc_html__( 'Map height', 'wolf-core' ),
					'param_name'   => 'size',
					'default'      => '500px',
					'admin_label'  => true,
					'page_builder' => 'vc',
				),

				/* Elementor CSS filters */
				array(
					'group_tabs' => 'open',
					'name'       => 'map_filter',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'tab'   => 'open',
					'name'  => 'normal',
					'label' => esc_html__( 'Normal', 'wolf-core' ),
					'group' => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'       => 'css_filters',
					'param_name' => 'css_filters',
					'selector'   => '{{WRAPPER}}:hover iframe',
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
					'type'       => 'css_filters',
					'param_name' => 'css_filters_hover',
					'selector'   => '{{WRAPPER}}:hover iframe',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'label'      => esc_html__( 'Transition Duration', 'wolf-core' ),
					'type'       => 'slider',
					'param_name' => 'hover_transition',
					'range'      => array(
						'px' => array(
							'max'  => 3,
							'step' => 0.1,
						),
					),
					'selectors'  => array(
						'{{WRAPPER}} iframe' => 'transition-duration: {{SIZE}}s',
					),
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
			),
		)
	);
}
