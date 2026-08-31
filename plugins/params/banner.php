<?php
/**
 * Banner
 *
 * @author WolfThemes
 * @package WolfCore/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Element Parameters
 *
 * @return array
 */
function wolf_core_banner_params() {

	/* Button params */
	$button_params   = array();
	$params_to_unset = array(
		'admin_label',
		'align',
		'link',
		'scroll_to_anchor',
		'css_animation',
		'css_anmation_delay',
		'css',
	);

	foreach ( wolf_core_get_button_params() as $key => $params ) {

		if ( ! isset( $params['param_name'] ) || in_array( $params['param_name'], $params_to_unset, true ) ) {

			continue;

		} else {
			/* Add prefix to param name */
			$params['param_name'] = 'btn_' . $params['param_name'];
		}

		/* Add condition */
		if ( ! isset( $params['condition'] ) && isset( $params['params_name'] ) ) {
			$params['condition'] = array(
				'add_button' => 'yes',
			);
		}

		$button_params[] = $params;
	}

	return apply_filters(
		'wolf_core_banner_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Banner', 'wolf-core' ),
				'description'   => esc_html__( 'A Big Linked Image with Text Overlay', 'wolf-core' ),
				'vc_base'       => 'wolf_core_banner',
				'el_base'       => 'banner',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'fa fa-bookmark-o',
			),

			'params'     => array_merge(
				array(
					array(
						'type'        => 'image',
						'label'       => esc_html__( 'Image', 'wolf-core' ),
						'param_name'  => 'image',
						'description' => esc_html__( 'Select image from media library.', 'wolf-core' ),
						'admin_label' => true,
					),

					// Image size.
					array(
						'type'        => 'select',
						'label'       => esc_html__( 'Banner Size', 'wolf-core' ),
						'param_name'  => 'img_size',
						'options'     => wolf_core_get_image_sizes(),
						'default'     => 'medium',
						'description' => esc_html__( 'You can set the "large", "medium" and "thumbnail" sizes in the WP media settings.', 'wolf-core' ),
						'admin_label' => true,
					),

					array(
						'type'        => 'text',
						'label'       => esc_html__( 'Custom Image Size', 'wolf-core' ),
						'param_name'  => 'custom_img_size',
						'description' => esc_html__( 'Enter size in pixels (Example: 200x100 (Width x Height).', 'wolf-core' ),
						'condition'   => array( 'img_size' => 'custom' ),
					),

					array(
						'type'        => 'text',
						'label'       => esc_html__( 'Text', 'wolf-core' ),
						'param_name'  => 'title',
						'admin_label' => true,
					),

					array(
						'type'       => 'select',
						'label'      => esc_html__( 'HTML Tag', 'wolf-core' ),
						'param_name' => 'title_tag',
						'options'    => array(
							'h1'   => 'H1',
							'h2'   => 'H2',
							'h3'   => 'H3',
							'h4'   => 'H4',
							'h5'   => 'H5',
							'h6'   => 'H6',
							'div'  => 'div',
							'span' => 'span',
							'p'    => 'p',
						),
					),

					array(
						'type'        => 'text',
						'label'       => esc_html__( 'Description', 'wolf-core' ),
						'param_name'  => 'tagline',
						'admin_label' => true,
					),

					array(
						'type'       => 'link',
						'label'      => esc_html__( 'Link', 'wolf-core' ),
						'param_name' => 'link',
					),

					array(
						'label'        => esc_html__( 'Alignment', 'wolf-core' ),
						'param_name'   => 'align',
						'type'         => 'choose',
						'options'      => array(
							'left'   => array(
								'title' => esc_html__( 'Left', 'wolf-core' ),
								'icon'  => 'eicon-h-align-left',
							),
							'center' => array(
								'title' => esc_html__( 'Center', 'wolf-core' ),
								'icon'  => 'eicon-h-align-center',
							),
							'right'  => array(
								'title' => esc_html__( 'Right', 'wolf-core' ),
								'icon'  => 'eicon-h-align-right',
							),
						),
						'selectors'    => array(
							'{{WRAPPER}} .wolf-core-banner' => 'margin-{{VALUE}}:0;',
						),
						'page_builder' => 'elementor',
					),

					array(
						'type'         => 'select',
						'label'        => esc_html__( 'Alignment', 'wolf-core' ),
						'param_name'   => 'align',
						'options'      => array(
							'center' => esc_html__( 'Center', 'wolf-core' ),
							'left'   => esc_html__( 'Left', 'wolf-core' ),
							'right'  => esc_html__( 'Right', 'wolf-core' ),
						),
						'page_builder' => 'vc',
					),

					array(
						'label'        => esc_html__( 'Text Alignment', 'wolf-core' ),
						'param_name'   => 'txt_align',
						'type'         => 'choose',
						'options'      => array(
							'left'   => array(
								'title' => esc_html__( 'Left', 'wolf-core' ),
								'icon'  => 'eicon-text-align-left',
							),
							'center' => array(
								'title' => esc_html__( 'Center', 'wolf-core' ),
								'icon'  => 'eicon-text-align-center',
							),
							'right'  => array(
								'title' => esc_html__( 'Right', 'wolf-core' ),
								'icon'  => 'eicon-text-align-right',
							),
						),
						'selectors'    => array(
							'{{WRAPPER}} .wolf-core-banner-caption' => 'text-align:{{VALUE}};',
						),
						'page_builder' => 'elementor',
					),

					array(
						'type'         => 'select',
						'label'        => esc_html__( 'Text Alignment', 'wolf-core' ),
						'param_name'   => 'txt_align',
						'options'      => array(
							'center' => esc_html__( 'Center', 'wolf-core' ),
							'left'   => esc_html__( 'Left', 'wolf-core' ),
							'right'  => esc_html__( 'Right', 'wolf-core' ),
						),
						'page_builder' => 'vc',
					),

					array(
						'label'        => esc_html__( 'Text Vertical Alignment', 'wolf-core' ),
						'param_name'   => 'txt_v_align',
						'type'         => 'choose',
						'options'      => array(
							'middle' => array(
								'title' => esc_html__( 'Middle', 'wolf-core' ),
								'icon'  => 'eicon-v-align-middle',
							),
							'bottom' => array(
								'title' => esc_html__( 'Bottom', 'wolf-core' ),
								'icon'  => 'eicon-v-align-bottom',
							),
							'top'    => array(
								'title' => esc_html__( 'Top', 'wolf-core' ),
								'icon'  => 'eicon-v-align-top',
							),
						),
						'selectors'    => array(
							'{{WRAPPER}} .wolf-core-banner-caption-table-cell' => 'vertical-align:{{VALUE}};',
						),
						'page_builder' => 'elementor',
					),

					array(
						'type'         => 'select',
						'label'        => esc_html__( 'Text Vertical Alignment', 'wolf-core' ),
						'param_name'   => 'txt_v_align',
						'options'      => array(
							'middle' => esc_html__( 'Middle', 'wolf-core' ),
							'bottom' => esc_html__( 'Bottom', 'wolf-core' ),
							'top'    => esc_html__( 'Top', 'wolf-core' ),
						),
						'page_builder' => 'vc',
					),

					array(
						'type'        => 'text',
						'label'       => esc_html__( 'Maximum width', 'wolf-core' ),
						'param_name'  => 'max_width',
						'description' => sprintf( esc_html__( 'Set a value in %1$s or %2$s if you want to constrain the image width.', 'wolf-core' ), 'px', '%' ),
						'placeholder' => '100%',
					),

					array(
						'type'       => 'checkbox',
						'label'      => esc_html__( 'Add Button?', 'wolf-core' ),
						'param_name' => 'add_button',
					),

					/* Typography Group controls for Elementor */
					array(
						'type'         => 'typography',
						'label'        => esc_html__( 'Title Typography', 'wolf-core' ),
						'param_name'   => 'typography',
						'selector'     => '{{WRAPPER}} .wolf-core-banner-title',
						'page_builder' => 'elementor',
						'group'        => esc_html__( 'Style', 'wolf-core' ),
					),

					/* Typography Settings for VC */
					array(
						'type'         => 'text',
						'label'        => esc_html__( 'Title Font Size', 'wolf-core' ),
						'param_name'   => 'font_size',
						'page_builder' => 'vc',
					),

					/* Overlay Color for VC */
					array(
						'type'               => 'select',
						'label'              => esc_html__( 'Overlay Color', 'wolf-core' ),
						'param_name'         => 'overlay_color',
						'options'            => array_merge(
							wolf_core_get_shared_colors(),
							array(
								'default'        => esc_html__( 'Default color', 'wolf-core' ),
								'gradient-red'   => esc_html__( 'Gradient Red', 'wolf-core' ),
								'gradient-green' => esc_html__( 'Gradient Green', 'wolf-core' ),
								'custom'         => esc_html__( 'Custom color', 'wolf-core' ),
							)
						),
						'description'        => esc_html__( 'Select a text color.', 'wolf-core' ),
						'param_holder_class' => 'wolf_core_colored-select',
						'group'              => esc_html__( 'Style', 'wolf-core' ),
						'page_builder'       => 'vc',
					),

					array(
						'type'         => 'colorpicker',
						'label'        => esc_html__( 'Overlay Custom Color', 'wolf-core' ),
						'param_name'   => 'overlay_custom_color',
						'condition'    => array(
							'color' > 'custom',
						),
						'group'        => esc_html__( 'Style', 'wolf-core' ),
						'page_builder' => 'vc',
					),

					/* Overlay Color for Elementor in Style tab */
					array(
						'label'        => esc_html__( 'Overlay Color', 'wolf-core' ),
						'type'         => 'select',
						'param_name'   => 'overlay_color',
						'options'      => array_merge(
							array(
								'auto'   => esc_html__( 'Auto', 'wolf-core' ),
								'#000'   => esc_html__( 'Black', 'wolf-core' ),
								'#fff'   => esc_html__( 'White', 'wolf-core' ),
								'custom' => esc_html__( 'Custom color', 'wolf-core' ),
							)
						),
						'default'      => 'auto',
						'page_builder' => 'elementor',
					),

					array(
						'type'         => 'colorpicker',
						'label'        => esc_html__( 'Overlay Color', 'wolf-core' ),
						'param_name'   => 'overlay_custom_color',
						'page_builder' => 'elementor',
						'selectors'    => array(
							'{{WRAPPER}} .wolf-core-bigtext' => 'color: {{VALUE}}!important;',
						),
						'group'        => esc_html__( 'Style', 'wolf-core' ),
					),

					/* Overlay Opacity */
					array(
						'type'         => 'slider',
						'label'        => esc_html__( 'Overlay Opacity', 'wolf-core' ),
						'param_name'   => 'overlay_opacity',
						'min'          => 0,
						'max'          => 1,
						'step'         => 0.01,
						'default'      => apply_filters( 'wolf_core_default_banner_overlay_opacity', 40 ) / 100,
						'selectors'    => array(
							'{{WRAPPER}} .bg-overlay' => 'opacity: {{SIZE}}!important;',
						),
						'group'        => esc_html__( 'Style', 'wolf-core' ),
						'page_builder' => 'elementor',
					),

					array(
						'type'         => 'slider',
						'label'        => esc_html__( 'Overlay Opacity in Percent', 'wolf-core' ),
						'param_name'   => 'overlay_opacity',
						'min'          => 0,
						'max'          => 100,
						'step'         => 1,
						'default'      => apply_filters( 'wolf_core_default_banner_overlay_opacity', 40 ),
						'group'        => esc_html__( 'Style', 'wolf-core' ),
						'page_builder' => 'vc',
					),
				),
				$button_params
			),
		)
	);
}
