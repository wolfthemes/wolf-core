<?php
/**
 * Theme SVG Animations
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
function wolf_core_theme_svg_animations( $atts ) {

	$atts = apply_filters(
		'wolf_core_theme_svg_animations_atts',
		wp_parse_args(
			$atts,
			array(
				'svg_animation_option' => 'simple',
				'alignment'            => '',
				'paths'                => '',
				'path_color'           => '',
				'anim_once'            => 'yes',
				'anim_duration'        => '5',
				'anim_delay'           => '0',
				'stroke_width'         => '10',
				'width'                => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$output .= '<div class="wolf-core-theme-svg-animation wolf-core-theme-svg-animation-align-' . esc_attr( $alignment ) . ' wolf-core-theme-svg-anim-once-' . esc_attr( $anim_once ) . '" data-width="' . absint( $width ) . '" data-stroke-width="' . absint( $stroke_width ) . '" data-path-color="' . esc_attr( $path_color ) . '" data-animation-duration="' . absint( $anim_duration ) . '" data-animation-delay="' . absint( $anim_delay ) . '">';
	$output .= '<div class="wolf-core-theme-svg-animation-inner">';

	$output .= apply_filters( 'wolf_core_theme_svg_animation', '', $atts );

	$output .= '</div></div>';

	return $output;
}
