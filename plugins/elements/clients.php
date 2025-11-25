<?php
/**
 * Clients
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
function wolf_core_clients( $atts ) {

	$atts = apply_filters(
		'wolf_core_clients_atts',
		wp_parse_args(
			$atts,
			array(
				'type'                => 'grid',
				'columns'             => 4,
				'padding'             => 'yes',
				'img_size'            => 'thumbnail',
				'custom_img_size'     => '',
				'clients'             => array(),

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

	if ( 'carousel' === $type ) {

		wp_enqueue_script( 'flickity' );
		wp_enqueue_script( 'wolf-core-carousels' );
	}

	$figure_class = '';
	$figure_style = '';
	$link_start   = '';
	$link_end     = '';

	$class = $el_class; // init container CSS class.

	/* Animate one by one */
	if ( $css_animation_each ) {

		if ( ! wolf_core_is_new_animation( $css_animation ) ) {
			$figure_class .= wolf_core_get_css_animation( $css_animation );
		}
	} elseif ( ! wolf_core_is_new_animation( $css_animation ) ) {

			$class        .= wolf_core_get_css_animation( $css_animation );
			$inline_style .= wolf_core_get_css_animation_delay( $css_animation_delay );
	}

	/* Custom Size */
	if ( 'custom' === $img_size ) {
		$img_size = esc_attr( $custom_img_size );
	}

	$output = '';

	$class .= " wolf-clients wolf-core-clearfix wolf-core-clients-$type wolf-core-clients-padding-$padding wolf-core-element";

	if ( 'grid' === $type ) {
		$class .= " wolf-core-clients-columns-$columns";
	}

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	if ( ! $css_animation_each ) {
		$output .= wolf_core_element_aos_animation_data_attr( $atts );
	}

	$output .= '>';

	$single_animation_delay = ( $css_animation_delay ) ? $css_animation_delay : 0;

	if ( ! wolf_core_is_new_animation( $css_animation ) ) {
		$figure_style = 'animation-delay:' . absint( $single_animation_delay ) . 'ms;';
	}

	$uncover_animations = array(
		'uncoverXLeft',
		'uncoverXRight',
		'uncoverYTop',
		'uncoverYBottom',
	);

	$add_delay = ( in_array( $css_animation, $uncover_animations, true ) ) ? 300 : 200;

	foreach ( $clients as $client ) {

		$single_animation_delay = $single_animation_delay + $add_delay;

		$output .= "<figure class='$figure_class wolf-core-client wolf-core-client-$type' style='$figure_style'";

		$client = extract(
			apply_filters(
				'wolf_core_client_atts',
				wp_parse_args(
					$client,
					array(
						'title'       => '',
						'image'       => '',
						'image_hover' => '',
						'link'        => '',
					)
				)
			)
		);

		if ( is_array( $image ) && isset( $image['id'] ) ) {
			$image = $image['id'];
		}

		if ( is_array( $image_hover ) && isset( $image_hover['id'] ) ) {
			$image_hover = $image_hover['id'];
		}

		if ( $css_animation_each ) {
			$force                       = ( 'elementor' === wolf_core_get_plugin_in_use() ) ? true : false;
			$atts['css_animation_delay'] = $single_animation_delay;
			$output                     .= wolf_core_element_aos_animation_data_attr( $atts, $force );
		}

		$output .= '>';

		$link = wolf_core_process_link_atts( $link );

		if ( is_array( $link ) && ! empty( $link['url'] ) ) {
			$output .= '<a rel="' . esc_attr( $link['rel'] ) . '" class="wolf-core-link-mask"';
			$output .= ' target="' . esc_attr( $link['target'] ) . '"';
			$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '"></a>';
		}

		$inner_class = 'wolf-core-client-inner';

		if ( $image_hover ) {
			$inner_class .= ' wolf-core-client-has-hover-image';
		} else {
			$inner_class .= ' wolf-core-client-no-hover-image';
		}

		$output .= "<div class='$inner_class'>";

		/* Image */
		if ( $image ) {
			$output .= '<div class="wolf-core-client-image-inner">';

			if ( wp_attachment_is_image( $image ) ) {

				$img = wolf_core_get_img_by_size(
					array(
						'attach_id'  => $image,
						'thumb_size' => $img_size,
						'class'      => 'wolf-core-client-image',
					)
				);

				$output .= $img['thumbnail'];
			} else {
				$output .= wolf_core_placeholder_img( $img_size );
			}

			$output .= '</div>';
		}

		if ( $image_hover ) {
			$output .= '<div class="wolf-core-client-image-hover-inner">';

			if ( wp_attachment_is_image( $image_hover ) ) {

				$img = wolf_core_get_img_by_size(
					array(
						'attach_id'  => $image_hover,
						'thumb_size' => $img_size,
						'class'      => 'wolf-core-client-image-hover',
					)
				);

				$output .= $img['thumbnail'];
			} else {
				$output .= wolf_core_placeholder_img( $img_size );
			}

			$output .= '</div>';
		}

		$output .= '</div>';

		$output .= '</figure>';
	}

	/* Image Hover */

	$output .= '</div><!--.wolf-core-client-->';

	return $output;
}
