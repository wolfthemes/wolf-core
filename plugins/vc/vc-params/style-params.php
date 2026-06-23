<?php
/**
 * Style params for containers
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Style params
 */
function wolf_core_style_params() {
	return array(
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'CSS box', 'wolf-core' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Custom', 'wolf-core' ),
			'weight'     => -1,
		),
	);
}
