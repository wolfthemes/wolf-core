<?php
/**
 * Image Carousel Controls
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Controls
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add image carousel
 */
add_action(
	'elementor/element/image-carousel/section_additional_options/before_section_end',
	function ( $section, $args ) {

		$section->add_control(
			'el_class',
			array(
				'label' => esc_html__( 'Extra Class', 'wolf-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);
	},
	10,
	2
);

/**
 * Render image-carousel custom attributes
 */
add_action(
	'elementor/frontend/widget/before_render',
	function ( $widget ) {

		if ( 'image-carousel' !== $widget->get_name() ) {
			return;
		}

		$settings = $widget->get_active_settings();

		if ( isset( $settings['el_class'] ) ) {
			$widget->add_render_attribute( '_wrapper', 'class', esc_attr( $settings['el_class'] ) );
		}
	},
	10
);
