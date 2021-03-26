<?php
/**
 * Heading settings
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Controls
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add additional params to Heading widget
 */
add_action(
	'elementor/element/heading/section_title/before_section_end',
	function( $element, $args ) {

		$element->remove_control( 'size' );

		$element->params = wolf_core_heading_params();

		wolf_core_convert_params_to_elementor( $element );
	},
	10,
	2
);

/**
 * Render Heading custom attributes
 */
add_action(
	'elementor/frontend/widget/before_render',
	function( $widget ) {

		// Make sure we are in a section element.
		if ( 'heading' !== $widget->get_name() ) {
			return;
		}

		$settings = $widget->get_active_settings();

		// debug( $settings );

		$style = '';
		$class = 'wolf-core-heading';

		$size        = ( isset( $settings['size'] ) ) ? $settings['size'] : '';
		$font_size   = ( isset( $settings['font_size'] ) ) ? $settings['font_size'] : '';
		$responsive  = ( isset( $settings['responsive'] ) ) ? $settings['responsive'] : '';
		$font_weight = ( isset( $settings['font_weight'] ) ) ? absint( $settings['font_weight'] ) : '';

		if ( isset( $settings['text_align_mobile'] ) && 'center' === $settings['text_align_mobile'] ) {
			$class .= ' wolf-core-mobile-text-align-center';
		}

		if ( 'yes' === $responsive ) {
			wp_enqueue_script( 'fittext' ); // enqueue fittext parallax scripts.
			wp_enqueue_script( 'wolf-core-fittext' );
			$class .= ' wolf-core-fittext';
		}

		if ( 'custom' === $size && $font_size ) {
			$class .= ' wolf-core-heading-custom-font-size';
			$style .= 'font-size:' . absint( $font_size ) . 'px;';
		}

		if ( $font_weight ) {
			$style .= 'font-weight:' . absint( $font_weight ) . ';';
		}

		if ( isset( $settings['letter_spacing'] ) && '' !== $settings['letter_spacing'] ) {
			$style .= 'letter-spacing:' . esc_attr( $settings['letter_spacing'] ) . ';';
		}

		if ( isset( $settings['line_height'] ) && '' !== $settings['line_height'] ) {
			$style .= 'line-height:' . esc_attr( $settings['line_height'] ) . ' ;';
		} else {
			$style .= 'line-height:1.5;';
		}

		if ( isset( $settings['font_family'] ) ) {
			$style .= 'font-family:' . esc_attr( $settings['font_family'] ) . ';';
		}

		if ( isset( $settings['text_transform'] ) && '' !== $settings['text_transform'] ) {
			$style .= 'text-transform:' . esc_attr( $settings['text_transform'] ) . ';';
		}

		if ( isset( $settings['font_style'] ) && '' !== $settings['font_style'] ) {
			$style .= 'font-style:' . esc_attr( $settings['font_style'] ) . ';';
		}

		$widget->add_render_attribute( '_wrapper', 'style', wolf_core_esc_style_attr( $style ) );
		$widget->add_render_attribute( '_wrapper', 'class', wolf_core_sanitize_html_classes( $class ) );

		if ( 'yes' === $responsive ) {
			if ( isset( $settings['font_size'] ) ) {
				$widget->add_render_attribute( '_wrapper', 'data-max-font-size', absint( $settings['font_size'] ) );
			}

			if ( isset( $settings['min_font_size'] ) ) {
				$widget->add_render_attribute( '_wrapper', 'data-min-font-size', absint( $settings['min_font_size'] ) );
			}
		}
	}
);

/**
 *  * Replace custom tags
 *
 * The only solution was to filter the whole content as there is no way to filter the default elementor settings output.
 *
 * @param string $content The frontend content.
 * @return string
 */
add_action(
	'elementor/frontend/the_content',
	function( $content ) {
		$post_title = wolf_core_get_post_title();
		$site_title = get_bloginfo( 'name' );

		$short_tags = array(
			'{{post_title}}' => $post_title,
			'{{page_title}}' => $post_title,
			'{{site_title}}' => $site_title,
		);

		foreach ( $short_tags as $key => $value ) {
			$content = preg_replace( "/$key/", $value, $content );
		}

		return $content;
	}
);
