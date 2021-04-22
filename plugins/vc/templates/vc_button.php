<?php // phpcs:ignore
/**
 * Button template
 *
 * @author WolfThemes
 * @package WolfCore/WPBakeryPageBuilder/Templates
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( // phpcs:ignore
	shortcode_atts(
		array(
			'type' => '',
		),
		$atts
	)
);

echo wolf_core_button( $atts ); // phpcs:ignore
