<?php
/**
 * Bandsintown Tracking Button
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
function wolf_core_bandsintown_traking_button( $atts ) {
	$atts = apply_filters(
		'wolf_core_bandsintown_traking_button_atts',
		wp_parse_args(
			$atts,
			array(
				'artist'                  => '',
				'size'                    => 'large',
				'alignment'               => 'center',
				'background_color'        => '',
				'background_custom_color' => '',
				'text_color'              => '',
				'text_custom_color'       => '',
				'css_animation'           => '',
				'css_animation_delay'     => '',
				'el_class'                => '',
				'css'                     => '',
				'inline_style'            => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-bandwintown-tracking-button wolf-core-element';
	$class .= " wolf-core-btb-align-$alignment";

	$artist      = wp_strip_all_tags( do_shortcode( $artist ) );
	$artist_slug = sanitize_title( $artist );

	if ( 'default' === $background_color ) {

		$background_color = '#00B4B3';

	} else {
		$background_color = wolf_core_convert_color_class_to_hex_value( $background_color, $background_custom_color );
	}

	$background_color = wolf_core_sanitize_color( $background_color );

	$hover_color = wolf_core_color_brightness( $background_color, -7 );

	if ( 'default' === $text_color ) {

		$text_color = '#FFFFFF';

	} else {
		$text_color = wolf_core_convert_color_class_to_hex_value( $text_color, $text_custom_color );
	}

	$text_color = wolf_core_sanitize_color( $text_color );

	if ( $artist ) {

		$artist = urldecode( $artist );

		$output = '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

		$output .= wolf_core_element_aos_animation_data_attr( $atts );
		$output .= '>';

		ob_start(); ?>
		<iframe src="https://www.bandsintown.com/artist/<?php echo esc_attr( $artist ); ?>/track_button?size=<?php echo esc_attr( $size ); ?>&display_tracker_count=true&text_color=<?php echo urlencode( $text_color ); ?>&background_color=<?php echo urlencode( $background_color ); ?>&hover_color=<?php echo urlencode( $hover_color ); ?>" height="32" width="165" scrolling="no" frameborder="0" style="border:none; overflow:hidden; display:block;"; allowtransparency="true" ></iframe>
		<?php
		$output .= ob_get_clean();

		$output .= '</div>';

	} elseif ( is_user_logged_in() ) {
			$output = esc_html__( 'Please set an artist.', 'wolf-core' );
	}

	return $output;
}
