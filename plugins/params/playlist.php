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

	$choices[0] = esc_html__( 'Choose a Playlist', '%TEXDOMAIN%' );

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
				'el_categories' => array( 'extension' ),
				'icon'          => 'linea-music linea-music-playlist',
				'scripts'       => array( 'jquery', 'wp-mediaelement', 'simplebar', 'jquery-cue', 'wpm-mejs', 'wpm-app' ),
			),

			'params'     => array(
				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Playlist', '%TEXDOMAIN%' ),
					'param_name'  => 'playlist_id',
					'options'     => $choices,
					'admin_label' => true,
					'default'     => '',
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Type', 'wolf-core' ),
					'param_name'  => 'is_sticky_player',
					'options'     => array(
						'false' => esc_html__( 'Large', 'wolf-core' ),
						'true'  => esc_html__( 'Compact', 'wolf-core' ),
					),
					'default'     => 'large',
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
					'default'    => 'true',
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
					'condition'  => array(
						'is_sticky_player' => 'false',
					),
				),

				array(
					'type'       => 'select',
					'label'      => esc_html__( 'Skin', '%TEXDOMAIN%' ),
					'param_name' => 'sticky_player_playlist_skin',
					'options'    => array(
						'dark'              => esc_html__( 'Dark', '%TEXDOMAIN%' ),
						'light'             => esc_html__( 'Light', '%TEXDOMAIN%' ),
						'transparent-light' => esc_html__( 'Transparent Light', 'wolf-visual-composer' ),
						'transparent-dark'  => esc_html__( 'Transparent Dark', 'wolf-visual-composer' ),
					),
					'default'    => apply_filters( 'wee_default_playlist_skin', 'dark' ),
					'condition'  => array(
						'is_sticky_player' => 'true',
					),
				),
			),
		)
	);
}
