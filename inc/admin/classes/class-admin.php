<?php
/**
 * %NAME% Admin.
 *
 * @class Wolf_core_Admin
 * @author %AUTHOR%
 * @category Admin
 * @package %PACKAGENAME%/Admin
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

/**
 * Wolf_Core_Admin class.
 */
class Wolf_Core_Admin {
	/**
	 * Constructor
	 */
	public function __construct() {

		// Update
		add_action( 'admin_init', [ $this, 'update' ], 0 );

		// Includes necessary files
		add_action( 'init', [ $this, 'includes' ], 0 );

		// Plugin update notifications
		add_action( 'admin_init', [ $this, 'plugin_update' ] );
	}

	/**
	 * Perform actions on updating the theme id needed
	 */
	public function update() {

		if ( ! defined( 'IFRAME_REQUEST' ) && ! defined( 'DOING_AJAX' ) && ( get_option( 'wolf_core_version' ) != WOLF_CORE_VERSION ) ) {

			// Update hook
			do_action( 'wolf_core_do_update' );

			// Update version
			delete_option( 'wolf_core_version' );
			add_option( 'wolf_core_version', WOLF_CORE_VERSION );

			// After update hook
			do_action( 'wolf_core_updated' );
		}
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {

	}

	/**
	 * Plugin update
	 */
	public function plugin_update() {
		$plugin_slug = WOLF_CORE_SLUG;
		$plugin_path = WOLF_CORE_PATH;
		$remote_path = WOLF_CORE_UPDATE_URL . '/' . $plugin_slug;
		$plugin_data = get_plugin_data( WOLF_CORE_DIR . '/' . WOLF_CORE_SLUG . '.php' );
		$current_version = $plugin_data['Version'];
		include_once( 'class-update.php');
		new Wolf_Core_Update( $current_version, $remote_path, $plugin_path );
	}
}

return new Wolf_Core_Admin();