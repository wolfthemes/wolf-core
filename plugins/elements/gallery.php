<?php
/**
 * Gallery
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the element markup
 *
 * @param array $atts The element attributes.
 */
function wolf_core_gallery( $atts ) {

	$atts = apply_filters(
		'wolf_core_gallery_atts',
		wp_parse_args(
			$atts,
			array(
				'images'              => '',
				'type'                => 'image_grid',
				'metro_pattern'       => 'auto',
				'metro_fullheight'    => '',
				'metro_bg_size'       => 'cover',
				'img_size'            => 'medium',
				'custom_img_size'     => '',
				'slides_per_view'     => '',
				'autoplay'            => 'yes',
				'transition'          => 'auto',
				'slideshow_speed'     => 4000,
				'pause_on_hover'      => 'yes',
				'nav_dots_tone'       => 'light',
				'nav_arrows_tone'     => 'light',
				'nav_bullets'         => 'yes',
				'nav_arrows'          => 'yes',
				'group_cells'         => 'yes',
				'img_padding'         => '',
				'hover_effect'        => '',
				'add_caption'         => '',
				'custom_links'        => '',
				'onclick'             => '',
				'custom_links_target' => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'css_animation_each'  => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$images = wolf_core_process_gallery_atts( $images );

	debug( $images );

	return $output;
}
