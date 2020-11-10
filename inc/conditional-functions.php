<?php
/**
 * %NAME% frontend functions
 *
 * General core functions available on admin.and frontend
 *
 * @author WolfThemes
 * @category Core
 * @package %PACKAGENAME%/Frontend
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check if we are on the WPB VC Frontend Editor
 *
 * @return string plugin slug
 */
function wolf_core_is_wpb_vc_frontend() {
    return function_exists( 'vc_is_inline' ) && vc_is_inline() ? true : false;
}

/**
 * Check is if new animation engine (AOS)
 *
 * @param string $animation_name Tha animation name.
 * @return bool
 */
function wolf_core_is_new_animation( $animation_name ) {
	$new_animations = wolf_core_get_aos_animations();

	if ( isset( $new_animations[ $animation_name ] ) ) {
		return true;
	}
}

/**
 * Check if we are on a woocommerce page
 *
 * @return bool
 */
function wolf_core_is_woocommerce_page() {

	if ( class_exists( 'WooCommerce' ) ) {

		if ( is_woocommerce() ) {
			return true;
		}

		if ( is_shop() ) {
			return true;
		}

		if ( is_checkout() || is_order_received_page() ) {
			return true;
		}

		if ( is_cart() ) {
			return true;
		}

		if ( is_account_page() ) {
			return true;
		}

		if ( function_exists( 'wolf_wishlist_get_page_id' ) && is_page( wolf_wishlist_get_page_id() ) ) {
			return true;
		}
	}
}

/**
 * Check if the home page is set to posts
 *
 * @return bool
 */
function wolf_core_is_home_as_blog() {
	return ( 'posts' === get_option( 'show_on_front' ) && is_home() );
}

/**
 * Check if we're on the blog index page
 *
 * @return bool
 */
function wolf_core_is_blog_index() {

	return wolf_core_is_home_as_blog() || ( wolf_core_get_the_id() === get_option( 'page_for_posts' ) );
}

/**
 * Check if we're on a blog page
 *
 * @return bool
 */
function wolf_core_is_blog() {

	$is_blog = ( wolf_core_is_home_as_blog() || wolf_core_is_blog_index() || is_search() || is_archive() ) && ! wolf_core_is_woocommerce_page() && 'post' == get_post_type();
	return ( true === $is_blog );
}
