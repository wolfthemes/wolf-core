<?php
/**
 * Hour List
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
function wolf_core_gallery_banner( $atts ) {

	$atts = apply_filters(
		'wolf_core_gallery_banner_atts',
		wp_parse_args(
			$atts,
			array(
				'cover_image'         => '',
				'images'              => '',
				'img_size'            => 'medium',
				'banner_title'        => '',
				'title_tag'           => 'h4',
				'custom_img_size'     => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	if ( is_array( $cover_image ) && isset( $cover_image['id'] ) ) {
		$cover_image = $cover_image['id'];
	}

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-gallery-banner-container wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$images_count = 0;

	if ( $images ) {

		// $images = wolf_core_list_to_array( $images );
		$images_count = count( $images );

		$image_params = array();

		foreach ( $images as $image ) {

			$attachment_id = $image['id'];

			$attachment = get_post( $attachment_id );

			if ( $attachment ) {
				$img_src     = esc_url( wolf_core_get_url_from_attachment_id( $attachment_id, 'wolf-core-XL' ) );
				$img_title   = wptexturize( $attachment->post_title );
				$img_caption = wptexturize( $attachment->post_excerpt );

				$image_params[] = array(
					'src'  => $img_src,
					'opts' => array(
						'caption' => $img_caption,
					),
				);
			}
		}

		$link_title = '';

		$output .= '<a class="wolf-core-banner-link-mask wolf-core-gallery-quickview" data-gallery-params="' . esc_js( json_encode( $image_params ) ) . '" href="#" title="' . esc_attr( $link_title ) . '"></a>';
	}

	/* Custom Size */
	if ( 'custom' === $img_size ) {
		$img_size = esc_attr( $custom_img_size );
	}

	$output .= '<div class="wolf-core-gallery-banner-image">';

	if ( ! in_array( $img_size, array( 'thumbnail', 'medium', 'large', 'wolf-core-XL', 'full' ), true ) ) {

		if ( wp_attachment_is_image( $cover_image ) ) {

			$img = wolf_core_get_img_by_size(
				array(
					'attach_id'  => $cover_image,
					'thumb_size' => $img_size,
				)
			);

			$output .= $img['thumbnail'];
		} else {
			$output .= wolf_core_placeholder_img( $img_size );
		}
	} elseif ( wp_attachment_is_image( $cover_image ) ) {
			$output .= wp_get_attachment_image( $cover_image, $img_size, false );
	} else {
		$output .= wolf_core_placeholder_img( $img_size );
	}

	$output .= '<div class="wolf-core-gallery-banner-image-caption">';

	if ( $banner_title ) {
		$output .= '<' . esc_attr( $title_tag ) . ' class="wolf-core-banner-title">';

		$output .= sanitize_text_field( $banner_title );

		$output .= '</' . esc_attr( $title_tag ) . '>';
	}

	if ( $images_count ) {
		$output .= '<span class="wolf-core-banner-tagline">';

		$output .= sprintf( esc_html( '%d photos' ), absint( $images_count ) );

		$output .= '</span>';
	}

	$output .= '</div><!--.wolf-core-gallery-banner-image-caption-->';

	$output .= '</div><!--.wolf-core-gallery-banner-image-->';

	$output .= '</ul></div><!--.wolf-core-gallery-banner-container-->';

	return $output;
}
