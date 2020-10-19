<?php
/**
 * %NAME% core functions
 *
 * General core functions available on admin and frontend
 *
 * @author WolfThemes
 * @category Core
 * @package %PACKAGENAME%/Core
 * @version %VERSION%
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

		return 'wbp-vc';
	}
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
		// 'album-disc',
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
		'column',
		'column-inner',
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
		'highlight',
		'hours',
		'hoverbox',
		'icon',
		'iframe-opener',
		// 'image-link',
		'image-device-slider',
		'info-table',
		'instagram-gallery',
		'instagram-old',
		'instagram',
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
		'row',
		'row-inner',
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

	// apply filters.
	$wolf_core_elements = apply_filters( 'wolf_core_element_list', $wolf_core_elements );

	// sort by alphabetical order.
	sort( $wolf_core_elements );

	return $wolf_core_elements;
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
 * Allow SVG files
 *
 * @param array $mimes
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
		'vine',
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
