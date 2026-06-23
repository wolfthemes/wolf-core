<?php
/**
 * Price List
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
function wolf_core_price_list( $atts ) {

	$atts = apply_filters(
		'wolf_core_price_list_atts',
		wp_parse_args(
			$atts,
			array(
				'prices'              => array(),
				'title_tag'           => 'h3',
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

	$class .= ' wolf-core-price-list-container wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= "<ul class='wolf-core-price-list'>";

	foreach ( $prices as $price_item ) {

		$output .= '<li class="wolf-core-price-item">';

		$price_item = extract(
			apply_filters(
				'wolf_core_price_item_atts',
				wp_parse_args(
					$price_item,
					array(
						'title'       => '',
						'price'       => '',
						'description' => '',
					)
				)
			)
		);

		$output .= '<span class="wolf-core-price-item-title-container">';

		if ( $title ) {
			$output .= '<span class="wolf-core-price-item-title">' . wolf_core_kses( $title ) . '</span>';
		}

		if ( $title && $price ) {
			$output .= '<span class="wolf-core-price-item-line"></span>';
		}

		if ( $price ) {
			$output .= '<span class="wolf-core-price-item-price">' . wolf_core_kses( $price ) . '</span>';
		}

		$output .= '</span><!--.wolf-core-price-item-title-container-->';

		if ( $description ) {
			$output .= '<span class="wolf-core-price-item-description">' . wolf_core_kses( $description ) . '</span>';
		}

		$output .= '</li>';
	}

	$output .= '</ul></div><!--.wolf-core-price-list-->';

	return $output;
}
