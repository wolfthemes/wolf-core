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

		$type                        = isset( $p['type'] ) ? $p['type'] : '';
		$field_params['label']       = isset( $p['label'] ) ? $p['label'] : '';
		$field_params['placeholder'] = isset( $p['placeholder'] ) ? $p['placeholder'] : '';

		if ( isset( $p['default'] ) ) {
			$field_params['default'] = $p['default'];
		}

		if ( 'text' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::TEXT;

		} elseif ( 'textarea' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::TEXTAREA;

		} elseif ( 'select' === $type ) {

			$field_params['type']    = \Elementor\Controls_Manager::SELECT;
			$field_params['options'] = $p['options'];

			/* Set the first option as default */
			if ( ! isset( $p['default'] ) ) {
				$field_params['default'] = array_key_first( $p['options'] );
			}
		} elseif ( 'choose' === $type ) {

			$field_params['type']    = \Elementor\Controls_Manager::CHOOSE;
			$field_params['options'] = $p['options'];

		} elseif ( 'checkbox' === $type ) {

			$field_params['type']         = \Elementor\Controls_Manager::SWITCHER;
			$field_params['label_on']     = ( isset( $p['label_on'] ) ) ? $p['label_on'] : esc_html__( 'Yes', 'wolf-core' );
			$field_params['label_off']    = ( isset( $p['label_off'] ) ) ? $p['label_off'] : esc_html__( 'No', 'wolf-core' );
			$field_params['return_value'] = ( isset( $p['return_value'] ) ) ? $p['return_value'] : 'yes';

		} elseif ( 'font_family' === $type ) {

			$field_params['type']    = \Elementor\Controls_Manager::SELECT;
			$field_params['options'] = array_merge( array( '' => esc_html__( 'Default' ) ), wolf_core_get_google_fonts_options() );

		} elseif ( 'link' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::URL;

		} elseif ( 'colorpicker' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::COLOR;

		} elseif ( 'slider' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::SLIDER;

			if ( isset( $p['default'] ) && ! is_array( $p['default'] ) ) {
				$field_params['default'] = array(
					'unit' => '%',
					'size' => $p['default'],
				);
			}

			$field_params['size_units'] = isset( $p['size_units'] ) ? $p['size_units'] : array( '%' );

			if ( isset( $field_params['range'] ) ) {
				$field_params['range'] = $p['range'];
			} else {
				$field_params['range']['%'] = array(
					'min'  => ( isset( $p['min'] ) ) ? $p['min'] : 0,
					'max'  => ( isset( $p['max'] ) ) ? $p['max'] : 100,
					'step' => ( isset( $p['step'] ) ) ? $p['step'] : 1,
				);
			}
		} elseif ( 'scheme' === $type ) {

			$field_params['type']  = \Elementor\Controls_Manager::COLOR;
			$field_params['type']  = \Elementor\Scheme_Color::get_type();
			$field_params['value'] = \Elementor\Scheme_Color::COLOR_1;

		} elseif ( 'hidden' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::HIDDEN;

		} elseif ( 'video' === $type ) {

			$field_params['type']       = \Elementor\Controls_Manager::MEDIA;
			$field_params['media_type'] = 'video';

		} elseif ( 'image' === $type ) {

			$field_params['type']       = \Elementor\Controls_Manager::MEDIA;
			$field_params['media_type'] = 'image';

		} elseif ( 'images' === $type ) {

			$field_params['type'] = \Elementor\Controls_Manager::GALLERY;

		}

		if ( isset( $p['condition'] ) ) {
			$field_params['condition'] = $p['condition'];
		}

		if ( isset( $p['description'] ) ) {
			$field_params['description'] = $p['description'];
		}

		if ( isset( $p['label_block'] ) ) {
			$field_params['label_block'] = $p['label_block'];
		}

		/* Preview render */
		if ( isset( $p['selectors'] ) ) {
			$field_params['selectors'] = $p['selectors'];
		}

		if ( isset( $p['selector'] ) ) {
			$field_params['selector'] = $p['selector'];
		}

		if ( isset( $p['group_tabs'] ) && 'open' === $p['group_tabs'] ) {
			$widget->start_controls_tabs( $p['name'] );
		}

		if ( isset( $p['tab'] ) && 'open' === $p['tab'] ) {
			$widget->start_controls_tab(
				$p['name'],
				array(
					'label' => $p['label'],
				)
			);
		}

		if ( 'css_filters' === $type ) {

			$widget->add_group_control(
				\Elementor\Group_Control_Css_Filter::get_type(),
				array(
					'name'     => $p['param_name'],
					'selector' => $p['selector'],
				)
			);

		} elseif ( 'typography' === $type ) {

			$widget->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				array_merge(
					array( 'name' => $p['param_name'] ),
					$field_params
				)
			);

		} elseif ( isset( $p['param_name'] ) ) {

			$widget->add_control(
				$p['param_name'],
				$field_params
			);
		}

		if ( isset( $p['tab'] ) && 'close' === $p['tab'] ) {
			$widget->end_controls_tab();
		}

		if ( isset( $p['group_tabs'] ) && 'close' === $p['group_tabs'] ) {
			$widget->end_controls_tabs();
		}
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
				'label' => esc_html__( 'Title', 'wolf-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		wolf_core_convert_params_to_elementor( $widget, $style_group_params );

		$widget->end_controls_section();
	}

	if ( array() !== $custom_group_params ) {
		$widget->start_controls_section(
			'custom_section',
			array(
				'label' => esc_html__( 'Custom', 'wolf-core' ),
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

add_filter(
	'wolf_core_fp_container',
	function() {
		return '.elementor-section-wrap';
	}
);
