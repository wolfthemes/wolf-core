<?php
/**
 * Content Blocks register post type
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/ContentBlocks/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/* Register Content Block post type */
$labels = array(
	'name'               => esc_html__( 'Content Blocks', 'wolf-core' ),
	'singular_name'      => esc_html__( 'Content Block', 'wolf-core' ),
	'add_new'            => esc_html__( 'Add New', 'wolf-core' ),
	'add_new_item'       => esc_html__( 'Add New Content Block', 'wolf-core' ),
	'all_items'          => esc_html__( 'All Content Blocks', 'wolf-core' ),
	'edit_item'          => esc_html__( 'Edit Content Block', 'wolf-core' ),
	'new_item'           => esc_html__( 'New Content Block', 'wolf-core' ),
	'view_item'          => esc_html__( 'View Content Block', 'wolf-core' ),
	'search_items'       => esc_html__( 'Search Content Blocks', 'wolf-core' ),
	'not_found'          => esc_html__( 'No content block found', 'wolf-core' ),
	'not_found_in_trash' => esc_html__( 'No content block found in Trash', 'wolf-core' ),
	'parent_item_colon'  => '',
	'menu_name'          => esc_html__( 'Content Block', 'wolf-core' ),
);

$args = array(
	'labels'              => $labels,
	'public'              => true,
	'publicly_queryable'  => true,
	'show_ui'             => true,
	'show_in_menu'        => true,
	'query_var'           => false,
	'rewrite'             => array( 'slug' => 'content-block' ),
	'capability_type'     => 'post',
	'has_archive'         => false,
	'hierarchical'        => false,
	'menu_position'       => 5,
	'taxonomies'          => array(),
	'supports'            => array( 'title', 'editor' ),
	'exclude_from_search' => true,
	'description'         => esc_html__( 'Re-usable content for page builder', 'wolf-core' ),
	'menu_icon'           => 'dashicons-editor-table',
);

register_post_type( 'wolf_content_block', $args );
