<?php
/**
 * Section settings
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Controls
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;


/**
 * Add default typography color option
 */
add_action(
	'elementor/element/section/section_typo/after_section_start',
	function( $element ) {
		$element->add_control(
			'font_color',
			array(
				'label'        => esc_html__( 'Default Font Color', '%TEXTDOMAIN%' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'dark',
				'prefix_class' => 'wolf-core-font-',
				// 'render_type' => 'template',
				'options'      => array(
					'dark'  => esc_html__( 'Dark', '%TEXTDOMAIN%' ),
					'light' => esc_html__( 'Light', '%TEXTDOMAIN%' ),
				),
			)
		);
	},
	10
);


/**
 * Render default typography color class
 */
// add_action(
// 'elementor/frontend/section/before_render',
// function( $widget ) {

// Make sure we are in a section element
// if ( 'section' !== $widget->get_name() ) {
// return;
// }

// $settings = $widget->get_active_settings();
// if ( isset( $settings['font_color'] ) ) {
// $widget->add_render_attribute( '_wrapper', 'class', 'wolf-core-font-' . $settings['font_color'] );
// }
// },
// 10
// );

/**
 * Add parallax background option
 */
add_action(
	'elementor/element/section/section_background/before_section_end',
	function( $section, $args ) {

		$section->add_control(
			'parallax',
			array(
				'label'        => esc_html__( 'Parallax', '%TEXTDOMAIN%' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'default'      => 'no',
				'prefix_class' => '',
				'label_on'     => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
				'label_off'    => esc_html__( 'No', '%TEXTDOMAIN%' ),
				'condition'    => array(
					'background' => array( 'classic', 'video' ),
				),
			)
		);
	},
	10,
	2
);
