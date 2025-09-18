<?php
/**
 *  WPBakery Page Builder Animation Params
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add animation and animation delay settings to certain elements
 */
$animated_elements = apply_filters(
	'wolf_core_animated_elements',
	array(
		'vc_accordion',
		'vc_button',
		'vc_cta',
		'vc_column',
		'vc_column_inner',
		'vc_column_text',
		'vc_custom_heading',
		'vc_gallery',
		'vc_gmaps',
		'vc_icon',
		'vc_message',
		'vc_pie',
		'vc_progress_bar',
		'vc_separator',
		'vc_single_image',
		// 'vc_row',
		'vc_tabs',
		'vc_toggle',
		'vc_video',
		'vc_zigzag',
		'wolf_core_advanced_slider',
		'wolf_core_audio',
		'wolf_core_audio_button',
		'wolf_core_audio_embed',
		'wolf_core_album_disc',
		'wolf_core_album_tracklist',
		'wolf_core_bandsintown_events',
		'wolf_core_banner',
		'wolf_core_bigtext',
		'wolf_core_breadcrumb',
		'wolf_core_cocoen',
		// 'wolf_core_countdown',
		// 'wolf_core_counter',
		'wolf_core_embed_video',
		'wolf_core_facebook_page_box',
		'wolf_core_google_maps',
		'wolf_core_image_device_slider',
		'wolf_core_headline',
		'wolf_core_hours',
		'wolf_core_image_link',
		'wolf_core_instagram_gallery',
		'wolf_core_sb_instagram_feed',
		'wolf_core_item_price',
		'wolf_core_list',
		'wolf_core_mailchimp',
		'wolf_core_playlist',
		'wolf_core_posts_slider',
		'wolf_core_posts_big_slider',
		'wolf_core_pricing_table',
		'wolf_core_process_container',
		'wolf_core_service_table',
		'wolf_core_social_icons',
		'wolf_core_social_icons_custom',
		'wolf_core_soundcloud',
		'wolf_core_spotify_player',
		'wolf_core_spotify_follow_button',
		'wolf_core_testimonial_slider',
		'wolf_core_testimonials',
		'wolf_core_team_member',
		// 'wolf_core_twitter',
		'wolf_core_typed',
		// 'wolf_core_video_opener',
		'wolf_core_video_switcher',
		'wolf_core_wc_categories',
	)
);

foreach ( $animated_elements as $animated_element ) {

	vc_add_params(
		$animated_element,
		array(
			array(
				'type'       => 'animation_style',
				'heading'    => esc_html__( 'Animation', 'wolf-visual-composer' ),
				'param_name' => 'css_animation',
				'group'      => esc_html__( 'Animation', 'wolf-visual-composer' ),
				'weight'     => -1,
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Animation Delay (in ms)', 'wolf-visual-composer' ),
				'param_name'  => 'css_animation_delay',
				'placeholder' => 0,
				'group'       => esc_html__( 'Animation', 'wolf-visual-composer' ),
				'weight'      => -1,
			),
		)
	);
}
