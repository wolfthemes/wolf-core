<?php
/**
 * Playlist
 *
 * Wolf Playlist Manager Plugin
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
function wolf_core_playlist_params() {

	if ( ! class_exists( 'Wolf_Playlist_Manager' ) ) {
		return;
	}

	$choices = array();

	$playlists = get_posts(
		array(
			'post_type'      => 'wpm_playlist',
			'posts_per_page' => -1,
		)
	); // get all playlist.

	foreach ( $playlists as $playlist ) {
		$choices[ $playlist->ID ] = $playlist->post_title;
	}

	// if no result display "no playlist".
	if ( array() === $choices ) {
		$choices[0] = esc_html__( 'No playlist created yet', '%TEXDOMAIN%' );
	}

	return apply_filters(
		'wolf_core_playlist_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Playlist', 'wolf-core' ),
				'description'   => esc_html__( 'Display one of your playlist', 'wolf-core' ),
				'vc_base'       => 'wolf_core_playlist',
				'el_base'       => 'playlist',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'el_categories' => array( 'music' ),
				'icon'          => 'dashicons-before dashicons-playlist-audio',
			),

			'params'     => array(
				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Playlist', '%TEXDOMAIN%' ),
					'param_name'  => 'id',
					'options'     => $choices,
					'admin_label' => true,
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Tracklist Visibility', '%TEXDOMAIN%' ),
					'param_name' => 'show_tracklist',
					'options'    => array(
						'true'  => esc_html__( 'Show', '%TEXDOMAIN%' ),
						'false' => esc_html__( 'Hide', '%TEXDOMAIN%' ),
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Skin', '%TEXDOMAIN%' ),
					'param_name' => 'theme',
					'options'    => array(
						'dark'  => esc_html__( 'Dark', '%TEXDOMAIN%' ),
						'light' => esc_html__( 'Light', '%TEXDOMAIN%' ),
					),
					'default'    => apply_filters( 'wee_default_playlist_skin', 'dark' ),
				),
			),
		)
	);
}
