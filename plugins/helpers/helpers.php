<?php
/**
 * Helpers
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Animate Elements
 *
 * Filter element attributes to output animation inline CSS for VC
 */
function wolf_core_add_inline_style_param() {
	$elements = wolf_core_get_elements();

	foreach ( $elements as $e ) {

		$element_slug = str_replace( '-', '_', $e );

		add_filter(
			'wolf_core_' . $element_slug . '_params',
			function( $params ) {

				$params['params'][] = array(
					'label'      => esc_html__( 'Additional CSS inline style', 'wolf-core' ),
					'param_name' => 'inline_style',
					'type'       => 'textarea',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				);

				return $params;
			}
		);
	}
}
add_action( 'init', 'wolf_core_add_inline_style_param' );

/**
 * Animate Elements
 *
 * Filter element attributes to output animation inline CSS for VC
 */
function wolf_core_animation_markup_filter() {

	$elements = wolf_core_get_elements();

	foreach ( $elements as $e ) {

		$element_slug = str_replace( '-', '_', $e );

		add_filter(
			'wolf_core_' . $element_slug . '_atts',
			function( $atts ) {

				$atts['el_class']     = ( isset( $atts['el_class'] ) ) ? $atts['el_class'] : '';
				$atts['inline_style'] = ( isset( $atts['inline_style'] ) ) ? $atts['inline_style'] : '';

				if ( isset( $atts['link'] ) ) {
					$atts['link'] = wolf_core_process_link_atts( $atts['link'] );
				}

				// Sanitize inline CSS.
				$atts['inline_style'] = wolf_core_sanitize_css_field( $atts['inline_style'] );

				if ( 'vc' === wolf_core_get_plugin_in_use() ) {

					if ( isset( $atts['css'] ) ) {
						$atts['inline_style'] = wolf_core_shortcode_custom_style( $css );
					}

					if ( isset( $atts['css_animation'] ) ) {
						if ( ! wolf_core_is_new_animation( $atts['css_animation'] ) ) {
							$atts['el_class'] .= wolf_core_get_css_animation( $atts['css_animation'] );

							if ( isset( $atts['css_animation_delay'] ) ) {
								$atts['inline_style'] .= wolf_core_get_css_animation_delay( $atts['css_animation_delay'] );
							}
						}
					}
				}

				//debug( $atts );
				return $atts;
			}
		);
	}
}
add_action( 'init', 'wolf_core_animation_markup_filter' );
