<?php
/**
 * Wolf Core Elementor Core functions
 *
 * General core functions available on admin and frontend for Elementor
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Core
 * @version 1.0.0
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

		$field_params = array();

		$type                        = $p['type'];
		$field_params['label']       = $p['label'];
		$field_params['placeholder'] = isset( $p['placeholder'] ) ? $p['placeholder'] : '';

		// Check if params is exluded for elementor
		if ( isset( $p['exclude_from'] ) && 'elementor' === $p['exclude_from'] ) {
			continue;
		}

		if ( 'text' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::TEXT;

		} elseif ( 'textarea' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::TEXTAREA;

		} elseif ( 'select' === $type ) {

			$field_params['type']    = \Elementor\Controls_Manager::SELECT;
			$field_params['options'] = $p['options'];

		} elseif ( 'choose' === $type ) {

			$field_params['type']    = \Elementor\Controls_Manager::CHOOSE;
			$field_params['options'] = $p['options'];

		} elseif ( 'checkbox' === $type ) {

			$field_params['type']         = \Elementor\Controls_Manager::SWITCHER;
			$field_params['label_on']     = $p['label_on'];
			$field_params['label_off']    = $p['label_off'];
			$field_params['return_value'] = $p['return_value'];

		} elseif ( 'font_family' === $type ) {

			$field_params['type']    = \Elementor\Controls_Manager::SELECT;
			$field_params['options'] = wolf_core_get_google_fonts_options();

		} elseif ( 'link' === $type ) {
			$field_params['type'] = \Elementor\Controls_Manager::URL;

		} elseif ( 'image' === $type ) {
			$field_params['type'] = \Elementor\Controls_Manager::MEDIA;

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
		array(
			'title' => esc_html__( 'Music', 'wolf-core' ),
			'icon'  => 'fa fa-music',
		)
	);

	$elements_manager->add_category(
		'extension',
		array(
			'title' => esc_html__( 'Extension', 'wolf-core' ),
			'icon'  => 'fa fa-extension',
		)
	);

}
add_action( 'elementor/elements/categories_registered', 'wolf_core_add_elementor_widget_categories' );
