<?php
/**
 * Wolf Core WPBakery Page Builder Core functions
 *
 * General core functions available on admin and frontend for WPBakeryPageBuilder
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Covert raw params to VC format params
 *
 * @param array $params The parameters array to convert.
 * @return array
 */
function wolf_core_convert_params_to_vc( $params ) {

	$vc_params  = array();
	$properties = $params['properties'];
	$params     = $params['params'];

	/* Properties */
	$vc_params['name']        = $properties['name'];
	$vc_params['description'] = $properties['description'];
	$vc_params['base']        = $properties['vc_base'];
	$vc_params['category']    = $properties['vc_category'];
	$vc_params['icon']        = $properties['icon'];

	$vc_params['params'] = array();

	/* Other */
	$vc_params['js_view'] = ( isset( $params['js_view'] ) ) ? $params['js_view'] : '';

	$i = 0;

	foreach ( $params as $p ) {

		if ( isset( $p['page_builder'] ) && 'elementor' === $p['page_builder'] ) {
			continue;
		}

		if ( ! isset( $p['type'] ) ) {
			continue;
		}

		$type = $p['type'];

		$vc_params['params'][ $i ]['type'] = $type;

		$vc_params['params'][ $i ]['param_name'] = ( isset( $p['param_name'] ) ) ? $p['param_name'] : '';

		if ( isset( $p['label'] ) ) {
			$vc_params['params'][ $i ]['heading'] = $p['label'];
		}

		if ( isset( $p['default'] ) ) {
			$vc_params['params'][ $i ]['value'] = $p['default'];
		}

		if ( 'text' === $type ) {

			$vc_params['params'][ $i ]['type'] = 'wolf_core_textfield';

		} elseif ( 'textarea' === $type ) {

			$vc_params['params'][ $i ]['type'] = 'textarea';

		} elseif ( 'select' === $type ) {

			$vc_params['params'][ $i ]['type']  = 'dropdown';
			$vc_params['params'][ $i ]['value'] = array_flip( $p['options'] );

			if ( isset( $p['default'] ) ) {
				$vc_params['params'][ $i ]['std'] = $p['default'];
			}
		} elseif ( 'checkbox' === $type ) {

			$label_on     = ( isset( $p['label_on'] ) ) ? $p['label_on'] : esc_html__( 'Yes', 'wolf-core' );
			$return_value = ( isset( $p['return_value'] ) ) ? $p['return_value'] : 'yes';

			$vc_params['params'][ $i ]['value'] = array(
				$label_on => $return_value,
			);

		} elseif ( 'font_family' === $type ) {

			$vc_params['params'][ $i ]['type']  = 'dropdown';
			$vc_params['params'][ $i ]['value'] = array_flip( wolf_core_get_google_fonts_options() );

		} elseif ( 'link' === $type ) {

			$vc_params['params'][ $i ]['type'] = 'vc_link';

		} elseif ( 'icon' === $type ) {

			$library_options = array();
			$all_libraries   = array_merge( wolf_core_get_icon_libraires(), wolf_core_get_vc_default_icon_libraries() );
			//$all_libraries   = wolf_core_get_icon_libraires();

			foreach ( $all_libraries as $library ) {
				$library_options[ $library['properties']['label'] ] = $library['properties']['name'];
			}

			$vc_params['params'][ $i ]['type']        = 'dropdown';
			$vc_params['params'][ $i ]['heading']     = esc_html__( 'Icon library', 'wolf-core' );
			$vc_params['params'][ $i ]['param_name']  = 'type';
			$vc_params['params'][ $i ]['admin_label'] = true;
			$vc_params['params'][ $i ]['description'] = esc_html__( 'Select icon library.', 'wolf-core' );
			$vc_params['params'][ $i ]['std']         = apply_filters( 'wolf_core_default_icon_font', 'dripicons' );
			$vc_params['params'][ $i ]['value']       = $library_options;

			foreach ( $all_libraries as $library ) {
				$i++;

				$vc_params['params'][ $i ] = array(
					'type'        => 'iconpicker',
					'heading'     => $library['properties']['label'],
					'param_name'  => 'icon_' . $library['properties']['name'],
					'value'       => $library['properties']['labelIcon'],
					'settings'    => array(
						'type'         => $library['properties']['name'],
						'emptyIcon'    => false,
						'iconsPerPage' => 4000,
					),
					'dependency'  => array(
						'element' => 'type',
						'value'   => $library['properties']['name'],
					),
					'description' => esc_html__( 'Select icon from library.', 'wolf-core' ),
				);

				//debug( $vc_params['params'][ $i ] );
			}
		} elseif ( 'colorpicker' === $type ) {

			$vc_params['params'][ $i ]['type'] = 'colorpicker';

		} elseif ( 'slider' === $type ) {

			$vc_params['params'][ $i ]['type'] = 'wolf_core_numeric_slider';
			$vc_params['params'][ $i ]['min']  = ( isset( $p['min'] ) ) ? $p['min'] : 0;
			$vc_params['params'][ $i ]['max']  = ( isset( $p['max'] ) ) ? $p['max'] : 100;
			$vc_params['params'][ $i ]['step'] = ( isset( $p['step'] ) ) ? $p['step'] : 1;

		} elseif ( 'video' === $type ) {

			$vc_params['params'][ $i ]['type'] = 'wolf_core_video_url';

		} elseif ( 'image' === $type ) {

			$vc_params['params'][ $i ]['type'] = 'attach_image';

		} elseif ( 'images' === $type ) {

			$vc_params['params'][ $i ]['type'] = 'attach_images';
		}

		if ( isset( $p['vc_dependency'] ) ) {
			foreach ( $p['vc_dependency'] as $k => $v ) {
				$vc_params['params'][ $i ]['dependency']['element'] = $k;
				$vc_params['params'][ $i ]['dependency']['value']   = $v;
			}
		} elseif ( isset( $p['condition'] ) ) {
			foreach ( $p['condition'] as $k => $v ) {
				$vc_params['params'][ $i ]['dependency']['element'] = $k;
				$vc_params['params'][ $i ]['dependency']['value']   = $v;
			}
		}

		if ( isset( $p['group'] ) ) {
			$vc_params['params'][ $i ]['group'] = $p['group'];
		}

		if ( isset( $p['weight'] ) ) {
			$vc_params['params'][ $i ]['weight'] = $p['weight'];
		}

		if ( isset( $p['save_always'] ) ) {
			$vc_params['params'][ $i ]['save_always'] = $p['save_always'];
		}

		if ( isset( $p['param_holder_class'] ) ) {
			$vc_params['params'][ $i ]['param_holder_class'] = $p['param_holder_class'];
		}

		if ( isset( $p['admin_label'] ) ) {
			$vc_params['params'][ $i ]['admin_label'] = $p['admin_label'];
		}

		$i++;
	}

	// die( debug( $vc_params ) );

	return $vc_params;
}

/**
 * Filtering template path for each shortcode
 *
 * Using vc_set_shortcodes_templates_dir will prevent the theme from having a VC template directory.
 * We filter the template path for each shortcode so we can have our shortcode templates in the plugin AND in the theme
 */
function wolf_core_hook_template_dir() {

	$template_dir   = WOLF_CORE_DIR . '/plugins/vc/templates';
	$elements_slugs = wolf_core_get_elements();

	if ( is_dir( $template_dir ) ) {

		foreach ( $elements_slugs as $slug ) {

			$slug = str_replace( '-', '_', basename( $slug ) );

			$vc_filename = wolf_core_locate_shortcode_template( 'vc_' . sanitize_title_with_dashes( $slug ) . '.php' );

			$wolf_core_filename = wolf_core_locate_shortcode_template( 'wolf_core_' . sanitize_title_with_dashes( $slug ) . '.php' );

			$default_filename = wolf_core_locate_shortcode_template( sanitize_title_with_dashes( $slug ) . '.php' );

			if ( is_file( $vc_filename ) ) {

				vc_map_update(
					'vc_' . $slug,
					array(
						'html_template' => $vc_filename,
					)
				);

			} elseif ( is_file( $wolf_core_filename ) ) {

				vc_map_update(
					'wolf_core_' . $slug,
					array(
						'html_template' => $wolf_core_filename,
					)
				);

			} elseif ( is_file( $default_filename ) ) {

				vc_map_update(
					$slug,
					array(
						'html_template' => $default_filename,
					)
				);
			}
		}
	}
}
add_action( 'vc_after_init', 'wolf_core_hook_template_dir' );

/**
 * Locate a file and return the path for inclusion.
 *
 * Used to check if the file is in a theme folder of from the original plugin directory
 *
 * @param string $filename The file to include.
 * @return string
 */
function wolf_core_locate_shortcode_template( $filename ) {

	if ( is_file( get_stylesheet_directory() . '/' . WOLF_CORE()->vc_shortcode_template_path() . '/' . untrailingslashit( $filename ) ) ) {

		$file = get_stylesheet_directory() . '/' . WOLF_CORE()->vc_shortcode_template_path() . '/' . untrailingslashit( $filename );

	} elseif ( is_file( get_template_directory() . '/' . WOLF_CORE()->vc_shortcode_template_path() . '/' . untrailingslashit( $filename ) ) ) {

		$file = get_template_directory() . '/' . WOLF_CORE()->vc_shortcode_template_path() . '/' . untrailingslashit( $filename );

	} else {
		$file = WOLF_CORE()->plugin_path() . '/' . WOLF_CORE()->vc_shortcode_template_path() . '/' . untrailingslashit( $filename );
	}

	// Return what we found.
	return apply_filters( 'wolf_core_locate_shortcode_template', $file );
}

/**
 * Get shape divider options
 */
function wolf_core_get_shape_divider_options() {
	$options = array(
		'tilt'           => esc_html__( 'Angle', 'wolf-core' ),
		// 'tilt_opacity' => esc_html__( 'Angle Opacity', 'wolf-core' ),
		'curve'          => esc_html__( 'Curve', 'wolf-core' ),
		// 'curve_opacity' => esc_html__( 'Curve Opacity', 'wolf-core' ),
		'grunge_border1' => esc_html__( 'Grunge Border', 'wolf-core' ),
	);

	$options = array_flip( apply_filters( 'wolf_core_shape_divider_options', $options ) );

	return $options;
}

function wolf_core_add_vc_shared_color( $colors ) {

	$vc_colors = array(
		'peacoc'      => esc_html__( 'Peacoc', 'js_composer' ),
		'chino'       => esc_html__( 'Chino', 'js_composer' ),
		'mulled-wine' => esc_html__( 'Mulled Wine', 'js_composer' ),
		'vista-blue'  => esc_html__( 'Vista Blue', 'js_composer' ),
		'grey'        => esc_html__( 'Grey', 'js_composer' ),
		'sky'         => esc_html__( 'Sky', 'js_composer' ),
		'juicy-pink'  => esc_html__( 'Juicy pink', 'js_composer' ),
		'sandy-brown' => esc_html__( 'Sandy brown', 'js_composer' ),
		'purple'      => esc_html__( 'Purple', 'js_composer' ),
	);

	return array_merge( $colors, $vc_colors );
}
add_filter( 'wolf_core_shared_colors', 'wolf_core_add_vc_shared_color' );

/**
 * Add animations
 *
 * @param array $animations Animation array.
 * @return array
 */
function wolf_core_add_animations( $animations ) {

	$animations[] = array(
		'label'  => esc_html__( 'Custom Animations', 'wolf-visual-composer' ),
		'values' => array(
			'uncoverXLeft'   => array(
				'value' => 'uncoverXLeft',
				'type'  => 'new',
			),
			'uncoverXRight'  => array(
				'value' => 'uncoverXRight',
				'type'  => 'new',
			),

			'uncoverYTop'    => array(
				'value' => 'uncoverYTop',
				'type'  => 'new',
			),

			'uncoverYBottom' => array(
				'value' => 'uncoverYBottom',
				'type'  => 'new',
			),
		),
	);

	return $animations;
}
add_filter( 'vc_param_animation_style_list', 'wolf_core_add_animations' );

/**
 * New animations
 */
// function wolf_core_get_aos_animations() {
// return array(
// 'fade'            => esc_html__( 'Fade', 'wolf-visual-composer' ),
// 'fade-up'         => esc_html__( 'Fade Up', 'wolf-visual-composer' ),
// 'fade-down'       => esc_html__( 'Fade Down', 'wolf-visual-composer' ),
// 'fade-left'       => esc_html__( 'Fade Left', 'wolf-visual-composer' ),
// 'fade-right'      => esc_html__( 'Fade Right', 'wolf-visual-composer' ),
// 'fade-up-right'   => esc_html__( 'Fade Up Right', 'wolf-visual-composer' ),
// 'fade-up-left'    => esc_html__( 'Fade Up Left', 'wolf-visual-composer' ),
// 'fade-down-right' => esc_html__( 'Fade Down Right', 'wolf-visual-composer' ),
// 'fade-down-left'  => esc_html__( 'Fade Down Left', 'wolf-visual-composer' ),

// 'flip-up'         => esc_html__( 'Flip Up', 'wolf-visual-composer' ),
// 'flip-down'       => esc_html__( 'Flip Down', 'wolf-visual-composer' ),
// 'flip-left'       => esc_html__( 'Flip Left', 'wolf-visual-composer' ),
// 'flip-right'      => esc_html__( 'Flip Right', 'wolf-visual-composer' ),

// 'slide-up'        => esc_html__( 'Slide Up', 'wolf-visual-composer' ),
// 'slide-down'      => esc_html__( 'Slide Down', 'wolf-visual-composer' ),
// 'slide-left'      => esc_html__( 'Slide Left', 'wolf-visual-composer' ),
// 'slide-right'     => esc_html__( 'Slide Right', 'wolf-visual-composer' ),

// 'zoom-in'         => esc_html__( 'Zoom In', 'wolf-visual-composer' ),
// 'zoom-in-up'      => esc_html__( 'Zoom In Up', 'wolf-visual-composer' ),
// 'zoom-in-down'    => esc_html__( 'Zoom In Down', 'wolf-visual-composer' ),
// 'zoom-in-left'    => esc_html__( 'Zoom In Left', 'wolf-visual-composer' ),
// 'zoom-in-right'   => esc_html__( 'Zoom In Right', 'wolf-visual-composer' ),
// 'zoom-out'        => esc_html__( 'Zoom Out', 'wolf-visual-composer' ),
// 'zoom-out-up'     => esc_html__( 'Zoom Out Up', 'wolf-visual-composer' ),
// 'zoom-out-down'   => esc_html__( 'Zoom Out Down', 'wolf-visual-composer' ),
// 'zoom-out-left'   => esc_html__( 'Zoom Out Left', 'wolf-visual-composer' ),
// 'zoom-out-right'  => esc_html__( 'Zoom Out Right', 'wolf-visual-composer' ),
// );
// }

/**
 * Filter animation style
 *
 * @param array $animation_syles WPBPB animations.
 * @return array
 */
function wolf_core_filter_animation_styles( $animation_syles ) {

	$new_animations = array(
		array(
			// 'label' => esc_html__( 'New Animations', 'wolf-visual-composer' ),
			'values' => array_flip( array( 'none' => esc_html__( 'None', 'wolf-visual-composer' ) ) ),
		),
		array(
			'label'  => esc_html__( 'New Animation Engine (beta)', 'wolf-visual-composer' ),
			'values' => array_flip( wolf_core_get_aos_animations() ),
		),
	);

	// $animation_syles[] = $new_animations;

	// debug( $animation_syles );

	$animation_syles = $new_animations + $animation_syles;

	return $animation_syles;
}
add_filter( 'vc_param_animation_style_list', 'wolf_core_filter_animation_styles' );
