<?php

// delete_option( '_wolftheme_hide_theme_plugin_notice_flag' );
// dd( get_option( '_wolftheme_hide_theme_plugin_notice_flag' ) );

if ( ! class_exists( 'Wolf_Core_Plugin_Installer' ) ) {
	/**
	 * Plugin installation class
	 */
	class Wolf_Core_Plugin_Installer {

		/**
		 * The single instance of the class
		 */
		protected static $instance = null;

		/**
		 * Holds arrays of plugin details.
		 *
		 * @var array
		 */
		public $plugins = array();

		/**
		 * Main Theme Instance
		 *
		 * Ensures only one instance of the theme is loaded or can be loaded.
		 *
		 * @static
		 * @see THEMENAME()
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
		}

		public function __construct( $plugins ) {

			$this->plugins = $plugins;

			// This should prevent the WC wizard from triggering
			add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );

			add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

			add_action( 'admin_notices', array( $this, 'import_admin_notice' ) );
			add_action( 'wp_ajax_import_external_plugin', array( $this, 'import_external_plugin' ) );
			add_action( 'wp_ajax_activate_all_plugins', array( $this, 'activate_all_plugins' ) );
			add_action( 'wp_ajax_plugin_install_dismiss_notice', array( $this, 'plugin_install_dismiss_notice' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'import_admin_scripts' ) );

			add_action( 'pt-ocdi/before_content_import_execution', array( $this, 'flush_rewrite_rules_before_import' ) );

			add_action( 'pt-ocdi/after_import', array( $this, 'set_pages_after_import' ) );
			add_filter( 'pt-ocdi/plugin_intro_text', array( $this, 'plugin_intro_text' ) );
			add_action( 'pt-ocdi/after_import', array( $this, 'replace_content_urls_after_import' ) );
			add_action( 'pt-ocdi/after_import', array( $this, 'replace_menu_item_custom_urls_after_import' ) );
			add_action( 'pt-ocdi/after_import', array( $this, 'remove_mods_after_import' ) );
			add_action( 'pt-ocdi/after_import', array( $this, 'set_permalinks_and_flags_after_import' ) );
			add_action( 'pt-ocdi/after_import', array( $this, 'generate_elementor_css_cache' ) );
			add_action( 'pt-ocdi/after_content_import_execution', array( $this, 'flush_rewrite_rules_after_import' ) );
			add_filter( 'ocdi/time_for_one_ajax_call', array( $this, 'ocdi_change_time_of_single_ajax_call' ) );
		}

		public function recommended_plugin_installed() {

			if ( get_option( '_wolf_core_hide_theme_plugin_notice_flag' ) ) {
				return true;
			} else {
				$plugins  = $this->plugins;
				$complete = true;

				foreach ( $plugins as $slug => $url ) {
					if ( ! is_plugin_active( $slug ) ) {
						$complete = false;
						break;
					}
				}

				return $complete;
			}
		}

		public function import_admin_notice() {

			if ( ! $this->recommended_plugin_installed() ) {
				?>
				<div class="notice notice-info is-dismissible wolf-core-notice wolf-core-custom-plugin-instal-notice">
					<h2 class="wolf-core-ocdi-notice-title"><?php esc_html_e( 'Install the required plugins to import the demo', 'wolf-core' ); ?></h2>
					<p class="plugin-install-info"><?php esc_html_e( 'Clicking the button will install required plugins and redirect you to the demo import page.', 'wolf-core' ); ?>
					<br>
					<?php
					printf(
						/* translators: %s: help URL */
						wolf_core_kses( __( 'Make sure that <strong>your hosting service provider allows external connections via the WordPress "wp_safe_remote_post" function</strong> so the plugins can be downloaded. (<a href="%s" target="_blank">more info</a>)', 'wolf-core' ) ),
						'https://wlfthm.es/hosting-external-connection-issue'
					);
					?>
					</p>
					<button class="wolf-core-install-import-plugin-btn btn-get-ocdi button button-primary button-hero"><?php esc_html_e( 'Install Plugins', 'wolf-core' ); ?></button>
					<br><br><a href="#" class="btn-get-ocdi-discard"><small><?php esc_html_e( 'No, I want to install everything by myself.', 'wolf-core' ); ?></small></a>
					<br><br>
				</div>
				<?php
				return;
			}
		}

		public function import_external_plugin() {
			check_ajax_referer( 'wolf_core_ocdi_install_nonce', 'security' );

			// wp_send_json( 'test' );

			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			if ( ! isset( $_POST['slug'] ) ) {
				wp_send_json( 'no plugin sepcified' );
			}

			if ( ! function_exists( 'download_url' ) ) {
				require_once ABSPATH . 'wp-admin' . '/includes/file.php';
			}

			$plugin_list = $this->plugins;

			$slug = esc_attr( $_POST['slug'] );
			$url  = ( isset( $plugin_list[ $slug ] ) ) ? $plugin_list[ $slug ] : null;

			$is_external = wp_http_validate_url( $url );

			if ( ! is_dir( WP_PLUGIN_DIR . '/' . $slug ) ) {

				// wp_send_json( $slug );

				if ( ! $is_external ) {
					include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
					include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

					$api = plugins_api(
						'plugin_information',
						array(
							'slug'   => sanitize_key( wp_unslash( $_POST['slug'] ) ),
							'fields' => array(
								'sections' => false,
							),
						)
					);

					// wp_send_json( $api->download_link );
					$url = $api->download_link;
				}

				if ( download_url( $url ) ) {

					$filename = download_url( $url );

					$plugin_path = WP_PLUGIN_DIR;

					WP_Filesystem();

					if ( is_file( $filename ) ) {
						$unzipfile = unzip_file( $filename, $plugin_path );

						if ( $unzipfile ) {
							$new_filename = str_replace( '-master', '', $slug );

							if ( file_exists( WP_PLUGIN_DIR . '/' . $slug . '-master' ) && 'envato-market' !== $slug ) {
								rename( $plugin_path . '/' . $slug . '-master', $plugin_path . '/' . $new_filename );
							}
						}

						unlink( $filename );

						wp_send_json( $slug . ' imported' );
					}
				}
			} else {
				wp_send_json( $slug . ' already installed' );
			}

			exit();
		}

		public function activate_all_plugins() {
			check_ajax_referer( 'wolf_core_ocdi_activate_nonce', 'security' );

			if ( ! current_user_can( 'activate_plugin' ) ) {
				wp_send_json( 'user can not' );
			}

			if ( empty( $_POST['slug'] ) ) {
				wp_send_json( 'no plugin sepcified' );
			}

			$plugin_list = $this->plugins;
			$slug        = sanitize_key( wp_unslash( $_POST['slug'] ) );
			$path        = ( isset( $plugin_list[ $slug ] ) ) ? $plugin_list[ $slug ] : null;
			$is_external = wp_http_validate_url( $path );

			if ( $is_external ) {
				$path = esc_attr( $slug . '/' . $slug . '.php' );
			}

			if ( file_exists( WP_PLUGIN_DIR . '/' . $path ) ) {
				if ( ! is_plugin_active( $path ) ) {

					$result = activate_plugin( $path, false, false, true );

					if ( is_wp_error( $result ) ) {
						// wp_send_json_error( $result );
						wp_send_json( $path . ' error' );
					}

					if ( 'revslider' === $slug ) {
						delete_transient( '_revslider_welcome_screen_activation_redirect' );
					}

					if ( 'js_composer' === $slug ) {
						delete_transient( '_vc_page_welcome_redirect' );
					}

					wp_send_json( $slug . ' activated' );

				} else {
					wp_send_json( $slug . ' already active' );
				}
			} else {
				echo esc_attr( $path );
				wp_send_json( $slug . ' not found' );
			}

			exit();
		}

		public function plugin_install_dismiss_notice() {
			check_ajax_referer( 'wolf_core_dismiss_notice_nonce', 'security' );
			update_option( '_wolf_core_hide_theme_plugin_notice_flag', 1 );

			flush_rewrite_rules(); // permalink rebuilt after plugin activation

			wp_send_json_success();
			exit();
		}
		/**
		 * Enqueue scripts and pass data to JS.
		 *
		 * @return void
		 */
		public function import_admin_scripts() {

			wp_enqueue_style( 'wolf-core-import', WOLF_CORE_URI . '/assets/css/admin/import.css', array(), '1.0.0' );
			wp_enqueue_script( 'wolf-core-import', WOLF_CORE_URI . '/assets/js/admin/import.js', array( 'jquery' ), '1.0.0', true );

			wp_localize_script(
				'wolf-core-import',
				'wolfCoreImportPlugins',
				array(
					'adminUrl'                 => admin_url(),
					'redirectUrl'              => admin_url( '/themes.php?page=one-click-demo-import' ), // Importer page URI.
					'dismissNonce'             => wp_create_nonce( 'wolf_core_dismiss_notice_nonce' ), // Dismiss nonce.
					'installNonce'             => wp_create_nonce( 'wolf_core_ocdi_install_nonce' ), // Install nonce.
					'activateNonce'            => wp_create_nonce( 'wolf_core_ocdi_activate_nonce' ), // Activate nonce.
					'updatesNonce'             => wp_create_nonce( 'updates' ),
					'requiredPlugins'          => $this->plugins,
					'installingPluginsMessage' => esc_html__( 'Installing plugins...', 'wolf-core' ),
					'activatingPluginsMessage' => esc_html__( 'Activating plugins...', 'wolf-core' ),
					'redirectingMessage'       => esc_html__( 'Redirecting...', 'wolf-core' ),
				)
			);
		}

		public function flush_rewrite_rules_before_import() {
			flush_rewrite_rules();
		}

		public function set_pages_after_import() {

			/* Assign front page and posts page (blog page). */
			$front_page = wolf_core_get_page_by_title( 'Home' );
			$blog_page  = wolf_core_get_page_by_title( 'Blog' );

			update_option( 'show_on_front', 'page' );

			if ( $front_page ) {
				update_option( 'page_on_front', $front_page->ID );
			} else {
				$front_page = wolf_core_get_page_by_title( 'Main Home' );

				if ( $front_page ) {
					update_option( 'page_on_front', $front_page->ID );
				}
			}

			if ( $blog_page ) {
				update_option( 'page_for_posts', $blog_page->ID );
			}

			/* Assign plugins pages */
			$wolf_pages = array(
				'Portfolio',
				'Albums',
				'Videos',
				'Discography',
				'Events',
				'Artists',
				'Jobs',
				'Wishlist',
			);

			foreach ( $wolf_pages as $page_title ) {

				$page = wolf_core_get_page_by_title( $page_title );

				if ( $page ) {
					update_option( '_wolf_' . strtolower( $page_title ) . '_page_id', $page->ID );
				}
			}

			/* Assign WooCommerce pages */
			$woocommerce_pages = array(
				'Shop',
				'Cart',
				'Checkout',
				'My Account',
				'Terms & Conditions',
			);

			foreach ( $woocommerce_pages as $page_title ) {

				$page = wolf_core_get_page_by_title( $page_title );

				if ( 'My Account' === $page_title ) {

					$page_slug = 'myaccount';

				} elseif ( 'Terms & Conditions' === $page_title ) {

					$page_slug = 'terms';

				} else {
					$page_slug = strtolower( $page_title );
				}

				if ( $page ) {
					update_option( 'woocommerce_' . $page_slug . '_page_id', $page->ID );
				}
			}
		}

		public function plugin_intro_text( $default_text ) {

			ob_start();

			?>
			<div class="wolf-core-ocdi-intro-text">
				<h1><?php esc_html_e( 'Install demo content', 'wolf-core' ); ?></h1>

				<p class="about-description">
					<?php esc_html_e( 'Importing demo data is the easiest way to setup your theme. It will allow you to quickly edit everything instead of creating content from scratch.', 'wolf-core' ); ?>
				</p>
				<section class="wolf-core-ocdi-notice-container">
					<main class="wolf-core-ocdi-notice">
						<h4><?php esc_html_e( 'Important', 'wolf-core' ); ?></h4>

						<ul>
							<li class="warning">
								<?php
								printf(
									/* translators: %s: theme admin "about" page URL */
									wolf_core_kses( __( 'Before you begin, <strong>make sure that your server settings fulfill the <a href="%s" target="_blank">server requirements</a></strong>.', 'wolf-core' ) ),
									esc_url( admin_url( 'themes.php?page=wolf-core-about#system-status' ) )
								);
								?>
							</li>
							<li class="warning">
								<?php
								printf(
									/* translators: %s: help URL */
									wolf_core_kses( __( 'Make sure that <strong>your hosting service provider allows external connections via the WordPress "wp_safe_remote_post" function</strong>, so the images can be downloaded from our server. (<a href="%s" target="_blank">more info</a>)', 'wolf-core' ) ),
									'https://wlfthm.es/hosting-external-connection-issue'
								);
								?>
							</li>
							<li class="warning"><?php esc_html_e( 'It is strongly recommended to import the demo on a fresh WordPress install to exactly replicate the theme demo.', 'wolf-core' ); ?></li>
							<li class="warning">
							<?php
								printf(
									/* translators: %s: WordPress reset plugin page URl */
									wolf_core_kses( __( 'We recommend resetting your install using <a href="%s" target="_blank">WordPress Reset</a> plugin.', 'wolf-core' ) ),
									'https://wordpress.org/plugins/wordpress-reset/'
								);
							?>
							<br>
							<strong><?php esc_html_e( 'Please disable all plugins except WordPress Reset before resetting your installation ( in "Tools" -> "Reset").', 'wolf-core' ); ?></strong>
							</li>

							<?php if ( ! $this->recommended_plugin_installed() ) : ?>
								<li>
									<?php
										printf(
											/* translators: %s: WordPress reset plugin page URl */
											wolf_core_kses( __( 'Make sure <a href="%s" target="_blank">all the required plugins</a> are installed and activated.', 'wolf-core' ) ),
											esc_url( admin_url( '/themes.php?page=tgmpa-install-plugins' ) )
										);
									?>
								</li>
							<?php endif; ?>
							<li>
								<?php
									printf(
										/* translators: %s: default site language */
										wolf_core_kses( __( 'You will need to import the Revolution Sliders afterward as explained in <a href="%s" target="_blank">this post</a>.', 'wolf-core' ) ),
										'https://wlfthm.es/import-revsliders'
									);
								?>
							</li>
							<li>
							<?php
								printf(
									/* translators: %s: default site language */
									wolf_core_kses( __( 'The <strong>Site Language</strong> must be set to "%s" in the "Settings" > "General" panel . You will be able to change it afterwards.', 'wolf-core' ) ),
									'English (United States)'
								);
							?>
							</li>
							<li><?php esc_html_e( 'Deactivate all 3rd party plugins except the one recommended by the theme.', 'wolf-core' ); ?></li>
							<li><?php esc_html_e( 'Some of the images may be replaced by placeholder images if they are copyrighted material.', 'wolf-core' ); ?></li>
							<li>
							<?php
								printf(
									/* translators: %s: OCDI plugin page URl */
									wolf_core_kses( __( 'If you have any issue importing the demo content, please check the <a href="%s" target="_blank">plugin troubleshooting documentation</a>.', 'wolf-core' ) ),
									'https://github.com/proteusthemes/one-click-demo-import/blob/master/docs/import-problems.md'
								);
							?>
							</li>
							<li>
							<?php
								printf(
									wolf_core_kses( __( 'Importing the demo content may <strong>take a while</strong>. Have a snack and don\'t refresh the page or close the window until it\'s done!', 'wolf-core' ) )
								);
							?>
							</li>
						</ul>
					</main><!-- .wolf-core-ocdi-notice -->
					<aside class="woilftheme-ocdi-notice-aside">
						<h3><?php esc_html_e( 'Recommended Hosting', 'wolf-core' ); ?></h3>
						<p>
						<?php
						printf(
							wolf_core_kses(
							/* translators: 1: support articles link, 2: support articles link */
								__( 'For a smooth experience, we recommended <a href="%s" target="_blank">Siteground</a> which we have tested and approved!.', 'wolf-core' )
							),
							'https://www.siteground.com/recommended?referrer_id=8486532'
						);
						?>
				</p>
					<a href="https://www.siteground.com/recommended?referrer_id=8486532" target="_blank"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/img/admin/siteground-logo.png' ); ?>" alt="Siteground"></a>
					</aside>
				</section>
				<hr>
				<h4><?php esc_html_e( 'Warning', 'wolf-core' ); ?></h4>
				<p>
				<?php
					printf(
						wolf_core_kses(
							/* translators: 1: support articles link, 2: support articles link */
							__(
								'Successfully importing the demo data into WordPress is not something we can guarantee for all users.<br>There are a lot of variables that come into play, over which we have no control. Most of the time, the main issues are <a href="%1$s" target="_blank">bad shared hosting servers</a>.<br>If you need recommendations on choosing your hosting service provider, here is a list of <a href="%3$s" target="_blank">recommended WordPress hosts</a>.<br>
							If you cannot import the demo data using the one-click demo importer, you can still use the alternative way described in <a href="%3$s" target="_blank">this post</a>.',
								'wolf-core'
							)
						),
						'https://wolfthemes.ticksy.com/article/11668/',
						'https://wolfthemes.ticksy.com/article/13381/',
						'https://wolfthemes.ticksy.com/article/19447'
					);
				?>
				</p>
				<p style="font-size:18px">
				<?php
					printf(
						wolf_core_kses(
							/* translators: %s: WolfThemes services page URL */
							__( '<strong>Do you want us to take care of everything for you? <a target="_blank" href="%s">Learn more &rarr;</a></strong>', 'wolf-core' )
						),
						'https://wolfthemes.com/services'
					);
				?>
				</p>
				<hr>
			</div><!-- .wolf-core-ocdi-intro-text -->
			<?php
			return ob_get_clean();
		}

		public function replace_content_urls_after_import() {

			$pages = get_posts( array( 'posts_per_page' => -1 ) );

			$url_regex       = '/(http:|https:)?\/\/[a-zA-Z0-9\/.?&=_-]+/';
			$demo_url_reg_ex = '/(http|https)?:\/\/([a-z0-9.]+)\wolfthemes.(com|live)/';

			foreach ( $pages as $page ) {

				$page_id = $page->ID;
				$content = get_post( $page_id )->post_content;

				// Loop all URLs.
				$content = preg_replace_callback(
					$url_regex,
					function ( $matches ) use ( $demo_url_reg_ex ) {

						$output = '';

						if ( isset( $matches[0] ) ) {
							$url = $matches[0];

							// Check if it matches demo URL.
							if ( preg_match( $demo_url_reg_ex, $url, $matches ) ) {

								if ( isset( $matches[0] ) ) {

									$wolf_core_root_url = $matches[0];
									$site_url           = home_url( '/' ); // current site url.
									$url_array          = explode( '/', $url );

									if ( isset( $url_array[3] ) ) {

										$demo_slug = $url_array[3];

										$wolf_core_url = $wolf_core_root_url . '/' . $demo_slug . '/';

										$output .= str_replace( $wolf_core_root_url . '/app/uploads', $site_url . '/wp-content/uploads', $url );
										$output .= str_replace( $wolf_core_url, $site_url, $url );
									}
								}
							}
						}

						return $output;
					},
					$content
				);

				/* Update content */
				$post = array(
					'ID'           => $page_id,
					'post_content' => $content,
				);

				/* Update the post into the database */
				wp_update_post( $post );
			}

			/* Replace app folder occurences */
			foreach ( $pages as $page ) {
				$page_id = $page->ID;
				$content = get_post( $page_id )->post_content;
			}
		}

		/**
		 * Replace hard coded URLs from demo data to local URL
		 */
		public function replace_menu_item_custom_urls_after_import() {

			/* Update hard coded links in menu items */
			$main_menu       = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
			$demo_url_reg_ex = '/(http|https)?:\/\/([a-z0-9.]+)\%ROOTDOMAIN%/';

			if ( $main_menu ) {

				$nav_items = wp_get_nav_menu_items( $main_menu->term_id );

				foreach ( $nav_items as $nav_item ) {

					if ( 'custom' === $nav_item->type ) {

						$nav_item_url = $nav_item->url;

						// if hard coded URL.
						if ( preg_match( $demo_url_reg_ex, $nav_item_url, $matches ) ) {

							if ( isset( $matches[0] ) ) {
								$wolf_core_root_url = $matches[0];

								$site_url  = home_url( '/' ); // current site url.
								$url_array = explode( '/', $nav_item_url );

								if ( isset( $url_array[3] ) ) {
									$demo_slug = $url_array[3];

									$wolf_core_url    = $wolf_core_root_url . '/' . $demo_slug . '/';
									$new_nav_item_url = str_replace( $wolf_core_url, $site_url, $nav_item_url );
									$menu_item_db_id  = $nav_item->ID;
									update_post_meta( $menu_item_db_id, '_menu_item_url', esc_url_raw( $new_nav_item_url ) );
								}
							}
						}
					}
				}
			}
		}

		/**
		 * Remove image mods like logos
		 *
		 * As they logo image previews don't appear after import, it may be confusing for users
		 * We will remove the logo mods until it's fixed by the cusomizer import/export plugin or WordPress core
		 */
		public function remove_mods_after_import() {
			remove_theme_mod( 'logo_dark' );
			remove_theme_mod( 'logo_light' );
			remove_theme_mod( 'logo_svg' );
			remove_theme_mod( 'custom_css' );
			remove_theme_mod( 'wp_css' );
		}

		/**
		 * Set permalinks after import
		 */
		public function set_permalinks_and_flags_after_import() {

			add_option( wolf_core_get_theme_slug() . '_demo_data_imported', true );

			/*
			Set pretty permalinks if they're not set yet */
			// if ( ! get_option( 'permalink_structure' ) ) {
				update_option( 'permalink_structure', '/%year%/%monthnum%/%postname%/' );
				flush_rewrite_rules();
			// }
		}

		/**
		 * Generate Elementor CSS cache after demo data import
		 */
		public function generate_elementor_css_cache() {
			if ( did_action( 'elementor/loaded' ) ) {
				\Elementor\Plugin::instance()->files_manager->clear_cache();
			}
		}

		/**
		 * Flush rewrite rules after import
		 *
		 * Make sure all CPT are registered
		 */
		public function flush_rewrite_rules_after_import() {
			update_option( 'permalink_structure', '/%year%/%monthnum%/%postname%/' );
			flush_rewrite_rules();
		}

		/**
		 * Default time of one AJAX call
		 *
		 * @return void
		 */
		public function ocdi_change_time_of_single_ajax_call() {
			return 50;
		}
	}
}

/**
 * Returns the main instance of THEMENAME to prevent the need to use globals.
 *
 * @return ThemeClass_Framework
 */
function wolf_core_plugin_installer( $plugins = array() ) { // phpcs:ignore
	return new Wolf_Core_Plugin_Installer( $plugins );
}
