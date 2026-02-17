<?php
/**
 * Interactive Links
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
function wolf_core_interactive_links( $atts ) {

	$atts = apply_filters(
		'wolf_core_interactive_links_atts',
		wp_parse_args(
			$atts,
			array()
		)
	);

	extract( $atts ); // phpcs:ignore

	// wp_enqueue_script( 'wolf-core-youtube-video-bg' );
	// wp_enqueue_script( 'wolf-core-interactive-links' );

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-interactive-links wolf-core-interactive-links-container';

	$output = '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$output .= '<div class="wolf-core-interactive-links-bg-holder">';

	$i = 1;
	foreach ( $panels as $panel_bg_atts ) {
		$panel_bg_atts = apply_filters(
			'wolf_core_interactive_links_bg_atts',
			wp_parse_args(
				$panel_bg_atts,
				array(
					'background_background' => '',
				)
			),
			$atts
		);

		extract( $panel_bg_atts ); // phpcs:ignore

		$current_class = ( 0 === $i ) ? 'panel-current' : '';

		$output .= '<div class="wolf-core-interactive-link-bg ' . $current_class . '" id="wolf-core-interactive-link-bg-' . absint( $i ) . '">';

		if ( 'classic' === $background_background ) {

			$background_repeat   = ( isset( $panel_bg_atts['background_repeat'] ) ) ? $panel_bg_atts['background_repeat'] : '';
			$background_position = ( isset( $panel_bg_atts['background_position'] ) ) ? $panel_bg_atts['background_position'] : '';
			$background_size     = ( isset( $panel_bg_atts['background_size'] ) ) ? $panel_bg_atts['background_size'] : '';

			$output .= wolf_core_background_img(
				array(
					'background_img'      => esc_attr( $background_image['id'] ),
					'background_position' => esc_attr( $background_position ),
					'background_repeat'   => esc_attr( $background_repeat ),
					'background_size'     => esc_attr( $background_size ),
				)
			);

		} elseif ( 'video' === $background_background && $background_video_link ) {

			$output .= wolf_core_background_video(
				array(
					'video_bg_url'        => $background_video_link,
					'video_bg_img'        => $background_video_fallback['url'],
					'video_bg_start_time' => $background_video_start,
					'video_bg_end_time'   => $background_video_end,
				)
			);
		}

		$output .= '</div>';

		++$i;
	}

	$output .= '</div>';

	$output .= '<div class="wolf-core-interactive-links-inner">';
	$output .= '<ul class="wolf-core-interactive-links-list">';

	$i = 1;
	foreach ( $panels as $panel_txt_atts ) {
		$panel_txt_atts = apply_filters(
			'wolf_core_interactive_links_text_atts',
			wp_parse_args(
				$panel_txt_atts,
				array(
					'title' => '',
					'link'  => '',
				)
			)
		);
		extract( $panel_txt_atts ); // phpcs:ignore

		$link          = wolf_core_process_link_atts( $link );
		$current_class = ( 0 === $i ) ? 'link-active' : '';

		$output .= '<li class="wolf-core-interactive-link-item" id="wolf-core-interactive-link-item-' . absint( $i ) . '">';

		if ( is_array( $link ) && isset( $link['url'] ) ) {
			$output .= '<a class="wolf-core-interactive-link ' . esc_attr( $current_class ) . '" data-panel-index="' . absint( $i ) . '"';
			$output .= ' target="' . esc_attr( $link['target'] ) . '"';
			$output .= ' href="' . esc_url( $link['url'] ) . '" title="' . esc_attr( $link['title'] ) . '">';
		}

		$output .= apply_filters( 'wolf_core_interactive_link_start', '', $panel_txt_atts );

		$output .= '<span class="wolf-core-interactive-link-text">';

		$output .= apply_filters( 'wolf_core_interactive_link_text_start', '', $panel_txt_atts );

		$output .= $title;

		$output .= '</span>';

		if ( is_array( $link ) && isset( $link['url'] ) ) {
			$output .= '</a>';
		}

		$output .= '</li>';

		++$i;
	}

	$output .= '</ul><!-- .wolf-core-interactive-links-text -->';
	$output .= '</div><!-- .wolf-core-interactive-links-inner -->';
	$output .= '</div><!-- .wolf-core-interactive-links -->';

	return $output;
}
