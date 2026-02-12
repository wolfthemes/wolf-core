<?php
/**
 * Wolf Core Extension Template Functions
 *
 * Action/filter functions used for Wolf Core Extension functions/templates
 *
 * @author WolfThemes
 * @category Frontend
 * @package WolfCore/Frontend
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output generator tag to aid debugging.
 */
function wolf_core_generator_tag( $gen, $type ) {
	switch ( $type ) {
		case 'html':
			$gen .= "\n" . '<meta name="generator" content="WolfCore ' . esc_attr( WOLF_CORE_VERSION ) . '">';
			break;
		case 'xhtml':
			$gen .= "\n" . '<meta name="generator" content="WolfCore ' . esc_attr( WOLF_CORE_VERSION ) . '" />';
			break;
	}
	return $gen;
}
