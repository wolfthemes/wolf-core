<?php
/**
 * Wolf Core Elementor admin functions
 *
 * Admin functions specific to Elementor
 *
 * @author WolfThemes
 * @category Admin
 * @package WolfCore/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Sync post meta with Elementor page settings
 *
 * Save Elementor page settings when post meta are updated.
 * The opposite (update post meta when Elementor page settings are updated) is done via AJAX.
 *
 * @param int $post_id The saved post ID.
 */
function wolf_core_sync_elementor_page_settings( $post_id ) {

	$post_types = array( 'post', 'page', 'product', 'work', 'gallery', 'release', 'event', 'video', 'artist', 'mp-event', 'mp-column' );

	// verify nonce.
	if ( ( isset( $_POST['wolf_meta_box_nonce'] ) ) && ( ! wp_verify_nonce( $_POST['wolf_meta_box_nonce'], basename( __FILE__ ) ) ) ) {
		return $post_id;
	}

	// check autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	global $post;

	// check permissions.
	if ( isset( $_POST['post_type'] ) && is_object( $post ) ) {

		$current_post_type = get_post_type( $post->ID );

		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;

			} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		if ( in_array( $_POST['post_type'], $post_types ) ) {
			$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );
			$page_settings_model   = $page_settings_manager->get_model( $post_id );

			$page_meta = $page_settings_model->get_settings();

			$metafields = apply_filters( 'wolf_core_elementor_page_settings', array( 'loading_animation_type', 'menu_layout', 'menu_style', 'hero_font_tone', 'after_header_block', 'before_footer_block' ) );

			foreach ( $metafields as $metafield ) {
				if ( isset( $_POST[ '_post_' . $metafield ] ) ) {

					$page_meta[ $metafield ] = $_POST[ '_post_' . $metafield ];
				}
			}
			$page_settings_manager->save_settings( $page_meta, $post_id );
		}
	}
}
add_action( 'save_post', 'wolf_core_sync_elementor_page_settings' );
