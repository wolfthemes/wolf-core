<?php
/**
 * Abstract WP_Background_Process class.
 *
 * Uses https://github.com/A5hleyRich/wp-background-processing to handle DB
 * updates in the background.
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_Background_Process' ) ) {
	include_once 'lib/class-db-background-process.php';
}

class Wolf_Core_DB_Updater_Process extends WP_Background_Process {

	protected $action = 'wolf_core_db_updater';

	/**
	 * Is queue empty.
	 *
	 * @return bool
	 */
	protected function is_queue_empty() {
		global $wpdb;

		$table  = $wpdb->options;
		$column = 'option_name';

		if ( is_multisite() ) {
			$table  = $wpdb->sitemeta;
			$column = 'meta_key';
		}

		$key = $wpdb->esc_like( $this->identifier . '_batch_' ) . '%';

		$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM {$table} WHERE {$column} LIKE %s", $key ) ); // @codingStandardsIgnoreLine.

		return ! ( $count > 0 );
	}

	/**
	 * Get batch.
	 *
	 * @return stdClass Return the first batch from the queue.
	 */
	protected function get_batch() {
		global $wpdb;

		$table        = $wpdb->options;
		$column       = 'option_name';
		$key_column   = 'option_id';
		$value_column = 'option_value';

		if ( is_multisite() ) {
			$table        = $wpdb->sitemeta;
			$column       = 'meta_key';
			$key_column   = 'meta_id';
			$value_column = 'meta_value';
		}

		$key = $wpdb->esc_like( $this->identifier . '_batch_' ) . '%';

		$query = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE {$column} LIKE %s ORDER BY {$key_column} ASC LIMIT 1", $key ) ); // @codingStandardsIgnoreLine.

		$batch       = new stdClass();
		$batch->key  = $query->$column;
		$batch->data = array_filter( (array) maybe_unserialize( $query->$value_column ) );

		return $batch;
	}

	/**
	 * See if the batch limit has been exceeded.
	 *
	 * @return bool
	 */
	protected function batch_limit_exceeded() {
		return $this->time_exceeded() || $this->memory_exceeded();
	}

	/**
	 * Handle.
	 *
	 * Pass each queue item to the task handler, while remaining
	 * within server memory and time limit constraints.
	 */
	protected function handle() {
		$this->lock_process();

		do {
			$batch = $this->get_batch();

			foreach ( $batch->data as $key => $value ) {
				$task = $this->task( $value );

				if ( false !== $task ) {
					$batch->data[ $key ] = $task;
				} else {
					unset( $batch->data[ $key ] );
				}

				if ( $this->batch_limit_exceeded() ) {
					// Batch limits reached.
					break;
				}
			}

			// Update or delete current batch.
			if ( ! empty( $batch->data ) ) {
				$this->update( $batch->key, $batch->data );
			} else {
				$this->delete( $batch->key );
			}
		} while ( ! $this->batch_limit_exceeded() && ! $this->is_queue_empty() );

		$this->unlock_process();

		// Start next batch or complete process.
		if ( ! $this->is_queue_empty() ) {
			$this->dispatch();
		} else {
			$this->complete();
		}
	}

	/**
	 * Get memory limit.
	 *
	 * @return int
	 */
	protected function get_memory_limit() {
		if ( function_exists( 'ini_get' ) ) {
			$memory_limit = ini_get( 'memory_limit' );
		} else {
			// Sensible default.
			$memory_limit = '128M';
		}

		if ( ! $memory_limit || -1 === intval( $memory_limit ) ) {
			// Unlimited, set to 32GB.
			$memory_limit = '32G';
		}

		return wp_convert_hr_to_bytes( $memory_limit );
	}

	/**
	 * Schedule cron healthcheck.
	 *
	 * @param array $schedules Schedules.
	 * @return array
	 */
	public function schedule_cron_healthcheck( $schedules ) {
		$interval = apply_filters( $this->identifier . '_cron_interval', 5 );

		if ( property_exists( $this, 'cron_interval' ) ) {
			$interval = apply_filters( $this->identifier . '_cron_interval', $this->cron_interval );
		}

		// Adds every 5 minutes to the existing schedules.
		$schedules[ $this->identifier . '_cron_interval' ] = array(
			'interval' => MINUTE_IN_SECONDS * $interval,
			/* translators: %d: interval */
			'display'  => sprintf( __( 'Every %d minutes', 'woocommerce' ), $interval ),
		);

		return $schedules;
	}

	/**
	 * Delete all batches.
	 *
	 * @return Background_Process
	 */
	public function delete_all_batches() {
		global $wpdb;

		$table  = $wpdb->options;
		$column = 'option_name';

		if ( is_multisite() ) {
			$table  = $wpdb->sitemeta;
			$column = 'meta_key';
		}

		$key = $wpdb->esc_like( $this->identifier . '_batch_' ) . '%';

		$wpdb->query( $wpdb->prepare( "DELETE FROM {$table} WHERE {$column} LIKE %s", $key ) ); // @codingStandardsIgnoreLine.

		return $this;
	}

	/**
	 * Kill process.
	 *
	 * Stop processing queue items, clear cronjob and delete all batches.
	 */
	public function kill_process() {
		if ( ! $this->is_queue_empty() ) {
			$this->delete_all_batches();
			wp_clear_scheduled_hook( $this->cron_hook_identifier );
		}
	}

	/**
	 * Task
	 *
	 * Override this method to perform any actions required on each
	 * queue item. Return the modified item for further processing
	 * in the next pass through. Or, return false to remove the
	 * item from the queue.
	 *
	 * @param mixed $item Queue item to iterate over
	 *
	 * @return mixed
	 */
	protected function task( $item ) {

		// d3_log( $item );
		wdv3u_update_content( $item );

		return false;
	}

	/**
	 * Complete
	 *
	 * Override if applicable, but ensure that the below actions are
	 * performed, or, call parent::complete().
	 */
	protected function complete() {

		// Show notice to user or perform some other arbitrary task...
		update_option( 'wolf_core_db_update_status', 'completed' );

		parent::complete();
	}
}

// var_dump( get_option( 'wolf_core_db_update_status' ) );
// delete_option( 'wolf_core_db_update_status' );

/**
 * Get post to update
 */
function wdv3_get_posts_to_update() {

	return;

	return get_posts(
		array(
			'fields'         => 'ids', // Only get post IDs
			'post_type'      => array( 'post', 'page' ),
			'posts_per_page' => -1,
		)
	);
}

/**
 * Process updates in the background
 */
function wdv3u_process_background_processed_updates() {

	return;

	$theme_slug = wdv3u_get_theme_slug();

	if ( isset( $_GET[ $theme_slug . '-process-update' ] ) ) {
		update_option( 'wolf_core_db_update_status', 'launching' );
		wp_redirect( admin_url() );
		exit;
	}

	if ( isset( $_GET[ $theme_slug . '-skip-update' ] ) ) {
		update_option( 'wolf_core_db_update_status', 'skipped' );
		wp_redirect( admin_url() );
		exit;
	}

	$background_process = new WDV3U_Update_Shortcodes();

	if ( 'launching' === get_option( 'wolf_core_db_update_status' ) ) {

		$background_process->kill_process(); // reset

		$posts_to_update = wdv3_get_posts_to_update();

		foreach ( $posts_to_update as $post_id ) {
			$background_process->push_to_queue( $post_id );
		}

		// Start the queue.
		$background_process->save()->dispatch();
		update_option( 'wolf_core_db_update_status', 'launched' );
	}
}
add_action( 'admin_init', 'wdv3u_process_background_processed_updates' );
