<?php
/**
 * Spotify Player
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
function wolf_core_spotify_player_params() {

	return apply_filters(
		'wolf_core_spotify_player_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Spotify Player', 'wolf-core' ),
				'vc_base'       => 'wolf_core_spotify_player',
				'el_base'       => 'spotify-player',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'fab fa-spotify',
			),

			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Spotify Link', 'wolf-core' ),
					'param_name'  => 'url',
					'placeholder' => 'https://open.spotify.com/album|track|artist|playlist/4RuzGKLG99XctuBMBkFFOC',
					'description' => esc_html__( 'A Spotify link URL containing the word "album", "track, "artist", or "playlist".', 'wolf-core' ),
					'admin_label' => true,
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Type', 'wolf-core' ),
					'param_name'  => 'type',
					'options'     => array(
						'large'   => esc_html__( 'Large', 'wolf-core' ),
						'compact' => esc_html__( 'Compact', 'wolf-core' ),
					),
					'default'     => 'large',
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Width', 'wolf-core' ),
					'param_name'  => 'width',
					'default'     => 700,
					'placeholder' => '700',
					'admin_label' => true,
				),

				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Height', 'wolf-core' ),
					'param_name'  => 'height',
					'default'     => 380,
					'placeholder' => '380',
					'admin_label' => true,
					'condition'   => array(
						'type' => 'large',
					),
				),
			),
		)
	);
}
