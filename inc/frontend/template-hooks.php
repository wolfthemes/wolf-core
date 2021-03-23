<?php
/**
 * Wolf Core Extension Template Hooks
 *
 * Action/filter hooks used for Wolf Core Extension functions/templates
 *
 * @author WolfThemes
 * @category Frontend
 * @package WolfCore/Frontend
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * WP Header
 *
 * @see  wolf_core_generator_tag()
 */
add_action( 'get_the_generator_html', 'wolf_core_generator_tag', 10, 2 );
add_action( 'get_the_generator_xhtml', 'wolf_core_generator_tag', 10, 2 );
