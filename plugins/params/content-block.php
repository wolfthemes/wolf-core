<?php
/**
 * Conten Block
 *
 * @author WolfThemes
 * @package WolfCore/Params
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 *  Content Block Parameters
 *
 * @return array
 */
function wolf_core_content_block_params() {

	$content_block_posts = get_posts( 'post_type="wolf_content_block"&numberposts=-1' );

	$content_blocks = array();
	if ( $content_block_posts ) {
		foreach ( $content_block_posts as $content_block_options ) {
			$content_blocks[ $content_block_options->ID ] = $content_block_options->post_title;
		}
	} else {
		$content_blocks[0] = esc_html__( 'No Content Block yet', 'wolf-core' );
	}

	return apply_filters(
		'wolf_core_content_block_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Content Block', 'wolf-core' ),
				'description'   => esc_html__( 'A block of content from the Content Block post type', 'wolf-core' ),
				'vc_base'       => 'wolf_content_block',
				'vc_category'   => esc_html__( 'Content', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'content-block',
				'icon'          => 'linea-software linea-software-layout-4lines',
			),
			'params'     => array(
				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Content Block', 'wolf-core' ),
					'param_name' => 'content_block_id',
					'options'    => $content_blocks,
					// 'default'    => '0',
				),
			),
			'js_view'    => 'WolfCoreContentBlockView',
		)
	);
}
