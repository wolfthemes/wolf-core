<?php
/**
 * Process
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
function wolf_core_process( $atts ) {

	$atts = apply_filters(
		'wolf_core_process_atts',
		wp_parse_args(
			$atts,
			array(
				'show_line'           => 'yes',
				'layout'              => 'horizontal',
				'size'                => 'medium',
				'alignment'           => 'left',
				'items'               => array(),
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-process-container wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= "<ul class='wolf-core-process'>";

	foreach ( $items as $process_item ) {

		$process_item = extract(
			apply_filters(
				'wolf_core_process_item_atts',
				wp_parse_args(
					$process_item,
					array(
						'type'          => 'icon',
						'selected_icon' => '',
						'background'    => '',
						'title'         => '',
						'text'          => '',
						'link'          => 'link',
					)
				)
			)
		);

		if ( is_array( $background ) && isset( $background['id'] ) ) {
			$background = $background['id'];
		}

		$container_class      = 'wolf-core-process-item';
		$bg_style             = '';
		$icon_container_class = 'wolf-core-process-icon-container wolf-core-icon-container fa-stack wolf-core-icon-container-type-' . $type;

		if ( ! $text ) {
			$container_class .= ' wolf-core-process-item-no-text';
		}

		$graphic_inline_style = $graphic_class = '';

		$output .= '<li class="' . wolf_core_sanitize_html_classes( $container_class ) . '">';

		$class               .= ' wolf-core-icon-box wolf-core-icon-position-top wolf-core-icon-background-style-rounded-outline ';
		$bg_style             = '';
		$icon_container_class = 'wolf-core-process-icon-container wolf-core-icon-container fa-stack wolf-core-icon-container-type-' . $type;

		if ( $background ) {
			$_bg                   = wolf_core_get_url_from_attachment_id( absint( $background ), 'medium' );
			$bg_style             .= 'background-image:url(' . $_bg . ')';
			$icon_container_class .= ' wolf-core-pi-has-bg';
		}

		$output .= '<span class="' . wolf_core_sanitize_html_classes( $class ) . '"><span class="wolf-core-icon-holder">';

		if ( is_array( $link ) && isset( $link['url'] ) && '' !== $link['url'] ) {
			$rel     = ( isset( $link['rel'] ) ) ? $link['rel'] : '';
			$target  = ( isset( $link['target'] ) ) ? $link['target'] : '_parent';
			$title   = ( isset( $link['title'] ) ) ? $link['title'] : '';
			$output .= '<a rel="' . esc_attr( $rel ) . '" class="wolf-core-process-item-inner"';
			$output .= ' target="' . esc_attr( $target ) . '"';
			$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $title ) . '">';
		} else {
			$output .= '<span class="wolf-core-process-item-inner">';
		}

		$output .= '<span class="wolf-core-process-item-line-before"></span>';

		$output .= '<span class="' . wolf_core_sanitize_html_classes( $icon_container_class ) . '" style="' . wolf_core_esc_style_attr( $bg_style ) . '">';

		if ( 'icon' === $type ) {

			$output .= wolf_core_render_icon( $selected_icon, array( 'aria-hidden' => 'true' ) );

		} elseif ( 'number' === $type ) {

			$output .= '<span class="wolf-core-process-number  ' . wolf_core_sanitize_html_classes( $graphic_class ) . '" style="' . wolf_core_esc_style_attr( $graphic_inline_style ) . '"></span>';
		}

		if ( is_array( $link ) && isset( $link['url'] ) && '' !== $link['url'] ) {
			$output .= '</a>';
		} else {
			$output .= '</span>';
		}

		$output .= '<span class="wolf-core-process-item-line-after"></span>';

		$output .= '</span><!--.wolf-core-icon-holder--></span><!--.wolf-core-icon-box-->';

		$output .= '</li>';
	}

	$output .= '</ul></div><!--.wolf-core-process-->';

	return $output;
}
