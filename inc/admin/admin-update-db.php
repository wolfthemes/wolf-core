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
	 * Last needed Elementor version
	 *
	 * @var mixed
	 * @access private
	 */
	private $last_elementor_version = '3.24.5';

	/**
	 * Last DB version update
	 *
	 * @var mixed
	 * @access private
	 */
	private $last_db_version = '1.8.5';

	/**
	 * New DB version update
	 *
	 * @var mixed
	 * @access private
	 */
	private $newest_db_version = '2.0.7';

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

		// Check DB state.
		add_action( 'admin_init', array( $this, 'set_db_state' ) );

		// Update notice.
		add_action( 'admin_notices', array( $this, 'admin_notice_start_upgrade' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice_upgrade_is_running' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice_upgrade_is_completed' ) );

		// Update DB.
		add_action( 'admin_init', array( $this, 'update_db' ) );
	}

	/**
	 * Set flags if update is needed
	 */
	public function set_db_state() {

		// update_option( 'wolf_core_db_state', 'need_update' );
		// delete_option( 'wolf_core_db_update_status' );

		global $pagenow;

		$debug_array = array(
			'DB State: '             => get_option( 'wolf_core_db_state' ),
			'DB Update status: '     => get_option( 'wolf_core_db_update_status' ),
			'Last DB version: '      => $this->last_db_version,
			'New DB version: '       => $this->newest_db_version,
			'Version history: '      => get_option( 'wolf_core_install_history', array() ),
			'Should Upgrade: '       => $this->should_upgrade(),
			'Is First Install'       => $this->is_first_install(),
			'Previous WCore Version' => $this->get_previous_installed_version(),
			'Compare Version'        => version_compare( $this->get_previous_installed_version(), $this->newest_db_version, '<' ),
		);

		if ( 'index.php' === $pagenow ) {
			// debug( $debug_array );
		}

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
	 * Get previous version installed
	 */
	public function get_previous_installed_version() {
		$installs_history    = get_option( 'wolf_core_install_history', array() );
		$second_last_version = '99999'; // if no previous version installed set high number so the version compare returns false

		if ( array() !== $installs_history ) {
			$versions = array_keys( $installs_history );
			natsort( $versions );
			$versions            = array_values( $versions );
			$second_last_version = ( count( $versions ) >= 2 ) ? $versions[ count( $versions ) - 2 ] : '99999';
		}

		return $second_last_version;
	}

	/**
	 * Should upgrade condition
	 *
	 * Check previous and current and current version
	 *
	 * @return boolean
	 */
	public function should_upgrade() {

		if (
			version_compare( $this->get_previous_installed_version(), $this->newest_db_version, '<' )
			&& get_option( 'wolf_core_db_state' ) !== $this->newest_db_version
			&& version_compare( ELEMENTOR_VERSION, $this->last_elementor_version, '>=' )
		) {
			return true;
		}
	}

	/**
	 * Update DB
	 */
	public function update_db() {

		// wolf_core_log( 'test' );

		// delete_option( 'wolf_core_db_update_status' );
		// debug( get_option( 'wolf_core_db_update_status' ) );

		if ( isset( $_GET['wolf-core-db-process-update'] ) ) {
			update_option( 'wolf_core_db_update_status', 'launching' );
			wp_safe_redirect( admin_url() );
			exit;
		}

		$background_process = new Wolf_Core_DB_Updater_Processor();

		if ( 'launching' === get_option( 'wolf_core_db_update_status' ) ) {

			$background_process->kill_process(); // reset.

			update_option( 'wolf_core_db_update_status', 'launched' );

			$this->_v_2_0_7_widget_name_updates( $background_process );

			// Start the queue.
			$background_process->save()->dispatch();
		}
	}

	/**
	 * Update unprefixed widget names
	 *
	 * More may be needed later
	 */
	public function _v_2_0_7_widget_name_updates( $background_process ) {

		global $wpdb;

		$widgets = array(
			'price-list'      => 'wolf_core_price_list',
			'gallery'         => 'wolf_core_gallery',
			'blockquote'      => 'wolf_core_blockquote',
			'countdown'       => 'wolf_core_countdown',
			'theme_countdown' => 'wolf_core_countdown',
			'link'            => 'wolf_core_link',
		);

		// $widgets = array_flip( $widgets );

		// Get Ids where widget type need to be updated.
		$query_string  = 'SELECT `post_id` FROM `' . $wpdb->postmeta . '` WHERE `meta_key` = "_elementor_data" AND (';
		$query_string .= '`meta_value` LIKE \'%"widgetType":"dummy"%\' ';

		foreach ( $widgets as $old => $new ) {
			$query_string .= 'OR `meta_value` LIKE \'%"widgetType":"' . $old . '"%\' ';
		}

		$query_string .= ');';

		$post_ids = $wpdb->get_col( $wpdb->prepare( $query_string ) );

		// debug( $query_string );
		// debug( $post_ids );

		// return;

		if ( empty( $post_ids ) ) {
			update_option( 'wolf_core_db_update_status', 'completed' );
			$background_process->kill_process(); // reset.
			return false;
		}

		foreach ( $post_ids as $post_id ) {
			wolf_core_log( 'pushing => ' . $post_id );
			$background_process->push_to_queue( $post_id );
		}
	}

	/**
	 * Output update notice
	 */
	public function admin_notice_start_upgrade() {

		global $pagenow;

		if ( 'index.php' !== $pagenow ) {
			return;
		}

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
	 * Output update running notice
	 */
	public function admin_notice_upgrade_is_running() {

		global $pagenow;

		if ( 'index.php' !== $pagenow ) {
			return;
		}

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

	/**
	 * Output update complete notice
	 */
	public function admin_notice_upgrade_is_completed() {

		global $pagenow;

		if ( 'index.php' !== $pagenow ) {
			return;
		}

		if ( 'completed' === get_option( 'wolf_core_db_update_status' ) ) {

			/**
			 * @var Admin_Notices $admin_notices
			 */
			$admin_notices = \Elementor\Plugin::$instance->admin->get_component( 'admin-notices' );

			$options = array(
				// 'title'       => $this->updater_label,
				'description' => '<b>' . $this->updater_label . '</b> - ' . esc_html__( 'The database update process is now complete. Thank you for updating to the latest version!', 'wolf-core' ),
				'type'        => 'success',
				'icon'        => false,
			);

			$admin_notices->print_admin_notice( $options );

			update_option( 'wolf_core_db_state', $this->newest_db_version );
			delete_option( 'wolf_core_db_update_status' );
		}
	}
}

return new Wolf_Core_DB_Updater();
