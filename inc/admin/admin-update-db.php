<?php
/**
 * Wolf Core Update DB functions
 *
 * @author WolfThemes
 * @category Admin
 * @package WolfCore/Admin
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
	return;
}

/**
 * DB Updater
 */
class Wolf_Core_DB_Updater {

	/**
	 * DB version update
	 *
	 * @var mixed
	 * @access private
	 */
	private $last_db_version = '1.8.5';

	/**
	 * Admin notice title label
	 *
	 * @var mixed
	 * @access private
	 */
	private $updater_label = 'Wolf Core Elementor Extension';

	/**
	 * Constructor
	 */
	public function __construct() {

		if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
			return;
		}

		// Check.
		add_action( 'admin_init', array( $this, 'set_db_state' ) );

		// Update notice.

		add_action( 'admin_notices', array( $this, 'admin_notice_upgrade_is_completed' ) );

		add_action( 'admin_notices', array( $this, 'admin_notice_start_upgrade' ) );

		// Enqueue AJAX script.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_script' ) );

		// Update DB AJAX task.
		add_action( 'wp_ajax_wolf_core_update_db',  array( $this, 'update_db' ) );

	}

	/**
	 * Enqueue Ajax script
	 *
	 * @return void
	 */
	public function enqueue_script() {
		wp_enqueue_script( 'wolf-core-update-db', WOLF_CORE_URI . '/assets/js/admin/db-updater.js', array( 'jquery' ), '1.0.0', true );
	}

	/**
	 * Set flags if update is needed
	 */
	public function set_db_state() {

		$debug_array = array(
			'DB State: '        => get_option( 'wolf_core_db_state' ),
			'Last DB version: ' => $this->last_db_version,
			'Version history: ' => get_option( 'wolf_core_install_history', array() ),
		);

		//debug( $debug_array );

		$db_state         = get_option( 'wolf_core_db_state' );
		$installs_history = get_option( 'wolf_core_install_history', array() );
		$is_first_install = 1 === count( $installs_history );
		$need_update      = false; // by default set to false

		if ( $is_first_install ) {
			return false;
		}

		if ( 'OK' !== $db_state ) {
			if ( $this->should_upgrade() ) {
				$need_update = true;
			}
		}

		// Set flags if DB update needed.
		if ( $need_update ) {
			update_option( 'wolf_core_db_state', 'need_update' );
		}
	}

	/**
	 * SHoudl upgrade condition
	 *
	 * Check previous and current and current version
	 *
	 * @return boolean
	 */
	public function should_upgrade() {

		return true; // debug
		if (
			isset( $installs_history['1.8.2'] )
			&& ! isset( $installs_history[ $this->last_db_version ] )
			&& version_compare( '1.8.5', WOLF_CORE_VERSION, '>=' )
			&& version_compare( '3.8.13', ELEMENTOR_VERSION, '>=' ) ) {
			return true;
		}
	}

	/**
	 * UPdate DB
	 */
	public function update_db() {

		check_ajax_referer( 'wolf_core_update_db_nonce', 'security' );

		if ( 'done' === $this->_v_1_8_5_widget_name_updates() ) {
			echo 'OK';
		}

		exit();
	}

	/**
	 * Update unprefixed widget names
	 *
	 * More may be needed later
	 */
	public function _v_1_8_5_widget_name_updates( $debug = false ) {

		global $wpdb;

		$widgets = array(
			'gallery'         => 'wolf_core_gallery',
			'blockquote'      => 'wolf_core_blockquote',
			'countdown'       => 'wolf_core_countdown',
			'theme_countdown' => 'wolf_core_countdown',
		);

		$widgets = array_flip( $widgets );

		// Get Ids where widget type need to be updated
		$query_string  = 'SELECT `post_id` FROM `' . $wpdb->postmeta . '` WHERE `meta_key` = "_elementor_data" AND (';
		$query_string .= '`meta_value` LIKE \'%"widgetType":"dummy"%\' ';

		foreach ( $widgets as $old => $new ) {
			$query_string .= 'OR `meta_value` LIKE \'%"widgetType":"' . $old . '"%\' ';
		}

		$query_string .= ');';

		$post_ids = $wpdb->get_col( $wpdb->prepare( $query_string ) );

		if ( empty( $post_ids ) ) {
			// Return done when finished
			return 'done';
		}

		$sql_post_ids = implode( ',', $post_ids );

		if ( $debug ) {
			return $sql_post_ids;
		}

		$replace = 'REPLACE(meta_value, dummy1, dummy2)';

		foreach ( $widgets as $old => $new ) {
			$replace = 'REPLACE(' . $replace . ', "widgetType":"'. $old . '", "widgetType":"'. $new . '" )';

		}

		$replace .= ')';

		// wp_send_json( $replace );

		foreach ( $widgets as $old => $new ) {
			$wpdb->query(
				$wpdb->prepare(
					"UPDATE $wpdb->postmeta SET meta_value = REPLACE(meta_value, %s, %s )
					WHERE meta_key = '_elementor_data' && post_id IN ( %s ) LIMIT 50;",
					'"widgetType":"' . esc_attr( $old ) . '"',
					'"widgetType":"' . esc_attr( $new ) . '"',
					esc_attr( $sql_post_ids )
				)
			);
		}

		wp_send_json( $sql_post_ids );
	}

	/**
	 * Output update notice
	 */
	public function admin_notice_start_upgrade() {

		if ( 'need_update' === get_option( 'wolf_core_db_state' ) ) {

			/**
			 * @var Admin_Notices $admin_notices
			 */
			$admin_notices = \Elementor\Plugin::$instance->admin->get_component( 'admin-notices' );

			$options = array(
				'title'       => $this->updater_label,
				'description' => esc_html__( 'Your site database needs to be updated to the latest version to keep up with the latest version of Elementor.', 'wolf-core' ),
				'type'        => 'warning',
				'icon'        => false,
				'button'      => array(
					'text'  => esc_html__( 'Update Now', 'wolf-core' ),
					//'url'   => '#',
					'classes' => array( 'button', 'button-primary', 'e-button', 'wolf-core-update-db-btn' ),
				),
			);

			$admin_notices->print_admin_notice( $options );
		}
	}

	public function admin_notice_upgrade_is_completed() {
		if ( isset( $_GET['wolf_core_db_updated'] ) ) {

			update_option( 'wolf_core_db_state', 'OK' );

			/**
			 * @var Admin_Notices $admin_notices
			 */
			$admin_notices = \Elementor\Plugin::$instance->admin->get_component( 'admin-notices' );

			$options = array(
				'title'       => $this->updater_label,
				'description' => esc_html__( 'The database update process is now complete. Thank you for updating to the latest version!', 'wolf-core' ),
				'type'        => 'info',
				'icon'        => false,
				// 'button'      => array(
				// 	'text'  => esc_html__( 'Update Now', 'wolf-core' ),
				// 	//'url'   => '#',
				// 	'classes' => array( 'button', 'button-primary', 'e-button', 'wolf-core-update-db-btn' ),
				// ),
			);

			$admin_notices->print_admin_notice( $options );
		}
	}
}

return new Wolf_Core_DB_Updater();
