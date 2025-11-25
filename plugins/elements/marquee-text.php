<?php
/**
 * arquee ext
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the element markup
 *
 * @param array $atts The element attributes.
 */
function wolf_core_marquee_text( $atts ) {

	$atts = apply_filters(
		'wolf_core_marquee_text_atts',
		wp_parse_args(
			$atts,
			array(
				'text'          => '',
				'direction'     => 'left',
				'marquee_speed' => '20',
				'link'          => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-marquee-container wolf-core-element';

	$class .= ' wolf-core-marquee-direction-' . $direction;

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';
	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	if ( is_array( $link ) && isset( $link['url'] ) && '' !== $link['url'] ) {
		$output .= '<a rel="' . esc_attr( $link['rel'] ) . '" class="wolf-core-marquee-link-mask"';
		$output .= ' target="' . esc_attr( $link['target'] ) . '"';
		$output .= ' href="' . esc_url( $link['url'] ) . '"></a>';
	}

	$output .= '<div class="wolf-core-marquee" aria-hidden="true">
	<div class="wolf-core-marquee__inner" style="animation-speed:' . absint( $marquee_speed ) . 's" aria-hidden="true">';

	$output .= '<span class="wolf-core-marquee-text">' . esc_attr( $text ) . '</span>';
	$output .= '<span class="wolf-core-marquee-text">' . esc_attr( $text ) . '</span>';
	$output .= '<span class="wolf-core-marquee-text">' . esc_attr( $text ) . '</span>';
	$output .= '<span class="wolf-core-marquee-text">' . esc_attr( $text ) . '</span>';
	$output .= '<span class="wolf-core-marquee-text">' . esc_attr( $text ) . '</span>';
	$output .= '<span class="wolf-core-marquee-text">' . esc_attr( $text ) . '</span>';

	$output .= '</div><!--.wolf-core-marquee__inner-->
	</div><!--.wolf-core-marquee--></div><!--.wolf-core-marquee-container-->';

	return $output;
}
