<?php
/**
 * Icon
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
function wolf_core_icon( $atts ) {

	$atts = apply_filters(
		'wolf_core_icon_atts',
		wp_parse_args(
			$atts,
			array(
				'media_type'    => 'simple',
				'selected_icon' => '',
				'view'          => '',
				'shape'         => '',
				'link'          => '',
				'align'         => 'align',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= " wolf-core-icon-container wolf-core-element wolf-core-align-$align";

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<div class="wolf-core-icon">';

	/* Opening */
	if ( is_array( $link ) && ! empty( $link['url'] ) ) {
		$output .= '<a rel="' . esc_attr( $link['rel'] ) . '" ';
		$output .= ' target="' . esc_attr( $link['target'] ) . '"';
		$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '">';
	} else {
		$output .= '<div>';
	}

	$output .= wolf_core_render_icon( $selected_icon, array( 'aria-hidden' => 'true' ) );
	// $output .= '<i class="' . wolf_core_sanitize_html_classes( wolf_core_render_icon( $selected_icon ) ) . '"></i>';

	/* Closing */
	if ( is_array( $link ) && ! empty( $link['url'] ) ) {
		$output .= '</a>';
	} else {
		$output .= '</div>';
	}

	$output .= '</div><!-- .wolf-core-icon -->';

	$output .= '</div><!-- .wolf-core-icon-container -->';

	return $output;
}
