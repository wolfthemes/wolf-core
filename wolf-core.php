<?php
/**
 * Plugin Name: Wolf Core
 * Plugin URI: %LINK%
 * Description: %DESCRIPTION%
 * Version: %VERSION%
 * Author: %AUTHOR%
 * Author URI: %AUTHORURI%
 * Requires at least: %REQUIRES%
 * Tested up to: %TESTED%
 *
 * Text Domain: %TEXTDOMAIN%
 * Domain Path: /languages/
 *
 * @package %PACKAGENAME%
 * @category Core
 * @author %AUTHOR%
 *
 * Help:
 * https://wlfthm.es/help
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Wolf_Core' ) ) {
	/**
	 * Main Wolf_Core Class
	 *
	 * Contains the main functions for Wolf_Core
	 *
	 * @class Wolf_Core
	 * @version %VERSION%
	 * @since 1.0.0
	 */
	final class Wolf_Core {

		/**
		 * Plugin Version
		 *
		 * @since 1.0.0
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '%VERSION%';

		/**
		 * Minimum Elementor Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

		/**
		 * Minimum WPBakery Page Builder Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum WPBakery Page Builder version required to run the plugin.
		 */
		const MINIMUM_WPBPB_VERSION = '6.5';

		/**
		 * Minimum PHP Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const MINIMUM_PHP_VERSION = '7.0';

		/**
		 * @var string
		 */
		public $version = '%VERSION%';

		/**
		 * @var string
		 */
		private $update_url = 'https://plugins.wolfthemes.com/update';

		/**
		 * @var the support forum URL
		 */
		private $support_url = 'https://wlfthm.es/help/';

		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @static
		 *
		 * @var Wolf_Core The single instance of the class.
		 */
		private static $_instance = null;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 * @static
		 *
		 * @return Wolf_Core An instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'init', [ $this, 'i18n' ] );
			add_action( 'plugins_loaded', [ $this, 'init' ] );
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * Fired by `init` action hook.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function i18n() {

			$domain = '%TEXTDOMAIN%';
			$locale = apply_filters( '%TEXTDOMAIN%', get_locale(), $domain );
			load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Initialize the plugin
		 *
		 * Load the plugin only after Elementor (and other plugins) are loaded.
		 * Checks for basic plugin requirements, if one check fail don't continue,
		 * if all check have passed load the files required to run the plugin.
		 *
		 * Fired by `plugins_loaded` action hook.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function init() {
			
			register_activation_hook( __FILE__, [ $this, 'activate' ] );
			
			include_once( 'inc/admin/auth.php' );

			if ( wolf_core_wrong_theme() ) {
				add_action( 'admin_notices', 'wolf_core_show_wrong_theme_notice' );
				return;
			}

			if ( ! wolf_core_is_activated() ) {
				add_action( 'admin_notices', 'wolf_core_activation_notice' );
				if ( $this->is_request( 'admin' ) ) {
					include_once( 'inc/admin/admin-theme-activation.php' );
				}
				return;
			}

			$this->define_constants();
			$this->includes();

			if ( get_transient( 'wolf_core_activation_notice' ) ) {
				add_action( 'admin_notices', 'wolf_core_show_activation_notice' );
			}
		}

		/**
		 * Define constant if not already set
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Activation function
		 */
		public function activate() {

			if ( ! get_transient( 'wolf_core_activation_notice' ) && ! get_option( 'wolf_core_activation_notice_set' ) ) {
				set_transient( 'wolf_core_activation_notice', true, 30 * DAY_IN_SECONDS );
				update_option( 'wolf_core_activation_notice_set', true );
			}

			update_option( 'wpb_js_gutenberg_disable', true );
		}

		/**
		 * Define WR Constants
		 */
		private function define_constants() {

			$constants = array(
				'WOLF_CORE_DEV' => false,
				'WOLF_CORE_OK' => true,
				'WOLF_CORE_DIR' => $this->plugin_path(),
				'WOLF_CORE_URI' => $this->plugin_url(),
				'WOLF_CORE_CSS' => $this->plugin_url() . '/assets/css',
				'WOLF_CORE_JS' => $this->plugin_url() . '/assets/js',
				'WOLF_CORE_SCRIPT_VERSION' => ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : $this->version,
				'WOLF_CORE_SLUG' => plugin_basename( dirname( __FILE__ ) ),
				'WOLF_CORE_PATH' => plugin_basename( __FILE__ ),
				'WOLF_CORE_VERSION' => $this->version,
				'WOLF_CORE_UPDATE_URL' => $this->update_url,
				'WOLF_CORE_SUPPORT_URL' => $this->support_url,
				'WOLF_CORE_DOC_URI' => 'https://docs.wolfthemes.com/documentation/plugins/' . plugin_basename( dirname( __FILE__ ) ),
				'WOLF_CORE_WOLF_DOMAIN' => 'wolfthemes.com',
			);

			foreach ( $constants as $name => $value ) {
				$this->define( $name, $value );
			}
		}

		/**
		 * What type of request is this?
		 * string $type ajax, frontend or admin
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin' :
					return is_admin();
				case 'ajax' :
					return defined( 'DOING_AJAX' );
				case 'cron' :
					return defined( 'DOING_CRON' );
				case 'frontend' || wvc_is_vc_frontend() :
					return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
			}
		}

		/**
		 * Include required core files used in admin and on the frontend.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function includes() {

			include_once( 'inc/core-functions.php' );
			include_once( 'inc/utility-functions.php' );
 			include_once( 'inc/conditional-functions.php' );
			
			if ( $this->is_request( 'admin' ) ) {

				if ( ! get_transient( 'wolf_core_activation_notice' ) && ! get_option( 'wolf_core_activation_notice_set' ) ) {
					set_transient( 'wolf_core_activation_notice', true, 30 * DAY_IN_SECONDS );
					update_option( 'wolf_core_activation_notice_set', true );
				}

				include_once( 'inc/admin/admin-theme-activation.php' );
				
				include_once( 'inc/admin/classes/class-admin.php' );
				include_once( 'inc/admin/classes/class-video-thumbnail-generator.php' );
				include_once( 'inc/admin/classes/class-metaboxes.php' );
			}

			if ( $this->is_request( 'ajax' ) ) {
				//$this->ajax_includes();
			}

			if ( $this->is_request( 'frontend' ) ) {
				//$this->frontend_includes();
			}
		}

		/**
		 * Include required ajax files.
		 */
		public function ajax_includes() {
			//include_once( 'inc/ajax/ajax-functions.php' );
		}

		/**
		 * Include required frontend files.
		 */
		public function frontend_includes() {
		}

		/**
		 * Get the plugin url.
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Get Ajax URL.
		 * @return string
		 */
		public function ajax_url() {
			return admin_url( 'admin-ajax.php', 'relative' );
		}
	}

	/**
	 * Returns the main instance of Wolf_Core to prevent the need to use globals.
	 *
	 * @return Wolf_Core
	 */
	function WOLF_CORE() {
		return Wolf_Core::instance();
	}

	WOLF_CORE(); // Go
}