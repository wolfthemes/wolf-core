<?php
/**
 * Work Cateogry Marquee
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 * @link https://tympanus.net/Tutorials/MarqueeMenu/
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the element markup
 *
 * @param array $atts The element attributes.
 */
function wolf_core_work_category_marquee( $atts ) {

	$atts = apply_filters(
		'wolf_core_work_category_marquee_atts',
		wp_parse_args(
			$atts,
			array(
				'count'   => 0,
				'orderby' => 'count',
				'order'   => 'DESC',
				'include' => '',
				'exclude' => '',
			)
		)
	);

	wp_enqueue_script( 'wolf-core-category-marquee' );

	extract( $atts ); // phpcs:ignore

	$output = '';

	$class = $el_class; // init container CSS class.

	/* Get taxonomy */
	$cat_args = array(
		'orderby'    => $orderby,
		'order'      => $order,
		'taxonomy'   => 'work_type',
		// 'parent' => $parent,
		'hide_empty' => 0,
	);

	if ( $include ) {
		$cat_args['include'] = $include_ids;
	}

	if ( $exclude ) {
		$cat_args['exclude'] = $exclude_ids;
	}

	$terms = get_terms( $cat_args );
	$i     = 0;

	$output .= '<div class="work-category-marquee-container"> <nav class="work-category-marquee">';

	foreach ( $terms as $term ) {
		if ( $count && $i == $count ) {
			break;
		}

		$link      = get_term_link( $term );
		$cat_title = $term->name;
		$cat_id    = $term->term_id;

		$output .= '<div class="work-category-marquee-item"> <a class="work-category-marquee-item-link" href="' . esc_url( $link ) . '">' . esc_attr( $cat_title ) . '</a>';

		$output .= '<div class="work-category-marquee-item-marquee"><div class="work-category-marquee-item-marquee__inner-wrap"><div class="work-category-marquee-item-marquee__inner" aria-hidden="true">';

		$args = array(
			'posts_per_page' => 8,
			'post_type'      => 'work',
			'work_type'      => $term->slug,
			'post_status'    => array( 'publish' ),
			'meta_key'       => '_thumbnail_id',
		);

		global $wp_query;
		$query = new WP_Query( $args );

		while ( $query->have_posts() ) {
			$query->the_post();
			$output .= '<span>' . get_the_title() . '</span>';
			$output .= '<div class="work-category-marquee-item-marquee__img" style="background-image:url(' . get_the_post_thumbnail_url() . ');"></div>';
		}

		while ( $query->have_posts() ) {
			$query->the_post();
			$output .= '<span>' . get_the_title() . '</span>';
			$output .= '<div class="work-category-marquee-item-marquee__img" style="background-image:url(' . get_the_post_thumbnail_url() . ');"></div>';
		}

		while ( $query->have_posts() ) {
			$query->the_post();
			$output .= '<span>' . get_the_title() . '</span>';
			$output .= '<div class="work-category-marquee-item-marquee__img" style="background-image:url(' . get_the_post_thumbnail_url() . ');"></div>';
		}

		while ( $query->have_posts() ) {
			$query->the_post();
			$output .= '<span>' . get_the_title() . '</span>';
			$output .= '<div class="work-category-marquee-item-marquee__img" style="background-image:url(' . get_the_post_thumbnail_url() . ');"></div>';
		}

		$output .= '</div></div></div></div>';
	}

	$output .= '</nav></div>';

	return $output;
}
