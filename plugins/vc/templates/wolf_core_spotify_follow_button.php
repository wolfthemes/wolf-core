<?php // phpcs:ignore
/**
 * Spotify Follow Button shortcode template
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( // phpcs:ignore
	shortcode_atts(
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
		),
		$atts
	)
);

echo wolf_core_spotify_follow_button( $atts ); // phpcs:ignore
