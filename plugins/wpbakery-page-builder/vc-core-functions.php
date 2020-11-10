<?php
/**
 * %NAME% WPBakery Page Builder Core functions
 *
 * General core functions available on admin and frontend for WPB VC
 *
 * @author WolfThemes
 * @category Core
 * @package %PACKAGENAME%/Core
 * @version %VERSION%
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
	$vc_params['params']      = array();

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
		}

		if ( isset( $p['condition'] ) ) {
			foreach ( $p['condition'] as $k => $v ) {
				$vc_params['params'][ $i ]['dependency']['element'] = $k;
				$vc_params['params'][ $i ]['dependency']['value']   = $v;
			}
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
