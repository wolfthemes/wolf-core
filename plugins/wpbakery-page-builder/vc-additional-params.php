<?php
/**
 * WPBakery Page Builder Extension Element Additional Settings
 *
 * @author WolfThemes
 * @category Core
 * @package WolfWPBakeryPageBuilderExtension/Admin
 * @version 3.2.8
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add styling option to post modules
 *
 * @param array $elements
 * @return array $elements
 */
function wolf_core_add_params_to_post_modules( $elements ) {

	$modules = array(
		'wvc_page_index',
		'wvc_post_index',
		'wvc_work_index',
		'wvc_product_index',
		'wvc_release_index',
		'wvc_event_index',
		'wvc_gallery_index',
		'wvc_artist_index',
		'wvc_video_index',
		'wvc_attachment_index',
		'wvc_mp_event_index',
	);

	$elements = array_merge( $elements, $modules );

	return $elements;
}
add_filter( 'wolf_core_stylable_elements', 'wolf_core_add_params_to_post_modules' );
add_filter( 'wolf_core_extra_class_elements', 'wolf_core_add_params_to_post_modules' );
add_filter( 'wolf_core_visibility_elements', 'wolf_core_add_params_to_post_modules' );

/**
 * Add class name param
 */
$extra_class_elements = apply_filters(
	'wolf_core_extra_class_elements',
	array(
		'vc_accordion',
		'vc_accordion_tab',
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
		'vc_tab',
		'vc_toggle',
		'vc_video',
		'vc_zigzag',
		'wolf_core_advanced_slider',
		'wolf_core_advanced_slide',
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
		'wolf_core_countdown',
		'wolf_core_counter',
		'wolf_core_embed_video',
		'wolf_core_facebook_page_box',
		'wolf_core_fittext',
		'wolf_core_google_maps',
		'wolf_core_hours',
		'wolf_core_image_device_slider',
		'wolf_core_image_link',
		'wolf_core_instagram',
		'wolf_core_instagram_gallery',
		'wolf_core_sb_instagram_feed',
		'wolf_core_interactive_link_item',
		'wolf_core_item_price',
		'wolf_core_list',
		'wolf_core_mailchimp',
		'wolf_core_playlist',
		'wolf_core_posts_slider',
		'wolf_core_posts_big_slider',
		// 'wolf_core_pricing_tables_container',
		'wolf_core_pricing_table',
		'wolf_core_process_container',
		'wolf_core_process_item',
		'wolf_core_service_table',
		'wolf_core_social_icons',
		'wolf_core_social_icons_custom',
		'wolf_core_soundcloud',
		'wolf_core_spotify_player',
		'wolf_core_spotify_follow_button',
		'wolf_core_testimonial_slider',
		'wolf_core_testimonials',
		'wolf_core_team_member',
		'wolf_core_twitter',
		'wolf_core_typed',
		'wolf_core_video_opener',
		'wolf_core_video_switcher',
		'wolf_core_wc_categories',
	)
);

foreach ( $extra_class_elements as $extra_class_element ) {
	vc_add_param(
		$extra_class_element,
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', '%TEXTDOMAIN%' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', '%TEXTDOMAIN%' ),
			'weight'      => -1000,
			'group'       => esc_html__( 'Extra', '%TEXTDOMAIN%' ),
		)
	);
}

/**
 * Add slider settings
 */
$slider_elements = apply_filters(
	'wolf_core_slider_elements',
	array(
		'wolf_core_image_device_slider',
		'wolf_core_advanced_slider',
		'wolf_core_anything_slider',
		'wolf_core_post_slider',
	)
);

foreach ( $slider_elements as $slider_element ) {
	vc_add_params(
		$slider_element,
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Autoplay', '%TEXTDOMAIN%' ),
				'param_name' => 'autoplay',
				'value'      => array(
					esc_html__( 'Yes', '%TEXTDOMAIN%' ) => 'true',
					esc_html__( 'No', '%TEXTDOMAIN%' )  => 'false',
				),
				'group'      => esc_html__( 'Slider Settings', '%TEXTDOMAIN%' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pause on Hover (if autoplay)', '%TEXTDOMAIN%' ),
				'param_name' => 'pause_on_hover',
				'value'      => array(
					esc_html__( 'Yes', '%TEXTDOMAIN%' ) => 'true',
					esc_html__( 'No', '%TEXTDOMAIN%' )  => 'false',
				),
				'group'      => esc_html__( 'Slider Settings', '%TEXTDOMAIN%' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Transition', '%TEXTDOMAIN%' ),
				'param_name' => 'transition',
				'value'      => array(
					esc_html__( 'Auto (fade by default and slide on touchable devices)', '%TEXTDOMAIN%' ) => 'auto',
					esc_html__( 'Slide', '%TEXTDOMAIN%' ) => 'slide',
					esc_html__( 'Fade', '%TEXTDOMAIN%' )  => 'fade',
				),
				'group'      => esc_html__( 'Slider Settings', '%TEXTDOMAIN%' ),
			),
			array(
				'type'       => 'wolf_core_textfield',
				'heading'    => esc_html__( 'Slideshow Speed in ms', '%TEXTDOMAIN%' ),
				'param_name' => 'slideshow_speed',
				'value'      => 6000,
				'group'      => esc_html__( 'Slider Settings', '%TEXTDOMAIN%' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Show Navigation Bullets', '%TEXTDOMAIN%' ),
				'param_name' => 'nav_bullets',
				'value'      => array(
					esc_html__( 'Yes', '%TEXTDOMAIN%' ) => 'true',
					esc_html__( 'No', '%TEXTDOMAIN%' )  => 'false',
				),
				'group'      => esc_html__( 'Slider Settings', '%TEXTDOMAIN%' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Show Navigation Arrows', '%TEXTDOMAIN%' ),
				'param_name' => 'nav_arrows',
				'value'      => array(
					esc_html__( 'Yes', '%TEXTDOMAIN%' ) => 'true',
					esc_html__( 'No', '%TEXTDOMAIN%' )  => 'false',
				),
				'group'      => esc_html__( 'Slider Settings', '%TEXTDOMAIN%' ),
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Navigation Tone', '%TEXTDOMAIN%' ),
				'param_name' => 'nav_tone',
				'value'      => array(
					esc_html__( 'Light', '%TEXTDOMAIN%' ) => 'light',
					esc_html__( 'Dark', '%TEXTDOMAIN%' )  => 'dark',
				),
				'group'      => esc_html__( 'Slider Settings', '%TEXTDOMAIN%' ),
			),
		)
	);
}

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
		'wolf_core_twitter',
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
				'heading'    => esc_html__( 'Animation', '%TEXTDOMAIN%' ),
				'param_name' => 'css_animation',
				'group'      => esc_html__( 'Animation', '%TEXTDOMAIN%' ),
				'weight'     => -1,
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Animation Delay (in ms)', '%TEXTDOMAIN%' ),
				'param_name'  => 'css_animation_delay',
				'placeholder' => 0,
				'group'       => esc_html__( 'Animation', '%TEXTDOMAIN%' ),
				'weight'      => -1,
			),
		)
	);
}

/**
 * Add design tab to chosen elements
 */
$stylable_elements = apply_filters(
	'wolf_core_stylable_elements',
	array(
		'vc_accordion',
		'vc_accordion_tab',
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
		// 'vc_row', doesn't work for some reason
		'vc_row_inner',
		'vc_toggle',
		'vc_tabs',
		'vc_tab',
		'vc_video',
		'vc_zigzag',
		'wolf_core_audio',
		'wolf_core_audio_button',
		'wolf_core_audio_embed',
		'wolf_core_album_disc',
		'wolf_core_album_tracklist',
		'wolf_core_bandsintown_events',
		'wolf_core_banner',
		'wolf_core_bigtext',
		'wolf_core_breadcrumb',
		'wolf_core_call_to_action',
		'wolf_core_cocoen',
		'wolf_core_countdown',
		'wolf_core_counter',
		'wolf_core_device_image_slider',
		'wolf_core_embed_video',
		'wolf_core_facebook_page_box',
		'wolf_core_fittext',
		'wolf_core_google_maps',
		'wolf_core_hours',
		'wolf_core_image_device_slider',
		'wolf_core_image_link',
		'wolf_core_instagram',
		'wolf_core_sb_instagram_feed',
		'wolf_core_item_price',
		'wolf_core_list',
		'wolf_core_mailchimp',
		// 'wolf_core_pricing_tables_container',
		'wolf_core_playlist',
		'wolf_core_pricing_table',
		'wolf_core_process_container',
		'wolf_core_posts_slider',
		'wolf_core_posts_big_slider',
		'wolf_core_separator',
		'wolf_core_service_table',
		'wolf_core_skill_bar',
		'wolf_core_soundcloud',
		'wolf_core_social_icons',
		'wolf_core_social_icons_custom',
		'wolf_core_spotify_player',
		'wolf_core_spotify_follow_button',
		'wolf_core_team_member',
		'wolf_core_testimonial_slider',
		'wolf_core_twitter',
		'wolf_core_typed',
		'wolf_core_video_opener',
		'wolf_core_video_switcher',
		'wolf_core_youtube',
		'wolf_core_wc_categories',
	)
);

foreach ( $stylable_elements as $stylable_element ) {
	vc_add_params(
		$stylable_element,
		array(
			array(
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'Css', '%TEXTDOMAIN%' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
				'weight'     => -10,
			),
			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Inline Style', '%TEXTDOMAIN%' ),
				'param_name'  => 'inline_style',
				'group'       => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
				'description' => sprintf( esc_html__( 'Additional inline CSS that will be applied to the element. (e.g: %s)', '%TEXTDOMAIN%' ), 'color:red;' ),
				'weight'      => -100, // be sure it's at the end of the form.
			),
		)
	);
}

/**
 * Add carousel settings
 */
$carousel_elements = apply_filters(
	'wolf_core_carousel_elements',
	array(
		'wolf_core_testimonials',
		'wolf_core_testimonial_slider',
	)
);

foreach ( $carousel_elements as $carousel_element ) {
	vc_add_params(
		$carousel_element,
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Autoplay', '%TEXTDOMAIN%' ),
				'param_name' => 'autoplay',
				'value'      => array(
					esc_html__( 'Yes', '%TEXTDOMAIN%' ) => 'true',
					esc_html__( 'No', '%TEXTDOMAIN%' )  => 'false',
				),
				'group'      => esc_html__( 'Carousel Settings', '%TEXTDOMAIN%' ),
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pause on Hover (if autoplay)', '%TEXTDOMAIN%' ),
				'param_name' => 'pause_on_hover',
				'value'      => array(
					esc_html__( 'Yes', '%TEXTDOMAIN%' ) => 'true',
					esc_html__( 'No', '%TEXTDOMAIN%' )  => 'false',
				),
				'group'      => esc_html__( 'Carousel Settings', '%TEXTDOMAIN%' ),
			),
			array(
				'type'       => 'wolf_core_textfield',
				'heading'    => esc_html__( 'Slideshow Speed in ms', '%TEXTDOMAIN%' ),
				'param_name' => 'slideshow_speed',
				'value'      => 6000,
				'group'      => esc_html__( 'Carousel Settings', '%TEXTDOMAIN%' ),
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Show Navigation Bullets', '%TEXTDOMAIN%' ),
				'param_name' => 'nav_bullets',
				'value'      => array(
					esc_html__( 'Yes', '%TEXTDOMAIN%' ) => 'true',
					esc_html__( 'No', '%TEXTDOMAIN%' )  => 'false',
				),
				'group'      => esc_html__( 'Carousel Settings', '%TEXTDOMAIN%' ),
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Show Navigation Arrows', '%TEXTDOMAIN%' ),
				'param_name' => 'nav_arrows',
				'value'      => array(
					esc_html__( 'Yes', '%TEXTDOMAIN%' ) => 'true',
					esc_html__( 'No', '%TEXTDOMAIN%' )  => 'false',
				),
				'group'      => esc_html__( 'Carousel Settings', '%TEXTDOMAIN%' ),
			),
		)
	);
}

/**
 * Add visibility settings
 */
$visibility_elements = apply_filters(
	'wolf_core_visibility_elements',
	array(
		'vc_custom_heading',
		'vc_column_text',
		'vc_empty_space',
		'vc_single_image',
		'wolf_core_social_icons',
	)
);

foreach ( $visibility_elements as $visibility_element ) {
	vc_add_params(
		$visibility_element,
		array(
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Visibility', '%TEXTDOMAIN%' ),
				'param_name' => 'hide_class',
				'value'      => array(
					esc_html__( 'Always visible', '%TEXTDOMAIN%' ) => '',
					esc_html__( 'Hide on tablet and mobile', '%TEXTDOMAIN%' ) => 'wvc-hide-tablet',
					esc_html__( 'Hide on mobile', '%TEXTDOMAIN%' ) => 'wvc-hide-mobile',
					esc_html__( 'Show on tablet and mobile only', '%TEXTDOMAIN%' ) => 'wvc-show-tablet',
					esc_html__( 'Show on mobile only', '%TEXTDOMAIN%' ) => 'wvc-show-mobile',
					esc_html__( 'Always hidden', '%TEXTDOMAIN%' ) => 'wvc-hide',
				),
				'group'      => esc_html__( 'Extra', '%TEXTDOMAIN%' ),
				'weight'     => -1000, // be sure it's at the end of the form
			),
		)
	);
}

if ( class_exists( 'Wolf_Videos' ) ) {
	/**
	 * Wolf Videos
	 */
	vc_add_param(
		'wolf_last_videos',
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Padding', '%TEXTDOMAIN%' ),
			'param_name' => 'padding',
			'value'      => array(
				'yes' => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
				'no'  => esc_html__( 'No', '%TEXTDOMAIN%' ),
			),
		)
	);
	vc_add_param(
		'wolf_last_videos',
		array(
			'type'       => 'animation_style',
			'heading'    => esc_html__( 'Animation', '%TEXTDOMAIN%' ),
			'param_name' => 'css_animation',
		)
	);
}

if ( class_exists( 'Wolf_Albums' ) ) {
	/**
	 * Wolf Albums
	 */
	vc_add_param(
		'wolf_last_albums',
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Padding', '%TEXTDOMAIN%' ),
			'param_name' => 'padding',
			'value'      => array(
				'yes' => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
				'no'  => esc_html__( 'No', '%TEXTDOMAIN%' ),
			),
		)
	);
	vc_add_param(
		'wolf_last_albums',
		array(
			'type'       => 'animation_style',
			'heading'    => esc_html__( 'Animation', '%TEXTDOMAIN%' ),
			'param_name' => 'css_animation',
		)
	);
}

if ( class_exists( 'Wolf_Discography' ) ) {
	/**
	 * Wolf Discorgaphy
	 */
	vc_add_param(
		'wolf_last_releases',
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Padding', '%TEXTDOMAIN%' ),
			'param_name' => 'padding',
			'value'      => array(
				'yes' => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
				'no'  => esc_html__( 'No', '%TEXTDOMAIN%' ),
			),
		)
	);
	vc_add_param(
		'wolf_last_releases',
		array(
			'type'       => 'animation_style',
			'heading'    => esc_html__( 'Animation', '%TEXTDOMAIN%' ),
			'param_name' => 'css_animation',
		)
	);
}

/**
 * Add background option to heading
 *
 * @param array $atts The attribute array.
 * @return array
 */
function wolf_core_add_background_option( $atts ) {

	if ( 'wbp-vc' === wolf_core_get_plugin_in_use() ) {

		$bg_params = array(
			array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Add Image Background?', '%TEXTDOMAIN%' ),
				'param_name'   => 'add_background',
				'label_on'     => esc_html__( 'Yes', '%TEXTDOMAIN%' ),
				'label_off'    => esc_html__( 'No', '%TEXTDOMAIN%' ),
				'return_value' => 'true',
			),

			array(
				'type'       => 'image',
				'label'      => esc_html__( 'Background Image', '%TEXTDOMAIN%' ),
				'param_name' => 'background_img',
				'condition'  => array(
					'add_background' => array( 'true' ),
				),
				'group'      => esc_html__( 'Background', '%TEXTDOMAIN%' ),
				'weight'     => 0,
			),

			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Background position', '%TEXTDOMAIN%' ),
				'param_name' => 'background_position',
				'options'    => array(
					'center center' => esc_html__( 'center center', '%TEXTDOMAIN%' ),
					'center top'    => esc_html__( 'center top', '%TEXTDOMAIN%' ),
					'left top'      => esc_html__( 'left top', '%TEXTDOMAIN%' ),
					'right top'     => esc_html__( 'right top', '%TEXTDOMAIN%' ),
					'center bottom' => esc_html__( 'center bottom', '%TEXTDOMAIN%' ),
					'left bottom'   => esc_html__( 'left bottom', '%TEXTDOMAIN%' ),
					'right bottom'  => esc_html__( 'right bottom', '%TEXTDOMAIN%' ),
					'left center'   => esc_html__( 'left center', '%TEXTDOMAIN%' ),
					'right center'  => esc_html__( 'right center', '%TEXTDOMAIN%' ),
				),
				'condition'  => array(
					'add_background' => array( 'true' ),
				),
				'group'      => esc_html__( 'Background', '%TEXTDOMAIN%' ),
				'weight'     => 0,
			),

			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Background repeat', '%TEXTDOMAIN%' ),
				'param_name' => 'background_repeat',
				'options'    => array(
					'no-repeat' => esc_html__( 'no repeat', '%TEXTDOMAIN%' ),
					'repeat'    => esc_html__( 'repeat', '%TEXTDOMAIN%' ),
					'repeat-x'  => esc_html__( 'repeat-x', '%TEXTDOMAIN%' ),
					'repeat-y'  => esc_html__( 'repeat-y', '%TEXTDOMAIN%' ),
				),
				'condition'  => array(
					'add_background' => array( 'true' ),
				),
				'group'      => esc_html__( 'Background', '%TEXTDOMAIN%' ),
				'weight'     => 0,
			),

			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Background size', '%TEXTDOMAIN%' ),
				'param_name' => 'background_size',
				'options'    => array(
					'inherit' => esc_html__( 'default', '%TEXTDOMAIN%' ),
					'cover'   => esc_html__( 'cover', '%TEXTDOMAIN%' ),
					'contain' => esc_html__( 'contain', '%TEXTDOMAIN%' ),
				),
				'dependency' => array(
					'element' => 'add_background',
					'value'   => array( 'true' ),
				),
				'group'      => esc_html__( 'Background', '%TEXTDOMAIN%' ),
				'weight'     => 0,
			),
		);

		$atts['params'] = array_merge( $atts['params'], $bg_params );
	}

	return $atts;
}
add_filter( 'wolf_core_custom_heading_params', 'wolf_core_add_background_option' );


/**
 * Column general params
 */
function wolf_core_column_general_params() {
	return array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content type', '%TEXTDOMAIN%' ),
			'param_name' => 'content_type',
			'value' => array(
				esc_html__( 'Text (padding)', '%TEXTDOMAIN%' ) => 'default',
				//esc_html__( 'Block with text content', '%TEXTDOMAIN%' ) => 'block-text',
				esc_html__( 'Media (no padding)', '%TEXTDOMAIN%' ) => 'block-media',
			),
			'description' => esc_html__( 'Select type of content you will insert.', '%TEXTDOMAIN%' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Vertical Position', '%TEXTDOMAIN%' ),
			'param_name' => 'content_placement',
			'value' => array(
				esc_html__( 'Default', '%TEXTDOMAIN%' ) => 'default',
				esc_html__( 'Top', '%TEXTDOMAIN%' ) => 'top',
				esc_html__( 'Middle', '%TEXTDOMAIN%' ) => 'middle',
				esc_html__( 'Bottom', '%TEXTDOMAIN%' ) => 'bottom',
			),
			'description' => esc_html__( 'Select the vertical position of the content.', '%TEXTDOMAIN%' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Horizontal Position', '%TEXTDOMAIN%' ),
			'param_name' => 'content_alignment',
			'value' => array(
				esc_html__( 'Center', '%TEXTDOMAIN%' ) => 'center',
				esc_html__( 'Left', '%TEXTDOMAIN%' ) => 'left',
				esc_html__( 'Right', '%TEXTDOMAIN%' ) => 'right',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', '%TEXTDOMAIN%' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Default Text Alignment', '%TEXTDOMAIN%' ),
			'param_name' => 'text_alignment',
			'value' => array(
				esc_html__( 'Default', '%TEXTDOMAIN%' ) => 'default',
				esc_html__( 'Left', '%TEXTDOMAIN%' ) => 'left',
				esc_html__( 'Center', '%TEXTDOMAIN%' ) => 'center',
				esc_html__( 'Right', '%TEXTDOMAIN%' ) => 'right',
			),
			'description' => esc_html__( 'Specify the text alignment inside the column. It can be overwritten in some elements.', '%TEXTDOMAIN%' ),
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Content Min Height', '%TEXTDOMAIN%' ),
			'param_name' => 'min_height',
			'placeholder' => 'auto',
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Content Max Width', '%TEXTDOMAIN%' ),
			'param_name' => 'max_width',
			'placeholder' => 'auto',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Column Style', '%TEXTDOMAIN%' ),
			'param_name' => 'column_style',
			'value' => array(
				esc_html__( 'None', '%TEXTDOMAIN%' ) => 'none',
				esc_html__( 'Box Shadow', '%TEXTDOMAIN%' ) => 'box-shadow',
				esc_html__( 'Boxed with Hover Effect', '%TEXTDOMAIN%' ) => 'boxed',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', '%TEXTDOMAIN%' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Width', '%TEXTDOMAIN%' ),
			'edit_field_class' => 'wvc-hidden',
			'param_name' => 'width',
			'value' => array(
				esc_html__( '1 column - 1/12', '%TEXTDOMAIN%' ) => '1/12',
				esc_html__( '2 columns - 1/6', '%TEXTDOMAIN%' ) => '1/6',
				esc_html__( '3 columns - 1/4', '%TEXTDOMAIN%' ) => '1/4',
				esc_html__( '4 columns - 1/3', '%TEXTDOMAIN%' ) => '1/3',
				esc_html__( '5 columns - 5/12', '%TEXTDOMAIN%' ) => '5/12',
				esc_html__( '6 columns - 1/2', '%TEXTDOMAIN%' ) => '1/2',
				esc_html__( '7 columns - 7/12', '%TEXTDOMAIN%' ) => '7/12',
				esc_html__( '8 columns - 2/3', '%TEXTDOMAIN%' ) => '2/3',
				esc_html__( '9 columns - 3/4', '%TEXTDOMAIN%' ) => '3/4',
				esc_html__( '10 columns - 5/6', '%TEXTDOMAIN%' ) => '5/6',
				esc_html__( '11 columns - 11/12', '%TEXTDOMAIN%' ) => '11/12',
				esc_html__( '12 columns - 1/1', '%TEXTDOMAIN%' ) => '1/1',
			),
			//'group' => __( 'Responsive Options', '%TEXTDOMAIN%' ),
			'description' => __( 'Select column width.', '%TEXTDOMAIN%' ),
			'std' => '1/1',
		),

		// Shift X-Axis
		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Shift X-Axis', '%TEXTDOMAIN%' ),
			'param_name' => 'shift_x',
			'min' => -1000,
			'max' => 1000,
			'step' => 10,
			'std' => 0,
			'group' => esc_html( 'Off-Grid', '%TEXTDOMAIN%' ),
			'weight' => -100,
		),

		// Shift Y-Axis
		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Shift Y-Axis', '%TEXTDOMAIN%' ),
			'param_name' => 'shift_y',
			'min' => -1000,
			'max' => 1000,
			'step' => 10,
			'std' => 0,
			'group' => esc_html( 'Off-Grid', '%TEXTDOMAIN%' ),
			'weight' => -100,
		),

		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Custom Z-Index', '%TEXTDOMAIN%' ),
			'param_name' => 'z_index',
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'std' => 0,
			'group' => esc_html( 'Off-Grid', '%TEXTDOMAIN%' ),
			'weight' => -100,
		),
	);
}


/**
 * Background params
 */
function wolf_core_background_params() {
	return array(

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Background type', '%TEXTDOMAIN%' ),
			'param_name' => 'background_type',
			'value' => array(
				esc_html__( 'Default', '%TEXTDOMAIN%' ) => 'default',
				esc_html__( 'Image and Color', '%TEXTDOMAIN%' ) => 'image',
				esc_html__( 'Slideshow', '%TEXTDOMAIN%' ) => 'slideshow',
				esc_html__( 'Video', '%TEXTDOMAIN%' ) => 'video',
				esc_html__( 'No Background', '%TEXTDOMAIN%' ) => 'transparent',
				esc_html__( 'Post Featured Image', '%TEXTDOMAIN%' ) => 'featured_image',
				esc_html__( 'Default WordPress Header', '%TEXTDOMAIN%' ) => 'default_header',
			),
			'std' => apply_filters( 'wolf_core_default_background_type', 'default' ),
			'group' => esc_html__( 'Style', '%TEXTDOMAIN%' ),
			'weight' => 0,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Background Color', '%TEXTDOMAIN%' ),
			'param_name' => 'background_color',
			'value' => array_merge(
				array( esc_html__( 'Default', '%TEXTDOMAIN%' ) => 'default', ),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', '%TEXTDOMAIN%' ) => 'custom', ),
				array( esc_html__( 'Transparent', '%TEXTDOMAIN%' ) => 'transparent', )
			),
			'std' => 'default',
			'description' => esc_html__( 'Select a background color.', '%TEXTDOMAIN%' ),
			'group' => esc_html__( 'Style', '%TEXTDOMAIN%' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
		),

		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Background Color', '%TEXTDOMAIN%' ),
			'param_name' => 'background_custom_color',
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
			'group' => esc_html__( 'Style', '%TEXTDOMAIN%' ),
			'weight' => 0,
			'dependency' => array(
				'element' => 'background_color',
				'value' => 'custom',
			),
		),

		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Background Image', '%TEXTDOMAIN%' ),
			'param_name' => 'background_img',
			'value' => '',
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
			'group' => esc_html__( 'Style', '%TEXTDOMAIN%' ),
			'weight' => 0,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Background position', '%TEXTDOMAIN%' ),
			'param_name' => 'background_position',
			'value' => array(
				esc_html__( 'center center', '%TEXTDOMAIN%' ) => 'center center',
				esc_html__( 'center top', '%TEXTDOMAIN%' )  => 'center top',
				esc_html__( 'left top', '%TEXTDOMAIN%' ) => 'left top',
				esc_html__( 'right top', '%TEXTDOMAIN%' )  => 'right top',
				esc_html__( 'center bottom', '%TEXTDOMAIN%' )  => 'center bottom',
				esc_html__( 'left bottom', '%TEXTDOMAIN%' )  => 'left bottom',
				esc_html__( 'right bottom', '%TEXTDOMAIN%' ) => 'right bottom',
				esc_html__( 'left center', '%TEXTDOMAIN%' ) => 'left center',
				esc_html__( 'right center', '%TEXTDOMAIN%' ) => 'right center',
			),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
			'group' => esc_html__( 'Style', '%TEXTDOMAIN%' ),
			'weight' => 0,
			//'edit_field_class' => 'wvc-half-start',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Background repeat', '%TEXTDOMAIN%' ),
			'param_name' => 'background_repeat',
			'value' => array(
				esc_html__( 'no repeat', '%TEXTDOMAIN%' ) => 'no-repeat',
				esc_html__( 'repeat', '%TEXTDOMAIN%' ) => 'repeat',
				esc_html__( 'repeat-x', '%TEXTDOMAIN%' ) => 'repeat-x',
				esc_html__( 'repeat-y', '%TEXTDOMAIN%' ) => 'repeat-y',
			),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
			//'edit_field_class' => 'wvc-half-end',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Background Size', 'wolf-visual-composer' ),
			'param_name' => 'background_size',
			'value' => array(
				esc_html__( 'cover', 'wolf-visual-composer' ) => 'cover',
				esc_html__( 'default', 'wolf-visual-composer' ) => 'default',
				esc_html__( 'contain', 'wolf-visual-composer' ) => 'contain',
			),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'image' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Background Effect', 'wolf-visual-composer' ),
			'param_name' => 'background_effect',
			'value' => apply_filters( 'wolf_core_background_effects', array(
				esc_html__( 'None', 'wolf-visual-composer' ) => 'none',
				esc_html__( 'Parallax', 'wolf-visual-composer' ) => 'parallax',
				esc_html__( 'Zoom', 'wolf-visual-composer' ) => 'zoomin',
				esc_html__( 'Fixed', 'wolf-visual-composer' ) => 'fixed',
				esc_html__( 'Marquee', 'wolf-visual-composer' ) => 'marquee',
				esc_html__( 'Blur', 'wolf-visual-composer' ) => 'blur',
			) ),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'image', 'default_header', 'featured_image' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Marquee Image Position', 'wolf-visual-composer' ),
			'param_name' => 'background_marquee_position',
			'value' => array(
				esc_html__( 'stretch', 'wolf-visual-composer' ) => 'stretch',
				esc_html__( 'top', 'wolf-visual-composer' ) => 'top',
				esc_html__( 'middle', 'wolf-visual-composer' ) => 'middle',
				esc_html__( 'bottom', 'wolf-visual-composer' ) => 'bottom',
			),
			'dependency' => array( 'element' => 'background_effect', 'value' => array( 'marquee' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'LazyLoad', 'wolf-visual-composer' ),
			'param_name' => 'background_img_lazyload',
			'value' => array( esc_html__( 'Yes', 'wolf-visual-composer' ) => true ),
			'std' => true,
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'image', 'default_header', 'featured_image' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		// Video URL
		array(
			'type' => 'wolf_core_video_url',
			'heading' => esc_html__( 'Video URL', 'wolf-visual-composer' ),
			'param_name' => 'video_bg_url',
			'value' => '',
			'description' => esc_html__( 'A YouTube, Vimeo, or mp4 URL.', 'wolf-visual-composer' ),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'video' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Video Start Time', 'wolf-visual-composer' ),
			'param_name' => 'video_bg_start_time',
			'value' => '',
			'description' => esc_html__( 'Set at which second the video will start (beta).', 'wolf-visual-composer' ),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'video' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Video End Time', 'wolf-visual-composer' ),
			'param_name' => 'video_bg_end_time',
			'value' => '',
			'description' => esc_html__( 'Set at which second the video will end (beta).', 'wolf-visual-composer' ),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'video' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Video Parallax', 'wolf-visual-composer' ),
			'param_name' => 'video_bg_parallax',
			'value' => '',
			'dependency' => array(
				'element' => 'background_type',
				'value' => array( 'video' )
			),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Loop video.', 'wolf-visual-composer' ),
			'param_name' => 'video_bg_loop',
			'value' => array(
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
				esc_html__( 'No', 'wolf-visual-composer' ) => 'no',
			),
			'dependency' => array(
				'element' => 'background_type',
				'value' => array( 'video' )
			),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
			'description' => esc_html__( 'Beta: If set to "No", the video will stop at the end only for YouTube video when parallax is not enabled.', 'wolf-visual-composer' ),
		),

		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Video Image Fallback', 'wolf-visual-composer' ),
			'param_name' => 'video_bg_img',
			'value' => '',
			'description' => esc_html__( 'An image to display when the video is loading.', 'wolf-visual-composer' ),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'video' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Video Image Mobile Fallback', 'wolf-visual-composer' ),
			'param_name' => 'video_bg_img_mobile',
			'value' => '',
			'description' => esc_html__( 'An image to display when the video can\'t be played. The image above will be used if empty.', 'wolf-visual-composer' ),
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'video' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		// Slideshow images
		array(
			'type' => 'attach_images',
			'heading' => esc_html__( 'Slideshow Images', 'wolf-visual-composer' ),
			'param_name' => 'slideshow_img_ids',
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'slideshow' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		// Slideshow speed
		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Slideshow Speed', 'wolf-visual-composer' ),
			'param_name' => 'slideshow_speed',
			'description' => esc_html__( 'In milliseconds.', 'wolf-visual-composer' ),
			'placeholder' => 5000,
			'std' => '5000',
			'dependency' => array( 'element' => 'background_type', 'value' => array( 'slideshow' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		// Overlay
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Add Overlay', 'wolf-visual-composer' ),
			'param_name' => 'add_overlay',
			'value' => array(
				esc_html__( 'No', 'wolf-visual-composer' ) => '',
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
			),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Overlay Color', 'wolf-visual-composer' ),
			'param_name' => 'overlay_color',
			'value' => array_merge(
				array( esc_html__( 'Auto', 'wolf-visual-composer' ) => 'auto', ),
				wolf_core_get_shared_gradient_colors(),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', 'wolf-visual-composer' ) => 'custom', )
			),
			'std' => 'black',
			'description' => esc_html__( 'Select an overlay color.', 'wolf-visual-composer' ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'dependency' => array( 'element' => 'add_overlay', 'value' => array( 'yes' ) ),
		),

		// Overlay color
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Overlay Custom Color', 'wolf-visual-composer' ),
			'param_name' => 'overlay_custom_color',
			//'value' => '#000000',
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'overlay_color',
				'value' => 'custom',
			),
		),

		// Overlay opacity
		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Overlay Opacity in Percent', 'wolf-visual-composer' ),
			'param_name' => 'overlay_opacity',
			'description' => '',
			'value' => 60,
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'dependency' => array( 'element' => 'add_overlay', 'value' => array( 'yes' ) ),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Add Top Shape Divider', 'wolf-visual-composer' ),
			'param_name' => 'add_top_shape_divider',
			'value' => array(
				esc_html__( 'No', 'wolf-visual-composer' ) => '',
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
			),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Add Bottom Shape Divider', 'wolf-visual-composer' ),
			'param_name' => 'add_bottom_shape_divider',
			'value' => array(
				esc_html__( 'No', 'wolf-visual-composer' ) => '',
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
			),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
			'weight' => 0,
		),

		// Particles
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Add Particles', 'wolf-visual-composer' ),
			'param_name' => 'add_particles',
			'value' => array(
				esc_html__( 'No', 'wolf-visual-composer' ) => '',
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
			),
			'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
		),

		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Particles Type', 'wolf-visual-composer' ),
		// 	'param_name' => 'particles_type',
		// 	'value' => array(
		// 		esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
		// 		esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
		// 	),
		// 	'dependency' => array( 'element' => 'add_particles', 'value' => array( 'yes' ) ),
		// 	'group' => esc_html__( 'Style', 'wolf-visual-composer' ),
		// ),
	);
}

/**
 * Column general params
 */
function wolf_core_column_inner_general_params() {
	return array(

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Vertical Position', 'wolf-visual-composer' ),
			'param_name' => 'content_placement',
			'value' => array(
				esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
				esc_html__( 'Top', 'wolf-visual-composer' ) => 'top',
				esc_html__( 'Middle', 'wolf-visual-composer' ) => 'middle',
				esc_html__( 'Bottom', 'wolf-visual-composer' ) => 'bottom',
			),
			'description' => esc_html__( 'Select the vertical position of the content.', 'wolf-visual-composer' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Horizontal Position', 'wolf-visual-composer' ),
			'param_name' => 'content_placement',
			'value' => array(
				esc_html__( 'Center', 'wolf-visual-composer' ) => 'center',
				esc_html__( 'Left', 'wolf-visual-composer' ) => 'left',
				esc_html__( 'Right', 'wolf-visual-composer' ) => 'right',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', 'wolf-visual-composer' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Default Text Alignment', 'wolf-visual-composer' ),
			'param_name' => 'text_alignment',
			'value' => array(
				esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
				esc_html__( 'Left', 'wolf-visual-composer' ) => 'left',
				esc_html__( 'Center', 'wolf-visual-composer' ) => 'center',
				esc_html__( 'Right', 'wolf-visual-composer' ) => 'right',
			),
			'description' => esc_html__( 'Specify the text alignment inside the column. It can be overwritten in some elements.', 'wolf-visual-composer' ),
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Content Min Height', 'wolf-visual-composer' ),
			'param_name' => 'min_height',
			'placeholder' => 'auto',
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Content Max Width', 'wolf-visual-composer' ),
			'param_name' => 'max_width',
			'placeholder' => 'auto',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Column Style', 'wolf-visual-composer' ),
			'param_name' => 'column_style',
			'value' => array(
				esc_html__( 'None', 'wolf-visual-composer' ) => 'none',
				esc_html__( 'Box Shadow', 'wolf-visual-composer' ) => 'box-shadow',
				esc_html__( 'Boxed with Hover Effect', 'wolf-visual-composer' ) => 'boxed',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', 'wolf-visual-composer' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Width', 'wolf-visual-composer' ),
			'edit_field_class' => 'wvc-hidden',
			'param_name' => 'width',
			'value' => array(
				esc_html__( '1 column - 1/12', 'wolf-visual-composer' ) => '1/12',
				esc_html__( '2 columns - 1/6', 'wolf-visual-composer' ) => '1/6',
				esc_html__( '3 columns - 1/4', 'wolf-visual-composer' ) => '1/4',
				esc_html__( '4 columns - 1/3', 'wolf-visual-composer' ) => '1/3',
				esc_html__( '5 columns - 5/12', 'wolf-visual-composer' ) => '5/12',
				esc_html__( '6 columns - 1/2', 'wolf-visual-composer' ) => '1/2',
				esc_html__( '7 columns - 7/12', 'wolf-visual-composer' ) => '7/12',
				esc_html__( '8 columns - 2/3', 'wolf-visual-composer' ) => '2/3',
				esc_html__( '9 columns - 3/4', 'wolf-visual-composer' ) => '3/4',
				esc_html__( '10 columns - 5/6', 'wolf-visual-composer' ) => '5/6',
				esc_html__( '11 columns - 11/12', 'wolf-visual-composer' ) => '11/12',
				esc_html__( '12 columns - 1/1', 'wolf-visual-composer' ) => '1/1',
			),
			//'group' => __( 'Responsive Options', 'wolf-visual-composer' ),
			'description' => __( 'Select column width.', 'wolf-visual-composer' ),
			'std' => '1/1',
		),
	);
}

/**
 * Row general params
 */
function wolf_core_row_general_params() {
	return array(

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Column Type', 'wolf-visual-composer' ),
			'param_name' => 'column_type',
			'value' => array(
				esc_html__( 'Columns', 'wolf-visual-composer' ) => 'column',
				esc_html__( 'Blocks', 'wolf-visual-composer' ) => 'block',
			),
			'std' => 'column',
			'description' => esc_html__( 'This will set a default style for your columns.', 'wolf-visual-composer' ),
			'weight' => 1,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Container Width', 'wolf-visual-composer' ),
			'param_name' => 'container_width',
			'value' => array(
				esc_html__( 'Wide', 'wolf-visual-composer' ) => 'wide',
				esc_html__( 'Boxed', 'wolf-visual-composer' ) => 'boxed',
				esc_html__( 'Small Boxed', 'wolf-visual-composer' ) => 'boxed-small',
				esc_html__( 'Large Boxed', 'wolf-visual-composer' ) => 'boxed-large',
			),
			'std' => 'wide',
			'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
			'weight' => 1,
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Box Shadow', 'wolf-visual-composer' ),
			'param_name' => 'box_shadow',
			'dependency' => array(
				'element' => 'container_width',
				'value_not_equal_to' => array( 'wide' ),
			),
			'weight' => 1,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content Width', 'wolf-visual-composer' ),
			'param_name' => 'content_width',
			'value' => array(
				sprintf( esc_html__( 'Standard width (%s centered)', 'wolf-visual-composer' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'standard',
				sprintf( esc_html__( 'Small width (%s centered)', 'wolf-visual-composer' ), apply_filters( 'wolf_core_row_small_width', '750px' ) ) => 'small',
				sprintf( esc_html__( 'Large width (%s centered)', 'wolf-visual-composer' ), '98%' ) => 'large',
				sprintf( esc_html__( 'Full width (%s)', 'wolf-visual-composer' ), '100%' ) => 'full',
			),
			'std' => apply_filters( 'wolf_core_default_row_content_width', 'standard' ),
			'dependency' => array( 'element' => 'container_width', 'value' => array( 'wide' ), ),
			'weight' => 1,
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Min Height', 'wolf-visual-composer' ),
			'param_name' => 'min_height',
			'placeholder' => 'auto',
			'description' => esc_html__( 'Insert the row minimum height.', 'wolf-visual-composer' ),
			'weight' => 1,
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Full height row?', 'wolf-visual-composer' ),
			'param_name' => 'full_height',
			'description' => esc_html__( 'If checked row will be set to full height.', 'wolf-visual-composer' ),
			'value' => array( esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes' ),
			'weight' => 1,
			//'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Columns Position', 'wolf-visual-composer' ),
			'param_name' => 'columns_placement',
			'value' => array(
				esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
				esc_html__( 'Middle', 'wolf-visual-composer' ) => 'middle',
				esc_html__( 'Top', 'wolf-visual-composer' ) => 'top',
				esc_html__( 'Bottom', 'wolf-visual-composer' ) => 'bottom',
				esc_html__( 'Stretch', 'wolf-visual-composer' ) => 'stretch',
			),
			'description' => esc_html__( 'Select columns position within row.', 'wolf-visual-composer' ),
			// 'dependency' => array(
			// 	'element' => 'full_height',
			// 	'not_empty' => true,
			// ),
			'weight' => 1,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Content Position', 'wolf-visual-composer' ),
			'param_name' => 'content_placement',
			'value' => array(
				esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
				esc_html__( 'Top', 'wolf-visual-composer' ) => 'top',
				esc_html__( 'Middle', 'wolf-visual-composer' ) => 'middle',
				esc_html__( 'Bottom', 'wolf-visual-composer' ) => 'bottom',
			),
			'description' => esc_html__( 'Select content position within columns.', 'wolf-visual-composer' ),
			'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ) ),
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Add pointing down arrow', 'wolf-visual-composer' ),
			'description' => esc_html__( 'Allow user to scroll to the next section when clicking on the arrow', 'wolf-visual-composer' ),
			'param_name' => 'arrow_down',
			'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
			'weight' => 1,
		),

		/*array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Mousewheel Scroll Down (beta)', 'wolf-visual-composer' ),
			'description' => esc_html__( 'Scroll to the next section automatically when scrolling down', 'wolf-visual-composer' ),
			'param_name' => 'mousewheel_down',
			'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
			'weight' => 1,
		),*/

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Arrow Caption', 'wolf-visual-composer' ),
			'param_name' => 'arrow_down_text',
			'placeholder' => esc_html__( 'Continue', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'arrow_down',
				'not_empty' => true,
			),
			'weight' => 1,
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Arrow Alignement', 'wolf-visual-composer' ),
			'param_name' => 'arrow_down_alignement',
			'value' => array(
				esc_html__( 'Center', 'wolf-visual-composer' ) => 'center',
				esc_html__( 'Left', 'wolf-visual-composer' ) => 'left',
				esc_html__( 'Right', 'wolf-visual-composer' ) => 'right',
			),
			'dependency' => array(
				'element' => 'arrow_down',
				'not_empty' => true,
			),
			'weight' => 1,
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Equal height', 'wolf-visual-composer' ),
			'param_name' => 'equal_height',
			'description' => esc_html__( 'If checked columns will be set to equal height.', 'wolf-visual-composer' ),
			'value' => array( esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes' ),
			'std' => 'no',
			'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
		),

		// Visibility
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Visibility', 'wolf-visual-composer' ),
			'param_name' => 'hide_class',
			'value' => array(
				esc_html__( 'Always visible', 'wolf-visual-composer' ) => '',
				esc_html__( 'Hide on tablet and mobile', 'wolf-visual-composer' ) => 'wvc-hide-tablet',
				esc_html__( 'Hide on mobile', 'wolf-visual-composer' ) => 'wvc-hide-mobile',
				esc_html__( 'Show on tablet and mobile only', 'wolf-visual-composer' ) => 'wvc-show-tablet',
				esc_html__( 'Show on mobile only', 'wolf-visual-composer' ) => 'wvc-show-mobile',
				esc_html__( 'Always hidden', 'wolf-visual-composer' ) => 'wvc-hide',
			),
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Disable row', 'wolf-visual-composer' ),
			'param_name' => 'disable_element',
			// Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'wolf-visual-composer' ),
			'value' => array( esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes' ),
		),

		// Shift Y-Axis
		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Shift Y-Axis', 'wolf-visual-composer' ),
			'param_name' => 'shift_y',
			'min' => -1000,
			'max' => 1000,
			'step' => 10,
			'std' => 0,
			'group' => esc_html( 'Off-Grid', 'wolf-visual-composer' ),
			'weight' => -100,
		),

		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Custom Z-Index', 'wolf-visual-composer' ),
			'param_name' => 'z_index',
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'std' => 0,
			'group' => esc_html( 'Off-Grid', 'wolf-visual-composer' ),
			'weight' => -100,
		),

		// Extra class
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'wolf-visual-composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wolf-visual-composer' ),
		),
	);
}

/**
 * Row extra params
 */
function wolf_core_row_extra_params() {
	return array(
		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Custom Column Gap', '%TEXTDOMAIN%' ),
			'param_name' => 'gap',
			'description' => esc_html__( 'The space gap between columns.', '%TEXTDOMAIN%' ),
			'weight' => -5,
			'std' => '',
			'group' => esc_html__( 'Advanced', '%TEXTDOMAIN%' ),
		),

		// Row name
		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Section name', '%TEXTDOMAIN%' ),
			'param_name' => 'row_name',
			'description' => esc_html__( 'Required for the onepage scroll, this gives the name to the section.', '%TEXTDOMAIN%' ),
			'weight' => -5,
			'group' => esc_html__( 'Advanced', '%TEXTDOMAIN%' ),
		),
	);
}

/**
 * Style params
 */
function wolf_core_style_params() {
	return array(
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', '%TEXTDOMAIN%' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
			'weight' => -1,
		),

		// array(
		// 	'type' => 'textfield',
		// 	'heading' => esc_html__( 'Border Color', '%TEXTDOMAIN%' ),
		// 	'param_name' => 'border_color',
		// 	'group' => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
		// 	'weight' => -1,
		// ),

		// array(
		// 	'type' => 'textfield',
		// 	'heading' => esc_html__( 'Border Style', '%TEXTDOMAIN%' ),
		// 	'param_name' => 'border_style',
		// 	'group' => esc_html__( 'Custom', '%TEXTDOMAIN%' ),
		// 	'weight' => -1,
		// ),
	);
}

/**
 * Row shape divider params
 */
function wolf_core_row_shape_dividers_params() {

	$sd_top = array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_type',
			'value' => array(
				esc_html__( 'Disabled', 'wolf-visual-composer' ) => 'disabled',
				esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
				esc_html__( 'Custom Image', 'wolf-visual-composer' ) => 'image',
				//esc_html__( 'Custom SVG', 'wolf-visual-composer' ) => 'custom_svg',
			),
			'weight' => -5,
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'add_top_shape_divider',
				'value' => array( 'yes' )
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_shape',
			'value' => wolf_core_get_shape_divider_options(),
			'weight' => -5,
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value' => array( 'default' ),
			),
		),

		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_img',
			'weight' => -5,
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value' => array( 'image' ),
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape Inverted', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_inverted',
			'value' => array(
				esc_html__( 'No', 'wolf-visual-composer' ) => '',
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
			),
			'weight' => -5,
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape Flip', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_flip',
			'value' => array(
				esc_html__( 'No', 'wolf-visual-composer' ) => '',
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
			),
			'weight' => -5,
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),


		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Shape Height', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_height',
			'description' => esc_html__( 'Enter a value in % or px.', 'wolf-visual-composer' ),
			'weight' => -5,
			'placeholder' => '25%',
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape Color', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_color',
			'value' => array_merge(
				array( esc_html__( 'Default', 'wolf-visual-composer' ) => 'default', ),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', 'wolf-visual-composer' ) => 'custom', ),
				array( esc_html__( 'Transparent', 'wolf-visual-composer' ) => 'transparent', )
			),
			'std' => 'default',
			'description' => esc_html__( 'Select a color.', 'wolf-visual-composer' ),
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'weight' => -5,
			'dependency' => array(
				'element' => 'sd_top_type',
				'value' => array( 'default' ),
			),
		),

		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Shape Custom Color', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_custom_color',
			'dependency' => array(
				'element' => 'sd_top_color',
				'value' => 'custom',
			),
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'weight' => -5,
		),

		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Shape Opacity', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_opacity',
			'weight' => -5,
			'std' => '',
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'std' => 100,
			'dependency' => array(
				'element' => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape Ratio', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_ratio',
			'value' => array(
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
				esc_html__( 'No', 'wolf-visual-composer' ) => 'no',
			),
			'weight' => -5,
			'std' => 'yes',
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Shape Z-Index', 'wolf-visual-composer' ),
			'param_name' => 'sd_top_zindex',
			'weight' => -5,
			'std' => '',
			'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
			'min' => 0,
			'max' => 10,
			'step' => 1,
			'std' => 0,
			'dependency' => array(
				'element' => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Shape Responsive', 'wolf-visual-composer' ),
		// 	'param_name' => 'sd_top_responsive',
		// 	'value' => array(
		// 		esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
		// 		esc_html__( 'No', 'wolf-visual-composer' ) => '',
		// 	),
		// 	'weight' => -5,
		// 	'group' => esc_html__( 'Divider Top', 'wolf-visual-composer' ),
		// 	'dependency' => array(
		// 		'element' => 'sd_top_type',
		// 		'value_not_equal_to' => array( 'disabled' )
		// 	),
		// )
	);

	$sd_bottom = array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_type',
			'value' => array(
				esc_html__( 'Disabled', 'wolf-visual-composer' ) => 'disabled',
				esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
				esc_html__( 'Custom Image', 'wolf-visual-composer' ) => 'image',
				//esc_html__( 'Custom SVG', 'wolf-visual-composer' ) => 'custom_svg',
			),
			'weight' => -5,
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'add_bottom_shape_divider',
				'value' => array( 'yes' )
			),
		),

		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_img',
			'weight' => -5,
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value' => array( 'image' ),
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_shape',
			'value' => wolf_core_get_shape_divider_options(),
			'weight' => -5,
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value' => array( 'default' ),
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape Inverted', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_inverted',
			'value' => array(
				esc_html__( 'No', 'wolf-visual-composer' ) => '',
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
			),
			'weight' => -5,
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape Flip', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_flip',
			'value' => array(
				esc_html__( 'No', 'wolf-visual-composer' ) => '',
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
			),
			'weight' => -5,
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),


		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Shape Height', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_height',
			'description' => esc_html__( 'Enter a value in % or px.', 'wolf-visual-composer' ),
			'weight' => -5,
			'placeholder' => '25%',
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape Color', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_color',
			'value' => array_merge(
				array( esc_html__( 'Default', 'wolf-visual-composer' ) => 'default', ),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', 'wolf-visual-composer' ) => 'custom', ),
				array( esc_html__( 'Transparent', 'wolf-visual-composer' ) => 'transparent', )
			),
			'std' => 'default',
			'description' => esc_html__( 'Select a color.', 'wolf-visual-composer' ),
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'weight' => -5,
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value' => array( 'default' ),
			),
		),

		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Shape Custom Color', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_custom_color',
			'dependency' => array(
				'element' => 'sd_bottom_color',
				'value' => 'custom',
			),
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'weight' => -5,
		),

		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Shape Opacity', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_opacity',
			'weight' => -5,
			'std' => '',
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'min' => 0,
			'max' => 100,
			'step' => 1,
			'std' => 100,
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Shape Ratio', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_ratio',
			'value' => array(
				esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
				esc_html__( 'No', 'wolf-visual-composer' ) => 'no',
			),
			'weight' => -5,
			'std' => 'yes',
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		array(
			'type' => 'wolf_core_numeric_slider',
			'heading' => esc_html__( 'Shape Z-Index', 'wolf-visual-composer' ),
			'param_name' => 'sd_bottom_zindex',
			'weight' => -5,
			'std' => '',
			'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
			'min' => 0,
			'max' => 10,
			'step' => 1,
			'std' => 0,
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' )
			),
		),

		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Shape Responsive', 'wolf-visual-composer' ),
		// 	'param_name' => 'sd_bottom_responsive',
		// 	'value' => array(
		// 		esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes',
		// 		esc_html__( 'No', 'wolf-visual-composer' ) => '',
		// 	),
		// 	'weight' => -5,
		// 	'group' => esc_html__( 'Divider Bottom', 'wolf-visual-composer' ),
		// 	'dependency' => array(
		// 		'element' => 'sd_bottom_type',
		// 		'value_not_equal_to' => array( 'disabled' )
		// 	),
		// )
	);

	return array_merge(
		$sd_top, $sd_bottom
	);
}

/**
 * Row inner general params
 */
function wolf_core_row_inner_general_params() {
	return array(
		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Column Type', 'wolf-visual-composer' ),
		// 	'param_name' => 'column_type',
		// 	'value' => array(
		// 		esc_html__( 'Columns', 'wolf-visual-composer' ) => 'column',
		// 		esc_html__( 'Block', 'wolf-visual-composer' ) => 'block',
		// 	),
		// 	'std' => 'column',
		// 	'description' => esc_html__( 'This will set a default style for your columns.', 'wolf-visual-composer' ),
		// 	'weight' => 1,
		// ),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Row Width', 'wolf-visual-composer' ),
			'param_name' => 'container_width',
			'value' => array(
				sprintf( esc_html__( 'Inherit', 'wolf-visual-composer' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'inherit',
				sprintf( esc_html__( 'Standard width (%s centered)', 'wolf-visual-composer' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'standard',
				sprintf( esc_html__( 'Small width (%s centered)', 'wolf-visual-composer' ), apply_filters( 'wolf_core_row_small_width', '750px' ) ) => 'small',
			),
			'weight' => 1,
		),

		array(
			'type' => 'wolf_core_textfield',
			'heading' => esc_html__( 'Min Height', 'wolf-visual-composer' ),
			'param_name' => 'min_height',
			'placeholder' => 'auto',
			'description' => esc_html__( 'Insert the row minimum height in pixel.', 'wolf-visual-composer' ),
			'weight' => 1,
		),

		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Content position', 'wolf-visual-composer' ),
		// 	'param_name' => 'content_placement',
		// 	'value' => array(
		// 		esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
		// 		esc_html__( 'Top', 'wolf-visual-composer' ) => 'top',
		// 		esc_html__( 'Middle', 'wolf-visual-composer' ) => 'middle',
		// 		esc_html__( 'Bottom', 'wolf-visual-composer' ) => 'bottom',
		// 	),
		// 	'description' => esc_html__( 'Select content position within columns.', 'wolf-visual-composer' ),
		// 	'dependency' => array( 'element' => 'content_layout', 'value' => array( 'column' ) ),
		// ),

		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Columns position', 'wolf-visual-composer' ),
		// 	'param_name' => 'columns_placement',
		// 	'value' => array(
		// 		esc_html__( 'Default', 'wolf-visual-composer' ) => 'default',
		// 		esc_html__( 'Middle', 'wolf-visual-composer' ) => 'middle',
		// 		esc_html__( 'Top', 'wolf-visual-composer' ) => 'top',
		// 		esc_html__( 'Bottom', 'wolf-visual-composer' ) => 'bottom',
		// 		esc_html__( 'Stretch', 'wolf-visual-composer' ) => 'stretch',
		// 	),
		// 	'description' => esc_html__( 'Select columns position within row.', 'wolf-visual-composer' ),
		// 	'dependency' => array(
		// 		'element' => 'full_height',
		// 		'not_empty' => true,
		// 	),
		// 	'weight' => 1,
		// ),

		// array(
		// 	'type' => 'checkbox',
		// 	'heading' => esc_html__( 'Equal height', 'wolf-visual-composer' ),
		// 	'param_name' => 'equal_height',
		// 	'description' => esc_html__( 'If checked columns will be set to equal height.', 'wolf-visual-composer' ),
		// 	'value' => array( esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes' ),
		// 	'dependency' => array( 'element' => 'content_layout', 'value' => array( 'column' ) ),
		// ),

		// array(
		// 	'type' => 'dropdown',
		// 	'heading' => esc_html__( 'Columns gap', 'wolf-visual-composer' ),
		// 	'param_name' => 'gap',
		// 	'value' => array(
		// 		'0px' => '0',
		// 		'1px' => '1',
		// 		'2px' => '2',
		// 		'3px' => '3',
		// 		'4px' => '4',
		// 		'5px' => '5',
		// 		'10px' => '10',
		// 		'15px' => '15',
		// 		'20px' => '20',
		// 		'25px' => '25',
		// 		'30px' => '30',
		// 		'35px' => '35',
		// 	),
		// 	'std' => '0',
		// 	'description' => esc_html__( 'Select gap between columns in row.', 'wolf-visual-composer' ),
		// ),

		// Visibility
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Visibility', 'wolf-visual-composer' ),
			'param_name' => 'hide_class',
			'value' => array(
				esc_html__( 'Always visible', 'wolf-visual-composer' ) => '',
				esc_html__( 'Hide on tablet and mobile', 'wolf-visual-composer' ) => 'wvc-hide-tablet',
				esc_html__( 'Hide on mobile', 'wolf-visual-composer' ) => 'wvc-hide-mobile',
				esc_html__( 'Show on tablet and mobile only', 'wolf-visual-composer' ) => 'wvc-show-tablet',
				esc_html__( 'Show on mobile only', 'wolf-visual-composer' ) => 'wvc-show-mobile',
				esc_html__( 'Always hidden', 'wolf-visual-composer' ) => 'wvc-hide',
			),
		),

		// Extra class
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'wolf-visual-composer' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wolf-visual-composer' ),
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Disable row', 'wolf-visual-composer' ),
			'param_name' => 'disable_element',
			// Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'wolf-visual-composer' ),
			'value' => array( esc_html__( 'Yes', 'wolf-visual-composer' ) => 'yes' ),
		),
	);
}
