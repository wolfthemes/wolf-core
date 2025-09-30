<?php
/**
 * Current Year shortcode
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Shortcodes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wolf_core_shortcode_current_year' ) ) {
	/**
	 * Current Year shortcode
	 *
	 * @return string
	 */
	function wolf_core_shortcode_current_year() {

		return '<span class="wolf-core-current-year">' . date( 'Y' ) . '</span>';
	}
	add_shortcode( 'wolf_core_current_year', 'wolf_core_shortcode_current_year' );
}
