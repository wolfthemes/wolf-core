<?php
/**
 * Video Opener
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the video opener markup
 *
 * @param array $atts The video opener attributes.
 */
function wolf_core_video_opener( $atts ) {

	$atts = apply_filters(
		'wolf_core_video_opener_atts',
		wp_parse_args(
			$atts,
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
			)
		)
	);

	/* Enqueue video lightbox script */
	wp_enqueue_script( 'lity' );

	extract( $atts ); // phpcs:ignore

	if ( is_array( $button_image ) && isset( $button_image['id'] ) ) {
		$button_image = $button_image['id'];
	}

	$output       = '';
	$caption_html = '';

	$class = $el_class; // init container CSS class.

	$video_url = esc_url( $video_url );

	$class .= " wolf-core-video-opener-container wolf-core-video-opener-align-$alignment wolf-core-element";
	$class .= " wolf-core-video-opener-caption-position-$caption_position";

	if ( $attention_seeker ) {
		$class .= ' wolf-core-video-opener-attention-seeker';
	}

	if ( ! $custom_play_button ) {
		$class .= ' wolf-core-video-opener-default';
	}

	if ( 'none' !== $caption_position ) {
		$caption_html .= '<div class="wolf-core-video-opener-caption" style="animation-delay:1600ms;-webkit-animation-delay:1600ms">';

		$caption_html .= '<span class="wolf-core-video-opener-caption-text">';
		$caption_html .= esc_attr( $caption );
		$caption_html .= '</span><!-- .wolf-core-video-opener-caption-text -->';

		if ( $caption && $duration ) {
			$caption_html .= '<span class="wolf-core-video-opener-caption-separator">';
			$caption_html .= ' &mdash; ';
			$caption_html .= '</span>';
		}

		if ( $duration ) {
			$caption_html .= '<span class="wolf-core-video-opener-duration">';
			$caption_html .= esc_attr( $duration );
			$caption_html .= '</span><!-- .wolf-core-video-opener-duration -->';
		}

		$caption_html .= '</div><!-- .wolf-core-video-opener-caption -->';
	}

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<div class="wolf-core-video-opener-caption-container">';

	if ( 'left' === $caption_position || 'top' === $caption_position ) {
		$output .= $caption_html;
	}

	$output .= '<a href="#" data-video-url="' . esc_url( $video_url ) . '" class="wolf-core-video-opener">';

	if ( $custom_play_button && $button_image ) {

		$img_class = 'wolf-core-vo-custom-button-img';
		$img_size  = 'thumbnail';

		if ( wp_attachment_is_image( $button_image ) ) {

			$img = wolf_core_get_img_by_size(
				array(
					'attach_id'  => $button_image,
					'thumb_size' => $img_size,
					'class'      => $img_class,
				)
			);

			$output .= $img['thumbnail'];

		} else {
			$output .= wolf_core_placeholder_img( $img_size, $img_class );
		}
	} else {
		$output .= apply_filters( 'wolf_core_default_video_opener_button', wolf_core_animated_svg( WOLF_CORE_URI . '/assets/css/lib/linea-icons/svg/_music/_SVG/music_play_button.svg' ) );
	}

	$output .= '</a>';

	if ( 'right' === $caption_position || 'bottom' === $caption_position ) {
		$output .= $caption_html;
	}

	$output .= '</div><!-- .wolf-core-video-opener-caption-position -->';

	$output .= '</div><!-- .wolf-core-video-opener -->';

	return $output;
}
