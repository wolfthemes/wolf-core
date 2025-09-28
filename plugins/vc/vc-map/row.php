<?php
/**
 * Row
 *
 * @author WolfThemes
 * @package wolf-core/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/* Removing parameters */
vc_remove_param( 'vc_row', 'el_id' );
vc_remove_param( 'vc_row', 'gap' );
vc_remove_param( 'vc_row', 'full_width' );
vc_remove_param( 'vc_row', 'full_height' );
vc_remove_param( 'vc_row', 'columns_placement' );
vc_remove_param( 'vc_row', 'content_placement' );
vc_remove_param( 'vc_row', 'video_bg' );
vc_remove_param( 'vc_row', 'video_bg_url' );
vc_remove_param( 'vc_row', 'video_bg_parallax' );
vc_remove_param( 'vc_row', 'parallax' );
vc_remove_param( 'vc_row', 'parallax_image' );
vc_remove_param( 'vc_row', 'parallax_speed_bg' );
vc_remove_param( 'vc_row', 'parallax_speed_video' );
vc_remove_param( 'vc_row', 'disable_element' );
vc_remove_param( 'vc_row', 'css' );

// Overwite icon.
vc_map_update(
	'vc_row',
	array(
		'icon'   => 'fa fa-ellipsis-h',
		'weight' => 1000,
	)
);

// inspired by js_composer/conifg/buttons/shortcode-vc-button.php
$bigtext_params = vc_map_integrate_shortcode(
	wolf_core_convert_params_to_vc( wolf_core_bigtext_params() ),
	'bt_', // bt stands for big text
	esc_html( 'Big Text', 'wolf-core' ),
	array(
		'exclude' => array(
			'title_tag',
			'link',
			'css_animation'       => '',
			'css_animation_delay' => '',
			'el_class'            => '',
			'css'                 => '',
			'inline_style'        => '',
		),
	),
	array(
		'element' => 'add_bigtext',
		'value'   => 'true',
	)
);

// Populate integrated vc_icons params.
if ( is_array( $bigtext_params ) && ! empty( $bigtext_params ) ) {
	foreach ( $bigtext_params as $key => $param ) {
		if ( is_array( $param ) && ! empty( $param ) ) {

			// if ( 'i_type' == $param['param_name'] ) {
				// force dependency
				$bigtext_params[ $key ]['admin_label'] = false;
			// }
		}
	}
}

/**
 * Row params
 */
vc_add_params(
	'vc_row',
	array_merge(
		wolf_core_row_general_params(),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Skin Tone', 'wolf-core' ),
				'param_name' => 'font_color',
				'value'      => array(
					esc_html__( 'Light', 'wolf-core' ) => 'dark',
					esc_html__( 'Dark', 'wolf-core' )  => 'light',
				),
				'std'        => apply_filters( 'wolf_core_default_row_font_color', 'dark' ),
				'group'      => esc_html__( 'Style', 'wolf-core' ),
				'weight'     => 0,
			),
		),
		array_merge(
			wolf_core_background_params(),
			array(
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Video mute button (beta)', 'wolf-core' ),
					'param_name'  => 'video_bg_mute_button',
					'dependency'  => array(
						'element' => 'background_type',
						'value'   => array( 'video' ),
					),
					'description' => esc_html__( 'Only if parallax is not enabled.', 'wolf-core' ),
					'group'       => esc_html__( 'Style', 'wolf-core' ),
				),

				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Unmute video by default', 'wolf-core' ),
					'param_name' => 'video_bg_unmute',
					'dependency' => array(
						'element' => 'background_type',
						'value'   => array( 'video' ),
					),
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),
			),
			array(
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Add Big Text Background', 'wolf-core' ),
					'param_name' => 'add_bigtext',
					'group'      => esc_html__( 'Style', 'wolf-core' ),
				),
			),
			$bigtext_params,
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Big Text Vertical Position', 'wolf-core' ),
					'param_name' => 'bt_vertical_align',
					'value'      => array(
						esc_html__( 'Middle', 'wolf-core' ) => 'middle',
						esc_html__( 'Top', 'wolf-core' )    => 'top',
						esc_html__( 'Bottom', 'wolf-core' ) => 'bottom',
					),
					'group'      => esc_html__( 'Big Text', 'wolf-core' ),
					'dependency' => array(
						'element' => 'add_bigtext',
						'value'   => 'true',
					),
				),
				array(
					'type'        => 'wolf_core_textfield',
					'heading'     => esc_html__( 'Big Text Maximum Width', 'wolf-core' ),
					'param_name'  => 'bt_max_width',
					'placeholder' => 2000,
					'group'       => esc_html__( 'Big Text', 'wolf-core' ),
					'dependency'  => array(
						'element' => 'add_bigtext',
						'value'   => 'true',
					),
				),

				// array(
				// 'type' => 'checkbox',
				// 'heading' => esc_html__( 'Marquee effect', 'wolf-core' ),
				// 'param_name' => 'bigtext_marquee',
				// 'group' => esc_html__( 'Big Text', 'wolf-core' ),
				// 'dependency' => array(
				// 'element' => 'add_bigtext',
				// 'value' => 'true',
				// ),
				// )
			)
		),
		wolf_core_style_params(),
		array(
			array(
				'type'               => 'dropdown',
				'heading'            => esc_html__( 'Border Color', 'wolf-core' ),
				'param_name'         => 'border_color',
				'value'              => array_merge(
					array( esc_html__( 'None', 'wolf-core' ) => 'none' ),
					wolf_core_get_shared_gradient_colors(),
					wolf_core_get_shared_colors(),
					array( esc_html__( 'Custom color', 'wolf-core' ) => 'custom' )
				),
				'param_holder_class' => 'wolf_core_colored-dropdown',
				'group'              => esc_html__( 'Custom', 'wolf-core' ),
				'weight'             => -5,
			),

			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Border Custom Color', 'wolf-core' ),
				'param_name' => 'border_custom_color',
				'dependency' => array(
					'element' => 'border_color',
					'value'   => 'custom',
				),
				'group'      => esc_html__( 'Custom', 'wolf-core' ),
				'weight'     => -5,
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Border Style', 'wolf-core' ),
				'param_name' => 'border_style',
				'value'      => array(
					esc_html__( 'None', 'wolf-core' )   => 'none',
					esc_html__( 'Solid', 'wolf-core' )  => 'solid',
					esc_html__( 'Dotted', 'wolf-core' ) => 'dotted',
					esc_html__( 'Dashed', 'wolf-core' ) => 'dashed',
					esc_html__( 'Double', 'wolf-core' ) => 'double',
					esc_html__( 'Groove', 'wolf-core' ) => 'groove',
					esc_html__( 'Ridge', 'wolf-core' )  => 'ridge',
					esc_html__( 'Inset', 'wolf-core' )  => 'inset',
					esc_html__( 'Outset', 'wolf-core' ) => 'outset',
				),
				'group'      => esc_html__( 'Custom', 'wolf-core' ),
				'weight'     => -5,
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Inline Style', 'wolf-core' ),
				'param_name'  => 'inline_style',
				'group'       => esc_html__( 'Custom', 'wolf-core' ),
				'description' => sprintf( esc_html__( 'Additional inline CSS that will be applied to the element. (e.g: %s)', 'wolf-core' ), 'color:red;' ),
				'weight'      => -5,
			),
		),
		wolf_core_row_extra_params(),
		wolf_core_row_shape_dividers_params()
	)
);

if ( class_exists( 'Wolf_Playlist_Manager' ) ) {

	// Player option
	$playlist_posts = get_posts( 'post_type="wpm_playlist"&numberposts=-1' );

	$playlist = array( '' => esc_html__( 'None', 'wolf-core' ) );
	if ( $playlist_posts ) {
		foreach ( $playlist_posts as $playlist_options ) {
			$playlist[ $playlist_options->ID ] = $playlist_options->post_title;
		}
	} else {
		$playlist[0] = esc_html__( 'No Playlist Yet', 'wolf-core' );
	}

	vc_add_params(
		'vc_row',
		array(

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Playlist', 'wolf-core' ),
				'param_name' => 'sticky_player_playlist_id',
				'value'      => array_flip( $playlist ),
				'group'      => esc_html__( 'Player Bar', 'wolf-core' ),
				'weight'     => -1000,
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Playlist Skin', 'wolf-core' ),
				'param_name' => 'sticky_player_playlist_skin',
				'value'      => array(
					esc_html__( 'Dark', 'wolf-core' )              => 'dark',
					esc_html__( 'Light', 'wolf-core' )             => 'dark',
					esc_html__( 'Transparent Light', 'wolf-core' ) => 'transparent-light',
					esc_html__( 'Transparent Dark', 'wolf-core' )  => 'transparent-dark',
				),
				'group'      => esc_html__( 'Player Bar', 'wolf-core' ),
				'weight'     => -1000,
			),
		)
	);
}
