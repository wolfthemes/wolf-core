<?php
/**
 * Blank
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
function wolf_core_work_category_marquee_params() {

	return apply_filters(
		'wolf_core_work_category_marquee_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Work Categoryies Marquee', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_work_category_marquee',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'work-category-marquee',
				'icon'             => 'linea-software linea-software-font-tracking',
				'register_scripts' => array(
					'wolf-core-work-category-marquee' => array(
						'src' => WOLF_CORE_JS . '/work-category-marquee.js',
					),
				),
				'scripts'          => array( 'wolf-core-work-category-marquee' ),
			),
			'params'     => array(
				array(
					'label'      => esc_html__( 'Count', 'wolf-visual-composer' ),
					'param_name' => 'count',
					'type'       => 'text',
				),
			),
		)
	);
}
