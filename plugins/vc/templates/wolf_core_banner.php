<?php // phpcs:ignore
/**
 * Banner shortcode template
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
			'image'                     => '',
			'img_size'                  => '',
			'custom_img_size'           => '',
			'alignment'                 => '',
			'max_width'                 => '',
			'link'                      => '',
			'overlay_color'             => '',
			'overlay_custom_color'      => '',
			'overlay_text_color'        => '',
			'overlay_text_custom_color' => '',
			'overlay_opacity'           => '',
			'txt_align'                 => '',
			'txt_v_align'               => '',
			'title'                     => '',
			'title_font_size'           => '',
			'title_tag'                 => 'h3',
			'tagline'                   => '',
			'add_button'                => '',
			'btn_title'                 => esc_html__( 'My Button', 'wolf-core' ),
			'btn_link'                  => '',
			'btn_color'                 => '',
			'btn_custom_color'          => '',
			'btn_shape'                 => '',
			'btn_style'                 => '',
			'btn_size'                  => '',
			'btn_button_block'          => '',
			'btn_hover_effect'          => '',
			'btn_font_weight'           => '',
			'btn_add_icon'              => '',
			'btn_i_align'               => '',
			'btn_i_type'                => '',
			'btn_i_icon'                => '',
			'btn_i_hover'               => '',
			'css_animation'             => '',
			'css_animation_delay'       => '',
			'el_class'                  => '',
			'css'                       => '',
			'inline_style'              => '',
		),
		$atts
	)
);

echo wolf_core_banner( $atts ); // phpcs:ignore
