<?php
/**
 * Process
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
function wolf_core_process_params() {

	return apply_filters(
		'wolf_core_process_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Process', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_process',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'process',
				'icon'          => 'far fa-lightbulb',
			),
			'params'     => array(
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Layout', 'wolf-core' ),
					'param_name' => 'layout',
					'options'    => array(
						'horizontal' => esc_html__( 'Horizontal', 'wolf-core' ),
						'vertical'   => esc_html__( 'Vertical', 'wolf-core' ),
					),
				),
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Size', 'wolf-core' ),
					'param_name' => 'size',
					'options'    => array(
						'medium'      => esc_html__( 'Medium', 'wolf-core' ),
						'small'       => esc_html__( 'Small', 'wolf-core' ),
						'large'       => esc_html__( 'Large', 'wolf-core' ),
						'extra-large' => esc_html__( 'Extra Large', 'wolf-core' ),
					),
				),
				array(
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Show Joining Line', 'wolf-core' ),
					'param_name' => 'show_line',
				),
				array(
					'type'       => 'repeater',
					'param_name' => 'items',
					'label'      => esc_html__( 'Items', 'wolf-core' ),
					'params'     => array(

						array(
							'label'      => esc_html__( 'Title', 'wolf-core' ),
							'param_name' => 'title',
						),

						array(
							'type'       => 'select',
							'label'      => esc_html__( 'Type', 'wolf-core' ),
							'param_name' => 'type',
							'options'    => array(
								'icon'   => esc_html__( 'Icon', 'wolf-core' ),
								'number' => esc_html__( 'Number', 'wolf-core' ),
								'none'   => esc_html__( 'None', 'wolf-core' ),
							),
						),

						array(
							'param_name' => 'selected_icon',
							'type'       => 'icon',
							'label'      => esc_html__( 'Icon', 'wolf-core' ),
							'default'    => array(
								'value'   => apply_filters( 'wolf_core_default_icon', 'fa fa-rocket' ),
								'library' => apply_filters( 'wolf_core_default_icon_font', 'fontawesome' ),
							),
							'condition'  => array(
								'type' => 'icon',
							),
						),

						array(
							'label'      => esc_html__( 'Icon Color', 'wolf-core' ),
							'type'       => 'colorpicker',
							'param_name' => 'icon_color',
							'condition'  => array(
								'type' => 'icon',
							),
						),

						array(
							'label'      => esc_html__( 'Background', 'wolf-core' ),
							'type'       => 'image',
							'param_name' => 'background',
						),

						array(
							'label'      => esc_html__( 'Text', 'wolf-core' ),
							'param_name' => 'text',
						),

						array(
							'label'      => esc_html__( 'Link', 'wolf-core' ),
							'type'       => 'link',
							'param_name' => 'link',
						),
					),
				),
			),
		)
	);
}
