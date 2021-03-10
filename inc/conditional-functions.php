<?php
/**
 * Wolf Core frontend functions
 *
 * General core functions available on admin.and frontend
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check if we are on the WPB VC Frontend Editor
 *
 * @return string plugin slug
 */
function wolf_core_is_page_builder_page() {
	return true;
}

/**
 * Check if we are on the WPB VC Frontend Editor
 *
 * @return string plugin slug
 */
function wolf_core_is_wpb_vc_frontend() {
	return function_exists( 'vc_is_inline' ) && vc_is_inline() ? true : false;
}

/**
 * Check if VC is used on this page
 *
 * @return bool
 */
function wolf_core_is_vc() {

	if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
		return false;
	}

	global $post;

	$is_page            = is_page() && 'default' === get_post_meta( get_the_ID(), '_wp_page_template', true );
	$is_valid_post_type = in_array( get_post_type(), apply_filters( 'wolf_core_default_post_types', vc_editor_post_types() ), true );

	if ( is_page() || ( is_single() && $is_valid_post_type ) ) {
		if ( is_object( $post ) ) {
			$pattern = get_shortcode_regex();
			if ( preg_match( "/$pattern/s", $post->post_content, $match ) ) {
				if ( 'vc_row' === $match[2] || 'vc_section' === $match[2] ) {
					return apply_filters( 'wolf_core_is_vc', true );
				}
			}
		}
	}
}

/**
 * Check is if new animation engine (AOS)
 *
 * @param string $animation_name Tha animation name.
 * @return bool
 */
function wolf_core_is_new_animation( $animation_name ) {

	if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
		return;
	}

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

/**
 * Check if the browser is edge
 *
 * @return bool
 */
function wolf_core_is_edge() {
	global $is_edge;

	return $is_edge;
}

/**
 * Check if the browser is firefox
 *
 * @return bool
 */
function wolf_core_is_firefox() {
	global $is_gecko;

	return $is_gecko;
}

/**
 * Check if the browser is iOS
 *
 * @return bool
 */
function wolf_core_is_iphone() {
	global $is_iphone;

	return $is_iphone;
}

/**
 * Check if Bandwintown plugin is active
 */
function wolf_core_is_bandsintown() {
	return class_exists( 'Bandsintown_JS_Plugin' );
}

/**
 * Do fullPage
 */
function wolf_core_do_fullpage() {
	if ( is_page() || is_single() ) {
		if ( get_post_meta( wolf_core_get_the_id(), '_post_fullpage', true ) && 'no' !== get_post_meta( wolf_core_get_the_id(), '_post_fullpage', true ) ) {
			return apply_filters( 'wolf_core_do_fullpage', true );
		}
	}
}
