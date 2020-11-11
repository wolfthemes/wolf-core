<?php
/**
 * Row
 *
 * @author WolfThemes
 * @category Core
 * @package %TEXTDOMAIN%/Elements
 * @since 1.0.0
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
	wolf_core_bigtext_params(),
	'bt_', // bt stands for big text
	esc_html( 'Big Text', '%TEXTDOMAIN%' ),
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

// Row params
vc_add_params(
	'vc_row',
	array_merge(
		wolf_core_row_general_params(),
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Skin Tone', '%TEXTDOMAIN%' ),
				'param_name' => 'font_color',
				'value'      => array(
					esc_html__( 'Light', '%TEXTDOMAIN%' ) => 'dark',
					esc_html__( 'Dark', '%TEXTDOMAIN%' )  => 'light',
				),
				'std'        => apply_filters( 'wolf_core_default_row_font_color', 'dark' ),
				'group'      => esc_html__( 'Style', '%TEXTDOMAIN%' ),
				'weight'     => 0,
			),
		),
		array_merge(
			wolf_core_background_params(),
			array(
				array(
					'type'        => 'checkbox',
					'heading'     => esc_html__( 'Video mute button (beta)', '%TEXTDOMAIN%' ),
					'param_name'  => 'video_bg_mute_button',
					'dependency'  => array(
						'element' => 'background_type',
						'value'   => array( 'video' ),
					),
					'description' => esc_html__( 'Only if parallax is not enabled.', '%TEXTDOMAIN%' ),
					'group'       => esc_html__( 'Style', '%TEXTDOMAIN%' ),
				),

				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Unmute video by default', '%TEXTDOMAIN%' ),
					'param_name' => 'video_bg_unmute',
					'dependency' => array(
						'element' => 'background_type',
						'value'   => array( 'video' ),
					),
					'group'      => esc_html__( 'Style', '%TEXTDOMAIN%' ),
				),
			),
			array(
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Add Big Text Background', '%TEXTDOMAIN%' ),
					'param_name' => 'add_bigtext',
					'group'      => esc_html__( 'Style', '%TEXTDOMAIN%' ),
				),
			),
			$bigtext_params,
			array(
				array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Big Text Vertical Position', '%TEXTDOMAIN%' ),
					'param_name' => 'bt_vertical_align',
					'value'      => array(
						esc_html__( 'Middle', '%TEXTDOMAIN%' ) => 'middle',
						esc_html__( 'Top', '%TEXTDOMAIN%' ) => 'top',
						esc_html__( 'Bottom', '%TEXTDOMAIN%' ) => 'bottom',
					),
					'group'      => esc_html__( 'Big Text', '%TEXTDOMAIN%' ),
					'dependency' => array(
						'element' => 'add_bigtext',
						'value'   => 'true',
					),
				),
				array(
					'type'        => 'wolf_core_textfield',
					'heading'     => esc_html__( 'Big Text Maximum Width', '%TEXTDOMAIN%' ),
					'param_name'  => 'bt_max_width',
					'placeholder' => 2000,
					'group'       => esc_html__( 'Big Text', '%TEXTDOMAIN%' ),
					'dependency'  => array(
						'element' => 'add_bigtext',
						'value'   => 'true',
					),
				),

				// array(
				// 'type' => 'checkbox',
				// 'heading' => esc_html__( 'Marquee effect', '%TEXTDOMAIN%' ),
				// 'param_name' => 'bigtext_marquee',
				// 'group' => esc_html__( 'Big Text', '%TEXTDOMAIN%' ),
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
				'heading'            => esc_html__( 'Border Color', '%TEXTDOMAIN%' ),
				'param_name'         => 'border_color',
				'value'              => array_merge(
					array( esc_html__( 'None', '%TEXTDOMAIN%' ) => 'none' ),
					wolf_core_get_shared_gradient_colors(),
					wolf_core_get_shared_colors(),
					array( esc_html__( 'Custom color', '%TEXTDOMAIN%' ) => 'custom' )
				),
				'param_holder_class' => 'wolf_core_colored-dropdown',
				'group'              => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
				'weight'             => -5,
			),

			array(
				'type'       => 'colorpicker',
				'heading'    => esc_html__( 'Border Custom Color', '%TEXTDOMAIN%' ),
				'param_name' => 'border_custom_color',
				'dependency' => array(
					'element' => 'border_color',
					'value'   => 'custom',
				),
				'group'      => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
				'weight'     => -5,
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Border Style', '%TEXTDOMAIN%' ),
				'param_name' => 'border_style',
				'value'      => array(
					esc_html__( 'None', '%TEXTDOMAIN%' )   => 'none',
					esc_html__( 'Solid', '%TEXTDOMAIN%' )  => 'solid',
					esc_html__( 'Dotted', '%TEXTDOMAIN%' ) => 'dotted',
					esc_html__( 'Dashed', '%TEXTDOMAIN%' ) => 'dashed',
					esc_html__( 'Double', '%TEXTDOMAIN%' ) => 'double',
					esc_html__( 'Groove', '%TEXTDOMAIN%' ) => 'groove',
					esc_html__( 'Ridge', '%TEXTDOMAIN%' )  => 'ridge',
					esc_html__( 'Inset', '%TEXTDOMAIN%' )  => 'inset',
					esc_html__( 'Outset', '%TEXTDOMAIN%' ) => 'outset',
				),
				'group'      => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
				'weight'     => -5,
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Inline Style', '%TEXTDOMAIN%' ),
				'param_name'  => 'inline_style',
				'group'       => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
				'description' => sprintf( esc_html__( 'Additional inline CSS that will be applied to the element. (e.g: %s)', '%TEXTDOMAIN%' ), 'color:red;' ),
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

	$playlist = array( '' => esc_html__( 'None', '%TEXTDOMAIN%' ) );
	if ( $playlist_posts ) {
		foreach ( $playlist_posts as $playlist_options ) {
			$playlist[ $playlist_options->ID ] = $playlist_options->post_title;
		}
	} else {
		$playlist[0] = esc_html__( 'No Playlist Yet', '%TEXTDOMAIN%' );
	}

	vc_add_params(
		'vc_row',
		array(

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Playlist', '%TEXTDOMAIN%' ),
				'param_name' => 'sticky_player_playlist_id',
				'value'      => array_flip( $playlist ),
				'group'      => esc_html__( 'Player Bar', '%TEXTDOMAIN%' ),
				'weight'     => -1000,
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Playlist Skin', '%TEXTDOMAIN%' ),
				'param_name' => 'sticky_player_playlist_skin',
				'value'      => array(
					esc_html__( 'Dark', '%TEXTDOMAIN%' )  => 'dark',
					esc_html__( 'Light', '%TEXTDOMAIN%' ) => 'dark',
					esc_html__( 'Transparent Light', '%TEXTDOMAIN%' ) => 'transparent-light',
					esc_html__( 'Transparent Dark', '%TEXTDOMAIN%' ) => 'transparent-dark',
				),
				'group'      => esc_html__( 'Player Bar', '%TEXTDOMAIN%' ),
				'weight'     => -1000,
			),
		)
	);
}
