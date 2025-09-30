<?php
/**
 * Content Block
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 2.0.20
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns a heading
 *
 * @param int $post_id The content block post ID.
 */
function wolf_core_content_block( $post_id ) {

	$post_id = absint( apply_filters( 'wpml_object_id', $post_id, 'wolf_content_block' ) ); // WPML compatibility.

	$content_block_post_slug = ( class_exists( 'Wolf_Core' ) ) ? 'wolf_content_block' : 'wvc_content_block';

	if ( get_post_status( $post_id ) && get_the_ID() !== $post_id && get_post_type( $post_id ) === $content_block_post_slug ) {

		$content = '';

		if ( 'elementor' === wolf_core_get_plugin_in_use() ) {
			$content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $post_id );
		}

		if ( 'wpbpb' === wolf_core_get_plugin_in_use() ) {
			$content = wolf_core_js_remove_wpautop( get_post_field( 'post_content', $post_id ) );
		}

		return $content;
	}
}
