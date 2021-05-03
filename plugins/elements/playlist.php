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
	$atts = apply_filters(
		'wolf_core_playlist_atts',
		wp_parse_args(
			$atts,
			array(
				'playlist_id'         => '',
				'show_tracklist'      => '',
				'theme'               => '',
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

	$attrs = array(
		'show_tracklist' => wolf_core_shortcode_bool( $show_tracklist ),
		'theme'          => $theme,
	);

	$class .= ' wvc-wolf-playlist-shortcode-container wvc-element';

	ob_start();
	wpm_playlist( $playlist_id, $attrs );
	$playlist = ob_get_clean();

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= $playlist . '</div><!-- .wvc-wolf-playlist-shortcode-container -->';

	return $output;
}
