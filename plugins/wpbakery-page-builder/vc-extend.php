<?php
/**
 * %NAME% WPBakery Page Builder Extend functions
 *
 * @author WolfThemes
 * @package %PACKAGENAME%/WPBakeryPageBuilder/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Replace default css class for vc_row shortcode and vc_column
 *
 * @param string $class_string The row class to output.
 * @param string $tag The shortcode tag.
 * @return string
 */
function wvc_custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {

	if ( $tag === 'vc_row' || $tag === 'vc_row_inner' ) {
		//$class_string = str_replace( 'vc_row-fluid', 'row', $class_string );
	}

	if ( $tag === 'vc_column' || $tag === 'vc_column_inner') {
		$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'wvc-col-$1', $class_string );
	}

	return $class_string;
}
add_filter( 'vc_shortcodes_css_class', 'wvc_custom_css_classes_for_vc_row_and_vc_column', 10, 2 );

/**
 * Disabled duplicated VC element
 */
function wvc_disable_elements() {

	$disabled_elements = apply_filters(
		'wvc_disabled_elements',
		array(
			'vc_section',
			'vc_tour', // deprecated
			'vc_btn', // deprecated
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
add_action( 'vc_after_init', 'wvc_disable_elements' );

/*
To re-add elements from theme:
http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key

function readd_el( $disabled_elements ) {

	if ( ( $key = array_search( 'vc_accordion', $disabled_elements ) ) !== false) {
		unset( $disabled_elements[ $key ] );
	}

	return $disabled_elements;
}
add_filter( 'wvc_disabled_elements', 'readd_el' );
*/
