<?php
/**
 * Wolf Core Extension Template Functions
 *
 * Action/filter functions used for Wolf Core Extension functions/templates
 *
 * @author WolfThemes
 * @category Frontend
 * @package WolfCore/Frontend
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output generator tag to aid debugging.
 */
function wolf_core_generator_tag( $gen, $type ) {
	switch ( $type ) {
		case 'html':
			$gen .= "\n" . '<meta name="generator" content="WolfCore ' . esc_attr( WOLF_CORE_VERSION ) . '">';
			break;
		case 'xhtml':
			$gen .= "\n" . '<meta name="generator" content="WolfCore ' . esc_attr( WOLF_CORE_VERSION ) . '" />';
			break;
	}
	return $gen;
}


/**
 * Add body classes for WPB pages
 *
 * @param  array $classes The body classes array.
 * @return array
 */
function wolf_core_body_class( $classes ) {

	$classes = (array) $classes;

	if ( wolf_core_is_page_builder_page() ) {

		$classes[] = 'wolf-core';

		if ( 'vc' === wolf_core_get_plugin_in_use() ) {
			$classes[] = 'wolf-core-vc';
		}

		if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
			$classes[] = 'wolf-core-elementor';
		}

		$classes[] = 'wolf-core-' . str_replace( '.', '-', WOLF_CORE_VERSION );
		$classes[] = sanitize_title_with_dashes( get_template() ); // theme slug.

		if ( get_post_meta( get_the_ID(), '_post_scroller', true ) ) {
			$classes[] = 'wolf-core-one-pager';
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

	return $classes;
}
