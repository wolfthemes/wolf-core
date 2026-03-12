<?php // phpcs:ignore
/**
 * Album disc shortcode template
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
			'type'                => 'cd', // CD or vinyl.
			'alignment'           => '',
			'worn_border'         => 'yes',
			'rotate'              => '',
			'rotation_speed'      => '',
			'cover_image'         => '',
			'disc_image'          => '',
			'img_size'            => '375x375',
			'link'                => '',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
		),
		$atts
	)
);

echo wolf_core_album_disc( $atts ); // phpcs:ignore
