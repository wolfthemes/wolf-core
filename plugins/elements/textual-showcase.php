<?php
/**
 * Textual showcase
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
function wolf_core_textual_showcase( $atts ) {

	$atts = apply_filters(
		'wolf_core_textual_showcase_atts',
		wp_parse_args(
			$atts,
			array(
				'items'               => array(),
				'alignment'           => '',
				'font_family'         => '',
				'letter_spacing'      => '',
				'font_weight'         => '',
				'text_transform'      => '',
				'font_style'          => '',
				'type'                => '',
				'line_break'          => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'css_animation_each'  => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$item_class = '';
	$item_style = '';
	$link_start = '';
	$link_end   = '';

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= " wolf-core-textual-showcase wolf-core-textual-showcase-align-$alignment wolf-core-element";

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	if ( ! $css_animation_each ) {
		$output .= wolf_core_element_aos_animation_data_attr( $atts );
	}

	$output .= '>';

	$single_animation_delay = ( $css_animation_delay ) ? $css_animation_delay : 0;

	if ( ! wolf_core_is_new_animation( $css_animation ) ) {
		$item_style = 'animation-delay:' . absint( $single_animation_delay ) . 'ms;';
	}

	$uncover_animations = array(
		'uncoverXLeft',
		'uncoverXRight',
		'uncoverYTop',
		'uncoverYBottom',
	);

	$add_delay = ( in_array( $css_animation, $uncover_animations, true ) ) ? 300 : 200;

	foreach ( $items as $item ) {

		$single_animation_delay = $single_animation_delay + $add_delay;

		$item = extract( // phpcs:ignore
			apply_filters(
				'wolf_core_textual_showcase_item_atts',
				wp_parse_args(
					$item,
					array(
						'text'            => '',
						'type'            => 'text',
						'image'           => array(),
						'video'           => array(),
						'video_poster'    => array(),
						'img_size'        => '224x94',
						'custom_img_size' => '',
						'link'            => '',
						'el_class'        => '',
					)
				)
			)
		);

		$item_class = $el_class;

		$media_hover_type = array( 'text_hover_image', 'text_hover_video' );
		if ( in_array( $type, $media_hover_type, true ) ) {
			$item_class .= ' wolf-core-tsi-text_hover_media';
		}

		$output .= "<span class='$item_class wolf-core-textual-showcase-item wolf-core-tsi-$type wolf-core-tsi-line-break-$line_break' style='$item_style'";

		if ( $css_animation_each ) {
			$force                       = ( 'elementor' === wolf_core_get_plugin_in_use() ) ? true : false;
			$atts['css_animation_delay'] = $single_animation_delay;
			$output                     .= wolf_core_element_aos_animation_data_attr( $atts, $force );
		}

		$output .= '>';

		$content = '';

		$link = wolf_core_process_link_atts( $link );

		if ( is_array( $link ) && ! empty( $link['url'] ) ) {
			$content .= '<a rel="' . esc_attr( $link['rel'] ) . '" class="wolf-core-link-mask"';
			$content .= ' target="' . esc_attr( $link['target'] ) . '"';
			$content .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '"></a>';
		}

		if ( is_array( $image ) && isset( $image['id'] ) ) {
			$image = $image['id'];
		}

		if ( is_array( $image_hover ) && isset( $image_hover['id'] ) ) {
			$image_hover = $image_hover['id'];
		}

		/* Image */
		if ( 'image' === $type ) {

			if ( $image_hover ) {
				$img_wrapper_class = ' wolf-core-textual-showcase-image-has-hover-image';
			} else {
				$img_wrapper_class = ' wolf-core-textual-showcase-image-no-hover-image';
			}

			$content .= '<span class="wolf-core-textual-showcase-image-wrapper ' . esc_attr( $img_wrapper_class ) . '">';

			if ( $image ) {
				$content .= '<span class="wolf-core-textual-showcase-image-inner">';

				if ( wp_attachment_is_image( $image ) ) {

					$img = wolf_core_get_img_by_size(
						array(
							'attach_id'  => $image,
							'thumb_size' => $img_size,
							'class'      => 'wolf-core-textual-showcase-image',
						)
					);

					$content .= $img['thumbnail'];
				} else {
					$content .= wolf_core_placeholder_img( $img_size );
				}

				$content .= '</span>';
			}

			if ( $image_hover ) {
				$content .= '<span class="wolf-core-textual-showcase-image-hover-inner">';

				if ( wp_attachment_is_image( $image_hover ) ) {

					$img = wolf_core_get_img_by_size(
						array(
							'attach_id'  => $image_hover,
							'thumb_size' => $img_size,
							'class'      => 'wolf-core-textual-showcase-image-hover',
						)
					);

					$content .= $img['thumbnail'];
				} else {
					$content .= wolf_core_placeholder_img( $img_size );
				}

				$content .= '</span>';
			}

			$content .= '</span>';

		} elseif ( 'text_hover_image' === $type ) {

			$content .= '<span class="wolf-core-tsi-text-inner">' . do_shortcode( $text ) . '</span>';
			$content .= '<span class="wolf-core-tsi-hover-reveal"><span class="wolf-core-tsi-hover-reveal__inner">';

			if ( wp_attachment_is_image( $image ) ) {

				$image_src = wp_get_attachment_url( absint( $image ) );
				$img       = wolf_core_get_img_by_size(
					array(
						'attach_id'  => $image,
						'thumb_size' => '250x300',
						'class'      => 'wolf-core-tsi-hover-reveal__img',
					)
				);

				$content .= $img['thumbnail'];
				// $content  .= wp_get_attachment_image( $image, '250x300', '', array( 'class' => 'wolf-core-tsi-hover-reveal__img' ) );
			}

			$content .= '</span></span>';

		} elseif ( 'text_hover_video' === $type ) {

			if ( is_array( $video_poster ) && isset( $video_poster['id'] ) ) {
				$video_poster = $video_poster['id'];
			}

			$video_url = isset( $video['url'] ) ? $video['url'] : '';
			$video_id  = isset( $video['id'] ) ? $video['id'] : '';

			$content .= '<span class="wolf-core-tsi-text-inner">' . do_shortcode( $text ) . '</span>';
			$content .= '<span class="wolf-core-tsi-hover-reveal"><span class="wolf-core-tsi-hover-reveal__inner">';

			if ( wp_attachment_is( 'video', $video_id ) ) {

				$content .= wolf_core_video_bg(
					array(
						'video_bg_url'      => $video_url,
						'video_bg_img'      => $video_poster,
						'video_bg_img_size' => '250x300',
					)
				);
			}

			$content .= '</span></span>';

			/* Text */
		} else {
			$content .= '<span class="wolf-core-tsi-text-inner">' . do_shortcode( $text ) . '</span>';
		}

		$output .= $content;

		$output .= '</span>';

	} // end foreach.

	$output .= '</div><!--.wolf-core-textual-showcase-->';

	return $output;
}
