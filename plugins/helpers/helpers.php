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
 * Add inline style param
 */
function wolf_core_add_extra_params() {
	$elements = wolf_core_get_elements();

	foreach ( $elements as $e ) {

		$element_slug = str_replace( '-', '_', $e );

		add_filter(
			'wolf_core_' . $element_slug . '_params',
			function( $params ) {

				if ( 'vc' === wolf_core_get_plugin_in_use() ) {

					$params['params'][] = array(
						'label'      => esc_html__( 'Extra Class Name', 'wolf-core' ),
						'param_name' => 'el_class',
						'type'       => 'text',
						'group'      => esc_html__( 'Extra', 'wolf-core' ),
					);

					$params['params'][] = array(
						'label'      => esc_html__( 'Visibility', 'wolf-core' ),
						'param_name' => 'hide_class',
						'type'       => 'select',
						'options'    => array(
							''                      => esc_html__( 'Always visible', 'wolf-core' ),
							'wolf-core-hide-tablet' => esc_html__( 'Hide on tablet and mobile', 'wolf-core' ),
							'wolf-core-hide-mobile' => esc_html__( 'Hide on mobile', 'wolf-core' ),
							'wolf-core-show-tablet' => esc_html__( 'Show on tablet and mobile only', 'wolf-core' ),
							'wolf-core-show-mobile' => esc_html__( 'Show on mobile only', 'wolf-core' ),
							'wolf-core-hide'        => esc_html__( 'Always hidden', 'wolf-core' ),
						),
						'default'    => '',
						'group'      => esc_html__( 'Extra', 'wolf-core' ),
					);
				}

				$params['params'][] = array(
					'label'       => esc_html__( 'Quick CSS', 'wolf-core' ),
					'description' => esc_html__( 'CSS inline style', 'wolf-core' ),
					'param_name'  => 'inline_style',
					'type'        => 'textarea',
					'group'       => esc_html__( 'Extra', 'wolf-core' ),
				);

				return $params;
			}
		);
	}
}
add_action( 'init', 'wolf_core_add_extra_params' );

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

				/* Link */
				if ( isset( $atts['link'] ) ) {
					$atts['link'] = wolf_core_process_link_atts( $atts['link'] );
				}

				/* Hide class */
				if ( isset( $atts['hide_class'] ) ) {
					$atts['el_class'] .= '' . $atts['hide_class'];
				}

				/* Sanitize inline CSS */
				$atts['inline_style'] = wolf_core_sanitize_css_field( $atts['inline_style'] );

				/* VC animation and custom style */
				if ( 'vc' === wolf_core_get_plugin_in_use() ) {

					if ( isset( $atts['css'] ) ) {
						$atts['inline_style'] .= wolf_core_shortcode_custom_style( $atts['css'] );
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

				// debug( $atts );
				return $atts;
			}
		);
	}
}
add_action( 'init', 'wolf_core_animation_markup_filter' );

/**
 * Filter typography attributes to suit both page builder
 */
function wolf_core_filter_typography_atts() {

	$elements = wolf_core_get_elements();

	foreach ( $elements as $e ) {

		$element_slug = str_replace( '-', '_', $e );

		add_filter(
			'wolf_core_' . $element_slug . '_atts',
			function( $atts ) {

				if ( 'elementor' === wolf_core_get_plugin_in_use() ) {

					$typography_atts = array( 'font_family', 'font_size', 'font_weight', 'text_transform', 'font_style', 'line_height', 'letter_spacing' );

					foreach ( $typography_atts as $typography_att ) {

						if ( isset( $atts[ 'typography_' . $typography_att ] ) ) {
							$atts[ $typography_att ] = $atts[ 'typography_' . $typography_att ];
						}
					}

					foreach ( $atts as $k => $a ) {

						if ( is_array( $a ) && isset( $a['size'] ) && isset( $a['unit'] ) ) {
							$atts[ $k ] = $a['size'] . $a['unit'];
						}
					}
				}

				return $atts;
			}
		);
	}

}
add_action( 'init', 'wolf_core_filter_typography_atts' );

/**
 * Get target parameter option
 *
 * @return array
 */
function wolf_core_target_param_list() {
	return array(
		'_self'  => esc_html__( 'Same window', 'wolf-visual-composer' ),
		'_blank' => esc_html__( 'New window', 'wolf-visual-composer' ),
	);
}

/**
 * Render html attributes
 *
 * @access public
 * @static
 * @param array $attributes
 *
 * @return string
 */
function wolf_core_render_html_attributes( array $attributes ) {
	$rendered_attributes = array();

	foreach ( $attributes as $attribute_key => $attribute_values ) {
		if ( is_array( $attribute_values ) ) {
			$attribute_values = implode( ' ', $attribute_values );
		}
		if ( ! empty( $attribute_values ) ) {
			$rendered_attributes[] = sprintf( '%1$s="%2$s"', $attribute_key, esc_attr( $attribute_values ) );
		}
	}

	return implode( ' ', $rendered_attributes );
}
