<?php
/**
 * Pricing Table
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
function wolf_core_pricing_table( $atts ) {

	$atts = apply_filters(
		'wolf_core_pricing_table_atts',
		wp_parse_args(
			$atts,
			array(
				'title'                 => '',
				'title_tag'             => 'h3',
				'tagline'               => '',
				'price'                 => '',
				'currency'              => '',
				'display_currency'      => 'before',
				'offer'                 => '',
				'offer_price'           => '',
				'price_period'          => '',
				'button_text'           => '',
				'button_link'           => '',
				'secondary_button_text' => '',
				'secondary_button_link' => '',
				'link'                  => '',
				'featured'              => '',
				'featured_text'         => '',
				'services'              => '',
				'css_animation'         => '',
				'css_animation_delay'   => '',
				'el_class'              => '',
				'css'                   => '',
				'inline_style'          => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= ' wolf-core-pricing-table wolf-core-element';

	if ( 'yes' === $featured ) {
		$class .= ' wolf-core-pricing-table-featured';
	}

	if ( $featured_text ) {
		$class .= ' wolf-core-pricing-table-has-featured-text';
	}

	if ( $offer_price ) {
		$class .= ' wolf-core-pricing-table-has-offer';
	}

	$output = '<div class="' . wolf_core_sanitize_html_classes( $class ) . '" style="' . wolf_core_esc_style_attr( $inline_style ) . '"';

	$output .= wolf_core_element_aos_animation_data_attr( $atts );
	$output .= '>';

	if ( 'yes' === $featured && $featured_text ) {
		$output .= '<div class="wolf-core-pricing-table-featured-text">' . esc_attr( $featured_text ) . '</div>';
	}

	$output .= '<div class="wolf-core-pricing-table-inner">';

	$output .= '<header class="wolf-core-pricing-table-header">';

		$output .= '<div class="wolf-core-pricing-table-title-wrapper">';

			$output .= '<div class="wolf-core-pricing-table-tagline">';

			$output .= esc_attr( $tagline );

			$output .= '</div><!-- .wolf-pricing-table-tagline -->';

			$output .= '<div class="wolf-core-pricing-table-title">';

			$output .= "<$title_tag>" . esc_attr( $title ) . "</$title_tag>";

			$output .= '</div><!-- .wolf-pricing-table-title -->';

		$output .= '</div><!-- .wolf-pricing-table-title-wrapper -->';

		$output .= '<div class="wolf-core-pricing-table-price-wrapper">';

		// Offer.
	if ( $offer_price ) {

		$output .= '<del class="wolf-core-pricing-table-price-strike">';

		if ( $currency && 'before' === $display_currency ) {
			$output .= '<span class="wolf-core-pricing-table-price-currency-strike">' . esc_attr( $currency ) . '</span>';
		}

		$output .= esc_attr( $price );

		if ( $currency && 'after' === $display_currency ) {
			$output .= '<span class="wolf-core-pricing-table-price-currency-strike">' . esc_attr( $currency ) . '</span>';
		}

		$output .= '</del>';

		$output .= '<div class="wolf-core-pricing-table-price">';

		if ( $currency && 'before' === $display_currency ) {
			$output .= '<span class="wolf-core-pricing-table-price-currency">' . esc_attr( $currency ) . '</span>';
		}

		$output .= '<span class="wolf-core-pricing-table-price-value">' . esc_attr( $offer_price ) . '</span>';

		if ( $currency && 'after' === $display_currency ) {
			$output .= '<span class="wolf-core-pricing-table-price-currency">' . esc_attr( $currency ) . '</span>';
		}

		$output .= '</div>';
	} else {

		$output .= '<div class="wolf-core-pricing-table-price">';

		if ( $currency && 'before' === $display_currency ) {
			$output .= '<span class="wolf-core-pricing-table-price-currency">' . esc_attr( $currency ) . '</span>';
		}

		$output .= '<span class="wolf-core-pricing-table-price-value">' . esc_attr( $price ) . '</span>';

		if ( $currency && 'after' === $display_currency ) {
			$output .= '<span class="wolf-core-pricing-table-price-currency">' . esc_attr( $currency ) . '</span>';
		}

		$output .= '</div>';
	}

	if ( $price_period ) {
		$output .= '<div class="wolf-core-pricing-table-price-period">' . esc_attr( $price_period ) . '</div>';
	}

		$output .= '</div><!-- .wolf-pricing-table-price -->';

	$output .= '</header><!-- .wolf-pricing-table-header -->';

	$output .= '<section class="wolf-core-pricing-table-content">';

	if ( $services ) {
		$services = wolf_core_texarea_lines_to_array( $services );
		$output  .= '<ul>';

		foreach ( $services as $service ) {
			$output .= '<li>';
			$output .= do_shortcode( $service );
			$output .= '</li>';
		}

		$output .= '</ul>';
	}

	$output .= '</section><!-- .wolf-pricing-table-content -->';

	$output .= '<footer class="wolf-core-pricing-table-footer">';

	if ( $button_text ) {
		if ( is_array( $link ) && isset( $link['url'] ) ) {
			$url     = ( isset( $link['url'] ) ) ? esc_attr( $link['url'] ) : '#';
			$rel     = ( isset( $link['rel'] ) ) ? esc_attr( $link['rel'] ) : '';
			$target  = ( isset( $link['target'] ) ) ? esc_attr( $link['target'] ) : '';
			$title   = ( isset( $link['title'] ) ) ? esc_attr( $link['title'] ) : '';
			$output .= '<a rel="' . esc_attr( $rel ) . '" class="' . apply_filters( 'wolf_core_pricing_table_button_class', 'wolf-core-button wolf-core-pricing-table-secondary-button' ) . '"';
			$output .= ' target="' . esc_attr( $target ) . '"';
			$output .= ' href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '">';

			$output .= '<span>' . do_shortcode( $button_text ) . '</span>';

			$output .= '</a>';
		}
	}

	if ( $secondary_button_text ) {
		if ( is_array( $secondary_button_link ) && isset( $secondary_button_link['url'] ) ) {
			$url     = ( isset( $secondary_button_link['url'] ) ) ? esc_attr( $secondary_button_link['url'] ) : '#';
			$rel     = ( isset( $secondary_button_link['rel'] ) ) ? esc_attr( $secondary_button_link['rel'] ) : '';
			$target  = ( isset( $secondary_button_link['target'] ) ) ? esc_attr( $secondary_button_link['target'] ) : '';
			$title   = ( isset( $secondary_button_link['title'] ) ) ? esc_attr( $secondary_button_link['title'] ) : '';
			$output .= '<a rel="' . esc_attr( $rel ) . '" class="' . apply_filters( 'wolf_core_pricing_table_secondary_button_class', 'wolf-core-button wolf-core-pricing-table-secondary-button' ) . '"';
			$output .= ' target="' . esc_attr( $target ) . '"';
			$output .= ' href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '">';

			$output .= '<span>' . do_shortcode( $secondary_button_text ) . '</span>';

			$output .= '</a>';
		}
	}

	$output .= '</footer><!-- .wolf-pricing-table-footer -->';

	$output .= '</div><!-- .wolf-pricing-table-inner -->';
	$output .= '</div><!-- .wolf-pricing-table -->';

	return $output;
}
