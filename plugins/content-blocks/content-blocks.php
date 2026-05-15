<?php
/**
 * Wolf Core Content Blocks Main Class
 *
 * @author WolfThemes
 * @package WolfCore/ContentBlocks/Core
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Wolf_Content_Blocks {

	/**
	 * Content Blocks Constructor.
	 */
	public function __construct() {

		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters
	 */
	private function init_hooks() {
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'wp_head', array( $this, 'add_no_follow_tag' ) );
	}

	/**
	 * Init Content Blocks when WordPress Initialises.
	 */
	public function init() {

		$this->register_post_type();
		$this->register_taxonomy();

		// Init action.
		do_action( 'wolf_content_block_init' );
	}

	/**
	 * Register post type
	 */
	public function register_post_type() {
		include_once 'register-post-type.php';
	}

	/**
	 * Register taxonomy
	 */
	public function register_taxonomy() {
		include_once 'register-taxonomy.php';
	}

	/**
	 * Add no follow tag on block single view
	 */
	public function add_no_follow_tag() {
		if ( is_singular( 'wolf_content_block' ) ) {
			echo '<!-- WolfCoreContentBlock No Follow -->' . "\n";
			echo '<meta name="robots" content="noindex,follow" />' . "\n";
		}
	}
}

return new Wolf_Content_Blocks();
