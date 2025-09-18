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
				'font_size'                 => '',
				'font_family'               => '',
				'letter_spacing'            => '',
				'line_height'               => '',
				'font_weight'               => '',
				'text_transform'            => '',
				'font_style'                => '',
				'text_decoration'           => '',
				'overlay_color'             => '',
				'overlay_custom_color'      => '',
				'overlay_text_color'        => '',
				'overlay_text_custom_color' => '',
				'overlay_opacity'           => '',
				'align'                     => '',
				'txt_align'                 => '',
				'txt_v_align'               => '',
				'title'                     => '',
				'title_tag'                 => 'h3',
				'tagline'                   => '',
				'add_button'                => '',
				'btn_title'                 => esc_html__( 'Click Here', 'wolf-core' ),
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

	// If elementor get image ID.
	if ( is_array( $image ) && isset( $image['id'] ) ) {
		$image = $image['id'];
	}

	$output      = '';
	$text_color  = '';
	$text_style  = '';
	$title_style = '';

	$class = $el_class; // init container CSS class.

	if ( $max_width ) {
		$max_width     = wolf_core_sanitize_css_value( $max_width );
		$inline_style .= "max-width:$max_width;";
	}

	/* Custom Size */
	if ( 'custom' === $img_size ) {
		$img_size = esc_attr( $custom_img_size );
	}

	$class .= ' wolf-core-banner wolf-core-element';
	$class .= " wolf-core-banner-alignment-$alignment wolf-core-banner-text-align-$txt_align wolf-core-banner-text-vertical-align-$txt_v_align";

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	if ( is_array( $link ) && ! empty( $link['url'] ) ) {
		$output .= '<a class="wolf-core-banner-link-mask" rel="' . esc_attr( $link['rel'] ) . '" ';
		$output .= ' target="' . esc_attr( $link['target'] ) . '"';
		$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '"></a>';
	}

	$output .= '<div class="wolf-core-banner-image">';

	if ( ! in_array( $img_size, array( 'thumbnail', 'medium', 'large', 'wolf-core-XL', 'full' ), true ) ) {

		if ( wp_attachment_is_image( $image ) ) {

			$img = wolf_core_get_img_by_size(
				array(
					'attach_id'  => $image,
					'thumb_size' => $img_size,
				)
			);

				$output .= $img['thumbnail'];
		} else {
			$output .= wolf_core_placeholder_img( $img_size );
		}
	} elseif ( wp_attachment_is_image( $image ) ) {
			$output .= wp_get_attachment_image( $image, $img_size, false );
	} else {
		$output .= wolf_core_placeholder_img( $img_size );
	}

	$output .= '</div><!--.wolf-core-banner-image-->';

	/* Overlay */
	$dominant_color = wolf_core_get_image_dominant_color( get_post_thumbnail_id() );

	if ( $dominant_color && 'auto' === $overlay_color ) {
		$overlay_custom_color = $dominant_color;
	}

	$output .= wolf_core_background_overlay(
		array(
			'overlay_color'        => $overlay_color,
			'overlay_custom_color' => $overlay_custom_color,
			'overlay_opacity'      => $overlay_opacity,
		)
	);

	$output .= '<div class="wolf-core-banner-caption">';

	$output .= '<div class="wolf-core-banner-caption-table">';

	$output .= '<div class="wolf-core-banner-caption-table-cell">';

	if ( $title ) {
		$output .= '<' . esc_attr( $title_tag ) . ' class="wolf-core-banner-title" style="' . wolf_core_esc_style_attr( $title_style ) . '">';
		$output .= sanitize_text_field( $title );
		$output .= '</' . esc_attr( $title_tag ) . '>';
	}

	if ( $tagline ) {
		$output .= '<span class="wolf-core-banner-tagline" style="' . wolf_core_esc_style_attr( $text_style ) . '">';
		$output .= sanitize_text_field( $tagline );
		$output .= '</span>';
	}

	$output .= '</div><!--.wolf-core-banner-caption-table-cell-->';

	$output .= '</div><!--.wolf-core-banner-caption-table-->';

	$output .= '</div><!--.wolf-core-banner-caption-->';

	$output .= '</div><!--.wolf-core-banner-->';

	return $output;
}
