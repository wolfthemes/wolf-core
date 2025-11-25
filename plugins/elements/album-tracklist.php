<?php
/**
 * Album Tracklist
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
function wolf_core_album_tracklist( $atts ) {

	$atts = apply_filters(
		'wolf_core_album_tracklist_atts',
		wp_parse_args(
			$atts,
			array(
				'show_numbers'        => '',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',

				'tracks'              => '',

			)
		)
	);

	wp_enqueue_script( 'wolf-core-album-tracklist' );

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$rand = wp_rand( 0, 99999 );

	$class .= ' wolf-core-album-tracklist wolf-core-element wolf-core-clearfix';

	if ( 'yes' === $show_numbers ) {
		$class .= ' wolf-core-album-tracklist-ordered';
	}

	$output = '<wolf-core-album-tracklist itemscope="" itemtype="http://schema.org/MusicPlaylist" class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );

	$output .= '>';

	// $output .= '<meta itemprop="numTracks" content="4">';

	$output .= '<ol class="wolf-core-album-tracklist-list">';

	if ( 'elementor' === wolf_core_get_plugin_in_use() ) {

		foreach ( $tracks as $track ) {

			$track = extract(
				apply_filters(
					'wolf_core_album_track_atts',
					wp_parse_args(
						$track,
						array(
							'title'          => '',
							'duration'       => '',
							'price'          => '',
							'mp3'            => '',
							'ogg'            => '',
							'video_url'      => '',
							'action'         => '',
							'itunes_url'     => '',
							'amazon_url'     => '',
							'googleplay_url' => '',
							'buy_url'        => '',
							'product_id'     => '',
						)
					)
				)
			);

			if ( $video_url ) {
				wp_enqueue_script( 'lity' );
			}

			$output .= '<li class="wolf-core-album-tracklist-item" itemprop="track" itemscope="" itemtype="http://schema.org/MusicRecording"><span class="wolf-core-ati-table">';

			// Title.
			$output .= '<span class="wolf-core-ati-cell wolf-core-ati-title-cell">';

			if ( $title ) {
				$output .= '<span class="wolf-core-ati-title">' . sanitize_text_field( $title ) . '</span>';
			}

			$output .= '</span>';

			// Duration.
			$output .= '<span class="wolf-core-ati-cell wolf-core-ati-duration-cell">';

			if ( $duration ) {
				$output .= '' . sanitize_text_field( $duration ) . '';
			}

			$output .= '</span>';

			// Play.
			$output .= '<span class="wolf-core-ati-cell wolf-core-ati-audio-cell">';

			$mp3 = ( isset( $mp3['url'] ) ) ? $mp3['url'] : '';

			if ( $mp3 || $ogg ) {

				$output .= '<a href="#" class="wolf-core-ati-play-button">';
				$output .= '<i class="wolf-core-ati-icon wolf-core-ati-play"></i><i class="wolf-core-ati-icon wolf-core-ati-pause"></i>';

				$output .= '</a>';

				if ( $mp3 ) {
					$output .= '<audio class="wolf-core-ati-audio" id="wolf-core-ati-audio-' . absint( $rand ) . '" src="' . esc_url( $mp3 ) . '"></audio>';
				}

				if ( $ogg ) {
					// $output .= '<src="' . $ogg . '">'
				}
			}

			$output .= '</span>';

			// Video.

			$video_url = ( isset( $video_url['url'] ) ) ? $video_url['url'] : '';
			$output   .= '<span class="wolf-core-ati-cell wolf-core-ati-video-cell">';

			if ( $video_url ) {
				$output .= '<a class="wolf-core-video-opener wolf-core-ati-link" title="' . esc_html( 'Watch the video', 'wolf-core' ) . '" href="' . esc_url( $video_url ) . '">';
				$output .= '<i class="wolf-core-ati-icon wolf-core-ati-video"></i>';
				$output .= '</a>';
			}

			$output .= '</span>';

			// Action.
			$output .= '<span class="wolf-core-ati-cell wolf-core-ati-action-cell">';

			if ( 'download' === $action && $mp3 ) {

				$file_name = parse_url( $mp3, PHP_URL_QUERY );

				$output .= '<a class="wolf-core-ati-link" title="' . esc_html__( 'Download', 'wolf-core' ) . '" href="' . esc_url( $mp3 ) . '" download="' . esc_attr( $file_name ) . '"><i class="wolf-core-ati-icon wolf-core-ati-download"></i></a>';

			} elseif ( 'link' === $action ) {

				if ( $price ) {
					$output .= '<span class="wolf-core-ati-price">' . sanitize_text_field( $price ) . '</span>';
				}

				if ( $itunes_url ) {
					$output .= '<a class="wolf-core-ati-link" title="' . sprintf( esc_html__( 'Buy on %s', 'wolf-core' ), 'Apple Music' ) . '" href="' . esc_url( $itunes_url ) . '" target="_blank"><i class="wolf-core-ati-icon wolf-core-ati-itunes"></i></a>';
				}

				if ( $amazon_url ) {
					$output .= '<a class="wolf-core-ati-link" title="' . sprintf( esc_html__( 'Buy on %s', 'wolf-core' ), 'amazon' ) . '" href="' . esc_url( $amazon_url ) . '" target="_blank"><i class="wolf-core-ati-icon wolf-core-ati-amazon"></i></a>';
				}

				if ( $googleplay_url ) {
					$output .= '<a class="wolf-core-ati-link" title="' . sprintf( esc_html__( 'Buy on %s', 'wolf-core' ), 'YT Music' ) . '" href="' . esc_url( $googleplay_url ) . '" target="_blank"><i class="wolf-core-ati-icon wolf-core-ati-googleplay"></i></a>';
				}

				if ( $buy_url ) {
					$output .= '<a class="wolf-core-ati-link" title="' . esc_html__( 'Buy', 'wolf-core' ) . '" href="' . esc_url( $buy_url ) . '" target="_blank"><i class="wolf-core-ati-icon wolf-core-ati-buy"></i></a>';
				}

				if ( $product_id ) {
					$output .= wolf_core_add_to_cart( $product_id, 'wolf-core-ati-link wolf-core-ati-add-to-cart-button', '<span class="wolf-core-ati-add-to-cart-button-title" title="' . esc_html__( 'Add to cart', 'wolf-core' ) . '"></span><i class="wolf-core-ati-icon wolf-core-ati-add-to-cart"></i>' );
				}
			} elseif ( 'add_to_cart' === $action && absint( $product_id ) ) {
				$output .= '<i class="wolf-core-ati-icon wolf-core-ati-add-to-cart-icon"></i>';
			}

			$output .= '</span>';

			$output .= '</span></li>';

		}
	}

	$output .= '</ol></wolf-core-album-tracklist>';

	return $output;
}
