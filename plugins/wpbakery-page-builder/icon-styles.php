<?php
/**
 * %NAME% icon styles functions
 *
 * Enqueue icon styles in both frontend and admin
 *
 * @author WolfThemes
 * @category Core
 * @package %PACKAGENAME%/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register Custom Icons CSS to use in frontend conditionaly
 */
function wolf_core_register_icon_styles() {

	// Linea Icons
	wp_register_style( 'linea-icons', WOLF_CORE_CSS. '/lib/linea-icons/linea-icons.min.css', array(), '1.0.0' );

	// Linearicons
	wp_register_style( 'linearicons', WOLF_CORE_CSS. '/lib/linearicons/linearicons.min.css', array(), '1.0.0' );

	// Socicon
	wp_register_style( 'socicon', WOLF_CORE_CSS. '/lib/socicon/socicon.min.css', array(), '3.5' );

	// Wolf Icons
	wp_register_style( 'wolficons', WOLF_CORE_CSS. '/lib/wolficons/wolficons.min.css', array(), '1.0.0' );

	// Elegant Icons
	wp_register_style( 'elegant-icons', WOLF_CORE_CSS. '/lib/elegant-icons/elegant-icons.min.css', array(), '1.0.0' );

	// Ionicons
	wp_register_style( 'ionicons', WOLF_CORE_CSS. '/lib/ionicons/ionicons.min.css', array(), '2.0.0' );

	// Dripicons
	wp_register_style( 'dripicons', WOLF_CORE_CSS. '/lib/dripicons/dripicons.min.css', array(), '2.0.0' );

	// Iconmonstr Iconic Font
	wp_register_style( 'iconmonstr-iconic-font', WOLF_CORE_CSS. '/lib/iconmonstr-iconic-font/iconmonstr-iconic-font.min.css', array(), '2.0.0' );

	if ( apply_filters( 'wolf_core_force_enqueue_scripts', false ) ) {
		// All VC icons
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'vc_openiconic' );
		wp_enqueue_style( 'vc_typicons' );
		wp_enqueue_style( 'vc_entypo' );
		wp_enqueue_style( 'vc_linecons' );
		//wp_enqueue_style( 'vc_monosocialiconsfont' );
		wp_enqueue_style( 'vc_material' );

		// Custom icons
		wp_enqueue_style( 'linea-icons' );
		wp_enqueue_style( 'linearicons' );
		wp_enqueue_style( 'socicon' );
		wp_enqueue_style( 'wolficons' );
		wp_enqueue_style( 'elegant-icons' );
		wp_enqueue_style( 'ionicons' );
		wp_enqueue_style( 'dripicons' );
		wp_enqueue_style( 'iconmonstr-iconic-font' );
	}
}
add_action( 'wp_enqueue_scripts', 'wolf_core_register_icon_styles' );

/**
 * Enqueue Custom Icons CSS
 */
function wolf_core_admin_icon_styles() {

	// Linea Icons
	wp_enqueue_style( 'linea-icons', WOLF_CORE_CSS. '/lib/linea-icons/linea-icons.min.css', array(), '1.0.0' );

	// Linearicons
	wp_enqueue_style( 'linearicons', WOLF_CORE_CSS. '/lib/linearicons/linearicons.min.css', array(), '1.0.0' );

	// Socicon
	wp_enqueue_style( 'socicon', WOLF_CORE_CSS. '/lib/socicon/socicon.min.css', array(), '3.5' );

	// Wolf Icons
	wp_enqueue_style( 'wolficons', WOLF_CORE_CSS. '/lib/wolficons/wolficons.min.css', array(), '1.0.0' );

	// Elegant Icons
	wp_enqueue_style( 'elegant-icons', WOLF_CORE_CSS. '/lib/elegant-icons/elegant-icons.min.css', array(), '1.0.0' );

	// Ionicons
	wp_enqueue_style( 'ionicons', WOLF_CORE_CSS. '/lib/ionicons/ionicons.min.css', array(), '2.0.0' );

	// Dripicons
	wp_enqueue_style( 'dripicons', WOLF_CORE_CSS. '/lib/dripicons/dripicons.min.css', array(), '2.0.0' );

	// Dripicons
	wp_enqueue_style( 'iconmonstr-iconic-font', WOLF_CORE_CSS. '/lib/iconmonstr-iconic-font/iconmonstr-iconic-font.min.css', array(), '1.3.0' );
}
add_action( 'admin_enqueue_scripts', 'wolf_core_admin_icon_styles' );