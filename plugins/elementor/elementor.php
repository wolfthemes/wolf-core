<?php
/**
 * %NAME% Elementor Extension Class
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Core
 * @version %VERSION%
 */

defined( 'ABSPATH' ) || exit;

class Wolf_Core_Elementor_Extension {

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

		require_once( 'elementor-core-functions.php' );

		$this->include_raw_params();

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
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
	public function init_widgets() {

		foreach ( $this->elements as $widget ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/elementor/widgets/' . sanitize_title_with_dashes( $widget ) . '.php' ) ) {
				require_once( WOLF_CORE_DIR . '/plugins/elementor/widgets/' .  sanitize_title_with_dashes( $widget ) . '.php' );
			}
		}
	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {

		// Include Control files
		//require_once( WOLF_CORE_DIR . '/controls/test-control.php' );

		// Register control
		//\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );

	}
}

return new Wolf_Core_Elementor_Extension();