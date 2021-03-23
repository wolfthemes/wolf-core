<?php
/**
 * Bandsintown Events
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
function wolf_core_bandsintown_events_params() {

	return apply_filters(
		'wolf_core_bandsintown_events_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Bandsintown Events', 'wolf-core' ),
				'description'   => esc_html__( 'A stylish presentation for your release', 'wolf-core' ),
				'vc_base'       => 'wolf_core_bandsintown_events',
				'el_base'       => 'bandsintown-events',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'el_categories' => array( 'music' ),
				'icon'          => 'fa wolficon-bandsintown',
			),

			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Artist Name', 'wolf-core' ),
					'param_name'  => 'artist',
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Display Limit', 'wolf-core' ),
					'param_name'  => 'display_limit',
					'admin_label' => true,
					'description' => esc_html__( 'Leave empty to display all shows', 'wolf-core' ),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Display Local Dates', 'wolf-core' ),
					'param_name' => 'local_dates',
					'options'    => array(
						'false' => esc_html__( 'No', 'wolf-core' ),
						'true'  => esc_html__( 'Yes', 'wolf-core' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Display Past Dates', 'wolf-core' ),
					'param_name' => 'past_dates',
					'options'    => array(
						'true'  => esc_html__( 'Yes', 'wolf-core' ),
						'false' => esc_html__( 'No', 'wolf-core' ),
					),
				),
			),
		)
	);
}
