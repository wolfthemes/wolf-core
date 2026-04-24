<?php
/**
 * Buy Buton
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
function wolf_core_buy_button_params() {
	$buy_button_params = wolf_core_get_button_params();

	// Remove 'link' and 'scroll_to_anchor' params
	$buy_button_params = array_filter( $buy_button_params, function( $param ) {
		return isset( $param['param_name'] ) && ! in_array( $param['param_name'], array( 'link', 'scroll_to_anchor' ), true );
	});

	// Re-index array
	$buy_button_params = array_values( $buy_button_params );

	// Add product_id param at the beginning (after text)
	array_splice( $buy_button_params, 1, 0, array(
		array(
			'type'        => 'text',
			'label'       => esc_html__( 'Product ID', 'wolf-core' ),
			'param_name'  => 'product_id',
			'description' => esc_html__( 'Enter the WooCommerce product ID.', 'wolf-core' ),
			'placeholder' => '123',
		),
		array(
			'type'        => 'text',
			'label'       => esc_html__( 'Variation ID (optional)', 'wolf-core' ),
			'param_name'  => 'variation_id',
			'description' => esc_html__( 'Enter the variation ID for a specific ticket type. Leave empty for simple products.', 'wolf-core' ),
			'placeholder' => '456',
		),
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Redirect to checkout', 'wolf-core' ),
			'param_name'  => 'redirect_to_checkout',
		),

	));

	return apply_filters(
		'wolf_core_buy_button_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Buy Button', 'wolf-core' ),
				'description'   => esc_html__( 'Add to cart button that redirects to checkout', 'wolf-core' ),
				'vc_base'       => 'wolf_core_buy_button',
				'el_base'       => 'buy_button',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'keywords'      => array( 'woocommerce' ),
				'icon'          => 'eicon-button',
			),
			'params'     => $buy_button_params,
		)
	);
}