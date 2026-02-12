<?php
/**
 * BIT artist shortcode (for demo purpose)
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Shortcodes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wolf_core_shortcode_bit_artist' ) ) {
	/**
	 * Bandsintown artist shortcode
	 *
	 * @return string
	 */
	function wolf_core_shortcode_bit_artist() {

		return 'korn';
	}
	add_shortcode( 'wolf_core_bit_artist', 'wolf_core_shortcode_bit_artist' );
}
