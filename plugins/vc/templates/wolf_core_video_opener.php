<?php // phpcs:ignore
/**
 * Video opener shortcode template
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
			'custom_play_button'  => '',
			'button_image'        => '',
			'alignment'           => 'center',
			'video_url'           => '',
			'attention_seeker'    => '',
			'caption_position'    => '',
			'caption'             => '',
			'duration'            => '',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
		),
		$atts
	)
);

echo wolf_core_video_opener( $atts ); // phpcs:ignore
