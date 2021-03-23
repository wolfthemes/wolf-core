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
 * Add widget categories
 *
 * @param object $elements_manager Theme Elementor manager object.
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

	$elements_manager->add_category(
		'post-modules',
		array(
			'title' => esc_html__( 'Post Modules', 'wolf-core' ),
			'icon'  => 'fa fa-th',
		)
	);

	$elements_manager->add_category(
		'social',
		array(
			'title' => esc_html__( 'Social', 'wolf-core' ),
			'icon'  => 'fa fa-th',
		)
	);

}
add_action( 'elementor/elements/categories_registered', 'wolf_core_add_elementor_widget_categories' );

/**
 * Covert raw params to Elementor format params
 *
 * @param object $widget The widget object.
 * @param array  $params The parameters to pass.
 * @return void
 */
function wolf_core_convert_params_to_elementor( $widget, $params = array() ) {

	if ( array() === $params ) {
		$params = $widget->params['params'];
	}

	foreach ( $params as $p ) {

		if ( isset( $p['page_builder'] ) && 'vc' === $p['page_builder'] ) {
			continue;
		}

		$field_params = array();

		$type                        = $p['type'];
		$field_params['label']       = $p['label'];
		$field_params['placeholder'] = isset( $p['placeholder'] ) ? $p['placeholder'] : '';

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
			$field_params['options'] = array_merge( array( '' => esc_html__( 'Default' ) ), wolf_core_get_google_fonts_options() );

		} elseif ( 'link' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::URL;

		} elseif ( 'colorpicker' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::COLOR;

		} elseif ( 'video' === $type ) {

			$field_params['type']       = \Elementor\Controls_Manager::MEDIA;
			$field_params['media_type'] = 'video';

		} elseif ( 'image' === $type ) {

			$field_params['type']       = \Elementor\Controls_Manager::MEDIA;
			$field_params['media_type'] = 'image';

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

		/* Preview render */
		if ( isset( $p['selectors'] ) ) {
			$field_params['selectors'] = $p['selectors'];
		}

		$widget->add_control(
			$p['param_name'],
			$field_params
		);
	}
}

/**
 * Register Elementor controls.
 *
 * Register control sections of a widget from its params array.
 *
 * @return void
 */
function wolf_core_register_elementor_controls( $widget ) {
	/* Reorder params by group */
	$content_group_params  = array();
	$query_group_params    = array();
	$style_group_params    = array();
	$custom_group_params   = array();
	$extra_group_params    = array();
	$advanced_group_params = array();

	foreach ( $widget->params['params'] as $param ) {

		if ( ! isset( $param['group'] ) ) {
			$content_group_params[] = $param;
		} elseif ( 'Query' === $param['group'] ) {
			$query_group_params[] = $param;
		} elseif ( 'Style' === $param['group'] ) {
			$style_group_params[] = $param;
		} elseif ( 'Custom' === $param['group'] ) {
			$custom_group_params[] = $param;
		} elseif ( 'Extra' === $param['group'] ) {
			$extra_group_params[] = $param;
		} elseif ( 'Advanced' === $param['group'] ) {
			$advanced_group_params[] = $param;
		}
	}

	$widget->start_controls_section(
		'content_section',
		array(
			'label' => esc_html__( 'Content', 'wolf-core' ),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
		)
	);

	wolf_core_convert_params_to_elementor( $widget, $content_group_params );

	$widget->end_controls_section();

	if ( array() !== $query_group_params ) {
		$widget->start_controls_section(
			'query_section',
			array(
				'label' => esc_html__( 'Query', 'wolf-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		wolf_core_convert_params_to_elementor( $widget, $query_group_params );

		$widget->end_controls_section();
	}

	if ( array() !== $style_group_params ) {
		$widget->start_controls_section(
			'style_section',
			array(
				'label' => esc_html__( 'Style', 'wolf-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		wolf_core_convert_params_to_elementor( $widget, $style_group_params );

		$widget->end_controls_section();
	}

	if ( array() !== $custom_group_params ) {
		$widget->start_controls_section(
			'custom_section',
			array(
				'label' => esc_html__( 'custom', 'wolf-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		wolf_core_convert_params_to_elementor( $widget, $custom_group_params );

		$widget->end_controls_section();
	}

	if ( array() !== $extra_group_params ) {
		$widget->start_controls_section(
			'extra_section',
			array(
				'label' => esc_html__( 'Extra', 'wolf-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		wolf_core_convert_params_to_elementor( $widget, $extra_group_params );

		$widget->end_controls_section();
	}

	if ( array() !== $advanced_group_params ) {
		$widget->start_controls_section(
			'advanced_section',
			array(
				'label' => esc_html__( 'Advanced', 'wolf-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		wolf_core_convert_params_to_elementor( $widget, $style_group_params );

		$widget->end_controls_section();
	}
}
