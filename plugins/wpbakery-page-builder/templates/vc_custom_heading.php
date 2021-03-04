<?php // phpcs:ignore
/**
 * Fittext shortcode template
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
			'font_size'           => '',
			'min_font_size'       => '',
			'responsive'          => true,
			'font_family'         => '',
			'letter_spacing'      => 0,
			'font_weight'         => '',
			'line_height'         => '',
			'text_transform'      => '',
			'font_style'          => '',
			'text_align'          => '',
			'color'               => '',
			'custom_color'        => '',
			'text'                => '',
			'tag'                 => 'h2',
			'link'                => '',
			'background_img'      => '',
			'background_position' => 'center center',
			'background_repeat'   => 'no-repeat',
			'background_size'     => 'cover',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
			'hide_class'          => '',
			'container'           => true,
		),
		$atts
	)
);

echo wolf_core_heading( $atts ); // phpcs:ignore
