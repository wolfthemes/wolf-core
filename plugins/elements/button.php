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
 * Returns the element markup
 *
 * @param array $atts The element attributes.
 */
function wolf_core_button( $atts ) {

	$atts = apply_filters(
		'wolf_core_button_atts',
		wp_parse_args(
			$atts,
			array(
				'button_type'                   => '',
				'text'                          => '',
				'link'                          => '',
				'align'                         => '',
				'size'                          => '',
				'shape'                         => '',
				'add_icon'                      => '',
				'icon_type'                     => '', // VC.
				'selected_icon'                 => '', // Elementor.
				'icon_align'                    => 'before',
				'full_width'                    => '',
				'icon_indent'                   => '',
				'button_css_id'                 => '',
				'text_shadow'                   => '',
				'button_text_color'             => '',
				'background_color'              => '',
				'hover_color'                   => '',
				'button_background_hover_color' => '',
				'button_hover_border_color'     => '',
				'hover_animation'               => '',
				'border'                        => '',
				'border_radius'                 => '',
				'box_shadow'                    => '',
				'text_padding'                  => '',
				'scroll_to_anchor'              => '',
				'icon_hover_reveal'             => '',
				'style'                         => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$container_class = 'wolf-core-button-container wolf-core-element';

	if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
		$add_icon = ! empty( $atts['selected_icon']['value'] );
	}

	/* Button attribute class */
	$class .= ' wolf-core-button';

	if ( $size ) {
		$class .= " wolf-core-button-size-$size";
	}

	if ( $full_width ) {
		$class .= ' wolf-core-button-full-width';
	}

	if ( $button_type ) {
		$class .= " $button_type";
	}

	if ( $shape ) {
		$class .= " wolf-core-button-shape-$shape";
	}

	if ( $icon_align ) {
		$class .= " wolf-core-button-icon-align-$icon_align";
	}

	if ( $hover_animation ) {
		$class .= " wolf-core-button-hover-animation-$hover_animation";
	}

	if ( $scroll_to_anchor ) {
		$class .= ' wolf-core-scroll';
	}

	if ( $icon_hover_reveal ) {
		$class .= ' wolf-core-button-icon-hover-reveal';
	}

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $container_class ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$button_link_atts = apply_filters(
		'wolf_core_button_atts',
		array(
			'role'  => 'button',
			'class' => wolf_core_sanitize_html_classes( $class ),
			'style' => wolf_core_esc_style_attr( $inline_style ),
		),
		$atts
	);

	/* Opening link tag */
	if ( is_array( $link ) && ! empty( $link['url'] ) ) {

		$button_link_atts = array_merge(
			array(
				'rel'    => esc_attr( $link['rel'] ),
				'target' => esc_attr( $link['target'] ),
				'title'  => esc_attr( $link['title'] ),
				'href'   => esc_attr( $link['url'] ),
			),
			$button_link_atts
		);

		$output .= '<a ' . wolf_core_render_html_attributes( $button_link_atts ) . ' id="' . esc_attr( $button_css_id ) . '"
			style="' . esc_attr( $style ) . '"
		>';

	} else {

		$output .= '<span ' . wolf_core_render_html_attributes( $button_link_atts ) . ' id="' . esc_attr( $button_css_id ) . '"
			style="' . esc_attr( $style ) . '"
		>';
	}

	if ( $add_icon && 'left' === $icon_align ) {
		$output .= wolf_core_render_icon(
			$selected_icon,
			array(
				'class'       => 'wolf-core-icon',
				'aria-hidden' => 'true',
			)
		);
	}

	$output .= apply_filters( 'wolf_core_button_text_before', '', $atts );
	$output .= '<span class="wolf-core-button-text">' . esc_attr( $text ) . '</span>';
	$output .= apply_filters( 'wolf_core_button_text_after', '', $atts );

	if ( $add_icon && 'right' === $icon_align ) {
		$output .= wolf_core_render_icon(
			$selected_icon,
			array(
				'class'       => 'wolf-core-icon',
				'aria-hidden' => 'true',
			)
		);
	}

	/* Closing link tag */
	if ( is_array( $link ) && ! empty( $link['url'] ) ) {
		$output .= '</a>';
	} else {
		$output .= '</span>';
	}

	$output .= '</div><!-- .wolf-core-button-container -->';

	return $output;
}
