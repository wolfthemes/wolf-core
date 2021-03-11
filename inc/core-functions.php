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
 * Check which page builder plugin is used
 *
 * @return string plugin slug
 */
function wolf_core_get_plugin_in_use() {

	if ( did_action( 'elementor/loaded' ) ) {

		return 'elementor';

	} elseif ( defined( 'WPB_VC_VERSION' ) ) {

		return 'wpbakerypagebuilder';
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
 * Get element list in array to allow filtering by theme and stuff
 *
 * @return array
 */
function wolf_core_get_element_list() {

	$wolf_core_elements = array(
		'accordion',
		'accordion-tab',
		'admin-helper-text',
		'advanced-slider',
		'advanced-slide',
		// 'albums',
		'album-disc',
		// 'album-tracklist',
		// 'album-tracklist-item',
		'anchor',
		// 'anything-slider',
		// 'anything-slide',
		'audio',
		'audio-embed',
		'bandsintown-events',
		// 'bandsintown-tracking-button',
		'banner-gallery',
		'banner-product',
		'banner',
		'bigtext',
		'bit-artist',
		'breadcrumb',
		'button',
		// 'cards-gallery',
		'cta',
		//'column',
		//'column-inner',
		'column-text',
		'comparison_slider',
		'content-block',
		'content-slider',
		'countdown',
		'counter',
		'current-year',
		'custom-heading',
		// 'discography',
		'dropcap',
		'embed-video',
		'empty-space',
		// 'events',
		'facebook-page-box',
		'gallery',
		'gmaps',
		'google-maps',
		'heading',
		'highlight',
		'hours',
		'hoverbox',
		'icon',
		'iframe-opener',
		// 'image-link',
		'image-device-slider',
		'info-table',
		//'instagram-gallery',
		//'instagram-old',
		//'instagram',
		'interactive-links',
		'interactive-link-item',
		// 'interactive-overlays',
		// 'interactive-overlay-item',
		'item-price',
		// 'last-posts',
		'post-slider',
		'list',
		'mailchimp',
		'message',
		'music-network',
		'next-month',
		'oembed-gist',
		// 'old-instagram',
		'parallax-holder',
		'pie',
		'playlist',
		// 'portfolio',
		'pricing-table',
		'process-container',
		'process-item',
		'progress-bar',
		'rev-slider-vc',
		//'row',
		//'row-inner',
		// 'section',
		'sb-instagram-feed',
		'separator',
		'service-table',
		'social-icons',
		'social-icons-custom',
		'single-image',
		'soundcloud',
		'span',
		'spotify-player',
		'spotify-follow-button',
		'tabs',
		'tab',
		'team-member',
		'testimonials',
		'testimonial-slider',
		'testimonial-slide',
		'toggle',
		'twitter',
		'typed',
		'video',
		'video-opener',
		'video-self-hosted',
		// 'videos-carousel', //  last videos from plugin carousel
		// 'videos',
		// 'waveform-player',
		'wc-categories',
		'youtube',
		'zigzag',
	);

	if ( 'wpbakerypagebuilder' === wolf_core_get_plugin_in_use() ) {
		$wolf_core_elements[] = 'row';
		$wolf_core_elements[] = 'row-inner';
		$wolf_core_elements[] = 'column';
		$wolf_core_elements[] = 'column-inner';
	}

	// apply filters.
	$wolf_core_elements = apply_filters( 'wolf_core_element_list', $wolf_core_elements );

	// sort by alphabetical order.
	sort( $wolf_core_elements );

	//debug( $wolf_core_elements );

	return $wolf_core_elements;
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

	if ( class_exists( 'PixProofPlugin' ) ) {
		$mimes['zip'] = 'application/zip';
		$mimes['gz']  = 'application/x-gzip';
	}

	return $mimes;
}
add_filter( 'upload_mimes', 'wolf_core_mime_types', 10, 1 );

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
		'bandcamp',
		'bandsintown',
		'behance',
		// 'bitbucket',
		'codepen',
		'dailymotion',
		'deviantart',
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
		'google',
		'twitter',
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
		'itunes',
		'delicious',
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
	array_unshift( $wolf_core_socials, 'facebook', 'twitter', 'instagram', 'messenger', 'flickr', 'behance', 'dribbble', 'linkedin', 'youtube', 'vimeo', 'bandcamp', 'spotify', 'soundcloud', 'bandsintown' );

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
		'instagram',
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
 * @param array $args The passed arguments.
 * @return string
 */
function wolf_core_animated_svg( $file, $args = array() ) {

	$args = wp_parse_args(
		$args,
		array(
			'class'              => '',
			'animation_duration' => '',
		)
	);

	wp_enqueue_script( 'vivus' );
	wp_enqueue_script( 'wolf-core-vivus' );

	extract( $args );

	$class .= ' wolf-core-vivus wolf-core-svg-icon';

	$rand = 'wolf-core-svg-' . wp_rand( 0, 999999 ); // unique ID.

	$output = '';

	$output .= '<span id="' . esc_attr( $rand ) . '" class="' . wolf_core_sanitize_html_classes( $class ) . '"
	data-file="' . esc_url( $file ) . '"';

	if ( $animation_duration ) {
		$output .= ' data-animation-duration="' . absint( $animation_duration ) . '"';
	}

	$output .= '></span>';

	return $output;
}

/**
 * New animations
 */
function wolf_core_get_aos_animations() {
	return array(
		'fade'            => esc_html__( 'Fade', 'wolf-visual-composer' ),
		'fade-up'         => esc_html__( 'Fade Up', 'wolf-visual-composer' ),
		'fade-down'       => esc_html__( 'Fade Down', 'wolf-visual-composer' ),
		'fade-left'       => esc_html__( 'Fade Left', 'wolf-visual-composer' ),
		'fade-right'      => esc_html__( 'Fade Right', 'wolf-visual-composer' ),
		'fade-up-right'   => esc_html__( 'Fade Up Right', 'wolf-visual-composer' ),
		'fade-up-left'    => esc_html__( 'Fade Up Left', 'wolf-visual-composer' ),
		'fade-down-right' => esc_html__( 'Fade Down Right', 'wolf-visual-composer' ),
		'fade-down-left'  => esc_html__( 'Fade Down Left', 'wolf-visual-composer' ),

		'flip-up'         => esc_html__( 'Flip Up', 'wolf-visual-composer' ),
		'flip-down'       => esc_html__( 'Flip Down', 'wolf-visual-composer' ),
		'flip-left'       => esc_html__( 'Flip Left', 'wolf-visual-composer' ),
		'flip-right'      => esc_html__( 'Flip Right', 'wolf-visual-composer' ),

		'slide-up'        => esc_html__( 'Slide Up', 'wolf-visual-composer' ),
		'slide-down'      => esc_html__( 'Slide Down', 'wolf-visual-composer' ),
		'slide-left'      => esc_html__( 'Slide Left', 'wolf-visual-composer' ),
		'slide-right'     => esc_html__( 'Slide Right', 'wolf-visual-composer' ),

		'zoom-in'         => esc_html__( 'Zoom In', 'wolf-visual-composer' ),
		'zoom-in-up'      => esc_html__( 'Zoom In Up', 'wolf-visual-composer' ),
		'zoom-in-down'    => esc_html__( 'Zoom In Down', 'wolf-visual-composer' ),
		'zoom-in-left'    => esc_html__( 'Zoom In Left', 'wolf-visual-composer' ),
		'zoom-in-right'   => esc_html__( 'Zoom In Right', 'wolf-visual-composer' ),
		'zoom-out'        => esc_html__( 'Zoom Out', 'wolf-visual-composer' ),
		'zoom-out-up'     => esc_html__( 'Zoom Out Up', 'wolf-visual-composer' ),
		'zoom-out-down'   => esc_html__( 'Zoom Out Down', 'wolf-visual-composer' ),
		'zoom-out-left'   => esc_html__( 'Zoom Out Left', 'wolf-visual-composer' ),
		'zoom-out-right'  => esc_html__( 'Zoom Out Right', 'wolf-visual-composer' ),
	);
}

/**
 * Retrieve an option value from the plugin settings
 *
 * @param string $index
 * @param [type] $name
 * @param [type] $default
 * @return void
 */
function wolf_core_get_option( $index = 'settings', $name, $default = null ) {

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
 * @param string $index
 * @param [type] $key
 * @param [type] $value
 * @return void
 */
function wolf_core_update_option( $index = 'settings', $key, $value ) {

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
 * @param int    $id
 * @param string $size
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
 * Get placeholder image URL
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
		return '<img class="' . wolf_core_sanitize_html_classes( $class ) . '" src="' . wolf_core_placeholder_img_url( $img_size ) . '" alt="placeholder" title="' . esc_html__( 'Image is missing', 'wolf-visual-composer' ) . '">';
	}
}
