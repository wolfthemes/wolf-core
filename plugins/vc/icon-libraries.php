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

	$libraries = wolf_core_get_icon_libraires();

	foreach ( $libraries as $library => $values ) {
		if ( $library === $font ) {
			wp_enqueue_style( $library );
			break;
		}
	}
}
add_action( 'vc_enqueue_font_icon_element', 'wolf_core_enqueue_icon_fonts' );

/**
 * Get default VC icon libraries to main icon libraries array
 *
 * @return array
 */
function wolf_core_get_vc_default_icon_libraries() {

	return array(
		'fontawesome'         => array(
			'properties' => array(
				'name'      => 'fontawesome',
				'label'     => esc_html__( 'Fontawesome', 'wolf-core' ),
				'labelIcon' => 'fa fa-cog',
			),
		),

		'entypo'              => array(
			'properties' => array(
				'name'      => 'entypo',
				'label'     => esc_html__( 'Entypo', 'wolf-core' ),
				'labelIcon' => 'entypo-icon entypo-icon-note',
			),
		),

		'material'            => array(
			'properties' => array(
				'name'      => 'material',
				'label'     => esc_html__( 'Material', 'wolf-core' ),
				'labelIcon' => 'vc-oi vc-oi-dial',
			),
		),

		'monosocialiconsfont' => array(
			'properties' => array(
				'name'      => 'monosocialiconsfont',
				'label'     => esc_html__( 'Monosocialicons', 'wolf-core' ),
				'labelIcon' => 'vc-oi vc-oi-dial',
			),
		),

		'openiconic'          => array(
			'properties' => array(
				'name'      => 'openiconic',
				'label'     => esc_html__( 'Iconic', 'wolf-core' ),
				'labelIcon' => 'fas fas-dial',
			),
		),

		'typicons'            => array(
			'properties' => array(
				'name'      => 'typicons',
				'label'     => esc_html__( 'Typicons', 'wolf-core' ),
				'labelIcon' => 'vc-oi vc-oi-dial',
			),
		),
	);
}

/**
 * Add icon libraires to VC
 */
function wolf_core_add_icon_libraries() {

	$libraries = wolf_core_get_icon_libraires();

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
			function ( $icons ) use ( $vc_icons ) {
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
	$libraries = wolf_core_get_icon_libraires();

	foreach ( $libraries as $library ) {

		if ( apply_filters( 'wolf_core_force_enqueue_scripts', false ) ) {

			wp_enqueue_style( $library['properties']['name'], $library['properties']['url'], array(), $library['properties']['version'] );

		} else {
			wp_register_style( $library['properties']['name'], $library['properties']['url'], array(), $library['properties']['version'] );
		}
	}

	if ( apply_filters( 'wolf_core_force_enqueue_scripts', false ) ) {

		foreach ( wolf_core_get_vc_default_icon_libraries() as $vc_library ) {
			wp_enqueue_style( $vc_library['properties']['name'] );
		}

		foreach ( wolf_core_get_icon_libraires() as $library ) {
			wp_enqueue_style( $library['properties']['name'] );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'wolf_core_register_icon_styles' );

/**
 * Enqueue Custom Icons CSS
 */
function wolf_core_admin_icon_styles() {

	wp_enqueue_style( 'vc_font_awesome_5' );

	$libraries = wolf_core_get_icon_libraires();

	foreach ( $libraries as $library ) {
		wp_enqueue_style( $library['properties']['name'], $library['properties']['url'], array(), $library['properties']['version'] );
	}
}
add_action( 'admin_enqueue_scripts', 'wolf_core_admin_icon_styles' );
