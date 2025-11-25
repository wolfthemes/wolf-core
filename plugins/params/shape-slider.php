<?php
/**
 * Shape Slider
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
function wolf_core_shape_slider_params() {

	return apply_filters(
		'wolf_core_shape_slider_params',
		array(
			'properties' => array(
				'name'             => esc_html__( 'Interactive Links', 'wolf-core' ),
				'description'      => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'          => 'wolf_core_shape_slider',
				'vc_category'      => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories'    => array( 'extension' ),
				'el_base'          => 'shape-slider',
				'icon'             => 'fas fa-shapes',
				'register_scripts' => array(
					'shape-slider' => array(
						'src'     => WOLF_CORE_JS . '/lib/shape-slider.min.js',
						'version' => WOLF_CORE_VERSION,
					),
				),
				'scripts'          => array( 'shape-slider' ),
			),
			'params'     => array(
				array(
					'type'       => 'repeater',
					'param_name' => 'panels',
					'label'      => esc_html__( 'Panels', 'wolf-core' ),
					'params'     => array(
						array(
							'param_name' => 'title',
							'label'      => esc_html__( 'Title', 'wolf-core' ),
						),

						array(
							'param_name' => 'url',
							'label'      => esc_html__( 'Link', 'wolf-core' ),
						),
					),
				),
			),
		)
	);
}
