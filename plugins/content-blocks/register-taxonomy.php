<?php
/**
 * Content Blocks register taxonomy
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/ContentBlocks/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/* Content Block Taxonomy */
$labels = array(
	'name'                       => esc_html__( 'Content Block Categories', 'wolf-core' ),
	'singular_name'              => esc_html__( 'Content Block Category', 'wolf-core' ),
	'search_items'               => esc_html__( 'Search Content Block Categories', 'wolf-core' ),
	'popular_items'              => esc_html__( 'Popular Content Block Categories', 'wolf-core' ),
	'all_items'                  => esc_html__( 'All Content Block Categories', 'wolf-core' ),
	'parent_item'                => esc_html__( 'Parent Content Block Category', 'wolf-core' ),
	'parent_item_colon'          => esc_html__( 'Parent Content Block Category:', 'wolf-core' ),
	'edit_item'                  => esc_html__( 'Edit Content Block Category', 'wolf-core' ),
	'update_item'                => esc_html__( 'Update Content Block Category', 'wolf-core' ),
	'add_new_item'               => esc_html__( 'Add New Content Block Category', 'wolf-core' ),
	'new_item_name'              => esc_html__( 'New Content Block Category', 'wolf-core' ),
	'separate_items_with_commas' => esc_html__( 'Separate content block categories with commas', 'wolf-core' ),
	'add_or_remove_items'        => esc_html__( 'Add or remove content block categories', 'wolf-core' ),
	'choose_from_most_used'      => esc_html__( 'Choose from the most used content block categories', 'wolf-core' ),
	'menu_name'                  => esc_html__( 'Categories', 'wolf-core' ),
);

$args = array(
	'labels'       => $labels,
	'hierarchical' => true,
	'public'       => true,
	'show_ui'      => true,
	'query_var'    => true,
	'rewrite'      => array(
		'slug'       => 'content-block-category',
		'with_front' => false,
	),
);

register_taxonomy( 'wolf_content_block_category', array( 'wolf_content_block' ), $args );
