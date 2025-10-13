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
function wolf_core_add_event_type_taxonomy() {


	$theme_slug = esc_attr( sanitize_title_with_dashes( get_template() ) );

	$theme_slugs = array( 'wolf-supertheme', 'unimate', 'covenant', );

	if ( ! in_array( $theme_slug, $theme_slugs ) ) {
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
add_action( 'init', 'wolf_core_add_event_type_taxonomy' );

/**
 * MediaFoundry Add event type tax
 */
function mediafoundry_add_event_type_taxonomy() {

	$theme_slug = esc_attr( sanitize_title_with_dashes( get_template() ) );

	if ( 'mediafoundry' !== $theme_slug && 'wolf-supertheme' !== $theme_slug ) {
		return;
	}

	/* Portfolio artist taxonomy */
	$labels = array(
		'name'                       => esc_html__( 'Artists', 'wolf-portfolio' ),
		'singular_name'              => esc_html__( 'Artist', 'wolf-portfolio' ),
		'search_items'               => esc_html__( 'Search Artists', 'wolf-portfolio' ),
		'popular_items'              => esc_html__( 'Popular Artists', 'wolf-portfolio' ),
		'all_items'                  => esc_html__( 'All Artists', 'wolf-portfolio' ),
		'parent_item'                => esc_html__( 'Parent Artist', 'wolf-portfolio' ),
		'parent_item_colon'          => esc_html__( 'Parent Artist:', 'wolf-portfolio' ),
		'edit_item'                  => esc_html__( 'Edit Artist', 'wolf-portfolio' ),
		'update_item'                => esc_html__( 'Update Artist', 'wolf-portfolio' ),
		'add_new_item'               => esc_html__( 'Add New Artist', 'wolf-portfolio' ),
		'new_item_name'              => esc_html__( 'New Artist', 'wolf-portfolio' ),
		'separate_items_with_commas' => esc_html__( 'Separate artists with commas', 'wolf-portfolio' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove artists', 'wolf-portfolio' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used artists', 'wolf-portfolio' ),
		'not_found'                  => esc_html__( 'No artists found', 'wolf-portfolio' ),
		'menu_name'                  => esc_html__( 'Artists', 'wolf-portfolio' ),
	);

	$args = array(
		'labels'       => $labels,
		'hierarchical' => true,
		'public'       => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug'       => 'work-artist',
			'with_front' => false,
		),
	);

	register_taxonomy( 'work_artist', array( 'work' ), $args );

	/* Video artist taxonomy */
	$labels = array(
		'name'                       => esc_html__( 'Artists', 'wolf-videos' ),
		'singular_name'              => esc_html__( 'Artist', 'wolf-videos' ),
		'search_items'               => esc_html__( 'Search Artists', 'wolf-videos' ),
		'popular_items'              => esc_html__( 'Popular Artists', 'wolf-videos' ),
		'all_items'                  => esc_html__( 'All Artists', 'wolf-videos' ),
		'parent_item'                => esc_html__( 'Parent Artist', 'wolf-videos' ),
		'parent_item_colon'          => esc_html__( 'Parent Artist:', 'wolf-videos' ),
		'edit_item'                  => esc_html__( 'Edit Artist', 'wolf-videos' ),
		'update_item'                => esc_html__( 'Update Artist', 'wolf-videos' ),
		'add_new_item'               => esc_html__( 'Add New Artist', 'wolf-videos' ),
		'new_item_name'              => esc_html__( 'New Artist', 'wolf-videos' ),
		'separate_items_with_commas' => esc_html__( 'Separate artists with commas', 'wolf-videos' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove artists', 'wolf-videos' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used artists', 'wolf-videos' ),
		'not_found'                  => esc_html__( 'No artists found', 'wolf-videos' ),
		'menu_name'                  => esc_html__( 'Artists', 'wolf-videos' ),
	);

	$args = array(
		'labels'       => $labels,
		'hierarchical' => true,
		'public'       => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug'       => 'video-artist',
			'with_front' => false,
		),
	);

	register_taxonomy( 'video_artist', array( 'video' ), $args );
}
add_action( 'init', 'mediafoundry_add_event_type_taxonomy' );


/**
 * Covenant Add sermon serites tax
 */
function covenant_add_sermon_series_taxonomy() {

	$theme_slug = esc_attr( sanitize_title_with_dashes( get_template() ) );

	if ( 'covenant' !== $theme_slug && 'wolf-supertheme' !== $theme_slug ) {
		return;
	}

	/* Sermon series taxonomy */
	$labels = array(
		'name'                       => esc_html__( 'Series', 'wolf-videos' ),
		'singular_name'              => esc_html__( 'Serie', 'wolf-videos' ),
		'search_items'               => esc_html__( 'Search Series', 'wolf-videos' ),
		'popular_items'              => esc_html__( 'Popular Series', 'wolf-videos' ),
		'all_items'                  => esc_html__( 'All Series', 'wolf-videos' ),
		'parent_item'                => esc_html__( 'Parent Serie', 'wolf-videos' ),
		'parent_item_colon'          => esc_html__( 'Parent Serie:', 'wolf-videos' ),
		'edit_item'                  => esc_html__( 'Edit Serie', 'wolf-videos' ),
		'update_item'                => esc_html__( 'Update Serie', 'wolf-videos' ),
		'add_new_item'               => esc_html__( 'Add New Serie', 'wolf-videos' ),
		'new_item_name'              => esc_html__( 'New Serie', 'wolf-videos' ),
		'separate_items_with_commas' => esc_html__( 'Separate artists with commas', 'wolf-videos' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove artists', 'wolf-videos' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used artists', 'wolf-videos' ),
		'not_found'                  => esc_html__( 'No artists found', 'wolf-videos' ),
		'menu_name'                  => esc_html__( 'Series', 'wolf-videos' ),
	);

	$args = array(
		'labels'       => $labels,
		'hierarchical' => true,
		'public'       => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug'       => 'sermon-series',
			'with_front' => false,
		),
	);

	register_taxonomy( 'sermon_series', array( 'work' ), $args );
}
add_action( 'init', 'covenant_add_sermon_series_taxonomy' );