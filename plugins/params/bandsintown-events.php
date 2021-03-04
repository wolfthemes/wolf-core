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
 *  Element Parameters
 *
 * @return array
 */
function wolf_core_bandsintown_events_params() {

	return apply_filters(
		'wolf_core_bandsintown_events_params',
		array(
			'properties' => array(
				'name'        => esc_html__( 'Audio Button', '%TEXTDOMAIN%' ),
				'description' => esc_html__( 'A stylish presentation for your release', '%TEXTDOMAIN%' ),
				'vc_base'     => 'wolf_core_bandsintown_events',
				'el_base'     => 'bandsintown-events',
				'vc_category' => esc_html__( 'Music', '%TEXTDOMAIN%' ),
				'icon'        => 'fa wolficon-bandsintown',
			),

			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Artist Name', '%TEXTDOMAIN%' ),
					'param_name'  => 'artist',
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Display Limit', '%TEXTDOMAIN%' ),
					'param_name'  => 'display_limit',
					'admin_label' => true,
					'description' => esc_html__( 'Leave empty to display all shows', '%TEXTDOMAIN%' ),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Display Local Dates', '%TEXTDOMAIN%' ),
					'param_name' => 'local_dates',
					'value'      => array(
						'false' => esc_html__( 'No', '%TEXTDOMAIN%' ),
						'true' => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Display Past Dates', '%TEXTDOMAIN%' ),
					'param_name' => 'past_dates',
					'value'      => array(
						'true' => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
						'false' => esc_html__( 'No', '%TEXTDOMAIN%' ),
					),
				),
			),
		)
	);
}
