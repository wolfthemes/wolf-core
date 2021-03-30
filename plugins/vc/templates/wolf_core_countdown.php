<?php // phpcs:ignore
/**
 * Countdown shortcode template
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
			'date'                     => '12/24/2020 12:00:00',
			'format'                   => 'dHMS',
			'custom_format'            => '',
			'offset'                   => -5,
			'message'                  => esc_html__( 'Done!', 'wolf-visual-composer' ),
			'font_family'              => '',
			'font_size'                => '',
			'font_weight'              => '',
			'number_font_color'        => '',
			'number_font_custom_color' => '',
			'text_font_color'          => '',
			'text_font_custom_color'   => '',
			'css_animation'            => '',
			'css_animation_delay'      => '',
			'el_class'                 => '',
			'css'                      => '',
			'inline_style'             => '',
		),
		$atts
	)
);

echo wolf_core_countdown( $atts ); // phpcs:ignore
