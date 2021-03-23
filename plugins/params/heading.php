<?php
/**
 * Heading (Elementor Heading)
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
function wolf_core_heading_params() {

	return apply_filters(
		'wolf_core_heading_params',
		array(
			// Not used as we will add our params to the existing heading widget
			'properties' => array(
				'name'        => esc_html__( 'Heading', 'wolf-core' ),
				'description' => esc_html__( 'A big title with flexible font size', 'wolf-core' ),
				'el_base'     => 'custom-heading',
				'icon'        => 'fa fa-text-width',
			),
			'params'     => array(
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
					'default'     => apply_filters( 'wolf_core_default_heading_font_size', 48 ),
					'selectors'    => array(
						'{{WRAPPER}}' => 'font-size: {{VALUE}}px;',
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Behavior', 'wolf-core' ),
					'param_name' => 'responsive',
					'options'    => array(
						'no'  => esc_html__( 'Static', 'wolf-core' ),
						'yes' => esc_html__( 'Responsive', 'wolf-core' ),
					),
					'default'    => 'no',
				),
				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Minimum Font Size', 'wolf-core' ),
					'param_name' => 'min_font_size',
					'default'    => 18,
					'condition'  => array(
						'responsive' => 'yes',
					),
				),
				array(
					'type'        => 'font_family',
					'label'       => esc_html__( 'Font', 'wolf-core' ),
					'param_name'  => 'font_family',
					'admin_label' => true,
					'default'     => apply_filters( 'wolf_core_default_heading_font_family', '' ),
					'selectors'    => array(
						'{{WRAPPER}} .elementor-heading-title' => 'font-family: {{VALUE}};',
					),
				),

				array(
					'type'        => 'font_weight',
					'label'       => esc_html__( 'Font Weight', 'wolf-core' ),
					'param_name'  => 'font_weight',
					'admin_label' => true,
					'default'     => apply_filters( 'wolf_core_default_heading_font_weight', '' ),
					'placeholder' => apply_filters( 'wolf_core_default_heading_font_weight', '700' ),
					'selectors'    => array(
						'{{WRAPPER}}' => 'font-weight: {{VALUE}};',
					),
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
					'selectors'    => array(
						'{{WRAPPER}}' => 'text-transform: {{VALUE}};',
					),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Font Style', 'wolf-core' ),
					'param_name' => 'font_style',
					'options'    => array(
						''       => esc_html__( 'Default', 'wolf-core' ),
						'italic' => esc_html__( 'Italic', 'wolf-core' ),
					),
					'selectors'    => array(
						'{{WRAPPER}}' => 'font-style: {{VALUE}};',
					),
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Letter Spacing', 'wolf-core' ),
					'param_name'  => 'letter_spacing',
					'placeholder' => '0',
					'default'     => apply_filters( 'wolf_core_default_heading_letter_spacing', '' ),
					'selectors'    => array(
						'{{WRAPPER}} .elementor-heading-title' => 'letter-spacing: {{VALUE}};',
					),
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Line Height', 'wolf-core' ),
					'param_name'  => 'line_height',
					'placeholder' => '1',
					'selectors'    => array(
						'{{WRAPPER}} .elementor-heading-title' => 'line-height: {{VALUE}};px',
					),
				),
			),
		)
	);
}
