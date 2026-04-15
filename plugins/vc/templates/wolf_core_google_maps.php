<?php // phpcs:ignore
/**
 * Google Maps shortcode template
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
			'type'                => 'simple',
			'locations'           => '',
			'size'                => '100%',
			'address'             => '',
			'zoom'                => 10,
			'map_skin'            => 'standard',
			'custom_map_skin'     => '',
			'marker'              => '',
			'marker_img'          => '',
			'marker_color'        => 'custom',
			'marker_custom_color' => '#F7584C',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
		),
		$atts
	)
);

echo wolf_core_google_maps( $atts ); // phpcs:ignore
