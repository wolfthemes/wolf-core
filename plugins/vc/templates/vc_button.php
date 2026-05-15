<?php // phpcs:ignore
/**
 * Button template
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$vc_atts = $atts;
$atts    = apply_filters( 'wolf_core_button_vc_atts', vc_map_get_attributes( $this->getShortcode(), $vc_atts ), $vc_atts );

extract( // phpcs:ignore
	shortcode_atts(
		array(
			'button_type'                   => '',
			'text'                          => '',
			'link'                          => '',
			'align'                         => '',
			'size'                          => '',
			'shape'                         => '',
			'selected_icon'                 => '',
			'icon'                          => '',
			'icon_align'                    => 'before',
			'icon_indent'                   => '',
			'button_css_id'                 => '',
			'text_shadow'                   => '',
			'button_text_color'             => '',
			'background_color'              => '',
			'hover_color'                   => '',
			'button_background_hover_color' => '',
			'button_hover_border_color'     => '',
			'hover_animation'               => '',
			'border'                        => '',
			'border_radius'                 => '',
			'box_shadow'                    => '',
			'text_padding'                  => '',
			'scroll_to_anchor'              => '',
			'icon_hover_reveal'             => '',
		),
		$atts
	)
);

echo wolf_core_button( $atts ); // phpcs:ignore
