<?php
/**
 * Wolf Core core functions
 *
 * General core functions available on admin and frontend
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get element list in array to allow filtering by theme and stuff
 *
 * @return array
 */
function wolf_core_get_elements() {

	$wolf_core_elements = array(
		// 'accordion',
		// 'accordion-tab',
		// 'admin-helper-text',
		// 'advanced-slider',
		// 'advanced-slide',
		// 'album-disc',
		// 'album-tracklist',
		// 'album-tracklist-item',
		// 'anchor',
		'animated-svg',
		// 'anything-slider',
		// 'anything-slide',
		// 'audio',
		// 'audio-button',
		// 'audio-embed',
		// 'bandsintown-events', // added in themes
		// 'bandsintown-tracking-button', // added in themes
		// 'banner-gallery',
		// 'banner-product',
		// 'banner',
		'bigtext',
		'blockquote',
		'breadcrumb',
		'button',
		// 'cards-gallery',
		// 'cta',
		'clients',
		// 'comparison_slider',
		'content-block',
		// 'content-slider',
		// 'countdown',
		// 'counter',
		// 'current-year',
		// 'custom-heading',
		// 'discography',
		// 'dropcap',
		// 'embed-video',
		// 'empty-space',
		// 'events',
		// 'facebook-page-box',
		'gallery',
		'gallery-banner',
		// 'gmaps',
		'google-maps',
		// 'highlight',
		'hour-list',
		// 'hoverbox',
		'icon',
		// 'iframe-opener',
		// 'image-link',
		// 'image-device-slider',
		'image-hover-video',
		// 'info-table',
		// 'interactive-links',
		// 'interactive-link-item',
		// 'interactive-overlays',
		// 'interactive-overlay-item',
		// 'item-price',
		// 'last-posts',
		'link',
		// 'post-slider',
		// 'list',
		'mailchimp',
		'marquee-text',
		// 'message',
		// 'music-network',
		// 'next-month',
		// 'oembed-gist',
		// 'old-instagram',
		// 'parallax-holder',
		// 'pie',
		'price-list',
		'pricing-table',
		// 'process',
		// 'process-container',
		// 'process-item',
		// 'progress-bar',
		'rotating-text',
		// 'section',
		// 'separator',
		// 'service-table',
		'social-icons',
		// 'social-icons-custom',
		// 'single-image',
		// 'soundcloud',
		// 'span',
		'spotify-player', // added in themes
		// 'spotify-follow-button', // added in themes
		// 'tabs',
		// 'tab',
		'team-member',
		// 'testimonials',
		'testimonial-slider',
		// 'testimonial-slide',
		'textual-showcase',
		// 'toggle',
		// 'twitter',
		// 'typed',
		// 'video',
		'video-opener',
		// 'video-self-hosted',
		// 'videos-carousel', //  last videos from plugin carousel
		'video-preview',
		// 'videos',
		// 'waveform-player',
		// 'wc-categories',
		'wc-search-form',
		// 'youtube',
		// 'zigzag',
	);

	if ( class_exists( 'Wolf_Playlist_Manager' ) ) {
		$wolf_core_elements[] = 'playlist';
	}

	if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
		$wolf_core_elements[] = 'heading';
		// $wolf_core_elements[] = 'interactive-links';
	}

	if ( 'vc' === wolf_core_get_plugin_in_use() ) {
		$wolf_core_elements[] = 'column';
		$wolf_core_elements[] = 'column-inner';
		$wolf_core_elements[] = 'column-text';
		$wolf_core_elements[] = 'custom-heading';
		$wolf_core_elements[] = 'row';
		$wolf_core_elements[] = 'row-inner';
	}

	if ( defined( 'WPCF7_VERSION' ) ) {
		$wolf_core_elements[] = 'contact-form-7';
	}

	if ( 'vc' === wolf_core_get_plugin_in_use() || 'elementor' === wolf_core_get_plugin_in_use() ) { // and not Elementor Pro?
		$wolf_core_elements[] = 'countdown';
	}

	if ( 'elementor' === wolf_core_get_plugin_in_use() ) { // and not Elementor Pro?
		// $wolf_core_elements[] = 'blockquote';
	}

	if ( function_exists( 'sb_instagram_feed_init' ) ) {
		$wolf_core_elements[] = 'sb-instagram-feed';
	}

	if ( class_exists( 'Wolf_Twitter' ) ) {
		$wolf_core_elements[] = 'twitter';
	}

	// apply filters.
	$wolf_core_elements = apply_filters( 'wolf_core_element_list', $wolf_core_elements );

	// sort by alphabetical order.
	sort( $wolf_core_elements );

	// debug( $wolf_core_elements );

	return $wolf_core_elements;
}

/**
 * Check which page builder plugin is used
 *
 * @return string plugin slug
 */
function wolf_core_get_plugin_in_use() {

	if ( did_action( 'elementor/loaded' ) ) {

		return 'elementor';

	} elseif ( defined( 'WPB_VC_VERSION' ) ) {

		return 'vc';
	}
}

/**
 * Gets the ID of the post, even if it's not inside the loop.
 *
 * @uses WP_Query
 * @uses get_queried_object()
 * @extends get_the_ID()
 * @see get_the_ID()
 *
 * @return int
 */
function wolf_core_get_the_id() {
	global $wp_query;

	$post_id = null;

	if ( function_exists( 'is_shop' ) && is_shop() ) {

		$post_id = get_option( 'woocommerce_shop_page_id' );

		// Get post ID outside the loop
	} elseif ( is_object( $wp_query ) && isset( $wp_query->queried_object ) && isset( $wp_query->queried_object->ID ) ) {

		$post_id = $wp_query->queried_object->ID;

	} else {
		$post_id = get_the_ID();
	}

	return $post_id;
}

/**
 * Get theme slug
 *
 * @return string
 */
function wolf_core_get_theme_slug() {
	return apply_filters( 'wolftheme_theme_slug', esc_attr( sanitize_title_with_dashes( get_template() ) ) );
}

/**
 * Get theme version
 *
 * @return string
 */
function woolf_core_get_theme_version() {
	$theme = wp_get_theme();
	return $theme->get( 'Version' );
}

/**
 * Get blog URL
 */
function wolf_core_get_blog_url() {
	if ( get_option( 'page_for_posts' ) ) {
		return esc_url( get_permalink( get_option( 'page_for_posts' ) ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Allow SVG files
 *
 * @param array $mimes The allowed mime types.
 * @return array $mimes
 */
function wolf_core_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	$mimes['svgz'] = 'image/svg+xml';
	$mimes['webp'] = 'image/webp';
	$mimes['csv']  = 'text/csv';
	$mimes['zip']  = 'application/zip';
	$mimes['gz']   = 'application/x-gzip';

	return $mimes;
}
add_filter( 'upload_mimes', 'wolf_core_mime_types', 10, 1 );

/**
 * Add image sizes
 *
 * These size will be ued for galleries and sliders
 */
function wolf_core_add_image_sizes() {

	// Extra Large for background.
	add_image_size( 'wolf-core-XL', 2000, 3000, false );

	// Slides.
	add_image_size( 'wolf-core-slide', 1200, 700, true );

	// Masonry.
	add_image_size( 'wolf-core-masonry', 500, 2000, false );

	// Horizontal photo.
	add_image_size( 'wolf-core-photo', 500, 500, false );
}
add_action( 'init', 'wolf_core_add_image_sizes' );

/**
 * Get socials services
 *
 * @return array
 */
function wolf_core_get_socials() {

	$wolf_core_socials = array(
		'500px',
		'8tracks',
		'airbnb',
		'amazon',
		// 'amplement',
		'apple', // iTunes.
		'beatport',
		'bandcamp',
		'bandsintown',
		'behance',
		// 'bitbucket',
		'codepen',
		'dailymotion',
		'deviantart',
		'deezer',
		'digg',
		'dribbble',
		// 'dropbox',
		// 'email',
		'envato',
		'etsy',
		'facebook',
		'flickr',
		'foursquare',
		'github',
		// 'google',
		'twitter',
		'x',
		'instagram',
		'linkedin',
		'youtube',
		'vimeo',
		'soundcloud',
		'spotify',
		'mailchimp',
		'medium',
		'messenger',
		'mixcloud',
		'imdb',
		'lastfm',
		// 'path',
		'pinterest',
		// 'jsfiddle',
		'tumblr',
		'tripadvisor',
		'skype',
		'snapchat',
		// 'itunes',
		// 'delicious',
		'stumbleupon',
		// 'forrst',
		// 'evernote',
		// 'rss',
		'reddit',
		// 'stack-exchange',
		// 'stack-overflow',
		'residentadvisor',
		'reverbnation',
		'snapchat',
		'steam',
		'trello',
		'triplej',
		'viadeo',
		'vk',
		'telegram',
		'tidal',
		'tiktok',
		'twitch',
		// 'qq',
		// 'wechat',
		// 'weibo',
		// 'weixin',
		// 'whatsapp',
		// 'windows',
		'wordpress',
		// 'renren',
		// 'tencent-weibo',
		// 'xing',
		'yelp',
		'zomato',
		'zerply',
	);

	$wolf_core_socials = apply_filters( 'wolf_core_socials', $wolf_core_socials );

	sort( $wolf_core_socials );

	// Insert most used at the beggining.
	array_unshift( $wolf_core_socials, 'facebook', 'twitter', 'x', 'instagram', 'messenger', 'flickr', 'behance', 'dribbble', 'linkedin', 'youtube', 'vimeo', 'bandcamp', 'spotify', 'soundcloud', 'bandsintown' );

	$wolf_core_socials[] = 'rss'; // push rss at the end.
	$wolf_core_socials[] = 'email'; // push email at the end.

	$wolf_core_socials = array_unique( $wolf_core_socials ); // remove duplicates.

	// var_dump( $wolf_core_socials );

	return $wolf_core_socials;
}

/**
 * Get socials services
 *
 * @return array
 */
function wolf_core_get_team_member_socials() {

	$wolf_core_team_member_socials = array(
		'facebook',
		'twitter',
		'x',
		'instagram',
		'tiktok',
		'pinterest',
		'google',
		'dribbble',
		'behance',
		'linkedin',
		'youtube',
		'vimeo',
		'github',
		'tumblr',
		'email',
	);

	$wolf_core_team_member_socials = apply_filters( 'wolf_core_team_member_socials', $wolf_core_team_member_socials );

	array_unique( $wolf_core_team_member_socials );
	// sort( $wolf_core_team_member_socials );

	return $wolf_core_team_member_socials;
}

/**
 *  Output animated SVG image
 *
 * @param string $file The file URL.
 * @param array  $args The passed arguments.
 * @return string
 */
// function wolf_core_animated_svg( $file, $args = array() ) {

// $args = wp_parse_args(
// $args,
// array(
// 'class'              => '',
// 'animation_duration' => '',
// )
// );

// wp_enqueue_script( 'vivus' );
// wp_enqueue_script( 'wolf-core-vivus' );

// extract( $args );

// $class .= ' wolf-core-vivus wolf-core-svg-icon';

// $rand = 'wolf-core-svg-' . wp_rand( 0, 999999 ); // unique ID.

// $output = '';

// $output .= '<span id="' . esc_attr( $rand ) . '" class="' . wolf_core_sanitize_html_classes( $class ) . '"
// data-file="' . esc_url( $file ) . '"';

// if ( $animation_duration ) {
// $output .= ' data-animation-duration="' . absint( $animation_duration ) . '"';
// }

// $output .= '></span>';

// return $output;
// }

/**
 * New animations
 */
function wolf_core_get_aos_animations() {
	return array(
		'fade'            => esc_html__( 'Fade', 'wolf-core' ),
		'fade-up'         => esc_html__( 'Fade Up', 'wolf-core' ),
		'fade-down'       => esc_html__( 'Fade Down', 'wolf-core' ),
		'fade-left'       => esc_html__( 'Fade Left', 'wolf-core' ),
		'fade-right'      => esc_html__( 'Fade Right', 'wolf-core' ),
		'fade-up-right'   => esc_html__( 'Fade Up Right', 'wolf-core' ),
		'fade-up-left'    => esc_html__( 'Fade Up Left', 'wolf-core' ),
		'fade-down-right' => esc_html__( 'Fade Down Right', 'wolf-core' ),
		'fade-down-left'  => esc_html__( 'Fade Down Left', 'wolf-core' ),

		'flip-up'         => esc_html__( 'Flip Up', 'wolf-core' ),
		'flip-down'       => esc_html__( 'Flip Down', 'wolf-core' ),
		'flip-left'       => esc_html__( 'Flip Left', 'wolf-core' ),
		'flip-right'      => esc_html__( 'Flip Right', 'wolf-core' ),

		'slide-up'        => esc_html__( 'Slide Up', 'wolf-core' ),
		'slide-down'      => esc_html__( 'Slide Down', 'wolf-core' ),
		'slide-left'      => esc_html__( 'Slide Left', 'wolf-core' ),
		'slide-right'     => esc_html__( 'Slide Right', 'wolf-core' ),

		'zoom-in'         => esc_html__( 'Zoom In', 'wolf-core' ),
		'zoom-in-up'      => esc_html__( 'Zoom In Up', 'wolf-core' ),
		'zoom-in-down'    => esc_html__( 'Zoom In Down', 'wolf-core' ),
		'zoom-in-left'    => esc_html__( 'Zoom In Left', 'wolf-core' ),
		'zoom-in-right'   => esc_html__( 'Zoom In Right', 'wolf-core' ),
		'zoom-out'        => esc_html__( 'Zoom Out', 'wolf-core' ),
		'zoom-out-up'     => esc_html__( 'Zoom Out Up', 'wolf-core' ),
		'zoom-out-down'   => esc_html__( 'Zoom Out Down', 'wolf-core' ),
		'zoom-out-left'   => esc_html__( 'Zoom Out Left', 'wolf-core' ),
		'zoom-out-right'  => esc_html__( 'Zoom Out Right', 'wolf-core' ),
	);
}

/**
 * Get hover animations
 *
 * @return array
 */
function wolf_core_get_hover_animations() {
	return array();
}

/**
 * Retrieve an option value from the plugin settings
 *
 * @param string $index The option index.
 * @param string $name The option name.
 * @param string $default The default value.
 * @return mixed
 */
function wolf_core_get_option( $index, $name, $default = null ) {

	global $options;

	$wolf_core_settings = ( get_option( 'wolf_core_settings' ) && is_array( get_option( 'wolf_core_settings' ) ) ) ? get_option( 'wolf_core_settings' ) : array();

	if ( isset( $wolf_core_settings[ $index ] ) && is_array( $wolf_core_settings[ $index ] ) ) {

		if ( isset( $wolf_core_settings[ $index ][ $name ] ) && '' !== $wolf_core_settings[ $index ][ $name ] ) {

			return $wolf_core_settings[ $index ][ $name ];

		} elseif ( $default ) {

			return $default;
		}
	} elseif ( $default ) {

		return $default;
	}
}

/**
 * Update an option value from the plugin settings
 *
 * @param string $index The option index.
 * @param string $key The option key.
 * @param string $value The new value.
 * @return void
 */
function wolf_core_update_option( $index, $key, $value ) {

	$wolf_core_settings = ( get_option( 'wolf_core_settings' ) && is_array( get_option( 'wolf_core_settings' ) ) ) ? get_option( 'wolf_core_settings' ) : array();

	if ( ! isset( $wolf_core_settings[ $index ] ) ) {
		$wolf_core_settings[ $index ] = array();
	}

	$wolf_core_settings[ $index ][ $key ] = $value;

	update_option( 'wolf_core_settings', $wolf_core_settings );
}

/**
 * Get the URL of an attachment from its id
 *
 * @param int    $id The attachent ID.
 * @param string $size The image size.
 * @return string $url
 */
function wolf_core_get_url_from_attachment_id( $id, $size = 'thumbnail', $fallback = true ) {
	if ( is_numeric( $id ) ) {
		$src = wp_get_attachment_image_src( absint( $id ), $size );

		if ( isset( $src[0] ) ) {

			return esc_url( $src[0] );
		} else {
			return wolf_core_placeholder_img_url( $size );
		}
	}
}

/**
 * Get image sizes in array to allow filtering by theme and stuff
 *
 * @return array
 */
function wolf_core_get_image_sizes() {

	$wolf_core_image_sizes = array(
		apply_filters( 'wolf_core_landscape_thumbnail_size', '600x360' ) => esc_html__( 'Landscape', 'wolf-core' ),
		apply_filters( 'wolf_core_square_thumbnail_size', '600x600' )    => esc_html__( 'Square', 'wolf-core' ),
		apply_filters( 'wolf_core_portrait_thumbnail_size', '300x537' )  => esc_html__( 'Portrait', 'wolf-core' ),
		'wolf-core-XL'                                                   => esc_html__( 'Extra large', 'wolf-core' ),
		'large'                                                          => esc_html__( 'Large', 'wolf-core' ),
		'medium'                                                         => esc_html__( 'Medium', 'wolf-core' ),
		'thumbnail'                                                      => esc_html__( 'Thumbnail', 'wolf-core' ),
		'full'                                                           => esc_html__( 'Full', 'wolf-core' ),
		'custom'                                                         => esc_html__( 'Custom', 'wolf-core' ),
	);

	return apply_filters( 'wolf_core_image_sizes', $wolf_core_image_sizes );
}

/**
 * Get placeholder image URL
 *
 * @param string $img_size The image size.
 * @return string
 */
function wolf_core_placeholder_img_url( $img_size ) {

	if ( in_array( $img_size, array( 'thumbnail', 'medium', 'large', 'wolf-core-XL', 'wolf-core-photo', 'full' ), true ) ) {

		switch ( $img_size ) {
			case 'wolf-core-XL':
				$img_size = '2000x1500';
				break;
			case 'wolf-core-photo':
				$img_size = '500x500';
				break;
			case 'full':
				$img_size = '2000x1500';
				break;
			case 'thumbnail':
				$img_size = get_option( 'thumbnail_size_w' ) . 'x' . get_option( 'thumbnail_size_h' );
				break;
			case 'medium':
				$img_size = get_option( 'medium_size_w' ) . 'x' . get_option( 'medium_size_h' );
				break;
			case 'large':
				$img_size = get_option( 'large_size_w' ) . 'x' . get_option( 'large_size_h' );
				break;
		}
	}

	if ( $img_size ) {
		$formatted_size = str_replace( 'x', '/', $img_size );
		return 'https://unsplash.it/' . $formatted_size . '/?image=' . rand( 1, 1084 );
	}
}

/**
 * Returns fallback from placeholder if image is missing
 */
function wolf_core_placeholder_img( $img_size, $class = '' ) {

	if ( wolf_core_placeholder_img_url( $img_size ) ) {
		return '<img class="' . wolf_core_sanitize_html_classes( $class ) . '" src="' . wolf_core_placeholder_img_url( $img_size ) . '" alt="placeholder" title="' . esc_html__( 'Image is missing', 'wolf-core' ) . '">';
	}
}

/**
 * Get twitter username from plugin options
 */
function wolf_core_get_twitter_usename() {
	$default_twitter_username = wolf_core_get_option( 'socials', 'twitter' );

	if ( $default_twitter_username ) {
		if ( preg_match( '/twitter.com\/[a-zA-Z0-9_]+/', $default_twitter_username, $match ) ) {
			$default_twitter_username = str_replace( 'twitter.com/', '', $match[0] );
			return $default_twitter_username;
		}
	}
}

/**
 * Get x username from plugin options
 */
function wolf_core_get_x_usename() {
	$default_x_username = wolf_core_get_option( 'socials', 'x' );

	if ( $default_x_username ) {
		if ( preg_match( '/x.com\/[a-zA-Z0-9_]+/', $default_x_username, $match ) ) {
			$default_x_username = str_replace( 'x.com/', '', $match[0] );
			return $default_x_username;
		}
	}
}

/**
 * Get shared color list in array to allow filtering by theme
 *
 * @return array
 */
function wolf_core_get_shared_colors() {

	if ( 'elementor' === wolf_core_get_plugin_in_use() ) {

		$wolf_core_shared_colors = apply_filters(
			'wolf_core_elementor_colors',
			array(
				'black'       => esc_html__( 'Black', 'wolf-core' ),
				'lightergrey' => esc_html__( 'Light Grey', 'wolf-core' ),
				'darkgrey'    => esc_html__( 'Dark Grey', 'wolf-core' ),
				'white'       => esc_html__( 'White', 'wolf-core' ),
			)
		);

	} elseif ( 'vc' === wolf_core_get_plugin_in_use() ) {

		$wolf_core_shared_colors = apply_filters(
			'wolf_core_vc_colors',
			array(
				'black'       => esc_html__( 'Black', 'wolf-core' ),
				'lightergrey' => esc_html__( 'Light Grey', 'wolf-core' ),
				'darkgrey'    => esc_html__( 'Dark Grey', 'wolf-core' ),
				'white'       => esc_html__( 'White', 'wolf-core' ),
				'orange'      => esc_html__( 'Orange', 'wolf-core' ),
				'green'       => esc_html__( 'Green', 'wolf-core' ),
				'turquoise'   => esc_html__( 'Turquoise', 'wolf-core' ),
				'violet'      => esc_html__( 'Violet', 'wolf-core' ),
				'pink'        => esc_html__( 'Pink', 'wolf-core' ),
				'greyblue'    => esc_html__( 'Grey blue', 'wolf-core' ),
				'red'         => esc_html__( 'Red', 'wolf-core' ),
				'yellow'      => esc_html__( 'Yellow', 'wolf-core' ),
				'blue'        => esc_html__( 'Blue', 'wolf-core' ),
			)
		);
	}

	$wolf_core_shared_colors = apply_filters( 'wolf_core_shared_colors', $wolf_core_shared_colors );

	return $wolf_core_shared_colors;
}

/**
 * Get theme accent color value
 */
function wolf_core_get_theme_accent_color_value() {
	return apply_filters( 'wolf_core_theme_accent_color', '#0073AA' );
}

/**
 * Get shared color hex value
 */
function wolf_core_get_shared_colors_hex() {

	$wolf_core_shared_colors_hex = array(
		'black'       => '#000000',
		'lightergrey' => '#f7f7f7',
		'darkgrey'    => '#444444',
		'white'       => '#ffffff',
		'orange'      => '#F7BE68',
		'green'       => '#6DAB3C',
		'turquoise'   => '#49afcd',
		'violet'      => '#8D6DC4',
		'pink'        => '#FE6C61',
		'greyblue'    => '#49535a',
		'red'         => '#da4f49',
		'yellow'      => '#e6ae48',
		'blue'        => '#75D69C',
		'peacoc'      => '#4CADC9',
		'chino'       => '#CEC2AB',
		'mulled-wine' => '#50485B',
		'vista-blue'  => '#75D69C',
		'grey'        => '#EBEBEB',
		'sky'         => '#5AA1E3',
		'juicy-pink'  => '#F4524D',
		'sandy-brown' => '#F79468',
		'purple'      => '#B97EBB',
		'accent'      => wolf_core_get_theme_accent_color_value(),
	);

	$wolf_core_shared_colors_hex = apply_filters( 'wolf_core_shared_colors_hex', $wolf_core_shared_colors_hex );

	return $wolf_core_shared_colors_hex;
}

/**
 * Get shared gradient color list in array to allow filtering by theme and stuff
 *
 * @return array
 */
function wolf_core_get_shared_gradient_colors() {

	$wolf_core_shared_gradient_colors = array(
		'gradient-color-3452ff' => esc_html__( 'Gradient Red', 'wolf-core' ),
		'gradient-color-588694' => esc_html__( 'Gradient Red 2', 'wolf-core' ),
		'gradient-color-105898' => esc_html__( 'Gradient Green', 'wolf-core' ),
		'gradient-color-111420' => esc_html__( 'Gradient Green Circle', 'wolf-core' ),
		'gradient-color-470604' => esc_html__( 'Gradient Orange', 'wolf-core' ),
		'gradient-color-b900b4' => esc_html__( 'Gradient Violet', 'wolf-core' ),
	);

	$wolf_core_shared_gradient_colors = apply_filters( 'wolf_core_shared_gradient_colors', $wolf_core_shared_gradient_colors );

	return $wolf_core_shared_gradient_colors;
}

/**
 * Get metro pattern options
 *
 * @return array
 */
function wolf_core_get_metro_patterns() {
	return apply_filters(
		'wolf_core_metro_pattern_options',
		array(
			'auto'      => esc_html__( 'Auto', 'wolf-core' ),
			'pattern-1' => sprintf( esc_html__( 'Pattern %1$d (loop of %2$d)', 'wolf-core' ), 1, 6 ),
			'pattern-2' => sprintf( esc_html__( 'Pattern %1$d (loop of %2$d)', 'wolf-core' ), 2, 8 ),
			'pattern-3' => sprintf( esc_html__( 'Pattern %1$d (loop of %2$d)', 'wolf-core' ), 3, 10 ),
			'pattern-4' => sprintf( esc_html__( 'Pattern %1$d (loop of %2$d)', 'wolf-core' ), 4, 8 ),
			'pattern-5' => sprintf( esc_html__( 'Pattern %1$d (loop of %2$d)', 'wolf-core' ), 5, 5 ),
			'pattern-6' => sprintf( esc_html__( 'Pattern %1$d (loop of %2$d)', 'wolf-core' ), 6, 5 ),
			'pattern-7' => sprintf( esc_html__( 'Pattern %1$d (loop of %2$d)', 'wolf-core' ), 7, 6 ),
		)
	);
}

/**
 * Get metro image size
 *
 * Get image size depending on metro pattern
 *
 * @param string $pattern
 * @param int    $index
 * @return string $img_size
 */
function wolf_core_get_metro_img_size( $pattern = 'auto', $i = 0 ) {

	$img_size = 'medium';

	if ( 'auto' === $pattern ) {

		// if ( 0 === $i ) {
			$img_size = 'large';
		// }

	} elseif ( 'pattern-1' === $pattern ) {

		if ( 0 === $i || $i % 6 == 0 || $i % 6 == 3 ) {
			$img_size = 'large';
		}
	} elseif ( 'pattern-2' === $pattern ) {

		if ( 0 === $i || $i % 8 == 1 || $i % 8 == 2 || $i % 8 == 4 || $i % 8 == 5 ) {
			$img_size = 'large';
		}
	} elseif ( 'pattern-3' === $pattern ) {

		if ( $i % 10 === 4 || $i % 10 === 8 ) {
			$img_size = 'large';
		}
	} elseif ( 'pattern-4' === $pattern ) {

		if ( 0 === $i || $i % 8 === 0 || $i % 8 === 2 || $i % 8 === 6 || $i % 8 === 7 ) {
			$img_size = 'large';
		}
	} elseif ( 'pattern-5' === $pattern ) {

		if ( 0 === $i || $i % 5 === 0 ) {
			$img_size = 'large';
		}
	} elseif ( 'pattern-6' === $pattern ) {

		if ( 0 === $i || $i % 5 === 2 ) {
			$img_size = 'large';
		}
	} elseif ( 'pattern-7' === $pattern ) {

		if ( 0 === $i || $i % 6 === 0 || $i % 6 === 1 ) {
			$img_size = 'large';
		}
	}

	return $img_size;
}

/**
 * Get hover effects in array to allow filtering by theme and stuff
 *
 * @return array
 */
function wolf_core_get_hover_effects() {

	$wolf_core_hover_effects = array(
		'default'         => esc_html__( 'Theme Default', 'wolf-core' ),
		'opacity'         => esc_html__( 'Opacity', 'wolf-core' ),
		'opacity-reverse' => esc_html__( 'Opacity Reversed', 'wolf-core' ),
		'zoomin'          => esc_html__( 'Zoom In', 'wolf-core' ),
		'zoomout'         => esc_html__( 'Zoom Out', 'wolf-core' ),
		'move-left'       => esc_html__( 'Move Left', 'wolf-core' ),
		'move-right'      => esc_html__( 'Move Right', 'wolf-core' ),
		'move-up'         => esc_html__( 'Move Up', 'wolf-core' ),
		'move-down'       => esc_html__( 'Move Down', 'wolf-core' ),
		'up'              => esc_html__( 'Up', 'wolf-core' ),
		'greyscale'       => esc_html__( 'Black and white to colored', 'wolf-core' ),
		'to-greyscale'    => esc_html__( 'Colored to Black and white', 'wolf-core' ),
	);

	return apply_filters( 'wolf_core_hover_effects', $wolf_core_hover_effects );
}

/**
 * Breadcrumb function
 */
function wolf_core_get_breadcrumb() {

	global $post, $wp_query;

	$output = '';

	if ( ! is_front_page() ) {

		$position  = 1;
		$delimiter = '<span class="wolf-core-breadcrumb-delimiter">' . apply_filters( 'wolf_core_breadcrumb_delimiter', '/' ) . '</span>';
		$before    = '';
		$after     = '';

		$output .= '<ol class="wolf-core-breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">';

		$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a
       itemprop="item" href="';
		$output .= esc_url( home_url( '/' ) );
		$output .= '"><span itemprop="name">';
		// $output .= esc_html__( 'Home', 'wolf-core' );
		if ( get_option( 'page_on_front' ) ) {
			$output .= get_the_title( get_option( 'page_on_front' ) );
		} else {
			$output .= esc_html__( 'Home', 'wolf-core' );
		}
		$output .= "</span></a><meta itemprop='position' content='" . $position++ . "' /></li>$delimiter";

		if ( 'post' == get_post_type() && ! wolf_core_is_blog_index() ) {

			$output     .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . wolf_core_get_blog_url() . '"><span itemprop="name">' . get_the_title( get_option( 'page_for_posts' ) ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;
		}

		if ( wolf_core_is_woocommerce_page() && is_shop() ) {
			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">';
			$output .= get_the_title( wolf_core_get_woocommerce_shop_page_id() );
			$output .= '</span><meta itemprop="position" content="' . $position++ . '" /></li>';
		}

		if ( wolf_core_is_woocommerce_page() && is_product_category() ) {

			$shop_page_id = wc_get_page_id( 'shop' );

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '" ><span itemprop="name">' . get_the_title( $shop_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;

			$current_term = $wp_query->get_queried_object();
			$ancestors    = array_reverse( get_ancestors( $current_term->term_id, 'product_cat' ) );

			foreach ( $ancestors as $ancestor ) {

				$ancestor = get_term( $ancestor, 'product_cat' );

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_term_link( $ancestor ) . '"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;
			}

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $before . esc_html( $current_term->name ) . $after ) . '</span><meta itemprop="position" content="' . $position++ . '" /></li>';

		} elseif ( wolf_core_is_woocommerce_page() && is_product_tag() ) {

			$shop_page_id = wc_get_page_id( 'shop' );
			$output      .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( $shop_page_id ) . '"><span itemprop="name">' . get_the_title( $shop_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;

			$queried_object = $wp_query->get_queried_object();

			$output .= $before . esc_html__( 'Products tagged &ldquo;', 'wolf-core' ) . $queried_object->name . '&rdquo;' . $after;

		} elseif ( wolf_core_is_woocommerce_page() && ! is_singular( 'product' ) && ! is_shop() ) {

			$shop_page_id = wc_get_page_id( 'shop' );
			$output      .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '"><span itemprop="name">' . get_the_title( $shop_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
			$output      .= $delimiter;
		}

		if ( is_category() ) {

			$cat_obj       = $wp_query->get_queried_object();
			$this_category = get_category( $cat_obj->term_id );

			if ( 0 != $this_category->parent ) {
				$parent_category = get_category( $this_category->parent );
				if ( ( $parents = get_category_parents( $parent_category, true, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {

					$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $before . rtrim( $parents, $after . $delimiter . $before ) . $after ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;
				}
			}

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $before . single_cat_title( '', false ) . $after ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>';

		} elseif ( is_tag() ) {

			$output .= get_the_tag_list( '', $delimiter );

		} elseif ( is_author() ) {

			$output .= get_the_author();

		} elseif ( is_day() ) {

			$output .= get_the_date();

		} elseif ( is_month() ) {

			$output .= get_the_date( 'F Y' );

		} elseif ( is_year() ) {

			$output .= get_the_date( 'Y' );

		} elseif ( is_tax( 'work_type' ) ) {

			$portfolio_page_id = wolf_portfolio_get_page_id();
			$output           .= '<a href="' . get_permalink( $portfolio_page_id ) . '">' . get_the_title( $portfolio_page_id ) . '</a>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $wp_query->queried_object->name ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" />';
			}
		} elseif ( is_tax( 'gallery_type' ) ) {

			$albums_page_id = wolf_albums_get_page_id();
			$output        .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item href="' . get_permalink( $albums_page_id ) . '"><span itemprop="name">' . get_the_title( $albums_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $wp_query->queried_object->name ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>';
			}
		} elseif ( is_tax( 'video_type' ) ) {

			$videos_page_id = wolf_videos_get_page_id();
			$output        .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item href="' . get_permalink( $videos_page_id ) . '"><span itemprop="name">' . get_the_title( $videos_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $wp_query->queried_object->name ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" />';
			}
		} elseif ( is_tax( 'plugin_cat' ) ) {

			$plugins_page_id = wolf_plugins_get_page_id();
			$output         .= '<a href="' . get_permalink( $plugins_page_id ) . '">' . get_the_title( $plugins_page_id ) . '</a>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= sanitize_text_field( $wp_query->queried_object->name );

			}
		} elseif ( is_tax( 'theme_cat' ) ) {

			$themes_page_id = wolf_themes_get_page_id();
			$output        .= '<a href="' . get_permalink( $themes_page_id ) . '">' . get_the_title( $themes_page_id ) . '</a>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= esc_attr( $wp_query->queried_object->name );

			}
		} elseif ( is_tax() && ! is_tax( 'product_cat' ) && ! is_tax( 'product_tag' ) ) {

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . esc_attr( $wp_query->queried_object->name ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>';

			}
		} elseif ( is_search() ) {

			if ( wolf_core_is_woocommerce_page() ) {
				$output .= $delimiter;
			}

			// $output .= '<a href="' . get_permalink( $post->post_parent ) . '">';
			$output .= esc_html__( 'Search', 'wolf-core' );
		}

		if ( is_attachment() ) {

			$output .= esc_html__( 'Attachment', 'wolf-core' );

			$output .= $delimiter;

			$output .= empty( $post->post_parent ) ? get_the_title() : '<a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a>' . $delimiter . get_the_title();

		} elseif ( is_page() ) {

			if ( ! empty( $post->post_parent ) && ! wolf_core_is_woocommerce_page() ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( $post->post_parent ) . '"><span itemprop="name">' . get_the_title( $post->post_parent ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;

			}

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . get_the_title() . '</span><meta itemprop="position" content="' . $position++ . '" /></li>';

		} elseif ( is_search() ) {

			$output .= $delimiter;

			$output .= ( isset( $_GET['s'] ) ) ? esc_attr( $_GET['s'] ) : esc_html__( 'Search results', 'wolf-core' );
		}

		if ( is_single() ) {

			if ( is_singular( 'work' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_portfolio_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_portfolio_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;

				$output .= get_the_term_list( $post->ID, 'work_type', '', $delimiter, '' );

				if ( has_term( '', 'work_type' ) ) {
					$output .= $delimiter;
				}
			} elseif ( is_singular( 'video' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_videos_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_videos_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;

				$output .= get_the_term_list( $post->ID, 'video_type', '', $delimiter, '' );

				if ( has_term( '', 'video_type' ) ) {
					$output .= $delimiter;
				}
			} elseif ( is_singular( 'gallery' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_albums_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_albums_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';

				$output .= $delimiter;

				$output .= get_the_term_list( $post->ID, 'gallery_type', '', $delimiter, '' );

				if ( has_term( '', 'gallery_type' ) ) {

					$output .= $delimiter;
				}
			} elseif ( is_singular( 'plugin' ) ) {

				$output .= '<a href="' . get_permalink( wolf_plugins_get_page_id() ) . '">' . get_the_title( wolf_plugins_get_page_id() ) . '</a>';
				$output .= $delimiter;

				$output .= get_the_term_list( $post->ID, 'plugin_cat', '', $delimiter, '' );

				// if ( has_term( '', 'plugin_cat' ) ) {
					$output .= $delimiter;
				// }

			} elseif ( is_singular( 'product' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '"><span itemprop="name">' . get_the_title( wc_get_page_id( 'shop' ) ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';

				$output .= $delimiter;

				if ( $terms = wc_get_product_terms(
					$post->ID,
					'product_cat',
					array(
						'orderby' => 'parent',
						'order'   => 'DESC',
					)
				) ) {
					$main_term = $terms[0];
					$ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
					$ancestors = array_reverse( $ancestors );

					foreach ( $ancestors as $ancestor ) {
						$ancestor = get_term( $ancestor, 'product_cat' );

						if ( ! is_wp_error( $ancestor ) && $ancestor ) {
							$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_term_link( $ancestor ) . '"><span itemprop="name">' . $ancestor->name . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>' . $delimiter;
						}
					}

					$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_term_link( $main_term ) . '"><span itemprop="name">' . $main_term->name . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>' . $delimiter;
				}
			} elseif ( is_singular( 'event' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item href="' . get_permalink( wolf_events_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_events_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>';
				$output .= $delimiter;

				// $output .= '<a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title( get_the_ID() ) . '</a>';
				// $output .= $delimiter;

				// $output .= get_the_term_list( $post->ID, 'gallery_type', '', $delimiter, '');

				// if ( has_term( '', 'gallery_type' ) )
				// $output .= $delimiter;

			} elseif ( is_singular( 'release' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_discography_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_discography_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>';

				if ( has_term( '', 'band' ) ) {
					$output .= $delimiter;
				}

				$output .= get_the_term_list( $post->ID, 'band', '', $delimiter, '' );

				// if ( has_term( '', 'band' ) ) {
					$output .= $delimiter;
				// }

			} elseif ( is_singular( 'artist' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_artists_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_artists_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>';

				if ( has_term( '', 'artist_genre' ) ) {
					$output .= $delimiter;
				}

				$output .= get_the_term_list( $post->ID, 'artist_genre', '', $delimiter, '' );

				// if ( has_term( '', 'band' ) ) {
					$output .= $delimiter;
				// }

			} elseif ( is_singular( 'wolf_content_block' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><span itemprop="name">' . esc_html__( 'Content Block', 'wolf-core' ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>';

				$output .= $delimiter;

			} elseif ( is_singular( 'wpm_playlist' ) ) {

				$output .= esc_html__( 'Playlists', 'wolf-core' );
				$output .= $delimiter;

			} else {
				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . wolf_core_get_first_category_url() . '"><span itemprop="name">' . wolf_core_get_first_category() . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;
			}

			$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><span itemprop="name">' . wolf_core_sample( get_the_title(), 10 ) . '</span><meta itemprop="position" content="' . $position++ . '" /></lI>';

		} elseif (
			$wp_query && isset( $wp_query->queried_object->ID )
			&& $wp_query->queried_object->ID == get_option( 'page_for_posts' )
		) {

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $wp_query->queried_object->post_title ) . '</span><meta itemprop="position" content="' . $position++ . '" /></lI>';
		}

		$output .= '</ol>';
	}

	return $output;
}

/**
 * Get current page URL
 */
function wolf_core_get_current_url() {
	global $wp;
	return esc_url( home_url( add_query_arg( array(), $wp->request ) ) );
}

/**
 * Add to cart tag
 *
 * @param int    $product_id
 * @param string $text button class
 * @param string $classes link text content
 * @return string
 */
function wolf_core_add_to_cart( $product_id, $classes = '', $text = '' ) {
	// <a rel="nofollow" href="/factory/retine/shop/shop-boxed/?add-to-cart=60" data-quantity="1" data-product_id="60" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart"><span>Add to cart</span></a>
	$wc_url = untrailingslashit( wolf_core_get_current_url() ) . '/?add-to-cart=' . absint( $product_id );

	$classes .= ' product_type_simple add_to_cart_button ajax_add_to_cart';

	return '<a
		href="' . esc_url( $wc_url ) . '"
		rel="nofollow"
		data-quantity="1" data-product_id="' . absint( $product_id ) . '"
		class="' . wolf_core_sanitize_html_classes( $classes ) . '">' . $text . '</a>';
}

/**
 * Get Google Maps API key
 *
 * @return string
 */
function wolf_core_get_google_maps_api_key() {

	$gmaps_api_key = wolf_core_get_option( 'google-map', 'google_maps_api_key' );

	if ( get_option( 'elementor_google_maps_api_key' ) && 'elementor' === wolf_core_get_plugin_in_use() ) {
		$gmaps_api_key = get_option( 'elementor_google_maps_api_key' );
	}

	return apply_filters( 'wolf_core_google_maps_api_key', $gmaps_api_key );
}

function wolf_core_set_default_kit_values() {

	if ( get_option( '_wolf_core_set_default_kit_values' ) ) {
		return;
	}

	/* Get default kit */
	$default_kit_post = wolf_core_get_page_by_title( 'Default Kit', OBJECT, 'elementor_library' );

	if ( $default_kit_post ) {

		$default_kit_post_id = $default_kit_post->ID;

		$css_meta                            = array();
		$css_meta['container_width']         = array();
		$css_meta['container_width']['unit'] = apply_filters( 'wolf_core_default_elementor_container_width_unit', 'px' );
		$css_meta['container_width']['size'] = apply_filters( 'wolf_core_default_elementor_container_width_size', '1400' );

		/* Update Default Kit */
		update_post_meta( $default_kit_post_id, '_elementor_page_settings', $css_meta );
		add_option( '_wolf_core_set_default_kit_values', true );
	}
}
add_action( 'admin_init', 'wolf_core_set_default_kit_values' );

/**
 * MailChimp add subscriber
 *
 * @param array $data
 * @return void
 * @link https://stackoverflow.com/questions/30481979/adding-subscribers-to-a-list-using-mailchimps-api-v3
 */
function wolf_core_sync_mailchimp( $data ) {

	$api_key = apply_filters( 'wolf_core_mailchimp_api_key', wolf_core_get_option( 'mailchimp', 'mailchimp_api_key' ) );
	$list_id = esc_attr( $data['list_id'] );
	$email   = $data['email'];
	$status  = 'subscribed';

	$merge_fields = array(
		'FNAME' => $data['firstname'],
		'LNAME' => $data['lastname'],
	); // FNAME, LNAME or something else

	// start our Mailchimp connection
	$connection = curl_init();
	curl_setopt(
		$connection,
		CURLOPT_URL,
		'https://' . substr( $api_key, strpos( $api_key, '-' ) + 1 ) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5( strtolower( $email ) )
	);
	curl_setopt( $connection, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Authorization: Basic ' . base64_encode( 'user:' . $api_key ) ) );
	curl_setopt( $connection, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $connection, CURLOPT_CUSTOMREQUEST, 'PUT' );
	curl_setopt( $connection, CURLOPT_POST, true );
	curl_setopt( $connection, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt(
		$connection,
		CURLOPT_POSTFIELDS,
		json_encode(
			array(
				'apikey'        => $api_key,
				'email_address' => $email,
				'status'        => $status,
				'merge_fields'  => $merge_fields,
			)
		)
	);

	$result = curl_exec( $connection );

	echo 'OK';
}

/**
 * get_page_by_title
 *
 * @param [type] $page_title
 * @return void
 */
function wolf_core_get_page_by_title( $page_title, $output = OBJECT, $post_type = 'page' ) {
	$query = new WP_Query(
		array(
			'title'                  => $page_title,
			'post_type'              => $post_type,
			'post_status'            => 'all',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'orderby'                => 'date',
			'order'                  => 'ASC',
		)
	);

	if ( ! empty( $query->post ) ) {
		$_post = $query->post;

		if ( ARRAY_A === $output ) {
			return $_post->to_array();
		} elseif ( ARRAY_N === $output ) {
			return array_values( $_post->to_array() );
		}

		return $_post;
	}

	return null;
}

if ( ! function_exists( 'wolf_core_log' ) ) {

	function wolf_core_log( $v ) {
		$log_file = WOLF_CORE_DIR . '/debug.log';

		if ( ( file_exists( $log_file ) && is_writable( $log_file ) ) || ( ! file_exists( $log_file ) && is_writable( dirname( $log_file ) ) ) ) {
			error_log( $v . PHP_EOL, 3, $log_file );
		}
	}
}
