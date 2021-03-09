<?php
/**
 * Wolf Core Elementor Extension Class
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Wolf_Core_Elementor_Extension {

	/**
	 * @var string
	 */
	private $elements = array();

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'init' ) );

		$this->elements = wolf_core_get_element_list();
	}

	/**
	 * Initialize the extension
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @version 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		require_once 'elementor-core-functions.php';

		if ( is_admin() ) {
			require_once WOLF_CORE_DIR . '/inc/admin/admin-elementor-functions.php';
		}

		$this->include_raw_params();

		add_action( 'elementor/widgets/widgets_registered', array( $this, 'init_widgets' ) );
		add_action( 'elementor/controls/controls_registered', array( $this, 'init_controls' ) );
	}

	/**
	 * Include all raw element params
	 */
	public function include_raw_params() {

		foreach ( $this->elements as $e ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/params/' . sanitize_title_with_dashes( $e ) . '.php' ) ) {
				include_once WOLF_CORE_DIR . '/plugins/params/' . sanitize_title_with_dashes( $e ) . '.php';
			}
		}
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @version 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		foreach ( $this->elements as $widget ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/elementor/widgets/' . sanitize_title_with_dashes( $widget ) . '.php' ) ) {
				require_once WOLF_CORE_DIR . '/plugins/elementor/widgets/' . sanitize_title_with_dashes( $widget ) . '.php';
			}
		}
	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @version 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {

		// Include Control files
		// require_once( WOLF_CORE_DIR . '/controls/test-control.php' );

		// Register control
		// \Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );

		$controls_files = array(
			'section',
		);

		foreach ( $controls_files as $controls_file ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/elementor/controls/' . sanitize_title_with_dashes( $controls_file ) . '.php' ) ) {
				require_once WOLF_CORE_DIR . '/plugins/elementor/controls/' . sanitize_title_with_dashes( $controls_file ) . '.php';
			}
		}
	}
}

return new Wolf_Core_Elementor_Extension();
