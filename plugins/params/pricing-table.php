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
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Currency', 'wolf-core' ),
					'param_name'  => 'currency',
					'placeholder' => '$',
					'description' => esc_html__( 'e.g: $ or €', 'wolf-core' ),
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
				// 	'type'       => 'checkbox',
				// 	'label'      => esc_html__( 'Offer', 'wolf-core' ),
				// 	'param_name' => 'offer',
				// ),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Offer Price', 'wolf-core' ),
					'param_name'  => 'offer_price',
					'placeholder' => 15,
				),
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Price Period', 'wolf-core' ),
					'param_name'  => 'price_period',
					'description' => esc_html__( 'e.g "monthly" or "per month"', 'wolf-core' ),
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
			),
		)
	);
}
