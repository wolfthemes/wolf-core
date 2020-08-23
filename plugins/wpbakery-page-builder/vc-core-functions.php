<?php
/**
 * %NAME% WPBakery Page Builder Core functions
 *
 * General core functions available on admin and frontend for WPB VC
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Core
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

/**
 * Covert raw params to VC format params
 *
 * @param array
 * @return array
 */
function wolf_core_convert_params_to_vc( $params ) {

	$vc_params = [];
	$properties = $params['properties'];
	$params = $params['params'];

	/* Properties */
	$vc_params['name'] = $properties['name'];
	$vc_params['description'] = $properties['description'];
	$vc_params['base'] = $properties['vc_base'];
	$vc_params['category'] = $properties['vc_category'];
	$vc_params['icon'] = $properties['icon'];
	$vc_params['params'] = [];

	
	$i = 0;

	foreach ( $params as $p ) {
		
		$type = $p['type'];

		$vc_params['params'][$i]['type'] = $type;
		
		$vc_params['params'][$i]['param_name'] = $p['param_name']; // mandatory

		if ( isset( $p['label'] ) ) {
			$vc_params['params'][$i]['heading'] = $p['label'];
		}
		
		if ( isset ( $p['default'] ) ) {
			$vc_params['params'][$i]['value'] = $p['default'];
		}

		if ( 'text' === $type ) {

			$vc_params['params'][$i]['type'] = 'wolf_core_textfield';

		} elseif ( 'textarea' === $type ) {

			$vc_params['params'][$i]['type'] = 'textarea';

		} elseif ( 'select' === $type ) {
			
			$vc_params['params'][$i]['type'] = 'dropdown';

			$vc_params['params'][$i]['value'] = array_flip( $p['options'] );

			if ( isset( $p['default'] ) ) {
				$vc_params['params'][$i]['std'] = $p['default'];
			}
		
		} elseif ( 'checkbox' === $type ) {

			$vc_params['params'][$i]['value'] = [
				$p['label_on'] => $p['return_value'],
			];

		} elseif ( 'font_family' === $type ) {

			$vc_params['params'][$i]['type'] = 'dropdown';
			$vc_params['params'][$i]['value'] = array_flip( ['font' => 'Font name'] );

		} elseif ( 'link' === $type ) {
			$vc_params['params'][$i]['type'] = 'vc_link';
		}

		if ( isset( $p['condition'] ) ) {
			foreach ( $p['condition'] as $k => $v ) {
				$vc_params['params'][$i]['dependency']['element'] = $k;
				$vc_params['params'][$i]['dependency']['value'] = $v;
			}
		}

		$i++;
	}

	//die( debug( $vc_params ) );

	return $vc_params;
}