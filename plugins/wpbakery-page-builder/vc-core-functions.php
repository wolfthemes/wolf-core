<?php
/**
 * Wolf Core WPBakery Page Builder Core functions
 *
 * General core functions available on admin and frontend for WPB VC
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

		$type = $p['type'];

		$vc_params['params'][ $i ]['type'] = $type;

		$vc_params['params'][ $i ]['param_name'] = $p['param_name']; // mandatory.

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

			$vc_params['params'][ $i ]['value'] = array(
				$p['label_on'] => $p['return_value'],
			);

		} elseif ( 'font_family' === $type ) {

			$vc_params['params'][ $i ]['type']  = 'dropdown';
			$vc_params['params'][ $i ]['value'] = array_flip( wolf_core_get_google_fonts_options() );

		} elseif ( 'link' === $type ) {
			$vc_params['params'][ $i ]['type'] = 'vc_link';

		} elseif ( 'image' === $type ) {
			$vc_params['params'][ $i ]['type'] = 'attach_image';

		}

		if ( isset( $p['condition'] ) ) {
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

	$template_dir   = WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/templates';
	$elements_slugs = wolf_core_get_element_list();

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

	if ( is_file( get_stylesheet_directory() . '/' . WOLF_CORE()->wpbpb_shortcode_template_path() . '/' . untrailingslashit( $filename ) ) ) {

		$file = get_stylesheet_directory() . '/' . WOLF_CORE()->wpbpb_shortcode_template_path() . '/' . untrailingslashit( $filename );

	} elseif ( is_file( get_template_directory() . '/' . WOLF_CORE()->wpbpb_shortcode_template_path() . '/' . untrailingslashit( $filename ) ) ) {

		$file = get_template_directory() . '/' . WOLF_CORE()->wpbpb_shortcode_template_path() . '/' . untrailingslashit( $filename );

	} else {
		$file = WOLF_CORE()->plugin_path() . '/' . WOLF_CORE()->wpbpb_shortcode_template_path() . '/' . untrailingslashit( $filename );
	}

	// Return what we found.
	return apply_filters( 'wolf_core_locate_shortcode_template', $file );
}

/**
 * Get shared color list in array to allow filtering by theme and stuff
 *
 * @return array
 */
function wolf_core_get_shared_colors() {

	$wolf_core_shared_colors = array(
		esc_html__( 'Black', 'wolf-core' )      => 'black',
		esc_html__( 'Light Grey', 'wolf-core' ) => 'lightergrey',
		esc_html__( 'Dark Grey', 'wolf-core' )  => 'darkgrey',
		esc_html__( 'White', 'wolf-core' )      => 'white',
		esc_html__( 'Orange', 'wolf-core' )     => 'orange',
		esc_html__( 'Green', 'wolf-core' )      => 'green',
		esc_html__( 'Turquoise', 'wolf-core' )  => 'turquoise',
		esc_html__( 'Violet', 'wolf-core' )     => 'violet',
		esc_html__( 'Pink', 'wolf-core' )       => 'pink',
		esc_html__( 'Grey blue', 'wolf-core' )  => 'greyblue',
		esc_html__( 'Red', 'wolf-core' )        => 'red',
		esc_html__( 'Yellow', 'wolf-core' )     => 'yellow',
		esc_html__( 'Blue', 'wolf-core' )       => 'blue',
		esc_html__( 'Peacoc', 'js_composer' )      => 'peacoc',
		esc_html__( 'Chino', 'js_composer' )       => 'chino',
		esc_html__( 'Mulled Wine', 'js_composer' ) => 'mulled-wine',
		esc_html__( 'Vista Blue', 'js_composer' )  => 'vista-blue',
		esc_html__( 'Grey', 'js_composer' )        => 'grey',
		esc_html__( 'Sky', 'js_composer' )         => 'sky',
		esc_html__( 'Juicy pink', 'js_composer' )  => 'juicy-pink',
		esc_html__( 'Sandy brown', 'js_composer' ) => 'sandy-brown',
		esc_html__( 'Purple', 'js_composer' )      => 'purple',
	);

	$wolf_core_shared_colors = apply_filters( 'wolf_core_shared_colors', $wolf_core_shared_colors );

	return $wolf_core_shared_colors;
}

/**
 * Get shared color hex value
 */
function wolf_core_get_shared_colors_hex() {

	$wolf_core_shared_colors_hex = array(
		'black'       => '#000000',
		'lightergrey' => '#f7f7f7',
		'darkgrey'    => '#444444',
		'white'       => '#ffffff',
		'orange'      => '#F7BE68',
		'green'       => '#6DAB3C',
		'turquoise'   => '#49afcd',
		'violet'      => '#8D6DC4',
		'pink'        => '#FE6C61',
		'greyblue'    => '#49535a',
		'red'         => '#da4f49',
		'yellow'      => '#e6ae48',
		'blue'        => '#75D69C',
		'peacoc'      => '#4CADC9',
		'chino'       => '#CEC2AB',
		'mulled-wine' => '#50485B',
		'vista-blue'  => '#75D69C',
		'grey'        => '#EBEBEB',
		'sky'         => '#5AA1E3',
		'juicy-pink'  => '#F4524D',
		'sandy-brown' => '#F79468',
		'purple'      => '#B97EBB',
		'accent'      => apply_filters( 'wolf_core_theme_accent_color', '#0073AA' ),
	);

	$wolf_core_shared_colors_hex = apply_filters( 'wolf_core_shared_colors_hex', $wolf_core_shared_colors_hex );

	return $wolf_core_shared_colors_hex;
}

/**
 * Get shared gradient color list in array to allow filtering by theme and stuff
 *
 * @return array
 */
function wolf_core_get_shared_gradient_colors() {

	$wolf_core_shared_gradient_colors = array(
		esc_html__( 'Gradient Red', 'wolf-core' )    => 'gradient-color-3452ff', // red salient
		esc_html__( 'Gradient Red 2', 'wolf-core' )  => 'gradient-color-588694', // red uncode
		esc_html__( 'Gradient Green', 'wolf-core' )  => 'gradient-color-105898',
		esc_html__( 'Gradient Green Circle', 'wolf-core' ) => 'gradient-color-111420',
		esc_html__( 'Gradient Orange', 'wolf-core' ) => 'gradient-color-470604',
		esc_html__( 'Gradient Violet', 'wolf-core' ) => 'gradient-color-b900b4',
	);

	$wolf_core_shared_gradient_colors = apply_filters( 'wolf_core_shared_gradient_colors', $wolf_core_shared_gradient_colors );

	return $wolf_core_shared_gradient_colors;
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
