<?php
/**
 * Video Preview
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the video preview markup
 *
 * @param array $atts The video preview attributes.
 */
function wolf_core_video_preview( $atts ) {

	$atts = apply_filters(
		'wolf_core_video_preview_atts',
		wp_parse_args(
			$atts,
			array(
				'title'               => '',
				'url'                 => '',
				'image'               => '',
				'video_preview'       => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	wp_enqueue_script( 'froogaloop' );
	wp_enqueue_script( 'wolf-core-video-preview' );

	extract( $atts ); // phpcs:ignore

	if ( is_array( $image ) && isset( $image['id'] ) ) {
		$image = $image['id'];
	}

	if ( is_array( $video_preview ) && isset( $video_preview['id'] ) ) {
		$video_preview = $video_preview['url'];
	}

	$output      = '';
	$cover_style = '';

	$class = $el_class; // init container CSS class.

	$embed = wp_oembed_get( $url );

	$class .= ' wolf-core-embed-video-container wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= $embed;

	$output .= '<div class="wolf-core-embed-video-cover">';

	if ( wp_attachment_is_image( $image ) && ! $video_preview ) {

		$image_url    = wolf_core_get_url_from_attachment_id( $image, 'large' );
		$cover_style .= 'background-image:url(' . esc_url( $image_url ) . ');';

		$image_dominant_color = wolf_core_get_image_dominant_color( $image );

		if ( $image_dominant_color ) {
			$cover_style .= 'background-color:#' . $image_dominant_color . '';
		}

		$output .= '<div class="wolf-core-embed-video-cover-image" style="' . wolf_core_esc_style_attr( $cover_style ) . '"></div>';
	}

	$video_preview = ( '' !== $video_preview ) ? $video_preview : $url;

	if ( $video_preview ) {

		$output .= wolf_core_background_video(
			array(
				'video_bg_url' => $video_preview,
				'video_bg_img' => $image,
			)
		);
	}

	$output .= '<span class="wolf-core-embed-video-play-button"><i class="fa fa-youtube-play" aria-hidden="true"></i>';

	if ( $title ) {

		$output .= sprintf( apply_filters( 'wolf_core_embed_video_title', esc_html__( 'Watch %s', 'wolf-core' ) ), $title );

	} else {
		$output .= esc_html__( 'Play Video', 'wolf-core' );
	}

	$output .= '</span><!-- .wolf-core-embed-video-play-button -->';

	$output .= '</div><!-- .wolf-core-embed-video-cover -->';

	$output .= '</div><!-- .wolf-core-embed-video-container -->';

	return $output;
}
