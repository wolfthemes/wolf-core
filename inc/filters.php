<?php
/**
 * Wolf Core filter functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add allowed tags
 *
 * Mainly for Elementor heading widget sanitize function
 */
add_filter( 'wp_kses_allowed_html', function( $array ) {

	$array['distorted'] = array();
	$array['elipse'] = array();
	$array['underline'] = array();

	return $array;
}, 44 );
