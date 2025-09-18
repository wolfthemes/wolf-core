<?php
/**
 * Link
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
function wolf_core_link( $atts ) {

	$atts = apply_filters(
		'wolf_core_link_atts',
		wp_parse_args(
			$atts,
			array(
				'text'    => '',
				'tagline' => '',
				'link'    => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-link wolf-core-element';

	$output .= '<wolf-core-link><div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<div class="wolf-core-link-inner">';

	if ( is_array( $link ) && isset( $link['url'] ) ) {
		$output .= '<a rel="' . esc_attr( $link['rel'] ) . '" class="wolf-core-link-mask"';
		$output .= ' target="' . esc_attr( $link['target'] ) . '"';
		$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '"></a>';
	}

	if ( $tagline ) {
		$output .= '<div class="wolf-core-link-tagline">';
		$output .= $tagline;
		$output .= '</div><!--.wolf-core-link-tagline-->';
	}

	if ( $text ) {
		$output .= '<div class="wolf-core-link-text">';
		$output .= $text;
		$output .= '</div><!--.wolf-core-link-text-->';
	}

	$output .= '</div><!--.wolf-core-link-inner-->';
	$output .= '</div><!--.wolf-core-link--></wolf-core-link>';

	return $output;
}
