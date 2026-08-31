<?php
/**
 * Twitter
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the twitter markup
 *
 * @param array $atts The twitter attributes.
 */
function wolf_core_twitter( $atts ) {

	$atts = apply_filters(
		'wolf_core_twitter_atts',
		wp_parse_args(
			$atts,
			array(
				'username'            => '',
				'type'                => '',
				'count'               => 3,
				'text_align'          => 'center',
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

	$username = esc_attr( str_replace( '@', '', $username ) );
	$count    = absint( $count );
	$type     = esc_attr( $type );

	$class .= ' wolf-core-wolf-twitter-shortcode-container wolf-core-element';

	if ( 'single' === $type ) {
		$class .= " wolf-core-wolf-twitter-shortcode-text-align-$text_align";
	}

	$output = '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= apply_filters( 'wolf_core_twitter_shortcode', do_shortcode( '[wolf_tweet username="' . $username . '" type="' . $type . '" count="' . $count . '"]' ) );

	$output .= '</div>';

	return $output;
}
