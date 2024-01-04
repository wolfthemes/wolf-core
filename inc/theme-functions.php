<?php
/**
 * Wolf Core theme specifig functions
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add event type tax
 */
function unimate_add_event_type_taxonomy() {

	$theme_slug = esc_attr( sanitize_title_with_dashes( get_template() ) );

	if ( 'unimate' !== $theme_slug && 'wolf-supertheme' !== $theme_slug ) {
		return;
	}

	$labels = array(
		'name'                       => esc_html__( 'Types', '%TEXTDOMAIN%' ),
		'singular_name'              => esc_html__( 'Type', '%TEXTDOMAIN%' ),
		'search_items'               => esc_html__( 'Search Types', '%TEXTDOMAIN%' ),
		'popular_items'              => esc_html__( 'Popular Types', '%TEXTDOMAIN%' ),
		'all_items'                  => esc_html__( 'All Types', '%TEXTDOMAIN%' ),
		'parent_item'                => esc_html__( 'Parent Type', '%TEXTDOMAIN%' ),
		'parent_item_colon'          => esc_html__( 'Parent Type:', '%TEXTDOMAIN%' ),
		'edit_item'                  => esc_html__( 'Edit Type', '%TEXTDOMAIN%' ),
		'update_item'                => esc_html__( 'Update Type', '%TEXTDOMAIN%' ),
		'add_new_item'               => esc_html__( 'Add New Type', '%TEXTDOMAIN%' ),
		'new_item_name'              => esc_html__( 'New Type', '%TEXTDOMAIN%' ),
		'separate_items_with_commas' => esc_html__( 'Separate types with commas', '%TEXTDOMAIN%' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove types', '%TEXTDOMAIN%' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used types', '%TEXTDOMAIN%' ),
		'not_found'                  => esc_html__( 'No types found', '%TEXTDOMAIN%' ),
		'menu_name'                  => esc_html__( 'Types', '%TEXTDOMAIN%' ),
	);

	$args = array(
		'labels'                => $labels,
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'query_var'             => true,
		'update_count_callback' => '_update_post_term_count',
		'rewrite'               => array(
			'slug'       => 'event-type',
			'with_front' => false,
		),
	);

	register_taxonomy( 'we_type', array( 'event' ), $args );
}
add_action( 'init', 'unimate_add_event_type_taxonomy' );
