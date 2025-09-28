<?php
/**
 * Wolf Core utility functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get inline CSS from VC custom CSS class
 *
 * We use it to add inline style to row
 *
 * @param $param_value
 * @param string $prefix
 * @return string
 */
function wolf_core_shortcode_custom_style( $param_value ) {

	if ( preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value, $match ) ) {
		if ( isset( $match[2] ) ) {
			return wolf_core_clean_spaces( str_replace( '!important', '', $match[2] ), true ); // remove !important to allow CSS overwriting
		}
	}
}

/**
 * Get VC purchase URL
 *
 * @return string
 */
function wolf_core_vc_purchase_url() {
	return esc_url( 'https://wlfthm.es/wpbpb' );
}

/**
 * Helper method to determine if a shortcode attribute is true or false.
 *
 * @param string|int|bool $var Attribute value.
 * @return bool
 */
function wolf_core_shortcode_bool( $var ) {
	$falsey = array( 'false', '0', 'no', 'n', '', ' ' );
	return ( ! $var || in_array( strtolower( $var ), $falsey, true ) ) ? false : true;
}

/**
 * Sanitize css value
 *
 * Be sure that the unit of a value ic correct (e.g: 100px)
 *
 * @param string $value
 * @param string $default_unit
 * @param string $default_value
 * @return string $value
 */
function wolf_core_sanitize_css_value( $value, $default_unit = 'px', $default_value = '1' ) {

	$pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
	// allowed metrics: http://www.w3schools.com/cssref/css_units.asp
	$regexr = preg_match( $pattern, $value, $matches );
	$value  = isset( $matches[1] ) ? absint( $matches[1] ) : $default_value;
	$unit   = isset( $matches[2] ) ? esc_attr( $matches[2] ) : $default_unit;
	$value  = $value . $unit;

	return $value;
}

/**
 * sanitize_html_class works just fine for a single class
 * Some times le wild <span class="blue hedgehog"> appears, which is when you need this function,
 * to validate both blue and hedgehog,
 * Because sanitize_html_class doesn't allow spaces.
 *
 * @uses sanitize_html_class
 * @param (mixed: string/array) $class   "blue hedgehog goes shopping" or array("blue", "hedgehog", "goes", "shopping")
 * @param (mixed)               $fallback Anything you want returned in case of a failure
 * @return (mixed: string / $fallback )
 */
function wolf_core_sanitize_html_classes( $class, $fallback = null ) {

	// Explode it, if it's a string
	if ( is_string( $class ) ) {
		$class = explode( ' ', $class );
	}

	if ( is_array( $class ) && count( $class ) > 0 ) {
		$class = array_unique( array_map( 'sanitize_html_class', $class ) );
		return trim( implode( ' ', $class ) );
	} else {
		return trim( sanitize_html_class( $class, $fallback ) );
	}
}

/**
 * Sanitize color input
 *
 * @link https://github.com/redelivre/wp-divi/blob/master/includes/functions/sanitization.php
 *
 * @param string $color
 * @return string $color
 */
function wolf_core_sanitize_color( $color ) {

	// Trim unneeded whitespace
	$color = str_replace( ' ', '', $color );
	// If this is hex color, validate and return it
	if ( 1 === preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}
	// If this is rgb, validate and return it
	elseif ( 'rgb(' === substr( $color, 0, 4 ) ) {
		sscanf( $color, 'rgb(%d,%d,%d)', $red, $green, $blue );
		if ( ( $red >= 0 && $red <= 255 ) &&
			( $green >= 0 && $green <= 255 ) &&
			( $blue >= 0 && $blue <= 255 )
			) {
			return "rgb({$red},{$green},{$blue})";
		}
	}
	// If this is rgba, validate and return it
	elseif ( 'rgba(' === substr( $color, 0, 5 ) ) {
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		if ( ( $red >= 0 && $red <= 255 ) &&
			( $green >= 0 && $green <= 255 ) &&
			( $blue >= 0 && $blue <= 255 ) &&
				$alpha >= 0 && $alpha <= 1
			) {
			return "rgba({$red},{$green},{$blue},{$alpha})";
		}
	} elseif ( 'transparent' === $color ) {
		return 'transparent';
	}
}

/**
 * Sanitize CSS from user intpu
 *
 * @param string $style
 * @return string
 */
function wolf_core_sanitize_css_field( $style ) {

	if ( '' === $style ) {
		return;
	}

	// remove double semicolon.
	$style = str_replace( array( ';;', '; ;' ), '', $style );

	if ( ';' !== substr( $style, -1 ) ) {
		$style = $style . ';'; // add end semicolon if missing.
	}

	return esc_attr( trim( wolf_core_clean_spaces( $style ) ) );
}

/**
 * Escape html style attribute
 *
 * @param string $style The style attribute to clean
 * @return string
 */
function wolf_core_esc_style_attr( $style ) {

	if ( '' === $style || empty( $style ) ) {
		return;
	}

	if ( ';' !== substr( $style, -1 ) ) {
		$style = $style . ';'; // add end semicolon if missing.
	}

	// remove double semicolon.
	$style = str_replace( array( ';;', '; ;' ), '', $style );

	$style = ( ';' !== $style ) ? $style : '';

	return esc_attr( trim( wolf_core_clean_spaces( $style ) ) );
}

/**
 * Convert color class to hex value
 *
 * @param sting  $color The color name to convert.
 * @param string $custom_color The custom color.
 * @return array
 */
function wolf_core_convert_color_class_to_hex_value( $color, $custom_color ) {

	$hex_color = '';

	$colors = array(
		'blue'        => '#5472d2',
		'turquoise'   => '#00c1cf',
		'pink'        => '#fe6c61',
		'violet'      => '#8d6dc4',
		'peacoc'      => '#4cadc9',
		'chino'       => '#cec2ab',
		'mulled-wine' => '#50485b',
		'vista-blue'  => '#75d69c',
		'orange'      => '#f7be68',
		'sky'         => '#5aa1e3',
		'green'       => '#6dab3c',
		'juicy-pink'  => '#f4524d',
		'sandy-brown' => '#f79468',
		'purple'      => '#b97ebb',
		'black'       => '#2a2a2a',
		'grey'        => '#ebebeb',
		'white'       => '#ffffff',
	);

	$colors = wolf_core_get_shared_colors_hex();

	if ( 'custom' === $color ) {
		$hex_color = $custom_color;
	} else {
		$hex_color = isset( $colors[ $color ] ) ? $colors[ $color ] : '';
	}

	return $hex_color;
}

/**
 * Convert textarea line to an array of each lines
 *
 * @param sting
 * @param string type text|html
 * @return array
 */
function wolf_core_texarea_lines_to_array( $text, $type = 'text' ) {
	$array = array();

	$lines = str_replace(
		'\r',
		'\n',
		str_replace( '\r\n', '\n', $text )
	);

	$lines = explode( "\n", $lines );

	if ( is_array( $lines ) ) {
		foreach ( $lines as $line ) {
			$array[] = ( 'text' === $type ) ? sanitize_text_field( $line ) : $line;
		}
	}

	return $array;
}

/**
 * Clean a list
 *
 * Remove first and last comma of a list and remove spaces before and after separator
 *
 * @param string $list
 * @return string $list
 */
function wolf_core_clean_list( $list, $separator = ',' ) {
	if ( ! empty( $list ) ) {
		$list = str_replace( array( $separator . ' ', ' ' . $separator ), $separator, $list );
		$list = ltrim( $list, $separator );
		$list = rtrim( $list, $separator );
	}

	return $list;
}

/**
 * Remove all double spaces and line breaks
 *
 * This function is mainly used to clean up inline CSS
 *
 * @param string $css
 * @return string
 */
function wolf_core_clean_spaces( $string, $hard = false ) {

	if ( $hard ) {
		return str_replace( ' ', '', $string );
	} else {
		return preg_replace( '/\s+/', ' ', $string );
	}
}

/**
 * Convert list to array
 *
 * @param string $list
 * @return array
 */
function wolf_core_list_to_array( $list, $separator = ',' ) {
	return ( $list ) ? explode( ',', trim( wolf_core_clean_spaces( wolf_core_clean_list( $list ) ) ) ) : array();
}

/**
 * Convert array of ids to list
 *
 * @param string $list
 * @return array
 */
function wolf_core_array_to_list( $array, $separator = ',' ) {
	$list = '';

	if ( is_array( $array ) ) {
		$list = rtrim( implode( $separator, array_unique( $array ) ), $separator );
	}

	return wolf_core_clean_list( $list );
}

/**
 * Create a formatted sample of any text
 *
 * Remove HTML and shortcode, sanitize and shorten a string
 *
 * @param string $text
 * @param int    $num_words
 * @param string $more
 * @return string
 */
function wolf_core_sample( $text, $num_words = 55, $more = '...' ) {
	$text = wp_strip_all_tags( wp_trim_words( strip_shortcodes( $text ), $num_words, $more ) );
	$text = preg_replace( '/(http:|https:)?\/\/[a-zA-Z0-9\/.?&=-]+/', '', $text );
	return $text;
}

/**
 * Check the type of video from URL
 *
 * Chek if a YouTube, mp4 or Vimeo URL
 */
function wolf_core_get_video_url_type( $url ) {

	if ( preg_match( '#youtu#', $url, $match ) ) {

		return 'youtube';

	} elseif ( preg_match( '#.vimeo#', $url, $match ) ) {

		return 'vimeo';

	} elseif ( preg_match( '#.mp4#', $url, $match ) ) {

		return 'selfhosted';
	}
}

/**
 * Return the first video URL in the post if a video URL is found
 *
 * @return string
 */
function wolf_core_get_first_video_url( $post_id = null ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$content = get_post_field( 'post_content', $post_id );

	$has_video_url =
	// youtube
	preg_match( '#(https|http)?://(?:\www.)?youtube.com/watch\?v=([A-Za-z0-9\-_]+)#', $content, $match )
	|| preg_match( '#(https|http)?://(?:\www.)?youtu.be/([A-Za-z0-9\-_]+)#', $content, $match )

	// vimeo
	|| preg_match( '#vimeo\.com/([0-9]+)#', $content, $match )

	// other
	|| preg_match( '#http://blip.tv/.*#', $content, $match )
	|| preg_match( '#https?://(www\.)?dailymotion\.com/.*#', $content, $match )
	|| preg_match( '#http://dai.ly/.*#', $content, $match )
	|| preg_match( '#https?://(www\.)?hulu\.com/watch/.*#', $content, $match )
	|| preg_match( '#https?://(www\.)?viddler\.com/.*#', $content, $match )
	|| preg_match( '#http://qik.com/.*#', $content, $match )
	|| preg_match( '#http://revision3.com/.*#', $content, $match )
	|| preg_match( '#http://wordpress.tv/.*#', $content, $match )
	|| preg_match( '#https?://(www\.)?funnyordie\.com/videos/.*#', $content, $match )
	|| preg_match( '#https?://(www\.)?flickr\.com/.*#', $content, $match )
	|| preg_match( '#http://flic.kr/.*#', $content, $match )

	// Video Format
	|| preg_match( '/(http:|https:)?\/\/[a-zA-Z0-9\/.?&=_-]+.mp4/', $content, $match );

	$video_url = ( $has_video_url ) ? esc_url( $match[0] ) : null;

	return $video_url;
}

/**
 * Get dominant color from image
 *
 * @param int $attachment_id The attachment id.
 */
function wolf_core_get_image_dominant_color( $attachment_id ) {

	if ( ! $attachment_id || ! extension_loaded( 'gd' ) ) {
		return;
	}

	$metadata = wp_get_attachment_metadata( $attachment_id );

	if ( ! isset( $metadata['file'] ) ) {
		return 'transparent';
	}

	$upload_dir = wp_upload_dir();
	$filename   = $upload_dir['basedir'] . '/' . $metadata['file'];
	$ext        = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );

	if ( 'jpg' === $ext || 'jpeg' === $ext ) {

		$image = imagecreatefromjpeg( $filename );

	} elseif ( 'png' === $ext ) {

		$image = imagecreatefrompng( $filename );

	} elseif ( 'gif' === $ext ) {

		$image = imagecreatefromgif( $filename );

	} else {
		return 'transparent';
	}

	$thumb = imagecreatetruecolor( 1, 1 );
	imagecopyresampled( $thumb, $image, 0, 0, 0, 0, 1, 1, imagesx( $image ), imagesy( $image ) );
	$main_color = dechex( imagecolorat( $thumb, 0, 0 ) );

	$main_color = ( 6 === strlen( $main_color ) ) ? '#' . $main_color : 'transparent';

	return $main_color;
}

/**
 * Get first category of the post if any
 *
 * @param int $post_id
 */
function wolf_core_get_first_category( $post_id = null ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( 'post' === get_post_type() ) {
		$category = get_the_category();
		if ( $category ) {
			return $category[0]->name;
		}
	}
}

/**
 * Get iframe src atttibute
 *
 * @param string $iframe
 * @return string $src
 */
function wolf_core_get_iframe_src( $iframe ) {

	if ( preg_match( '/src=("|\')?([a-zA-Z0-9:\/\'?!=.+%-_]+)("|\')?"/', $iframe, $match ) ) {

		if ( isset( $match[2] ) ) {
			$src = $match[2];
			return esc_url( $src );
		}
	}
}

/**
 * Get first category of the post if any
 *
 * @param int $post_id
 */
function wolf_core_get_first_category_url( $post_id = null ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( 'post' === get_post_type() ) {
		$category = get_the_category();
		if ( $category ) {
			return get_category_link( $category[0]->term_ID );
		}
	} elseif ( 'work' && taxonomy_exists( 'work_type' ) ) {

		$terms = get_the_terms( $post_id, 'work_type' );

		if ( $terms ) {
			$term = $terms[0];

			return get_term_link( $term );
		}
	} elseif ( 'gallery' && taxonomy_exists( 'gallery_type' ) ) {

		$terms = get_the_terms( $post_id, 'gallery_type' );

		if ( $terms ) {
			$term = $terms[0];

			return get_term_link( $term );
		}
	}
}

/**
 * @param array $atts
 */
function wolf_core_element_aos_animation_data_attr( $atts, $force = false ) {
	$data = '';

	if ( isset( $atts['css_animation'] ) && 'none' !== $atts['css_animation'] ) {

		$css_animation       = esc_attr( $atts['css_animation'] );
		$css_animation_delay = ( isset( $atts['css_animation_delay'] ) ) ? absint( $atts['css_animation_delay'] ) : '';

		if ( wolf_core_is_new_animation( $css_animation ) || $force ) {
			wp_enqueue_style( 'aos' );
			wp_enqueue_script( 'aos' );

			$data .= ' data-aos="' . $css_animation . '"';

			if ( ! wolf_core_do_fullpage() ) {
				$data .= ' data-aos-once="true"';
			}

			if ( $css_animation_delay ) {
				$data .= ' data-aos-delay="' . $css_animation_delay . '"';
			}
		}
	}

	return $data;
}
// add_filter( 'wolf_core_social_icons_data_attrs', 'wolf_core_element_aos_animation_data_attr' );

/**
 * @param $css_animation
 *
 * @return string
 */
function wolf_core_get_css_animation( $css_animation ) {

	$output = '';
	if ( '' !== $css_animation && 'none' !== $css_animation ) {
		wp_enqueue_script( 'wow' );
		wp_enqueue_script( 'waypoints' );
		wp_enqueue_style( 'animate-css' );
		$output = ' wolf-core-wow ' . $css_animation;
	}

	return $output;
}

/**
 * @param $css_animation_delay
 *
 * @return string
 */
function wolf_core_get_css_animation_delay( $css_animation_delay ) {

	$output = '';

	if ( '' !== $css_animation_delay ) {
		$output = 'animation-delay:' . absint( $css_animation_delay ) / 1000 . 's;-webkit-animation-delay:' . absint( $css_animation_delay ) / 1000 . 's;';
	}

	return $output;
}

/**
 * Brightness color function simiar to sass lighten and darken
 *
 * @param string $hex
 * @param int    $percent
 * @return string
 */
function wolf_core_color_brightness( $hex, $percent ) {

	$steps = ( ceil( ( $percent * 200 ) / 100 ) ) * 2;

	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Format the hex color string
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Get decimal values
	$r = hexdec( substr( $hex, 0, 2 ) );
	$g = hexdec( substr( $hex, 2, 2 ) );
	$b = hexdec( substr( $hex, 4, 2 ) );

	// Adjust number of steps and keep it inside 0 to 255
	$r = max( 0, min( 255, $r + $steps ) );
	$g = max( 0, min( 255, $g + $steps ) );
	$b = max( 0, min( 255, $b + $steps ) );

	$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
	$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
	$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

	return '#' . $r_hex . $g_hex . $b_hex;
}

/**
 * Sanitize title and replace the string by custom tag if needed
 *
 * This function is mainy used for heading. It allows users to use a short tag {{post_title}} to display the curent page/page title
 *
 * @param string $string
 * @return string $string
 */
function wolf_core_sanitize_heading( $string ) {

	$post_title     = wolf_core_get_post_title();
	$site_title     = get_bloginfo( 'name' );
	$post_excerpt   = get_the_excerpt();
	$subheading     = wolf_core_get_post_subheading();
	$featured_image = get_the_post_thumbnail( get_the_ID(), 'large' );

	$short_tags = array(
		'{{post_title}}'      => $post_title,
		'{{page_title}}'      => $post_title,
		'{{site_title}}'      => $site_title,
		'{{post_subheading}}' => $subheading,
		'{{post_excerpt}}'    => $post_excerpt,
		'{{post_thumbnail}}'  => $featured_image,
	);

	foreach ( $short_tags as $key => $value ) {
		$string = preg_replace( "/$key/", $value, $string );
	}

	return $string;
}

/**
 * Sanitize text_block and replace the string by custom tag if needed
 *
 * This function is mainy used for text_block. It allows users to use a short tag {{post_text_block}} to display the curent page/page text_block
 *
 * @param string $string The string to sanitize.
 * @return string $string
 */
function wolf_core_sanitize_text_block( $string ) {

	$post_title     = wolf_core_get_post_title();
	$site_title     = get_bloginfo( 'name' );
	$post_excerpt   = get_the_excerpt();
	$subheading     = wolf_core_get_post_subheading();
	$featured_image = get_the_post_thumbnail( get_the_ID(), 'large' );

	$short_tags = array(
		'{{post_title}}'      => $post_title,
		'{{page_title}}'      => $post_title,
		'{{site_title}}'      => $site_title,
		'{{post_subheading}}' => $subheading,
		'{{post_excerpt}}'    => $post_excerpt,
		'{{post_thumbnail}}'  => $featured_image,
	);

	foreach ( $short_tags as $key => $value ) {
		$string = preg_replace( "/$key/", $value, $string );
	}

	return wp_kses_post( $string );
}

/* Add text-transform to allow wp_kses style attr */
add_filter(
	'safe_style_css',
	function ( $styles ) {
		$styles[] = 'text-transform';
		return $styles;
	}
);

/**
 * Sanitize string with wp_kses
 *
 * @param string $output The string to sanitize.
 * @return sring $output
 */
function wolf_core_kses( $output ) {

	return wp_kses(
		$output,
		array(
			'div'        => array(
				'class'     => array(),
				'id'        => array(),
				'itemscope' => array(),
				'itemtype'  => array(),
			),
			'p'          => array(
				'class' => array(),
				'id'    => array(),
			),
			'ul'         => array(
				'class' => array(),
				'id'    => array(),
				'style' => array(),
			),
			'ol'         => array(
				'class' => array(),
				'id'    => array(),
				'style' => array(),
			),
			'li'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'span'       => array(
				'class'        => array(),
				'id'           => array(),
				'data-post-id' => array(),
				'itemprop'     => array(),

			),
			'i'          => array(
				'class'       => array(),
				'id'          => array(),
				'aria-hidden' => array(),
			),
			'time'       => array(
				'class'    => array(),
				'datetime' => array(),
				'itemprop' => array(),
			),
			'blockquote' => array(
				'class' => array(),
				'id'    => array(),
			),
			'hr'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'strong'     => array(
				'class' => array(),
				'id'    => array(),
			),
			'em'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'br'         => array(),
			'img'        => array(
				'src'      => array(),
				'srcset'   => array(),
				'class'    => array(),
				'id'       => array(),
				'width'    => array(),
				'height'   => array(),
				'sizes'    => array(),
				'alt'      => array(),
				'title'    => array(),
				'data-src' => array(),
			),
			'a'          => array(
				'class'                  => array(),
				'id'                     => array(),
				'href'                   => array(),
				'data-fancybox'          => array(),
				'rel'                    => array(),
				'title'                  => array(),
				'target'                 => array(),
				'data-mega-menu-tagline' => array(),
				'itemprop'               => array(),
			),
			'h1'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'h2'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'h3'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'h4'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'h5'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'h6'         => array(
				'class' => array(),
				'id'    => array(),
			),
			'ins'        => array(
				'class' => array(),
				'id'    => array(),
			),
			'del'        => array(
				'class' => array(),
				'id'    => array(),
			),
			'svg'        => array(
				'class' => array(),
				'id'    => array(),
			),
			'iframe'     => array(
				'class'           => array(),
				'id'              => array(),
				'src'             => array(),
				'width'           => array(),
				'height'          => array(),
				'style'           => array(),
				'allowfullscreen' => array(),
				'loading'         => array(),
				'referrerpolicy'  => array(),
			),
		)
	);
}

/**
 * Returns page title outside the loop
 *
 * @return string
 */
function wolf_core_get_post_title() {

	$title = get_the_title();

	if ( wolf_core_is_home_as_blog() ) {
		$title = get_bloginfo( 'name' );
	}

	/* Main condition not 404 and not woocommerce page */
	if ( ! is_404() && ! wolf_core_is_woocommerce_page() ) {

		if ( wolf_core_is_blog() ) {

			if ( is_category() ) {

				$title = single_cat_title( '', false );

			} elseif ( is_tag() ) {

				$title = single_tag_title( '', false );

			} elseif ( is_author() ) {

				$title = get_the_author();

			} elseif ( is_day() ) {

				$title = get_the_date();

			} elseif ( is_month() ) {

				$title = get_the_date( 'F Y' );

			} elseif ( is_year() ) {

				$title = get_the_date( 'Y' );

				/* is blog index */
			} elseif ( wolf_core_is_blog_index() && ! wolf_core_is_home_as_blog() ) {

				$title = get_the_title( get_option( 'page_for_posts' ) );
			}
		} elseif ( is_tax() ) {

			$queried_object = get_queried_object();

			if ( is_object( $queried_object ) && isset( $queried_object->name ) ) {
				$title = $queried_object->name;
			}
		} elseif ( is_single() ) {

			$title = get_the_title();
		}
	} elseif ( wolf_core_is_woocommerce_page() ) { // shop title.

		if ( is_shop() || is_product_taxonomy() ) {

			$title = ( function_exists( 'woocommerce_page_title' ) ) ? woocommerce_page_title( false ) : '';

		} else {
			$title = get_the_title();
		}
	}

	if ( is_search() ) {
		$title = sprintf( esc_html__( 'Search results for %s', 'wolf-core' ), '<span class="search-query-text">&quot;' . esc_html( get_search_query() ) . '&quot;</span>' );
	}

	return $title;
}

/**
 * Returns page title outside the loop
 *
 * @return string
 */
function wolf_core_get_post_subheading( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = wolf_core_get_the_id();
	}

	if ( wolf_core_is_woocommerce_page() ) {
		if ( is_shop() || is_product_taxonomy() ) {
			$post_id = ( function_exists( 'wolf_core_get_woocommerce_shop_page_id' ) ) ? wolf_core_get_woocommerce_shop_page_id() : false;
		}
	}

	return get_post_meta( $post_id, '_post_subheading', true );
}

/**
 * Get WooCommerce shop page id
 *
 * @return int
 */
function wolf_core_get_woocommerce_shop_page_id() {

	$page_id = null;

	if ( class_exists( 'Woocommerce' ) ) {
		$page_id = get_option( 'woocommerce_shop_page_id' );
	}

	return $page_id;
}

/**
 * Get color brightness to adjust font color
 *
 * Used to determine if a background is light enough to use a dark font
 *
 * @param string $hex
 * @return string light|dark
 */
function wolf_core_get_color_tone( $hex, $index = 215 ) {

	// Sanitize the color
	$hex = sanitize_hex_color( $hex );

	// If sanitize_hex_color returns null, default to a fallback value (e.g., '#000000').
	if ( is_null( $hex ) ) {
		$hex = '#ffffff';
	}

	// Remove #
	$hex = str_replace( '#', '', $hex );

	// Convert hex to RGB
	$c_r = hexdec( substr( $hex, 0, 2 ) );
	$c_g = hexdec( substr( $hex, 2, 2 ) );
	$c_b = hexdec( substr( $hex, 4, 2 ) );

	// Calculate brightness
	$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;

	// Return light or dark
	return ( $index < $brightness ) ? 'light' : 'dark';
}

/**
 * Convert time in minutes to ISO 8601
 *
 * @param int $minutes
 * @return string
 */
function wolf_core_format_minutes_to_iso( $minutes ) {

	$seconds        = $minutes * 60;
	$formatted_time = 'PT';
	$units          = array(
		'H' => 3600,
		'M' => 60,
	);

	foreach ( $units as $key => $unit ) {
		if ( $seconds >= $unit ) {
			$value           = floor( $seconds / $unit );
			$seconds        -= $value * $unit;
			$formatted_time .= $value . $key;
		}
	}

	return $formatted_time;
}

/**
 * Convert minutes to nice display time with hours
 *
 * @param int $minutes
 * @return string
 */
function wolf_core_format_minutes_to_text( $minutes ) {

	$seconds = $minutes * 60;
	$hours   = floor( $seconds / 3600 );
	$minutes = floor( ( $seconds / 60 ) % 60 );
	$seconds = $seconds % 60;
	return ( $hours > 0 ) ? sprintf( esc_html( '%d h %d mins', 'wolf-core' ), $hours, $minutes ) : sprintf( esc_html( '%d mins', 'wolf-core' ), $minutes );
}

if ( ! function_exists( 'wolf_core_get_user_country_code' ) ) {
	/**
	 * Get user country code
	 */
	function wolf_core_get_user_country_code() {

		if ( ! class_exists( 'WC_Geolocation' ) ) {
			return;
		}

		// Geolocation must be enabled @ Woo Settings
		$country_code = null;
		$location     = WC_Geolocation::geolocate_ip();
		$country      = $location['country'];

		return $country;
	}
}

if ( ! function_exists( 'wolf_core_user_country_code_is_in_eu' ) ) {
	/**
	 * Get user country code
	 */
	function wolf_core_user_country_code_is_in_eu( $country_code = null ) {

		$country_code = ( $country_code ) ? $country_code : wwcs_get_user_country_code();

		$eu_countries = array(
			'AT',
			'BE',
			'BG',
			'CY',
			'CZ',
			'DE',
			'DK',
			'EE',
			'ES',
			'FI',
			'FR',
			'GB',
			'GR',
			'HR',
			'HU',
			'IE',
			'IT',
			'LT',
			'LU',
			'LV',
			'MT',
			'NL',
			'PO',
			'PT',
			'RO',
			'SE',
			'SI',
			'SK',
		);

		if ( in_array( $country_code, $eu_countries, true ) ) {
			return true;
		} else {
			return false;
		}
	}
}

/**
 * Straight from VC
 *
 * @param $content The output content.
 * @param bool $autop Whether to strip p tag or not
 * @return string
 */
function wolf_core_js_remove_wpautop( $content, $autop = false ) {

	if ( $autop ) { // Possible to use !preg_match('('.WPBMap::getTagsRegexp().')', $content).
		$content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
	}

	return do_shortcode( shortcode_unautop( $content ) );
}

/**
 * Process link attribute to retrieve a standard array for both page builder
 *
 * @param array $atts The link attributes.
 * @return array|void
 */
function wolf_core_process_link_atts( $link_atts ) {

	$link = array(
		'url'    => '',
		'target' => '',
		'rel'    => '',
		'title'  => '',
	);

	if ( function_exists( 'vc_build_link' ) ) {

		$vc_link        = vc_build_link( $link_atts );
		$link['url']    = esc_url( $vc_link['url'] );
		$link['target'] = esc_attr( $vc_link['target'] );
		$link['rel']    = esc_attr( $vc_link['rel'] );
		$link['title']  = esc_attr( $vc_link['title'] );

	} elseif ( is_array( $link_atts ) ) {

		$link['url']    = esc_url( $link_atts['url'] );
		$link['target'] = ( isset( $link_atts['is_external'] ) && 'on' === $link_atts['is_external'] ) ? '_blank' : '_parent';
		$link['rel']    = ( isset( $link_atts['nofollow'] ) && 'on' === $link_atts['nofollow'] ) ? 'nofollow' : '';
		$link['title']  = '';
	}

	if ( isset( $link['url'] ) ) {
		return $link;
	}
}

/**
 * Format gallery image attributes
 *
 * @param mixed $images
 * @return string
 */
function wolf_core_process_gallery_atts( $images ) {

	if ( 'elementor' === wolf_core_get_plugin_in_use() && is_array( $images ) ) {

		$images_array = array();

		foreach ( $images as $image ) {
			$images_array[] = $image['id'];
		}

		$images = $images_array;

	} else {
		$images = wolf_core_list_to_array( $images );
	}

	return $images;
}

if ( ! function_exists( 'debug' ) ) {
	function debug( $var ) {
		echo '<br><pre class="wolf-core-debug">';
		print_r( $var );
		echo '</pre>';
	}
}

if ( ! function_exists( 'dd' ) ) {
	function dd( $var ) {
		echo '<br><pre class="wolf-core-debug">';
		print_r( $var );
		echo '</pre>';
		die();
	}
}
