<?php
/**
 * Text Hover Image shortcode
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Shortcodes
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wolf_core_shortcode_text_hover_image' ) ) {
	/**
	 * Span shortcode
	 *
	 * @param array $atts The shortcode attributes.
	 * @return string
	 */
	function wolf_core_shortcode_text_hover_image( $atts, $content = null ) {

		extract(
			shortcode_atts(
				array(
					'img_id' => '',
				),
				$atts
			)
		);

		wp_enqueue_script( 'wolf-core-text-hover-image' );

		$output  = '<span class="wolf-core-text-hover-image"><span class="wolf-core-text-hover-image-text">' . do_shortcode( $content ) . '</span>';
		$output .= '<span class="hover-reveal"><span class="hover-reveal__inner">';

		if ( wp_attachment_is_image( $img_id ) ) {

			$image_src = wp_get_attachment_url( absint( $img_id ) );
			// $output .= '<span class="hover-reveal__img" style="background-image: url(' . esc_url( $image_src ) . ');"></span>';
			$output .= wp_get_attachment_image( $img_id, 'medium', '', array( 'class' => 'hover-reveal__img' ) );
		}

		$output .= '</span></span></span>';

		return $output;
	}
	add_shortcode( 'wolf_core_text_hover_image', 'wolf_core_shortcode_text_hover_image' );
}
