<?php
/**
 * Icon Box Controls
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Controls
 * @version 2.0.21
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add icon position
 */
add_action(
	'elementor/element/icon-box/section_icon/before_section_end',
	function ( $section, $args ) {

		$section->add_control(
			'icon_revert',
			array(
				'label'        => esc_html__( 'Icon Revert', 'wolf-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'wolf-core-icon-revert-',
				'condition'    => array(),
			)
		);
	},
	10,
	2
);
