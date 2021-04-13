<?php
/**
 * Wolf Core Admin scripts
 *
 * @author WolfThemes
 * @category Admin
 * @package WolfCore/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue admin scripts
 *
 * Styles and scripts for the admin
 */
function wolf_core_enqueue_admin_scripts() {

	$suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : WOLF_CORE_VERSION;

	/* Styles */
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'wolf-core-admin', WOLF_CORE_CSS . '/admin/admin' . $suffix . '.css', array(), $version, 'all' );

	/* Scripts */
	if ( 'vc' === wolf_core_get_plugin_in_use() ) {
		/* load jQuery-ui slider */
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_script( 'wolf-core-numeric-slider', WOLF_CORE_JS . '/admin/numeric-slider.js', array( 'jquery-ui-slider' ), $version, true );
		wp_enqueue_script( 'wolf-core-font-preview', WOLF_CORE_JS . '/admin/font-preview.js', array( 'jquery' ), $version, true );
	}

	wp_enqueue_media();
	wp_enqueue_script( 'wolf-core-media', WOLF_CORE_JS . '/admin/media.js', array( 'jquery', 'wp-color-picker' ), $version, true );
	wp_enqueue_script( 'wolf-core-admin', WOLF_CORE_JS . '/admin/admin.js', array( 'jquery', 'wp-color-picker' ), $version, true );

	wp_localize_script(
		'wolf-core-admin',
		'WolfCoreAdminParams',
		array(
			'ajaxUrl'                => esc_url( admin_url( 'admin-ajax.php' ) ),
			'chooseImage'            => esc_html__( 'Select an image', 'wolf-core' ),
			'chooseMultipleImage'    => esc_html__( 'Select a set of images', 'wolf-core' ),
			'chooseFile'             => esc_html__( 'Select a file', 'wolf-core' ),
			'confirmRemoveAllImages' => esc_html__( 'This will remove the entire image set', 'wolf-core' ),
			'VCPurchaseUrl'          => wolf_core_vc_purchase_url(),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'wolf_core_enqueue_admin_scripts' );
