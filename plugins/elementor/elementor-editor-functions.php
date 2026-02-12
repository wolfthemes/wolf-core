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
 * Enqueue Elementor admin scripts
 */
function wolf_core_enqueue_elementor_admin_scripts() {
	wp_enqueue_script( 'wolf-core-post-meta', WOLF_CORE_JS . '/admin/post-meta.js', array( 'jquery' ), WOLF_CORE_VERSION, true );
}
add_action( 'elementor/frontend/after_enqueue_scripts', 'wolf_core_enqueue_elementor_admin_scripts' );
