<?php
/**
 * Testimonial Slider
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the element markup
 *
 * @param array $atts The element attributes.
 */
function wolf_core_testimonial_slider( $atts ) {

	$atts = apply_filters(
		'wolf_core_testimonial_slider_atts',
		wp_parse_args(
			$atts,
			array(
				'autoplay'            => 'yes',
				'transition'          => 'slide',
				'slideshow_speed'     => 4000,
				'group_cells'         => 0,
				'pause_on_hover'      => 'yes',
				'nav_bullets'         => 'yes',
				'nav_arrows'          => 'yes',
				'contain'             => 'yes',
				'arrows_color'        => '',
				'dots_color'          => '',
				'testimonials'        => array(),
				'css_animation'       => '',
				'css_animation_delay' => '',
				'el_class'            => '',
				'css'                 => '',
				'inline_style'        => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	if ( 'vc' === wolf_core_get_plugin_in_use() ) {
		wp_enqueue_script( 'flickity' );
		wp_enqueue_script( 'wolf-core-carousels' );
	}

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-testimonial-slider-container wolf-core-element';

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	$slider_data = "data-pause-on-hover='$autoplay'
		data-autoplay='$autoplay'
		data-transition='$transition'
		data-slideshow-speed='$slideshow_speed'
		data-arrows-color='$arrows_color'
		data-dots-color='$dots_color'
		data-nav-arrows='$nav_arrows'
		data-contain='$contain'
		data-nav-bullets='$nav_bullets'";

	if ( $group_cells && 1 < absint( $group_cells ) ) {
		$slider_data .= " data-groupcells='$group_cells'";

		$class .= ' wolf-core-testimonial-slider-groupcells';
	}

	$output .= "<div $slider_data class='wolf-core-testimonial-slider'>";

	foreach ( $testimonials as $testimonial ) {

		$output .= '<div class="wolf-core-testimonal-slide">';

		$output .= '<div class="wolf-core-blockquote-inner">';

		$testimonial = extract(
			apply_filters(
				'wolf_core_testimonial_atts',
				wp_parse_args(
					$testimonial,
					array(
						'text'    => '',
						'tagline' => '',
						'cite'    => '',
						'role'    => '',
						'avatar'  => '',
						'rating'  => '',
					)
				)
			)
		);

		if ( is_array( $avatar ) && isset( $avatar['id'] ) ) {
			$avatar = $avatar['id'];
		}

		if ( $tagline ) {
			$output .= '<div class="wolf-core-blockquote-tagline">';
			$output .= $tagline;
			$output .= '</div><!--.wolf-core-blockquote-tagline-->';
		}

		if ( $text ) {
			$output .= '<div class="wolf-core-blockquote-text">';
			$output .= '<blockquote>';
			$output .= $text;
			$output .= '</blockquote>';
			$output .= '</div><!--.wolf-core-blockquote-text-->';
		}

		if ( $avatar || $cite ) {
			$output .= '<div class="wolf-core-blockquote-author">';
		}

		if ( $avatar ) {

			$output .= '<div class="wolf-core-blockquote-avatar">';

			if ( wp_attachment_is_image( $avatar ) ) {
				$output .= wp_get_attachment_image( $avatar, 'thumbnail', false );
			} else {
				$output .= wolf_core_placeholder_img( 'thumbnail' );
			}

			$output .= '</div><!--.wolf-core-blockquote-avatar-->';

		}

		if ( $cite ) {
			$output .= '<cite class="wolf-core-blockquote-cite">';
			$output .= $cite;
			$output .= '</cite><!--.wolf-core-blockquote-cite-->';
		}

		if ( $role ) {
			$output .= '<role class="wolf-core-blockquote-role">';
			$output .= $role;
			$output .= '</role><!--.wolf-core-blockquote-role-->';
		}

		if ( $avatar || $cite ) {
			$output .= '</div><!--.wolf-core-blockquote-author-->';
		}

		$output .= '</div><!--.wolf-core-blockquote-inner-->';
		$output .= '</div><!--.wolf-core-blockquote-->';
	}

	$output .= '</div></div><!--.wolf-core-testimonial-slider-->';

	return $output;
}
