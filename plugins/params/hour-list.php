<?php
/**
 * Hour List
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
function wolf_core_hour_list_params() {

	return apply_filters(
		'wolf_core_hour_list_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Hour List', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_hour_list',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'hour-list',
				'icon'          => 'far fa-clock',
			),
			'params'     => array(
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
							'param_name' => 'hours_text',
						),
					),
				),
			),
		)
	);
}
