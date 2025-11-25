<?php
/**
 * Hour List
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
function wolf_core_hour_list( $atts ) {

	$atts = apply_filters(
		'wolf_core_hour_list_atts',
		wp_parse_args(
			$atts,
			array(
				'hours'               => array(),
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

	$class .= ' wolf-core-hour-list-container wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= "<ul class='wolf-core-hour-list'>";

	foreach ( $hours as $hour_item ) {

		$output .= '<li class="wolf-core-h-container">';

		$hour_item = extract(
			apply_filters(
				'wolf_core_hour_atts',
				wp_parse_args(
					$hour_item,
					array(
						'day'        => '',
						'hours_text' => '',
					)
				)
			)
		);

		if ( $day ) {
			$output .= '<span class="wolf-core-h-day">' . wolf_core_kses( $day ) . '</span>';
		}

		if ( $day && $hours ) {
			$output .= '<span class="wolf-core-h-line"></span>';
		}

		if ( $hours_text ) {
			$output .= '<span class="wolf-core-h-hours">' . wolf_core_kses( $hours_text ) . '</span>';
		}

		$output .= '</li>';
	}

	$output .= '</ul></div><!--.wolf-core-hour-list-->';

	return $output;
}
