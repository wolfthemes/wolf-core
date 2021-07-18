<?php
/**
 * Textual showcase
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
function wolf_core_textual_showcase( $atts ) {

	$atts = apply_filters(
		'wolf_core_textual_showcase_atts',
		wp_parse_args(
			$atts,
			array(
				'items' => array(),
				'font_family'    => '',
				'letter_spacing' => '',
				'font_weight'    => '',
				'text_transform' => '',
				'font_style'     => '',
				'type'           => '',
				'el_class'       => '',
				'css'            => '',
				'inline_style'   => '',
			)
		)
	);

	extract( $atts ); // phpcs:ignore

	$item_class = '';
	$item_style = '';
	$link_start   = '';
	$link_end     = '';

	$output = '';

	$class = $el_class; // init container CSS class.

	$class .= " wolf-core-textual-showcase wolf-core-element";

	$single_animation_delay = ( $css_animation_delay ) ? $css_animation_delay : 0;

	if ( ! wolf_core_is_new_animation( $css_animation ) ) {
		$figure_style = 'animation-delay:' . absint( $single_animation_delay ) . 'ms;';
	}

	$uncover_animations = array(
		'uncoverXLeft',
		'uncoverXRight',
		'uncoverYTop',
		'uncoverYBottom',
	);

	$add_delay = ( in_array( $css_animation, $uncover_animations, true ) ) ? 300 : 200;

	foreach ( $items as $item ) {

		$single_animation_delay = $single_animation_delay + $add_delay;

		$item = extract( // phpcs:ignore
			apply_filters(
				'wolf_core_textual_showcase_item_atts',
				wp_parse_args(
					$item,
					array(
						'type'    => 'text',
						'text'    => '',
						'image' => '',
						'video' => '',
					)
				)
			)
		);

		if ( $css_animation_each ) {
			$force                       = ( 'elementor' === wolf_core_get_plugin_in_use() ) ? true : false;
			$atts['css_animation_delay'] = $single_animation_delay;
			$output                     .= wolf_core_element_aos_animation_data_attr( $atts, $force );
		}

		$content = do_shortcode( $text );

		if ( 'image' === $type ) {
			if ( is_array( $image ) && isset( $image['id'] ) ) {
				$image = $image['id'];
			}

			if ( is_array( $image_hover ) && isset( $image_hover['id'] ) ) {
				$image_hover = $image_hover['id'];
			}
		}

		$output .= '<span class="wolf-core-textual-showcase-item-' . esc_attr( $type ) . '" style="' . esc_attr(  ) . '">' . $content . '</span>';
	}

	return $output;
}
