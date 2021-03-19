<?php // phpcs:ignore
/**
 * Breadcrumb shortcode template
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
			'align'               => '',
			'text_align_mobile'   => '',
			'font_size'           => '',
			'font_weight'         => '',
			'text_transform'      => '',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
		),
		$atts
	)
);

echo wolf_core_breadcrumb( $atts ); // phpcs:ignore
