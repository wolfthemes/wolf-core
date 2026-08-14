<?php
/**
 * Updater
 *
 * Hooks into WordPress' update system to check for new versions of this
 * plugin from downloads.wolfthemes.cloud, same principle as
 * Wolf_Envato_License_Manager\Core\Updater.
 *
 * @package WolfCore/Admin
 */

defined( 'ABSPATH' ) || exit;

/**
 * Wolf_Core_Updater class
 */
class Wolf_Core_Updater {

	const INFO_URL = 'https://downloads.wolfthemes.cloud/plugins/wolf-core/info.json';
	const SLUG     = 'wolf-core';
	const FILE     = 'wolf-core/wolf-core.php';

	/**
	 * Hook into WordPress' update system.
	 */
	public function __construct() {
		add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'check_update' ) );
		add_filter( 'plugins_api', array( $this, 'plugin_info' ), 10, 3 );
		add_filter( 'upgrader_post_install', array( $this, 'post_install' ), 10, 3 );
	}

	/**
	 * Fetch and cache info.json from the distribution server.
	 *
	 * @return object|false
	 */
	private function get_remote_info() {
		$transient_key = 'wolf_core_remote_info';
		$data          = get_site_transient( $transient_key );

		if ( ! $data ) {
			$response = wp_remote_get(
				self::INFO_URL,
				array( 'timeout' => 10 )
			);

			if ( is_wp_error( $response ) ) {
				return false;
			}

			$data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( empty( $data->version ) ) {
				return false;
			}

			set_site_transient( $transient_key, $data, 6 * HOUR_IN_SECONDS );
		}

		return $data;
	}

	/**
	 * Inject update info into the WordPress update transient.
	 *
	 * @param object $transient The update_plugins site transient.
	 * @return object
	 */
	public function check_update( $transient ) {
		if ( empty( $transient->checked ) ) {
			return $transient;
		}

		$info            = $this->get_remote_info();
		$current_version = $transient->checked[ self::FILE ] ?? null;

		if ( $info && $current_version && version_compare( $info->version, $current_version, '>' ) ) {
			$transient->response[ self::FILE ] = (object) array(
				'slug'        => self::SLUG,
				'plugin'      => self::FILE,
				'new_version' => $info->version,
				'package'     => $info->download_url,
				'url'         => $info->homepage ?? '',
			);
		}

		return $transient;
	}

	/**
	 * Power the "View details" popup in wp-admin.
	 *
	 * @param false|object $plugin_info The plugins_api response so far.
	 * @param string       $action      The plugins_api action being performed.
	 * @param object       $args        Plugin API arguments.
	 * @return false|object
	 */
	public function plugin_info( $plugin_info, $action, $args ) {
		if ( 'plugin_information' !== $action ) {
			return $plugin_info;
		}

		if ( ! isset( $args->slug ) || self::SLUG !== $args->slug ) {
			return $plugin_info;
		}

		$info = $this->get_remote_info();

		if ( ! $info ) {
			return $plugin_info;
		}

		return (object) array(
			'name'          => $info->name ?? 'Wolf Core',
			'slug'          => self::SLUG,
			'version'       => $info->version,
			'requires'      => $info->requires ?? '5.0',
			'requires_php'  => $info->requires_php ?? '7.0',
			'tested'        => $info->tested ?? '',
			'author'        => $info->author ?? 'WolfThemes',
			'homepage'      => $info->homepage ?? '',
			'download_link' => $info->download_url,
			'sections'      => array(
				'description' => $info->description ?? '',
				'changelog'   => $info->changelog ?? '',
			),
		);
	}

	/**
	 * After install: move the plugin to the correct folder name.
	 * WordPress extracts zips into a temp folder — this renames it properly.
	 *
	 * @param bool  $response   Install response (always true).
	 * @param mixed $hook_extra Extra hook arguments, contains the plugin slug.
	 * @param array $result     The result of the plugin install.
	 * @return array
	 */
	public function post_install( $response, $hook_extra, $result ) {
		unset( $response );

		if (
			! isset( $hook_extra['plugin'] ) ||
			self::FILE !== $hook_extra['plugin']
		) {
			return $result;
		}

		global $wp_filesystem;

		$proper = WP_PLUGIN_DIR . '/' . self::SLUG;
		$wp_filesystem->move( $result['destination'], $proper );
		$result['destination'] = $proper;

		if ( is_plugin_active( self::FILE ) ) {
			activate_plugin( self::FILE );
		}

		return $result;
	}
}
