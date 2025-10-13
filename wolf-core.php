<?php // phpcs:ignore
/**
 * Plugin Name: Wolf Core
 * Plugin URI: https://wlfthm.es/wolf-core
 * Description: Core functions for Wolf Themes.
 * Version: 2.1.4
 * Author: WolfThemes
 * Author URI: https://wolfthemes.com
 * Requires at least: 6.0
 * Tested up to: 6.8
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
		const VERSION = '2.1.4';

		/**
		 * Minimum Elementor Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

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
		public $version = '2.1.4';

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

			/**
			 * Auth and verification
			 */
			if ( ! $this->verifications() ) {
				return;
			}

			$this->define_constants();
			$this->includes();
			$this->init_hooks();

			if ( get_transient( 'wolf_core_activation_notice' ) ) {
				add_action( 'admin_notices', 'wolf_core_show_activation_notice' );
			}

			do_action( 'wolf_core_loaded' );
		}

		/**
		 * Initialize the plugin
		 */
		public function verifications() {

			/*
			Check if Elementor or WPBakery Page Builder is activated */
			// if ( ! did_action( 'elementor/loaded' ) && ! defined( 'WPB_VC_VERSION' ) ) {
			// add_action( 'admin_notices', array( $this, 'admin_notice_missing_page_builder_plugin' ) );
			// return;
			// }

			if ( ! did_action( 'elementor/loaded' ) || defined( 'WPB_VC_VERSION' ) ) {
				add_action( 'admin_notices', array( $this, 'admin_notice_missing_elementor' ) );
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

			return true;
		}

		/**
		 * Hook into actions and filters
		 */
		private function init_hooks() {

			add_action( 'init', array( $this, 'init' ), 0 );

			register_activation_hook( __FILE__, array( $this, 'activate' ) );

			// Plugin update notifications.
			add_action( 'admin_init', array( $this, 'plugin_update' ) );
		}

		/**
		 * Initialize the plugin
		 */
		public function init() {

			// Plugin text domain for translation.
			$this->load_plugin_textdomain();

			// Includes additional good ol' shortcodes that can be used in elements.
			$this->include_shortcodes();

			// Includes element after init hook to allow filtering by theme.
			$this->include_elements();

			// Includes helpers.
			$this->include_helpers();

			// Includes WP widgets.
			$this->include_wp_widgets();

			if ( $this->is_request( 'frontend' ) ) {
				$this->frontend_includes();
			}

			do_action( 'wolf_core_init' );
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
		public function admin_notice_missing_elementor() {

			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
				wp_kses_post( __( '"%1$s" requires <a href="%2$s" target="_blank">%3$s</a> to be installed and activated.', 'wolf-core' ) ),
				'<strong>' . esc_html__( 'Wolf Core', 'wolf-core' ) . '</strong>',
				'https://wlfthm.es/elementor',
				'<strong>' . esc_html__( 'Elementor', 'wolf-core' ) . '</strong>',
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
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
				wp_kses_post( __( '"%1$s" requires <a href="%2$s" target="_blank">%3$s</a> to be installed and activated.', 'wolf-core' ) ),
				'<strong>' . esc_html__( 'Wolf Core', 'wolf-core' ) . '</strong>',
				'https://wlfthm.es/elementor',
				'<strong>' . esc_html__( 'Elementor', 'wolf-core' ) . '</strong>',
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

			/* WPBakery activation hooks */
			update_option( 'wpb_js_gutenberg_disable', true );

			/* Elementor activation hooks */

			// Supported CPT.
			$cpt_support = get_option( 'elementor_cpt_support' );

			$supported_post_types = array(
				'wolf_content_block',
				'work',
				'page',
				'release',
				'video',
				'product',
				'event',
				'post',
			);

			if ( ! $cpt_support ) {
				update_option( 'elementor_cpt_support', $supported_post_types );
			} else {
				foreach ( $supported_post_types as $cpt ) {
					if ( ! in_array( $cpt, $cpt_support, true ) ) {
						$cpt_support[] = $cpt;
					}
				}

				update_option( 'elementor_cpt_support', $cpt_support ); // update database.
			}

			// Disable Elementor Default Colors and fonts to inherit everything from the theme.
			update_option( 'elementor_disable_color_schemes', 'yes' );
			update_option( 'elementor_disable_typography_schemes', 'yes' );
			update_option( 'elementor_load_fa4_shim', 'yes' );
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
				'WOLF_CORE_FONTS'          => $this->plugin_url() . '/assets/css/lib/fonts',
				'WOLF_CORE_JS'             => $this->plugin_url() . '/assets/js',
				'WOLF_CORE_SCRIPT_VERSION' => ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : $this->version,
				'WOLF_CORE_SLUG'           => plugin_basename( __DIR__ ),
				'WOLF_CORE_PATH'           => plugin_basename( __FILE__ ),
				'WOLF_CORE_VERSION'        => $this->version,
				'WOLF_CORE_SUPPORT_URL'    => $this->support_url,
				'WOLF_CORE_DOC_URI'        => 'https://docs.wolfthemes.com/documentation/plugins/' . plugin_basename( __DIR__ ),
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
				'theme-functions',
				'background-functions',
				'image-functions',
				'filters',
				'utility-functions',
				'conditional-functions',
				'google-fonts',
				'styles',
				'scripts',
				'login-form',
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
		}

		/**
		 * Include required admin files.
		 */
		public function admin_includes() {

			$admin_files = array(
				'admin-theme-activation',
				'classes/class-options',
				'classes/class-admin',
				// 'classes/class-video-thumbnail-generator',
				'classes/class-metaboxes',
				// 'classes/class-plugin-installer',
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
		 * Include required files for plugin extension functions.
		 */
		public function plugins_includes() {

			if ( 'elementor' === wolf_core_get_plugin_in_use() ) {

				require_once 'plugins/elementor/elementor.php';
			}

			if ( 'vc' === wolf_core_get_plugin_in_use() ) {

				require_once 'plugins/vc/vc.php';
			}

			require_once 'plugins/content-blocks/content-blocks.php';
		}

		/**
		 * Include required ajax files.
		 */
		public function ajax_includes() {
			include_once 'inc/ajax-functions.php';
		}

		/**
		 * Include required frontend files.
		 */
		public function frontend_includes() {

			$frontend_files = array(
				// 'template-functions',
				// 'template-hooks',
				'body-classes',
				'frontend-functions',
			);

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
		 * Include elements files.
		 *
		 * Look if the files exist and include the parameters and output functions for each element
		 */
		public function include_elements() {

			$common_params_files = array(
				'button',
			);

			foreach ( $common_params_files as $file ) {

				if ( ! require_once WOLF_CORE_DIR . '/plugins/common-params/' . $file . '-params.php' ) {
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

			$element_files = wolf_core_get_elements();

			foreach ( $element_files as $element ) {

				if ( is_file( WOLF_CORE_DIR . '/plugins/params/' . sanitize_title_with_dashes( $element ) . '.php' ) ) {
					include_once WOLF_CORE_DIR . '/plugins/params/' . sanitize_title_with_dashes( $element ) . '.php';
				}

				if ( is_file( WOLF_CORE_DIR . '/plugins/elements/' . sanitize_title_with_dashes( $element ) . '.php' ) ) {
					require_once WOLF_CORE_DIR . '/plugins/elements/' . sanitize_title_with_dashes( $element ) . '.php';
				}
			}
		}

		/**
		 * Include required helper files.
		 */
		public function include_helpers() {

			$helper_files = array(
				'colors',
				'helpers',
				'icons',
			);

			foreach ( $helper_files as $file ) {

				if ( ! require_once WOLF_CORE_DIR . '/plugins/helpers/' . $file . '.php' ) {
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
		 * Include WP widget files files.
		 */
		public function include_wp_widgets() {

			$helper_files = array(
				'mailchimp',
				'social-icons',
			);

			foreach ( $helper_files as $file ) {

				if ( ! require_once WOLF_CORE_DIR . '/inc/wp-widgets/class-widget-' . $file . '.php' ) {
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
		 * Include shortcode files.
		 *
		 * Look if the files exist and include it.
		 */
		public function include_shortcodes() {

			$shortcode_files = array(
				'bit-artist',
				'current-year',
				'next-month',
				'span',
				'text-hover-image',
			);

			foreach ( $shortcode_files as $shortcode ) {

				if ( is_file( WOLF_CORE_DIR . '/plugins/shortcodes/' . sanitize_title_with_dashes( $shortcode ) . '.php' ) ) {
					require_once WOLF_CORE_DIR . '/plugins/shortcodes/' . sanitize_title_with_dashes( $shortcode ) . '.php';
				}
			}
		}

		/**
		 * Get the WPBakery Page Builder template path.
		 *
		 * @return string
		 */
		public function vc_shortcode_template_path() {
			return apply_filters( 'wolf_core_vc_shortcode_template_path', 'plugins/vc/templates/' );
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
			return admin_url( 'admin-ajax.php' );
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
		public function load_plugin_textdomain() {

			$domain = 'wolf-core';
			$locale = apply_filters( 'wolf-core', get_locale(), $domain );
			load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
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
