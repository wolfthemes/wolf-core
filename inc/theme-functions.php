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

	$theme_slug = wolf_core_get_theme_slug();

	$theme_slugs = array( 'wolf-supertheme', 'unimate', 'covenant', 'megahertz' );

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

	if ( 'mediafoundry' !==  wolf_core_get_theme_slug() ) {
		return;
	}

	/* Portfolio artist taxonomy */
	$labels = array(
		'name'                       => esc_html__( 'Artists', 'wolf-core' ),
		'singular_name'              => esc_html__( 'Artist', 'wolf-core' ),
		'search_items'               => esc_html__( 'Search Artists', 'wolf-core' ),
		'popular_items'              => esc_html__( 'Popular Artists', 'wolf-core' ),
		'all_items'                  => esc_html__( 'All Artists', 'wolf-core' ),
		'parent_item'                => esc_html__( 'Parent Artist', 'wolf-core' ),
		'parent_item_colon'          => esc_html__( 'Parent Artist:', 'wolf-core' ),
		'edit_item'                  => esc_html__( 'Edit Artist', 'wolf-core' ),
		'update_item'                => esc_html__( 'Update Artist', 'wolf-core' ),
		'add_new_item'               => esc_html__( 'Add New Artist', 'wolf-core' ),
		'new_item_name'              => esc_html__( 'New Artist', 'wolf-core' ),
		'separate_items_with_commas' => esc_html__( 'Separate artists with commas', 'wolf-core' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove artists', 'wolf-core' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used artists', 'wolf-core' ),
		'not_found'                  => esc_html__( 'No artists found', 'wolf-core' ),
		'menu_name'                  => esc_html__( 'Artists', 'wolf-core' ),
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
		'name'                       => esc_html__( 'Artists', 'wolf-core' ),
		'singular_name'              => esc_html__( 'Artist', 'wolf-core' ),
		'search_items'               => esc_html__( 'Search Artists', 'wolf-core' ),
		'popular_items'              => esc_html__( 'Popular Artists', 'wolf-core' ),
		'all_items'                  => esc_html__( 'All Artists', 'wolf-core' ),
		'parent_item'                => esc_html__( 'Parent Artist', 'wolf-core' ),
		'parent_item_colon'          => esc_html__( 'Parent Artist:', 'wolf-core' ),
		'edit_item'                  => esc_html__( 'Edit Artist', 'wolf-core' ),
		'update_item'                => esc_html__( 'Update Artist', 'wolf-core' ),
		'add_new_item'               => esc_html__( 'Add New Artist', 'wolf-core' ),
		'new_item_name'              => esc_html__( 'New Artist', 'wolf-core' ),
		'separate_items_with_commas' => esc_html__( 'Separate artists with commas', 'wolf-core' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove artists', 'wolf-core' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used artists', 'wolf-core' ),
		'not_found'                  => esc_html__( 'No artists found', 'wolf-core' ),
		'menu_name'                  => esc_html__( 'Artists', 'wolf-core' ),
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

	if ( 'covenant' !== wolf_core_get_theme_slug() ) {
		return;
	}

	/* Sermon series taxonomy */
	$labels = array(
		'name'                       => esc_html__( 'Series', 'wolf-core' ),
		'singular_name'              => esc_html__( 'Serie', 'wolf-core' ),
		'search_items'               => esc_html__( 'Search Series', 'wolf-core' ),
		'popular_items'              => esc_html__( 'Popular Series', 'wolf-core' ),
		'all_items'                  => esc_html__( 'All Series', 'wolf-core' ),
		'parent_item'                => esc_html__( 'Parent Serie', 'wolf-core' ),
		'parent_item_colon'          => esc_html__( 'Parent Serie:', 'wolf-core' ),
		'edit_item'                  => esc_html__( 'Edit Serie', 'wolf-core' ),
		'update_item'                => esc_html__( 'Update Serie', 'wolf-core' ),
		'add_new_item'               => esc_html__( 'Add New Serie', 'wolf-core' ),
		'new_item_name'              => esc_html__( 'New Serie', 'wolf-core' ),
		'separate_items_with_commas' => esc_html__( 'Separate artists with commas', 'wolf-core' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove artists', 'wolf-core' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used artists', 'wolf-core' ),
		'not_found'                  => esc_html__( 'No artists found', 'wolf-core' ),
		'menu_name'                  => esc_html__( 'Series', 'wolf-core' ),
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

/**
 * MegaHertz Add custom taxonomies
 */
function megahertz_add_custom_taxonomy() {

	if ( 'megahertz' !== wolf_core_get_theme_slug() ) {
		return;
	}

	/* Season taxonomy */
	$labels = array(
		'name'                       => esc_html__( 'Seasons', 'wolf-core' ),
		'singular_name'              => esc_html__( 'Season', 'wolf-core' ),
		'search_items'               => esc_html__( 'Search Seasons', 'wolf-core' ),
		'popular_items'              => esc_html__( 'Popular Seasons', 'wolf-core' ),
		'all_items'                  => esc_html__( 'All Seasons', 'wolf-core' ),
		'parent_item'                => esc_html__( 'Parent Season', 'wolf-core' ),
		'parent_item_colon'          => esc_html__( 'Parent Season:', 'wolf-core' ),
		'edit_item'                  => esc_html__( 'Edit Season', 'wolf-core' ),
		'update_item'                => esc_html__( 'Update Season', 'wolf-core' ),
		'add_new_item'               => esc_html__( 'Add New Season', 'wolf-core' ),
		'new_item_name'              => esc_html__( 'New Season', 'wolf-core' ),
		'separate_items_with_commas' => esc_html__( 'Separate seasons with commas', 'wolf-core' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove seasons', 'wolf-core' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used seasons', 'wolf-core' ),
		'not_found'                  => esc_html__( 'No seasons found', 'wolf-core' ),
		'menu_name'                  => esc_html__( 'Seasons', 'wolf-core' ),
	);
	$args = array(
		'labels'       => $labels,
		'hierarchical' => true,
		'public'       => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug'       => 'season',
			'with_front' => false,
		),
	);
	register_taxonomy( 'episode_season', array( 'work' ), $args );

	/* Episode Topics taxonomy */
	$topic_labels = array(
		'name'                       => esc_html__( 'Topics', 'wolf-core' ),
		'singular_name'              => esc_html__( 'Topic', 'wolf-core' ),
		'search_items'               => esc_html__( 'Search Topics', 'wolf-core' ),
		'popular_items'              => esc_html__( 'Popular Topics', 'wolf-core' ),
		'all_items'                  => esc_html__( 'All Topics', 'wolf-core' ),
		'edit_item'                  => esc_html__( 'Edit Topic', 'wolf-core' ),
		'update_item'                => esc_html__( 'Update Topic', 'wolf-core' ),
		'add_new_item'               => esc_html__( 'Add New Topic', 'wolf-core' ),
		'new_item_name'              => esc_html__( 'New Topic', 'wolf-core' ),
		'separate_items_with_commas' => esc_html__( 'Separate topics with commas', 'wolf-core' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove topics', 'wolf-core' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used topics', 'wolf-core' ),
		'not_found'                  => esc_html__( 'No topics found', 'wolf-core' ),
		'menu_name'                  => esc_html__( 'Topics', 'wolf-core' ),
	);
	$topic_args = array(
		'labels'       => $topic_labels,
		'hierarchical' => false, // Topics are non-hierarchical
		'public'       => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug'       => 'topic',
			'with_front' => false,
		),
	);
	register_taxonomy( 'episode_topic', array( 'work' ), $topic_args );

	/* Guest taxonomy */
	$guest_labels = array(
		'name'                       => esc_html__( 'Guests', 'wolf-core' ),
		'singular_name'              => esc_html__( 'Guest', 'wolf-core' ),
		'search_items'               => esc_html__( 'Search Guests', 'wolf-core' ),
		'popular_items'              => esc_html__( 'Popular Guests', 'wolf-core' ),
		'all_items'                  => esc_html__( 'All Guests', 'wolf-core' ),
		'edit_item'                  => esc_html__( 'Edit Guest', 'wolf-core' ),
		'update_item'                => esc_html__( 'Update Guest', 'wolf-core' ),
		'add_new_item'               => esc_html__( 'Add New Guest', 'wolf-core' ),
		'new_item_name'              => esc_html__( 'New Guest Name', 'wolf-core' ),
		'separate_items_with_commas' => esc_html__( 'Separate guests with commas', 'wolf-core' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove guests', 'wolf-core' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used guests', 'wolf-core' ),
		'not_found'                  => esc_html__( 'No guests found', 'wolf-core' ),
		'menu_name'                  => esc_html__( 'Guests', 'wolf-core' ),
	);
	$guest_args = array(
		'labels'       => $guest_labels,
		'hierarchical' => false,
		'public'       => true,
		'show_ui'      => true,
		'query_var'    => true,
		'rewrite'      => array(
			'slug'       => 'guest',
			'with_front' => false,
		),
	);
	register_taxonomy( 'episode_guest', array( 'work' ), $guest_args );
}
add_action( 'init', 'megahertz_add_custom_taxonomy' );