<?php
/**
 * Scripts functions
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
 * JS params
 */
function wolf_core_get_js_params() {

	$js_params = apply_filters(
		'wolf_core_js_params',
		array(
			'themeSlug'                 => wolf_core_get_theme_slug(),
			'ajaxUrl'                   => esc_url( WOLF_CORE()->ajax_url() ),
			'ajaxNonce'                 => wp_create_nonce( 'wolf_core_ajax_nonce' ),
			'WolfCoreUrl'               => esc_url( WOLF_CORE_URI ),
			'lightbox'                  => apply_filters( 'wolf_core_lightbox', 'fancybox' ),
			'isMobile'                  => wp_is_mobile(),
			'WOWAnimationOffset'        => apply_filters( 'wolf_core_wow_animation_offset', 0 ),
			'forceAnimationMobile'      => apply_filters( 'wolf_core_force_animation_mobile', false ),
			'smoothScrollSpeed'         => apply_filters( 'wolf_core_smooth_scroll_speed', 900 ),
			'smoothScrollEase'          => apply_filters( 'wolf_core_smooth_scroll_ease', 'swing' ),
			'pieChartLineWidth'         => apply_filters( 'wolf_core_default_pie_chart_line_width', 5 ),
			'parallaxNoIos'             => apply_filters( 'wolf_core_parallax_no_ios', true ),
			'parallaxNoAndroid'         => apply_filters( 'wolf_core_parallax_no_android', true ),
			'parallaxNoSmallScreen'     => apply_filters( 'wolf_core_parallax_no_small_screen', true ),
			'googleMapApiKey'           => wolf_core_get_google_maps_api_key(),
			'onePageSelector'           => apply_filters( 'wolf_core_one_page_selector', '.wolf-core-parent-row' ),
			'fullPage'                  => apply_filters( 'wolf_core_do_fullpage', wolf_core_do_fullpage() ),
			'fpTransitionEffect'        => apply_filters( 'wolf_core_fp_transition_effect', 'mix' ),
			'fpAnimTime'                => apply_filters( 'wolf_core_fp_animtime', 900 ),
			'fpEasing'                  => apply_filters( 'wolf_core_fp_easing', 'swing' ),
			'fullPageContainer'         => apply_filters( 'wolf_core_fp_container', '[data-elementor-type="wp-page"]' ),
			'fullPageSelector'          => apply_filters( 'wolf_core_fp_selector', '.wolf-core-parent-row' ),
			'audioButtonPlayText'       => esc_html__( 'Play', 'wolf-visual-composer' ),
			'audioButtonPauseText'      => esc_html__( 'Pause', 'wolf-visual-composer' ),
			'language'                  => get_locale(),
			'accentColor'               => wolf_core_get_theme_accent_color_value(),
			'fullHeightRowDoWPMOffsset' => apply_filters( 'wolf_core_fullheight_row_do_wpm_offset', true ),
			'isRTL'                     => apply_filters( 'wolf_core_is_rtl', true ),
			'printStylesheet'           => WOLF_CORE_CSS . '/print.min.css',
			'isElementorEditor'         => wolf_core_is_elementor_editor(),
			'l10n'                      => array(
				'emptyFields'           => esc_html__( 'Please fill all fields.', 'wolf-visual-composer' ),
				'unknownError'          => esc_html__( 'Something went wrong while submuitting the form, please try again later.', 'wolf-visual-composer' ),
				'processingMessage'     => esc_html__( 'Loading', 'wolf-visual-composer' ) . '<span class="wolf-core-hellip">.</span><span class="wolf-core-hellip">.</span><span class="wolf-core-hellip">.</span>',
				'BMICProcessingMessage' => esc_html__( 'Calculating', 'wolf-visual-composer' ) . '<span class="wolf-core-hellip">.</span><span class="wolf-core-hellip">.</span><span class="wolf-core-hellip">.</span>',
				'playText'              => esc_html( 'Play', 'wolf-core' ),
				'pauseText'             => esc_html( 'Pause', 'wolf-core' ),
			),
		)
	);

	$js_params = apply_filters( 'wolf_core_js_params', $js_params );

	return $js_params;
}

/**
 * Register scripts
 *
 * @param array $scripts The scripts to register.
 */
function wolf_core_register_scripts( $scripts = array() ) {

	$plugin_version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : WOLF_CORE_VERSION;

	foreach ( $scripts as $handle => $properties ) {
		$src          = esc_url( $properties['src'] );
		$dependencies = ( isset( $properties['dependencies'] ) ) ? $properties['dependencies'] : array( 'jquery' );
		$version      = ( isset( $properties['version'] ) ) ? $properties['version'] : $plugin_version;
		$in_footer    = ( isset( $properties['in_footer'] ) ) ? $properties['in_footer'] : true;

		wp_register_script( $handle, $src, $dependencies, $version, $in_footer );
	}
}

/**
 * Returns script sto register
 */
function wolf_core_get_register_scripts() {

	$version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : WOLF_CORE_VERSION;
	$folder  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '/min';
	$suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Don't serve minified JS files if Autoptimize plugin is activated.
	if ( defined( 'AUTOPTIMIZE_PLUGIN_DIR' ) ) {
		$suffix = '';
		$folder = '';
	}

	return apply_filters(
		'wolf_core_register_scripts',
		array(
			'jarallax'                   => array(
				'src'          => WOLF_CORE_JS . '/lib/jarallax/jarallax.min.js',
				'version'      => '1.10.6',
				'dependencies' => array(),
				'in_footer'    => false,
			),

			'jarallax-video'             => array(
				'src'          => WOLF_CORE_JS . '/lib/jarallax/jarallax-video.min.js',
				'version'      => '1.0.1',
				'dependencies' => array(),
				'in_footer'    => false,
			),

			'parallax-scroll'            => array(
				'src'     => WOLF_CORE_JS . '/lib/jquery.parallax-scroll.min.js',
				'version' => '1.0.0b',
			),

			'lazyloadxt'                 => array(
				'src'     => WOLF_CORE_JS . '/lib/jquery.lazyloadxt.min.js',
				'version' => '1.1.0',
			),

			'wolf-core-text-hover-image' => array(
				'src' => WOLF_CORE_JS . $folder . '/text-hover-image' . $suffix . '.js',
			),
		)
	);
}

/**
 * Enqueue scripts
 *
 * @since WPBakery Page Builder Extension 3.2.8
 */
function wolf_core_enqueue_scripts() {

	$version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : WOLF_CORE_VERSION;
	$folder  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '/min';
	$suffix  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	// Don't serve minified JS files if Autoptimize plugin is activated.
	if ( defined( 'AUTOPTIMIZE_PLUGIN_DIR' ) ) {
		$suffix = '';
		$folder = '';
	}

	/* Register conditional scripts */
	wolf_core_register_scripts( wolf_core_get_register_scripts() );

	/* Lightbox */
	wp_register_script( 'swipebox', WOLF_CORE_JS . '/lib/jquery.swipebox.min.js', array( 'jquery' ), '1.2.9', true );

	// BigText.
	wp_register_script( 'bigtext', WOLF_CORE_JS . '/lib/jquery.bigtext.min.js', array( 'jquery' ), '1.0.0', true );

	// Waypoint.
	wp_deregister_script( 'waypoints' ); // deregister waypoints from VC.
	wp_register_script( 'waypoints', WOLF_CORE_JS . '/lib/jquery.waypoints.min.js', array( 'jquery' ), '1.6.2', true );

	// Froogaloop.
	wp_register_script( 'froogaloop', WOLF_CORE_JS . '/lib/froogaloop.js', array( 'jquery' ), '1.6.2', true ); // deprecated.

	// Vimeo.
	wp_register_script( 'vimeo-player', WOLF_CORE_JS . '/lib/player.min.js', array(), '2.6.1', true );

	// Easypiechart.
	wp_deregister_script( 'vc_pie' ); // deregister vc_pie from VC.
	wp_register_script( 'easypiechart', WOLF_CORE_JS . '/lib/jquery.easypiechart.min.js', array( 'jquery' ), '2.1.7', true );

	// Flex images.
	wp_register_script( 'flex-images', WOLF_CORE_JS . '/lib/jquery.flex-images.min.js', array( 'jquery' ), '1.0.4', true );

	// ImagesLoaded.
	wp_register_script( 'imagesloaded', WOLF_CORE_JS . '/assets/js/lib/imagesloaded.pkgd.min.js', array( 'jquery' ), '4.1.4', true );

	// Sticky elements.
	wp_register_script( 'sticky-kit', WOLF_CORE_JS . '/lib/sticky-kit.min.js', array( 'jquery' ), '1.1.2', true );

	// Mousewheel.
	wp_register_script( 'mousewheel', WOLF_CORE_JS . '/lib/jquery.mousewheel.min.js', array( 'jquery' ), '3.1.13', true );

	// InView.
	wp_register_script( 'inview', WOLF_CORE_JS . '/lib/jquery.inview.min.js', array( 'jquery' ), '1.1.2', true );
	wp_enqueue_script( 'inview' );

	/* Full Page */
	wp_register_script( 'scrolloverflow', WOLF_CORE_JS . '/lib/scrolloverflow.min.js', array(), '0.0.5', true );
	wp_register_script( 'fullpage', WOLF_CORE_JS . '/lib/jquery.fullpage.min.js', array(), '2.9.6', true );

	/* Particles */
	wp_register_script( 'particles', WOLF_CORE_JS . '/lib/particles.min.js', array(), '0.4.0', false );

	/* Print */
	wp_register_script( 'print', WOLF_CORE_JS . '/lib/jQuery.print.min.js', array(), '1.6.0', true );

	// Concat and minifed libraries for theme that use AJAX.
	wp_register_script( 'wolf-core-lib-min', WOLF_CORE_JS . '/min/lib.min.js', array( 'jquery' ), WOLF_CORE_VERSION, true );

	// Concat and minifed scripts for theme that use AJAX.
	wp_register_script( 'wolf-core-scripts', WOLF_CORE_JS . '/min/scripts.min.js', array( 'jquery' ), WOLF_CORE_VERSION, true );

	/*
	Don't register script below if we use the wolf_core_force_enqueue_scripts filter
	When using the wolf_core_force_enqueue_scripts, we will enqueue all these scripts concatenated and minified
	*/
	if ( apply_filters( 'wolf_core_force_enqueue_scripts', false ) ) {
		return;
	}

	/* Libraries */
	wp_register_script( 'event-move', WOLF_CORE_JS . '/lib/jquery.event.move.min.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'twentytwenty', WOLF_CORE_JS . '/lib/jquery.twentytwenty.min.js', array( 'jquery' ), '1.0.0', true );
	wp_register_script( 'countdown', WOLF_CORE_JS . '/lib/jquery.countdown.min.js', array( 'jquery' ), '2.0.1', true );
	wp_register_script( 'countup', WOLF_CORE_JS . '/lib/countUp.min.js', array(), '1.9.3', true );
	wp_register_script( 'fittext', WOLF_CORE_JS . '/lib/jquery.fittext.min.js', array( 'jquery' ), '1.2.0', true );
	wp_register_script( 'flickity', WOLF_CORE_JS . '/lib/flickity.pkgd.min.js', array( 'jquery' ), '2.2.1', true );
	wp_register_script( 'typed', WOLF_CORE_JS . '/lib/typed.min.js', array( 'jquery' ), '2.0.1', true );
	wp_register_script( 'wow', WOLF_CORE_JS . '/lib/wow.min.js', array( 'jquery' ), '1.3.0', true );
	wp_register_script( 'aos', WOLF_CORE_JS . '/lib/aos.js', array( 'jquery' ), '2.3.0', true );
	wp_register_script( 'lity', WOLF_CORE_JS . '/lib/lity.min.js', array( 'jquery' ), '2.2.2', true );
	wp_register_script( 'vivus', WOLF_CORE_JS . '/lib/vivus.min.js', array(), '0.4.0', false );
	wp_register_script( 'owlcarousel', WOLF_CORE_JS . '/lib/owl.carousel.min.js', array( 'jquery' ), '2.2.1', true );

	wp_register_script( 'packery-mode', WOLF_CORE_JS . '/lib/packery-mode.pkgd.min.js', array( 'jquery', 'isotope' ), '2.0.1', true );

	wp_register_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?key=' . wolf_core_get_google_maps_api_key(), array(), WOLF_CORE_VERSION, true );

	// JS Cookies.
	wp_register_script( 'js-cookie', WOLF_CORE_JS . '/lib/js.cookie.min.js', array( 'jquery' ), '2.1.4', true );

	// Register scripts that can be enqueued conditionally.
	wp_register_script( 'wolf-core-responsive', WOLF_CORE_JS . $folder . '/responsive' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-accordion', WOLF_CORE_JS . $folder . '/accordion' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-advanced-slider', WOLF_CORE_JS . $folder . '/advanced-slider' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-anything-slider', WOLF_CORE_JS . $folder . '/anything-slider' . $suffix . '.js', array( 'jquery' ), $version, true );
	/* wp_register_script( 'wolf-core-audio-button', WOLF_CORE_JS . $folder . '/audio-button' . $suffix . '.js', array( 'jquery' ), $version, true ); */
	wp_register_script( 'wolf-core-carousels', WOLF_CORE_JS . $folder . '/carousels' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-bigtext', WOLF_CORE_JS . $folder . '/bigtext' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-fittext', WOLF_CORE_JS . $folder . '/fittext' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-twentytwenty', WOLF_CORE_JS . $folder . '/twentytwenty' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-countdown', WOLF_CORE_JS . $folder . '/countdown' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-counter', WOLF_CORE_JS . $folder . '/counter' . $suffix . '.js', array( 'jquery' ), $version, true );

	wp_register_script( 'wolf-core-fullpage', WOLF_CORE_JS . $folder . '/fullpage' . $suffix . '.js', array( 'jquery' ), $version, true );

	wp_register_script( 'wolf-core-mailchimp', WOLF_CORE_JS . $folder . '/mailchimp' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-sliders', WOLF_CORE_JS . $folder . '/sliders' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-tabs', WOLF_CORE_JS . $folder . '/tabs' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-toggles', WOLF_CORE_JS . $folder . '/toggles' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-typed', WOLF_CORE_JS . $folder . '/autotyping' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-video-preview', WOLF_CORE_JS . $folder . '/video-preview' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-message', WOLF_CORE_JS . $folder . '/message' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-vivus', WOLF_CORE_JS . $folder . '/vivus' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-particles', WOLF_CORE_JS . $folder . '/particles' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-gmaps', WOLF_CORE_JS . $folder . '/gmaps' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-google-maps', WOLF_CORE_JS . $folder . '/google-maps' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-progress-bar', WOLF_CORE_JS . $folder . '/progress-bar' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-process', WOLF_CORE_JS . $folder . '/process' . $suffix . '.js', array( 'jquery' ), $version, true );
	// wp_register_script( 'wolf-core-galleries', WOLF_CORE_JS . $folder . '/galleries' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-album-tracklist', WOLF_CORE_JS . $folder . '/album-tracklist' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-loginform', WOLF_CORE_JS . $folder . '/loginform' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-bmic', WOLF_CORE_JS . $folder . '/bmic' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-modal-window', WOLF_CORE_JS . $folder . '/modal-window' . $suffix . '.js', array( 'jquery', 'js-cookie' ), $version, true );
	wp_register_script( 'wolf-core-privacy-policy-message', WOLF_CORE_JS . $folder . '/privacy-policy-message' . $suffix . '.js', array( 'jquery', 'js-cookie' ), $version, true );
	wp_register_script( 'wolf-core-icon', WOLF_CORE_JS . $folder . '/icon' . $suffix . '.js', array( 'jquery' ), $version, true );

	// Pie charts.
	wp_register_script( 'wolf-core-pie', WOLF_CORE_JS . $folder . '/pie' . $suffix . '.js', array( 'jquery' ), $version, true );

	// Interactive Links.
	wp_register_script( 'wolf-core-interactive-links', WOLF_CORE_JS . $folder . '/interactive-links' . $suffix . '.js', array( 'jquery' ), $version, true );

	// Interactive Overlays.
	wp_register_script( 'wolf-core-interactive-overlays', WOLF_CORE_JS . $folder . '/interactive-overlays' . $suffix . '.js', array( 'jquery' ), $version, true );

	// Video Switcher.
	wp_register_script( 'wolf-core-video-switcher', WOLF_CORE_JS . $folder . '/video-switcher' . $suffix . '.js', array( 'jquery' ), $version, true );

	// Showcase vertical carousel.
	wp_register_script( 'wolf-core-showcase-vertical-carousel', WOLF_CORE_JS . $folder . '/showcase-vertical-carousel' . $suffix . '.js', array( 'jquery' ), $version, true );

	// Print.
	wp_register_script( 'wolf-core-print', WOLF_CORE_JS . $folder . '/print' . $suffix . '.js', array( 'jquery', 'print' ), $version, true );

	// Plugin scripts.
	wp_register_script( 'wolf-core-youtube-video-bg', WOLF_CORE_JS . $folder . '/YT-video-bg' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-vimeo', WOLF_CORE_JS . $folder . '/vimeo' . $suffix . '.js', array( 'jquery' ), $version, true );
	wp_register_script( 'wolf-core-functions', WOLF_CORE_JS . $folder . '/functions' . $suffix . '.js', array( 'jquery' ), $version, true );

	// wp_enqueue_script( 'wolf-core-wavesurfer', Wolf_core_LIB . '/wavesurfer/wavesurfer.js', array(), '3.3.3', false );
	// wp_enqueue_script( 'wolf-core-wavesurfer-regions', Wolf_core_LIB . '/wavesurfer/wavesurfer.regions.js', array(), '3.3.3', false );
}
add_action( 'wp_enqueue_scripts', 'wolf_core_enqueue_scripts' );

/**
 * Enqueue conditional scripts
 *
 * @since WPBakery Page Builder Extension 3.2.8
 */
function wolf_core_enqueue_common_scripts() {

	if ( apply_filters( 'wolf_core_force_enqueue_scripts', false ) ) {
		return;
	}

	if ( 'swipebox' === apply_filters( 'wolf_core_lightbox', 'swipebox' ) ) {
		wp_enqueue_script( 'swipebox' );
	}

	wp_enqueue_script( 'lazyloadxt' );

	// Plugin common scripts.
	wp_enqueue_script( 'wolf-core-functions' ); // common functions.

	// add JS global variables.
	wp_localize_script( 'wolf-core-functions', 'WolfCoreJSParams', wolf_core_get_js_params() );
}
add_action( 'wp_enqueue_scripts', 'wolf_core_enqueue_common_scripts' );

/**
 * Force Enqueue all JS for theme usign AJAX
 *
 * @since WPBakery Page Builder Extension 3.2.8
 */
function wolf_core_force_enqueue_scripts() {

	/* If the theme need scripts on every page for AJAX, we enqueue everything */
	if ( apply_filters( 'wolf_core_force_enqueue_scripts', false ) ) {

		/*
			In case these libraries are used by 3rd party plugins
			We dequeue all library that are in the compressed file
		*/
		wp_dequeue_script( 'bigtext' );
		wp_dequeue_script( 'event-move' );
		wp_dequeue_script( 'twentytwenty' );
		wp_dequeue_script( 'countdown' );
		wp_dequeue_script( 'countup' );
		wp_dequeue_script( 'fittext' );
		wp_dequeue_script( 'flickity' );
		wp_dequeue_script( 'typed' );
		wp_dequeue_script( 'wow' );
		wp_dequeue_script( 'aos' );
		wp_dequeue_script( 'lity' );
		wp_dequeue_script( 'vivus' );

		// Lazyload.
		wp_enqueue_script( 'lazyloadxt' );

		// Lightbox.
		if ( 'swipebox' === apply_filters( 'wolf_core_lightbox', 'swipebox' ) ) {
			wp_enqueue_script( 'swipebox' );
		}

		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'waypoints' );

		// Lib.
		wp_enqueue_script( 'jarallax' );
		wp_enqueue_script( 'jarallax-video' );
		wp_enqueue_script( 'parallax-scroll' );
		wp_enqueue_script( 'particles' );
		wp_enqueue_script( 'sticky-kit' );
		wp_enqueue_script( 'wolf-core-lib-min' ); // all lib files.

		// 3rd party.
		wp_enqueue_script( 'bandsintown', 'https://widget.bandsintown.com/main.min.js', array(), WOLF_CORE_VERSION, true );

		$google_api_key = wolf_core_get_google_maps_api_key();

		if ( $google_api_key ) {
			wp_enqueue_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?key=' . $google_api_key, array(), WOLF_CORE_VERSION, true );
		}

		wp_enqueue_script( 'wolf-facebook-page-box' );

		// Wolf core scripts.
		wp_enqueue_script( 'wolf-core-scripts' );

		// add JS global variables.
		wp_localize_script( 'wolf-core-scripts', 'WolfCoreParams', wolf_core_get_js_params() );

		// MailChimp.
		wp_enqueue_script( 'wolf-core-mailchimp', WOLF_CORE_JS . '/min/mailchimp.min.js', array( 'jquery' ), WOLF_CORE_VERSION, true );

		// Add MailChimp JS global variables.
		wp_localize_script(
			'wolf-core-mailchimp',
			'WolfCoreMailchimpParams',
			array(
				'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
				'unknownError' => esc_html__( 'An unknown error occured.', 'wolf-visual-composer' ),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'wolf_core_force_enqueue_scripts' );

/**
 * Enqueue full page if enabled
 */
function wolf_core_enqueue_fullpage_scripts() {

	if ( wolf_core_do_fullpage() ) {

		wp_enqueue_script( 'waypoints' );
		wp_enqueue_script( 'scrolloverflow' );
		wp_enqueue_script( 'fullpage-extensions' );
		wp_enqueue_script( 'fullpage' );
		wp_enqueue_script( 'wolf-core-fullpage' );
	}
}
add_action( 'wp_enqueue_scripts', 'wolf_core_enqueue_fullpage_scripts', 44 );

/**
 * Overwrite isotope
 */
function wolf_core_overwrite_vc_scripts() {

	wp_deregister_script( 'isotope' );
	wp_register_script( 'isotope', WOLF_CORE_JS . '/lib/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
}
add_action( 'wp_enqueue_scripts', 'wolf_core_overwrite_vc_scripts', 999 );

function wolf_core_add_type_attribute( $tag, $handle, $src ) {
	// if not your script, do nothing and return original $tag
	if ( 'wolf-core-work-category-marquee' !== $handle ) {
		return $tag;
	}
	// change the script tag by adding type="module" and return it.
	$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
	return $tag;
}
// add_filter( 'script_loader_tag', 'wolf_core_add_type_attribute', 10, 3 );
