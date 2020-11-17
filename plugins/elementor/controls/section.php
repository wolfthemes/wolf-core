<?php
/**
 * Section settings
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Controls
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

function add_elementor_page_settings_controls( \Elementor\PageSettings\Page $page ) {
	$page->add_control(
		'menu_item_color',
		[
			'label' => __( 'Menu Item Color', 'elementor' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .menu-item a' => 'color: {{VALUE}}',
			],
		]
	);
}

add_action( 'elementor/element/page-settings/section_page_style/before_section_end', 'add_elementor_page_settings_controls' );
