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
				'keywords'      => array( 'map', 'embed' ),
				'icon'          => 'linea-basic linea-basic-geolocalize-05',
				'scripts'       => array( 'jquery', 'google-maps-api', 'wolf-core-google-maps' ),
			),
			'params'     => array(

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Map Type', 'wolf-core' ),
					'param_name'  => 'type',
					'options'     => array(
						'default'  => esc_html__( 'Default', 'wolf-core' ),
						'simple'   => esc_html__( 'Simple', 'wolf-core' ),
						'multiple' => esc_html__( 'Muliple locations', 'wolf-core' ),
					),
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Address', 'wolf-core' ),
					'param_name'  => 'address',
					'admin_label' => true,
					'placeholder' => $default_address,
					'default'     => $default_address,
					'label_block' => true,
					'condition'   => array(
						'type' => array( 'default' ),
					),
				),

				array(
					'type'       => 'repeater',
					'param_name' => 'locations',
					'label'      => esc_html__( 'Locations', 'wolf-core' ),
					'params'     => array(
						array(
							'param_name' => 'name',
							'label'      => esc_html__( 'Name', 'wolf-core' ),
						),
						array(
							'param_name' => 'coordinates',
							'label'      => esc_html__( 'Coordinates', 'wolf-core' ),
						),
					),
					'defaults'   => array(
						array(
							'name'        => esc_html__( 'Location name', 'wolf-core' ),
							'coordinates' => '',
						),
						array(
							'name'        => esc_html__( 'Location name', 'wolf-core' ),
							'coordinates' => '',
						),
					),
					'condition'  => array(
						'type' => array( 'multiple' ),
					),

				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Location name', 'wolf-core' ),
					'param_name'  => 'name',
					'admin_label' => true,
					'placeholder' => $default_address,
					'default'     => $default_address,
					'label_block' => true,
					'condition'   => array(
						'type' => array( 'simple' ),
					),
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Coordinates', 'wolf-core' ),
					'param_name'  => 'coordinates',
					'default'     => '48.58212406669087, 7.750927801893993',
					'admin_label' => true,
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
					'condition'   => array(
						'type' => array( 'simple', 'multiple' ),
					),
				),

				array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Custom code', 'wolf-core' ),
					'param_name'  => 'custom_map_skin',
					'description' => sprintf( wolf_core_kses( __( 'You can get a custom code from <a href="%s" target="_blank">https://snazzymaps.com</a> and paste it here', 'wolf-core' ) ), 'https://snazzymaps.com/' ),
					'condition'   => array(
						'map_skin' => array( 'custom' ),
						'type'     => array( 'simple', 'multiple' ),
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
					'default'      => '400px',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'text',
					'label'        => esc_html__( 'Map height', 'wolf-core' ),
					'param_name'   => 'size',
					'default'      => '400px',
					'admin_label'  => true,
					'page_builder' => 'vc',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Marker Type', 'wolf-visual-composer' ),
					'param_name' => 'marker',
					'options'    => array(
						'default' => esc_html__( 'Standard', 'wolf-visual-composer' ),
						'custom'  => esc_html__( 'Custom Image', 'wolf-visual-composer' ),
					),
					'std'        => 'default',
				),

				array(
					'type'        => 'image',
					'label'       => esc_html__( 'Image', 'wolf-visual-composer' ),
					'param_name'  => 'marker_img',
					'value'       => '',
					'description' => esc_html__( 'Select image from media library.', 'wolf-visual-composer' ),
					'condition'   => array(
						'marker' => array( 'custom' ),
					),
				),

				array(
					'type'               => 'select',
					'label'              => esc_html__( 'Marker Color', 'wolf-visual-composer' ),
					'param_name'         => 'marker_color',
					'options'            => array_merge(
						array( 'default' => esc_html__( 'Default color', 'wolf-visual-composer' ) ),
						wolf_core_get_shared_colors(),
						array( 'custom' => esc_html__( 'Custom color', 'wolf-visual-composer' ) )
					),
					'std'                => 'default',
					'description'        => esc_html__( 'Select a marker color.', 'wolf-visual-composer' ),
					'param_holder_class' => 'wolf_core_colored-select',
					'condition'          => array(
						'marker' => array( 'default' ),
					),
					'page_builder'       => 'vc',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Marker Custom Color', 'wolf-visual-composer' ),
					'param_name'   => 'marker_custom_color',
					'condition'    => array(
						'marker_color' => 'custom',
					),
					'page_builder' => 'vc',
				),

				/* Elementor color */
				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Marker Color', 'wolf-visual-composer' ),
					'param_name'   => 'marker_color',
					'options'      => array_merge(
						array( 'default' => esc_html__( 'Default color', 'wolf-visual-composer' ) ),
						wolf_core_get_shared_colors(),
						array( 'custom' => esc_html__( 'Custom color', 'wolf-visual-composer' ) )
					),
					'default'      => 'accent',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Marker Color', 'wolf-visual-composer' ),
					'param_name'   => 'marker_custom_color',
					'page_builder' => 'elementor',
					'condition'    => array(
						'marker_color' => array( 'custom' ),
					),
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
