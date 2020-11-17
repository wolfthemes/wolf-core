<?php
/**
 * Wolf Core WPBakery Page Builder Extension Class
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * The main WPBakery_Page_Builder_Extension class
 */
class Wolf_Core_WPBakery_Page_Builder_Extension {

	/**
	 * The available elements
	 *
	 * @var array
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

		$this->includes();
		$this->include_raw_params();
		$this->init_shortcodes();
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
	 * Include core files fro WPBAkery Page Builder
	 */
	public function includes() {

		$files = array(
			'vc-core-functions',
			'vc-custom-fields',
			'vc-additional-params',

			'icon-styles',
			'icon-libraries',

			// 'row',
			// 'row-inner',
			// 'column-text',
			// 'column-inner',
		);

		foreach ( $files as $file ) {
			if ( ! include_once WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/' . $file . '.php' ) {
				wp_die(
					sprintf(
						wp_kses(
							/* translators: %s: the code to display */
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

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @version 1.0.0
	 *
	 * @access public
	 */
	public function init_shortcodes() {

		foreach ( $this->elements as $e ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/vc-params/' . sanitize_title_with_dashes( $e ) . '.php' ) ) {

				include_once WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/vc-params/' . sanitize_title_with_dashes( $e ) . '.php';
			}
		}
	}
}

return new Wolf_Core_WPBakery_Page_Builder_Extension();
