<?php
/**
 * %NAME% Admin.
 *
 * @class Wolf_core_Admin
 * @author WolfThemes
 * @category Admin
 * @package %PACKAGENAME%/Admin/Classes
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
	 * Perform actions on updating the theme id needed
	 */
	public function update() {

		if ( ! defined( 'IFRAME_REQUEST' ) && ! defined( 'DOING_AJAX' ) && ( get_option( 'wolf_core_version' ) != WOLF_CORE_VERSION ) ) {

			// Update hook.
			do_action( 'wolf_core_do_update' );

			// Update version.
			delete_option( 'wolf_core_version' );
			add_option( 'wolf_core_version', WOLF_CORE_VERSION );

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
		);

		/* Includes files from theme inc/admin dir in backend */
		foreach ( $admin_files as $file ) {

			if ( ! include_once WOLF_CORE_DIR . '/inc/admin/' . $file . '.php' ) {
				wp_die(
					sprintf(
						wp_kses(
							/* translators: the code to output */
							__( 'Error locating <code>%s</code> for inclusion.', '%TEXTDOMAIN%' ),
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
