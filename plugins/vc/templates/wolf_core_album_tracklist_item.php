<?php // phpcs:ignore
/**
 * Album tracklist shortcode template
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

// Album Tracklist Item.
vc_map(
	array(
		'name'     => esc_html__( 'Track', 'wolf-core' ),
		'base'     => 'wolf_core_album_tracklist_item',
		'as_child' => array( 'only' => 'wolf_core_album_tracklist' ),
		'category' => esc_html__( 'Content', 'wolf-core' ),
		'icon'     => 'fa fa-music',
		'params'   => array(

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Title', 'wolf-core' ),
				'param_name'  => 'title',
				'placeholder' => esc_html__( 'My Awesome Song', 'wolf-core' ),
				'admin_label' => true,
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Duration', 'wolf-core' ),
				'param_name'  => 'duration',
				'placeholder' => '3:25',
				'admin_label' => true,
			),

			array(
				'type'        => 'wolf_core_audio_url',
				'heading'     => esc_html__( 'Mp3 URL', 'wolf-core' ),
				'param_name'  => 'mp3',
				'admin_label' => true,
			),

			// array(
			// 'type' => 'wolf_core_audio_url',
			// 'heading' => esc_html__( 'Ogg URL', 'wolf-core' ),
			// 'param_name' => 'ogg',
			// 'description' => esc_html__( 'Add alternate sources for maximum HTML5 playback.', 'wolf-core' ),
			// ),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Video URL', 'wolf-core' ),
				'param_name'  => 'video_url',
				'placeholder' => 'https://vimeo.com/124894010',
				'description' => sprintf(
					esc_html__( 'Support %1$s and %2$s', 'wolf-core' ),
					'YouTube',
					'Vimeo'
				),
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Price', 'wolf-core' ),
				'param_name'  => 'price',
				// 'placeholder' => '',
				'admin_label' => true,
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Link', 'wolf-core' ),
				'param_name' => 'action',
				'value'      => array(
					esc_html__( 'None', 'wolf-core' )          => '',
					esc_html__( 'Buy Link', 'wolf-core' )      => 'link',
					// esc_html__( 'Add to Cart', 'wolf-core' ) => 'add_to_cart',
					esc_html__( 'Free Download', 'wolf-core' ) => 'download',
				),
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => sprintf( esc_html__( '%s URL', 'wolf-core' ), 'Apple Music' ),
				'param_name'  => 'itunes_url',
				'placeholder' => 'http://',
				'dependency'  => array(
					'element' => 'action',
					'value'   => array( 'link' ),
				),
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => sprintf( esc_html__( '%s URL', 'wolf-core' ), 'Amazon' ),
				'param_name'  => 'amazon_url',
				'placeholder' => 'http://',
				'dependency'  => array(
					'element' => 'action',
					'value'   => array( 'link' ),
				),
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => sprintf( esc_html__( '%s URL', 'wolf-core' ), 'YouTube Music' ),
				'param_name'  => 'googleplay_url',
				'placeholder' => 'http://',
				'dependency'  => array(
					'element' => 'action',
					'value'   => array( 'link' ),
				),
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Other "Buy" URL', 'wolf-core' ),
				'param_name'  => 'buy_url',
				'placeholder' => 'http://',
				'dependency'  => array(
					'element' => 'action',
					'value'   => array( 'link' ),
				),
			),

		),
	)
);

if ( class_exists( 'WooCommerce' ) ) {
	$product_posts = get_posts( 'post_type="product"&numberposts=-1' );

	$products = array();
	if ( $product_posts ) {
		$products[ esc_html__( 'Not linked', 'wolf-core' ) ] = '';
		foreach ( $product_posts as $product_options ) {
			$products[ $product_options->post_title ] = $product_options->ID;
		}
	} else {
		$products[ esc_html__( 'No product yet', 'wolf-core' ) ] = 0;
	}

	vc_add_param(
		'wolf_core_album_tracklist_item',
		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Link to Product', 'wolf-core' ),
			'param_name'  => 'product_id',
			'value'       => $products,
			'dependency'  => array(
				'element' => 'action',
				'value'   => array( 'link' ),
			),
			'description' => esc_html__( 'Select a product to link to add an "Add to Cart" button.', 'wolf-core' ),
		)
	);
}

class WPBakeryShortCode_Wolf_Core_Album_Tracklist_Item extends WPBakeryShortCode {}
