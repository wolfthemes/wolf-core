<?php
/**
 * Image Hover Video
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
function wolf_core_image_hover_video( $atts ) {

	$atts = apply_filters(
		'wolf_core_image_hover_video_atts',
		wp_parse_args(
			$atts,
			array(
				'image'           => '',
				'video'           => '',
				'img_size'        => '',
				'custom_img_size' => '',
				'link'            => '',
				'el_class'        => '',
				'css'             => '',
				'inline_style'    => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	if ( is_array( $image ) && isset( $image['id'] ) ) {
		$image_url = $image['url'];
		$image     = $image['id'];
	}

	if ( is_array( $video ) && isset( $video['url'] ) ) {
		$video = $video['url'];
	}

	$class .= ' wolf-core-image-hover-video wolf-core-element';

	$html_atts = wolf_core_render_html_attributes(
		array(
			'class' => wolf_core_sanitize_html_classes( $class ),
			'style' => wolf_core_esc_style_attr( $inline_style ),
		)
	);

	$output  = '<div ' . $html_atts;
	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	if ( is_array( $link ) && ! empty( $link['url'] ) ) {
		$output .= '<a rel="' . esc_attr( $link['rel'] ) . '" class="wolf-core-link-mask"';
		$output .= ' target="' . esc_attr( $link['target'] ) . '"';
		$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '"></a>';
	}

	if ( 'custom' === $img_size ) {
		$img_size = esc_attr( $custom_img_size );
	}

	if ( $video ) {
		$output .= '<video poster="' . esc_url( $image_url ) . '"  preload="auto" muted loop="loop"><source src="' . esc_url( $video ) . '" type="video/mp4"></video>';
	}

	if ( wp_attachment_is_image( $image ) ) {

		$img = wolf_core_get_img_by_size(
			array(
				'attach_id'  => $image,
				'thumb_size' => $img_size,
				'class'      => 'wolf-core-ihv-image',
			)
		);

		$output .= $img['thumbnail'];
	}

	$output .= '</div><!--.wolf-core-image-hover-video-->';

	return $output;
}
