<?php
/**
 * Album Disc
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the album disc markup
 *
 * @param array $atts The album disc attributes.
 */
function wolf_core_album_disc( $atts ) {

	$atts = apply_filters(
		'wolf_core_album_disc_atts',
		wp_parse_args(
			$atts,
			array(
				'type'                => 'cd', // CD or vinyl.
				'alignment'           => '',
				'worn_border'         => 'no',
				'rotate'              => '',
				'rotation_speed'      => '',
				'cover_image'         => '',
				'disc_image'          => '',
				'img_size'            => '375x375',
				'link'                => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'el_id'               => '',
				'css'                 => '',
				'inline_style'        => '',
				'data_attrs'          => array(),
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$data_attrs = apply_filters( 'wolf_core_album_disc_data_attrs', $data_attrs, $atts );

	if ( is_array( $cover_image ) && isset( $cover_image['id'] ) ) {
		$cover_image = $cover_image['id'];
	}

	if ( is_array( $disc_image ) && isset( $disc_image['id'] ) ) {
		$disc_image = $disc_image['id'];
	}

	$output = '';

	// Disc animation.
	wp_enqueue_script( 'wow' );
	wp_enqueue_script( 'waypoints' );
	wp_enqueue_style( 'animate-css' );

	$class = $el_class; // init container CSS class.

	if ( is_array( $link ) ) {
		$class .= ' wolf-core-album-disc-has-link';
	}

	$class .= " wolf-core-album-disc wolf-core-album-disc-align-$alignment wolf-core-album-disc-$type wolf-core-album-disc-worn-border-$worn_border wolf-core-album-disc-rotate-$rotate wolf-core-element";

	$data_attr = '';

	foreach ( $data_attrs as $k => $v ) {
		$data_attr .= 'data-' . $k . '="' . $v . '"';
	}

	$output = '<div ' . $data_attr . ' class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	if ( is_array( $link ) && isset( $link['url'] ) && '' !== $link['url'] ) {
		$output .= '<a rel="' . esc_attr( $link['rel'] ) . '" class="wolf-core-album-disc-link-mask"';
		$output .= ' target="' . esc_attr( $link['target'] ) . '"';
		$output .= ' href="' . esc_url( $link['url'] ) . '"></a>';
	} else {
		$output .= '<a class="wolf-core-album-disc-link-mask"';
		$output .= ' href="' . get_the_permalink() . '"></a>';
	}

	$output .= '<div class="wolf-core-album-disc-cover-container">';

	if ( ! $disc_image ) {
		$disc_image = $cover_image;
	}

	if ( $disc_image ) {

		$disc_animation_delay = ( absint( $css_animation_delay ) + 400 ) / 1000 . 's';

		$output .= '<div class="wolf-core-album-disc-disc-container wow wolf-core-album-disc-reveal" style="' . wolf_core_esc_style_attr( 'transition-delay:' . $disc_animation_delay ) . ';">';

		$inner_style = '';
		if ( $rotation_speed ) {
			$rotation_speed = absint( $rotation_speed ) / 1000 . 's';
			$inner_style    = ' style="animation-duration:' . esc_attr( $rotation_speed ) . ';"';
		}

		$output .= '<div class="wolf-core-album-disc-disc-inner" ' . $inner_style . '>';

		if ( wp_attachment_is_image( $disc_image ) ) {

			$img = wolf_core_get_img_by_size(
				array(
					'attach_id'  => $disc_image,
					'thumb_size' => $img_size,
					'class'      => 'wolf-core-album-disc-disc-img',
				)
			);

			$output .= $img['thumbnail'];
		} else {
			$output .= wolf_core_placeholder_img( $img_size, 'wolf-core-album-disc-disc-img' );
		}

		if ( 'cd' === $type ) {
			$output .= '<div class="wolf-core-album-disc-disc-text"></div>';
			$output .= '<div class="wolf-core-album-disc-disc-hole"></div>';
		}

		if ( 'vinyl' === $type ) {
			$output .= '<div class="wolf-core-vinyl"></div>';
		}

		$output .= '</div>';

		$output .= '</div>';
	}

	if ( $cover_image ) {

		$output .= '<div class="wolf-core-album-disc-cover-inner wow wolf-core-album-cover-reveal">';

		if ( wp_attachment_is_image( $cover_image ) ) {

			$img = wolf_core_get_img_by_size(
				array(
					'attach_id'  => $cover_image,
					'thumb_size' => $img_size,
					'class'      => 'wolf-core-album-disc-cover-img',
				)
			);

			$output .= $img['thumbnail'];

		} else {
			$output .= wolf_core_placeholder_img( $img_size, 'wolf-core-album-disc-cover-img' );
		}

		$output .= '<div class="wolf-core-album-disc-cover-border"></div>';
		$output .= '</div><!-- .wolf-core-album-disc-cover-inner -->';
	}

	$output .= '</div><!-- .wolf-core-album-disc-cover-container -->';
	$output .= '</div><!-- .wolf-core-album-disc -->';

	return $output;
}
