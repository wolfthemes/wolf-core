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

	foreach ( $hours as $hour ) {

		$output .= '<li class="wolf-core-process-item">';

		$hour = extract(
			apply_filters(
				'wolf_core_hour_atts',
				wp_parse_args(
					$hour,
					array(
						'type' => 'icon',
						'title' => '',
						'text' => '',

					)
				)
			)
		);

		$output .= '</li>';
	}

	$output .= '</ul><!--.wolf-core-process-->';

	return $output;
}
