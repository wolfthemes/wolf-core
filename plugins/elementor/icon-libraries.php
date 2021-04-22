<?php
/**
 * Wolf Core Add custom icon libraries to Elementor
 *
 * @author WolfThemes
 * @package WolfCore/Elementor/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Add icon libraires to elementor
 *
 * @param array $icon_tabs The Elementor icon tabs.
 * @return array
 */
function wolf_core_add_icon_libraries( $icon_tabs ) {

	$libraries = wolf_core_get_icon_libraires();

	foreach ( $libraries as $library ) {
		$icon_tabs[ $library['properties']['name'] ] = array(
			'name'          => $library['properties']['name'],
			'label'         => $library['properties']['label'],
			'labelIcon'     => $library['properties']['labelIcon'],
			'prefix'        => $library['properties']['prefix'],
			'displayPrefix' => $library['properties']['displayPrefix'],
			'url'           => $library['properties']['url'],
			'ver'           => $library['properties']['version'],
			'icons'         => $library['icons'],
		);
	}

	return $icon_tabs;
}
add_filter( 'elementor/icons_manager/additional_tabs', 'wolf_core_add_icon_libraries' );
