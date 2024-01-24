<?php

/**
 * Is update needed?
 */
function wolf_core_check_updatable_version() {

	//delete_option( 'wolf_core_db_state' );
	//debug( get_option( 'wolf_core_install_history' ) );
	//debug( get_option( 'wolf_core_db_state' ) );

	$db_state         = get_option( 'wolf_core_db_state' );
	$installs_history = get_option( 'wolf_core_install_history', array() );
	$is_first_install = 1 === count( $installs_history );
	$need_update      = false;

	if ( $is_first_install ) {
		return false;
	}

	// Already updated.
	if ( 'OK' === $db_state ) {
		return false;
	}

	//debug( $installs_history );

	if ( isset( $installs_history['1.8.2'] ) && version_compare( '1.8.3', WOLF_CORE_VERSION, '<=' ) ) {
		$need_update = true;
	}

	if ( $need_update ) {
		update_option( 'wolf_core_db_state', 'need_update' );
	}
}
add_action( 'admin_init', 'wolf_core_check_updatable_version' );

/**
 * Is update needed?
 */
function wolf_core_is_update_needed() {
	return 'need_update' === get_option( 'wolf_core_db_state' );
}

/**
 * Update message
 */
function wolf_core_output_update_db_notice() {

	if ( wolf_core_is_update_needed() ) {
		$current_version = WOLF_CORE_VERSION;
		?>
		<div class="notice notice-info is-dismissible">
			<h2 class="wolf-core-db-update-title"><?php esc_html_e( 'Wolf Elementor Extension Updater', 'wolf-core' ); ?></h2>
			<p class="wolf-core-db-update-info"><?php esc_html_e( 'The database need to be updated to match the new verison of Elementor. Please click on the button below.', 'wolf-core' ); ?>
			</p>
			<a href="<?php echo esc_url( admin_url( 'index.php?wolf_core_db_update=true&wolf_core_update_db_version=' . $current_version ) ); ?>" class="button-primary button-hero"><?php esc_html_e( 'Update Now', 'wolf-core' ); ?></a>
			<br><br>
		</div>
		<?php
		return;
	}
}
add_action( 'admin_notices', 'wolf_core_output_update_db_notice' );

/**
 * Update message
 */
function wolf_core_output_update_successful_db_notice() {
	if ( isset( $_GET['wolf_core_db_updated'] ) ) {
		?>
	<div class="notice notice-info is-dismissible">
		<h2 class="wolf-core-db-update-title"><?php esc_html_e( 'Wolf Elementor Extension Updated!', 'wolf-core' ); ?></h2>
		<p class="wolf-core-db-update-info"><?php esc_html_e( 'Thanks for updating your database for the latest version.', 'wolf-core' ); ?></p>
	</div>
		<?php
		return;
	}
}
add_action( 'admin_notices', 'wolf_core_output_update_successful_db_notice' );

/**
 * Update olf gallery and countdown Elementor widget name
 */
function wolf_core_update_db() {

	$post_types = array( 'page', 'post', 'event', 'release', 'video', 'gallery', 'work', );

	if ( isset( $_GET['wolf_core_db_update'] ) && isset( $_GET['wolf_core_update_db_version'] ) ) {

		foreach ( $post_types as $post_type ) {
			if ( post_type_exists( $post_type ) ) {
				// Get all posts.
				$posts = get_posts(
					array(
						'post_type'      => $post_type,
						'posts_per_page' => -1,
					)
				);

				foreach ( $posts as $p ) {

					$elementor_data = get_post_meta( $p->ID, '_elementor_data', true );

					if ( $elementor_data && isset( $_GET['wolf_core_update_db_version'] ) ) {

						$version = esc_attr( $_GET['wolf_core_update_db_version'] );

						wolf_core_update_db_from_version( $version, $p->ID );
					}
				}
			}
		}

		// Update options.
		update_option( 'wolf_core_db_state', 'OK' );

		// Redirect to success page.
		wp_safe_redirect( esc_url( admin_url( 'index.php?wolf_core_db_updated=true' ) ) );
		exit;
	}

}
add_action( 'admin_init', 'wolf_core_update_db' );

/**
 * Update leta depending on version
 *
 * @param string $version
 * @param int $post_id
 * @return void
 */
function wolf_core_update_db_from_version( $version, $post_id ) {
	$elementor_data = get_post_meta( $post_id, '_elementor_data', true );

	if ( '1.8.3' === $version ) {

		$search = array(
			'"widgetType":"gallery"',
			//'"widgetType":"wolf_core_gallery"',
			'"widgetType":"countdown"',
			'"widgetType":"theme_countdown"',
		);

		$replace = array(
			//'"widgetType":"gallery"',
			'"widgetType":"wolf_core_gallery"',
			'"widgetType":"wolf_core_countdown"',
			'"widgetType":"wolf_core_countdown"',
		);

		$elementor_data = str_replace( $search, $replace, $elementor_data );
	}

	update_post_meta( $post_id, '_elementor_data', $elementor_data );
}
