<?php
/**
 * Album Tracklist
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
function wolf_core_album_tracklist_params() {

	$product_posts = get_posts( 'post_type="product"&numberposts=-1' );

	$products = array();
	if ( $product_posts ) {
		$products[''] = esc_html__( 'Not linked', 'wolf-core' );
		foreach ( $product_posts as $product_options ) {
			$products[ $product_options->ID ] = $product_options->post_title;
		}
	} else {
		$products[0] = esc_html__( 'No product yet', 'wolf-core' );
	}

	return apply_filters(
		'wolf_core_album_tracklist_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'album_tracklist', 'wolf-core' ),
				'description'   => esc_html__( 'Description.', 'wolf-core' ),
				'vc_base'       => 'wolf_core_album_tracklist',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'vc_as_parent'  => array( 'only' => 'wolf_core_album_tracklist_item' ),
				'el_categories' => array( 'extension' ),
				'el_base'       => 'album-tracklist',
				'icon'          => 'fa fa-text-width',
				'scripts'       => array( 'jquery', 'wolf-core-album-tracklist' ),
			),
			'params'     => array(
				array(
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Show Tracklist Numbers', 'wolf-core' ),
					'param_name' => 'show_numbers',
				),
				array(
					'type'       => 'repeater',
					'param_name' => 'tracks',
					'label'      => esc_html__( 'Tracks', 'wolf-core' ),
					'params'     => array(
						array(
							'param_name' => 'title',
							'label'      => esc_html__( 'Title', 'wolf-core' ),
						),
						array(
							'param_name' => 'duration',
							'label'      => esc_html__( 'Duration', 'wolf-core' ),
						),
						array(
							'param_name' => 'mp3',
							'label'      => esc_html__( 'MP3 File', 'wolf-core' ),
							'type'       => 'audio',
						),
						array(
							'param_name' => 'video_url',
							'label'      => esc_html__( 'Video URL', 'wolf-core' ),
							'type'       => 'video',
						),

						array(
							'type'       => 'select',
							'label'      => esc_html__( 'Link', 'wolf-core' ),
							'param_name' => 'action',
							'options'    => array(
								''         => esc_html__( 'None', 'wolf-core' ),
								'link'     => esc_html__( 'Buy Link', 'wolf-core' ),
								// 'add_to_cart' => esc_html__( 'Add to Cart', 'wolf-core' ),
								'download' => esc_html__( 'Free Download', 'wolf-core' ),
							),
						),

						array(
							'param_name' => 'price',
							'label'      => esc_html__( 'Price', 'wolf-core' ),
							'condition'  => array(
								'action' => 'link',
							),
						),

						array(
							'param_name' => 'itunes_url',
							'label'      => sprintf( esc_html__( '%s URL', 'wolf-core' ), 'Apple Music' ),
							'condition'  => array(
								'action' => 'link',
							),
						),

						array(
							'param_name' => 'amazon_url',
							'label'      => sprintf( esc_html__( '%s URL', 'wolf-core' ), 'Amazon' ),
							'condition'  => array(
								'action' => 'link',
							),
						),

						array(
							'param_name' => 'googleplay_url',
							'label'      => sprintf( esc_html__( '%s URL', 'wolf-core' ), 'YouTube Music' ),
							'condition'  => array(
								'action' => 'link',
							),
						),

						array(
							'param_name' => 'buy_url',
							'label'      => esc_html__( 'Other "Buy" URL', 'wolf-core' ),
							'condition'  => array(
								'action' => 'link',
							),
						),

						array(
							'type'        => 'select',
							'label'       => esc_html__( 'Link to WooCommerce Product', 'wolf-core' ),
							'param_name'  => 'product_id',
							'options'     => $products,
							'description' => esc_html__( 'Select a product to link to add an "Add to Cart" button.', 'wolf-core' ),
							'condition'   => array(
								'action' => 'link',
							),
						),
					),
					// 'defaults'   => array(
					// array(
					// 'title'     => esc_html__( 'Title', 'wolf-core' ),
					// 'duration'  => '',
					// 'mp3'       => '',
					// 'video_url' => '',
					// 'price'     => '',
					// 'action'    => '',
					// ),
					// ),
				),
			),
		)
	);
}
