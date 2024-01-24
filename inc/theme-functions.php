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
 * Unimate Add event type tax
 */
function unimate_add_event_type_taxonomy() {

	$theme_slug = esc_attr( sanitize_title_with_dashes( get_template() ) );

	if ( 'unimate' !== $theme_slug && 'wolf-supertheme' !== $theme_slug ) {
		return;
	}

	$labels = array(
		'name'                       => esc_html__( 'Types', 'wolf-core' ),
		'singular_name'              => esc_html__( 'Type', 'wolf-core' ),
		'search_items'               => esc_html__( 'Search Types', 'wolf-core' ),
		'popular_items'              => esc_html__( 'Popular Types', 'wolf-core' ),
		'all_items'                  => esc_html__( 'All Types', 'wolf-core' ),
		'parent_item'                => esc_html__( 'Parent Type', 'wolf-core' ),
		'parent_item_colon'          => esc_html__( 'Parent Type:', 'wolf-core' ),
		'edit_item'                  => esc_html__( 'Edit Type', 'wolf-core' ),
		'update_item'                => esc_html__( 'Update Type', 'wolf-core' ),
		'add_new_item'               => esc_html__( 'Add New Type', 'wolf-core' ),
		'new_item_name'              => esc_html__( 'New Type', 'wolf-core' ),
		'separate_items_with_commas' => esc_html__( 'Separate types with commas', 'wolf-core' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove types', 'wolf-core' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used types', 'wolf-core' ),
		'not_found'                  => esc_html__( 'No types found', 'wolf-core' ),
		'menu_name'                  => esc_html__( 'Types', 'wolf-core' ),
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
