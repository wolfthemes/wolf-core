<?php
/**
 * Bandsintown Tracking Button
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
function wolf_core_bandsintown_tracking_button_params() {

	return apply_filters(
		'wolf_core_bandsintown_tracking_button_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Bandsintown Tracking Button', 'wolf-core' ),
				'description'   => esc_html__( 'Display your Bandsintown Tracking Button', 'wolf-core' ),
				'vc_base'       => 'wolf_core_bandsintown_tracking_button',
				'el_base'       => 'bandsintown-tracking-button',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'fa wolficon-bandsintown',
			),

			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Artist Name', 'wolf-core' ),
					'param_name'  => 'artist',
					'admin_label' => true,
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Size', 'wolf-core' ),
					'param_name'  => 'size',
					'options'     => array(
						'large' => esc_html__( 'Large', 'wolf-core' ),
						'small' => esc_html__( 'Small', 'wolf-core' ),
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
						'{{WRAPPER}} .wolf-core-bandwintown-tracking-button iframe' => 'margin-{{VALUE}}: 0;',
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

				// array(
				// 'type'               => 'select',
				// 'label'              => esc_html__( 'Background Color', 'wolf-core' ),
				// 'param_name'         => 'background_color',
				// 'options'            => array_merge(
				// wolf_core_get_shared_colors(),
				// array(
				// esc_html__( 'Default', 'wolf-core' ) => 'default',
				// esc_html__( 'Custom color', 'wolf-core' ) => 'custom',
				// )
				// ),
				// 'std'                => 'default',
				// 'description'        => esc_html__( 'Select a background color.', 'wolf-core' ),
				// 'param_holder_class' => 'wolf_core_colored-dropdown',
				// ),

				// array(
				// 'type'       => 'colorpicker',
				// 'label'      => esc_html__( 'Background Color', 'wolf-core' ),
				// 'param_name' => 'background_custom_color',
				// 'condition'  => array(
				// 'element' => 'background_color',
				// 'value'   => 'custom',
				// ),
				// ),

				// array(
				// 'type'               => 'select',
				// 'label'              => esc_html__( 'Text Color', 'wolf-core' ),
				// 'param_name'         => 'text_color',
				// 'options'            => array_merge(
				// wolf_core_get_shared_colors(),
				// array(
				// esc_html__( 'Default', 'wolf-core' ) => 'default',
				// esc_html__( 'Custom color', 'wolf-core' ) => 'custom',
				// )
				// ),
				// 'std'                => 'default',
				// 'description'        => esc_html__( 'Select a background color.', 'wolf-core' ),
				// 'param_holder_class' => 'wolf_core_colored-dropdown',
				// ),

				// array(
				// 'type'       => 'colorpicker',
				// 'label'      => esc_html__( 'Text Color', 'wolf-core' ),
				// 'param_name' => 'text_custom_color',
				// 'condition'  => array(
				// 'element' => 'text_color',
				// 'value'   => 'custom',
				// ),
				// ),

			),
		)
	);
}
