<?php
/**
 * Span shortcode
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Shortcodes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wolf_core_shortcode_span' ) ) {
	/**
	 * Span shortcode
	 *
	 * @param array $atts The shortcode attributes.
	 * @return string
	 */
	function wolf_core_shortcode_span( $atts, $content = null ) {

		extract(
			shortcode_atts(
				array(
					'id'    => '',
					'class' => '',
					'style' => '',
				),
				$atts
			)
		);

		$output = '<span data-span-text="' . esc_attr( $content ) . '" class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . esc_attr( $style ) . '"';

		if ( ! empty( $id ) ) {
			$output .= ' id="' . esc_attr( $id ) . '"';
		}

		$output .= '>' . do_shortcode( $content ) . '</span>';

		return $output;
	}
	add_shortcode( 'wolf_core_span', 'wolf_core_shortcode_span' );
}
