<?php
/**
 * Countdown
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the countdown markup
 *
 * @param array $atts The countdown attributes.
 */
function wolf_core_countdown( $atts ) {

	$atts = apply_filters(
		'wolf_core_countdown_atts',
		wp_parse_args(
			$atts,
			array(
				'date'                     => '12/24/2024 12:00:00',
				'format'                   => 'dHMS',
				'custom_format'            => '',
				'offset'                   => -5,
				'message'                  => esc_html__( 'Done!', 'wolf-visual-composer' ),
				'font_family'              => '',
				'font_size'                => '',
				'font_weight'              => '',
				'text_transform'           => '',
				'font_style'               => '',
				'text_decoration'          => '',
				'line_height'              => '',
				'letter_spacing'           => '',
				'period_font_family'       => '',
				'period_font_size'         => '',
				'period_font_weight'       => '',
				'period_text_transform'    => '',
				'period_font_style'        => '',
				'period_text_decoration'   => '',
				'period_line_height'       => '',
				'period_letter_spacing'    => '',
				'number_font_color'        => '',
				'number_font_custom_color' => '',
				'text_font_color'          => '',
				'text_font_custom_color'   => '',
				'css_animation'            => '',
				'css_animation_delay'      => '',
				'el_class'                 => '',
				'css'                      => '',
				'inline_style'             => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	// wp_enqueue_script( 'countdown' );
	// wp_enqueue_script( 'wolf-core-countdown' );

	$output = '';

	$class = $el_class; // init container CSS class.

	$date    = esc_attr( $date );
	$offset  = esc_attr( $offset );
	$message = sanitize_text_field( $message );

	$rand_id = wp_rand( 0, 999 );
	$output  = '';

	/* Format date */
	$date        = wp_strip_all_tags( do_shortcode( $date ) );
	$format_date = explode( ' ', $date );
	$date        = $format_date[0];
	$hours       = $format_date[1];
	$date        = explode( '/', $date );
	$year        = $date[2];
	$month       = $date[0];
	$day         = $date[1];
	$hours       = explode( ':', $hours );
	$hour        = $hours[0];
	$min         = $hours[1];
	$sec         = $hours[2];

	// class.
	if ( 'custom' === $format && $custom_format ) {
		$format = $custom_format;
	}

	$format_class = sanitize_title_with_dashes( $format );
	$class       .= " wolf-core-countdown-container wolf-core-cd-$format_class wolf-core-clearfix wolf-core-element";

	$text_style       = 'color:#ffffff;';
	$text_style       = '';
	$text_class       = '';
	$amount_style_tag = '';
	$period_style_tag = '';

	$colors = wolf_core_get_shared_colors_hex();

	/* Amount color */
	if ( 'custom' === $number_font_color ) {
		$number_font_color = $number_font_custom_color;
	} else {
		$number_font_color = isset( $colors[ $number_font_color ] ) ? $colors[ $number_font_color ] : '';
	}

	if ( $number_font_color ) {
		$amount_style_tag .= 'color:' . wolf_core_sanitize_color( $number_font_color ) . ';';
	}

	/* Amount Font */
	if ( $font_family && 'default' !== $font_family ) {
		$font_family       = esc_attr( $font_family );
		$amount_style_tag .= "font-family:$font_family;";
	}

	if ( $font_weight ) {
		$font_weight       = absint( $font_weight );
		$amount_style_tag .= "font-weight:$font_weight;";
	}

	if ( $text_transform ) {
		$amount_style_tag .= 'text-transform:' . esc_attr( $text_transform ) . ';';
	}

	if ( $font_style ) {
		$amount_style_tag .= 'font-style:' . esc_attr( $font_style ) . ';';
	}

	if ( $text_decoration ) {
		$amount_style_tag .= 'text-decoration:' . esc_attr( $text_decoration ) . ';';
	}

	if ( $line_height && preg_match( '~[0-9]+~', $line_height ) ) {
		$amount_style_tag .= 'line-height:' . esc_attr( $line_height ) . ';';
	}

	if ( $letter_spacing && preg_match( '~[0-9]+~', $letter_spacing ) ) {
		$amount_style_tag .= 'letter-spacing:' . esc_attr( $letter_spacing ) . ';';
	}

	/* Amount style tag */
	if ( $amount_style_tag && ! wolf_core_is_elementor_editor() ) {
		// $output .= '<style>';
		if ( $font_size && preg_match( '~[0-9]+~', $font_size ) ) {
			// $font_size = wolf_core_sanitize_css_value( $font_size );
			// $output   .= "@media screen and (min-width: 1200px) { #wolf-core-countdown-$rand_id{ font-size:$font_size;} }";
		}
		// $output .= '#wolf-core-countdown-' . absint( $rand_id ) . ' .countdown-amount{ ' . $amount_style_tag . '}';
		// $output .= '</style>';
	}

	/* Period color */
	if ( 'custom' === $text_font_color ) {
		$text_font_color = $text_font_custom_color;
	} else {
		$text_font_color = isset( $colors[ $text_font_color ] ) ? $colors[ $text_font_color ] : '';
	}

	if ( $text_font_color ) {
		$period_style_tag .= 'color:' . wolf_core_sanitize_color( $text_font_color ) . ';';
	}

	/* Period Font */
	if ( $period_font_family && 'default' !== $period_font_family ) {
		$period_font_family = esc_attr( $period_font_family );
		$period_style_tag  .= "font-family:$period_font_family;";
	}

	if ( $period_font_size ) {
		$period_font_size  = absint( $period_font_size );
		$period_style_tag .= "font-size:$period_font_size;";
	}

	if ( $period_font_weight ) {
		$period_style_tag .= 'font-size:' . esc_attr( $period_text_transform ) . ';';
	}

	if ( $period_text_transform ) {
		$period_style_tag .= 'text-transform:' . esc_attr( $period_text_transform ) . ';';
	}

	if ( $period_font_style ) {
		$period_style_tag .= 'font-style:' . esc_attr( $period_font_style ) . ';';
	}

	if ( $period_text_decoration ) {
		$period_style_tag .= 'text-decoration:' . esc_attr( $period_text_decoration ) . ';';
	}

	if ( $period_line_height ) {
		$period_style_tag .= 'line-height:' . esc_attr( $period_line_height ) . ';';
	}

	/* Period style tag */
	if ( $period_style_tag && ! wolf_core_is_elementor_editor() ) {
		// $output .= '<style>';
		// $output .= '#wolf-core-countdown-' . absint( $rand_id ) . ' .countdown-period{ ' . $period_style_tag . '}';
		// $output .= '</style>';
	}

	$output .= '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';
	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';
	$output .= '<div
		data-format="' . esc_attr( $format ) . '"
		data-year="' . absint( $year ) . '"
		data-month="' . absint( $month ) . '"
		data-day="' . absint( $day ) . '"
		data-hour="' . absint( $hour ) . '"
		data-min="' . absint( $min ) . '"
		data-sec="' . absint( $sec ) . '"
		data-offset="' . intval( $offset ) . '"
		class="wolf-core-countdown ' . wolf_core_sanitize_html_classes( $text_class ) . '" id="wolf-core-countdown-' . absint( $rand_id ) . '" style="' . wolf_core_esc_style_attr( $text_style ) . '"></div>';
	$output .= '</div>';

	return $output;
}
