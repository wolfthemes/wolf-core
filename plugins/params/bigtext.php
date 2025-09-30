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
				'el_categories' => array( 'extension' ),
				'keywords'      => array( 'text', 'typography' ),
				'el_base'       => 'bigtext',
				'icon'          => 'linea-software linea-software-font-horizontal-scale',
				'scripts'       => array( 'jquery', 'bigtext', 'wolf-core-bigtext' ),
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

				/* Text Color for VC */
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
					'description'        => esc_html__( 'Select a text color.', 'wolf-core' ),
					'param_holder_class' => 'wolf_core_colored-select',
					'group'              => esc_html__( 'Style', 'wolf-core' ),
					'page_builder'       => 'vc',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Custom Color', 'wolf-core' ),
					'param_name'   => 'custom_color',
					'condition'    => array(
						'color' > 'custom',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
					'page_builder' => 'vc',
				),

				/* Text Color for Elementor in Style tab */
				array(
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'type'         => 'hidden',
					'param_name'   => 'color',
					'default'      => 'custom',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'custom_color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-bigtext' => 'color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				/* Typography Group controls for Elementor */
				array(
					'type'         => 'typography',
					'label'        => esc_html__( 'Typography', 'wolf-core' ),
					'param_name'   => 'typography',
					'selector'     => '{{WRAPPER}} .wolf-core-bigtext',
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				/* Typography Settings for VC */
				array(
					'type'         => 'font_weight',
					'label'        => esc_html__( 'Font Weight', 'wolf-core' ),
					'param_name'   => 'font_weight',
					'admin_label'  => true,
					'default'      => apply_filters( 'wolf_core_default_heading_font_weight', '' ),
					'placeholder'  => apply_filters( 'wolf_core_default_heading_font_weight', '700' ),
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
						'{{WRAPPER}} .wolf-core-bigtext' => 'text-transform: {{VALUE}}!important;',
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
						'{{WRAPPER}} .wolf-core-bigtext' => 'font-style: {{VALUE}};',
					),
					'page_builder' => 'vc',
				),

				array(
					'type'         => 'font_family',
					'label'        => esc_html__( 'Font', 'wolf-core' ),
					'param_name'   => 'font_family',
					'admin_label'  => true,
					'default'      => apply_filters( 'wolf_core_default_heading_font_family', '' ),
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-bigtext' => 'font-family: {{VALUE}}!important;',
					),
					'page_builder' => 'vc',
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'HTML Tag', 'wolf-core' ),
					'param_name' => 'title_tag',
					'options'    => array(
						'h1'   => 'H1',
						'h2'   => 'H2',
						'h3'   => 'H3',
						'h4'   => 'H4',
						'h5'   => 'H5',
						'h6'   => 'H6',
						'div'  => 'div',
						'span' => 'span',
						'p'    => 'p',
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
