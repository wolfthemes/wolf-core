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
	wp_enqueue_script( 'wolf-core-smash-id', WOLF_CORE_JS . '/admin/smash-id.js', array(), $version, true );

	wp_localize_script(
		'wolf-core-admin',
		'WolfCoreAdminParams',
		array(
			'ajaxUrl'                      => esc_url( admin_url( 'admin-ajax.php' ) ),
			'chooseImage'                  => esc_html__( 'Select an image', 'wolf-core' ),
			'chooseMultipleImage'          => esc_html__( 'Select a set of images', 'wolf-core' ),
			'chooseFile'                   => esc_html__( 'Select a file', 'wolf-core' ),
			'confirmRemoveAllImages'       => esc_html__( 'This will remove the entire image set', 'wolf-core' ),
			'VCPurchaseUrl'                => wolf_core_vc_purchase_url(),
			'updatingDBNonce'              => wp_create_nonce( 'wolf_core_update_db_nonce' ), // Install nonce.
			'updatingDBDismissNonce'       => wp_create_nonce( 'wolf_core_update_db_dismiss_nonce' ), // Install nonce.
			'updatingDBMessage'            => esc_html__( 'Updating Database...', 'wolf-core' ),
			'updatingDBRedirectingMessage' => esc_html__( 'Redirecting...', 'wolf-core' ),
			'updatingDBFinalizingMessage'  => esc_html__( 'Finalizing...', 'wolf-core' ),
			'updatingDBRedirectURL'        => esc_url( admin_url( '/index.php?wolf_core_db_updated=true' ) ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'wolf_core_enqueue_admin_scripts' );

/**
 * Admin styles
 */
function wolf_core_enqueue_admin_styles() {
	wp_enqueue_style( 'linearicons', WOLF_CORE_CSS . '/lib/fonts/linearicons/linearicons.min.css', array(), WOLF_CORE_VERSION );
	wp_enqueue_style( 'linea-software', WOLF_CORE_CSS . '/lib/fonts/linea-icons/linea-icons.min.css', array(), WOLF_CORE_VERSION );
	wp_enqueue_style( 'wolficons', WOLF_CORE_CSS . '/lib/fonts/wolficons/wolficons.min.css', array(), WOLF_CORE_VERSION );
	wp_enqueue_style( 'font-awesome' );
}
add_action( 'elementor/editor/after_enqueue_scripts', 'wolf_core_enqueue_admin_styles' );
