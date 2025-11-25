<?php
/**
 * Blockquote
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
function wolf_core_blockquote( $atts ) {

	$atts = apply_filters(
		'wolf_core_blockquote_atts',
		wp_parse_args(
			$atts,
			array(
				'text'    => '',
				'tagline' => '',
				'cite'    => '',
				'avatar'  => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	if ( is_array( $avatar ) && isset( $avatar['id'] ) ) {
		$avatar = $avatar['id'];
	}

	$class .= ' wolf-core-blockquote wolf-core-element';

	$output .= '<wolf-core-blockquote><div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<div class="wolf-core-blockquote-inner">';

	if ( $tagline ) {
		$output .= '<div class="wolf-core-blockquote-tagline">';
		$output .= $tagline;
		$output .= '</div><!--.wolf-core-blockquote-tagline-->';
	}

	if ( $text ) {
		$output .= '<div class="wolf-core-blockquote-text">';
		$output .= '<blockquote>';
		$output .= $text;
		$output .= '</blockquote>';
		$output .= '</div><!--.wolf-core-blockquote-text-->';
	}

	if ( $avatar || $cite ) {
		$output .= '<div class="wolf-core-blockquote-author">';
	}

	if ( $avatar ) {

		$output .= '<div class="wolf-core-blockquote-avatar">';

		if ( wp_attachment_is_image( $avatar ) ) {
			$output .= wp_get_attachment_image( $avatar, 'thumbnail', false );
		} else {
			$output .= wolf_core_placeholder_img( 'thumbnail' );
		}

		$output .= '</div><!--.wolf-core-blockquote-avatar-->';

	}

	if ( $cite ) {
		$output .= '<cite class="wolf-core-blockquote-cite">';
		$output .= $cite;
		$output .= '</cite><!--.wolf-core-blockquote-cite-->';
	}

	if ( $avatar || $cite ) {
		$output .= '</div><!--.wolf-core-blockquote-author-->';
	}

	$output .= '</div><!--.wolf-core-blockquote-inner-->';
	$output .= '</div><!--.wolf-core-blockquote--></wolf-core-blockquote>';

	return $output;
}
