<?php
/**
 * Spotify Player
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the spotify markup
 *
 * @param array $atts The spotify attributes.
 */
function wolf_core_spotify_player( $atts ) {

	$atts = wp_parse_args(
		$atts,
		array(
			'url'                 => '',
			'type'                => '',
			'width'               => '',
			'height'              => '',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
		)
	);

	$atts = apply_filters( 'wolf_core_spotify_player_atts', $atts );

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class         = $el_class;
	$inline_style  = wolf_core_sanitize_css_field( $inline_style );
	$inline_style .= wolf_core_shortcode_custom_style( $css );

	/*Animate */
	if ( ! wolf_core_is_new_animation( $css_animation ) ) {
		$class        .= wolf_core_get_css_animation( $css_animation );
		$inline_style .= wolf_core_get_css_animation_delay( $css_animation_delay );
	}

	$class .= ' wolf-core-spotify-player-container wolf-core-element';

	$inline_style .= 'max-width:' . absint( $width ) . 'px';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	if ( 'compact' === $type ) {
		$height = 80;
	}

	if ( preg_match( '/https:\/\/open.spotify.com\/(artist|album|track|playlist)\/([A-Za-z0-9]+)/', $url, $match ) ) {
		if ( isset( $match[1] ) && isset( $match[2] ) ) {

			$output .= '<iframe src="https://open.spotify.com/embed/' . esc_attr( $match[1] ) . '/' . esc_attr( $match[2] ) . '" width="' . absint( $width ) . '" height="' . absint( $height ) . '" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>';
		}
	}

	$output .= '</div><!-- .wolf-core-spotify-container -->';

	return $output;
}