<?php
/**
 * Wolf Core Add custom icon libraries to WPBakeryPageBuilder
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add icon choice styles
 *
 * @param string $font The font name.
 */
function wolf_core_enqueue_icon_fonts( $font ) {

	$libraries = wolf_fore_get_icon_libraires();

	foreach ( $libraries as $library => $values ) {
		if ( $library === $font ) {
			wp_enqueue_style( $library );
			break;
		}
	}
}
add_action( 'vc_enqueue_font_icon_element', 'wolf_core_enqueue_icon_fonts' );

/**
 * Add icon libraires to VC
 */
function wolf_core_add_icon_libraries() {

	$libraries = wolf_fore_get_icon_libraires();

	foreach ( $libraries as $library ) {
		$icons    = $library['icons'];
		$vc_icons = array();

		foreach ( $icons as $icon ) {
			$vc_icons[] = array(
				$library['properties']['prefix'] . $icon => ucfirst( str_replace( '-', ' ', $icon ) ),
			);
		}

		add_filter(
			'vc_iconpicker-type-' . $library['properties']['name'],
			function( $icons ) use ( $vc_icons ) {
				return $vc_icons;
			}
		);
	}
}
add_action( 'init', 'wolf_core_add_icon_libraries' );

/**
 * Register Custom Icons CSS to use in frontend conditionaly
 */
function wolf_core_register_icon_styles() {
	$libraries = wolf_fore_get_icon_libraires();

	foreach ( $libraries as $library ) {

		if ( apply_filters( 'wolf_core_force_enqueue_scripts', false ) ) {

			wp_enqueue_style( $library['properties']['name'], $library['properties']['url'], array(), $library['properties']['version'] );

		} else {
			wp_register_style( $library['properties']['name'], $library['properties']['url'], array(), $library['properties']['version'] );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'wolf_core_register_icon_styles' );

/**
 * Enqueue Custom Icons CSS
 */
function wolf_core_admin_icon_styles() {

	$libraries = wolf_fore_get_icon_libraires();

	foreach ( $libraries as $library ) {
		wp_enqueue_style( $library['properties']['name'], $library['properties']['url'], array(), $library['properties']['version'] );
	}
}
add_action( 'admin_enqueue_scripts', 'wolf_core_admin_icon_styles' );
