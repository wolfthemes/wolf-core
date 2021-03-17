<?php
/**
 * WPBakery Page Builder Extension Element Additional Settings
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Core
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
			'heading'     => esc_html__( 'Extra class name', 'wolf-core' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wolf-core' ),
			'weight'      => -1000,
			'group'       => esc_html__( 'Extra', 'wolf-core' ),
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
				'heading'    => esc_html__( 'Autoplay', 'wolf-core' ),
				'param_name' => 'autoplay',
				'value'      => array(
					esc_html__( 'Yes', 'wolf-core' ) => 'true',
					esc_html__( 'No', 'wolf-core' )  => 'false',
				),
				'group'      => esc_html__( 'Slider Settings', 'wolf-core' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pause on Hover (if autoplay)', 'wolf-core' ),
				'param_name' => 'pause_on_hover',
				'value'      => array(
					esc_html__( 'Yes', 'wolf-core' ) => 'true',
					esc_html__( 'No', 'wolf-core' )  => 'false',
				),
				'group'      => esc_html__( 'Slider Settings', 'wolf-core' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Transition', 'wolf-core' ),
				'param_name' => 'transition',
				'value'      => array(
					esc_html__( 'Auto (fade by default and slide on touchable devices)', 'wolf-core' ) => 'auto',
					esc_html__( 'Slide', 'wolf-core' ) => 'slide',
					esc_html__( 'Fade', 'wolf-core' )  => 'fade',
				),
				'group'      => esc_html__( 'Slider Settings', 'wolf-core' ),
			),
			array(
				'type'       => 'wolf_core_textfield',
				'heading'    => esc_html__( 'Slideshow Speed in ms', 'wolf-core' ),
				'param_name' => 'slideshow_speed',
				'value'      => 6000,
				'group'      => esc_html__( 'Slider Settings', 'wolf-core' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Show Navigation Bullets', 'wolf-core' ),
				'param_name' => 'nav_bullets',
				'value'      => array(
					esc_html__( 'Yes', 'wolf-core' ) => 'true',
					esc_html__( 'No', 'wolf-core' )  => 'false',
				),
				'group'      => esc_html__( 'Slider Settings', 'wolf-core' ),
			),
			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Show Navigation Arrows', 'wolf-core' ),
				'param_name' => 'nav_arrows',
				'value'      => array(
					esc_html__( 'Yes', 'wolf-core' ) => 'true',
					esc_html__( 'No', 'wolf-core' )  => 'false',
				),
				'group'      => esc_html__( 'Slider Settings', 'wolf-core' ),
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Navigation Tone', 'wolf-core' ),
				'param_name' => 'nav_tone',
				'value'      => array(
					esc_html__( 'Light', 'wolf-core' ) => 'light',
					esc_html__( 'Dark', 'wolf-core' )  => 'dark',
				),
				'group'      => esc_html__( 'Slider Settings', 'wolf-core' ),
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
				'heading'    => esc_html__( 'Animation', 'wolf-core' ),
				'param_name' => 'css_animation',
				'group'      => esc_html__( 'Animation', 'wolf-core' ),
				'weight'     => -1,
			),

			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Animation Delay (in ms)', 'wolf-core' ),
				'param_name'  => 'css_animation_delay',
				'placeholder' => 0,
				'group'       => esc_html__( 'Animation', 'wolf-core' ),
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
				'heading'    => esc_html__( 'Css', 'wolf-core' ),
				'param_name' => 'css',
				'group'      => esc_html__( 'Custom', 'wolf-core' ),
				'weight'     => -10,
			),
			array(
				'type'        => 'wolf_core_textfield',
				'heading'     => esc_html__( 'Inline Style', 'wolf-core' ),
				'param_name'  => 'inline_style',
				'group'       => esc_html__( 'Custom', 'wolf-core' ),
				'description' => sprintf( esc_html__( 'Additional inline CSS that will be applied to the element. (e.g: %s)', 'wolf-core' ), 'color:red;' ),
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
				'heading'    => esc_html__( 'Autoplay', 'wolf-core' ),
				'param_name' => 'autoplay',
				'value'      => array(
					esc_html__( 'Yes', 'wolf-core' ) => 'true',
					esc_html__( 'No', 'wolf-core' )  => 'false',
				),
				'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Pause on Hover (if autoplay)', 'wolf-core' ),
				'param_name' => 'pause_on_hover',
				'value'      => array(
					esc_html__( 'Yes', 'wolf-core' ) => 'true',
					esc_html__( 'No', 'wolf-core' )  => 'false',
				),
				'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
			),
			array(
				'type'       => 'wolf_core_textfield',
				'heading'    => esc_html__( 'Slideshow Speed in ms', 'wolf-core' ),
				'param_name' => 'slideshow_speed',
				'value'      => 6000,
				'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Show Navigation Bullets', 'wolf-core' ),
				'param_name' => 'nav_bullets',
				'value'      => array(
					esc_html__( 'Yes', 'wolf-core' ) => 'true',
					esc_html__( 'No', 'wolf-core' )  => 'false',
				),
				'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
			),

			array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Show Navigation Arrows', 'wolf-core' ),
				'param_name' => 'nav_arrows',
				'value'      => array(
					esc_html__( 'Yes', 'wolf-core' ) => 'true',
					esc_html__( 'No', 'wolf-core' )  => 'false',
				),
				'group'      => esc_html__( 'Carousel Settings', 'wolf-core' ),
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
				'heading'    => esc_html__( 'Visibility', 'wolf-core' ),
				'param_name' => 'hide_class',
				'value'      => array(
					esc_html__( 'Always visible', 'wolf-core' ) => '',
					esc_html__( 'Hide on tablet and mobile', 'wolf-core' ) => 'wvc-hide-tablet',
					esc_html__( 'Hide on mobile', 'wolf-core' ) => 'wvc-hide-mobile',
					esc_html__( 'Show on tablet and mobile only', 'wolf-core' ) => 'wvc-show-tablet',
					esc_html__( 'Show on mobile only', 'wolf-core' ) => 'wvc-show-mobile',
					esc_html__( 'Always hidden', 'wolf-core' ) => 'wvc-hide',
				),
				'group'      => esc_html__( 'Extra', 'wolf-core' ),
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
			'heading'    => esc_html__( 'Padding', 'wolf-core' ),
			'param_name' => 'padding',
			'value'      => array(
				'yes' => esc_html__( 'Yes', 'wolf-core' ),
				'no'  => esc_html__( 'No', 'wolf-core' ),
			),
		)
	);
	vc_add_param(
		'wolf_last_videos',
		array(
			'type'       => 'animation_style',
			'heading'    => esc_html__( 'Animation', 'wolf-core' ),
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
			'heading'    => esc_html__( 'Padding', 'wolf-core' ),
			'param_name' => 'padding',
			'value'      => array(
				'yes' => esc_html__( 'Yes', 'wolf-core' ),
				'no'  => esc_html__( 'No', 'wolf-core' ),
			),
		)
	);
	vc_add_param(
		'wolf_last_albums',
		array(
			'type'       => 'animation_style',
			'heading'    => esc_html__( 'Animation', 'wolf-core' ),
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
			'heading'    => esc_html__( 'Padding', 'wolf-core' ),
			'param_name' => 'padding',
			'value'      => array(
				'yes' => esc_html__( 'Yes', 'wolf-core' ),
				'no'  => esc_html__( 'No', 'wolf-core' ),
			),
		)
	);
	vc_add_param(
		'wolf_last_releases',
		array(
			'type'       => 'animation_style',
			'heading'    => esc_html__( 'Animation', 'wolf-core' ),
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

	if ( 'vc' === wolf_core_get_plugin_in_use() ) {

		$bg_params = array(
			array(
				'type'         => 'checkbox',
				'label'        => esc_html__( 'Add Image Background?', 'wolf-core' ),
				'param_name'   => 'add_background',
				'label_on'     => esc_html__( 'Yes', 'wolf-core' ),
				'label_off'    => esc_html__( 'No', 'wolf-core' ),
				'return_value' => 'true',
			),

			array(
				'type'       => 'image',
				'label'      => esc_html__( 'Background Image', 'wolf-core' ),
				'param_name' => 'background_img',
				'condition'  => array(
					'add_background' => array( 'true' ),
				),
				'group'      => esc_html__( 'Background', 'wolf-core' ),
				'weight'     => 0,
			),

			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Background position', 'wolf-core' ),
				'param_name' => 'background_position',
				'options'    => array(
					'center center' => esc_html__( 'center center', 'wolf-core' ),
					'center top'    => esc_html__( 'center top', 'wolf-core' ),
					'left top'      => esc_html__( 'left top', 'wolf-core' ),
					'right top'     => esc_html__( 'right top', 'wolf-core' ),
					'center bottom' => esc_html__( 'center bottom', 'wolf-core' ),
					'left bottom'   => esc_html__( 'left bottom', 'wolf-core' ),
					'right bottom'  => esc_html__( 'right bottom', 'wolf-core' ),
					'left center'   => esc_html__( 'left center', 'wolf-core' ),
					'right center'  => esc_html__( 'right center', 'wolf-core' ),
				),
				'condition'  => array(
					'add_background' => array( 'true' ),
				),
				'group'      => esc_html__( 'Background', 'wolf-core' ),
				'weight'     => 0,
			),

			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Background repeat', 'wolf-core' ),
				'param_name' => 'background_repeat',
				'options'    => array(
					'no-repeat' => esc_html__( 'no repeat', 'wolf-core' ),
					'repeat'    => esc_html__( 'repeat', 'wolf-core' ),
					'repeat-x'  => esc_html__( 'repeat-x', 'wolf-core' ),
					'repeat-y'  => esc_html__( 'repeat-y', 'wolf-core' ),
				),
				'condition'  => array(
					'add_background' => array( 'true' ),
				),
				'group'      => esc_html__( 'Background', 'wolf-core' ),
				'weight'     => 0,
			),

			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Background size', 'wolf-core' ),
				'param_name' => 'background_size',
				'options'    => array(
					'inherit' => esc_html__( 'default', 'wolf-core' ),
					'cover'   => esc_html__( 'cover', 'wolf-core' ),
					'contain' => esc_html__( 'contain', 'wolf-core' ),
				),
				'dependency' => array(
					'element' => 'add_background',
					'value'   => array( 'true' ),
				),
				'group'      => esc_html__( 'Background', 'wolf-core' ),
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
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Content type', 'wolf-core' ),
			'param_name'  => 'content_type',
			'value'       => array(
				esc_html__( 'Text (padding)', 'wolf-core' ) => 'default',
				// esc_html__( 'Block with text content', 'wolf-core' ) => 'block-text',
				esc_html__( 'Media (no padding)', 'wolf-core' ) => 'block-media',
			),
			'description' => esc_html__( 'Select type of content you will insert.', 'wolf-core' ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Vertical Position', 'wolf-core' ),
			'param_name'  => 'content_placement',
			'value'       => array(
				esc_html__( 'Default', 'wolf-core' ) => 'default',
				esc_html__( 'Top', 'wolf-core' )     => 'top',
				esc_html__( 'Middle', 'wolf-core' )  => 'middle',
				esc_html__( 'Bottom', 'wolf-core' )  => 'bottom',
			),
			'description' => esc_html__( 'Select the vertical position of the content.', 'wolf-core' ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Horizontal Position', 'wolf-core' ),
			'param_name'  => 'content_alignment',
			'value'       => array(
				esc_html__( 'Center', 'wolf-core' ) => 'center',
				esc_html__( 'Left', 'wolf-core' )   => 'left',
				esc_html__( 'Right', 'wolf-core' )  => 'right',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', 'wolf-core' ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Default Text Alignment', 'wolf-core' ),
			'param_name'  => 'text_alignment',
			'value'       => array(
				esc_html__( 'Default', 'wolf-core' ) => 'default',
				esc_html__( 'Left', 'wolf-core' )    => 'left',
				esc_html__( 'Center', 'wolf-core' )  => 'center',
				esc_html__( 'Right', 'wolf-core' )   => 'right',
			),
			'description' => esc_html__( 'Specify the text alignment inside the column. It can be overwritten in some elements.', 'wolf-core' ),
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Content Min Height', 'wolf-core' ),
			'param_name'  => 'min_height',
			'placeholder' => 'auto',
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Content Max Width', 'wolf-core' ),
			'param_name'  => 'max_width',
			'placeholder' => 'auto',
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column Style', 'wolf-core' ),
			'param_name'  => 'column_style',
			'value'       => array(
				esc_html__( 'None', 'wolf-core' )       => 'none',
				esc_html__( 'Box Shadow', 'wolf-core' ) => 'box-shadow',
				esc_html__( 'Boxed with Hover Effect', 'wolf-core' ) => 'boxed',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', 'wolf-core' ),
		),

		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Width', 'wolf-core' ),
			'edit_field_class' => 'wolf-core-hidden',
			'param_name'       => 'width',
			'value'            => array(
				esc_html__( '1 column - 1/12', 'wolf-core' ) => '1/12',
				esc_html__( '2 columns - 1/6', 'wolf-core' ) => '1/6',
				esc_html__( '3 columns - 1/4', 'wolf-core' ) => '1/4',
				esc_html__( '4 columns - 1/3', 'wolf-core' ) => '1/3',
				esc_html__( '5 columns - 5/12', 'wolf-core' ) => '5/12',
				esc_html__( '6 columns - 1/2', 'wolf-core' ) => '1/2',
				esc_html__( '7 columns - 7/12', 'wolf-core' ) => '7/12',
				esc_html__( '8 columns - 2/3', 'wolf-core' ) => '2/3',
				esc_html__( '9 columns - 3/4', 'wolf-core' ) => '3/4',
				esc_html__( '10 columns - 5/6', 'wolf-core' ) => '5/6',
				esc_html__( '11 columns - 11/12', 'wolf-core' ) => '11/12',
				esc_html__( '12 columns - 1/1', 'wolf-core' ) => '1/1',
			),
			// 'group' => __( 'Responsive Options', 'wolf-core' ),
			'description'      => __( 'Select column width.', 'wolf-core' ),
			'std'              => '1/1',
		),

		// Shift X-Axis
		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shift X-Axis', 'wolf-core' ),
			'param_name' => 'shift_x',
			'min'        => -1000,
			'max'        => 1000,
			'step'       => 10,
			'std'        => 0,
			'group'      => esc_html( 'Off-Grid', 'wolf-core' ),
			'weight'     => -100,
		),

		// Shift Y-Axis
		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shift Y-Axis', 'wolf-core' ),
			'param_name' => 'shift_y',
			'min'        => -1000,
			'max'        => 1000,
			'step'       => 10,
			'std'        => 0,
			'group'      => esc_html( 'Off-Grid', 'wolf-core' ),
			'weight'     => -100,
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Custom Z-Index', 'wolf-core' ),
			'param_name' => 'z_index',
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'std'        => 0,
			'group'      => esc_html( 'Off-Grid', 'wolf-core' ),
			'weight'     => -100,
		),
	);
}


/**
 * Background params
 */
function wolf_core_background_params() {
	return array(

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background type', 'wolf-core' ),
			'param_name' => 'background_type',
			'value'      => array(
				esc_html__( 'Default', 'wolf-core' )   => 'default',
				esc_html__( 'Image and Color', 'wolf-core' ) => 'image',
				esc_html__( 'Slideshow', 'wolf-core' ) => 'slideshow',
				esc_html__( 'Video', 'wolf-core' )     => 'video',
				esc_html__( 'No Background', 'wolf-core' ) => 'transparent',
				esc_html__( 'Post Featured Image', 'wolf-core' ) => 'featured_image',
				esc_html__( 'Default WordPress Header', 'wolf-core' ) => 'default_header',
			),
			'std'        => apply_filters( 'wolf_core_default_background_type', 'default' ),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Background Color', 'wolf-core' ),
			'param_name'         => 'background_color',
			'value'              => array_merge(
				array( esc_html__( 'Default', 'wolf-core' ) => 'default' ),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', 'wolf-core' ) => 'custom' ),
				array( esc_html__( 'Transparent', 'wolf-core' ) => 'transparent' )
			),
			'std'                => 'default',
			'description'        => esc_html__( 'Select a background color.', 'wolf-core' ),
			'group'              => esc_html__( 'Style', 'wolf-core' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'dependency'         => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
		),

		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Background Color', 'wolf-core' ),
			'param_name' => 'background_custom_color',
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
			'dependency' => array(
				'element' => 'background_color',
				'value'   => 'custom',
			),
		),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Background Image', 'wolf-core' ),
			'param_name' => 'background_img',
			'value'      => '',
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background position', 'wolf-core' ),
			'param_name' => 'background_position',
			'value'      => array(
				esc_html__( 'center center', 'wolf-core' ) => 'center center',
				esc_html__( 'center top', 'wolf-core' ) => 'center top',
				esc_html__( 'left top', 'wolf-core' )   => 'left top',
				esc_html__( 'right top', 'wolf-core' )  => 'right top',
				esc_html__( 'center bottom', 'wolf-core' ) => 'center bottom',
				esc_html__( 'left bottom', 'wolf-core' ) => 'left bottom',
				esc_html__( 'right bottom', 'wolf-core' ) => 'right bottom',
				esc_html__( 'left center', 'wolf-core' ) => 'left center',
				esc_html__( 'right center', 'wolf-core' ) => 'right center',
			),
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', 'wolf-core' ),
			'weight'     => 0,
			// 'edit_field_class' => 'wvc-half-start',
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background repeat', 'wolf-core' ),
			'param_name' => 'background_repeat',
			'value'      => array(
				esc_html__( 'no repeat', 'wolf-core' ) => 'no-repeat',
				esc_html__( 'repeat', 'wolf-core' )    => 'repeat',
				esc_html__( 'repeat-x', 'wolf-core' )  => 'repeat-x',
				esc_html__( 'repeat-y', 'wolf-core' )  => 'repeat-y',
			),
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
			// 'edit_field_class' => 'wvc-half-end',
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background Size', '%TEXDOMAIN%' ),
			'param_name' => 'background_size',
			'value'      => array(
				esc_html__( 'cover', '%TEXDOMAIN%' )   => 'cover',
				esc_html__( 'default', '%TEXDOMAIN%' ) => 'default',
				esc_html__( 'contain', '%TEXDOMAIN%' ) => 'contain',
			),
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image' ),
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Background Effect', '%TEXDOMAIN%' ),
			'param_name' => 'background_effect',
			'value'      => apply_filters(
				'wolf_core_background_effects',
				array(
					esc_html__( 'None', '%TEXDOMAIN%' )    => 'none',
					esc_html__( 'Parallax', '%TEXDOMAIN%' ) => 'parallax',
					esc_html__( 'Zoom', '%TEXDOMAIN%' )    => 'zoomin',
					esc_html__( 'Fixed', '%TEXDOMAIN%' )   => 'fixed',
					esc_html__( 'Marquee', '%TEXDOMAIN%' ) => 'marquee',
					esc_html__( 'Blur', '%TEXDOMAIN%' )    => 'blur',
				)
			),
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image', 'default_header', 'featured_image' ),
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Marquee Image Position', '%TEXDOMAIN%' ),
			'param_name' => 'background_marquee_position',
			'value'      => array(
				esc_html__( 'stretch', '%TEXDOMAIN%' ) => 'stretch',
				esc_html__( 'top', '%TEXDOMAIN%' )     => 'top',
				esc_html__( 'middle', '%TEXDOMAIN%' )  => 'middle',
				esc_html__( 'bottom', '%TEXDOMAIN%' )  => 'bottom',
			),
			'dependency' => array(
				'element' => 'background_effect',
				'value'   => array( 'marquee' ),
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'LazyLoad', '%TEXDOMAIN%' ),
			'param_name' => 'background_img_lazyload',
			'value'      => array( esc_html__( 'Yes', '%TEXDOMAIN%' ) => true ),
			'std'        => true,
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'image', 'default_header', 'featured_image' ),
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
		),

		// Video URL
		array(
			'type'        => 'wolf_core_video_url',
			'heading'     => esc_html__( 'Video URL', '%TEXDOMAIN%' ),
			'param_name'  => 'video_bg_url',
			'value'       => '',
			'description' => esc_html__( 'A YouTube, Vimeo, or mp4 URL.', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'      => 0,
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Video Start Time', '%TEXDOMAIN%' ),
			'param_name'  => 'video_bg_start_time',
			'value'       => '',
			'description' => esc_html__( 'Set at which second the video will start (beta).', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'      => 0,
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Video End Time', '%TEXDOMAIN%' ),
			'param_name'  => 'video_bg_end_time',
			'value'       => '',
			'description' => esc_html__( 'Set at which second the video will end (beta).', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'      => 0,
		),

		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Video Parallax', '%TEXDOMAIN%' ),
			'param_name' => 'video_bg_parallax',
			'value'      => '',
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Loop video.', '%TEXDOMAIN%' ),
			'param_name'  => 'video_bg_loop',
			'value'       => array(
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
				esc_html__( 'No', '%TEXDOMAIN%' )  => 'no',
			),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'      => 0,
			'description' => esc_html__( 'Beta: If set to "No", the video will stop at the end only for YouTube video when parallax is not enabled.', '%TEXDOMAIN%' ),
		),

		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Video Image Fallback', '%TEXDOMAIN%' ),
			'param_name'  => 'video_bg_img',
			'value'       => '',
			'description' => esc_html__( 'An image to display when the video is loading.', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'      => 0,
		),

		array(
			'type'        => 'attach_image',
			'heading'     => esc_html__( 'Video Image Mobile Fallback', '%TEXDOMAIN%' ),
			'param_name'  => 'video_bg_img_mobile',
			'value'       => '',
			'description' => esc_html__( 'An image to display when the video can\'t be played. The image above will be used if empty.', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'video' ),
			),
			'group'       => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'      => 0,
		),

		// Slideshow images
		array(
			'type'       => 'attach_images',
			'heading'    => esc_html__( 'Slideshow Images', '%TEXDOMAIN%' ),
			'param_name' => 'slideshow_img_ids',
			'dependency' => array(
				'element' => 'background_type',
				'value'   => array( 'slideshow' ),
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
		),

		// Slideshow speed
		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Slideshow Speed', '%TEXDOMAIN%' ),
			'param_name'  => 'slideshow_speed',
			'description' => esc_html__( 'In milliseconds.', '%TEXDOMAIN%' ),
			'placeholder' => 5000,
			'std'         => '5000',
			'dependency'  => array(
				'element' => 'background_type',
				'value'   => array( 'slideshow' ),
			),
			'group'       => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'      => 0,
		),

		// Overlay
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Add Overlay', '%TEXDOMAIN%' ),
			'param_name' => 'add_overlay',
			'value'      => array(
				esc_html__( 'No', '%TEXDOMAIN%' )  => '',
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
		),

		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Overlay Color', '%TEXDOMAIN%' ),
			'param_name'         => 'overlay_color',
			'value'              => array_merge(
				array( esc_html__( 'Auto', '%TEXDOMAIN%' ) => 'auto' ),
				wolf_core_get_shared_gradient_colors(),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', '%TEXDOMAIN%' ) => 'custom' )
			),
			'std'                => 'black',
			'description'        => esc_html__( 'Select an overlay color.', '%TEXDOMAIN%' ),
			'group'              => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'dependency'         => array(
				'element' => 'add_overlay',
				'value'   => array( 'yes' ),
			),
		),

		// Overlay color
		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Overlay Custom Color', '%TEXDOMAIN%' ),
			'param_name' => 'overlay_custom_color',
			// 'value' => '#000000',
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element' => 'overlay_color',
				'value'   => 'custom',
			),
		),

		// Overlay opacity
		array(
			'type'        => 'wolf_core_numeric_slider',
			'heading'     => esc_html__( 'Overlay Opacity in Percent', '%TEXDOMAIN%' ),
			'param_name'  => 'overlay_opacity',
			'description' => '',
			'value'       => 60,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'dependency'  => array(
				'element' => 'add_overlay',
				'value'   => array( 'yes' ),
			),
			'group'       => esc_html__( 'Style', '%TEXDOMAIN%' ),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Add Top Shape Divider', '%TEXDOMAIN%' ),
			'param_name' => 'add_top_shape_divider',
			'value'      => array(
				esc_html__( 'No', '%TEXDOMAIN%' )  => '',
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Add Bottom Shape Divider', '%TEXDOMAIN%' ),
			'param_name' => 'add_bottom_shape_divider',
			'value'      => array(
				esc_html__( 'No', '%TEXDOMAIN%' )  => '',
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
			'weight'     => 0,
		),

		// Particles
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Add Particles', '%TEXDOMAIN%' ),
			'param_name' => 'add_particles',
			'value'      => array(
				esc_html__( 'No', '%TEXDOMAIN%' )  => '',
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
			),
			'group'      => esc_html__( 'Style', '%TEXDOMAIN%' ),
		),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Particles Type', '%TEXDOMAIN%' ),
		// 'param_name' => 'particles_type',
		// 'value' => array(
		// esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default',
		// esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
		// ),
		// 'dependency' => array( 'element' => 'add_particles', 'value' => array( 'yes' ) ),
		// 'group' => esc_html__( 'Style', '%TEXDOMAIN%' ),
		// ),
	);
}

/**
 * Column general params
 */
function wolf_core_column_inner_general_params() {
	return array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Vertical Position', '%TEXDOMAIN%' ),
			'param_name'  => 'content_placement',
			'value'       => array(
				esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default',
				esc_html__( 'Top', '%TEXDOMAIN%' )     => 'top',
				esc_html__( 'Middle', '%TEXDOMAIN%' )  => 'middle',
				esc_html__( 'Bottom', '%TEXDOMAIN%' )  => 'bottom',
			),
			'description' => esc_html__( 'Select the vertical position of the content.', '%TEXDOMAIN%' ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Horizontal Position', '%TEXDOMAIN%' ),
			'param_name'  => 'content_placement',
			'value'       => array(
				esc_html__( 'Center', '%TEXDOMAIN%' ) => 'center',
				esc_html__( 'Left', '%TEXDOMAIN%' )   => 'left',
				esc_html__( 'Right', '%TEXDOMAIN%' )  => 'right',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', '%TEXDOMAIN%' ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Default Text Alignment', '%TEXDOMAIN%' ),
			'param_name'  => 'text_alignment',
			'value'       => array(
				esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default',
				esc_html__( 'Left', '%TEXDOMAIN%' )    => 'left',
				esc_html__( 'Center', '%TEXDOMAIN%' )  => 'center',
				esc_html__( 'Right', '%TEXDOMAIN%' )   => 'right',
			),
			'description' => esc_html__( 'Specify the text alignment inside the column. It can be overwritten in some elements.', '%TEXDOMAIN%' ),
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Content Min Height', '%TEXDOMAIN%' ),
			'param_name'  => 'min_height',
			'placeholder' => 'auto',
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Content Max Width', '%TEXDOMAIN%' ),
			'param_name'  => 'max_width',
			'placeholder' => 'auto',
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column Style', '%TEXDOMAIN%' ),
			'param_name'  => 'column_style',
			'value'       => array(
				esc_html__( 'None', '%TEXDOMAIN%' )       => 'none',
				esc_html__( 'Box Shadow', '%TEXDOMAIN%' ) => 'box-shadow',
				esc_html__( 'Boxed with Hover Effect', '%TEXDOMAIN%' ) => 'boxed',
			),
			'description' => esc_html__( 'Select the horizontal position of the content.', '%TEXDOMAIN%' ),
		),

		array(
			'type'             => 'dropdown',
			'heading'          => __( 'Width', '%TEXDOMAIN%' ),
			'edit_field_class' => 'wvc-hidden',
			'param_name'       => 'width',
			'value'            => array(
				esc_html__( '1 column - 1/12', '%TEXDOMAIN%' ) => '1/12',
				esc_html__( '2 columns - 1/6', '%TEXDOMAIN%' ) => '1/6',
				esc_html__( '3 columns - 1/4', '%TEXDOMAIN%' ) => '1/4',
				esc_html__( '4 columns - 1/3', '%TEXDOMAIN%' ) => '1/3',
				esc_html__( '5 columns - 5/12', '%TEXDOMAIN%' ) => '5/12',
				esc_html__( '6 columns - 1/2', '%TEXDOMAIN%' ) => '1/2',
				esc_html__( '7 columns - 7/12', '%TEXDOMAIN%' ) => '7/12',
				esc_html__( '8 columns - 2/3', '%TEXDOMAIN%' ) => '2/3',
				esc_html__( '9 columns - 3/4', '%TEXDOMAIN%' ) => '3/4',
				esc_html__( '10 columns - 5/6', '%TEXDOMAIN%' ) => '5/6',
				esc_html__( '11 columns - 11/12', '%TEXDOMAIN%' ) => '11/12',
				esc_html__( '12 columns - 1/1', '%TEXDOMAIN%' ) => '1/1',
			),
			// 'group' => __( 'Responsive Options', '%TEXDOMAIN%' ),
			'description'      => __( 'Select column width.', '%TEXDOMAIN%' ),
			'std'              => '1/1',
		),
	);
}

/**
 * Row general params
 */
function wolf_core_row_general_params() {
	return array(

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Column Type', '%TEXDOMAIN%' ),
			'param_name'  => 'column_type',
			'value'       => array(
				esc_html__( 'Columns', '%TEXDOMAIN%' ) => 'column',
				esc_html__( 'Blocks', '%TEXDOMAIN%' )  => 'block',
			),
			'std'         => 'column',
			'description' => esc_html__( 'This will set a default style for your columns.', '%TEXDOMAIN%' ),
			'weight'      => 1,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Container Width', '%TEXDOMAIN%' ),
			'param_name' => 'container_width',
			'value'      => array(
				esc_html__( 'Wide', '%TEXDOMAIN%' )        => 'wide',
				esc_html__( 'Boxed', '%TEXDOMAIN%' )       => 'boxed',
				esc_html__( 'Small Boxed', '%TEXDOMAIN%' ) => 'boxed-small',
				esc_html__( 'Large Boxed', '%TEXDOMAIN%' ) => 'boxed-large',
			),
			'std'        => 'wide',
			'dependency' => array(
				'element' => 'column_type',
				'value'   => array( 'column' ),
			),
			'weight'     => 1,
		),

		array(
			'type'       => 'checkbox',
			'heading'    => esc_html__( 'Box Shadow', '%TEXDOMAIN%' ),
			'param_name' => 'box_shadow',
			'dependency' => array(
				'element'            => 'container_width',
				'value_not_equal_to' => array( 'wide' ),
			),
			'weight'     => 1,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Content Width', '%TEXDOMAIN%' ),
			'param_name' => 'content_width',
			'value'      => array(
				sprintf( esc_html__( 'Standard width (%s centered)', '%TEXDOMAIN%' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'standard',
				sprintf( esc_html__( 'Small width (%s centered)', '%TEXDOMAIN%' ), apply_filters( 'wolf_core_row_small_width', '750px' ) ) => 'small',
				sprintf( esc_html__( 'Large width (%s centered)', '%TEXDOMAIN%' ), '98%' ) => 'large',
				sprintf( esc_html__( 'Full width (%s)', '%TEXDOMAIN%' ), '100%' ) => 'full',
			),
			'std'        => apply_filters( 'wolf_core_default_row_content_width', 'standard' ),
			'dependency' => array(
				'element' => 'container_width',
				'value'   => array( 'wide' ),
			),
			'weight'     => 1,
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Min Height', '%TEXDOMAIN%' ),
			'param_name'  => 'min_height',
			'placeholder' => 'auto',
			'description' => esc_html__( 'Insert the row minimum height.', '%TEXDOMAIN%' ),
			'weight'      => 1,
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Full height row?', '%TEXDOMAIN%' ),
			'param_name'  => 'full_height',
			'description' => esc_html__( 'If checked row will be set to full height.', '%TEXDOMAIN%' ),
			'value'       => array( esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes' ),
			'weight'      => 1,
			// 'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Columns Position', '%TEXDOMAIN%' ),
			'param_name'  => 'columns_placement',
			'value'       => array(
				esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default',
				esc_html__( 'Middle', '%TEXDOMAIN%' )  => 'middle',
				esc_html__( 'Top', '%TEXDOMAIN%' )     => 'top',
				esc_html__( 'Bottom', '%TEXDOMAIN%' )  => 'bottom',
				esc_html__( 'Stretch', '%TEXDOMAIN%' ) => 'stretch',
			),
			'description' => esc_html__( 'Select columns position within row.', '%TEXDOMAIN%' ),
			// 'dependency' => array(
			// 'element' => 'full_height',
			// 'not_empty' => true,
			// ),
			'weight'      => 1,
		),

		array(
			'type'        => 'dropdown',
			'heading'     => esc_html__( 'Content Position', '%TEXDOMAIN%' ),
			'param_name'  => 'content_placement',
			'value'       => array(
				esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default',
				esc_html__( 'Top', '%TEXDOMAIN%' )     => 'top',
				esc_html__( 'Middle', '%TEXDOMAIN%' )  => 'middle',
				esc_html__( 'Bottom', '%TEXDOMAIN%' )  => 'bottom',
			),
			'description' => esc_html__( 'Select content position within columns.', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element' => 'column_type',
				'value'   => array( 'column' ),
			),
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Add pointing down arrow', '%TEXDOMAIN%' ),
			'description' => esc_html__( 'Allow user to scroll to the next section when clicking on the arrow', '%TEXDOMAIN%' ),
			'param_name'  => 'arrow_down',
			'dependency'  => array(
				'element' => 'column_type',
				'value'   => array( 'column' ),
			),
			'weight'      => 1,
		),

		/*
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Mousewheel Scroll Down (beta)', '%TEXDOMAIN%' ),
			'description' => esc_html__( 'Scroll to the next section automatically when scrolling down', '%TEXDOMAIN%' ),
			'param_name' => 'mousewheel_down',
			'dependency' => array( 'element' => 'column_type', 'value' => array( 'column' ), ),
			'weight' => 1,
		),*/

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Arrow Caption', '%TEXDOMAIN%' ),
			'param_name'  => 'arrow_down_text',
			'placeholder' => esc_html__( 'Continue', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element'   => 'arrow_down',
				'not_empty' => true,
			),
			'weight'      => 1,
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Arrow Alignement', '%TEXDOMAIN%' ),
			'param_name' => 'arrow_down_alignement',
			'value'      => array(
				esc_html__( 'Center', '%TEXDOMAIN%' ) => 'center',
				esc_html__( 'Left', '%TEXDOMAIN%' )   => 'left',
				esc_html__( 'Right', '%TEXDOMAIN%' )  => 'right',
			),
			'dependency' => array(
				'element'   => 'arrow_down',
				'not_empty' => true,
			),
			'weight'     => 1,
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Equal height', '%TEXDOMAIN%' ),
			'param_name'  => 'equal_height',
			'description' => esc_html__( 'If checked columns will be set to equal height.', '%TEXDOMAIN%' ),
			'value'       => array( esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes' ),
			'std'         => 'no',
			'dependency'  => array(
				'element' => 'column_type',
				'value'   => array( 'column' ),
			),
		),

		// Visibility
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Visibility', '%TEXDOMAIN%' ),
			'param_name' => 'hide_class',
			'value'      => array(
				esc_html__( 'Always visible', '%TEXDOMAIN%' ) => '',
				esc_html__( 'Hide on tablet and mobile', '%TEXDOMAIN%' ) => 'wvc-hide-tablet',
				esc_html__( 'Hide on mobile', '%TEXDOMAIN%' ) => 'wvc-hide-mobile',
				esc_html__( 'Show on tablet and mobile only', '%TEXDOMAIN%' ) => 'wvc-show-tablet',
				esc_html__( 'Show on mobile only', '%TEXDOMAIN%' ) => 'wvc-show-mobile',
				esc_html__( 'Always hidden', '%TEXDOMAIN%' ) => 'wvc-hide',
			),
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Disable row', '%TEXDOMAIN%' ),
			'param_name'  => 'disable_element',
			// Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', '%TEXDOMAIN%' ),
			'value'       => array( esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes' ),
		),

		// Shift Y-Axis
		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shift Y-Axis', '%TEXDOMAIN%' ),
			'param_name' => 'shift_y',
			'min'        => -1000,
			'max'        => 1000,
			'step'       => 10,
			'std'        => 0,
			'group'      => esc_html( 'Off-Grid', '%TEXDOMAIN%' ),
			'weight'     => -100,
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Custom Z-Index', '%TEXDOMAIN%' ),
			'param_name' => 'z_index',
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'std'        => 0,
			'group'      => esc_html( 'Off-Grid', '%TEXDOMAIN%' ),
			'weight'     => -100,
		),

		// Extra class
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', '%TEXDOMAIN%' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', '%TEXDOMAIN%' ),
		),
	);
}

/**
 * Row extra params
 */
function wolf_core_row_extra_params() {
	return array(
		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Custom Column Gap', 'wolf-core' ),
			'param_name'  => 'gap',
			'description' => esc_html__( 'The space gap between columns.', 'wolf-core' ),
			'weight'      => -5,
			'std'         => '',
			'group'       => esc_html__( 'Advanced', 'wolf-core' ),
		),

		// Row name
		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Section name', 'wolf-core' ),
			'param_name'  => 'row_name',
			'description' => esc_html__( 'Required for the onepage scroll, this gives the name to the section.', 'wolf-core' ),
			'weight'      => -5,
			'group'       => esc_html__( 'Advanced', 'wolf-core' ),
		),
	);
}

/**
 * Style params
 */
function wolf_core_style_params() {
	return array(
		array(
			'type'       => 'css_editor',
			'heading'    => esc_html__( 'CSS box', 'wolf-core' ),
			'param_name' => 'css',
			'group'      => esc_html__( 'Custom', 'wolf-core' ),
			'weight'     => -1,
		),

		// array(
		// 'type' => 'textfield',
		// 'heading' => esc_html__( 'Border Color', 'wolf-core' ),
		// 'param_name' => 'border_color',
		// 'group' => esc_html__( 'Custom', 'wolf-core' ),
		// 'weight' => -1,
		// ),

		// array(
		// 'type' => 'textfield',
		// 'heading' => esc_html__( 'Border Style', 'wolf-core' ),
		// 'param_name' => 'border_style',
		// 'group' => esc_html__( 'Custom', 'wolf-core' ),
		// 'weight' => -1,
		// ),
	);
}

/**
 * Row shape divider params
 */
function wolf_core_row_shape_dividers_params() {

	$sd_top = array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Type', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_type',
			'value'      => array(
				esc_html__( 'Disabled', '%TEXDOMAIN%' ) => 'disabled',
				esc_html__( 'Default', '%TEXDOMAIN%' )  => 'default',
				esc_html__( 'Custom Image', '%TEXDOMAIN%' ) => 'image',
				// esc_html__( 'Custom SVG', '%TEXDOMAIN%' ) => 'custom_svg',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element' => 'add_top_shape_divider',
				'value'   => array( 'yes' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_shape',
			'value'      => wolf_core_get_shape_divider_options(),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value'   => array( 'default' ),
			),
		),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Image', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_img',
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element' => 'sd_top_type',
				'value'   => array( 'image' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Inverted', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_inverted',
			'value'      => array(
				esc_html__( 'No', '%TEXDOMAIN%' )  => '',
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Flip', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_flip',
			'value'      => array(
				esc_html__( 'No', '%TEXDOMAIN%' )  => '',
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Shape Height', '%TEXDOMAIN%' ),
			'param_name'  => 'sd_top_height',
			'description' => esc_html__( 'Enter a value in % or px.', '%TEXDOMAIN%' ),
			'weight'      => -5,
			'placeholder' => '25%',
			'group'       => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Shape Color', '%TEXDOMAIN%' ),
			'param_name'         => 'sd_top_color',
			'value'              => array_merge(
				array( esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default' ),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', '%TEXDOMAIN%' ) => 'custom' ),
				array( esc_html__( 'Transparent', '%TEXDOMAIN%' ) => 'transparent' )
			),
			'std'                => 'default',
			'description'        => esc_html__( 'Select a color.', '%TEXDOMAIN%' ),
			'group'              => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'weight'             => -5,
			'dependency'         => array(
				'element' => 'sd_top_type',
				'value'   => array( 'default' ),
			),
		),

		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Shape Custom Color', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_custom_color',
			'dependency' => array(
				'element' => 'sd_top_color',
				'value'   => 'custom',
			),
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'weight'     => -5,
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shape Opacity', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_opacity',
			'weight'     => -5,
			'std'        => '',
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'std'        => 100,
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Ratio', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_ratio',
			'value'      => array(
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
				esc_html__( 'No', '%TEXDOMAIN%' )  => 'no',
			),
			'weight'     => -5,
			'std'        => 'yes',
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shape Z-Index', '%TEXDOMAIN%' ),
			'param_name' => 'sd_top_zindex',
			'weight'     => -5,
			'std'        => '',
			'group'      => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
			'min'        => 0,
			'max'        => 10,
			'step'       => 1,
			'std'        => 0,
			'dependency' => array(
				'element'            => 'sd_top_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Shape Responsive', '%TEXDOMAIN%' ),
		// 'param_name' => 'sd_top_responsive',
		// 'value' => array(
		// esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
		// esc_html__( 'No', '%TEXDOMAIN%' ) => '',
		// ),
		// 'weight' => -5,
		// 'group' => esc_html__( 'Divider Top', '%TEXDOMAIN%' ),
		// 'dependency' => array(
		// 'element' => 'sd_top_type',
		// 'value_not_equal_to' => array( 'disabled' )
		// ),
		// )
	);

	$sd_bottom = array(
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Type', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_type',
			'value'      => array(
				esc_html__( 'Disabled', '%TEXDOMAIN%' ) => 'disabled',
				esc_html__( 'Default', '%TEXDOMAIN%' )  => 'default',
				esc_html__( 'Custom Image', '%TEXDOMAIN%' ) => 'image',
				// esc_html__( 'Custom SVG', '%TEXDOMAIN%' ) => 'custom_svg',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element' => 'add_bottom_shape_divider',
				'value'   => array( 'yes' ),
			),
		),

		array(
			'type'       => 'attach_image',
			'heading'    => esc_html__( 'Image', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_img',
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value'   => array( 'image' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_shape',
			'value'      => wolf_core_get_shape_divider_options(),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element' => 'sd_bottom_type',
				'value'   => array( 'default' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Inverted', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_inverted',
			'value'      => array(
				esc_html__( 'No', '%TEXDOMAIN%' )  => '',
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Flip', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_flip',
			'value'      => array(
				esc_html__( 'No', '%TEXDOMAIN%' )  => '',
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
			),
			'weight'     => -5,
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Shape Height', '%TEXDOMAIN%' ),
			'param_name'  => 'sd_bottom_height',
			'description' => esc_html__( 'Enter a value in % or px.', '%TEXDOMAIN%' ),
			'weight'      => -5,
			'placeholder' => '25%',
			'group'       => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'dependency'  => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'               => 'dropdown',
			'heading'            => esc_html__( 'Shape Color', '%TEXDOMAIN%' ),
			'param_name'         => 'sd_bottom_color',
			'value'              => array_merge(
				array( esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default' ),
				wolf_core_get_shared_colors(),
				array( esc_html__( 'Custom color', '%TEXDOMAIN%' ) => 'custom' ),
				array( esc_html__( 'Transparent', '%TEXDOMAIN%' ) => 'transparent' )
			),
			'std'                => 'default',
			'description'        => esc_html__( 'Select a color.', '%TEXDOMAIN%' ),
			'group'              => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'param_holder_class' => 'wolf_core_colored-dropdown',
			'weight'             => -5,
			'dependency'         => array(
				'element' => 'sd_bottom_type',
				'value'   => array( 'default' ),
			),
		),

		array(
			'type'       => 'colorpicker',
			'heading'    => esc_html__( 'Shape Custom Color', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_custom_color',
			'dependency' => array(
				'element' => 'sd_bottom_color',
				'value'   => 'custom',
			),
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'weight'     => -5,
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shape Opacity', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_opacity',
			'weight'     => -5,
			'std'        => '',
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'std'        => 100,
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Shape Ratio', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_ratio',
			'value'      => array(
				esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
				esc_html__( 'No', '%TEXDOMAIN%' )  => 'no',
			),
			'weight'     => -5,
			'std'        => 'yes',
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		array(
			'type'       => 'wolf_core_numeric_slider',
			'heading'    => esc_html__( 'Shape Z-Index', '%TEXDOMAIN%' ),
			'param_name' => 'sd_bottom_zindex',
			'weight'     => -5,
			'std'        => '',
			'group'      => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
			'min'        => 0,
			'max'        => 10,
			'step'       => 1,
			'std'        => 0,
			'dependency' => array(
				'element'            => 'sd_bottom_type',
				'value_not_equal_to' => array( 'disabled' ),
			),
		),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Shape Responsive', '%TEXDOMAIN%' ),
		// 'param_name' => 'sd_bottom_responsive',
		// 'value' => array(
		// esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes',
		// esc_html__( 'No', '%TEXDOMAIN%' ) => '',
		// ),
		// 'weight' => -5,
		// 'group' => esc_html__( 'Divider Bottom', '%TEXDOMAIN%' ),
		// 'dependency' => array(
		// 'element' => 'sd_bottom_type',
		// 'value_not_equal_to' => array( 'disabled' )
		// ),
		// )
	);

	return array_merge(
		$sd_top,
		$sd_bottom
	);
}

/**
 * Row inner general params
 */
function wolf_core_row_inner_general_params() {
	return array(
		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Column Type', '%TEXDOMAIN%' ),
		// 'param_name' => 'column_type',
		// 'value' => array(
		// esc_html__( 'Columns', '%TEXDOMAIN%' ) => 'column',
		// esc_html__( 'Block', '%TEXDOMAIN%' ) => 'block',
		// ),
		// 'std' => 'column',
		// 'description' => esc_html__( 'This will set a default style for your columns.', '%TEXDOMAIN%' ),
		// 'weight' => 1,
		// ),
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Row Width', '%TEXDOMAIN%' ),
			'param_name' => 'container_width',
			'value'      => array(
				sprintf( esc_html__( 'Inherit', '%TEXDOMAIN%' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'inherit',
				sprintf( esc_html__( 'Standard width (%s centered)', '%TEXDOMAIN%' ), apply_filters( 'wolf_core_row_standard_width', '1140px' ) ) => 'standard',
				sprintf( esc_html__( 'Small width (%s centered)', '%TEXDOMAIN%' ), apply_filters( 'wolf_core_row_small_width', '750px' ) ) => 'small',
			),
			'weight'     => 1,
		),

		array(
			'type'        => 'wolf_core_textfield',
			'heading'     => esc_html__( 'Min Height', '%TEXDOMAIN%' ),
			'param_name'  => 'min_height',
			'placeholder' => 'auto',
			'description' => esc_html__( 'Insert the row minimum height in pixel.', '%TEXDOMAIN%' ),
			'weight'      => 1,
		),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Content position', '%TEXDOMAIN%' ),
		// 'param_name' => 'content_placement',
		// 'value' => array(
		// esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default',
		// esc_html__( 'Top', '%TEXDOMAIN%' ) => 'top',
		// esc_html__( 'Middle', '%TEXDOMAIN%' ) => 'middle',
		// esc_html__( 'Bottom', '%TEXDOMAIN%' ) => 'bottom',
		// ),
		// 'description' => esc_html__( 'Select content position within columns.', '%TEXDOMAIN%' ),
		// 'dependency' => array( 'element' => 'content_layout', 'value' => array( 'column' ) ),
		// ),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Columns position', '%TEXDOMAIN%' ),
		// 'param_name' => 'columns_placement',
		// 'value' => array(
		// esc_html__( 'Default', '%TEXDOMAIN%' ) => 'default',
		// esc_html__( 'Middle', '%TEXDOMAIN%' ) => 'middle',
		// esc_html__( 'Top', '%TEXDOMAIN%' ) => 'top',
		// esc_html__( 'Bottom', '%TEXDOMAIN%' ) => 'bottom',
		// esc_html__( 'Stretch', '%TEXDOMAIN%' ) => 'stretch',
		// ),
		// 'description' => esc_html__( 'Select columns position within row.', '%TEXDOMAIN%' ),
		// 'dependency' => array(
		// 'element' => 'full_height',
		// 'not_empty' => true,
		// ),
		// 'weight' => 1,
		// ),

		// array(
		// 'type' => 'checkbox',
		// 'heading' => esc_html__( 'Equal height', '%TEXDOMAIN%' ),
		// 'param_name' => 'equal_height',
		// 'description' => esc_html__( 'If checked columns will be set to equal height.', '%TEXDOMAIN%' ),
		// 'value' => array( esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes' ),
		// 'dependency' => array( 'element' => 'content_layout', 'value' => array( 'column' ) ),
		// ),

		// array(
		// 'type' => 'dropdown',
		// 'heading' => esc_html__( 'Columns gap', '%TEXDOMAIN%' ),
		// 'param_name' => 'gap',
		// 'value' => array(
		// '0px' => '0',
		// '1px' => '1',
		// '2px' => '2',
		// '3px' => '3',
		// '4px' => '4',
		// '5px' => '5',
		// '10px' => '10',
		// '15px' => '15',
		// '20px' => '20',
		// '25px' => '25',
		// '30px' => '30',
		// '35px' => '35',
		// ),
		// 'std' => '0',
		// 'description' => esc_html__( 'Select gap between columns in row.', '%TEXDOMAIN%' ),
		// ),

		// Visibility
		array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Visibility', '%TEXDOMAIN%' ),
			'param_name' => 'hide_class',
			'value'      => array(
				esc_html__( 'Always visible', '%TEXDOMAIN%' ) => '',
				esc_html__( 'Hide on tablet and mobile', '%TEXDOMAIN%' ) => 'wvc-hide-tablet',
				esc_html__( 'Hide on mobile', '%TEXDOMAIN%' ) => 'wvc-hide-mobile',
				esc_html__( 'Show on tablet and mobile only', '%TEXDOMAIN%' ) => 'wvc-show-tablet',
				esc_html__( 'Show on mobile only', '%TEXDOMAIN%' ) => 'wvc-show-mobile',
				esc_html__( 'Always hidden', '%TEXDOMAIN%' ) => 'wvc-hide',
			),
		),

		// Extra class
		array(
			'type'        => 'textfield',
			'heading'     => esc_html__( 'Extra class name', '%TEXDOMAIN%' ),
			'param_name'  => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', '%TEXDOMAIN%' ),
		),

		array(
			'type'        => 'checkbox',
			'heading'     => esc_html__( 'Disable row', '%TEXDOMAIN%' ),
			'param_name'  => 'disable_element',
			// Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', '%TEXDOMAIN%' ),
			'value'       => array( esc_html__( 'Yes', '%TEXDOMAIN%' ) => 'yes' ),
		),
	);
}
