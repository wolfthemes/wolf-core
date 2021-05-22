<?php
/**
 * Album Tracklist Item (for VC)
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
function wolf_core_album_tracklist_item_params() {

	return apply_filters(
		'wolf_core_album_tracklist_item_params',
		array(
			'properties' => array(
				'name'        => esc_html__( 'album_tracklist_item', 'wolf-core' ),
				'description' => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'     => 'wolf_core_album_tracklist_item',
				'vc_category' => esc_html__( 'Music', 'wolf-core' ),
				'vc_as_child' => array( 'only' => 'wolf_core_album_tracklist' ),
				'icon'        => 'fa fa-text-width',
			),
			'params'     => array(),
		)
	);
}
