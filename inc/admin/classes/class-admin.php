<?php
/**
 * Wolf Core Admin.
 *
 * @class Wolf_core_Admin
 * @author WolfThemes
 * @category Admin
 * @package WolfCore/Admin/Classes
 * @version 1.0.0
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

		// Update.
		add_action( 'admin_init', array( $this, 'update' ), 0 );

		// Includes necessary files.
		add_action( 'init', array( $this, 'includes' ), 0 );
	}

	/**
	 * Perform actions on updating the theme if needed
	 */
	public function update() {

		if ( ! defined( 'IFRAME_REQUEST' ) && ! defined( 'DOING_AJAX' ) && ( get_option( 'wolf_core_version' ) !== WOLF_CORE_VERSION ) ) {

			// Update hook.
			do_action( 'wolf_core_do_update' );

			$installs_history                      = get_option( 'wolf_core_install_history', array() );
			$time                                  = time();
			$installs_history[ WOLF_CORE_VERSION ] = $time;

			$old_version = get_option( 'wolf_core_version' );

			// If there was an old version of Wolf Core, and there's no record for that install yet
			if ( $old_version && empty( $installs_history[ $old_version ] ) ) {
				$installs_history[ $old_version ] = $installs_history[ WOLF_CORE_VERSION ] - 1;
			}

			uksort( $installs_history, 'version_compare' );

			update_option( 'wolf_core_install_history', $installs_history );

			// Update new version.
			update_option( 'wolf_core_version', WOLF_CORE_VERSION );

			// After update hook.
			do_action( 'wolf_core_updated' );
		}
	}

	/**
	 * Include any classes we need within admin.
	 */
	public function includes() {

		$admin_files = array(
			'admin-scripts',
			'admin-options',
			'admin-update-db',
			'admin-notices',
			'admin-functions',
		);

		/* Includes files from theme inc/admin dir in backend */
		foreach ( $admin_files as $file ) {

			if ( ! include_once WOLF_CORE_DIR . '/inc/admin/' . $file . '.php' ) {
				wp_die(
					sprintf(
						wp_kses(
							/* translators: the code to output */
							__( 'Error locating <code>%s</code> for inclusion.', 'wolf-core' ),
							array(
								'code' => array(),
							)
						),
						esc_attr( $file )
					)
				);
			}
		}
	}
}

return new Wolf_Core_Admin();
