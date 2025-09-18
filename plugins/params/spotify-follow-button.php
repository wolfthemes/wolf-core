<?php
/**
 * Spotify Follow Button
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
function wolf_core_spotify_follow_button_params() {

	return apply_filters(
		'wolf_core_spotify_follow_button_params',
		array(
			'properties' => array(
				'name'          => esc_html__( 'Spotify Follow Button', 'wolf-core' ),
				'vc_base'       => 'wolf_core_spotify_follow_button',
				'el_base'       => 'spotify-follow-button',
				'vc_category'   => esc_html__( 'Music', 'wolf-core' ),
				'el_categories' => array( 'extension' ),
				'icon'          => 'fab fa-spotify',
			),

			'params'     => array(
				array(
					'type'        => 'text',
					'label'       => esc_html__( 'Spotify Artist Link', 'wolf-core' ),
					'param_name'  => 'url',
					'placeholder' => 'https://open.spotify.com/artist/4RuzGKLG99XctuBMBkFFOC',
					'admin_label' => true,
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Size', 'wolf-core' ),
					'param_name'  => 'size',
					'options'     => array(
						'detail' => esc_html__( 'Detailed', 'wolf-core' ),
						'basic'  => esc_html__( 'Basic', 'wolf-core' ),
					),
					'default'     => 'detail',
					'admin_label' => true,
				),

				array(
					'type'        => 'select',
					'label'       => esc_html__( 'Theme', 'wolf-core' ),
					'param_name'  => 'theme',
					'options'     => array(
						'light' => esc_html__( 'For bright backgrounds', 'wolf-core' ),
						'dark'  => esc_html__( 'For dark backgrounds', 'wolf-core' ),
					),
					'default'     => 'light',
					'admin_label' => true,
				),

				array(
					'type'        => 'checkbox',
					'label'       => esc_html__( 'Show follower count', 'wolf-core' ),
					'param_name'  => 'show_count',
					'default'     => 'yes',
					'admin_label' => true,
				),

				array(
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'type'         => 'choose',
					'options'      => array(
						'left'   => array(
							'title' => esc_html__( 'Left', 'wolf-core' ),
							'icon'  => 'eicon-text-align-left',
						),
						'center' => array(
							'title' => esc_html__( 'Center', 'wolf-core' ),
							'icon'  => 'eicon-text-align-center',
						),
						'right'  => array(
							'title' => esc_html__( 'Right', 'wolf-core' ),
							'icon'  => 'eicon-text-align-right',
						),
					),
					'selectors'    => array(
						'{{WRAPPER}} .wolf-core-spotify-follow-button-container' => 'text-align:{{VALUE}};',
					),
					'page_builder' => 'elementor',
				),

				array(
					'type'         => 'select',
					'label'        => esc_html__( 'Alignment', 'wolf-core' ),
					'param_name'   => 'alignment',
					'options'      => array(
						'center' => esc_html__( 'Center', 'wolf-core' ),
						'left'   => esc_html__( 'Left', 'wolf-core' ),
						'right'  => esc_html__( 'Right', 'wolf-core' ),
					),
					'page_builder' => 'vc',
				),
			),
		)
	);
}
