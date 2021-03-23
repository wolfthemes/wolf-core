<?php
/**
 * Breadcrumb
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
function wolf_core_breadcrumb_params() {

	return apply_filters(
		'wolf_core_breadcrumb_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Breadcrumb', 'wolf-core' ),
				'description'   => esc_html__( 'A stylish presentation for your release', 'wolf-core' ),
				'vc_base'       => 'wolf_core_breadcrumb',
				'el_base'       => 'breadcrumb',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'dashicons-before dashicons-album',
			),

			'params'     => array(

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
						'{{WRAPPER}} .wolf-core-breadcrumb' => 'margin-{{VALUE}}: 0;',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'align',
					'options'      => array(
						'center' => esc_html__( 'Center', 'wolf-core' ),
						'left'   => esc_html__( 'Left', 'wolf-core' ),
						'right'  => esc_html__( 'Right', 'wolf-core' ),
					),
					'page_builder' => 'vc',
				),

				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Center Aligned on Mobile', 'wolf-core' ),
					'param_name'   => 'text_align_mobile',
					'label_on'     => esc_html__( 'Yes', 'wolf-core' ),
					'label_off'    => esc_html__( 'No', 'wolf-core' ),
					'return_value' => 'center',
					'default'      => 'center',
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Custom Font Size', 'wolf-core' ),
					'description' => esc_html__( 'It will overwrite the size setting above.', 'wolf-core' ),
					'param_name'  => 'font_size',
					'default'     => apply_filters( 'wolf_core_default_breadcrumb_font_size', '' ),
					'selectors'   => array(
						'{{WRAPPER}}' => 'font-size: {{VALUE}}px;',
					),
				),

				array(
					'type'        => 'font_weight',
					'label'       => esc_html__( 'Font Weight', 'wolf-core' ),
					'param_name'  => 'font_weight',
					'admin_label' => true,
					'default'     => apply_filters( 'wolf_core_default_breadcrumb_font_weight', '' ),
					'placeholder' => apply_filters( 'wolf_core_default_breadcrumb_font_weight', '700' ),
					'selectors'   => array(
						'{{WRAPPER}}' => 'font-weight: {{VALUE}};',
					),
					'default'     => apply_filters( 'wolf_core_default_breadcrumb_font_weight', '' ),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Text Transform', 'wolf-core' ),
					'param_name' => 'text_transform',
					'options'    => array(
						''          => esc_html__( 'Default', 'wolf-core' ),
						'none'      => esc_html__( 'None', 'wolf-core' ),
						'uppercase' => esc_html__( 'Uppercase', 'wolf-core' ),
						'lowercase' => esc_html__( 'Lowercase', 'wolf-core' ),
					),
					'selectors'  => array(
						'{{WRAPPER}}' => 'text-transform: {{VALUE}};',
					),
					'default'    => apply_filters( 'wolf_core_default_breadcrumb_text_transform', '' ),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Font Style', 'wolf-core' ),
					'param_name' => 'font_style',
					'options'    => array(
						''       => esc_html__( 'Default', 'wolf-core' ),
						'italic' => esc_html__( 'Italic', 'wolf-core' ),
					),
					'selectors'  => array(
						'{{WRAPPER}}' => 'font-style: {{VALUE}};',
					),
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Letter Spacing', 'wolf-core' ),
					'param_name'  => 'letter_spacing',
					'placeholder' => '0',
					'default'     => apply_filters( 'wolf_core_default_breadcrumb_letter_spacing', '' ),
					'selectors'   => array(
						'{{WRAPPER}} .wolf-core-breadcrumb' => 'letter-spacing: {{VALUE}};',
					),
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Line Height', 'wolf-core' ),
					'param_name'  => 'line_height',
					'placeholder' => '1',
					'selectors'   => array(
						'{{WRAPPER}} .wolf-core-breadcrumb' => 'line-height: {{VALUE}};px',
					),
				),
			),
		)
	);
}
