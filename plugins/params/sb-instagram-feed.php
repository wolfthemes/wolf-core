<?php
/**
 * Instagram Feed
 *
 * Smash Balloon Social Feed Plugins
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
function wolf_core_sb_instagram_feed_params() {

	global $wpdb;

	/* Get feeds */
	$feeds_table_name = $wpdb->prefix . 'sbi_feeds';
	$feed_posts       = $wpdb->get_results(
		"SELECT * FROM {$feeds_table_name}"
	);

	$feeds    = array();
	$feeds[1] = esc_html__( 'Default', 'wolf-core' );
	if ( $feed_posts ) {
		foreach ( $feed_posts as $feed ) {
			$feeds[ $feed->id ] = $feed->feed_name;
		}
	}

	return apply_filters(
		'wolf_core_sb_instagram_feed_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Instagram Feed', 'wolf-core' ),
				'description'   => esc_html__( 'Your last instagram photos', 'wolf-core' ),
				'vc_base'       => 'wolf_core_sb_instagram_feed',
				'el_base'       => 'sb-instagram-feed',
				'vc_category'   => esc_html__( 'Extension', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'fa fa-instagram',
			),

			'params'     => array(

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Feed', 'wolf-core' ),
					'param_name' => 'feed',
					'options'    => $feeds,
					// 'default'    => '0',
				),

				// array(
				// 'type'        => 'text',
				// 'label'       => esc_html__( 'Image Count', 'wolf-core' ),
				// 'description' => esc_html__( 'Note that the instagram API may limit the number of image to display.', 'wolf-core' ),
				// 'param_name'  => 'num',
				// 'default'     => 12,
				// 'admin_label' => true,
				// ),

				// array(
				// 'type'        => 'select',
				// 'label'       => esc_html__( 'Columns', 'wolf-core' ),
				// 'param_name'  => 'cols',
				// 'options'     => array(
				// 6 => '6',
				// 5 => '5',
				// 4 => '4',
				// 3 => '3',
				// 2 => '2',
				// ),
				// 'default' => 4,
				// 'admin_label' => true,
				// ),

				// array(
				// 'type'        => 'text',
				// 'label'       => esc_html__( 'User', 'wolf-core' ),
				// 'description' => esc_html__( 'Your Instagram User Name. This must be from a connected account on the "Configure" tab.', 'wolf-core' ),
				// 'param_name'  => 'username',
				// 'admin_label' => true,
				// ),

				// array(
				// 'type'        => 'text',
				// 'label'       => esc_html__( 'API key (optional)', 'wolf-core' ),
				// 'description' => esc_html__( 'Leave empty to use the default API key set in the plugin settings.', 'wolf-core' ),
				// 'param_name'  => 'accesstoken',
				// 'admin_label' => true,
				// ),

				array(
					'type'       => 'checkbox',
					'label'      => esc_html__( 'Display follow button (theme style)', 'wolf-core' ),
					'param_name' => 'follow_button',
				),

				array(
					'type'       => 'text',
					'label'      => esc_html__( 'Button Text (theme style)', 'wolf-core' ),
					'param_name' => 'button_text',
					'condifion'  => array(
						'follow_button' => 'true',
					),
				),

				// array(
				// 'type'       => 'text',
				// 'label'      => esc_html__( 'Padding', 'wolf-core' ),
				// 'param_name' => 'imagepadding',
				// ),

				// array(
				// 'type'         => 'checkbox',
				// 'label'        => esc_html__( 'Show Header', 'wolf-core' ),
				// 'param_name'   => 'showheader',
				// 'description'  => esc_html__( 'Whether to show the feed Header.', 'wolf-core' ),
				// ),

				// array(
				// 'type'         => 'checkbox',
				// 'label'        => esc_html__( 'Show "Follow" button', 'wolf-core' ),
				// 'param_name'   => 'showfollow',
				// ),

				// array(
				// 'type'         => 'checkbox',
				// 'label'        => esc_html__( 'Show "Load More" button', 'wolf-core' ),
				// 'param_name'   => 'showbutton',
				// ),

				array(
					'type'         => 'checkbox',
					'label'        => esc_html__( 'Disable Default Hover Effect', 'wolf-core' ),
					'description'  => esc_html__( 'Check this option to set your own hover effect if you have the pro version of the Instagram Feed plugin.', 'wolf-core' ),
					'param_name'   => 'disable_default_hover',
					'label_on'     => esc_html__( 'Yes', 'wolf-core' ),
					'label_off'    => esc_html__( 'No', 'wolf-core' ),
					'return_value' => 'yes',
				),
			),
		)
	);
}
