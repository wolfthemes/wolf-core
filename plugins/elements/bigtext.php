<?php
/**
 * Big Text
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the big text markup
 *
 * @param array $atts The big text attributes.
 */
function wolf_core_bigtext( $atts ) {

	$atts = apply_filters(
		'wolf_core_bigtext_atts',
		wp_parse_args(
			$atts,
			array(
				'font_family'         => '',
				'letter_spacing'      => 0,
				'font_weight'         => '',
				'text_transform'      => '',
				'font_style'          => '',
				'color'               => '',
				'custom_color'        => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'text'                => '',
				'link'                => '',
				'title_tag'           => 'h3',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	// wp_enqueue_script( 'bigtext' );
	// wp_enqueue_script( 'wolf-core-bigtext' );

	$output               = '';
	$text_container_class = '';
	$text_style           = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-bigtext';

	$text_container_class .= ' wolf-core-element';

	$text_style .= 'font-weight:' . absint( $font_weight ) . ';';
	$text_style .= 'letter-spacing:' . absint( $letter_spacing ) . 'px;';

	if ( $font_family && 'default' !== $font_family ) {
		$text_style .= 'font-family:' . esc_attr( $font_family ) . ';';
	}

	if ( $text_transform ) {
		$text_style .= 'text-transform:' . esc_attr( $text_transform ) . ';';
	}

	if ( $font_style ) {
		$text_style .= 'font-style:' . esc_attr( $font_style ) . ';';
	}

	if ( 'custom' === $color && $custom_color ) {
		$text_style .= 'color:' . wolf_core_sanitize_color( $custom_color ) . ';';
	} else {
		$class .= " wolf-core-text-color-$color"; // color class.
	}

	if ( wolf_core_is_elementor_editor() ) {
		$text_style = '';
	}

	$lines = wolf_core_texarea_lines_to_array( $text );

	if ( 'fadeInUp' === $css_animation || 'fadeInDown' === $css_animation ) {
		$text_container_class .= ' wolf-core-overflow-hidden';
	}

	if ( array() !== $lines ) {

		$output .= '<div class="' . wolf_core_sanitize_html_classes( $text_container_class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

		$output .= wolf_core_element_aos_animation_data_attr( $atts );

		$output .= '>';

		$output .= '<' . esc_attr( $title_tag ) . '';
		$output .= ' style="' . wolf_core_esc_style_attr( $text_style ) . '" class="' . wolf_core_sanitize_html_classes( $class ) . '">';

		foreach ( $lines as $line ) {
			if ( is_array( $link ) ) {
				$output .= '<a class="wolf-core-bigtext-link" href="' . esc_url( $link['url'] ) . '" target="' . esc_attr( $link['target'] ) . '">';

			} else {
				$output .= '<span>';
			}

			$output .= wolf_core_sanitize_heading( $line );

			// $output .= '<svg viewBox="0 0 56 18">
			// <text x="0" y="15">' . wolf_core_sanitize_heading( $line ) . '</text>
			// </svg>';

			if ( is_array( $link ) ) {
				$output .= '</a>';
			} else {
				$output .= '</span>';
			}
		}

		$output .= '</' . esc_attr( $title_tag ) . '>';

		$output .= '</div>';

		return $output;

	}
}
