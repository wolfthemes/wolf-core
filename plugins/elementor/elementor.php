<?php // phpcs:ignore
/**
 * Wolf Core Elementor Extension Class
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Wolf_Core_Elementor_Extension { // phpcs:ignore

	/**
	 * @var string
	 */
	private $elements = array();

	/**
	 * Constructor.
	 */
	public function __construct() {

		require_once 'elementor-core-functions.php';
		require_once 'elementor-editor-functions.php';

		if ( is_admin() ) {
			require_once WOLF_CORE_DIR . '/inc/admin/admin-elementor-functions.php';
		}

		add_action( 'init', array( $this, 'init_hooks' ) );
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
	public function init_hooks() {

		$this->elements = wolf_core_get_elements();

		require_once 'icon-libraries.php';

		add_action( 'elementor/widgets/widgets_registered', array( $this, 'init_widgets' ) );
		add_action( 'elementor/controls/controls_registered', array( $this, 'init_controls' ) );
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

		$controls_files = array(
			'section',
			'heading',
			'icon-box',
			'icon-list',
			'image',
			'image-carousel',
			'page',
			'text-editor',
		);

		foreach ( $controls_files as $controls_file ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/elementor/controls/' . sanitize_title_with_dashes( $controls_file ) . '.php' ) ) {
				require_once WOLF_CORE_DIR . '/plugins/elementor/controls/' . sanitize_title_with_dashes( $controls_file ) . '.php';
			}
		}
	}
}

return new Wolf_Core_Elementor_Extension();
