<?php
/**
 * Spotify Follow Button
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the spotify follow button markup
 *
 * @param array $atts The spotify follow button attributes.
 */
function wolf_core_spotify_follow_button( $atts ) {

	$atts = apply_filters(
		'wolf_core_spotify_follow_button_atts',
		wp_parse_args(
			$atts,
			array(
				'url'                 => '',
				'size'                => 'detail',
				'show_count'          => true,
				'theme'               => 'light',
				'alignment'           => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	return;

	extract( $atts ); // phpcs:ignore

	$output      = '';
	$cover_style = '';

	$class = $el_class; // init container CSS class.

	$class .= " wolf-core-spotify-follow-button-container wolf-core-align-$alignment wolf-core-element";

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$width  = 300;
	$height = 56;

	if ( 'basic' === $size ) {
		$width  = 200;
		$height = 25;
	}

	if ( preg_match( '/https:\/\/open.spotify.com\/artist\/([A-Za-z0-9]+)/', $url, $match ) ) {
		if ( isset( $match[1] ) ) {

			$show_count = wolf_core_shortcode_bool( $show_count );

			$output .= '<iframe src="https://open.spotify.com/follow/1/?uri=spotify:artist:' . esc_attr( $match[1] ) . '&size=' . esc_attr( $size ) . '&theme=' . esc_attr( $theme ) . '&show-count=' . esc_attr( $show_count ) . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '" scrolling="no" frameborder="0" style="border:none; overflow:hidden;" allowtransparency="true"></iframe>';
		}
	}

	$output .= '</div><!-- .wolf-core-spotify-container -->';

	return $output;
}
