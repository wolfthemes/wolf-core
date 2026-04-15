<?php
/**
 * WooCommerce custom functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

add_action( 'template_redirect', 'wolf_core_buy_button_redirect' );

function wolf_core_buy_button_redirect() {
    if ( ! isset( $_GET['wc_buy_ticket'] ) || ! isset( $_GET['product_id'] ) ) {
        return;
    }

    $product_id   = absint( $_GET['product_id'] );
    $variation_id = isset( $_GET['variation_id'] ) ? absint( $_GET['variation_id'] ) : 0;
    $redirect     = isset( $_GET['redirect_to_checkout'] ) ? absint( $_GET['redirect_to_checkout'] ) : 0;
    $attributes   = array();

    if ( $variation_id ) {
        $variation = wc_get_product( $variation_id );
        if ( $variation && $variation->is_type( 'variation' ) ) {
            $attributes = $variation->get_variation_attributes();
        }
    }

    WC()->cart->empty_cart();
    WC()->cart->add_to_cart( $product_id, 1, $variation_id, $attributes );

    wc_clear_notices();

    wp_safe_redirect( $redirect ? wc_get_checkout_url() : wc_get_cart_url() );
    exit;
}