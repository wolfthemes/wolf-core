<?php
/**
 * Styles functions
 *
 * Enqueue styles in the frontend
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue CSS
 *
 * @since WPBakery Page Builder Extension 1.0
 */
function wolf_core_enqueue_styles() {

	$version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : WOLF_CORE_VERSION;
	$suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Don't serve minified CSS files if Autoptimize plugin is activated.
	if ( defined( 'AUTOPTIMIZE_PLUGIN_DIR' ) ) {
		$suffix = '';
	}

	/**
	 * animate.css
	 *
	 * @link https://daneden.github.io/animate.css/
	 */
	wp_register_style( 'animate-css', WOLF_CORE_CSS . '/lib/animate.min.css', array(), '3.3.0' );

	/**
	 * AOS
	 *
	 * @link https://github.com/michalsnik/aos
	 */
	wp_register_style( 'aos', WOLF_CORE_CSS . '/lib/aos.css', array(), '2.3.0' );

	if ( 'vc' === wolf_core_get_plugin_in_use() ) {

		// Font awesome back compat.
		wp_enqueue_style( 'font-awesome', WOLF_CORE_CSS . '/lib/fontawesome/fontawesome.css', array(), '4.7.0' );

		if ( apply_filters( 'wolf_core_force_enqueue_scripts', false ) ) {
			wp_enqueue_style( 'animate-css' );
		}

		wp_enqueue_style( 'wolf-core-wpbpb', WOLF_CORE_CSS . '/wpbpb' . $suffix . '.css', array(), $version );
	}

	// Default icon fonts.
	wp_register_style( 'socicon', WOLF_CORE_CSS . '/lib/fonts/socicon/socicon.min.css', array(), $version );
	wp_register_style( 'wolficons', WOLF_CORE_CSS . '/lib/fonts/wolficons/wolficons.min.css', array(), $version );

	// Libraries.
	wp_enqueue_style( 'flexslider' ); // be sure that flexslider CSS file is enqueue BEFORE our plugin styles.
	wp_enqueue_style( 'flickity', WOLF_CORE_CSS . '/lib/flickity.min.css', array(), '2.2.1' );
	wp_enqueue_style( 'lity', WOLF_CORE_CSS . '/lib/lity.min.css', array(), '2.2.2' );
	// wp_enqueue_style( 'fancybox', WOLF_CORE_CSS . '/lib/jquery.fancybox.min.css', array(), '3.5.2' );

	// Plugin scripts.
	wp_enqueue_style( 'wolf-core-styles', WOLF_CORE_CSS . '/style' . $suffix . '.css', array(), $version );
}
add_action( 'wp_enqueue_scripts', 'wolf_core_enqueue_styles' );


/**
 * Admin styles
 */
// function wolf_core_enqueue_el_adm_styles() {
// wp_enqueue_style( 'wolficons', WOLF_CORE_CSS . '/lib/fonts/wolficons/wolficons.min.css', array(), WOLF_CORE_VERSION );
// }
// add_action( 'wp_enqueue_scripts', 'wolf_core_enqueue_el_adm_styles' );
