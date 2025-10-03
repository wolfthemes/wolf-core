<?php
/**
 * Background Updater
 * WDV3U_Background_Process Class.
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_Async_Request', false ) ) {
	include_once 'wp-async-request.php';
}

if ( ! class_exists( 'WP_Background_Process', false ) ) {
	include_once 'wp-background-process.php';
}

class Wolf_Core_Background_Process extends WP_Background_Process {

	/**
	 * Initiate new background process.
	 */
	public function __construct() {
		// Uses unique prefix per blog so each blog has separate queue.
		$this->prefix = 'wp_' . get_current_blog_id();
		$this->action = 'wolf_core_updater';

		parent::__construct();
	}

	/**
	 * Dispatch updater.
	 *
	 * Updater will still run via cron job if this fails for any reason.
	 */
	public function dispatch() {
		$dispatched = parent::dispatch();

		if ( is_wp_error( $dispatched ) ) {
			wolf_core_log( sprintf( 'Unable to dispatch Decibel updater: %s', $dispatched->get_error_message() ) );
		}
	}

	/**
	 * Handle cron healthcheck
	 *
	 * Restart the background process if not already running
	 * and data exists in the queue.
	 */
	public function handle_cron_healthcheck() {
		if ( $this->is_process_running() ) {
			// Background process already running.
			return;
		}

		if ( $this->is_queue_empty() ) {
			// No data to process.
			$this->clear_scheduled_event();
			return;
		}

		$this->handle();
	}

	/**
	 * Schedule fallback event.
	 */
	protected function schedule_event() {
		if ( ! wp_next_scheduled( $this->cron_hook_identifier ) ) {
			wp_schedule_event( time() + 10, $this->cron_interval_identifier, $this->cron_hook_identifier );
		}
	}

	/**
	 * Is the updater running?
	 *
	 * @return boolean
	 */
	public function is_updating() {
		return false === $this->is_queue_empty();
	}

	/**
	 * Task
	 *
	 * Override this method to perform any actions required on each
	 * queue item. Return the modified item for further processing
	 * in the next pass through. Or, return false to remove the
	 * item from the queue.
	 *
	 * @param string $callback Update callback function.
	 * @return string|bool
	 */
	protected function task( $callback ) {

		wolf_core_log( $item );

		// sleep( 2 );

		$result = false;

		if ( is_callable( $callback ) ) {
			wolf_core_log( sprintf( 'Running %s callback', $callback ) );
			$result = (bool) call_user_func( $callback, $this );

			if ( $result ) {
				wolf_core_log( sprintf( '%s callback needs to run again', $callback ) );
			} else {
				wolf_core_log( sprintf( 'Finished running %s callback', $callback ) );
			}
		} else {
			wolf_core_log( sprintf( 'Could not find %s callback', $callback ) );
		}

		return $result ? $callback : false;
	}

	/**
	 * Complete
	 *
	 * Override if applicable, but ensure that the below actions are
	 * performed, or, call parent::complete().
	 */
	protected function complete() {

		wolf_core_log( 'Data update complete' );

		parent::complete();
	}

	/**
	 * See if the batch limit has been exceeded.
	 *
	 * @return bool
	 */
	public function is_memory_exceeded() {
		return $this->memory_exceeded();
	}
}
