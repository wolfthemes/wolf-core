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
			// Not used as we will add our params to the existing heading widget.
			'properties' => array(
				'name'        => esc_html__( 'Heading', 'wolf-core' ),
				'description' => esc_html__( 'A big title with flexible font size', 'wolf-core' ),
				'el_base'     => 'custom-heading',
				'icon'        => 'fa fa-text-width',
			),
			'params'     => array(
				/*
				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Center Aligned on Mobile', 'wolf-core' ),
					'param_name'   => 'text_align_mobile',
					'return_value' => 'center',
					'default'      => 'center',
				),*/

				// array(
				// 'type'         => 'select',
				// 'label'        => esc_html__( 'Size', 'wolf-core' ),
				// 'param_name'   => 'size',
				// 'options'      => array(
				// 'default' => esc_html__( 'Default', 'wolf-core' ),
				// 'small'   => esc_html__( 'Small', 'wolf-core' ),
				// 'medium'  => esc_html__( 'Medium', 'wolf-core' ),
				// 'large'   => esc_html__( 'Large', 'wolf-core' ),
				// 'xl'      => esc_html__( 'XL', 'wolf-core' ),
				// 'xxl'     => esc_html__( 'XXL', 'wolf-core' ),
				// 'custom'  => esc_html__( 'Custom', 'wolf-core' ),
				// ),
				// 'default'      => 'default',
				// 'page_builder' => 'vc',
				// ),

				array(
					'type'         => 'text',
					'label'        => esc_html__( 'Custom Font Size', 'wolf-core' ),
					'description'  => esc_html__( 'It will overwrite the size setting above.', 'wolf-core' ),
					'param_name'   => 'font_size',
					'default'      => apply_filters( 'wolf_core_default_heading_font_size', 48 ),
					'selectors'    => array(
						'{{WRAPPER}}' => 'font-size: {{VALUE}}px;',
					),
					'condition'    => array(
						'size' => 'custom',
					),
					'page_builder' => 'vc',
				),

				/*
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Behavior', 'wolf-core' ),
					'param_name' => 'responsive',
					'options'    => array(
						'no'  => esc_html__( 'Static', 'wolf-core' ),
						'yes' => esc_html__( 'Responsive', 'wolf-core' ),
					),
					'default'    => 'no',
				),*/

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Extra Class', 'wolf-core' ),
					'param_name' => 'extra_class',
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
					'type'         => 'font_family',
					'label'        => esc_html__( 'Font', 'wolf-core' ),
					'param_name'   => 'font_family',
					'admin_label'  => true,
					'default'      => apply_filters( 'wolf_core_default_heading_font_family', '' ),
					'selectors'    => array(
						'{{WRAPPER}} .elementor-heading-title' => 'font-family: {{VALUE}};',
					),
					'page_builder' => 'vc',
				),

				array(
					'type'         => 'font_weight',
					'label'        => esc_html__( 'Font Weight', 'wolf-core' ),
					'param_name'   => 'font_weight',
					'admin_label'  => true,
					'default'      => apply_filters( 'wolf_core_default_heading_font_weight', '' ),
					'placeholder'  => apply_filters( 'wolf_core_default_heading_font_weight', '700' ),
					'selectors'    => array(
						'{{WRAPPER}}' => 'font-weight: {{VALUE}};',
					),
					'page_builder' => 'vc',
				),
				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Text Transform', 'wolf-core' ),
					'param_name'   => 'text_transform',
					'options'      => array(
						''          => esc_html__( 'Default', 'wolf-core' ),
						'none'      => esc_html__( 'None', 'wolf-core' ),
						'uppercase' => esc_html__( 'Uppercase', 'wolf-core' ),
						'lowercase' => esc_html__( 'Lowercase', 'wolf-core' ),
					),
					'selectors'    => array(
						'{{WRAPPER}}' => 'text-transform: {{VALUE}};',
					),
					'page_builder' => 'vc',
				),
				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Font Style', 'wolf-core' ),
					'param_name'   => 'font_style',
					'options'      => array(
						''       => esc_html__( 'Default', 'wolf-core' ),
						'italic' => esc_html__( 'Italic', 'wolf-core' ),
					),
					'selectors'    => array(
						'{{WRAPPER}}' => 'font-style: {{VALUE}};',
					),
					'page_builder' => 'vc',
				),
				array(
					'type'         => 'text',
					'label'        => esc_html__( 'Letter Spacing', 'wolf-core' ),
					'param_name'   => 'letter_spacing',
					'placeholder'  => '0',
					'default'      => apply_filters( 'wolf_core_default_heading_letter_spacing', '' ),
					'selectors'    => array(
						'{{WRAPPER}} .elementor-heading-title' => 'letter-spacing: {{VALUE}};',
					),
					'page_builder' => 'vc',
				),
				array(
					'type'         => 'text',
					'label'        => esc_html__( 'Line Height', 'wolf-core' ),
					'param_name'   => 'line_height',
					'placeholder'  => '1',
					'selectors'    => array(
						'{{WRAPPER}} .elementor-heading-title' => 'line-height: {{VALUE}};px',
					),
					'page_builder' => 'vc',
				),

				array(
					'type'               => 'select',
					'label'              => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'         => 'color',
					'options'            => array_merge(
						wolf_core_get_shared_colors(),
						array(
							'default'        => esc_html__( 'Default color', 'wolf-core' ),
							'gradient-red'   => esc_html__( 'Gradient Red', 'wolf-core' ),
							'gradient-green' => esc_html__( 'Gradient Green', 'wolf-core' ),
							'custom'         => esc_html__( 'Custom color', 'wolf-core' ),
						)
					),
					'default'            => 'default',
					'description'        => esc_html__( 'Select a text color.', 'wolf-core' ),
					'param_holder_class' => 'wolf_core_colored-select',
					'page_builder'       => 'vc',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'custom_color',
					'condition'    => array(
						'color' > 'custom',
					),
					'page_builder' => 'vc',
				),
			),
		)
	);
}
