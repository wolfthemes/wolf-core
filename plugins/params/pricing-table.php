<?php
/**
 * Pricing Table
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
function wolf_core_pricing_table_params() {

	return apply_filters(
		'wolf_core_pricing_table_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Pricing Table', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_pricing_table',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'pricing-table',
				'icon'          => 'linea-ecommerce linea-ecommerce-receipt-dollar',
			),
			'params'     => array(
				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Title', 'wolf-core' ),
					'param_name' => 'title',
					'ai'         => array(
						'active' => false,
					),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'HTML Tag', 'wolf-core' ),
					'param_name' => 'title_tag',
					'options'    => array(
						'h4'   => 'H4',
						'h1'   => 'H1',
						'h2'   => 'H2',
						'h3'   => 'H3',
						'h5'   => 'H5',
						'h6'   => 'H6',
						'div'  => 'div',
						'span' => 'span',
						'p'    => 'p',
					),
				),
				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Tagline', 'wolf-core' ),
					'param_name' => 'tagline',
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Price', 'wolf-core' ),
					'param_name'  => 'price',
					'placeholder' => 20,
					'ai'          => array(
						'active' => false,
					),
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Currency', 'wolf-core' ),
					'param_name'  => 'currency',
					'placeholder' => '$',
					'description' => esc_html__( 'e.g: $ or €', 'wolf-core' ),
					'ai'          => array(
						'active' => false,
					),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Display Currency', 'wolf-core' ),
					'param_name' => 'display_currency',
					'options'    => array(
						'before' => esc_html__( 'Before', 'wolf-core' ),
						'after'  => esc_html__( 'After', 'wolf-core' ),

					),
				),
				// array(
				// 'type'       => 'checkbox',
				// 'label'      => esc_html__( 'Offer', 'wolf-core' ),
				// 'param_name' => 'offer',
				// ),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Offer Price', 'wolf-core' ),
					'param_name'  => 'offer_price',
					'placeholder' => 15,
					'ai'          => array(
						'active' => false,
					),
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Price Period', 'wolf-core' ),
					'param_name'  => 'price_period',
					'description' => esc_html__( 'e.g "monthly" or "per month"', 'wolf-core' ),
					'ai'          => array(
						'active' => false,
					),
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Button Text', 'wolf-core' ),
					'param_name' => 'button_text',
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Button Link', 'wolf-core' ),
					'param_name' => 'link',
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Secondary Button Text', 'wolf-core' ),
					'param_name' => 'secondary_button_text',
				),

				array(
					'type'       => 'link',
					'label'      => esc_html__( 'Secondary Button Link', 'wolf-core' ),
					'param_name' => 'secondary_button_link',
				),

				array(
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Featured', 'wolf-core' ),
					'param_name' => 'featured',
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Featured Text', 'wolf-core' ),
					'param_name' => 'featured_text',
				),
				array(
					'type'        => 'textarea',
					'label'       => esc_html__( 'Services', 'wolf-core' ),
					'param_name'  => 'services',
					'description' => esc_html__( 'Enter one service per line.', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Title Color', 'wolf-core' ),
					'param_name'   => 'pricing_table_title_color',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-pricing-table-title h1' => 'color: {{VALUE}}!important;',
						'{{WRAPPER}} .wolf-core-pricing-table-title h2' => 'color: {{VALUE}}!important;',
						'{{WRAPPER}} .wolf-core-pricing-table-title h3' => 'color: {{VALUE}}!important;',
						'{{WRAPPER}} .wolf-core-pricing-table-title h4' => 'color: {{VALUE}}!important;',
						'{{WRAPPER}} .wolf-core-pricing-table-title h5' => 'color: {{VALUE}}!important;',
					),
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Price Color', 'wolf-core' ),
					'param_name'   => 'pricing_table_price_color',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-pricing-table-price' => 'color: {{VALUE}};',
					),
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'pricing_table_text_color',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-pricing-table-inner' => 'color: {{VALUE}};',
					),
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Background Color', 'wolf-core' ),
					'param_name'   => 'custom_background_color', // backward compatiblity name (WVC plugin).
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-pricing-table-inner' => 'background-color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Border Color', 'wolf-core' ),
					'param_name'   => 'custom_border_color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-pricing-table-inner' => 'border:1px solid; border-color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Featured Text Background Color', 'wolf-core' ),
					'param_name'   => 'featured_text_background_color', // backward compatiblity name (WVC plugin).
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-pricing-table-featured-text' => 'background-color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Featured Text Color', 'wolf-core' ),
					'param_name'   => 'featured_text_color', // backward compatiblity name (WVC plugin).
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-pricing-table-featured-text' => 'color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),
			),
		)
	);
}
