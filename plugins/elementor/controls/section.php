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
	'elementor/element/section/section_background/before_section_end',
	function ( $element ) {
		$element->add_control(
			'font_color',
			array(
				'label'        => esc_html__( 'Default Font Color', 'wolf-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'prefix_class' => 'wolf-core-font-',
				// 'render_type' => 'template',
				'options'      => array(
					''      => esc_html__( 'Default', 'wolf-core' ),
					'dark'  => esc_html__( 'Dark', 'wolf-core' ),
					'light' => esc_html__( 'Light', 'wolf-core' ),
				),
			)
		);
	},
	10
);

add_action(
	'elementor/element/container/section_background/before_section_end',
	function ( $element ) {
		$element->add_control(
			'font_color',
			array(
				'label'        => esc_html__( 'Default Font Color', 'wolf-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'prefix_class' => 'wolf-core-font-',
				// 'render_type' => 'template',
				'options'      => array(
					''      => esc_html__( 'Default', 'wolf-core' ),
					'dark'  => esc_html__( 'Dark', 'wolf-core' ),
					'light' => esc_html__( 'Light', 'wolf-core' ),
				),
			)
		);
	},
	10
);

/**
 * Add name option
 */
add_action(
	'elementor/element/section/section_layout/before_section_end',
	function ( $section, $args ) {
		$section->add_control(
			'name',
			array(
				'label'       => esc_html__( 'Name (Optional)', 'wolf-core' ),
				'description' => esc_html__( 'Required for the "one-page" scroll, this gives the name to the section.', 'wolf-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'ai'          => array(
					'active' => false,
				),
			)
		);

		$section->add_control(
			'el_class',
			array(
				'label' => esc_html__( 'Extra Class', 'wolf-core' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
				'ai'    => array(
					'active' => false,
				),
			)
		);
	},
	10,
	2
);

function wolf_core_add_section_name_option( $section, $args ) {

	// debug( 'plugin' );

	$section->add_control(
		'name',
		array(
			'label'       => esc_html__( 'Name (Optional)', 'wolf-core' ),
			'description' => esc_html__( 'Required for the "one-page" scroll, this gives the name to the section.', 'wolf-core' ),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'ai'          => array(
				'active' => false,
			),
		)
	);
}
add_action( 'elementor/element/container/section_layout/before_section_end', 'wolf_core_add_section_name_option', 10, 2 );

/**
 * Add parallax background option
 */
function wolf_core_add_parallax_background_option( $section, $args ) {
	$section->add_control(
		'parallax',
		array(
			'label'        => esc_html__( 'Parallax Background', 'wolf-core' ),
			'description'  => esc_html__( 'Will overwrite position settings (Not visible in editor preview yet)', 'wolf-core' ),
			'type'         => \Elementor\Controls_Manager::SWITCHER,
			'default'      => 'no',
			'return_value' => 'yes',
			'prefix_class' => 'wolf-core-row-parallax-',
			'label_on'     => esc_html__( 'Yes', 'wolf-core' ),
			'label_off'    => esc_html__( 'No', 'wolf-core' ),
			'condition'    => array(
				'background_background' => array( 'classic', 'video' ),
			),
		)
	);
}
add_action( 'elementor/element/section/section_background/before_section_end', 'wolf_core_add_parallax_background_option', 10, 2 );
add_action( 'elementor/element/container/section_background/before_section_end', 'wolf_core_add_parallax_background_option', 10, 2 );

/**
 * Render Section custom attributes
 */
function wolf_core_render_custom_attributes( $widget ) {

	// Make sure we are in a section/container element.
	if ( 'container' !== $widget->get_name() && 'section' !== $widget->get_name() ) {
		return;
	}

	$settings = $widget->get_active_settings();

	$widget->add_render_attribute( '_wrapper', 'class', 'wolf-core-elementor-row' );

	if ( isset( $settings['parallax'] ) && 'yes' === $settings['parallax'] ) {

		if ( 'video' === $settings['background_background'] && isset( $settings['background_video_link'] ) ) {

			wp_enqueue_script( 'jarallax-video' ); // enqeueue video parallax script.
			$widget->add_render_attribute( '_wrapper', 'data-jarallax-video', esc_url( $settings['background_video_link'] ) );
			$widget->add_render_attribute( '_wrapper', 'class', 'wolf-core-video-parallax' );

		} else {
			$widget->add_render_attribute( '_wrapper', 'class', 'wolf-core-parallax' );
		}
	}

	/* Default font color */
	if ( isset( $settings['font_color'] ) ) {
		$widget->add_render_attribute( '_wrapper', 'class', 'wolf-core-font-' . esc_attr( $settings['font_color'] ) );
		$widget->add_render_attribute( '_wrapper', 'data-font-skin', esc_attr( $settings['font_color'] ) );

		$skin = ( 'light' === $settings['font_color'] ) ? 'dark' : '';

		$widget->add_render_attribute( '_wrapper', 'data-color-tone', esc_attr( $skin ) );
	}

	/* Section ID and name data for one-page feature */
	if ( isset( $settings['el_class'] ) ) {
		$widget->add_render_attribute( '_wrapper', 'class', esc_attr( $settings['el_class'] ) );
	}

	/* Section ID and name data for one-page feature */
	if ( ! empty( $settings['name'] ) ) {
		$section_id = sanitize_title( $settings['name'] );
		$widget->add_render_attribute( '_wrapper', 'class', 'wolf-core-parent-row' );
		$widget->add_render_attribute( '_wrapper', 'id', $section_id );
		$widget->add_render_attribute( '_wrapper', 'data-anchor', $section_id );
		$widget->add_render_attribute( '_wrapper', 'data-row-name', esc_attr( $settings['name'] ) );
	}

	if ( isset( $settings['post_featured_img_bg'] ) && 'yes' === $settings['post_featured_img_bg'] ) {

		if ( wolf_core_get_the_id() && get_the_post_thumbnail_url( wolf_core_get_the_id(), 'wolf-core-XL' ) ) {
			// $widget->add_render_attribute( '_wrapper', 'class', 'wolf-core-row-post-featured-img-bg' );
			// $widget->add_render_attribute( '_wrapper', 'data-post-bg-image-url', get_the_post_thumbnail_url( wolf_core_get_the_id(), 'wolf-core-XL' ) );
		}
	}
}
add_action( 'elementor/frontend/section/before_render', 'wolf_core_render_custom_attributes', 10 );
add_action( 'elementor/frontend/container/before_render', 'wolf_core_render_custom_attributes', 10 );
