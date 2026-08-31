<?php
/**
 * Rotating Text
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
function wolf_core_rotating_text( $atts ) {

	$atts = apply_filters(
		'wolf_core_rotating_text_atts',
		wp_parse_args(
			$atts,
			array(
				'text'           => '',
				'svg_width'      => '200',
				'link'           => '',
				'rotating_speed' => '',
				'selected_icon'  => '',
				'scroll_link'    => '',
				'el_class'       => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	// debug( $atts );

	$link = wolf_core_process_link_atts( $link );

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-rotating-text wolf-core-element';

	$svg_inline_style = '';

	// $svg_inline_style = 'margin-left: -' . absint( absint( $width ) / 4 ) . 'px; margin-top: -' . absint( absint( $width ) / 4 ) . 'px;';

	if ( $rotating_speed ) {
		$svg_inline_style .= ' animation-duration:' . absint( $rotating_speed ) . 's';
	}

	if ( $svg_width ) {
		$inline_style .= ' width:' . absint( $svg_width ) . 'px; height:' . absint( $svg_width ) . 'px;';
	}

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';
	$output .= wolf_core_element_aos_animation_data_attr( $atts );

	$output .= '>';

	if ( is_array( $link ) && ! empty( $link['url'] ) ) {
		$link_class = 'wolf-core-rotating-text-link';

		if ( $scroll_link ) {
			$link_class .= ' wolf-core-scroll';
		}

		$output .= '<a rel="' . esc_attr( $link['rel'] ) . '" class="' . esc_attr( $link_class ) . '"';
		$output .= ' target="' . esc_attr( $link['target'] ) . '"';
		$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '">';
	} else {
		$output .= '<span class="wolf-core-rotating-text-link">';
	}

	if ( $selected_icon ) {
		// if ( 'svg' === $selected_icon['library'] ) {
		// ob_start();
		// echo wolf_core_render_icon( $selected_icon, array( 'aria-hidden' => 'true' ) );
		// $output .= ob_get_clean();

		// } else {
			$output .= wolf_core_render_icon( $selected_icon, array( 'aria-hidden' => 'true' ) );
		// }

	}

	$output .= '<svg class="wolf-core-rotating-text-svg" style="' . wolf_core_esc_style_attr( $svg_inline_style ) . '" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="100px" viewBox="0 0 300 300" enable-background="new 0 0 300 300" xml:space="preserve">
	<defs><path id="circlePath" d="M 150, 150 m -60, 0 a 60,60 0 0,1 120,0 a 60,60 0 0,1 -120,0 "></path>
	</defs><circle cx="150" cy="100" r="75" fill="none"></circle> <g> <use xlink:href="#circlePath" fill="none"></use>
	<text fill="#fff"><textPath xlink:href="#circlePath">' . esc_attr( $text ) . '</textPath> </text> </g> </svg>';
	$output .= '</div><!--.wolf-core-rotating-text-->';

	if ( is_array( $link ) && ! empty( $link['url'] ) ) {
		$output .= '</a>';
	} else {
		$output .= '</span>';
	}

	return $output;
}
