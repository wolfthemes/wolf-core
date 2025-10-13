<?php
/**
 * Bandsintown Events
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the Bandsintown events markup
 *
 * @param array $atts The Bandsintown events attributes.
 */
function wolf_core_bandsintown_events( $atts ) {

	$atts = apply_filters(
		'wolf_core_bandsintown_events_atts',
		wp_parse_args(
			$atts,
			array(
				'artist'              => '',
				'local_dates'         => 'true',
				'past_dates'          => 'true',
				'display_limit'       => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	if ( ! is_admin() ) {
		wp_enqueue_script( 'bandsintown', 'https://widget.bandsintown.com/main.min.js', array(), false, true ); // phpcs:ignore
	}

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-bandwintown-events wolf-core-element';

	$artist      = wp_strip_all_tags( do_shortcode( $artist ) );
	$artist_slug = sanitize_title( $artist );

	$options = array(
		'artist'           => $artist,
		'text_color'       => '',
		'background_color' => '',
		'display_limit'    => $display_limit,
		'link_text_color'  => '#ffffff',
		'link_color'       => apply_filters( 'wolf_core_theme_accent_color', '#0073AA' ), // accent color.
		'local_dates'      => $local_dates,
		'past_dates'       => $past_dates,
	);

	if ( $artist ) {

		$output .= '<div id="wolf-core-bandwintown-events-' . $artist_slug . '" class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

		$output .= wolf_core_element_aos_animation_data_attr( $atts );
		$output .= '>';

		$output .= '<a class="bit-widget-initializer"'
		. 'data-text-color="' . esc_attr( $options['text_color'] ) . '"'
		. 'data-background-color="' . esc_attr( $options['background_color'] ) . '"'
		. 'data-display-limit="' . esc_attr( $options['display_limit'] ) . '"'
		. 'data-link-text-color="' . esc_attr( $options['link_text_color'] ) . '"'
		. 'data-popup-background-color="#FFFFFF"'
		. 'data-artist-name="' . esc_attr( $options['artist'] ) . '"'
		. 'data-link-color="' . esc_attr( $options['link_color'] ) . '"'
		. 'data-display-local-dates="' . esc_attr( $options['local_dates'] ) . '"'
		. 'data-display-past-dates="' . esc_attr( $options['past_dates'] ) . '"'
		. 'data-auto-style="false"';
		$output .= '></a>';

		$output .= '</div><!-- .wolf-core-bandwintown -->';

	} elseif ( is_user_logged_in() ) {
			$output = esc_html__( 'Please set an artist.', 'wolf-visual-composer' );
	} else {
		$output = esc_html__( 'No event scheduled.', 'wolf-visual-composer' );
	}

	return $output; // WCS XSS ok.
}
