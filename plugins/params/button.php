<?php
/**
 * Button
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
function wolf_core_button_params() {

	return apply_filters(
		'wolf_core_button_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Button', 'wolf-core' ),
				'description'   => esc_html__( 'Eye catching button', 'wolf-core' ),
				'vc_base'       => 'vc_button',
				'vc_category'   => esc_html__( 'Basic', 'wolf-core' ),
				'el_categories' => array( 'basic' ),
				'el_base'       => 'button',
				'keywords'      => array( 'button' ),
				'icon'          => 'eicon-button',
				// 'icon'          => 'fa fa-square',
			),
			'params'     => wolf_core_get_button_params(),
		)
	);
}
