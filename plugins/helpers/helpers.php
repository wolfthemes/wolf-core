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
 * Add carousel params
 */
function wolf_core_add_carousel_params() {

	$elements = array(
		'testimonial-slider',
	);

	foreach ( $elements as $e ) {

		$element_slug = str_replace( '-', '_', $e );

		add_filter(
			'wolf_core_' . $element_slug . '_params',
			function ( $params ) {

				$params['params'][] = array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Autoplay', 'wolf-core' ),
					'param_name'   => 'autoplay',
					'return_value' => 'true',
					'group'        => esc_html__( 'Options', 'wolf-core' ),
				);

				$params['params'][] = array(
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Pause on Hover (if autoplay)', 'wolf-core' ),
					'param_name' => 'pause_on_hover',
					'group'      => esc_html__( 'Options', 'wolf-core' ),
				);

				$params['params'][] = array(
					'label'      => esc_html__( 'Slideshow Speed in ms', 'wolf-core' ),
					'param_name' => 'slideshow_speed',
					'group'      => esc_html__( 'Options', 'wolf-core' ),
				);

				$params['params'][] = array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Show Navigation Bullets', 'wolf-core' ),
					'param_name'   => 'nav_bullets',
					'return_value' => 'true',
					'group'        => esc_html__( 'Options', 'wolf-core' ),
				);

				$params['params'][] = array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Show Navigation Arrows', 'wolf-core' ),
					'param_name'   => 'nav_arrows',
					'return_value' => 'true',
					'group'        => esc_html__( 'Options', 'wolf-core' ),
				);

				$params['params'][] = array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Contain', 'wolf-core' ),
					'param_name'   => 'contain',
					'return_value' => 'true',
					'default'      => 'true',
					'group'        => esc_html__( 'Options', 'wolf-core' ),
				);

				$params['params'][] = array(
					'type'       => 'int',
					'label'      => esc_html__( 'Item to show', 'wolf-core' ),
					'param_name' => 'group_cells',
					'group'      => esc_html__( 'Options', 'wolf-core' ),
				);

				return $params;
			}
		);
	}
}
add_action( 'init', 'wolf_core_add_carousel_params' );

/**
 * Add inline style param
 */
function wolf_core_add_extra_params() {
	$elements = wolf_core_get_elements();

	foreach ( $elements as $e ) {

		$element_slug = str_replace( '-', '_', $e );

		add_filter(
			'wolf_core_' . $element_slug . '_params',
			function ( $params ) {

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

				/*
				$params['params'][] = array(
					'label'       => esc_html__( 'Quick CSS', 'wolf-core' ),
					'description' => esc_html__( 'CSS inline style', 'wolf-core' ),
					'param_name'  => 'inline_style',
					'type'        => 'textarea',
					'group'       => esc_html__( 'Extra', 'wolf-core' ),
				);*/

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
			function ( $atts ) {

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

				/* VC */
				if ( 'vc' === wolf_core_get_plugin_in_use() ) {

					/* VC custom style */
					if ( isset( $atts['css'] ) ) {
						$atts['inline_style'] .= wolf_core_shortcode_custom_style( $atts['css'] );
					}

					/* VC animation */
					if ( isset( $atts['css_animation'] ) ) {
						if ( ! wolf_core_is_new_animation( $atts['css_animation'] ) ) {
							$atts['el_class'] .= wolf_core_get_css_animation( $atts['css_animation'] );

							if ( isset( $atts['css_animation_delay'] ) ) {
								$atts['inline_style'] .= wolf_core_get_css_animation_delay( $atts['css_animation_delay'] );
							}
						}
					}

					/* VC icon */
					if ( isset( $atts['icon_type'] ) && isset( $atts[ 'icon_' . $atts['icon_type'] ] ) ) {
						$atts['selected_icon'] = array(
							'library' => $atts['icon_type'],
							'value'   => $atts[ 'icon_' . $atts['icon_type'] ],
						);
					}
				}

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
			function ( $atts ) {

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
 * @param array $attributes The attribute array duh.
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

	return implode( ' ', apply_filters( 'wolf_core_html_attributes', $rendered_attributes ) );
}

/**
 * Render shortcode attributes
 *
 * @access public
 * @static
 * @param array $attributes The attribute array duh.
 *
 * @return string
 */
function wolf_core_render_shortcode_attributes( array $attributes ) {
	$rendered_attributes = array();

	foreach ( $attributes as $attribute_key => $attribute_values ) {
		if ( is_array( $attribute_values ) ) {
			continue;
		}
		if ( ! empty( $attribute_values ) && ! is_array( $attribute_values ) ) {
			$rendered_attributes[] = sprintf( '%1$s="%2$s"', $attribute_key, esc_attr( $attribute_values ) );
		}
	}

	return implode( ' ', $rendered_attributes );
}

/**
 * Get params to convert
 */
function wol_core_get_vc_parms_to_convert() {
	return array(
		'button'        => array(
			'type'         => 'button_type',
			'title'        => 'text',
			'hover_effect' => 'hover_animation',
			'i_align'      => 'icon_align',
			'el_id'        => 'button_css_id',
			'i_hover'      => 'icon_hover_reveal',
			// 'color' => '',
			// 'custom_color' => 'background_color',
		),
		'banner'        => array(
			'title_font_size' => 'font_size',
		),
		'content-block' => array(
			'id' => 'contact_block_id',
		),
		'playlist'      => array(
			'id' => 'playlist_id',
		),
	);
}


/**
 * Sync VC and elementor attributename
 */
function wolf_core_sync_atts() {

	if ( 'vc' !== wolf_core_get_plugin_in_use() ) {
		return;
	}

	$converter = wol_core_get_vc_parms_to_convert();
	$elements  = wolf_core_get_elements();

	foreach ( $elements as $e ) {

		$element_slug = str_replace( '-', '_', $e );

		foreach ( $converter as $name => $params ) {

			if ( $name === $element_slug ) {

				add_filter(
					'wolf_core_' . $element_slug . '_vc_atts',
					function ( $atts, $vc_atts ) use ( $element_slug, $params ) {

						foreach ( $params as $old => $new ) {

							if ( isset( $vc_atts[ $old ] ) ) {
								$atts[ $new ] = $atts[ $old ];
							}
						}

						return $atts;
					},
					10,
					2
				);
			}
		}
	}
}
add_action( 'init', 'wolf_core_sync_atts' );

/**
 * Register scripts for a widget based on an array
 *
 * @param array $scripts The scripts to register.
 */
function wolf_core_register_elementor_widget_scripts( $scripts = array() ) {

	$theme_version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : wolf_core_get_theme_version();

	foreach ( $scripts as $handle => $properties ) {
		$src          = esc_url( $properties['src'] );
		$dependencies = ( isset( $properties['dependencies'] ) ) ? $properties['dependencies'] : array( 'jquery' );
		$version      = ( isset( $properties['version'] ) ) ? $properties['version'] : $theme_version;
		$in_footer    = ( isset( $properties['in_footer'] ) ) ? $properties['in_footer'] : true;

		wp_register_script( $handle, $src, $dependencies, $version, $in_footer );
	}
}
