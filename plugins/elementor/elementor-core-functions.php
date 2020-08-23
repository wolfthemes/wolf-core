<?php
/**
 * %NAME% Elementor Core functions
 *
 * General core functions available on admin and frontend for Elementor
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Core
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

/**
 * Covert raw params to Elementor format params
 *
 * @param array
 * @return array
 */
function wolf_core_convert_params_to_elementor( $widget ) {
	
	$i = 0;

	$params = $widget->params['params'];

	foreach ( $params as $p ) {

		$field_params = [];

		$type = $p['type'];
		$field_params['label'] = $p['label'];
		
		if ( 'text' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::TEXT;
			$field_params['placeholder'] = $p['placeholder'];

		} elseif ( 'textarea' === $type  ) {
			
			$field_params['type'] = \Elementor\Controls_Manager::TEXTAREA;
			$field_params['placeholder'] = $p['placeholder'];

		} elseif ( 'select' === $type  ) {

			$field_params['type'] = \Elementor\Controls_Manager::SELECT;
			$field_params['options'] = $p['options'];

		} elseif ( 'checkbox' === $type  ) {

			$field_params['type'] = \Elementor\Controls_Manager::SWITCHER;
			$field_params['label_on'] = $p['label_on'];
			$field_params['label_off'] = $p['label_off'];
			$field_params['return_value'] = $p['return_value'];

		} elseif ( 'font_family' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::SELECT;
			$field_params['options'] = ['font' => 'Font name'];

		} elseif ( 'link' === $type ) {

		}

		if ( isset( $p['default'] ) ) {
			$field_params['default'] = $p['default'];
		}

		if ( isset( $p['condition'] ) ) {
			$field_params['condition'] = $p['condition'];
		}

		if ( isset( $p['description'] ) ) {
			$field_params['description'] = $p['description'];
		}

		//debug( $field_params );

		$widget->add_control(
			$p['param_name'],
			$field_params
		);
	}
}

/**
 * Add widget categories
 */
function wolf_core_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'music',
		[
			'title' => esc_html__( 'Music', '%TEXTDOMAIN%' ),
			'icon' => 'fa fa-music',
		]
	);

	$elements_manager->add_category(
		'extension',
		[
			'title' => esc_html__( 'Extension', '%TEXTDOMAIN%' ),
			'icon' => 'fa fa-extension',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'wolf_core_add_elementor_widget_categories' );