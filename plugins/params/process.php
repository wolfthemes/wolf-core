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
				'icon'          => 'far fa-clock',
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
						'medium'      => esc_html__( 'Medium', 'wolf-visual-composer' ),
						'small'       => esc_html__( 'Small', 'wolf-visual-composer' ),
						'large'       => esc_html__( 'Large', 'wolf-visual-composer' ),
						'extra-large' => esc_html__( 'Extra Large', 'wolf-visual-composer' ),
					),
				),
				array(
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Show Joining Line', 'wolf-core' ),
					'param_name' => 'show_line',
				),
				array(
					'type'       => 'repeater',
					'param_name' => 'hours',
					'label'      => esc_html__( 'Hours', 'wolf-core' ),
					'params'     => array(

						array(
							'label'      => esc_html__( 'Day', 'wolf-core' ),
							'param_name' => 'day',
						),

						array(
							'label'      => esc_html__( 'Hours', 'wolf-core' ),
							'param_name' => 'hours',
						),
					),
				),
			),
		)
	);
}
