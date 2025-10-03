<?php
/**
 * Wolf Core image functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/FRontend
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * From WPBPB
 *
 * @param  array $params the arrray for parameters.
 * @return array|bool
 * @since 4.2
 * vc_filter: vc_wpb_getimagesize - to override output of this function
 */
function wolf_core_get_img_by_size( $params = array() ) {
	$params = array_merge(
		array(
			'post_id'    => null,
			'attach_id'  => null,
			'thumb_size' => 'thumbnail',
			'class'      => '',
		),
		$params
	);

	if ( ! $params['thumb_size'] ) {
		$params['thumb_size'] = 'thumbnail';
	}

	if ( ! $params['attach_id'] && ! $params['post_id'] ) {
		return false;
	}

	$post_id = $params['post_id'];

	$attach_id   = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
	$attach_id   = apply_filters( 'wolf_core_object_id', $attach_id );
	$thumb_size  = $params['thumb_size'];
	$thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';

	global $_wp_additional_image_sizes;
	$thumbnail = '';

	$sizes = array(
		'thumbnail',
		'thumb',
		'medium',
		'large',
		'full',
	);

	if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, $sizes, true ) ) ) {
		$attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );

		$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );

	} elseif ( $attach_id ) {

		if ( is_string( $thumb_size ) ) {
			preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
			if ( isset( $thumb_matches[0] ) ) {
				$thumb_size = array();
				$count      = count( $thumb_matches[0] );
				if ( $count > 1 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width.
					$thumb_size[] = $thumb_matches[0][1]; // height.
				} elseif ( 1 === $count ) {
					$thumb_size[] = $thumb_matches[0][0]; // width.
					$thumb_size[] = $thumb_matches[0][0]; // height.
				} else {
					$thumb_size = false;
				}
			}
		}

		if ( is_array( $thumb_size ) ) {

			// Resize image to custom size.
			$p_img      = wolf_core_resize_image( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
			$alt        = trim( wp_strip_all_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
			$attachment = get_post( $attach_id );
			if ( ! empty( $attachment ) ) {
				$title = trim( wp_strip_all_tags( $attachment->post_title ) );

				if ( empty( $alt ) ) {
					$alt = trim( wp_strip_all_tags( $attachment->post_excerpt ) ); // If not, use the caption.
				}
				if ( empty( $alt ) ) {
					$alt = $title;
				}
				if ( $p_img ) {

					$attributes = wolf_core_stringify_attributes(
						array(
							'class'  => $thumb_class,
							'src'    => $p_img['url'],
							'width'  => $p_img['width'],
							'height' => $p_img['height'],
							'alt'    => $alt,
							'title'  => $title,
						)
					);

					$thumbnail = '<img ' . $attributes . ' />';
				}
			}
		}
	}

	$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );

	return apply_filters(
		'vc_wpb_getimagesize', // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals
		array(
			'thumbnail'   => $thumbnail,
			'p_img_large' => $p_img_large,
		),
		$attach_id,
		$params
	);
}

if ( ! function_exists( 'wolf_core_resize_image' ) ) {
	/**
	 * Resize images dynamically using wp built in functions
	 * Victor Teixeira
	 *
	 * @param int    $attach_id attachment ID.
	 * @param string $img_url image URL.
	 * @param int    $width width.
	 * @param int    $height height.
	 * @param bool   $crop crop or not.
	 *
	 * @return array
	 * @since 4.2
	 */
	function wolf_core_resize_image( $attach_id, $img_url, $width, $height, $crop = false ) {
		// This is an attachment, so we have the ID.
		$image_src = array();
		if ( $attach_id ) {
			$image_src        = wp_get_attachment_image_src( $attach_id, 'full' );
			$actual_file_path = get_attached_file( $attach_id );
			// This is not an attachment, let's use the image url.
		} elseif ( $img_url ) {
			$file_path        = wp_parse_url( $img_url );
			$actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
			$orig_size        = getimagesize( $actual_file_path );
			$image_src[0]     = $img_url;
			$image_src[1]     = $orig_size[0];
			$image_src[2]     = $orig_size[1];
		}
		if ( ! empty( $actual_file_path ) ) {
			$file_info = pathinfo( $actual_file_path );
			$extension = '.' . $file_info['extension'];

			// the image path without the extension.
			$no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

			// checking if the file size is larger than the target size.
			// if it is smaller or the same size, stop right here and return.
			if ( $image_src[1] > $width || $image_src[2] > $height ) {

				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match).
				if ( file_exists( $cropped_img_path ) ) {
					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
					$vt_image        = array(
						'url'    => $cropped_img_url,
						'width'  => $width,
						'height' => $height,
					);

					return $vt_image;
				}

				if ( ! $crop ) {
					// calculate the size proportionaly.
					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
					$resized_img_path  = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

					// checking if the file already exists.
					if ( file_exists( $resized_img_path ) ) {
						$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

						$vt_image = array(
							'url'    => $resized_img_url,
							'width'  => $proportional_size[0],
							'height' => $proportional_size[1],
						);

						return $vt_image;
					}
				}

				// no cache files - let's finally resize it.
				$img_editor = wp_get_image_editor( $actual_file_path );

				if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
					return array(
						'url'    => '',
						'width'  => '',
						'height' => '',
					);
				}

				$new_img_path = $img_editor->generate_filename();

				if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
					return array(
						'url'    => '',
						'width'  => '',
						'height' => '',
					);
				}
				if ( ! is_string( $new_img_path ) ) {
					return array(
						'url'    => '',
						'width'  => '',
						'height' => '',
					);
				}

				$new_img_size = getimagesize( $new_img_path );
				$new_img      = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

				// resized output.
				$vt_image = array(
					'url'    => $new_img,
					'width'  => $new_img_size[0],
					'height' => $new_img_size[1],
				);

				return $vt_image;
			}

			// default output - without resizing.
			$vt_image = array(
				'url'    => $image_src[0],
				'width'  => $image_src[1],
				'height' => $image_src[2],
			);

			return $vt_image;
		}

		return false;
	}
}

/**
 * Convert array of named params to string version
 * All values will be escaped
 *
 * E.g. f(array('name' => 'foo', 'id' => 'bar')) -> 'name="foo" id="bar"'
 *
 * @param  array $attributes the attributes array.
 * @return string
 */
function wolf_core_stringify_attributes( $attributes ) {
	$atts = array();
	foreach ( $attributes as $name => $value ) {
		$atts[] = $name . '="' . esc_attr( $value ) . '"';
	}

	return implode( ' ', $atts );
}
