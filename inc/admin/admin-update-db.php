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

if ( ! class_exists( 'Wolf_Core_DB_Updater_Processor' ) ) {
	include_once 'classes/class-db-updater-processor.php';
}

/**
 * DB Updater
 */
class Wolf_Core_DB_Updater {

	/**
	 * Last DB version update
	 *
	 * @var mixed
	 * @access private
	 */
	private $last_db_version = '1.8.2';

	/**
	 * New DB version update
	 *
	 * @var mixed
	 * @access private
	 */
	private $new_db_version = '1.8.5';

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

		add_action( 'admin_notices', array( $this, 'admin_notice_start_upgrade' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice_upgrade_is_running' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice_upgrade_is_completed' ) );

		// Enqueue AJAX script.
		// add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_script' ) );

		// Update DB AJAX task.
		// add_action( 'wp_ajax_wolf_core_update_db',  array( $this, 'update_db_ajax' ) );

		add_action( 'admin_init', array( $this, 'update_db' ) );
	}

	/**
	 * Enqueue Ajax script
	 *
	 * @return void
	 */
	public function enqueue_script() {
		// wp_enqueue_script( 'wolf-core-update-db', WOLF_CORE_URI . '/assets/js/admin/db-updater.js', array( 'jquery' ), '1.0.0', true );
	}

	/**
	 * Set flags if update is needed
	 */
	public function set_db_state() {

		// update_option( 'wolf_core_db_state', 'need_update' );
		// delete_option( 'wolf_core_db_update_status' );

		$debug_array = array(
			'DB State: '         => get_option( 'wolf_core_db_state' ),
			'DB Update status: ' => get_option( 'wolf_core_db_update_status' ),
			'Last DB version: '  => $this->last_db_version,
			'New DB version: '   => $this->new_db_version,
			'Version history: '  => get_option( 'wolf_core_install_history', array() ),
			'Should Upgrade: '   => $this->should_upgrade(),
		);

		//debug( $debug_array );

		$need_update = false; // by default set to false.

		if ( $this->is_first_install() ) {
			return false;
		}

		if ( $this->should_upgrade() ) {
			$need_update = true;
		}

		// Set flags if DB update needed.
		if ( $need_update ) {
			update_option( 'wolf_core_db_state', 'need_update' );
		}
	}

	/**
	 * Check if first install
	 *
	 * @return boolean
	 */
	public function is_first_install() {
		$installs_history = get_option( 'wolf_core_install_history', array() );
		return 1 === count( $installs_history );
	}

	/**
	 * Should upgrade condition
	 *
	 * Check previous and current and current version
	 *
	 * @return boolean
	 */
	public function should_upgrade() {

		$installs_history = get_option( 'wolf_core_install_history', array() );

		if (
			isset( $installs_history[ $this->last_db_version ] )
			&& get_option( 'wolf_core_db_state' ) !== $this->new_db_version
			&& version_compare( ELEMENTOR_VERSION, '3.8.13', '>=' ) ) {
			return true;
		}
	}

	/**
	 * UPdate DB
	 */
	public function update_db() {

		// wolf_core_log( 'test' );

		// delete_option( 'wolf_core_db_update_status' );
		// debug( get_option( 'wolf_core_db_update_status' ) );

		if ( isset( $_GET['wolf-core-db-process-update'] ) ) {
			update_option( 'wolf_core_db_update_status', 'launching' );
			wp_redirect( admin_url() );
			exit;
		}

		$background_process = new Wolf_Core_DB_Updater_Processor();

		if ( 'launching' === get_option( 'wolf_core_db_update_status' ) ) {

			$background_process->kill_process(); // reset

			$this->_v_1_8_5_widget_name_updates( $background_process );

			// Start the queue.
			$background_process->save()->dispatch();
			update_option( 'wolf_core_db_update_status', 'launched' );
		}
	}

	/**
	 * UPdate DB with AJAX
	 */
	public function update_db_ajax() {

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
	public function _v_1_8_5_widget_name_updates( $background_process ) {

		global $wpdb;

		$widgets = array(
			'gallery'         => 'wolf_core_gallery',
			'blockquote'      => 'wolf_core_blockquote',
			'countdown'       => 'wolf_core_countdown',
			'theme_countdown' => 'wolf_core_countdown',
		);

		// $widgets = array_flip( $widgets );

		// Get Ids where widget type need to be updated
		$query_string  = 'SELECT `post_id` FROM `' . $wpdb->postmeta . '` WHERE `meta_key` = "_elementor_data" AND (';
		$query_string .= '`meta_value` LIKE \'%"widgetType":"dummy"%\' ';

		foreach ( $widgets as $old => $new ) {
			$query_string .= 'OR `meta_value` LIKE \'%"widgetType":"' . $old . '"%\' ';
		}

		$query_string .= ');';

		$post_ids = $wpdb->get_col( $wpdb->prepare( $query_string ) );

		if ( empty( $post_ids ) ) {
			$background_process->push_to_queue( null );
		}

		// wp_send_json( $wpdb->last_query );

		$sql_post_ids = implode( ',', $post_ids );

		foreach ( $post_ids as $post_id ) {
			// wolf_core_log( 'puching => ' . $post_id  );
			$background_process->push_to_queue( $post_id );
		}

		// foreach ( $widgets as $old => $new ) {
		// $wpdb->query(
		// $wpdb->prepare(
		// "UPDATE $wpdb->postmeta SET meta_value = REPLACE(meta_value, %s, %s )
		// WHERE meta_key = '_elementor_data' && post_id IN ( %s ) LIMIT 50;",
		// '"widgetType":"' . esc_attr( $old ) . '"',
		// '"widgetType":"' . esc_attr( $new ) . '"',
		// esc_attr( $sql_post_ids )
		// )
		// );
		// }

		// wp_send_json( $wpdb->last_query );
		// wp_send_json( $sql_post_ids );
	}


	/**
	 * Output update notice
	 */
	public function admin_notice_start_upgrade() {

		if ( 'need_update' === get_option( 'wolf_core_db_state' ) && ! get_option( 'wolf_core_db_update_status' ) ) {

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
					'text'    => esc_html__( 'Update Now', 'wolf-core' ),
					'url'     => esc_url( admin_url( 'index.php?wolf-core-db-process-update' ) ),
					// 'classes' => array( 'button', 'button-primary', 'e-button', 'wolf-core-update-db-btn' ),
					'classes' => array( 'button', 'button-primary', 'e-button' ),
				),
			);

			$admin_notices->print_admin_notice( $options );
		}
	}

	/**
	 * Output update notice
	 */
	public function admin_notice_upgrade_is_running() {

		if ( 'launched' === get_option( 'wolf_core_db_update_status' ) ) {

			/**
			 * @var Admin_Notices $admin_notices
			 */
			$admin_notices = \Elementor\Plugin::$instance->admin->get_component( 'admin-notices' );

			$options = array(
				'title'       => $this->updater_label,
				'description' => esc_html__( 'Database update process is running in the background.  You will be notified when it is done.', 'wolf-core' ),
				'type'        => 'info',
				'icon'        => false,

			);

			$admin_notices->print_admin_notice( $options );
		}
	}

	public function admin_notice_upgrade_is_completed() {

		if ( 'completed' === get_option( 'wolf_core_db_update_status' ) ) {

			/**
			 * @var Admin_Notices $admin_notices
			 */
			$admin_notices = \Elementor\Plugin::$instance->admin->get_component( 'admin-notices' );

			$options = array(
				//'title'       => $this->updater_label,
				'description' => '<b>' . $this->updater_label . '</b> - ' . esc_html__( 'The database update process is now complete. Thank you for updating to the latest version!', 'wolf-core' ),
				'type'        => 'success',
				'icon'        => false,
				// 'button'      => array(
				// 'text'  => esc_html__( 'Update Now', 'wolf-core' ),
				// 'url'   => '#',
				// 'classes' => array( 'button', 'button-primary', 'e-button', 'wolf-core-update-db-btn' ),
				// ),
			);

			$admin_notices->print_admin_notice( $options );

			update_option( 'wolf_core_db_state', $this->new_db_version );
			delete_option( 'wolf_core_db_update_status' );
		}
	}
}

return new Wolf_Core_DB_Updater();
