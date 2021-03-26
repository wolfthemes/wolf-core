<?php
/**
 * Button
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Generate a button markup
 *
 * @param array $atts
 */
function wolf_core_generate_button( $atts ) {

	$atts = apply_filters(
		'wolf_core_button_atts',
		wp_parse_args(
			$atts,
			array(
				'title'               => esc_html__( 'Click here', 'wolf-core' ),
				'link'                => '',
				'href'                => '#',
				'color'               => '',
				'custom_color'        => '',
				'shape'               => '',
				'style'               => '',
				'size'                => 'md',
				'align'               => '',
				'button_block'        => '',
				'hover_effect'        => 'opacity',
				'font_weight'         => '',
				'scroll_to_anchor'    => '',
				'add_icon'            => '',
				'i_align'             => '',
				'i_hover'             => '',
				'icon'                => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'css'                 => '',
				'el_class'            => '',
				'inline_style'        => '',
			)
		)
	);

	$atts = apply_filters( 'wolf_core_button_atts', $atts );

	extract( $atts ); //phpcs:ignore

	$output              = '';
	$container_class     = '';
	$button_filler_style = '';
	$before_text         = '';
	$after_text          = '';

	$class = $el_class; // init container CSS class.

	if ( $button_block && 'inline' !== $align ) {
		$class .= ' wolf-core-button-fullwidth';
	}

	$class .= ' wolf-core-button';

	if ( $color ) {
		$class .= " wolf-core-button-background-color-$color";
	}

	if ( $shape ) {
		$class .= " wolf-core-button-shape-$shape";
	}

	if ( $style ) {
		$class .= " wolf-core-button-style-$style";
	}

	if ( $size ) {
		$class .= " wolf-core-button-size-$size";
	}

	if ( $style ) {
		$class .= " wolf-core-button-style-$style";
	}

	if ( $hover_effect ) {
		$class .= " wolf-core-button-hover-$hover_effect";
	}

	if ( $scroll_to_anchor ) {
		$class .= ' wolf-core-scroll';
	}

	if ( $i_hover ) {
		$class .= ' wolf-core-button-icon-reveal';
	}

	$container_class .= "wolf-core-button-container wolf-core-button-container-align-$align";

	if ( 'inline' !== $align ) {
		$container_class .= ' wolf-core-element';
	}

	/* Icon */
	if ( $add_icon ) {
		$class .= " wolf-core-button-icon-$i_align";

		if ( 'left' === $i_align ) {

			$before_text = "<i class='wolf-core-button-icon fa $icon'></i>";

		} elseif ( 'right' === $i_align ) {

			$after_text = "<i class='fa $icon'></i>";
		}
	}

	/* Background color */
	if ( 'custom' === $color ) {
		$color              = $custom_color;
		$bg_color           = wolf_core_sanitize_color( $color );
		$inline_style      .= "background-color:$bg_color;border-color:$bg_color;box-shadow-color:$bg_color;";
		$icon_filler_style .= "background-color:$bg_color;box-shadow-color:$bg_color;";
	}

	if ( $font_weight ) {
		$font_weight   = absint( $font_weight );
		$inline_style .= "font-weight:$font_weight;";
	}

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $container_class ) . '"';
	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	if ( is_array( $link ) ) {
		$output .= '<a rel="' . esc_attr( $link['rel'] ) . '"';
		$output .= ' target="' . esc_attr( $link['target'] ) . '"';
		$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '"';
	} else {
		$output .= '<a href="#" ';
	}

	$output .= ' data-text="' . esc_attr( $title ) . '" class="' . wvc_sanitize_html_classes( $class ) . '"  style="' . wvc_esc_style_attr( $inline_style ) . '">';

	$output .= '<small data-text="' . esc_attr( $title ) . '" class="wolf-core-button-background-fill" style="' . wolf_core_esc_style_attr( $button_filler_style ) . '"></small>';

	$output .= $before_text;

	$output .= '<span>';
	$output .= esc_attr( $title );
	$output .= '</span>';

	$output .= $after_text;

	$output .= '</a>';
	$output .= '</div><!-- .wolf-core-button-container -->';

	return $output;
}
