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

	$colors = wolf_core_get_shared_colors_hex();

	$colors_css = '';

	/*
	----------------------------------------------------

	BACKGROUND

	-------------------------------------------------------
	*/
	foreach ( $colors as $color => $hex ) {

		/* Background */
		$colors_css .= "
			.wolf-core-background-color-$color{
				background-color:$hex;
			}
		";

		/* Border */
		$colors_css .= "
			.wolf-core-border-color-$color{
				border-color:$hex;
			}
		";

		/* Button */
		$colors_css .= "
			.wolf-core-button-background-color-$color{
				background-color:$hex;
				color:$hex;
				border-color:$hex;
			}

			.wolf-core-button-background-color-$color .wolf-core-button-background-fill{
				box-shadow:0 0 0 0 $hex;
				background-color:$hex;
			}
		";

		/* Icons */
		$colors_css .= "
			.wolf-core-icon-color-$color{
				color:$hex;
			}

			.wolf-core-svg-icon-color-$color svg *{
				stroke:$hex!important;
			}

			.wolf-core-icon-background-color-$color{
				box-shadow:0 0 0 0 $hex;
				background-color:$hex;
				color:$hex;
				border-color:$hex;
			}

			.wolf-core-icon-background-color-$color .wolf-core-icon-background-fill{
				box-shadow:0 0 0 0 $hex;
				background-color:$hex;
			}
		";

		/* Text */
		$colors_css .= "
			.wolf-core-text-color-$color{
				color:$hex!important;
			}
		";
	}

	if ( ! SCRIPT_DEBUG ) {
		$colors_css = wolf_core_clean_spaces( $colors_css );
	}

	wp_add_inline_style( 'wolf-core-styles', $colors_css );
}
add_action( 'wp_enqueue_scripts', 'wolf_core_output_colors_inline_css' );
