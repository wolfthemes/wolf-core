<?php
/**
 * Banner
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the Banner markup
 *
 * @param array $atts The Banner attributes.
 */
function wolf_core_banner( $atts ) {
	$atts = apply_filters(
		'wolf_core_banner_atts',
		wp_parse_args(
			$atts,
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
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	return $output;
}
