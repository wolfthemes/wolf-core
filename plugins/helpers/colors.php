<?php
/**
 * Colors Helpers
 *
 * @author WolfThemes
 * @package WolfCore/Elements
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output colors inline CSS
 */
function wolf_core_output_colors_inline_css() {

	$colors_css = '';
	$accent     = wolf_core_get_theme_accent_color_value();

	/* Button default */
	// $colors_css .= ".wolf-core-button{
	// 	background-color: $accent;
	// }";

	/* Icon default */
	$colors_css .= ".wolf-core-icon-view-stacked .wolf-core-icon{
		background-color: $accent;
	}
	.wolf-core-icon-view-framed  .wolf-core-icon {
		fill: $accent;
		color: $accent;
		border-color: $accent;
	}
	";

	if ( ! SCRIPT_DEBUG ) {
		$colors_css = wolf_core_clean_spaces( $colors_css );
	}

	wp_add_inline_style( 'wolf-core-styles', $colors_css );
}
add_action( 'wp_enqueue_scripts', 'wolf_core_output_colors_inline_css' );
