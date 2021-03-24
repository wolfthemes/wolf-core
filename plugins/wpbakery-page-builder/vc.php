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

		$this->includes();

		add_action( 'init', array( $this, 'init_hooks' ), 0 );
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

		add_action( 'init', array( $this, 'include_vc_params' ) );
		add_action( 'init', array( $this, 'include_shortcode_maps' ) );
	}

	/**
	 * Include core files for WPBakery Page Builder
	 */
	public function includes() {

		$files = array(
			'vc-core-functions',
			'vc-custom-fields',
			'icon-styles',
			'icon-libraries',
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
	 * Include params files for WPBakery Page Builder
	 */
	public function include_vc_params() {
		$files = array(
			'background-params',
			'style-params',
			'custom-heading-params',
			'row-params',
			'row-inner-params',
			'column-params',
			'column-inner-params',
			'icon-params',
		);

		foreach ( $files as $file ) {
			if ( ! include_once WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/vc-params/' . $file . '.php' ) {
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
	public function include_shortcode_maps() {

		foreach ( $this->elements as $e ) {

			if ( is_file( WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/vc-map/' . sanitize_title_with_dashes( $e ) . '.php' ) ) {

				include_once WOLF_CORE_DIR . '/plugins/wpbakery-page-builder/vc-map/' . sanitize_title_with_dashes( $e ) . '.php';
			}
		}
	}
}

return new Wolf_Core_WPBakery_Page_Builder_Extension();
