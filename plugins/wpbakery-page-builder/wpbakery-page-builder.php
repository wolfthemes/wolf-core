<?php
/**
 * %NAME% WPBakery Page Builder Extension Class
 *
 * @author WolfThemes
 * @category Core
 * @package %PACKAGENAME%/Core
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

class Wolf_Core_WPBakery_Page_Builder_Extension {

	/**
	 * @var string
	 */
	private $elements = [];
	
	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'init' ] );

		$this->elements = wolf_core_get_element_list();
	}

	/**
	 * Initialize the extension
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		require_once( 'vc-core-functions.php' );
		require_once( 'vc-custom-fields.php' );

		$this->include_raw_params();
		$this->init_shortcodes();
	}

	/**
	 * Include all raw element params
	 */
	public function include_raw_params() {
		
		foreach ( $this->elements as $e ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/params/' . sanitize_title_with_dashes( $e ) . '.php' ) ) {
				include_once( WOLF_CORE_DIR . '/plugins/params/' . sanitize_title_with_dashes( $e ) . '.php' );
			}
		}
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_shortcodes() {

		foreach ( $this->elements as $e ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/vc-params/' . sanitize_title_with_dashes( $e ) . '.php' ) ) {

				include_once( WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/vc-params/' .  sanitize_title_with_dashes( $e ) . '.php' );
			}
		}
	}
}

return new Wolf_Core_WPBakery_Page_Builder_Extension();