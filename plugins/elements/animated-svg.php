<?php
/**
 * Animated SVG
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
function wolf_core_animated_svg( $atts ) {

	$atts = apply_filters(
		'wolf_core_animated_svg_atts',
		wp_parse_args(
			$atts,
			array(
				'type'          => 'simple',
				'alignment'     => '',
				'paths'         => '',
				'inline_code'   => '',
				'path_color'    => '',
				'anim_once'     => 'yes',
				'anim_duration' => '5',
				'anim_delay'    => '0',
				'stroke_width'  => '5',
				'width'         => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$output .= '<div class="wolf-core-animated-svg wolf-core-animated-svg-align-' . esc_attr( $alignment ) . ' wolf-core-svg-anim-once-' . esc_attr( $anim_once ) . '" data-width="' . absint( $width ) . '" data-stroke-width="' . absint( $stroke_width ) . '" data-path-color="' . esc_attr( $path_color ) . '" data-animation-duration="' . esc_attr( $anim_duration ) . '" data-animation-delay="' . esc_attr( $anim_delay ) . '">';

	if ( 'multiple' === $type ) {

		$output .= '<svg>';

		foreach ( $paths as $path ) {
			$path = extract(
				apply_filters(
					'wolf_core_animated_svg_path_atts',
					wp_parse_args(
						$path,
						array(
							'inline_code'   => '',
							'path_color'    => '',
							'anim_duration' => '5s',
							'anim_delay'    => '0',
							'stroke_width'  => '5',
						)
					)
				)
			);

			$data_attrs = 'data-stroke-width="' . absint( $stroke_width ) . '" data-path-color="' . esc_attr( $path_color ) . '" data-animation-duration="' . absint( $anim_duration ) . '" data-animation-delay="' . absint( $anim_delay ) . '"';

			$output .= str_replace( '<path', '<path ' . $data_attrs . ' ', $inline_code );
		}

		$output .= '</svg>';

	} else {
		$output .= $inline_code;
	}

	$output .= '</div>';

	return $output;
}
