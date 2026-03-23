<?php
/**
 * Body classes frontend functions
 *
 * @author WolfThemes
 * @category Frontend
 * @package WolfCore/Frontend
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add body classes for WPB pages
 *
 * @param  array $classes The body classes array.
 * @return array
 */
function wolf_core_body_class( $classes ) {

	$classes[] = 'wolf-core';
	$classes[] = 'wolf-core-body';

	if ( wolf_core_is_page_builder_page() ) {

		$classes[] = 'wolf-core-layout';

		if ( 'vc' === wolf_core_get_plugin_in_use() ) {
			$classes[] = 'wolf-core-vc';
		}

		if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
			$classes[] = 'wolf-core-elementor';
		}

		if ( wolf_core_is_elementor_page() ) {
			$classes[] = 'wolf-core-elementor-page';
		}

		$classes[] = 'wolf-core-' . str_replace( '.', '-', WOLF_CORE_VERSION );
		$classes[] = sanitize_title_with_dashes( get_template() ); // theme slug.

		if ( get_post_meta( get_the_ID(), '_post_scroller', true ) ) {
			$classes[] = 'wolf-core-one-pager';
		}

		if ( wp_is_mobile() ) {
			$classes[] = 'wolf-core-is-mobile';
		} else {
			$classes[] = 'wolf-core-is-desktop';
		}

		if ( wolf_core_is_edge() ) {
			$classes[] = 'wolf-core-is-edge';
		} else {
			$classes[] = 'wolf-core-not-edge';
		}

		if ( wolf_core_is_firefox() ) {
			$classes[] = 'wolf-core-is-firefox';
		} else {
			$classes[] = 'wolf-core-not-firefox';
		}

		if ( wolf_core_do_fullpage() ) {
			$classes[] = 'wolf-core-fullpage';
			$classes[] = 'wolf-core-fullpage-slide';
		}
	}

	if ( wolf_core_is_elementor_editor() ) {
		$classes[] = 'wolf-core-elementor-editor-active';
	}

	return $classes;
}
add_filter( 'body_class', 'wolf_core_body_class' );
