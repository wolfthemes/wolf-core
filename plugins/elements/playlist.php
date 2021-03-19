<?php
/**
 * Playlist
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the playlist markup
 *
 * @param array $atts The playlist attributes.
 */
function wolf_core_playlist( $atts ) {
	$atts = wp_parse_args(
		$atts,
		array(
			'id'                  => '',
			'show_tracklist'      => '',
			'theme'               => '',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
		)
	);

	$atts = apply_filters( 'wolf_core_playlist_atts', $atts );

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

	$attrs = array(
		'show_tracklist' => wolf_core_shortcode_bool( $show_tracklist ),
		'theme'          => $theme,
	);

	$class .= ' wvc-wolf-playlist-shortcode-container wvc-element';

	ob_start();
	wpm_playlist( $id, $attrs );
	$playlist = ob_get_clean();

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= $playlist . '</div><!-- .wvc-wolf-playlist-shortcode-container -->';

	return $output;
}
