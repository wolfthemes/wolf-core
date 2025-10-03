<?php
/**
 * Image settings
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Controls
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add inline option
 */
add_action(
	'elementor/element/image/section_image/before_section_end',
	function ( $element ) {
		$element->add_control(
			'inline_display',
			array(
				'label'        => esc_html__( 'Inline Display', 'wolf-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'wolf-core' ),
				'label_off'    => esc_html__( 'No', 'wolf-core' ),
				'return_value' => 'yes',
				'prefix_class' => 'wolf-core-image-inline-display-',
			)
		);
	},
	10
);

/**
 * Render image custom attributes
 */
add_action(
	'elementor/frontend/widget/before_render',
	function ( $widget ) {

		// Make sure we are in a section element.
		if ( 'image' !== $widget->get_name() ) {
			return;
		}

		$settings = $widget->get_active_settings();

		if ( isset( $settings['inline_display'] ) ) {
			$widget->add_render_attribute( '_wrapper', 'class', esc_attr( $settings['inline_display'] ) );
		}
	},
	10
);
