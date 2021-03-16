<?php
/**
 * Social Icons
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
function wolf_core_social_icons_params() {

	return apply_filters(
		'wolf_core_social_icons_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Social Icons', 'wolf-core' ),
				'description'   => esc_html__( 'A set of icons linked to your social profiles', 'wolf-visual-composer' ),
				'vc_base'       => 'wolf_core_social_icons',
				'el_base'       => 'social-icons',
				'vc_category'   => esc_html__( 'Social', 'wolf-core' ),
				'el_categories' => array( 'social' ),
				'icon'          => 'fa fa-share-alt',
			),

			'params'     => array(),
		)
	);
}
