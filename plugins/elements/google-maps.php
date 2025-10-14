<?php
/**
 * Google Maps
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
function wolf_core_google_maps( $atts ) {

	$atts = apply_filters(
		'wolf_core_google_maps_atts',
		wp_parse_args(
			$atts,
			array(
				'type'                => 'default',
				'locations'           => '',
				'name'                => '',
				'coordinates'         => '',
				'size'                => '400px',
				'height'              => '400px',
				'address'             => '',
				'zoom'                => 10,
				'map_skin'            => 'standard',
				'custom_map_skin'     => '',
				'marker'              => '',
				'marker_img'          => '',
				'marker_color'        => 'accent',
				'marker_custom_color' => '#F7584C',
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$google_api_key = wolf_core_get_google_maps_api_key();

	if ( ! $google_api_key ) {

		if ( is_user_logged_in() ) {

			if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
				printf(
					wp_kses_post( __( '<p class="wolf-core-align-center">You must set a Google Map API key in the <a style="text-decoration:underline;" href="%1$s" target="_blank">%2$s settings</a>. You can get your Google Maps API <a style="text-decoration:underline;" href="%3$s" target="_blank">here</a>.<p>', 'wolf-core' ) ),
					esc_url( admin_url( 'admin.php?page=elementor-settings#tab-integrations' ) ),
					'Elementor',
					esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' )
				);

			} else {
				printf(
					wp_kses_post( __( '<p class="wolf-core-align-center">You must set a Google Map API key in the <a style="text-decoration:underline;" href="%1$s" target="_blank">%2$s settings</a>. You can get your Google Maps API <a style="text-decoration:underline;" href="%3$s" target="_blank">here</a>.<p>', 'wolf-core' ) ),
					esc_url( admin_url( 'admin.php?page=wolf-core-google-map' ) ),
					'Wolf Core',
					esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key' )
				);
			}
		}

		return;
	}

	wp_enqueue_script( 'google-maps-api' );
	wp_enqueue_script( 'wolf-core-google-maps' );

	$output = '';

	$class = $el_class; // init container CSS class.

	$size   = ( $size ) ? $size : '400px';
	$height = ( $height ) ? $height : '400px';

	if ( 'elementor' === wolf_core_get_plugin_in_use() ) {

		$el_height = wolf_core_sanitize_css_value( $height );

	} elseif ( 'elementor' === wolf_core_get_plugin_in_use() ) {
		$el_height = wolf_core_sanitize_css_value( $size );
	}

	$inline_style .= "height:$el_height;";

	/* Marker color */
	$colors = wolf_core_get_shared_colors_hex();

	if ( 'default' === $marker_color ) {

		$marker_color = '#F7584C';

	} elseif ( 'custom' === $marker_color ) {

		$marker_color = $marker_custom_color;

	} else {
		$marker_color = isset( $colors[ $marker_color ] ) ? $colors[ $marker_color ] : '';
	}

	$marker_color = wolf_core_sanitize_color( $marker_color );

	$class .= ' wolf-core-clearfix wolf-core-element wolf-core-google-maps-container';

	$el_id = uniqid( 'wolf-core-google-maps-' );

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );

	$output .= '>';

	$locations_formatted = array();

	/* Single location (Elementor default) */
	if ( $address && ( 'default' === $type || ! $type ) ) {
		$output .= sprintf(
			'<div class="elementor-custom-embed"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=%1$s&amp;t=m&amp;z=%2$d&amp;output=embed&amp;iwloc=near" title="%3$s" aria-label="%3$s" height="%4$s"></iframe></div>',
			rawurlencode( $address ),
			absint( $zoom ),
			esc_attr( $address ),
			$el_height
		);
	}
	/* Multiple locations */
	if ( ( $locations && 'multiple' === $type ) || $name && $coordinates && 'simple' === $type ) {

		if ( 'simple' === $type ) {

			$coordinates = wolf_core_list_to_array( $coordinates );
			$latitude    = ( isset( $coordinates[0] ) ) ? $coordinates[0] : false;
			$longitude   = ( isset( $coordinates[1] ) ) ? $coordinates[1] : false;

			$locations_formatted[] = array(
				$name,
				$latitude,
				$longitude,
			);

		} elseif ( 'multiple' === $type ) {

			foreach ( $locations as $location ) {

				$coordinates = wolf_core_list_to_array( $location['coordinates'] );
				$latitude    = ( isset( $coordinates[0] ) ) ? $coordinates[0] : false;
				$longitude   = ( isset( $coordinates[1] ) ) ? $coordinates[1] : false;

				$locations_formatted[] = array(
					$location['name'],
					$latitude,
					$longitude,
				);
			}
		}

		$output .= '<div id="' . esc_attr( $el_id ) . '"
		class="wolf-core-google-maps"
		data-locations="' . esc_js( wp_json_encode( $locations_formatted ) ) . '"
		data-map-skin="' . esc_attr( $map_skin ) . '"
		data-zoom="' . absint( $zoom ) . '"
		data-marker-color="' . esc_attr( $marker_color ) . '"';

		if ( $custom_map_skin ) {
			$custom_map_skin = wolf_core_clean_spaces( wp_strip_all_tags( $custom_map_skin ) );
			$output         .= ' data-custom-map-skin="' . esc_js( $custom_map_skin ) . '"';
		}

		if ( $marker_img ) {

			if ( is_array( $marker_img ) && isset( $marker_img['id'] ) ) {
				$marker_img = $marker_img['id'];
			}

			$marker_img_url = wolf_core_get_url_from_attachment_id( $marker_img );
			$output        .= 'data-marker-icon="' . esc_url( $marker_img_url ) . '"';
		}

		$output .= '></div><!--.wolf-core-google-maps-->';
	}

	$output .= '</div><!--.wolf-core-google-maps-container-->';

	return $output;
}
