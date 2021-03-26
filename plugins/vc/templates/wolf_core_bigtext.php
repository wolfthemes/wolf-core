<?php // phpcs:ignore
/**
 * Bigtext shortcode template
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
			'font_family'         => '',
			'letter_spacing'      => 0,
			'font_weight'         => 700,
			'text_transform'      => 'none',
			'font_style'          => '',
			'color'               => '',
			'custom_color'        => '',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'text'                => '',
			'link'                => '',
			'title_tag'           => 'h4',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
		),
		$atts
	)
);

echo wolf_core_bigtext( $atts ); // phpcs:ignore
