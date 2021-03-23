<?php // phpcs:ignore
/**
 * SB Instagram Feed shortcode template
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
			'num'                   => 18,
			'cols'                  => 6,
			'username'              => '',
			'accesstoken'           => '',
			'imagepadding'          => '',
			'showheader'            => 'false',
			'showbio'               => 'false',
			'showbutton'            => 'false',
			'showfollow'            => 'false',

			'follow_button'         => '',
			'button_text'           => '',

			'disable_default_hover' => '',

			'el_class'              => '',
			'css'                   => '',
			'inline_style'          => '',
		),
		$atts
	)
);

echo wolf_core_sb_instagram_feed( $atts ); // phpcs:ignore
