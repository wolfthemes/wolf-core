<?php
/**
 * Textual Showcase
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
function wolf_core_textual_showcase_params() {

	return apply_filters(
		'wolf_core_textual_showcase_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Textual Showcase', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_textual_showcase',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'textual-showcase',
				'icon'             => 'linea-software linea-software-font-kerning',
				'register_scripts' => array(
					'wolf-core-textual-showcase' => array(
						'src'     => WOLF_CORE_JS . '/textual-showcase.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'wolf-core-textual-showcase' ),
			),
			'params'     => array(

				array(
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'type'         => 'choose',
					'options'      => array(
						'flex-start' => array(
							'title' => esc_html__( 'Left', 'wolf-core' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center'     => array(
							'title' => esc_html__( 'Center', 'wolf-core' ),
							'icon'  => 'eicon-text-align-center',
						),
						'flex-end'   => array(
							'title' => esc_html__( 'Right', 'wolf-core' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-textual-showcase' => 'justify-content:{{VALUE}};',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'typography',
					'label'        => esc_html__( 'Typography', 'wolf-core' ),
					'param_name'   => 'typography',
					'selector'     => '{{WRAPPER}} .wolf-core-textual-showcase-item',
					'page_builder' => 'elementor',
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'colorpicker',
					'label'        => esc_html__( 'Text Color', 'wolf-core' ),
					'param_name'   => 'custom_color',
					'page_builder' => 'elementor',
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-textual-showcase' => 'color: {{VALUE}};',
					),
					'group'        => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Animate Items', 'wolf-core' ),
					'param_name'   => 'css_animation_each',
					'default'      => 'yes',
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'hidden',
					'label'        => esc_html__( 'Animation', 'wolf-core' ),
					'param_name'   => 'css_animation',
					'options'      => array(
						'none'            => esc_html__( 'None', 'wolf-core' ),
						'fade'            => esc_html__( 'Fade', 'wolf-core' ),
						'fade-up'         => esc_html__( 'Fade Up', 'wolf-core' ),
						'fade-down'       => esc_html__( 'Fade Down', 'wolf-core' ),
						'fade-left'       => esc_html__( 'Fade Left', 'wolf-core' ),
						'fade-right'      => esc_html__( 'Fade Right', 'wolf-core' ),
						'fade-up-right'   => esc_html__( 'Fade Up Right', 'wolf-core' ),
						'fade-up-left'    => esc_html__( 'Fade Up Left', 'wolf-core' ),
						'fade-down-right' => esc_html__( 'Fade Down Right', 'wolf-core' ),
						'fade-down-left'  => esc_html__( 'Fade Down Left', 'wolf-core' ),

						'uncoverXLeft'    => esc_html__( 'uncoverXLeft', 'wolf-core' ),
						'uncoverXRight'   => esc_html__( 'uncoverXRight', 'wolf-core' ),
						'uncoverYTop'     => esc_html__( 'uncoverYTop', 'wolf-core' ),
						'uncoverYBottom'  => esc_html__( 'uncoverYBottom', 'wolf-core' ),

						'flip-up'         => esc_html__( 'Flip Up', 'wolf-core' ),
						'flip-down'       => esc_html__( 'Flip Down', 'wolf-core' ),
						'flip-left'       => esc_html__( 'Flip Left', 'wolf-core' ),
						'flip-right'      => esc_html__( 'Flip Right', 'wolf-core' ),

						'slide-up'        => esc_html__( 'Slide Up', 'wolf-core' ),
						'slide-down'      => esc_html__( 'Slide Down', 'wolf-core' ),
						'slide-left'      => esc_html__( 'Slide Left', 'wolf-core' ),
						'slide-right'     => esc_html__( 'Slide Right', 'wolf-core' ),

						'zoom-in'         => esc_html__( 'Zoom In', 'wolf-core' ),
						'zoom-in-up'      => esc_html__( 'Zoom In Up', 'wolf-core' ),
						'zoom-in-down'    => esc_html__( 'Zoom In Down', 'wolf-core' ),
						'zoom-in-left'    => esc_html__( 'Zoom In Left', 'wolf-core' ),
						'zoom-in-right'   => esc_html__( 'Zoom In Right', 'wolf-core' ),
						'zoom-out'        => esc_html__( 'Zoom Out', 'wolf-core' ),
						'zoom-out-up'     => esc_html__( 'Zoom Out Up', 'wolf-core' ),
						'zoom-out-down'   => esc_html__( 'Zoom Out Down', 'wolf-core' ),
						'zoom-out-left'   => esc_html__( 'Zoom Out Left', 'wolf-core' ),
						'zoom-out-right'  => esc_html__( 'Zoom Out Right', 'wolf-core' ),
					),
					'default'      => 'none',
					'page_builder' => 'elementor',
					'condition'    => array(
						'css_animation_each' => 'yes',
					),
				),

				array(
					'type'       => 'repeater',
					'param_name' => 'items',
					'label'      => esc_html__( 'Items', 'wolf-core' ),
					'params'     => apply_filters(
						'wolf_core_textual_showcase_item_params',
						array(
							array(
								'type'       => 'text',
								'label'      => esc_html__( 'Text', 'wolf-core' ),
								'param_name' => 'text',
								// 'condition'  => array(
								// 'type' => array( 'text', 'text_hover_image', 'text_hover_video' ),
								// ),
							),
							array(
								'type'       => 'select',
								'label'      => esc_html__( 'Type', 'wolf-core' ),
								'param_name' => 'type',
								'options'    => array(
									'text'             => esc_html__( 'Text', 'wolf-core' ),
									'image'            => esc_html__( 'Image', 'wolf-core' ),
									'text_hover_image' => esc_html__( 'Text with Image on Hover', 'wolf-core' ),
									'text_hover_video' => esc_html__( 'Text with Video on Hover', 'wolf-core' ),
								),
								'default'    => 'text',
							),
							array(
								'type'       => 'image',
								'label'      => esc_html__( 'Image', 'wolf-core' ),
								'param_name' => 'image',
								'condition'  => array(
									'type' => array( 'image', 'text_hover_image' ),
								),
							),
							array(
								'type'       => 'image',
								'label'      => esc_html__( 'Image Hover', 'wolf-core' ),
								'param_name' => 'image_hover',
								'condition'  => array(
									'type' => array( 'image' ),
								),
							),

							array(
								'type'       => 'video',
								'label'      => esc_html__( 'Video', 'wolf-core' ),
								'param_name' => 'video',
								'condition'  => array(
									'type' => array( 'text_hover_video' ),
								),
							),

							array(
								'type'       => 'image',
								'label'      => esc_html__( 'Video Poster', 'wolf-core' ),
								'param_name' => 'video_poster',
								'condition'  => array(
									'type' => array( 'text_hover_video' ),
								),
							),

							array(
								'param_name' => 'link',
								'label'      => esc_html__( 'Link', 'wolf-core' ),
								'type'       => 'link',
							),

							array(
								'param_name' => 'line_break',
								'label'      => esc_html__( 'Line break', 'wolf-core' ),
								'type'       => 'checkbox',
							),

							// array(
							// 'param_name' => 'item_font_family',
							// 'type'       => 'font_family',
							// 'label'      => esc_html__( 'Font Family', 'wolf-core' ),
							// 'selectors'   => array(
							// '{{WRAPPER}} {{CURRENT_ITEM}} .wolf-core-tsi-text-inner' => 'font-family: {{VALUE}}!important;',
							// ),
							// 'condition'  => array(
							// 'type' => array( 'text', 'text_hover_image', 'text_hover_video' ),
							// ),
							// ),
						)
					),
				),
			),
		)
	);
}
