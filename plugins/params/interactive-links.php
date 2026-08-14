<?php
/**
 * Interactive Links
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Element Parameters
 *
 * @return array
 */
function wolf_core_interactive_links_params() {

	return apply_filters(
		'wolf_core_interactive_links_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Interactive Links', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_interactive_links',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'interactive-links',
				'icon'             => 'fas fa-hand-pointer',
				'register_scripts' => array(
					'wolf-core-youtube-video-bg'  => array(
						'src'     => WOLF_CORE_JS . '/YT-video-bg.js',
						'version' => WOLF_CORE_VERSION,
					),
					'wolf-core-interactive-links' => array(
						'src'     => WOLF_CORE_JS . '/interactive-links.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'wolf-core-youtube-video-bg', 'wolf-core-interactive-links' ),
			),
			'params'     => array(

				array(
					'type'         => 'typography',
					'label'        => esc_html__( 'Typography', 'wolf-core' ),
					'param_name'   => 'typography',
					'selector'     => '{{WRAPPER}} .wolf-core-interactive-link-text',
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-interactive-link-text' => 'color: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color Active', 'wolf-core' ),
					'param_name'   => 'color_active',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-interactive-link.link-active' => 'color: {{VALUE}}!important;',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				'panels' => array(
					'type'       => 'repeater',
					'param_name' => 'panels',
					'label'      => esc_html__( 'Panels', 'wolf-core' ),
					'params'     => array(
						array(
							'param_name' => 'title',
							'label'      => esc_html__( 'Title', 'wolf-core' ),
						),

						array(
							'param_name' => 'link',
							'type'       => 'link',
							'label'      => esc_html__( 'Link', 'wolf-core' ),
						),

						array(
							'param_name' => 'background',
							'type'       => 'background',
							'label'      => esc_html__( 'Background', 'wolf-core' ),
							'selectors'  => '{{WRAPPER}} .wolf-core-interactive-links-bg-holder',
						),

						array(
							'param_name' => 'font_family',
							'type'       => 'font_family',
							'label'      => esc_html__( 'Font Family', 'wolf-core' ),
							'selector'   => '{{WRAPPER}} {{CURRENT_ITEM}} .wolf-core-interactive-link-text',
						),
					),
				),
			),
		)
	);
}
