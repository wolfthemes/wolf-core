<?php
/**
 * Plugin Name: Wolf Core
 * Plugin URI: https://wlfthm.es/wolf-core
 * Description: Core functions for Wolf Themes.
 * Version: 1.0.0
 * Author: WolfThemes
 * Author URI: https://wolfthemes.com
 * Requires at least: 5.0
 * Tested up to: 5.5
 *
 * Text Domain: wolf-core
 * Domain Path: /languages/
 *
 * @package WolfCore
 * @category Core
 * @author WolfThemes
 *
 * Verified customers who have purchased a premium theme at https://wlfthm.es/tf/
 * will have access to support for this plugin in the forums
 * https://wlfthm.es/help/
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Wolf_Core' ) ) {
	/**
	 * Main Wolf_Core Class
	 *
	 * Contains the main functions for Wolf_Core
	 *
	 * @class Wolf_Core
	 * @version 1.0.0
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
		const VERSION = '1.0.0';

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
		const MINIMUM_WPB_VC_VERSION = '6.2';

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
		public $version = '1.0.0';



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

			add_action( 'init', array( $this, 'i18n' ) );
			add_action( 'plugins_loaded', array( $this, 'init' ) );
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

			$domain = 'wolf-core';
			$locale = apply_filters( 'wolf-core', get_locale(), $domain );
			load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
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

			register_activation_hook( __FILE__, array( $this, 'activate' ) );

			/* Check if Elementor or WPBakery Page Builder is activated */
			if ( ! did_action( 'elementor/loaded' ) && ! defined( 'WPB_VC_VERSION' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notice_missing_page_builder_plugin' ) );
				return;
			}

			/* Check if both plugin are installed */
			if ( did_action( 'elementor/loaded' ) && defined( 'WPB_VC_VERSION' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notice_both_page_builder_plugins' ) );
				return;
			}

			/* Check for required Elementor version */
			if ( defined( 'ELEMENTOR_VERSION' ) && ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
				return;
			}

			/* Check for required WPBakery Page Builder version */
			if ( defined( 'WPB_VC_VERSION' ) && ! version_compare( WPB_VC_VERSION, self::MINIMUM_WPB_VC_VERSION, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notice_minimum_wpb_vc_version' ) );
				return;
			}

			/* Check for required PHP version */
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
				return;
			}

			/* License activation notices */
			require_once 'inc/admin/auth.php';

			if ( wolf_core_wrong_theme() ) {
				add_action( 'admin_notices', 'wolf_core_show_wrong_theme_notice' );
				return;
			}

			if ( ! wolf_core_is_activated() ) {
				add_action( 'admin_notices', 'wolf_core_activation_notice' );
				if ( $this->is_request( 'admin' ) ) {
					require_once 'inc/admin/admin-theme-activation.php';
				}
				return;
			}

			$this->define_constants();
			$this->includes();
			$this->flush_rewrite_rules();

			if ( get_transient( 'wolf_core_activation_notice' ) ) {
				add_action( 'admin_notices', 'wolf_core_show_activation_notice' );
			}

			// Plugin update notifications.
			add_action( 'admin_init', array( $this, 'plugin_update' ) );

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor or WPBakery Page Builder installed or activated.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_missing_page_builder_plugin() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				wp_kses_post( __( '"%1$s" requires "<a href="%2$s" target="_blank">%3$s</a>" or "<a href="%4$s" target="_blank">%5$s</a>" to be installed and activated.', 'wolf-core' ) ),
				'<strong>' . esc_html__( 'Wolf Core', 'wolf-core' ) . '</strong>',
				'https://wlfthm.es/elementor',
				'<strong>' . esc_html__( 'Elementor', 'wolf-core' ) . '</strong>',
				'https://wlfthm.es/wpbpb',
				'<strong>' . esc_html__( 'WPBakery Page Builder', 'wolf-core' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site has both Elementor and WPBakery Page Builder installed and activated.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_both_page_builder_plugins() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				wp_kses_post( __( '"%1$s" requires to choose between "<a href="%2$s" target="_blank">%3$s</a>" or "<a href="%4$s" target="_blank">%5$s</a>" to be activated. You can not use both at the same time.', 'wolf-core' ) ),
				'<strong>' . esc_html__( 'Wolf Core', 'wolf-core' ) . '</strong>',
				'https://wlfthm.es/elementor',
				'<strong>' . esc_html__( 'Elementor', 'wolf-core' ) . '</strong>',
				'https://wlfthm.es/wpbpb',
				'<strong>' . esc_html__( 'WPBakery Page Builder', 'wolf-core' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wolf-core' ),
				'<strong>' . esc_html__( 'Wolf Core', 'wolf-core' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'wolf-core' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_wpb_vc_version() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wolf-core' ),
				'<strong>' . esc_html__( 'Wolf Core', 'wolf-core' ) . '</strong>',
				'<strong>' . esc_html__( 'WPBakery Page Builder', 'wolf-core' ) . '</strong>',
				self::MINIMUM_WPB_VC_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wolf-core' ),
				'<strong>' . esc_html__( 'Wolf Elementor Extension', 'wolf-core' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'wolf-core' ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		/**
		 * Activation function
		 */
		public function activate() {

			if ( ! get_transient( 'wolf_core_activation_notice' ) && ! get_option( 'wolf_core_activation_notice_set' ) ) {
				set_transient( 'wolf_core_activation_notice', true, 30 * DAY_IN_SECONDS );
				update_option( 'wolf_core_activation_notice_set', true );
			}

			if ( ! get_option( '_wolf_core_flush_rewrite_rules_flag' ) ) {
				add_option( '_wolf_core_flush_rewrite_rules_flag', true );
			}

			update_option( 'wpb_js_gutenberg_disable', true );

			$cpt_support = get_option( 'elementor_cpt_support' );

			// if it DOES exist, but portfolio is NOT defined
			if ( ! in_array( 'wolf_content_block', $cpt_support ) ) {
				$cpt_support[] = 'wolf_content_block'; // append to array.
				update_option( 'elementor_cpt_support', $cpt_support ); // update database.
			}
		}

		/**
		 * Flush rewrite rules on plugin activation to avoid 404 error on oist type single ^page
		 */
		public function flush_rewrite_rules() {

			if ( get_option( '_wolf_core_flush_rewrite_rules_flag' ) ) {
				flush_rewrite_rules();
				delete_option( '_wolf_core_flush_rewrite_rules_flag' );
			}
		}

		/**
		 * Define constant if not already set
		 *
		 * @param  string      $name The constant to define.
		 * @param  string|bool $value The constant value.
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Define WR Constants
		 */
		private function define_constants() {

			$constants = array(
				'WOLF_CORE_DEV'            => false,
				'WOLF_CORE_OK'             => true,
				'WOLF_CORE_DIR'            => $this->plugin_path(),
				'WOLF_CORE_URI'            => $this->plugin_url(),
				'WOLF_CORE_CSS'            => $this->plugin_url() . '/assets/css',
				'WOLF_CORE_JS'             => $this->plugin_url() . '/assets/js',
				'WOLF_CORE_SCRIPT_VERSION' => ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : $this->version,
				'WOLF_CORE_SLUG'           => plugin_basename( dirname( __FILE__ ) ),
				'WOLF_CORE_PATH'           => plugin_basename( __FILE__ ),
				'WOLF_CORE_VERSION'        => $this->version,
				'WOLF_CORE_SUPPORT_URL'    => $this->support_url,
				'WOLF_CORE_DOC_URI'        => 'https://docs.wolfthemes.com/documentation/plugins/' . plugin_basename( dirname( __FILE__ ) ),
				'WOLF_CORE_WOLF_DOMAIN'    => 'wolfthemes.com',
			);

			foreach ( $constants as $name => $value ) {
				$this->define( $name, $value );
			}
		}

		/**
		 * What type of request is this?
		 * string $type ajax, frontend or admin
		 *
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin':
					return is_admin();
				case 'ajax':
					return defined( 'DOING_AJAX' );
				case 'cron':
					return defined( 'DOING_CRON' );
				case 'frontend' || wolf_core_is_vc_frontend():
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

			$core_files = array(
				'core-functions',
				'background-functions',
				'filters',
				'utility-functions',
				'conditional-functions',
				'google-fonts',
				'styles',
				'scripts',
			);

			/* Includes core files from theme inc dir in both frontend and backend */
			foreach ( $core_files as $file ) {

				if ( ! require_once WOLF_CORE_DIR . '/inc/' . $file . '.php' ) {
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

			if ( $this->is_request( 'admin' ) ) {

				if ( ! get_transient( 'wolf_core_activation_notice' ) && ! get_option( 'wolf_core_activation_notice_set' ) ) {
					set_transient( 'wolf_core_activation_notice', true, 30 * DAY_IN_SECONDS );
					update_option( 'wolf_core_activation_notice_set', true );
				}

				$this->admin_includes();
			}

			$this->plugins_includes();

			if ( $this->is_request( 'ajax' ) ) {
				$this->ajax_includes();
			}

			if ( $this->is_request( 'frontend' ) ) {
				$this->frontend_includes();
			}

			$this->element_includes();
		}

		/**
		 * Include required admin files.
		 */
		public function admin_includes() {

			$admin_files = array(
				'admin-theme-activation',
				'classes/class-options',
				'classes/class-admin',
				'classes/class-video-thumbnail-generator',
				'classes/class-metaboxes',
			);

			/* Includes core files from theme inc dir in both frontend and backend */
			foreach ( $admin_files as $file ) {

				if ( ! require_once WOLF_CORE_DIR . '/inc/admin/' . $file . '.php' ) {
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

		/**
		 * Include required files for page builder plugins functions.
		 */
		public function plugins_includes() {
			if ( 'elementor' === wolf_core_get_plugin_in_use() ) {

				require_once 'plugins/elementor/elementor.php';
			}

			if ( 'wbp-vc' === wolf_core_get_plugin_in_use() ) {

				require_once 'plugins/wpbakery-page-builder/wpbakery-page-builder.php';
			}

			require_once 'plugins/content-blocks/content-blocks.php';
		}

		/**
		 * Include required ajax files.
		 */
		public function ajax_includes() {
			// include_once( 'inc/ajax/ajax-functions.php' );
		}

		/**
		 * Include required frontend files.
		 */
		public function frontend_includes() {

			$frontend_files = array(
				'template-functions',
				'template-hooks',
				'frontend-functions',
			);

			/* Includes core files from theme inc dir in both frontend and backend */
			foreach ( $frontend_files as $file ) {

				if ( ! require_once WOLF_CORE_DIR . '/inc/frontend/' . $file . '.php' ) {
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

		/**
		 * Include required elements files.
		 */
		public function element_includes() {
			$element_files = array(
				'custom-heading',
				'content-block',
			);

			/* Includes core files from theme inc dir in both frontend and backend */
			foreach ( $element_files as $file ) {

				if ( ! require_once WOLF_CORE_DIR . '/plugins/elements/' . $file . '.php' ) {
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

		/**
		 * Get the WPBakery Page Builder template path.
		 *
		 * @return string
		 */
		public function wpbpb_shortcode_template_path() {
			return apply_filters( 'wolf_core_wpbpb_shortcode_template_path', 'plugins/wpbakery-page-builder/templates/' );
		}

		/**
		 * Get the plugin url.
		 *
		 * @return string
		 */
		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', __FILE__ ) );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Get Ajax URL.
		 *
		 * @return string
		 */
		public function ajax_url() {
			return admin_url( 'admin-ajax.php', 'relative' );
		}

		/**
		 * Plugin update
		 */
		public function plugin_update() {

			if ( ! class_exists( 'WP_GitHub_Updater' ) ) {
				include_once 'inc/admin/updater.php';
			}

			$repo = 'wolfthemes/wolf-core';

			$config = array(
				'slug'               => plugin_basename( __FILE__ ),
				'proper_folder_name' => 'wolf-core',
				'api_url'            => 'https://api.github.com/repos/' . $repo . '',
				'raw_url'            => 'https://raw.github.com/' . $repo . '/master/',
				'github_url'         => 'https://github.com/' . $repo . '',
				'zip_url'            => 'https://github.com/' . $repo . '/archive/master.zip',
				'sslverify'          => true,
				'requires'           => '5.0',
				'tested'             => '5.5',
				'readme'             => 'README.md',
				'access_token'       => '',
			);

			new WP_GitHub_Updater( $config );
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

	WOLF_CORE(); // Go!
}
