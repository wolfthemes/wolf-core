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
add_filter(
	'wp_kses_allowed_html',
	function ( $array ) {

		$array['distorted'] = array(
			'class' => array(),
			'id'    => array(),
		);
		$array['elipse']    = array(
			'class' => array(),
			'id'    => array(),
		);
		$array['underline'] = array(
			'class' => array(),
			'id'    => array(),
		);
		$array['accent']    = array(
			'class' => array(),
			'id'    => array(),
		);

		$array['strong'] = array(
			'class' => array(),
			'id'    => array(),
		);

		$array['b'] = array(
			'class' => array(),
			'id'    => array(),
		);

		$array['i'] = array(
			'class' => array(),
			'id'    => array(),
		);

		$array['em'] = array(
			'class' => array(),
			'id'    => array(),
		);

		return $array;
	},
	44
);
