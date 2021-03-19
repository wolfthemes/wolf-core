<?php
/**
 * Wolf Core Extension Template Functions
 *
 * Action/filter functions used for Wolf Core Extension functions/templates
 *
 * @author WolfThemes
 * @category Frontend
 * @package WolfCore/Frontend
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output generator tag to aid debugging.
 */
function wolf_core_generator_tag( $gen, $type ) {
	switch ( $type ) {
		case 'html':
			$gen .= "\n" . '<meta name="generator" content="WolfCore ' . esc_attr( WOLF_CORE_VERSION ) . '">';
			break;
		case 'xhtml':
			$gen .= "\n" . '<meta name="generator" content="WolfCore ' . esc_attr( WOLF_CORE_VERSION ) . '" />';
			break;
	}
	return $gen;
}


/**
 * Add body classes for WPB pages
 *
 * @param  array $classes The body classes array.
 * @return array
 */
function wolf_core_body_class( $classes ) {

	$classes = (array) $classes;

	$classes[] = 'wolf-core';

	if ( wolf_core_is_page_builder_page() ) {

		$classes[] = 'wolf-core-layout';

		if ( 'vc' === wolf_core_get_plugin_in_use() ) {
			$classes[] = 'wolf-core-vc';
		}

		if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
			$classes[] = 'wolf-core-elementor';
		}

		$classes[] = 'wolf-core-' . str_replace( '.', '-', WOLF_CORE_VERSION );
		$classes[] = sanitize_title_with_dashes( get_template() ); // theme slug.

		if ( get_post_meta( get_the_ID(), '_post_scroller', true ) ) {
			$classes[] = 'wolf-core-one-pager';
		}

		if ( wolf_core_is_edge() ) {
			$classes[] = 'wolf-core-is-edge';
		} else {
			$classes[] = 'wolf-core-not-edge';
		}

		if ( wolf_core_is_firefox() ) {
			$classes[] = 'wolf-core-is-firefox';
		} else {
			$classes[] = 'wolf-core-not-firefox';
		}

		if ( wolf_core_do_fullpage() ) {
			$classes[] = 'wolf-core-fullpage';
			$classes[] = 'wolf-core-fullpage-slide';
		}
	}

	return $classes;
}

/**
 * Breadcrumb function
 */
function wolf_core_get_breadcrumb() {

	global $post, $wp_query;

	$output = '';

	if ( ! is_front_page() ) {

		$position  = 1;
		$delimiter = '<span class="wolf-core-breadcrumb-delimiter">' . apply_filters( 'wolf_core_breadcrumb_delimiter', '/' ) . '</span>';
		$before    = '';
		$after     = '';

		$output .= '<ol class="wolf-core-breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">';

		$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a
       itemprop="item" href="';
		$output .= esc_url( home_url( '/' ) );
		$output .= '"><span itemprop="name">';
		// $output .= esc_html__( 'Home', 'wolf-visual-composer' );
		if ( get_option( 'page_on_front' ) ) {
			$output .= get_the_title( get_option( 'page_on_front' ) );
		} else {
			$output .= esc_html__( 'Home', 'wolf-visual-composer' );
		}
		$output .= "</span></a><meta itemprop='position' content='" . $position++ . "' /></li>$delimiter";

		if ( 'post' == get_post_type() && ! wolf_core_is_blog_index() ) {

			$output     .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . wolf_core_get_blog_url() . '"><span itemprop="name">' . get_the_title( get_option( 'page_for_posts' ) ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;
		}

		if ( wolf_core_is_woocommerce_page() && is_shop() ) {
			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">';
			$output .= get_the_title( wolf_core_get_woocommerce_shop_page_id() );
			$output .= '</span><meta itemprop="position" content="' . $position++ . '" /></li>';
		}

		if ( wolf_core_is_woocommerce_page() && is_product_category() ) {

			$shop_page_id = wc_get_page_id( 'shop' );

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '" ><span itemprop="name">' . get_the_title( $shop_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;

			$current_term = $wp_query->get_queried_object();
			$ancestors    = array_reverse( get_ancestors( $current_term->term_id, 'product_cat' ) );

			foreach ( $ancestors as $ancestor ) {

				$ancestor = get_term( $ancestor, 'product_cat' );

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_term_link( $ancestor ) . '"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;
			}

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $before . esc_html( $current_term->name ) . $after ) . '</span><meta itemprop="position" content="' . $position++ . '" /></li>';

		} elseif ( wolf_core_is_woocommerce_page() && is_product_tag() ) {

			$shop_page_id = wc_get_page_id( 'shop' );
			$output      .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( $shop_page_id ) . '"><span itemprop="name">' . get_the_title( $shop_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;

			$queried_object = $wp_query->get_queried_object();

			$output .= $before . esc_html__( 'Products tagged &ldquo;', 'wolf-visual-composer' ) . $queried_object->name . '&rdquo;' . $after;

		} elseif ( wolf_core_is_woocommerce_page() && ! is_singular( 'product' ) && ! is_shop() ) {

			$shop_page_id = wc_get_page_id( 'shop' );
			$output      .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '"><span itemprop="name">' . get_the_title( $shop_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
			$output      .= $delimiter;
		}

		if ( is_category() ) {

			$cat_obj       = $wp_query->get_queried_object();
			$this_category = get_category( $cat_obj->term_id );

			if ( 0 != $this_category->parent ) {
				$parent_category = get_category( $this_category->parent );
				if ( ( $parents = get_category_parents( $parent_category, true, $after . $delimiter . $before ) ) && ! is_wp_error( $parents ) ) {

					$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $before . rtrim( $parents, $after . $delimiter . $before ) . $after ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;
				}
			}

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $before . single_cat_title( '', false ) . $after ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>';

		} elseif ( is_tag() ) {

			$output .= get_the_tag_list( '', $delimiter );

		} elseif ( is_author() ) {

			$output .= get_the_author();

		} elseif ( is_day() ) {

			$output .= get_the_date();

		} elseif ( is_month() ) {

			$output .= get_the_date( 'F Y' );

		} elseif ( is_year() ) {

			$output .= get_the_date( 'Y' );

		} elseif ( is_tax( 'work_type' ) ) {

			$portfolio_page_id = wolf_portfolio_get_page_id();
			$output           .= '<a href="' . get_permalink( $portfolio_page_id ) . '">' . get_the_title( $portfolio_page_id ) . '</a>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $wp_query->queried_object->name ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" />';
			}
		} elseif ( is_tax( 'gallery_type' ) ) {

			$albums_page_id = wolf_albums_get_page_id();
			$output        .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item href="' . get_permalink( $albums_page_id ) . '"><span itemprop="name">' . get_the_title( $albums_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $wp_query->queried_object->name ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>';
			}
		} elseif ( is_tax( 'video_type' ) ) {

			$videos_page_id = wolf_videos_get_page_id();
			$output        .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item href="' . get_permalink( $videos_page_id ) . '"><span itemprop="name">' . get_the_title( $videos_page_id ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $wp_query->queried_object->name ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" />';
			}
		} elseif ( is_tax( 'plugin_cat' ) ) {

			$plugins_page_id = wolf_plugins_get_page_id();
			$output         .= '<a href="' . get_permalink( $plugins_page_id ) . '">' . get_the_title( $plugins_page_id ) . '</a>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= sanitize_text_field( $wp_query->queried_object->name );

			}
		} elseif ( is_tax( 'theme_cat' ) ) {

			$themes_page_id = wolf_themes_get_page_id();
			$output        .= '<a href="' . get_permalink( $themes_page_id ) . '">' . get_the_title( $themes_page_id ) . '</a>' . $delimiter;

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= esc_attr( $wp_query->queried_object->name );

			}
		} elseif ( is_tax() && ! is_tax( 'product_cat' ) && ! is_tax( 'product_tag' ) ) {

			$the_tax = get_taxonomy( get_query_var( 'taxonomy' ) );
			if ( $the_tax && $wp_query && isset( $wp_query->queried_object->name ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . esc_attr( $wp_query->queried_object->name ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>';

			}
		} elseif ( is_search() ) {

			if ( wolf_core_is_woocommerce_page() ) {
				$output .= $delimiter;
			}

			// $output .= '<a href="' . get_permalink( $post->post_parent ) . '">';
			$output .= esc_html__( 'Search', 'wolf-visual-composer' );
		}

		if ( is_attachment() ) {

			esc_html_e( 'Attachment', 'wolf-visual-composer' );

			$output .= $delimiter;

			$output .= empty( $post->post_parent ) ? get_the_title() : '<a href="' . get_permalink( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a>' . $delimiter . get_the_title();

		} elseif ( is_page() ) {

			if ( ! empty( $post->post_parent ) && ! wolf_core_is_woocommerce_page() ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( $post->post_parent ) . '"><span itemprop="name">' . get_the_title( $post->post_parent ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;

			}

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . get_the_title() . '</span><meta itemprop="position" content="' . $position++ . '" /></li>';

		} elseif ( is_search() ) {

			$output .= $delimiter;

			$output .= ( isset( $_GET['s'] ) ) ? esc_attr( $_GET['s'] ) : esc_html__( 'Search results', 'wolf-visual-composer' );
		}

		if ( is_single() ) {

			if ( is_singular( 'work' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_portfolio_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_portfolio_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;

				$output .= get_the_term_list( $post->ID, 'work_type', '', $delimiter, '' );

				if ( has_term( '', 'work_type' ) ) {
					$output .= $delimiter;
				}
			} elseif ( is_singular( 'video' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_videos_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_videos_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;

				$output .= get_the_term_list( $post->ID, 'video_type', '', $delimiter, '' );

				if ( has_term( '', 'video_type' ) ) {
					$output .= $delimiter;
				}
			} elseif ( is_singular( 'gallery' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_albums_get_page_id() ) . '"><span itemprop="name"' . get_the_title( wolf_albums_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';

				$output .= $delimiter;

				$output .= get_the_term_list( $post->ID, 'gallery_type', '', $delimiter, '' );

				if ( has_term( '', 'gallery_type' ) ) {

					$output .= $delimiter;
				}
			} elseif ( is_singular( 'plugin' ) ) {

				$output .= '<a href="' . get_permalink( wolf_plugins_get_page_id() ) . '">' . get_the_title( wolf_plugins_get_page_id() ) . '</a>';
				$output .= $delimiter;

				$output .= get_the_term_list( $post->ID, 'plugin_cat', '', $delimiter, '' );

				// if ( has_term( '', 'plugin_cat' ) ) {
					$output .= $delimiter;
				// }

			} elseif ( is_singular( 'product' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wc_get_page_id( 'shop' ) ) . '"><span itemprop="name">' . get_the_title( wc_get_page_id( 'shop' ) ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';

				$output .= $delimiter;

				if ( $terms = wc_get_product_terms(
					$post->ID,
					'product_cat',
					array(
						'orderby' => 'parent',
						'order'   => 'DESC',
					)
				) ) {
					$main_term = $terms[0];
					$ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
					$ancestors = array_reverse( $ancestors );

					foreach ( $ancestors as $ancestor ) {
						$ancestor = get_term( $ancestor, 'product_cat' );

						if ( ! is_wp_error( $ancestor ) && $ancestor ) {
							$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_term_link( $ancestor ) . '"><span itemprop="name">' . $ancestor->name . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>' . $delimiter;
						}
					}

					$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_term_link( $main_term ) . '"><span itemprop="name">' . $main_term->name . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>' . $delimiter;
				}
			} elseif ( is_singular( 'event' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item href="' . get_permalink( wolf_events_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_events_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>';
				$output .= $delimiter;

				// $output .= '<a href="' . get_permalink( get_the_ID() ) . '">' . get_the_title( get_the_ID() ) . '</a>';
				// $output .= $delimiter;

				// $output .= get_the_term_list( $post->ID, 'gallery_type', '', $delimiter, '');

				// if ( has_term( '', 'gallery_type' ) )
				// $output .= $delimiter;

			} elseif ( is_singular( 'release' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_discography_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_discography_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>';

				if ( has_term( '', 'band' ) ) {
					$output .= $delimiter;
				}

				$output .= get_the_term_list( $post->ID, 'band', '', $delimiter, '' );

				// if ( has_term( '', 'band' ) ) {
					$output .= $delimiter;
				// }

			} elseif ( is_singular( 'artist' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . get_permalink( wolf_artists_get_page_id() ) . '"><span itemprop="name">' . get_the_title( wolf_artists_get_page_id() ) . '</span></a><meta itemprop="position" content="' . $position++ . '" /><li>';

				if ( has_term( '', 'artist_genre' ) ) {
					$output .= $delimiter;
				}

				$output .= get_the_term_list( $post->ID, 'artist_genre', '', $delimiter, '' );

				// if ( has_term( '', 'band' ) ) {
					$output .= $delimiter;
				// }

			} elseif ( is_singular( 'wolf_core_content_block' ) ) {

				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><span itemprop="name">' . esc_html__( 'Content Block', 'wolf-visual-composer' ) . '</span>
    <meta itemprop="position" content="' . $position++ . '" /></li>';

				$output .= $delimiter;

			} elseif ( is_singular( 'wpm_playlist' ) ) {

				$output .= esc_html__( 'Playlists', 'wolf-visual-composer' );
				$output .= $delimiter;

			} else {
				$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . wolf_core_get_first_category_url() . '"><span itemprop="name">' . wolf_core_get_first_category() . '</span></a><meta itemprop="position" content="' . $position++ . '" /></li>';
				$output .= $delimiter;
			}

			$output .= '<li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem"><span itemprop="name">' . wolf_core_sample( get_the_title(), 10 ) . '</span><meta itemprop="position" content="' . $position++ . '" /></lI>';

		} elseif (
			$wp_query && isset( $wp_query->queried_object->ID )
			&& $wp_query->queried_object->ID == get_option( 'page_for_posts' )
		) {

			$output .= '<li itemprop="itemListElement" itemscope
      				itemtype="https://schema.org/ListItem"><span itemprop="name">' . sanitize_text_field( $wp_query->queried_object->post_title ) . '</span><meta itemprop="position" content="' . $position++ . '" /></lI>';
		}

		$output .= '</ol>';
	}

	return $output;
}
