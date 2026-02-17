<?php
/**
 * Custom Heading
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns a heading
 *
 * @param array $atts The heading attributes.
 */
function wolf_core_heading( $atts ) {

	$atts = apply_filters(
		'wolf_core_heading_atts',
		wp_parse_args(
			$atts,
			array(
				'font_size'           => '',
				'min_font_size'       => '',
				'responsive'          => 'yes',
				'font_family'         => '',
				'letter_spacing'      => 0,
				'font_weight'         => '',
				'line_height'         => '',
				'text_transform'      => '',
				'font_style'          => '',
				'text_align'          => '',
				'text_align_mobile'   => '',
				'color'               => '',
				'custom_color'        => '',
				'text'                => '',
				'tag'                 => 'h2',
				'link'                => '',
				'background_img'      => '',
				'background_position' => 'center center',
				'background_repeat'   => 'no-repeat',
				'background_size'     => 'cover',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'el_id'               => '',
				'css'                 => '',
				'inline_style'        => '',
				'hide_class'          => '',
				'container'           => true,
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	wp_enqueue_script( 'fittext' );
	wp_enqueue_script( 'wolf-core-fittext' );

	$output               = '';
	$text_container_class = '';
	$text_style           = '';

	$class = $el_class; // init container CSS class.

	$has_line_break = ( preg_match( '/(<br>|<br\/>|<br \/>)/', $text ) );

	$text_transform = esc_attr( $text_transform );
	$font_weight    = ( $font_weight ) ? absint( $font_weight ) : '';
	// $letter_spacing = preg_replace( '/[^0-9-.,]/', '', $letter_spacing );
	// $letter_spacing = ( $letter_spacing ) ? wolf_core_sanitize_css_value( $letter_spacing ) : '';

	$class .= ' wolf-core-mobile-text-align-' . $text_align_mobile;

	if ( $font_size && 'yes' === $responsive ) {

		$class .= ' wolf-core-fittext';

	} elseif ( $font_size && 'yes' !== $responsive ) {

		$text_style .= 'font-size:' . absint( $font_size ) . 'px;';
	}

	if ( $font_weight ) {
		$text_style .= 'font-weight:' . absint( $font_weight ) . ';';
	}

	if ( '' !== $letter_spacing ) {
		$text_style .= 'letter-spacing:' . esc_attr( $letter_spacing ) . ';';
	}

	if ( $text_align ) {
		$text_style .= 'text-align:' . esc_attr( $text_align ) . ';';
	}

	if ( $line_height ) {
		$line_height = esc_attr( $line_height );
		$text_style .= "line-height:$line_height;";
	} else {
		$text_style .= 'line-height:1.5;';
	}

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

	if ( 'fadeInUp' === $css_animation || 'fadeInDown' === $css_animation ) {
		$text_container_class .= ' wolf-core-overflow-hidden';
	}

	$text_container_class .= ' wolf-core-custom-heading wolf-core-element wolf-core-align-' . $text_align;
	$text_container_class .= ' ' . $hide_class; // device visibility class.

	if ( $background_img ) {
		$bg_img_url    = wolf_core_get_url_from_attachment_id( $background_img, 'large' );
		$inline_style .= "background-image:url($bg_img_url);";
		$inline_style .= "background-repeat:$background_repeat;";
		$inline_style .= "background-position:$background_position;";
		$inline_style .= "background-size:$background_size;";
	}

	if ( $container ) {
		$output .= '<div class="' . wolf_core_sanitize_html_classes( $text_container_class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

		if ( ! $has_line_break ) {
			$output .= wolf_core_element_aos_animation_data_attr( $atts );
		}

		$output .= '>';
	}

	$output .= '<' . esc_attr( $tag ) . '';

	if ( ! $container && ! $has_line_break ) {
		$output .= wolf_core_element_aos_animation_data_attr( $atts );
	}

	if ( '' !== $el_id ) {
		$output .= ' id="' . sanitize_title( $el_id ) . '"';
	}

	$output .= ' style="' . wolf_core_esc_style_attr( $text_style ) . '" class="' . wolf_core_sanitize_html_classes( $class ) . '"
		data-heading-text="' . esc_attr( wolf_core_sanitize_heading( sanitize_text_field( $text ) ) ) . '"
		data-max-font-size="' . absint( $font_size ) . '"
		data-min-font-size="' . absint( $min_font_size ) . '">';

	if ( is_array( $link ) ) {
		$output .= '<a style="' . wolf_core_esc_style_attr( $inline_style ) . '" class="wolf-core-fittext-link" href="' . esc_url( $link['url'] ) . '"
		target="' . esc_attr( $link['target'] ) . '" title="' . esc_attr( $link['title'] ) . '" rel="' . esc_attr( $link['rel'] ) . '">';
	}

	if ( $has_line_break ) {

		$lines = wolf_core_texarea_lines_to_array( $text );

		$text = '';

		foreach ( $lines as $line ) {

			$line_container_style = '';
			$line_container_class = 'wolf-core-custom-heading-line';

			if ( 'fadeInUp' === $css_animation || 'fadeInDown' === $css_animation ) {
				$line_container_class .= ' wolf-core-overflow-hidden';
			}

			if ( ! wolf_core_is_new_animation( $css_animation ) ) {
				$line_container_class .= ' ' . wolf_core_get_css_animation( $css_animation );
				$line_container_style  = wolf_core_get_css_animation_delay( $css_animation_delay );
			}

			$text .= '<span class="' . esc_attr( $line_container_class ) . '" style="' . esc_attr( $line_container_style ) . '"';

			$text .= wolf_core_element_aos_animation_data_attr(
				array(
					'css_animation'       => $css_animation,
					'css_animation_delay' => $css_animation_delay,

				)
			);

			$text .= '>';

			$text .= $line;

			$text .= '</span>';

			$css_animation_delay = absint( $css_animation_delay ) + 100;
		}
	}

	$output .= do_shortcode( wolf_core_sanitize_heading( $text ) );

	if ( is_array( $link ) ) {
		$output .= '</a>';
	}

	$output .= '</' . esc_attr( $tag ) . '>';

	if ( $container ) {
		$output .= '</div>';
	}

	return $output;
}
