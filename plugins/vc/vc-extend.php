<?php
/**
 * Wolf Core WPBakery Page Builder Extend functions
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Disable WPBPB frontend
 */
function wvc_vc_remove_frontend_links() {
	vc_disable_frontend();
}
add_action( 'vc_after_init', 'wvc_vc_remove_frontend_links' );

/**
 * Replace default css class for vc_row shortcode and vc_column
 *
 * @param string $class_string The row class to output.
 * @param string $tag The shortcode tag.
 * @return string
 */
function wolf_core_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {

	if ( 'vc_row' === $tag || 'vc_row_inner' === $tag ) {
		// $class_string = str_replace( 'vc_row-fluid', 'row', $class_string );
	}

	if ( 'vc_column' === $tag || 'vc_column_inner' === $tag ) {
		$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'wolf-core-col-$1', $class_string );
	}

	return $class_string;
}
add_filter( 'vc_shortcodes_css_class', 'wolf_core_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );

/**
 * Disabled duplicated VC element
 */
function wolf_core_disable_elements() {

	$disabled_elements = apply_filters(
		'wolf_core_disabled_elements',
		array(
			'vc_section',
			'vc_tour', // deprecated.
			'vc_btn', // deprecated.
			'vc_tta_accordion',
			'vc_tta_tabs',
			'vc_tta_pageable',
			'vc_round_chart',
			'vc_line_chart',
			'vc_text_separator',
			'vc_facebook',
			'vc_tweetmeme',
			'vc_googleplus',
			'vc_pinterest',
			'vc_images_carousel',
			'vc_tour',
			'vc_teaser_grid',
			'vc_posts_grid',
			'vc_carousel',
			'vc_posts_slider',
			'vc_button2',
			'vc_btn',
			'vc_cta_button',
			'vc_cta_button2',
			'vc_basic_grid',
			'vc_media_grid',
			'vc_masonry_grid',
			'vc_masonry_media_grid',
		)
	);

	foreach ( $disabled_elements as $element ) {
		vc_remove_element( $element );
	}
}
add_action( 'vc_after_init', 'wolf_core_disable_elements' );

/**
 * Enqueue editor scripts
 *
 * Script available only for VC editor
 */
function wolf_core_enqueue_vc_editor_scripts() {

	$version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : WOLF_CORE_VERSION;

	wp_enqueue_script( 'wolf-core-vc-editor', WOLF_CORE_JS . '/admin/vc-editor.js', array(), $version, true );
}
add_action( 'vc_backend_editor_render', 'wolf_core_enqueue_vc_editor_scripts' );

/*
To re-add elements from theme:
http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key

function readd_el( $disabled_elements ) {

	if ( ( $key = array_search( 'vc_accordion', $disabled_elements ) ) !== false) {
		unset( $disabled_elements[ $key ] );
	}

	return $disabled_elements;
}
add_filter( 'wolf_core_disabled_elements', 'readd_el' );
*/
