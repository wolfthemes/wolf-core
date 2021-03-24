<?php
/**
 * Big Text
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
function wolf_core_bigtext_params() {

	return apply_filters(
		'wolf_core_bigtext_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Big Text', 'wolf-core' ),
				'description'   => esc_html__( 'A big line of text that will take the full width of its container.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_bigtext',
				'vc_category'   => esc_html__( 'Typography', 'wolf-core' ),
				'el_categories' => array( 'music' ),
				'el_base'       => 'bigtext',
				'icon'          => 'fa fa-text-width',
			),
			'params'     => array(
				array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Text', 'wolf-core' ),
					'param_name'  => 'text',
					'default'     => esc_html__( 'My mega big text', 'wolf-core' ),
					'admin_label' => true,
					'description' => esc_html__( 'You can add several lines of text.', 'wolf-core' ) . '
	' . sprintf( esc_html__( 'You can use the %s short tag to display the current page title.', 'wolf-core' ), '{{post_title}}' ),
				),

				// array(
				// 'type' => 'select',
				// 'label' => esc_html__( 'Text Color', 'wolf-core' ),
				// 'param_name' => 'color',
				// 'value' => array_merge( wolf_core_get_shared_colors(), array(
				// esc_html__( 'Default color', 'wolf-core' ) => 'default',
				// esc_html__( 'Gradient Red', 'wolf-core' ) => 'gradient-red',
				// esc_html__( 'Gradient Green', 'wolf-core' ) => 'gradient-green',
				// esc_html__( 'Custom color', 'wolf-core' ) => 'custom',
				// )
				// ),
				// 'default' => 'default',
				// 'description' => esc_html__( 'Select a text color.', 'wolf-core' ),
				// 'param_holder_class' => 'wolf_core_colored-select',
				// ),

				// array(
				// 'type' => 'colorpicker',
				// 'label' => esc_html__( 'Text Color', 'wolf-core' ),
				// 'param_name' => 'custom_color',
				// 'dependency' => array(
				// 'element' => 'color',
				// 'value' => 'custom',
				// ),
				// ),

				array(
					'type'        => 'font_weight',
					'label'       => esc_html__( 'Font Weight', 'wolf-core' ),
					'param_name'  => 'font_weight',
					'admin_label' => true,
					'default'     => apply_filters( 'wolf_core_default_heading_font_weight', '' ),
					'placeholder' => apply_filters( 'wolf_core_default_heading_font_weight', '700' ),
					'selectors'   => array(
						'{{WRAPPER}} .wolf-core-bigtext' => 'font-weight: {{VALUE}}!important;',
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
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-bigtext' => 'text-transform: {{VALUE}}!important;',
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
					'selectors'  => array(
						'{{WRAPPER}} .wolf-core-bigtext' => 'font-style: {{VALUE}};',
					),
				),

				array(
					'type'        => 'font_family',
					'label'       => esc_html__( 'Font', 'wolf-core' ),
					'param_name'  => 'font_family',
					'admin_label' => true,
					'default'     => apply_filters( 'wolf_core_default_heading_font_family', '' ),
					'selectors'   => array(
						'{{WRAPPER}} .wolf-core-bigtext' => 'font-family: {{VALUE}}!important;',
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'HTML Tag', 'wolf-core' ),
					'param_name' => 'title_tag',
					'options'    => array(
						'h2' => 'h2',
						'p'  => 'p',
						'h5' => 'h5',
						'h4' => 'h4',
						'h3' => 'h3',
						'h1' => 'h1',
					),
				),

				array(
					'type'        => 'link',
					'label'       => esc_html__( 'Link', 'wolf-core' ),
					'param_name'  => 'link',
					'placeholder' => 'http://',
				),
			),
		)
	);
}
