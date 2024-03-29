<?php
/**
 * WPBakery Page Builder Extension Fonts Functions
 *
 * Enqueue google fonts depending on user settings
 *
 * @author WolfThemes
 * @category Core
 * @package WolfCore/Core
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get loaded Google fonts as a clean array
 *
 * @return array
 */
function wolf_core_get_google_fonts_options() {

	$wolf_core_google_fonts = array();

	$font_option = ( wolf_core_get_option( 'fonts', 'google_fonts' ) ) ? wolf_core_get_option( 'fonts', 'google_fonts' ) . '|' : null;

	if ( $font_option ) {

		$raw_fonts = explode( '|', preg_replace( '/\s+/', '', $font_option ) );

		foreach ( $raw_fonts as $font ) {

			$font_name = preg_replace( '/:[,0-9]+/', '', $font ); // replace font weight.
			$font_name = str_replace( '+', ' ', $font_name );
			$font_name = str_replace( array( 'italic' ), '', $font_name );

			if ( '' !== $font_name ) {
				$wolf_core_google_fonts[ $font_name ] = $font_name;
			}
		}
	}

	$wolf_core_google_fonts = array_unique( $wolf_core_google_fonts );

	return apply_filters( 'wolf_core_google_fonts', $wolf_core_google_fonts );
}

/**
 * Get google font URL
 */
function wolf_core_get_google_fonts_file_url() {

	$url = '';

	$wolf_core_google_fonts = wolf_core_get_google_fonts_options();

	if ( array() !== $wolf_core_google_fonts ) {

		$subsets = 'latin,latin-ext';

		$fonts = array_unique( $wolf_core_google_fonts );
		/*
		 * Translators: To add an additional character subset specific to your language,
		 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'wolf-visual-composer' );

		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}

		$url = add_query_arg(
			array(
				'family' => implode( urlencode( '|' ), $fonts ),
				'subset' => $subsets,
			),
			'https://fonts.googleapis.com/css'
		);

		return esc_url( $url );
	}
}

/**
 * Loads our special font CSS file.
 *
 * @since WPBakery Page Builder Extension 1.0
 */
function wolf_core_enqueue_google_fonts() {

	if ( wolf_core_get_google_fonts_file_url() ) {
		wp_enqueue_style( 'wolf-core-google-fonts', wolf_core_get_google_fonts_file_url(), array(), null );
	}
}
add_action( 'admin_enqueue_scripts', 'wolf_core_enqueue_google_fonts' ); // enqueue google font CSS in admin.
add_action( 'wp_enqueue_scripts', 'wolf_core_enqueue_google_fonts' ); // enqueue google font CSS in frontend.

/**
 * Add preconnect for Google Fonts.
 *
 * @since WPBakery Page Builder Extension 2.4.8
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function wolf_core_resource_hints( $urls, $relation_type ) {

	if ( wp_style_is( 'wolf-core-google-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'wolf_core_resource_hints', 10, 2 );

/**
 * Add google font to editor style
 *
 * @since WPBakery Page Builder Extension 1.7
 */
function wolf_core_add_google_fonts_editor_styles() {

	if ( wolf_core_get_google_fonts_file_url() ) {
		$font_url = str_replace( ',', '%2C', wolf_core_get_google_fonts_file_url() );
		add_editor_style( $font_url );
	}
}
add_action( 'after_setup_theme', 'wolf_core_add_google_fonts_editor_styles' );

/**
 * Add fonts to Elementor
 *
 * @param array $fonts The fonts option array.
 * @return array $fonts
 */
function wolf_core_add_fonts_to_elementor( $fonts ) {

	$google_fonts = wolf_core_get_google_fonts_options();

	foreach ( $google_fonts as $k => $v ) {
		$fonts[ $k ] = 'googlefonts';
	}

	return $fonts;
}
add_filter( 'elementor/fonts/additional_fonts', 'wolf_core_add_fonts_to_elementor' );
