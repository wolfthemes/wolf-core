<?php
/**
 * Next Month shortcode
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Shortcodes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wolf_core_shortcode_next_month' ) ) {
	/**
	 * Next Month shortcode
	 *
	 * @return string
	 */
	function wolf_core_shortcode_next_month() {

		$month = ( 12 === date( 'm' ) ) ? '01' : date( 'm' ) + 1;

		return '<span class="wvc-next-month">' . $month . '</span>';
	}
	add_shortcode( 'wolf_core_next_month', 'wolf_core_shortcode_next_month' );
}
